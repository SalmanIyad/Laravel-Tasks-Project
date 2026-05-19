<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    $email = session('email');
    if (! $email) {
        $roles = ['Admin', 'User', 'Guest'];

        return view('login', compact('roles'));
    } else {
        return redirect('/dashboard');
    }

});

Route::get('/dashboard', function () {
    $email = session('email');
    if (! $email) {
        return redirect('/login');
    }

    return view('dashboard', compact('email'));
});

Route::post('/login', function () {
    $users = [
        [
            'email' => 'salman@ptcdb.com',
            'password' => '12345',
            'role' => 'Admin',
        ],
        [
            'email' => 'ali@ptcdb.com',
            'password' => '12345',
            'role' => 'User',
        ],
        [
            'email' => 'ahmed@ptcdb.com',
            'password' => '12345',
            'role' => 'Guest',
        ],
    ];

    $email = request('email');
    $password = request('password');
    $role = request('role');
    $errorText = '';

    if (! $email) {
        $errorText = 'Email is required';

        return redirect('/login')->with('error', $errorText);
    }
    if (! $password) {
        $errorText = 'Password is required';

        return redirect('/login')->with('error', $errorText);
    }

    foreach ($users as $user) {
        if ($user['email'] === $email) {
            if ($user['password'] === $password) {
                if ($user['role'] !== $role) {
                    $errorText = 'Incorrect role';

                    return redirect('/login')->with('error', $errorText);
                }
                session(['email' => $email]);

                return redirect('/dashboard');
            } else {
                $errorText = 'Incorrect password';

                return redirect('/login')->with('error', $errorText);
            }
        }
    }
    $errorText = 'Email not found';

    return redirect('/login')->with('error', $errorText);
});

Route::post('/logout', function () {
    session()->forget('email');

    return redirect('/login');
});

Route::get('/books', function () {

    $books = DB::table('books')->get();
    return view('books', compact('books'));
    
});

Route::get('/books/create', function () {
    return view('add_book');
});

Route::post('/books/store', function () {
    DB::table('books')->insert([
        'title' => request('title'),
        'author' => request('author'),
        'created_at' => now(), 
        'updated_at' => now(),
    ]);

    return redirect('/books')->with('success', 'Book added successfully!');
});

Route::get('/books/{id}/edit', function ($id) {

    $book = DB::table('books')->where('id', $id)->first();
    
    if (!$book) {
        return redirect('/books')->with('error', 'Book not found.');
    }
    
    return view('edit_book', compact('book'));

});


Route::put('/books/{id}', function ($id) {

    DB::table('books')->where('id', $id)->update([
        'title' => request('title'),
        'author' => request('author'),
        'updated_at' => now(),

    ]);

    return redirect('/books')->with('success', 'Book updated successfully!');
});


Route::delete('/books/{id}', function ($id) {

    DB::table('books')->where('id', $id)->delete();
    
    return redirect('/books')->with('success', 'Book deleted successfully!');
});