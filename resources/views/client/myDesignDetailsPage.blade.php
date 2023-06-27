<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Design Details Page</title>
    <link rel="stylesheet" href="/css/navbarstyle.css" >
    <link rel="stylesheet" href="/css/designdetailspagestyle.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/mydesignsliststyle.css" >
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="menu-container">
    <div class="menu">
        <div class="logo"><img src="/images/Lengkuas_Logo_1.svg" alt="LG Logo" style="width:180px;height:45px;"></div>

        <div class="links">
        <div class="home"><a href="{{ route('client.mainWindow') }}" style="color:black; text-decoration:none">Home</a></div>
            <div class="my_designs"><a href="{{ route('client.myDesignsListPage') }}" style="color:black; text-decoration:none">My Designs</a></div>
            <div class="my_orders"><a href="{{ route('client.myOrdersListPage') }}" style="color:black; text-decoration:none">My Orders</a></div>
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
				<div class="col col-md-6" id="thetitle"><b>My Design </b></div>
				
				<a href="{{ route('client.myDesignsListPage') }}" style="width:90px" class="btn btn-success btn-sm float-end" id="requestbutton">
                    <i class="fa fa-arrow-circle-left" style="font-size:25px;color:white"></i>
                </a>
			</div>
			</div>
		</div>

	
		<div class="cardbody" id="cardbody">


            <div class="leftonly">
                <div class="partDesign">
                            <img src="{{ asset('images/' . $design->partDesign) }}" width="275" />
                        
                    </div>    
            </div>

            <div class="rightonly">
                
                
                <div class="partNo">
                    <label><b>PART NO.: </b></label>
                        <b>{{ $design->partNo }}</b>
                </div>

                <div class="partName" style="text-transform: uppercase;">
                    <label>PART NAME:</label>
                        {{ $design->partDescription }}
                </div>

                <div class=" dateCreated">
                    <label>SIZE:</label>
                        {{ $design->size }}
                </div>
                    

                <div class=" dateCreated">
                    <label>MATERIAL:</label>
                        {{ $design->rawMaterialMain }}
                </div>

                <div class="dateCreated">
                    <label>DATE CREATED:</label>
                        {{ $design->created_at }}
                </div>

                <div class="size">
                    <label>UNIT PRICE:</label>
                        {{ $design->unitPrice }}
                </div>
                
                

                @if($design->designConfirmationStatus == 'PENDING')
                
                <div class="designConfirmationStatus">
                    <label>Your design quotation is still in <b>PENDING</b></label>
                </div>
                
                @elseif($design->designConfirmationStatus == 'REJECTED')

                <div class="designConfirmationStatus">
                    <label>Your design quotation is still in <b style="color:red">REJECTED</b></label>
                </div>


                @else
                <!-- STORE NEW ORDER IN ORDER TABLE -->
                <br><br>
				    <a href="{{ route('client.makeOrderPage',$design->designID) }}" style="width:50%" class="btn btn-success btn-sm float-end" id="requestbutton" class="reorderbutton">Order design</a>
                
                   

                @endif

                </div>
        </div>
        

</div>

</body>
</html>