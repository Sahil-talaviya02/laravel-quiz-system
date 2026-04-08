<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Categories</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-column" style="height: 100vh; overflow: hidden;">
    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Main Content --}}
    <main class="flex-grow-1 overflow-auto p-3">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <p class="mb-0">All Current Quiz's MCQ</p>

            <a href="{{ route('addQuiz') }}" class="btn btn-info btn-sm">Back</a>
        </div>

        {{-- show category --}}
        <div class="mx-2 mt-2">
            <div class="card shadow">
                <table class="table table-hover table-striped mb-0 text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>MCQ ID</th>
                            <th>Question</th>
                            {{-- <th>Creator</th>
                            <th>Action</th> --}}
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($mcqs as $mcq)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="fw-semibold">{{ $mcq->question }}</td>
                                {{-- <td>{{ $mcq->creator }}</td>
                                <td><a href="{{ route('deleteCategory', $mcq->id) }}"
                                        class="btn btn-danger btn-sm">Delete</a></td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    {{-- Footer --}}
    @include('components.footer')

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
