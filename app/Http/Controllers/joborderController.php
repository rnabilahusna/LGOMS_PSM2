<?php

namespace App\Http\Controllers;

use App\Models\joborder;
use Illuminate\Http\Request;

class joborderController extends Controller
{
    
    public function index()
    {
        $data = order::latest()->paginate(5);
        return view('store.jobOrderFormPage', compact('data'));
    }

    //QC PERSONNEL FUNCTIONS
    //redirect to the created Job Order Form Page
    public function getJobOrderFormPageForQCP(joborder $joborder)
    {
        return view('qc.jobOrderFormPage', compact('joborder'));
    }

    //function to update the job order information as Quality Control personnel
    public function updateJobOrderFormPageForQCP(Request $request, joborder $joborder){
        //find the particular job order to update
        $joborder = joborder::with('getJO')->find($request->PDRID);
        joborder::where('PDRID', $joborder->PDRID)->delete();

        //get the data from the job order form
       $data = $request->all();
      //creates a new instance of the job order model
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

        //update the job order info entered
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
        //processes an array of data and creates multiple records in the joborder table         
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
        //processes an array of data and creates multiple records in the joborder table         
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
    //redirect to the created Job Order Form Page
    public function getJobOrderFormPageForStoreP(joborder $joborder) 
    {
        // get the job order that has the same id as PDR
        $joborder = joborder::with('getJO')->where('PDRID',$joborder->PDRID)->first();
        return view('store.updateJobOrderFormPage', compact('joborder'));
    }

   
    //function for Store personnel to create Job Order (JO)
    public function createJobOrderFormPageForStoreP(Request $request)
    {
        // get all the data entered 
        $data = $request->all();
        // validate all the data 
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

        //creates a new instance of the job order model.
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
        
        //save the data to the joborder table
        $joborder->save();

        //processes an array of data and creates multiple records in the joborder table         
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
                //store the data into joborder table
                joborder::create($data2);
            }
        }
        //processes an array of data and creates multiple records in the joborder table         
        if(count($data['AMDate'])>0){
            foreach($data['AMDate'] as $item=>$value){
                $data4 = array(
                    'JONo' => $data['JONo'],
                    'PDRID' => $data['PDRID'],
                    'AMDate' => $data['AMDate'][$item],
                    'AMQty' => $data['AMQty'][$item],
                );
                //store the data into joborder table
                joborder::create($data4);
            }
        }
        return redirect()->route('store.ordersListPage')->with('success', 'Job order created successfully.');
    }

    //function to update the job order information for Store personnel
    public function updateJobOrderFormPageForStoreP(Request $request, joborder $joborder){
        
        //find for the particular job order using hidden id
        $joborder = joborder::with('getJO')->find($request->PDRID);
        joborder::where('PDRID', $joborder->PDRID)->delete();

        //get the data entered by the Store personnel
       $data = $request->all();
        //creates a new instance of the job order model
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
        //update the job order info entered
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
                
        //processes an array of data and creates multiple records in the joborder table         
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
        //processes an array of data and creates multiple records in the joborder table         
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
   
    //redirect to the created Job Order Form Page 
    public function getJobOrderFormPageForProdP(joborder $joborder)
    {
        return view('prod.jobOrderFormPage', compact('joborder'));
    }

    //function to update the job order information as Production personnel
    public function updateJobOrderFormPageForProdP(Request $request, joborder $joborder){
       
        //find the particular job order using the hidden id
        $joborder = joborder::with('getJO')->find($request->PDRID);
        joborder::where('PDRID', $joborder->PDRID)->delete();

        //get all the data from the job order form page
       $data = $request->all();
      //creates a new instance of the job order model
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
        //update the job order info entered
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
        //processes an array of data and creates multiple records in the joborder table         
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
        //processes an array of data and creates multiple records in the joborder table         
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
