@extends('layouts.app')

@section('content')

 <div class="card">
    <h2 class="card-header">Manage Users</h2>
    <div class="card-body">
        @can('create-user')
          <a href="{{ route('users.create') }}" class="btn btn-success btn-md my2">Add New User</a>  
        @endcan
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                <th scope="col">S#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Roles</th>
                <th style="width: 300px" scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <th scope="col">{{ $loop->iteration }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @forelse ($user->getRoleNames() as $role)

                            <span class="badge bg-primary">{{ $role }}</span>
                            @empty
                            @endforelse
                        </td>
                        <td>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                            @csrf
                        @method('DELETE')
                          
                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-warning btn-sm"> Show</a>

                        @if (in_array('Super Admin', $user->getRoleNames()->toArray() ?? []))
                            @if (Auth::user()->hasRole('Super Admin'))
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            @endif
                          @else
                          @can('edit-user')
                              <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm">Edit</a>
                          @endcan  

                          @can('delete-user')
                              @if (Auth::user()->id != $user->id)
                                  <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this user? ');">Delete</button>
                              @endif
                          @endcan
                        @endif
                        </form>
                        </td>
                    </tr>
                @empty
                 <td colspan="5">
                    <span class="text-danger">
                        <strong>No User Found!</strong>
                    </span>
                 </td>
                    
                @endforelse
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
 </div>
    
@endsection