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
	<title>My Order List</title>
</head>
<body>
	<div class="menu-container">
		<div class="menu">
			<div class="logo"><img src="images/Lengkuas_Logo_1.svg" alt="LG Logo" style="width:180px;height:45px;"></div>

			<div class="links">
            <div class="home"><a href="{{ route('client.mainWindow') }}" style="color:black; text-decoration:none">Home</a></div>
                <div class="my_designs"><a href="{{ route('client.myDesignsListPage') }}" style="color:black; text-decoration:none">My Designs</a></div>
				<div class="my_orders">My Orders</div>
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

<!-- display returned message from the controller if success -->
	@if($message = Session::get('success'))

	<div class="alert alert-success">
		{{ $message }}
	</div>

	@endif

	<div class="card">
		<div class="cardheader">
			<div class="row">
				<div class="col col-md-6" id="thetitle"><b>My Order List</b></div>
				<a href="{{ route('client.getClientOrdersHistoryListPage') }}" style="width:20%" class="btn btn-success btn-sm float-end" id="requestbutton">Order History</a>
				<form class="form-inline my-2 my-lg-0" action="" type="get">
					<div>
						<div class="row g-3 align-items-center mt-1">
							
							<div class="col-auto">
								<form action="{{route('client.myOrdersListPage')}}" method="GET">
									<input type="search" name="search" id="search" class="form-control" aria-describedby="passwordHelpInline" placeholder="Search to filter">
								</form>
							</div>
							
						</div>
						
					</div>
				
				</form>
			</div>
		</div>

		<div class="cardbody">
		<table class="table table-bordered" style="width:100%">
			<tr>
				<th width="5%">PO No</th>
				<th width="10%">Part No & Name</th>
				<th width="10%">Status</th>
				<th width="10%">Updated</th>
                <th width="9%">Payment Status</th>
                <th width="6%"></th>
			</tr>
			
			@if(count($data) > 0)

				@foreach($data as $key=>$row)

					<tr>
						<td>{{ $row->PONo }}</td>
						<td>{{ $row->partNo }} / {{ $row->partDescription}}</td>
                        <td>{{ $row->orderStatus }}</td>
                        <td>{{ $row->updated_at }}</td>

						<!-- the updated order status can be seen from this column -->
						@if($row->paymentStatus == 'PAID')
						<td><div style="color:white;background-color:#00CC6A;border-radius:5px">{{ $row->paymentStatus }}</div></td>
						@elseif($row->paymentStatus == 'PENDING' || $row->paymentStatus == 'SUBMITTED')
						<td><div style="color:white;background-color:#FBD347;border-radius:5px">{{ $row->paymentStatus }}</div></td>
						@else
						<td><div style="color:white;background-color:#FF6363;border-radius:5px">{{ $row->paymentStatus }}</div></td>
						@endif

						<td>
                            <button class="viewbutton">
                            <a style="text-decoration:none;color:white" href="{{ route('order.showForClient', $row->id) }}" >View order</a>
							</button>
                        </td>
					</tr>

				@endforeach

				@else
				<tr>
					<td colspan="5" class="text-center">No Data Found</td>
				</tr>
				@endif
				
		</table>
		</div>
	</div>
</body>
</html>


