<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('admin.roles.index')}}">Управление Ролями</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Переключить навигацию">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('admin.roles.index')}}">Главная</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.roles.index')}}">role</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.assign-to.user')}}"> Assign to</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
