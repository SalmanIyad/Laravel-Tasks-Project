<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Book;


class BookController extends Controller
{
    public function index()
    {
        // $books = DB::table('books')->get();

        $books = Book::all();

        return view('books', compact('books'));
    }

    public function create()
    {
        if (!Auth::check() || Auth::user()->role !== 'Admin') {
            return redirect('/books')->with('error', 'Unauthorized access. Only Admins can add books.');
        }

        return view('add_book');
    }

    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'Admin') {
            return redirect('/books')->with('error', 'Unauthorized access.');
        }

        // DB::table('books')->insert([
        //     'title' => request('title'),
        //     'author' => request('author'),
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        $new_book = new Book();

        // $new_book->name = $_POST['name']; // OLD WAY --> not recommended to use $_POST in laravel

        // ALTERNATIVE 1 --> Using request() helper method
        
          $validated = $request->validate([
            'title' => 'required|max:50|min:2',
            'author' => 'required|max:50|min:2',
          ]);
          
          $new_book->title = $request->title;    //  request() is the new way instead of $_POST['title']
          $new_book->author = $request->author;  //  it check if the input "is empty" or not and the request has a method to check if the input is required or not
          
          $new_book->save(); 
  
          // the request() prevents this error, used for <server side validation>:
            // Illuminate\Database\QueryException
            // vendor\laravel\framework\src\Illuminate\Database\Connection.php:841
            // SQLSTATE[23000]: Integrity constraint violation: 1048 Column 'title' cannot be null (Connection: mysql, Host: 127.0.0.1, Port: 3306, Database: tasks_project, SQL: insert into `books` (`title`, `author`, `updated_at`, `created_at`) values (?, ?, 2026-06-02 12:45:48, 2026-06-02 12:45:48))
          
          
        // ALTERNATIVE 2 --> Using create() method (mass assignment)
          // $book = Book::create(request()->all()); // create() method is a mass assignment method --> creates a new model instance and saves it to the database at the same time 


        return redirect('/books')->with('success', 'Book added successfully!');
    }

    public function edit($id)
    {
        if (!Auth::check() || Auth::user()->role !== 'Admin') {
            return redirect('/books')->with('error', 'Unauthorized access. Only Admins can edit books.');
        }

        // $book = DB::table('books')->where('id', $id)->first();
        $book = Book::find($id);
        

        if (!$book) {
            return redirect('/books')->with('error', 'Book not found.');
        }

        return view('edit_book', compact('book'));
    }

    public function update($id, Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'Admin') {
            return redirect('/books')->with('error', 'Unauthorized access.');
        }

        // DB::table('books')->where('id', $id)->update([
        //     'title' => request('title'),
        //     'author' => request('author'),
        //     'updated_at' => now(),

        // ]);

        $updated_book = Book::find($id);
    
        $validated = $request->validate([
        'title' => 'required|max:50|min:2',
        'author' => 'required|max:50|min:2',
        ]);
        
        $updated_book->title = $request->title;   
        $updated_book->author = $request->author;  
        
        $updated_book->save();

        // $book = Book::update(request()->all()); // using mass assignment

        return redirect('/books')->with('success', 'Book updated successfully!');
    }

    public function destroy($id)
    {
        if (!Auth::check() || Auth::user()->role !== 'Admin') {
            return redirect('/books')->with('error', 'Unauthorized access.');
        }

        // DB::table('books')->where('id', $id)->delete();

        $book = Book::find($id);
        $book->delete();

        return redirect('/books')->with('success', 'Book deleted successfully!');
    }

}
