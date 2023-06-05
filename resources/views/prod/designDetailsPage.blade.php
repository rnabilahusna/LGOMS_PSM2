<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/css/mydesignsliststyle.css" >
    <link rel="stylesheet" href="/css/navbarstyle.css" >
    <link rel="stylesheet" href="/css/proddesigndetailspagestyle.css" >
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
	<title>Design Details</title>
</head>
<body>

<div class="menu-container">
    <div class="menu">
        <div class="logo"><img src="/images/Lengkuas_Logo_1.svg" alt="LG Logo" style="width:180px;height:45px;"></div>

        <div class="links">
            <div class="home"><a href="{{ route('prod.mainWindow') }}" style="color:black; text-decoration:none">Home</a></div>
            <div class="appointment_list"><a href="{{ route('prod.RFQListPage') }}" style="text-decoration:none; color:black">RFQ List</a></div>
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
				<div class="col col-md-6" id="thetitle"><b>Order ID: {{ $design->designID }}</b></div>
				
				<a href="{{ route('prod.designsListPage') }}" class="btn btn-primary btn-sm float-end" id="requestbutton" style="width:20%">View All Design</a>
				
			</div>
			</div>
		</div>

        <div class="cardbody">

			<div class="leftinfo">
               <img class="partDesignImage" src="{{ asset('images/' . $design->partDesign) }}" width="275" />
            </div>
				
				<form method="post" action="{{ route('design.updateDesignInfo', $design->designID) }}" enctype="multipart/form-data">
					
					@csrf
					@method('PUT')

                    <div class="tworightcolumn">

                       <div class="centerinfo">

                        <div class="input-group details"> Client ID:&nbsp&nbsp&nbsp&nbsp
                            <input  name="buyerCode" value="{{$design->buyerCode}} " class="form-control"  type="text" readonly>
                        </div>

                        <!-- <div class="partDesign details" >
                            <label>Update The New Part Design:</label>
                                <input type="file" name="partDesign" />
                        </div> -->


                                <div class="input-group details" id="partNo">Part No:&nbsp&nbsp&nbsp&nbsp
                                    <input  name="partNo" value="{{$design->partNo}}" class="form-control"  type="text" readonly>
                                </div>
                        
                       
                                <div class="input-group details" id="partDescription">Part Description:&nbsp&nbsp&nbsp&nbsp
                                    <input  name="partDescription" value="{{$design->partDescription}}" class="form-control"  type="text" readonly>
                                </div>

                                <!-- <div class="input-group details" id="designConfirmationStatus">Design Status:&nbsp&nbsp&nbsp&nbsp -->
                                    <input  name="designConfirmationStatus" value="{{$design->designConfirmationStatus}}" class="form-control"  type="hidden" readonly>
                                <!-- </div> -->
                         


                        </div>
                    
        

                    <div class="rightinfo">

                        <div class="input-group details" id="unitPrice">Unit Price:&nbsp&nbsp&nbsp&nbsp
                            <input  name="unitPrice" placeholder="Unit Price (RM)" class="form-control"  type="number" step="0.01" value="{{ $design->unitPrice }}">
                        </div>

                        <div class="input-group details" id="noOfCavities">No of cavities:&nbsp&nbsp&nbsp&nbsp
                            <input  name="noOfCavities" placeholder="No of cavities"  class="form-control"  type="text" value="{{ $design->noOfCavities }}">
                        </div>

                        <div class="input-group details" id="noOfEnvelope">No of envelope:&nbsp&nbsp&nbsp&nbsp
                            <input  name="noOfEnvelope" placeholder="No of envelope" class="form-control"  type="text" value="{{ $design->noOfEnvelope }}">
                        </div>

                        <div class="input-group details" id="noOfSheets">No of sheets:&nbsp&nbsp&nbsp&nbsp
                            <input  name="noOfSheets" placeholder="No of sheets" class="form-control"  type="text" value="{{ $design->noOfSheets }}">
                        </div>

                        <div class="input-group details" id="otherMaterials">Other materials used:&nbsp&nbsp&nbsp&nbsp
                            <input  name="otherMaterials" placeholder="Other materials" class="form-control"  type="text" value="{{ $design->otherMaterials }}">
                        </div>

                        <div class="input-group details" id="noOfSheets">Usage of PE Film:&nbsp&nbsp&nbsp&nbsp
                            <select name="PEFilmApplied" class="form-group" style="width:85%; height:40px; color:grey; padding-left: 10px">
                                <option>{{ $design->PEFilmApplied }}</option>
                                <option name="PEFilmApplied" value="YES"> YES </option>
                                <option name="PEFilmApplied" value="NO"> NO </option>
                            </select>
                        </div>

                        <div class="input-group details" id="rawMaterialMain">Raw material main:&nbsp&nbsp&nbsp&nbsp
                            <input  name="rawMaterialMain" placeholder="Raw material main" class="form-control"  type="text" value="{{ $design->rawMaterialMain }}">
                        </div>

                        <div class="input-group details" id="size">Size:&nbsp&nbsp&nbsp&nbsp
                            <input  name="size" placeholder="Size" class="form-control"  type="text" value="{{ $design->size }}">
                        </div>

                        <div class="input-group details" id="thickness">Thickness:&nbsp&nbsp&nbsp&nbsp
                            <input  name="thickness" placeholder="Thickness" class="form-control"  type="text" value="{{ $design->thickness }}">
                        </div>



                    </div>
                    </div>

<br>
					<div class="text-center">
                        <input type="hidden" name="hidden_id" value="{{ $design->designID }}" />
                        <input type="submit" class="btn btn-primary float-end" id="requestbutton" value="Update design" />
			        </div>

				</form>
			

         



</div>



    
</body>
</html>