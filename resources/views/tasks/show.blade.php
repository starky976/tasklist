@extends('layouts.app')

@section('content')
    <div class="prose ml-4">
        <h2>id = {{ $task->id }} のタスク詳細ページ</h2>
    </div>

    <table class="table w-full my-4">
        <tr>
            <th>id</th>
            <td>{{ $task->id }}</td>
        </tr>

        <tr>
            <th>メッセージ</th>
            <td>{{ $task->content }}</td>
        </tr>
    </table>
    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 sm:gap-0 mt-8">
        <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
            {{-- 一覧ページに戻る --}}
            <a class="btn btn-outline btn-accent" href="{{ route('tasks.index') }}">タスク一覧ページに戻る</a>
        </div>
        <div class="flex gap-4 w-full sm:w-auto justify-end">
            {{-- メッセージ編集ページへのリンク --}}
            <a class="btn btn-outline" href="{{ route('tasks.edit', $task->id) }}">このタスクを編集</a>

            {{-- メッセージ削除フォーム --}}
            <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" class="">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-error btn-outline"
                    onclick="return confirm('id = {{ $task->id }} のタスクを削除します。よろしいですか？')">削除</button>
            </form>
        </div>

    </div>
@endsection
