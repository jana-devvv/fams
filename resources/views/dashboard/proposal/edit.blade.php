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
            <li class="breadcrumb-item active">Edit</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit Proposal</h3>
            </div>
            <form action="{{ route('proposal.update', $proposal->id) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="card-body">
                  <!-- Title -->
                  <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{ $proposal->title }}" placeholder="Enter Title">
                    @error('title')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>

                  <!-- Description -->
                  <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="3" placeholder="Enter Description">{{ $proposal->description }}</textarea>
                    @error('description')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>

                  <!-- Objectives -->
                  <div class="form-group">
                    <label for="objectives">Objectives</label>
                    <textarea class="form-control @error('objectives') is-invalid @enderror" name="objectives" rows="3" placeholder="Enter Objectives">{{ $proposal->objectives }}</textarea>
                    @error('objectives')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>

                  <!-- Budget -->
                  <div class="form-group">
                    <label for="budget">Budget</label>
                    <input type="number" class="form-control @error('budget') is-invalid @enderror" name="budget" id="budget" value="{{ $proposal->budget }}" placeholder="Enter Budget">
                    @error('budget')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
              </div>
  
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection