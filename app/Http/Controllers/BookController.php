<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    //

    public function index()
    {
        $books = DB::table('books')->get();
        return view('books', compact('books'));
    }

    public function create()
    {
        return view('add_book');
    }

    public function store()
    {
        DB::table('books')->insert([
            'title' => request('title'),
            'author' => request('author'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/books')->with('success', 'Book added successfully!');
    }

    public function edit($id)
    {
        $book = DB::table('books')->where('id', $id)->first();

        if (!$book) {
            return redirect('/books')->with('error', 'Book not found.');
        }

        return view('edit_book', compact('book'));
    }

    public function update($id)
    {
        DB::table('books')->where('id', $id)->update([
            'title' => request('title'),
            'author' => request('author'),
            'updated_at' => now(),

        ]);

        return redirect('/books')->with('success', 'Book updated successfully!');
    }

    public function destroy($id)
    {
        DB::table('books')->where('id', $id)->delete();
        return redirect('/books')->with('success', 'Book deleted successfully!');
    }

}
