<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Models\User;

class AdminArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('user')->latest()->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }
    
    public function adminShow($id)
    {
        $article = Article::with('user')->findOrFail($id);
        return view('admin.articles.show', compact('article'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'reason' => 'nullable|string',
        ]);

        if ($request->status === 'approved') {
            return $this->approve($id);
        } elseif ($request->status === 'rejected') {
            $article = Article::findOrFail($id);
            $article->reason = $request->reason;
            $article->save();

            return $this->reject($id);
        }

        return redirect()->back()->with('error', 'Status tidak valid');
    }

    public function approve($id)
    {
        $article = Article::findOrFail($id);
        $article->status = 'approved';
        $article->reason = null;
        $article->save();

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil disetujui.');
    }

    public function reject($id)
    {
        $article = Article::findOrFail($id);
        $article->status = 'rejected';
        $article->save();

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil ditolak.');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        if ($article->status !== 'rejected') {
            return response()->json(['success' => false, 'message' => 'Hanya artikel yang ditolak yang dapat dihapus.'], 403);
        }

        $article->delete();
        return response()->json(['success' => true, 'message' => 'Artikel berhasil dihapus.']);
    }
}