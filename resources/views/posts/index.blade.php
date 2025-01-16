@extends('layouts.app')

@section('title', 'Главная страница')

@section('content')
    <h1>Список постов</h1>

    <!-- Сообщения об успехе -->
    @if(session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Форма добавления поста -->
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div>
            <input type="text" name="title" placeholder="Заголовок" required>
        </div>
        <div>
            <textarea name="content" placeholder="Контент" rows="5" required></textarea>
        </div>
        <button type="submit">Добавить пост</button>
    </form>

    <hr>

    <!-- Список постов -->
    <ul>
        @foreach ($posts as $post)
            <li>
                <h2>{{ $post->title }}</h2>
                <p>{{ $post->content }}</p>
                <div>
                    <a href="{{ route('posts.edit', $post->id) }}">Редактировать</a>

                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Удалить этот пост?')">Удалить</button>
                    </form>

                    <!-- Кнопка просмотра комментариев -->
                    <a href="{{ route('posts.show', $post->id) }}">Просмотреть комментарии</a>
                </div>
            </li>
        @endforeach
    </ul>

    <!-- Пагинация -->
    <div>
        {{ $posts->links() }}
    </div>
@endsection

