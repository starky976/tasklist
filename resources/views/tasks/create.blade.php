@extends('layouts.app')

@section('content')
    <div class="prose ml-4">
        <h2 class="text-lg">タスク新規作成ページ</h2>
    </div>

    <div class="flex justify-center">
        <form method="POST" action="{{ route('tasks.store') }}" class="w-1/2">
            @csrf

            <div class="form-control my-4">
                <label for="content" class="label">
                    <span class="label-text">タスク:</span>
                </label>
                <input type="text" name="content" value="{{ old('content') }}"
                    class="input input-bordered w-full border
                    @error('content') border-red-500 @else border-gray-300 @enderror">
                @error('content')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-control my-4">
                <label for="status" class="label">
                    <span class="label-text">ステータス:</span>
                </label>
                <input type="text" name="status" value="{{ old('status') }}"
                    class="input input-bordered w-full border
                    @error('status') border-red-500 @else border-gray-300 @enderror">
                @error('status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-outline">投稿</button>
        </form>
    </div>
@endsection
