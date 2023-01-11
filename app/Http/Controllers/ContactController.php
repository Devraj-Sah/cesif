<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Mail\RegisterMail;
use App\Mail\BookMail;
use App\Mail\ResponseMail;
use App\Models\Comment;
use App\Models\GlobalSetting;
use Session;
use App\Models\Navigation;
use App\Job;
use App\Contact;

use Mail;

class ContactController extends Controller
{

    public function send(Request $request)
    {
        $data = $request->all();
        $mail = GlobalSetting::first();
        $token = $request->input('g-recaptcha-response');
        if(is_null($token)){
            //dd($token);
            return redirect('/contact-us')->with('error',"Recaptcha not checked. Submit With recaptcha again !!");
        }else{
        $email = $mail->site_email;
        $asd = "production@radiantnepal.com";
        $user_email = $request->input('email');
        
        $subject = "Contact Message";
            $msg = '<table border="1" style="background: #f1f1f1; color: #1b1b1b;">';
            $msg .= '<tr><td colspan="2"><h3>Contact message by '.$data['name'].'</h3></td></tr>';
            $msg .= '<tr><th>Full Name</th><td>'.$data['name'].'</td></tr>';
            $msg .= '<tr><th>Email Address</th><td>'.$data['email'].'</td></tr>';
            $msg .= '<tr><th>Phone Number</th><td>'.$data['phone'].'</td></tr>';
            $msg .= '<tr><th>Subject</th><td>'.$data['subject'].'</td></tr>';
            $msg .= '<tr><th>Message</th><td>' . $data['comment'] . '</td></tr>';
            $msg .= '</table>';
            
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        mail($email,$subject,$msg,$headers);
        
        if($data){
            return redirect('/contact-us')->with('success',"Message sent Sucessfully. Thank You!!");
        }
        }
        // return redirect()->back()->with('error',"Feedback Message failed. Try Again Later");
    }
    public function Contact(){
        if(Navigation::query()->where('nav_category','Home')->where('nav_name', 'LIKE', "%contacts%")->where('page_type','Group')->latest()->first()!=null){
            $contact_id = Navigation::query()->where('nav_category','Home')->where('nav_name', 'LIKE', "%contacts%")->where('page_type','Group')->latest()->first()->id;
            $contacts = Navigation::query()->where('parent_page_id',$contact_id)->latest()->get();
            //return $partners;
        }
        else{
            $contacts = null;
        }
        //return $contacts;
       //$job =Navigation::all()->where('nav_name',$slug)->first();     
        $slug_detail = Navigation::all()->where('nav_name','contact')->first();   
        $global_setting = GlobalSetting::all()->first(); 
        $menus = Navigation::query()->where('nav_category','Main')->where('page_type','!=','Job')->where('page_type','!=','Photo Gallery')->where('page_type','!=','Notice')->where('parent_page_id',0)->where('page_status','1')->orderBy('position','ASC')->get();
        return view("admin.contact")->with(['contacts'=>$contacts,'slug_detail'=>$slug_detail,'menus'=>$menus,'global_setting'=>$global_setting]);
    }


    
    public function inquiry(){
       //$job =Navigation::all()->where('nav_name',$slug)->first();        
        $global_setting = GlobalSetting::all()->first(); 
        $menus = Navigation::query()->where('nav_category','Main')->where('page_type','!=','Job')->where('page_type','!=','Photo Gallery')->where('page_type','!=','Notice')->where('parent_page_id',0)->where('page_status','1')->orderBy('position','ASC')->get();
        return view("admin.apply")->with(['menus'=>$menus,'global_setting'=>$global_setting]);
    }

    
    public function jobApply($slug){
        $job_detail = Navigation::where('nav_name',$slug)->first();
        $global_setting = GlobalSetting::all()->first(); 
        $menus = Navigation::query()->where('nav_category','Main')->where('page_type','!=','Job')->where('page_type','!=','Photo Gallery')->where('page_type','!=','Notice')->where('parent_page_id',0)->where('page_status','1')->orderBy('position','ASC')->get();
        return view("admin.inquiry")->with(['job_detail'=>$job_detail,'menus'=>$menus,'global_setting'=>$global_setting,'job_slug'=>$slug]);
    }

    
    public function ContactStore(Request $req){
        $validated = $req->validate([
            'name' => 'required',
            'number' => 'required',
         ]);

         if($req->file('file')){
            $img_file = $req->file('file');
            $name = "/contact_image/".time().'_'.$img_file->getClientOriginalName();
            $destinationPath = public_path('contact_image');
            $img_file->move($destinationPath,$name);
         }
         else{
             $name = null;
         }
         //return $req['country'];
        $contact = new Contact;
        $contact->name = $req['name'];
        $contact->number = $req['number'];
        $contact->email = $req['email'];
        $contact->file = $name;
        $contact->message = $req['message'];
        $contact->job_id = $req['job_id'];//job_detail
        $contact->apply_for = $req['apply_for'];//job title
        $contact->country = $req['country'];
        $contact->save();
        if($contact){
            Session::flash('contact', 'Thanks for submitting'); 
            return redirect('/');
        }
        else{
            Session::flash('contact_error', 'Sorry form submitted failed'); 
            return redirect('/');
        }

    }
    public function Destroy($slug){
        $contact = Contact::where('nav_name',$slug)->delete();
        return redirect('/');
    }

    public function AppliedJob(){
        //$navigations  = Navigation::where('page_type','Job')->orderBy('position','ASC')->get();
        $contacts = Contact::all();
        //return $jobs;
        //return $jobs->navigation;
        $categories = Navigation::where('page_type','Group')->where('parent_page_id',0)->get();
        //return $navigations;
        return view('admin.job.applied_job_list', compact('contacts','categories'));
    }
    public function Contactelete($slug){
        Contact::find($slug)->delete();
        return redirect()->back();
    }

   
}
