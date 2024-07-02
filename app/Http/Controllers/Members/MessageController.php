<?php

namespace App\Http\Controllers\Members;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::all();
        return view('members.community-boards.index', compact('messages'));
    }
    
     public function show(Message $message)
     {
         return view('members.community-boards.show', compact('message'));
     }
    
     public function create()
     {
         return view('members.community-boards.create');
     }

     public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Message::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id(), // 認証されたユーザーのIDを保存
        ]);

        return redirect()->route('community-boards.index')->with('success', 'メッセージが作成されました');
    }

}
