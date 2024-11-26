@extends('backend.app.app')

@section('title', 'Edit roles')

@section('content')
    <div class="container mt-5">
        <h2>Создать новую роль</h2>

        <div class="card mt-3">
            <div class="card-body">
                <form action="{{route('admin.roles.update', $role->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="roleName" class="form-label">Название роли</label>
                        <input type="text" class="form-control" id="roleName" name="name" value="{{$role->name}}" placeholder="Введите название роли" >
                    </div>
                    <div class="mb-3">
                        <label for="roleDescription" class="form-label">Описание роли</label>
                        <textarea class="form-control" id="roleDescription" name="description" rows="4" placeholder="Введите описание роли" >{{$role->description}}</textarea>
                    </div>
{{--                    <div class="mb-3">--}}
{{--                        <label for="permissions" class="form-label">Права доступа</label>--}}
{{--                        <select multiple class="form-select" id="permissions" name="permissions[]">--}}
{{--                            <option value="view">Просмотр</option>--}}
{{--                            <option value="edit">Редактирование</option>--}}
{{--                            <option value="delete">Удаление</option>--}}
{{--                            <option value="create">Создание</option>--}}
{{--                        </select>--}}
{{--                        <small class="form-text text-muted">Выберите права доступа для этой роли.</small>--}}
{{--                    </div>--}}
                    <button type="submit" class="btn btn-primary">Обновить роль</button>
                </form>
            </div>
        </div>
    </div>
@endsection

