@extends('layouts.app')

@section('title', 'Редактировать пост')

@section('content')
    <h1>Редактировать пост</h1>

    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <input type="text" name="title" value="{{ old('title', $post->title) }}" required>
        </div>
        <div>
            <textarea name="content" rows="5" required>{{ old('content', $post->content) }}</textarea>
        </div>
        <button type="submit">Сохранить изменения</button>
    </form>
@endsection

