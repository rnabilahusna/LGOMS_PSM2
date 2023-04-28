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
            <div class="home">Home</div>
            <div class="appointment_list"><a href="{{ route('appointment.index') }}" style="text-decoration:none; color:black">Appointment List</a></div>
            <div class="order_list"><a href="{{ route('prod.ordersListPage') }}" style="color:black;text-decoration:none">Order List</a></div>
            <div class="design_list"><a href="{{ route('prod.designsListPage') }}" style="text-decoration:none; color:black">Design List</a></div>
        </div>

		@auth
       
	   <div class="dropdown">
		   <div class="profile-group">
			   <div class="profile-pic"><img  src="images/profile_picture_default.png" alt="profile pic" style="width:45px;height:45px;"></div>
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
				<div class="col col-md-6" id="thetitle"><b>Appointments Details</b></div>
				
				<a href="{{ route('appointment.index') }}" class="btn btn-primary btn-sm float-end">View All</a>
			</div>
			</div>
		</div>

	
		<div class="cardbody">
            <div class="row mb-3">
                <label class="col-sm-2 col-label-form"><b>Company Name</b></label>
                <div class="col-sm-10">
					{{ $appointment->getClient->buyerName }}
                </div>
            </div>
			<div class="row mb-3">
                <label class="col-sm-2 col-label-form"><b>Client ID</b></label>
                <div class="col-sm-10">
					{{ $appointment->getClient->buyerCode }}
                </div>
            </div>
			<div class="row mb-3">
                <label class="col-sm-2 col-label-form"><b>Contact No.</b></label>
                <div class="col-sm-10">
					{{ $appointment->getClient->contactNum }}
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-label-form"><b>Appointment Purpose</b></label>
                <div class="col-sm-10">
                    {{ $appointment->appPurpose }}
                </div>
            </div>
            <div class="row mb-4">
                <label class="col-sm-2 col-label-form"><b>App Date</b></label>
                <div class="col-sm-10">
                    {{ $appointment->appDate }}
                </div>
            </div>
            <div class="row mb-4">
                <label class="col-sm-2 col-label-form"><b>Email</b></label>
                <div class="col-sm-10">
                    {{ $appointment->getClient->email }}
                </div>
            </div>
            <div class="row mb-4">
                <label class="col-sm-2 col-label-form"><b>Appointment Time</b></label>
                <div class="col-sm-10">
                    {{ $appointment->appTime }}
                </div>
            </div>

			<div class="row mb-4">
			<form method="post" action="{{ route('appointment.update', $appointment->appID) }}" enctype="multipart/form-data">
				@csrf
				@method('PUT')
				
				<input type="hidden" name="hidden_id" value="{{ $appointment->appID }}" />
				<input name="appStatus" type="submit" class="btn btn-success" value="Accepted" />
				<input name="appStatus" type="submit" class="btn btn-danger" value="Rejected" />
			</form>
            </div>


			
        </div>

	</div>

</body>
</html>



