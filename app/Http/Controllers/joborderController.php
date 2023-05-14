<?php

namespace App\Http\Controllers;

use App\Models\joborder;
use Illuminate\Http\Request;

class joborderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = order::latest()->paginate(5);
        return view('qc.ordersListPage', compact('data'))->with('i', (request()->input('page',1)-1)*5);
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
    public function show(joborder $joborder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(joborder $joborder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, joborder $joborder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(joborder $joborder)
    {
        //
    }


    //QC PERSONNEL FUNCTIONS
    public function getJobOrderFormPageForQCP(joborder $joborder)
    {
        return view('qc.jobOrderFormPage', compact('joborder'));
    }

    public function updateJobOrderFormPageForQCP(Request $request, joborder $joborder){
        //
    }



    //STORE PERSONNEL FUNCTIONS
    public function getJobOrderFormPageForStoreP(joborder $joborder)
    {
        return view('store.jobOrderFormPage', compact('joborder'));
    }

    public function updateJobOrderFormPageForStoreP(Request $request, joborder $joborder){
        //
    }


    //PRODUCTION PERSONNEL FUNCTIONS
    public function getJobOrderFormPageForProdP(joborder $joborder)
    {
        return view('prod.jobOrderFormPage', compact('joborder'));
    }

    public function updateJobOrderFormPageForProdP(Request $request, joborder $joborder){
        //
    }


}
