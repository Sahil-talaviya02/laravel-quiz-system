<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

    @include('components.user_navbar')

    <main class="flex-grow-1">

        <div class="container py-4">

            <!-- Header -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
                <h4 class="fw-bold mb-2 mb-md-0">
                    📚 Category: {{ $category }}
                </h4>
            </div>

            <!-- Quiz Cards -->
            <div class="row g-4">

                @foreach ($quizData as $item)
                    <div class="col-12 col-sm-6 col-lg-4">

                        <div class="card h-100 shadow-sm">

                            <div class="card-body d-flex flex-column text-center">

                                <h5 class="card-title fw-bold">
                                    {{ $item->name }}
                                </h5>

                                <p class="text-muted mb-3">
                                    📝 {{ $item->mcq_count }} Questions
                                </p>

                                <div class="mt-auto">
                                    <a href="{{ route('startQuiz', [$item->id, $item->name]) }}"
                                        class="btn btn-success w-100">
                                        Start Quiz
                                    </a>
                                </div>

                            </div>

                        </div>

                    </div>
                @endforeach
            </div>

            <!-- Empty State -->
            @if ($quizData->isEmpty())
                <div class="text-center mt-5">
                    <h5 class="text-muted">No quizzes available</h5>
                </div>
            @endif

        </div>

    </main>

    @include('components.user_footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
