<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Result</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

    @include('components.user_navbar')

    <main class="flex-grow-1">

        <!-- HERO -->
        <div class="bg-primary text-white text-center py-3">
            <h1 class="fw-bold">Quit Result</h1>
        </div>

        <div class="container py-5">
            <div class="card shadow-lg">
                <table class="table table-bordered text-center align-middle mb-0">

                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Question</th>
                            <th>Your Answer</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($resultData as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-start">{{ $item->question }}</td>
                                <td>{{ $item->select_answer }}</td>
                                <td>
                                    @if ($item->is_correct)
                                        <span class="badge bg-success">Correct</span>
                                    @else
                                        <span class="badge bg-danger">Wrong</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>

        <div class="text-center mb-4">
            <h4>
                Score:
                <span class="text-success">
                    {{ $resultData->where('is_correct', 1)->count() }}
                </span> /
                {{ $resultData->count() }}
            </h4>
        </div>

    </main>

    @include('components.user_footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Push current page into history
        history.pushState(null, null, location.href);
        window.onpopstate = function() {
            // Redirect to dashboard/home
            window.location.href = "{{ route('home') }}";
        };
    </script>
</body>

</html>
