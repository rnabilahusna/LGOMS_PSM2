<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/css/mydesignsliststyle.css" >
    <link rel="stylesheet" href="/css/navbarstyle.css" >
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
	<title>Orders List</title>
</head>
<body>
<div class="menu-container">
    <div class="menu">
        <div class="logo"><img src="/images/Lengkuas_Logo_1.svg" alt="LG Logo" style="width:180px;height:45px;"></div>

        <div class="links">
            <div class="home">Home</div>
            <div class="register_user">Register User</div>
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
				<a href="#">Account Settings</a>
				<a href="#">Sign Out</a>
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
				
				<a href="{{ route('sales.ordersListPage') }}" class="btn btn-primary btn-sm float-end">View All Orders</a>
				<a href="" class="btn btn-primary btn-sm float-end">View PDR</a>
				<a href="" class="btn btn-primary btn-sm float-end">View JO</a>
			</div>
			</div>
		</div>

	
		<div class="cardbody">

			<div class="leftinfo">
				<div><img src="{{ asset('images/' . $order->getDesign->partDesign) }}" width="75" /></div>
				
               
					<div class="row mb-3">
						<label class="col-sm-2 col-label-form"><b>Payment proof: </b></label>
						<div class="col-sm-10">
							<img src="{{ asset('images/' . $order->paymentProof) }}" width="75" />
						</div>
					</div> 

					

			@if($order->paymentStatus == 'PAID')
            
            
                <div class="row mb-4">
                    <label class="col-sm-2 col-label-form"><b>What is the current order status?</b></label>
            
                    <form method="post" action="{{ route('order.updateOrderStatusInfo', $order->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <select name="orderStatus" class="form-group" value="{{$order->orderStatus}} style="width:85%; height:40px; color:grey; padding-left: 10px">
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
                        <input type="submit" class="btn btn-primary" value="Update status" />
                    </div>

                    </form>
                </div>
            
            @elseif($order->paymentStatus == 'PAYMENT REJECTED')


			@else
			<!-- payment status == submitted -->
				<form method="post" action="{{ route('order.updateOrderStatusInfo', $order->id) }}" >
                    
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="hidden_id" value="{{ $order->id }}"/>
					<input type="hidden" name="orderStatus" value="{{ $order->orderStatus }}" />
                    <input name="paymentStatus" type="submit" class="btn btn-success" value="PAID" />
                    <input name="paymentStatus" type="submit" class="btn btn-danger" value="PAYMENT REJECTED" />
                </form>


			@endif

			</div>




			<div class="centerinfo">
				
			<div class="row mb-3">
					<label class="col-sm-2 col-label-form"><b>Payment Status: </b></label>
					<div class="col-sm-10">
						{{ $order->paymentStatus }}
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-2 col-label-form"><b>P/O No:</b></label>
					<div class="col-sm-10">
						{{ $order->PONo }}
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-2 col-label-form"><b>Order Status: </b></label>
					<div class="col-sm-10">
						{{ $order->orderStatus }}
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-2 col-label-form"><b>Currency Code:</b></label>
					<div class="col-sm-10">
						{{ $order->currencyCode }}
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-2 col-label-form"><b>Shipping Mode:</b></label>
					<div class="col-sm-10">
						{{ $order->shippingMode }}
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-2 col-label-form"><b>Place of Delivery:</b></label>
					<div class="col-sm-10">
						{{ $order->placeofDelivery }}
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-2 col-label-form"><b>Shipping Term:</b></label>
					<div class="col-sm-10">
						{{ $order->shippingTerm }}
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-2 col-label-form"><b>Part No:</b></label>
					<div class="col-sm-10">
						{{ $order->partNo }}
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-2 col-label-form"><b>Sales Unit Price Basis (UOM):</b></label>
					<div class="col-sm-10">
						{{ $order->salesUnitPriceBasisUOM }}
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-2 col-label-form"><b>Quantity Per Package (UOM):</b></label>
					<div class="col-sm-10">
						{{ $order->quantityPerPackageUOM }}
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-2 col-label-form"><b>Unit Price:</b></label>
					<div class="col-sm-10">
						{{ $order->unitPrice }}
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-2 col-label-form"><b>Reference Date/ETA:</b></label>
					<div class="col-sm-10">
						{{ $order->referenceDateETD }}
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-2 col-label-form"><b>Amount:</b></label>
					<div class="col-sm-10">
						{{ $order->amount }}
					</div>
				</div>
			
			</div>


			<div class="rightinfo">

				<div class="row mb-3">
					<label class="col-sm-2 col-label-form"><b>Creation Date:</b></label>
					<div class="col-sm-10">
						{{ $order->created_at }}
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-2 col-label-form"><b>Issued Date:</b></label>
					<div class="col-sm-10">
						{{ $order->IssuedDate }}
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-2 col-label-form"><b>Remark:</b></label>
					<div class="col-sm-10">
						{{ $order->remark }}
					</div>
				</div>

				


				<div class="row mb-3">
					<label class="col-sm-2 col-label-form"><b>Payment Status:</b></label>
					<div class="col-sm-10">
						{{ $order->paymentStatus }}
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-2 col-label-form"><b>Payment Term:</b></label>
					<div class="col-sm-10">
						{{ $order->paymentTerm }}
					</div>
				</div>

				<div class="row mb-3">
					<label class="col-sm-2 col-label-form"><b>Part Description:</b></label>
					<div class="col-sm-10">
						{{ $order->partDescription }}
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-2 col-label-form"><b>Quantity:</b></label>
					<div class="col-sm-10">
						{{ $order->quantity }}
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-2 col-label-form"><b>UOM:</b></label>
					<div class="col-sm-10">
						{{ $order->UOM }}
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-2 col-label-form"><b>Delivery Date/ETA:</b></label>
					<div class="col-sm-10">
						{{ $order->deliveryDateETA }}
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-2 col-label-form"><b>R/O No:</b></label>
					<div class="col-sm-10">
						{{ $order->RONo }}
					</div>
				</div>

				<div class="row mb-3">
					<label class="col-sm-2 col-label-form"><b>Total Amount:</b></label>
					<div class="col-sm-10">
						
					</div>
				</div>
			</div>
        </div>
	

</body>
</html>


