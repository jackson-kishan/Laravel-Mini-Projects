@extends('layouts.app')

@section('content')
  
  <div class="row justify-content-center">
     <div class="col-md-8">
        <div class="card">
            <div class="card-header">
              <h3 class="float-start">
                Edit User
              </h3>
              <div class="float-end">
                <a href="{{ route('users.index') }}" class="btn btn-primary btn-md">&larr; Back</a>
              </div>
           </div>

           <div class="card-body">
            <form action="{{ route('users.update' , $user->id) }}" method="POST">
             @csrf
            @method('PUT')

            <div class="mb-3 row">
              <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name :</label>
              <div class="col-md-6">
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ $user->name }}">
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
              </div>
            </div>

            <div class="mb-3 row">
                <label for="email" class="col-md-4 col-form-label text-md-end text-start">Email :</label>
                <div class="col-md-6">
                  <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ $user->email }}">
                  @if ($errors->has('email'))
                      <span class="text-danger">{{ $errors->first('email') }}</span>
                  @endif
                </div>
              </div>

              <div class="mb-3 row">
                <label for="password" class="col-md-4 col-form-label text-md-end text-start">Password :</label>
                <div class="col-md-6">
                  <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
                  @if ($errors->has('password'))
                      <span class="text-danger">{{ $errors->first('password') }}</span>
                  @endif
                </div>
              </div>

              <div class="mb-3 row">
                <label for="password_confirmation" class="col-md-4 col-form-label text-md-end text-start">Confirm Password :</label>
                <div class="col-md-6">
                  <input type="password" class="form-control @error('name') is-invalid @enderror" name="password_confirmation" id="password_confirmation">
                </div>
              </div>

              <div class="mb-3 row">
                <label for="roles" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                <div class="col-md-6">
                  <select name="roles[]" id="roles" multiple aria-label="roles" class="form-select @error('roles') is-invalid @enderror">
                   @forelse ($roles as $role)
                       
                   @if ($role != 'Super Admin')
                       <option value="{{ $role }}" {{ in_array($role, $userRole ?? []) ? 'selected' : '' }}>
                       {{ $role }}
                      </option>

                    @else 
                      @if (Auth::user()->hasRole('Super Admin'))
                           <option value="{{ $role }}" {{ in_array($role, $userRole ?? []) ? 'selected' : '' }}>
                           {{ $role }}
                           </option>
                      @endif  
                   @endif

                   @empty
                       
                   @endforelse
                </select>
 
                 <div class="md-3 row">
                    <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update User">
                 </div>

                </div>
              </div>

            </form>
           </div>

        </div>
     </div>
  </div>
    
@endsection