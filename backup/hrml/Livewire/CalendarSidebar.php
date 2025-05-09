<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Attendance; 
use App\Models\Tickets;
use App\Models\TicketsLogs;

class CalendarSidebar extends Component
{
    public $selectedDate=null;
    public $user_id;
    public $AttendanceLogs;
    protected $listeners = ['dateSelected' => 'mount']; // Listen for the event
    public $isEditMode = false;
    public $title, $description,$status;
    public $tickets,$tickets_open,$ticket_id;

    public function mount($date=null)
    {
        $this->user_id = auth()->user()->id;
        $this->selectedDate = isset($date) ? $date : date('Y-m-d');
        $this->AttendanceLogs=Attendance::where('user_id',auth()->user()->id)
        ->whereDate('attend_date',$this->selectedDate)
        ->get();
        $this->tickets_open = Tickets::where('attend_date',$this->selectedDate)->where('status','!=','close')->first();
        $this->ticket_id=isset($this->tickets_open) ? $this->tickets_open->id : null;

    }
     // Create or update a ticket
    public function submitTicket()
    {
        $this->validate([
            'description' => 'required|min:5',
        ]);
         $tickets_new=new Tickets;
         $tickets_new->title = auth()->user()->name.' | Attendance Logs';
         $tickets_new->description = $this->description;
         $tickets_new->status  = 'open';
         $tickets_new->type  = 'Attendance';
         $tickets_new->attend_date  = $this->selectedDate;
         $tickets_new->save();

         $tickets_logs=new TicketsLogs;
         $tickets_logs->ticket_id = $tickets_new->id;
         $tickets_logs->notes = $this->description;
         $tickets_logs->notes_by_id  = auth()->user()->id;
         $tickets_logs->notes_by_name  = auth()->user()->name;
         $tickets_logs->save();
           

        $this->resetInputs();
        $this->tickets = Tickets::all();
        $this->dispatch('success', 'Ticket created successfully!');
    }
    // Create or update a ticket
    public function updateTicket()
    {
        $this->validate([
            'description' => 'required|min:5',
        ]);
        
         
         $tickets_logs=new TicketsLogs;
         $tickets_logs->ticket_id = $this->ticket_id;
         $tickets_logs->notes = $this->description;
         $tickets_logs->notes_by_id  = auth()->user()->id;
         $tickets_logs->notes_by_name  = auth()->user()->name;
         $tickets_logs->save();
           

        $this->resetInputs();
        $this->tickets = Tickets::all();
        $this->dispatch('success', 'Notes Updated successfully!');
    }
     // Reset the input fields
     public function resetInputs()
     {
         $this->title = '';
         $this->description = '';
         $this->status = 'open';
     }
    public function render()
    {
        $selectedDate=$this->selectedDate;
        $AttendanceLogs=$this->AttendanceLogs;
        $totalTimes = calculateTotalTime(auth()->user()->id, $selectedDate);
        $this->tickets = Tickets::with('ticketLogs')->where('attend_date',$selectedDate)->get();


        return view('livewire.calendar-sidebar',compact('selectedDate','AttendanceLogs','totalTimes'));
    }
}
