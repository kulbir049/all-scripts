<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon; // Add this line
use Illuminate\Http\Request;

class AttendanceComponent extends Component
{
  
    public $userId;
    public $today_date;
    public $status;

     // Load the attendance record from the database
    public function mount()
    {
        $this->userId=auth()->user()->id;
        $this->today_date=date('Y-m-d');
        $Attendance=Attendance::where('user_id',$this->userId)
        ->whereDate('created_at',$this->today_date)
        ->whereNull('check_out')
        ->first();
        if(!empty($Attendance)){
            $this->status='Checked In';
        }else{
            $this->status='Checked Out';
        }
    }

    
        

        public function updateStatus(Request $request)
        {
            $status = $request->input('status');
            
            // Get today's attendance records
            $Attendance = Attendance::where('user_id', auth()->user()->id)
                ->whereDate('attend_date', date('Y-m-d'))
                ->whereNull('check_out')
                ->first();
            
            if (empty($Attendance) && $status == 'Checked In') {
                // Create a new check-in record
                $AttendanceCreate = new Attendance;
                $AttendanceCreate->user_id = auth()->user()->id;
                $AttendanceCreate->attend_date = date('Y-m-d');
                $AttendanceCreate->check_in = date('Y-m-d H:i:s');
                $AttendanceCreate->status = $status;
                $AttendanceCreate->save();
            } elseif ($status == 'Checked Out' && !empty($Attendance)) {
                // Update the check-out time for the first check-in record
                $Attendance->check_out = date('Y-m-d H:i:s');
                $Attendance->status = $status;
                $Attendance->save();
            }

            // Call the calculateTotalTime function to get check-in and check-out times
            $totalTimes = calculateTotalTime(auth()->user()->id, date('Y-m-d'));  // Calling the global helper
            // Return the status along with calculated times
            session()->put('checkInStatus', $status);
            
            $data['today_date'] = date('Y-m-d');
            $data['today_date_str'] = strtotime(date('Y-m-d'));
            $data['total_time_checkin'] = $totalTimes['total_time_checkin']; // The total time spent in check-in
            $data['total_time_checkout'] = $totalTimes['total_time_checkout']; // The total time spent in checkout
            
            return response()->json(['status' => $status, 'records' => $data]);
        }


    public function render()
    {
        session()->put('checkInStatus', $this->status);      
        return view('livewire.attendance');
    }
}

