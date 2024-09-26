<?php

namespace App\Http\Controllers;

use App\Http\Request\StoreAuthorBookRequest;
use App\Http\Request\UpdateBookRequest;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function allBooks(Request $request)
    {
        $query = Book::query();

        if ($request->has('author')) {
            $authorIds = $request->input('author');
            $query->whereHas('author', function ($q) use ($authorIds){
                $q->whereIn('author_id', $authorIds);
            })->get();
        }

        if($request->has('title') && $request->input('title') != null) {
            $search = $request->input('title');
            $query->where('title', 'LIKE', '%' . $search . '%');
        }
        $book = $query->paginate(10);
        $allAuthors = Author::whereHas('book')->get();

        return view('book.index', compact('book', 'allAuthors'));
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

    public function show(Request $request, Book $book)
    {
        $book->load('author');

        return view('book.show', compact('book', ));
    }

    public function edit(Book $book)
    {
        $authors=Author::all();
        $book->load('author');

        return response()->json([
            'book' => $book,
            'authors' => $authors,
        ]);
    }

    public function update(UpdateBookRequest $request, Book $book)
    {
        $book->update([
            'title' => $request->title,
            'short_description' => $request->short_description,
            'image' => $request->hasFile('image') ? $request->file('image')->store('news_photos', 'public') : $book->image,
        ]);

        if ($request->has('author')) {
            $book->author()->sync($request->input('author')); // Синхронизируем авторов
        }

        $updatedAuthors = $book->author()->get();

       return response()->json([
           'success' => true,
           'book' => $book,
           'authors' => $updatedAuthors,
       ]);
    }

    public function destroy(Book $book)
    {

        $book->delete();

        return response()->json(['success' => true]);
    }
}
