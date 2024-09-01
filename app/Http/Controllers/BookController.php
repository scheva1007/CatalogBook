<?php

namespace App\Http\Controllers;

use App\Http\Request\StoreAuthorBookRequest;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function allBooks()
    {
        $book = Book::all();

        return view('book.index', compact('book'));
    }

    public function create()
    {
        $authors = Author::all();

        return view('book.create', compact('authors'));
    }

    public function store(StoreAuthorBookRequest $request)
    {
        $book = Book::create([
            'title' => $request->title,
            'short_description' => $request->short_description,
        ]);

        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store( 'news_photo', 'public');
            $book->update(['image' => $imagePath]);
        }

        $book->author()->attach($request->author);

        return redirect()->route('book.all');
    }

    public function show(Book $book)
    {
        return view('book.show', compact('book'));
    }
}
