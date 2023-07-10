<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/mydesignsliststyle.css" >
    <link rel="stylesheet" href="css/navbarstyle.css" >
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>Order List</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	
</head>
<body>
<div class="menu-container">
    <div class="menu">
        <div class="logo"><img src="images/Lengkuas_Logo_1.svg" alt="LG Logo" style="width:180px;height:45px;"></div>

        <div class="links">
			<div class="home"><a href="{{ route('sales.mainWindow') }}" style="color:black; text-decoration:none">Home</a></div>
            <div class="register_user"><a href="{{ route('register.index') }}" style="color:black; text-decoration:none">Register User</a></div>
            <div class="order_list">Order List</div>
            <div class="design_list"><a href="{{ route('sales.designsListPage') }}" style="color:black; text-decoration:none">Design List</a></div>
        </div>
		

		@auth
       
		<div class="dropdown">
			<div class="profile-group">
				<div class="profile-pic"><img  src="images/profile_picture_default.png" alt="profile pic" style="width:45px;height:45px;"></div>
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
				<div class="col col-md-6" id="thetitle"><b>Orders List</b></div>
				<form class="form-inline my-2 my-lg-0" action="{{route('sales.ordersListPage')}}" type="get">
					<div>
					<a href="{{ route('order.getOrdersHistoryListPageForSales') }}" style="width:20%" class="btn btn-success btn-sm float-end" id="requestbutton">Order History</a>
						<div class="row g-3 align-items-center">
						
							
							<div class="col-auto" style="display:flex">
									<div class="row" style="padding-right:7%">
										<label for="">Search</label>
										<input type="search" name="search" id="search" class="form-control" aria-describedby="passwordHelpInline" placeholder="Search to filter">
									</div>
									
									<div>
										<label for=""> </label>
										<button type="submit" class="btn btn-primary">Filter</button>
									</div>
								<!-- </form> -->
							</div>
							
						</div>
						
					</div>
				
				</form>
			</div>
		</div>

		<div class="cardbody">
		<table class="table table-bordered table-sortable" style="width:100%">
		<thead>	
			<tr>
				<th width="5%">PO No</th>
				<th width="5%">Client</th>
				<th width="10%">Part No. & Name</th>
				<th width="10%">Order Status</th>
                <th width="10%">Payment Status</th>
                <th width="10%">
                <!-- Add an ID to the delivery date column header for event listener -->
                <span id="delivery-date-header">Delivery Date</span>
            	</th>
                <th width="10%"></th>
			</tr>
		</thead>
			
			@if(count($data) > 0)

				@foreach($data as $row)

					<tr>
						<td>{{ $row->PONo }}</td>
						<td>{{ $row->getClient->buyerCode }}</td>
                        <td>{{ $row->partNo }} / {{ $row->partDescription }}</td>
						<td>{{ $row->orderStatus }}</td>
						
						@if($row->paymentStatus == 'PAID')
						<td><div style="color:white;background-color:#00CC6A;border-radius:5px">{{ $row->paymentStatus }}</div></td>
						@elseif($row->paymentStatus == 'PENDING' || $row->paymentStatus == 'SUBMITTED') 
						<td><div style="color:white;background-color:#FBD347;border-radius:5px">{{ $row->paymentStatus }}</div></td>
						@else
						<td><div style="color:white;background-color:#FF6363;border-radius:5px">{{ $row->paymentStatus }}</div></td>
						@endif

                        <td>{{ $row->deliveryDateETA }}</td>
						<td><a style="text-decoration:none;color:white" class="viewbutton" href="{{ route('order.showForSalesP', $row->id) }}" class="btn btn-primary btn-sm">View order</a></td>
					</tr>

				@endforeach

				@else
				<tr>
					<td colspan="5" class="text-center">No Data Found</td>
				</tr>
				@endif

		</table>
		{!! $data->links() !!}

		</div>


		
	</div>

</body>
</html>


