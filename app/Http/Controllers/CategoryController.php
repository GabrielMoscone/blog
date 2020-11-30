<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Validator;

use App\Http\Controllers\Controller;
use App\Category;
use App\Post;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();

        return view('categories', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        $category = new Category();
        $category->active = true;

        return view('category', [
            'category' => $category
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:3|max:255',
            'description' => 'required|min:3'
        ];

        $messages = [
            'name.required' => 'O campo nome deve ser preenchido',
            'name.min' => 'O campo nome deve ter pelo menos 3 caracteres',
            'name.max' => 'O campo nome deve ter no máximo 255 caracteres',
            'description.required' => 'O campo descrição deve ser preenchido',
            'description.min' => 'O campo descrição deve ter pelo menos 3 caracteres'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $category = new Category();
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->active = ($request->input('active') === 'S');
        $category->save();

        return redirect()->route('categories.index');
    }

    public function edit($id)
    {
        $category = Category::find($id);

        return view('category', [
            'category' => $category
        ]);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|min:3|max:255',
            'description' => 'required|min:3'
        ];

        $messages = [
            'name.required' => 'O campo nome deve ser preenchido',
            'name.min' => 'O campo nome deve ter pelo menos 3 caracteres',
            'name.max' => 'O campo nome deve ter no máximo 255 caracteres',
            'description.required' => 'O campo descrição deve ser preenchido',
            'description.min' => 'O campo descrição deve ter pelo menos 3 caracteres'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->active = ($request->input('active') === 'S');

        // Desabilita as publicações que possuem essa categoria
        if (!$category->active) {
            Post::where('category_id', $id)->update(['active' => false]);
        }

        $category->save();

        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect()->route('categories.index');
    }
}
