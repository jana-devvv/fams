<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProposalController extends Controller
{
    public function index() 
    {
        $role = Auth::user()->role->name;

        if($role == 'user') {
            return $this->user();
        } else {
            return $this->admin();
        }
    }

    private function admin()
    {
        $pending = Proposal::where('status', 'pending')->get();
        $approved = Proposal::where('status', 'approved')->get();
        $rejected = Proposal::where('status', 'rejected')->get();
        
        $data = [
            'title' => 'Dashboard | FAMS',
            'pending' => $pending,
            'approved' => $approved,
            'rejected' => $rejected
        ];
        
        return view('dashboard.proposal.administrator', $data);
    }

    private function user()
    {
        $id = Auth::user()->id;
        $proposals = Proposal::where('user_id', $id)->get();
        $data = [
            'title' => 'Dashboard | FAMS',
            'proposals' => $proposals
        ];
        return view('dashboard.proposal.user', $data);
    }

    public function approval(string $id, string $status) 
    {
        $proposal = Proposal::findOrFail($id);
        $proposal->update(['status' => $status]);

        return redirect()->route('proposal.index')->with('success', 'Proposal status updated successfully.');
    }

    public function print(string $id) 
    {
        $proposal = Proposal::findOrFail($id);

        $pdf = Pdf::loadView('dashboard.proposal.print', ['proposal' => $proposal]);
        return $pdf->download('proposal.pdf');
    }

    public function create()
    {
        $data = ['title' => 'Proposal | FAMS'];
        return view('dashboard.proposal.create', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'objectives' => 'required|string',
            'budget' => 'required|max_digits:10'
        ]);

        $validated['user_id'] = Auth::user()->id;

        Proposal::create($validated);

        return redirect()->route('proposal.index')->with('success', 'Proposal successfully created.');
    }

    public function show(string $id)
    {
        $proposal = Proposal::findOrFail($id);
        $data = [
            'title' => 'Proposal | FAMS',
            'proposal' => $proposal
        ];
        return view('dashboard.proposal.detail', $data);
    }

    public function edit(string $id)
    {
        $proposal = Proposal::findOrFail($id);
        $data = [
            'title' => 'Proposal | FAMS',
            'proposal' => $proposal
        ];
        return view('dashboard.proposal.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'objectives' => 'required|string',
            'budget' => 'required|max_digits:10'
        ]);

        $proposal = Proposal::findOrFail($id);
        $proposal->update($validated);

        return redirect()->route('proposal.index')->with('success', 'Proposal successfully updated.');
    }

    public function destroy(string $id)
    {
        $proposal = Proposal::findOrFail($id);
        $proposal->delete();

        return redirect()->route('proposal.index')->with('success', 'Proposal successfully deleted.');
    }
}
