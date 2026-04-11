<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attempted Quiz</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

    @include('components.user_navbar')

    <main class="flex-grow-1">

        <!-- HERO -->
        <div class="bg-primary text-white text-center py-3">
            <h1 class="fw-bold">Attempted Quiz</h1>
        </div>

        <div class="container py-5">
            <div class="card shadow-lg">
                <table class="table table-bordered text-center align-middle mb-0">

                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($quizRecord as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-start">{{ $item->name }}</td>
                                <td>
                                    @if ($item->status == 2)
                                        <span class="badge bg-success">Completed</span>
                                    @else
                                        <span class="badge bg-danger">Not Completed</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>

    </main>

    @include('components.user_footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
