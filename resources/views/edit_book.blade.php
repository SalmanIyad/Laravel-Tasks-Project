@extends('layouts.app')

@section('content')

@section('description', 'Edit book details')

<div class="container mx-auto px-4 py-8">
    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">

        <h2 class="text-2xl font-bold mb-6 text-gray-800"> Edit Book</h2>

        <form action="/books/{{ $book->id }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="title"> Book Title </label>
                <input  type="text" name="title" id="title"  value="{{ $book->title }}"  class="shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required >
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="author">Author </label>
                <input type="text" name="author" id="author" value="{{ $book->author }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500  hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                     Update Book
                </button>

                <a href="/books"  class="inline-block align-baseline font-bold text-sm text-gray-500 hover:text-gray-800">
                    Cancel 
                </a>
            </div>
        </form>

    </div>

</div>
@endsection
