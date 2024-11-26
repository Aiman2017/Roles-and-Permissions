@extends('backend.app.app')
@section('title', 'Assign role to')

@section('content')
    <div class="container mt-5">
        <h2>Create Permission</h2>

        <div class="card mt-3">
            <div class="card-body">
                @include('backend.app.errors')
                <form action="{{route('admin.permissions.store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="name" class="form-control">
                    </div>

                    <div class="mb-3">
                        @foreach($roles as $role)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="role_id[]" id="role_{{ $role->id }}" value="{{ $role->id }}">
                                <label class="form-check-label" for="role_{{ $role->id }}">
                                    {{ $role->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <button type="submit" class="btn btn-primary">Create Permission</button>
                </form>
            </div>
        </div>
    </div>
@endsection

