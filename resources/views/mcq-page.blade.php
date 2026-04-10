<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCQ Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

    @include('components.user_navbar')

    <main class="flex-grow-1 d-flex align-items-center">
        <div class="container">

            <!-- Title -->
            <div class="text-center mb-4">
                <h3 class="fw-bold">{{ $quizName }}</h3>
                <p class="text-muted">
                    Question {{ Session('currentQuiz.currentMcq') }} of
                    {{ Session('currentQuiz.totalMcq') }}
                </p>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-6">

                    <div class="card shadow">

                        <div class="card-body">
                            <h5 class="mb-4">Q. {{ $mcqData->question }}</h5>

                            <form action="{{ route('submitNext', [$mcqData->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $mcqData->id }}">

                                <div class="list-group">
                                    @foreach (['a', 'b', 'c', 'd'] as $opt)
                                        <label class="list-group-item">
                                            <input type="radio" name="answer" value="{{ $opt }}"
                                                class="form-check-input me-2" {{ $selected == $opt ? 'checked' : '' }}>
                                            {{ $mcqData->$opt }}
                                        </label>
                                    @endforeach
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" value="next" class="btn btn-primary">
                                        Next →
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    @include('components.user_footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let submitted = false;

        document.addEventListener("visibilitychange", function() {
            if (document.hidden && !submitted) {
                submitted = true;

                fetch("{{ route('tabChange') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        record_id: "{{ Session('currentQuiz.recordId') }}"
                    })
                }).then(() => {
                    window.location.href = "{{ route('forceResult') }}";
                });
            }
        });

        let tabTimer = null;
        history.pushState(null, null, location.href);
        window.onpopstate = function() {
            if (!submitted) {
                submitted = true;

                alert("⚠️ You cannot go back! Quiz will be submitted.");

                fetch("{{ route('tabChange') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        record_id: "{{ Session('currentQuiz.recordId') }}"
                    })
                }).then(() => {
                    window.location.href = "{{ route('forceResult') }}";
                });
            }
        };
    </script>
</body>

</html>
