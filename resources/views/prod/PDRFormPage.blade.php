<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/css/mydesignsliststyle.css" >
    <link rel="stylesheet" href="/css/navbarstyle.css" >
    <link rel="stylesheet" href="/css/updatePDR.css" >
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

<!-- display returned message from the controllers if success -->
    @if($message = Session::get('success'))

	<div class="alert alert-success">
		{{ $message }}
	</div>

	@endif

    <div class="card">		
    <div class="cardheader">
			<div class="row">
				<div class="col col-md-6" id="thetitle"><b>PRODUCT DELIVERY REPORT</b></div>
				
				<a href="{{route('order.showForProdP',$pdr->getOrder->id)}}" class="btn btn-primary btn-sm float-end" id="requestbutton" style="width:90px">
                <i class="fa fa-arrow-circle-left" style="font-size:25px;color:white"></i>
                </a>
			</div>
			</div>
		</div>
	
		<div class="cardbody">
        <!-- submit the form to update the PRD -->
        <form id="PDRForm" method="post" action="{{ route('prod.updatePDRFormPageForProdP', $pdr->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

        <div class="bigrow">
            <div class="leftonly">

                <div class="input-group details"> CUSTOMER NAME:&nbsp&nbsp&nbsp&nbsp
                    <input  name="buyerName" value="{{$pdr->buyerName}} " class="form-control"  type="text" readonly>
                </div>
                <div class="input-group details"> MONTH:&nbsp&nbsp&nbsp&nbsp
                    <input  name="month" value="{{ $pdr->month }} " class="form-control" readonly>
                </div>
            </div>

            <div class="rightonly">
                <div class="input-group details"> DATE OF ISSUE:&nbsp&nbsp&nbsp&nbsp
                    <input  name="IssuedDate" value="{{$pdr->IssuedDate}} " class="form-control" readonly>
                </div>
                <div class="input-group details"> REPORT DATE:&nbsp&nbsp&nbsp&nbsp
                    <input  name="reportDate" value="{{$pdr->reportDate}} " class="form-control"  readonly>
                </div>
                <div class="input-group details"> REF NO:&nbsp&nbsp&nbsp&nbsp
                    <input  name="refNo" value="{{$pdr->refNo}} " class="form-control"  type="text" readonly>
                </div>
            </div>
        </div>
        <hr>
    
        <table>
            <tr>
                <th class="column colone">NO.</th>
                <th class="column coltwo">PART ID/PART NAME</th>
                <th class="column colthree">PO NO</th>
                <th class="column colfour">STOCK</th>
                <th class="column colfive">DLV QTY</th>
                <th class="column colsix">BAL</th>
                <th class="column colseven">DELIVERY DATE</th>
                <th class="column coleight">DI NO</th>
                <th class="column colnine">JOB ORDER NO.</th>
                <th class="column colten">DO NO</th>
                <th class="column coleleven">JOB ORDER DATE</th>
                <th class="column coltwelve">DELIVERED DATE</th>
                <th class="column colonethree">DAYS DELAYED</th>
                <th class="column colonefour">DO NO</th>
            </tr>
            <tr>
                <td><input  name="no" class="form-control"  type="number" value="{{ $pdr->no }}" readonly></td>
                <td><input  name="partIDOrName" class="form-control"  type="text" value="{{$pdr->partIDOrName}}" readonly></td>
                <td><input  name="PONo" class="form-control"  type="text" value="{{ $pdr->PONo }}" readonly></td>
                <td><input  name="stock" class="form-control"  type="number" value="{{ $pdr->stock }}" readonly></td>
                <td><input  name="deliveryQuantity" class="form-control"  type="number" value="{{ $pdr->deliveryQuantity }}" readonly></td>
                <td><input  name="balance" class="form-control"  type="number" value="{{ $pdr->balance }}" readonly></td>
                <td><input  name="deliveryDate" class="form-control"  value="{{ $pdr->deliveryDate }}" readonly></td>
                <td><input  name="DINo" class="form-control"  type="text" value="{{ $pdr->DINo }}" readonly></td>
                <td><input  name="JONo" class="form-control"  type="text" value="{{ $pdr->JONo }}"></td>
                <td><input  name="DONoSales1" class="form-control"  type="text" value="{{ $pdr->DONoSales1 }}"></td>
                <td><input  name="jobOrderDate" class="form-control"  type="date" value="{{ $pdr->jobOrderDate }}" readonly></td>
                <td><input  name="deliveredDate" class="form-control"  type="date" value="{{ $pdr->deliveredDate }}" readonly></td>
                <td><input  name="daysDelayed" class="form-control"  type="number" value="{{ $pdr->daysDelayed }}" readonly></td>
                <td><input  name="DONoSales2" class="form-control"  type="number" value="{{ $pdr->DONoSales2 }}" readonly></td>
            </tr>
        </table>
        <hr>

        <div class="lastrow">
            <div>
                <b>PRODUCED BY:</b>
                <input  name="producedBy" class="form-control"  type="text" value="{{ $pdr->producedBy }}" readonly>
            </div>
            <div>
                <b>APPROVED BY:</b>
                <input  name="approvedBy" class="form-control"  type="text" value="{{ $pdr->approvedBy }}">
            </div>
            <div>
                <b>ACCEPTED BY:</b>
                <input  name="acceptedBy" class="form-control"  type="text" value="{{ $pdr->acceptedBy }}">
            </div>
        </div>

        <div class="text-center">
            <input type="hidden" name="hidden_id" value="{{ $pdr->id }}" />
            <input type="hidden" name="orderID" value="{{$pdr->getOrder->id}}" />
            <input type="hidden" name="buyerCode" value="{{$pdr->getClient->buyerCode}}" />
            <br>
            <input type="submit" class="btn btn-primary float-end" id="requestbutton" value="Update" />
		</div>      
		</form>	
        </div>
    </div>

 @endauth
   
</body>
</html>