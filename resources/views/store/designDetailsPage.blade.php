<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
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
            <div class="order_list"><a href="{{ route('store.ordersListPage') }}" style="color:black; text-decoration:none">Order List</a></div>
            <div class="design_list"><a href="{{ route('store.designsListPage') }}" style="color:black; text-decoration:none">Design List</a></div>
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
				<div class="col col-md-6" id="thetitle"><b>Part No: {{ $design->partNo }}</b></div>
				
				<a href="{{ route('store.designsListPage') }}" class="btn btn-primary btn-sm float-end">View All</a>
			</div>
			</div>
		</div>

        
	
		<div class="cardbody">

            <div class="row mb-3">
                <label class="col-sm-2 col-label-form"><b>Part Design</b></label>
                <div class="col-sm-10">
                    <img src="{{ asset('images/' . $design->partDesign) }}" width="75" />
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-label-form"><b>Part No: </b></label>
                <div class="col-sm-10">
					{{ $design->partNo }}
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-label-form"><b>Part Description: </b></label>
                <div class="col-sm-10">
					{{ $design->partDescription }}
                </div>
            </div>
			<div class="row mb-3">
                <label class="col-sm-2 col-label-form"><b>Quantity currently in stock: </b></label>
                <div class="col-sm-10">
					{{ $design->goodsStock }}
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-label-form"><b>No of cavities: </b></label>
                <div class="col-sm-10">
					{{ $design->noOfCavities }}
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-label-form"><b>No of envelope: </b></label>
                <div class="col-sm-10">
					{{ $design->noOfEnvelope }}
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-label-form"><b>No of sheets: </b></label>
                <div class="col-sm-10">
					{{ $design->noOfSheets }}
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-label-form"><b>Updated quantity: </b></label>
                <div class="col-sm-10">
                <div class="form-group">
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    
                                </div>
                            </div>
                        </div>
                </div>
            </div>


            

			<div class="row mb-4">
			<form method="post" action="{{ route('design.updateGoodsStock', $design->designID) }}" enctype="multipart/form-data">
			
                @csrf
				@method('PUT')
			
				
                <span class="input-group-addon"></span>
                    <input  name="goodsStock" placeholder="Updated quantity " class="form-control"  type="text" Required value="{{old('goodsStock')}}">
                </span>
                  
                <div class="text-center">
				    <input type="hidden" name="hidden_id" value="{{ $design->designID }}" />
				    <input type="submit" class="btn btn-primary" value="Edit" />
			    </div>
			</form>
            </div>


			
        </div>

	</div>
    
</body>
</html>