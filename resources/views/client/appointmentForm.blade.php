

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Form</title>
    <link rel="stylesheet" href="css/makeappointmentstyle.css" >
    <link rel="stylesheet" href="css/navbarstyle.css" >
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
</head>
<body>


<!-- @if($errors->any())

<div class="alert alert-danger">
	<ul>
	@foreach($errors->all() as $error)

		<li>{{ $error }}</li>

	@endforeach
	</ul>
</div>

@endif -->

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

       
        
    </div>
</div>

@if($message = Session::get('success'))

<div class="alert alert-success">
    {{ $message }}
</div>

@endif



<div class="content-container">
            
            <div class="contents">
                <div class="contents-title">
                    <b><p style="font-size: 280%; color:#B00000;">Let's Meet With Us</p></b>
                    <p class="desc">Kindly use the form below, our person in charge
                        <br/> confirm your appointment request as soon as 
                        <br/> possible.
                    </p>
                </div>
                
                <div class="the-query">
                    <form id="addquery" class="well form-horizontal" method="post" action="{{ route('appointment.store') }}" enctype="multipart/form-data">
                        @csrf

                        
                        <div class="form-group">
                            <div class="col-md-4 inputGroupContainer">
                                <div class="inpute-groupe">
                                    <span class="inpute-groupe-addon"></span>
                                    <label>Client ID</label></br>
                                    <input  id="buyerCode" name="buyerCode" placeholder="Client ID *" class="form-control"  value="{{ auth()->user()->getClient->buyerCode }}" type="text" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4 inputGroupContainer">
                                <div class="inpute-groupe">
                                    <span class="inpute-groupe-addon"></span>
                                    <label>Appointment purpose</label></br>
                                    <input  id="appPurpose" name="appPurpose" placeholder="Appointment purpose *" class="form-control"  type="text" Required>
                                </div>
                            </div>
                        </div>

                        <div class="date-time">
                            <div class="form-group">
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="inpute-grouep">
                                        <span class="inpute-groupe-addon"></span>
                                        <label>Appointment date</label></br>
                                        <input  id="appDate" name="appDate" placeholder="Appointment date *" class="form-control"  type="date" Required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="inpute-groupe">
                                        <span class="inpute-groupe-addon"></span>
                                        <label>Appointment time</label></br>
                                        <input  id="appTime" name="appTime" class="form-control"  type="time" Required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input  id="appStatus" name="appStatus" type="text" value="PENDING" hidden>


                        <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <button type="submit" id="submit" class="button buttonsubmit" >Submit Request</button>
                        </div>

                    </div>
                    </form>
                </div>


                
            </div>
           
        </div>

    @endauth

</body>
</html>