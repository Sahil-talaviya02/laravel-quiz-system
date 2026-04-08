<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">

        <div class="card shadow p-4" style="width: 100%; max-width: 400px; border-radius: 15px;">

            <h2 class="text-center mb-4 fw-bold">Admin Login</h2>

            <form action="{{ route('adminLogin') }}" method="POST">
                @csrf

                @error('user')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror

                <div class="mb-3">
                    <label class="form-label fw-semibold">Admin Name</label>
                    <input type="text" name="name" placeholder="Enter Admin Name" class="form-control">

                    @error('name')
                        <p class="text-danger small mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Admin Password</label>
                    <input type="password" name="password" placeholder="Enter Admin Password" class="form-control">

                    @error('password')
                        <p class="text-danger small mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100 fw-semibold">
                    Login
                </button>
            </form>

        </div>
    </div>

</body>

</html>
