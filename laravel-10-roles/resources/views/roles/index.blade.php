@extends('layouts.app')

@section('content')
    
   <div class="card">
    <h2 class="card-header text-center">Manage Role</h2>
    <div class="card-body">
        @can('create-role')
            <a href="{{ route('roles.create') }}" class="btn btn-success btn-md my-2"><i class="bi bi-plus-circle"></i> Add New Role</a>
        @endcan
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">S#</th>
                    <th scope="col">Name</th>
                    <th scope="col" style="width: 350px;"> Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($roles as $role)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <th>{{ $role->name }}</th>
                        <th>
                            <form action="{{ route('roles.create', $role->id) }}" method="POST">
                            
                                @csrf

                                @method('DELETE')

                                <a href="{{ route('roles.show' , $role->id) }}" class="btn btn-warning btn-md">  Show </a>

                                @if ($role->name != 'Super Admin')
                                    @can('edit-role')
                                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-md"> Edit </a>
                                    @endcan

                                    @can('delete-role')
                                        @if ($role->name != Auth::user()->hasRole($role->name))
                                            <button type="submit" class="btn btn-danger btn-md" onclick="return confirm('Do you want to delete this role?'):"> Delete </button>
                                        @endif
                                    @endcan
                                @endif
                            </form>
                        </th>
                    </tr>
                     @empty
                      <td colspan="3">
                          <span class="text-danger">
                            <strong>No Role Found!</strong>
                          </span>
                      </td>
                         
                @endforelse
            </tbody>
        </table>

        {{ $roles->links() }}

    </div>
   </div>
    
@endsection