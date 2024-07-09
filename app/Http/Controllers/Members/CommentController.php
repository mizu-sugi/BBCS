<?php

namespace App\Http\Controllers\Members;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, Message $message)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $comment = new Comment;
        $comment->content = $request->content;
        $comment->member_id = auth('members')->id();
        $message->comments()->save($comment);

        return back(); // メッセージの詳細ページにリダイレクトする
    }

    public function edit($messageId, $commentId)
    {
        $message = Message::findOrFail($messageId);
        $comment = Comment::findOrFail($commentId);

        // コメントの所有者チェック
        if (auth('members')->id() !== $comment->member_id) {
            abort(403);
        }

        return view('members.community-boards.comments.edit', compact('message', 'comment'));
    }

    public function update(Request $request, $messageId, $commentId)
    {
        $message = Message::findOrFail($messageId);
        $comment = Comment::findOrFail($commentId);

        // コメントの所有者チェック
        if (auth('members')->id() !== $comment->member_id) {
            abort(403);
        }

        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        $comment->content = $request->input('content');
        $comment->save();

        return redirect()->route('members.community-boards.show', $messageId)->with('success', 'コメントが更新されました。');
    }

    public function destroy($messageId, $commentId)
    {
        $message = Message::findOrFail($messageId);
        $comment = Comment::findOrFail($commentId);

        // コメントの所有者チェック
        if (auth('members')->id() !== $comment->member_id) {
            abort(403);
        }

        $comment->delete();

        return redirect()->route('members.community-boards.show', $messageId)->with('success', 'コメントが削除されました。');
    }
}