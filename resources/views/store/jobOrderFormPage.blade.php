<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- <link rel="stylesheet" href="/css/mydesignsliststyle.css" > -->
    <link rel="stylesheet" href="/css/navbarstyle.css" >
    <link rel="stylesheet" href="/css/updateJO.css" >
    <!-- <link rel="stylesheet" href="/css/stafforderdetailspagestyle.css" > -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
	<title>Order Details</title>
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
        
    </div>
</div>

	@if($message = Session::get('success'))

	<div class="alert alert-success">
		{{ $message }}
	</div>

	@endif


    <div class="card">
		
        <div class="cardheader">
                <div class="">
                    <div class="col col-md-6" id="thetitle"><b>JOB ORDER</b></div>
                    
                    <a href="{{route('order.showForStoreP',$order->id)}}" class="btn btn-primary btn-sm float-end" id="requestbutton" style="width:15%">Back</a>
                </div>
                
        </div>
    
        
            <div class="cardbody">
    
                <form id="JobOrderForm" method="post" action="{{ route('joborder.createJobOrderFormPageForStoreP') }}" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        
                        <div class="theheader">
                            <div class="leftheader" style="width:35%">
                                <div class="input-group details"> <b>PO NO:</b>&nbsp&nbsp&nbsp&nbsp
                                    <input  name="PONo" value="{{$order->getPDR->PONo}}" class="form-control"  type="text" >
                                </div>
                                <div class="input-group details"> STOCK:&nbsp&nbsp&nbsp&nbsp
                                    <input  name="stock" value="{{old('stock')}}" class="form-control"  type="number" >
                                </div>
                            </div>

                            <div class="rightheader" style="width:35%">
                                <div class="input-group details"> <b>DATE:</b>&nbsp&nbsp&nbsp&nbsp
                                    <input  name="JODate" value="{{old('JODate')}}" class="form-control"  type="date" >
                                </div>
                                <div class="input-group details"> J.O NO:&nbsp&nbsp&nbsp&nbsp
                                    <input  name="JONo" value="{{old('JONo')}}" class="form-control"  type="text" >
                                </div>
                                <div class="input-group details">RAW MATERIAL APPROVED:&nbsp&nbsp&nbsp&nbsp
                                    <input  name="rawMaterialApproved" value="{{old('rawMaterialApproved')}}" class="form-control"  type="text" >
                                </div>
                            </div>
                        </div>
                    
                <hr>
                <div class="uppertables">
                    <table class="firsttable" style="width:35%">
                        <tr>
                            <td colspan="2" style="text-align:center"><b>J O INFORMATION</b></td>
                        </tr>
                        <tr>
                            <td colspan="2"> </td>
                        </tr>
                        <tr>
                            <td>CUSTOMER NAME:</td>
                            <td><input  name="buyerCode" value="{{$order->getPDR->buyerCode}}" class="form-control"  type="text" readonly></td>
                        </tr>
                        <tr>
                            <td>PRODUCT NAME:</td>
                            <td><input  name="partDescription" value="{{$order->partDescription}}" class="form-control"  type="text" readonly></td>
                        </tr>
                        <tr>
                            <td>PRODUCT CODE:</td>
                            <td><input  name="partNo" value="{{$order->partNo}}" class="form-control"  type="text" readonly></td>
                        </tr>
                        <tr>
                            <td>PRODUCT J O QTY:</td>
                            <td><input  name="productJOQuantity" value="{{old('productJOQuantity')}}" class="form-control"  type="number" ></td>
                        </tr>
                        <tr>
                            <td>PRODUCT READY DATE:</td>
                            <td><input  name="productReadyDate" value="{{old('productReadyDate')}}" class="form-control"  type="date" ></td>
                        </tr>
                        <tr>
                            <td>JOB START DATE:</td>
                            <td><input  name="jobStartDate" value="{{old('jobStartDate')}}" class="form-control"  type="date" ></td>
                        </tr>
                        <tr>
                            <td>JOB END DATE:</td>
                            <td><input  name="jobEndDate" value="{{old('jobEndDate')}}" class="form-control"  type="date" ></td>
                        </tr>
                        <tr>
                            <td>SAMPLE AVAILABLE:</td>
                            <td><input  name="sampleAvailable" value="{{old('sampleAvailable')}}" class="form-control"  type="text" ></td>
                        </tr>
                        <tr>
                            <td>FILM AVAILABLE:</td>
                            <td><input  name="filmAvailable" value="{{old('filmAvailable')}}" class="form-control"  type="text" ></td>
                        </tr>
                        <tr>
                            <td>PO RECEIVED DATE:</td>
                            <td><input  name="POReceivedDate" value="{{old('POReceivedDate')}}" class="form-control"  type="date" ></td>
                        </tr>
                        
                    </table>

                    <table class="secondtable" style="width:35%">
                        <tr>
                            <td colspan="2" style="text-align:center"><b>RAW MATERIAL USED</b></td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>RAW MATERIAL-MAIN:</td>
                            <td><input  name="rawMaterialMain" value="{{$order->getDesign->rawMaterialMain}}" class="form-control"  type="text" ></td>
                        </tr>
                        <tr>
                            <td>THICKNESS:</td>
                            <td><input  name="thickness" value="{{$order->getDesign->thickness}}" class="form-control"  type="text" ></td>
                        </tr>
                        <tr>
                            <td>SIZE:</td>
                            <td><input  name="size" value="{{$order->getDesign->size}}" class="form-control"  type="text" ></td>
                        </tr>
                        <tr>
                            <td>NO OF SHEETS:</td>
                            <td><input  name="noOfSheets" value="{{$order->getDesign->noOfSheets}}" class="form-control"  type="number" ></td>
                        </tr>
                        <tr>
                            <td>NO OF CAVITIES:</td>
                            <td><input  name="noOfCavities" value="{{$order->getDesign->noOfCavities}}" class="form-control"  type="number" ></td>
                        </tr>
                        <tr>
                            <td>OTHER MATERIALS:</td>
                            <td><input  name="otherMaterials" value="{{$order->getDesign->otherMaterials}}" class="form-control"  type="text" ></td>
                        </tr>
                        <tr>
                            <td>ADHESIVE APPLIED:</td>
                            <td><input  name="adhesiveApplied" value="{{old('adhesiveApplied')}}" class="form-control"  type="text" ></td>
                        </tr>
                        <tr>
                            <td>PE FILM APPLIED:</td>
                            <td><input  name="PEFilmApplied" value="{{$order->getDesign->PEFilmApplied}}" class="form-control"  type="text" ></td>
                        </tr>
                        <tr>
                            <td>NO OF ENVELOPE:</td>
                            <td><input  name="noOfEnvelope" value="{{$order->getDesign->noOfEnvelope}}" class="form-control"  type="number" ></td>
                        </tr>
                        <tr>
                            <td>PO QUANTITY:</td>
                            <td><input  name="POQuantity" value="{{old('POQuantity')}}" class="form-control"  type="number" ></td>
                        </tr>
                        
                    </table>
                </div>
                
                <hr>
                <div class="middletable">
                    <table class="newrow">
                        <tr>
                            <th class="column colone">NO</th>
                            <th class="column coltwo">DATE IN</th>
                            <th class="column colthree">QTY IN</th>
                            <th class="column colfour">PROCESSESS CARRIED OUT</th>
                            <th class="column colfive">DATE OUT</th>
                            <th class="column colsix">OUTPUT</th>
                            <th class="column colseven">OTY NO GOOD</th>
                            <th class="column coleight">BALANCE</th>
                            <th class="column colnine">OPERATOR NAME</th>
                            <th class="column colten">OPERATOR SIGNATURE</th>
                        </tr>
                        <tr>
                            <td><input type="number" class="form-control" name="no[]" value="{{old('no')}}"></td>
                            <td><input type="date" class="form-control" name="dateIn[]" value="{{old('dateIn')}}"></td>
                            <td><input type="number" class="form-control" name="qtyIn[]" value="{{old('qtyIn')}}"></td>
                            <td><input type="text" class="form-control" name="processesCarriedOut[]" value="{{old('processesCarriedOut')}}"></td>
                            <td><input type="date" class="form-control" name="dateOut[]" value="{{old('dateOut')}}"></td>
                            <td><input type="text" class="form-control" name="output[]" value="{{old('output')}}"></td>
                            <td><input type="text" class="form-control" name="otyNoGood[]" value="{{old('otyNoGood')}}"></td>
                            <td><input type="number" class="form-control" name="balance[]" value="{{old('balance')}}"></td>
                            <td><input type="text" class="form-control" name="operatorName[]" value="{{old('operatorName')}}"></td>
                            <td><input type="text" class="form-control" name="operatorSign[]" value="{{old('operatorSign')}}"></td>
                            <td class="" ><a href="#" class="addnewrow">Add row</a></td>
                        </tr>
                       
                        
                    </table>
                </div>
                <hr>

                <div class="bottomtables">
                    <table class="bottomtables1" style="width:35%">
                        <tr>
                            <td><b>PRODUCED QTY</b></td>
                            <td><input type="number" class="form-control" name="producedQty" value="{{old('producedQty')}}"></td>
                        </tr>
                        <tr>
                            <td><b>REJECTED QTY</b></td>
                            <td><input type="number" class="form-control" name="rejectedQty" value="{{old('rejectedQty')}}"></td>
                        </tr>
                        <tr>
                            <td><b>STOCK UPDATED QTY</b></td>
                            <td><input type="number" class="form-control" name="stockUpdatedQty" value="{{old('stockUpdatedQty')}}"></td>
                        </tr>
                        <tr>
                            <td><b>STOCK UPDATED DATE</b></td>
                            <td><input type="date" class="form-control" name="stockUpdatedDate" value="{{old('stockUpdatedDate')}}"></td>
                        </tr>
                    </table>

                    <table class="newrow2 bottomtables2" style="width:35%">
                        <tr><td colspan="2" style="text-align:center"><b>ADVANCE MOVEMENT</b></td></tr>
                        <tr>
                            <th>DATE</th>
                            <th>QTY</th>
                        </tr>
                        <tr>
                            <td><input type="date" class="form-control" name="AMDate[]" value="{{old('AMDate')}}"></td>
                            <td><input type="text" class="form-control" name="AMQty[]" value="{{old('AMQty')}}"></td>
                            <td class="" ><a href="#" class="addnewrow2">Add row</a></td>
                        </tr>
                    </table>
                </div>
                <hr>

                <div class="lastrow">
                    
                    <div style="width:35%">
                        <div class="input-group details"> <b>ISSUED BY:</b>&nbsp&nbsp&nbsp&nbsp
                            <input  name="IssuedBy" value="{{old('IssuedBy')}}" class="form-control"  type="text" >
                        </div>
                        <div class="input-group details"> <b>ISSUED DATE:</b>&nbsp&nbsp&nbsp&nbsp
                            <input  name="IssuedDate" value="{{old('IssuedDate')}}" class="form-control"  type="date" >
                        </div>
                    </div>

                    <div style="width:35%">
                       <div class="input-group details"> <b>AUTHORISED BY:</b>&nbsp&nbsp&nbsp&nbsp
                            <input  name="AuthorisedBy" value="{{old('AuthorisedBy')}}" class="form-control"  type="text" >
                        </div>
                        <div class="input-group details"> <b>AUTHORISED BY:</b>&nbsp&nbsp&nbsp&nbsp
                            <input  name="AuthorisedDate" value="{{old('AuthorisedDate')}}" class="form-control"  type="date" >
                        </div> 
                    </div>
                    
                </div>

                


                <div class="text-center">
                <!-- <input type="hidden" name="hidden_id" value="" /> -->
                <input type="hidden" name="id" value="{{$order->id}}" />
                <input type="hidden" name="orderID" value="{{$order->id}}" />
                <input type="hidden" name="PDRID" value="{{$order->id}}" />
                <input type="hidden" name="buyerCode" value="{{$order->buyerCode}}" />
                <input  name="designID" value="{{$order->getDesign->designID}}" type="hidden" >
                <br>
                <input type="submit" class="btn btn-primary float-end" id="requestbutton" value="Create" />
                </div>


                        
                </form>	
            </div>
    
    
        </div>

        @endauth

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script type="text/javascript">
            $('.addnewrow').on('click',function(){
                addnewrow();
            });
            function addnewrow(){
                var newrow = '<tr><td><input type="number" class="form-control" name="no[]" value="{{old('no')}}"></td>'+
                            '<td><input type="date" class="form-control" name="dateIn[]" value="{{old('dateIn')}}"></td>'+
                            '<td><input type="number" class="form-control" name="qtyIn[]" value="{{old('qtyIn')}}"></td>'+
                            '<td><input type="text" class="form-control" name="processesCarriedOut[]" value="{{old('processesCarriedOut')}}"></td>'+
                            '<td><input type="date" class="form-control" name="dateOut[]" value="{{old('dateOut')}}"></td>'+
                            '<td><input type="text" class="form-control" name="output[]" value="{{old('output')}}"></td>'+
                            '<td><input type="text" class="form-control" name="otyNoGood[]" value="{{old('otyNoGood')}}"></td>'+
                            '<td><input type="number" class="form-control" name="balance[]" value="{{old('balance')}}"></td>'+
                            '<td><input type="text" class="form-control" name="operatorName[]" value="{{old('operatorName')}}"></td>'+
                            '<td><input type="text" class="form-control" name="operatorSign[]" value="{{old('operatorSign')}}"></td>'+
                            '<td hidden class="" ><a type="hidden" href="#" class="addnewrow">Add row</a></td></tr>';
                $('.newrow').append(newrow);
            };
            // $('.remove').live('click',function(){
            //     $(this).parent().parent().parent().remove();
            // });
        </script>
        <script type="text/javascript">
            $('.addnewrow2').on('click',function(){
                addnewrow2();
            });
            function addnewrow2(){
                var newrow2 = '<tr><td><input type="date" class="form-control" name="AMDate[]" value="{{old('AMDate')}}"></td>'+
                            '<td><input type="text" class="form-control" name="AMQty[]" value="{{old('AMQty')}}"></td></tr>';
                $('.newrow2').append(newrow2);
            };
            // $('.remove').live('click',function(){
            //     $(this).parent().parent().parent().remove();
            // });
        </script>
</body>
</html>



