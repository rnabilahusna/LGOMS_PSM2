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
	<title>Appointment List</title>
</head>
<body>


<div class="menu-container">
    <div class="menu">
        <div class="logo"><img src="images/Lengkuas_Logo_1.svg" alt="LG Logo" style="width:180px;height:45px;"></div>

        <div class="links">
        <div class="home"><a href="{{ route('prod.mainWindow') }}" style="color:black; text-decoration:none">Home</a></div>
            <div class="appointment_list">Appointment List</div>
            <div class="order_list"><a href="{{ route('prod.ordersListPage') }}" style="color:black;text-decoration:none">Order List</a></div>
            <div class="design_list"><a href="{{ route('prod.designsListPage') }}" style="color:black; text-decoration:none">Design List</a></div>
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
				<div class="col col-md-6" id="thetitle"><b>Appointments Requests List</b></div>
				
			</div>
		</div>

	

		<div class="cardbody">
		<table class="table table-bordered" style="width:100%">
			<tr>
				<th width="10%">Client ID</th>
				<th width="15%">Company Name</th>
				<th width="15%">Representative </th>
				<th width="20%">Request Date & Time</th>
				<th width="17%">Appointment Status</th>
				<th width="10%"></th>
			</tr>
			
			@if(count($data) > 0)

				@foreach($data as $row)

					<tr>
						<td>{{ $row->buyerCode }}</td>
						<td>{{ $row->getClient->buyerCorrespondentOrName }}</td>
						<td>{{ $row->getUser->name }}</td>
						<td>{{ $row->appDate }} {{ $row->appTime }}</td>

						@if($row->appStatus == 'PENDING')
						<td><div style="border-radius:5px; background-color:#FBD347; color:white">{{ $row->appStatus }}</div></td>

						@elseif($row->appStatus == 'ACCEPTED')
						<td><div style="border-radius:5px; background-color:#00CC6A; color:white">{{ $row->appStatus }}</div></td>

						@elseif($row->appStatus == 'REJECTED')
						<td><div style="border-radius:5px; background-color:#FF6363; color:white">{{ $row->appStatus }}</div></td>

						@endif

						<td>
							<form method="post" action="{{ route('appointment.destroy', $row->appID) }}">
								@csrf
								@method('DELETE')
								<a href="{{ route('appointment.showForProdP', $row->appID) }}" class="btn btn-primary btn-sm">View</a>
								<input type="submit" class="btn btn-danger btn-sm" value="Delete" />
							</form>
						</td>
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



