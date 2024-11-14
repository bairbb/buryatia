<?php

namespace App\Http\Controllers;

use App\Models\Space;
use App\Models\District;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SpaceController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $districtSlug = $request->input('district');
        $spaces = Space::with(['images', 'district'])
            ->when($districtSlug, function ($query) use ($districtSlug) {
                return $query->whereHas('district', function ($q) use ($districtSlug) {
                    $q->where('slug', $districtSlug);
                });
            })->get();
        $districts = District::all();
        return view('spaces.index', compact('spaces', 'districts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Space::class);
        $districts = District::all();
        return view('spaces.create', compact('districts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Space::class);
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'district' => 'required|exists:districts,id',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'website' => 'nullable|url',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'how_to_get' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $space = Space::create([
            'title' => $validatedData['title'],
            'district_id' => $validatedData['district'],
            'longitude' => $validatedData['longitude'],
            'latitude' => $validatedData['latitude'],
            'description' => $validatedData['description'],
            'address' => $validatedData['address'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'website' => $validatedData['website'],
            'how_to_get' => $validatedData['how_to_get'],
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $space->images()->create(['path' => $path]);
            }
        }

        return redirect()->route('spaces.index')->with('success', 'Место успешно добавлено.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Space $space)
    {
        return view('spaces.show', compact('space'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Space $space)
    {
        $this->authorize('update', Space::class);
        $districts = District::all();
        return view('spaces.edit', compact('space', 'districts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Space $space)
    {
        $this->authorize('update', Space::class);
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'district' => 'required|exists:districts,id',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|string',
            'website' => 'nullable|url',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'how_to_get' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $space->update([
            'title' => $request->title,
            'district_id' => $request->district,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'description' => $request->description,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'website' => $request->website,
            'how_to_get' => $request->how_to_get,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $space->images()->create(['path' => $path]);
            }
        }

        return redirect()->route('spaces.show', $space)->with('success', 'Место успешно обновлено.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Space $space)
    {
        $this->authorize('delete', Space::class);
        $space->delete();
        return redirect()->route('spaces.index')->with('success', 'Место успешно удалено.');
    }
}
