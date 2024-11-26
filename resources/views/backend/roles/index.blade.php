@extends('backend.app.app')

@section('title', 'Управление Ролями')

@section('content')
    <h2 class="mb-4">Управление Ролями</h2>

    <!-- Кнопка для добавления новой роли -->
    @can('roles.create')
        <a class="btn btn-primary mb-3" href="{{route('admin.roles.create')}}">
            Добавить Роль
        </a>
    @endcan

    <!-- Таблица ролей -->
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Название Роли</th>
            <th>Описание</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody id="rolesTableBody">
        @foreach($roles as $role)
            <tr>
                <td>{{$role->name}}</td>
                <td>{{$role->description ?? "No description yet.."}}</td>
                @can('roles.view')
                    <td>
                        <div class="d-flex">
                            <a class="btn btn-warning btn-sm me-1"
                               href="{{route('admin.roles.edit', $role->id)}}">Изменить</a>
                            <form action="{{route('admin.roles.destroy', $role->id)}}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete role: {{ $role->name }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                            </form>
                        </div>
                    </td>
                @endcan
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
