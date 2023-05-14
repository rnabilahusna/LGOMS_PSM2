<?php

namespace App\Http\Controllers;

use App\Models\pdr;
use App\Models\order;
use Illuminate\Http\Request;

class pdrController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = order::latest()->paginate(5);
        return view('store.ordersListPage', compact('data'))->with('i', (request()->input('page',1)-1)*5);
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
    public function show(pdr $pdr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pdr $pdr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, pdr $pdr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pdr $pdr)
    {
        //
    }



    //SALES PERSONNEL FUNCTIONS
    public function getPDRFormPageForSalesP(order $order)
    {
        return view('sales.PDRFormPage', compact('order'));
    }

    public function updatePDRFormPageForSalesP(Request $request, pdr $pdr){
        //
    }



    //STORE PERSONNEL FUNCTIONS
    public function getPDRFormPageForStoreP(order $order)
    {
        return view('store.PDRFormPage', compact('order'));
    }

    public function updatePDRFormPageForStoreP(Request $request, pdr $pdr){
        //
    }


    //PRODUCTION PERSONNEL FUNCTIONS
    public function getPDRFormPageForProdP(pdr $pdr)
    {
        return view('prod.PDRFormPage', compact('pdr'));
    }

    public function updatePDRFormPageForProdP(Request $request, pdr $pdr){
        //
    }

    
}
