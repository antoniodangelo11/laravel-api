@php 
    $user = Auth::user();
@endphp

<nav>
    <div class="container d-flex justify-content-between">
        <div class="navigation">
            <ul class="d-flex list-unstyled py-3 gap-2">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Projects
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="{{ route('admin.project.index') }}">List</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.project.create') }}">Add</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('admin.project.trashed') }}">Trash</a></li>
                    </ul>
                </li>
    
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Types
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="{{ route('admin.type.index') }}">List</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.type.create') }}">Add</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Technologies
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="{{ route('admin.technology.index') }}">List</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.technology.create') }}">Add</a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="profile">
            <ul class="d-flex list-unstyled py-3 gap-2">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ $user->name }}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('admin.profile.edit') }}">Edit profile</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button>Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>