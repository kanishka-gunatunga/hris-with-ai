<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\User;
use App\Models\UserCustomLeaves;
use App\Models\LeaveTypes;
use App\Models\Leaves;
use App\Models\OtherEmployeeDetails;
use Carbon\Carbon;
use Mail;
class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
        $users = User::get();
        foreach($users as $user){
        $custom_leaves =  UserCustomLeaves::where('user_id',$user->id)->where('leave_type',4)->value('leave_count');
        $current_leaves = Leaves::where('leave_type',4)->where('employee',$user->id)->get();
        $leave_count = 0;
            foreach($current_leaves as $current_leave){
            $currentDate = date("Y");
            $currentDate = date('Y', strtotime($currentDate));
          
            $leave_date = $current_leave->date;
            
            $reqDate = date('Y', strtotime($leave_date));
            if (($currentDate == $reqDate)){
            $leave_count = $leave_count+1;
            }
           }
           
           if($leave_count < $custom_leaves){
            $leave_diff =    $custom_leaves-$leave_count;
            $leave =  UserCustomLeaves::where('user_id',$user->id)->where('leave_type',4)->first();;
            $leave->leave_count =$custom_leaves+$leave_diff;
            $leave->update();  
           }
           else{
            
           }
        }
           
        })->yearlyOn(12, 31, '23:50');
        
        $schedule->call(function () {
        $leave_types = LeaveTypes::get();
        foreach($leave_types as $leave_type){
        UserCustomLeaves::where('leave_type', '=', $leave_type->id)->update(['leave_count' => $leave_type->leave_count]);    
        }
        })->yearlyOn(3, 31, '23:50');
        
        $schedule->call(function () {
        $interns = OtherEmployeeDetails::where('employment_type', 'Intern')->get();
        foreach($interns as $intern){
        $emp_id = $intern->user_id;
        $emp_name = $intern->first_name.' '.$intern->last_name;
        $emp_email = User::where('id',$intern->user_id)->value('email');
        $sup_email = User::where('id',$intern->responsible_person)->value('email');
        $intern_end_date =  date('Y-m-d', strtotime($intern->intern_end_date));
        $end_date=date_create($intern_end_date);
        date_sub($end_date,date_interval_create_from_date_string("8 days"));
        $sub_date =  date_format($end_date,"Y-m-d");
        if(date('Y-m-d') == $sub_date){
            $details_employee  = [
            'title' => "Internship Update",
             'message' =>'Hello '.$emp_name.',<br>Your internship will end in approximately 1 week.',
            ];
           Mail::to($emp_email)->send(new \App\Mail\InternMailEmployee($details_employee));
           
            $details_supervisor = [
            'title' => "Internship Update",
             'message' =>"Your employee ".$emp_name."(".$emp_id.")'s internship period will end in one week.",
            ];
           Mail::to($sup_email)->send(new \App\Mail\InternMailSupervisor($details_supervisor));
        }
        }
        })->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
        
    }
}
