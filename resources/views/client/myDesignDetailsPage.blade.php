<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Design Details Page</title>
    <link rel="stylesheet" href="css/navbarstyle.css" >
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="menu-container">
    <div class="menu">
        <div class="logo"><img src="images/Lengkuas_Logo_1.svg" alt="LG Logo" style="width:180px;height:45px;"></div>

        <div class="links">
            <div class="home">Home</div>
            <div class="my_designs"><a href="{{ route('client.myDesignsListPage') }}" style="color:black; text-decoration:none">My Designs</a></div>
            <div class="my_orders">My Orders</div>
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
				<div class="col col-md-6" id="thetitle"><b>Design ID: {{ $design->designID }}</b></div>
				
				<a href="{{ route('client.myDesignsListPage') }}" class="btn btn-primary btn-sm float-end">View All</a>
			</div>
			</div>
		</div>

	
		<div class="cardbody">


            <div class="row mb-3">
                    <label class="col-sm-2 col-label-form"><b>PART NO.: </b></label>
                    <div class="col-sm-10">
                         <img src="{{ asset('images/' . $design->partDesign) }}" width="75" />
                    </div>
                </div>    
            <div class="row mb-3">
                <label class="col-sm-2 col-label-form"><b>PART NO.: </b></label>
                <div class="col-sm-10">
					{{ $design->partNo }}
                </div>
            </div>
			<div class="row mb-3">
                <label class="col-sm-2 col-label-form"><b>PART NAME:</b></label>
                <div class="col-sm-10">
					{{ $design->partDescription }}
                </div>
            </div>
			<div class="row mb-3">
                <label class="col-sm-2 col-label-form"><b>DATE CREATED:</b></label>
                <div class="col-sm-10">
					{{ $design->created_at }}
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-label-form"><b>Size: </b></label>
                <div class="col-sm-10">
                    {{ $design->size }}
                </div>
            </div>
            
            

            @if($design->designConfirmationStatus == 'PENDING')
            
            <div class="row mb-4">
                    <label class="col-sm-2 col-label-form"><b>Do you approve the design?</b></label>
            </div>
            
                <div class="row mb-4">
                    <form method="post" action="{{ route('design.updateMyDesignInfo', $design->designID) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <input type="hidden" name="hidden_id" value="{{ $design->designID }}" />
                        <input name="designConfirmationStatus" type="submit" class="btn btn-success" value="ACCEPTED" />
                        <input name="designConfirmationStatus" type="submit" class="btn btn-danger" value="REJECTED" />
                    </form>
                </div>
            
            @else
            <!-- STORE NEW ORDER IN ORDER TABLE -->
            <div class="row mb-4">
                    <label class="col-sm-2 col-label-form"><b>Forecast for:</b></label>
            </div>
            
                <!-- <div class="row mb-4">
                    <form method="post" action="{{ route('design.updateMyDesignInfo', $design->designID) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <input type="hidden" name="hidden_id" value="{{ $design->designID }}" />
                        <input name="designConfirmationStatus" type="submit" class="btn btn-success" value="ACCEPTED" />
                        <input name="designConfirmationStatus" type="submit" class="btn btn-danger" value="REJECTED" />


                        <div class="form-group">
                            <div class="col-md-4 inputGroupContainer">
                                <div class="inpute-grouep">
                                    <span class="inpute-groupe-addon"></span>
                                    <label>Forecast for:</label></br>
                                    <input  id="appDate" name="appDate" placeholder="Appointment date *" class="form-control"  type="date" Required>
                                </div>
                            </div>
                        </div>


                    </form>
                </div> -->

            @endif

			
        </div>

	</div>
   
</body>
</html>