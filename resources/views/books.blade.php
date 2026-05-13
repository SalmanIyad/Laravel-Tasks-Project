@extends('layouts.app')

@section('description', 'Manage your book collection and resources')
@section('content')

<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Book Management</h1>
        <a href="/books/create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer">
            + Add New Book
        </a>
    </div>
</div>
@endsection