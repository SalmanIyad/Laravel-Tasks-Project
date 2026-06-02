@extends('layouts.app')

@section('title', 'Dashboard')
@section('header', 'Dashboard')
@section('description')
    @auth
        Welcome, <span class="font-semibold text-blue-700">{{ $email ?? Auth::user()->email }}</span>!
    @else
        View your personalized dashboard
    @endauth
@endsection

@section('content')
    <div>
        @auth
            <p class="text-gray-700 mb-6">You are successfully logged in and can now manage your resources.</p>
            <div class="flex items-center gap-4">
                <a href="/profile/edit" class="inline-block w-fit bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                    Edit Profile
                </a>
                <form action="/logout" method="POST" class="m-0">
                    @csrf
                    <button type="submit"
                        class="w-fit bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">Logout</button>
                </form>
            </div>
        @else
            <p class="text-gray-700 mb-6">It looks like you are not logged in. Please log in to continue.</p>
            <a href="/login" class="inline-block w-fit bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">Login to Dashboard</a>
        @endauth
    </div>
@endsection