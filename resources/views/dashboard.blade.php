<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-100 min-h-screen m-2">

    <div>
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard</h1>

        <h3 class="text-lg text-gray-700 mb-8">Welcome, <span class="font-semibold underline text-blue-700">{{ $email }}</span>!</h3>

        <form action="/logout" method="POST">
            @csrf
            <button type="submit"
                class="w-fit bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">Logout</button>
        </form>
    </div>

</body>

</html>