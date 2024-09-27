<?php

namespace App\Http\Controllers;

use App\Models\Space;
use App\Models\District;
use Illuminate\Http\Request;

class SpaceController extends Controller
{
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $space = Space::where('slug', $slug)->with(['images', 'district'])->firstOrFail();
        return view('spaces.show', compact('space'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Space $space)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Space $space)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Space $space)
    {
        //
    }
}
