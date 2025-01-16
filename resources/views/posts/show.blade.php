@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <h1>{{ $post->title }}</h1>

    <p>{{ $post->content }}</p>

    <!-- Форма для добавления комментария -->
    <form action="{{ route('comments.store', $post->id) }}" method="POST">
        @csrf
        <textarea name="content" placeholder="Оставьте комментарий" required></textarea>
        <button type="submit" class="btn-primary">Отправить</button>
    </form>

    <h3>Комментарии:</h3>

    @if ($post->comments->isEmpty())
        <p>Комментариев пока нет. Будьте первым!</p>
    @else
        @foreach ($post->comments as $comment)
            <div class="comment">
                <p><strong>Комментарий:</strong> {{ $comment->content }}</p>
                @if ($comment->is_approved)
                    <p style="color: green;">Комментарий одобрен</p>
                @else
                    <p style="color: red;">Ожидает одобрения</p>
                    <form action="{{ route('comments.approve', $comment->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn-primary">Одобрить</button>
                    </form>
                @endif

                <div class="comment-actions">
                    <a href="{{ route('comments.edit', $comment->id) }}" class="btn-secondary">Редактировать</a>

                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-danger" onclick="return confirm('Вы уверены, что хотите удалить комментарий?');">Удалить</button>
                    </form>
                </div>
            </div>
        @endforeach
    @endif

    <hr>

    <!-- Кнопки для перемещения между страницами -->
    <div>
        <a href="{{ route('posts.index') }}" class="btn-secondary">Назад к постам</a>
    </div>
@endsection

