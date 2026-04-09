<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Search</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

    @include('components.user_navbar')

    <main class="flex-grow-1">

        <!-- HERO -->
        <div class="bg-primary text-white text-center py-5">
            <div class="container">
                <h1 class="fw-bold">🚀 Test Your Skills</h1>
                <p class="mb-4">Search and start your quiz</p>

                <!-- Search -->
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" id="search" class="form-control form-control-lg"
                                placeholder="Search category...">
                            <button class="btn btn-light">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- CATEGORY CARDS -->
        <div class="container py-5">
            <div class="row g-4">

                @foreach ($categories as $category)
                    <div class="col-12 col-sm-6 col-lg-4 category-item">

                        <div class="card h-100 shadow-sm text-center">

                            <div class="card-body d-flex flex-column">

                                <div class="mb-3">
                                    <i class="bi bi-journal-text fs-1 text-primary"></i>
                                </div>

                                <h5 class="card-title fw-bold">
                                    {{ $category->name }}
                                </h5>

                                <p class="text-muted">
                                    {{ $category->quizzes_count }} Quiz Available
                                </p>

                                <div class="mt-auto">
                                    <a href="{{ route('userQuizList', [$category->id, $category->name]) }}"
                                        class="btn btn-primary btn-sm w-100">
                                        Start Quiz
                                    </a>
                                </div>

                            </div>

                        </div>

                    </div>
                @endforeach

            </div>
        </div>

    </main>

    @include('components.user_footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SEARCH FILTER -->
    {{-- <script>
        document.getElementById('search').addEventListener('keyup', function() {
            let value = this.value.toLowerCase();
            let items = document.querySelectorAll('.category-item');

            items.forEach(item => {
                let text = item.innerText.toLowerCase();
                item.style.display = text.includes(value) ? '' : 'none';
            });
        });
    </script> --}}

</body>

</html>
