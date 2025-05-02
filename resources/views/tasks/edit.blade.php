@extends('layouts.app')

@section('content')
    <div class="prose ml-4">
        <h2 class="text-lg">id: {{ $task->id }} のタスク編集ページ</h2>
    </div>

    <div class="flex justify-center">
        <form method="POST" action="{{ route('tasks.update', $task->id) }}" class="w-1/2">
            @csrf
            @method('PUT')

            <div class="form-control my-4">
                <label for="content" class="label">
                    <span class="label-text">タスク:</span>
                </label>
                <input type="text" name="content" value="{{ old('content', $task->content) }}"
                    class="input input-bordered w-full border @error('content') border-red-500 @else border-gray-300 @enderror">
                @error('content')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-control my-4">
                <label for="status" class="label">
                    <span class="label-text">ステータス:</span>
                </label>
                <input type="text" name="status" value="{{ old('status', $task->status) }}"
                    class="input input-bordered w-full border @error('status') border-red-500 @else border-gray-300 @enderror">
                @error('status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4 sm:gap-0 mt-8">
                <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
                    {{-- 一覧ページに戻る --}}
                    <a class="btn btn-outline btn-accent" href="{{ route('tasks.index') }}">タスク一覧ページに戻る</a>
                </div>
                <div class="flex gap-4 w-full sm:w-auto justify-end">
                    <button type="submit" class="btn btn-primary btn-outline">更新</button>
                </div>
            </div>
        </form>
    </div>
@endsection
