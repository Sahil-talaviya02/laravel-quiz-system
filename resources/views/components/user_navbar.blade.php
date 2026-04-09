<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm py-3 px-3">
    <!-- Brand -->
    @if (session('user'))
        <a class="navbar-brand fw-bold" href="#">Welcome, {{ session('user.name') }} </a>
    @else
        <a class="navbar-brand fw-bold" href="#">Quiz System</a>
    @endif

    <!-- Toggle Button -->
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar Links -->
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
        <div class="navbar-nav gap-1">
            <a class="nav-link active fw-semibold" aria-current="page" href="/">Home</a>
            <a class="nav-link fw-semibold" href="">Cateqories</a>
            <a class="nav-link fw-semibold" href="">Blog</a>
            @if (session('user'))
                <a class="nav-link fw-semibold" href="{{ route('userLogout') }}">Logout</a>
            @else
                <a class="nav-link fw-semibold" href="{{ route('loginPage') }}">Login</a>
            @endif
        </div>
    </div>
</nav>
