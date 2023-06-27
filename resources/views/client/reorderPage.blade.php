<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Design Details Page</title>
    <link rel="stylesheet" href="/css/navbarstyle.css" >
    <link rel="stylesheet" href="/css/updateJO.css" >
    <!-- <link rel="stylesheet" href="/css/designdetailspagestyle.css" > -->
    <link rel="stylesheet" href="/css/mydesignsliststyle.css" >
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
				<div class="col col-md-6" id="thetitle"><b>Purchase Order </b></div>
				    <a href="{{ route('client.getClientOrdersHistoryListPage') }}" style="width:90px" class="btn btn-success btn-sm float-end" id="requestbutton">
                        <i class="fa fa-arrow-circle-left" style="font-size:25px;color:white"></i>
                    </a>
			    </div>
			</div>
		</div>

	
		<div class="cardbody" id="cardbody">

        <form method="post" action="{{ route('order.submitOrder') }}" enctype="multipart/form-data">
					
					@csrf
					@method('POST')

        <hr>
        <!-- FIRST ROW -->
        <div class="firstbigrow">
            <div class="leftonly firstrow">
                
                <div class="input-group details"> Buyer Code / Abbrevation:&nbsp&nbsp&nbsp&nbsp
                    <input  name="buyerCode" value="{{$order->getClient->buyerCode}} " class="form-control"  type="text" readonly>
                </div>
                <div class="input-group details"> Buyer Name:&nbsp&nbsp&nbsp&nbsp
                    <input  name="buyerName" value="{{$order->getClient->buyerName}} " class="form-control"  type="text" readonly>
                </div>
                <div class="input-group details"> Buyer Address:&nbsp&nbsp&nbsp&nbsp
                    <input  name="buyerAddress" value="{{$order->getClient->buyerAddress}} " class="form-control"  type="text" readonly>
                </div>
                <div class="input-group details"> Buyer Section Code / Name:&nbsp&nbsp&nbsp&nbsp
                    <input  name="buyerSectionCodeOrName" value="{{$order->getClient->buyerSectionCodeOrName}} " class="form-control"  type="text" readonly>
                </div>
                

            </div>
            
            <div class="rightonly firstrow">
                <div class="input-group details"> Buyer Correspondent / Name:&nbsp&nbsp&nbsp&nbsp
                    <input  name="buyerCorrespondentOrName" value="{{$order->getClient->buyerCorrespondentOrName}} " class="form-control"  type="text" readonly>
                </div>
                <div class="input-group details"> Authorization Code / Name:&nbsp&nbsp&nbsp&nbsp
                    <input  name="authorizationCodeOrName" value="{{$order->getClient->authorizationCodeOrName}} " class="form-control"  type="text" readonly>
                </div>
                <div class="input-group details"> Contact No:&nbsp&nbsp&nbsp&nbsp
                    <input  name="contactNum" value="{{auth()->user()->contactNum}} " class="form-control"  type="text" readonly>
                </div>
                <div class="input-group details"> Email:&nbsp&nbsp&nbsp&nbsp
                    <input  name="email" value="{{auth()->user()->email}} " class="form-control"  type="email" readonly>
                </div>

            </div>
        </div>

        <hr>
        <!-- SECOND ROW -->
        <div class="secondbigrow">
            <div class="leftonly secondrow">

                <div class="input-group details"> P/O No:&nbsp&nbsp&nbsp&nbsp
                    <input  name="PONo" value="{{old('PONo')}} " class="form-control"  type="text">
                </div>
                <div class="input-group details"> Creation Date:*&nbsp&nbsp&nbsp&nbsp
                    <input  name="creationDate" value="{{$order->creationDate}} " class="form-control"  type="date">
                </div>
                <div class="input-group details"> Quotation No:&nbsp&nbsp&nbsp&nbsp
                    <input  name="QuotationNo" value="{{$order->QuotationNo}} " class="form-control"  type="text">
                </div>
            </div>

            <div class="rightonly secondrow">
                <div class="input-group details"> Order Status:&nbsp&nbsp&nbsp&nbsp
                    <input  name="orderStatus" value="NEW" class="form-control"  type="text" readonly>
                </div>
                <div class="input-group details"> Issued Date:*&nbsp&nbsp&nbsp&nbsp
                    <input  name="IssuedDate" value="{{$order->IssuedDate}} " class="form-control"  type="date">
                </div>
               
            </div>
        
        </div>

        <hr>
        <!-- THIRD ROW -->
        <div class="thirdbigrow">
            <div class="leftonly thirdrow">

                <div class="input-group details"> Shipping Term:&nbsp&nbsp&nbsp&nbsp
                    <input  name="shippingTerm" value="{{$order->shippingTerm}} " class="form-control"  type="text">
                </div>
                <div class="input-group details"> Payment Term:&nbsp&nbsp&nbsp&nbsp
                    <input  name="paymentTerm" value="{{$order->paymentTerm}} " class="form-control"  type="text">
                </div>
                <div class="input-group details"> Term Of Payment:&nbsp&nbsp&nbsp&nbsp
                    <input  name="termOfPayment" value="{{$order->termOfPayment}} " class="form-control"  type="text">
                </div>
                <div class="input-group details"> Comment:&nbsp&nbsp&nbsp&nbsp
                    <input  name="comment" value="{{$order->comment}} " class="form-control"  type="textarea">
                </div>
            </div>

            <div class="rightonly thirdrow">
                <div class="input-group details"> Currency Code:&nbsp&nbsp&nbsp&nbsp
                    <input  name="currencyCode" value="{{$order->currencyCode}} " class="form-control"  type="text">
                </div>
                <div class="input-group details"> Shipping Mode:&nbsp&nbsp&nbsp&nbsp
                    <input  name="shippingMode" value="{{$order->shippingMode}} " class="form-control"  type="text">
                </div>
                <div class="input-group details"> Remark:&nbsp&nbsp&nbsp&nbsp
                    <input  name="remark" value="{{$order->remark}} " class="form-control"  type="textarea">
                </div>
                <div class="input-group details"> Place Of Delivery:&nbsp&nbsp&nbsp&nbsp
                    <input  name="placeOfDelivery" value="{{$order->placeOfDelivery}} " class="form-control"  type="text">
                </div>
            </div>
        
        </div>


        <hr>
        <!-- FOURTH ROW -->
        <div class="fourthbigrow">
        <table>
            <tr>
                <th class="column colone">Line No</th>
                <th class="column coltwo">Action Code*</th>
                <th class="column colthree" style="width:10%">Part No</th>
                <th class="column colfour">Part Description</th>
                <th class="column colfive">Sales Unit Price Basis (UOM)</th>
                <th class="column colsix">Quantity Per Package (UOM)*</th>
                <th class="column colseven">Unit Price</th>
                <th class="column coleight">Quantity*</th>
                <th class="column colnine">UOM</th>
                <th class="column colten">Reference Data / ETD</th>
                <th class="column coleleven">Delivery Date / ETA*</th>
                <th class="column coltwelve">Amount</th>
                <th class="column colonethree">R/O No</th>
            </tr>
            <tr>
                <td><input  name="lineNo" placeholder="Line No" class="form-control"  type="number" value="{{ $order->lineNo }}"></td>
                <td><input  name="actionCode" placeholder="Action Code" class="form-control"  type="text" value="NEW" readonly></td>
                <td><input  name="partNo" placeholder="Part No" class="form-control"  type="text" value="{{ $order->partNo }}" readonly></td>
                <td><input  name="partDescription" placeholder="Part Description" class="form-control"  type="text" value="{{ $order->partDescription }}" readonly></td>
                <td><input  name="salesUnitPriceBasisUOM" placeholder="Sales Unit Price Basis (UOM)" class="form-control"  type="number" value="{{ $order->salesUnitPriceBasisUOM }}"></td>
                <td><input  name="quantityPerPackageUOM" placeholder="Quantity Per Package (UOM)" class="form-control"  type="number" value="{{ $order->quantityPerPackageUOM }}"></td>
                <td><input  name="unitPrice" placeholder="Unit Price (RM)" class="form-control"  type="number" step="0.01" value="{{ $order->unitPrice }}" readonly></td>
                <td><input  name="quantity" placeholder="Quantity" class="form-control"  type="number" value="{{ $order->quantity }}" Required></td>
                <td><input  name="UOM" placeholder="UOM" class="form-control"  type="text" value="{{ $order->UOM }}"></td>
                <td><input  name="referenceDateETD" placeholder="Reference Data / ETD" class="form-control"  type="date" value="{{ $order->referenceDateETD }}"></td>
                <td><input  name="deliveryDateETA" placeholder="Delivery Date / ETA" class="form-control"  type="date" value="{{ $order->deliveryDateETA }}" required></td>
                <td><input  name="amount" placeholder="Amount" class="form-control"  type="number" value="{{ $order->amount }}"></td>
                <td><input  name="RONo" placeholder="R/O No" class="form-control"  type="number" value="{{ $order->RONo }}"></td>
            </tr>
        </table>
        </div>

        <div class="text-center">
            <input type="hidden" name="paymentStatus" value="PENDING" />          
            <input type="hidden" name="designID" value="{{ $order->getDesign->designID }}" />
            <input type="hidden" name="goodsStock" value="{{ $order->getDesign->goodsStock }}" />
            <br>
            <input type="submit" class="btn btn-primary float-end" id="requestbutton" value="Submit Order" />
		</div>



</form>
        </div>
        

</div>
@endauth 

</body>
</html>