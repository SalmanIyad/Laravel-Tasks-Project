@extends('layouts.app')

@section('title', 'Edit Profile')
@section('header', 'Edit Profile')
@section('description', 'Update your personal details')

@section('content')
    <div class="mx-auto p-6 rounded-lg">

        <form action="/profile/update" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Full Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="Full Name"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 bg-red-50 @enderror">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
                <input type="text" name="email" value="{{ old('email', $user->email) }}" placeholder="Email"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 bg-red-50 @enderror">
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">New Password (leave blank to keep
                    current)</label>
                <input type="password" name="password" placeholder="New Password"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 bg-red-50 @enderror">
                @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password_confirmation">Confirm New
                    Password</label>
                <input type="password" name="password_confirmation" placeholder="Confirm Password"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="role">Role</label>
                <select name="role"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('role') border-red-500 bg-red-50 @enderror">
                    @foreach ($roles as $role)
                        <option value="{{ $role }}" {{ old('role', $user->role) == $role ? 'selected' : '' }}>{{ $role }}</option>
                    @endforeach
                </select>
                @error('role') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-200">
                    Save Changes
                </button>
                <a href="/dashboard"
                    class="inline-block align-baseline font-bold text-sm text-gray-500 hover:text-gray-800">
                    Cancel
                </a>
            </div>
        </form>

        <hr class="my-8">

        <div class="bg-red-50 p-4 border border-red-200 rounded-lg">
            <h3 class="text-red-800 font-bold mb-2">Danger Zone</h3>
            <p class="text-sm text-red-700 mb-4">Once you delete your account, there is no going back. Please be certain.
            </p>
            <form action="/profile/delete" method="POST"
                onsubmit="return confirm('Are you sure you want to delete your account?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-200">
                    Delete Account
                </button>
            </form>
        </div>

    </div>
@endsection