<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white flex justify-center items-center h-screen">
    <div class="w-full max-w-md bg-gray-800 rounded-lg p-8">
        <h1 class="text-4xl font-semibold mb-4 text-center">Register</h1>

        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 mb-4 rounded-lg text-center">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium mb-2">Nama Lengkap:</label>
                <input type="text" class="w-full px-3 py-2 bg-gray-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="name" name="name">
            </div>
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium mb-2">Email:</label>
                <input type="email" class="w-full px-3 py-2 bg-gray-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="email" name="email">
            </div>
            <div class="mb-6">
                <label for="username" class="block text-sm font-medium mb-2">Username:</label>
                <input type="text" class="w-full px-3 py-2 bg-gray-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="username" name="username">
            </div>
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium mb-2">Password:</label>
                <input type="password" class="w-full px-3 py-2 bg-gray-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="password" name="password">
            </div>
            <div class="mb-6">
                <label for="confirmed" class="block text-sm font-medium mb-2">Confirm Password:</label>
                <input type="password" class="w-full px-3 py-2 bg-gray-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="password_confirmation" name="password_confirmation">
            </div>
            <button type="submit" class="w-full py-2 px-4 bg-cyan-700 hover:bg-cyan-800 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">Register</button>
        </form>
        <p class="text-center text-white mt-4">Sudah punya akun? <a href="{{ route('login') }}" class="text-cyan-500">Login</a></p>
    </div>
</body>
</html>
