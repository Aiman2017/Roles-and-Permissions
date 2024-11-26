@extends('backend.app.app')
@section('title', 'Assign role to')

@section('content')
    @if($roles->isNotEmpty())
        <div class="container mt-5">
            <!-- Form Section -->
            <section class="card shadow-sm mb-5">
                <div class="card-body">
                    <!-- Error Messages Section -->
                    @include('backend.app.errors')

                    <h2 class="text-center mb-4">Assign Roles to Users</h2>

                    <form action="{{ route('admin.assign-to.user.store') }}" method="POST">
                        @csrf
                        <div class="d-flex flex-row align-items-center justify-content-between">
                            <!-- Role Selection -->
                            <div class="col-md-5 mb-3">
                                <label for="role_id" class="form-label">Select Role</label>
                                <select class="form-select" name="role_id" id="role_id" aria-label="Select Role">
                                    <option value="" selected>Select Role</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- 'To' Separator -->
                            <div class="mt-3 d-flex align-items-center">
                                <span><b>-> to -></b></span>
                            </div>

                            <!-- User Selection -->
                            <div class="col-md-5 mb-3">
                                <label for="user_id" class="form-label">Select User</label>
                                <select class="form-select" name="user_id" id="user_id" aria-label="Select User">
                                    <option value="" selected>Select User</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">Assign Role</button>
                        </div>
                    </form>
                </div>
            </section>

            <!-- User Roles Table Section -->
            <section class="card shadow-sm">
                <div class="card-header">
                    <h4 class="text-center">User and Their Roles</h4>
                </div>
                <div class="card-body">
                    <div style="max-height: 400px; overflow: auto; border: 1px solid #ddd; padding: 5px;">
                        <table class="table table-bordered table-hover table-md">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($users->isNotEmpty())
                                @foreach($users as $key => $user)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        @if(isset($user->roles))
                                            <td>
                                                @foreach($user->roles as $role)
                                                    {{ $role->name }}
                                                    @if (!$loop->last) <span class="text-muted">,</span> @endif
                                                @endforeach
                                            </td>
                                        @else
                                            <td>No Roles Assigned</td>
                                        @endif
                                        <td>
                                            <a href="#" class="btn btn-secondary btn-sm">Details</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center">No users found</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

        </div>
    @else
        <div class="container mt-5">
            <div class="alert alert-warning text-center">
                No roles found. Please create roles first. <a href="{{route('admin.roles.create')}}">go</a>
            </div>
        </div>
    @endif

@endsection

