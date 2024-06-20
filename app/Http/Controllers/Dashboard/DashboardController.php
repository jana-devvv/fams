<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $role = Auth::user()->role->name;
        
        if ($role == 'supervisor') {
            return $this->supervisor();
        } else if ($role == 'admin') {
            return $this->admin();
        } else if ($role == 'user') {
            return $this->user();
        }
    }

    private function supervisor()
    {
        $supervisor = User::with(['role'])->whereHas('role', function($query) {
            $query->where('name', 'supervisor');
        })->count();

        $admin = User::with(['role'])->whereHas('role', function($query) {
            $query->where('name', 'admin');
        })->count();

        $user = User::with(['role'])->whereHas('role', function($query) {
            $query->where('name', 'user');
        })->count();

        $proposalCount = Proposal::count();

        $account = User::select(DB::raw('COUNT(*) as count'))->groupBy('role_id')->get();
        $proposal = Proposal::select('status', DB::raw('COUNT(*) as count'))->groupBy('status')->get();

        $chartProposal = [
            'labels' => $proposal->pluck('status'),
            'datasets' => [
                [
                    'label'=> 'Status Proposal',
                    'backgroundColor' => ['#343a40', '#39cccc', '#d81b60'],
                    'data' => $proposal->pluck('count')
                ],
            ],
        ];

        $chartAccount = [
            'labels' => ['Supervisor', 'Admin', 'User'],
            'datasets' => [
                [
                    'label'=> 'Status Proposal',
                    'backgroundColor' => ['#343a40', '#39cccc', '#d81b60'],
                    'data' => $account->pluck('count')
                ],
            ],
        ];

        // Use Object Casting
        $count = (object) [
            'supervisor' => $supervisor,
            'admin' => $admin,
            'user' => $user,
            'proposal' => $proposalCount
        ];

        $data = [
            'title' => 'Dashboard | FAMS',
            'count' => $count,
            'chart1' => $chartAccount,
            'chart2' => $chartProposal,
        ];

        return view('dashboard.roles.supervisor', $data);
    }

    private function admin()
    {
        $proposal = Proposal::select('status', DB::raw('COUNT(*) as count'))->groupBy('status')->get();

        $chart = [
            'labels' => $proposal->pluck('status'),
            'datasets' => [
                [
                    'label'=> 'Status Proposal',
                    'backgroundColor' => ['#343a40', '#39cccc', '#d81b60'],
                    'data' => $proposal->pluck('count')
                ],
            ],
        ];

        $data = [
            'title' => 'Dashboard | FAMS',
            'chart' => $chart,            
        ];
        
        return view('dashboard.roles.admin', $data);
    }

    private function user()
    {
        $data = [
            'title' => 'Dashboard | FAMS'
        ];
        
        return view('dashboard.roles.user', $data);
    }
}
