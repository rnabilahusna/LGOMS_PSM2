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
	<title>Upload Design</title>
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
				<div class="col col-md-6" id="thetitle"><b>Upload Design</b></div>
				<div class="col col-md-6">
					<a href="{{route('prod.designsListPage')}}" class="btn btn-success btn-sm float-end" id="requestbutton" >View All Design</a>
				</div>
			</div>
		</div>

	

		<div class="cardbody">
                    <form id="addquery" class="well form-horizontal" method="post" action="{{ route('design.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-4">
                            <label class="col-sm-2 col-label-form">Part Design</label>
                            <div class="col-sm-10">
                                <input type="file" name="partDesign" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4 inputGroupContainer">
                                <div class="inpute-groupe">
                                    <span class="inpute-groupe-addon"></span>
                                    <label>Date Created:</label></br>
                                    <input  id="created_at" name="created_at" class="form-control"  type="date" Required value="{{old('created_at')}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4 inputGroupContainer">
                                <div class="inpute-groupe">
                                    <span class="inpute-groupe-addon"></span>
                                    <label>Part No:</label></br>
                                    <input  id="partNo" name="partNo" class="form-control"  type="text" Required value="{{old('partNo')}}">
                                </div>
                            </div>
                        </div>

                        <div class="date-time">
                            <div class="form-group">
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="inpute-grouep">
                                        <span class="inpute-groupe-addon"></span>
                                        <label>Part Name:</label></br>
                                        <input  id="partDescription" name="partDescription" class="form-control"  type="text" Required value="{{old('partDescription')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="inpute-groupe">
                                        <span class="inpute-groupe-addon"></span>
                                        <label>Client ID:</label></br>
                                        <input  id="buyerCode" name="buyerCode" class="form-control"  type="text" Required value="{{old('buyerCode')}}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input  id="designConfirmationStatus" name="designConfirmationStatus" type="text" value="PENDING" hidden>

                        
                        <div class="form-group">
                            <label class="col-md-4 control-label"></label>
                            <div class="col-md-4">
                                <button type="submit" id="submit" class="button buttonsubmit" >Upload</button>
                            </div>

                        </div>
                    </form>
              

		</div>


		
	</div>

</body>
</html>



