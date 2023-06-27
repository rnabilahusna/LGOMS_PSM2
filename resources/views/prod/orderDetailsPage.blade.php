<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/css/mydesignsliststyle.css" >
    <link rel="stylesheet" href="/css/navbarstyle.css" >
    <link rel="stylesheet" href="/css/stafforderdetailspagestyle.css" >
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>Order Details</title>
</head>
<body>


<div class="menu-container">
    <div class="menu">
        <div class="logo"><img src="/images/Lengkuas_Logo_1.svg" alt="LG Logo" style="width:180px;height:45px;"></div>

        <div class="links">
        <div class="home"><a href="{{ route('prod.mainWindow') }}" style="color:black; text-decoration:none">Home</a></div>
            <div class="appointment_list"><a href="{{ route('prod.RFQListPage') }}" style="text-decoration:none; color:black">RFQ List</a></div>
            <div class="order_list"><a href="{{ route('prod.ordersListPage') }}" style="color:black;text-decoration:none">Order List</a></div>
            <div class="design_list"><a href="{{ route('prod.designsListPage') }}" style="text-decoration:none; color:black">Design List</a></div>
        </div>

		@auth
       
	   <div class="dropdown">
		   <div class="profile-group">
			   <div class="profile-pic"><img  src="/images/profile_picture_default.png" alt="profile pic" style="width:45px;height:45px;"></div>
			   <div class="profile"><p class="dropbtn">{{ auth()->user()->name }}</p></div>
		   </div>

		   <div class="dropdown-content">
			   <a href="logout">Sign Out</a>
		   </div>


	   </div>

	   @endauth
        
    </div>
</div>

	@if($message = Session::get('success'))

	<div class="alert alert-success">
		{{ $message }}
	</div>

	@endif

<div class="card">

<div class="cardheader">
    <div class="row">
        <div class="col col-md-6" id="thetitle"><b>Order ID: {{ $order->PONo }}</b></div>
     
        <a href="{{ route('prod.ordersListPage') }}" class="btn btn-primary btn-sm float-end" id="requestbutton" style="width: 90px">
        <i class="fa fa-arrow-circle-left" style="font-size:25px;color:white"></i>
        </a>&nbsp&nbsp
        <a href="{{ route('pdr.getPDRFormPageForProdP', $order->id) }}" class="btn btn-primary btn-sm float-end" id="requestbutton" style="width:16%">View PDR</a>&nbsp
        <a href="{{ route('joborder.getJobOrderFormPageForProdP', $order->id) }}" class="btn btn-primary btn-sm float-end" id="requestbutton" style="width:15%">View JO</a>
    </div>
    </div>
</div>


<div class="cardbody">

    <div class="leftinfo">
        <div><img class="partDesignImage" src="{{ asset('images/' . $order->getDesign->partDesign) }}" width="275" /></div>
        
    </div>




    <div class="centerinfo">


        <div class="details PONo">
            <label><b>P/O No:&nbsp&nbsp </label>
                {{ $order->PONo }}</b>
        </div>
        <div class="details partNo">
            <label>Part No:&nbsp&nbsp </label>
                {{ $order->partNo }}
        </div>
        <div class="details partDescription">
            <label>Part Description:&nbsp&nbsp </label>
                {{ $order->partDescription }}
        </div>
        <div class="details orderStatus">
            <label>Order Status: &nbsp&nbsp </label>
                {{ $order->orderStatus }}
        </div>
        <div class="details currencyCode">
            <label>Currency Code:&nbsp&nbsp </label>
                {{ $order->currencyCode }}
        </div>
        <div class="details shippingMode">
            <label>Shipping Mode:&nbsp&nbsp </label>
                {{ $order->shippingMode }}
        </div>
        <div class="details placeofDelivery">
            <label>Place of Delivery:&nbsp&nbsp </label>
                {{ $order->placeofDelivery }}
        </div>
        <div class="details shippingTerm">
            <label>Shipping Term:&nbsp&nbsp </label>
                {{ $order->shippingTerm }}
        </div>
        
        <div class="details salesUnitPriceBasisUOM">
            <label>Sales Unit Price Basis (UOM):&nbsp&nbsp </label>
                {{ $order->salesUnitPriceBasisUOM }}
        </div>
        <div class="details quantityPerPackageUOM">
            <label>Quantity Per Package (UOM):&nbsp&nbsp </label>
                {{ $order->quantityPerPackageUOM }}
        </div>
        <div class="details unitPrice">
            <label>Unit Price:&nbsp&nbsp </label>
                {{ $order->unitPrice }}
        </div>
        
        <div class="details amount">
            <label>Amount:&nbsp&nbsp </label>
                {{ $order->amount }}
        </div>
    
    </div>


    <div class="rightinfo">

        <div class="details referenceDateETD">
            <label>Reference Date/ETA:&nbsp&nbsp </label>
                {{ $order->referenceDateETD }}
        </div>
        <div class="details createdDate">
            <label>Creation Date:&nbsp&nbsp </label>
                {{ $order->created_at }}
        </div>
        <div class="details IssuedDate">
            <label>Issued Date:&nbsp&nbsp </label>
                {{ $order->IssuedDate }}
        </div>
        <div class="details remark">
            <label>Remark:&nbsp&nbsp </label>
                {{ $order->remark }}
        </div>

        
        <div class="details paymentTerm">
            <label>Payment Term:&nbsp&nbsp </label>
                {{ $order->paymentTerm }}
        </div>

        
        <div class="details quantity">
            <label>Quantity:&nbsp&nbsp </label>
                {{ $order->quantity }}
        </div>
        <div class="details UOM">
            <label>UOM:&nbsp&nbsp </label>
                {{ $order->UOM }}
        </div>
        <div class="details deliveryDateETA">
            <label>Delivery Date/ETA:&nbsp&nbsp </label>
                {{ $order->deliveryDateETA }}
        </div>
        <div class="details RONo">
            <label>R/O No:&nbsp&nbsp </label>
                {{ $order->RONo }}
        </div>

        <div class="details amount">
            <label><b>Total Amount:&nbsp&nbsp &nbsp&nbsp </b></label>
          
        </div>
    </div>
</div>
</body>
</html>



