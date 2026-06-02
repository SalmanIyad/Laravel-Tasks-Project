<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'author']; 
    
    //  This is for the mass assignment
    // mass assignment is a feature of Laravel that allows to create or update a model instance with an array of attributes at once
    // for example, if i have an array of attributes like this:
    // $attributes = ['title' => 'The Great Gatsby', 'author' => 'F. Scott Fitzgerald'];
    // I can create a model instance with this array like this:
    // $book = Book::create($attributes);

    // why we use it ?
    // instead of doing this:   
    // $book = new Book();
    // $book->title = request('title');
    // $book->author = request('author');
    // $book->save();
    // we can do this:
    // $book = Book::create(request()->all());

}
