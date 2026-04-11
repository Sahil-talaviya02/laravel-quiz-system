<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #36b9cc, #f6c23e);
        }
    </style>
</head>

<body>

    @include('components.user_navbar')

    <div class="container d-flex justify-content-center align-items-center" style="height: 90vh;">

        <div class="card shadow-lg p-4" style="width: 400px;">
            <h3 class="text-center mb-4">Reset Password</h3>

            <form method="POST" action="{{ route('userSetForgetPassword') }}">
                @csrf

                <input type="hidden" name="name" value="{{ $email }}" placeholder="Name">

                <input type="password" name="password" class="form-control mb-2" placeholder="Set new password">
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <input type="password" name="password_confirmation" class="form-control mb-3"
                    placeholder="Confirm Password">

                <button class="btn btn-success w-100">Update Password</button>

                <div class="text-center mt-3">
                    <a href="{{ route('loginPage') }}">Already have account?</a>
                </div>
            </form>
        </div>

    </div>

    @include('components.user_footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
