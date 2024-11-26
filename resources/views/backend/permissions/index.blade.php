@extends('backend.app.app')

@section('title', 'Управление Ролями')

@section('content')
    <h2 class="mb-4">Управление Ролями</h2>

    <!-- Кнопка для добавления новой роли -->
    <a class="btn btn-primary mb-3" href="{{route('admin.permissions.create')}}">
        Добавить permission
    </a>

    <!-- Таблица ролей -->
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Название Permission</th>
            <th>Название Роли</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody id="rolesTableBody">
        @if($permissions->isNotEmpty())
            @foreach($permissions as $permission)
                <tr>
                    <td>{{$permission->name}}</td>
                    <td>
                        {{ implode(', ', $permission->roles->pluck('name')->toArray()) }}
                    </td>

                    <td>
                        <div class="d-flex">
                            <a class="btn btn-warning btn-sm me-1"
                               href="{{route('admin.roles.edit', $permission->id)}}">Изменить</a>
                            <form action="{{route('admin.permissions.destroy', $permission->id)}}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete role: {{ $permission->name }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                            </form>
                        </div>
                    </td>


                </tr>

                <tr>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="2" class="text-center"><em>No Permissions...</em></td>
            </tr>
        @endif
        </tbody>
    </table>

@endsection
