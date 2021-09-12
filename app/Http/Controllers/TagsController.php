<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    /* ====== index function to go to tage index page with values of all tags in tag model ====== */
    public function index()
    {
        return view('tags.index')->with('tags', Tag::all());
    }

    /* ====== create function to go to the create blade to get the form of create ====== */
    public function create()
    {
        return view('tags.create');
    }

    /* ====== store function to go to the create blade to get the form of create ====== */
    public function store(TagRequest $request)
    {
        Tag::create($request->all());

        // return success message in the index page
        session()->flash('success','The tag has been created successfully');
        return redirect(route('tags.index'));
    }

    /* ====== show function to show only one tag ====== */
    public function show(Tag $tag)
    {
        //
    }

    /* ====== edit function to go to the edit blade to update the data of tag from the form of edit ====== */
    public function edit(Tag $tag)
    {
        // ####### this is to go mainly to edit form
        return view('tags.edit')->with('tag', $tag);
    }

    // ######## update function for tags
    public function update(TagRequest $request, Tag $tag)
    {
        $tag->update([
            'name' => $request->name
        ]);

        // return success message in the index page
        session()->flash('middle','The tag has been updated successfully');
        return redirect(route('tags.index'));
    }

    // ######## delete function for tags
    public function destroy(Tag $tag)
    {
        $tag->delete();

        // return error message in the index page
        session()->flash('error','The tag has been deleted successfully');
        return redirect(route('tags.index'));
    }
}
