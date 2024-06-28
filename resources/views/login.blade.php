<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white flex justify-center items-center h-screen">
    <div class="w-full max-w-md bg-gray-800 rounded-lg p-8">
        <h1 class="text-4xl font-semibold mb-4 text-center">Login</h1>

        @if(session('failed'))
            <div class="bg-red-500 text-white p-4 mb-4 rounded-lg text-center">
                {{ session('failed') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label for="username" class="block text-sm font-medium mb-2">Username:</label>
                <input type="text" class="w-full px-3 py-2 bg-gray-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="username" name="username">
            </div>
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium mb-2">Password:</label>
                <input type="password" class="w-full px-3 py-2 bg-gray-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="password" name="password">
            </div>
            <button type="submit" class="w-full py-2 px-4 bg-cyan-700 hover:bg-cyan-800 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">Login</button>
        </form>
        <p class="text-center text-white mt-4">Belum punya akun? <a href="{{ route('register') }}" class="text-cyan-500">Register</a></p>
    </div>
</body>
</html>
