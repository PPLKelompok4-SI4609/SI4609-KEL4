<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchQuery = $request->input('search');
        $category = $request->input('category');

        $articles = Article::where('status', 'approved') // Tambahkan ini untuk filter status approved
            ->when($category, function ($query, $category) {
                return $query->where('category', $category);
            })
            ->when($searchQuery, function ($query, $searchQuery) {
                return $query->where(function($q) use ($searchQuery) {
                    $q->where('title', 'like', '%' . $searchQuery . '%')
                    ->orWhere('content', 'like', '%' . $searchQuery . '%');
                });
            })
            ->latest()
            ->paginate(10);

        return view('articles.index', compact('articles', 'searchQuery', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input with the correct category constraint
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|in:Musim Kemarau,Musim Hujan', // Correct validation for category
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation (optional)
            'status' => 'nullable|in:approved,rejected', // Optional status validation
        ]);

        // Check if there's an uploaded file
        $path = null;
        if ($request->hasFile('image')) {
            // Store the file in storage/public/articles
            $path = $request->file('image')->store('articles', 'public');
        }

        // Create a new article
        Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category,
            'author' => auth()->user()->name, // Use the authenticated user's name
            'image_url' => $path, // Store the file path
            'status' => $request->status ?? 'pending', // Default status to pending if not provided
            'user_id' => auth()->id(), // Use the authenticated user's ID
        ]);

        return redirect()->route('articles.listarticle')->with('success', 'Artikel berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Display the article by its ID
        $article = Article::with('user')->findOrFail($id);
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        // Display the form for editing the article
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        // Validate input with the correct category constraint
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|in:Musim Kemarau,Musim Hujan', // Correct validation for category
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation (optional)
        ]);

        // Check if there's a new image file uploaded
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($article->image_url) {
                Storage::disk('public')->delete($article->image_url);
            }

            // Store the new image
            $path = $request->file('image')->store('articles', 'public');
            $article->image_url = $path;
        }

        // Update the article
        $article->update([
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category,
        ]);

        return redirect()->route('articles.listarticle')->with('success', 'Artikel berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        // Delete the article image if it exists
        if ($article->image_url) {
            Storage::disk('public')->delete($article->image_url);
        }

        // Delete the article itself
        $article->delete();
        return redirect()->route('articles.listarticle')->with('success', 'Artikel berhasil dihapus.');
    }

    public function myArticles()
    {
        // Get the authenticated user's articles
        $articles = Article::where('user_id', auth()->id())->latest()->paginate(10);
        return view('articles.listarticle', compact('articles'));
    }
}
