<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil artikel terbaru dengan pagination 10
        $articles = Article::latest()->paginate(10);
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menampilkan form untuk membuat artikel baru
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi dan simpan artikel baru
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string|max:255',
            'image_url' => 'required|url',
        ]);

        Article::create($request->all());
        return redirect()->route('articles.index')->with('success', 'Article created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Menampilkan artikel berdasarkan ID
        $article = Article::findOrFail($id);
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        // Menampilkan form untuk mengedit artikel
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        // Validasi dan update artikel
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string|max:255',
            'image_url' => 'required|url',
        ]);

        $article->update($request->all());
        return redirect()->route('articles.index')->with('success', 'Article updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        // Menghapus artikel
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Article deleted successfully.');
    }
}