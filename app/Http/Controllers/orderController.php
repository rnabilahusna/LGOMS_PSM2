<?php

namespace App\Http\Controllers;

use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class orderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = order::latest()->paginate(5);
        return view('sales.ordersListPage', compact('data'))->with('i', (request()->input('page',1)-1)*5);
        // $data = order::latest()->paginate(5);
        // return view('prod.ordersListPage', compact('data'))->with('i', (request()->input('page',1)-1)*5);
        // $data = order::latest()->paginate(5);
        // return view('store.ordersListPage', compact('data'))->with('i', (request()->input('page',1)-1)*5);
        // $data = order::latest()->paginate(5);
        // return view('qc.ordersListPage', compact('data'))->with('i', (request()->input('page',1)-1)*5);
         // $data = order::latest()->paginate(5);
        // return view('client.myOrdersListPage', compact('data'))->with('i', (request()->input('page',1)-1)*5);
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
    public function submitOrder(Request $request)
    {

        $request->validate([
            
            'PONo'              =>   'nullable',
            'actionCode'        =>   'required',
            'amount'            =>   'nullable',
            'comment'           =>   'nullable',
            'creationDate'      =>   'required',
            'currencyCode'      =>   'nullable',
            'deliveryDateETA'   =>   'nullable',
            'IssuedDate'        =>   'required',
            'lineNo'            =>   'nullable',
            'orderStatus'       =>   'nullable',
            'partDescription'   =>   'required',
            'partNo'            =>   'required',
            'paymentStatus'     =>   'required',
            'paymentTerm'       =>   'nullable',
            'placeOfDelivery'   =>   'nullable',
            'quantity'          =>   'nullable',
            'quantityPerPackageUOM' =>   'nullable',
            'QuotationNo'       =>   'nullable',
            'referenceDateETD'  =>   'nullable',
            'remark'            =>   'nullable',
            'RONo'              =>   'nullable',
            'salesUnitPriceBasisUOM'    =>   'nullable',
            'shippingMode'      =>   'nullable',
            'shippingTerm'      =>   'nullable',
            'termOfPayment'     =>   'nullable',
            'unitPrice'         =>   'nullable',
            'UOM'               =>   'nullable',
            'buyerCode'         =>   'required',
            'designID'          =>   'required',
        ]);

        // dd('hello');

        $order = new order;

        $order->PONo = $request->PONo;
        $order->actionCode = $request->actionCode;
        $order->amount = $request->amount;
        $order->comment = $request->comment;
        $order->creationDate = $request->creationDate;
        $order->currencyCode = $request->currencyCode;
        $order->deliveryDateETA = $request->deliveryDateETA;
        $order->IssuedDate = $request->IssuedDate;
        $order->lineNo = $request->lineNo;
        $order->orderStatus = $request->orderStatus;
        $order->partDescription = $request->partDescription;
        $order->partNo = $request->partNo;
        $order->paymentStatus = $request->paymentStatus;
        $order->paymentTerm = $request->paymentTerm;
        $order->placeOfDelivery = $request->placeOfDelivery;
        $order->quantity = $request->quantity;
        $order->quantityPerPackageUOM = $request->quantityPerPackageUOM;
        $order->QuotationNo = $request->QuotationNo;
        $order->referenceDateETD = $request->referenceDateETD;
        $order->remark = $request->remark;
        $order->RONo = $request->RONo;
        $order->salesUnitPriceBasisUOM = $request->salesUnitPriceBasisUOM;
        $order->shippingMode = $request->shippingMode;
        $order->shippingTerm = $request->shippingTerm;
        $order->termOfPayment = $request->termOfPayment;
        $order->unitPrice = $request->unitPrice;
        $order->UOM = $request->UOM;
        $order->buyerCode = $request->buyerCode;
        $order->designID = $request->designID;

        // dd('hellow');
        $order->save();

        return redirect()->route('client.myDesignsListPage')->with('success', 'Order submitted successfully.');
    
    }

    /**
     * Display the specified resource.
     */

    public function show(order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, order $order)
    {
        $request->validate([
            'orderStatus'          =>  'required'
        ]);

        $order = order::find($request->hidden_id);

        $order->orderStatus = $request->orderStatus;  

        $order->save();

        return redirect()->route('sales.ordersListPage')->with('success', 'Order status info has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(order $order)
    {
        //
    }


    //SALES PERSONNEL FUNCTIONS
    public function showForSalesP(order $order)
    {
        return view('sales.orderDetailsPage', compact('order'));
    }


    public function getSalesOrdersListPage()
    {
        $data = order::latest()->paginate(5);
        return view('sales.ordersListPage', compact('data'))->with('i', (request()->input('page',1)-1)*5);
    }

    public function updateOrderStatusInfo(Request $request, order $order)
    {
        $request->validate([
            'orderStatus'          =>  'required',
            'paymentStatus'          =>  'required'
        ]);

        $order = order::find($request->hidden_id);

        $order->orderStatus = $request->orderStatus; 
        $order->paymentStatus = $request->paymentStatus; 

        $order->save();

        return redirect()->route('sales.ordersListPage')->with('success', 'Order status info has been updated successfully');
    }

    public function getPDRFormPageForSalesP(order $order)
    {
        return view('sales.PDRFormPage', compact('order'));
    }


    //CLIENT FUNCTIONS
    public function showForClient(order $order)
    {
        return view('client.myOrderDetailsPage', compact('order'));
    }


    public function getClientOrdersListPage()
    {
        // $data = order::latest()->paginate(5);
        // return view('client.myOrdersListPage', compact('data'))->with('i', (request()->input('page',1)-1)*5);
        $data = order::where('buyerCode',Auth::user()->buyerCode)->where('orderStatus','!=', 'DELIVERED')->get();

        return view('client.myOrdersListPage', compact('data'));
    }

    public function getClientOrdersHistoryListPage()
    {
        // $data = order::latest()->paginate(5);
        // return view('client.myOrdersListPage', compact('data'))->with('i', (request()->input('page',1)-1)*5);
        $data = order::where('orderStatus','DELIVERED')->where('buyerCode',Auth::user()->buyerCode)->get();

        return view('client.orderHistoryPage', compact('data'));
    }

    public function updatePaymentInfo(Request $request, order $order)
    {
    
        $order = order::find($request->hidden_id);
       
        $order->paymentStatus = $request->paymentStatus; 

        if($request->hasFile('paymentProof'))
        {
            $destination = '/images' . $order->paymentProof;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $request->file('paymentProof');
            $extension = $file->getClientOriginalExtension();
            $filename = time(). '.' . $extension;
            $file->move('images/', $filename);
            $order->paymentProof = $filename;
        }

        $order->save();
        return redirect()->route('client.myOrdersListPage')->with('success', 'Order payment proof info has been sent successfully');

    }

    public function getReorderPage(order $order)
    {
        return view('client.reorderPage', compact('order'));
    }
    


 

    //PRODUCTION PERSONNEL FUNCTIONS
    public function showForProdP(order $order)
    {
        return view('prod.orderDetailsPage', compact('order'));
    }


    public function getProdOrdersListPage()
    {
        $data = order::latest()->paginate(5);
        return view('prod.ordersListPage', compact('data'))->with('i', (request()->input('page',1)-1)*5);
    }

    public function getPDRFormPageForProdP(order $order)
    {
        return view('prod.PDRFormPage', compact('order'));
    }


    //STORE PERSONNEL FUNCTIONS
    public function showForStoreP(order $order)
    {
        return view('store.orderDetailsPage', compact('order'));
    }


    public function getStoreOrdersListPage()
    {
        $data = order::latest()->paginate(5);
        return view('store.ordersListPage', compact('data'))->with('i', (request()->input('page',1)-1)*5);
    }

    public function getPDRFormPageForStoreP(order $order)
    {
        return view('store.PDRFormPage', compact('order'));
    }


    public function getJobOrderFormPageForStoreP(order $order)
    {
        return view('store.jobOrderFormPage', compact('order'));
    }


    //QC PERSONNEL FUNCTIONS
    public function showForQCP(order $order)
    {
        return view('qc.orderDetailsPage', compact('order'));
    }


    public function getQCOrdersListPage()
    {
        $data = order::latest()->paginate(5);
        return view('qc.ordersListPage', compact('data'))->with('i', (request()->input('page',1)-1)*5);
    }

    


}
