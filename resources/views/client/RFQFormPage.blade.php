

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
                    <b><p style="font-size: 280%; color:#B00000;">Let's Work With Us</p></b>
                    <p class="desc">Kindly use the form below, our person in charge
                        <br/> confirm your quotation request as soon as 
                        <br/> possible.
                    </p>
                </div>
                
                <div class="the-query">
                    <form id="addquery" class="well form-horizontal" method="post" action="{{ route('design.submitRFQ') }}" enctype="multipart/form-data">
                        @csrf

                       
                        <div class="partDesign details" >
                            <label>Upload your tech design here:</label>
                                <input type="file" name="partDesign" />
                                @if($errors->has('partDesign'))
                                        <span class="text-danger" style="color:red">{{ $errors->first('partDesign') }}</span>
                                    @endif
                        </div>


                        <div class="input-group details" id="partNo">Part No:&nbsp&nbsp&nbsp&nbsp
                            <input  name="partNo" value="{{old('partNo')}}" class="form-control"  type="text" required>
                            @if($errors->has('partNo'))
                                        <span class="text-danger" style="color:red">{{ $errors->first('partNo') }}</span>
                                    @endif
                        </div>
                        
                        <div class="input-group details" id="partDescription">Part Description:&nbsp&nbsp&nbsp&nbsp
                            <input  name="partDescription" value="{{old('partDescription')}}" class="form-control"  type="text" required>
                            @if($errors->has('partDescription'))
                                        <span class="text-danger" style="color:red">{{ $errors->first('partDescription') }}</span>
                                    @endif
                        </div>

                        <div class="input-group details" id="unitPrice">Unit Price:&nbsp&nbsp&nbsp&nbsp
                            <input  name="unitPrice" placeholder="Unit Price (RM)" class="form-control"  type="number" step="0.01" value="{{ old('unitPrice') }}" required>
                            @if($errors->has('unitPrice'))
                                        <span class="text-danger" style="color:red">{{ $errors->first('unitPrice') }}</span>
                                    @endif
                        </div>

                        <div class="input-group details" id="rawMaterialMain">Raw material main:&nbsp&nbsp&nbsp&nbsp
                            <input  name="rawMaterialMain" placeholder="Raw material main" class="form-control"  type="text" value="{{ old('rawMaterialMain') }}" required>
                            @if($errors->has('rawMaterialMain'))
                                        <span class="text-danger" style="color:red">{{ $errors->first('rawMaterialMain') }}</span>
                                    @endif
                        </div>

                        <div class="input-group details" id="size">Size:&nbsp&nbsp&nbsp&nbsp
                            <input  name="size" placeholder="Size" class="form-control"  type="text" value="{{ old('size') }}" required>
                            @if($errors->has('size'))
                                        <span class="text-danger" style="color:red">{{ $errors->first('size') }}</span>
                                    @endif
                        </div>

                        <input  name="buyerCode" value="{{auth()->user()->getClient->buyerCode}}" class="form-control"  type="hidden" required>
                        <input  name="designConfirmationStatus" value="PENDING" class="form-control"  type="hidden" >

                        <button id="requestbutton" type="submit" id="submit" class="button buttonsubmit" >Submit</button>


                    </form>
                </div>


                
            </div>
           
        </div>

    @endauth

</body>
</html>