<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm py-3 px-3">
    <!-- Brand -->
    <a class="navbar-brand fw-bold" href="#">Welcome, {{ $name }}</a>

    <!-- Toggle Button -->
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar Links -->
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
        <div class="navbar-nav gap-1">
            <a class="nav-link active fw-semibold" aria-current="page" href="/dashboard">Home</a>
            <a class="nav-link fw-semibold" href="{{ route('adminCategory') }}">Cateqories</a>
            <a class="nav-link fw-semibold" href="{{ route('addQuiz') }}">Quiz</a>
            <a class="nav-link fw-semibold" href="{{ route('adminLogout') }}">Logout</a>
        </div>
    </div>
</nav>
