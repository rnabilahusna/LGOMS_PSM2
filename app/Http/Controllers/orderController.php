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

     //client submit order of their design function
    public function submitOrder(Request $request)
    {
        //validate the data entered in the order page
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

       //creates a new instance of the order model
        $order = new order;
        //get all the data
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

        //send notification to the role should receive about the new order 
        $salesUsers = User::where('role', 'Sales')->get();
        Notification::send($salesUsers, new NewOrderNotification($order));
        $storeUsers = User::where('role', 'Store')->get();
        Notification::send($storeUsers, new NewOrderNotification($order));
        $qcUsers = User::where('role', 'QC')->get();
        Notification::send($qcUsers, new NewOrderNotification($order));
        $prodUsers = User::where('role', 'Production')->get();
        Notification::send($prodUsers, new NewOrderNotification($order));

        //get the design to update the balance goods stock
        $design = design::find($request->designID);
        //update the goods stock
        $design->goodsStock = $request->goodsStock - $request->quantity;  

        $design->save();

        return redirect()->route('client.myDesignsListPage')->with('success', 'Order submitted successfully.');
    
    }

    

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

   


    //SALES PERSONNEL FUNCTIONS

    //details page about the design for Sales personnel view
    public function showForSalesP(order $order)
    {
        return view('sales.orderDetailsPage', compact('order'));
    }

    //redirect to orders list page for Sales view
    public function getSalesOrdersListPage(Request $request)
    {
        //return all the order that the orderStatus is not yet DELIVERED, which
        //is the order is still active
        $query = order::query()->where('orderStatus', '!=', 'DELIVERED');

        //the search utility
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

    //to update the client's order status for the client's view
    public function updateOrderStatusInfo(Request $request, order $order)
    {
        //validate data entered
        $request->validate([
            'orderStatus'          =>  'required',
            'paymentStatus'          =>  'required'
        ]);

        //find the particular order to update the status by hidden id
        $order = order::find($request->hidden_id);

        $order->orderStatus = $request->orderStatus; 
        $order->paymentStatus = $request->paymentStatus; 

        $order->save();

        //notify the client that their order payment proof status has been confirmed (accepted / rejected)
        $clientUsers = User::where('buyerCode', $request->buyerCode)->get();
        Notification::send($clientUsers, new NewPaymentUpdateNotification($order));

        return redirect()->route('sales.ordersListPage')->with('success', 'Order status info has been updated successfully');
    }

    //redirect to PDR form page compact with order data for Sales personnel
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
    //details page about the design for Client  view
    public function showForClient(order $order)
    {
        return view('client.myOrderDetailsPage', compact('order'));
    }

    public function viewPaymentProof(order $order)
    {
        return view('client.viewPaymentProof', compact('order'));
    }

    //redirect to the orders list page that are still active
    public function getClientOrdersListPage(Request $request)
    {
        //the search utility
        if($request->has('search')){
            $data = DB::table('order')->where('buyerCode',Auth::user()->buyerCode)->where('PONo','LIKE','%' .$request->search. '%')->orWhere('partNo','LIKE','%' .$request->search. '%')->orWhere('partDescription','LIKE','%' .$request->search. '%')->get();
        }
        else{
            $data = DB::table('order')->where('buyerCode',Auth::user()->buyerCode)->where('orderStatus','!=', 'DELIVERED')->get();
        }
        return view('client.myOrdersListPage', compact('data'));
    }

    public function getClientOrdersHistoryListPage()
    {
        // $data = order::latest()->paginate(5);
        // return view('client.myOrdersListPage', compact('data'))->with('i', (request()->input('page',1)-1)*5);
        $data = order::where('orderStatus','DELIVERED')->where('buyerCode',Auth::user()->buyerCode)->get();

        return view('client.orderHistoryPage', compact('data'));
    }

    //submit payment proof function for client user
    public function updatePaymentInfo(Request $request, order $order)
    {
        //find the order by hidden id
        $order = order::find($request->hidden_id);
       //update the payment proof file
        $order->paymentStatus = $request->paymentStatus; 
        //delete if the payment proof exist in db, replace new proof
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
    //redirect to the order details page for Store personnel
    public function showForStoreP(order $order)
    {
        return view('store.orderDetailsPage', compact('order'));
    }

    //redirect to the order list page for Store personnel
    public function getStoreOrdersListPage(Request $request)
    {
        //the search utility
        if($request->has('search')){
            $data = order::latest()->where('PONo','LIKE','%' .$request->search. '%')->orWhere('buyerCode','LIKE','%' .$request->search. '%')->orWhere('partNo','LIKE','%' .$request->search. '%')->orWhere('partDescription','LIKE','%' .$request->search. '%')->paginate(5);
        }
        else{
            $data = order::latest()->paginate(5);
        }
        //using bootstrap to display the order list table with 5 rows for each page
        return view('store.ordersListPage', compact('data'))->with('i', (request()->input('page',1)-1)*5);
    }

    public function getPDRFormPageForStoreP(order $order)
    {
        return view('store.PDRFormPage', compact('order'));
    }

    //redirect to job order form page compact with order data for Store personnel
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
