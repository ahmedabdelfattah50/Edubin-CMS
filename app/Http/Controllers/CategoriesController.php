<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\categoryRequest;

class CategoriesController extends Controller
{
    /* ====== index function to go to categories index page with values of all categories in Category model ====== */
    public function index()
    {
        return view('categories.index')->with('categories',Category::all());
    }

    /* ====== create function to go to the create blade to get the form of create ====== */
    public function create()
    {
        return view('categories.create');
    }

    /* ====== store function to go to the create blade to get the form of create ====== */
    public function store(categoryRequest $request)
    {
        Category::create($request->all());

        // return success message in the index page
        session()->flash('success','The category has been created successfully');
        return redirect(route('categories.index'));
    }

    /* ====== show function to show only one Category ====== */
    public function show($id)
    {
        //
    }

    /* ====== edit function to go to the edit blade to update the data of tag from the form of edit ====== */
    public function edit(Category $category)
    {
        // ####### if I used the same form of create to be update form
        // return view('categories.create')->with('category', $category);

        // ####### this is to go mainly to edit form
        return view('categories.edit')->with('category', $category);
    }

    // ######## update function for categories
    public function update(categoryRequest $request, Category $category)
    {
        $category->update([
            'name' => $request->name
        ]);

        // return success message in the index page
        session()->flash('middle','The category has been updated successfully');
        return redirect(route('categories.index'));
    }

    // ######## delete function for categories
    public function destroy(Category $category)
    {
        $category->delete();

        // return error message in the index page
        session()->flash('error','The category has been deleted successfully');
        return redirect(route('categories.index'));
    }
}
