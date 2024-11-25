<?php

namespace App\Http\Controllers;

use App\Http\Requests\Space\StoreSpaceRequest;
use App\Http\Requests\Space\UpdateSpaceRequest;
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
//        $districtSlug = $request->input('district');
//        $spaces = Space::with(['images', 'district'])
//            ->when($districtSlug, function ($query) use ($districtSlug) {
//                return $query->whereHas('district', function ($q) use ($districtSlug) {
//                    $q->where('slug', $districtSlug);
//                });
//            })->get();
//        $districts = District::all();
        $spaces = Space::with(['images', 'district'])->paginate(15);
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
    public function store(StoreSpaceRequest $request)
    {
        $this->authorize('create', Space::class);

        $space = Space::create([
            'title' => $request['title'],
            'district_id' => $request['district'],
            'longitude' => $request['longitude'],
            'latitude' => $request['latitude'],
            'description' => $request['description'],
            'address' => $request['address'],
            'phone' => $request['phone'],
            'email' => $request['email'],
            'website' => $request['website'],
            'how_to_get' => $request['how_to_get'],
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $space->images()->create(['path' => $path]);
            }
        }

        return to_route('spaces.index')->with('success', 'Место успешно добавлено.');
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
    public function update(UpdateSpaceRequest $request, Space $space)
    {
        $this->authorize('update', Space::class);

        $space->update([
            'title' => $request['title'],
            'district_id' => $request['district'],
            'longitude' => $request['longitude'],
            'latitude' => $request['latitude'],
            'description' => $request['description'],
            'address' => $request['address'],
            'phone' => $request['phone'],
            'email' => $request['email'],
            'website' => $request['website'],
            'how_to_get' => $request['how_to_get'],
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $space->images()->create(['path' => $path]);
            }
        }

        return to_route('spaces.show', $space)->with('success', 'Место успешно обновлено.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Space $space)
    {
        $this->authorize('delete', Space::class);
        $space->delete();
        return to_route('spaces.index')->with('success', 'Место успешно удалено.');
    }
}
