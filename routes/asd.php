<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use App\Models\StudentDetails;
use App\Models\CourseModel;
use App\Models\OfflinePaymentCourses;
use App\Models\OfflinePayments;
use App\Models\Cart;
use App\Models\Coupens;
use App\Models\WishList;
use App\Models\Orders;
use App\Models\CartPaid;
use App\Models\CourseEnrollments;
use App\Models\CourseBundleCourses;
use App\Models\TeacherDetails;
use App\Models\ParentCategoriesModel;
use App\Models\TeacherCategories;
use App\Models\ELibrary;
use App\Models\ELibraryCategoreis;
use App\Models\Blogs;
use App\Models\BlogCategoreis;
use App\Models\CourseLessons;
use App\Models\CoursesLecturersModel;
use App\Models\CourseSections;
use App\Models\CourseOffersCourses;
use App\Models\CourseOffersMain;
use App\Models\EssayQuizAnswerMain;
use App\Models\EssayQuizAnswers;
use App\Models\McqQuizAnswerMain;
use App\Models\McqQuizAnswers;
use App\Models\CourseBundleMainModel;
use App\Models\CoursesParentCategoreisModel;
use App\Models\CourseBundleParentCategoreis;
use App\Models\SubCategoriesModel;
use App\Models\CoursesSubCategoreisModel;
use App\Models\CourseBundleSubCategoreis;
use App\Models\EssayQuizAnswerTimer;
use App\Models\MCQQuizAnswerTimer;
use Carbon\Carbon;

use File;
use Mail;
class MainController extends Controller
{
    public function login(Request $request)
    {
        if($request->isMethod('get')){
            return view('login');
        }
        if($request->isMethod('post')){
            $this->validate($request, [
                'user_name'   => 'required',
                'password'  => 'required'
               ]);
          
               $user_data = array(
                'user_name'  => $request->get('user_name'),
                'password' => $request->get('password'),
                'user_role' => 2
               );
          
               if(Auth::attempt($user_data))
               {
                session(['otp_confirmed' => false]);
                return redirect('confirm-otp');
               }
               else
               {
                return back()->with('login_error', 'Wrong Login Details');
               }
        }
    }
    public function forget_password(Request $request)
    {
        if($request->isMethod('get')){
            return view('forget_password');
        }
        if($request->isMethod('post')){
            $this->validate($request, [
                'email'   => 'required',
               ]);
            $login_details = User::where('email',$request->email)->first();
            if($login_details == null){
               return back()->with('error', 'Please enter a valid email address'); 
            }
            else{
                $details  = [
             
              'title' => "Infinity Learning Space Password Rest",
               'body' => "Plese Click On The Link Below To Rest Your Password",
               'link1' => Crypt::encryptString($login_details->id),
               'link2' => "rest",
         
               
            ];
              Mail::to($request->email)->send(new \App\Mail\ForgetPassword($details));
       
            return back()->with(['success' => 'Password Rest Link Has Been Sent To Your Email']);
        }
    }
    }
    public function reset_password($id,$email,Request $request){
          
        return view('reset_password',
           ['id' => $id]);
    
    } 
    public function reset_password_submit($id,Request $request){ 
        $this->validate($request, [
            'password'   => 'required|confirmed',
           ]);
        $user_id = Crypt::decryptString($id);
    
                $password = User::find($user_id);
                $password->password = Hash::make($request->input('password'));
                $password->update();
                return back()->with('success', 'Password changed');
                
              
              
        }  
    public function confirm_otp(Request $request)
    {
        if($request->isMethod('get')){
            $user_id = Auth::user()->id;
            $mobile_number = StudentDetails::where('user_id', $user_id)->value("mobile");
            return view('confirm_otp',['mobile_number'=> $mobile_number]);
        }
        if($request->isMethod('post')){
            $this->validate($request, [
                'otp'   => 'required',
               ]);
            if($request->otp == 1234){
            session(['otp_confirmed' => true]);
            return redirect('profile');
            }
            else{
            return back()->with('error', 'OTP is incorrect');
            }
        }
    }
    public function contact_us(Request $request)
    {
        if($request->isMethod('get')){
            return view('contact_us');
        }
        if($request->isMethod('post')){
            $this->validate($request, [
                'full_name'   => 'required',
                'email'   => 'required',
                'tel_no'   => 'required',
                'subject'   => 'required',
                'massage'   => 'required',
               ]);

            $details  = [
              'title' => "Infinity Learning Space Contact Us Form Submit",
               'body' => "",
               'full_name' => $request->full_name,
               'email' => $request->email,
               'tel_no' => $request->tel_no,
               'subject' => $request->subject,
               'massage' => $request->massage,
         
               
            ];
            Mail::to("test@gmail.com")->send(new \App\Mail\ContactUsSubmition($details));
       
            return back()->with(['success' => 'Your details has been submited']);
        
        }  
    }
    public function profile(Request $request)
    {
    $user_id = Auth::user()->id; 
    $profile_details = StudentDetails::where('user_id', $user_id)->get();
    $login_details = User::where('id', $user_id)->get();
    $courses = CourseEnrollments::where('student_id', $user_id)->get();
    $payments = Orders::where('user_id', $user_id)->get();
    return view('profile',['profile_details' => $profile_details,'login_details' => $login_details,'courses' => $courses,'payments' => $payments]);
    }
    function logout()
    {
     Auth::logout();
     return redirect('login');
    }
    public function register(Request $request)
    {
        if($request->isMethod('get')){
            return view('register');
        }
        if($request->isMethod('post')){
            $this->validate($request, [
                'first_name'   => 'required',
                'last_name'  => 'required',
                'address'   => 'required',
                'gender'  => 'required',
                'mobile'  => 'required | unique:student_details',
                'email'   => 'required | email | unique:users',
                'user_name'  => 'required | min:6 | unique:users',
                "password" => "required | confirmed | min:6",
               ]);
               session(['std_first_name' => $request->first_name]);
               session(['std_last_name' => $request->last_name]);
               session(['std_address' => $request->address]);
               session(['std_gender' => $request->gender]);
               session(['std_mobile' => $request->mobile]);
               session(['std_email' => $request->email]);
               session(['std_user_name' => $request->user_name]);
               session(['std_password' => $request->password]);
            return redirect('register-step-2');
       
        }
    }
    public function register_step_2(Request $request)
    {
        if($request->isMethod('get')){
            if(session('std_user_name')){
                return view('register_step_2');
            }
            else{
                return redirect('register');
            }
           
        }
        if($request->isMethod('post')){

            $this->validate($request, [
                'otp'   => 'required',
               ]);
            if($request->otp == 1234){
                DB::beginTransaction();
                $user = User::create([
                   "user_name" => $request->user_name,
                   "email" => $request->email,
                   "password" => Hash::make($request->password),
                   "user_role" => 2
                ]);
                $max_student_code = StudentDetails::max('student_code');
                if($max_student_code == null){
                 $student_code = 1000 ;
                 $student_code_text = "IN".$student_code."" ;
                }
                else{
                 $student_code = $max_student_code + 1 ;
                 $student_code_text = "IN".$student_code."" ;
                }
                $studentDetails = new StudentDetails();
                $studentDetails->user_id = $user->id;
                $studentDetails->student_code = $student_code;
                $studentDetails->student_code_text = $student_code_text;
                $studentDetails->first_name = $request->first_name;
                $studentDetails->last_name = $request->last_name;
                $studentDetails->address = $request->address	;
                $studentDetails->gender = $request->gender;
                $studentDetails->mobile = $request->mobile;
                $studentDetails->verified = "yes";
                $studentDetails->save();
                DB::commit();
                session(['student_code_text' => $student_code_text]);

                $details  = [
                    'title' => "Infinity Learning Space Registration Details",
                     'body' => "",
                     'user_id' => $student_code_text,
                     'email' => $request->email,
                     'mobile' => $request->mobile,
            
                  ];
                  Mail::to($request->email)->send(new \App\Mail\RegistrationDetails($details));

                $request->session()->forget(['std_first_name', 'std_last_name', 'std_address', 'std_gender']);
                
                return redirect('register-success');

            }
            else{
            return back()->with('error', 'OTP is incorrect');
            }

             
        }
    }
    public function register_success(Request $request)
    {
        return view('register_success');
    }
    public function go_to_profile(Request $request)
    {
     
               $user_data = array(
                'user_name'  => session('std_user_name'),
                'password' => session('std_password'),
                'user_role' => 2
               );
          
               if(Auth::attempt($user_data))
               {
                session(['otp_confirmed' => true]);
                $request->session()->forget(['student_code_text', 'std_email', 'std_mobile', 'std_user_name', 'std_password']);
                return redirect('profile');
               }
               else
               {
                return back()->with('login_error', 'Wrong Login Details');
               }
        
    }
    public function apply_as_teacher(Request $request)
    {
        if($request->isMethod('get')){
            return view('apply_as_teacher');
        }
        if($request->isMethod('post')){
            $this->validate($request, [
                'first_name'   => 'required',
                'last_name'   => 'required',
                'email'   => 'required',
                'phone_no'   => 'required',
                'teaching_intrest'   => 'required',
                'cv'   => 'required',
               ]);

            $cv = time().'_'.$request->first_name.' '.$request->last_name.'.'.$request->cv->extension();
            $request->cv->move(public_path('teachers_cvs'), $cv);

            $details  = [
              'title' => "Infinity Learning Space Apply As a Teacher Form Submit",
               'body' => "",
               'first_name' => $request->first_name,
               'last_name' => $request->last_name,
               'email' => $request->email,
               'phone_no' => $request->phone_no,
               'teaching_intrest' => $request->teaching_intrest,
               'cv' => $cv,
   
            ];
            
            Mail::to("test@gmail.com")->send(new \App\Mail\ApplyAsTeacher($details,));
       
            return back()->with(['success' => 'Your details has been submited']);
        
        }
       
    }
    public function apply_for_scholarship(Request $request)
    {
        if($request->isMethod('get')){
            return view('apply_for_scholarship');
        }
        if($request->isMethod('post')){
            $this->validate($request, [
                'first_name'   => 'required',
                'last_name'   => 'required',
                'email'   => 'required',
                'phone_no'   => 'required',
                'cv'   => 'required',
               ]);

            $cv = time().'_'.$request->first_name.' '.$request->last_name.'.'.$request->cv->extension();
            $request->cv->move(public_path('scholarship_cvs'), $cv);

            $details  = [
              'title' => "Infinity Learning Space Apply For Scholarship Form Submit",
               'body' => "",
               'first_name' => $request->first_name,
               'last_name' => $request->last_name,
               'email' => $request->email,
               'phone_no' => $request->phone_no,
               'cv' => $cv,
   
            ];
            
            Mail::to("test@gmail.com")->send(new \App\Mail\ApplyForScholarship($details,));
       
            return back()->with(['success' => 'Your details has been submited']);
        
        }
       
    }
    public function cart(Request $request)
    {
        if(Auth::check()){
            if(Auth::user()->user_role == 2){ 
            $user_id = Auth::user()->id;
            $cart_details = Cart::where('user_id', $user_id)->get();
            $coupen_value = 0;
            $coupen_code = null;
            }
            else{
            $cart_details = null; 
            $coupen_value = 0;
            $coupen_code = null;
            }   
            }
            else{
            $cart_details = null;   
            $coupen_value = 0;
            $coupen_code = null;
            }
            return view('cart', ['cart_details' => $cart_details,'coupen_value' => $coupen_value, 'coupen_code' => $coupen_code]);
    }
    public function cart_apply_coupen(Request $request)
    {
        if(Auth::check()){
            if(Auth::user()->user_role == 2){ 
            $user_id = Auth::user()->id;
            $cart_details = Cart::where('user_id', $user_id)->get();
            $coupen_code = $request->coupen;
            $coupen_value = Coupens::where('coupen_code', $request->coupen)->value('value');
            if($coupen_value){
            return view('cart', ['cart_details' => $cart_details,'coupen_value' => $coupen_value, 'coupen_code' => $coupen_code]);
            }
            else{
                return back()->with(['fail' => 'Invalid Coupen Code']);
            }
            }
            else{
            $cart_details = null; 
            $coupen_value = 0;
            $coupen_code = null;
            return view('cart', ['cart_details' => $cart_details,'coupen_value' => $coupen_value, 'coupen_code' => $coupen_code]);
            }   
            }
            else{
            $cart_details = null;   
            $coupen_value = 0;
            $coupen_code = null;
            return view('cart', ['cart_details' => $cart_details,'coupen_value' => $coupen_value, 'coupen_code' => $coupen_code]);
            }
           
    }
    public function remove_cart_item($id){
        Cart::where('id',$id)->delete();
        return back()->with('sucess', 'Cart Item Removed');
    
    }
    public function add_to_wishlist($id){
        $wishlist = new WishList();
        $wishlist->user_id =Cart::where('id',$id)->value('user_id');
        $wishlist->purchase_type =Cart::where('id',$id)->value('purchase_type');
        $wishlist->item_id =Cart::where('id',$id)->value('item_id');
        $wishlist->save();
        return back()->with('sucess', 'Item Added To Wishlist');
    }
    public function checkout(Request $request)
    {
        if(!$request->original_price){
         return redirect('cart');   
        }
        else{
        $coupen_value = $request->coupen_value;
        $original_price = $request->original_price;
        $offer_discount = $request->offer_discount;
        $cart_ids = $request->cart_ids;
        $studentdetails = StudentDetails::where('user_id', Auth::user()->id)->get();
        $studentlogindetails = User::where('id', Auth::user()->id)->get();
        return view('checkout', ['original_price' => $original_price,'coupen_value' => $coupen_value,'offer_discount' => $offer_discount,
        'studentdetails' => $studentdetails,'studentlogindetails' => $studentlogindetails,'cart_ids' => $cart_ids]);
    }
    }
    public function proceed_checkout(Request $request)
    {
        $order = new Orders();
        $order->user_id = Auth::user()->id;
        $order->first_name =$request->first_name;
        $order->last_name =$request->last_name;
        $order->email =$request->email;
        $order->mobile =$request->mobile;
        $order->country =$request->country;
        $order->address =$request->address;
        $order->town =$request->town;
        $order->postal_code =$request->postal_code;
        $order->amount =$request->final_price;
        $order->save();
        foreach($request->cart_ids as $cart){
            $user_id = Cart::where('id',$cart)->value('user_id');
            $purchase_type =Cart::where('id',$cart)->value('purchase_type');
            $item_id = Cart::where('id',$cart)->value('item_id');
            $discount_id = Cart::where('id',$cart)->value('discount_id');
            $discount = Cart::where('id',$cart)->value('discount');
            $cart_paid = new CartPaid();
            $cart_paid->user_id = $user_id;
            $cart_paid->order_id =$order->id;
            $cart_paid->purchase_type =$purchase_type;
            $cart_paid->item_id	 =$item_id;
            $cart_paid->discount_id =$discount_id;
            $cart_paid->discoun =$discount;
            $cart_paid->save();
            if($purchase_type == "course"){
                $course_enrollments = new CourseEnrollments();
                $course_enrollments->course_id = $item_id;
                $course_enrollments->student_id = $user_id;
                $course_enrollments->enrollement_fee = CourseModel::where('id',$item_id)->value('sale_price');
                $course_enrollments->date = date('Y-m-d');;
                $course_enrollments->save();
            }
            else{
                $courses = CourseBundleCourses::where('bundle_id', $item_id)->get(); 
                foreach($courses as $course){
                    $course_enrollments_b = new CourseEnrollments();
                    $course_enrollments_b->course_id = $course->course_id;
                    $course_enrollments_b->student_id = $user_id;
                    $course_enrollments_b->enrollement_fee = CourseModel::where('id',$course->course_id)->value('sale_price');
                    $course_enrollments_b->date = date('Y-m-d');;
                    $course_enrollments_b->save();
                }
            }
        Cart::where('id',$cart)->delete();
        }
        return redirect('payment-success');
    }
    public function payment_success(Request $request)
    {
        if($request->isMethod('get')){
            return view('payment_success');
        }
 
    }
    public function offline_payments(Request $request)
    {
        
        if($request->isMethod('get')){
            $courses = CourseModel::get();
            return view('offline_payments', ['courses' => $courses]);
        }
        if($request->isMethod('post')){
            $this->validate($request, [
                'name'   => 'required',
                'student_id'  => 'required',
                'tel_no'   => 'required',
                'email'   => 'required',
                'amount'  => 'required',
                'reciept'  => 'required',
                'courses'  => 'required',
            ]);
            $courses_total_price = 0;
            foreach($request->courses as $course){
                $course_price = CourseModel::where('id', $course)->value('sale_price');
                $courses_total_price = $courses_total_price + $course_price;
            }
            if($courses_total_price <= $request->amount){
                $reciept = time().'_'.$request->student_id.'.'.$request->reciept->extension();
                $request->reciept->move(public_path('payment_slips'), $reciept);

                $payment = new OfflinePayments();
                $payment->name = $request->name;
                $payment->student_id = $request->student_id;
                $payment->tel_no = $request->tel_no;
                $payment->email = $request->email;
                $payment->is_approved = "no";
                $payment->amount = $request->amount;
                $payment->payment_slip = $reciept;
                $payment->date = date('Y-m-d');
                $payment->save(); 
    
                foreach($request->courses as $course){
                    $pay_course = new OfflinePaymentCourses();
                    $pay_course->offline_payment_id =$payment->id;
                    $pay_course->course_id = $course;
                    $pay_course->save();
                }
                return back()->with('success', 'Payment Successfull');
            }
          else{
            return back()->with('error', 'Your Enterd Amount Is Lower Than The Course Prices');
          }
       
            
        }
    }
    public function lectures(Request $request)
    {
        $categories = ParentCategoriesModel::get();
        return view('lectures',['categories' => $categories]);
    }
    public function onload_lectures(Request $request)
    {
    $lectures = TeacherDetails::get();
    foreach($lectures as $lecture){
        echo ' <div class="itembox Charted">
        <div class="d-flex flex-column justify-content-center align-items-center">
            <div class="lecture_photo_here"> <img src="'.asset("teachers_images/".$lecture->image."").'"></div>
            <a href="'.url("view-lecturer/".$lecture->user_id."").'"><h2 class="lecture_person_name">'.$lecture->name.'</h2></a>
            <p class="lecture_person_desc">'.$lecture->education_qulification.'
            </p>
        </div>
    </div>';
    }
    }
    public function fillter_lectures(Request $request)
    {
    if($request->category_id == "all"){
        $lectures = TeacherDetails::get();
        foreach($lectures as $lecture){
            echo ' <div class="itembox Charted">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <div class="lecture_photo_here"> <img src="'.asset("teachers_images/".$lecture->image."").'"></div>
                <a href="'.url("view-lecturer/".$lecture->user_id."").'"><h2 class="lecture_person_name">'.$lecture->name.'</h2></a>
                <p class="lecture_person_desc">'.$lecture->education_qulification.'
                </p>
            </div>
        </div>';
        }
    }
    else{
        $lectures = TeacherCategories::where('category',$request->category_id)->get();
        foreach($lectures as $lecture){
        $image = TeacherDetails::where('user_id',$lecture->user_id)->value('image');
        $name = TeacherDetails::where('user_id',$lecture->user_id)->value('name');
        $education_qulification = TeacherDetails::where('user_id',$lecture->user_id)->value('education_qulification');
            echo ' <div class="itembox Charted">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <div class="lecture_photo_here"> <img src="'.asset("teachers_images/".$image."").'"></div>
                <a href="'.url("view-lecturer/".$lecture->user_id."").'"><h2 class="lecture_person_name">'.$name.'</h2></a>
                <p class="lecture_person_desc">'.$education_qulification.'
                </p>
            </div>
        </div>';
        }
    }
   
    }
    public function view_lecturer($id,Request $request)
    {
    $teacher_details = TeacherDetails::where('user_id', $id)->get();

    return view('view_lecturer',['teacher_details' => $teacher_details]);
    }
    public function about_us()
    {
    $teachers = TeacherDetails::get();
    $teacher_details_desktop_active = TeacherDetails::take(4)->orderBy('id')->get();

    return view('about_us',['teachers' => $teachers,'teacher_details_desktop_active' => $teacher_details_desktop_active,
    ]);
    }
    public function e_library(Request $request)
    {
        $categories = ELibraryCategoreis::get();
        $libraries = ELibrary::paginate(4);
        return view('e_library',['categories' => $categories,'libraries' => $libraries]);
    }
    public function search_e_library(Request $request)
    {
        $libraries = ELibrary::where('title', 'like', "%".$request->search_text."%")->get();
        foreach($libraries as $library){
             echo'<div class="col-md-3 mt-4">
             
             <a href="'.url("view-e-library/".$library->id."").'" class="book_link">
                 <div class=" book-card-container d-flex shadow-sm">
                     <div class="d-flex justify-content-center align-items-center text-center">
                         <img src="'.asset('e_library_files/'.$library->featured_img.'').'" class="book-img-cotainer">
                     </div>
                     <div class="d-flex justify-content-center align-items-center text-center">
                         <p class="book-auther  mt-1">'.$library->title.'</p>
                     </div>
                 </div>
             </a>
             </div>';
        }
    }
    public function fillter_e_library(Request $request)
    {
    if($request->category_id == "all"){
        $libraries = ELibrary::get();
        foreach($libraries as $library){
            echo '<div class="col-md-3 mt-4">
             
            <a href="'.url("view-e-library/".$library->id."").'" class="book_link">
                <div class=" book-card-container d-flex shadow-sm">
                    <div class="d-flex justify-content-center align-items-center text-center">
                        <img src="'.asset('e_library_files/'.$library->featured_img.'').'" class="book-img-cotainer">
                    </div>
                    <div class="d-flex justify-content-center align-items-center text-center">
                        <p class="book-auther  mt-1">'.$library->title.'</p>
                    </div>
                </div>
            </a>
            </div>';
        }
    }
    else{
        $libraries = ELibrary::where('e_library_category',$request->category_id)->get();
        foreach($libraries as $library){
            echo '<div class="col-md-3 mt-4">
             
            <a href="'.url("view-e-library/".$library->id."").'" class="book_link">
                <div class=" book-card-container d-flex shadow-sm">
                    <div class="d-flex justify-content-center align-items-center text-center">
                        <img src="'.asset('e_library_files/'.$library->featured_img.'').'" class="book-img-cotainer">
                    </div>
                    <div class="d-flex justify-content-center align-items-center text-center">
                        <p class="book-auther  mt-1">'.$library->title.'</p>
                    </div>
                </div>
            </a>
            </div>';
        }
    }
   
    }
    public function view_e_library($id,Request $request)
    {
    $library_details = ELibrary::where('id', $id)->get();

    return view('view_e_library',['library_details' => $library_details]);
    }
    public function blogs(Request $request)
    {
        $blogs = Blogs::where('status', "active")->paginate(3);
        $categories = BlogCategoreis::get();
        return view('blogs',['blogs' => $blogs,'categories' => $categories]);
    }
    public function fillter_blogs(Request $request)
    {
    if($request->category_id == "all"){
        $blogs = Blogs::where('status', "active")->get();
        foreach($blogs as $blog){
        $blog_category_name =BlogCategoreis::where('id', $blog->blog_category)->value('category'); 
        $blog_teacher_name =TeacherDetails::where('user_id', $blog->teacher)->value('name');
        $blog_teacher_image =TeacherDetails::where('user_id', $blog->teacher)->value('image');
       
         echo'<div class="col-md-4 mt-4">
         <a href="'.url("view-blog/".$blog->id."").'" class="course_link">
             <div class=" blog-container d-flex p-2">
                 <div class="row">
                     <p class="blog-category mt-2">'.$blog_category_name.'</p>
                     <p class="blog-title">'.$blog->blog_title.'</p>
                 </div>
                 <div class="d-flex mt-5 mb-2 mx-3 flex-row align-items-center">
                     <div class="col-5">
              
                         <img src="'. asset('teachers_images/'.$blog_teacher_image.'') .'" class="author-img-cotainer">
                       
                     </div>
                     <div class="col-7">
                         <p class="blog-auther  mt-1">'.$blog->blog_teacher_name.'</p>
                     </div>
                 </div>
             </div>
         </a>
     </div>';
        }
      
    }
    else{
        $blogs = Blogs::where('status', "active")->where('blog_category',$request->category_id)->get();
        foreach($blogs as $blog){
        $blog_category_name =BlogCategoreis::where('id', $blog->blog_category)->value('category'); 
        $blog_teacher_name =TeacherDetails::where('user_id', $blog->teacher)->value('name');
        $blog_teacher_image =TeacherDetails::where('user_id', $blog->teacher)->value('image');
            echo'<div class="col-md-4 mt-4">
         <a href="'.url("view-blog/".$blog->id."").'" class="course_link">
             <div class=" blog-container d-flex p-2">
                 <div class="row">
                     <p class="blog-category mt-2">'.$blog_category_name.'</p>
                     <p class="blog-title">'.$blog->blog_title.'</p>
                 </div>
                 <div class="d-flex mt-5 mb-2 mx-3 flex-row align-items-center">
                     <div class="col-5">
              
                         <img src="'. asset('teachers_images/'.$blog_teacher_image.'') .'" class="author-img-cotainer">
                       
                     </div>
                     <div class="col-7">
                         <p class="blog-auther  mt-1">'.$blog->blog_teacher_name.'</p>
                     </div>
                 </div>
             </div>
         </a>
     </div>';
        }
    }
   
    }
    public function search_blogs(Request $request)
    {
        $blogs = Blogs::where('status', "active")->where('blog_title', 'like', "%".$request->search_text."%")->get();
        foreach($blogs as $blog){
            $blog_category_name =BlogCategoreis::where('id', $blog->blog_category)->value('category'); 
            $blog_teacher_name =TeacherDetails::where('user_id', $blog->teacher)->value('name');
            $blog_teacher_image =TeacherDetails::where('user_id', $blog->teacher)->value('image');
           
             echo'<div class="col-md-4 mt-4">
             <a href="'.url("view-blog/".$blog->id."").'" class="course_link">
                 <div class=" blog-container d-flex p-2">
                     <div class="row">
                         <p class="blog-category mt-2">'.$blog_category_name.'</p>
                         <p class="blog-title">'.$blog->blog_title.'</p>
                     </div>
                     <div class="d-flex mt-5 mb-2 mx-3 flex-row align-items-center">
                         <div class="col-5">
                  
                             <img src="'. asset('teachers_images/'.$blog_teacher_image.'') .'" class="author-img-cotainer">
                           
                         </div>
                         <div class="col-7">
                             <p class="blog-auther  mt-1">'.$blog->blog_teacher_name.'</p>
                         </div>
                     </div>
                 </div>
             </a>
         </div>';
        }
    }
    public function view_blog($id,Request $request)
    {
    $blog_details = Blogs::where('id', $id)->get();
    $similler_blogs = Blogs::where('blog_category', Blogs::where('id', $id)->value('blog_category'))->get();
    return view('view_blog',['blog_details' => $blog_details,'similler_blogs' => $similler_blogs]);
    }
    public function course_inner($id,Request $request)
    {
    $course_details = CourseModel::where('id', $id)->get();
    $course_lessons = CourseLessons::where('course_id', $id)->get();
    $course_sections = CourseSections::where('course_id', $id)->get();
    $course_teacher_id = CoursesLecturersModel::where('course_id', $id)->first()->get();
    return view('course_inner',['course_details' => $course_details, 'course_lessons' => $course_lessons, 
    'course_teacher_id' => $course_teacher_id, 'course_sections' => $course_sections]);
    }
    public function courses(Request $request)
    {
    $courses = CourseModel::get();
    $course_bundles = CourseBundleMainModel::get();
    $parent_categoreis = ParentCategoriesModel::get();
    $sub_categoreis = SubCategoriesModel::get();
    return view('courses',['courses' => $courses,'course_bundles' => $course_bundles,'parent_categoreis' => $parent_categoreis
    ,'sub_categoreis' => $sub_categoreis]);
    }
    public function enroll_student(Request $request)
    {
        if($request->user_id == null){
        return back()->with('fail', 'You have to login first');  
        }
        else{
            $course_enrollment = new CourseEnrollments();
            $course_enrollment->course_id = $request->course_id;
            $course_enrollment->student_id = $request->user_id;
            $course_enrollment->enrollement_fee = $request->sale_price;
            $course_enrollment->date = date('Y-m-d');;
            $course_enrollment->save();
            return back()->with('success', 'You have enrolled to this course');  
        }
        
    }
    public function add_to_cart(Request $request)
    {
        if($request->user_id == null){
        return back()->with('fail', 'You have to login first');  
        }
        else{
        if(Cart::where("item_id", $request->course_id)->where("purchase_type", "course")->where("user_id", $request->user_id)->exists()){
        return back()->with('fail', 'This course is already in your cart'); 
        }
        else{
        if(CourseOffersCourses::where("course_id", $request->course_id)->exists()){
        $offer_id = CourseOffersCourses::where("course_id", $request->course_id)->value('offer_id');
        $cart_offer_count = Cart::where('discount_id', $offer_id)->count();
        $offer_course_count = CourseOffersCourses::where('offer_id', $offer_id)->count();
        if($offer_course_count - 1 == $cart_offer_count){
            $add_to_cart = new Cart();
            $add_to_cart->user_id = $request->user_id;
            $add_to_cart->purchase_type = "course";
            $add_to_cart->item_id = $request->course_id;
            $add_to_cart->discount_id = $offer_id;
            $add_to_cart->discount = CourseOffersMain::where("id", $offer_id)->value('discount');
            $add_to_cart->save();
            return back()->with('success', 'Course has been added to the cart');
        }
        else{
            $add_to_cart = new Cart();
            $add_to_cart->user_id = $request->user_id;
            $add_to_cart->purchase_type = "course";
            $add_to_cart->item_id = $request->course_id;
            $add_to_cart->discount_id = $offer_id;
            $add_to_cart->discount = null;
            $add_to_cart->save();
            return back()->with('success', 'Course has been added to the cart');  
        }
        }
        else{
            $add_to_cart = new Cart();
            $add_to_cart->user_id = $request->user_id;
            $add_to_cart->purchase_type = "course";
            $add_to_cart->item_id = $request->course_id;
            $add_to_cart->discount_id = null;
            $add_to_cart->discount = null;
            $add_to_cart->save();
            return back()->with('success', 'Course has been added to the cart');
        }
              
        }
            
        }
        
    }
    public function submit_essay_answers(Request $request)
    {
        if($request->isMethod('post')){

        if(EssayQuizAnswerMain::where("course_id", $request->essay_course_id)->where("quiz_id", $request->essay_quiz_id)->
        where("student_id", $request->essay_student_id)->exists()){
        return back()->with('fail', 'You have already submited your answers');
        }
        else{
        $essay_answers_main = new EssayQuizAnswerMain();
        $essay_answers_main->course_id = $request->essay_course_id;
        $essay_answers_main->quiz_id = $request->essay_quiz_id;
        $essay_answers_main->student_id = $request->essay_student_id;
        $essay_answers_main->date = date('Y-m-d');
        $essay_answers_main->save();
        $c = 0;
        foreach($request->essay_quiz_qustion_ids as $essay_quiz_qustion_id){
            $essay_answers = new EssayQuizAnswers();
            $essay_answers->answer_main_id = $essay_answers_main->id;
            $essay_answers->questions_id = $essay_quiz_qustion_id;
            $essay_answers->questions = $request->essay_quiz_qustion_questions[$c];
            $essay_answers->answer = $request->essay_quiz_answers[$c];
            $essay_answers->save();
            $c = $c + 1;
        }
        return back()->with('success', 'Your answers has been submited');
    }
    }
    }
    public function submit_mcq_answers(Request $request)
    {
        if($request->isMethod('post')){

        if(McqQuizAnswerMain::where("course_id", $request->mcq_course_id)->where("quiz_id", $request->mcq_quiz_id)->
        where("student_id", $request->mcq_student_id)->exists()){
        return back()->with('fail', 'You have already submited your answers');
        }
        else{
        $mcq_answers_main = new McqQuizAnswerMain();
        $mcq_answers_main->course_id = $request->mcq_course_id;
        $mcq_answers_main->quiz_id = $request->mcq_quiz_id;
        $mcq_answers_main->student_id = $request->mcq_student_id;
        $mcq_answers_main->date = date('Y-m-d');
        $mcq_answers_main->save();
        $c = 0;
        foreach($request->mcq_quiz_qustion_ids as $mcq_quiz_qustion_id){
            $mcq_answers = new McqQuizAnswers();
            $mcq_answers->answer_main_id = $mcq_answers_main->id;
            $mcq_answers->questions_id = $mcq_quiz_qustion_id;
            $mcq_answers->questions = $request->mcq_quiz_qustion_questions[$c];
            $mcq_answers->answer = $request->input('mcq_answer'.$mcq_quiz_qustion_id);
            $mcq_answers->save();
            $c = $c + 1;
        }
        return back()->with('success', 'Your answers has been submited');
    }
    }
    }
public function fillter_courses_by_name(Request $request)
{
$courses = CourseModel::where('course_name', 'like', "%".$request->search_text."%")->get();
$course_bundles = CourseBundleMainModel::where('bundle_name', 'like', "%".$request->search_text."%")->get();
if($courses->isEmpty() && $course_bundles->isEmpty()){
echo '<p class="more-courses-course-title mt-4">No courses avilable</p>';
}
else{
foreach($courses as $course){
$course_teacher_id = CoursesLecturersModel::where('course_id', $course->id)->get();
if($course_teacher_id == null || $course_teacher_id->isEmpty()){
    $teacher_name = " ";
}
else{
foreach($course_teacher_id as $course_teacher){
$course_teacher_details = TeacherDetails::where('user_id', $course_teacher->lecturre_id)->get();   
foreach($course_teacher_details as $course_teacher_detail){ 
        $teacher_name = $course_teacher_detail->name;
}
}
}
$more_courses_lessons_count = CourseLessons::where('course_id', $course->id)->count(); 
echo '<div class="col-md-3 mt-4 ">
<a href="'.url('course-inner/'.$course->id.'').'">
<div class=" more-courses-container">
<img src="'. asset('course_featured_images/'.$course->image_path.'').'" class="course-filter-featured-image">
<p class="more-courses-course-title mt-2">'.$course->course_name.'</p>
<p class="more-courses-course-sub">'.$teacher_name.'</p>
<p class="more-courses-course-sub  mt-1">'.$more_courses_lessons_count.' lectures</p>';
if($course->paymet_method == "Paid"){
echo '<p class="more-courses-course-price mt-3"><span style="text-decoration: line-through;">RS. '.$course->normal_price.'</span> RS. '.$course->sale_price.'</p>';
 }
else{
echo '<p class="more-courses-course-price mt-3">Free</p>';
 } 
echo '</div>
</a>
</div>
 ';
        }
foreach($course_bundles as $course_bundle){
$course_bundle_count = CourseBundleCourses::where('bundle_id', $course_bundle->id)->count();
    echo '<div class="col-md-3 mt-4 ">
            <a href="'. url('course-bundle-inner/'.$course_bundle->id.'') .'">
            <div class=" more-courses-container">
            <img src="'. asset('course_bundle_images/'.$course_bundle->featured_image.'') .'" class="course-filter-featured-image">
            <p class="more-courses-course-title mt-2">'.$course_bundle->bundle_name.'</p>
            <p class="more-courses-course-sub">Course Bundle</p>
            <p class="more-courses-course-sub  mt-1">'.$course_bundle_count.' Courses</p>
            <p class="more-courses-course-price mt-3">RS. '.$course_bundle->price.'</p>
            </div>
            </a>
            </div>';
}
}
}
public function fillter_courses(Request $request)
{
if($request->course_type == "course"){
if($request->payment_type == "all"){
    if($request->main_category == "all"){

        if($request->sub_category == "all"){
        $courses = CourseModel::get();
        if($courses->isEmpty()){
            echo '<p class="more-courses-course-title mt-4">No courses avilable</p>';
        }
        else{
        foreach($courses as $course){
            $course_teacher_id = CoursesLecturersModel::where('course_id', $course->id)->get();
            if($course_teacher_id == null || $course_teacher_id->isEmpty()){
                $teacher_name = " ";
            }
            else{
            foreach($course_teacher_id as $course_teacher){
            $course_teacher_details = TeacherDetails::where('user_id', $course_teacher->lecturre_id)->get();   
            foreach($course_teacher_details as $course_teacher_detail){ 
                    $teacher_name = $course_teacher_detail->name;
            }
            }
            }
            $more_courses_lessons_count = CourseLessons::where('course_id', $course->id)->count(); 
            echo '<div class="col-md-3 mt-4 ">
            <a href="'.url('course-inner/'.$course->id.'').'">
            <div class=" more-courses-container">
            <img src="'. asset('course_featured_images/'.$course->image_path.'').'" class="course-filter-featured-image">
            <p class="more-courses-course-title mt-2">'.$course->course_name.'</p>
            <p class="more-courses-course-sub">'.$teacher_name.'</p>
            <p class="more-courses-course-sub  mt-1">'.$more_courses_lessons_count.' lectures</p>';
            if($course->paymet_method == "Paid"){
            echo '<p class="more-courses-course-price mt-3"><span style="text-decoration: line-through;">RS. '.$course->normal_price.'</span> RS. '.$course->sale_price.'</p>';
             }
            else{
            echo '<p class="more-courses-course-price mt-3">Free</p>';
             } 
            echo '</div>
            </a>
            </div>
             ';
                    }
                
            } 
        }
        else{
            $courses = CourseModel::get();
            if($courses->isEmpty()){
                echo '<p class="more-courses-course-title mt-4">No courses avilable</p>';
            }
            else{
            foreach($courses as $course){
                if(CoursesSubCategoreisModel::where("course_id", "=", $course->id)->where("category_id", "=", $request->sub_category)->exists()){
                $course_teacher_id = CoursesLecturersModel::where('course_id', $course->id)->get();
                if($course_teacher_id == null || $course_teacher_id->isEmpty()){
                    $teacher_name = " ";
                }
                else{
                foreach($course_teacher_id as $course_teacher){
                $course_teacher_details = TeacherDetails::where('user_id', $course_teacher->lecturre_id)->get();   
                foreach($course_teacher_details as $course_teacher_detail){ 
                        $teacher_name = $course_teacher_detail->name;
                }
                }
                }
                $more_courses_lessons_count = CourseLessons::where('course_id', $course->id)->count(); 
                echo '<div class="col-md-3 mt-4 ">
                <a href="'.url('course-inner/'.$course->id.'').'">
                <div class=" more-courses-container">
                <img src="'. asset('course_featured_images/'.$course->image_path.'').'" class="course-filter-featured-image">
                <p class="more-courses-course-title mt-2">'.$course->course_name.'</p>
                <p class="more-courses-course-sub">'.$teacher_name.'</p>
                <p class="more-courses-course-sub  mt-1">'.$more_courses_lessons_count.' lectures</p>';
                if($course->paymet_method == "Paid"){
                echo '<p class="more-courses-course-price mt-3"><span style="text-decoration: line-through;">RS. '.$course->normal_price.'</span> RS. '.$course->sale_price.'</p>';
                 }
                else{
                echo '<p class="more-courses-course-price mt-3">Free</p>';
                 } 
                echo '</div>
                </a>
                </div>
                 ';
                }
                } 
                }   
        }

        



    }
    else{

    if($request->sub_category == "all"){
        $courses = CourseModel::get();
        if($courses->isEmpty()){
            echo '<p class="more-courses-course-title mt-4">No courses avilable</p>';
        }
        else{
        foreach($courses as $course){
            if(CoursesParentCategoreisModel::where("course_id", "=", $course->id)->where("category_id", "=", $request->main_category)->exists()){
                $course_teacher_id = CoursesLecturersModel::where('course_id', $course->id)->get();
                if($course_teacher_id == null || $course_teacher_id->isEmpty()){
                    $teacher_name = " ";
                }
                else{
                foreach($course_teacher_id as $course_teacher){
                $course_teacher_details = TeacherDetails::where('user_id', $course_teacher->lecturre_id)->get();   
                foreach($course_teacher_details as $course_teacher_detail){ 
                        $teacher_name = $course_teacher_detail->name;
                }
                }
            }
                $more_courses_lessons_count = CourseLessons::where('course_id', $course->id)->count(); 
                echo '<div class="col-md-3 mt-4 ">
                <a href="'.url('course-inner/'.$course->id.'').'">
                <div class=" more-courses-container">
                <img src="'. asset('course_featured_images/'.$course->image_path.'').'" class="course-filter-featured-image">
                <p class="more-courses-course-title mt-2">'.$course->course_name.'</p>
                <p class="more-courses-course-sub">'.$teacher_name.'</p>
                <p class="more-courses-course-sub  mt-1">'.$more_courses_lessons_count.' lectures</p>';
                if($course->paymet_method == "Paid"){
                echo '<p class="more-courses-course-price mt-3"><span style="text-decoration: line-through;">RS. '.$course->normal_price.'</span> RS. '.$course->sale_price.'</p>';
                 }
                else{
                echo '<p class="more-courses-course-price mt-3">Free</p>';
                 } 
                echo '</div>
                </a>
                </div>
                 ';
            }

            }
                
            } 
    }
    else{
        $courses = CourseModel::get();
        if($courses->isEmpty()){
            echo '<p class="more-courses-course-title mt-4">No courses avilable</p>';
        }
        else{
        foreach($courses as $course){
            if(CoursesParentCategoreisModel::where("course_id", "=", $course->id)->where("category_id", "=", $request->main_category)->exists()){
            if(CoursesSubCategoreisModel::where("course_id", "=", $course->id)->where("category_id", "=", $request->sub_category)->exists()){
                $course_teacher_id = CoursesLecturersModel::where('course_id', $course->id)->get();
                if($course_teacher_id == null || $course_teacher_id->isEmpty()){
                    $teacher_name = " ";
                }
                else{
                foreach($course_teacher_id as $course_teacher){
                $course_teacher_details = TeacherDetails::where('user_id', $course_teacher->lecturre_id)->get();   
                foreach($course_teacher_details as $course_teacher_detail){ 
                        $teacher_name = $course_teacher_detail->name;
                }
                }
            }
                $more_courses_lessons_count = CourseLessons::where('course_id', $course->id)->count(); 
                echo '<div class="col-md-3 mt-4 ">
                <a href="'.url('course-inner/'.$course->id.'').'">
                <div class=" more-courses-container">
                <img src="'. asset('course_featured_images/'.$course->image_path.'').'" class="course-filter-featured-image">
                <p class="more-courses-course-title mt-2">'.$course->course_name.'</p>
                <p class="more-courses-course-sub">'.$teacher_name.'</p>
                <p class="more-courses-course-sub  mt-1">'.$more_courses_lessons_count.' lectures</p>';
                if($course->paymet_method == "Paid"){
                echo '<p class="more-courses-course-price mt-3"><span style="text-decoration: line-through;">RS. '.$course->normal_price.'</span> RS. '.$course->sale_price.'</p>';
                 }
                else{
                echo '<p class="more-courses-course-price mt-3">Free</p>';
                 } 
                echo '</div>
                </a>
                </div>
                 ';
            }
            }
            }  
            } 
    }
        
    }
     
}    
elseif($request->payment_type == "free"){
    if($request->main_category == "all"){

        if($request->sub_category == "all"){
            $courses = CourseModel::where('paymet_method', 'Free')->get();
            if($courses->isEmpty()){
                echo '<p class="more-courses-course-title mt-4">No courses avilable</p>';
            }
            else{
            foreach($courses as $course){
                $course_teacher_id = CoursesLecturersModel::where('course_id', $course->id)->get();
                if($course_teacher_id == null || $course_teacher_id->isEmpty()){
                    $teacher_name = " ";
                }
                else{
                foreach($course_teacher_id as $course_teacher){
                $course_teacher_details = TeacherDetails::where('user_id', $course_teacher->lecturre_id)->get();   
                foreach($course_teacher_details as $course_teacher_detail){ 
                        $teacher_name = $course_teacher_detail->name;
                }
                }
                }
                $more_courses_lessons_count = CourseLessons::where('course_id', $course->id)->count(); 
                echo '<div class="col-md-3 mt-4 ">
                <a href="'.url('course-inner/'.$course->id.'').'">
                <div class=" more-courses-container">
                <img src="'. asset('course_featured_images/'.$course->image_path.'').'" class="course-filter-featured-image">
                <p class="more-courses-course-title mt-2">'.$course->course_name.'</p>
                <p class="more-courses-course-sub">'.$teacher_name.'</p>
                <p class="more-courses-course-sub  mt-1">'.$more_courses_lessons_count.' lectures</p>';
                if($course->paymet_method == "Paid"){
                echo '<p class="more-courses-course-price mt-3"><span style="text-decoration: line-through;">RS. '.$course->normal_price.'</span> RS. '.$course->sale_price.'</p>';
                 }
                else{
                echo '<p class="more-courses-course-price mt-3">Free</p>';
                 } 
                echo '</div>
                </a>
                </div>
                 ';
                        }
                    
                }
        }
        else{
            $courses = CourseModel::where('paymet_method', 'Free')->get();
            if($courses->isEmpty()){
                echo '<p class="more-courses-course-title mt-4">No courses avilable</p>';
            }
            else{
            foreach($courses as $course){
                if(CoursesSubCategoreisModel::where("course_id", "=", $course->id)->where("category_id", "=", $request->sub_category)->exists()){
                $course_teacher_id = CoursesLecturersModel::where('course_id', $course->id)->get();
                if($course_teacher_id == null || $course_teacher_id->isEmpty()){
                    $teacher_name = " ";
                }
                else{
                foreach($course_teacher_id as $course_teacher){
                $course_teacher_details = TeacherDetails::where('user_id', $course_teacher->lecturre_id)->get();   
                foreach($course_teacher_details as $course_teacher_detail){ 
                        $teacher_name = $course_teacher_detail->name;
                }
                }
            }
                $more_courses_lessons_count = CourseLessons::where('course_id', $course->id)->count(); 
                echo '<div class="col-md-3 mt-4 ">
                <a href="'.url('course-inner/'.$course->id.'').'">
                <div class=" more-courses-container">
                <img src="'. asset('course_featured_images/'.$course->image_path.'').'" class="course-filter-featured-image">
                <p class="more-courses-course-title mt-2">'.$course->course_name.'</p>
                <p class="more-courses-course-sub">'.$teacher_name.'</p>
                <p class="more-courses-course-sub  mt-1">'.$more_courses_lessons_count.' lectures</p>';
                if($course->paymet_method == "Paid"){
                echo '<p class="more-courses-course-price mt-3"><span style="text-decoration: line-through;">RS. '.$course->normal_price.'</span> RS. '.$course->sale_price.'</p>';
                 }
                else{
                echo '<p class="more-courses-course-price mt-3">Free</p>';
                 } 
                echo '</div>
                </a>
                </div>
                 ';
                }
                }   
                } 
        }
        

    }
    else{
        if($request->sub_category == "all"){
            $courses = CourseModel::where('paymet_method', 'Free')->get();
            if($courses->isEmpty()){
                echo '<p class="more-courses-course-title mt-4">No courses avilable</p>';
            }
            else{
            foreach($courses as $course){
                if(CoursesParentCategoreisModel::where("course_id", "=", $course->id)->where("category_id", "=", $request->main_category)->exists()){
                $course_teacher_id = CoursesLecturersModel::where('course_id', $course->id)->get();
                if($course_teacher_id == null || $course_teacher_id->isEmpty()){
                    $teacher_name = " ";
                }
                else{
                foreach($course_teacher_id as $course_teacher){
                $course_teacher_details = TeacherDetails::where('user_id', $course_teacher->lecturre_id)->get();   
                foreach($course_teacher_details as $course_teacher_detail){ 
                        $teacher_name = $course_teacher_detail->name;
                }
                }
            }
                $more_courses_lessons_count = CourseLessons::where('course_id', $course->id)->count(); 
                echo '<div class="col-md-3 mt-4 ">
                <a href="'.url('course-inner/'.$course->id.'').'">
                <div class=" more-courses-container">
                <img src="'. asset('course_featured_images/'.$course->image_path.'').'" class="course-filter-featured-image">
                <p class="more-courses-course-title mt-2">'.$course->course_name.'</p>
                <p class="more-courses-course-sub">'.$teacher_name.'</p>
                <p class="more-courses-course-sub  mt-1">'.$more_courses_lessons_count.' lectures</p>';
                if($course->paymet_method == "Paid"){
                echo '<p class="more-courses-course-price mt-3"><span style="text-decoration: line-through;">RS. '.$course->normal_price.'</span> RS. '.$course->sale_price.'</p>';
                 }
                else{
                echo '<p class="more-courses-course-price mt-3">Free</p>';
                 } 
                echo '</div>
                </a>
                </div>
                 ';
                }
                }  
                } 
        }
        else{
            $courses = CourseModel::where('paymet_method', 'Free')->get();
            if($courses->isEmpty()){
                echo '<p class="more-courses-course-title mt-4">No courses avilable</p>';
            }
            else{
            foreach($courses as $course){
                if(CoursesParentCategoreisModel::where("course_id", "=", $course->id)->where("category_id", "=", $request->main_category)->exists()){
                if(CoursesSubCategoreisModel::where("course_id", "=", $course->id)->where("category_id", "=", $request->sub_category)->exists()){
                $course_teacher_id = CoursesLecturersModel::where('course_id', $course->id)->get();
                if($course_teacher_id == null || $course_teacher_id->isEmpty()){
                    $teacher_name = " ";
                }
                else{
                foreach($course_teacher_id as $course_teacher){
                $course_teacher_details = TeacherDetails::where('user_id', $course_teacher->lecturre_id)->get();   
                foreach($course_teacher_details as $course_teacher_detail){ 
                        $teacher_name = $course_teacher_detail->name;
                }
                }
            }
                $more_courses_lessons_count = CourseLessons::where('course_id', $course->id)->count(); 
                echo '<div class="col-md-3 mt-4 ">
                <a href="'.url('course-inner/'.$course->id.'').'">
                <div class=" more-courses-container">
                <img src="'. asset('course_featured_images/'.$course->image_path.'').'" class="course-filter-featured-image">
                <p class="more-courses-course-title mt-2">'.$course->course_name.'</p>
                <p class="more-courses-course-sub">'.$teacher_name.'</p>
                <p class="more-courses-course-sub  mt-1">'.$more_courses_lessons_count.' lectures</p>';
                if($course->paymet_method == "Paid"){
                echo '<p class="more-courses-course-price mt-3"><span style="text-decoration: line-through;">RS. '.$course->normal_price.'</span> RS. '.$course->sale_price.'</p>';
                 }
                else{
                echo '<p class="more-courses-course-price mt-3">Free</p>';
                 } 
                echo '</div>
                </a>
                </div>
                 ';
                }
                }
                }  
                } 
        }
         
    }
    
}
elseif($request->payment_type == "paid"){
    if($request->main_category == "all"){
        if($request->sub_category == "all"){

            $courses = CourseModel::where('paymet_method', 'Paid')->get();
            if($courses->isEmpty()){
                echo '<p class="more-courses-course-title mt-4">No courses avilable</p>';
            }
            else{
            foreach($courses as $course){
                $course_teacher_id = CoursesLecturersModel::where('course_id', $course->id)->get();
                if($course_teacher_id == null || $course_teacher_id->isEmpty()){
                    $teacher_name = " ";
                }
                else{
                foreach($course_teacher_id as $course_teacher){
                $course_teacher_details = TeacherDetails::where('user_id', $course_teacher->lecturre_id)->get();   
                foreach($course_teacher_details as $course_teacher_detail){ 
                        $teacher_name = $course_teacher_detail->name;
                }
                }
            }
                $more_courses_lessons_count = CourseLessons::where('course_id', $course->id)->count(); 
                echo '<div class="col-md-3 mt-4 ">
                <a href="'.url('course-inner/'.$course->id.'').'">
                <div class=" more-courses-container">
                <img src="'. asset('course_featured_images/'.$course->image_path.'').'" class="course-filter-featured-image">
                <p class="more-courses-course-title mt-2">'.$course->course_name.'</p>
                <p class="more-courses-course-sub">'.$teacher_name.'</p>
                <p class="more-courses-course-sub  mt-1">'.$more_courses_lessons_count.' lectures</p>';
                if($course->paymet_method == "Paid"){
                echo '<p class="more-courses-course-price mt-3"><span style="text-decoration: line-through;">RS. '.$course->normal_price.'</span> RS. '.$course->sale_price.'</p>';
                 }
                else{
                echo '<p class="more-courses-course-price mt-3">Free</p>';
                 } 
                echo '</div>
                </a>
                </div>
                 ';
                        }
                    
                }
        }
        else{
            $courses = CourseModel::where('paymet_method', 'Paid')->get();
            if($courses->isEmpty()){
                echo '<p class="more-courses-course-title mt-4">No courses avilable</p>';
            }
            else{
            foreach($courses as $course){
                if(CoursesSubCategoreisModel::where("course_id", "=", $course->id)->where("category_id", "=", $request->sub_category)->exists()){
                $course_teacher_id = CoursesLecturersModel::where('course_id', $course->id)->get();
                if($course_teacher_id == null || $course_teacher_id->isEmpty()){
                    $teacher_name = " ";
                }
                else{
                foreach($course_teacher_id as $course_teacher){
                $course_teacher_details = TeacherDetails::where('user_id', $course_teacher->lecturre_id)->get();   
                foreach($course_teacher_details as $course_teacher_detail){ 
                        $teacher_name = $course_teacher_detail->name;
                }
                }
            }
                $more_courses_lessons_count = CourseLessons::where('course_id', $course->id)->count(); 
                echo '<div class="col-md-3 mt-4 ">
                <a href="'.url('course-inner/'.$course->id.'').'">
                <div class=" more-courses-container">
                <img src="'. asset('course_featured_images/'.$course->image_path.'').'" class="course-filter-featured-image">
                <p class="more-courses-course-title mt-2">'.$course->course_name.'</p>
                <p class="more-courses-course-sub">'.$teacher_name.'</p>
                <p class="more-courses-course-sub  mt-1">'.$more_courses_lessons_count.' lectures</p>';
                if($course->paymet_method == "Paid"){
                echo '<p class="more-courses-course-price mt-3"><span style="text-decoration: line-through;">RS. '.$course->normal_price.'</span> RS. '.$course->sale_price.'</p>';
                 }
                else{
                echo '<p class="more-courses-course-price mt-3">Free</p>';
                 } 
                echo '</div>
                </a>
                </div>
                 ';
                        }
                    } 
                }   
        }


    }
    else{
        if($request->sub_category == "all"){
            $courses = CourseModel::where('paymet_method', 'Paid')->get();
            if($courses->isEmpty()){
                echo '<p class="more-courses-course-title mt-4">No courses avilable</p>';
            }
            else{
            foreach($courses as $course){
             if(CoursesParentCategoreisModel::where("course_id", "=", $course->id)->where("category_id", "=", $request->main_category)->exists()){
                $course_teacher_id = CoursesLecturersModel::where('course_id', $course->id)->get();
                if($course_teacher_id == null || $course_teacher_id->isEmpty()){
                    $teacher_name = " ";
                }
                else{
                foreach($course_teacher_id as $course_teacher){
                $course_teacher_details = TeacherDetails::where('user_id', $course_teacher->lecturre_id)->get();   
                foreach($course_teacher_details as $course_teacher_detail){ 
                        $teacher_name = $course_teacher_detail->name;
                }
                }
            }
                $more_courses_lessons_count = CourseLessons::where('course_id', $course->id)->count(); 
                echo '<div class="col-md-3 mt-4 ">
                <a href="'.url('course-inner/'.$course->id.'').'">
                <div class=" more-courses-container">
                <img src="'. asset('course_featured_images/'.$course->image_path.'').'" class="course-filter-featured-image">
                <p class="more-courses-course-title mt-2">'.$course->course_name.'</p>
                <p class="more-courses-course-sub">'.$teacher_name.'</p>
                <p class="more-courses-course-sub  mt-1">'.$more_courses_lessons_count.' lectures</p>';
                if($course->paymet_method == "Paid"){
                echo '<p class="more-courses-course-price mt-3"><span style="text-decoration: line-through;">RS. '.$course->normal_price.'</span> RS. '.$course->sale_price.'</p>';
                 }
                else{
                echo '<p class="more-courses-course-price mt-3">Free</p>';
                 } 
                echo '</div>
                </a>
                </div>
                 ';
                }
                }   
            }
        }
        else{
            $courses = CourseModel::where('paymet_method', 'Paid')->get();
            if($courses->isEmpty()){
                echo '<p class="more-courses-course-title mt-4">No courses avilable</p>';
            }
            else{
            foreach($courses as $course){
             if(CoursesParentCategoreisModel::where("course_id", "=", $course->id)->where("category_id", "=", $request->main_category)->exists()){
                if(CoursesSubCategoreisModel::where("course_id", "=", $course->id)->where("category_id", "=", $request->sub_category)->exists()){
                $course_teacher_id = CoursesLecturersModel::where('course_id', $course->id)->get();
                if($course_teacher_id == null || $course_teacher_id->isEmpty()){
                    $teacher_name = " ";
                }
                else{
                foreach($course_teacher_id as $course_teacher){
                $course_teacher_details = TeacherDetails::where('user_id', $course_teacher->lecturre_id)->get();   
                foreach($course_teacher_details as $course_teacher_detail){ 
                        $teacher_name = $course_teacher_detail->name;
                }
                }
            }
                $more_courses_lessons_count = CourseLessons::where('course_id', $course->id)->count(); 
                echo '<div class="col-md-3 mt-4 ">
                <a href="'.url('course-inner/'.$course->id.'').'">
                <div class=" more-courses-container">
                <img src="'. asset('course_featured_images/'.$course->image_path.'').'" class="course-filter-featured-image">
                <p class="more-courses-course-title mt-2">'.$course->course_name.'</p>
                <p class="more-courses-course-sub">'.$teacher_name.'</p>
                <p class="more-courses-course-sub  mt-1">'.$more_courses_lessons_count.' lectures</p>';
                if($course->paymet_method == "Paid"){
                echo '<p class="more-courses-course-price mt-3"><span style="text-decoration: line-through;">RS. '.$course->normal_price.'</span> RS. '.$course->sale_price.'</p>';
                 }
                else{
                echo '<p class="more-courses-course-price mt-3">Free</p>';
                 } 
                echo '</div>
                </a>
                </div>
                 ';
                }
                }
                }   
            } 
        }
          
    }
    
}
}
elseif($request->course_type == "bundle"){
    if($request->payment_type == "all"){
    if($request->main_category == "all"){

        if($request->sub_category == "all"){
            $course_bundles = CourseBundleMainModel::get();
            if($course_bundles->isEmpty()){
                echo '<p class="more-courses-course-title mt-4">No courses avilable</p>';
            }
            else{
            foreach($course_bundles as $course_bundle){
            $course_bundle_count = CourseBundleCourses::where('bundle_id', $course_bundle->id)->count();
                echo '<div class="col-md-3 mt-4 ">
                        <a href="'. url('course-bundle-inner/'.$course_bundle->id.'') .'">
                        <div class=" more-courses-container">
                        <img src="'. asset('course_bundle_images/'.$course_bundle->featured_image.'') .'" class="course-filter-featured-image">
                        <p class="more-courses-course-title mt-2">'.$course_bundle->bundle_name.'</p>
                        <p class="more-courses-course-sub">Course Bundle</p>
                        <p class="more-courses-course-sub  mt-1">'.$course_bundle_count.' Courses</p>
                        <p class="more-courses-course-price mt-3">RS. '.$course_bundle->price.'</p>
                        </div>
                        </a>
                        </div>';
            } 
            }
        }
        else{
            $course_bundles = CourseBundleMainModel::get();
            if($course_bundles->isEmpty()){
                echo '<p class="more-courses-course-title mt-4">No courses avilable</p>';
            }
            else{
            foreach($course_bundles as $course_bundle){
            if(CourseBundleSubCategoreis::where("bundle_id", "=", $course_bundle->id)->where("category_id", "=", $request->sub_category)->exists()){    
            $course_bundle_count = CourseBundleCourses::where('bundle_id', $course_bundle->id)->count();
                echo '<div class="col-md-3 mt-4 ">
                        <a href="'. url('course-bundle-inner/'.$course_bundle->id.'') .'">
                        <div class=" more-courses-container">
                        <img src="'. asset('course_bundle_images/'.$course_bundle->featured_image.'') .'" class="course-filter-featured-image">
                        <p class="more-courses-course-title mt-2">'.$course_bundle->bundle_name.'</p>
                        <p class="more-courses-course-sub">Course Bundle</p>
                        <p class="more-courses-course-sub  mt-1">'.$course_bundle_count.' Courses</p>
                        <p class="more-courses-course-price mt-3">RS. '.$course_bundle->price.'</p>
                        </div>
                        </a>
                        </div>';
            }
            } 
            }  
        }
        
    }
    else{
        if($request->sub_category == "all"){
            $course_bundles = CourseBundleMainModel::get();
            if($course_bundles->isEmpty()){
                echo '<p class="more-courses-course-title mt-4">No courses avilable</p>';
            }
            else{
            foreach($course_bundles as $course_bundle){
            if(CourseBundleParentCategoreis::where("bundle_id", "=", $course_bundle->id)->where("category_id", "=", $request->main_category)->exists()){
           
                $course_bundle_count = CourseBundleCourses::where('bundle_id', $course_bundle->id)->count();
                echo '<div class="col-md-3 mt-4 ">
                        <a href="'. url('course-bundle-inner/'.$course_bundle->id.'') .'">
                        <div class=" more-courses-container">
                        <img src="'. asset('course_bundle_images/'.$course_bundle->featured_image.'') .'" class="course-filter-featured-image">
                        <p class="more-courses-course-title mt-2">'.$course_bundle->bundle_name.'</p>
                        <p class="more-courses-course-sub">Course Bundle</p>
                        <p class="more-courses-course-sub  mt-1">'.$course_bundle_count.' Courses</p>
                        <p class="more-courses-course-price mt-3">RS. '.$course_bundle->price.'</p>
                        </div>
                        </a>
                        </div>';
            
            }
            } 
            }
        }
        else{
            $course_bundles = CourseBundleMainModel::get();
            if($course_bundles->isEmpty()){
                echo '<p class="more-courses-course-title mt-4">No courses avilable</p>';
            }
            else{
            foreach($course_bundles as $course_bundle){
            if(CourseBundleParentCategoreis::where("bundle_id", "=", $course_bundle->id)->where("category_id", "=", $request->main_category)->exists()){
            if(CourseBundleSubCategoreis::where("bundle_id", "=", $course_bundle->id)->where("category_id", "=", $request->sub_category)->exists()){    
                $course_bundle_count = CourseBundleCourses::where('bundle_id', $course_bundle->id)->count();
                echo '<div class="col-md-3 mt-4 ">
                        <a href="'. url('course-bundle-inner/'.$course_bundle->id.'') .'">
                        <div class=" more-courses-container">
                        <img src="'. asset('course_bundle_images/'.$course_bundle->featured_image.'') .'" class="course-filter-featured-image">
                        <p class="more-courses-course-title mt-2">'.$course_bundle->bundle_name.'</p>
                        <p class="more-courses-course-sub">Course Bundle</p>
                        <p class="more-courses-course-sub  mt-1">'.$course_bundle_count.' Courses</p>
                        <p class="more-courses-course-price mt-3">RS. '.$course_bundle->price.'</p>
                        </div>
                        </a>
                        </div>';
        }
        }
        } 
        }  
        }
        
    }
    }    
    elseif($request->payment_type == "free"){
        if($request->main_category == "all"){

            if($request->sub_category == "all"){
                $course_bundles = CourseBundleMainModel::where('price' , null)->get();
                if($course_bundles->isEmpty()){
                    echo '<p class="more-courses-course-title mt-4">No courses avilable</p>';
                }
                else{
                foreach($course_bundles as $course_bundle){
                $course_bundle_count = CourseBundleCourses::where('bundle_id', $course_bundle->id)->count();
                    echo '<div class="col-md-3 mt-4 ">
                            <a href="'. url('course-bundle-inner/'.$course_bundle->id.'') .'">
                            <div class=" more-courses-container">
                            <img src="'. asset('course_bundle_images/'.$course_bundle->featured_image.'') .'" class="course-filter-featured-image">
                            <p class="more-courses-course-title mt-2">'.$course_bundle->bundle_name.'</p>
                            <p class="more-courses-course-sub">Course Bundle</p>
                            <p class="more-courses-course-sub  mt-1">'.$course_bundle_count.' Courses</p>
                            <p class="more-courses-course-price mt-3">RS. '.$course_bundle->price.'</p>
                            </div>
                            </a>
                            </div>';
                } 
                }
            }
            else{
                $course_bundles = CourseBundleMainModel::where('price' , null)->get();
                if($course_bundles->isEmpty()){
                    echo '<p class="more-courses-course-title mt-4">No courses avilable</p>';
                }
                else{
                foreach($course_bundles as $course_bundle){
                if(CourseBundleSubCategoreis::where("bundle_id", "=", $course_bundle->id)->where("category_id", "=", $request->sub_category)->exists()){    
                $course_bundle_count = CourseBundleCourses::where('bundle_id', $course_bundle->id)->count();
                    echo '<div class="col-md-3 mt-4 ">
                            <a href="'. url('course-bundle-inner/'.$course_bundle->id.'') .'">
                            <div class=" more-courses-container">
                            <img src="'. asset('course_bundle_images/'.$course_bundle->featured_image.'') .'" class="course-filter-featured-image">
                            <p class="more-courses-course-title mt-2">'.$course_bundle->bundle_name.'</p>
                            <p class="more-courses-course-sub">Course Bundle</p>
                            <p class="more-courses-course-sub  mt-1">'.$course_bundle_count.' Courses</p>
                            <p class="more-courses-course-price mt-3">RS. '.$course_bundle->price.'</p>
                            </div>
                            </a>
                            </div>';
                } 
                }
                } 
            }
               
        }
        else{
            if($request->sub_category == "all"){
                $course_bundles = CourseBundleMainModel::where('price' , null)->get();
                if($course_bundles->isEmpty()){
                    echo '<p class="more-courses-course-title mt-4">No courses avilable</p>';
                }
                else{
                foreach($course_bundles as $course_bundle){
                if(CourseBundleParentCategoreis::where("bundle_id", "=", $course_bundle->id)->where("category_id", "=", $request->main_category)->exists()){
                $course_bundle_count = CourseBundleCourses::where('bundle_id', $course_bundle->id)->count();
                    echo '<div class="col-md-3 mt-4 ">
                            <a href="'. url('course-bundle-inner/'.$course_bundle->id.'') .'">
                            <div class=" more-courses-container">
                            <img src="'. asset('course_bundle_images/'.$course_bundle->featured_image.'') .'" class="course-filter-featured-image">
                            <p class="more-courses-course-title mt-2">'.$course_bundle->bundle_name.'</p>
                            <p class="more-courses-course-sub">Course Bundle</p>
                            <p class="more-courses-course-sub  mt-1">'.$course_bundle_count.' Courses</p>
                            <p class="more-courses-course-price mt-3">RS. '.$course_bundle->price.'</p>
                            </div>
                            </a>
                            </div>';
            } 
            }
            }  
            }
            else{
                $course_bundles = CourseBundleMainModel::where('price' , null)->get();
                if($course_bundles->isEmpty()){
                    echo '<p class="more-courses-course-title mt-4">No courses avilable</p>';
                }
                else{
                foreach($course_bundles as $course_bundle){
                if(CourseBundleParentCategoreis::where("bundle_id", "=", $course_bundle->id)->where("category_id", "=", $request->main_category)->exists()){
                if(CourseBundleSubCategoreis::where("bundle_id", "=", $course_bundle->id)->where("category_id", "=", $request->sub_category)->exists()){    
                $course_bundle_count = CourseBundleCourses::where('bundle_id', $course_bundle->id)->count();
                    echo '<div class="col-md-3 mt-4 ">
                            <a href="'. url('course-bundle-inner/'.$course_bundle->id.'') .'">
                            <div class=" more-courses-container">
                            <img src="'. asset('course_bundle_images/'.$course_bundle->featured_image.'') .'" class="course-filter-featured-image">
                            <p class="more-courses-course-title mt-2">'.$course_bundle->bundle_name.'</p>
                            <p class="more-courses-course-sub">Course Bundle</p>
                            <p class="more-courses-course-sub  mt-1">'.$course_bundle_count.' Courses</p>
                            <p class="more-courses-course-price mt-3">RS. '.$course_bundle->price.'</p>
                            </div>
                            </a>
                            </div>';
            } 
            }
            }
            }    
            }
            
        }
       
    }
    elseif($request->payment_type == "paid"){
        if($request->main_category == "all"){
            
            if($request->sub_category == "all"){
                $course_bundles = CourseBundleMainModel::get();
                if($course_bundles->isEmpty()){
                    echo '<p class="more-courses-course-title mt-4">No courses avilable</p>';
                }
                else{
                foreach($course_bundles as $course_bundle){
                $course_bundle_count = CourseBundleCourses::where('bundle_id', $course_bundle->id)->count();
                    echo '<div class="col-md-3 mt-4 ">
                            <a href="'. url('course-bundle-inner/'.$course_bundle->id.'') .'">
                            <div class=" more-courses-container">
                            <img src="'. asset('course_bundle_images/'.$course_bundle->featured_image.'') .'" class="course-filter-featured-image">
                            <p class="more-courses-course-title mt-2">'.$course_bundle->bundle_name.'</p>
                            <p class="more-courses-course-sub">Course Bundle</p>
                            <p class="more-courses-course-sub  mt-1">'.$course_bundle_count.' Courses</p>
                            <p class="more-courses-course-price mt-3">RS. '.$course_bundle->price.'</p>
                            </div>
                            </a>
                            </div>';
                } 
                }
            }
            else{
                $course_bundles = CourseBundleMainModel::get();
                if($course_bundles->isEmpty()){
                    echo '<p class="more-courses-course-title mt-4">No courses avilable</p>';
                }
                else{
                foreach($course_bundles as $course_bundle){
                    if(CourseBundleSubCategoreis::where("bundle_id", "=", $course_bundle->id)->where("category_id", "=", $request->sub_category)->exists()){    
                $course_bundle_count = CourseBundleCourses::where('bundle_id', $course_bundle->id)->count();
                    echo '<div class="col-md-3 mt-4 ">
                            <a href="'. url('course-bundle-inner/'.$course_bundle->id.'') .'">
                            <div class=" more-courses-container">
                            <img src="'. asset('course_bundle_images/'.$course_bundle->featured_image.'') .'" class="course-filter-featured-image">
                            <p class="more-courses-course-title mt-2">'.$course_bundle->bundle_name.'</p>
                            <p class="more-courses-course-sub">Course Bundle</p>
                            <p class="more-courses-course-sub  mt-1">'.$course_bundle_count.' Courses</p>
                            <p class="more-courses-course-price mt-3">RS. '.$course_bundle->price.'</p>
                            </div>
                            </a>
                            </div>';
                } 
            }
                } 
            }
            
        }
        else{
            if($request->sub_category == "all"){
                $course_bundles = CourseBundleMainModel::get();
                if($course_bundles->isEmpty()){
                    echo '<p class="more-courses-course-title mt-4">No courses avilable</p>';
                }
                else{
                foreach($course_bundles as $course_bundle){
                if(CourseBundleParentCategoreis::where("bundle_id", "=", $course_bundle->id)->where("category_id", "=", $request->main_category)->exists()){
                $course_bundle_count = CourseBundleCourses::where('bundle_id', $course_bundle->id)->count();
                    echo '<div class="col-md-3 mt-4 ">
                            <a href="'. url('course-bundle-inner/'.$course_bundle->id.'') .'">
                            <div class=" more-courses-container">
                            <img src="'. asset('course_bundle_images/'.$course_bundle->featured_image.'') .'" class="course-filter-featured-image">
                            <p class="more-courses-course-title mt-2">'.$course_bundle->bundle_name.'</p>
                            <p class="more-courses-course-sub">Course Bundle</p>
                            <p class="more-courses-course-sub  mt-1">'.$course_bundle_count.' Courses</p>
                            <p class="more-courses-course-price mt-3">RS. '.$course_bundle->price.'</p>
                            </div>
                            </a>
                            </div>';
            } 
            }
            }
            }
         else{
        $course_bundles = CourseBundleMainModel::get();
                if($course_bundles->isEmpty()){
                    echo '<p class="more-courses-course-title mt-4">No courses avilable</p>';
                }
                else{
                foreach($course_bundles as $course_bundle){
                if(CourseBundleParentCategoreis::where("bundle_id", "=", $course_bundle->id)->where("category_id", "=", $request->main_category)->exists()){
                    if(CourseBundleSubCategoreis::where("bundle_id", "=", $course_bundle->id)->where("category_id", "=", $request->sub_category)->exists()){    
                $course_bundle_count = CourseBundleCourses::where('bundle_id', $course_bundle->id)->count();
                    echo '<div class="col-md-3 mt-4 ">
                            <a href="'. url('course-bundle-inner/'.$course_bundle->id.'') .'">
                            <div class=" more-courses-container">
                            <img src="'. asset('course_bundle_images/'.$course_bundle->featured_image.'') .'" class="course-filter-featured-image">
                            <p class="more-courses-course-title mt-2">'.$course_bundle->bundle_name.'</p>
                            <p class="more-courses-course-sub">Course Bundle</p>
                            <p class="more-courses-course-sub  mt-1">'.$course_bundle_count.' Courses</p>
                            <p class="more-courses-course-price mt-3">RS. '.$course_bundle->price.'</p>
                            </div>
                            </a>
                            </div>';
            } 
        }
            }
            }
         }
        }
   
    }

}
elseif($request->course_type == "all"){
    if($request->payment_type == "all"){
        if($request->main_category == "all"){

        if($request->sub_category == "all"){
            $courses = CourseModel::get();
            $course_bundles = CourseBundleMainModel::get();
            if($courses->isEmpty() && $course_bundles->isEmpty()){
                echo '<p class="more-courses-course-title mt-4">No courses avilable</p>';
            }
            else{
            foreach($courses as $course){
            $course_teacher_id = CoursesLecturersModel::where('course_id', $course->id)->get();
            if($course_teacher_id == null || $course_teacher_id->isEmpty()){
                $teacher_name = " ";
            }
            else{
            foreach($course_teacher_id as $course_teacher){
            $course_teacher_details = TeacherDetails::where('user_id', $course_teacher->lecturre_id)->get();   
            foreach($course_teacher_details as $course_teacher_detail){ 
                    $teacher_name = $course_teacher_detail->name;
            }
            }
        }
            $more_courses_lessons_count = CourseLessons::where('course_id', $course->id)->count(); 
            echo '<div class="col-md-3 mt-4 ">
            <a href="'.url('course-inner/'.$course->id.'').'">
            <div class=" more-courses-container">
            <img src="'. asset('course_featured_images/'.$course->image_path.'').'" class="course-filter-featured-image">
            <p class="more-courses-course-title mt-2">'.$course->course_name.'</p>
            <p class="more-courses-course-sub">'.$teacher_name.'</p>
            <p class="more-courses-course-sub  mt-1">'.$more_courses_lessons_count.' lectures</p>';
            if($course->paymet_method == "Paid"){
            echo '<p class="more-courses-course-price mt-3"><span style="text-decoration: line-through;">RS. '.$course->normal_price.'</span> RS. '.$course->sale_price.'</p>';
             }
            else{
            echo '<p class="more-courses-course-price mt-3">Free</p>';
             } 
            echo '</div>
            </a>
            </div>
             ';
                    }
            foreach($course_bundles as $course_bundle){
            $course_bundle_count = CourseBundleCourses::where('bundle_id', $course_bundle->id)->count();
                echo '<div class="col-md-3 mt-4 ">
                        <a href="'. url('course-bundle-inner/'.$course_bundle->id.'') .'">
                        <div class=" more-courses-container">
                        <img src="'. asset('course_bundle_images/'.$course_bundle->featured_image.'') .'" class="course-filter-featured-image">
                        <p class="more-courses-course-title mt-2">'.$course_bundle->bundle_name.'</p>
                        <p class="more-courses-course-sub">Course Bundle</p>
                        <p class="more-courses-course-sub  mt-1">'.$course_bundle_count.' Courses</p>
                        <p class="more-courses-course-price mt-3">RS. '.$course_bundle->price.'</p>
                        </div>
                        </a>
                        </div>';
            }
        }
        }
        else{
            $courses = CourseModel::get();
            $course_bundles = CourseBundleMainModel::get();
            if($courses->isEmpty() && $course_bundles->isEmpty()){
                echo '<p class="more-courses-course-title mt-4">No courses avilable</p>';
            }
            else{
            foreach($courses as $course){
            if(CoursesSubCategoreisModel::where("course_id", "=", $course->id)->where("category_id", "=", $request->sub_category)->exists()){
            $course_teacher_id = CoursesLecturersModel::where('course_id', $course->id)->get();
            if($course_teacher_id == null || $course_teacher_id->isEmpty()){
                $teacher_name = " ";
            }
            else{
            foreach($course_teacher_id as $course_teacher){
            $course_teacher_details = TeacherDetails::where('user_id', $course_teacher->lecturre_id)->get();   
            foreach($course_teacher_details as $course_teacher_detail){ 
                    $teacher_name = $course_teacher_detail->name;
            }
            }
        }
            $more_courses_lessons_count = CourseLessons::where('course_id', $course->id)->count(); 
            echo '<div class="col-md-3 mt-4 ">
            <a href="'.url('course-inner/'.$course->id.'').'">
            <div class=" more-courses-container">
            <img src="'. asset('course_featured_images/'.$course->image_path.'').'" class="course-filter-featured-image">
            <p class="more-courses-course-title mt-2">'.$course->course_name.'</p>
            <p class="more-courses-course-sub">'.$teacher_name.'</p>
            <p class="more-courses-course-sub  mt-1">'.$more_courses_lessons_count.' lectures</p>';
            if($course->paymet_method == "Paid"){
            echo '<p class="more-courses-course-price mt-3"><span style="text-decoration: line-through;">RS. '.$course->normal_price.'</span> RS. '.$course->sale_price.'</p>';
             }
            else{
            echo '<p class="more-courses-course-price mt-3">Free</p>';
             } 
            echo '</div>
            </a>
            </div>
             ';
            }
            }
            foreach($course_bundles as $course_bundle){
            if(CourseBundleSubCategoreis::where("bundle_id", "=", $course_bundle->id)->where("category_id", "=", $request->sub_category)->exists()){    
            $course_bundle_count = CourseBundleCourses::where('bundle_id', $course_bundle->id)->count();
                echo '<div class="col-md-3 mt-4 ">
                        <a href="'. url('course-bundle-inner/'.$course_bundle->id.'') .'">
                        <div class=" more-courses-container">
                        <img src="'. asset('course_bundle_images/'.$course_bundle->featured_image.'') .'" class="course-filter-featured-image">
                        <p class="more-courses-course-title mt-2">'.$course_bundle->bundle_name.'</p>
                        <p class="more-courses-course-sub">Course Bundle</p>
                        <p class="more-courses-course-sub  mt-1">'.$course_bundle_count.' Courses</p>
                        <p class="more-courses-course-price mt-3">RS. '.$course_bundle->price.'</p>
                        </div>
                        </a>
                        </div>';
            }
        }
        }
        } 
        }
        else{
            if($request->sub_category == "all"){
                $courses = CourseModel::get();
                $course_bundles = CourseBundleMainModel::get();
                if($courses->isEmpty() && $course_bundles->isEmpty()){
                    echo '<p class="more-courses-course-title mt-4">No courses avilable</p>';
                }
                else{
                foreach($courses as $course){
                if(CoursesParentCategoreisModel::where("course_id", "=", $course->id)->where("category_id", "=", $request->main_category)->exists()){
                $course_teacher_id = CoursesLecturersModel::where('course_id', $course->id)->get();
                if($course_teacher_id == null || $course_teacher_id->isEmpty()){
                    $teacher_name = " ";
                }
                else{
                foreach($course_teacher_id as $course_teacher){
                $course_teacher_details = TeacherDetails::where('user_id', $course_teacher->lecturre_id)->get();   
                foreach($course_teacher_details as $course_teacher_detail){ 
                        $teacher_name = $course_teacher_detail->name;
                }
                }
            }
                $more_courses_lessons_count = CourseLessons::where('course_id', $course->id)->count(); 
                echo '<div class="col-md-3 mt-4 ">
                <a href="'.url('course-inner/'.$course->id.'').'">
                <div class=" more-courses-container">
                <img src="'. asset('course_featured_images/'.$course->image_path.'').'" class="course-filter-featured-image">
                <p class="more-courses-course-title mt-2">'.$course->course_name.'</p>
                <p class="more-courses-course-sub">'.$teacher_name.'</p>
                <p class="more-courses-course-sub  mt-1">'.$more_courses_lessons_count.' lectures</p>';
                if($course->paymet_method == "Paid"){
                echo '<p class="more-courses-course-price mt-3"><span style="text-decoration: line-through;">RS. '.$course->normal_price.'</span> RS. '.$course->sale_price.'</p>';
                 }
                else{
                echo '<p class="more-courses-course-price mt-3">Free</p>';
                 } 
                echo '</div>
                </a>
                </div>
                 ';
                }
                }
                foreach($course_bundles as $course_bundle){
                if(CourseBundleParentCategoreis::where("bundle_id", "=", $course_bundle->id)->where("category_id", "=", $request->main_category)->exists()){
                $course_bundle_count = CourseBundleCourses::where('bundle_id', $course_bundle->id)->count();
                    echo '<div class="col-md-3 mt-4 ">
                            <a href="'. url('course-bundle-inner/'.$course_bundle->id.'') .'">
                            <div class=" more-courses-container">
                            <img src="'. asset('course_bundle_images/'.$course_bundle->featured_image.'') .'" class="course-filter-featured-image">
                            <p class="more-courses-course-title mt-2">'.$course_bundle->bundle_name.'</p>
                            <p class="more-courses-course-sub">Course Bundle</p>
                            <p class="more-courses-course-sub  mt-1">'.$course_bundle_count.' Courses</p>
                            <p class="more-courses-course-price mt-3">RS. '.$course_bundle->price.'</p>
                            </div>
                            </a>
                            </div>';
            }
            }
            } 
            }
            else{
                $courses = CourseModel::get();
                $course_bundles = CourseBundleMainModel::get();
                if($courses->isEmpty() && $course_bundles->isEmpty()){
                    echo '<p class="more-courses-course-title mt-4">No courses avilable</p>';
                }
                else{
                foreach($courses as $course){
                if(CoursesParentCategoreisModel::where("course_id", "=", $course->id)->where("category_id", "=", $request->main_category)->exists()){
                if(CoursesSubCategoreisModel::where("course_id", "=", $course->id)->where("category_id", "=", $request->sub_category)->exists()){
                $course_teacher_id = CoursesLecturersModel::where('course_id', $course->id)->get();
                if($course_teacher_id == null || $course_teacher_id->isEmpty()){
                    $teacher_name = " ";
                }
                else{
                foreach($course_teacher_id as $course_teacher){
                $course_teacher_details = TeacherDetails::where('user_id', $course_teacher->lecturre_id)->get();   
                foreach($course_teacher_details as $course_teacher_detail){ 
                        $teacher_name = $course_teacher_detail->name;
                }
                }
            }
                $more_courses_lessons_count = CourseLessons::where('course_id', $course->id)->count(); 
                echo '<div class="col-md-3 mt-4 ">
                <a href="'.url('course-inner/'.$course->id.'').'">
                <div class=" more-courses-container">
                <img src="'. asset('course_featured_images/'.$course->image_path.'').'" class="course-filter-featured-image">
                <p class="more-courses-course-title mt-2">'.$course->course_name.'</p>
                <p class="more-courses-course-sub">'.$teacher_name.'</p>
                <p class="more-courses-course-sub  mt-1">'.$more_courses_lessons_count.' lectures</p>';
                if($course->paymet_method == "Paid"){
                echo '<p class="more-courses-course-price mt-3"><span style="text-decoration: line-through;">RS. '.$course->normal_price.'</span> RS. '.$course->sale_price.'</p>';
                 }
                else{
                echo '<p class="more-courses-course-price mt-3">Free</p>';
                 } 
                echo '</div>
                </a>
                </div>
                 ';
                }
                }
                }
                foreach($course_bundles as $course_bundle){
                if(CourseBundleParentCategoreis::where("bundle_id", "=", $course_bundle->id)->where("category_id", "=", $request->main_category)->exists()){
                if(CourseBundleSubCategoreis::where("bundle_id", "=", $course_bundle->id)->where("category_id", "=", $request->sub_category)->exists()){
                $course_bundle_count = CourseBundleCourses::where('bundle_id', $course_bundle->id)->count();
                    echo '<div class="col-md-3 mt-4 ">
                            <a href="'. url('course-bundle-inner/'.$course_bundle->id.'') .'">
                            <div class=" more-courses-container">
                            <img src="'. asset('course_bundle_images/'.$course_bundle->featured_image.'') .'" class="course-filter-featured-image">
                            <p class="more-courses-course-title mt-2">'.$course_bundle->bundle_name.'</p>
                            <p class="more-courses-course-sub">Course Bundle</p>
                            <p class="more-courses-course-sub  mt-1">'.$course_bundle_count.' Courses</p>
                            <p class="more-courses-course-price mt-3">RS. '.$course_bundle->price.'</p>
                            </div>
                            </a>
                            </div>';
                }
            }
            }
            }  
            }  
        }
        
    }
    if($request->payment_type == "free"){
        if($request->main_category == "all"){
            if($request->sub_category == "all"){
                $courses = CourseModel::where('paymet_method', 'Free')->get();
                $course_bundles = CourseBundleMainModel::where('price' , null)->get();
                if($courses->isEmpty() && $course_bundles->isEmpty()){
                    echo '<p class="more-courses-course-title mt-4">No courses avilable</p>';
                }
                else{
                foreach($courses as $course){
                $course_teacher_id = CoursesLecturersModel::where('course_id', $course->id)->get();
                if($course_teacher_id == null || $course_teacher_id->isEmpty()){
                    $teacher_name = " ";
                }
                else{
                foreach($course_teacher_id as $course_teacher){
                $course_teacher_details = TeacherDetails::where('user_id', $course_teacher->lecturre_id)->get();   
                foreach($course_teacher_details as $course_teacher_detail){ 
                        $teacher_name = $course_teacher_detail->name;
                }
                }
            }
                $more_courses_lessons_count = CourseLessons::where('course_id', $course->id)->count(); 
                echo '<div class="col-md-3 mt-4 ">
                <a href="'.url('course-inner/'.$course->id.'').'">
                <div class=" more-courses-container">
                <img src="'. asset('course_featured_images/'.$course->image_path.'').'" class="course-filter-featured-image">
                <p class="more-courses-course-title mt-2">'.$course->course_name.'</p>
                <p class="more-courses-course-sub">'.$teacher_name.'</p>
                <p class="more-courses-course-sub  mt-1">'.$more_courses_lessons_count.' lectures</p>';
                if($course->paymet_method == "Paid"){
                echo '<p class="more-courses-course-price mt-3"><span style="text-decoration: line-through;">RS. '.$course->normal_price.'</span> RS. '.$course->sale_price.'</p>';
                 }
                else{
                echo '<p class="more-courses-course-price mt-3">Free</p>';
                 } 
                echo '</div>
                </a>
                </div>
                 ';
                        }
                foreach($course_bundles as $course_bundle){
                $course_bundle_count = CourseBundleCourses::where('bundle_id', $course_bundle->id)->count();
                    echo '<div class="col-md-3 mt-4 ">
                            <a href="'. url('course-bundle-inner/'.$course_bundle->id.'') .'">
                            <div class=" more-courses-container">
                            <img src="'. asset('course_bundle_images/'.$course_bundle->featured_image.'') .'" class="course-filter-featured-image">
                            <p class="more-courses-course-title mt-2">'.$course_bundle->bundle_name.'</p>
                            <p class="more-courses-course-sub">Course Bundle</p>
                            <p class="more-courses-course-sub  mt-1">'.$course_bundle_count.' Courses</p>
                            <p class="more-courses-course-price mt-3">RS. '.$course_bundle->price.'</p>
                            </div>
                            </a>
                            </div>';
                }
            }
            }
            else{
                $courses = CourseModel::where('paymet_method', 'Free')->get();
                $course_bundles = CourseBundleMainModel::where('price' , null)->get();
                if($courses->isEmpty() && $course_bundles->isEmpty()){
                    echo '<p class="more-courses-course-title mt-4">No courses avilable</p>';
                }
                else{
                foreach($courses as $course){
                if(CoursesSubCategoreisModel::where("course_id", "=", $course->id)->where("category_id", "=", $request->sub_category)->exists()){
                $course_teacher_id = CoursesLecturersModel::where('course_id', $course->id)->get();
                if($course_teacher_id == null || $course_teacher_id->isEmpty()){
                    $teacher_name = " ";
                }
                else{
                foreach($course_teacher_id as $course_teacher){
                $course_teacher_details = TeacherDetails::where('user_id', $course_teacher->lecturre_id)->get();   
                foreach($course_teacher_details as $course_teacher_detail){ 
                        $teacher_name = $course_teacher_detail->name;
                }
                }
            }
                $more_courses_lessons_count = CourseLessons::where('course_id', $course->id)->count(); 
                echo '<div class="col-md-3 mt-4 ">
                <a href="'.url('course-inner/'.$course->id.'').'">
                <div class=" more-courses-container">
                <img src="'. asset('course_featured_images/'.$course->image_path.'').'" class="course-filter-featured-image">
                <p class="more-courses-course-title mt-2">'.$course->course_name.'</p>
                <p class="more-courses-course-sub">'.$teacher_name.'</p>
                <p class="more-courses-course-sub  mt-1">'.$more_courses_lessons_count.' lectures</p>';
                if($course->paymet_method == "Paid"){
                echo '<p class="more-courses-course-price mt-3"><span style="text-decoration: line-through;">RS. '.$course->normal_price.'</span> RS. '.$course->sale_price.'</p>';
                 }
                else{
                echo '<p class="more-courses-course-price mt-3">Free</p>';
                 } 
                echo '</div>
                </a>
                </div>
                 ';
                }
                }
                foreach($course_bundles as $course_bundle){
                if(CourseBundleSubCategoreis::where("bundle_id", "=", $course_bundle->id)->where("category_id", "=", $request->sub_category)->exists()){
                $course_bundle_count = CourseBundleCourses::where('bundle_id', $course_bundle->id)->count();
                    echo '<div class="col-md-3 mt-4 ">
                            <a href="'. url('course-bundle-inner/'.$course_bundle->id.'') .'">
                            <div class=" more-courses-container">
                            <img src="'. asset('course_bundle_images/'.$course_bundle->featured_image.'') .'" class="course-filter-featured-image">
                            <p class="more-courses-course-title mt-2">'.$course_bundle->bundle_name.'</p>
                            <p class="more-courses-course-sub">Course Bundle</p>
                            <p class="more-courses-course-sub  mt-1">'.$course_bundle_count.' Courses</p>
                            <p class="more-courses-course-price mt-3">RS. '.$course_bundle->price.'</p>
                            </div>
                            </a>
                            </div>';
                }
            }
            }  
            }
            
        }
        else{
            if($request->sub_category == "all"){
                $courses = CourseModel::where('paymet_method', 'Free')->get();
                $course_bundles = CourseBundleMainModel::where('price' , null)->get();
                if($courses->isEmpty() && $course_bundles->isEmpty()){
                    echo '<p class="more-courses-course-title mt-4">No courses avilable</p>';
                }
                else{
                foreach($courses as $course){
                if(CoursesParentCategoreisModel::where("course_id", "=", $course->id)->where("category_id", "=", $request->main_category)->exists()){
                $course_teacher_id = CoursesLecturersModel::where('course_id', $course->id)->get();
                if($course_teacher_id == null || $course_teacher_id->isEmpty()){
                    $teacher_name = " ";
                }
                else{
                foreach($course_teacher_id as $course_teacher){
                $course_teacher_details = TeacherDetails::where('user_id', $course_teacher->lecturre_id)->get();   
                foreach($course_teacher_details as $course_teacher_detail){ 
                        $teacher_name = $course_teacher_detail->name;
                }
                }
            }
                $more_courses_lessons_count = CourseLessons::where('course_id', $course->id)->count(); 
                echo '<div class="col-md-3 mt-4 ">
                <a href="'.url('course-inner/'.$course->id.'').'">
                <div class=" more-courses-container">
                <img src="'. asset('course_featured_images/'.$course->image_path.'').'" class="course-filter-featured-image">
                <p class="more-courses-course-title mt-2">'.$course->course_name.'</p>
                <p class="more-courses-course-sub">'.$teacher_name.'</p>
                <p class="more-courses-course-sub  mt-1">'.$more_courses_lessons_count.' lectures</p>';
                if($course->paymet_method == "Paid"){
                echo '<p class="more-courses-course-price mt-3"><span style="text-decoration: line-through;">RS. '.$course->normal_price.'</span> RS. '.$course->sale_price.'</p>';
                 }
                else{
                echo '<p class="more-courses-course-price mt-3">Free</p>';
                 } 
                echo '</div>
                </a>
                </div>
                 ';
                }
                }
                foreach($course_bundles as $course_bundle){
                if(CourseBundleParentCategoreis::where("bundle_id", "=", $course_bundle->id)->where("category_id", "=", $request->main_category)->exists()){
                $course_bundle_count = CourseBundleCourses::where('bundle_id', $course_bundle->id)->count();
                    echo '<div class="col-md-3 mt-4 ">
                            <a href="'. url('course-bundle-inner/'.$course_bundle->id.'') .'">
                            <div class=" more-courses-container">
                            <img src="'. asset('course_bundle_images/'.$course_bundle->featured_image.'') .'" class="course-filter-featured-image">
                            <p class="more-courses-course-title mt-2">'.$course_bundle->bundle_name.'</p>
                            <p class="more-courses-course-sub">Course Bundle</p>
                            <p class="more-courses-course-sub  mt-1">'.$course_bundle_count.' Courses</p>
                            <p class="more-courses-course-price mt-3">RS. '.$course_bundle->price.'</p>
                            </div>
                            </a>
                            </div>';
                }
            }
            } 
            }
            else{
                $courses = CourseModel::where('paymet_method', 'Free')->get();
                $course_bundles = CourseBundleMainModel::where('price' , null)->get();
                if($courses->isEmpty() && $course_bundles->isEmpty()){
                    echo '<p class="more-courses-course-title mt-4">No courses avilable</p>';
                }
                else{
                foreach($courses as $course){
                if(CoursesParentCategoreisModel::where("course_id", "=", $course->id)->where("category_id", "=", $request->main_category)->exists()){
                if(CoursesSubCategoreisModel::where("course_id", "=", $course->id)->where("category_id", "=", $request->sub_category)->exists()){
                $course_teacher_id = CoursesLecturersModel::where('course_id', $course->id)->get();
                if($course_teacher_id == null || $course_teacher_id->isEmpty()){
                    $teacher_name = " ";
                }
                else{
                foreach($course_teacher_id as $course_teacher){
                $course_teacher_details = TeacherDetails::where('user_id', $course_teacher->lecturre_id)->get();   
                foreach($course_teacher_details as $course_teacher_detail){ 
                        $teacher_name = $course_teacher_detail->name;
                }
                }
            }
                $more_courses_lessons_count = CourseLessons::where('course_id', $course->id)->count(); 
                echo '<div class="col-md-3 mt-4 ">
                <a href="'.url('course-inner/'.$course->id.'').'">
                <div class=" more-courses-container">
                <img src="'. asset('course_featured_images/'.$course->image_path.'').'" class="course-filter-featured-image">
                <p class="more-courses-course-title mt-2">'.$course->course_name.'</p>
                <p class="more-courses-course-sub">'.$teacher_name.'</p>
                <p class="more-courses-course-sub  mt-1">'.$more_courses_lessons_count.' lectures</p>';
                if($course->paymet_method == "Paid"){
                echo '<p class="more-courses-course-price mt-3"><span style="text-decoration: line-through;">RS. '.$course->normal_price.'</span> RS. '.$course->sale_price.'</p>';
                 }
                else{
                echo '<p class="more-courses-course-price mt-3">Free</p>';
                 } 
                echo '</div>
                </a>
                </div>
                 ';
                }
                }
                }
                foreach($course_bundles as $course_bundle){
                if(CourseBundleParentCategoreis::where("bundle_id", "=", $course_bundle->id)->where("category_id", "=", $request->main_category)->exists()){
                if(CourseBundleSubCategoreis::where("bundle_id", "=", $course_bundle->id)->where("category_id", "=", $request->sub_category)->exists()){
                $course_bundle_count = CourseBundleCourses::where('bundle_id', $course_bundle->id)->count();
                    echo '<div class="col-md-3 mt-4 ">
                            <a href="'. url('course-bundle-inner/'.$course_bundle->id.'') .'">
                            <div class=" more-courses-container">
                            <img src="'. asset('course_bundle_images/'.$course_bundle->featured_image.'') .'" class="course-filter-featured-image">
                            <p class="more-courses-course-title mt-2">'.$course_bundle->bundle_name.'</p>
                            <p class="more-courses-course-sub">Course Bundle</p>
                            <p class="more-courses-course-sub  mt-1">'.$course_bundle_count.' Courses</p>
                            <p class="more-courses-course-price mt-3">RS. '.$course_bundle->price.'</p>
                            </div>
                            </a>
                            </div>';
                }
            }
            }
            }    
            }
              
        }
        
    }
    if($request->payment_type == "paid"){
        if($request->main_category == "all"){
            if($request->sub_category == "all"){
                $courses = CourseModel::where('paymet_method', 'Paid')->get();
                $course_bundles = CourseBundleMainModel::get();
                if($courses->isEmpty() && $course_bundles->isEmpty()){
                    echo '<p class="more-courses-course-title mt-4">No courses avilable</p>';
                }
                else{
                foreach($courses as $course){
                $course_teacher_id = CoursesLecturersModel::where('course_id', $course->id)->get();
                if($course_teacher_id == null || $course_teacher_id->isEmpty()){
                    $teacher_name = " ";
                }
                else{
                foreach($course_teacher_id as $course_teacher){
                $course_teacher_details = TeacherDetails::where('user_id', $course_teacher->lecturre_id)->get();   
                foreach($course_teacher_details as $course_teacher_detail){ 
                        $teacher_name = $course_teacher_detail->name;
                }
                }
            }
                $more_courses_lessons_count = CourseLessons::where('course_id', $course->id)->count(); 
                echo '<div class="col-md-3 mt-4 ">
                <a href="'.url('course-inner/'.$course->id.'').'">
                <div class=" more-courses-container">
                <img src="'. asset('course_featured_images/'.$course->image_path.'').'" class="course-filter-featured-image">
                <p class="more-courses-course-title mt-2">'.$course->course_name.'</p>
                <p class="more-courses-course-sub">'.$teacher_name.'</p>
                <p class="more-courses-course-sub  mt-1">'.$more_courses_lessons_count.' lectures</p>';
                if($course->paymet_method == "Paid"){
                echo '<p class="more-courses-course-price mt-3"><span style="text-decoration: line-through;">RS. '.$course->normal_price.'</span> RS. '.$course->sale_price.'</p>';
                 }
                else{
                echo '<p class="more-courses-course-price mt-3">Free</p>';
                 } 
                echo '</div>
                </a>
                </div>
                 ';
                        }
                foreach($course_bundles as $course_bundle){
                $course_bundle_count = CourseBundleCourses::where('bundle_id', $course_bundle->id)->count();
                    echo '<div class="col-md-3 mt-4 ">
                            <a href="'. url('course-bundle-inner/'.$course_bundle->id.'') .'">
                            <div class=" more-courses-container">
                            <img src="'. asset('course_bundle_images/'.$course_bundle->featured_image.'') .'" class="course-filter-featured-image">
                            <p class="more-courses-course-title mt-2">'.$course_bundle->bundle_name.'</p>
                            <p class="more-courses-course-sub">Course Bundle</p>
                            <p class="more-courses-course-sub  mt-1">'.$course_bundle_count.' Courses</p>
                            <p class="more-courses-course-price mt-3">RS. '.$course_bundle->price.'</p>
                            </div>
                            </a>
                            </div>';
                }
            }
            }
            else{
                $courses = CourseModel::where('paymet_method', 'Paid')->get();
                $course_bundles = CourseBundleMainModel::get();
                if($courses->isEmpty() && $course_bundles->isEmpty()){
                    echo '<p class="more-courses-course-title mt-4">No courses avilable</p>';
                }
                else{
                foreach($courses as $course){
                    if(CoursesSubCategoreisModel::where("course_id", "=", $course->id)->where("category_id", "=", $request->sub_category)->exists()){
                $course_teacher_id = CoursesLecturersModel::where('course_id', $course->id)->get();
                if($course_teacher_id == null || $course_teacher_id->isEmpty()){
                    $teacher_name = " ";
                }
                else{
                foreach($course_teacher_id as $course_teacher){
                $course_teacher_details = TeacherDetails::where('user_id', $course_teacher->lecturre_id)->get();   
                foreach($course_teacher_details as $course_teacher_detail){ 
                        $teacher_name = $course_teacher_detail->name;
                }
                }
            }
                $more_courses_lessons_count = CourseLessons::where('course_id', $course->id)->count(); 
                echo '<div class="col-md-3 mt-4 ">
                <a href="'.url('course-inner/'.$course->id.'').'">
                <div class=" more-courses-container">
                <img src="'. asset('course_featured_images/'.$course->image_path.'').'" class="course-filter-featured-image">
                <p class="more-courses-course-title mt-2">'.$course->course_name.'</p>
                <p class="more-courses-course-sub">'.$teacher_name.'</p>
                <p class="more-courses-course-sub  mt-1">'.$more_courses_lessons_count.' lectures</p>';
                if($course->paymet_method == "Paid"){
                echo '<p class="more-courses-course-price mt-3"><span style="text-decoration: line-through;">RS. '.$course->normal_price.'</span> RS. '.$course->sale_price.'</p>';
                 }
                else{
                echo '<p class="more-courses-course-price mt-3">Free</p>';
                 } 
                echo '</div>
                </a>
                </div>
                 ';
                        }
                    }
                foreach($course_bundles as $course_bundle){
                if(CourseBundleSubCategoreis::where("bundle_id", "=", $course_bundle->id)->where("category_id", "=", $request->sub_category)->exists()){
                $course_bundle_count = CourseBundleCourses::where('bundle_id', $course_bundle->id)->count();
                    echo '<div class="col-md-3 mt-4 ">
                            <a href="'. url('course-bundle-inner/'.$course_bundle->id.'') .'">
                            <div class=" more-courses-container">
                            <img src="'. asset('course_bundle_images/'.$course_bundle->featured_image.'') .'" class="course-filter-featured-image">
                            <p class="more-courses-course-title mt-2">'.$course_bundle->bundle_name.'</p>
                            <p class="more-courses-course-sub">Course Bundle</p>
                            <p class="more-courses-course-sub  mt-1">'.$course_bundle_count.' Courses</p>
                            <p class="more-courses-course-price mt-3">RS. '.$course_bundle->price.'</p>
                            </div>
                            </a>
                            </div>';
                }
            }    
            }
        }
        }
        else{
            if($request->sub_category == "all"){
                $courses = CourseModel::where('paymet_method', 'Paid')->get();
                $course_bundles = CourseBundleMainModel::get();
                if($courses->isEmpty() && $course_bundles->isEmpty()){
                    echo '<p class="more-courses-course-title mt-4">No courses avilable</p>';
                }
                else{
                foreach($courses as $course){
                if(CoursesParentCategoreisModel::where("course_id", "=", $course->id)->where("category_id", "=", $request->main_category)->exists()){
                $course_teacher_id = CoursesLecturersModel::where('course_id', $course->id)->get();
                if($course_teacher_id == null || $course_teacher_id->isEmpty()){
                    $teacher_name = " ";
                }
                else{
                foreach($course_teacher_id as $course_teacher){
                $course_teacher_details = TeacherDetails::where('user_id', $course_teacher->lecturre_id)->get();   
                foreach($course_teacher_details as $course_teacher_detail){ 
                        $teacher_name = $course_teacher_detail->name;
                }
                }
            }
                $more_courses_lessons_count = CourseLessons::where('course_id', $course->id)->count(); 
                echo '<div class="col-md-3 mt-4 ">
                <a href="'.url('course-inner/'.$course->id.'').'">
                <div class=" more-courses-container">
                <img src="'. asset('course_featured_images/'.$course->image_path.'').'" class="course-filter-featured-image">
                <p class="more-courses-course-title mt-2">'.$course->course_name.'</p>
                <p class="more-courses-course-sub">'.$teacher_name.'</p>
                <p class="more-courses-course-sub  mt-1">'.$more_courses_lessons_count.' lectures</p>';
                if($course->paymet_method == "Paid"){
                echo '<p class="more-courses-course-price mt-3"><span style="text-decoration: line-through;">RS. '.$course->normal_price.'</span> RS. '.$course->sale_price.'</p>';
                 }
                else{
                echo '<p class="more-courses-course-price mt-3">Free</p>';
                 } 
                echo '</div>
                </a>
                </div>
                 ';
                 }}
                foreach($course_bundles as $course_bundle){
                if(CourseBundleParentCategoreis::where("bundle_id", "=", $course_bundle->id)->where("category_id", "=", $request->main_category)->exists()){
                $course_bundle_count = CourseBundleCourses::where('bundle_id', $course_bundle->id)->count();
                    echo '<div class="col-md-3 mt-4 ">
                            <a href="'. url('course-bundle-inner/'.$course_bundle->id.'') .'">
                            <div class=" more-courses-container">
                            <img src="'. asset('course_bundle_images/'.$course_bundle->featured_image.'') .'" class="course-filter-featured-image">
                            <p class="more-courses-course-title mt-2">'.$course_bundle->bundle_name.'</p>
                            <p class="more-courses-course-sub">Course Bundle</p>
                            <p class="more-courses-course-sub  mt-1">'.$course_bundle_count.' Courses</p>
                            <p class="more-courses-course-price mt-3">RS. '.$course_bundle->price.'</p>
                            </div>
                            </a>
                            </div>';
                }
            }
            }
            }
            else{
                $courses = CourseModel::where('paymet_method', 'Paid')->get();
                $course_bundles = CourseBundleMainModel::get();
                if($courses->isEmpty() && $course_bundles->isEmpty()){
                    echo '<p class="more-courses-course-title mt-4">No courses avilable</p>';
                }
                else{
                foreach($courses as $course){
                if(CoursesParentCategoreisModel::where("course_id", "=", $course->id)->where("category_id", "=", $request->main_category)->exists()){
                    if(CoursesSubCategoreisModel::where("course_id", "=", $course->id)->where("category_id", "=", $request->sub_category)->exists()){
                $course_teacher_id = CoursesLecturersModel::where('course_id', $course->id)->get();
                if($course_teacher_id == null || $course_teacher_id->isEmpty()){
                    $teacher_name = " ";
                }
                else{
                foreach($course_teacher_id as $course_teacher){
                $course_teacher_details = TeacherDetails::where('user_id', $course_teacher->lecturre_id)->get();   
                foreach($course_teacher_details as $course_teacher_detail){ 
                        $teacher_name = $course_teacher_detail->name;
                }
                }
            }
                $more_courses_lessons_count = CourseLessons::where('course_id', $course->id)->count(); 
                echo '<div class="col-md-3 mt-4 ">
                <a href="'.url('course-inner/'.$course->id.'').'">
                <div class=" more-courses-container">
                <img src="'. asset('course_featured_images/'.$course->image_path.'').'" class="course-filter-featured-image">
                <p class="more-courses-course-title mt-2">'.$course->course_name.'</p>
                <p class="more-courses-course-sub">'.$teacher_name.'</p>
                <p class="more-courses-course-sub  mt-1">'.$more_courses_lessons_count.' lectures</p>';
                if($course->paymet_method == "Paid"){
                echo '<p class="more-courses-course-price mt-3"><span style="text-decoration: line-through;">RS. '.$course->normal_price.'</span> RS. '.$course->sale_price.'</p>';
                 }
                else{
                echo '<p class="more-courses-course-price mt-3">Free</p>';
                 } 
                echo '</div>
                </a>
                </div>
                 ';
                 }}}
                foreach($course_bundles as $course_bundle){
                if(CourseBundleParentCategoreis::where("bundle_id", "=", $course_bundle->id)->where("category_id", "=", $request->main_category)->exists()){
                    if(CourseBundleSubCategoreis::where("bundle_id", "=", $course_bundle->id)->where("category_id", "=", $request->sub_category)->exists()){
                $course_bundle_count = CourseBundleCourses::where('bundle_id', $course_bundle->id)->count();
                    echo '<div class="col-md-3 mt-4 ">
                            <a href="'. url('course-bundle-inner/'.$course_bundle->id.'') .'">
                            <div class=" more-courses-container">
                            <img src="'. asset('course_bundle_images/'.$course_bundle->featured_image.'') .'" class="course-filter-featured-image">
                            <p class="more-courses-course-title mt-2">'.$course_bundle->bundle_name.'</p>
                            <p class="more-courses-course-sub">Course Bundle</p>
                            <p class="more-courses-course-sub  mt-1">'.$course_bundle_count.' Courses</p>
                            <p class="more-courses-course-price mt-3">RS. '.$course_bundle->price.'</p>
                            </div>
                            </a>
                            </div>';
                }
            }
            }
            }   
            }
              
        }
        
    }

}
}
public function edit_profile_basic($user_id,Request $request)
{
    $this->validate($request, [
            'first_name'   => 'required',
            'last_name'   => 'required',
            'email'   => 'required',
            'mobile'   => 'required',
            'gender'   => 'required',
            'address'   => 'required',
            'user_name'   => 'required',
           ]);
        if(User::where("id", "=", $user_id)->where("email", "=", $request->email)->exists()){
            $email = $request->email;
        }
        elseif(User::where("email", "=", $request->email)->exists()){
         return back()->with('fail', 'This email is already in use');
        }
        else{
         $email = $request->email; 
        }
        if(User::where("id", "=", $user_id)->where("user_name", "=", $request->user_name)->exists()){
            $user_name = $request->user_name;
        }
        elseif(User::where("user_name", "=", $request->user_name)->exists()){
         return back()->with('fail', 'This user name is already in use');
        }
        else{
         $user_name = $request->user_name; 
        }

        $student_details =  StudentDetails::where('user_id', '=', $user_id)->first();;
        $student_details->first_name = $request->first_name;
        $student_details->last_name = $request->last_name;
        $student_details->mobile = $request->mobile;
        $student_details->gender = $request->gender;
        $student_details->address = $request->address;
        $student_details->update();
     
        $loginDetails = User::find($user_id);
        $loginDetails->email = $email;
        $loginDetails->user_name = $user_name;
        $loginDetails->update();
        return back()->with('success', 'Basic Details Updated'); 
     
    }
public function edit_profile_picture($user_id,Request $request)
{
    $this->validate($request, [
            'profile_picture'   => 'required',
    ]);

    $profile_picture = time().'-'.$user_id.'.'.$request->profile_picture->extension();
    $request->profile_picture->move(public_path('student_profile_pictures'), $profile_picture);

        $student_details =  StudentDetails::where('user_id', '=', $user_id)->first();;
        $student_details->profile_picture = $profile_picture;
        $student_details->update();
        return back()->with('success', 'Profile Picture Updated'); 
     
    }
public function edit_profile_password($user_id,Request $request)
    {
        $this->validate($request, [
                'current_password'   => 'required',
                "password" => "required | confirmed | min:6",
        ]);
    if (Hash::check($request->current_password, User::where("id", "=", $user_id)->value('password'))) {
            $userDetails = User::find($user_id);
            $userDetails->password = Hash::make($request->password);
            $userDetails->update();
            return back()->with('success', 'Password Updated');
    }
   else{
    return back()->with('fail', 'Current Password Does Not Match');  
   }
        }


public function update_timer_essay(Request $request)
        {
            if(EssayQuizAnswerTimer::where("course_id", $request->essaycourseid)
            ->where("quiz_id", $request->essayid)
            ->where("student_id", $request->essaystudentid)
            ->exists()){
                $timer_up = EssayQuizAnswerTimer::where("course_id", $request->essaycourseid)
                ->where("quiz_id", $request->essayid)
                ->where("student_id", $request->essaystudentid)->first();
                $timer_up->time_limit =  $request->m+1;
                $timer_up->update();
            }
            else{
                $timer_in = new EssayQuizAnswerTimer();
                $timer_in->course_id = $request->essaycourseid;
                $timer_in->quiz_id = $request->essayid;
                $timer_in->student_id = $request->essaystudentid;
                $timer_in->time_limit = $request->m+1;
                $timer_in->save();
            }
        }
public function update_timer_mcq(Request $request)
        {
            if(MCQQuizAnswerTimer::where("course_id", $request->mcqcourseid)
            ->where("quiz_id", $request->mcqid)
            ->where("student_id", $request->mcqstudentid)
            ->exists()){
                $timer_up = MCQQuizAnswerTimer::where("course_id", $request->mcqcourseid)
                ->where("quiz_id", $request->mcqid)
                ->where("student_id", $request->mcqstudentid)->first();
                $timer_up->time_limit =  $request->m+1;
                $timer_up->update();
            }
            else{
                $timer_in = new MCQQuizAnswerTimer();
                $timer_in->course_id = $request->mcqcourseid;
                $timer_in->quiz_id = $request->mcqid;
                $timer_in->student_id = $request->mcqstudentid;
                $timer_in->time_limit = $request->m+1;
                $timer_in->save();
            }
        }
}
