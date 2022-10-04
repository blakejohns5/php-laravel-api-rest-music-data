<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genres = Genre::with('artists')->orderBy('name')->get();
        return response()->json([
            'genres' => $genres,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:30|unique:genres,name',
        ]);

        $genre = new Genre();
        // $genre->name = $request->name;
        $genre->name = $validated['name'];
        $genre->save();

        return response()->json([
            'success' => true,
            'genre' => $genre,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $genre = Genre::findOrFail($id);
        $genre->load('artists');

        return response()->json([
            'id' => $id,
            'genre' => $genre,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Genre $genre)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:30|unique:genres,name',
        ]);

        $genre->name = $validated['name'];
        $genre->save();
        return response()->json([
            'success' => true,
            'genre' => $genre,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();
        
        return response()->json([
            'success' => true,
            'genre' => $genre,
        ]);
    }
}
