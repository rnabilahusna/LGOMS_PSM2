<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/css/mydesignsliststyle.css" >
    <link rel="stylesheet" href="/css/navbarstyle.css" >
    <link rel="stylesheet" href="/css/qcdesigndetailspagestyle.css" >
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
	<title>Design Details</title>
</head>
<body>
<div class="menu-container">
    <div class="menu">
        <div class="logo"><img src="/images/Lengkuas_Logo_1.svg" alt="LG Logo" style="width:180px;height:45px;"></div>

        <div class="links">
            <div class="home"><a href="{{ route('sales.mainWindow') }}" style="color:black; text-decoration:none">Home</a></div>
            <div class="register_user"><a href="{{ route('register.index') }}" style="color:black; text-decoration:none">Register User</a></div>
            <div class="order_list"><a href="{{ route('sales.ordersListPage') }}" style="color:black; text-decoration:none">Order List</div>
            <div class="design_list"><a href="{{ route('sales.designsListPage') }}" style="color:black; text-decoration:none">Design List</a></div>
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
				<div class="col col-md-6" id="thetitle"><b>Design ID: {{ $design->designID }}</b></div>
				
				<a href="{{ route('sales.designsListPage') }}" class="btn btn-primary btn-sm float-end" id="requestbutton" style="width:15%">View All</a>
			</div>
			</div>
		</div>

	
		<div class="cardbody_qc">

        <div class="left">
            <div class="row mb-3">
                <label class="col-sm-2 col-label-form"></label>
                <div class="col-sm-10">
                    <img class="partDesignImage" src="{{ asset('images/' . $design->partDesign) }}" width="275" />
                </div>
            </div>
        </div>
            

        <div class="right">

            <div class="detailstop" id="partDescription">
                <label>Part Description: </label>
					{{ $design->partDescription }}
            </div>
			<div class="details" id="goodsStock">
                <label>Quantity currently in stock: </label>
					{{ $design->goodsStock }}
            </div>

            <div class="details" id="noOfCavities">
                <label>No of cavities: </label>
					{{ $design->noOfCavities }}
            </div>

            <div class="details" id="noOfEnvelope">
                <label>No of envelope:</label>
					{{ $design->noOfEnvelope }}
            </div>

            <div class="details" id="noOfSheets">
                <label>No of sheets:</label>
					{{ $design->noOfSheets }}
            </div>

    
        </div>
            
			
        </div>

			
        </div>
	

</body>
</html>


