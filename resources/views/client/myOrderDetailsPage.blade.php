<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/css/mydesignsliststyle.css" >
	<link rel="stylesheet" href="/css/orderdetailspagestyle.css" >
    <link rel="stylesheet" href="/css/navbarstyle.css" >
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>My Orders Details Page</title>
</head>
<body>
<div class="menu-container">
		<div class="menu">
			<div class="logo"><img src="/images/Lengkuas_Logo_1.svg" alt="LG Logo" style="width:180px;height:45px;"></div>

			<div class="links">
            <div class="home"><a href="{{ route('client.mainWindow') }}" style="color:black; text-decoration:none">Home</a></div>
                <div class="my_designs"><a href="{{ route('client.myDesignsListPage') }}" style="color:black; text-decoration:none">My Designs</a></div>
				<div class="my_orders"><a href="{{ route('client.myOrdersListPage') }}" style="color:black; text-decoration:none">My Orders</a></div>
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

<!-- display returned message from the controller if success -->
	@if($message = Session::get('success'))

	<div class="alert alert-success">
		{{ $message }}
	</div>

	@endif

	<div class="card">
		<div class="cardheader">
			<div class="row">
				<div class="col col-md-6" id="thetitle"><b>My Order</b></div>
					<a href="{{ route('client.myOrdersListPage') }}" style="width:90px"  class="btn btn-primary btn-sm float-end" id="requestbutton">
						<i class="fa fa-arrow-circle-left" style="font-size:25px;color:white"></i>
					</a>
					<a href="{{ route('order.viewInvoice',$order->id)}}" target="_blank" style="width:250px"  class="btn btn-primary btn-sm float-end" id="requestbutton">View Invoice</a>
					<a href="{{ route('order.downloadInvoice',$order->id)}}" style="width:250px"  class="btn btn-primary btn-sm float-end" id="requestbutton">
						<i class="fa fa-download" style="font-size:20px;color:white"></i>&nbsp Download Invoice
					</a>
			</div>
			</div>
		</div>

	
		<div class="cardbody">
			<div class="leftinfo">
				<div class="partDesign"><img class="partDesignImage" src="{{ asset('images/' . $order->getDesign->partDesign) }}" width="275" /></div>

				<div class="paymentStatus">
					<label>PAYMENT PROOF:&nbsp&nbsp</label>
						{{ $order->paymentStatus }}
				</div>
				
				@if($order->paymentStatus == 'SUBMITTED' || $order->paymentStatus == 'PAYMENT REJECTED' || $order->paymentStatus == 'PENDING')
				<!-- payment proof submission form -->
				<!-- function updatePaymentInfo will be executed if client click submit button -->
				<form method="post" action="{{ route('order.updatePaymentInfo', $order->id) }}" enctype="multipart/form-data">
					
					@csrf
					@method('PUT')
					
                    <div class="newPaymentProof">
                            <label>Payment proof:&nbsp&nbsp</label>
                                <input type="file" name="paymentProof" />
                        </div>

					<div class="text-center buttonsubmit">
						<input type="hidden" class="submitbutton" name="paymentStatus" value="SUBMITTED" />
						<input type="hidden" name="hidden_id" value="{{ $order->id }}" />
						<input type="submit" class="btn btn-primary btn-sm float-end" id="requestbutton" value="Submit payment proof" />
			    	</div>
				</form>
				@else
				@endif

				@if($order->paymentStatus == 'SUBMITTED' || $order->paymentStatus == 'PAYMENT REJECTED')
				
				<img src="{{ asset('images/' . $order->paymentProof) }}" width="155" style="padding-top:25px" />
				<a href="{{ route('client.viewPaymentProof', $order->id) }}" target="_blank">View payment proof</a>
				
				@endif
			</div>

			<div class="centerinfo">
				<div class="partNo">
					<label><b>PART NO.:&nbsp</label>
						{{ $order->partNo }}</b>
				</div>
            	
				
				<div class="partName">
					<label>PART NAME:&nbsp</label>
						{{ $order->getDesign->partDescription }}
				</div>
				<!-- updated order status can be seen here -->
				<div class="ordeStatus">
					<label>Order Status:&nbsp</label>
						{{ $order->orderStatus }}
				</div>
				<div class="currencyCode">
					<label>Currency Code:&nbsp</label>
						{{ $order->currencyCode }}
				</div>
				<div class="shippingMode">
					<label>Shipping Mode:&nbsp</label>
						{{ $order->shippingMode }}
				</div>
				<div class="placeOfDelivery">
					<label>Place of Delivery:&nbsp</label>
						{{ $order->placeofDelivery }}
				</div>
				<div class="shippingTerm">
					<label>Shipping Term:&nbsp</label>
						{{ $order->shippingTerm }}
				</div>
				<div class="salesUnitPriceBasisUOM">
					<label>Sales Unit Price Basis (UOM):&nbsp</label>
						{{ $order->salesUnitPriceBasisUOM }}
				</div>
				<div class="quantityPerPackageUOM">
					<label>Quantity Per Package (UOM):&nbsp</label>
						{{ $order->quantityPerPackageUOM }}
				</div>
				<div class="unitPrice">
					<label>Unit Price:&nbsp</label>
						{{ $order->unitPrice }}
				</div>
				<div class="referenceDateETD">
					<label>Reference Date/ETA:&nbsp</label>
						{{ $order->referenceDateETD }}
				</div>
				<div class="amount">
					<label>Amount:&nbsp</label>
						{{ $order->amount }}
				</div>
			</div>

			<div class="rightinfo">
				<div class="orderSubmitted">
					<label>ORDER SUBMITTED:&nbsp</label>
						{{ $order->created_at }}
				</div>
				<div class="remark">
					<label>Remark:&nbsp</label>
						{{ $order->remark }}
				</div>
				<div class="paymentTerm">
					<label>Payment Term:&nbsp</label>
						{{ $order->paymentTerm }}
				</div>
				<div class="quantity">
					<label>Quantity:&nbsp</label>
						{{ $order->quantity }}
				</div>
				<div class="UOM">
					<label>UOM:&nbsp</label>
						{{ $order->UOM }}
				</div>
				<div class="deliveryDateETA">
					<label>Delivery Date/ETA:&nbsp</label>
						{{ $order->deliveryDateETA }}
				</div>
				<div class="RONo">
					<label>R/O No:&nbsp</label>
						{{ $order->RONo }}
				</div>

				<div class="totalAmount">
					<label><b>Total Amount:&nbsp</b></label>
				</div>
			</div>
        </div>
</body>
</html>


