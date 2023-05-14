<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Design Details</title>
    <link rel="stylesheet" href="/css/mydesignsliststyle.css" >
    <link rel="stylesheet" href="/css/navbarstyle.css" >
    <link rel="stylesheet" href="/css/qcdesigndetailspagestyle.css" >
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="menu-container">
    <div class="menu">
        <div class="logo"><img src="/images/Lengkuas_Logo_1.svg" alt="LG Logo" style="width:180px;height:45px;"></div>

        <div class="links">
        <div class="home"><a href="{{ route('store.mainWindow') }}" style="color:black; text-decoration:none">Home</a></div>
            <div class="order_list"><a href="{{ route('store.ordersListPage') }}" style="color:black; text-decoration:none">Order List</a></div>
            <div class="design_list"><a href="{{ route('store.designsListPage') }}" style="color:black; text-decoration:none">Design List</a></div>
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
				<div class="col col-md-6" id="thetitle"><b>Part No: {{ $design->partNo }}</b></div>
				
				<a href="{{ route('store.designsListPage') }}" class="btn btn-primary btn-sm float-end" id="requestbutton" style="width:15%">View All</a>
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


            <div class="updateQuantityForm">
			<form method="post" action="{{ route('design.updateGoodsStock', $design->designID) }}" enctype="multipart/form-data">
			
                @csrf
				@method('PUT')
			
				<label>Update the quantity:</label>
                <span class="input-group-addon"></span>
                    <input  name="goodsStock" placeholder="Quantity " class="form-control"  type="text" Required value="{{old('goodsStock')}}">
                </span>
                  
                <div class="text-center">
				    <input type="hidden" name="hidden_id" value="{{ $design->designID }}" />
				    <input type="submit" class="btn btn-primary" value="Edit" id="requestbutton"/>
			    </div>
			</form>
            </div>
        </div>
            

        <div class="right">

             <div class="detailstop" id="partNo">
                <label>Part No: </label>
					{{ $design->partNo }}
            </div>
            <div class="details" id="partDescription">
                <label>Part Description: </label>
					{{ $design->partDescription }}
            </div>
			<div class="details" id="goodsStock">
                <label>Quantity currently in stock: </label>
					{{ $design->goodsStock }}
            </div>

            <div class="details" id="unitPrice">
                <label>Unit Price:</label>
					{{ $design->unitPrice }}
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