<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Validator;

use App\Http\Controllers\Controller;
use App\Post;
use App\Category;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::all();

        return view('posts', [
            'posts' => $posts
        ]);
    }

    public function create()
    {
        $post = new Post();
        $post->active = true;

        $categories = Category::where('active', true)->get();

        return view('post', [
            'post' => $post,
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|min:3|max:255',
            'summary' => 'required|min:3',
            'text' => 'required|min:3',
            'category_id' => 'required|exists:categories,id',
        ];

        $messages = [
            'title.required' => 'O campo título deve ser preenchido',
            'title.min' => 'O campo título deve ter pelo menos 3 caracteres',
            'title.max' => 'O campo título deve ter no máximo 255 caracteres',
            'summary.required' => 'O campo súmario deve ser preenchido',
            'summary.min' => 'O campo súmario deve ter pelo menos 3 caracteres',
            'text.required' => 'O campo descrição deve ser preenchido',
            'text.min' => 'O campo descrição deve ter pelo menos 3 caracteres',
            'category_id.required' => 'Uma categoria deve ser selecionada',
            'category_id.exists' => 'Você deve selecionar uma categoria válida',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $post = new Post();
        $post->title = $request->input('title');
        $post->summary = $request->input('summary');
        $post->text = $request->input('text');
        $post->category_id = $request->input('category_id');
        $post->active = ($request->input('active') === 'S');

        $post->save();

        return redirect()->route('posts.index');
    }

    public function edit($id)
    {
        $post = Post::find($id);

        $categories = Category::where('active', true)->get();

        return view('post', [
            'post' => $post,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'title' => 'required|min:3|max:255',
            'summary' => 'required|min:3',
            'text' => 'required|min:3',
            'category_id' => 'required|exists:categories,id',
        ];

        $messages = [
            'title.required' => 'O campo título deve ser preenchido',
            'title.min' => 'O campo título deve ter pelo menos 3 caracteres',
            'title.max' => 'O campo título deve ter no máximo 255 caracteres',
            'summary.required' => 'O campo súmario deve ser preenchido',
            'summary.min' => 'O campo súmario deve ter pelo menos 3 caracteres',
            'text.required' => 'O campo descrição deve ser preenchido',
            'text.min' => 'O campo descrição deve ter pelo menos 3 caracteres',
            'category_id.required' => 'Uma categoria deve ser selecionada',
            'category_id.exists' => 'Você deve selecionar uma categoria válida',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->summary = $request->input('summary');
        $post->text = $request->input('text');
        $post->category_id = $request->input('category_id');
        $post->active = ($request->input('active') === 'S');

        $post->save();

        return redirect()->route('posts.index');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        return redirect()->route('posts.index');
    }
}
