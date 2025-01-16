<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
{
    $posts = Post::paginate(5); // Выводить по 5 постов на странице
    return view('posts.index', compact('posts'));
}


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        Post::create($request->only('title', 'content')); // Создаём новый пост
        return redirect()->route('posts.index')->with('success', 'Пост добавлен!');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post')); // Форма редактирования поста
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $post->update($request->only('title', 'content')); // Обновляем пост
        return redirect()->route('posts.index')->with('success', 'Пост обновлён!');
    }

    public function destroy(Post $post)
    {
        $post->delete(); // Удаляем пост
        return redirect()->route('posts.index')->with('success', 'Пост удалён!');
    }
public function show(Post $post)
{
    $comments = $post->comments; // Загрузить комментарии для поста
    return view('posts.show', compact('post', 'comments'));
}

}

