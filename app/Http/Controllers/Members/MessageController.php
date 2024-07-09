<?php

namespace App\Http\Controllers\Members;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Message;
use App\Models\Comment;


class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::where('member_id', auth()->id())->get();
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
            'member_id' => auth('members')->id(), // 認証されたユーザーのIDを保存
        ]);

        return redirect()->route('members.community-boards.index')->with('success', 'メッセージが作成されました');
    }

    public function edit($messageId)
    {
        $message = Message::findOrFail($messageId);
       
        // メッセージの所有者チェック
        if (auth('members')->id() !== $message->member_id) {
            abort(403);
        }

        return view('members.community-boards.edit', compact('message'));
    }

    public function update(Request $request, Message $message)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // メッセージの所有者チェック
        if (auth('members')->id() !== $message->member_id) {
            abort(403);
        }

        $message->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('members.community-boards.show', $message->id)->with('success', 'メッセージが更新されました');
    }

    public function destroy(Message $message)
    {
        // メッセージの所有者チェック
        if (auth('members')->id() !== $message->member_id) {
            abort(403);
        }

        $message->delete();

        return redirect()->route('members.community-boards.index')->with('success', 'メッセージが削除されました');
    }

}
