<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザーを取得
            $user = \Auth::user();
            $tasks = Task::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(10);
            $data = [
                'user' => $user,
                'tasks' => $tasks,
            ];
            return view('tasks.index', $data);
        }
        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (\Auth::check()) { // 認証済みの場合
            $task = new Task;
            return view('tasks.create', [
                'task' => $task,
            ]);
        }
        return redirect('/');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (\Auth::check()) { // 認証済みの場合
            // バリデーション
            $request->validate([
                'content' => 'required',
                'status' => 'required|max:10',
            ]);
            // 認証済みユーザー（閲覧者）の投稿として作成（リクエストされた値をもとに作成）
            $request->user()->tasks()->create([
                'content' => $request->content,
                'status' => $request->status,
            ]);
            return redirect()->route('tasks.index')->with('success', 'タスクを作成しました。');
        }
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);
        if (\Auth::id() === $task->user_id) {
            return view('tasks.show', [
                'task' => $task,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        // 認証済みユーザー（閲覧者）がその投稿の所有者である場合は投稿を削除
        if (\Auth::id() === $task->user_id) {
            return view('tasks.edit', [
                'task' => $task,
            ]);
        }
        return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        if (\Auth::id() === $task->user_id) {
            $request->validate([
                'content' => 'required',
                'status' => 'required|max:10',
            ]);
            $request->user()->tasks()->findOrFail($id)->update([
                'content' => $request->content,
                'status' => $request->status,
            ]);
            return redirect()->route('tasks.index')->with('success', 'タスクを更新しました。');
        }
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        // 認証済みユーザー（閲覧者）がその投稿の所有者である場合は投稿を削除
        if (\Auth::id() === $task->user_id) {
            $task->delete();
            return redirect()->route('tasks.index')->with('success', 'タスクを削除しました。');
        }
        // 前のURLへリダイレクトさせる
        return back()
            ->with('Delete Failed');
    }
}
