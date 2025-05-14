<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\ArticlePublished;
use Illuminate\Support\Facades\Notification;
use App\Events\NewArticlePublished;
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

        $articles = Article::when($category, function ($query, $category) {
            return $query->where('category', $category);
        })
        ->when($searchQuery, function ($query, $searchQuery) {
            return $query->where('title', 'like', '%' . $searchQuery . '%')
                         ->orWhere('content', 'like', '%' . $searchQuery . '%');
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
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|in:Musim Kemarau,Musim Hujan',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Cek apakah ada file gambar yang di-upload
        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('articles', 'public');
        }

        // Membuat artikel baru
        $article = Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category,
            'image_url' => $path,
        ]);

        // Trigger event untuk push notification
        event(new NewArticlePublished($article));  // Menyebarkan event push notification

        // Kirimkan email notifikasi ke semua pengguna
        $users = User::all(); // Bisa difilter jika perlu
        Notification::send($users, new ArticlePublished($article)); // Kirim email notification

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|in:Musim Kemarau,Musim Hujan',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($article->image_url) {
                Storage::disk('public')->delete($article->image_url);
            }

            $path = $request->file('image')->store('articles', 'public');
            $article->image_url = $path;
        }

        $article->update([
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category,
        ]);

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        if ($article->image_url) {
            Storage::disk('public')->delete($article->image_url);
        }

        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Artikel berhasil dihapus.');
    }
}
