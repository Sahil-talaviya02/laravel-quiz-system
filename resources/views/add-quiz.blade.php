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

        @if (!Session('quizDetails'))
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
                            <select name="category_id" class="form-select shadow-sm">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Add Quiz</button>
                    </form>
                </div>
            </div>
        @else
            {{-- add Mcq quiz --}}
            <h2 class="text-center mb-4 fw-bold">Quiz : {{ Session('quizDetails.name') }}</h2>

            <div class="m-4 d-flex justify-content-center align-items-center">
                <div class="card shadow p-4" style="width: 100%; max-width: 400px; border-radius: 15px;">
                    <h2 class="text-center mb-4 fw-bold">Add Mcq</h2>

                    <form action="{{ route('addMcq') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold">MCQ Question</label>

                            <textarea name="addQuestion" class="form-control shadow-sm" rows="3" placeholder="Enter MCQ Question">{{ old('addQuestion') }}</textarea>

                            {{-- Validation Error --}}
                            @error('addQuestion')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <input type="text" name="optionA" class="form-control"
                                placeholder="Enter First Option"value="{{ old('optionA') }}">
                            {{-- Validation Error --}}
                            @error('optionA')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <input type="text" name="optionB" class="form-control"
                                placeholder="Enter Second Option"value="{{ old('optionB') }}">
                            {{-- Validation Error --}}
                            @error('optionB')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <input type="text" name="optionC" class="form-control"
                                placeholder="Enter Third Option"value="{{ old('optionC') }}">
                            {{-- Validation Error --}}
                            @error('optionC')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <input type="text" name="optionD" class="form-control"
                                placeholder="Enter Four Option"value="{{ old('optionD') }}">
                            {{-- Validation Error --}}
                            @error('optionD')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <select name="correct_ans" class="form-select shadow-sm">
                                <option value="" disabled selected>Choose correct option</option>
                                <option value="a">A</option>
                                <option value="b">B</option>
                                <option value="c">C</option>
                                <option value="d">D</option>
                            </select>
                            {{-- Validation Error --}}
                            @error('correct_ans')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" name="submit" value="addMore" class="btn btn-primary flex-fill">Add
                                More</button>
                            <button type="submit" name="submit" value="done" class="btn btn-success flex-fill">Add
                                And Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif

    </main>

    {{-- Footer --}}
    @include('components.footer')

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
