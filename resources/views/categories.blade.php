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

    {{-- Toast Message --}}
    @if (session('categories'))
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999; margin-top: 70px;">
            <div class="toast align-items-center text-bg-success border-0" role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('categories') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast"></button>
                </div>
            </div>
        </div>
    @endif

    {{-- Main Content --}}
    <main class="flex-grow-1 overflow-auto p-3">

        {{-- add category --}}
        <div class="m-4 d-flex justify-content-center align-items-center">
            <div class="card shadow p-4" style="width: 100%; max-width: 400px; border-radius: 15px;">
                <h2 class="text-center mb-4 fw-bold">Add Categories</h2>

                <form action="{{ route('addCategories') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <input type="text" name="category" class="form-control"
                            placeholder="Enter Category Name"value="{{ old('category') }}">
                        {{-- Validation Error --}}
                        @error('category')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Add Categories</button>
                </form>
            </div>
        </div>

        {{-- show category --}}
        <div class="mx-2 mt-2">
            <div class="card shadow">
                <table class="table table-hover table-striped mb-0 text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Category Name</th>
                            <th>Creator</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="fw-semibold">{{ $category->name }}</td>
                                <td>{{ $category->creator }}</td>
                                <td>
                                    <a href="{{ route('quizList', [$category->id,$category->name]) }}"
                                        class="btn btn-info btn-sm">View</a>

                                    <a href="{{ route('deleteCategory', $category->id) }}"
                                        class="btn btn-danger btn-sm">Delete</a>
                                </td>
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

    {{-- Auto Show Toast --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toastEl = document.querySelector('.toast');
            if (toastEl) {
                const toast = new bootstrap.Toast(toastEl, {
                    delay: 3000
                });
                toast.show();
            }
        });
    </script>

</body>

</html>
