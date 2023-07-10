<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\User;
use App\Models\design;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Events\OrderSubmitted;
use App\Listeners\SendNewOrderNotification;
use App\Notifications\NewOrderNotification;

use App\Events\PaymentSubmitted;
use App\Notifications\NewPaymentNotification;
use App\Listeners\SendNewPaymentNotification;

use App\Events\PaymentUpdated;
use App\Notifications\NewPaymentUpdateNotification;
use App\Listeners\SendNewPaymentUpdateNotification;

use Illuminate\Support\Facades\Notification;



class orderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data = order::latest()->paginate(5);
        // return view('sales.ordersListPage', compact('data'))->with('i', (request()->input('page',1)-1)*5);
        $notifications = auth()->user()->unreadNotifications;
        return view('sales.mainWindow', compact('notifications'));
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


        $order->save();

        $salesUsers = User::where('role', 'Sales')->get();
        Notification::send($salesUsers, new NewOrderNotification($order));
        $storeUsers = User::where('role', 'Store')->get();
        Notification::send($storeUsers, new NewOrderNotification($order));
        $qcUsers = User::where('role', 'QC')->get();
        Notification::send($qcUsers, new NewOrderNotification($order));
        $prodUsers = User::where('role', 'Production')->get();
        Notification::send($prodUsers, new NewOrderNotification($order));

        
        $design = design::find($request->designID);

        $design->goodsStock = $request->goodsStock - $request->quantity;  

        $design->save();

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


    public function getSalesOrdersListPage(Request $request)
    {

        $query = order::query()->where('orderStatus', '!=', 'DELIVERED');

        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('PONo', 'LIKE', '%' . $request->search . '%')
                ->orWhere('buyerCode', 'LIKE', '%' . $request->search . '%')
                ->orWhere('partNo', 'LIKE', '%' . $request->search . '%')
                ->orWhere('partDescription', 'LIKE', '%' . $request->search . '%');
            });
        }

        $data = $query->orderBy('deliveryDateETA', 'ASC')->paginate(10);

        return view('sales.ordersListPage', compact('data'))->with('i', (request()->input('page', 1) - 1) * 10);
       
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

        //notify the client that their order payment proof status has been confirmed (accepted / rejected)
        $clientUsers = User::where('buyerCode', $request->buyerCode)->get();
        Notification::send($clientUsers, new NewPaymentUpdateNotification($order));

        return redirect()->route('sales.ordersListPage')->with('success', 'Order status info has been updated successfully');
    }

    public function getPDRFormPageForSalesP(order $order)
    {
        return view('sales.PDRFormPage', compact('order'));
    }

    public function viewPaymentProofForSales(order $order){
        return view('sales.viewPaymentProof', compact('order'));
    }
    

    public function getOrdersHistoryListPageForSales()
    {
        $data = order::where('orderStatus','DELIVERED')->latest()->paginate(5);

        return view('sales.orderHistoryPage', compact('data'));
    }







    //CLIENT FUNCTIONS
    public function showForClient(order $order)
    {
        return view('client.myOrderDetailsPage', compact('order'));
    }

    public function viewPaymentProof(order $order)
    {
        return view('client.viewPaymentProof', compact('order'));
    }


    public function getClientOrdersListPage(Request $request)
    {
        if($request->has('search')){
            $data = DB::table('order')->where('buyerCode',Auth::user()->buyerCode)->where('PONo','LIKE','%' .$request->search. '%')->orWhere('partNo','LIKE','%' .$request->search. '%')->orWhere('partDescription','LIKE','%' .$request->search. '%')->get();
        }
        else{
            $data = DB::table('order')->where('buyerCode',Auth::user()->buyerCode)->where('orderStatus','!=', 'DELIVERED')->get();
        }

        // $data = DB::table('order')->where('buyerCode',Auth::user()->buyerCode)->where('orderStatus','!=', 'DELIVERED')->get();
        // $data = order::where('buyerCode',Auth::user()->buyerCode)->where('orderStatus','!=', 'DELIVERED')->get();

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

        //notify the sales about the payment proof uploaded
        $salesUsers = User::where('role', 'Sales')->get();
        Notification::send($salesUsers, new NewPaymentNotification($order));

        return redirect()->route('client.myOrdersListPage')->with('success', 'Order payment proof info has been sent successfully');

    }

    public function getReorderPage(order $order)
    {
        return view('client.reorderPage', compact('order'));
    }

    public function viewInvoice(int $id)
    {
        $order = order::findOrFail($id);
        return view('client.invoice', compact('order'));
    }

    public function downloadInvoice(int $id)
    {
        $order = order::findOrFail($id);
        $data = ['order' => $order];
        $pdf = Pdf::loadView('client.invoice', $data);

        $todayDate = Carbon::now()->format('d-m-Y');
        return $pdf->download('LG-invoice'.$order->id.'-'.$todayDate.'.pdf');
    }
    


 

    //PRODUCTION PERSONNEL FUNCTIONS
    public function showForProdP(order $order)
    {
        return view('prod.orderDetailsPage', compact('order'));
    }


    public function getProdOrdersListPage(Request $request)
    {
        if($request->has('search')){
            $data = order::latest()->where('PONo','LIKE','%' .$request->search. '%')->orWhere('buyerCode','LIKE','%' .$request->search. '%')->orWhere('partNo','LIKE','%' .$request->search. '%')->orWhere('partDescription','LIKE','%' .$request->search. '%')->paginate(5);
        }
        else{
            $data = order::latest()->paginate(5);
        }

        return view('prod.ordersListPage', compact('data'))->with('i', (request()->input('page',1)-1)*5);
    }

    public function getPDRFormPageForProdP(order $order)
    {
        return view('prod.PDRFormPage', compact('order'));
    }

    public function getOrdersHistoryListPageForProd()
    {
        $data = order::where('orderStatus','DELIVERED')->latest()->paginate(5);

        return view('prod.orderHistoryPage', compact('data'));
    }






    //STORE PERSONNEL FUNCTIONS
    public function showForStoreP(order $order)
    {
        return view('store.orderDetailsPage', compact('order'));
    }


    public function getStoreOrdersListPage(Request $request)
    {
        if($request->has('search')){
            $data = order::latest()->where('PONo','LIKE','%' .$request->search. '%')->orWhere('buyerCode','LIKE','%' .$request->search. '%')->orWhere('partNo','LIKE','%' .$request->search. '%')->orWhere('partDescription','LIKE','%' .$request->search. '%')->paginate(5);
        }
        else{
            $data = order::latest()->paginate(5);
        }

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


    public function getOrdersHistoryListPageForStore()
    {
        $data = order::where('orderStatus','DELIVERED')->latest()->paginate(5);

        return view('store.orderHistoryPage', compact('data'));
    }






    //QC PERSONNEL FUNCTIONS
    public function showForQCP(order $order)
    {
        return view('qc.orderDetailsPage', compact('order'));
    }


    public function getQCOrdersListPage(Request $request)
    {
        if($request->has('search')){
            $data = order::latest()->where('PONo','LIKE','%' .$request->search. '%')->orWhere('buyerCode','LIKE','%' .$request->search. '%')->orWhere('partNo','LIKE','%' .$request->search. '%')->orWhere('partDescription','LIKE','%' .$request->search. '%')->paginate(5);
        }
        else{
            $data = order::latest()->paginate(5);
        }
        
        return view('qc.ordersListPage', compact('data'))->with('i', (request()->input('page',1)-1)*5);
    }

    public function getOrdersHistoryListPageForQC()
    {
        $data = order::where('orderStatus','DELIVERED')->latest()->paginate(5);

        return view('qc.orderHistoryPage', compact('data'));
    }

    


}
