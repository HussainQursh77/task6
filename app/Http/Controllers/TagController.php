<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();
        return response()->json($tags);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valdata = $request->validate([

            'name' => 'required|max:255|unique:tags'
        ]);

        $tag = Tag::create($valdata);
        return response()->json($tag, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tag = Tag::with('posts')->findOrFail($id);
        return response()->json($tag);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tag = Tag::findOrFail($id);

        $valdata = $request->validate([
            'name' => 'required|max:255|unique:tags,id'
        ]);
        $tag->update($valdata);
        return response()->json($tag);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return response()->json('tagdelete', 201);
    }
}
