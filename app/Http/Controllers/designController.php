<?php

namespace App\Http\Controllers;

use App\Models\design;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class designController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = design::latest()->paginate(5);
        return view('client.myDesignsListPage', compact('data'))->with('i', (request()->input('page',1)-1)*5);
        // $data = design::latest()->paginate(5);
        // return view('sales.designsListPage', compact('data'))->with('i', (request()->input('page',1)-1)*5);
        // $data = design::latest()->paginate(5);
        // return view('prod.designsListPage', compact('data'))->with('i', (request()->input('page',1)-1)*5);
        // $data = design::latest()->paginate(5);
        // return view('store.designsListPage', compact('data'))->with('i', (request()->input('page',1)-1)*5);
        // $data = design::latest()->paginate(5);
        // return view('qc.designsListPage', compact('data'))->with('i', (request()->input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(design $design)
    {
        return view('edit', compact('design'));
    }


    /**
     * ONLY FOR PRODUCTION PERSONNEL
     */
    public function destroy(design $design)
    {
        $design->delete();

        return redirect()->route('prod.designsListPage')->with('success', 'Design deleted successfully');
    }



    //SALES PERSONNEL FUNCTIONS

    public function showForSalesP(design $design)
    {
        return view('sales.designDetailsPage', compact('design'));
    }


    public function getSalesDesignsListPage()
    {
        $data = design::latest()->paginate(5);
        return view('sales.designsListPage', compact('data'))->with('i', (request()->input('page',1)-1)*5);
    }




    //PRODUCTION PERSONNEL FUNCTIONS

    public function uploadDesign()
    {
        return view('prod.uploadDesignPage');
    }

    public function getProdDesignsListPage()
    {
        $data = design::latest()->paginate(5);
        return view('prod.designsListPage', compact('data'))->with('i', (request()->input('page',1)-1)*5);
    }

    public function showForProdP(design $design)
    {
        return view('prod.designDetailsPage', compact('design'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'designConfirmationStatus' =>  'required',
            'goodsStock'               =>  'nullable',   
            'noOfCavities'             =>  'nullable',
            'noOfEnvelope'             =>  'nullable',
            'noOfSheets'               =>  'nullable',
            'otherMaterials'           =>  'nullable',
            'partDescription'          =>  'nullable',
            'partDesign'               =>  'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=3000,max_height=3000',
            'partNo'                   =>  'required',
            'PEFilmApplied'            =>  'nullable',
            'POQty'                    =>  'nullable',
            'rawMaterialMain'          =>  'nullable',
            'size'                     =>  'nullable',
            'thickness'                =>  'nullable',
            'buyerCode'                =>  'required',
        ]);

        $file_name = time() . '.' . request()->partDesign->getClientOriginalExtension();
        request()->partDesign->move(public_path('images'), $file_name);

        $design = new design;

        $design->designConfirmationStatus = $request->designConfirmationStatus;
        $design->goodsStock = $request->goodsStock;
        $design->noOfCavities = $request->noOfCavities;
        $design->noOfEnvelope = $request->noOfEnvelope;
        $design->noOfSheets = $request->noOfSheets;
        $design->otherMaterials = $request->otherMaterials;
        $design->partDescription = $request->partDescription;
        $design->partDesign = $file_name;
        $design->partNo = $request->partNo;
        $design->PEFilmApplied = $request->PEFilmApplied;
        $design->POQty = $request->POQty;
        $design->rawMaterialMain = $request->rawMaterialMain;
        $design->size = $request->size;
        $design->thickness = $request->thickness;
        $design->buyerCode = $request->buyerCode;

        $design->save();

        return redirect()->route('prod.designsListPage')->with('success', 'New design added successfully.');
    }

    public function updateDesignInfo(Request $request, design $design)
    {
        

        $design = design::find($request->hidden_id);

        $design->designConfirmationStatus = $request->designConfirmationStatus;
        $design->noOfCavities = $request->noOfCavities;
        $design->noOfEnvelope = $request->noOfEnvelope;
        $design->noOfSheets = $request->noOfSheets;
        $design->otherMaterials = $request->otherMaterials;
        $design->partDescription = $request->partDescription;
        $design->partNo = $request->partNo;
        $design->PEFilmApplied = $request->PEFilmApplied;
        $design->rawMaterialMain = $request->rawMaterialMain;
        $design->size = $request->size;
        $design->thickness = $request->thickness;
        $design->buyerCode = $request->buyerCode;


        if($request->hasFile('partDesign'))
        {
            $destination = '/images' . $design->partDesign;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $request->file('partDesign');
            $extension = $file->getClientOriginalExtension();
            $filename = time(). '.' . $extension;
            $file->move('images/', $filename);
            $design->partDesign = $filename;
        }

        $design->save();

        return redirect()->route('prod.designsListPage')->with('success', 'Design info updated successfully.');
    }




    //STORE PERSONNEL FUNCTIONS

    public function showForStoreP(design $design)
    {
        return view('store.designDetailsPage', compact('design'));
    }

    public function updateGoodsStock(Request $request, design $design)
    {
        $request->validate([
            'goodsStock'          =>  'nullable'
        ]);

        $design = design::find($request->hidden_id);

        $design->goodsStock = $request->goodsStock;  

        $design->save();

        return redirect()->route('store.designsListPage')->with('success', 'Design goods stock has been updated successfully');
    }

    public function getStoreDesignsListPage()
    {
        $data = design::latest()->paginate(5);
        return view('store.designsListPage', compact('data'))->with('i', (request()->input('page',1)-1)*5);
    }



    //QC PERSONNEL FUNCTIONS
    public function showForQCP(design $design)
    {
        return view('qc.designDetailsPage', compact('design'));
    }


    public function getQCDesignsListPage()
    {
        $data = design::latest()->paginate(5);
        return view('qc.designsListPage', compact('data'))->with('i', (request()->input('page',1)-1)*5);
    }


    //CLIENT FUNCTIONS
    public function showForClient(design $design)
    {
        return view('client.myDesignDetailsPage', compact('design'));
    }

    public function updateMyDesignInfo(Request $request, design $design)
    {
        $request->validate([
            'designConfirmationStatus'          =>  'nullable'
        ]);

        $design = design::find($request->hidden_id);

        $design->designConfirmationStatus = $request->designConfirmationStatus;  

        $design->save();

        return redirect()->route('client.myDesignsListPage')->with('success', 'Thank you for the design confirmation!');
    }

    public function getClientDesignsListPage()
    {
        $data = design::latest()->paginate(5);
        return view('client.myDesignsListPage', compact('data'))->with('i', (request()->input('page',1)-1)*5);
    }


}
