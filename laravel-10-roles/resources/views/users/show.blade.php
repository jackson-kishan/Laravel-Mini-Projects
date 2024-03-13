@extends('layouts.app')

@section('content')

  <div class="row justify-content-center">
     <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="float-start">
                    User Information
                </h3>
                <div class="float-end">
                    <a href="{{ route('users.index') }}" class="btn btn-primary btn-md">&larr; Back</a>
                </div>
            </div>

            <div class="card-body">

                <div class="mb-2 row">
                    <label for="name" class="col-md-4 col-form-lable text-md-end text-start"><strong>Name :</strong></label>
                    <div class="col-md-6" style="line-height: 35px">
                    {{ $user->name }}
                    </div>
                </div>

                <div class="mb-2 row">
                    <label for="email" class="col-md-4 col-form-lable text-md-end text-start"><strong>Email Address :</strong></label>
                    <div class="col-md-6" style="line-height: 35px">
                    {{ $user->email }}
                    </div>
                </div>

                <div class="mb-2 row">
                    <label for="roles" class="col-md-4 col-form-lable text-md-end text-start"><strong>Roles :</strong></label>
                    <div class="col-md-6" style="line-height: 35px">
                    @forelse ($user->getRoleNames() as $role)
                      <span class="badge bg primary">{{ $role }}</span>                        
                    @empty
                        
                    @endforelse
                    </div>
                </div>

            </div>
        </div>
     </div>
  </div>
    
@endsection