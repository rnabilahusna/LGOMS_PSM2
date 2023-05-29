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
        return view('store.jobOrderFormPage', compact('data'));
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
        $joborder = joborder::with('getJO')->find($request->PDRID);
        // dd($request->all());

        joborder::where('PDRID', $joborder->PDRID)->delete();

       $data = $request->all();
      
       $joborder = new joborder;
       $joborder->id = $request->id;
       $joborder->JONo = $request->JONo;
       $joborder->PONo = $request->PONo;
       $joborder->buyerCode = $request->buyerCode;
       $joborder->designID = $request->designID;
       $joborder->orderID = $request->orderID;
       $joborder->PDRID = $request->PDRID;
       $joborder->AuthorisedBy = $request->AuthorisedBy;
       $joborder->AuthorisedDate = $request->AuthorisedDate;
       $joborder->filmAvailable = $request->filmAvailable;
       $joborder->IssuedBy = $request->IssuedBy;
       $joborder->IssuedDate = $request->IssuedDate;
       $joborder->jobEndDate = $request->jobEndDate;
       $joborder->JODate = $request->JODate;
       $joborder->jobStartDate = $request->jobStartDate;
       $joborder->JODate = $request->JODate;
       $joborder->noOfCavities = $request->noOfCavities;
       $joborder->noOfEnvelope = $request->noOfEnvelope;
       $joborder->noOfSheets = $request->noOfSheets;
       $joborder->otherMaterials = $request->otherMaterials;
       $joborder->adhesiveApplied = $request->adhesiveApplied;
       $joborder->PEFilmApplied = $request->PEFilmApplied;
       $joborder->POQuantity = $request->POQuantity;
       $joborder->partDescription = $request->partDescription;
       $joborder->partNo = $request->partNo;
       $joborder->POReceivedDate = $request->POReceivedDate;
       $joborder->producedQty = $request->producedQty;
       $joborder->productJOQuantity = $request->productJOQuantity;
       $joborder->productReadyDate = $request->productReadyDate;
       $joborder->rawMaterialApproved = $request->rawMaterialApproved;
       $joborder->rawMaterialMain = $request->rawMaterialMain;
       $joborder->rejectedQty = $request->rejectedQty;
       $joborder->sampleAvailable = $request->sampleAvailable;
       $joborder->size = $request->size;
       $joborder->stock = $request->stock;
       $joborder->stockUpdatedDate = $request->stockUpdatedDate;
       $joborder->stockUpdatedQty = $request->stockUpdatedQty;
       $joborder->thickness = $request->thickness;

        $joborder->save();

        $joborder->update([
            'id' => $data['id'],
            'JONo' => $data['JONo'],
            'PONo' => $data['PONo'],
            'buyerCode' => $data['buyerCode'],
            'designID' => $data['designID'],
            'orderID' => $data['orderID'],
            'PDRID' => $data['PDRID'],
            'AuthorisedBy' => $data['AuthorisedBy'],
            'AuthorisedDate' => $data['AuthorisedDate'],
            'filmAvailable' => $data['filmAvailable'],
            'IssuedBy' => $data['IssuedBy'],
            'IssuedDate' => $data['IssuedDate'],
            'jobEndDate' => $data['jobEndDate'],
            'JODate' => $data['JODate'],
            'jobStartDate' => $data['jobStartDate'],
            'JODate' => $data['JODate'],
            'noOfCavities' => $data['noOfCavities'],
            'noOfEnvelope' => $data['noOfEnvelope'],
            'noOfSheets' => $data['noOfSheets'],
            'otherMaterials' => $data['otherMaterials'],
            'adhesiveApplied' => $data['adhesiveApplied'],
            'PEFilmApplied' => $data['PEFilmApplied'],
            'POQuantity' => $data['POQuantity'],
            'partDescription' => $data['partDescription'],
            'partNo' => $data['partNo'],
            'POReceivedDate' => $data['POReceivedDate'],
            'producedQty' => $data['producedQty'],
            'productJOQuantity' => $data['productJOQuantity'],
            'productReadyDate' => $data['productReadyDate'],
            'rawMaterialApproved' => $data['rawMaterialApproved'],
            'rawMaterialMain' => $data['rawMaterialMain'],
            'rejectedQty' => $data['rejectedQty'],
            'sampleAvailable' => $data['sampleAvailable'],
            'size' => $data['size'],
            'stock' => $data['stock'],
            'stockUpdatedDate' => $data['stockUpdatedDate'],
            'stockUpdatedQty' => $data['stockUpdatedQty'],
            'thickness' => $data['thickness']
        ]);
        
        if(count($data['no']) > 0){
            foreach($data['no'] as $item => $value){
                $data2 = array(
                    'JONo' => $data['JONo'],
                    'PDRID' => $data['PDRID'],
                    'no' => $data['no'][$item],
                    'dateIn' => $data['dateIn'][$item],
                    'qtyIn' => $data['qtyIn'][$item],
                    'processesCarriedOut' => $data['processesCarriedOut'][$item],
                    'dateOut' => $data['dateOut'][$item],
                    'output' => $data['output'][$item],
                    'otyNoGood' => $data['otyNoGood'][$item],
                    'balance' => $data['balance'][$item],
                    'operatorName' => $data['operatorName'][$item],
                    'operatorSign' => $data['operatorSign'][$item],
                );
                joborder::create($data2);
            }
        }

        if(count($data['AMDate'])>0){
            foreach($data['AMDate'] as $item=>$value){
                $data4 = array(
                    'JONo' => $data['JONo'],
                    'PDRID' => $data['PDRID'],
                    'AMDate' => $data['AMDate'][$item],
                    'AMQty' => $data['AMQty'][$item],
                );
                joborder::create($data4);
            }
        }


        return redirect()->route('qc.ordersListPage')->with('success', 'Job order created successfully.');
    }



    //STORE PERSONNEL FUNCTIONS
    public function getJobOrderFormPageForStoreP(joborder $joborder) 
    {
        $joborder = joborder::with('getJO')->where('PDRID',$joborder->PDRID)->first();
        // dd($joborder);
        return view('store.updateJobOrderFormPage', compact('joborder'));
    }

   

    public function createJobOrderFormPageForStoreP(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $request->validate([
            'id'                        =>  'required',
            'JONo'                      =>  'nullable',
            'PONo'                      =>  'nullable',
            'buyerCode'                 =>  'nullable',
            'designID'                  =>  'nullable',
            'orderID'                   =>  'nullable',
            'PDRID'                     =>  'nullable',
            'AMDate'                    =>  'nullable',
            'AMQty'                     =>  'nullable',
            'AuthorisedBy'              =>  'nullable',
            'AuthorisedDate'            =>  'nullable',
            'balance'                   =>  'nullable',
            'dateIn'                    =>  'nullable',
            'dateOut'                   =>  'nullable',
            'filmAvailable'             =>  'nullable',
            'IssuedBy'                  =>  'nullable',
            'IssuedDate'                =>  'nullable',
            'jobEndDate'                =>  'nullable',
            'JODate'                    =>  'nullable',
            'jobStartDate'              =>  'nullable',
            'JODate'                    =>  'nullable',
            'no'                        =>  'nullable',
            'noOfCavities'              =>  'nullable',
            'noOfEnvelope'              =>  'nullable',
            'noOfSheets'                =>  'nullable',
            'otherMaterials'            =>  'nullable',
            'adhesiveApplied'           =>  'nullable',
            'PEFilmApplied'             =>  'nullable',
            'POQuantity'                =>  'nullable',
            'operatorName'              =>  'nullable',
            'operatorSign'              =>  'nullable',
            'output'                    =>  'nullable',
            'otyNoGood'                 =>  'nullable',
            'partDescription'           =>  'nullable',
            'partNo'                    =>  'nullable',
            'POReceivedDate'            =>  'nullable',
            'processesCarriedOut'       =>  'nullable',
            'producedQty'               =>  'nullable',
            'productJOQuantity'         =>  'nullable',
            'productReadyDate'          =>  'nullable',
            'qtyIn'                     =>  'nullable',
            'rawMaterialApproved'       =>  'nullable',
            'rawMaterialMain'           =>  'nullable',
            'rejectedQty'               =>  'nullable',
            'sampleAvailable'           =>  'nullable',
            'size'                      =>  'nullable',
            'stock'                     =>  'nullable',
            'stockUpdatedDate'          =>  'nullable',
            'stockUpdatedQty'           =>  'nullable',
            'thickness'                 =>  'nullable'
        ]);


        $joborder = new joborder;
        $joborder->id = $request->id;
        $joborder->JONo = $request->JONo;
        $joborder->PONo = $request->PONo;
        $joborder->buyerCode = $request->buyerCode;
        $joborder->designID = $request->designID;
        $joborder->orderID = $request->orderID;
        $joborder->PDRID = $request->PDRID;
        $joborder->AuthorisedBy = $request->AuthorisedBy;
        $joborder->AuthorisedDate = $request->AuthorisedDate;
        $joborder->filmAvailable = $request->filmAvailable;
        $joborder->IssuedBy = $request->IssuedBy;
        $joborder->IssuedDate = $request->IssuedDate;
        $joborder->jobEndDate = $request->jobEndDate;
        $joborder->JODate = $request->JODate;
        $joborder->jobStartDate = $request->jobStartDate;
        $joborder->JODate = $request->JODate;
        $joborder->noOfCavities = $request->noOfCavities;
        $joborder->noOfEnvelope = $request->noOfEnvelope;
        $joborder->noOfSheets = $request->noOfSheets;
        $joborder->otherMaterials = $request->otherMaterials;
        $joborder->adhesiveApplied = $request->adhesiveApplied;
        $joborder->PEFilmApplied = $request->PEFilmApplied;
        $joborder->POQuantity = $request->POQuantity;
        $joborder->partDescription = $request->partDescription;
        $joborder->partNo = $request->partNo;
        $joborder->POReceivedDate = $request->POReceivedDate;
        $joborder->producedQty = $request->producedQty;
        $joborder->productJOQuantity = $request->productJOQuantity;
        $joborder->productReadyDate = $request->productReadyDate;
        $joborder->rawMaterialApproved = $request->rawMaterialApproved;
        $joborder->rawMaterialMain = $request->rawMaterialMain;
        $joborder->rejectedQty = $request->rejectedQty;
        $joborder->sampleAvailable = $request->sampleAvailable;
        $joborder->size = $request->size;
        $joborder->stock = $request->stock;
        $joborder->stockUpdatedDate = $request->stockUpdatedDate;
        $joborder->stockUpdatedQty = $request->stockUpdatedQty;
        $joborder->thickness = $request->thickness;
        
        
        $joborder->save();

        if(count($data['no']) > 0){
            foreach($data['no'] as $item => $value){
                $data2 = array(
                    'JONo' => $data['JONo'],
                    'PDRID' => $data['PDRID'],
                    'no' => $data['no'][$item],
                    'dateIn' => $data['dateIn'][$item],
                    'qtyIn' => $data['qtyIn'][$item],
                    'processesCarriedOut' => $data['processesCarriedOut'][$item],
                    'dateOut' => $data['dateOut'][$item],
                    'output' => $data['output'][$item],
                    'otyNoGood' => $data['otyNoGood'][$item],
                    'balance' => $data['balance'][$item],
                    'operatorName' => $data['operatorName'][$item],
                    'operatorSign' => $data['operatorSign'][$item],
                );
                joborder::create($data2);
            }
        }

        if(count($data['AMDate'])>0){
            foreach($data['AMDate'] as $item=>$value){
                $data4 = array(
                    'JONo' => $data['JONo'],
                    'PDRID' => $data['PDRID'],
                    'AMDate' => $data['AMDate'][$item],
                    'AMQty' => $data['AMQty'][$item],
                );
                joborder::create($data4);
            }
        }

       

        return redirect()->route('store.ordersListPage')->with('success', 'Job order created successfully.');

    }

    public function updateJobOrderFormPageForStoreP(Request $request, joborder $joborder){
        
        
        $joborder = joborder::with('getJO')->find($request->PDRID);
        // dd($request->all());

        joborder::where('PDRID', $joborder->PDRID)->delete();

       $data = $request->all();
      
       $joborder = new joborder;
       $joborder->id = $request->id;
       $joborder->JONo = $request->JONo;
       $joborder->PONo = $request->PONo;
       $joborder->buyerCode = $request->buyerCode;
       $joborder->designID = $request->designID;
       $joborder->orderID = $request->orderID;
       $joborder->PDRID = $request->PDRID;
       $joborder->AuthorisedBy = $request->AuthorisedBy;
       $joborder->AuthorisedDate = $request->AuthorisedDate;
       $joborder->filmAvailable = $request->filmAvailable;
       $joborder->IssuedBy = $request->IssuedBy;
       $joborder->IssuedDate = $request->IssuedDate;
       $joborder->jobEndDate = $request->jobEndDate;
       $joborder->JODate = $request->JODate;
       $joborder->jobStartDate = $request->jobStartDate;
       $joborder->JODate = $request->JODate;
       $joborder->noOfCavities = $request->noOfCavities;
       $joborder->noOfEnvelope = $request->noOfEnvelope;
       $joborder->noOfSheets = $request->noOfSheets;
       $joborder->otherMaterials = $request->otherMaterials;
       $joborder->adhesiveApplied = $request->adhesiveApplied;
       $joborder->PEFilmApplied = $request->PEFilmApplied;
       $joborder->POQuantity = $request->POQuantity;
       $joborder->partDescription = $request->partDescription;
       $joborder->partNo = $request->partNo;
       $joborder->POReceivedDate = $request->POReceivedDate;
       $joborder->producedQty = $request->producedQty;
       $joborder->productJOQuantity = $request->productJOQuantity;
       $joborder->productReadyDate = $request->productReadyDate;
       $joborder->rawMaterialApproved = $request->rawMaterialApproved;
       $joborder->rawMaterialMain = $request->rawMaterialMain;
       $joborder->rejectedQty = $request->rejectedQty;
       $joborder->sampleAvailable = $request->sampleAvailable;
       $joborder->size = $request->size;
       $joborder->stock = $request->stock;
       $joborder->stockUpdatedDate = $request->stockUpdatedDate;
       $joborder->stockUpdatedQty = $request->stockUpdatedQty;
       $joborder->thickness = $request->thickness;

        $joborder->save();

        $joborder->update([
            'id' => $data['id'],
            'JONo' => $data['JONo'],
            'PONo' => $data['PONo'],
            'buyerCode' => $data['buyerCode'],
            'designID' => $data['designID'],
            'orderID' => $data['orderID'],
            'PDRID' => $data['PDRID'],
            'AuthorisedBy' => $data['AuthorisedBy'],
            'AuthorisedDate' => $data['AuthorisedDate'],
            'filmAvailable' => $data['filmAvailable'],
            'IssuedBy' => $data['IssuedBy'],
            'IssuedDate' => $data['IssuedDate'],
            'jobEndDate' => $data['jobEndDate'],
            'JODate' => $data['JODate'],
            'jobStartDate' => $data['jobStartDate'],
            'JODate' => $data['JODate'],
            'noOfCavities' => $data['noOfCavities'],
            'noOfEnvelope' => $data['noOfEnvelope'],
            'noOfSheets' => $data['noOfSheets'],
            'otherMaterials' => $data['otherMaterials'],
            'adhesiveApplied' => $data['adhesiveApplied'],
            'PEFilmApplied' => $data['PEFilmApplied'],
            'POQuantity' => $data['POQuantity'],
            'partDescription' => $data['partDescription'],
            'partNo' => $data['partNo'],
            'POReceivedDate' => $data['POReceivedDate'],
            'producedQty' => $data['producedQty'],
            'productJOQuantity' => $data['productJOQuantity'],
            'productReadyDate' => $data['productReadyDate'],
            'rawMaterialApproved' => $data['rawMaterialApproved'],
            'rawMaterialMain' => $data['rawMaterialMain'],
            'rejectedQty' => $data['rejectedQty'],
            'sampleAvailable' => $data['sampleAvailable'],
            'size' => $data['size'],
            'stock' => $data['stock'],
            'stockUpdatedDate' => $data['stockUpdatedDate'],
            'stockUpdatedQty' => $data['stockUpdatedQty'],
            'thickness' => $data['thickness']
        ]);
        
        if(count($data['no']) > 0){
            foreach($data['no'] as $item => $value){
                $data2 = array(
                    'JONo' => $data['JONo'],
                    'PDRID' => $data['PDRID'],
                    'no' => $data['no'][$item],
                    'dateIn' => $data['dateIn'][$item],
                    'qtyIn' => $data['qtyIn'][$item],
                    'processesCarriedOut' => $data['processesCarriedOut'][$item],
                    'dateOut' => $data['dateOut'][$item],
                    'output' => $data['output'][$item],
                    'otyNoGood' => $data['otyNoGood'][$item],
                    'balance' => $data['balance'][$item],
                    'operatorName' => $data['operatorName'][$item],
                    'operatorSign' => $data['operatorSign'][$item],
                );
                joborder::create($data2);
            }
        }

        if(count($data['AMDate'])>0){
            foreach($data['AMDate'] as $item=>$value){
                $data4 = array(
                    'JONo' => $data['JONo'],
                    'PDRID' => $data['PDRID'],
                    'AMDate' => $data['AMDate'][$item],
                    'AMQty' => $data['AMQty'][$item],
                );
                joborder::create($data4);
            }
        }


        

        return redirect()->route('store.ordersListPage')->with('success', 'Job order updated successfully.');

    }


    //PRODUCTION PERSONNEL FUNCTIONS
   

    public function getJobOrderFormPageForProdP(joborder $joborder)
    {
        return view('prod.jobOrderFormPage', compact('joborder'));
    }

    public function updateJobOrderFormPageForProdP(Request $request, joborder $joborder){
        $joborder = joborder::with('getJO')->find($request->PDRID);
        // dd($request->all());

        joborder::where('PDRID', $joborder->PDRID)->delete();

       $data = $request->all();
      
       $joborder = new joborder;
       $joborder->id = $request->id;
       $joborder->JONo = $request->JONo;
       $joborder->PONo = $request->PONo;
       $joborder->buyerCode = $request->buyerCode;
       $joborder->designID = $request->designID;
       $joborder->orderID = $request->orderID;
       $joborder->PDRID = $request->PDRID;
       $joborder->AuthorisedBy = $request->AuthorisedBy;
       $joborder->AuthorisedDate = $request->AuthorisedDate;
       $joborder->filmAvailable = $request->filmAvailable;
       $joborder->IssuedBy = $request->IssuedBy;
       $joborder->IssuedDate = $request->IssuedDate;
       $joborder->jobEndDate = $request->jobEndDate;
       $joborder->JODate = $request->JODate;
       $joborder->jobStartDate = $request->jobStartDate;
       $joborder->JODate = $request->JODate;
       $joborder->noOfCavities = $request->noOfCavities;
       $joborder->noOfEnvelope = $request->noOfEnvelope;
       $joborder->noOfSheets = $request->noOfSheets;
       $joborder->otherMaterials = $request->otherMaterials;
       $joborder->adhesiveApplied = $request->adhesiveApplied;
       $joborder->PEFilmApplied = $request->PEFilmApplied;
       $joborder->POQuantity = $request->POQuantity;
       $joborder->partDescription = $request->partDescription;
       $joborder->partNo = $request->partNo;
       $joborder->POReceivedDate = $request->POReceivedDate;
       $joborder->producedQty = $request->producedQty;
       $joborder->productJOQuantity = $request->productJOQuantity;
       $joborder->productReadyDate = $request->productReadyDate;
       $joborder->rawMaterialApproved = $request->rawMaterialApproved;
       $joborder->rawMaterialMain = $request->rawMaterialMain;
       $joborder->rejectedQty = $request->rejectedQty;
       $joborder->sampleAvailable = $request->sampleAvailable;
       $joborder->size = $request->size;
       $joborder->stock = $request->stock;
       $joborder->stockUpdatedDate = $request->stockUpdatedDate;
       $joborder->stockUpdatedQty = $request->stockUpdatedQty;
       $joborder->thickness = $request->thickness;

        $joborder->save();

        $joborder->update([
            'id' => $data['id'],
            'JONo' => $data['JONo'],
            'PONo' => $data['PONo'],
            'buyerCode' => $data['buyerCode'],
            'designID' => $data['designID'],
            'orderID' => $data['orderID'],
            'PDRID' => $data['PDRID'],
            'AuthorisedBy' => $data['AuthorisedBy'],
            'AuthorisedDate' => $data['AuthorisedDate'],
            'filmAvailable' => $data['filmAvailable'],
            'IssuedBy' => $data['IssuedBy'],
            'IssuedDate' => $data['IssuedDate'],
            'jobEndDate' => $data['jobEndDate'],
            'JODate' => $data['JODate'],
            'jobStartDate' => $data['jobStartDate'],
            'JODate' => $data['JODate'],
            'noOfCavities' => $data['noOfCavities'],
            'noOfEnvelope' => $data['noOfEnvelope'],
            'noOfSheets' => $data['noOfSheets'],
            'otherMaterials' => $data['otherMaterials'],
            'adhesiveApplied' => $data['adhesiveApplied'],
            'PEFilmApplied' => $data['PEFilmApplied'],
            'POQuantity' => $data['POQuantity'],
            'partDescription' => $data['partDescription'],
            'partNo' => $data['partNo'],
            'POReceivedDate' => $data['POReceivedDate'],
            'producedQty' => $data['producedQty'],
            'productJOQuantity' => $data['productJOQuantity'],
            'productReadyDate' => $data['productReadyDate'],
            'rawMaterialApproved' => $data['rawMaterialApproved'],
            'rawMaterialMain' => $data['rawMaterialMain'],
            'rejectedQty' => $data['rejectedQty'],
            'sampleAvailable' => $data['sampleAvailable'],
            'size' => $data['size'],
            'stock' => $data['stock'],
            'stockUpdatedDate' => $data['stockUpdatedDate'],
            'stockUpdatedQty' => $data['stockUpdatedQty'],
            'thickness' => $data['thickness']
        ]);
        
        if(count($data['no']) > 0){
            foreach($data['no'] as $item => $value){
                $data2 = array(
                    'JONo' => $data['JONo'],
                    'PDRID' => $data['PDRID'],
                    'no' => $data['no'][$item],
                    'dateIn' => $data['dateIn'][$item],
                    'qtyIn' => $data['qtyIn'][$item],
                    'processesCarriedOut' => $data['processesCarriedOut'][$item],
                    'dateOut' => $data['dateOut'][$item],
                    'output' => $data['output'][$item],
                    'otyNoGood' => $data['otyNoGood'][$item],
                    'balance' => $data['balance'][$item],
                    'operatorName' => $data['operatorName'][$item],
                    'operatorSign' => $data['operatorSign'][$item],
                );
                joborder::create($data2);
            }
        }

        if(count($data['AMDate'])>0){
            foreach($data['AMDate'] as $item=>$value){
                $data4 = array(
                    'JONo' => $data['JONo'],
                    'PDRID' => $data['PDRID'],
                    'AMDate' => $data['AMDate'][$item],
                    'AMQty' => $data['AMQty'][$item],
                );
                joborder::create($data4);
            }
        }


        return redirect()->route('prod.ordersListPage')->with('success', 'Job order created successfully.');
    }



}
