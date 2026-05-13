<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tasks Project')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50">

    <!-- Nav -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-blue-600">Tasks Project</h1>
                </div>
                <ul class="flex space-x-6">
                    <li><a href="/dashboard" class="text-gray-700 hover:text-blue-600 transition">Dashboard</a></li>
                    <li><a href="/books" class="text-gray-700 hover:text-blue-600 transition">Books</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-900">@yield('header', 'Welcome')</h2>
            <p class="text-gray-600 mt-2">@yield('description', 'Manage your tasks and resources')</p>
        </div>

        <!-- Flash Messages -->
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                <h3 class="text-red-800 font-semibold mb-2">Errors</h3>
                <ul class="text-red-700 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                <p class="text-green-700">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Content Section -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Sidebar -->
            <aside class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Sections</h3>
                    <ul class="space-y-2">
                        <li><a href="/books"
                                class="block px-4 py-2 text-gray-700 hover:bg-blue-50 rounded transition">Books</a></li>
                    </ul>
                </div>
            </aside>

            <!-- Main Content Area -->
            <main class="lg:col-span-3">
                <div class="bg-white rounded-lg shadow-md p-6">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-3 gap-8 mb-8">
                <div>
                    <h4 class="text-white font-semibold mb-4">About</h4>
                    <p class="text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa, quia.</p>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Quick Links</h4>
                    <ul class="text-sm space-y-2">
                        <li><a href="/" class="hover:text-white transition">Home</a></li>
                        <li><a href="/login" class="hover:text-white transition">Login</a></li>
                        <li><a href="#" class="hover:text-white transition">Register</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Contact</h4>
                    <p class="text-sm">salman.iyad@ieee.org</p>
                </div>
            </div>
            <div class="border-t border-gray-700 pt-8 text-center text-sm">
                <p>&copy; 2026 Tasks Project. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>

</html>