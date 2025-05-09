<div>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="calendar-container">
                    <div class="calendar-header">
                        <button class="prev-month" wire:click="changeMonth(-1)">&#8249;</button>
                        <h2 class="month-title">{{ date('F Y', strtotime($currentYear.'-'.$currentMonth.'-01')) }}</h2>
                        <button class="next-month" wire:click="changeMonth(1)">&#8250;</button>
                    </div>

                    <div class="calendar-grid">
                        <div class="calendar-weekdays">
                            <div class="calendar-day">Sun</div>
                            <div class="calendar-day">Mon</div>
                            <div class="calendar-day">Tue</div>
                            <div class="calendar-day">Wed</div>
                            <div class="calendar-day">Thu</div>
                            <div class="calendar-day">Fri</div>
                            <div class="calendar-day">Sat</div>
                        </div>

                        @for($i = 0; $i < $firstDayOfMonth; $i++)
                            <div class="calendar-day empty"></div>
                        @endfor

                        @foreach($days as $day)
                              <div id="{{strtotime($day['date'])}}" class="calendar-day @if($selected_date==$day['date']) selectedDate @endif" wire:click="selectDate('{{ $day['date'] }}')">
                                {{ $day['day'] }}
                                @if($day['note'])
                                    <span class="note-indicator">📝</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <!-- Pass the selected date to the sidebar component -->
                <livewire:calendar-sidebar :selected_date="$selected_date" />
            </div>
        </div>
    </div>
</div>
