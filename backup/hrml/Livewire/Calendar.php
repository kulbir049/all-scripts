<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon; // Add this line

class Calendar extends Component
{
    public $currentMonth;
    public $currentYear;
    public $selected_date;
    public $openPopup=false;
    public $notes = [];
    // Initialize the current month and year
    public function mount()
    {
        $this->currentMonth = now()->month; // Current month
        $this->currentYear = now()->year;   // Current year
        $this->selected_date = date('Y-m-d');   // Current year
       

    }


    // Change the month (forward or backward)
    public function changeMonth($direction)
    {
        $this->currentMonth += $direction;

        // Adjust month and year when reaching bounds
        if ($this->currentMonth < 1) {
            $this->currentMonth = 12;
            $this->currentYear--;
        } elseif ($this->currentMonth > 12) {
            $this->currentMonth = 1;
            $this->currentYear++;
        }
        

        $this->render(); // Rerender the calendar view
    }
    public function selectDate($date)
    {
        // Set the selected date
        $this->selected_date = $date;
        $this->dispatch('dateSelected', $date);
    }


   

    // Render the calendar view
    public function render()
    {
        // Calculate the number of days in the current month and the starting day of the month
        // $daysInMonth = now()->month($this->currentMonth)->daysInMonth;
        // $firstDayOfMonth = now()->month($this->currentMonth)->startOfMonth()->dayOfWeek;
        $daysInMonth = Carbon::create($this->currentYear, $this->currentMonth, 1)->daysInMonth;
        $firstDayOfMonth = Carbon::create($this->currentYear, $this->currentMonth, 1)->startOfMonth()->dayOfWeek;
       //dd($this->currentYear,$this->currentMonth);

        // Generate the days array for the calendar
        $days = [];
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $date =Carbon::create($this->currentYear, $this->currentMonth, 1)->day($i)->format('Y-m-d');
            $days[] = [
                'date' => $date,
                'day' => $i,
                'note' => $this->notes[$date] ?? null, // Retrieve any notes for this day
            ];
        }
           $currentMonth= $this->currentMonth;
            $currentYear= $this->currentYear;
            $selected_date=isset($this->selected_date) ? $this->selected_date : date('Y-m-d');
           
        // Return the view for the calendar with the computed days and first day of the month
        return view('livewire.calendar', compact('days', 'firstDayOfMonth','currentYear','currentMonth','selected_date'));
    }
}