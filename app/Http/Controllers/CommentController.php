<?php

// app/Http/Controllers/CommentController.php
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Report;

class CommentController extends Controller
{
    use AuthorizesRequests;

    public function store(Request $request, Report $report)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Comment::create([
            'report_id' => $report->id,
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        return back()->with('success', 'Komentar berhasil dikirim!');
    }

    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment->update([
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil diperbarui.');
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment); 
        $comment->delete();

        return back()->with('success', 'Komentar berhasil dihapus.');
    }
}
