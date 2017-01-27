	<div class="spreadsheet">
	@if (count($locations) === 0)
		No location found matching the specified keywords
	@else
		<div class="row">
			<div class="col-xs-12">
				<h3>Name</h3>
			</div>
		</div>
		<div class="data">
		@foreach ( $locations as $key => $value )
			<div class="location">
				<a href="/location-report/{{ $value->id }}">
					<div class="row">
						<div class="col-xs-12">
							{{ $value->name }}
						</div>
					</div>
				</a>
			</div>
		@endforeach
		</div>
	@endif
	</div>