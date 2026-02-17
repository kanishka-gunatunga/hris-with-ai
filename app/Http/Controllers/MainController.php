<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\OtherAdminDetails;
use App\Models\OtherHRManagerDetails;
use App\Models\OtherEmployeeDetails;
use App\Models\Designations;
use App\Models\Departments;
use App\Models\Immigrations;
use App\Models\Contacts;
use App\Models\SocialProfile;
use App\Models\Documents;
use App\Models\Qulifications;
use App\Models\Works;
use App\Models\BankAccounts;
use App\Models\BasicSalary;
use App\Models\Allowances;
use App\Models\Commissions;
use App\Models\Loans;
use App\Models\Deductions;
use App\Models\OtherPaymnets;
use App\Models\Overtimes;
use App\Models\Pensions;
use App\Models\CoreHRPromotions;
use App\Models\CoreHRAwards;
use App\Models\CoreHRTravel;
use App\Models\CoreHRTransfer;
use App\Models\CoreHRResignations;
use App\Models\CoreHRComplaints;
use App\Models\CoreHRWarnings;
use App\Models\CoreHRTerminations;
use App\Models\OtherClientDetails;
use App\Models\PMProjects;
use App\Models\PMProjectsEmployees;
use App\Models\PMTasks;
use App\Models\PMTaskUsers;
use App\Models\PMTaxTypes;
use App\Models\PMInvoices;
use App\Models\PMInvoiceItems;
use App\Models\OrganizationDepartments;
use App\Models\OrganizationLocations;
use App\Models\OrganizationDesignations;
use App\Models\OrganizationAnnouncements;
use App\Models\OrganizationPolicy;
use App\Models\Events;
use App\Models\Meetings;
use App\Models\PerformanceGoalType;
use App\Models\PerformanceGoalTracking;
use App\Models\PerformanceIndicator;
use App\Models\PerformanceAppraisal;
use App\Models\TrainingTrainers;
use App\Models\TrainingType;
use App\Models\TrainingList;
use App\Models\TrainingListEmployees;
use App\Models\FinanceAccountList;
use App\Models\FinancePayer;
use App\Models\FinancePayee;
use App\Models\FinanceDeposit;
use App\Models\FinanceExpense;
use App\Models\FinanceTransfer;
use App\Models\FinancePayment;
use App\Models\AssetCategory;
use App\Models\Asset;
use App\Models\FileManager;
use App\Models\FileOfficialDocument;
use App\Models\OfficeShift;
use App\Models\Holidays;
use App\Models\Leaves;
use App\Models\Attendance;
use App\Models\JobPosts;
use App\Models\OtherHODDetails;
use App\Models\BlockedIPS;
use App\Models\LeaveTypes;
use App\Models\SpecialLeavesDeduction;
use App\Models\EventsDepartments;
use App\Models\Recruitments;
use App\Models\InterviewUpdates;
use App\Models\InterviewOtherUpdates;
use App\Models\EmploymentTypeHistory;
use App\Models\UserCheckInOutData;
use App\Models\OtherAuthoriserDetails;
use App\Models\UserCustomLeaves;
use App\Models\Accessories;
use App\Models\EmployeeAccessories;
use File;
use PDF;
use Mail;
use League\Csv\Writer;

date_default_timezone_set('Asia/Colombo');

class MainController extends Controller
{
    // public function index(Request $request)
    // {
    //     if($request->isMethod('get')){
    //         return view('index');
    //      }
    //      if($request->isMethod('post')){
    //         if(BlockedIPS::where("ip", "=", $request->get('user_ip'))->exists()){
    //             return back()->with('login_error', 'You have been blocked, please contact the admin');
    //         }
    //         else{
    //         $this->validate($request, [
    //             'user_name'   => 'required',
    //             'password'  => 'required'
    //           ]);

    //           $user_data = array(
    //             'user_name'  => $request->get('user_name'),
    //             'status'  => "active",
    //             'password' => $request->get('password')
    //           );
    //         if(User::where("user_name", "=", $request->get('user_name'))->exists())
    //         {
    //         if(Hash::check($request->get('password'), User::where('user_name', $request->get('user_name'))->value('password'))){
    //             if(Auth::attempt($user_data))
    //             {
    //              $user_last_login =  User::where('user_name', $request->get('user_name'))->first();
    //              $user_last_login->last_login = date('Y-m-d h:m:s');
    //              $user_last_login->login_attempts = null;
    //              $user_last_login->update();
    //              return redirect('dashboard');
    //             }
    //             else
    //             {
    //              return back()->with('login_error', 'Wrong Login Details');
    //             }
    //         }
    //         else{
    //             $attempt_count = User::where("user_name", "=", $request->get('user_name'))->value('login_attempts');
    //             if($attempt_count == null){
    //                 $user_attempt = User::where('user_name', '=',$request->get('user_name'))->first();;
    //                 $user_attempt->login_attempts = 1;
    //                 $user_attempt->update();
    //                 return back()->with('login_error', 'Wrong Login Details');
    //             }
    //             elseif($attempt_count < 3){
    //                 $user_attempt = User::where('user_name', '=',$request->get('user_name'))->first();;
    //                 $user_attempt->login_attempts = $attempt_count+1;
    //                 $user_attempt->update();
    //                 return back()->with('login_error', 'Wrong Login Details');
    //             }
    //             else{
    //                 $user_attempt = User::where('user_name', '=',$request->get('user_name'))->first();;
    //                 $user_attempt->status = "blocked";
    //                 $user_attempt->update();
    //                 return back()->with('login_error', 'Wrong Login Details');
    //             }
    //             }
    //         }
    //         else{
    //             $block = new BlockedIPS();
    //             $block->ip =$request->get('user_ip');
    //             $block->save();
    //             return back()->with('login_error', 'Wrong Login Details');
    //         }

    //      }
    //     }
    // }
    
    public function index(Request $request)
    {
        if($request->isMethod('get')){
            return view('index');
         }
         if($request->isMethod('post')){

            $this->validate($request, [
                'user_name'   => 'required',
                'password'  => 'required'
               ]);

               $user_data = array(
                'user_name'  => $request->get('user_name'),
                'status'  => "active",
                'password' => $request->get('password')
               );


                if(Auth::attempt($user_data))
                {
                 $user_last_login =  User::where('user_name', $request->get('user_name'))->first();
                 $user_last_login->last_login = date('Y-m-d h:m:s');
                 $user_last_login->login_attempts = null;
                 $user_last_login->update();
                 return redirect('dashboard');
                }
                else
                {
                 return back()->with('login_error', 'Wrong Login Details');
                }

            
          
        }
    }

    function logout()
    {
     Auth::logout();
     return redirect('/');
    }
    public function dashboard()
    {

    if(Auth::user()->user_role == 1){
        $no_of_emp = User::where('user_role', 3)->count();
        $no_of_hod = User::where('user_role', 5)->count();
        $no_of_hrm = User::where('user_role', 2)->count();
        $no_of_client = User::where('user_role', 4)->count();
        $no_of_projects = PMProjects::count();
        $no_of_tasks = PMTasks::count();
        $no_of_departments = OrganizationDepartments::count();
        $no_of_locations = OrganizationLocations::count();
        $no_of_jobs = JobPosts::where('status', 'Published')->count();
        $recent_logins = User::orderBy('last_login', 'DESC')->take(10)->get();
        $recent_blocked_ips = BlockedIPS::orderBy('created_at', 'DESC')->take(10)->get();
        $recent_blocked_users = User::where('status', 'blocked')->take(10)->get();
        $holidays = Holidays::get();
        return view('admin_dashboard', ['no_of_emp' => $no_of_emp,'no_of_hod' => $no_of_hod,'no_of_hrm' => $no_of_hrm,
        'no_of_client' => $no_of_client,'no_of_projects' => $no_of_projects,'no_of_tasks' => $no_of_tasks,
        'no_of_departments' => $no_of_departments,'no_of_locations' => $no_of_locations,'no_of_jobs' => $no_of_jobs
        ,'recent_logins' => $recent_logins,'recent_blocked_ips' => $recent_blocked_ips,'recent_blocked_users' => $recent_blocked_users,
        'holidays' => $holidays]);
    }
    if(Auth::user()->user_role == 3){
        $promotions = CoreHRPromotions::where('employee', Auth::user()->id)->get();
        $awards = CoreHRAwards::where('employee', Auth::user()->id)->get();
        $travels = CoreHRTravel::where('employee', Auth::user()->id)->get();
        $transfers = CoreHRTransfer::where('employee', Auth::user()->id)->get();
        $resignations = CoreHRResignations::where('employee', Auth::user()->id)->get();
        $coreHRComplaints = CoreHRComplaints::where('complaint_against', Auth::user()->id)->where('send_notification','yes')->get();
        $warnings = CoreHRWarnings::where('employee', Auth::user()->id)->get();
        $terminations = CoreHRTerminations::where('employee', Auth::user()->id)->get();
        $projects = PMProjects::get();
        $tasks = PMTasks::get();
        $meetings = Meetings::where('employee', Auth::user()->id)->get();
        $emp_department = OtherEmployeeDetails::where('user_id', Auth::user()->id)->value('department');
        $events = Events::get();
        $training_lists = TrainingList::get();
        return view('employee_dashboard', ['promotions' => $promotions, 'awards' => $awards, 'travels' => $travels, 'transfers' => $transfers
        , 'resignations' => $resignations, 'coreHRComplaints' => $coreHRComplaints, 'warnings' => $warnings, 'terminations' => $terminations
        , 'projects' => $projects, 'tasks' => $tasks, 'meetings' => $meetings, 'events' => $events, 'training_lists' => $training_lists,
        'emp_department' => $emp_department]);
    }
    if(Auth::user()->user_role == 5){
        $promotions = CoreHRPromotions::get();
        $awards = CoreHRAwards::get();
        $travels = CoreHRTravel::get();
        $transfers = CoreHRTransfer::get();
        $resignations = CoreHRResignations::get();
        $coreHRComplaints = CoreHRComplaints::get();
        $warnings = CoreHRWarnings::get();
        $terminations = CoreHRTerminations::get();
        $projects = PMProjects::get();
        $tasks = PMTasks::get();
        $meetings = Meetings::get();
        $events = Events::get();
        $training_lists = TrainingList::get();
        return view('hod_dashboard', ['promotions' => $promotions, 'awards' => $awards, 'travels' => $travels, 'transfers' => $transfers
        , 'resignations' => $resignations, 'coreHRComplaints' => $coreHRComplaints, 'warnings' => $warnings, 'terminations' => $terminations
        , 'projects' => $projects, 'tasks' => $tasks, 'meetings' => $meetings, 'events' => $events, 'training_lists' => $training_lists]);
    }
    if(Auth::user()->user_role == 2){

        return view('hrm_dashboard');
    }
     if(Auth::user()->user_role == 6){

        return view('authoriser_dashboard');
    }
    }
    public function admins()
    {
        $admins = User::where('user_role', '1')->orderBy('id')->get();
        return view('admins', ['admins' => $admins]);
    }
    public function add_admin(Request $request)
    { if($request->isMethod('get')){
        return view('add-admin');
    }
    if($request->isMethod('post')){
    $this->validate($request, [
            'first_name'   => 'required',
            'last_name'   => 'required',
            'phone'   => 'required',
            'email'   => 'required | email | unique:users',
            'user_name'  => 'required | min:6 | unique:users',
            "password" => "required | confirmed | min:6",
           ]);

           if($request->image){
            $image_name = time().'admin.'.$request->image->extension();
           $request->image->move(public_path('user_images'), $image_name);
           }
           else{
            $image_name = "defaul_admin.jpg";
           }

           if($request->status){
            $status = 'active';
           }
           else{
            $status = 'inactive';
           }
           DB::beginTransaction();
           $user = User::create([
              "user_name" => $request->user_name,
              "email" => $request->email,
              "password" => Hash::make($request->password),
              "user_role" => 1,
              "status" => $status
           ]);

           $userDetails = new OtherAdminDetails();
           $userDetails->user_id =$user->id;
           $userDetails->first_name = $request->first_name;
           $userDetails->last_name = $request->last_name;
           $userDetails->phone = $request->phone;
           $userDetails->image = $image_name;
           $userDetails->save();
           DB::commit();
            return back()->with('success', 'Admin Successfully Added');

    }

    }
    public function deactivate_admin($id){
        $admin = User::find($id);
        $admin->status = "inactive";
        $admin->update();
        return back()->with('success', 'Admin Deactivated');

    }
    public function activate_admin($id){
        $admin = User::find($id);
        $admin->status = "active";
        $admin->update();
        return back()->with('success', 'Admin Activated');

    }
    public function edit_admin($id,Request $request)
    {
    if($request->isMethod('get')){
    $login_details = User::where('id',$id)->get();
    $other_details = OtherAdminDetails::where('user_id',$id)->get();
    return view('edit-admin', ['login_details' => $login_details,'other_details' => $other_details]);
    }
    if($request->isMethod('post')){
    $this->validate($request, [
        'first_name'   => 'required',
        'last_name'   => 'required',
        'phone'   => 'required',
        'email'   => 'required | email',
        'user_name'  => 'required | min:6',
    ]);
    if($request->status){
        $status = 'active';
    }
    else{
        $status = 'inactive';
    }

    if($request->image){
        $image_name = time().'admin.'.$request->image->extension();
       $request->image->move(public_path('user_images'), $image_name);
       }
       else{
        $image_name = OtherAdminDetails::where('user_id',$id)->value('image');;
    }

    if(!$request->current_password == null || !$request->password == null || !$request->password_confirmation == null){
        $this->validate($request, [
            "password" => "required | confirmed | min:6",
            "current_password" => "required",
           ]);
           if (Hash::check($request->input('current_password'), User::where('id', $id)->value('password'))) {
            if(User::where("id", "=", $id)->where("email", "=", $request->email)->exists()){
                $email = $request->email;
            }
            elseif(User::where("email", "=", $request->email)->exists()){
             return back()->with('fail', 'This email is already in use');
            }
            else{
             $email = $request->email;
            }
            if(User::where("id", "=", $id)->where("user_name", "=", $request->user_name)->exists()){
                $user_name = $request->user_name;
                }
               elseif(User::where("user_name", "=", $request->user_name)->exists()){
               return back()->with('fail', 'This user name is already in use');
               }
               else{
                $user_name = $request->user_name;
               }
            $userDetails =  OtherAdminDetails::where('user_id', '=', $id)->first();;
            $userDetails->first_name = $request->first_name;
            $userDetails->last_name = $request->last_name;
            $userDetails->phone = $request->phone;
            $userDetails->image = $image_name;
            $userDetails->update();
            $user = User::find($id);
            $user->email = $email;
            $user->password = Hash::make($request->input('password'));
            $user->user_name = $user_name;
            $user->status = $status;
            $user->update();
            return back()->with('success', 'Admin Details Successfully  Updated');
           }
           else{
            return back()->with('fail', 'Current password is incorrect.');
        }
    }
    else{
        if(User::where("id", "=", $id)->where("email", "=", $request->email)->exists()){
            $email = $request->email;
        }
        elseif(User::where("email", "=", $request->email)->exists()){
         return back()->with('fail', 'This email is already in use');
        }
        else{
         $email = $request->email;
        }
        if(User::where("id", "=", $id)->where("user_name", "=", $request->user_name)->exists()){
            $user_name = $request->user_name;
            }
           elseif(User::where("user_name", "=", $request->user_name)->exists()){
           return back()->with('fail', 'This user name is already in use');
           }
           else{
            $user_name = $request->user_name;
           }
        $userDetails =  OtherAdminDetails::where('user_id', '=', $id)->first();;
        $userDetails->first_name = $request->first_name;
        $userDetails->last_name = $request->last_name;
        $userDetails->phone = $request->phone;
        $userDetails->image = $image_name;
        $userDetails->update();
        $user = User::find($id);
        $user->email = $email;
        $user->user_name = $user_name;
        $user->status = $status;
        $user->update();
        return back()->with('success', 'Admin Details Successfully  Updated');
    }


    }

    }
    public function hr_managers()
    {
        $hr_managers = User::where('user_role', '2')->orderBy('id')->get();
        return view('hr-managers', ['hr_managers' => $hr_managers]);
    }
    public function add_hr_manager(Request $request)
    { if($request->isMethod('get')){
        $hrms = User::where('user_role', '2')->orderBy('id')->get();
        $admins = User::where('user_role', '1')->orderBy('id')->get();
        $departments = OrganizationDepartments::orderBy('id')->get();
        return view('add-hr-manager', ['hrms' => $hrms, 'departments' => $departments, 'admins' => $admins]);
    }
    if($request->isMethod('post')){
    $this->validate($request, [
            'first_name'   => 'required',
            'last_name'   => 'required',
            'phone'   => 'required',
            'dob'   => 'required',
            'gender'   => 'required',
            'department'   => 'required',
            'employment_type'   => 'required',
            'epf_no'   => 'required',
            'appoinment_date'   => 'required',
            'latitude'   => 'required',
            'longitude'   => 'required',
            // 'responsible_person'   => 'required',
            'nic'   => 'required',
            'email'   => 'required | email | unique:users',
            'user_name'  => 'required | min:6 | unique:users',
            "password" => "required | confirmed | min:6",
           ]);

           if($request->image){
            $image_name = time().'hr-manager.'.$request->image->extension();
           $request->image->move(public_path('user_images'), $image_name);
           }
           else{
            $image_name = "defaul_admin.jpg";
           }

           if($request->status){
            $status = 'active';
           }
           else{
            $status = 'inactive';
           }
           DB::beginTransaction();
           $user = User::create([
              "user_name" => $request->user_name,
              "email" => $request->email,
              "password" => Hash::make($request->password),
              "user_role" => 2,
              "status" => $status
           ]);

           $userDetails = new OtherHRManagerDetails();
           $userDetails->user_id =$user->id;
           $userDetails->first_name = $request->first_name;
           $userDetails->last_name = $request->last_name;
           $userDetails->responsible_person = $request->responsible_person;
           $userDetails->phone = $request->phone;
           $userDetails->dob = $request->dob;
           $userDetails->gender = $request->gender;
           $userDetails->department = $request->department;
           $userDetails->employment_type = $request->employment_type;
           $userDetails->epf_no = $request->epf_no;
           $userDetails->appoinment_date = $request->appoinment_date;
           $userDetails->latitude = $request->latitude;
           $userDetails->longitude = $request->longitude;
           $userDetails->nic = $request->nic;
           $userDetails->image = $image_name;
           $userDetails->save();
           DB::commit();
            return back()->with('success', 'HR Manager Successfully Added');

    }

    }
    public function deactivate_hr_manager($id){
        $manager = User::find($id);
        $manager->status = "inactive";
        $manager->update();
        return back()->with('success', 'HR Manager Deactivated');

    }
    public function activate_hr_manager($id){
        $manager = User::find($id);
        $manager->status = "active";
        $manager->update();
        return back()->with('success', 'HR Manager Activated');

    }
    public function edit_hr_manager($id,Request $request)
    {
    if($request->isMethod('get')){
    $login_details = User::where('id',$id)->get();
    $other_details = OtherHRManagerDetails::where('user_id',$id)->get();
    $designations = Designations::where('status', 'active')->orderBy('id')->get();
    $departments = OrganizationDepartments::orderBy('id')->get();
    $immigrations = Immigrations::where('user_id', $id)->orderBy('id')->get();
    $contacts = Contacts::where('user_id', $id)->orderBy('id')->get();
    $social_profile = SocialProfile::where('user_id', $id)->orderBy('id')->get();
    $documents = Documents::where('user_id', $id)->orderBy('id')->get();
    $qulifications = Qulifications::where('user_id', $id)->orderBy('id')->get();
    $works = Works::where('user_id', $id)->orderBy('id')->get();
    $bank_accounts = BankAccounts::where('user_id', $id)->orderBy('id')->get();
    $basic_salarys = BasicSalary::where('user_id', $id)->orderBy('id')->get();
    $allowances = Allowances::where('user_id', $id)->orderBy('id')->get();
    $commissions = Commissions::where('user_id', $id)->orderBy('id')->get();
    $loans = Loans::where('user_id', $id)->orderBy('id')->get();
    $deductions = Deductions::where('user_id', $id)->orderBy('id')->get();
    $payments = OtherPaymnets::where('user_id', $id)->orderBy('id')->get();
    $overtimes = Overtimes::where('user_id', $id)->orderBy('id')->get();
    $pensions = Pensions::where('user_id', $id)->orderBy('id')->get();
    $corehr_promotions = CoreHRPromotions::where('employee', $id)->orderBy('id')->get();
    $corehr_awrds = CoreHRAwards::where('employee', $id)->orderBy('id')->get();
    $corehr_travels = CoreHRTravel::where('employee', $id)->orderBy('id')->get();
    $corehr_transfers = CoreHRTransfer::where('employee', $id)->orderBy('id')->get();
    $corehr_resignations = CoreHRResignations::where('employee', $id)->orderBy('id')->get();
    $corehr_complaints = CoreHRComplaints::where('complaint_from', $id)->orderBy('id')->get();
    $corehr_warnings = CoreHRWarnings::where('employee', $id)->orderBy('id')->get();
    $corehr_terminations = CoreHRTerminations::where('employee', $id)->orderBy('id')->get();
    $projects = PMProjects::get();
    $tasks = PMTasks::get();
    $leaves = Leaves::where('employee',$id)->get();
    $hods = User::where('user_role', '5')->orderBy('id')->get();
    $hrms = User::where('user_role', '2')->orderBy('id')->get();
    $authorisers = User::where('user_role', '6')->orderBy('id')->get();
        return view('edit-hr-manager', ['login_details' => $login_details, 'other_details' => $other_details,
        'designations' => $designations, 'departments' => $departments, 'immigrations' => $immigrations,
         'contacts' => $contacts,'social_profile' => $social_profile,'documents' => $documents,
         'qulifications' => $qulifications, 'works' => $works, 'bank_accounts' => $bank_accounts, 'basic_salarys' => $basic_salarys
         , 'allowances' => $allowances, 'commissions' => $commissions, 'loans' => $loans, 'deductions' => $deductions
         , 'payments' => $payments, 'overtimes' => $overtimes, 'pensions' => $pensions, 'corehr_promotions' => $corehr_promotions
         , 'corehr_awrds' => $corehr_awrds, 'corehr_travels' => $corehr_travels, 'corehr_transfers' => $corehr_transfers
         , 'corehr_resignations' => $corehr_resignations, 'corehr_complaints' => $corehr_complaints, 'corehr_warnings' => $corehr_warnings
         , 'corehr_terminations' => $corehr_terminations, 'projects' => $projects, 'tasks' => $tasks, 'leaves' => $leaves,
         'hods' => $hods, 'hrms' => $hrms, 'authorisers' => $authorisers]);
    }
    }
   public function edit_hrm_basic($id,Request $request)
    {
    $this->validate($request, [
        'first_name'   => 'required',
        'last_name'   => 'required',
        'phone'   => 'required',
        'gender'   => 'required',
        'department'   => 'required',
        'employment_type'   => 'required',
        'epf_no'   => 'required',
        'appoinment_date'   => 'required',
        'longitude'   => 'required',
        'latitude'   => 'required',
        'responsible_person'   => 'required',
        'responsible_person'   => 'required',
        'nic'   => 'required',
        'email'   => 'required | email',
        'user_name'  => 'required | min:6',
    ]);
    if($request->status){
        $status = 'active';
    }
    else{
        $status = 'inactive';
    }



    if(!$request->current_password == null || !$request->password == null || !$request->password_confirmation == null){
        $this->validate($request, [
            "password" => "required | confirmed | min:6",
            "current_password" => "required",
           ]);
           if (Hash::check($request->input('current_password'), User::where('id', $id)->value('password'))) {
            if(User::where("id", "=", $id)->where("email", "=", $request->email)->exists()){
                $email = $request->email;
            }
            elseif(User::where("email", "=", $request->email)->exists()){
             return back()->with('fail', 'This email is already in use');
            }
            else{
             $email = $request->email;
            }
            if(User::where("id", "=", $id)->where("user_name", "=", $request->user_name)->exists()){
                $user_name = $request->user_name;
                }
               elseif(User::where("user_name", "=", $request->user_name)->exists()){
               return back()->with('fail', 'This user name is already in use');
               }
               else{
                $user_name = $request->user_name;
               }
            $userDetails =  OtherHRManagerDetails::where('user_id', '=', $id)->first();;
            $userDetails->first_name = $request->first_name;
            $userDetails->last_name = $request->last_name;
            $userDetails->phone = $request->phone;
            $userDetails->dob = $request->dob;
           $userDetails->gender = $request->gender;
           $userDetails->department = $request->department;
           $userDetails->employment_type = $request->employment_type;
           $userDetails->epf_no = $request->epf_no;
           $userDetails->appoinment_date = $request->appoinment_date;
           $userDetails->latitude = $request->latitude;
           $userDetails->longitude = $request->longitude;
            $userDetails->responsible_person = $request->responsible_person;
            $userDetails->nic = $request->nic;
            $userDetails->update();
            $user = User::find($id);
            $user->email = $email;
            $user->password = Hash::make($request->input('password'));
            $user->user_name = $user_name;
            $user->status = $status;
            $user->update();
            return back()->with('success', 'HR Manager Details Successfully  Updated');
           }
           else{
            return back()->with('fail', 'Current password is incorrect.');
        }
    }
    else{
        if(User::where("id", "=", $id)->where("email", "=", $request->email)->exists()){
            $email = $request->email;
        }
        elseif(User::where("email", "=", $request->email)->exists()){
         return back()->with('fail', 'This email is already in use');
        }
        else{
         $email = $request->email;
        }
        if(User::where("id", "=", $id)->where("user_name", "=", $request->user_name)->exists()){
            $user_name = $request->user_name;
            }
           elseif(User::where("user_name", "=", $request->user_name)->exists()){
           return back()->with('fail', 'This user name is already in use');
           }
           else{
            $user_name = $request->user_name;
           }
        $userDetails =  OtherHRManagerDetails::where('user_id', '=', $id)->first();;
        $userDetails->first_name = $request->first_name;
        $userDetails->last_name = $request->last_name;
        $userDetails->phone = $request->phone;
        $userDetails->dob = $request->dob;
           $userDetails->gender = $request->gender;
           $userDetails->department = $request->department;
           $userDetails->employment_type = $request->employment_type;
           $userDetails->epf_no = $request->epf_no;
           $userDetails->appoinment_date = $request->appoinment_date;
           $userDetails->latitude = $request->latitude;
           $userDetails->longitude = $request->longitude;
        $userDetails->responsible_person = $request->responsible_person;
        $userDetails->nic = $request->nic;
        $userDetails->update();
        $user = User::find($id);
        $user->email = $email;
        $user->user_name = $user_name;
        $user->status = $status;
        $user->update();
        return back()->with('success', 'HR Manager Details Successfully  Updated');
    }


    }
public function change_hrm_image($id,Request $request)
    {
        $image_name = time().'hrm.'.$request->image->extension();
        $request->image->move(public_path('user_images'), $image_name);

        $change_image =  OtherHRManagerDetails::where('user_id', '=', $id)->first();;
        $change_image->image =$image_name;
        $change_image->update();
        return back()->with('success', 'HRM Profile Picture  Updated');

    }
    public function employees()
    {
        $employees = User::where('user_role', '3')->orderBy('id')->get();
        return view('employees', ['employees' => $employees]);
    }
    public function add_employee(Request $request)
    { if($request->isMethod('get')){
        $designations = OrganizationDesignations::orderBy('id')->get();
        $departments = OrganizationDepartments::orderBy('id')->get();
        $hods = User::where('user_role', '5')->orderBy('id')->get();
        $hrms = User::where('user_role', '2')->orderBy('id')->get();
        $authorisers = User::where('user_role', '6')->orderBy('id')->get();
        return view('add-employee', ['designations' => $designations, 'departments' => $departments, 'hods' => $hods, 'hrms' => $hrms, 'authorisers' => $authorisers]);
    }
    if($request->isMethod('post')){
    $this->validate($request, [
            'first_name'   => 'required',
            'last_name'   => 'required',
            'phone'   => 'required',
            'dob'   => 'required',
            'gender'   => 'required',
            'company'   => 'required',
            'department'   => 'required',
            'designation'   => 'required',
            'office_shift'   => 'required',
            'employment_type'   => 'required',
            'join_date'   => 'required',
            'latitude'   => 'required',
            'longitude'   => 'required',
            'responsible_person'   => 'required',
            'nic'   => 'required',
            'email'   => 'required | email | unique:users',
            'user_name'  => 'required | min:6 | unique:users',
            "password" => "required | confirmed | min:6",
           ]);

           if($request->image){
            $image_name = time().'employee.'.$request->image->extension();
           $request->image->move(public_path('user_images'), $image_name);
           }
           else{
            $image_name = "defaul_admin.jpg";
           }

           if($request->status){
            $status = 'active';
           }
           else{
            $status = 'inactive';
           }
           DB::beginTransaction();
           $user = User::create([
              "user_name" => $request->user_name,
              "email" => $request->email,
              "password" => Hash::make($request->password),
              "user_role" => 3,
              "status" => $status
           ]);

           $userDetails = new OtherEmployeeDetails();
           $userDetails->user_id =$user->id;
           $userDetails->first_name = $request->first_name;
           $userDetails->last_name = $request->last_name;
           $userDetails->phone = $request->phone;
           $userDetails->dob = $request->dob;
           $userDetails->gender = $request->gender;
           $userDetails->company = $request->company;
           $userDetails->department = $request->department;
           $userDetails->designation = $request->designation;
           $userDetails->office_shift = $request->office_shift;
           $userDetails->employment_type = $request->employment_type;
           $userDetails->join_date = $request->join_date;
           $userDetails->intern_end_date = $request->intern_end_date;
           $userDetails->image = $image_name;
           $userDetails->epf_no = $request->epf_no;
           $userDetails->appoinment_date = $request->appoinment_date;
           $userDetails->responsible_person = $request->responsible_person;
           $userDetails->latitude = $request->latitude;
           $userDetails->longitude = $request->longitude;
            $userDetails->nic = $request->nic;
           $userDetails->save();
           DB::commit();
            return back()->with('success', 'Employee Successfully Added');

    }

    }
    public function deactivate_employee($id){
        $employee = User::find($id);
        $employee->status = "inactive";
        $employee->update();
        return back()->with('success', 'Employee Deactivated');

    }
    public function activate_employee($id){
        $manager = User::find($id);
        $manager->status = "active";
        $manager->update();
        return back()->with('success', 'Employee Activated');

    }
    public function designations()
    {
        $designations = Designations::orderBy('id')->get();
        return view('designations', ['designations' => $designations]);
    }
    public function add_designations(Request $request)
    {
    $this->validate($request, [
            'designation'   => 'required',
           ]);

           if($request->status){
            $status = 'active';
           }
           else{
            $status = 'inactive';
           }

           $designation = new Designations();
           $designation->designation =$request->designation;
           $designation->status =$status;
           $designation->save();
           return back()->with('success', 'Designation Successfully Added');
    }
    public function edit_designation($id,Request $request)
    {
    if($request->status){
        $status = 'active';
    }
    else{
        $status = 'inactive';
    }

        $designation =  Designations::where('id', $id)->first();;
        $designation->designation =$request->designation;
        $designation->status =$status;
        $designation->update();
        return back()->with('success', 'Designation Successfully  Updated');


    }
    public function departments()
    {
        $departments = Departments::orderBy('id')->get();
        return view('departments', ['departments' => $departments]);
    }
    public function add_department(Request $request)
    {
    $this->validate($request, [
            'department'   => 'required',
           ]);

           if($request->status){
            $status = 'active';
           }
           else{
            $status = 'inactive';
           }

           $department = new Departments();
           $department->department =$request->department;
           $department->status =$status;
           $department->save();
           return back()->with('success', 'Department Successfully Added');
    }
    public function edit_department($id,Request $request)
    {
    if($request->status){
        $status = 'active';
    }
    else{
        $status = 'inactive';
    }

        $department =  Departments::where('id', $id)->first();;
        $department->department =$request->department;
        $department->status =$status;
        $department->update();
        return back()->with('success', 'Department Successfully  Updated');


    }
    public function edit_employee($id)
    {
        $login_details = User::where('id',$id)->get();
        $other_details = OtherEmployeeDetails::where('user_id',$id)->get();
        $designations = OrganizationDesignations::orderBy('id')->get();
        $departments = OrganizationDepartments::orderBy('id')->get();
        $immigrations = Immigrations::where('user_id', $id)->orderBy('id')->get();
        $contacts = Contacts::where('user_id', $id)->orderBy('id')->get();
        $social_profile = SocialProfile::where('user_id', $id)->orderBy('id')->get();
        $documents = Documents::where('user_id', $id)->orderBy('id')->get();
        $qulifications = Qulifications::where('user_id', $id)->orderBy('id')->get();
        $works = Works::where('user_id', $id)->orderBy('id')->get();
        $bank_accounts = BankAccounts::where('user_id', $id)->orderBy('id')->get();
        $basic_salarys = BasicSalary::where('user_id', $id)->orderBy('id')->get();
        $allowances = Allowances::where('user_id', $id)->orderBy('id')->get();
        $commissions = Commissions::where('user_id', $id)->orderBy('id')->get();
        $loans = Loans::where('user_id', $id)->orderBy('id')->get();
        $deductions = Deductions::where('user_id', $id)->orderBy('id')->get();
        $payments = OtherPaymnets::where('user_id', $id)->orderBy('id')->get();
        $overtimes = Overtimes::where('user_id', $id)->orderBy('id')->get();
        $pensions = Pensions::where('user_id', $id)->orderBy('id')->get();
        $corehr_promotions = CoreHRPromotions::where('employee', $id)->orderBy('id')->get();
        $corehr_awrds = CoreHRAwards::where('employee', $id)->orderBy('id')->get();
        $corehr_travels = CoreHRTravel::where('employee', $id)->orderBy('id')->get();
        $corehr_transfers = CoreHRTransfer::where('employee', $id)->orderBy('id')->get();
        $corehr_resignations = CoreHRResignations::where('employee', $id)->orderBy('id')->get();
        $corehr_complaints = CoreHRComplaints::where('complaint_from', $id)->orderBy('id')->get();
        $corehr_warnings = CoreHRWarnings::where('employee', $id)->orderBy('id')->get();
        $corehr_terminations = CoreHRTerminations::where('employee', $id)->orderBy('id')->get();
        $custom_leaves = UserCustomLeaves::where('user_id', $id)->orderBy('id')->get();
        $projects = PMProjects::get();
        $tasks = PMTasks::get();
        $leaves = Leaves::where('employee',$id)->get();
        $hods = User::where('user_role', '5')->orderBy('id')->get();
        $hrms = User::where('user_role', '2')->orderBy('id')->get();
        $authorisers = User::where('user_role', '6')->orderBy('id')->get();
        $accessories = Accessories::get();
        $employee_accessories = EmployeeAccessories::where('user_id',$id)->get();
        return view('edit_employee', ['login_details' => $login_details, 'other_details' => $other_details,
        'designations' => $designations, 'departments' => $departments, 'immigrations' => $immigrations,
         'contacts' => $contacts,'social_profile' => $social_profile,'documents' => $documents,
         'qulifications' => $qulifications, 'works' => $works, 'bank_accounts' => $bank_accounts, 'basic_salarys' => $basic_salarys
         , 'allowances' => $allowances, 'commissions' => $commissions, 'loans' => $loans, 'deductions' => $deductions
         , 'payments' => $payments, 'overtimes' => $overtimes, 'pensions' => $pensions, 'corehr_promotions' => $corehr_promotions
         , 'corehr_awrds' => $corehr_awrds, 'corehr_travels' => $corehr_travels, 'corehr_transfers' => $corehr_transfers
         , 'corehr_resignations' => $corehr_resignations, 'corehr_complaints' => $corehr_complaints, 'corehr_warnings' => $corehr_warnings
         , 'corehr_terminations' => $corehr_terminations, 'projects' => $projects, 'tasks' => $tasks, 'leaves' => $leaves,
         'hods' => $hods, 'hrms' => $hrms, 'authorisers' => $authorisers, 'custom_leaves' => $custom_leaves, 'accessories' => $accessories, 'employee_accessories' => $employee_accessories]);
    }
    public function edit_employee_basic($id,Request $request)
    {

    $this->validate($request, [
            'first_name'   => 'required',
            'last_name'   => 'required',
            'phone'   => 'required',
            'dob'   => 'required',
            'gender'   => 'required',
            'nic'   => 'required',
            'company'   => 'required',
            'department'   => 'required',
            'designation'   => 'required',
            'latitude'   => 'required',
            'longitude'   => 'required',
            'office_shift'   => 'required',
            'employment_type'   => 'required',
            'join_date'   => 'required',
             'responsible_person'   => 'required',
           ]);

    if($request->job_description){
        $jd_name = time().'-'.$id.'.'.$request->job_description->extension();
        $request->job_description->move(public_path('job_descriptions'), $jd_name);
      }
    else{
        $jd_name = OtherEmployeeDetails::where('user_id',$id)->value('job_description');;
    }
    if($request->status){
        $status = 'active';
    }
    else{
        $status = 'inactive';
    }

        if(User::where("id", "=", $id)->where("email", "=", $request->email)->exists()){
            $email = $request->email;
        }
        elseif(User::where("email", "=", $request->email)->exists()){
         return back()->with('fail', 'This email is already in use');
        }
        else{
         $email = $request->email;
        }
        if(User::where("id", "=", $id)->where("user_name", "=", $request->user_name)->exists()){
        $user_name = $request->user_name;
        }
        elseif(User::where("user_name", "=", $request->user_name)->exists()){
        return back()->with('fail', 'This user name is already in use');
        }
        else{
        $user_name = $request->user_name;
        }
        if(OtherEmployeeDetails::where("user_id", "=", $id)->where("employment_type", "=", $request->employment_type)->exists()){

        }
        else{
           $employment_type_history = new EmploymentTypeHistory();
           $employment_type_history->employee =$id;
           $employment_type_history->old_employment_type =OtherEmployeeDetails::where("user_id", "=", $id)->value('employment_type');
           $employment_type_history->new_employment_type =$request->employment_type;
           $employment_type_history->save();
        }
        $userDetails =  OtherEmployeeDetails::where('user_id', '=', $id)->first();;
        $userDetails->first_name = $request->first_name;
        $userDetails->last_name = $request->last_name;
        $userDetails->phone = $request->phone;
        $userDetails->dob = $request->dob;
        $userDetails->gender = $request->gender;
        $userDetails->company = $request->company;
        $userDetails->department = $request->department;
        $userDetails->designation = $request->designation;
        $userDetails->office_shift = $request->office_shift;
        $userDetails->employment_type = $request->employment_type;
        $userDetails->join_date = $request->join_date;
        $userDetails->intern_end_date = $request->intern_end_date;
        $userDetails->epf_no = $request->epf_no;
        $userDetails->appoinment_date = $request->appoinment_date;
        $userDetails->responsible_person = $request->responsible_person;
        $userDetails->latitude = $request->latitude;
        $userDetails->longitude = $request->longitude;
        $userDetails->nic = $request->nic;
        $userDetails->job_description = $jd_name;
        $userDetails->update();
        $user = User::find($id);
        $user->email = $email;
        $user->user_name = $user_name;
        $user->status = $status;
        $user->update();
        return back()->with('success', 'Employee Details Successfully  Updated');

    }
    public function view_core_hr_promotion($id,Request $request)
    {
    if($request->isMethod('get')){
    $promotion_details = CoreHRPromotions::where('id',$id)->get();
    return view('view-core-hr-promotion', ['promotion_details' => $promotion_details]);
    }
    }
    public function view_core_hr_award($id,Request $request)
    {
    if($request->isMethod('get')){
    $award_details = CoreHRAwards::where('id',$id)->get();
    return view('view-core-hr-award', ['award_details' => $award_details]);
    }
    }
    public function view_core_hr_travel($id,Request $request)
    {
    if($request->isMethod('get')){
    $travel_details = CoreHRTravel::where('id',$id)->get();
    return view('view-core-hr-travel', ['travel_details' => $travel_details]);
    }
    }
    public function view_core_hr_transfer($id,Request $request)
    {
    if($request->isMethod('get')){
    $transfer_details = CoreHRTransfer::where('id',$id)->get();
    return view('view-core-hr-transfer', ['transfer_details' => $transfer_details]);
    }
    }
    public function add_immigration($id,Request $request)
    {

        $document_name = time().'-'.$id.'.'.$request->document->extension();
        $request->document->move(public_path('immigration_documents'), $document_name);

        $immigration = new Immigrations();
        $immigration->user_id =$id;
        $immigration->document_no =$request->document_no;
        $immigration->document_type =$request->document_type;
        $immigration->issue_date =$request->issue_date;
        $immigration->expire_date =$request->expire_date;
        $immigration->review_date =$request->review_date;
        $immigration->country =$request->country;
        $immigration->document =$document_name;
        $immigration->save();
        return back()->with('success', 'Immigration Successfully Added');
    }
    public function edit_immigration($id,Request $request)
    {
    if($request->isMethod('get')){
    $immigration_details = Immigrations::where('id',$id)->get();
    return view('edit-immigration', ['immigration_details' => $immigration_details]);
    }
    if($request->isMethod('post')){

    if($request->document){
        $document_name = time().'-'.$id.'.'.$request->document->extension();
        $request->document->move(public_path('immigration_documents'), $document_name);
       }
       else{
        $document_name = Immigrations::where('id',$id)->value('document');;
    }
        $immigration =  Immigrations::where('id', '=', $id)->first();;
        $immigration->document_no =$request->document_no;
        $immigration->document_type =$request->document_type;
        $immigration->issue_date =$request->issue_date;
        $immigration->expire_date =$request->expire_date;
        $immigration->review_date =$request->review_date;
        $immigration->country =$request->country;
        $immigration->document =$document_name;
        $immigration->update();
        return back()->with('success', 'Immigration Details Successfully  Updated');
    }

    }
    public function delete_immigration($id){
        Immigrations::find($id)->delete();
        return back()->with('success', 'Immigration Details Successfully  Deleted');
    }
    public function add_contact($id,Request $request)
    {

        $contact = new Contacts();
        $contact->user_id =$id;
        $contact->relation =$request->relation;
        $contact->email_work =$request->email_work;
        $contact->email_personal =$request->email_personal;
        $contact->name =$request->name;
        $contact->address_line1 =$request->address_line1;
        $contact->address_line2 =$request->address_line2;
        $contact->mobile_work =$request->mobile_work;
        $contact->mobile_ext =$request->mobile_ext;
        $contact->mobile_personal =$request->mobile_personal;
        $contact->mobile_home =$request->mobile_home;
        $contact->city =$request->city;
        $contact->state_province =$request->state_province;
        $contact->zip =$request->zip;
        $contact->country =$request->country;
        $contact->save();
        return back()->with('success', 'Contact Successfully Added');
    }
    public function edit_contact($id,Request $request)
    {
    if($request->isMethod('get')){
    $contact_details = Contacts::where('id',$id)->get();
    return view('edit-contact', ['contact_details' => $contact_details]);
    }
    if($request->isMethod('post')){

        $contact =  Contacts::where('id', '=', $id)->first();;
        $contact->relation =$request->relation;
        $contact->email_work =$request->email_work;
        $contact->email_personal =$request->email_personal;
        $contact->name =$request->name;
        $contact->address_line1 =$request->address_line1;
        $contact->address_line2 =$request->address_line2;
        $contact->mobile_work =$request->mobile_work;
        $contact->mobile_ext =$request->mobile_ext;
        $contact->mobile_personal =$request->mobile_personal;
        $contact->mobile_home =$request->mobile_home;
        $contact->city =$request->city;
        $contact->state_province =$request->state_province;
        $contact->zip =$request->zip;
        $contact->country =$request->country;
        $contact->update();
        return back()->with('success', 'Contact Details Successfully  Updated');
    }

    }
    public function delete_contact($id){
        Contacts::find($id)->delete();
        return back()->with('success', 'Contact Details Successfully  Deleted');
    }
    public function add_social_profile($id,Request $request)
    {

        if(SocialProfile::where("user_id", "=", $id)->exists()){
            $social_profile = SocialProfile::where('user_id', '=', $id)->first();
            $social_profile->facebook_profile =$request->facebook_profile;
            $social_profile->skype_profile =$request->skype_profile;
            $social_profile->linkedIn_profile =$request->linkedIn_profile;
            $social_profile->twitter_profile =$request->twitter_profile;
            $social_profile->whatsapp_profile =$request->whatsapp_profile;
            $social_profile->update();
            return back()->with('success', 'Social Profile Successfully Updated');
        }
        else{
            $social_profile = new SocialProfile();
            $social_profile->user_id =$id;
            $social_profile->facebook_profile =$request->facebook_profile;
            $social_profile->skype_profile =$request->skype_profile;
            $social_profile->linkedIn_profile =$request->linkedIn_profile;
            $social_profile->twitter_profile =$request->twitter_profile;
            $social_profile->whatsapp_profile =$request->whatsapp_profile;
            $social_profile->save();
            return back()->with('success', 'Social Profile Successfully Updated');
        }

    }
    public function add_document($id,Request $request)
    {

        $document_name = time().'-'.$id.'.'.$request->document->extension();
        $request->document->move(public_path('genaral_document_documents'), $document_name);

        if($request->send_notification){
            $notification = 'yes';
        }
        else{
            $notification = 'no';
        }
        $document = new Documents();
        $document->user_id =$id;
        $document->title =$request->title;
        $document->document_type =$request->document_type;
        $document->discription =$request->discription;
        $document->expire_date =$request->expire_date;
        $document->document =$document_name;
        $document->send_notification =$notification;
        $document->save();
        return back()->with('success', 'Document Successfully Added');
    }
    public function edit_document($id,Request $request)
    {
    if($request->isMethod('get')){
    $document_details = Documents::where('id',$id)->get();
    return view('edit-document', ['document_details' => $document_details]);
    }
    if($request->isMethod('post')){

    if($request->document){
        $document_name = time().'-'.$id.'.'.$request->document->extension();
        $request->document->move(public_path('genaral_document_documents'), $document_name);
       }
       else{
        $document_name = Documents::where('id',$id)->value('document');;
    }
    if($request->send_notification){
        $notification = 'yes';
    }
    else{
        $notification = 'no';
    }
        $document =  Documents::where('id', '=', $id)->first();;
        $document->title =$request->title;
        $document->document_type =$request->document_type;
        $document->discription =$request->discription;
        $document->expire_date =$request->expire_date;
        $document->document =$document_name;
        $document->send_notification =$notification;
        $document->update();
        return back()->with('success', 'Document Details Successfully  Updated');
    }

    }
    public function delete_document($id){
        Documents::find($id)->delete();
        return back()->with('success', 'Document Details Successfully  Deleted');
    }
    public function add_qulification($id,Request $request)
    {

        $qulification = new Qulifications();
        $qulification->user_id =$id;
        $qulification->school_university =$request->school_university;
        $qulification->education_level =$request->education_level;
        $qulification->from_date =$request->from;
        $qulification->to_date =$request->to;
        $qulification->language =$request->language;
        $qulification->professional_skills =$request->professional_skills;
        $qulification->discription =$request->discription;
        $qulification->save();
        return back()->with('success', 'Qulification Successfully Added');
    }
    public function edit_qulification($id,Request $request)
    {
    if($request->isMethod('get')){
    $qulification_details = Qulifications::where('id',$id)->get();
    return view('edit-qulification', ['qulification_details' => $qulification_details]);
    }
    if($request->isMethod('post')){

        $qulification =  Qulifications::where('id', '=', $id)->first();;
        $qulification->school_university =$request->school_university;
        $qulification->education_level =$request->education_level;
        $qulification->from_date =$request->from;
        $qulification->to_date =$request->to;
        $qulification->language =$request->language;
        $qulification->professional_skills =$request->professional_skills;
        $qulification->discription =$request->discription;
        $qulification->update();
        return back()->with('success', 'Qulification Details Successfully  Updated');
    }

    }
    public function delete_qulification($id){
        Qulifications::find($id)->delete();
        return back()->with('success', 'Qulification Details Successfully  Deleted');
    }
    public function add_work($id,Request $request)
    {

        $work = new Works();
        $work->user_id =$id;
        $work->company =$request->company;
        $work->from_date =$request->from_date;
        $work->to_date =$request->to_date;
        $work->post =$request->post;
        $work->discription =$request->discription;
        $work->save();
        return back()->with('success', 'Work Successfully Added');
    }
    public function edit_work($id,Request $request)
    {
    if($request->isMethod('get')){
    $work_details = Works::where('id',$id)->get();
    return view('edit-work', ['work_details' => $work_details]);
    }
    if($request->isMethod('post')){

        $work =  Works::where('id', '=', $id)->first();;
        $work->company =$request->company;
        $work->from_date =$request->from_date;
        $work->to_date =$request->to_date;
        $work->post =$request->post;
        $work->discription =$request->discription;
        $work->update();
        return back()->with('success', 'Work Details Successfully  Updated');
    }

    }
    public function delete_work($id){
        Works::find($id)->delete();
        return back()->with('success', 'Work Details Successfully  Deleted');
    }
    public function add_bank_account($id,Request $request)
    {

        $account = new BankAccounts();
        $account->user_id =$id;
        $account->account_title =$request->account_title;
        $account->account_number =$request->account_number;
        $account->bank_name =$request->bank_name;
        $account->bank_code =$request->bank_code;
        $account->bank_branch =$request->bank_branch;
        $account->save();
        return back()->with('success', 'Bank Account Successfully Added');
    }
    public function edit_bank_account($id,Request $request)
    {
    if($request->isMethod('get')){
    $bank_details = BankAccounts::where('id',$id)->get();
    return view('edit-bank-account', ['bank_details' => $bank_details]);
    }
    if($request->isMethod('post')){

        $account =  BankAccounts::where('id', '=', $id)->first();;
        $account->account_title =$request->account_title;
        $account->account_number =$request->account_number;
        $account->bank_name =$request->bank_name;
        $account->bank_code =$request->bank_code;
        $account->bank_branch =$request->bank_branch;
        $account->update();
        return back()->with('success', 'Bank Account Details Successfully  Updated');
    }

    }
    public function delete_bank_account($id){
        BankAccounts::find($id)->delete();
        return back()->with('success', 'Bank Account Details Successfully  Deleted');
    }
    public function change_employee_image($id,Request $request)
    {
        $image_name = time().'employee.'.$request->image->extension();
        $request->image->move(public_path('user_images'), $image_name);

        $change_image =  OtherEmployeeDetails::where('user_id', '=', $id)->first();;
        $change_image->image =$image_name;
        $change_image->update();
        return back()->with('success', 'Employee Profile Picture  Updated');

    }
    public function add_basic_salary($id,Request $request)
    {

        $sallery = new BasicSalary();
        $sallery->user_id =$id;
        $sallery->month_year =$request->month_year;
        $sallery->payslip_type =$request->payslip_type;
        $sallery->basic_salary =$request->basic_salary;
        $sallery->save();
        return back()->with('success', 'Basic Salary Successfully Added');
    }
    public function edit_basic_salary($id,Request $request)
    {
    if($request->isMethod('get')){
    $salary_details = BasicSalary::where('id',$id)->get();
    return view('edit-basic-salary', ['salary_details' => $salary_details]);
    }
    if($request->isMethod('post')){

        $sallery =  BasicSalary::where('id', '=', $id)->first();;
        $sallery->month_year =$request->month_year;
        $sallery->payslip_type =$request->payslip_type;
        $sallery->basic_salary =$request->basic_salary;
        $sallery->update();
        return back()->with('success', 'Basic Salary  Details Successfully  Updated');
    }

    }
    public function delete_basic_salary($id){
        BasicSalary::find($id)->delete();
        return back()->with('success', 'Basic Salary  Details Successfully  Deleted');
    }
    public function add_allowances($id,Request $request)
    {
        $allowance = new Allowances();
        $allowance->user_id =$id;
        $allowance->month_year =$request->month_year;
        $allowance->allowance_type =$request->allowance_type;
        $allowance->allowance_title =$request->allowance_title;
        $allowance->allowance_amount =$request->allowance_amount;
        $allowance->save();
        return back()->with('success', 'Allowance Successfully Added');
    }
    public function edit_allowances($id,Request $request)
    {
    if($request->isMethod('get')){
    $allowance_details = Allowances::where('id',$id)->get();
    return view('edit-allowances', ['allowance_details' => $allowance_details]);
    }
    if($request->isMethod('post')){

        $allowance =  Allowances::where('id', '=', $id)->first();;
        $allowance->month_year =$request->month_year;
        $allowance->allowance_type =$request->allowance_type;
        $allowance->allowance_title =$request->allowance_title;
        $allowance->allowance_amount =$request->allowance_amount;
        $allowance->update();
        return back()->with('success', 'Allowance  Details Successfully  Updated');
    }

    }
    public function delete_allowances($id){
        Allowances::find($id)->delete();
        return back()->with('success', 'Allowance  Details Successfully  Deleted');
    }
    public function add_commissions($id,Request $request)
    {
        $commission = new Commissions();
        $commission->user_id =$id;
        $commission->month_year =$request->month_year;
        $commission->commission_title =$request->commission_title;
        $commission->commission_amount =$request->commission_amount;
        $commission->save();
        return back()->with('success', 'Commission Successfully Added');
    }
    public function edit_commissions($id,Request $request)
    {
    if($request->isMethod('get')){
    $commission_details = Commissions::where('id',$id)->get();
    return view('edit-commissions', ['commission_details' => $commission_details]);
    }
    if($request->isMethod('post')){

        $commission =  Commissions::where('id', '=', $id)->first();;
        $commission->month_year =$request->month_year;
        $commission->commission_title =$request->commission_title;
        $commission->commission_amount =$request->commission_amount;
        $commission->update();
        return back()->with('success', 'Commission  Details Successfully  Updated');
    }

    }
    public function delete_commissions($id){
        Commissions::find($id)->delete();
        return back()->with('success', 'Commission  Details Successfully  Deleted');
    }
    public function add_loan($id,Request $request)
    {
        $loan = new Loans();
        $loan->user_id =$id;
        $loan->month_year =$request->month_year;
        $loan->loan_option =$request->loan_option;
        $loan->title =$request->title;
        $loan->amount =$request->amount;
        $loan->number_of_installments =$request->number_of_installments;
        $loan->reason =$request->reason;
        $loan->save();
        return back()->with('success', 'Loan Successfully Added');
    }
    public function edit_loan($id,Request $request)
    {
    if($request->isMethod('get')){
    $loan_details = Loans::where('id',$id)->get();
    return view('edit-loan', ['loan_details' => $loan_details]);
    }
    if($request->isMethod('post')){

        $loan =  Loans::where('id', '=', $id)->first();;
        $loan->month_year =$request->month_year;
        $loan->loan_option =$request->loan_option;
        $loan->title =$request->title;
        $loan->amount =$request->amount;
        $loan->number_of_installments =$request->number_of_installments;
        $loan->reason =$request->reason;
        $loan->update();
        return back()->with('success', 'Loan  Details Successfully  Updated');
    }

    }
    public function delete_loan($id){
        Loans::find($id)->delete();
        return back()->with('success', 'Loan  Details Successfully  Deleted');
    }
    public function add_deduction($id,Request $request)
    {
        $deduction = new Deductions();
        $deduction->user_id =$id;
        $deduction->month_year =$request->month_year;
        $deduction->deduction_option =$request->deduction_option;
        $deduction->title =$request->title;
        $deduction->amount =$request->amount;
        $deduction->save();
        return back()->with('success', 'Deduction Successfully Added');
    }
    public function edit_deduction($id,Request $request)
    {
    if($request->isMethod('get')){
    $deduction_details = Deductions::where('id',$id)->get();
    return view('edit-deduction', ['deduction_details' => $deduction_details]);
    }
    if($request->isMethod('post')){

        $deduction =  Deductions::where('id', '=', $id)->first();;
        $deduction->month_year =$request->month_year;
        $deduction->deduction_option =$request->deduction_option;
        $deduction->title =$request->title;
        $deduction->amount =$request->amount;
        $deduction->update();
        return back()->with('success', 'Deduction  Details Successfully  Updated');
    }

    }
    public function delete_deduction($id){
        Deductions::find($id)->delete();
        return back()->with('success', 'Deduction  Details Successfully  Deleted');
    }
    public function add_payment($id,Request $request)
    {
        $payment = new OtherPaymnets();
        $payment->user_id =$id;
        $payment->month_year =$request->month_year;
        $payment->title =$request->title;
        $payment->amount =$request->amount;
        $payment->save();
        return back()->with('success', 'Payment Successfully Added');
    }
    public function edit_payment($id,Request $request)
    {
    if($request->isMethod('get')){
    $payment_details = OtherPaymnets::where('id',$id)->get();
    return view('edit-payment', ['payment_details' => $payment_details]);
    }
    if($request->isMethod('post')){

        $payment =  OtherPaymnets::where('id', '=', $id)->first();;
        $payment->month_year =$request->month_year;
        $payment->title =$request->title;
        $payment->amount =$request->amount;
        $payment->update();
        return back()->with('success', 'Payment  Details Successfully  Updated');
    }

    }
    public function delete_payment($id){
        OtherPaymnets::find($id)->delete();
        return back()->with('success', 'Payment  Details Successfully  Deleted');
    }
    public function add_overtime($id,Request $request)
    {
        $overtime = new Overtimes();
        $overtime->user_id =$id;
        $overtime->month_year =$request->month_year;
        $overtime->title =$request->title;
        $overtime->no_of_days =$request->no_of_days;
        $overtime->total_hours =$request->total_hours;
        $overtime->rate =$request->rate;
        $overtime->save();
        return back()->with('success', 'Overtime Successfully Added');
    }
    public function edit_overtime($id,Request $request)
    {
    if($request->isMethod('get')){
    $overtime_details = Overtimes::where('id',$id)->get();
    return view('edit-overtime', ['overtime_details' => $overtime_details]);
    }
    if($request->isMethod('post')){

        $overtime =  Overtimes::where('id', '=', $id)->first();;
        $overtime->month_year =$request->month_year;
        $overtime->title =$request->title;
        $overtime->no_of_days =$request->no_of_days;
        $overtime->total_hours =$request->total_hours;
        $overtime->rate =$request->rate;
        $overtime->update();
        return back()->with('success', 'Overtime  Details Successfully  Updated');
    }

    }
    public function delete_overtime($id){
        Overtimes::find($id)->delete();
        return back()->with('success', 'Overtime  Details Successfully  Deleted');
    }
    public function add_pension($id,Request $request)
    {
        if(Pensions::where("user_id", "=", $id)->exists()){
            $pension =  Pensions::where('user_id', '=', $id)->first();;
            $pension->pansion_type =$request->pansion_type;
            $pension->amount =$request->amount;
            $pension->update();
            return back()->with('success', 'Pension  Details Successfully  Updated');
        }
        else{
            $pension = new Pensions();
            $pension->user_id =$id;
            $pension->pansion_type =$request->pansion_type;
            $pension->amount =$request->amount;
            $pension->save();
            return back()->with('success', 'Pension Successfully Added');
        }

    }
    public function core_hr_promotions(Request $request)
    {
    $employees = OtherEmployeeDetails::get();
    $promotions = CoreHRPromotions::get();
    return view('core-hr-promotions', ['employees' => $employees,'promotions' => $promotions]);

    }
    public function add_promotion(Request $request)
    {
    if($request->isMethod('get')){
    $employees = OtherEmployeeDetails::get();
    $promotions = CoreHRPromotions::get();
    return view('add_promotion', ['employees' => $employees,'promotions' => $promotions]);
    }
    if($request->isMethod('post')){
        $this->validate($request, [
            'employee'   => 'required',
            'title'   => 'required',
            'promotion_date'   => 'required',
            'discription'  => 'required',
        ]);

        $promotion =  new CoreHRPromotions();
        $promotion->employee =$request->employee;
        $promotion->title =$request->title;
        $promotion->promotion_date =$request->promotion_date;
        $promotion->discription =$request->discription;
        $promotion->save();
        return back()->with('success', 'Promotion Added');
    }

    }
    public function delete_core_hr_promotion($id){
        CoreHRPromotions::find($id)->delete();
        return back()->with('success', 'Promotion Successfully  Deleted');
    }
    public function edit_core_hr_promotion($id,Request $request)
    {
    if($request->isMethod('get')){
    $promotion_details = CoreHRPromotions::where('id',$id)->get();
    $employees = OtherEmployeeDetails::get();
    return view('edit-core-hr-promotion', ['promotion_details' => $promotion_details,'employees' => $employees]);
    }
    if($request->isMethod('post')){

        $promotion =  CoreHRPromotions::where('id', '=', $id)->first();
        $promotion->employee =$request->employee;
        $promotion->title =$request->title;
        $promotion->promotion_date =$request->promotion_date;
        $promotion->discription =$request->discription;
        $promotion->update();
        return back()->with('success', 'Promotion  Details Successfully  Updated');
    }

    }
    public function core_hr_awards(Request $request)
    {
    if($request->isMethod('get')){
    $employees = OtherEmployeeDetails::get();
    $depatments = OrganizationDepartments::get();
    $awards = CoreHRAwards::get();
    return view('core-hr-awards', ['employees' => $employees,'awards' => $awards,'depatments' => $depatments]);
    }

    }
    public function add_award(Request $request)
    {
    if($request->isMethod('get')){
    $employees = OtherEmployeeDetails::get();
    $departments = OrganizationDepartments::get();
    $awards = CoreHRAwards::get();
    return view('add_award', ['employees' => $employees,'awards' => $awards,'departments' => $departments]);
    }
    if($request->isMethod('post')){
        $this->validate($request, [

            'employee'   => 'required',
            'department'   => 'required',
            'award_type'   => 'required',
            'gift'  => 'required',
            'cash'   => 'required',
            'award_date'  => 'required',
            'award_information'   => 'required',
        ]);
        if($request->image){
            $image_name = time().'-award-.'.$request->image->extension();
           $request->image->move(public_path('core_hr_images'), $image_name);
        }
           else{
            $image_name = "defaul_award.jpg";
        }
        $award =  new CoreHRAwards();

        $award->employee =$request->employee;
        $award->department =$request->department;
        $award->award_type =$request->award_type;
        $award->gift =$request->gift;
        $award->award_type =$request->award_type;
        $award->cash =$request->cash;
        $award->award_date =$request->award_date;
        $award->award_information =$request->award_information;
        $award->photo =$image_name;
        $award->save();
        return back()->with('success', 'Award Added');
    }

    }
    public function delete_core_hr_award($id){
        CoreHRAwards::find($id)->delete();
        return back()->with('success', 'Award Successfully  Deleted');
    }
    public function edit_core_hr_award($id,Request $request)
    {
    if($request->isMethod('get')){
    $award_details = CoreHRAwards::where('id',$id)->get();
    $employees = OtherEmployeeDetails::get();
    $depatments = OrganizationDepartments::get();
    return view('edit-core-hr-award', ['award_details' => $award_details,'employees' => $employees,'depatments' => $depatments]);
    }
    if($request->isMethod('post')){

        if($request->image){
           $image_name = time().'-award-.'.$request->image->extension();
           $request->image->move(public_path('core_hr_images'), $image_name);
           }
           else{
            $image_name = CoreHRAwards::where('id',$id)->value('photo');;
        }
        $award =  CoreHRAwards::where('id', '=', $id)->first();;

        $award->employee =$request->employee;
        $award->department =$request->department;
        $award->award_type =$request->award_type;
        $award->gift =$request->gift;
        $award->award_type =$request->award_type;
        $award->cash =$request->cash;
        $award->award_date =$request->award_date;
        $award->award_information =$request->award_information;
        $award->photo =$image_name;
        $award->update();
        return back()->with('success', 'Award  Details Successfully  Updated');
    }

    }
    public function core_hr_travels(Request $request)
    {

    $employees = OtherEmployeeDetails::get();
    $travels = CoreHRTravel::get();
    return view('core-hr-travels', ['employees' => $employees,'travels' => $travels]);


    }
    public function add_travel(Request $request)
    {
    if($request->isMethod('get')){
    $employees = OtherEmployeeDetails::get();
    $travels = CoreHRTravel::get();
    return view('add_travel', ['employees' => $employees,'travels' => $travels]);
    }
    if($request->isMethod('post')){
        $this->validate($request, [

            'employee'   => 'required',
            'arrangment_type'   => 'required',
            'visit_purpose'   => 'required',
            'visit_place'  => 'required',
            'discription'   => 'required',
            'start_date'  => 'required',
            'end_date'   => 'required',
            'expected_budget'  => 'required',
            'actual_budget'   => 'required',
            'travel_mode'  => 'required',
            'status'   => 'required',
        ]);

        $travel =  new CoreHRTravel();

        $travel->employee =$request->employee;
        $travel->arrangment_type =$request->arrangment_type;
        $travel->visit_purpose =$request->visit_purpose;
        $travel->visit_place =$request->visit_place;
        $travel->discription =$request->discription;
        $travel->start_date =$request->start_date;
        $travel->end_date =$request->end_date;
        $travel->expected_budget =$request->expected_budget;
        $travel->actual_budget =$request->actual_budget;
        $travel->travel_mode =$request->travel_mode;
        $travel->status =$request->status;
        $travel->save();
        return back()->with('success', 'Travel Added');
    }

    }
    public function delete_core_hr_travel($id){
        CoreHRTravel::find($id)->delete();
        return back()->with('success', 'Travel Successfully  Deleted');
    }
    public function edit_core_hr_travel($id,Request $request)
    {
    if($request->isMethod('get')){
    $travel_details = CoreHRTravel::where('id',$id)->get();
    $employees = OtherEmployeeDetails::get();
    return view('edit-core-hr-travel', ['travel_details' => $travel_details,'employees' => $employees]);
    }
    if($request->isMethod('post')){

        $travel =  CoreHRTravel::where('id', '=', $id)->first();;

        $travel->employee =$request->employee;
        $travel->arrangment_type =$request->arrangment_type;
        $travel->visit_purpose =$request->visit_purpose;
        $travel->visit_place =$request->visit_place;
        $travel->discription =$request->discription;
        $travel->start_date =$request->start_date;
        $travel->end_date =$request->end_date;
        $travel->expected_budget =$request->expected_budget;
        $travel->actual_budget =$request->actual_budget;
        $travel->travel_mode =$request->travel_mode;
        $travel->status =$request->status;
        $travel->update();
        return back()->with('success', 'Travel  Details Successfully  Updated');
    }

    }
    public function core_hr_transfers(Request $request)
    {

    $employees = OtherEmployeeDetails::get();
    $transfers = CoreHRTransfer::get();
    $depatments = OrganizationDepartments::get();
    return view('core-hr-transfers', ['employees' => $employees,'transfers' => $transfers,'depatments' => $depatments]);

    }
    public function add_transfer(Request $request)
    {
    if($request->isMethod('get')){
    $employees = OtherEmployeeDetails::get();
    $transfers = CoreHRTransfer::get();
    $depatments = OrganizationDepartments::get();
    return view('add_transfer', ['employees' => $employees,'transfers' => $transfers,'depatments' => $depatments]);
    }
    if($request->isMethod('post')){
        $this->validate($request, [

            'employee'   => 'required',
            'from_department'   => 'required',
            'to_department'   => 'required',
            'transfer_date'  => 'required',
            'discription'   => 'required',

        ]);

        $transfer =  new CoreHRTransfer();

        $transfer->employee =$request->employee;
        $transfer->from_department =$request->from_department;
        $transfer->to_department =$request->to_department;
        $transfer->transfer_date =$request->transfer_date;
        $transfer->discription =$request->discription;
        $transfer->save();
        return back()->with('success', 'Transfer Added');
    }

    }
    public function delete_core_hr_transfer($id){
        CoreHRTransfer::find($id)->delete();
        return back()->with('success', 'Transfer Successfully  Deleted');
    }
    public function edit_core_hr_transfer($id,Request $request)
    {
    if($request->isMethod('get')){
    $transfer_details = CoreHRTransfer::where('id',$id)->get();
    $employees = OtherEmployeeDetails::get();
    $depatments = OrganizationDepartments::get();
    return view('edit-core-hr-transfer', ['transfer_details' => $transfer_details,'employees' => $employees,'depatments' => $depatments]);
    }
    if($request->isMethod('post')){

        $transfer =  CoreHRTransfer::where('id', '=', $id)->first();;

        $transfer->employee =$request->employee;
        $transfer->from_department =$request->from_department;
        $transfer->to_department =$request->to_department;
        $transfer->transfer_date =$request->transfer_date;
        $transfer->discription =$request->discription;
        $transfer->update();
        return back()->with('success', 'Transfer  Details Successfully  Updated');
    }

    }
    public function core_hr_resignations(Request $request)
    {

    $employees = OtherEmployeeDetails::get();
    $resignations = CoreHRResignations::get();
    $depatments = OrganizationDepartments::get();
    return view('core-hr-resignations', ['employees' => $employees,'resignations' => $resignations,'depatments' => $depatments]);



    }
    public function add_resignation(Request $request)
    {
    if($request->isMethod('get')){
    $employees = OtherEmployeeDetails::get();
    $resignations = CoreHRResignations::get();
    $depatments = OrganizationDepartments::get();
    return view('add_resignation', ['employees' => $employees,'resignations' => $resignations,'depatments' => $depatments]);
    }
    if($request->isMethod('post')){
        $this->validate($request, [

            'employee'   => 'required',
            'department'   => 'required',
            'notice_date'   => 'required',
            'resignation_date'  => 'required',
            'discription'   => 'required',

        ]);

        $resignation =  new CoreHRResignations();

        $resignation->employee =$request->employee;
        $resignation->department =$request->department;
        $resignation->notice_date =$request->notice_date;
        $resignation->resignation_date =$request->resignation_date;
        $resignation->discription =$request->discription;
        $resignation->save();
        return back()->with('success', 'Resignation Added');
    }

    }
    public function delete_core_hr_resignation($id){
        CoreHRResignations::find($id)->delete();
        return back()->with('success', 'Resignation Successfully  Deleted');
    }
    public function edit_core_hr_resignation($id,Request $request)
    {
    if($request->isMethod('get')){
    $resignation_details = CoreHRResignations::where('id',$id)->get();
    $employees = OtherEmployeeDetails::get();
    $depatments = OrganizationDepartments::get();
    return view('edit-core-hr-resignation', ['resignation_details' => $resignation_details,'employees' => $employees,'depatments' => $depatments]);
    }
    if($request->isMethod('post')){

        $resignation =  CoreHRResignations::where('id', '=', $id)->first();;
        $resignation->employee =$request->employee;
        $resignation->department =$request->department;
        $resignation->notice_date =$request->notice_date;
        $resignation->resignation_date =$request->resignation_date;
        $resignation->discription =$request->discription;
        $resignation->update();
        return back()->with('success', 'Resignation  Details Successfully  Updated');
    }

    }
    public function core_hr_complaints(Request $request)
    {

    $employees = OtherEmployeeDetails::get();
    $complaints = CoreHRComplaints::get();
    return view('core-hr-complaints', ['employees' => $employees,'complaints' => $complaints]);

    }
    public function add_complaint(Request $request)
    {
    if($request->isMethod('get')){
    $employees = OtherEmployeeDetails::get();
    $complaints = CoreHRComplaints::get();
    return view('add_complaint', ['employees' => $employees,'complaints' => $complaints]);
    }
    if($request->isMethod('post')){
        $this->validate($request, [

            'complaint_from'   => 'required',
            'complaint_against'   => 'required',
            'complaint_title'   => 'required',
            'complaint_date'  => 'required',
            'discription'   => 'required',


        ]);
        if($request->send_notification){
            $notification = 'yes';
        }
        else{
            $notification = 'no';
        }
        $complaint =  new CoreHRComplaints();

        $complaint->complaint_from =$request->complaint_from;
        $complaint->complaint_against =$request->complaint_against;
        $complaint->complaint_title =$request->complaint_title;
        $complaint->complaint_date =$request->complaint_date;
        $complaint->discription =$request->discription;
        $complaint->send_notification =$notification;
        $complaint->save();
        return back()->with('success', 'Complaint Added');
    }

    }
    public function delete_core_hr_complaint($id){
        CoreHRComplaints::find($id)->delete();
        return back()->with('success', 'Complaint Successfully  Deleted');
    }
    public function edit_core_hr_complaint($id,Request $request)
    {
    if($request->isMethod('get')){
    $complaint_details = CoreHRComplaints::where('id',$id)->get();
    $employees = OtherEmployeeDetails::get();
    return view('edit-core-hr-complaint', ['complaint_details' => $complaint_details,'employees' => $employees]);
    }
    if($request->isMethod('post')){
        if($request->send_notification){
            $notification = 'yes';
        }
        else{
            $notification = 'no';
        }

        $complaint =  CoreHRComplaints::where('id', '=', $id)->first();;

        $complaint->complaint_from =$request->complaint_from;
        $complaint->complaint_against =$request->complaint_against;
        $complaint->complaint_title =$request->complaint_title;
        $complaint->complaint_date =$request->complaint_date;
        $complaint->discription =$request->discription;
        $complaint->send_notification =$notification;
        $complaint->update();
        return back()->with('success', 'Complaint  Details Successfully  Updated');
    }

    }
    public function core_hr_warnings(Request $request)
    {

    $employees = OtherEmployeeDetails::get();
    $warnings = CoreHRWarnings::get();
    return view('core-hr-warnings', ['employees' => $employees,'warnings' => $warnings]);

    }
    public function add_warning(Request $request)
    {
    if($request->isMethod('get')){
    $employees = OtherEmployeeDetails::get();
    $warnings = CoreHRWarnings::get();
    return view('add_warning', ['employees' => $employees,'warnings' => $warnings]);
    }
    if($request->isMethod('post')){
        $this->validate($request, [

            'employee'   => 'required',
            'warning_type'   => 'required',
            'subject'   => 'required',
            'warning_date'  => 'required',
            'discription'   => 'required',
            'status'   => 'required',
        ]);

        $warning =  new CoreHRWarnings();

        $warning->employee =$request->employee;
        $warning->warning_type =$request->warning_type;
        $warning->subject =$request->subject;
        $warning->warning_date =$request->warning_date;
        $warning->discription =$request->discription;
        $warning->status =$request->status;
        $warning->save();
        return back()->with('success', 'Warning Added');
    }

    }
    public function delete_core_hr_warning($id){
        CoreHRWarnings::find($id)->delete();
        return back()->with('success', 'Warning Successfully  Deleted');
    }
    public function edit_core_hr_warning($id,Request $request)
    {
    if($request->isMethod('get')){
    $warning_details = CoreHRWarnings::where('id',$id)->get();
    $employees = OtherEmployeeDetails::get();
    return view('edit-core-hr-warning', ['warning_details' => $warning_details,'employees' => $employees]);
    }
    if($request->isMethod('post')){

        $warning =  CoreHRWarnings::where('id', '=', $id)->first();;

        $warning->employee =$request->employee;
        $warning->warning_type =$request->warning_type;
        $warning->subject =$request->subject;
        $warning->warning_date =$request->warning_date;
        $warning->discription =$request->discription;
        $warning->status =$request->status;
        $warning->update();
        return back()->with('success', 'Warning  Details Successfully  Updated');
    }

    }
    public function core_hr_terminations(Request $request)
    {

    $employees = OtherEmployeeDetails::get();
    $terminations = CoreHRTerminations::get();
    return view('core-hr-terminations', ['employees' => $employees,'terminations' => $terminations]);

    }
    public function add_termination(Request $request)
    {
    if($request->isMethod('get')){
    $employees = OtherEmployeeDetails::get();
    $terminations = CoreHRTerminations::get();
    return view('add_termination', ['employees' => $employees,'terminations' => $terminations]);
    }
    if($request->isMethod('post')){
        $this->validate($request, [

            'employee'   => 'required',
            'termination_type'   => 'required',
            'termination_date'   => 'required',
            'notice_date'  => 'required',
            'discription'   => 'required',
        ]);

        $termination =  new CoreHRTerminations();

        $termination->employee =$request->employee;
        $termination->termination_type =$request->termination_type;
        $termination->termination_date =$request->termination_date;
        $termination->notice_date =$request->notice_date;
        $termination->discription =$request->discription;
        $termination->save();
        return back()->with('success', 'Termination Added');
    }

    }
    public function delete_core_hr_termination($id){
        CoreHRTerminations::find($id)->delete();
        return back()->with('success', 'Termination Successfully  Deleted');
    }
    public function edit_core_hr_termination($id,Request $request)
    {
    if($request->isMethod('get')){
    $termination_details = CoreHRTerminations::where('id',$id)->get();
    $employees = OtherEmployeeDetails::get();
    return view('edit-core-hr-termination', ['termination_details' => $termination_details,'employees' => $employees]);
    }
    if($request->isMethod('post')){

        $termination =  CoreHRTerminations::where('id', '=', $id)->first();;

        $termination->employee =$request->employee;
        $termination->termination_type =$request->termination_type;
        $termination->termination_date =$request->termination_date;
        $termination->notice_date =$request->notice_date;
        $termination->discription =$request->discription;
        $termination->update();
        return back()->with('success', 'Termination  Details Successfully  Updated');
    }

    }
    public function pm_clients(Request $request)
    {
    if($request->isMethod('get')){
    $clients = OtherClientDetails::get();
    return view('pm-clients', ['clients' => $clients]);
    }
    }

    public function add_client(Request $request)
    {
    if($request->isMethod('get')){
    return view('add_client');
    }
    if($request->isMethod('post')){
        $this->validate($request, [
            'first_name'   => 'required',
            'last_name'   => 'required',
            'company'   => 'required',
            'user_name'   => 'required | min:6 | unique:users',
            'email'  => 'required | email | unique:users',
            'password'   => 'required | min:6',
            'phone'   => 'required',
            'website'   => 'required',
            'address_line_1'   => 'required',
            'address_line_2'   => 'required',
            'city'   => 'required',
            'state_province'   => 'required',
            'zip'   => 'required',
            'country'   => 'required',
            'image'   => 'required',
        ]);

        if($request->image){
           $image_name = time().'client.'.$request->image->extension();
           $request->image->move(public_path('user_images'), $image_name);
           }
           else{
            $image_name = "defaul_admin.jpg";
           }

           DB::beginTransaction();
           $user = User::create([
              "user_name" => $request->user_name,
              "email" => $request->email,
              "password" => Hash::make($request->password),
              "user_role" => 4,
              "status" => "active"
           ]);

           $client = new OtherClientDetails();
           $client->user_id =$user->id;
           $client->first_name = $request->first_name;
           $client->last_name = $request->last_name;
           $client->company = $request->company;
           $client->phone = $request->phone;
           $client->website = $request->website;
           $client->address_line_1 = $request->address_line_1;
           $client->address_line_2 = $request->address_line_2;
           $client->city = $request->city;
           $client->state_province = $request->state_province;
           $client->zip = $request->zip;
           $client->country = $request->country;
           $client->image = $image_name;
           $client->save();
           DB::commit();

        return back()->with('success', 'Client Added');
    }

    }
    public function delete_pm_client($id){
        OtherClientDetails::where("user_id",$id)->delete();
        User::where("id",$id)->delete();
        return back()->with('success', 'Client Successfully  Deleted');
    }
    public function edit_pm_client($id,Request $request)
    {
    if($request->isMethod('get')){
    $client_details = OtherClientDetails::where('user_id',$id)->get();
    $login_details = User::where('id',$id)->get();
    return view('edit-pm-client', ['client_details' => $client_details,'login_details' => $login_details]);
    }
    if($request->isMethod('post')){
        $this->validate($request, [
            'first_name'   => 'required',
            'last_name'   => 'required',
            'company'   => 'required',
            'phone'   => 'required',
            'website'   => 'required',
            'address_line_1'   => 'required',
            'address_line_2'   => 'required',
            'city'   => 'required',
            'state_province'   => 'required',
            'zip'   => 'required',
            'country'   => 'required',
        ]);
        if($request->image){
            $image_name = time().'client.'.$request->image->extension();
           $request->image->move(public_path('user_images'), $image_name);
           }
           else{
            $image_name = OtherClientDetails::where('user_id',$id)->value('image');;
        }

        if(!$request->password == null){

                if(User::where("id", "=", $id)->where("email", "=", $request->email)->exists()){
                    $email = $request->email;
                }
                elseif(User::where("email", "=", $request->email)->exists()){
                 return back()->with('fail', 'This email is already in use');
                }
                else{
                 $email = $request->email;
                }
                if(User::where("id", "=", $id)->where("user_name", "=", $request->user_name)->exists()){
                    $user_name = $request->user_name;
                    }
                   elseif(User::where("user_name", "=", $request->user_name)->exists()){
                   return back()->with('fail', 'This user name is already in use');
                   }
                   else{
                    $user_name = $request->user_name;
                   }
            $client =  OtherClientDetails::where('user_id', '=', $id)->first();;
            $client->first_name = $request->first_name;
            $client->last_name = $request->last_name;
            $client->company = $request->company;
            $client->phone = $request->phone;
            $client->website = $request->website;
            $client->address_line_1 = $request->address_line_1;
            $client->address_line_2 = $request->address_line_2;
            $client->city = $request->city;
            $client->state_province = $request->state_province;
            $client->zip = $request->zip;
            $client->country = $request->country;
            $client->image = $image_name;
            $client->update();

            $user = User::find($id);
            $user->email = $email;
            $user->password = Hash::make($request->input('password'));
            $user->user_name = $user_name;
            $user->update();
            return back()->with('success', 'Client Details Successfully  Updated');

        }
        else{

            if(User::where("id", "=", $id)->where("email", "=", $request->email)->exists()){
                $email = $request->email;
            }
            elseif(User::where("email", "=", $request->email)->exists()){
             return back()->with('fail', 'This email is already in use');
            }
            else{
             $email = $request->email;
            }
            if(User::where("id", "=", $id)->where("user_name", "=", $request->user_name)->exists()){
                $user_name = $request->user_name;
                }
               elseif(User::where("user_name", "=", $request->user_name)->exists()){
               return back()->with('fail', 'This user name is already in use');
               }
               else{
                $user_name = $request->user_name;
               }
        $client =  OtherClientDetails::where('user_id', '=', $id)->first();;
        $client->first_name = $request->first_name;
        $client->last_name = $request->last_name;
        $client->company = $request->company;
        $client->phone = $request->phone;
        $client->website = $request->website;
        $client->address_line_1 = $request->address_line_1;
        $client->address_line_2 = $request->address_line_2;
        $client->city = $request->city;
        $client->state_province = $request->state_province;
        $client->zip = $request->zip;
        $client->country = $request->country;
        $client->image = $image_name;
        $client->update();

        $user = User::find($id);
        $user->email = $email;
        $user->user_name = $user_name;
        $user->update();
        return back()->with('success', 'Client Details Successfully  Updated');

        }
    }

    }
    public function pm_projects(Request $request)
    {
    if($request->isMethod('get')){
    $employees = OtherEmployeeDetails::get();
    $clients = OtherClientDetails::get();
    $projects = PMProjects::get();
    return view('pm-projects', ['employees' => $employees,'projects' => $projects,'clients' => $clients]);
    }


    }
    public function add_project(Request $request)
    {
    if($request->isMethod('get')){
    $employees = OtherEmployeeDetails::get();
    $clients = OtherClientDetails::get();
    return view('add_project', ['employees' => $employees,'clients' => $clients]);
    }
    if($request->isMethod('post')){
        $this->validate($request, [
            'title'   => 'required',
            'client'   => 'required',
            'start_date'   => 'required',
            'end_date'   => 'required',
            'priority'  => 'required',
            'company'   => 'required',
            'summery'   => 'required',
            'discription'   => 'required',
            'progress'   => 'required',
        ]);

        $project =  new PMProjects();
        $project->title =$request->title;
        $project->client =$request->client;
        $project->start_date =$request->start_date;
        $project->end_date =$request->end_date;
        $project->priority =$request->priority;
        $project->company =$request->company;
        $project->summery =$request->summery;
        $project->discription =$request->discription;
        $project->progress =$request->progress;
        $project->save();

        if(!$request->employees == null){
            foreach($request->employees as $employee){
                $pm_employee = new PMProjectsEmployees();
                $pm_employee->project_id = $project->id;
                $pm_employee->employee_id = $employee;
                $pm_employee->save();

        }
        }

        return back()->with('success', 'Project Added');
    }

    }
    public function delete_pm_project($id){
        PMProjects::find($id)->delete();
        PMProjectsEmployees::where('project_id',$id)->delete();
        return back()->with('success', 'Project Successfully  Deleted');
    }
    public function edit_pm_project($id,Request $request)
    {
    if($request->isMethod('get')){
    $project_details = PMProjects::where('id',$id)->get();
    $project_employees = PMProjectsEmployees::where('project_id',$id)->get();
    $employees = OtherEmployeeDetails::get();
    $clients = OtherClientDetails::get();
    return view('edit-pm-project', ['project_details' => $project_details,'employees' => $employees,'clients' => $clients,
    'project_employees' => $project_employees]);
    }
    if($request->isMethod('post')){

        $project =  PMProjects::where('id', '=', $id)->first();;
        $project->title =$request->title;
        $project->client =$request->client;
        $project->start_date =$request->start_date;
        $project->end_date =$request->end_date;
        $project->priority =$request->priority;
        $project->company =$request->company;
        $project->summery =$request->summery;
        $project->discription =$request->discription;
        $project->progress =$request->progress;
        $project->update();

        PMProjectsEmployees::where('project_id',$id)->delete();
        if(!$request->employees == null){
            foreach($request->employees as $employee){
                $pm_employee = new PMProjectsEmployees();
                $pm_employee->project_id = $id;
                $pm_employee->employee_id = $employee;
                $pm_employee->save();

        }
        }
        return back()->with('success', 'Project  Details Successfully  Updated');
    }

    }
    public function pm_tasks(Request $request)
    {
    if($request->isMethod('get')){
    $employees = OtherEmployeeDetails::get();
    $projects = PMProjects::get();
    $tasks = PMTasks::get();
    return view('pm-tasks', ['projects' => $projects,'employees' => $employees,'tasks' => $tasks]);
    }
    }

    public function add_task(Request $request)
    {
    if($request->isMethod('get')){
    $employees = OtherEmployeeDetails::get();
    $projects = PMProjects::get();
    return view('add_task', ['projects' => $projects,'employees' => $employees]);
    }
    if($request->isMethod('post')){
        $this->validate($request, [
            'title'   => 'required',

            'start_date'   => 'required',
            'end_date'   => 'required',
            'project'  => 'required',
            'estimated_hours'   => 'required',
            'discription'   => 'required',
            'status'   => 'required',
            'progress'   => 'required',
        ]);

        $task =  new PMTasks();
        $task->title =$request->title;

        $task->start_date =$request->start_date;
        $task->end_date =$request->end_date;
        $task->project =$request->project;
        $task->estimated_hours =$request->estimated_hours;
        $task->discription =$request->discription;
        $task->status =$request->status;
        $task->progress =$request->progress;
        $task->save();

        if(!$request->project_users == null){
            foreach($request->project_users as $project_user){
                $pm_user = new PMTaskUsers();
                $pm_user->task_id = $task->id;
                $pm_user->user_id = $project_user;
                $pm_user->save();

        }
        }

        return back()->with('success', 'Project Added');
    }

    }
    public function delete_pm_task($id){
        PMTasks::find($id)->delete();
        PMTaskUsers::where('task_id',$id)->delete();
        return back()->with('success', 'Task Successfully  Deleted');
    }
    public function edit_pm_task($id,Request $request)
    {
    if($request->isMethod('get')){
    $task_details = PMTasks::where('id',$id)->get();
    $project_employees = PMTaskUsers::where('task_id',$id)->get();
    $employees = OtherEmployeeDetails::get();
    $projects = PMProjects::get();
    return view('edit-pm-task', ['task_details' => $task_details,'employees' => $employees,'projects' => $projects,
    'project_employees' => $project_employees]);
    }
    if($request->isMethod('post')){

        $task =  PMTasks::where('id', '=', $id)->first();;
        $task->title =$request->title;

        $task->start_date =$request->start_date;
        $task->end_date =$request->end_date;
        $task->project =$request->project;
        $task->estimated_hours =$request->estimated_hours;
        $task->discription =$request->discription;
        $task->status =$request->status;
        $task->progress =$request->progress;
        $task->update();

        PMTaskUsers::where('task_id',$id)->delete();
        if(!$request->project_users == null){
            foreach($request->project_users as $project_user){
                $pm_user = new PMTaskUsers();
                $pm_user->task_id = $id;
                $pm_user->user_id = $project_user;
                $pm_user->save();

        }
        }
        return back()->with('success', 'Task  Details Successfully  Updated');
    }

    }
    public function pm_tax_types(Request $request)
    {
    if($request->isMethod('get')){
    $tax_types = PMTaxTypes::get();
    return view('pm-tax-types', ['tax_types' => $tax_types]);
    }


    }
    public function add_tax_type(Request $request)
    {
    if($request->isMethod('get')){

    return view('add_tax_type');
    }
    if($request->isMethod('post')){
        $this->validate($request, [
            'tax_name'   => 'required',
            'tax_rate'   => 'required',
            'discription'   => 'required',
            'tax_type'   => 'required',
        ]);

        $tax_type =  new PMTaxTypes();
        $tax_type->tax_name =$request->tax_name;
        $tax_type->tax_rate =$request->tax_rate;
        $tax_type->discription =$request->discription;
        $tax_type->tax_type =$request->tax_type;
        $tax_type->save();
        return back()->with('success', 'Tax Type Added');
    }

    }
    public function delete_pm_tax_type($id){
        PMTaxTypes::find($id)->delete();
        return back()->with('success', 'Tax Type Successfully  Deleted');
    }
    public function edit_pm_tax_type($id,Request $request)
    {
    if($request->isMethod('get')){
    $tax_details = PMTaxTypes::where('id',$id)->get();
    return view('edit-pm-tax-type', ['tax_details' => $tax_details]);
    }
    if($request->isMethod('post')){

        $tax_type =  PMTaxTypes::where('id', '=', $id)->first();;
        $tax_type->tax_name =$request->tax_name;
        $tax_type->tax_rate =$request->tax_rate;
        $tax_type->discription =$request->discription;
        $tax_type->tax_type =$request->tax_type;
        $tax_type->update();
        return back()->with('success', 'Tax Type Details Successfully  Updated');
    }

    }
    public function pm_invoices(Request $request)
    {

    $invoices = PMInvoices::get();
    return view('pm-invoices', ['invoices' => $invoices]);

    }
    public function pm_add_invoice(Request $request)
    {
    if($request->isMethod('get')){
    $tax_types = PMTaxTypes::get();
    $projects = PMProjects::get();
    return view('pm-add-invoice', ['tax_types' => $tax_types,'projects' => $projects]);
    }
    if($request->isMethod('post')){
        $this->validate($request, [
            'invoice_number'   => 'required',
            'project'   => 'required',
            'inovoice_date'   => 'required',
            'due_date'   => 'required',
            'status'   => 'required',
        ]);
        $invoice = PMInvoices::create([
            "invoice_number" => $request->invoice_number,
            "project" => $request->project,
            "inovoice_date" =>  $request->inovoice_date,
            "due_date" => $request->due_date,
            "invoice_sub_total" => $request->sub_total_final,
            "discount_type" => $request->discount_type,
            "discount" => $request->discount,
            "discount_amount" => $request->discount_amount,
            "grand_total" => $request->grand_total,
            "invoice_note" => $request->invoice_note,
            "status" => $request->status,
          ]);

          $c = 0;
          foreach($request->item as $items){
              $item = new PMInvoiceItems();
              $item->invoice_id =$invoice->id;
              $item->item = $items;
              $item->qty = $request->qty[$c];
              $item->unit_price = $request->unit_price[$c];
              $item->tax_type = $request->tax_type[$c];
              $item->tax_rate = $request->tax_rate[$c];
              $item->sub_total = $request->sub_total[$c];
              $item->save();
              $c = $c+1;
          }
        return back()->with('success', 'Invoice Created');
    }

    }
    public function edit_pm_invoice($id,Request $request)
    {
    if($request->isMethod('get')){
    $invoice_details = PMInvoices::where('id',$id)->get();
    $invoice_items = PMInvoiceItems::where('invoice_id',$id)->get();
    $tax_types = PMTaxTypes::get();
    $projects = PMProjects::get();
    return view('edit-pm-invoice', ['invoice_details' => $invoice_details,'invoice_items' => $invoice_items,'tax_types' => $tax_types
    ,'projects' => $projects]);
    }
    if($request->isMethod('post')){

        $invoice =  PMInvoices::where('id', '=', $id)->first();;
        $invoice->invoice_number =$request->invoice_number;
        $invoice->project =$request->project;
        $invoice->inovoice_date =$request->inovoice_date;
        $invoice->due_date =$request->due_date;
        $invoice->invoice_sub_total =$request->sub_total_final;
        $invoice->discount_type =$request->discount_type;
        $invoice->discount =$request->discount;
        $invoice->discount_amount =$request->discount_amount;
        $invoice->grand_total =$request->grand_total;
        $invoice->invoice_note =$request->invoice_note;
        $invoice->status =$request->status;
        $invoice->update();

        PMInvoiceItems::where('invoice_id', $id)->delete();
        $c = 0;
          foreach($request->item as $items){
              $item = new PMInvoiceItems();
              $item->invoice_id =$id;
              $item->item = $items;
              $item->qty = $request->qty[$c];
              $item->unit_price = $request->unit_price[$c];
              $item->tax_type = $request->tax_type[$c];
              $item->tax_rate = $request->tax_rate[$c];
              $item->sub_total = $request->sub_total[$c];
              $item->save();
              $c = $c+1;
          }
        return back()->with('success', 'Invoice  Details Successfully  Updated');
    }

    }
    public function delete_pm_invoice($id){
        PMInvoices::find($id)->delete();
        PMInvoiceItems::where('invoice_id', $id)->delete();
        return back()->with('success', 'Invoice Successfully  Deleted');
    }
    public function organization_departments(Request $request)
    {
    if($request->isMethod('get')){
    $employees = OtherHODDetails::get();
    $locations = OrganizationLocations::get();
    $departments = OrganizationDepartments::get();
    return view('organization-departments', ['employees' => $employees,'departments' => $departments,'locations' => $locations]);
    }

    }
    public function add_organization_department(Request $request)
    {
    if($request->isMethod('get')){
    $employees = OtherHODDetails::get();
    $locations = OrganizationLocations::get();
    $departments = OrganizationDepartments::get();
    return view('add_organization_department', ['employees' => $employees,'departments' => $departments,'locations' => $locations]);
    }
    if($request->isMethod('post')){
        $this->validate($request, [
            'department'   => 'required',
            // 'employee'   => 'required',
            // 'location'   => 'required',
        ]);

        $department =  new OrganizationDepartments();
        $department->department =$request->department;
        $department->employee =$request->employee;
        $department->location =$request->location;
        $department->save();
        return back()->with('success', 'Department Added');
    }

    }
    public function delete_organization_departments($id){
        OrganizationDepartments::find($id)->delete();
        return back()->with('success', 'Department Successfully  Deleted');
    }
    public function edit_organization_departments($id,Request $request)
    {
    if($request->isMethod('get')){
    $department_details = OrganizationDepartments::where('id',$id)->get();
    $employees = OtherHODDetails::get();
    $locations = OrganizationLocations::get();
    return view('edit-organization-departments', ['department_details' => $department_details,'employees' => $employees,'locations' => $locations]);
    }
    if($request->isMethod('post')){

        $department =  OrganizationDepartments::where('id', '=', $id)->first();;
        $department->department =$request->department;
        $department->employee =$request->employee;
        $department->location =$request->location;
        $department->update();
        return back()->with('success', 'Department  Details Successfully  Updated');
    }

    }
    public function organization_locations(Request $request)
    {
    if($request->isMethod('get')){
    $employees = OtherEmployeeDetails::get();
    $locations = OrganizationLocations::get();
    return view('organization-locations', ['employees' => $employees,'locations' => $locations]);
    }

    }
    public function add_organization_location(Request $request)
    {
    if($request->isMethod('get')){
    $employees = OtherEmployeeDetails::get();
    return view('add_organization_location', ['employees' => $employees]);
    }
    if($request->isMethod('post')){
        $this->validate($request, [
            'location'   => 'required',
            'employee'   => 'required',
            'address_line_1'   => 'required',
            'address_line_2'   => 'required',
            'city'   => 'required',
            'state'   => 'required',
            'country'   => 'required',
            'zip'   => 'required',
        ]);

        $locations =  new OrganizationLocations();
        $locations->location =$request->location;
        $locations->employee =$request->employee;
        $locations->address_line_1 =$request->address_line_1;
        $locations->address_line_2 =$request->address_line_2;
        $locations->city =$request->city;
        $locations->state =$request->state;
        $locations->country =$request->country;
        $locations->zip =$request->zip;
        $locations->save();
        return back()->with('success', 'Location Added');
    }

    }
    public function delete_organization_locations($id){
        OrganizationLocations::find($id)->delete();
        return back()->with('success', 'Location Successfully  Deleted');
    }
    public function edit_organization_locations($id,Request $request)
    {
    if($request->isMethod('get')){
    $location_details = OrganizationLocations::where('id',$id)->get();
    $employees = OtherEmployeeDetails::get();
    return view('edit-organization-locations', ['location_details' => $location_details,'employees' => $employees]);
    }
    if($request->isMethod('post')){

        $locations =  OrganizationLocations::where('id', '=', $id)->first();;
        $locations->location =$request->location;
        $locations->employee =$request->employee;
        $locations->address_line_1 =$request->address_line_1;
        $locations->address_line_2 =$request->address_line_2;
        $locations->city =$request->city;
        $locations->state =$request->state;
        $locations->country =$request->country;
        $locations->zip =$request->zip;
        $locations->update();
        return back()->with('success', 'Locations  Details Successfully  Updated');
    }

    }
    public function organization_designations(Request $request)
    {
    if($request->isMethod('get')){
    $designations = OrganizationDesignations::get();
    $departments = OrganizationDepartments::get();
    return view('organization-designations', ['designations' => $designations,'departments' => $departments]);
    }


    }
    public function add_organization_designation(Request $request)
    {
    if($request->isMethod('get')){
    $departments = OrganizationDepartments::get();
    return view('add_organization_designation', ['departments' => $departments]);
    }
    if($request->isMethod('post')){
        $this->validate($request, [
            'designation'   => 'required',
            'department'   => 'required',
        ]);

        $designations =  new OrganizationDesignations();
        $designations->designation =$request->designation;
        $designations->department =$request->department;
        $designations->save();
        return back()->with('success', 'Designation Added');
    }

    }
    public function delete_organization_designations($id){
        OrganizationDesignations::find($id)->delete();
        return back()->with('success', 'Designation Successfully  Deleted');
    }
    public function edit_organization_designations($id,Request $request)
    {
        if($request->isMethod('get')){
            $designation_details = OrganizationDesignations::where('id', $id)->get();
            $departments = OrganizationDepartments::get();
            return view('edit_organization_designations', ['designation_details' => $designation_details,'departments' => $departments]);
            }
    if($request->isMethod('post')){

        $designations =  OrganizationDesignations::where('id', '=', $id)->first();;
        $designations->designation =$request->designation;
        $designations->department =$request->department;
        $designations->update();
        return back()->with('success', 'Designations  Details Successfully  Updated');
    }

    }
    public function organization_announcements(Request $request)
    {
    if($request->isMethod('get')){
    $announcements = OrganizationAnnouncements::get();
    $departments = OrganizationDepartments::get();
    return view('organization-announcements', ['announcements' => $announcements,'departments' => $departments]);
    }


    }
    public function add_announcement(Request $request)
    {
    if($request->isMethod('get')){
    $departments = OrganizationDepartments::get();
    return view('add_announcement', ['departments' => $departments]);
    }
    if($request->isMethod('post')){
        $this->validate($request, [
            'title'   => 'required',
            'summery'   => 'required',
            'start_date'   => 'required',
            'end_date'   => 'required',
            'department'   => 'required',
            'discription'   => 'required',

        ]);
        if($request->notify){
            $notify = 'on';
        }
        else{
            $notify = 'off';
        }
        $announcement =  new OrganizationAnnouncements();
        $announcement->title =$request->title;
        $announcement->summery =$request->summery;
        $announcement->start_date =$request->start_date;
        $announcement->end_date =$request->end_date;
        $announcement->department =$request->department;
        $announcement->discription =$request->discription;
        $announcement->notify =$notify;
        $announcement->save();
        return back()->with('success', 'Announcement Added');
    }

    }
    public function delete_organization_announcements($id){
        OrganizationAnnouncements::find($id)->delete();
        return back()->with('success', 'Announcement Successfully  Deleted');
    }
    public function edit_organization_announcements($id,Request $request)
    {

        if($request->isMethod('get')){
            $announcement_details = OrganizationAnnouncements::where('id',$id)->get();
            $departments = OrganizationDepartments::get();
            return view('edit-organization-announcements', ['announcement_details' => $announcement_details,'departments' => $departments]);
            }
        if($request->isMethod('post')){
            if($request->notify){
                $notify = 'on';
            }
            else{
                $notify = 'off';
            }
            $announcement =  OrganizationAnnouncements::where('id', '=', $id)->first();;
            $announcement->title =$request->title;
            $announcement->summery =$request->summery;
            $announcement->start_date =$request->start_date;
            $announcement->end_date =$request->end_date;
            $announcement->department =$request->department;
            $announcement->discription =$request->discription;
            $announcement->notify =$notify;
            $announcement->update();
            return back()->with('success', 'Announcement  Details Successfully  Updated');
            }


    }
    public function organization_company_policy(Request $request)
    {
    if($request->isMethod('get')){
    $policys = OrganizationPolicy::get();
    return view('organization-company-policy', ['policys' => $policys]);
    }


    }
    public function add_policy(Request $request)
    {
    if($request->isMethod('get')){
    $policys = OrganizationPolicy::get();
    return view('add_policy');
    }
    if($request->isMethod('post')){
        $this->validate($request, [
            'title'   => 'required',
            'description'   => 'required',
        ]);

        $policy =  new OrganizationPolicy();
        $policy->title =$request->title;
        $policy->description =$request->description;
        $policy->save();
        return back()->with('success', 'Policy Added');
    }

    }
    public function delete_organization_company_policy($id){
        OrganizationPolicy::find($id)->delete();
        return back()->with('success', 'Policy Successfully  Deleted');
    }
    public function edit_organization_company_policy($id,Request $request)
    {

    if($request->isMethod('post')){

        $policy =  OrganizationPolicy::where('id', '=', $id)->first();;
        $policy->title =$request->title;
        $policy->description =$request->description;
        $policy->update();
        return back()->with('success', 'Policy  Details Successfully  Updated');
    }

    }
    public function events(Request $request)
    {
    if($request->isMethod('get')){
    $events = Events::get();
    $departments = OrganizationDepartments::get();
    return view('events', ['events' => $events,'departments' => $departments]);
    }

    }
    public function add_event(Request $request)
    {
    if($request->isMethod('get')){
    $departments = OrganizationDepartments::get();
    return view('add_event', ['departments' => $departments]);
    }
    if($request->isMethod('post')){
        $this->validate($request, [
            'event_title'   => 'required',
            'event_date'   => 'required',
            'event_time'   => 'required',
            'departments'   => 'required',
            'status'   => 'required',
            'event_note'   => 'required',

        ]);
        if($request->notification){
            $notification = 'on';
        }
        else{
            $notification = 'off';
        }

        $event =  new Events();
        $event->event_title =$request->event_title;
        $event->event_date =$request->event_date;
        $event->event_time =$request->event_time;
        $event->status =$request->status;
        $event->event_note =$request->event_note;
        $event->notification =$notification;
        $event->save();

        if(!$request->departments == null){
            foreach($request->departments as $department){
                $event_dep = new EventsDepartments();
                $event_dep->event_id = $event->id;
                $event_dep->department_id = $department;
                $event_dep->save();
        }
        }
        return back()->with('success', 'Event Added');
    }

    }
    public function delete_events($id){
        Events::find($id)->delete();
        return back()->with('success', 'Event Successfully  Deleted');
    }
    public function edit_events($id,Request $request)
    {

        if($request->isMethod('get')){
            $event_details = Events::where('id',$id)->get();
            $departments = OrganizationDepartments::get();
            return view('edit-events', ['event_details' => $event_details,'departments' => $departments]);
            }
        if($request->isMethod('post')){
            if($request->notification){
                $notification = 'on';
            }
            else{
                $notification = 'off';
            }
            $event =  Events::where('id', '=', $id)->first();;
            $event->event_title =$request->event_title;
            $event->event_date =$request->event_date;
            $event->event_time =$request->event_time;
            $event->status =$request->status;
            $event->event_note =$request->event_note;
            $event->notification =$notification;
            $event->update();

            EventsDepartments::where('event_id',$id)->delete();
            if(!$request->departments == null){
                foreach($request->departments as $department){
                    $event_dep = new EventsDepartments();
                    $event_dep->event_id = $id;
                    $event_dep->department_id = $department;
                    $event_dep->save();
            }
            }
            return back()->with('success', 'Event  Details Successfully  Updated');
            }


    }
    public function meetings(Request $request)
    {
    if($request->isMethod('get')){
    $meetings = Meetings::get();
    $employees = OtherEmployeeDetails::get();
    return view('meetings', ['meetings' => $meetings,'employees' => $employees]);
    }


    }
    public function add_meeting(Request $request)
    {
    if($request->isMethod('get')){
    $employees = OtherEmployeeDetails::get();
    return view('add_meeting', ['employees' => $employees]);
    }
    if($request->isMethod('post')){
        $this->validate($request, [
            'meeting_title'   => 'required',
            'meeting_date'   => 'required',
            'meeting_time'   => 'required',
            'employee'   => 'required',
            'status'   => 'required',
            'meeting_note'   => 'required',

        ]);
        if($request->notification){
            $notification = 'on';
        }
        else{
            $notification = 'off';
        }
        $meeting =  new Meetings();
        $meeting->meeting_title =$request->meeting_title;
        $meeting->meeting_date =$request->meeting_date;
        $meeting->meeting_time =$request->meeting_time;
        $meeting->employee =$request->employee;
        $meeting->status =$request->status;
        $meeting->meeting_note =$request->meeting_note;
        $meeting->notification =$notification;
        $meeting->save();
        return back()->with('success', 'Meeting Added');
    }

    }
    public function delete_meetings($id){
        Meetings::find($id)->delete();
        return back()->with('success', 'Meeting Successfully  Deleted');
    }
    public function edit_meetings($id,Request $request)
    {

        if($request->isMethod('get')){
            $meeting_details = Meetings::where('id',$id)->get();
            $employees = OtherEmployeeDetails::get();
            return view('edit-meetings', ['meeting_details' => $meeting_details,'employees' => $employees]);
            }
        if($request->isMethod('post')){
            if($request->notification){
                $notification = 'on';
            }
            else{
                $notification = 'off';
            }
            $meeting =  Meetings::where('id', '=', $id)->first();;
            $meeting->meeting_title =$request->meeting_title;
            $meeting->meeting_date =$request->meeting_date;
            $meeting->meeting_time =$request->meeting_time;
            $meeting->employee =$request->employee;
            $meeting->status =$request->status;
            $meeting->meeting_note =$request->meeting_note;
            $meeting->notification =$notification;
            $meeting->update();
            return back()->with('success', 'Meeting  Details Successfully  Updated');
            }
    }
    public function performance_goal_type(Request $request)
    {
    if($request->isMethod('get')){
    $goal_types = PerformanceGoalType::get();
    return view('performance-goal-type', ['goal_types' => $goal_types]);
    }


    }
    public function add_goal_type(Request $request)
    {
    if($request->isMethod('get')){
    return view('add_goal_type');
    }
    if($request->isMethod('post')){
        $this->validate($request, [
            'goal_type'   => 'required',
        ]);

        $goal_type =  new PerformanceGoalType();
        $goal_type->goal_type =$request->goal_type;
        $goal_type->save();
        return back()->with('success', 'Goal Type Added');
    }

    }
    public function delete_performance_goal_type($id){
        PerformanceGoalType::find($id)->delete();
        return back()->with('success', 'Goal Type Successfully  Deleted');
    }
    public function edit_performance_goal_type($id,Request $request)
    {

    if($request->isMethod('post')){

        $goal_type =  PerformanceGoalType::where('id', '=', $id)->first();;
        $goal_type->goal_type =$request->goal_type;
        $goal_type->update();
        return back()->with('success', 'Goal Type Successfully  Updated');
    }

    }
    public function performance_goal_tracking(Request $request)
    {
    if($request->isMethod('get')){
    $goal_tracks = PerformanceGoalTracking::get();
    $goal_types = PerformanceGoalType::get();
    return view('performance-goal-tracking', ['goal_tracks' => $goal_tracks,'goal_types' => $goal_types]);
    }

    }
    public function add_goal(Request $request)
    {
    if($request->isMethod('get')){
    $goal_types = PerformanceGoalType::get();
    return view('add_goal', ['goal_types' => $goal_types]);
    }
    if($request->isMethod('post')){
        $this->validate($request, [
            'goal_type'   => 'required',
            'subject'   => 'required',
            'target_achievement'   => 'required',
            'start_date'   => 'required',
            'end_date'   => 'required',
            'discription'   => 'required',
            'progress'   => 'required',

        ]);

        $goal_track =  new PerformanceGoalTracking();
        $goal_track->goal_type =$request->goal_type;
        $goal_track->subject =$request->subject;
        $goal_track->target_achievement =$request->target_achievement;
        $goal_track->start_date =$request->start_date;
        $goal_track->end_date =$request->end_date;
        $goal_track->discription =$request->discription;
        $goal_track->progress =$request->progress;
        $goal_track->save();
        return back()->with('success', 'Goal Tracking Added');
    }

    }
    public function delete_performance_goal_tracking($id){
        PerformanceGoalTracking::find($id)->delete();
        return back()->with('success', 'Goal Tracking Successfully  Deleted');
    }
    public function edit_performance_goal_tracking($id,Request $request)
    {

        if($request->isMethod('get')){
            $tracking_details = PerformanceGoalTracking::where('id',$id)->get();
            $goal_types = PerformanceGoalType::get();
            return view('edit-performance-goal-tracking', ['tracking_details' => $tracking_details,'goal_types' => $goal_types]);
            }
        if($request->isMethod('post')){

            $goal_track =  PerformanceGoalTracking::where('id', '=', $id)->first();;
            $goal_track->goal_type =$request->goal_type;
            $goal_track->subject =$request->subject;
            $goal_track->target_achievement =$request->target_achievement;
            $goal_track->start_date =$request->start_date;
            $goal_track->end_date =$request->end_date;
            $goal_track->discription =$request->discription;
            $goal_track->progress =$request->progress;
            $goal_track->update();
            return back()->with('success', 'Goal Tracking  Details Successfully  Updated');
            }


    }
    public function performance_indicator(Request $request)
    {
    if($request->isMethod('get')){
    $indicators = PerformanceIndicator::get();
    $designations = OrganizationDesignations::get();
    return view('performance-indicator', ['indicators' => $indicators,'designations' => $designations]);
    }


    }
    public function add_indicator(Request $request)
    {
    if($request->isMethod('get')){
    $designations = OrganizationDesignations::get();
    return view('add_indicator', ['designations' => $designations]);
    }
    if($request->isMethod('post')){
        $this->validate($request, [
            'desigantion'   => 'required',
            'customer_experience'   => 'required',
            'marketing'   => 'required',
            'administration'   => 'required',
            'professionalism'   => 'required',
            'integrity'   => 'required',
            'attendance'   => 'required',
        ]);

        $indicator =  new PerformanceIndicator();
        $indicator->desigantion =$request->desigantion;
        $indicator->customer_experience =$request->customer_experience;
        $indicator->marketing =$request->marketing;
        $indicator->administration =$request->administration;
        $indicator->professionalism =$request->professionalism;
        $indicator->integrity =$request->integrity;
        $indicator->attendance =$request->attendance;
        $indicator->save();
        return back()->with('success', 'Indicator Added');
    }

    }
    public function delete_performance_indicator($id){
        PerformanceIndicator::find($id)->delete();
        return back()->with('success', 'Indicator Successfully  Deleted');
    }
    public function edit_performance_indicator($id,Request $request)
    {

        if($request->isMethod('get')){
            $indicator_details = PerformanceIndicator::where('id',$id)->get();
            $designations = OrganizationDesignations::get();
            return view('edit-performance-indicator', ['indicator_details' => $indicator_details,'designations' => $designations]);
            }
        if($request->isMethod('post')){

            $indicator =  PerformanceIndicator::where('id', '=', $id)->first();;
            $indicator->desigantion =$request->desigantion;
            $indicator->customer_experience =$request->customer_experience;
            $indicator->marketing =$request->marketing;
            $indicator->administration =$request->administration;
            $indicator->professionalism =$request->professionalism;
            $indicator->integrity =$request->integrity;
            $indicator->attendance =$request->attendance;
            $indicator->update();
            return back()->with('success', 'Indicator Details Successfully  Updated');
            }


    }
    public function performance_appraisal(Request $request)
    {
    if($request->isMethod('get')){
    $appraisals = PerformanceAppraisal::get();
    $employees = OtherEmployeeDetails::get();
    $designations = OrganizationDesignations::get();
    return view('performance-appraisal', ['appraisals' => $appraisals,'employees' => $employees,'designations' => $designations]);
    }


    }
    public function add_appraisal(Request $request)
    {
    if($request->isMethod('get')){
    $employees = OtherEmployeeDetails::get();
    $designations = OrganizationDesignations::get();
    return view('add_appraisal', ['employees' => $employees,'designations' => $designations]);
    }
    if($request->isMethod('post')){
        $this->validate($request, [
            'employee'   => 'required',
            'desigantion'   => 'required',
            'appraisal_date'   => 'required',
            'customer_experience'   => 'required',
            'marketing'   => 'required',
            'administration'   => 'required',
            'professionalism'   => 'required',
            'integrity'   => 'required',
            'attendance'   => 'required',
            'remarks'   => 'required',
        ]);

        $appraisal =  new PerformanceAppraisal();
        $appraisal->employee =$request->employee;
        $appraisal->desigantion =$request->desigantion;
        $appraisal->appraisal_date =$request->appraisal_date;
        $appraisal->customer_experience =$request->customer_experience;
        $appraisal->marketing =$request->marketing;
        $appraisal->administration =$request->administration;
        $appraisal->professionalism =$request->professionalism;
        $appraisal->integrity =$request->integrity;
        $appraisal->attendance =$request->attendance;
        $appraisal->remarks =$request->remarks;
        $appraisal->save();
        return back()->with('success', 'Appraisal Added');
    }

    }
    public function delete_performance_appraisal($id){
        PerformanceAppraisal::find($id)->delete();
        return back()->with('success', 'Appraisal Successfully  Deleted');
    }
    public function edit_performance_appraisal($id,Request $request)
    {

        if($request->isMethod('get')){
            $appraisal_details = PerformanceAppraisal::where('id',$id)->get();
            $employees = OtherEmployeeDetails::get();
            $designations = OrganizationDesignations::get();
            return view('edit-performance-appraisal', ['appraisal_details' => $appraisal_details,'employees' => $employees,'designations' => $designations]);
            }
        if($request->isMethod('post')){

            $appraisal =  PerformanceAppraisal::where('id', '=', $id)->first();;
            $appraisal->employee =$request->employee;
            $appraisal->desigantion =$request->desigantion;
            $appraisal->appraisal_date =$request->appraisal_date;
            $appraisal->customer_experience =$request->customer_experience;
            $appraisal->marketing =$request->marketing;
            $appraisal->administration =$request->administration;
            $appraisal->professionalism =$request->professionalism;
            $appraisal->integrity =$request->integrity;
            $appraisal->attendance =$request->attendance;
            $appraisal->remarks =$request->remarks;
            $appraisal->update();
            return back()->with('success', 'Appraisal Details Successfully  Updated');
            }


    }
    public function training_trainers(Request $request)
    {
    if($request->isMethod('get')){
    $trainers = TrainingTrainers::get();
    return view('training-trainers', ['trainers' => $trainers]);
    }
    if($request->isMethod('post')){
        $this->validate($request, [
            'first_name'   => 'required',
            'last_name'   => 'required',
            'email'   => 'required',
            'phone'   => 'required',
            'expertise'   => 'required',
            'address'   => 'required',
        ]);

        $trainer =  new TrainingTrainers();
        $trainer->first_name =$request->first_name;
        $trainer->last_name =$request->last_name;
        $trainer->email =$request->email;
        $trainer->phone =$request->phone;
        $trainer->expertise =$request->expertise;
        $trainer->address =$request->address;
        $trainer->save();
        return back()->with('success', 'Trainer Added');
    }

    }
    public function delete_training_trainers($id){
        TrainingTrainers::find($id)->delete();
        return back()->with('success', 'Trainer Successfully  Deleted');
    }
    public function edit_training_trainers($id,Request $request)
    {

        if($request->isMethod('get')){
            $trainer_details = TrainingTrainers::where('id',$id)->get();
            return view('edit-training-trainers', ['trainer_details' => $trainer_details]);
            }
        if($request->isMethod('post')){

            $trainer =  TrainingTrainers::where('id', '=', $id)->first();;
            $trainer->first_name =$request->first_name;
            $trainer->last_name =$request->last_name;
            $trainer->email =$request->email;
            $trainer->phone =$request->phone;
            $trainer->expertise =$request->expertise;
            $trainer->address =$request->address;
            $trainer->update();
            return back()->with('success', 'Trainer  Details Successfully  Updated');
            }


    }
    public function training_type(Request $request)
    {
    if($request->isMethod('get')){
    $training_types = TrainingType::get();
    return view('training-type', ['training_types' => $training_types]);
    }

    }
    public function add_training_type(Request $request)
    {
    if($request->isMethod('get')){
    return view('add_training_type');
    }
    if($request->isMethod('post')){
        $this->validate($request, [
            'training_type'   => 'required',
        ]);

        $training_type =  new TrainingType();
        $training_type->training_type =$request->training_type;
        $training_type->save();
        return back()->with('success', 'Training Type Added');
    }

    }
    public function delete__training_type($id){
        TrainingType::find($id)->delete();
        return back()->with('success', 'Training Type Successfully  Deleted');
    }
    public function edit_training_type($id,Request $request)
    {

    if($request->isMethod('post')){

        $training_type =  TrainingType::where('id', '=', $id)->first();;
        $training_type->training_type =$request->training_type;
        $training_type->update();
        return back()->with('success', 'Training Type Successfully  Updated');
    }

    }
    public function training_list(Request $request)
    {
    if($request->isMethod('get')){
    $trainers = TrainingTrainers::get();
    $training_types = TrainingType::get();
    $employees = OtherEmployeeDetails::get();
    $lists = TrainingList::get();
    return view('training-list', ['trainers' => $trainers,'training_types' => $training_types,'employees' => $employees
    ,'lists' => $lists]);
    }

    }
    public function add_training_list(Request $request)
    {
    if($request->isMethod('get')){
    $trainers = TrainingTrainers::get();
    $training_types = TrainingType::get();
    $employees = OtherEmployeeDetails::get();
    return view('add_training_list', ['trainers' => $trainers,'training_types' => $training_types,'employees' => $employees]);
    }
    if($request->isMethod('post')){
        $this->validate($request, [
            'training_type'   => 'required',
            'trainer'   => 'required',
            'start_date'   => 'required',
            'end_date'   => 'required',
            'training_cost'   => 'required',
            'discription'   => 'required',
        ]);

        $list =  new TrainingList();
        $list->training_type =$request->training_type;
        $list->trainer =$request->trainer;
        $list->start_date =$request->start_date;
        $list->end_date =$request->end_date;
        $list->training_cost =$request->training_cost;
        $list->discription =$request->discription;
        $list->save();

        if(!$request->employees == null){
            foreach($request->employees as $employee){
                $lsit_employee = new TrainingListEmployees();
                $lsit_employee->list_id = $list->id;
                $lsit_employee->employee_id = $employee;
                $lsit_employee->save();

        }
        }
        return back()->with('success', 'Training List Added');
    }

    }
    public function delete_training_list($id){
        TrainingList::find($id)->delete();
        TrainingListEmployees::where('list_id',$id)->delete();
        return back()->with('success', 'Training List  Deleted');
    }
    public function edit_training_list($id,Request $request)
    {

        if($request->isMethod('get')){
            $list_details = TrainingList::where('id',$id)->get();
            $list_employees = TrainingListEmployees::where('list_id',$id)->get();
            $trainers = TrainingTrainers::get();
            $training_types = TrainingType::get();
            $employees = OtherEmployeeDetails::get();
            return view('edit-training-list', ['list_details' => $list_details,'list_employees' => $list_employees,'trainers' => $trainers
        ,'training_types' => $training_types,'employees' => $employees]);
            }
        if($request->isMethod('post')){

            $list =  TrainingList::where('id', '=', $id)->first();;
            $list->training_type =$request->training_type;
            $list->trainer =$request->trainer;
            $list->start_date =$request->start_date;
            $list->end_date =$request->end_date;
            $list->training_cost =$request->training_cost;
            $list->discription =$request->discription;
            $list->update();

            TrainingListEmployees::where('list_id',$id)->delete();

            if(!$request->employees == null){
                foreach($request->employees as $employee){
                    $lsit_employee = new TrainingListEmployees();
                    $lsit_employee->list_id = $list->id;
                    $lsit_employee->employee_id = $employee;
                    $lsit_employee->save();

            }
            }
            return back()->with('success', 'Training List  Details Successfully  Updated');
            }


    }
    public function finance_account_list(Request $request)
    {
    if($request->isMethod('get')){
    $accounts = FinanceAccountList::get();
    return view('finance-account-list', ['accounts' => $accounts]);
    }


    }
    public function add_account(Request $request)
    {
    if($request->isMethod('get')){

    return view('add_account');

    }
    if($request->isMethod('post')){
        $this->validate($request, [
            'account_name'   => 'required',
            'initial_balance'   => 'required',
            'account_number'   => 'required',
            'branch_code'   => 'required',
            'branch_name'   => 'required',
            'swift_code'   => 'required',
        ]);

        $account =  new FinanceAccountList();
        $account->account_name =$request->account_name;
        $account->initial_balance =$request->initial_balance;
        $account->account_number =$request->account_number;
        $account->branch_code =$request->branch_code;
        $account->branch_name =$request->branch_name;
        $account->swift_code =$request->swift_code;
        $account->save();

        return back()->with('success', 'Account Added');
    }

    }
    public function delete_finance_account_list($id){
        FinanceAccountList::find($id)->delete();
        return back()->with('success', 'Account  Deleted');
    }
    public function edit_finance_account_list($id,Request $request)
    {

        if($request->isMethod('get')){
            $account_details = FinanceAccountList::where('id',$id)->get();
            return view('edit-finance-account-list', ['account_details' => $account_details]);
            }
        if($request->isMethod('post')){

            $account =  FinanceAccountList::where('id', '=', $id)->first();;
            $account->account_name =$request->account_name;
            $account->initial_balance =$request->initial_balance;
            $account->account_number =$request->account_number;
            $account->branch_code =$request->branch_code;
            $account->branch_name =$request->branch_name;
            $account->swift_code =$request->swift_code;
            $account->update();


            return back()->with('success', 'Account  Details Successfully  Updated');
            }


    }
    public function finance_account_balances(Request $request)
    {
    $accounts = FinanceAccountList::get();
    return view('finance-account-balances', ['accounts' => $accounts]);
    }
    public function finance_payer(Request $request)
    {
    if($request->isMethod('get')){
    $payers = FinancePayer::get();
    return view('finance-payer', ['payers' => $payers]);
    }
    }
    public function add_payer(Request $request)
    {
    if($request->isMethod('get')){
    return view('add_payer');
    }
    if($request->isMethod('post')){
        $this->validate($request, [
            'name'   => 'required',
            'nic'   => 'required',
            'email'   => 'required',
            'telephone'   => 'required',
            'address'   => 'required',
        ]);

        $payer =  new FinancePayer();
        $payer->name =$request->name;
        $payer->nic =$request->nic;
        $payer->email =$request->email;
        $payer->telephone =$request->telephone;
        $payer->address =$request->address;
        $payer->company_name =$request->company_name;
        $payer->discription =$request->discription;
        $payer->save();

        return back()->with('success', 'Payer Added');
    }

    }
    public function delete_finance_payer($id){
        FinancePayer::find($id)->delete();
        return back()->with('success', 'Payer  Deleted');
    }
    public function edit_finance_payer($id,Request $request)
    {

        if($request->isMethod('get')){
            $payer_details = FinancePayer::where('id',$id)->get();
            return view('edit-finance-payer', ['payer_details' => $payer_details]);
            }
        if($request->isMethod('post')){

            $payer =  FinancePayer::where('id', '=', $id)->first();;
            $payer->name =$request->name;
            $payer->nic =$request->nic;
            $payer->email =$request->email;
            $payer->telephone =$request->telephone;
            $payer->address =$request->address;
            $payer->company_name =$request->company_name;
            $payer->discription =$request->discription;
            $payer->update();


            return back()->with('success', 'Payer  Details Successfully  Updated');
            }
    }
    public function finance_payee(Request $request)
    {
    if($request->isMethod('get')){
    $payees = FinancePayee::get();
    return view('finance-payee', ['payees' => $payees]);
    }


    }
    public function add_payee(Request $request)
    {
    if($request->isMethod('get')){
    return view('add_payee');
    }
    if($request->isMethod('post')){
        $this->validate($request, [
            'name'   => 'required',
            'nic'   => 'required',
            'email'   => 'required',
            'telephone'   => 'required',
            'address'   => 'required',
            'discription'   => 'required',
            'bank_name'   => 'required',
            'branch'   => 'required',
            'account_no'   => 'required',
        ]);

        $payee =  new FinancePayee();
        $payee->name =$request->name;
        $payee->nic =$request->nic;
        $payee->email =$request->email;
        $payee->telephone =$request->telephone;
        $payee->address =$request->address;
        $payee->discription =$request->discription;
        $payee->bank_name =$request->bank_name;
        $payee->branch =$request->branch;
        $payee->account_no =$request->account_no;
        $payee->company_name =$request->company_name;
        $payee->save();

        return back()->with('success', 'Payee Added');
    }

    }
    public function delete_finance_payee($id){
        FinancePayee::find($id)->delete();
        return back()->with('success', 'Payee  Deleted');
    }
    public function edit_finance_payee($id,Request $request)
    {

        if($request->isMethod('get')){
            $payee_details = FinancePayee::where('id',$id)->get();
            return view('edit-finance-payee', ['payee_details' => $payee_details]);
            }
        if($request->isMethod('post')){

            $payee =  FinancePayee::where('id', '=', $id)->first();;
            $payee->name =$request->name;
            $payee->nic =$request->nic;
            $payee->email =$request->email;
            $payee->telephone =$request->telephone;
            $payee->address =$request->address;
            $payee->discription =$request->discription;
            $payee->bank_name =$request->bank_name;
            $payee->branch =$request->branch;
            $payee->account_no =$request->account_no;
            $payee->company_name =$request->company_name;
            $payee->update();


            return back()->with('success', 'Payee  Details Successfully  Updated');
            }
    }
    public function finance_deposit(Request $request)
    {
    if($request->isMethod('get')){
    $deposits = FinanceDeposit::get();
    $accounts = FinanceAccountList::get();
    $payers = FinancePayer::get();
    return view('finance-deposit', ['deposits' => $deposits,'accounts' => $accounts,'payers' => $payers]);
    }

    }
    public function add_deposit(Request $request)
    {
    if($request->isMethod('get')){
    $accounts = FinanceAccountList::get();
    $payers = FinancePayer::get();
    return view('add_deposit', ['accounts' => $accounts,'payers' => $payers]);
    }
    if($request->isMethod('post')){
        $this->validate($request, [
            'account'   => 'required',
            'category'   => 'required',
            'amount'   => 'required',
            'date'   => 'required',
            'payer'   => 'required',
            'reference_no'   => 'required',
            'discription'   => 'required',
            'attachment'   => 'required',
            'payment_mode'   => 'required',
        ]);

        $attachment_name = time().'deposit.'.$request->attachment->extension();
        $request->attachment->move(public_path('financial_attchments'), $attachment_name);

        $deposit =  new FinanceDeposit();
        $deposit->account =$request->account;
        $deposit->category =$request->category;
        $deposit->amount =$request->amount;
        $deposit->date =$request->date;
        $deposit->payer =$request->payer;
        $deposit->reference_no =$request->reference_no;
        $deposit->discription =$request->discription;
        $deposit->attachment =$attachment_name;
        $deposit->payment_mode =$request->payment_mode;
        $deposit->save();

        $account_current_balance = FinanceAccountList::where('id', '=', $request->account)->value('initial_balance');
        $account =  FinanceAccountList::where('id', '=', $request->account)->first();
        $account->initial_balance =$account_current_balance + $request->amount;
        $account->update();

        return back()->with('success', 'Deposit Added');
    }

    }
    public function delete_finance_deposit($id){
        FinanceDeposit::find($id)->delete();
        return back()->with('success', 'Deposit  Deleted');
    }
    public function edit_finance_deposit($id,Request $request)
    {

        if($request->isMethod('get')){
            $deposit_details = FinanceDeposit::where('id',$id)->get();
            $accounts = FinanceAccountList::get();
            $payers = FinancePayer::get();
            return view('edit-finance-deposit', ['deposit_details' => $deposit_details,'accounts' => $accounts,'payers' => $payers]);
            }
        if($request->isMethod('post')){

            if($request->attachment){
                $attachment_name = time().'deposit.'.$request->attachment->extension();
                $request->attachment->move(public_path('financial_attchments'), $attachment_name);
               }
               else{
                $attachment_name = FinanceDeposit::where('id',$id)->value('attachment');;
            }

            $deposit_current_ammount = FinanceDeposit::where('id', '=', $id)->value('amount');
            if($deposit_current_ammount > $request->amount){
                $deposit_balance = $deposit_current_ammount - $request->amount;
                $account_current_balance = FinanceAccountList::where('id', '=', $request->account)->value('initial_balance');
                $account =  FinanceAccountList::where('id', '=', $request->account)->first();
                $account->initial_balance =$account_current_balance - $deposit_balance;
                $account->update();
            }
            elseif($deposit_current_ammount < $request->amount){
                $deposit_balance = $request->amount - $deposit_current_ammount;
                $account_current_balance = FinanceAccountList::where('id', '=', $request->account)->value('initial_balance');
                $account =  FinanceAccountList::where('id', '=', $request->account)->first();
                $account->initial_balance =$account_current_balance + $deposit_balance;
                $account->update();
            }
            else{
                $account_current_balance = FinanceAccountList::where('id', '=', $request->account)->value('initial_balance');
                $account =  FinanceAccountList::where('id', '=', $request->account)->first();
                $account->initial_balance =$account_current_balance;
                $account->update();
            }

            $deposit =  FinanceDeposit::where('id', '=', $id)->first();;
            $deposit->account =$request->account;
            $deposit->category =$request->category;
            $deposit->amount =$request->amount;
            $deposit->date =$request->date;
            $deposit->payer =$request->payer;
            $deposit->reference_no =$request->reference_no;
            $deposit->discription =$request->discription;
            $deposit->attachment =$attachment_name;
            $deposit->payment_mode =$request->payment_mode;
            $deposit->update();

            return back()->with('success', 'Deposit  Details Successfully  Updated');
            }
    }
    public function finance_expense(Request $request)
    {
    if($request->isMethod('get')){
    $expenses = FinanceExpense::get();
    $accounts = FinanceAccountList::get();
    $payees = FinancePayee::get();
    return view('finance-expense', ['expenses' => $expenses,'accounts' => $accounts,'payees' => $payees]);
    }

    }
    public function add_expense(Request $request)
    {
    if($request->isMethod('get')){
    $accounts = FinanceAccountList::get();
    $payees = FinancePayee::get();
    return view('add_expense', ['accounts' => $accounts,'payees' => $payees]);
    }
    if($request->isMethod('post')){
        $this->validate($request, [
            'account'   => 'required',
            'category'   => 'required',
            'amount'   => 'required',
            'date'   => 'required',
            'payee'   => 'required',
            'reference_no'   => 'required',
            'discription'   => 'required',
            'attachment'   => 'required',
            'payment_mode'   => 'required',
        ]);

        $attachment_name = time().'expense.'.$request->attachment->extension();
        $request->attachment->move(public_path('financial_attchments'), $attachment_name);

        $expense =  new FinanceExpense();
        $expense->account =$request->account;
        $expense->category =$request->category;
        $expense->amount =$request->amount;
        $expense->date =$request->date;
        $expense->payee =$request->payee;
        $expense->reference_no =$request->reference_no;
        $expense->discription =$request->discription;
        $expense->attachment =$attachment_name;
        $expense->payment_mode =$request->payment_mode;
        $expense->save();

        $account_current_balance = FinanceAccountList::where('id', '=', $request->account)->value('initial_balance');
        $account =  FinanceAccountList::where('id', '=', $request->account)->first();
        $account->initial_balance =$account_current_balance - $request->amount;
        $account->update();

        return back()->with('success', 'Expense Added');
    }

    }
    public function delete_finance_expense($id){
        FinanceExpense::find($id)->delete();
        return back()->with('success', 'Expense  Deleted');
    }
    public function edit_finance_expense($id,Request $request)
    {

        if($request->isMethod('get')){
            $expense_details = FinanceExpense::where('id',$id)->get();
            $accounts = FinanceAccountList::get();
            $payees = FinancePayee::get();
            return view('edit-finance-expense', ['expense_details' => $expense_details,'accounts' => $accounts,'payees' => $payees]);
            }
        if($request->isMethod('post')){

            if($request->attachment){
                $attachment_name = time().'expense.'.$request->attachment->extension();
                $request->attachment->move(public_path('financial_attchments'), $attachment_name);
               }
               else{
                $attachment_name = FinanceExpense::where('id',$id)->value('attachment');;
            }

            $expense_current_ammount = FinanceExpense::where('id', '=', $id)->value('amount');
            if($expense_current_ammount > $request->amount){
                $expense_balance = $expense_current_ammount - $request->amount;
                $account_current_balance = FinanceAccountList::where('id', '=', $request->account)->value('initial_balance');
                $account =  FinanceAccountList::where('id', '=', $request->account)->first();
                $account->initial_balance =$account_current_balance + $expense_balance;
                $account->update();
            }
            elseif($expense_current_ammount < $request->amount){
                $expense_balance = $request->amount - $expense_current_ammount;
                $account_current_balance = FinanceAccountList::where('id', '=', $request->account)->value('initial_balance');
                $account =  FinanceAccountList::where('id', '=', $request->account)->first();
                $account->initial_balance =$account_current_balance - $expense_balance;
                $account->update();
            }
            else{
                $account_current_balance = FinanceAccountList::where('id', '=', $request->account)->value('initial_balance');
                $account =  FinanceAccountList::where('id', '=', $request->account)->first();
                $account->initial_balance =$account_current_balance;
                $account->update();
            }

            $expense =  FinanceExpense::where('id', '=', $id)->first();;
            $expense->account =$request->account;
            $expense->category =$request->category;
            $expense->amount =$request->amount;
            $expense->date =$request->date;
            $expense->payee =$request->payee;
            $expense->reference_no =$request->reference_no;
            $expense->discription =$request->discription;
            $expense->attachment =$attachment_name;
            $expense->payment_mode =$request->payment_mode;
            $expense->update();

            return back()->with('success', 'Expense  Details Successfully  Updated');
            }
    }
    public function add_finance_transfer(Request $request)
    {
    if($request->isMethod('get')){
    $accounts = FinanceAccountList::get();
    return view('add_finance_transfer', ['accounts' => $accounts]);
    }
    if($request->isMethod('post')){
        $this->validate($request, [
            'from_account'   => 'required',
            'to_account'   => 'required',
            'amount'   => 'required',
            'date'   => 'required',
            'payment_mode'   => 'required',
            'reference_no'   => 'required',
            'discription'   => 'required',
        ]);


        $transfer =  new FinanceTransfer();
        $transfer->from_account =$request->from_account;
        $transfer->to_account =$request->to_account;
        $transfer->amount =$request->amount;
        $transfer->date =$request->date;
        $transfer->payment_mode =$request->payment_mode;
        $transfer->reference_no =$request->reference_no;
        $transfer->discription =$request->discription;
        $transfer->save();

        $from_account_current_balance = FinanceAccountList::where('id', '=', $request->from_account)->value('initial_balance');
        $from_account =  FinanceAccountList::where('id', '=', $request->from_account)->first();
        $from_account->initial_balance =$from_account_current_balance - $request->amount;
        $from_account->update();
        $to_account_current_balance = FinanceAccountList::where('id', '=', $request->to_account)->value('initial_balance');
        $to_account =  FinanceAccountList::where('id', '=', $request->to_account)->first();
        $to_account->initial_balance =$to_account_current_balance + $request->amount;
        $to_account->update();

        return back()->with('success', 'Transfer Added');
    }

    }
    public function finance_transfer(Request $request)
    {
    if($request->isMethod('get')){
    $transfers = FinanceTransfer::get();
    $accounts = FinanceAccountList::get();
    return view('finance-transfer', ['transfers' => $transfers,'accounts' => $accounts]);
    }
    if($request->isMethod('post')){
        $this->validate($request, [
            'from_account'   => 'required',
            'to_account'   => 'required',
            'amount'   => 'required',
            'date'   => 'required',
            'payment_mode'   => 'required',
            'reference_no'   => 'required',
            'discription'   => 'required',
        ]);


        $transfer =  new FinanceTransfer();
        $transfer->from_account =$request->from_account;
        $transfer->to_account =$request->to_account;
        $transfer->amount =$request->amount;
        $transfer->date =$request->date;
        $transfer->payment_mode =$request->payment_mode;
        $transfer->reference_no =$request->reference_no;
        $transfer->discription =$request->discription;
        $transfer->save();

        $from_account_current_balance = FinanceAccountList::where('id', '=', $request->from_account)->value('initial_balance');
        $from_account =  FinanceAccountList::where('id', '=', $request->from_account)->first();
        $from_account->initial_balance =$from_account_current_balance - $request->amount;
        $from_account->update();
        $to_account_current_balance = FinanceAccountList::where('id', '=', $request->to_account)->value('initial_balance');
        $to_account =  FinanceAccountList::where('id', '=', $request->to_account)->first();
        $to_account->initial_balance =$to_account_current_balance + $request->amount;
        $to_account->update();

        return back()->with('success', 'Transfer Added');
    }

    }
    public function delete_finance_transfer($id){
        FinanceTransfer::find($id)->delete();
        return back()->with('success', 'Transfer  Deleted');
    }
    public function edit_finance_transfer($id,Request $request)
    {

        if($request->isMethod('get')){
            $transfer_details = FinanceTransfer::where('id',$id)->get();
            $accounts = FinanceAccountList::get();
            return view('edit-finance-transfer', ['transfer_details' => $transfer_details,'accounts' => $accounts]);
            }
        if($request->isMethod('post')){

            $transfer_current_ammount = FinanceTransfer::where('id', '=', $id)->value('amount');
            if($transfer_current_ammount > $request->amount){
                $transfer_balance = $transfer_current_ammount - $request->amount;
                $from_account_current_balance = FinanceAccountList::where('id', '=', $request->from_account)->value('initial_balance');
                $from_account =  FinanceAccountList::where('id', '=', $request->from_account)->first();
                $from_account->initial_balance =$from_account_current_balance + $transfer_balance;
                $from_account->update();
                $to_account_current_balance = FinanceAccountList::where('id', '=', $request->to_account)->value('initial_balance');
                $to_account =  FinanceAccountList::where('id', '=', $request->to_account)->first();
                $to_account->initial_balance =$to_account_current_balance - $transfer_balance;
                $to_account->update();
            }
            elseif($transfer_current_ammount < $request->amount){
                $transfer_balance =  $request->amount - $transfer_current_ammount;
                $from_account_current_balance = FinanceAccountList::where('id', '=', $request->from_account)->value('initial_balance');
                $from_account =  FinanceAccountList::where('id', '=', $request->from_account)->first();
                $from_account->initial_balance =$from_account_current_balance - $transfer_balance;
                $from_account->update();
                $to_account_current_balance = FinanceAccountList::where('id', '=', $request->to_account)->value('initial_balance');
                $to_account =  FinanceAccountList::where('id', '=', $request->to_account)->first();
                $to_account->initial_balance =$to_account_current_balance + $transfer_balance;
                $to_account->update();
            }
            else{
                $from_account_current_balance = FinanceAccountList::where('id', '=', $request->from_account)->value('initial_balance');
                $from_account =  FinanceAccountList::where('id', '=', $request->from_account)->first();
                $from_account->initial_balance =$from_account_current_balance;
                $from_account->update();
                $to_account_current_balance = FinanceAccountList::where('id', '=', $request->to_account)->value('initial_balance');
                $to_account =  FinanceAccountList::where('id', '=', $request->to_account)->first();
                $to_account->initial_balance =$to_account_current_balance;
                $to_account->update();
            }

            $transfer =  FinanceTransfer::where('id', '=', $id)->first();;
            $transfer->from_account =$request->from_account;
            $transfer->to_account =$request->to_account;
            $transfer->amount =$request->amount;
            $transfer->date =$request->date;
            $transfer->payment_mode =$request->payment_mode;
            $transfer->reference_no =$request->reference_no;
            $transfer->discription =$request->discription;
            $transfer->update();

            return back()->with('success', 'Transfer  Details Successfully  Updated');
            }
    }
    public function finance_transaction_history(Request $request)
    {
        $deposits = FinanceDeposit::get();
        $expenses = FinanceExpense::get();
        $transfers = FinanceTransfer::get();
    return view('finance-transaction-history', ['deposits' => $deposits,'expenses' => $expenses,'transfers' => $transfers]);
    }
    public function finance_payment(Request $request)
    {
    if($request->isMethod('get')){
    $payments = FinancePayment::get();
    $accounts = FinanceAccountList::get();
    $departments = OrganizationDepartments::get();
    return view('finance-payment', ['payments' => $payments,'accounts' => $accounts,'departments' => $departments]);
    }
    if($request->isMethod('post')){
        $this->validate($request, [
            'department'   => 'required',
            'account'   => 'required',
            'date'   => 'required',
        ]);

        $employees = OtherEmployeeDetails::where('department', $request->department)->get();
        if($employees == null || $employees->isEmpty()){
            return back()->with('fail', 'No Employees in This Department');
        }
        else{
        $total_sallery=0;
          foreach($employees as $employee){
            $basic_sallery = BasicSalary::where('user_id', $employee->user_id)->value('basic_salary');
            if($basic_sallery == null){
                $basic_sallery = 0;
            }
            else{
                $basic_sallery = $basic_sallery;
            }
            $allowance = Allowances::where('user_id', $employee->user_id)->value('allowance_amount');
            if($allowance == null){
                $allowance = 0;
            }
            else{
                $allowance = $allowance;
            }
            $commissions = Commissions::where('user_id', $employee->user_id)->value('commission_amount');
            if($commissions == null){
                $commissions = 0;
            }
            else{
                $commissions = $commissions;
            }
            $loan = Loans::where('user_id', $employee->user_id)->value('amount');
            if($loan == null){
                $loan = 0;
            }
            else{
                $loan = Loans::where('user_id', $employee->user_id)->value('amount')/Loans::where('user_id', $employee->user_id)->value('number_of_installments');
            }
            $deductions = Deductions::where('user_id', $employee->user_id)->value('amount');
            if($deductions == null){
                $deductions = 0;
            }
            else{
                $deductions = $deductions;
            }
            $other_paymnets = OtherPaymnets::where('user_id', $employee->user_id)->value('amount');
            if($other_paymnets == null){
                $other_paymnets = 0;
            }
            else{
                $other_paymnets = $other_paymnets;
            }
            $overtimes = Overtimes::where('user_id', $employee->user_id)->value('total_hours');
            if($overtimes == null){
                $overtimes = 0;
            }
            else{
                $overtimes = Overtimes::where('user_id', $employee->user_id)->value('total_hours')*Overtimes::where('user_id', $employee->user_id)->value('rate');
            }
            $final_sallery = ($basic_sallery+$allowance+$commissions+$other_paymnets+$overtimes)-($deductions+$loan);
            $total_sallery=$total_sallery+$final_sallery;
          }
        }
        $account_current_balance = FinanceAccountList::where('id', '=', $request->account)->value('initial_balance');
        if($account_current_balance < $total_sallery){
            return back()->with('fail', 'Inefficient balance on this account');
        }
        else{
            $payment =  new FinancePayment();
            $payment->department =$request->department;
            $payment->account =$request->account;
            $payment->date =$request->date;
            $payment->amount =$total_sallery;
            $payment->save();
            $account =  FinanceAccountList::where('id', '=', $request->account)->first();
            $account->initial_balance =$account_current_balance - $total_sallery;
            $account->update();
            return back()->with('success', 'Payment Added');
        }
    }

    }

    public function view_finance_payment($id,Request $request)
    {
            return view('view-finance-payment', ['id' => $id]);
    }
    public function assets_category(Request $request)
    {
    if($request->isMethod('get')){
    $categorys = AssetCategory::get();
    return view('assets-category', ['categorys' => $categorys]);
    }

    }
    public function add_asset_category(Request $request)
    {
    if($request->isMethod('get')){
    return view('add_asset_category');
    }
    if($request->isMethod('post')){
        $this->validate($request, [
            'category'   => 'required',
        ]);

        $category =  new AssetCategory();
        $category->category =$request->category;
        $category->save();
        return back()->with('success', 'Category Added');
    }
    }
    public function delete_assets_category($id){
        AssetCategory::find($id)->delete();
        return back()->with('success', 'Category Successfully  Deleted');
    }
    public function edit_assets_category($id,Request $request)
    {
    if($request->isMethod('post')){

        $category =  AssetCategory::where('id', '=', $id)->first();;
        $category->category =$request->category;
        $category->update();
        return back()->with('success', 'Category  Details Successfully  Updated');
    }
    }
    public function assets(Request $request)
    {
    $assets = Asset::get();
    return view('assets', ['assets' => $assets]);

    }
    public function add_asset(Request $request)
    {
    if($request->isMethod('get')){
    $categorys = AssetCategory::get();
    $employees = OtherEmployeeDetails::get();
    return view('add_asset', ['categorys' => $categorys,'employees' => $employees]);
    }
    if($request->isMethod('post')){
        $this->validate($request, [
            'asset_name'   => 'required',
            'asset_code'   => 'required',
            'category'   => 'required',
            'is_working'   => 'required',
            'employee'   => 'required',
            'purchase_date'   => 'required',
            'end_date'   => 'required',
            'manufacturer'   => 'required',
            'invoice_number'   => 'required',
            'serial_number'   => 'required',
            'image'   => 'required',
            'asset_note'   => 'required',
        ]);

        $image_name = time().'asset.'.$request->image->extension();
        $request->image->move(public_path('asset_images'), $image_name);

        $asset =  new Asset();
        $asset->asset_name =$request->asset_name;
        $asset->asset_code =$request->asset_code;
        $asset->category =$request->category;
        $asset->is_working =$request->is_working;
        $asset->employee =$request->employee;
        $asset->purchase_date =$request->purchase_date;
        $asset->end_date =$request->end_date;
        $asset->manufacturer =$request->manufacturer;
        $asset->invoice_number =$request->invoice_number;
        $asset->serial_number =$request->serial_number;
        $asset->image =$image_name;
        $asset->asset_note =$request->asset_note;
        $asset->save();

        return back()->with('success', 'Asset Added');
    }

    }
    public function delete_assets($id){
        Asset::find($id)->delete();
        return back()->with('success', 'Asset  Deleted');
    }
    public function edit_assets($id,Request $request)
    {

        if($request->isMethod('get')){
            $asset_details = Asset::where('id',$id)->get();
            $categorys = AssetCategory::get();
            $employees = OtherEmployeeDetails::get();
            return view('edit-asset', ['asset_details' => $asset_details,'categorys' => $categorys,'employees' => $employees]);
            }
        if($request->isMethod('post')){

            if($request->image){
                $image_name = time().'asset.'.$request->image->extension();
                $request->image->move(public_path('asset_images'), $image_name);
               }
               else{
                $image_name = Asset::where('id',$id)->value('image');;
            }

            $asset =  Asset::where('id', '=', $id)->first();;
            $asset->asset_name =$request->asset_name;
            $asset->asset_code =$request->asset_code;
            $asset->category =$request->category;
            $asset->is_working =$request->is_working;
            $asset->employee =$request->employee;
            $asset->purchase_date =$request->purchase_date;
            $asset->end_date =$request->end_date;
            $asset->manufacturer =$request->manufacturer;
            $asset->invoice_number =$request->invoice_number;
            $asset->serial_number =$request->serial_number;
            $asset->image =$image_name;
            $asset->asset_note =$request->asset_note;
            $asset->update();

            return back()->with('success', 'Asset  Details Successfully  Updated');
            }
    }
    public function file_manager(Request $request)
    {
    if($request->isMethod('get')){
    $files = FileManager::get();
    $departments = OrganizationDepartments::get();
    return view('file-manager', ['files' => $files,'departments' => $departments]);
    }


    }
    public function add_file(Request $request)
    {
    if($request->isMethod('get')){
    $departments = OrganizationDepartments::get();
    return view('add_file', ['departments' => $departments]);
    }
    if($request->isMethod('post')){
        $this->validate($request, [
            'file_name'   => 'required',
            'department'   => 'required',

        ]);
        if(!$request->document && !$request->file_link){
            return back()->with('fail', 'Please Select a File or Add File Link');
        }
        if($request->document){
            $doc_name = time().'-doc.'.$request->document->extension();
            $request->document->move(public_path('file_manager_docs'), $doc_name);
           }
           else{
            $doc_name = null;
        }


        $file =  new FileManager();
        $file->file_name =$request->file_name;
        $file->department =$request->department;
        $file->document =$doc_name;
        $file->file_link =$request->file_link;
        $file->save();

        return back()->with('success', 'File Added');
    }

    }
    public function delete_file_manager($id){
        FileManager::find($id)->delete();
        return back()->with('success', 'File  Deleted');
    }
    public function edit_file_manager($id,Request $request)
    {

        if($request->isMethod('get')){
            $file_details = FileManager::where('id',$id)->get();
            $departments = OrganizationDepartments::get();
            return view('edit-file-manager', ['file_details' => $file_details,'departments' => $departments]);
            }
        if($request->isMethod('post')){
            if(!$request->document && !$request->file_link){
                return back()->with('fail', 'Please Select a File or Add File Link');
            }
            if($request->document){
                $doc_name = time().'-doc.'.$request->document->extension();
                $request->document->move(public_path('file_manager_docs'), $doc_name);
               }
               else{
                $doc_name = FileManager::where('id',$id)->value('document');;
            }

            $file =  FileManager::where('id', '=', $id)->first();;
            $file->file_name =$request->file_name;
            $file->department =$request->department;
            $file->document =$doc_name;
            $file->file_link =$request->file_link;
            $file->update();

            return back()->with('success', 'File  Details Successfully  Updated');
            }
    }
    public function file_oficial_documents(Request $request)
    {
    if($request->isMethod('get')){
    $docs = FileOfficialDocument::get();
    return view('file-oficial-documents', ['docs' => $docs]);
    }

    }
    public function add_official_document(Request $request)
    {
    if($request->isMethod('get')){
    return view('add_official_document');
    }
    if($request->isMethod('post')){
        $this->validate($request, [
            'title'   => 'required',
            'document_type'   => 'required',
            'identification_number'   => 'required',
            'expired_date'   => 'required',
            'notification'   => 'required',
            'discription'   => 'required',
            'document'   => 'required',

        ]);

        $doc_name = time().'-official-doc.'.$request->document->extension();
        $request->document->move(public_path('file_manager_docs'), $doc_name);

        $official =  new FileOfficialDocument();
        $official->title =$request->title;
        $official->document_type =$request->document_type;
        $official->identification_number =$request->identification_number;
        $official->expired_date =$request->expired_date;
        $official->notification =$request->notification;
        $official->discription =$request->discription;
        $official->document =$doc_name;
        $official->save();

        return back()->with('success', 'Document Added');
    }

    }
    public function delete_file_oficial_documents($id){
        FileOfficialDocument::find($id)->delete();
        return back()->with('success', 'Document  Deleted');
    }
    public function edit_file_oficial_documents($id,Request $request)
    {

        if($request->isMethod('get')){
            $doc_details = FileOfficialDocument::where('id',$id)->get();
            return view('edit-file-oficial-documents', ['doc_details' => $doc_details]);
            }
        if($request->isMethod('post')){
            if($request->document){
                $doc_name = time().'-official-doc.'.$request->document->extension();
                $request->document->move(public_path('file_manager_docs'), $doc_name);
               }
               else{
                $doc_name = FileOfficialDocument::where('id',$id)->value('document');;
            }

            $official =  FileOfficialDocument::where('id', '=', $id)->first();;
            $official->title =$request->title;
            $official->document_type =$request->document_type;
            $official->identification_number =$request->identification_number;
            $official->expired_date =$request->expired_date;
            $official->notification =$request->notification;
            $official->discription =$request->discription;
            $official->document =$doc_name;
            $official->update();

            return back()->with('success', 'Document  Details Successfully  Updated');
            }
    }
    public function office_shift(Request $request)
    {
    if($request->isMethod('get')){
    $shifts = OfficeShift::get();
    return view('office-shift', ['shifts' => $shifts]);
    }


    }
    public function add_shift(Request $request)
    {
    if($request->isMethod('get')){
    return view('add_shift');
    }
    if($request->isMethod('post')){
        $this->validate($request, [
            'shift'   => 'required',
        ]);


        $shift =  new OfficeShift();
        $shift->shift =$request->shift;
        $shift->monday_in_time =$request->monday_in_time;
        $shift->monday_out_time =$request->monday_out_time;
        $shift->tuesday_in_time =$request->tuesday_in_time;
        $shift->tuesday_out_time =$request->tuesday_out_time;
        $shift->wednesday_in_time =$request->wednesday_in_time;
        $shift->wednesday_out_time =$request->wednesday_out_time;
        $shift->thursday_in_time =$request->thursday_in_time;
        $shift->thursday_out_time =$request->thursday_out_time;
        $shift->friday_in_time =$request->friday_in_time;
        $shift->friday_out_time =$request->friday_out_time;
        $shift->saturday_in_time =$request->saturday_in_time;
        $shift->saturday_out_time =$request->saturday_out_time;
        $shift->sunday_in_time =$request->sunday_in_time;
        $shift->sunday_out_time =$request->sunday_out_time;
        $shift->save();

        return back()->with('success', 'Shift Added');
    }

    }
    public function delete_office_shift($id){
        OfficeShift::find($id)->delete();
        return back()->with('success', 'Shift  Deleted');
    }
    public function edit_office_shift($id,Request $request)
    {

        if($request->isMethod('get')){
            $shift_details = OfficeShift::where('id',$id)->get();
            return view('edit-office-shift', ['shift_details' => $shift_details]);
            }
        if($request->isMethod('post')){

            $shift =  OfficeShift::where('id', '=', $id)->first();;
            $shift->shift =$request->shift;
            $shift->monday_in_time =$request->monday_in_time;
            $shift->monday_out_time =$request->monday_out_time;
            $shift->tuesday_in_time =$request->tuesday_in_time;
            $shift->tuesday_out_time =$request->tuesday_out_time;
            $shift->wednesday_in_time =$request->wednesday_in_time;
            $shift->wednesday_out_time =$request->wednesday_out_time;
            $shift->thursday_in_time =$request->thursday_in_time;
            $shift->thursday_out_time =$request->thursday_out_time;
            $shift->friday_in_time =$request->friday_in_time;
            $shift->friday_out_time =$request->friday_out_time;
            $shift->saturday_in_time =$request->saturday_in_time;
            $shift->saturday_out_time =$request->saturday_out_time;
            $shift->sunday_in_time =$request->sunday_in_time;
            $shift->sunday_out_time =$request->sunday_out_time;
            $shift->update();

            return back()->with('success', 'Shift  Details Successfully  Updated');
            }
    }
    public function manage_holiday(Request $request)
    {
    if($request->isMethod('get')){
    $holidays = Holidays::get();
    return view('manage-holiday', ['holidays' => $holidays]);
    }

    }
    public function add_holiday(Request $request)
    {
    if($request->isMethod('get')){
    return view('add_holiday');
    }
    if($request->isMethod('post')){
        $this->validate($request, [
            'event_name'   => 'required',
            'start_date'   => 'required',
            'end_date'   => 'required',
            'status'   => 'required',
            'discription'   => 'required',
        ]);


        $holiday =  new Holidays();
        $holiday->event_name =$request->event_name;
        $holiday->start_date =$request->start_date;
        $holiday->end_date =$request->end_date;
        $holiday->status =$request->status;
        $holiday->discription =$request->discription;
        $holiday->save();

        return back()->with('success', 'Holiday Added');
    }

    }
    public function delete_holiday($id){
        Holidays::find($id)->delete();
        return back()->with('success', 'Holiday  Deleted');
    }
    public function edit_holiday($id,Request $request)
    {

        if($request->isMethod('get')){
            $holiday_details = Holidays::where('id',$id)->get();
            return view('edit-holiday', ['holiday_details' => $holiday_details]);
            }
        if($request->isMethod('post')){

            $holiday =  Holidays::where('id', '=', $id)->first();;
            $holiday->event_name =$request->event_name;
            $holiday->start_date =$request->start_date;
            $holiday->end_date =$request->end_date;
            $holiday->status =$request->status;
            $holiday->discription =$request->discription;
            $holiday->update();

            return back()->with('success', 'Holiday  Details Successfully  Updated');
            }
    }
    public function manage_leaves(Request $request)
    {
    if($request->isMethod('get')){
    $leaves = Leaves::get();
    $leave_types = LeaveTypes::get();
    $departments = OrganizationDepartments::get();
    $employees = OtherEmployeeDetails::get();

    return view('manage-leaves', ['leaves' => $leaves,'leave_types' => $leave_types,'employees' => $employees,'departments' => $departments]);
    }

    }
    public function add_leave(Request $request)
    {
    if($request->isMethod('get')){
    $leave_types = LeaveTypes::get();
    $departments = OrganizationDepartments::get();
    $employees = OtherEmployeeDetails::get();

    return view('add_leave', ['leave_types' => $leave_types,'employees' => $employees,'departments' => $departments]);
    }
    if($request->isMethod('post')){
        $this->validate($request, [
            'leave_type'   => 'required',
            'department'   => 'required',
            'employee'   => 'required',
            'leave_duration'   => 'required',
            'discription'   => 'required',
            'remarks'   => 'required',
            'status'   => 'required',
        ]);
        if($request->leave_type == "special"){
            if($request->status == "Approved"){
                if($request->leave_duration == "Full Day"){
                    $deduction_amount = SpecialLeavesDeduction::where('id',1)->value('full_day_deduction');
                }
                else{
                    $deduction_amount = SpecialLeavesDeduction::where('id',1)->value('half_day_deduction');
                }
                $deduction =  new Deductions();
                $deduction->user_id =$request->employee;
                $deduction->month_year =date("Y-m");
                $deduction->deduction_option ="Special Leave Deduction";
                $deduction->title ="Special Leave";
                $deduction->amount =$deduction_amount;
                $deduction->save();
            }
            if($request->leave_duration == "Full Day"){
                $start_date = $request->start_date;
                $end_date = $request->end_date;
                $morining_or_evening = null;
                $date = null;
                }
                else{
                $start_date = null;
                $end_date = null;
                $morining_or_evening = $request->morining_or_evening;
                $date = $request->date;
                }

                $leave =  new Leaves();
                $leave->leave_type =$request->leave_type;
                $leave->department =$request->department;
                $leave->employee =$request->employee;
                $leave->leave_duration =$request->leave_duration;
                $leave->start_date =$start_date;
                $leave->end_date =$end_date;
                $leave->morining_or_evening =$morining_or_evening;
                $leave->date =$date;
                $leave->discription =$request->discription;
                $leave->remarks =$request->remarks;
                $leave->status =$request->status;
                $leave->requested_date = date("Y-m-d");
                $leave->save();

                return back()->with('success', 'Leave Added');
        }
        else{
        // $leave_avilable_count = UserCustomLeaves::where('leave_type', $request->leave_type)->where('user_id', $request->employee)->value('leave_count');
        $leave_avilable_count = LeaveTypes::where('id', $request->leave_type)->value('leave_count');
        $leave_avilablility = LeaveTypes::where('id', $request->leave_type)->value('leave_available');
        $current_leaves = Leaves::where('leave_type',$request->leave_type)->where('employee',$request->employee)->get();
        if($current_leaves == null || $current_leaves->isEmpty()){
            if($request->leave_duration == "Full Day"){
                $start_date = $request->start_date;
                $end_date = $request->end_date;
                $morining_or_evening = null;
                $date = null;
                }
                else{
                $start_date = null;
                $end_date = null;
                $morining_or_evening = $request->morining_or_evening;
                $date = $request->date;
                }

                $leave =  new Leaves();
                $leave->leave_type =$request->leave_type;
                $leave->department =$request->department;
                $leave->employee =$request->employee;
                $leave->leave_duration =$request->leave_duration;
                $leave->start_date =$start_date;
                $leave->end_date =$end_date;
                $leave->morining_or_evening =$morining_or_evening;
                $leave->date =$date;
                $leave->discription =$request->discription;
                $leave->remarks =$request->remarks;
                $leave->status =$request->status;
                $leave->requested_date = date("Y-m-d");
                $leave->save();

                return back()->with('success', 'Leave Added');
        }
        else{
        if($leave_avilablility == "monthly"){
            $leave_count = 0;
           foreach($current_leaves as $current_leave){
            $currentDate = date("Y-m");
            $currentDate = date('Y-m', strtotime($currentDate));
            if($current_leave->leave_duration == "Full Day"){
                $leave_date = $current_leave->start_date;
            }
            else{
                $leave_date = $current_leave->date;
            }
            $reqDate = date('Y-m', strtotime($leave_date));
            if (($currentDate == $reqDate)){
            $leave_count = $leave_count+1;
            }
           }
           if( $leave_count < $leave_avilable_count){
            if($request->leave_duration == "Full Day"){
                $start_date = $request->start_date;
                $end_date = $request->end_date;
                $morining_or_evening = null;
                $date = null;
                }
                else{
                $start_date = null;
                $end_date = null;
                $morining_or_evening = $request->morining_or_evening;
                $date = $request->date;
                }

                $leave =  new Leaves();
                $leave->leave_type =$request->leave_type;
                $leave->department =$request->department;
                $leave->employee =$request->employee;
                $leave->leave_duration =$request->leave_duration;
                $leave->start_date =$start_date;
                $leave->end_date =$end_date;
                $leave->morining_or_evening =$morining_or_evening;
                $leave->date =$date;
                $leave->discription =$request->discription;
                $leave->remarks =$request->remarks;
                $leave->status =$request->status;
                $leave->requested_date = date("Y-m-d");
                $leave->save();

                return back()->with('success', 'Leave Added');
           }
           else{
            return back()->with('fail', 'Maximum leave amount reached');
           }
        }
        else{
            $leave_count = 0;
            foreach($current_leaves as $current_leave){
             $currentYear = date("Y");
             $currentYear = date('Y', strtotime($currentYear));
             if($current_leave->leave_duration == "Full Day"){
                $leave_date = $current_leave->start_date;
            }
            else{
                $leave_date = $current_leave->date;
            }
             $reqYear = date('Y', strtotime($leave_date));
             if (($currentYear == $reqYear)){
             $leave_count = $leave_count+1;
             }
            }
            if( $leave_count < $leave_avilable_count){
             if($request->leave_duration == "Full Day"){
                 $start_date = $request->start_date;
                 $end_date = $request->end_date;
                 $morining_or_evening = null;
                 $date = null;
                 }
                 else{
                 $start_date = null;
                 $end_date = null;
                 $morining_or_evening = $request->morining_or_evening;
                 $date = $request->date;
                 }

                 $leave =  new Leaves();
                 $leave->leave_type =$request->leave_type;
                 $leave->department =$request->department;
                 $leave->employee =$request->employee;
                 $leave->leave_duration =$request->leave_duration;
                 $leave->start_date =$start_date;
                 $leave->end_date =$end_date;
                 $leave->morining_or_evening =$morining_or_evening;
                 $leave->date =$date;
                 $leave->discription =$request->discription;
                 $leave->remarks =$request->remarks;
                 $leave->status =$request->status;
                 $leave->requested_date = date("Y-m-d");
                 $leave->save();

                 return back()->with('success', 'Leave Added');
            }
            else{
             return back()->with('fail', 'Maximum leave amount reached');
            }
        }

        }

    }
    }
    }
     public function add_employee_leave(Request $request)
    {
    if($request->isMethod('get')){
    $leave_types = LeaveTypes::get();

    return view('add_employee_leave', ['leave_types' => $leave_types]);
    }
    if($request->isMethod('post')){
        $this->validate($request, [
            'leave_type'   => 'required',
            'leave_duration'   => 'required',
            'discription'   => 'required',
            'remarks'   => 'required',
        ]);
        if($request->leave_type == "special"){

            if($request->leave_duration == "Full Day"){
                $start_date = $request->start_date;
                $end_date = $request->end_date;
                $morining_or_evening = null;
                $date = null;
                }
                else{
                $start_date = null;
                $end_date = null;
                $morining_or_evening = $request->morining_or_evening;
                $date = $request->date;
                }
                 $department = OtherEmployeeDetails::where('user_id',Auth::user()->id)->value('department');
                 
                $leave =  new Leaves();
                $leave->leave_type =$request->leave_type;
                $leave->department =$department;
                $leave->employee =Auth::user()->id;
                $leave->leave_duration =$request->leave_duration;
                $leave->start_date =$start_date;
                $leave->end_date =$end_date;
                $leave->morining_or_evening =$morining_or_evening;
                $leave->date =$date;
                $leave->discription =$request->discription;
                $leave->remarks =$request->remarks;
                $leave->status ="Pending";
                $leave->requested_date = date("Y-m-d");
                $leave->save();

                return back()->with('success', 'Leave Added');
        }
        else{
        // $leave_avilable_count = UserCustomLeaves::where('leave_type', $request->leave_type)->where('user_id', Auth::user()->id)->value('leave_count');
        $leave_avilable_count = LeaveTypes::where('id', $request->leave_type)->value('leave_count');
        $leave_avilablility = LeaveTypes::where('id', $request->leave_type)->value('leave_available');
        $current_leaves = Leaves::where('leave_type',$request->leave_type)->where('employee',Auth::user()->id)->get();
        if($current_leaves == null || $current_leaves->isEmpty()){
            if($request->leave_duration == "Full Day"){
                $start_date = $request->start_date;
                $end_date = $request->end_date;
                $morining_or_evening = null;
                $date = null;
                }
                else{
                $start_date = null;
                $end_date = null;
                $morining_or_evening = $request->morining_or_evening;
                $date = $request->date;
                }
                 $department = OtherEmployeeDetails::where('user_id',Auth::user()->id)->value('department');
                $leave =  new Leaves();
                $leave->leave_type =$request->leave_type;
                 $leave->department =$department;
                $leave->employee =Auth::user()->id;
                $leave->leave_duration =$request->leave_duration;
                $leave->start_date =$start_date;
                $leave->end_date =$end_date;
                $leave->morining_or_evening =$morining_or_evening;
                $leave->date =$date;
                $leave->discription =$request->discription;
                $leave->remarks =$request->remarks;
                $leave->status ="Pending";
                $leave->requested_date = date("Y-m-d");
                $leave->save();

                return back()->with('success', 'Leave Added');
        }
        else{
        if($leave_avilablility == "monthly"){
            $leave_count = 0;
           foreach($current_leaves as $current_leave){
            $currentDate = date("Y-m");
            $currentDate = date('Y-m', strtotime($currentDate));
            if($current_leave->leave_duration == "Full Day"){
                $leave_date = $current_leave->start_date;
            }
            else{
                $leave_date = $current_leave->date;
            }
            $reqDate = date('Y-m', strtotime($leave_date));
            if (($currentDate == $reqDate)){
            $leave_count = $leave_count+1;
            }
           }
           if( $leave_count < $leave_avilable_count){
            if($request->leave_duration == "Full Day"){
                $start_date = $request->start_date;
                $end_date = $request->end_date;
                $morining_or_evening = null;
                $date = null;
                }
                else{
                $start_date = null;
                $end_date = null;
                $morining_or_evening = $request->morining_or_evening;
                $date = $request->date;
                }
                
                 $department = OtherEmployeeDetails::where('user_id',Auth::user()->id)->value('department');
                 
                $leave =  new Leaves();
                $leave->leave_type =$request->leave_type;
                $leave->department =$department;
                $leave->employee =Auth::user()->id;
                $leave->leave_duration =$request->leave_duration;
                $leave->start_date =$start_date;
                $leave->end_date =$end_date;
                $leave->morining_or_evening =$morining_or_evening;
                $leave->date =$date;
                $leave->discription =$request->discription;
                $leave->remarks =$request->remarks;
                $leave->status ="Pending";
                $leave->requested_date = date("Y-m-d");
                $leave->save();

                return back()->with('success', 'Leave Added');
           }
           else{
            return back()->with('fail', 'Maximum leave amount reached');
           }
        }
        else{
            $leave_count = 0;
            foreach($current_leaves as $current_leave){
             $currentYear = date("Y");
             $currentYear = date('Y', strtotime($currentYear));
             if($current_leave->leave_duration == "Full Day"){
                $leave_date = $current_leave->start_date;
            }
            else{
                $leave_date = $current_leave->date;
            }
             $reqYear = date('Y', strtotime($leave_date));
             if (($currentYear == $reqYear)){
             $leave_count = $leave_count+1;
             }
            }
            if( $leave_count < $leave_avilable_count){
             if($request->leave_duration == "Full Day"){
                 $start_date = $request->start_date;
                 $end_date = $request->end_date;
                 $morining_or_evening = null;
                 $date = null;
                 }
                 else{
                 $start_date = null;
                 $end_date = null;
                 $morining_or_evening = $request->morining_or_evening;
                 $date = $request->date;
                 }
                $department = OtherEmployeeDetails::where('user_id',Auth::user()->id)->value('department');
                 $leave =  new Leaves();
                 $leave->leave_type =$request->leave_type;
                 $leave->department =$department;
                 $leave->employee =Auth::user()->id;
                 $leave->leave_duration =$request->leave_duration;
                 $leave->start_date =$start_date;
                 $leave->end_date =$end_date;
                 $leave->morining_or_evening =$morining_or_evening;
                 $leave->date =$date;
                 $leave->discription =$request->discription;
                 $leave->remarks =$request->remarks;
                 $leave->status ="Pending";
                 $leave->requested_date = date("Y-m-d");
                 $leave->save();

                 return back()->with('success', 'Leave Added');
            }
            else{
             return back()->with('fail', 'Maximum leave amount reached');
            }
        }

        }

    }
    }
    }
    public function delete_leaves($id){
        Leaves::find($id)->delete();
        return back()->with('success', 'Leave  Deleted');
    }
    public function edit_leaves($id,Request $request)
    {

        if($request->isMethod('get')){
            $leave_details = Leaves::where('id',$id)->get();
            $departments = OrganizationDepartments::get();
            $employees = OtherEmployeeDetails::get();
            $leave_types = LeaveTypes::get();
            return view('edit-leave', ['leave_details' => $leave_details,'leave_types' => $leave_types,'employees' => $employees,'departments' => $departments]);
            }
        if($request->isMethod('post')){
            if($request->leave_type == "special"){
                if($request->status == "Approved"){
                    if($request->leave_duration == "Full Day"){
                        $deduction_amount = SpecialLeavesDeduction::where('id',1)->value('full_day_deduction');
                    }
                    else{
                        $deduction_amount = SpecialLeavesDeduction::where('id',1)->value('half_day_deduction');
                    }
                    $deduction =  new Deductions();
                    $deduction->user_id =$request->employee;
                    $deduction->month_year =date("Y-m");
                    $deduction->deduction_option ="Special Leave Deduction";
                    $deduction->title ="Special Leave";
                    $deduction->amount =$deduction_amount;
                    $deduction->save();

                     $details  = [
                        'title' => "Your Leave Has Been Approved",
                        'leave_duration' => $request->leave_duration,
                        'start_date' => $request->start_date,
                        'end_date' => $request->end_date,
                        'morining_or_evening' => $request->morining_or_evening,
                        'date' => $request->date,
                    ];

                    /*Mail::to($request->email)->send(new \App\Mail\ForgetPassword($details));*/

                }
                if($request->leave_duration == "Full Day"){
                    $start_date = $request->start_date;
                    $end_date = $request->end_date;
                    $morining_or_evening = null;
                    $date = null;
                    }
                    else{
                    $start_date = null;
                    $end_date = null;
                    $morining_or_evening = $request->morining_or_evening;
                    $date = $request->date;
                    }

                $leave =  Leaves::where('id', '=', $id)->first();;
                $leave->leave_type =$request->leave_type;
                $leave->department =$request->department;
                $leave->employee =$request->employee;
                $leave->leave_duration =$request->leave_duration;
                $leave->start_date =$start_date;
                $leave->end_date =$end_date;
                $leave->morining_or_evening =$morining_or_evening;
                $leave->date =$date;
                $leave->discription =$request->discription;
                $leave->remarks =$request->remarks;
                $leave->status =$request->status;
                $leave->update();
            }
            if($request->leave_duration == "Full Day"){
                $start_date = $request->start_date;
                $end_date = $request->end_date;
                $morining_or_evening = null;
                $date = null;
                }
                else{
                $start_date = null;
                $end_date = null;
                $morining_or_evening = $request->morining_or_evening;
                $date = $request->date;
                }

            $leave =  Leaves::where('id', '=', $id)->first();;
            $leave->leave_type =$request->leave_type;
            $leave->department =$request->department;
            $leave->employee =$request->employee;
            $leave->leave_duration =$request->leave_duration;
            $leave->start_date =$start_date;
            $leave->end_date =$end_date;
            $leave->morining_or_evening =$morining_or_evening;
            $leave->date =$date;
            $leave->discription =$request->discription;
            $leave->remarks =$request->remarks;
            $leave->status =$request->status;
            $leave->update();

            return back()->with('success', 'Leave  Details Successfully  Updated');
            }
    }
    public function delete_leave_type($id){
        LeaveTypes::find($id)->delete();
        return back()->with('success', 'Leave Type Deleted');
    }
    public function leave_types(Request $request)
    {
    if($request->isMethod('get')){
    $leave_types = LeaveTypes::get();
    $special_leaves_deduction = SpecialLeavesDeduction::where('id', 1)->get();
    return view('leave-types', ['leave_types' => $leave_types, 'special_leaves_deduction' => $special_leaves_deduction]);
    }


    }
    public function add_leave_type(Request $request)
    {
    if($request->isMethod('get')){
    $special_leaves_deduction = SpecialLeavesDeduction::where('id', 1)->get();
    return view('add_leave_type', ['special_leaves_deduction' => $special_leaves_deduction]);
    }
    if($request->isMethod('post')){
        $this->validate($request, [
            'leave_type'   => 'required',
            'leave_available'   => 'required',
            'leave_count'   => 'required',
        ]);

        $leave_type =  new LeaveTypes();
        $leave_type->leave_type =$request->leave_type;
        $leave_type->leave_available =$request->leave_available;
        $leave_type->leave_count =$request->leave_count;
        $leave_type->save();

        $users = User::get();
        foreach($users as $user){
        $user_leave =  new UserCustomLeaves();
        $user_leave->user_id =$user->id;
        $user_leave->leave_type =$leave_type->id;
        $user_leave->leave_count =$request->leave_count;
        $user_leave->save();
        }

        return back()->with('success', 'Leave Type Added');
    }

    }
    public function edit_leave_type($id,Request $request)
    {

        if($request->isMethod('get')){
            $type_details = LeaveTypes::where('id',$id)->get();
            return view('edit-leave-type', ['type_details' => $type_details]);
            }
        if($request->isMethod('post')){


            $leave_type =  LeaveTypes::where('id', '=', $id)->first();;
            $leave_type->leave_type =$request->leave_type;
            $leave_type->leave_available =$request->leave_available;
            $leave_type->leave_count =$request->leave_count;
            $leave_type->update();

            return back()->with('success', 'Leave  Type Successfully  Updated');
            }
    }
    public function update_special_leaves_deductions(Request $request)
    {

        if($request->isMethod('post')){
            $diduc =  SpecialLeavesDeduction::where('id', '=', 1)->first();;
            $diduc->half_day_deduction =$request->half_day_deduction;
            $diduc->full_day_deduction =$request->full_day_deduction;
            $diduc->update();
            return back()->with('successd', 'Diduction Successfully  Updated');
            }
    }
    public function update_attendances_2(Request $request)
    {
    if($request->isMethod('get')){
    $departments = OrganizationDepartments::get();
    return view('update-attendances', ['departments' => $departments]);
    }
    if($request->isMethod('post')){
    if(Attendance::where('department', $request->department)->where('employee', $request->employee)->where('clock_out', null)->exists()){
        return back()->with('fail', 'Clock Out Time Missing From Previous Date Please Check');
    }
    else{
        $attendance =  new Attendance();
        $attendance->date =$request->date;
        $attendance->department =$request->department;
        $attendance->employee =$request->employee;
        $attendance->attendance_date =$request->attendance_date;
        $attendance->clock_in =$request->clock_in;
        $attendance->clock_out =$request->clock_out;
        $attendance->added_date_time = date('Y-m-d H:i:s');
        $attendance->save();

        return back()->with('success', 'Attendance Added');
    }
    }


    }
    public function update_attendances(Request $request)
    {
    if($request->isMethod('get')){
    $hods = User::where('user_role', '5')->orderBy('id')->get();
    $hrms = User::where('user_role', '2')->orderBy('id')->get();
    $authorisers = User::where('user_role', '6')->orderBy('id')->get();
    $employees = User::where('user_role', '3')->orderBy('id')->get();
    return view('update-attendances', ['hods' => $hods,'hrms' => $hrms,'authorisers' => $authorisers,'employees' => $employees]);
    }

    }
    public function attendence_get_employees(Request $request)
    {
        $employees = OtherEmployeeDetails::where('department', $request->department_id)->get();
        echo '<option selected hidden disabled value="Select">Select</option>';
            foreach($employees as $employee){
           echo '<option value="'.$employee->user_id.'">'.$employee->first_name.' '.$employee->last_name.'</option>';
            }

    }
       public function get_attendence_details(Request $request)
    {
    $prevoius_day = date( "Y-m-d", strtotime(date("Y-m-d") . "-1 day"));

        $attendence_details = UserCheckInOutData::where('year_month_date', $request->date)->where('user_id', $request->user_id)->get();
        echo '<thead>
        <tr>
            <th>User</th>
            <th>Check In/Out</th>
            <th>Date</th>
            <th>Time</th>
             <th>Approved</th>
        </tr></thead><tbody>';
        foreach($attendence_details as $attendence_detail){
            $user_role = User::where('id',$attendence_detail->user_id)->value('user_role');
            if($user_role == 2){
            $user_name = OtherHRManagerDetails::where('user_id',$attendence_detail->user_id)->value('first_name').' '.OtherHRManagerDetails::where('user_id',$attendence_detail->user_id)->value('last_name');
            }
            if($user_role == 3){
            $user_name = OtherEmployeeDetails::where('user_id', $attendence_detail->user_id)->value('first_name').' '. OtherEmployeeDetails::where('user_id', $attendence_detail->user_id)->value('last_name');
            }
            if($user_role == 5){
            $user_name = OtherHODDetails::where('user_id',$attendence_detail->user_id)->value('name');
            }
            if($user_role == 6){
            $user_name =  OtherAuthoriserDetails::where('user_id',$attendence_detail->user_id)->value('name');
            }
            echo ' <tr><td>'. $user_name.'</td>
            <td>'. $attendence_detail->check_in_or_out.'</td><td>'.$attendence_detail->year_month_date.'</td><td>'.$attendence_detail->time_.' </td> <td>'.$attendence_detail->approved.' </td></tr>'
            ;
        }
        echo '
        </tbody>';
    }
    public function add_attendence_details(Request $request)
    {
    $check_in = new UserCheckInOutData();
    $check_in->user_id =$request->user_id;
    $check_in->check_in_or_out ="check in";
    $check_in->year_month_date =$request->attendance_date;
    $check_in->time_ =$request->check_in;
    $check_in->approved ="yes";
    $check_in->save();

    $check_out = new UserCheckInOutData();
    $check_out->user_id =$request->user_id;
    $check_out->check_in_or_out ="check out";
    $check_out->year_month_date =$request->attendance_date;
    $check_out->time_ =$request->check_out;
    $check_out->approved ="yes";
    $check_out->save();
    }
    public function edit_attendence_details($id,Request $request)
    {
        if($request->isMethod('get')){
            $departments = OrganizationDepartments::get();
            $attendence_details = Attendance::where('id',$id)->get();
            return view('edit-attendence-details', ['attendence_details' => $attendence_details,'departments' => $departments]);
            }
        if($request->isMethod('post')){

            $attendance =  Attendance::where('id', '=', $id)->first();;
            $attendance->date =$request->date;
            $attendance->department =$request->department;
            $attendance->employee =$request->employee;
            $attendance->attendance_date =$request->attendance_date;
            $attendance->clock_in =$request->clock_in;
            $attendance->clock_out =$request->clock_out;
            $attendance->added_date_time = date('Y-m-d H:i:s');
            $attendance->update();

            return back()->with('success', 'Attendance  Details Successfully  Updated');
            }
    }
    public function job_post(Request $request)
    {

    $jobs = JobPosts::get();
    return view('job-post', ['jobs' => $jobs]);

    }
    public function add_job_post(Request $request)
    {
    if($request->isMethod('get')){
    $jobs = JobPosts::get();
    return view('add_job_post', ['jobs' => $jobs]);
    }
    if($request->isMethod('post')){
        $this->validate($request, [
            'job_title'   => 'required',
            'job_type'   => 'required',
            'job_category'   => 'required',
            'no_of_vacancy'   => 'required',
            'date_of_closing'   => 'required',
            'gender'   => 'required',
            'minimum_experience'   => 'required',
            'is_featured'   => 'required',
            'status'   => 'required',
            'short_description'   => 'required',
            'long_discription'   => 'required',
        ]);


        $job =  new JobPosts();
        $job->job_title =$request->job_title;
        $job->job_type =$request->job_type;
        $job->job_category =$request->job_category;
        $job->no_of_vacancy =$request->no_of_vacancy;
        $job->date_of_closing =$request->date_of_closing;
        $job->gender =$request->gender;
        $job->minimum_experience =$request->minimum_experience;
        $job->is_featured =$request->is_featured;
        $job->status =$request->status;
        $job->short_description =$request->short_description;
        $job->long_discription =$request->long_discription;
        $job->save();

        return back()->with('success', 'Job Added');
    }

    }
    public function delete_job_post($id){
        JobPosts::find($id)->delete();
        return back()->with('success', 'Jop Post  Deleted');
    }
    public function edit_job_post($id,Request $request)
    {

        if($request->isMethod('get')){
            $job_details = JobPosts::where('id',$id)->get();
            $recruitments = Recruitments::where('job_post',$id)->get();
            return view('edit_job_post', ['job_details' => $job_details,'recruitments' => $recruitments]);
            }
        if($request->isMethod('post')){

        $job =  JobPosts::where('id', '=', $id)->first();;
        $job->job_title =$request->job_title;
        $job->job_type =$request->job_type;
        $job->job_category =$request->job_category;
        $job->no_of_vacancy =$request->no_of_vacancy;
        $job->date_of_closing =$request->date_of_closing;
        $job->gender =$request->gender;
        $job->minimum_experience =$request->minimum_experience;
        $job->is_featured =$request->is_featured;
        $job->status =$request->status;
        $job->short_description =$request->short_description;
        $job->long_discription =$request->long_discription;
        $job->update();

        return back()->with('success', 'Job  Details Successfully  Updated');
        }
    }
    public function hod()
    {
        $hods = User::where('user_role', '5')->orderBy('id')->get();
        return view('hod', ['hods' => $hods]);
    }
    public function add_hod(Request $request)
    { if($request->isMethod('get')){
        $departments = OrganizationDepartments::orderBy('id')->get();
        $hrms = User::where('user_role', '2')->orderBy('id')->get();
        return view('add-hod', ['departments' => $departments, 'hrms' => $hrms]);
    }
    if($request->isMethod('post')){
    $this->validate($request, [
            'name'   => 'required',
            'department'   => 'required',
            'phone'   => 'required',
            'dob'   => 'required',
            'gender'   => 'required',
            'employment_type'   => 'required',
            'epf_no'   => 'required',
            'appoinment_date'   => 'required',
            'longitude'   => 'required',
            'appoinment_date'   => 'required',
            'responsible_person'   => 'required',
            'nic'   => 'required',
            'email'   => 'required | email | unique:users',
            'user_name'  => 'required | min:6 | unique:users',
            "password" => "required | confirmed | min:6",
           ]);

           if($request->image){
            $image_name = time().'hod.'.$request->image->extension();
           $request->image->move(public_path('user_images'), $image_name);
           }
           else{
            $image_name = "defaul_admin.jpg";
           }

           if($request->status){
            $status = 'active';
           }
           else{
            $status = 'inactive';
           }
           DB::beginTransaction();
           $user = User::create([
              "user_name" => $request->user_name,
              "email" => $request->email,
              "password" => Hash::make($request->password),
              "user_role" => 5,
              "status" => $status
           ]);

           $userDetails = new OtherHODDetails();
           $userDetails->user_id =$user->id;
           $userDetails->name = $request->name;
           $userDetails->department = $request->department;
           $userDetails->phone = $request->phone;
           $userDetails->dob = $request->dob;
           $userDetails->gender = $request->gender;
           $userDetails->employment_type = $request->employment_type;
           $userDetails->epf_no = $request->epf_no;
           $userDetails->appoinment_date = $request->appoinment_date;
           $userDetails->latitude = $request->latitude;
           $userDetails->longitude = $request->longitude;
           $userDetails->responsible_person = $request->responsible_person;
           $userDetails->nic = $request->nic;
           $userDetails->image = $image_name;
           $userDetails->save();
           DB::commit();
            return back()->with('success', 'HOD Successfully Added');

    }

    }
    public function deactivate_hod($id){
        $hod = User::find($id);
        $hod->status = "inactive";
        $hod->update();
        return back()->with('success', 'HOD Deactivated');

    }
    public function activate_hod($id){
        $hod = User::find($id);
        $hod->status = "active";
        $hod->update();
        return back()->with('success', 'HOD Activated');

    }
    public function edit_hod($id,Request $request)
    {
    if($request->isMethod('get')){
    $login_details = User::where('id',$id)->get();
    $other_details = OtherHODDetails::where('user_id',$id)->get();
    $designations = Designations::where('status', 'active')->orderBy('id')->get();
    $departments = OrganizationDepartments::orderBy('id')->get();
    $immigrations = Immigrations::where('user_id', $id)->orderBy('id')->get();
    $contacts = Contacts::where('user_id', $id)->orderBy('id')->get();
    $social_profile = SocialProfile::where('user_id', $id)->orderBy('id')->get();
    $documents = Documents::where('user_id', $id)->orderBy('id')->get();
    $qulifications = Qulifications::where('user_id', $id)->orderBy('id')->get();
    $works = Works::where('user_id', $id)->orderBy('id')->get();
    $bank_accounts = BankAccounts::where('user_id', $id)->orderBy('id')->get();
    $basic_salarys = BasicSalary::where('user_id', $id)->orderBy('id')->get();
    $allowances = Allowances::where('user_id', $id)->orderBy('id')->get();
    $commissions = Commissions::where('user_id', $id)->orderBy('id')->get();
    $loans = Loans::where('user_id', $id)->orderBy('id')->get();
    $deductions = Deductions::where('user_id', $id)->orderBy('id')->get();
    $payments = OtherPaymnets::where('user_id', $id)->orderBy('id')->get();
    $overtimes = Overtimes::where('user_id', $id)->orderBy('id')->get();
    $pensions = Pensions::where('user_id', $id)->orderBy('id')->get();
    $corehr_promotions = CoreHRPromotions::where('employee', $id)->orderBy('id')->get();
    $corehr_awrds = CoreHRAwards::where('employee', $id)->orderBy('id')->get();
    $corehr_travels = CoreHRTravel::where('employee', $id)->orderBy('id')->get();
    $corehr_transfers = CoreHRTransfer::where('employee', $id)->orderBy('id')->get();
    $corehr_resignations = CoreHRResignations::where('employee', $id)->orderBy('id')->get();
    $corehr_complaints = CoreHRComplaints::where('complaint_from', $id)->orderBy('id')->get();
    $corehr_warnings = CoreHRWarnings::where('employee', $id)->orderBy('id')->get();
    $corehr_terminations = CoreHRTerminations::where('employee', $id)->orderBy('id')->get();
    $projects = PMProjects::get();
    $tasks = PMTasks::get();
    $leaves = Leaves::where('employee',$id)->get();
    $hods = User::where('user_role', '5')->orderBy('id')->get();
    $hrms = User::where('user_role', '2')->orderBy('id')->get();
    $authorisers = User::where('user_role', '6')->orderBy('id')->get();
        return view('edit-hod', ['login_details' => $login_details, 'other_details' => $other_details,
        'designations' => $designations, 'departments' => $departments, 'immigrations' => $immigrations,
         'contacts' => $contacts,'social_profile' => $social_profile,'documents' => $documents,
         'qulifications' => $qulifications, 'works' => $works, 'bank_accounts' => $bank_accounts, 'basic_salarys' => $basic_salarys
         , 'allowances' => $allowances, 'commissions' => $commissions, 'loans' => $loans, 'deductions' => $deductions
         , 'payments' => $payments, 'overtimes' => $overtimes, 'pensions' => $pensions, 'corehr_promotions' => $corehr_promotions
         , 'corehr_awrds' => $corehr_awrds, 'corehr_travels' => $corehr_travels, 'corehr_transfers' => $corehr_transfers
         , 'corehr_resignations' => $corehr_resignations, 'corehr_complaints' => $corehr_complaints, 'corehr_warnings' => $corehr_warnings
         , 'corehr_terminations' => $corehr_terminations, 'projects' => $projects, 'tasks' => $tasks, 'leaves' => $leaves,
         'hods' => $hods, 'hrms' => $hrms, 'authorisers' => $authorisers]);
    }
    }
    public function edit_hod_basic($id,Request $request)
    {
    $this->validate($request, [
        'name'   => 'required',
        'department'   => 'required',
        'phone'   => 'required',
        'dob'   => 'required',
            'gender'   => 'required',
            'employment_type'   => 'required',
            'epf_no'   => 'required',
            'appoinment_date'   => 'required',
            'appoinment_date'   => 'required',
            'longitude'   => 'required',
        'responsible_person'   => 'required',
        'nic'   => 'required',
        'email'   => 'required | email',
        'user_name'  => 'required | min:6',
    ]);
    if($request->status){
        $status = 'active';
    }
    else{
        $status = 'inactive';
    }


    if(!$request->current_password == null || !$request->password == null || !$request->password_confirmation == null){
        $this->validate($request, [
            "password" => "required | confirmed | min:6",
            "current_password" => "required",
           ]);
           if (Hash::check($request->input('current_password'), User::where('id', $id)->value('password'))) {
            if(User::where("id", "=", $id)->where("email", "=", $request->email)->exists()){
                $email = $request->email;
            }
            elseif(User::where("email", "=", $request->email)->exists()){
             return back()->with('fail', 'This email is already in use');
            }
            else{
             $email = $request->email;
            }
            if(User::where("id", "=", $id)->where("user_name", "=", $request->user_name)->exists()){
                $user_name = $request->user_name;
                }
               elseif(User::where("user_name", "=", $request->user_name)->exists()){
               return back()->with('fail', 'This user name is already in use');
               }
               else{
                $user_name = $request->user_name;
               }
            $userDetails =  OtherHODDetails::where('user_id', '=', $id)->first();;
            $userDetails->name = $request->name;
            $userDetails->department = $request->department;
            $userDetails->phone = $request->phone;
            $userDetails->dob = $request->dob;
           $userDetails->gender = $request->gender;
           $userDetails->employment_type = $request->employment_type;
           $userDetails->epf_no = $request->epf_no;
           $userDetails->appoinment_date = $request->appoinment_date;
           $userDetails->latitude = $request->latitude;
           $userDetails->longitude = $request->longitude;
            $userDetails->responsible_person = $request->responsible_person;
            $userDetails->nic = $request->nic;
            $userDetails->update();
            $user = User::find($id);
            $user->email = $email;
            $user->password = Hash::make($request->input('password'));
            $user->user_name = $user_name;
            $user->status = $status;
            $user->update();
            return back()->with('success', 'HOD Details Successfully  Updated');
           }
           else{
            return back()->with('fail', 'Current password is incorrect.');
        }
    }
    else{
        if(User::where("id", "=", $id)->where("email", "=", $request->email)->exists()){
            $email = $request->email;
        }
        elseif(User::where("email", "=", $request->email)->exists()){
         return back()->with('fail', 'This email is already in use');
        }
        else{
         $email = $request->email;
        }
        if(User::where("id", "=", $id)->where("user_name", "=", $request->user_name)->exists()){
            $user_name = $request->user_name;
            }
           elseif(User::where("user_name", "=", $request->user_name)->exists()){
           return back()->with('fail', 'This user name is already in use');
           }
           else{
            $user_name = $request->user_name;
           }
        $userDetails =  OtherHODDetails::where('user_id', '=', $id)->first();;
        $userDetails->name = $request->name;
        $userDetails->department = $request->department;
        $userDetails->phone = $request->phone;
        $userDetails->dob = $request->dob;
           $userDetails->gender = $request->gender;
           $userDetails->employment_type = $request->employment_type;
           $userDetails->epf_no = $request->epf_no;
           $userDetails->appoinment_date = $request->appoinment_date;
           $userDetails->latitude = $request->latitude;
           $userDetails->longitude = $request->longitude;
        $userDetails->responsible_person = $request->responsible_person;
$userDetails->nic = $request->nic;
        $userDetails->update();
        $user = User::find($id);
        $user->email = $email;
        $user->user_name = $user_name;
        $user->status = $status;
        $user->update();
        return back()->with('success', 'HOD Details Successfully  Updated');
    }


    }
public function change_hod_image($id,Request $request)
    {
        $image_name = time().'hod.'.$request->image->extension();
        $request->image->move(public_path('user_images'), $image_name);

        $change_image =  OtherHODDetails::where('user_id', '=', $id)->first();;
        $change_image->image =$image_name;
        $change_image->update();
        return back()->with('success', 'HOD Profile Picture  Updated');

    }
    public function employee_profile($id)
    {
        $login_details = User::where('id',$id)->get();
        $other_details = OtherEmployeeDetails::where('user_id',$id)->get();
        $designations = Designations::where('status', 'active')->orderBy('id')->get();
        $departments = OrganizationDepartments::orderBy('id')->get();
        $immigrations = Immigrations::where('user_id', $id)->orderBy('id')->get();
        $contacts = Contacts::where('user_id', $id)->orderBy('id')->get();
        $social_profile = SocialProfile::where('user_id', $id)->orderBy('id')->get();
        $documents = Documents::where('user_id', $id)->orderBy('id')->get();
        $qulifications = Qulifications::where('user_id', $id)->orderBy('id')->get();
        $works = Works::where('user_id', $id)->orderBy('id')->get();
        $bank_accounts = BankAccounts::where('user_id', $id)->orderBy('id')->get();
        $basic_salarys = BasicSalary::where('user_id', $id)->orderBy('id')->get();
        $allowances = Allowances::where('user_id', $id)->orderBy('id')->get();
        $commissions = Commissions::where('user_id', $id)->orderBy('id')->get();
        $loans = Loans::where('user_id', $id)->orderBy('id')->get();
        $deductions = Deductions::where('user_id', $id)->orderBy('id')->get();
        $payments = OtherPaymnets::where('user_id', $id)->orderBy('id')->get();
        $overtimes = Overtimes::where('user_id', $id)->orderBy('id')->get();
        $pensions = Pensions::where('user_id', $id)->orderBy('id')->get();
        $corehr_promotions = CoreHRPromotions::where('employee', $id)->orderBy('id')->get();
        $corehr_awrds = CoreHRAwards::where('employee', $id)->orderBy('id')->get();
        $corehr_travels = CoreHRTravel::where('employee', $id)->orderBy('id')->get();
        $corehr_transfers = CoreHRTransfer::where('employee', $id)->orderBy('id')->get();
        $corehr_resignations = CoreHRResignations::where('employee', $id)->orderBy('id')->get();
        $corehr_complaints = CoreHRComplaints::where('complaint_from', $id)->orderBy('id')->get();
        $corehr_warnings = CoreHRWarnings::where('employee', $id)->orderBy('id')->get();
        $corehr_terminations = CoreHRTerminations::where('employee', $id)->orderBy('id')->get();
        return view('employee_profile', ['login_details' => $login_details, 'other_details' => $other_details,
        'designations' => $designations, 'departments' => $departments, 'immigrations' => $immigrations,
         'contacts' => $contacts,'social_profile' => $social_profile,'documents' => $documents,
         'qulifications' => $qulifications, 'works' => $works, 'bank_accounts' => $bank_accounts, 'basic_salarys' => $basic_salarys
         , 'allowances' => $allowances, 'commissions' => $commissions, 'loans' => $loans, 'deductions' => $deductions
         , 'payments' => $payments, 'overtimes' => $overtimes, 'pensions' => $pensions, 'corehr_promotions' => $corehr_promotions
         , 'corehr_awrds' => $corehr_awrds, 'corehr_travels' => $corehr_travels, 'corehr_transfers' => $corehr_transfers,
          'corehr_resignations' => $corehr_resignations,'corehr_complaints' => $corehr_complaints,'corehr_warnings' => $corehr_warnings
          ,'corehr_terminations' => $corehr_terminations]);
    }
    public function view_immigration($id,Request $request)
    {
    if($request->isMethod('get')){
    $details = Immigrations::where('id',$id)->get();
    return view('view_immigration', ['details' => $details]);
    }
    }
    public function view_contact($id,Request $request)
    {
    if($request->isMethod('get')){
    $details = Contacts::where('id',$id)->get();
    return view('view_contact', ['details' => $details]);
    }
    }
    public function view_document($id,Request $request)
    {
    if($request->isMethod('get')){
    $details = Documents::where('id',$id)->get();
    return view('view_document', ['details' => $details]);
    }
    }
    public function view_qulification($id,Request $request)
    {
    if($request->isMethod('get')){
    $details = Qulifications::where('id',$id)->get();
    return view('view_qulification', ['details' => $details]);
    }
    }
    public function view_work($id,Request $request)
    {
    if($request->isMethod('get')){
    $details = Works::where('id',$id)->get();
    return view('view_work', ['details' => $details]);
    }
    }
    public function view_core_hr_resignations($id,Request $request)
    {
    if($request->isMethod('get')){
    $details = CoreHRResignations::where('id',$id)->get();
    return view('view_core_hr_resignations', ['details' => $details]);
    }
    }
    public function view_core_hr_complaint($id,Request $request)
    {
    if($request->isMethod('get')){
    $details = CoreHRComplaints::where('id',$id)->get();
    return view('view_core_hr_complaint', ['details' => $details]);
    }
    }
    public function view_core_hr_warning($id,Request $request)
    {
    if($request->isMethod('get')){
    $details = CoreHRWarnings::where('id',$id)->get();
    return view('view_core_hr_warning', ['details' => $details]);
    }
    }
    public function view_core_hr_termination($id,Request $request)
    {
    if($request->isMethod('get')){
    $details = CoreHRTerminations::where('id',$id)->get();
    return view('view_core_hr_termination', ['details' => $details]);
    }
    }
    public function employee_leaves($id,Request $request)
    {
    if($request->isMethod('get')){
    $leaves = Leaves::where('employee',$id)->get();
    $leave_types = LeaveTypes::get();
    return view('employee-leaves', ['leaves' => $leaves,'leave_types' => $leave_types,'id' => $id]);
    }
    if($request->isMethod('post')){
        $this->validate($request, [
            'leave_type'   => 'required',
            'leave_duration'   => 'required',
            'discription'   => 'required',
            'remarks'   => 'required',
        ]);

        if($request->leave_type == "special"){
            if($request->leave_duration == "Full Day"){
                $start_date = $request->start_date;
                $end_date = $request->end_date;
                $morining_or_evening = null;
                $date = null;
                }
                else{
                $start_date = null;
                $end_date = null;
                $morining_or_evening = $request->morining_or_evening;
                $date = $request->date;
                }
                $department = OtherEmployeeDetails::where('user_id',$id)->value('department');
                $leave =  new Leaves();
                $leave->leave_type =$request->leave_type;
                $leave->department =$department;
                $leave->employee =$id;
                $leave->leave_duration =$request->leave_duration;
                $leave->start_date =$start_date;
                $leave->end_date =$end_date;
                $leave->morining_or_evening =$morining_or_evening;
                $leave->date =$date;
                $leave->discription =$request->discription;
                $leave->remarks =$request->remarks;
                $leave->status ="Pending";
                $leave->requested_date = date("Y-m-d");
                $leave->save();

                return back()->with('success', 'Leave Added');
        }
        else{
        // $leave_avilable_count = UserCustomLeaves::where('leave_type', $request->leave_type)->where('user_id', $id)->value('leave_count');
        $leave_avilable_count = LeaveTypes::where('id', $request->leave_type)->value('leave_count');
        $leave_avilablility = LeaveTypes::where('id', $request->leave_type)->value('leave_available');
        $current_leaves = Leaves::where('leave_type',$request->leave_type)->where('employee',$id)->get();
        if($current_leaves == null || $current_leaves->isEmpty()){
            if($request->leave_duration == "Full Day"){
                $start_date = $request->start_date;
                $end_date = $request->end_date;
                $morining_or_evening = null;
                $date = null;
                }
                else{
                $start_date = null;
                $end_date = null;
                $morining_or_evening = $request->morining_or_evening;
                $date = $request->date;
                }
                $department = OtherEmployeeDetails::where('user_id',$id)->value('department');
                $leave =  new Leaves();
                $leave->leave_type =$request->leave_type;
                $leave->department =$department;
                $leave->employee =$id;
                $leave->leave_duration =$request->leave_duration;
                $leave->start_date =$start_date;
                $leave->end_date =$end_date;
                $leave->morining_or_evening =$morining_or_evening;
                $leave->date =$date;
                $leave->discription =$request->discription;
                $leave->remarks =$request->remarks;
                $leave->status ="Pending";
                $leave->requested_date = date("Y-m-d");
                $leave->save();

                return back()->with('success', 'Leave Added');
        }
        else{
        if($leave_avilablility == "monthly"){
            $leave_count = 0;
           foreach($current_leaves as $current_leave){
            $currentDate = date("Y-m");
            $currentDate = date('Y-m', strtotime($currentDate));
            if($current_leave->leave_duration == "Full Day"){
                $leave_date = $current_leave->start_date;
            }
            else{
                $leave_date = $current_leave->date;
            }
            $reqDate = date('Y-m', strtotime($leave_date));
            if (($currentDate == $reqDate)){
            $leave_count = $leave_count+1;
            }
           }
           if( $leave_count < $leave_avilable_count){
            if($request->leave_duration == "Full Day"){
                $start_date = $request->start_date;
                $end_date = $request->end_date;
                $morining_or_evening = null;
                $date = null;
                }
                else{
                $start_date = null;
                $end_date = null;
                $morining_or_evening = $request->morining_or_evening;
                $date = $request->date;
                }
                $department = OtherEmployeeDetails::where('user_id',$id)->value('department');
                $leave =  new Leaves();
                $leave->leave_type =$request->leave_type;
                $leave->department =$department;
                $leave->employee =$id;
                $leave->leave_duration =$request->leave_duration;
                $leave->start_date =$start_date;
                $leave->end_date =$end_date;
                $leave->morining_or_evening =$morining_or_evening;
                $leave->date =$date;
                $leave->discription =$request->discription;
                $leave->remarks =$request->remarks;
                $leave->status ="Pending";
                $leave->requested_date = date("Y-m-d");
                $leave->save();

                return back()->with('success', 'Leave Added');
           }
           else{
            return back()->with('fail', 'Maximum leave amount reached');
           }
        }
        else{
            $leave_count = 0;
            foreach($current_leaves as $current_leave){
             $currentYear = date("Y");
             $currentYear = date('Y', strtotime($currentYear));
             if($current_leave->leave_duration == "Full Day"){
                $leave_date = $current_leave->start_date;
            }
            else{
                $leave_date = $current_leave->date;
            }
             $reqYear = date('Y', strtotime($leave_date));
             if (($currentYear == $reqYear)){
             $leave_count = $leave_count+1;
             }
            }
            if( $leave_count < $leave_avilable_count){
                if($request->leave_duration == "Full Day"){
                    $start_date = $request->start_date;
                    $end_date = $request->end_date;
                    $morining_or_evening = null;
                    $date = null;
                    }
                    else{
                    $start_date = null;
                    $end_date = null;
                    $morining_or_evening = $request->morining_or_evening;
                    $date = $request->date;
                    }
                    $department = OtherEmployeeDetails::where('user_id',$id)->value('department');
                    $leave =  new Leaves();
                    $leave->leave_type =$request->leave_type;
                    $leave->department =$department;
                    $leave->employee =$id;
                    $leave->leave_duration =$request->leave_duration;
                    $leave->start_date =$start_date;
                    $leave->end_date =$end_date;
                    $leave->morining_or_evening =$morining_or_evening;
                    $leave->date =$date;
                    $leave->discription =$request->discription;
                    $leave->remarks =$request->remarks;
                    $leave->status ="Pending";
                    $leave->requested_date = date("Y-m-d");
                    $leave->save();

                    return back()->with('success', 'Leave Added');
            }
            else{
             return back()->with('fail', 'Maximum leave amount reached');
            }
        }

        }

    }
    }

    }
    public function view_leave($id,Request $request)
    {
    if($request->isMethod('get')){
    $details = Leaves::where('id',$id)->get();
    return view('view_leave', ['details' => $details]);
    }
    }
    public function employee_project_tasks(Request $request)
    {
    if($request->isMethod('get')){
    $projects = PMProjects::get();
    $tasks = PMTasks::get();
    return view('employee_project_tasks', ['projects' => $projects, 'tasks' => $tasks]);
    }
    }
    public function view_project($id,Request $request)
    {
    if($request->isMethod('get')){
    $details = PMProjects::where('id',$id)->get();
    return view('view_project', ['details' => $details]);
    }
    }
    public function view_task($id,Request $request)
    {
    if($request->isMethod('get')){
    $details = PMTasks::where('id',$id)->get();
    return view('view_task', ['details' => $details]);
    }
    }
    public function employee_events(Request $request)
    {
    if($request->isMethod('get')){
    $events = Events::get();
    return view('employee_events', ['events' => $events]);
    }
    }
    public function employee_meetings(Request $request)
    {
    if($request->isMethod('get')){
    $meetings = Meetings::where('employee',Auth::user()->id)->get();
    return view('employee_meetings', ['meetings' => $meetings]);
    }
    }
    public function employee_training(Request $request)
    {
    if($request->isMethod('get')){
    $trainings = TrainingList::get();
    return view('employee_training', ['trainings' => $trainings]);
    }
    }
    public function blocked_users(Request $request)
    {
    if($request->isMethod('get')){
    $users = User::where('status','blocked')->get();
    return view('blocked_users', ['users' => $users]);
    }
    }
    public function unblock_user($id,Request $request)
    {
    $user = User::find($id);
    $user->status = "active";
    $user->login_attempts = null;
    $user->update();
    return back()->with('success', 'User Unblocked');
    }
    public function blocked_ips(Request $request)
    {
    if($request->isMethod('get')){
    $ips = BlockedIPS::get();
    return view('blocked_ips', ['ips' => $ips]);
    }
    }
    public function unblock_ip($id,Request $request)
    {
    $ip = BlockedIPS::find($id);
    $ip->delete();
    return back()->with('success', 'IP Unblocked');
    }
   public function download_pay_slip(Request $request, $id) {
    $request->validate([
        'year_month' => 'required|date_format:Y-m',
    ]);

    $yearMonth = $request->year_month;

    $basic_salary_record = BasicSalary::where('user_id', $id)
        ->where('month_year', $yearMonth)
        ->first();

    // If salary for requested month is not available, get the latest previous salary
    if (!$basic_salary_record) {
        $basic_salary_record = BasicSalary::where('user_id', $id)
            ->orderBy('month_year', 'desc')
            ->first();
    }

    $basic_salary = $basic_salary_record ? $basic_salary_record->basic_salary : "-";
    $allowances = Allowances::where('user_id',$id)
                    ->where('month_year', $yearMonth)
                    ->get();
    $commissions = Commissions::where('user_id',$id)
                     ->where('month_year', $yearMonth)
                     ->get();
    $loans = Loans::where('user_id',$id)
              ->where('month_year', 'like', $yearMonth.'%')
              ->get();
    $deductions = Deductions::where('user_id',$id)
                   ->where('month_year', $yearMonth)
                   ->get();
    $overtimes = Overtimes::where('user_id',$id)
                   ->where('month_year', $yearMonth)
                   ->get();
    $other_paymnets = OtherPaymnets::where('user_id',$id)
                          ->where('month_year', $yearMonth)
                          ->get();

    $login_details = User::where('id',$id)->get();
    $user_role = User::where('id',$id)->value('user_role');

    if($user_role == 2){
        $other_details = OtherHRManagerDetails::where('user_id',$id)->get();
    } elseif($user_role == 3){
        $other_details = OtherEmployeeDetails::where('user_id',$id)->get();
    } elseif($user_role == 5){
        $other_details = OtherHODDetails::where('user_id',$id)->get();
    } elseif($user_role == 6){
        $other_details = OtherAuthoriserDetails::where('user_id',$id)->get();
    }

    $pdf = PDF::loadView('pdf.pay-slip', [
        'basic_salary' => $basic_salary,
        'allowances' => $allowances,
        'commissions' => $commissions,
        'loans' => $loans,
        'deductions' => $deductions,
        'overtimes' => $overtimes,
        'other_paymnets' => $other_paymnets,
        'login_details' => $login_details,
        'other_details' => $other_details,
        'yearMonth' => $yearMonth // pass to view
    ]);

    return $pdf->download('Payment Slip - '.$id.'-'.$yearMonth.'.pdf');
}

    public function insert_records(Request $request)
    {

            $image_name = "defaul_admin.jpg";

            $status = 'inactive';
        for ($x = 0; $x <= 1000; $x++) {
           DB::beginTransaction();
           $user = User::create([
              "user_name" => "test123",
              "email" => "test123@gmail.com",
              "password" => Hash::make("123"),
              "user_role" => 3,
              "status" => $status
           ]);

           $userDetails = new OtherEmployeeDetails();
           $userDetails->user_id =$user->id;
           $userDetails->first_name = "first";
           $userDetails->last_name = "second";
           $userDetails->phone = "sd";
           $userDetails->dob = "dsad";
           $userDetails->gender = "sd";
           $userDetails->company = "sd";
           $userDetails->department ="sd";
           $userDetails->designation = "sd";
           $userDetails->office_shift = "sd";
           $userDetails->attendence_type = "sd";
           $userDetails->join_date = "sd";
           $userDetails->image = $image_name;
           $userDetails->save();
           DB::commit();
        }

    }

    
//     public function add_recruitment(Request $request)
//     {
//         if ($request->isMethod('get')) {
//             $job_posts = JobPosts::get();
//             return view('add-recruitment', compact('job_posts'));
//         }

//         if ($request->isMethod('post')) {
//             $request->validate([
//                 'job_post' => 'required',
//                 'name' => 'required',
//                 'phone' => 'required',
//                 'email' => 'required',
//                 'location' => 'required',
//                 'cv' => 'required|mimes:pdf'
//             ]);

//             // 1. Upload CV
//             $cv_name = time() . 'cv.' . $request->cv->extension();
//             $request->cv->move(public_path('recruitment_cvs'), $cv_name);
//             $fullPath = public_path('recruitment_cvs/' . $cv_name);

//             // 2. Save Basic Data to MySQL
//             $recruitment = new Recruitments();
//             $recruitment->job_post = $request->job_post;
//             $recruitment->name = $request->name;
//             $recruitment->phone = $request->phone;
//             $recruitment->email = $request->email;
//             $recruitment->location = $request->location;
//             $recruitment->cv = $cv_name;
//             $recruitment->save();

//             // 3. Extract Text from PDF
//             $cvText = $this->extractTextFromPDF($fullPath);
//             if (!$cvText) {
//                 // Fallback: Save without AI indexing if PDF is unreadable
//                 return back()->with('success', 'Recruitment added (CV text not readable for AI search)');
//             }

//             // 4. Analyze CV with AI (Extract Gender, Exp, Skills)
//             $data = $this->extractCVProfile($cvText);
            
//             if (empty($data)) {
//                 return back()->with('success', 'Recruitment added (AI analysis failed)');
//             }
            
//             $basicInfo = $data['basic_info'] ?? [];
//             $summary = $data['summary'] ?? [];
//             $skills = $summary['skills'] ?? [];
            
//             $extractedAddress = $basicInfo['address'] ?? $request->location;
            
            
//             $eduString = "";
//             foreach (($data['education'] ?? []) as $edu) {
//                 $eduString .= "{$edu['qualification']} from {$edu['institute']} ({$edu['year']}). ";
//             }

//             // Format Projects for Embedding Context
//             $projString = "";
//             foreach (($data['projects'] ?? []) as $proj) {
//                 $projString .= "Project: {$proj['name']} using {$proj['technologies']}. ";
//             }
            
            
//             $embeddingText = "Role: " . ($summary['role'] ?? 'Unknown') . ". " .
//                             "Location: " . $extractedAddress . ". " .
//                              "Experience: " . ($summary['total_experience_years'] ?? 0) . " years. " .
//                              "Education: " . $eduString .
//                              "Projects: " . $projString .
//                              "Skills: " . implode(', ', $skills) . ".";
                             
//             $embedding = $this->generateEmbedding($embeddingText);

//             // 5. Create Text for Embedding (Includes Role + Skills)
//             // $embeddingText = "Role: {$profile['role']}. Skills: " . implode(', ', $profile['skills']) . ".";
//             // $embedding = $this->generateEmbedding($embeddingText);

//             // if ($embedding) {
//             //     // 6. Store in Pinecone with Metadata
//             //     $this->storeInPinecone($recruitment->id, $embedding, [
//             //         'recruitment_id' => (int)$recruitment->id,
//             //         'role' => strtolower($profile['role']),
//             //         'years_experience' => (int)$profile['years_experience'],
//             //         'gender' => $profile['gender'] ?? any, // Storing Gender for filtering
//             //         'skills' => array_map('strtolower', $profile['skills']),
//             //     ]);
//             // }
            
//             if ($embedding) {
//                 // 7. Store in Pinecone (Rich Metadata)
//                 $this->storeInPinecone($recruitment->id, $embedding, [
//                     'recruitment_id' => (int)$recruitment->id,
//                     'role' => strtolower($summary['role'] ?? 'unknown'),
//                     'location' => $extractedAddress,
//                     'years_experience' => (float)($summary['total_experience_years'] ?? 0),
//                     'gender' => $summary['gender'] ?? 'any',
//                     'age' => (int)($basicInfo['calculated_age'] ?? 0), // Can filter by age now
//                     'skills' => array_map('strtolower', $skills),
//                     // We can verify candidate name/address against DB if needed in future
//                     'has_projects' => !empty($data['projects']),
//                     'has_degree' => !empty($data['education'])
//                 ]);

//             return back()->with('success', 'Recruitment added and indexed successfully');
//             }
//         }
//     }




    
    
//     // private function extractTextFromPDF($filePath)
//     // {

//     //     if (!file_exists($filePath)) {
//     //         \Log::error("PDF Extraction Failed: File does not exist at " . $filePath);
//     //         return null;
//     //     }

//     //     require_once app_path('Libraries/PdfParser/vendor/autoload.php');
    
//     //     try {
//     //         $parser = new \Smalot\PdfParser\Parser();
//     //         $pdf = $parser->parseFile($filePath);
//     //         $text = $pdf->getText();
    
//     //         if (empty(trim($text))) {
//     //             \Log::warning("PDF Extraction: File parsed but returned empty text. Path: " . $filePath);
//     //             return null;
//     //         }
//     //         return $text;
            
//     //     } catch (\Exception $e) {
//     //         \Log::error("PDF Extraction Failed: " . $e->getMessage() . " Path: " . $filePath);
//     //         return null;
//     //     }
//     // }
    
//     private function extractTextFromPDF($filePath)
//     {
//         require_once app_path('Libraries/PdfParser/vendor/autoload.php');
//         $parser = new \Smalot\PdfParser\Parser();
//         $pdf = $parser->parseFile($filePath);
//         return trim($pdf->getText());
//     }


// private function extractCVProfile($text)
//     {
//         // Increase limit to capture full work history
//         $truncated = substr($text, 0, 7500);
        
//         $prompt = <<<PROMPT
// You are an expert HR Data Scientist. Analyze the CV text.

// **CRITICAL INSTRUCTIONS:**
// 1. **Experience Calculation**: Look at every "Work Experience" entry. extract the start and end dates. Calculate the duration for each. Sum them up to get the TOTAL years. 
//   - Example: "Jan 2020 - Jan 2022" is 2 years.
//   - Example: "2023 - Present" uses the current year (2026).
//   - Return a float number (e.g. 2.5).

// 2. **Education Extraction**: Identify all Degrees, Diplomas, and Institute names.

// 3. **Gender**: Infer from pronouns or context.

// 4. **Address/Location**: Extract the candidate's current city and country. (e.g., "Colombo, Sri Lanka"). If not explicitly stated, infer from their most recent job location or phone number area code.

// Return JSON ONLY:
// {
//   "basic_info": {
//       "name": "Full Name",
//       "email": "Email",
//       "phone": "Phone",
//       "address": "City, Country",
//       "dob": "YYYY-MM-DD",
//       "calculated_age": number
//   },
//   "summary": {
//       "role": "Current Job Title",
//       "total_experience_years": number,
//       "gender": "Male/Female/any",
//       "skills": ["Skill1", "Skill2"]
//   },
//   "education": [
//       {
//           "institute": "Institute Name",
//           "qualification": "Degree/Diploma",
//           "year": "Year"
//       }
//   ],
//   "projects": [
//       {
//           "name": "Project Name",
//           "technologies": "Tech Stack",
//           "description": "Brief details"
//       }
//   ]
// }

// CV TEXT:
// {$truncated}
// PROMPT;

//         return $this->callOpenAIGPT($prompt);
//     }
    
    
//     private function callOpenAIGPT($prompt)
//     {
//         $response = Http::withToken(env('OPENAI_API_KEY'))
//             ->post('https://api.openai.com/v1/chat/completions', [
//                 'model' => 'gpt-4o-mini', // or gpt-3.5-turbo
//                 'messages' => [
//                     ['role' => 'system', 'content' => 'You output valid JSON only.'],
//                     ['role' => 'user', 'content' => $prompt],
//                 ],
//                 'temperature' => 0,
//             ]);

//         if (!$response->successful()) {
//             Log::error('OpenAI Error', ['body' => $response->body()]);
//             return null;
//         }

//         $content = $response->json('choices.0.message.content');
        
//         // Clean markdown code blocks if present (```json ... ```)
//         $content = preg_replace('/^```json\s*|\s*```$/', '', $content);
//         $data = json_decode($content, true);

//         return $data; // Returns null if decode fails
//     }



// private function buildProfileText($profile)
// {
//     return
//         "Role: {$profile['role']}. " .
//         "Experience: {$profile['years_experience']} years. " .
//         "Skills: " . implode(', ', $profile['skills']) . ".";
// }

    
    
//     private function generateEmbedding($text)
//     {
//         $response = Http::withToken(env('OPENAI_API_KEY'))
//             ->post('https://api.openai.com/v1/embeddings', [
//                 'model' => 'text-embedding-3-small',
//                 'input' => substr($text, 0, 8000), // OpenAI limit
//             ]);

//         return $response->successful() ? $response->json('data.0.embedding') : null;
//     }
    
    
//     private function summarizeCVForAI($text)
//     {
//         $prompt = "Act as an HR Database Agent. Extract and list the core profile from this text. 
//         Format:
//         Role: [Role Name]
//         Experience: [Years]
//         Gender: [Male/Female]
//         Skills: [List all technical and soft skills found]
//         CV TEXT: " . substr($text, 0, 6000);
    
//         $response = Http::withToken(env('OPENAI_API_KEY'))
//             ->post('https://api.openai.com/v1/chat/completions', [
//                 'model' => 'gpt-3.5-turbo',
//                 'messages' => [['role' => 'user', 'content' => $prompt]],
//                 'temperature' => 0,
//             ]);
    
//         return $response->successful() ? $response->json('choices.0.message.content') : $text;
//     }
        
    
//     private function storeInPinecone($id, $embedding, $metadata)
//     {
//         Http::withHeaders([
//             'Api-Key' => env('PINECONE_API_KEY'),
//             'Content-Type' => 'application/json',
//         ])->post(env('PINECONE_ENDPOINT') . '/vectors/upsert', [
//             'vectors' => [[
//                 'id' => "rec_" . $id,
//                 'values' => $embedding,
//                 'metadata' => $metadata,
//             ]]
//         ]);
//     }  



// ------------------------------------ current

//     public function add_recruitment(Request $request)
//     {
//         if ($request->isMethod('get')) {
//             $job_posts = JobPosts::get();
//             return view('add-recruitment', compact('job_posts'));
//         }

//         if ($request->isMethod('post')) {
//             $request->validate([
//                 'job_post' => 'required',
//                 'name' => 'required',
//                 'phone' => 'required',
//                 'email' => 'required',
//                 'location' => 'required',
//                 'cv' => 'required|mimes:pdf'
//             ]);

//             // 1. Upload CV
//             $cv_name = time() . 'cv.' . $request->cv->extension();
//             $request->cv->move(public_path('recruitment_cvs'), $cv_name);
//             $fullPath = public_path('recruitment_cvs/' . $cv_name);

//             // 2. Save Basic Data to MySQL
//             $recruitment = new Recruitments();
//             $recruitment->job_post = $request->job_post;
//             $recruitment->name = $request->name;
//             $recruitment->phone = $request->phone;
//             $recruitment->email = $request->email;
//             $recruitment->location = $request->location;
//             $recruitment->cv = $cv_name;
//             $recruitment->save();

//             // 3. Extract Text from PDF
//             $cvText = $this->extractTextFromPDF($fullPath);
//             if (!$cvText) {
//                 // Fallback: Save without AI indexing if PDF is unreadable
//                 return back()->with('success', 'Recruitment added (CV text not readable for AI search)');
//             }

//             // 4. Analyze CV with AI (Extract Gender, Exp, Skills)
//             $data = $this->extractCVProfile($cvText);

//             if (empty($data)) {
//                 return back()->with('success', 'Recruitment added (AI analysis failed)');
//             }

//             $basicInfo = $data['basic_info'] ?? [];
//             $summary = $data['summary'] ?? [];
//             $skills = $summary['skills'] ?? [];

//             $extractedAddress = $basicInfo['address'] ?? $request->location;


//             $eduString = "";
//             foreach (($data['education'] ?? []) as $edu) {
//                 $eduString .= "{$edu['qualification']} from {$edu['institute']} ({$edu['year']}). ";
//             }

//             // Format Projects for Embedding Context
//             $projString = "";
//             foreach (($data['projects'] ?? []) as $proj) {
//                 $projString .= "Project: {$proj['name']} using {$proj['technologies']}. ";
//             }


//             $embeddingText = "Name: " . ($basicInfo['name'] ?? $request->name) . ". " .
//                 "Role: " . ($summary['role'] ?? 'Unknown') . ". " .
//                 "Location: " . $extractedAddress . ". " .
//                 "Experience: " . ($summary['total_experience_years'] ?? 0) . " years. " .
//                 "Education: " . $eduString .
//                 "Projects: " . $projString .
//                 "Skills: " . implode(', ', $skills) . ".";

//             $embedding = $this->generateEmbedding($embeddingText);

//             if ($embedding) {
//                 // 7. Store in Pinecone (Rich Metadata)
//                 $this->storeInPinecone($recruitment->id, $embedding, [
//                     'recruitment_id' => (int) $recruitment->id,
//                     'name' => $basicInfo['name'] ?? $request->name,
//                     'role' => strtolower($summary['role'] ?? 'unknown'),
//                     'location' => $extractedAddress,
//                     'years_experience' => (float) ($summary['total_experience_years'] ?? 0),
//                     'gender' => $summary['gender'] ?? 'any',
//                     'age' => (int) ($basicInfo['calculated_age'] ?? 0), // Can filter by age now
//                     'skills' => array_map('strtolower', $skills),
//                     'education_level' => !empty($data['education']) ? 'Degree/Diploma' : 'None',
//                     'has_projects' => !empty($data['projects']),
//                     'has_degree' => !empty($data['education'])
//                 ]);

//                 return back()->with('success', 'Recruitment added and indexed successfully');
//             }
//         }
//     }


//     private function extractTextFromPDF($filePath)
//     {
//         require_once app_path('Libraries/PdfParser/vendor/autoload.php');
//         $parser = new \Smalot\PdfParser\Parser();
//         $pdf = $parser->parseFile($filePath);
//         return trim($pdf->getText());
//     }


//     private function extractCVProfile($text)
//     {
//         // Increase limit to capture full work history
//         $truncated = substr($text, 0, 7500);

//         $prompt = <<<PROMPT
// You are an expert HR Data Scientist. Analyze the CV text.

// **CRITICAL INSTRUCTIONS:**
// 1. **Experience Calculation**: Look at every "Work Experience" entry. extract the start and end dates. Calculate the duration for each. Sum them up to get the TOTAL years. 
//   - Example: "Jan 2020 - Jan 2022" is 2 years.
//   - Example: "2023 - Present" uses the current year (2026).
//   - Return a float number (e.g. 2.5).

// 2. **Age Calculation**: 
//   - Look for Date of Birth (DOB). Calculate age based on year 2026.
//   - Look for explicit mentions like "24 years old".
//   - If found, return pure integer. If NOT found, return 0.

// 3. **Education**: Identify all Degrees, Diplomas, and Institute names.

// 4. **Gender**: Infer from pronouns or context (e.g. "Military servie", "He/Him").

// 5. **Address/Location**: Extract the candidate's current city and country.

// Return JSON ONLY:
// {
//   "basic_info": {
//       "name": "Full Name",
//       "email": "Email",
//       "phone": "Phone",
//       "address": "City, Country",
//       "dob": "YYYY-MM-DD",
//       "calculated_age": number
//   },
//   "summary": {
//       "role": "Current Job Title",
//       "total_experience_years": number,
//       "gender": "Male/Female/any",
//       "skills": ["Skill1", "Skill2"]
//   },
//   "education": [
//       {
//           "institute": "Institute Name",
//           "qualification": "Degree/Diploma",
//           "year": "Year"
//       }
//   ],
//   "projects": [
//       {
//           "name": "Project Name",
//           "technologies": "Tech Stack",
//           "description": "Brief details"
//       }
//   ]
// }

// CV TEXT:
// {$truncated}
// PROMPT;

//         return $this->callOpenAIGPT($prompt);
//     }


//     private function callOpenAIGPT($prompt)
//     {
//         $response = Http::withToken(env('OPENAI_API_KEY'))
//             ->post('https://api.openai.com/v1/chat/completions', [
//                 'model' => 'gpt-4o-mini', // or gpt-3.5-turbo
//                 'messages' => [
//                     ['role' => 'system', 'content' => 'You output valid JSON only.'],
//                     ['role' => 'user', 'content' => $prompt],
//                 ],
//                 'temperature' => 0,
//             ]);

//         if (!$response->successful()) {
//             Log::error('OpenAI Error', ['body' => $response->body()]);
//             return null;
//         }

//         $content = $response->json('choices.0.message.content');

//         // Clean markdown code blocks if present (```json ... ```)
//         $content = preg_replace('/^```json\s*|\s*```$/', '', $content);
//         $data = json_decode($content, true);

//         return $data; // Returns null if decode fails
//     }



//     private function buildProfileText($profile)
//     {
//         return
//             "Role: {$profile['role']}. " .
//             "Experience: {$profile['years_experience']} years. " .
//             "Skills: " . implode(', ', $profile['skills']) . ".";
//     }



//     private function generateEmbedding($text)
//     {
//         $response = Http::withToken(env('OPENAI_API_KEY'))
//             ->post('https://api.openai.com/v1/embeddings', [
//                 'model' => 'text-embedding-3-small',
//                 'input' => substr($text, 0, 8000), // OpenAI limit
//             ]);

//         return $response->successful() ? $response->json('data.0.embedding') : null;
//     }


//     private function summarizeCVForAI($text)
//     {
//         $prompt = "Act as an HR Database Agent. Extract and list the core profile from this text. 
//         Format:
//         Role: [Role Name]
//         Experience: [Years]
//         Gender: [Male/Female]
//         Skills: [List all technical and soft skills found]
//         CV TEXT: " . substr($text, 0, 6000);

//         $response = Http::withToken(env('OPENAI_API_KEY'))
//             ->post('https://api.openai.com/v1/chat/completions', [
//                 'model' => 'gpt-3.5-turbo',
//                 'messages' => [['role' => 'user', 'content' => $prompt]],
//                 'temperature' => 0,
//             ]);

//         return $response->successful() ? $response->json('choices.0.message.content') : $text;
//     }


//     private function storeInPinecone($id, $embedding, $metadata)
//     {
//         Http::withHeaders([
//             'Api-Key' => env('PINECONE_API_KEY'),
//             'Content-Type' => 'application/json',
//         ])->post(env('PINECONE_ENDPOINT') . '/vectors/upsert', [
//                     'vectors' => [
//                         [
//                             'id' => "rec_" . $id,
//                             'values' => $embedding,
//                             'metadata' => $metadata,
//                         ]
//                     ]
//                 ]);
//     }



public function add_recruitment(Request $request)
    {
        if ($request->isMethod('get')) {
            $job_posts = JobPosts::get();
            return view('add-recruitment', ['job_posts' => $job_posts]);
        }

        if ($request->isMethod('post')) {
            $this->validate($request, [
                'job_post' => 'required',
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'location' => 'required',
                'cv' => 'required|mimes:pdf',
            ]);

            // 1. Upload CV
            $cv_name = time() . 'cv.' . $request->cv->extension();
            $request->cv->move(public_path('recruitment_cvs'), $cv_name);
            $fullPath = public_path('recruitment_cvs/' . $cv_name);

            // 2. Save Basic Data to MySQL
            $recruitment = new Recruitments();
            $recruitment->job_post = $request->job_post;
            $recruitment->name = $request->name;
            $recruitment->phone = $request->phone;
            $recruitment->email = $request->email;
            $recruitment->location = $request->location;
            $recruitment->cv = $cv_name;
            $recruitment->save();

            // 3. Extract Text from PDF
            $cvText = $this->extractTextFromPDF($fullPath);
            if (!$cvText) {
                return back()->with('success', 'Recruitment added (CV text not readable for AI search)');
            }

            // 4. Analyze CV with AI (Extract Gender, Exp, Skills, Education, etc.)
            $data = $this->extractCVProfile($cvText);

            if (empty($data)) {
                return back()->with('success', 'Recruitment added (AI analysis failed)');
            }

            $basicInfo = $data['basic_info'] ?? [];
            $summary = $data['summary'] ?? [];
            $skills = $summary['skills'] ?? [];
            $extractedAddress = $basicInfo['address'] ?? $request->location;

            // Format Education for Embedding Context
            $eduString = "";
            foreach (($data['education'] ?? []) as $edu) {
                $eduString .= "{$edu['qualification']} from {$edu['institute']} ({$edu['year']}). ";
            }

            // Format Projects for Embedding Context
            $projString = "";
            foreach (($data['projects'] ?? []) as $proj) {
                $projString .= "Project: {$proj['name']} using {$proj['technologies']}. ";
            }

            // 5. Build comprehensive embedding text for semantic search
            $embeddingText = "Name: " . ($basicInfo['name'] ?? $request->name) . ". " .
                "Role: " . ($summary['role'] ?? 'Unknown') . ". " .
                "Location: " . $extractedAddress . ". " .
                "Experience: " . ($summary['total_experience_years'] ?? 0) . " years. " .
                "University: " . ($summary['university'] ?? 'Not specified') . ". " .
                "Degree: " . ($summary['degree_program'] ?? 'Not specified') . ". " .
                "Education: " . $eduString .
                "Projects: " . $projString .
                "Skills: " . implode(', ', $skills) . ".";

            // 6. Generate Embedding
            $embedding = $this->generateEmbeddingWithCurl($embeddingText);

            if ($embedding) {
                // 7. Store in Pinecone with Rich Metadata
                $this->storeInPineconeWithCurl($recruitment->id, $embedding, [
                    'recruitment_id' => (int) $recruitment->id,
                    'name' => $basicInfo['name'] ?? $request->name,
                    'name_lowercase' => strtolower($basicInfo['name'] ?? $request->name),
                    'role' => strtolower($summary['role'] ?? 'unknown'),
                    'location' => $extractedAddress,
                    'years_experience' => (float) ($summary['total_experience_years'] ?? 0),
                    'gender' => $summary['gender'] ?? 'any',
                    'age' => (int) ($basicInfo['calculated_age'] ?? 0),
                    'skills' => array_map('strtolower', $skills),
                    'university' => strtolower($summary['university'] ?? ''),
                    'degree_program' => strtolower($summary['degree_program'] ?? ''),
                    'education_level' => !empty($data['education']) ? 'Degree/Diploma' : 'None',
                    'has_projects' => !empty($data['projects']),
                    'has_degree' => !empty($data['education']),
                    'cv_summary' => substr($embeddingText, 0, 500),
                ]);

                return back()->with('success', 'Recruitment added and indexed successfully');
            }

            return back()->with('success', 'Recruitment added (embedding generation failed)');
        }
    }
    
    
    
        private function extractTextFromPDF($filePath)
    {
        if (!file_exists($filePath)) {
            Log::error("PDF Extraction Failed: File does not exist at " . $filePath);
            return null;
        }

        require_once app_path('Libraries/PdfParser/vendor/autoload.php');

        try {
            $parser = new \Smalot\PdfParser\Parser();
            $pdf = $parser->parseFile($filePath);
            $text = $pdf->getText();

            if (empty(trim($text))) {
                Log::warning("PDF Extraction: File parsed but returned empty text. Path: " . $filePath);
                return null;
            }
            return trim($text);

        } catch (\Exception $e) {
            Log::error("PDF Extraction Failed: " . $e->getMessage() . " Path: " . $filePath);
            return null;
        }
    }


    private function extractCVProfile($text)
    {
        $truncated = substr($text, 0, 7500);

        $prompt = <<<PROMPT
You are an expert HR Data Scientist. Analyze the CV text.

**CRITICAL INSTRUCTIONS:**
1. **Experience Calculation**: Look at every "Work Experience" entry. extract the start and end dates. Calculate the duration for each. Sum them up to get the TOTAL years. 
   - Example: "Jan 2020 - Jan 2022" is 2 years.
   - Example: "2023 - Present" uses the current year (2026).
   - Return a float number (e.g. 2.5).

2. **Age Calculation**: 
   - Look for Date of Birth (DOB). Calculate age based on year 2026.
   - Look for explicit mentions like "24 years old".
   - If found, return pure integer. If NOT found, return 0.

3. **Education**: Identify all Degrees, Diplomas, and Institute names.
   - Extract the UNIVERSITY/INSTITUTE name (e.g., "NIBM", "University of Colombo", "MIT")
   - Extract the DEGREE PROGRAM name (e.g., "Computer Science", "Project Management", "Business Administration")

4. **Gender**: Infer from pronouns or context (e.g. "Military service", "He/Him").

5. **Address/Location**: Extract the candidate's current city and country.

Return JSON ONLY:
{
  "basic_info": {
      "name": "Full Name",
      "email": "Email",
      "phone": "Phone",
      "address": "City, Country",
      "dob": "YYYY-MM-DD",
      "calculated_age": number
  },
  "summary": {
      "role": "Current Job Title",
      "total_experience_years": number,
      "gender": "Male/Female/any",
      "skills": ["Skill1", "Skill2"],
      "university": "Primary University/Institute Name",
      "degree_program": "Degree or Diploma Program Name"
  },
  "education": [
      {
          "institute": "Institute Name",
          "qualification": "Degree/Diploma",
          "year": "Year"
      }
  ],
  "projects": [
      {
          "name": "Project Name",
          "technologies": "Tech Stack",
          "description": "Brief details"
      }
  ]
}

CV TEXT:
{$truncated}
PROMPT;

        return $this->callOpenAIWithCurl($prompt);
    }


    private function callOpenAIWithCurl($prompt)
    {
        $ch = curl_init();
        
        $postData = json_encode([
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'system', 'content' => 'You output valid JSON only.'],
                ['role' => 'user', 'content' => $prompt],
            ],
            'temperature' => 0,
            'max_tokens' => 500,
        ]);
        
        curl_setopt_array($ch, [
            CURLOPT_URL => 'https://api.openai.com/v1/chat/completions',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Authorization: Bearer ' . env('OPENAI_API_KEY'),
            ],
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_TIMEOUT => 60,
        ]);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);
        
        if ($curlError) {
            Log::error('OpenAI cURL Error', ['error' => $curlError]);
            return null;
        }
        
        if ($httpCode !== 200) {
            Log::error('OpenAI API Error', ['code' => $httpCode, 'response' => $response]);
            return null;
        }
        
        $data = json_decode($response, true);
        $content = $data['choices'][0]['message']['content'] ?? '';
        
        // Clean markdown code blocks if present (```json ... ```)
        $content = preg_replace('/^```json\s*|\s*```$/', '', trim($content));
        
        return json_decode($content, true);
    }


    private function generateEmbeddingWithCurl($text)
    {
        $ch = curl_init();
        
        $postData = json_encode([
            'model' => 'text-embedding-3-small',
            'input' => substr($text, 0, 8000), // OpenAI limit
        ]);
        
        curl_setopt_array($ch, [
            CURLOPT_URL => 'https://api.openai.com/v1/embeddings',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Authorization: Bearer ' . env('OPENAI_API_KEY'),
            ],
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_TIMEOUT => 30,
        ]);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);
        
        if ($curlError || $httpCode !== 200) {
            Log::error('OpenAI Embedding Error', [
                'error' => $curlError,
                'code' => $httpCode,
                'response' => $response
            ]);
            return null;
        }
        
        $data = json_decode($response, true);
        return $data['data'][0]['embedding'] ?? null;
    }

    /**
     * Store vector embedding and metadata in Pinecone using cURL
     */
    private function storeInPineconeWithCurl($id, $embedding, $metadata)
    {
        $ch = curl_init();
        
        $postData = json_encode([
            'vectors' => [
                [
                    'id' => 'rec_' . $id,
                    'values' => $embedding,
                    'metadata' => $metadata,
                ]
            ]
        ]);
        
        curl_setopt_array($ch, [
            CURLOPT_URL => env('PINECONE_ENDPOINT') . '/vectors/upsert',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Api-Key: ' . env('PINECONE_API_KEY'),
            ],
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_TIMEOUT => 30,
        ]);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);
        
        if ($curlError || $httpCode !== 200) {
            Log::error('Pinecone Upsert Error', [
                'error' => $curlError,
                'code' => $httpCode,
                'response' => $response
            ]);
            return false;
        }
        
        return true;
    }


    
    
    public function delete_recruitment($id){
        Recruitments::find($id)->delete();
        return back()->with('success', 'Recruitment Deleted');
    }
    public function edit_recruitment($id,Request $request)
    {

        if($request->isMethod('get')){
            $recruitment_details = Recruitments::where('id',$id)->get();
            $interview_updates = InterviewUpdates::where('recruitment_id',$id)->get();
            $other_updates = InterviewOtherUpdates::where('recruitment_id',$id)->get();
            return view('edit_recruitment', ['recruitment_details' => $recruitment_details,'interview_updates' => $interview_updates,
            'other_updates' => $other_updates]);
            }
        if($request->isMethod('post')){
        if($request->cv){
            $cv_name = time().'cv.'.$request->cv->extension();
            $request->cv->move(public_path('recruitment_cvs'), $cv_name);
            }
            else{
            $cv_name = Recruitments::where('id',$id)->value('cv');;
        }

        $recruitment =  Recruitments::where('id', '=', $id)->first();;
        $recruitment->name = $request->name;
        $recruitment->phone = $request->phone;
        $recruitment->email = $request->email;
        $recruitment->location = $request->location;
        $recruitment->cv = $cv_name;
        $recruitment->update();

        return back()->with('success', 'Recruitment  Details Successfully  Updated');
        }
    }
    public function add_interview_update($id,Request $request){
    $this->validate($request, [
            'title'   => 'required',
            'scheduled_by'   => 'required',
            'interview_time'   => 'required',
            'interviewer'   => 'required',
            'status'  => 'required',
            "notes" => "required",
    ]);

           $interview_update = new InterviewUpdates();
           $interview_update->recruitment_id =$id;
           $interview_update->title =$request->title;
           $interview_update->scheduled_by = $request->scheduled_by;
           $interview_update->interview_time = $request->interview_time;
           $interview_update->interviewer = $request->interviewer;
           $interview_update->status = $request->status;
           $interview_update->notes = $request->notes;
           $interview_update->save();

           return back()->with('success', 'Interview Update Successfully Added');

    }
    public function add_other_update($id,Request $request){
        $this->validate($request, [
                'title'   => 'required',
                'by'   => 'required',
                "notes" => "required",
        ]);

               $other_update = new InterviewOtherUpdates();
               $other_update->recruitment_id =$id;
               $other_update->title =$request->title;
               $other_update->c_by = $request->by;
               $other_update->notes = $request->notes;
               $other_update->save();

               return back()->with('success', 'Other Update Successfully Added');

        }
    public function edit_interview_update($id,Request $request)
    {
        if($request->isMethod('get')){
            $interview_details = InterviewUpdates::where('id',$id)->get();
            return view('edit_interview_update', ['interview_details' => $interview_details]);
            }
        if($request->isMethod('post')){

        $interview_update =  InterviewUpdates::where('id', '=', $id)->first();;
        $interview_update->title =$request->title;
        $interview_update->scheduled_by = $request->scheduled_by;
        $interview_update->interview_time = $request->interview_time;
        $interview_update->interviewer = $request->interviewer;
        $interview_update->status = $request->status;
        $interview_update->notes = $request->notes;
        $interview_update->update();

        return back()->with('success', 'Successfully  Updated');
        }
    }
    public function edit_interview_other_update($id,Request $request)
    {
        if($request->isMethod('get')){
            $interview_details = InterviewOtherUpdates::where('id',$id)->get();
            return view('edit_interview_other_update', ['interview_details' => $interview_details]);
            }
        if($request->isMethod('post')){

        $other_update =  InterviewOtherUpdates::where('id', '=', $id)->first();;
        $other_update->title =$request->title;
        $other_update->c_by = $request->by;
        $other_update->notes = $request->notes;
        $other_update->update();

        return back()->with('success', 'Successfully  Updated');
        }
    }

    public function employment_type_history(Request $request)
    {
    if($request->isMethod('get')){
    $employeement_types = EmploymentTypeHistory::get();
    $employees = OtherEmployeeDetails::get();
    return view('employment_type_history', ['employeement_types' => $employeement_types,'employees' => $employees]);
    }

    }
    public function change_employment_type(Request $request)
    {
    if($request->isMethod('get')){
    $employees = OtherEmployeeDetails::get();
    return view('change_employment_type', ['employees' => $employees]);
    }
    if($request->isMethod('post')){
    $this->validate($request, [
            'employee'   => 'required',
            'old_employment_type'   => 'required',
            'new_employment_type'   => 'required',
    ]);
    $employment_type_history = new EmploymentTypeHistory();
    $employment_type_history->employee =$request->employee;
    $employment_type_history->old_employment_type =$request->old_employment_type;
    $employment_type_history->new_employment_type =$request->new_employment_type;
    $employment_type_history->save();
    return back()->with('success', 'Employment Type Changed');
    }
    }
    public function user_add_check_in_time(Request $request)
    {
    if($request->isMethod('post')){
    $prevoius_day = date( "Y-m-d", strtotime(date("Y-m-d") . "-1 day"));
    $check_in_out_data = UserCheckInOutData::where('user_id',Auth::user()->id)->where('year_month_date',$prevoius_day)->orderBy('id', 'DESC')->first();
    if($check_in_out_data == null || $check_in_out_data->check_in_or_out == "check out"){
    $check_in = new UserCheckInOutData();
    $check_in->user_id =Auth::user()->id;
    $check_in->check_in_or_out ="check in";
    $check_in->year_month_date =date("Y-m-d");
    $check_in->time_ =date("h:i");
    $check_in->approved ="yes";
    $check_in->save();
    return back()->with('success_check', 'Check-In Time Added');
    }
    else{
    $check_in = new UserCheckInOutData();
    $check_in->user_id =Auth::user()->id;
    $check_in->check_in_or_out ="check in";
    $check_in->year_month_date =date("Y-m-d");
    $check_in->time_ =date("h:i");
    $check_in->approved ="yes";
    $check_in->save();
    return back()->with('success_check', 'Check-In Time Added (Please add the check-out time on previous day)');
    }
    }
    }
     public function user_add_check_out_time(Request $request)
    {
    if($request->isMethod('post')){

    $check_in = new UserCheckInOutData();
    $check_in->user_id =Auth::user()->id;
    $check_in->check_in_or_out ="check out";
    $check_in->year_month_date =date("Y-m-d");
    $check_in->time_ =date("h:i");
    $check_in->approved ="yes";
    $check_in->save();
    return back()->with('success_check', 'Check-Out Time Added');
    }
    }
    public function my_attendence_history(Request $request)
    {
    if($request->isMethod('get')){
    $attendences = UserCheckInOutData::where('user_id', Auth::user()->id)->where('approved','yes')->orderBy('id','DESC')->get();
    return view('my_attendence_history', ['attendences' => $attendences]);
    }

    }

    public function add_checkout_time(Request $request)
    {
    if($request->isMethod('get')){
    return view('add_checkout_time');
    }
    if($request->isMethod('post')){
     $this->validate($request, [
            'date'   => 'required',
             'time'   => 'required',
              'reason'   => 'required',
    ]);
    $check_in = new UserCheckInOutData();
    $check_in->user_id =Auth::user()->id;
    $check_in->check_in_or_out ="check out";
    $check_in->year_month_date =date('Y-m-d', strtotime($request->date));
    $check_in->time_ =$request->time;
    $check_in->reason =$request->reason;
    $check_in->approved ="no";
    $check_in->save();
    return back()->with('success', 'Check-Out Time Added');
    }
    }

    public function approve_user_checkout_time(Request $request)
    {
    if($request->isMethod('get')){
    $attendences = UserCheckInOutData::where('approved','no')->get();
    return view('approve_user_checkout_time', ['attendences' => $attendences]);
    }

    }
    public function accept_chekout_time($id){
        $check = UserCheckInOutData::find($id);
        $check->approved = "yes";
        $check->update();
        return back()->with('success', 'Check-Out Time Accepted');

    }
    public function reject_chekout_time($id){
        UserCheckInOutData::find($id)->delete();
        return back()->with('success', 'Check-Out Time Rejected');
    }
    public function authorisers()
    {
        $authorisers = User::where('user_role', '6')->orderBy('id')->get();
        return view('authorisers', ['authorisers' => $authorisers]);
    }
    public function add_authoriser(Request $request)
    { if($request->isMethod('get')){
         $hods = User::where('user_role', '5')->orderBy('id')->get();
        $hrms = User::where('user_role', '2')->orderBy('id')->get();
         $departments = OrganizationDepartments::orderBy('id')->get();
        return view('add_authoriser', ['hods' => $hods, 'hrms' => $hrms, 'departments' => $departments]);
    }
    if($request->isMethod('post')){
    $this->validate($request, [
            'name'   => 'required',
            'phone'   => 'required',
            'dob'   => 'required',
            'gender'   => 'required',
            'department'   => 'required',
            'employment_type'   => 'required',
            'epf_no'   => 'required',
            'appoinment_date'   => 'required',
            'latitude'   => 'required',
            'longitude'   => 'required',
            'responsible_person'   => 'required',
            'nic'   => 'required',
            'email'   => 'required | email | unique:users',
            'user_name'  => 'required | min:6 | unique:users',
            "password" => "required | confirmed | min:6",
           ]);

           if($request->image){
            $image_name = time().'authoriser.'.$request->image->extension();
           $request->image->move(public_path('user_images'), $image_name);
           }
           else{
            $image_name = "defaul_admin.jpg";
           }

           if($request->status){
            $status = 'active';
           }
           else{
            $status = 'inactive';
           }
           DB::beginTransaction();
           $user = User::create([
              "user_name" => $request->user_name,
              "email" => $request->email,
              "password" => Hash::make($request->password),
              "user_role" => 6,
              "status" => $status
           ]);

           $userDetails = new OtherAuthoriserDetails();
           $userDetails->user_id =$user->id;
           $userDetails->name = $request->name;
           $userDetails->phone = $request->phone;
            $userDetails->dob = $request->dob;
           $userDetails->gender = $request->gender;
           $userDetails->department = $request->department;
           $userDetails->employment_type = $request->employment_type;
           $userDetails->epf_no = $request->epf_no;
           $userDetails->appoinment_date = $request->appoinment_date;
           $userDetails->latitude = $request->latitude;
           $userDetails->longitude = $request->longitude;
           $userDetails->responsible_person = $request->responsible_person;
           $userDetails->image = $image_name;
           $userDetails->nic = $request->nic;
           $userDetails->save();
           DB::commit();
           return back()->with('success', 'Authoriser Successfully Added');

    }

    }
    public function deactivate_authoriser($id){
        $authoriser = User::find($id);
        $authoriser->status = "inactive";
        $authoriser->update();
        return back()->with('success', 'Authoriser Deactivated');

    }
    public function activate_authoriser($id){
        $authoriser = User::find($id);
        $authoriser->status = "active";
        $authoriser->update();
        return back()->with('success', 'Authoriser Activated');

    }
    public function edit_authoriser($id,Request $request)
    {
    if($request->isMethod('get')){
    $login_details = User::where('id',$id)->get();
    $other_details = OtherAuthoriserDetails::where('user_id',$id)->get();
    $designations = Designations::where('status', 'active')->orderBy('id')->get();
    $departments = OrganizationDepartments::orderBy('id')->get();
    $immigrations = Immigrations::where('user_id', $id)->orderBy('id')->get();
    $contacts = Contacts::where('user_id', $id)->orderBy('id')->get();
    $social_profile = SocialProfile::where('user_id', $id)->orderBy('id')->get();
    $documents = Documents::where('user_id', $id)->orderBy('id')->get();
    $qulifications = Qulifications::where('user_id', $id)->orderBy('id')->get();
    $works = Works::where('user_id', $id)->orderBy('id')->get();
    $bank_accounts = BankAccounts::where('user_id', $id)->orderBy('id')->get();
    $basic_salarys = BasicSalary::where('user_id', $id)->orderBy('id')->get();
    $allowances = Allowances::where('user_id', $id)->orderBy('id')->get();
    $commissions = Commissions::where('user_id', $id)->orderBy('id')->get();
    $loans = Loans::where('user_id', $id)->orderBy('id')->get();
    $deductions = Deductions::where('user_id', $id)->orderBy('id')->get();
    $payments = OtherPaymnets::where('user_id', $id)->orderBy('id')->get();
    $overtimes = Overtimes::where('user_id', $id)->orderBy('id')->get();
    $pensions = Pensions::where('user_id', $id)->orderBy('id')->get();
    $corehr_promotions = CoreHRPromotions::where('employee', $id)->orderBy('id')->get();
    $corehr_awrds = CoreHRAwards::where('employee', $id)->orderBy('id')->get();
    $corehr_travels = CoreHRTravel::where('employee', $id)->orderBy('id')->get();
    $corehr_transfers = CoreHRTransfer::where('employee', $id)->orderBy('id')->get();
    $corehr_resignations = CoreHRResignations::where('employee', $id)->orderBy('id')->get();
    $corehr_complaints = CoreHRComplaints::where('complaint_from', $id)->orderBy('id')->get();
    $corehr_warnings = CoreHRWarnings::where('employee', $id)->orderBy('id')->get();
    $corehr_terminations = CoreHRTerminations::where('employee', $id)->orderBy('id')->get();
    $projects = PMProjects::get();
    $tasks = PMTasks::get();
    $leaves = Leaves::where('employee',$id)->get();
    $hods = User::where('user_role', '5')->orderBy('id')->get();
    $hrms = User::where('user_role', '2')->orderBy('id')->get();
    $authorisers = User::where('user_role', '6')->orderBy('id')->get();
        return view('edit_authoriser', ['login_details' => $login_details, 'other_details' => $other_details,
        'designations' => $designations, 'departments' => $departments, 'immigrations' => $immigrations,
         'contacts' => $contacts,'social_profile' => $social_profile,'documents' => $documents,
         'qulifications' => $qulifications, 'works' => $works, 'bank_accounts' => $bank_accounts, 'basic_salarys' => $basic_salarys
         , 'allowances' => $allowances, 'commissions' => $commissions, 'loans' => $loans, 'deductions' => $deductions
         , 'payments' => $payments, 'overtimes' => $overtimes, 'pensions' => $pensions, 'corehr_promotions' => $corehr_promotions
         , 'corehr_awrds' => $corehr_awrds, 'corehr_travels' => $corehr_travels, 'corehr_transfers' => $corehr_transfers
         , 'corehr_resignations' => $corehr_resignations, 'corehr_complaints' => $corehr_complaints, 'corehr_warnings' => $corehr_warnings
         , 'corehr_terminations' => $corehr_terminations, 'projects' => $projects, 'tasks' => $tasks, 'leaves' => $leaves,
         'hods' => $hods, 'hrms' => $hrms, 'authorisers' => $authorisers]);
    }
    }
    public function edit_authoriser_basic($id,Request $request)
    {
    $this->validate($request, [
        'name'   => 'required',
        'phone'   => 'required',
        'dob'   => 'required',
            'gender'   => 'required',
            'department'   => 'required',
            'employment_type'   => 'required',
            'epf_no'   => 'required',
            'appoinment_date'   => 'required',
            'latitude'   => 'required',
            'longitude'   => 'required',
        'responsible_person'   => 'required',
        'email'   => 'required | email',
        'user_name'  => 'required | min:6',
    ]);
    if($request->status){
        $status = 'active';
    }
    else{
        $status = 'inactive';
    }


    if(!$request->current_password == null || !$request->password == null || !$request->password_confirmation == null){
        $this->validate($request, [
            "password" => "required | confirmed | min:6",
            "current_password" => "required",
           ]);
           if (Hash::check($request->input('current_password'), User::where('id', $id)->value('password'))) {
            if(User::where("id", "=", $id)->where("email", "=", $request->email)->exists()){
                $email = $request->email;
            }
            elseif(User::where("email", "=", $request->email)->exists()){
             return back()->with('fail', 'This email is already in use');
            }
            else{
             $email = $request->email;
            }
            if(User::where("id", "=", $id)->where("user_name", "=", $request->user_name)->exists()){
                $user_name = $request->user_name;
                }
               elseif(User::where("user_name", "=", $request->user_name)->exists()){
               return back()->with('fail', 'This user name is already in use');
               }
               else{
                $user_name = $request->user_name;
               }
            $userDetails =  OtherAuthoriserDetails::where('user_id', '=', $id)->first();;
            $userDetails->name = $request->name;
            $userDetails->phone = $request->phone;
             $userDetails->dob = $request->dob;
           $userDetails->gender = $request->gender;
           $userDetails->department = $request->department;
           $userDetails->employment_type = $request->employment_type;
           $userDetails->epf_no = $request->epf_no;
           $userDetails->appoinment_date = $request->appoinment_date;
           $userDetails->latitude = $request->latitude;
           $userDetails->longitude = $request->longitude;
            $userDetails->responsible_person = $request->responsible_person;
             $userDetails->nic = $request->nic;
            $userDetails->update();
            $user = User::find($id);
            $user->email = $email;
            $user->password = Hash::make($request->input('password'));
            $user->user_name = $user_name;
            $user->status = $status;
            $user->update();
            return back()->with('success', 'Authoriser Details Successfully  Updated');
           }
           else{
            return back()->with('fail', 'Current password is incorrect.');
        }
    }
    else{
        if(User::where("id", "=", $id)->where("email", "=", $request->email)->exists()){
            $email = $request->email;
        }
        elseif(User::where("email", "=", $request->email)->exists()){
         return back()->with('fail', 'This email is already in use');
        }
        else{
         $email = $request->email;
        }
        if(User::where("id", "=", $id)->where("user_name", "=", $request->user_name)->exists()){
            $user_name = $request->user_name;
            }
           elseif(User::where("user_name", "=", $request->user_name)->exists()){
           return back()->with('fail', 'This user name is already in use');
           }
           else{
            $user_name = $request->user_name;
           }
        $userDetails =  OtherAuthoriserDetails::where('user_id', '=', $id)->first();;
        $userDetails->name = $request->name;
        $userDetails->phone = $request->phone;
         $userDetails->dob = $request->dob;
           $userDetails->gender = $request->gender;
           $userDetails->department = $request->department;
           $userDetails->employment_type = $request->employment_type;
           $userDetails->epf_no = $request->epf_no;
           $userDetails->appoinment_date = $request->appoinment_date;
           $userDetails->latitude = $request->latitude;
           $userDetails->longitude = $request->longitude;
        $userDetails->responsible_person = $request->responsible_person;
 $userDetails->nic = $request->nic;
        $userDetails->update();
        $user = User::find($id);
        $user->email = $email;
        $user->user_name = $user_name;
        $user->status = $status;
        $user->update();
        return back()->with('success', 'Authoriser Details Successfully  Updated');
    }

    }
public function change_authoriser_image($id,Request $request)
    {
        $image_name = time().'authoriser.'.$request->image->extension();
        $request->image->move(public_path('user_images'), $image_name);

        $change_image =  OtherAuthoriserDetails::where('user_id', '=', $id)->first();;
        $change_image->image =$image_name;
        $change_image->update();
        return back()->with('success', 'Authoriser Profile Picture  Updated');

    }
    public function employee_report(Request $request)
    {
    if($request->isMethod('get')){
     $employees = User::get();
    $departments = OrganizationDepartments::orderBy('id')->get();
    return view('employee_report', ['employees' => $employees, 'departments' => $departments]);
    }
    if($request->isMethod('post')){
       if(!$request->department && !$request->employment_type){
          return back()->with('fail', 'Please select at least one option');
       }
       else{
            $employees = User::get();
            $employee_header = ['Employee Details', '', '', '', ''];
            if($request->employee_name_check){
                $name_header = "Employee Name";
            }
            else{
                $name_header = " ";
            }
            if($request->epf_no_check){
             $epf_header = "EPF No";
            }
            else{
             $epf_header = " ";
            }
            if($request->employment_type_check){
             $emp_type_header = "Employment Type";
            }
            else{
             $emp_type_header = " ";
            }
            if($request->appointment_date_check){
             $app_date_header = "Appointment Date";
            }
            else{
             $app_date_header = " ";
            }
            if($request->email_check){
              $email_header = "Email";
            }
            else{
             $email_header = " ";
            }
            if($request->phone_check){
             $phone_header = "Phone Number";
            }
            else{
             $phone_header = " ";
            }
             if($request->birthday_check){
              $dob_header = "Birthday";
            }
            else{
             $dob_header = " ";
            }
            if($request->department_check){
            $dep_header = "Department";
            }
            else{
             $dep_header = " ";
            }
            $employee_header2 = [$name_header, $epf_header, $emp_type_header, $app_date_header, $email_header, $phone_header, $dob_header, $dep_header];
            $employee_header3 = [''];
            $employee_header4 = [''];
            $title_array[] = array();
            foreach($employees as $employee){
                $user_role = $employee->user_role;
                $email = $employee->email;
                if($user_role == 2){
                $employee_name = OtherHRManagerDetails::where('user_id',$employee->id)->value('first_name').' '.OtherHRManagerDetails::where('user_id',$employee->id)->value('last_name');
                $epf_no = OtherHRManagerDetails::where('user_id',$employee->id)->value('epf_no');
                $department = OtherHRManagerDetails::where('user_id',$employee->id)->value('department');
                $employment_type = OtherHRManagerDetails::where('user_id',$employee->id)->value('employment_type');
                $department_name = OrganizationDepartments::where('id', $department)->value('department');
                $department_location = OrganizationDepartments::where('id', $department)->value('location');
                $selected_location_name =  OrganizationLocations::where('id', $department_location)->value('location');
                $final_location_data = $department_name.' ('.$selected_location_name.')';
                $appoinment_date = OtherHRManagerDetails::where('user_id',$employee->id)->value('appoinment_date');
                $phone = OtherHRManagerDetails::where('user_id',$employee->id)->value('phone');
                $dob = OtherHRManagerDetails::where('user_id',$employee->id)->value('dob');
                }
                if($user_role == 3){
                $employee_name = OtherEmployeeDetails::where('user_id',$employee->id)->value('first_name').' '. OtherEmployeeDetails::where('user_id', $employee->id)->value('last_name');
                $epf_no = OtherEmployeeDetails::where('user_id',$employee->id)->value('epf_no');
                $department = OtherEmployeeDetails::where('user_id',$employee->id)->value('department');
                $employment_type = OtherEmployeeDetails::where('user_id',$employee->id)->value('employment_type');
                $department_name = OrganizationDepartments::where('id', $department)->value('department');
                $department_location = OrganizationDepartments::where('id', $department)->value('location');
                $selected_location_name =  OrganizationLocations::where('id', $department_location)->value('location');
                $final_location_data = $department_name.' ('.$selected_location_name.')';
                $appoinment_date = OtherEmployeeDetails::where('user_id',$employee->id)->value('appoinment_date');
                $phone = OtherEmployeeDetails::where('user_id',$employee->id)->value('phone');
                $dob = OtherEmployeeDetails::where('user_id',$employee->id)->value('dob');
                }
                if($user_role == 5){
                $employee_name = OtherHODDetails::where('user_id',$employee->id)->value('name');
                 $epf_no = OtherHODDetails::where('user_id',$employee->id)->value('epf_no');
                $department = OtherHODDetails::where('user_id',$employee->id)->value('department');
                $employment_type = OtherHODDetails::where('user_id',$employee->id)->value('employment_type');
                $department_name = OrganizationDepartments::where('id', $department)->value('department');
                $department_location = OrganizationDepartments::where('id', $department)->value('location');
                $selected_location_name =  OrganizationLocations::where('id', $department_location)->value('location');
                $final_location_data = $department_name.' ('.$selected_location_name.')';
                $appoinment_date = OtherHODDetails::where('user_id',$employee->id)->value('appoinment_date');
                $phone = OtherHODDetails::where('user_id',$employee->id)->value('phone');
                $dob = OtherHODDetails::where('user_id',$employee->id)->value('dob');
                }
                if($user_role ==6){
                $employee_name = OtherAuthoriserDetails::where('user_id',$employee->id)->value('name');
                $epf_no = OtherAuthoriserDetails::where('user_id',$employee->id)->value('epf_no');
                $department = OtherAuthoriserDetails::where('user_id',$employee->id)->value('department');
                $employment_type = OtherAuthoriserDetails::where('user_id',$employee->id)->value('employment_type');
                $department_name = OrganizationDepartments::where('id', $department)->value('department');
                $department_location = OrganizationDepartments::where('id', $department)->value('location');
                $selected_location_name =  OrganizationLocations::where('id', $department_location)->value('location');
                $final_location_data = $department_name.' ('.$selected_location_name.')';
                $appoinment_date = OtherAuthoriserDetails::where('user_id',$employee->id)->value('appoinment_date');
                $phone = OtherAuthoriserDetails::where('user_id',$employee->id)->value('phone');
                $dob = OtherAuthoriserDetails::where('user_id',$employee->id)->value('dob');
                }
            if($request->employee_name_check){
                $employee_name_data = $employee_name;
            }
            else{
                $employee_name_data = " ";
            }
            if($request->epf_no_check){
             $epf_no_data = $epf_no;
            }
            else{
             $epf_no_data = " ";
            }
            if($request->employment_type_check){
             $employment_type_data = $employment_type;
            }
            else{
             $employment_type_data = " ";
            }
            if($request->appointment_date_check){
             $appoinment_date_data = $appoinment_date;
            }
            else{
             $appoinment_date_data = " ";
            }
            if($request->email_check){
              $email_data = $email;
            }
            else{
             $email_data = " ";
            }
            if($request->phone_check){
             $phone_data = $phone;
            }
            else{
             $phone_data = " ";
            }
             if($request->birthday_check){
              $dob_data = $dob;
            }
            else{
             $dob_data = " ";
            }
            if($request->department_check){
            $final_location_data = $final_location_data;
            }
            else{
             $final_location_data = " ";
            }
                if(!$request->employment_type){
                    if($request->department  == $department){

                     $title_array[] = array(
                    'Employee Name '  => $employee_name_data,
                    'EPF No'   => $epf_no_data,
                    'Employment Type'    => $employment_type_data,
                    'Appointment Date'  => $appoinment_date_data,
                    'Email'   => $email_data,
                    'Phone Number'   => $phone_data,
                    'Birthday'   => $dob_data,
                    'Department'   => $final_location_data,
                   );
                }


                }
                if(!$request->department){
                    if($request->employment_type  == $employment_type){
                     $title_array[] = array(
                    'Employee Name '  => $employee_name_data,
                    'EPF No'   => $epf_no_data,
                    'Employment Type'    => $employment_type_data,
                    'Appointment Date'  => $appoinment_date_data,
                    'Email'   => $email_data,
                    'Phone Number'   => $phone_data,
                    'Birthday'   => $dob_data,
                    'Department'   => $final_location_data,
                   );
                }

                }
                if($request->employment_type && $request->department){
                if($request->employment_type  == $employment_type && $request->department  == $department){
                     $title_array[] = array(
                    'Employee Name '  => $employee_name_data,
                    'EPF No'   => $epf_no_data,
                    'Employment Type'    => $employment_type_data,
                    'Appointment Date'  => $appoinment_date_data,
                    'Email'   => $email_data,
                    'Phone Number'   => $phone_data,
                    'Birthday'   => $dob_data,
                    'Department'   => $final_location_data,
                   );
                }

                }

            }

        $csv = Writer::createFromString('');

        //insert the header
        $csv->insertOne($employee_header);
        $csv->insertOne($employee_header2);
        //insert all the records
        $csv->insertAll($title_array);
        $csv->insertOne($employee_header3);
        $csv->insertOne($employee_header4);
        $csv->output('Employee Report ('.date("Y-m-d H:i:s").').csv');
       }
    }
    }
  public function leave_report(Request $request)
{
    if ($request->isMethod('get')) {
        $departments = OrganizationDepartments::orderBy('id')->get();
        return view('leave_report', ['departments' => $departments]);
    }

    if ($request->isMethod('post')) {

        $request->validate([
            'department' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'download_type' => 'required|in:csv,pdf'
        ]);

        $departmentId = $request->department;
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        // Get leaves within date range
        $leaves = Leaves::whereBetween('requested_date', [$startDate, $endDate])->get();
        $users = User::all();

        $leave_data = [];
        $leave_summary = [];

        // 1) DETAILED LEAVE DATA
        foreach ($leaves as $leave) {
            $employee_name = '';
            $epf_no = '';
            $department = null;

            $user_role = User::where('id', $leave->employee)->value('user_role');

            // Leave type
            $leave_type = ($leave->leave_type == "special")
                ? "Special"
                : LeaveTypes::where('id', $leave->leave_type)->value('leave_type');

            // Get employee details by role
            $details = null;

            if ($user_role == 2) {
                $details = OtherHRManagerDetails::where('user_id', $leave->employee)->first();
            } elseif ($user_role == 3) {
                $details = OtherEmployeeDetails::where('user_id', $leave->employee)->first();
            } elseif ($user_role == 5) {
                $details = OtherHODDetails::where('user_id', $leave->employee)->first();
            } elseif ($user_role == 6) {
                $details = OtherAuthoriserDetails::where('user_id', $leave->employee)->first();
            }

            if ($details) {
                $employee_name = ($details->first_name ?? '') . ' ' . ($details->last_name ?? '');
                $epf_no = $details->epf_no;
                $department = $details->department;
            }

            if ($department && $departmentId == $department) {
                $leave_data[] = [
                    'employee' => trim($employee_name),
                    'epf' => $epf_no,
                    'type' => $leave_type
                ];
            }
        }

        // 2) LEAVE SUMMARY (TOTAL LEAVES PER EMPLOYEE)
        foreach ($users as $user) {

            $details = null;
            if ($user->user_role == 2) {
                $details = OtherHRManagerDetails::where('user_id', $user->id)->first();
            } elseif ($user->user_role == 3) {
                $details = OtherEmployeeDetails::where('user_id', $user->id)->first();
            } elseif ($user->user_role == 5) {
                $details = OtherHODDetails::where('user_id', $user->id)->first();
            } elseif ($user->user_role == 6) {
                $details = OtherAuthoriserDetails::where('user_id', $user->id)->first();
            }

            if (!$details) continue;

            $department2 = $details->department;
            $employee_name2 = ($details->first_name ?? '') . ' ' . ($details->last_name ?? '');
            $epf_no2 = $details->epf_no;

            if ($departmentId == $department2) {
                $total = Leaves::where('employee', $user->id)
                    ->whereBetween('requested_date', [$startDate, $endDate])
                    ->count();

                $leave_summary[] = [
                    'employee' => trim($employee_name2),
                    'epf' => $epf_no2,
                    'total' => $total
                ];
            }
        }

        // **********************************************
        //  *************** CSV DOWNLOAD *****************
        // **********************************************
        if ($request->download_type == 'csv') {

            $csv = Writer::createFromString('');

            $csv->insertOne(['Leave Details']);
            $csv->insertOne(['Employee Name', 'EPF No', 'Leave Type']);
            $csv->insertAll($leave_data);

            $csv->insertOne(['']);
            $csv->insertOne(['Total Leave Count']);
            $csv->insertOne(['Employee Name', 'EPF No', 'Total Leaves']);
            $csv->insertAll($leave_summary);

            return $csv->output('Leave Report (' . date("Y-m-d H:i:s") . ').csv');
        }

        // **********************************************
        //  *************** PDF DOWNLOAD *****************
        // **********************************************
        if ($request->download_type == 'pdf') {

            $pdf = Pdf::loadView('pdf.leave_report_pdf', [
                'leave_data' => $leave_data,
                'leave_summary' => $leave_summary,
                'startDate' => $startDate,
                'endDate' => $endDate
            ])->setPaper('A4', 'portrait');

            return $pdf->download('Leave_Report_' . date('Y-m-d') . '.pdf');
        }
    }
}


    /*public function leave_report(Request $request)
    {
    if($request->isMethod('get')){
    $departments = OrganizationDepartments::orderBy('id')->get();
    return view('leave_report', ['departments' => $departments]);
    }
    if($request->isMethod('post')){
       if(!$request->department){
          return back()->with('fail', 'Please select at least one option');
       }
       else{
            $users = User::get();
            $leave_header = ['Leave Details', '', '', '', ''];
            $leave_header2 = ["Employee Name", "EPF No", "Leave Type", "Leave Count Total"];
            $leave_header3 = [''];
            $leave_header4 = [''];
            $title_array1[] = array();
            $title_array2[] = array();
             $title_array3[] = array();
            foreach($users as $user){
                $user_role = $user->user_role;
                $leaves = Leaves::where('employee', $user->id)->get();
                if($leaves != null){
                if($user_role == 2){
                $employee_name = OtherHRManagerDetails::where('user_id',$user->id)->value('first_name').' '.OtherHRManagerDetails::where('user_id',$user->id)->value('last_name');
                $epf_no = OtherHRManagerDetails::where('user_id',$user->id)->value('epf_no');
                $department = OtherHRManagerDetails::where('user_id',$user->id)->value('department');
                }
                if($user_role == 3){
                $employee_name = OtherEmployeeDetails::where('user_id', $user->id)->value('first_name').' '. OtherEmployeeDetails::where('user_id', $user->id)->value('last_name');
                $epf_no = OtherEmployeeDetails::where('user_id',$user->id)->value('epf_no');
                $department = OtherEmployeeDetails::where('user_id',$user->id)->value('department');
                }
                if($user_role == 5){
                $employee_name = OtherHODDetails::where('user_id',$user->id)->value('name');
                 $epf_no = OtherHODDetails::where('user_id',$user->id)->value('epf_no');
                $department = OtherHODDetails::where('user_id',$user->id)->value('department');
                }
                if($user_role ==6){
                $employee_name = OtherAuthoriserDetails::where('user_id',$user->id)->value('name');
                $epf_no = OtherAuthoriserDetails::where('user_id',$user->id)->value('epf_no');
                $department = OtherAuthoriserDetails::where('user_id',$user->id)->value('department');
                }

                if($request->department  == $department){
                    $title_array1[] = array(
                    'Employee Name '  => $employee_name,
                    'EPF No'  => $epf_no,
                    'Leave Type'  => "",
                    'Leave Count'  => "",
                    'Leave Count Total'  => "",
                    );

                foreach($leaves as $leave){
                if($leave->leave_type == "special"){
                    $leave_type= "special";
                }
                else{
                    $leave_type = LeaveTypes::where('id',$leave->leave_type)->value('leave_type');
                }

                     $title_array2[] = array(
                    'Employee Name '  => "",
                    'EPF No'   => " ",
                    'Leave Type'    => $leave_type,
                    'Leave Count'    => "1",
                    'Leave Count Total'    => "",
                   );
                    }
                    $title_array3[] = array(
                    'Employee Name '  => "",
                    'EPF No'   => " ",
                    'Leave Type'    => "",
                    'Leave Count'    => "",
                    'Leave Count Total'    => "",
                   );
                }
                }

            }
            d
        $csv = Writer::createFromString('');

        //insert the header
        $csv->insertOne($leave_header);
        $csv->insertOne($leave_header2);
        //insert all the records
        $csv->insertAll($title_array1);
        $csv->insertAll($title_array2);
        $csv->insertAll($title_array3);
        $csv->insertOne($leave_header3);
        $csv->insertOne($leave_header4);
        $csv->output('Leave Report ('.date("Y-m-d H:i:s").').csv');
       }
    }
    }*/
   public function sallary_report(Request $request)
{
    if ($request->isMethod('get')) {
        $departments = OrganizationDepartments::orderBy('id')->get();
        return view('sallary_report', ['departments' => $departments]);
    }

    if ($request->isMethod('post')) {

        $request->validate([
            'department' => 'required',
            'year_month' => 'required|date_format:Y-m',
            'format' => 'required|in:csv,pdf'
        ]);

        $departmentId = $request->department;
        $yearMonth = $request->year_month;
        $format = $request->format;

        $users = User::get();
        $titleArray = [];

        foreach ($users as $user) {
            $employee_name = $epf_no = '';
            $department = null;

            switch ($user->user_role) {
                case 2:
                    $details = OtherHRManagerDetails::where('user_id', $user->id)->first();
                    break;
                case 3:
                    $details = OtherEmployeeDetails::where('user_id', $user->id)->first();
                    break;
                case 5:
                    $details = OtherHODDetails::where('user_id', $user->id)->first();
                    break;
                case 6:
                    $details = OtherAuthoriserDetails::where('user_id', $user->id)->first();
                    break;
                default:
                    $details = null;
            }

            if ($details) {
                $employee_name = $details->first_name ?? $details->name . ' ' . ($details->last_name ?? '');
                $epf_no = $details->epf_no;
                $department = $details->department;
            }

            if ($departmentId != $department) continue;

            // Basic Salary
            $basic_salary = BasicSalary::where('user_id', $user->id)
                ->where('month_year', $yearMonth)
                ->value('basic_salary');

            if (!$basic_salary) {
                $latest = BasicSalary::where('user_id', $user->id)
                    ->orderBy('month_year', 'desc')
                    ->first();
                $basic_salary = $latest ? $latest->basic_salary : 0;
            }

            // Deductions
            $total_deductions = Deductions::where('user_id', $user->id)
                ->where('month_year', $yearMonth)
                ->sum('amount');

            // Loans
            foreach (Loans::where('user_id', $user->id)->get() as $loan) {
                if (date('Y', strtotime($loan->month_year)) == date('Y', strtotime($yearMonth))) {
                    $total_deductions += ($loan->amount / $loan->number_of_installments);
                }
            }

            // Other payments
            $total_deductions += OtherPaymnets::where('user_id', $user->id)
                ->where('month_year', $yearMonth)
                ->sum('amount');

            // EPF 8%
            $total_deductions += ($basic_salary * 0.08);

            // Allowances
            $total_allowances = Allowances::where('user_id', $user->id)
                ->where('month_year', $yearMonth)
                ->sum('allowance_amount');

            $total_allowances += Commissions::where('user_id', $user->id)
                ->where('month_year', $yearMonth)
                ->sum('commission_amount');

            foreach (Overtimes::where('user_id', $user->id)->where('month_year', $yearMonth)->get() as $ot) {
                $total_allowances += ($ot->total_hours * $ot->rate);
            }

            $net_salary = ($basic_salary - $total_deductions) + $total_allowances;

            $titleArray[] = [
                'employee_name' => $employee_name,
                'epf_no' => $epf_no,
                'basic_salary' => $basic_salary,
                'total_deductions' => $total_deductions,
                'total_allowances' => $total_allowances,
                'net_salary' => $net_salary,
            ];
        }

        # --------------------------------------
        # 📌 If format = CSV
        # --------------------------------------
        if ($format == 'csv') {

            $csv = Writer::createFromString('');
            $csv->insertOne(['Salary Report - ' . $yearMonth]);
            $csv->insertOne(["Employee Name", "EPF No", "Basic Salary", "Total Deductions", "Total Allowances", "Net Salary"]);
            $csv->insertAll($titleArray);

            return $csv->output('Salary Report - ' . $yearMonth . '.csv');
        }

        # --------------------------------------
        # 📌 If format = PDF (DomPDF)
        # --------------------------------------
        if ($format == 'pdf') {

            $pdf = Pdf::loadView('pdf.salary_report_pdf', [
                'yearMonth' => $yearMonth,
                'data' => $titleArray,
            ])->setPaper('A4', 'portrait');

            return $pdf->download('Salary Report - ' . $yearMonth . '.pdf');
        }
    }
}
 public function attendance_report(Request $request)
{
    if ($request->isMethod('get')) {

        $hrms = User::where('user_role', 2)->get();
        $employees = User::where('user_role', 3)->get();
        $hods = User::where('user_role', 5)->get();
        $authorizers = User::where('user_role', 6)->get();

        return view('attendance_report', [
            'hrms' => $hrms,
            'employees' => $employees,
            'hods' => $hods,
            'authorizers' => $authorizers
        ]);
    }

    if ($request->isMethod('post')) {

        // Validate input
        $request->validate([
            'employee' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'export_type' => 'required|in:csv,pdf'
        ]);

        $employee_id = $request->employee;
        $start = $request->start_date;
        $end = $request->end_date;

        // Fetch attendance
        $attendance_list = UserCheckInOutData::where('user_id', $employee_id)
            ->where('approved', 'yes')
            ->whereDate('year_month_date', '>=', $start)
            ->whereDate('year_month_date', '<=', $end)
            ->orderBy('year_month_date', 'ASC')
            ->get();

        if ($attendance_list->count() == 0) {
            return back()->with('fail', 'No attendance records found for selected date range.');
        }

        $first = OtherEmployeeDetails::where('user_id', $employee_id)->value('first_name');
        $last = OtherEmployeeDetails::where('user_id', $employee_id)->value('last_name');
        $employee_name = $first . ' ' . $last;

        // ----------------------------------------------------------
        // EXPORT → CSV
        // ----------------------------------------------------------
        if ($request->export_type === "csv") {

            $header = ["Employee Name", "Check-In / Check-Out", "Date", "Time"];

            $rows = [];
            foreach ($attendance_list as $att) {
                $rows[] = [
                    $employee_name,
                    $att->check_in_or_out,
                    $att->year_month_date,
                    $att->time_
                ];
            }

            $csv = Writer::createFromString('');
            $csv->insertOne($header);
            $csv->insertAll($rows);

            $fileName = 'Attendance_Report_'.$employee_name.'_'.$start.'_to_'.$end.'.csv';

            return response((string) $csv)
                ->header('Content-Type', 'text/csv')
                ->header('Content-Disposition', "attachment; filename=\"$fileName\"");
        }

        // ----------------------------------------------------------
        // EXPORT → PDF
        // ----------------------------------------------------------
        if ($request->export_type === "pdf") {

            $pdf = Pdf::loadView('pdf.attendance_pdf', [
                'attendance_list' => $attendance_list,
                'employee_name' => $employee_name,
                'start' => $start,
                'end' => $end
            ])->setPaper('A4', 'portrait');

            return $pdf->download('Attendance_Report_'.$employee_name.'_'.$start.'_to_'.$end.'.pdf');
        }
    }
}

    public function department_directory(){
        $hrms = User::where('user_role', 2)->get();
        $employees = User::where('user_role', 3)->get();
        $hods = User::where('user_role', 5)->get();
        $authorizers = User::where('user_role', 6)->get();
       return view('department_directory', ['hrms' => $hrms,'employees' => $employees,'hods' => $hods,'authorizers' => $authorizers]);
    }
    public function get_employee_details(Request $request)
    {
    $user_id = $request->user_id;
    $user_role = User::where('id', $user_id)->value('user_role');
    $email = User::where('id', $user_id)->value('email');
    if($user_role == 2){
    $employee_name = OtherHRManagerDetails::where('user_id',$user_id)->value('first_name').' '.OtherHRManagerDetails::where('user_id',$user_id)->value('last_name');
    $department = OtherHRManagerDetails::where('user_id',$user_id)->value('department');
    $department_name = OrganizationDepartments::where('id', $department)->value('department');
    $department_location = OrganizationDepartments::where('id', $department)->value('location');
    $selected_location_name =  OrganizationLocations::where('id', $department_location)->value('location');
    $phone = OtherHRManagerDetails::where('user_id',$user_id)->value('phone');
    $designation = "HR Manager";
    }
    if($user_role == 3){
    $employee_name = OtherEmployeeDetails::where('user_id',$user_id)->value('first_name').' '. OtherEmployeeDetails::where('user_id', $user_id)->value('last_name');
    $department = OtherEmployeeDetails::where('user_id',$user_id)->value('department');
    $department_name = OrganizationDepartments::where('id', $department)->value('department');
    $department_location = OrganizationDepartments::where('id', $department)->value('location');
    $selected_location_name =  OrganizationLocations::where('id', $department_location)->value('location');
    $phone = OtherEmployeeDetails::where('user_id',$user_id)->value('phone');
    $designation = "Employee";
    }
    if($user_role == 5){
    $employee_name = OtherHODDetails::where('user_id',$user_id)->value('name');
    $department = OtherHODDetails::where('user_id',$user_id)->value('department');
    $department_name = OrganizationDepartments::where('id', $department)->value('department');
    $department_location = OrganizationDepartments::where('id', $department)->value('location');
    $selected_location_name =  OrganizationLocations::where('id', $department_location)->value('location');
    $phone = OtherHODDetails::where('user_id',$user_id)->value('phone');
    $designation = "Head of Department";
    }
    if($user_role ==6){
    $employee_name = OtherAuthoriserDetails::where('user_id',$user_id)->value('name');
    $department = OtherAuthoriserDetails::where('user_id',$user_id)->value('department');
    $department_name = OrganizationDepartments::where('id', $department)->value('department');
    $department_location = OrganizationDepartments::where('id', $department)->value('location');
    $selected_location_name =  OrganizationLocations::where('id', $department_location)->value('location');
    $phone = OtherAuthoriserDetails::where('user_id',$user_id)->value('phone');
    $designation = "Authoriser";
    }

    echo ' <div class="table-responsive">
    <table class="table table-bordered">
    <tbody>
    <tr>
    <th>Full Name</th>
    <td>'.$employee_name.'</td>
    </tr>
     <tr>
    <th>Designation</th>
    <td>'.$designation.'</td>
    </tr>
     <tr>
    <th>E-Mail</th>
    <td>'.$email.'</td>
    </tr>
     <tr>
    <th>Department</th>
    <td>'.$department_name.'</td>
    </tr>
     <tr>
    <th>Location</th>
    <td>'.$selected_location_name.'</td>
    </tr>
     <tr>
    <th>Phone No</th>
    <td>'.$phone.'</td>
    </tr>
    </tbody>
    </table></div>';
    }
    public function form_c(Request $request){
        if($request->isMethod('get')){
        return view('form_c');
        }
        if($request->isMethod('post')){
           $epf_reg_no = $request->epf_reg_no;
           $year_month = $request->year_month;
           $surcharges = $request->surcharges;
           $cheque_no = $request->cheque_no;
           $bank_and_branch = $request->bank_and_branch;
        }
        $pdf = PDF::loadView('pdf.form_c', ['epf_reg_no' => $epf_reg_no,'year_month' => $year_month,'surcharges' => $surcharges
    ,'cheque_no' => $cheque_no,'bank_and_branch' => $bank_and_branch]);
        return $pdf->download('Form C.pdf');
    }

    public function update_custom_leaves(Request $request)
    {
        $c=0;
        foreach($request->leave_id as $leave_id){
        $update_leave =  UserCustomLeaves::where('id', '=', $leave_id)->first();;
        $update_leave->leave_count =$request->leave_count[$c];
        $update_leave->update();
        $c=$c+1;
        }

    return back()->with('success', 'Leave Details Updated');
    }
    public function accessories(Request $request)
    { if($request->isMethod('get')){
        $accessories = Accessories::get();
       return view('accessories', ['accessories' => $accessories]);
    }
    }
    public function add_accessory(Request $request)
    { if($request->isMethod('get')){
       return view('add_accessory');
    }
    if($request->isMethod('post')){
    $this->validate($request, [
            'accessory_name'   => 'required',
           ]);

           $accessory = new Accessories();
           $accessory->accessory_name =$request->accessory_name;
           $accessory->save();

            return back()->with('success', 'Accessory Successfully Added');

    }

    }
    public function delete_accessory($id){
        Accessories::find($id)->delete();
        return back()->with('success', 'Accessory Successfully  Deleted');
    }
    public function employee_add_accessory($id,Request $request)
    {
        $this->validate($request, [
            'accessory'   => 'required',
           ]);

        $emp_accessory = new EmployeeAccessories();
        $emp_accessory->user_id =$id;
        $emp_accessory->accessory =$request->accessory;
        $emp_accessory->added_date = date("Y-m-d");
        $emp_accessory->save();
        return back()->with('success', 'Accessory Successfully Added');
    }
    public function delete_employee_accessory($id){
        EmployeeAccessories::find($id)->delete();
        return back()->with('success', 'Accessory Successfully  Deleted');
    }
    function send_intern_mails()
    {
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
    }
}



