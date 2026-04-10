<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start Quiz</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

    @include('components.user_navbar')

    <main class="flex-grow-1 d-flex justify-content-center align-items-center">

        <div class="container">
            <div class="row justify-content-center">

                <div class="col-md-6">

                    <div class="card shadow text-center p-4">

                        <!-- Quiz Name -->
                        <h3 class="fw-bold mb-3">
                            🧠 {{ $quizName }}
                        </h3>

                        <!-- Info -->
                        <p class="text-muted mb-4">
                            This quiz contains <strong>{{ $quizCount }}</strong> questions.<br>
                            You can attempt it anytime.
                        </p>

                        <!-- Button -->
                        @if (session('user'))
                            <a href="{{ route('mcq', [Session('firstMcq')->id, $quizName]) }}"
                                class="btn btn-success w-100 fw-semibold">
                                Start Quiz </a>
                        @else
                            <a class="btn btn-primary w-100 fw-semibold" href="{{ route('loginPage') }}">Login /Register
                                to Start</a>
                        @endif

                    </div>

                </div>

            </div>
        </div>

    </main>

    @include('components.user_footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
