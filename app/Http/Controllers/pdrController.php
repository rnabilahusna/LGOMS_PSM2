<?php

namespace App\Http\Controllers;

use App\Models\pdr;
use Illuminate\Http\Request;

class pdrController extends Controller
{

    //SALES PERSONNEL FUNCTIONS

    //function for Sales personnel to create Product Delivery Report (PDR) 
    public function createPDRFormPageForSalesP(Request $request){

        //validate the data entered by the Sales personnel during
        //the creation process of the PDR
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

        
        //creates a new instance of the pdr model.
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

        // save data into pdr table
        $pdr->save();

        return redirect()->route('sales.ordersListPage')->with('success', 'PDR created successfully.');

    }

    //redirect the Sales personnel to the created PDR page 
    public function getPDRFormPageForSalesP(pdr $pdr)
    {
        return view('sales.updatePDRForm', compact('pdr'));
    }

    //function for Sales personnel to update the PDR form 
    public function updatePDRFormPageForSalesP(Request $request, pdr $pdr){
        $request->validate([

            //validate the data entered by Sales personnel
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

        //find the PDR to update by hidden id
        $pdr = pdr::find($request->hidden_id);

        //get data from the form page
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
      
        //save the data into the table pdr
        $pdr->save();

        return redirect()->route('sales.ordersListPage')->with('success', 'PDR updated successfully.');
    }


    //STORE PERSONNEL FUNCTIONS

    //redirect the Store personnel to the created PDR page 
    public function getPDRFormPageForStoreP(pdr $pdr)
    {
        return view('store.PDRFormPage', compact('pdr'));
    }

    //function for Store personnel to update the PDR form 
    public function updatePDRFormPageForStoreP(Request $request, pdr $pdr){
        
        //validate the data entered by the Store personnel
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
        //find the PDR to update by hidden id
        $pdr = pdr::find($request->hidden_id);
        //get data from the form page
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
      
        //save the data into the table pdr
        $pdr->save();

        return redirect()->route('store.ordersListPage')->with('success', 'PDR updated successfully.');
    }


    //PRODUCTION PERSONNEL FUNCTIONS

    //redirect the Production personnel to the created PDR page 
    public function getPDRFormPageForProdP(pdr $pdr)
    {
        return view('prod.PDRFormPage', compact('pdr'));
    }

    //function for Production personnel to update the PDR form
    public function updatePDRFormPageForProdP(Request $request, pdr $pdr){
    
        //validate the data entered by the Production personnel
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

        //find the PDR to update by hidden id
        $pdr = pdr::find($request->hidden_id);
        //get data from the form page
        $pdr->orderID = $request->orderID;
        $pdr->partIDOrName = $request->partIDOrName;
        $pdr->acceptedBy = $request->acceptedBy;
        $pdr->approvedBy = $request->approvedBy;
        $pdr->buyerCode = $request->buyerCode;
        $pdr->DONoSales1 = $request->DONoSales1;
        $pdr->jobOrderDate = $request->jobOrderDate;
        $pdr->producedBy = $request->producedBy;
      
        //save the data into the table pdr
        $pdr->save();

        return redirect()->route('prod.ordersListPage')->with('success', 'PDR updated successfully.');
    }
}


