<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #4e73df, #1cc88a);
            /* max-height: 100vh; */
        }

        .card {
            border-radius: 15px;
        }
    </style>
</head>

<body class="bg-light d-flex flex-column min-vh-100">

    @include('components.user_navbar')

    <div class="container flex-grow-1 d-flex justify-content-center align-items-center">

        <div class="container d-flex justify-content-center align-items-center">
            <div class="card p-4 shadow" style="width: 400px;">
                <h4 class="text-center mb-3">Forgot Password</h4>

                {{-- @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif --}}

                <form method="POST" action="{{ route('userforgetPassword') }}">
                    @csrf

                    <input type="email" name="email" class="form-control mb-3" placeholder="Enter your email">

                    <button class="btn btn-primary w-100">Send Reset Link</button>
                </form>
            </div>
        </div>

    </div>

    @include('components.user_footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
