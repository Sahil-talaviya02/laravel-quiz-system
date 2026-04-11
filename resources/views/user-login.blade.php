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

<body class="bg-light d-flex flex-column min-vh-100">

    @include('components.user_navbar')

    {{-- Toast Message --}}
    @if (session('success'))
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999; margin-top: 70px;">
            <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast"></button>
                </div>
            </div>
        </div>
    @endif

    <div class="container flex-grow-1 d-flex justify-content-center align-items-center">

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

                <div class="text-center mx-3 mt-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <small>Don't have account?</small>
                        <a href="{{ route('userforgetPassword') }}" class="small text-decoration-none">
                            Forgot Password?
                        </a>
                    </div>
                    <a href="{{ route('signupPage') }}" class="btn btn-outline-primary btn-sm mt-2">
                        Register
                    </a>
                </div>
            </form>
        </div>

    </div>

    @include('components.user_footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let toastEl = document.getElementById('successToast');
            if (toastEl) {
                let toast = new bootstrap.Toast(toastEl);
                toast.show();
            }
        });
    </script>
</body>

</html>
