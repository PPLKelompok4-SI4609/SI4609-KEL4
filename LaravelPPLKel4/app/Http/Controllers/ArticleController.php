<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use App\Notifications\FloodRescueEduNotification;
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

<<<<<<< Updated upstream
        Article::create($request->all());
        return redirect()->route('articles.index')->with('success', 'Article created successfully.');
=======
        // Check if there's an uploaded file
        $path = null;
        if ($request->hasFile('image')) {
            // Store the file in storage/public/articles
            $path = $request->file('image')->store('articles', 'public');
        }

        // Create a new article
        $article = Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category,
            'image_url' => $path, // Store the file path
        ]);

        // Kirimkan notifikasi ke semua pengguna setelah artikel baru diposting
        $users = User::all(); // Ambil semua pengguna
        foreach ($users as $user) {
            $user->notify(new FloodRescueEduNotification("Artikel baru diposting: " . $article->title));
        }

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil ditambahkan.');
>>>>>>> Stashed changes
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

<<<<<<< Updated upstream
        $article->update($request->all());
        return redirect()->route('articles.index')->with('success', 'Article updated successfully.');
=======
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

        // Kirimkan notifikasi ke semua pengguna setelah artikel diperbarui
        $users = User::all(); // Ambil semua pengguna
        foreach ($users as $user) {
            $user->notify(new FloodRescueEduNotification("Artikel diperbarui: " . $article->title));
        }

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil diperbarui.');
>>>>>>> Stashed changes
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