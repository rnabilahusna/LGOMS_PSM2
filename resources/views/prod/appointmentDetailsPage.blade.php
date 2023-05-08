<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/css/mydesignsliststyle.css" >
    <!-- <link rel="stylesheet" href="/css/designdetailspagestyle.css" > -->
    <link rel="stylesheet" href="/css/navbarstyle.css" >
    <link rel="stylesheet" href="/css/appointmentdetailspage.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
	<title>Appointment Details</title>
</head>
<body>


<div class="menu-container">
    <div class="menu">
        <div class="logo"><img src="/images/Lengkuas_Logo_1.svg" alt="LG Logo" style="width:180px;height:45px;"></div>

        <div class="links">
        <div class="home"><a href="{{ route('prod.mainWindow') }}" style="color:black; text-decoration:none">Home</a></div>
            <div class="appointment_list"><a href="{{ route('appointment.index') }}" style="text-decoration:none; color:black">Appointment List</a></div>
            <div class="order_list"><a href="{{ route('prod.ordersListPage') }}" style="color:black;text-decoration:none">Order List</a></div>
            <div class="design_list"><a href="{{ route('prod.designsListPage') }}" style="text-decoration:none; color:black">Design List</a></div>
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
				<div class="col col-md-6" id="thetitle"><b>Appointments Details</b></div>
				<div class="col col-md-6">
				    <a href="{{ route('prod.appointmentsListPage') }}" class="btn btn-success btn-sm float-end" id="requestbutton">View All</a>
                </div>
            </div>
			</div>
		</div>

	
		<div class="cardbody" id=cardbody>

            <div class="leftonly">

                <div class="details" id="buyerName">Company Name:&nbsp&nbsp 
                        {{ $appointment->getClient->buyerName }}
                </div>
           
           
                <div class="details" id="buyerCode">Client ID:&nbsp&nbsp 
                        {{ $appointment->getClient->buyerCode }}
                </div>
       
           
                <div class="details" id="contactNum">Contact No.:&nbsp&nbsp 
                        {{ $appointment->getUser->contactNum }}
                </div>
       
          
                <div class="details" id="buyerName">Email:&nbsp&nbsp 
                        {{ $appointment->getUser->email }}
                </div>

            </div>



            <div class="rightonly">

                <div class="details" id="appPurpose">Appointment Purpose:&nbsp&nbsp 
                        {{ $appointment->appPurpose }}
                </div>

                <div class="details" id="appDate">Appointment Date:&nbsp&nbsp 
                        {{ $appointment->appDate }}
                </div>

                <div class="details" id="appTime">Appointment Time:&nbsp&nbsp 
                        {{ $appointment->appTime }}
                </div>

                <div class="details" id="appStatus">Appointment Status:&nbsp&nbsp 
                        {{ $appointment->appStatus }}
                </div>



                @if($appointment->appStatus == 'PENDING')
                
                <form method="post" action="{{ route('appointment.updateAppointmentInfo', $appointment->appID) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <label for="">Do you want to accept the appointment request?</label>&nbsp&nbsp
                    <input type="hidden" name="hidden_id" value="{{ $appointment->appID }}" />
                    <div class="buttonsConfirm">
                        <input name="appStatus" type="submit" style="width:40%" class="confirmbtn btn btn-success" value="ACCEPTED" />&nbsp&nbsp&nbsp&nbsp
                        <input name="appStatus" type="submit" style="width:40%" class="confirmbtn btn btn-danger" value="REJECTED" /> 
                    </div>
                    
                </form>
           
            </div>

                @else 

                @endif


			
        </div>

	</div>

</body>
</html>



