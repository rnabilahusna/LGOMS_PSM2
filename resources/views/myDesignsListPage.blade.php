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
	<title>My Designs List</title>
</head>
<body>
		<div class="menu-container">
		<div class="menu">
			<div class="logo"><img src="images/Lengkuas_Logo_1.svg" alt="LG Logo" style="width:180px;height:45px;"></div>

			<div class="links">
				<div class="home">Home</div>
				<div class="my_designs">My Designs</div>
				<div class="my_orders">My Orders</div>
			</div>

			<div class="dropdown">
				<div class="profile-group">
					<div class="profile-pic"><img  src="images/profile_picture_default.png" alt="profile pic" style="width:45px;height:45px;"></div>
					<div class="profile"><p class="dropbtn">Profile</p></div>
				</div>

				<div class="dropdown-content">
					<a href="#">Account Settings</a>
					<a href="#">Sign Out</a>
				</div>
			</div>
			
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
				<div class="col col-md-6" id="thetitle"><b>My Designs List</b></div>
				<div class="col col-md-6">
					<a href="{{ route('design.create') }}'" class="btn btn-success btn-sm float-end" id="requestbutton" >Request New Design</a>
				</div>
			</div>
		</div>

	

		<div class="cardbody">
		<table class="table table-bordered" style="width:100%">
			<tr>
				<th width="23%">Part No. & Name</th>
				<th width="50%">Part Design</th>
				<th width="15%">Good Stock</th>
				<th width="12%"></th>
			</tr>
			
			@if(count($data) > 0)

				@foreach($data as $row)

					<tr>
						
						<td>{{ $row->partNo }}</td>
						<td><img src="{{ asset('images/' . $row->partDesign) }}" width="75" /></td>
						<td>{{ $row->goodsStock }}</td>
						<td><button class="viewbutton">View design</button></td>
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


