<?php

namespace App\Http\Controllers;

use App\Models\design;
use Illuminate\Http\Request;

class designController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = design::latest()->paginate(5);
        return view('myDesignsListPage', compact('data'))->with('i', (request()->input('page',1)-1)*5);
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
    public function show(design $design)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(design $design)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, design $design)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(design $design)
    {
        //
    }
}
