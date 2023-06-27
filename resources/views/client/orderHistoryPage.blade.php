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
	<title>My Order History</title>
</head>
<body>
	<div class="menu-container">
		<div class="menu">
			<div class="logo"><img src="images/Lengkuas_Logo_1.svg" alt="LG Logo" style="width:180px;height:45px;"></div>

			<div class="links">
            <div class="home"><a href="{{ route('client.mainWindow') }}" style="color:black; text-decoration:none">Home</a></div>
                <div class="my_designs"><a href="{{ route('client.myDesignsListPage') }}" style="color:black; text-decoration:none">My Designs</a></div>
				<div class="my_orders"><a href="{{ route('client.myOrdersListPage') }}" style="color:black; text-decoration:none">My Orders</a></div>
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
				<div class="col col-md-6" id="thetitle"><b>My Order History</b></div>
                <a href="{{ route('client.myOrdersListPage') }}" style="width:90px" class="btn btn-success btn-sm float-end" id="requestbutton">
					<i class="fa fa-arrow-circle-left" style="font-size:25px;color:white"></i>
				</a>
			</div>
		</div>

	

		<div class="cardbody">
		<table class="table table-bordered" style="width:100%">
			<tr>
				<th width="5%">Order ID</th>
				<th width="10%">Part No & Name</th>
				<th width="10%">Status</th>
				<th width="10%">Updated</th>
                <th width="9%">Payment Status</th>
                <th width="6%"></th>
			</tr>

            
            @if(count($data) > 0 )


				@foreach($data as $key=>$row)

					<tr>
						<td>{{ $row->PONo }}</td>
						<td>{{ $row->partNo }} / {{ $row->partDescription}}</td>
                        <td>{{ $row->orderStatus }}</td>
                        <td>{{ $row->updated_at }}</td>
						@if($row->paymentStatus == 'PAID')
						<td><div style="color:white;background-color:#00CC6A;border-radius:5px">{{ $row->paymentStatus }}</div></td>
						@elseif($row->paymentStatus == 'PENDING' || $row->paymentStatus == 'SUBMITTED')
						<td><div style="color:white;background-color:#FBD347;border-radius:5px">{{ $row->paymentStatus }}</div></td>
						@else
						<td><div style="color:white;background-color:#FF6363;border-radius:5px">{{ $row->paymentStatus }}</div></td>
						@endif

						

						<td>
                            <button class="viewbutton">
							<a style="text-decoration:none;color:white" href="{{ route('client.reorderPage',$row->id) }}" >Reorder</a>
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


