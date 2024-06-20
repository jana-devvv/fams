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
            <li class="breadcrumb-item">Proposal</li>
            <li class="breadcrumb-item active">Detail</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('content')
  <section class="content">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Proposal Detail</h3>
      </div>
      
      <div class="card-body">
        <div class="row">
          <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
            <div class="row">
              <div class="col-12 col-sm-4">
                <div class="info-box bg-light">
                  <div class="info-box-content">
                    <span class="info-box-text text-center text-muted">Budget</span>
                    <span class="info-box-number text-center text-muted mb-0">Rp. {{ $proposal->budget }}</span>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-4">
                <div class="info-box bg-light">
                  <div class="info-box-content">
                    <span class="info-box-text text-center text-muted">Created</span>
                    <span class="info-box-number text-center text-muted mb-0">{{ $proposal->created_at->format('d-m-y') }}</span>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-4">
                <div class="info-box bg-light">
                  <div class="info-box-content">
                    <span class="info-box-text text-center text-muted">Updated</span>
                    <span class="info-box-number text-center text-muted mb-0">{{ $proposal->updated_at->format('d-m-y') }}</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12">
                <h4>Description</h4>
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="{{ asset('template/dashboard/dist/img/avatar5.png') }}" alt="user image">
                    <span class="username">
                      <a href="#">{{ $proposal->user->username }}</a>
                    </span>
                  </div>
                  <p>{{ $proposal->description }}</p>
                </div>
              </div>
            </div>
          </div>

          <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
            <h3 class="text-primary"><i class="fas fa-file-signature"></i> {{ $proposal->title }}</h3>
            <p class="mt-2 mb-0">Objectives</p>
            <p class="text-muted">{{ $proposal->objectives }}</p>
            <br>

            <div class="text-muted">
              <p class="text-sm">Author
                <b class="d-block">{{ $proposal->user->profile->name }}</b>
              </p>
              <p class="text-sm">Phone
                <b class="d-block">{{ $proposal->user->profile->phone ?? '?' }}</b>
              </p>
            </div>

            <div class="text-center mt-5 mb-3">
              <a href="{{ route('proposal.index') }}" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Back</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>    
@endsection

