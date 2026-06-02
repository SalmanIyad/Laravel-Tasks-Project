@extends('layouts.app')

@section('description', 'Manage your book collection and resources')
@section('content')

<div class="container mx-auto px-4 py-8">
    <div class="mb-8  flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-800">Book Collection</h1>
        @if(Auth::check() && Auth::user()->role === 'Admin')
            <a href="/admin/books/create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer">
                + Add New Book
            </a>
        @endif
    </div>

    <div class="overflow-x-auto shadow rounded-lg">
        <table class="w-full bg-white">
            <thead class="bg-gray-200 border-b">
                <tr>

                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Title </th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Author </th>
                    @if(Auth::check() && Auth::user()->role === 'Admin')
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Actions</th>
                    @endif
             
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-900"> {{ $book->title }} </td>
                        <td class="px-6 py-4 text-sm text-gray-900"> {{ $book->author }} </td>
                        @if(Auth::check() && Auth::user()->role === 'Admin')
                            <td class="px-6 py-4 text-sm space-x-2">
                                <a href="/admin/books/{{ $book->id }}/edit" class="text-yellow-500 hover:text-yellow-700 font-semibold cursor-pointer">Edit</a>
                                <form action="/admin/books/{{ $book->id }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 font-semibold" onclick="return confirm('Are you sure you want to delete this book?')">Delete</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr> <td colspan="{{ Auth::check() && Auth::user()->role === 'Admin' ? '3' : '2' }}" class="px-6 py-4 text-center text-gray-500">No books found. Add some!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection