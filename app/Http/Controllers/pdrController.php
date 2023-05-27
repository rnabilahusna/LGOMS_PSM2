<?php

namespace App\Http\Controllers;

use App\Models\pdr;
use Illuminate\Http\Request;

class pdrController extends Controller
{
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

    public function createPDRFormPageForSalesP(Request $request){

        // $data = $request->all();
        // dd($data);
        $request->validate([
            'id'                    =>  'required',
            'refNo'                 =>  'nullable',
            'JONo'                  =>  'nullable',
            'orderID'               =>  'nullable',
            'PONo'                  =>  'nullable',
            'acceptedBy'            =>  'nullable',
            'approvedBy'            =>  'nullable',
            'balance'               =>  'nullable',
            'buyerCode'             =>  'required',
            'buyerName'             =>  'required',
            'IssuedDate'            =>  'required',
            'daysDelayed'           =>  'nullable',
            'deliveredDate'         =>  'nullable',
            'deliveryDate'          =>  'required',
            'deliveryQuantity'      =>  'nullable',
            'DINo'                  =>  'nullable',
            'DONoSales1'            =>  'nullable',
            'DONoSales2'            =>  'nullable',
            'jobOrderDate'          =>  'nullable',
            'month'                 =>  'nullable',
            'no'                    =>  'nullable',
            'partIDOrName'          =>  'nullable',
            'producedBy'            =>  'nullable',
            'reportDate'            =>  'nullable',
            'stock'                 =>  'nullable'
        ]);

        // dd('hello');

        $pdr = new pdr;
        $pdr->id = $request->id;
        $pdr->refNo = $request->refNo;
        $pdr->JONo = $request->JONo;
        $pdr->orderID = $request->orderID;
        $pdr->PONo = $request->PONo;
        $pdr->acceptedBy = $request->acceptedBy;
        $pdr->approvedBy = $request->approvedBy;
        $pdr->balance = $request->balance;
        $pdr->buyerCode = $request->buyerCode;
        $pdr->buyerName = $request->buyerName;
        $pdr->IssuedDate = $request->IssuedDate;
        $pdr->daysDelayed = $request->daysDelayed;
        $pdr->deliveredDate = $request->deliveredDate;
        $pdr->deliveryDate = $request->deliveryDate;
        $pdr->deliveryQuantity = $request->deliveryQuantity;
        $pdr->DINo = $request->DINo;
        $pdr->DONoSales1 = $request->DONoSales1;
        $pdr->DONoSales2 = $request->DONoSales2;
        $pdr->jobOrderDate = $request->jobOrderDate;
        $pdr->month = $request->month;
        $pdr->no = $request->no;
        $pdr->partIDOrName = $request->partIDOrName;
        $pdr->producedBy = $request->producedBy;
        $pdr->reportDate = $request->reportDate;
        $pdr->stock = $request->stock;

        // dd('hellow');
        $pdr->save();

        return redirect()->route('sales.ordersListPage')->with('success', 'PDR created successfully.');

    }

    public function getPDRFormPageForSalesP(pdr $pdr)
    {
        // dd($pdr);
        return view('sales.updatePDRForm', compact('pdr'));
    }

    public function updatePDRFormPageForSalesP(Request $request, pdr $pdr){
        $request->validate([

            'orderID'               =>  'nullable',
            'partIDOrName'          =>  'nullable',
            'acceptedBy'            =>  'nullable',
            'approvedBy'            =>  'nullable',
            'buyerCode'             =>  'required',
            'month'                 =>  'nullable',
            'IssuedDate'            =>  'nullable',
            'reportDate'            =>  'nullable',
            'no'                    =>  'nullable',
            'PONo'                  =>  'nullable',
            'deliveryDate'          =>  'nullable',
            'jobOrderDate'          =>  'nullable',
            'deliveredDate'         =>  'nullable',
            'daysDelayed'           =>  'nullable',
            'DONoSales2'            =>  'nullable',
            'producedBy'            =>  'nullable',
           
        ]);

        $pdr = pdr::find($request->hidden_id);

        $pdr->orderID = $request->orderID;
        $pdr->partIDOrName = $request->partIDOrName;
        $pdr->acceptedBy = $request->acceptedBy;
        $pdr->approvedBy = $request->approvedBy;
        $pdr->buyerCode = $request->buyerCode;

        $pdr->month = $request->month;
        $pdr->IssuedDate = $request->IssuedDate;
        $pdr->reportDate = $request->reportDate;
        $pdr->no = $request->no;
        $pdr->PONo = $request->PONo;
        $pdr->deliveryDate = $request->deliveryDate;
        $pdr->jobOrderDate = $request->jobOrderDate;
        $pdr->deliveredDate = $request->deliveredDate;
        $pdr->daysDelayed = $request->daysDelayed;
        $pdr->DONoSales2 = $request->DONoSales2;

        $pdr->producedBy = $request->producedBy;
      
        // dd('hellow');
        $pdr->save();

        return redirect()->route('sales.ordersListPage')->with('success', 'PDR updated successfully.');
    

    }
   
   


    //STORE PERSONNEL FUNCTIONS

    public function getPDRFormPageForStoreP(pdr $pdr)
    {
        // dd($pdr);
        return view('store.PDRFormPage', compact('pdr'));
    }

    public function updatePDRFormPageForStoreP(Request $request, pdr $pdr){
        $request->validate([

            'orderID'               =>  'nullable',
            'partIDOrName'          =>  'nullable',
            'acceptedBy'            =>  'nullable',
            'approvedBy'            =>  'nullable',
            'buyerCode'             =>  'required',
            'stock'                 =>  'nullable',
            'deliveryQuantity'      =>  'nullable',
            'balance'               =>  'nullable',
            'producedBy'            =>  'nullable',
            'DINo'            =>  'nullable',
        ]);

        $pdr = pdr::find($request->hidden_id);

        $pdr->orderID = $request->orderID;
        $pdr->partIDOrName = $request->partIDOrName;
        $pdr->acceptedBy = $request->acceptedBy;
        $pdr->approvedBy = $request->approvedBy;
        $pdr->buyerCode = $request->buyerCode;
        $pdr->stock = $request->stock;
        $pdr->deliveryQuantity = $request->deliveryQuantity;
        $pdr->balance = $request->balance;
        $pdr->producedBy = $request->producedBy;
        $pdr->DINo = $request->DINo;
      
        // dd('hellow');
        $pdr->save();

        return redirect()->route('store.ordersListPage')->with('success', 'PDR updated successfully.');
    

    }


    //PRODUCTION PERSONNEL FUNCTIONS

    public function getPDRFormPageForProdP(pdr $pdr)
    {
        // dd($pdr);
        return view('prod.PDRFormPage', compact('pdr'));
    }

    public function updatePDRFormPageForProdP(Request $request, pdr $pdr){
    
        
        $request->validate([

            'orderID'               =>  'nullable',
            'partIDOrName'               =>  'nullable',
            'acceptedBy'            =>  'nullable',
            'approvedBy'            =>  'nullable',
            'buyerCode'             =>  'required',
            'DONoSales1'            =>  'nullable',
            'jobOrderDate'          =>  'nullable',
            'producedBy'            =>  'nullable',
           
        ]);

        // dd('hello');
        $pdr = pdr::find($request->hidden_id);

        $pdr->orderID = $request->orderID;
        $pdr->partIDOrName = $request->partIDOrName;
        $pdr->acceptedBy = $request->acceptedBy;
        $pdr->approvedBy = $request->approvedBy;
        $pdr->buyerCode = $request->buyerCode;
        $pdr->DONoSales1 = $request->DONoSales1;
        $pdr->jobOrderDate = $request->jobOrderDate;
        $pdr->producedBy = $request->producedBy;
      
        // dd('hellow');
        $pdr->save();

        return redirect()->route('prod.ordersListPage')->with('success', 'PDR updated successfully.');
    
    }

}


