<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Track;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    public function index()
    {
        $tracks = Track::where('display', true)->orderBy('title')->get();

        return Inertia::render('Track/Index', [
            'tracks' => $tracks,
        ]);
    }

    public function create()
    {
        return Inertia::render('Track/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['string', 'required', 'max:255'],
            'artist' => ['string', 'required', 'max:255'],
            'image' => ['file', 'required'],
            'music' => ['file', 'required', 'extensions:mp3,wav'],
            'display' => ['boolean', 'required'],
        ]);

        $uuid = 'trk-' . Str::uuid();

        $extension = $request->file('image')->extension();
        $imagePath = $request->image->storeAs('tracks/images', $uuid . '.' . $extension);

        $extension2 = $request->music->extension();
        $musicPath = $request->music->storeAs('tracks/musics', $uuid . '.' . $extension2);

        Track::create([
            'uuid' => $uuid,
            'title' => $request->title,
            'artist' => $request->artist,
            'display' => $request->display,
            'image' => $imagePath,
            'music' => $musicPath,
        ]);

        return redirect()->route('tracks.index');
    }

    public function edit(Track $track)
    {
        return Inertia::render('Track/Edit', [
            'track' => $track,
        ]);
    }

    public function update(Request $request, Track $track)
    {
        $request->validate([
            'title' => ['string', 'required', 'max:255'],
            'artist' => ['string', 'required', 'max:255'],
            'image' => ['file'],
            'music' => ['file', 'extensions:mp3,wav'],
            'display' => ['boolean', 'required'],
        ]);

        $track->update([
            'title' => $request->title,
            'artist' => $request->artist,
            'display' => $request->display,
        ]);

        if ($request->hasFile('image')) {
            $extension = $request->file('image')->extension();
            $imagePath = $request->image->storeAs('tracks/images', $track->uuid . '.' . $extension);

            $track->update([
                'image' => $imagePath,
            ]);
        }

        if ($request->hasFile('music')) {
            $extension = $request->file('music')->extension();
            $musicPath = $request->music->storeAs('tracks/musics', $track->uuid . '.' . $extension);

            $track->update([
                'music' => $musicPath,
            ]);
        }

        return redirect()->route('tracks.index');
    }

    public function destroy(Track $track)
    {
        $track->delete();

        return redirect()->route('tracks.index');
    }
}
