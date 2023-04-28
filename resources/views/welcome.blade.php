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
            <div class="appointment_list">Appointment List</div>
            <div class="order_list">Order List</div>
            <div class="design_list">Design List</div>
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
				
				<!-- <a href="{{ route('appointment.index') }}" class="btn btn-primary btn-sm float-end">View All</a> -->
			</div>
			</div>
		</div>

	
		<div class="cardbody">
            <div class="row mb-3">
                <label class="col-sm-2 col-label-form"><b>ID</b></label>
                <div class="col-sm-10">
                    {{ $appointment->appID }}
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-label-form"><b>Buyer Code</b></label>
                <div class="col-sm-10">
                    {{ $appointment->appDate }}
                </div>
            </div>
            <div class="row mb-4">
                <label class="col-sm-2 col-label-form"><b>App Date</b></label>
                <div class="col-sm-10">
                    {{ $appointment->appPurpose }}
                </div>
            </div>
            <div class="row mb-4">
                <label class="col-sm-2 col-label-form"><b>App Purpose</b></label>
                <div class="col-sm-10">
                    {{ $appointment->appStatus }}
                </div>
            </div>
            <div class="row mb-4">
                <label class="col-sm-2 col-label-form"><b>App Status</b></label>
                <div class="col-sm-10">
                    {{ $appointment->appTime }}
                </div>
            </div>
        </div>

	</div>

</body>
</html>



