<!-- //mydesignlistpage -->

<div class="card-body">
			<table class="table table-bordered">
				<tr>
					<th>Part No. & Name</th>
					<th>Part Design</th>
					<th>Creation Date</th>
				</tr>
				@if(count($data) > 0)

					@foreach($data as $row)

						<tr>
							
							<td>{{ $row->partNo }}</td>
							<td><img src="{{ asset('images/' . $row->partDesign) }}" width="75" /></td>
							<td>{{ $row->created_at }}</td>
							<td>
								<form method="post" action="{{ route('appointment.destroy', $row->id) }}">
									@csrf
									@method('DELETE')
									<a href="{{ route('appointment.show', $row->id) }}" class="btn btn-primary btn-sm">View</a>
									<a href="{{ route('appointment.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
									<input type="submit" class="btn btn-danger btn-sm" value="Delete" />
								</form>
								
							</td>
						</tr>

					@endforeach

				@else
					<tr>
						<td colspan="5" class="text-center">No Data Found</td>
					</tr>
				@endif
			</table>
			{!! $data->links() !!}
		</div>