<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Quiz</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-column" style="height: 100vh; overflow: hidden;">
    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Main Content --}}
    <main class="flex-grow-1 overflow-auto p-3">

        {{-- add quiz --}}
        <div class="m-4 d-flex justify-content-center align-items-center">
            <div class="card shadow p-4" style="width: 100%; max-width: 400px; border-radius: 15px;">
                <h2 class="text-center mb-4 fw-bold">Add Categories</h2>

                <form action="{{ route('addQuiz') }}" method="get">
                    @csrf

                    <div class="mb-3">
                        <input type="text" name="quiz" class="form-control"
                            placeholder="Enter Quiz Name"value="{{ old('quiz') }}">
                        {{-- Validation Error --}}
                        @error('quiz')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <select name="category_id" class="form-control">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Add Quiz</button>
                </form>
            </div>
        </div>

    </main>

    {{-- Footer --}}
    @include('components.footer')

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
