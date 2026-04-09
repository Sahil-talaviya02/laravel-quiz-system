<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body class="bg-light d-flex flex-column" style="height: 100vh; overflow: hidden;">

    @include('components.user_navbar')

    <main class="flex-grow-1 overflow-auto p-3">

        <div>
            <h1 class="text-center mb-4 fw-bold">Check your skills</h1>
            <div>
                <div class="mb-3">
                    <input type="text" name="search" id="search" placeholder="Search Quiz..."
                        class="form-control">
                </div>
            </div>
        </div>
    </main>

    @include('components.user_footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
