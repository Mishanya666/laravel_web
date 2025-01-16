@extends('layouts.app')

@section('title', 'Редактировать комментарий')

@section('content')
    <h1>Редактировать комментарий</h1>

    <form action="{{ route('comments.update', $comment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Поле для редактирования комментария -->
        <textarea name="content" rows="5" required>{{ old('content', $comment->content) }}</textarea>

        <!-- Кнопка для сохранения изменений -->
        <button type="submit">Сохранить</button>
    </form>
@endsection

