<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\ApiKey;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ApiKeyController extends Controller
{
    public function index()
    {
        $user = request()->user();
        $apiKeys = $user->api_keys()->get();

        return Inertia::render('ApiKeys/Index', [
            'apiKeys' => $apiKeys,
        ]);
    }

    public function create()
    {
        $user = request()->user();
        $apiKeys = ApiKey::where('uuid', $user->uuid)->orderBy('name')->get();

        return Inertia::render('ApiKeys/Create', [
            'apiKeys' => $apiKeys,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['string', 'required', 'max:255'],
        ]);

        $uuid = 'api-' . Str::uuid();

        ApiKey::create([
            'uuid' => $uuid,
            'name' => $request->name,
            'key' => Str::random(32),
            'user_id' => $request->user()->id,
        ]);

        return redirect()->route('apiKeys.index');
    }

    public function destroy(ApiKey $apiKey)
    {
        $apiKey->delete();
        return redirect()->route('apiKeys.index');
    }
}
