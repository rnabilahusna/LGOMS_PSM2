<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/css/mydesignsliststyle.css" >
	<link rel="stylesheet" href="/css/stafforderdetailspagestyle.css" >
    <link rel="stylesheet" href="/css/navbarstyle.css" >
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
			<div class="home"><a href="{{ route('sales.mainWindow') }}" style="color:black; text-decoration:none">Home</a></div>
            <div class="register_user"><a href="{{ route('register.index') }}" style="color:black; text-decoration:none">Register User</a></div>
            <div class="order_list"><a href="{{ route('sales.ordersListPage') }}" style="color:black; text-decoration:none">Order List</div>
            <div class="design_list"><a href="{{ route('sales.designsListPage') }}" style="color:black; text-decoration:none">Design List</a></div>
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
				
				<a href="{{ route('sales.ordersListPage') }}" class="btn btn-primary btn-sm float-end" id="requestbutton" style="width:90px;height:10%">
				<i class="fa fa-arrow-circle-left" style="font-size:25px;color:white"></i>
				</a>
				<a href="{{ route('pdr.getPDRFormPageForSalesP', $order->id) }}" class="btn btn-primary btn-sm float-end" id="requestbutton" style="width:15%">Create PDR</a>&nbsp
				<a href="{{ route('sales.getPDRFormPageForSalesP', $order->id) }}" class="btn btn-primary btn-sm float-end" id="requestbutton" style="width:15%">View PDR</a>&nbsp
			</div>
			</div>
		</div>

	
		<div class="cardbody">

			<div class="leftinfo">
				
				
				<div><img class="partDesignImage" src="{{ asset('images/' . $order->getDesign->partDesign) }}" width="175" /></div>
				
               	

					

			@if($order->paymentStatus == 'PAID')
            
            
                <div class="updateStatusForm">
                    <label><b>What is the current order status?</b></label>
            
                    <form method="post" action="{{ route('order.updateOrderStatusInfo', $order->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <select name="orderStatus" class="form-group" value="{{$order->orderStatus}}" style="width:85%; height:40px; color:grey; padding-left: 10px">
                        <option>-- Update Order Status --</option>
                        <option name="orderStatus" value="NEW"> New </option>
                        <option name="orderStatus" value="PRODUCTION IN PROGRESS"> Production In Progress </option>
                        <option name="orderStatus" value="INSPECTION"> Inspection </option>
                        <option name="orderStatus" value="PACKING"> Packing </option>
                        <option name="orderStatus" value="SHIPPED"> Shipped </option>
                        <option name="orderStatus" value="DELIVERED"> Delivered </option>
                    </select>
                    <div class="text-center">
                        <input type="hidden" name="hidden_id" value="{{ $order->id }}" />
						<input type="hidden" name="paymentStatus" value="{{ $order->paymentStatus }}" />
                        <input type="submit" class="btn btn-primary" value="Update status" id="requestbutton" style="margin:auto; margin-top:10px"/>
                    </div>

                    </form>
                </div>
            
            @elseif($order->paymentStatus == 'PAYMENT REJECTED' || $order->paymentStatus == 'PENDING')


			@else
			<!-- payment status == submitted -->
				<form method="post" action="{{ route('order.updateOrderStatusInfo', $order->id) }}" class="paymentConfirmationForm">
                    
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="hidden_id" value="{{ $order->id }}"/>
					<input type="hidden" name="orderStatus" value="{{ $order->orderStatus }}" />
					<input type="hidden" name="buyerCode" value="{{ $order->getClient->buyerCode }}" />
                    <input name="paymentStatus" type="submit" class="btn btn-success" value="PAID" />
                    <input name="paymentStatus" type="submit" class="btn btn-danger" value="PAYMENT REJECTED" />
                </form>


			@endif

			<div class="paymentStatus">
						<br>
						<label>Payment Status: </label>
							<b>{{ $order->paymentStatus }}</b>
					</div>

			@if(is_null($order->paymentProof))
				<br><br>
				<div>Payment proof is still in <b>PENDING</b><br></div>
				@else
					<div class="paymentProof">
						<label>Payment proof: </label>
							<img src="{{ asset('images/' . $order->paymentProof) }}" width="140px" style="padding-top:25px" />
							<a href="{{ route('client.viewPaymentProof', $order->id) }}" target="_blank">View payment proof</a>
					</div> 
				@endif

					

			</div>




			<div class="centerinfo">
				
				
				<div class="PONo">
					<label><b>P/O No:</label>
						{{ $order->PONo }}</b>
				</div>
				<div class="orderStatus">
					<label>Order Status: </label>
						{{ $order->orderStatus }}
				</div>
				<div class="currencyCode">
					<label>Currency Code:</label>
						{{ $order->currencyCode }}
				</div>
				<div class="shippingMode">
					<label>Shipping Mode:</label>
						{{ $order->shippingMode }}
				</div>
				<div class="placeofDelivery">
					<label>Place of Delivery:</label>
						{{ $order->placeofDelivery }}
				</div>
				<div class="shippingTerm">
					<label>Shipping Term:</label>
						{{ $order->shippingTerm }}
				</div>
				<div class="partNo">
					<label>Part No:</label>
						{{ $order->partNo }}
				</div>
				<div class="salesUnitPriceBasisUOM">
					<label>Sales Unit Price Basis (UOM):</label>
						{{ $order->salesUnitPriceBasisUOM }}
				</div>
				<div class="quantityPerPackageUOM">
					<label>Quantity Per Package (UOM):</label>
						{{ $order->quantityPerPackageUOM }}
				</div>
				<div class="unitPrice">
					<label>Unit Price:</label>
						{{ $order->unitPrice }}
				</div>
				<div class="referenceDateETD">
					<label>Reference Date/ETA:</label>
						{{ $order->referenceDateETD }}
				</div>
				<div class="amount">
					<label>Amount:</label>
						{{ $order->amount }}
				</div>
			
			</div>


			<div class="rightinfo">

				<div class="created_at">
					<label>Creation Date:</label>
						{{ $order->created_at }}
				</div>
				<div class="IssuedDate">
					<label>Issued Date:</label>
						{{ $order->IssuedDate }}
				</div>
				<div class="remark">
					<label>Remark:</label>
						{{ $order->remark }}
				</div>

				<div class="paymentTerm">
					<label>Payment Term:</label>
						{{ $order->paymentTerm }}
				</div>

				<div class="partDescription">
					<label>Part Description:</label>
						{{ $order->partDescription }}
				</div>
				<div class="quantity">
					<label>Quantity:</label>
						{{ $order->quantity }}
				</div>
				<div class="UOM">
					<label>UOM:</label>
						{{ $order->UOM }}
				</div>
				<div class="deliveryDateETA">
					<label>Delivery Date/ETA:</label>
						{{ $order->deliveryDateETA }}
				</div>
				<div class="RONo">
					<label>R/O No:</label>
						{{ $order->RONo }}
				</div>

				<div class="totalAmount">
					<label>Total Amount:</label>
					
				</div>
			</div>
        </div>
	

</body>
</html>


