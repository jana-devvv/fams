@extends('template.dashboard')

@section('breadcrumbs')
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Proposal</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Dashboard</li>
            <li class="breadcrumb-item active">Proposal</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- Pending -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Status Pending</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                  <i class="fas fa-expand"></i>
                </button>
              </div>
            </div>

            <div class="card-body p-0">
              <table class="table table-striped text-center">
                <thead>
                  <tr>
                    <th style="width: 1%">
                        No.
                    </th>
                    <th style="width: 20%">
                        Proposal Title
                    </th>
                    <th style="width: 20%">
                        Proposal Author
                    </th>
                    <th style="width: 10%" class="text-center">
                        Status
                    </th>
                    <th style="width: 15%"> 
                        Approval
                    </th>
                    <th style="width: 25%">
                        Action
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($pending as $proposal)
                    <tr>
                      <td>
                        {{ $loop->iteration }}
                      </td>

                      <td>
                        <a>{{ $proposal->title }}</a>
                        <br/>
                        <small>Created {{ $proposal->created_at->diffForHumans() }}</small>
                      </td>

                      <td>
                        <ul class="list-inline text-center">
                          <li class="list-inline-item">
                            <img alt="Avatar" class="img-circle" width="80" height="80" src="{{ asset('template/dashboard/dist/img/avatar.png') }}">
                            <p>{{ $proposal->user->username }}</p>
                          </li>
                        </ul>
                      </td>

                      <td>
                        <span class="badge @if($proposal->status == 'approved') badge-success @elseif($proposal->status == 'rejected') badge-danger @else badge-dark @endif p-2" style="font-size: 0.8em">{{ ucfirst($proposal->status)  }}</span>
                      </td>

                      <td>
                        <div class="row">
                          <div class="col-md-6">
                            <form action="{{ route('proposal.approval', ['id' => $proposal->id, 'status' => 'approved']) }}" method="POST">
                              @csrf
                              @method('PATCH')
                              <button type="submit" class="btn btn-sm btn-success">Approve</button>
                            </form>
                          </div>
                          <div class="col-md-6">
                            <form action="{{ route('proposal.approval', ['id' => $proposal->id, 'status' => 'rejected']) }}" method="POST">
                              @csrf
                              @method('PATCH')
                              <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                            </form>
                          </div>
                        </div>
                      </td>
                            
                      <td class="project-actions text-right">
                        <a class="btn btn-info btn-sm" href="{{ route('proposal.show', $proposal->id) }}">
                          <i class="fas fa-list"></i> Detail
                        </a>
                        <form class="d-inline" action="{{ route('proposal.destroy', $proposal->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-sm">
                              <i class="fas fa-trash"></i> Delete
                          </button>
                        </form>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="6">No data available</td>
                    </tr>
                  @endforelse                        
                </tbody>
              </table>
            </div>
          </div>

          <!-- Approved -->
          <div class="card collapsed-card">
            <div class="card-header">
              <h3 class="card-title">Status Approved</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-plus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                  <i class="fas fa-expand"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <table class="table table-striped text-center">
                <thead>
                  <tr>
                    <th style="width: 1%">
                        No.
                    </th>
                    <th style="width: 20%">
                        Proposal Title
                    </th>
                    <th style="width: 20%">
                        Proposal Author
                    </th>
                    <th style="width: 10%" class="text-center">
                        Status
                    </th>
                    <th style="width: 15%"> 
                        Approval
                    </th>
                    <th style="width: 25%">
                        Action
                    </th>
                  </tr>
                </thead>

                    <tbody>
                      @forelse ($approved as $proposal)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                              <a>{{ $proposal->title }}</a>
                              <br/>
                              <small>Created {{ $proposal->created_at->diffForHumans() }}</small>
                            </td>
                            <td>
                                <ul class="list-inline text-center">
                                    <li class="list-inline-item">
                                        <img alt="Avatar" class="img-circle" width="80" height="80" src="{{ asset('template/dashboard/dist/img/avatar.png') }}">
                                        <p>{{ $proposal->user->username }}</p>
                                    </li>
                                </ul>
                            </td>
                            <td>
                              <span class="badge @if($proposal->status == 'approved') badge-success @elseif($proposal->status == 'rejected') badge-danger @else badge-dark @endif p-2" style="font-size: 0.8em">{{ ucfirst($proposal->status)  }}</span>
                            </td>

                            <td>
                              <div class="row">
                                <div class="col-md-6">
                                  <form action="{{ route('proposal.approval', ['id' => $proposal->id, 'status' => 'approved']) }}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                  </form>
                                </div>
                                <div class="col-md-6">
                                  <form action="{{ route('proposal.approval', ['id' => $proposal->id, 'status' => 'rejected']) }}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                  </form>
                                </div>
                              </div>
                            </td>
                            
                            <td class="project-actions text-right">
                              <form class="d-inline" action="{{ route('proposal.print', $proposal->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-file"></i>Print</button>
                              </form>

                              <a class="btn btn-info btn-sm" href="{{ route('proposal.show', $proposal->id) }}">
                                <i class="fas fa-list"></i> Detail
                              </a>
                              <form class="d-inline" action="{{ route('proposal.destroy', $proposal->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" >
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                              </form>
                            </td>
                        </tr>
                      @empty
                      <tr>
                        <td colspan="6">No data available</td>
                      </tr>
                      @endforelse
                    </tbody>
              </table>
            </div>
          </div>

          <!-- Rejected -->
          <div class="card collapsed-card">
            <div class="card-header">
              <h3 class="card-title">Status Rejected</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-plus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                  <i class="fas fa-expand"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <table class="table table-striped text-center">
                <thead>
                  <tr>
                    <th style="width: 1%">
                        No.
                    </th>
                    <th style="width: 20%">
                        Proposal Title
                    </th>
                    <th style="width: 20%">
                        Proposal Author
                    </th>
                    <th style="width: 10%" class="text-center">
                        Status
                    </th>
                    <th style="width: 15%"> 
                        Approval
                    </th>
                    <th style="width: 25%">
                        Action
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($rejected as $proposal)
                    <tr>
                      <td>
                          {{ $loop->iteration }}
                      </td>
                      <td>
                          <a>{{ $proposal->title }}</a>
                          <br/>
                          <small>Created {{ $proposal->created_at->diffForHumans() }}</small>
                      </td>
                      <td>
                        <ul class="list-inline text-center">
                          <li class="list-inline-item">
                            <img alt="Avatar" class="img-circle" width="80" height="80" src="{{ asset('template/dashboard/dist/img/avatar.png') }}">
                            <p>{{ $proposal->user->username }}</p>
                          </li>
                        </ul>
                      </td>
                      <td>
                        <span class="badge @if($proposal->status == 'approved') badge-success @elseif($proposal->status == 'rejected') badge-danger @else badge-dark @endif p-2" style="font-size: 0.8em">{{ ucfirst($proposal->status)  }}</span>
                      </td>

                      <td>
                        <div class="row">
                          <div class="col-md-6">
                            <form action="{{ route('proposal.approval', ['id' => $proposal->id, 'status' => 'approved']) }}" method="post">
                              @csrf
                              @method('PATCH')
                              <button type="submit" class="btn btn-sm btn-success">Approve</button>
                            </form>
                          </div>
                          <div class="col-md-6">
                            <form action="{{ route('proposal.approval', ['id' => $proposal->id, 'status' => 'rejected']) }}" method="post">
                              @csrf
                              @method('PATCH')
                              <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                            </form>
                          </div>
                        </div>
                      </td>
                          
                      <td class="project-actions text-right">
                        <a class="btn btn-info btn-sm" href="{{ route('proposal.show', $proposal->id) }}">
                            <i class="fas fa-list"></i> Detail
                        </a>
                        <form class="d-inline" action="{{ route('proposal.destroy', $proposal->id) }}" method="post">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-sm" >
                              <i class="fas fa-trash"></i> Delete
                          </button>
                        </form>
                      </td>
                    </tr>
                  @empty
                  <tr>
                    <td colspan="6">No data available</td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection