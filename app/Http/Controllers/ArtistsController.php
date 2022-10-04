<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artists = Artist::orderBy('name')->get();
        
        return response()->json([
            'artists' => $artists,
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
            'name' => 'required|string|max:50',
            'bio' => 'sometimes|nullable|string|min:20|max:200',
            'genre_id' => 'required|exists:genres,id'
        ]);
        $artist = new Artist();
        $artist->name = $validated['name'];
        $artist->bio = $validated['bio'] || null;
        $artist->genre_id = $validated['genre_id'];
        $artist->save();

        return response()->json([
            'artist' => $artist,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $artist = Artist::findOrFail($id);
        
        return response()->json([
            'id' => $id,
            'artist' => $artist,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artist $artist)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'bio' => 'sometimes|nullable|string|min:20|max:200',
            'genre_id' => 'required|exists:genres,id'
        ]);

        $artist->name = $validated['name'];
        $artist->bio = $validated['bio'] || null;
        $artist->genre_id = $validated['genre_id'];
        $artist->save();

        return response()->json([
            'success' => true,
            'artist' => $artist,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artist $artist)
    {
        $artist->delete();
        
        return response()->json([
            'success' => true,
            'artist' => $artist,
        ]);
    }
}
