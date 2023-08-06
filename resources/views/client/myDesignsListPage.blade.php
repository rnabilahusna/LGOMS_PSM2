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
	<title>My Design List</title>
</head>
<body>
	<div class="menu-container">
		<div class="menu">
			<div class="logo"><img src="images/Lengkuas_Logo_1.svg" alt="LG Logo" style="width:180px;height:45px;"></div>

			<div class="links">
            <div class="home"><a href="{{ route('client.mainWindow') }}" style="color:black; text-decoration:none">Home</a></div>
				<div class="my_designs">My Designs</div>
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

		</div>
	</div>

	<!-- display returned message from controller if success -->
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
					<a href="{{route('design.getRFQFormPage')}}" class="btn btn-success btn-sm float-end" id="requestbutton" >Request New Design</a>
					<form class="form-inline my-2 my-lg-0" action="" type="get">
					<div>
						<div class="row g-3 align-items-center">
							
							<div class="col-auto">
								<form action="{{route('client.myDesignsListPage')}}" method="GET">
									<input type="search" name="search" id="search" class="form-control" aria-describedby="passwordHelpInline" placeholder="Search to filter">
								</form>
							</div>
							
						</div>
					</div>
				</form>
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
			<!-- display the data in table if has data in the table database -->
			@if(count($data) > 0)
				@foreach($data as $key=>$row)
					<tr>
						<td>{{ $row->partNo }}/{{ $row->partDescription }}</td>
						<td><img src="{{ asset('images/' . $row->partDesign) }}" width="100" /></td>
						<td>
							@if( $row->goodsStock < 1)
								
							@else
								{{ $row->goodsStock }}
							@endif
						</td>
						<td>
							<!-- view the design details -->
							<a style="text-decoration:none" href="{{ route('design.showForClient', $row->designID) }}" class="btn btn-primary btn-sm" id="requestbutton">View</a>
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
	@endauth
</body>
</html>


