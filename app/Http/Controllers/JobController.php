<?php

namespace App\Http\Controllers;

use App\Job;
use App\Models\Navigation;
use Illuminate\Http\Request;
use App\Models\NavigationItems;
use  App\Contact;
use Session;
use File;

class JobController extends Controller
{
    public function jobList($nav_category = null)
    {
        //$navigations  = Navigation::where('page_type','Job')->orderBy('position','ASC')->get();
        $jobs = Job::all();
        //return $jobs;
        //return $jobs->navigation;
        $categories = Navigation::where('page_type', 'Group')->where('parent_page_id', 0)->get();
        //return $navigations;
        return view('admin.job.job_list', compact('jobs', 'nav_category', 'categories'));
    }
    public function AddJob($category)
    {
        $request_segment = \Request::segment(4);
        if (intval($request_segment) == 0) {
            $request_segment = \Request::segment(3);
            $current_max_position = Navigation::where('nav_category', $request_segment)->max('position');
        } else {
            $current_max_position = Navigation::where('parent_page_id', $request_segment)->max('position');
            $category .= '/' . $request_segment;
        }

        $next_position = $current_max_position + 1;
        $categories = Navigation::where('page_type', 'group')->where('nav_category', $category)->get();
        return view('admin.job.job_create', compact('category', 'next_position', 'categories'));
    }

    public function store(Request $request, $nav_category)
    {
        $this->validate($request, [
            'nav_name' => 'required|min:2',
            'alias' => 'required|unique:navigations',
            'caption' => 'required',
            'country' => 'required',
            'company_name' => 'required',
            'no_of_recruits' => 'required',
            'no_working_hr' => 'required',
            'salary' => 'required',
            'icon_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'banner_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240'

        ]);
        //get job details and store it in another table "

        $company_name = $request['company_name'];
        $country = $request['country'];
        $salary = $request['salary'];
        $no_of_recruits = $request['no_of_recruits'];
        $no_working_hr = $request['no_working_hr'];
        $contract_time = $request['contract_time'];

        //unset above data from request
        unset($request['company_name']);
        unset($request['country']);
        unset($request['salary']);
        unset($request['no_of_recruits']);
        unset($request['no_working_hr']);
        unset($request['contract_time']);

        //close

        $data = $request->all();
        $data['nav_category'] = $nav_category;
        $request_segment = \Request::segment(4);
        $parent_id = intval($request_segment);
        $data['parent_page_id'] = $parent_id;
        $parent_id = ($parent_id == '') ? '' : '/' . $parent_id;

        if ($request->hasFile('icon_image')) {
            $img_file = $request->file('icon_image');
            $data['icon_image'] = time() . '_' . $img_file->getClientOriginalName();
            $destinationPath = public_path('uploads/icon_image');
            $img_file->move($destinationPath, $data['icon_image']);
        }
        if ($request->hasFile('featured_image')) {
            $img_file = $request->file('featured_image');
            $data['featured_image'] = time() . '_' . $img_file->getClientOriginalName();
            $destinationPath = public_path('uploads/featured_image');
            $img_file->move($destinationPath, $data['featured_image']);
        }

        if ($request->hasFile('banner_image')) {
            $banner_file = $request->file('banner_image');
            $data['banner_image'] = "/uploads/banner_image/" . time() . '_' . $banner_file->getClientOriginalName();
            $destinationPath = public_path('uploads/banner_image');
            $banner_file->move($destinationPath, $data['banner_image']);
        }

        if ($request->hasFile('attachment')) {
            $attachment_file = $request->file('attachment');
            $data['attachment'] = time() . '_' . $attachment_file->getClientOriginalName();
            $destinationPath = public_path('uploads/attachment');
            $attachment_file->move($destinationPath, $data['attachment']);
        }

        if ($request->hasFile('main_attachment')) {
            $attachment_file = $request->file('main_attachment');
            $data['main_attachment'] = time() . '_' . $attachment_file->getClientOriginalName();
            $destinationPath = public_path('uploads/main_attachment');
            $attachment_file->move($destinationPath, $data['main_attachment']);
        }

        $navigation = Navigation::create($data);

        //*********store to job table */
        if ($navigation) {
            $job = new Job;
            $job->country = $country;
            $job->company_name = $company_name;
            $job->salary = $salary;
            $job->contract_time = $contract_time;
            $job->no_of_recruits =  $no_of_recruits;
            $job->no_working_hr =  $no_working_hr;
            $job->navigation_id =  $navigation->id;
            
            $job->save();
        }
        return redirect('admin/navigation-list/' . $nav_category . $parent_id)->with('success', 'Data Added Succssfully!!');
    }
    public function JobUpdate(Request $request, $nav_category, $id)
    {
        //return $request;
        $this->validate($request, [
            'nav_name' => 'required|min:3',
            'caption' => 'required',
            'icon_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'banner_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240'

        ]);
        //get job details and store it in another table "

        $company_name = $request['company_name'];
        $country = $request['country'];
        $salary = $request['salary'];
        $contract_time = $request['contract_time'];
        $job_id = $request['job_id'];

        $job = Job::find($job_id);
        $job->country = $country;
        $job->company_name = $company_name;
        $job->salary = $salary;
        $job->contract_time = $contract_time;

        $job->save();
        //unset above data from request
        unset($request['company_name']);
        unset($request['country']);
        unset($request['salary']);
        unset($request['contract_time']);
        unset($request['job_id']);

        $request->offsetUnset('_token');
        $request->offsetUnset('_method');

        $data = $request->all();
        $navigation = Navigation::find($id);
        $parent_id = (intval($navigation->parent_page_id) == 0) ? '' : '/' . intval($navigation->parent_page_id);

        if ($request->hasFile('icon_image')) {
            if (file_exists(public_path('uploads/icon_image') . '/' . $navigation->icon_image)) {
                File::delete('uploads/icon_image/' . $navigation->icon_image);
            }
            $icon_image = $request->file('icon_image');
            $data['icon_image'] = time() . '_' . $icon_image->getClientOriginalName();
            $destinationPath = public_path('uploads/icon_image');
            $icon_image->move($destinationPath, $data['icon_image']);
        }

        if ($request->hasFile('featured_image')) {
            if (file_exists(public_path('uploads/featured_image') . '/' . $navigation->icon_image)) {
                File::delete('uploads/featured_image/' . $navigation->icon_image);
            }
            $icon_image = $request->file('featured_image');
            $data['featured_image'] = time() . '_' . $icon_image->getClientOriginalName();
            $destinationPath = public_path('uploads/featured_image');
            $icon_image->move($destinationPath, $data['featured_image']);
        }

        if ($request->hasFile('banner_image')) {
            if (file_exists(public_path($navigation->banner_image))) {
                File::delete($navigation->banner_image);
            }
            $banner_image = $request->file('banner_image');
            $data['banner_image'] = "/uploads/banner_image/" . time() . '_' . $banner_image->getClientOriginalName();
            $destinationPath = public_path('uploads/banner_image');
            $banner_image->move($destinationPath, $data['banner_image']);
        }

        if ($request->hasFile('attachment')) {
            if (file_exists(public_path('uploads/attachment') . '/' . $navigation->attachment)) {
                File::delete('uploads/attachment/' . $navigation->attachment);
            }

            $attachment_file = $request->file('attachment');
            $data['attachment'] = time() . '_' . $attachment_file->getClientOriginalName();
            $destinationPath = public_path('uploads/attachment');
            $attachment_file->move($destinationPath, $data['attachment']);
        }

        if ($request->hasFile('main_attachment')) {
            if (file_exists(public_path('uploads/main_attachment') . '/' . $navigation->attachment)) {
                File::delete('uploads/main_attachment/' . $navigation->attachment);
            }

            $attachment_file = $request->file('main_attachment');
            $data['main_attachment'] = time() . '_' . $attachment_file->getClientOriginalName();
            $destinationPath = public_path('uploads/main_attachment');
            $attachment_file->move($destinationPath, $data['main_attachment']);
        }

        Navigation::where('id', $id)->update($data);

        $jobs = Job::all();
        //return $jobs;
        //return $jobs->navigation;
        $categories = Navigation::where('page_type', 'Group')->where('parent_page_id', 0)->get();
        Session::flash('success', 'Data Updated Successfully!!!');
        //return $navigations;
        return view('admin.job.job_list', compact('jobs', 'categories'));
    }
    public function deleteIconImage($nav_category, $id)
    {
        $icons = Navigation::where('id', $id)->where('icon_image', 'like', '%_%')->first();
        $image = $icons->icon_image;
        File::delete(public_path('uploads/icon_image/' . $image));
        $icons->update(['icon_image' => null]);
        return redirect()->back();
    }

    public function deleteFeaturedImage($nav_category, $id)
    {
        $icons = Navigation::where('id', $id)->where('featured_image', 'like', '%_%')->first();
        $image = $icons->featured_image;
        File::delete(public_path('uploads/featured_image/' . $image));
        $icons->update(['featured_image' => null]);
        return redirect()->back();
    }

    public function deleteBannerImage($nav_category, $id)
    {
        $bannerimage = Navigation::where('id', $id)->where('banner_image', 'like', '%_%')->first();
        $image = $bannerimage->banner_image;
        File::delete(public_path($image));
        $bannerimage->update(['banner_image' => null]);
        return redirect()->back();
    }

    public function deletemainattachment($nav_category, $id)
    {
        $mainattachment = Navigation::where('id', $id)->where('main_attachment', 'like', '%_%')->first();
        $image = $mainattachment->main_attachment;
        File::delete(public_path('uploads/main_attachment/' . $image));
        $mainattachment->update(['main_attachment' => null]);
        return redirect()->back();
    }

    public function deleteattachment($nav_category, $id)
    {
        $attachment = Navigation::where('id', $id)->where('attachment', 'like', '%_%')->first();
        $image = $attachment->attachment;
        File::delete(public_path('uploads/attachment/' . $image));
        $attachment->update(['attachment' => null]);
        return redirect()->back();
    }


    public function edit($slug1, $slug2)
    {
        $job = Job::all()->where('navigation_id', $slug2)->first();
        $categories = Navigation::where('page_type', 'Group')->where('parent_page_id', 0)->get();
        return view('admin.job.job_edit')->with(['job' => $job, 'category' => '/' . $slug1 . '/' . $slug2, 'categories' => $categories, 'category_name' => $slug1, "category_id" => $slug2]);
    }
}
