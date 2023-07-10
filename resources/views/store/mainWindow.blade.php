<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/navbarstyle.css" >
    <link rel="stylesheet" href="/css/mydesignsliststyle.css" >
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>
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
				<div class="col col-md-6" id="thetitle">
					<b>{{ auth()->user()->name }}'s&nbsp dashboard [Store]</b>
                </div>
			</div>
		</div>

        <div class="card-body" style="width:80%">
			
				@forelse($notifications as $notification)
					<div class="alert alert-success" role="alert">

					@if($notification->type === 'App\Notifications\NewOrderNotification')
                        Client <b>{{ $notification->data['buyerCode'] }}</b> just placed an order 
						<a href="{{ route('order.showForStoreP', $notification->data['id']) }}" data-id="{{ $notification->id }}">
							<b>{{$notification->data['PONo']}}</b>
						</a>
						and is expecting to receive it on <b>{{ $notification->data['deliveryDateETA'] }}</b>.
						
					@elseif($notification->type === 'App\Notifications\OrderDueNotification')
						You have an order due in <b>5</b> days for order 
						<a href="{{ route('order.showForStoreP', $notification->data['id']) }}" data-id="{{ $notification->id }}">
							<b>{{$notification->data['PONo']}}</b>
						</a>
							from client <b>{{$notification->data['buyerCode']}}</b>. 
						Please make sure to prepare and complete the necessary arrangements by then.
					@endif

						<a href="#" class="float-end mark-as-read" data-id="{{ $notification->id }}">
							Mark as read
						</a>
					</div>

					@if($loop->last)
						<a href="#" id="mark-all">Mark all as read</a>
					@endif
					@empty
					<div style="text-align:center">There are no new notifications</div>
				@endforelse


		</div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script type="text/javascript">
		var _token = "{{ csrf_token() }}"; 
		function sendMarkRequest(id = null) {
			return $.ajax("{{ route('markNotification') }}", {
				method: 'POST',
				data: {
					_token,
					id
				}
			});
		}
		$(function() {
			$('.mark-as-read').click(function() {
				let request = sendMarkRequest($(this).data('id'));
				request.done(() => {
					$(this).parents('div.alert').remove();
				});
			});
			$('#mark-all').click(function() {
				let request = sendMarkRequest();
				request.done(() => {
					$('div.alert').remove();
				})
			});
		});
	</script>

	</script>
	</script>

 @endauth
</body>
</html>