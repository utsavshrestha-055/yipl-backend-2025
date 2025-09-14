<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthorController extends Controller
{
    public function index(Request $request)
    {
        $query = Author::withCount('books');

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        $order = strtolower($request->input('order', 'desc')) === 'asc' ? 'asc' : 'desc';
        if ($request->input('sort') === 'books') {
            $query->orderBy('books_count', $order);
        } else {
            $query->orderBy('created_at', $order);
        }

        if ($request->filled('per_page')) {
            $perPage = min(max((int)$request->input('per_page', 10), 1), 100);
            $results = $query->with('books')->paginate($perPage);
            return response()->json($results);
        }

        $authors = $query->with('books')->get();
        return response()->json($authors);
    }


    public function show($id)
    {
        $author = Author::with('books')->find($id);
        if (!$author) return response()->json(['error' => 'Author not found'], 404);
        return response()->json($author);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|min:2',
                'email' => 'required|email|unique:authors,email',
            ], [
                'name.required' => 'Author name is required.',
                'name.min' => 'Author name must be at least 2 characters.',
                'email.required' => 'Email is required.',
                'email.email' => 'Email must be a valid email address.',
                'email.unique' => 'An author with this email already exists.',
            ]);
        } catch (ValidationException $e) {
            if ($request->expectsJson()) {
                return response()->json(['errors' => $e->errors()], 400);
            }
            throw $e;
        }

        $author = Author::create($validated);

        if ($request->expectsJson()) {
            return response()->json($author, 201);
        }

        return redirect()->back()->with('success', 'Author created successfully.');
    }

    public function listUI()
    {
       $query = Author::with('books')->withCount('books');

    if (request()->filled('name')) {
        $query->where('name', 'like', '%' . request('name') . '%');
    }

    $order = strtolower(request('order', 'desc')) === 'asc' ? 'asc' : 'desc';
    if (request('sort') === 'books') {
        $query->orderBy('books_count', $order);
    } else {
        $query->orderBy('created_at', $order);
    }

    $authors = $query->paginate(6)->withQueryString();

    return view('authors', compact('authors'));
    }

    public function editUI($id)
    {
        $author = Author::with('books')->find($id);
        if (!$author) {
            return redirect()->route('authors.ui')->with('error', 'Author not found');
        }
        return view('authors_edit', compact('author'));
    }

    public function update(Request $request, $id)
    {
        $author = Author::find($id);
        if (!$author) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Author not found'], 404);
            }
            return redirect()->route('authors.ui')->with('error', 'Author not found');
        }

        $validated = $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email|unique:authors,email,' . $id,
        ]);

        $author->update($validated);

        if ($request->expectsJson()) {
            return response()->json($author);
        }

        return redirect()->route('authors.ui')->with('success', 'Author updated successfully.');
    }

    public function destroy(Request $request, $id)
    {
        $author = Author::find($id);
        if (!$author) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Author not found'], 404);
            }
            return redirect()->route('authors.ui')->with('error', 'Author not found');
        }

        $author->delete();

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Author deleted successfully']);
        }

        return redirect()->route('authors.ui')->with('success', 'Author deleted successfully.');
    }
}
