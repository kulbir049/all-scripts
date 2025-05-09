<div>
	<!-- Display the selected date -->
	<div class="row calendar-container">
		<div class="card overflow-hidden">

			<div class="card-header pb-1">
				<div class="card-title mb-2">Selected Date: {{ $selectedDate }}</div>
			</div>
			<div class="card-body p-0">
				<div class="list-group projects-list border-0">

					<a href="javascript:void(0);" class="list-group-item list-group-item-action flex-column align-items-start border-0">
						<div class="d-flex w-100 justify-content-between">
							<p class="tx-13 mb-2 font-weight-semibold text-dark">Login Hours</p>
							<p class="tx-13 mb-2 font-weight-semibold text-dark">Break Hours</p>
						</div>
						<div class="d-flex w-100 justify-content-between" style="border-bottom: 1px solid #ededf5 !important;">
							<span class="text-muted tx-12">{{$totalTimes['total_time_checkin']}}</span>
							<span class="text-muted  tx-12">{{$totalTimes['total_time_checkout']}}</span>
						</div>
					</a>
					<a href="javascript:void(0);" class="list-group-item list-group-item-action flex-column align-items-start border-0">
						<div class="d-flex w-100 justify-content-between">
							<p class="tx-13 mb-2 font-weight-semibold text-dark">Checked In</p>
							<p class="tx-13 mb-2 font-weight-semibold text-dark">Checked Out</p>
						</div>
						@foreach($AttendanceLogs as $value)
						<div class="d-flex w-100 justify-content-between" style="border-bottom: 1px solid #ededf5 !important;">
							<span class="text-muted tx-12">{{date('h:i:s A', strtotime($value->check_in))}}</span>
							<span class="text-muted  tx-12">{{isset($value->check_out) ? date('h:i:s A', strtotime($value->check_out)) : 'Null'; }}</span>
						</div>
						@endforeach
					</a>

				</div>

				<div class="card">
					@foreach($tickets as $value)
					<div class="card-header bg-transparent pb-0">
						<div>
							<h3 class="card-title mb-2">Ticket Timeline <span style="float: right;">#{{$value->id}}</span></h3>
						</div>
					</div>
					<div class="card-body mt-0">
						<div class="latest-timeline mt-4">
							<ul class="timeline mb-0">
								@foreach($value->ticketLogs as $logs)
								<li>
									<div class="featured_icon teal">
										<i class="fas fa-circle"></i>
									</div>
								</li>
								<li class="mt-0 activity">
									<div><span class="tx-11 text-muted float-end">{{date('Y-m-d',strtotime($logs->created_at))}}</span></div>
									<a href="javascript:void(0);" class="tx-12 text-dark">
										<p class="mb-1 font-weight-semibold text-dark tx-13">{{$logs->notes_by_name}}</p>
									</a>
									<p class="text-muted mt-0 mb-0 tx-12">{{$logs->notes}} </p>
								</li>
								@endforeach
							</ul>
						</div>
					</div>
					@endforeach
				</div>
				<div class="card">
					@if(strtotime($selectedDate)<strtotime(date('Y-m-d')) && empty($tickets_open))
						<form wire:submit.prevent="submitTicket">

						<textarea wire:model="description" placeholder="Description" class="form-control"></textarea>
						@error('description') <span class="text-danger">{{ $message }}</span> @enderror
						<br>

						<button type="submit" class="btn btn-primary">Create Ticket</button>
						</form>
						@elseif(strtotime($selectedDate)<strtotime(date('Y-m-d')) && !empty($tickets_open))

							<form wire:submit.prevent="updateTicket">
							<input type="hidden" wire:model="ticket_id" value="{{ $tickets_open->id }}">
							<textarea wire:model="description" placeholder="Description" class="form-control"></textarea>
							@error('description') <span class="text-danger">{{ $message }}</span> @enderror
							<br>

							<button type="submit" class="btn btn-primary">Submit Notes</button>
							</form>
							@endif
				</div>
			</div>
		</div>
	</div>
</div>