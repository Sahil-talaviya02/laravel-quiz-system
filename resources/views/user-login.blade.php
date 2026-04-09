<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #4e73df, #1cc88a);
        }

        .card {
            border-radius: 15px;
        }
    </style>
</head>

<body>

    @include('components.user_navbar')

    <div class="container d-flex justify-content-center align-items-center" style="height: 90vh;">

        <div class="card shadow-lg p-4" style="width: 400px;">
            <h3 class="text-center mb-4">🔐 Login</h3>

            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('userLogin') }}">
                @csrf

                <input type="email" name="email" class="form-control mb-3" placeholder="Email">

                <input type="password" name="password" class="form-control mb-3" placeholder="Password">

                <button class="btn btn-primary w-100">Login</button>

                <div class="text-center mt-3">
                    <small>Don't have account?</small><br>
                    <a href="{{ route('signupPage') }}" class="btn btn-outline-primary btn-sm mt-2">
                        Register
                    </a>
                </div>
            </form>
        </div>

    </div>

    @include('components.user_footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
