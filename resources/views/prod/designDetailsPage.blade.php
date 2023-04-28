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
				<div class="col col-md-6" id="thetitle"><b>Order ID: {{ $design->designID }}</b></div>
				
				<a href="{{ route('prod.designsListPage') }}" class="btn btn-primary btn-sm float-end">View All Design</a>
				
			</div>
			</div>
		</div>

        <div class="cardbody">

			<div class="leftinfo">
				<div><img src="{{ asset('images/' . $design->partDesign) }}" width="75" /></div>
				<form method="post" action="{{ route('design.updateDesignInfo', $design->designID) }}" enctype="multipart/form-data">
					
					@csrf
					@method('PUT')

                    <div class="leftcontent">


                        <div class="form-group">
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"></span>
                                    <input  name="buyerCode" value="{{$design->buyerCode}} " class="form-control"  type="text" readonly>
                                   
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form"><b>Current Part Design:</b></label>
                            <div class="col-sm-10">
                            <img src="{{ asset('images/' . $design->partDesign) }}" width="75" />
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label class="col-sm-2 col-label-form">Update The New Part Design:</label>
                            <div class="col-sm-10">
                                <input type="file" name="partDesign" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"></span>
                                    <input  name="partNo" value="{{$design->partNo}} " class="form-control"  type="text" readonly>
                                   
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"></span>
                                    <input  name="partDescription" value="{{$design->partDescription}} " class="form-control"  type="text" readonly>
                                   
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"></span>
                                    <input  name="designConfirmationStatus" value="{{$design->designConfirmationStatus}} " class="form-control"  type="text" readonly>
                                   
                                </div>
                            </div>
                        </div>

        

                    

                        <div class="form-group">
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"></span>
                                    <input  name="noOfCavities" placeholder="No of cavities"  class="form-control"  type="text" value="{{ $design->noOfCavities }}">
                                   
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"></span>
                                    <input  name="noOfEnvelope" placeholder="No of envelope" class="form-control"  type="text" value="{{ $design->noOfEnvelope }}">
                                   
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"></span>
                                    <input  name="noOfSheets" placeholder="No of sheets" class="form-control"  type="text" value="{{ $design->noOfSheets }}">
                                   
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"></span>
                                    <input  name="otherMaterials" placeholder="Other materials" class="form-control"  type="text" value="{{ $design->otherMaterials }}">
                                   
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"></span>
                                    <select name="PEFilmApplied" class="form-group" style="width:85%; height:40px; color:grey; padding-left: 10px">
                                        <option>{{ $design->PEFilmApplied }}</option>
                                        <option name="PEFilmApplied" value="YES"> YES </option>
                                        <option name="PEFilmApplied" value="NO"> NO </option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"></span>
                                    <input  name="rawMaterialMain" placeholder="Raw material main" class="form-control"  type="text" value="{{ $design->rawMaterialMain }}">
                                   
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"></span>
                                    <input  name="size" placeholder="Size" class="form-control"  type="text" value="{{ $design->size }}">
                                   
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"></span>
                                    <input  name="thickness" placeholder="Thickness" class="form-control"  type="text" value="{{ $design->thickness }}">
                                   
                                </div>
                            </div>
                        </div>

                    </div>
                       


					<div class="text-center">
                        <input type="hidden" name="hidden_id" value="{{ $design->designID }}" />
                        <input type="submit" class="btn btn-primary" value="Update Design" />
			        </div>

				</form>
			</div>

         



</div>



    
</body>
</html>