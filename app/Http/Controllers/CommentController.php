<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller

{
public function show($id)
{
    $post = Post::findOrFail($id);
    $comments = $post->comments()->paginate(5); // По 5 комментариев на страницу
    return view('posts.show', compact('post', 'comments'));
}

public function destroy(Comment $comment)
{
    $comment->delete();

    return redirect()->back()->with('success', 'Комментарий успешно удалён.');
}

public function edit(Comment $comment)
{
    return view('comments.edit', compact('comment'));
}

public function update(Request $request, Comment $comment)
{
    $request->validate([
        'content' => 'required|string|max:500',
    ]);

    $comment->content = $request->content;
    $comment->save();

    return redirect()->back()->with('success', 'Комментарий успешно обновлён.');
}

    public function store(Request $request, Post $post)
    {
        // Валидация входных данных
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        // Создание нового комментария
        $comment = new Comment();
        $comment->content = $request->content;
        $comment->post_id = $post->id;
        $comment->is_approved = false;  // по умолчанию комментарий не одобрен
        $comment->save();

        // Перенаправление обратно на страницу поста с сообщением об успешной отправке
        return redirect()->route('posts.show', $post->id)->with('success', 'Комментарий успешно добавлен!');
    }

    public function approve(Request $request, Comment $comment)
{
    $comment->is_approved = 1; // Одобрить комментарий
    $comment->save();

    return redirect()->back()->with('success', 'Комментарий одобрен.');
}

}

