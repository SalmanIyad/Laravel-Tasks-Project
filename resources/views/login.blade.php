<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body  class="font-sans bg-gray-100 flex justify-center items-center min-h-screen m-0">

    <form action="/login" method="POST" class="bg-white p-6 rounded-lg shadow-lg w-80">
        @csrf

        <h1 class="mt-0 mb-5 text-2xl text-center">Login</h1>

        <input type="text" name="email" value="{{ old('email') }}" placeholder="Email" class="w-full p-3 mb-3.5 border border-gray-300 rounded-md text-base @error('email') border-red-500 bg-red-50 @enderror">
        @error('email') <p class="text-red-500 text-xs mb-2 mt-[-10px]">{{ $message }}</p> @enderror
        
        <input type="password" name="password" placeholder="Password" class="w-full p-3 mb-3.5 border border-gray-300 rounded-md text-base @error('password') border-red-500 bg-red-50 @enderror">
        @error('password') <p class="text-red-500 text-xs mb-2 mt-[-10px]">{{ $message }}</p> @enderror
        
        <select name="role" class="w-full p-3 mb-3.5 border border-gray-300 rounded-md text-base">
            @foreach ($roles as $role)
                <option value="{{ $role }}">{{ $role }}</option>
            @endforeach
        </select>

        <button type="submit" class="w-full p-3 border-none rounded-md bg-blue-500 text-white text-base cursor-pointer hover:bg-blue-600">Login</button>
        
        @if (session('error'))
            <p class="text-red-500 mt-2.5 text-sm text-center ">{{ session('error') }}</p>
        @endif 

        <div class="mt-4 text-center text-sm">
            <a href="/register" class="text-blue-500 hover:underline">Don't have an account? Register</a>
        </div>

    </form>

</body>

</html>
    
