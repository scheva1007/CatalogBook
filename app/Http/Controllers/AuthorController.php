<?php

namespace App\Http\Controllers;

use App\Http\Request\IndexAuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $author = Author::all();

        return view('author.index', compact('author'));
    }
}
