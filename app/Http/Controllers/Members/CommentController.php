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
        $comment->user_id = auth()->id(); // もしくは、コメントの投稿者のIDを設定する方法
        $message->comments()->save($comment);

        return back(); // メッセージの詳細ページにリダイレクトする
    }

}
