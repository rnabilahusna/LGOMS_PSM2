<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/css/mydesignsliststyle.css" >
    <link rel="stylesheet" href="/css/navbarstyle.css" >
    <!-- <link rel="stylesheet" href="/css/updatePDR.css" > -->
    <link rel="stylesheet" href="/css/RFQDetailsPagestyle.css" >
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
	<title>Dashboard</title>
</head>
<body>

<div class="menu-container">
    <div class="menu">
        <div class="logo"><img src="/images/Lengkuas_Logo_1.svg" alt="LG Logo" style="width:180px;height:45px;"></div>

        <div class="links">
            <div class="home">Home</div>
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
				<div class="col col-md-6" id="thetitle"><b>REQUEST FOR QUOTATION</b></div>
				
				<a href="{{route('prod.RFQListPage')}}" class="btn btn-primary btn-sm float-end" id="requestbutton" style="width:90px">
                <i class="fa fa-arrow-circle-left" style="font-size:25px;color:white"></i>
                </a>
			</div>
			</div>
		</div>

	
		<div class="cardbody">

            
                    <div class="leftonly">
                        <div class="partDesign">
                            <img class="partDesignImage" src="{{ asset('images/' . $design->partDesign) }}" width="275" />
                        </div>    
                    </div>

                    <div class="rightonly">
                    
                    
                        <div class="partNo">
                            <label><b>PART NO.: </b></label>
                                <b>{{ $design->partNo }}</b>
                        </div>

                        <div class="details partName" style="text-transform: uppercase;">
                            <label>PART NAME:</label>
                                {{ $design->partDescription }}
                        </div>

                        <div class="details size">
                            <label>SIZE:</label>
                                {{ $design->size }}
                        </div>
                    

                        <div class="details rawMaterialMain">
                            <label>MATERIAL:</label>
                                {{ $design->rawMaterialMain }}
                        </div>

                        <div class="details unitPrice">
                            <label>UNIT PRICE:</label>
                                {{ $design->unitPrice }}
                        </div>
                        
                        

                        <div class="details designConfirmationStatus">
                                <br><label>Do you want to approve the quotation?</label><br><br>
                        </div>
                        
                            <div class="row mb-4">
                                <form method="post" action="{{ route('design.updateQuotationStatus', $design->designID) }}" enctype="multipart/form-data" class="buttons">
                                    @csrf
                                    @method('PUT')
                                    
                                    <input type="hidden" name="hidden_id" value="{{ $design->designID }}" />
                                    <input type="hidden" name="buyerCode" value="{{ $design->buyerCode }}" />
                                    <div class="confirmbutton">
                                        <input name="designConfirmationStatus" type="submit" class="btn btn-success" value="ACCEPTED" />&nbsp&nbsp&nbsp&nbsp
                                        <input name="designConfirmationStatus" type="submit" class="btn btn-danger rejectbutton" value="REJECTED" />
                                    </div>
                                </form>
                            </div>
                    
                

                    </div>
               
        </div>


    </div>

 @endauth

    
</body>
</html>