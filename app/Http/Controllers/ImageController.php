<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Space;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Image $image)
    {
        $this->authorize('delete', Space::class);
//        dd(storage_path('app/public/' . $image->path));
        if ($image->path && file_exists(storage_path('app/public/' . $image->path))) {
            unlink(storage_path('app/public/' . $image->path));
        }
        $image->delete();
        return redirect()->back()->with('message', 'Изображение успешно удалено.');
    }
}

