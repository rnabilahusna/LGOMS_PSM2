<?php

namespace App\Http\Controllers;

use App\Models\design;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Events\QuotationSubmitted;
use App\Listeners\SendNewQuotationNotification;
use App\Notifications\NewQuotationNotification;
use App\Events\QuotationUpdated;
use App\Listeners\SendNewQuotationUpdateNotification;
use App\Notifications\NewQuotationUpdateNotification;
use Illuminate\Support\Facades\Notification;

class designController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = design::latest()->paginate(5);
        return view('client.myDesignsListPage', compact('data'))->with('i', (request()->input('page',1)-1)*5);
       
    }

    public function markNotification(Request $request)
    {
        auth()->user()
        ->unreadNotifications
        ->when($request->input('id'), function($query) use ($request){
            return $query->where('id', $request->input('id'));
        })
        ->markAsRead();

        return response()->noContent();
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


    public function getSalesDesignsListPage(Request $request)
    {
        if($request->has('search')){
            $data = design::latest()->where('designConfirmationStatus','ACCEPTED')->where('partNo','LIKE','%' .$request->search. '%')->orWhere('partDescription','LIKE','%' .$request->search. '%')->orWhere('buyerCode','LIKE','%' .$request->search. '%')->paginate(5);
        }
        else{
            $data = design::latest()->where('designConfirmationStatus','ACCEPTED')->paginate(5);
        }

        return view('sales.designsListPage', compact('data'))->with('i', (request()->input('page',1)-1)*5);
    }


    




    //PRODUCTION PERSONNEL FUNCTIONS

    // redirect to designs list page for Production personnel
    public function getProdDesignsListPage(Request $request)
    {
        //the search utility
        if($request->has('search')){
            $data = design::latest()->where('designConfirmationStatus','ACCEPTED')->where('partNo','LIKE','%' .$request->search. '%')->orWhere('partDescription','LIKE','%' .$request->search. '%')->orWhere('buyerCode','LIKE','%' .$request->search. '%')->paginate(5);
        }
        else{
            $data = design::latest()->where('designConfirmationStatus','ACCEPTED')->paginate(5);
        }
        //using bootstrap paginate, which will only display 5 design row per page
        return view('prod.designsListPage', compact('data'))->with('i', (request()->input('page',1)-1)*5);
    }

    //redirect to design details page for Production personnel
    public function showForProdP(design $design)
    {
        return view('prod.designDetailsPage', compact('design'));
    }


    //NEW PROD FUNCTIONS RFQ
    
    //redirect to RFQ list page
    public function getProdRFQListPage()
    {
        $data = design::latest()->where('designConfirmationStatus','PENDING')->paginate(5);
        return view('prod.RFQListPage', compact('data'))->with('i', (request()->input('page',1)-1)*5);
       
    }

    //function for Production personnel
    //to confirm the quoation status submitted by the client
    public function updateQuotationStatus(Request $request, design $design)
    {
        $request->validate([
            'designConfirmationStatus'          =>  'nullable'
        ]);

        $design = design::find($request->hidden_id);

        $design->designConfirmationStatus = $request->designConfirmationStatus;  

        $design->save();


        //notify the client that their design quotation has been confirmed (accepted / rejected)
        $clientUsers = User::where('buyerCode', $request->buyerCode)->get();
        Notification::send($clientUsers, new NewQuotationUpdateNotification($design));

        return redirect()->route('prod.RFQListPage')->with('success', 'Thank you for the design quotation confirmation!');
    }

    //redirect to RFQ details page for Production perosnnel
    public function getProdRFQDetailsPage(design $design){
        return view('prod.RFQDetailsPage', compact('design'));
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
        $design->unitPrice = $request->unitPrice;
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
    //view design detail page
    public function showForStoreP(design $design)
    {
        return view('store.designDetailsPage', compact('design'));
    }

    //function to update design goods stock
    public function updateGoodsStock(Request $request, design $design)
    {
        //validate the 'goodsStock' entered by the Store personnel
        $request->validate([
            'goodsStock'          =>  'nullable|numeric'
        ]);
        //find the particular design to update
        $design = design::find($request->hidden_id);

        $design->goodsStock = $request->goodsStock;  

        $design->save();

        return redirect()->route('store.designsListPage')->with('success', 'Design goods stock has been updated successfully');
    }

    public function getStoreDesignsListPage(Request $request)
    {
        if($request->has('search')){
            $data = design::latest()->where('designConfirmationStatus','ACCEPTED')->where('partNo','LIKE','%' .$request->search. '%')->orWhere('partDescription','LIKE','%' .$request->search. '%')->orWhere('buyerCode','LIKE','%' .$request->search. '%')->paginate(5);
        }
        else{
            $data = design::latest()->where('designConfirmationStatus','ACCEPTED')->paginate(5);
        }

        return view('store.designsListPage', compact('data'))->with('i', (request()->input('page',1)-1)*5);
    }



    //QC PERSONNEL FUNCTIONS
    public function showForQCP(design $design)
    {
        return view('qc.designDetailsPage', compact('design'));
    }


    public function getQCDesignsListPage(Request $request)
    {
        if($request->has('search')){
            $data = design::latest()->where('designConfirmationStatus','ACCEPTED')->where('partNo','LIKE','%' .$request->search. '%')->orWhere('partDescription','LIKE','%' .$request->search. '%')->orWhere('buyerCode','LIKE','%' .$request->search. '%')->paginate(5);
        }
        else{
            $data = design::latest()->where('designConfirmationStatus','ACCEPTED')->paginate(5);
        }

        return view('qc.designsListPage', compact('data'))->with('i', (request()->input('page',1)-1)*5);
    }


    //CLIENT FUNCTIONS

    //redirect to the design details page for client for a particular design
    public function showForClient(design $design)
    {
        return view('client.myDesignDetailsPage', compact('design'));
    }

    
    //get the designs list page for client user
    public function getClientDesignsListPage(Request $request)
    {
        //use search utility to find specific design
        if($request->has('search')){
            $data = design::latest()->where('designConfirmationStatus','ACCEPTED')->where('buyerCode',Auth::user()->buyerCode)->where('partNo','LIKE','%' .$request->search. '%')->orWhere('partDescription','LIKE','%' .$request->search. '%')->get();
        }
        else{
            $data = design::latest()->where('designConfirmationStatus','ACCEPTED')->where('buyerCode',Auth::user()->buyerCode)->get();
        }
        //return the design list page
        return view('client.myDesignsListPage', compact('data'));
    }

    //redirect to purchase order page with automated filled information
    public function getMakeOrderPage(design $design)
    {
        return view('client.makeOrderPage', compact('design'));
    }



    //NEW CLIENT RFQ

    //redirect to the RFQ form page
    public function getRFQFormPage() {
        return view('client.RFQFormPage');
    }

    //submit Request For Quotation Form by Client user
    public function submitRFQ(Request $request)
    {
        //validate the data entered by the client
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
            'unitPrice'                =>  'required',
            'buyerCode'                =>  'required',
        ]);

        //move the uploaded file (partDesign) into the images folder
        $file_name = time() . '.' . request()->partDesign->getClientOriginalExtension();
        request()->partDesign->move(public_path('images'), $file_name);

        //create new instances of design model
        $design = new design;
       
        //assign values into the design object
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
        $design->unitPrice = $request->unitPrice;
        $design->buyerCode = $request->buyerCode;
       
        $design->save();

        //Send the new quotation submission notification to the Production personnel
        $prodUsers = User::where('role', 'Production')->get();
        Notification::send($prodUsers, new NewQuotationNotification($design));

        return redirect()->route('client.myDesignsListPage')->with('success', 'RFQ submitted successfully.');
    }

}
