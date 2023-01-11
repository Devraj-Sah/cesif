<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Navigation;
use App\Job;
use App\Models\NavigationItems;
use App\Date;
use App\HomeDates;
use File;

class NavigationController extends Controller
{

    public function index($nav_category = null)
    {
        $navigations  = Navigation::where('nav_category', $nav_category)->where('parent_page_id', 0)->orderBy('position', 'ASC')->get();
        return view('admin.navigation.navigation_list', compact('navigations', 'nav_category'));
    }

    public function create($category)
    {
        $main_home = $category; //customized by md to redirect for job add page  
        //return $main_home;       
        $request_segment = \Request::segment(4); //customized by md to redirect for job add page
        $category_id = \Request::segment(4);
        if (intval($request_segment) == 0) {
            $request_segment = \Request::segment(3);
            $current_max_position = Navigation::where('nav_category', $request_segment)->max('position');
        } else {
            $category_id = \Request::segment(4);
            //return $category_id;
            $current_max_position = Navigation::where('parent_page_id', $request_segment)->max('position');
            $category .= '/' . $request_segment;
        }
        $category_id = intval($category_id);
        //return $category_id;
        $next_position = $current_max_position + 1;
        $categories = Navigation::where('page_type', 'group')->where('nav_category', $category)->get();
        return view('admin.navigation.navigation_create', compact('category', 'next_position', 'categories', 'main_home', 'category_id'));
    }

    public function store(Request $request, $nav_category)
    {
        $this->validate($request, [
            'nav_name' => 'required|min:2',
            'alias' => 'required|unique:navigations',
            'caption' => 'required',
           'icon_image' => 'mimes:jpeg,png,jpg,gif,svg,JPG',
            'banner_image' => 'mimes:jpeg,png,jpg,gif,svg,JPG'

        ]);

        $page_title = $request['page_title'];

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
        // return $navigation->id;

        $date = Date::updateOrCreate(
            // [],
            [
                'date_yrs_month' => $page_title,
                'nav_category' => $nav_category,
            ],
        );

        return redirect('admin/navigation-list/' . $nav_category . $parent_id)->with('success', 'Data Added Succssfully!!');
    }

    public function show($id)
    {
        //
    }

    public function edit($nav_category, $id)
    {
        $navigation = Navigation::find($id);
        $categories = Navigation::where('page_type', 'group')->where('nav_category', $nav_category)->get();
        return view('admin.navigation.navigation_edit', compact('navigation', 'nav_category', 'categories'));
    }

    public function update(Request $request, $nav_category, $id)
    {
        $this->validate($request, [
            'nav_name' => 'required|min:3',
            'caption' => 'required',
          'icon_image' => 'mimes:jpeg,png,jpg,gif,svg,JPG',
            'banner_image' => 'mimes:jpeg,png,jpg,gif,svg,JPG'

        ]);
        $page_title = $request['page_title'];

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


        $date = Date::updateOrCreate(
            // ['date_yrs_month' => $page_title],
            [
                'nav_category' => $nav_category,
                'date_yrs_month' => $page_title
            ],
        );



        // $date = Date::updateOrCreate(
        //     ['navigation_id' => $navigation->id, 'date_yrs_month' => $page_title,],
        //     [
        //         // 'date_yrs_month' => $page_title,
        //         'nav_category' => $nav_category,
        //         // 'navigation_id' => $navigation->id
        //     ],
        // );



        $navigationItems = NavigationItems::all();
        NavigationItems::where('navigation_id', $id)->update(['navigation_id' => $id]);
        return redirect('/admin/navigation-list/' . $nav_category . $parent_id)->with('success', 'Data Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nav_category, $id)



    {
        $navigation = Navigation::find($id);
        $page_title = strval($navigation->page_title);

        // strval( $variable ) 
        $date = Date::all()->where('date_yrs_month', $page_title)->first();
        // return $date;
        if ($date) {
            $date->delete();
        }
        // return gettype($page_title);

        $parent_id = (intval($navigation->parent_page_id) == 0) ? '' : '/' . intval($navigation->parent_page_id);

        if (file_exists(public_path('uploads/icon_image/' . $navigation->icon_image))) {
            File::delete(public_path('uploads/icon_image/' . $navigation->icon_image));
        }

        if (file_exists(public_path('uploads/featured_image/' . $navigation->featured_image))) {
            File::delete(public_path('uploads/featured_image/' . $navigation->featured_image));
        }

        if (file_exists(public_path($navigation->banner_image))) {
            File::delete(public_path($navigation->banner_image));
        }

        if (file_exists(public_path('uploads/attachment/' . $navigation->attachment))) {
            File::delete(public_path('uploads/attachment/' . $navigation->attachment));
        }

        if (file_exists(public_path('uploads/main_attachment/' . $navigation->main_attachment))) {
            File::delete(public_path('uploads/main_attachment/' . $navigation->main_attachment));
        }


        $navigation->delete($id);
        //modify by Md delete job post
        $job = Job::all()->where('navigation_id', $id)->first();
        if ($job) {
            $job->delete();
        }



        return redirect('admin/navigation-list/' . $nav_category . $parent_id)->with('success', 'Data Deleted Succssfully!!');
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


    public function childNavigation($nav_category, $parent_id)
    {
        $navigations = Navigation::where('nav_category', $nav_category)->where('parent_page_id', $parent_id)->get();
        return view('admin.navigation.navigation_list', compact('navigations', 'nav_category'));
    }

    /*Photo gallery*/

    public function showMediaList($nav_category = null, $id)
    {
        $medias = NavigationItems::where('navigation_id', $id)->paginate(10);
        return view('admin.gallery.photo_gallery_list', compact('nav_category', 'medias'));
    }

    public function addMedia($category, $id)
    {
        return view('admin.gallery.add_photo_gallery', compact('category', 'id'));
    }

    public function storeAlbum(Request $request, $nav_category)
    {
        $this->validate($request, [
            'pg_file' => 'required'
        ]);
        $data = $request->all();
        $data['nav_category'] = $nav_category;

        $request_segment = \Request::segment(4);
        $parent_id = intval($request_segment);
        $data['parent_page_id'] = $parent_id;
        $parent_id = ($parent_id == '') ? '' : '/' . $parent_id;

        if ($request->hasFile('pg_file')) {
            $orders = $request->input('pg_sort');
            $names = $request->input('pg_name');
            $names_nepali = $request->input('pg_name_nepali');
            $link = $request->input('pg_link');
            $contents = $request->input('pg_caption');
            $contents_nepali = $request->input('pg_caption_nepali');
            $files = $request->file('pg_file');

            foreach ($files as $index => $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $destinationPath = public_path('uploads/photo_gallery');
                $image->move($destinationPath, $filename);
                NavigationItems::create([
                    'navigation_id' => $request->id,
                    'sort' => $orders[$index],
                    'file' => $filename,
                    'name' => $names[$index],
                    'name_nepali' => $names_nepali[$index],
                    'link' => $link[$index],
                    'content' => $contents[$index],
                    'content_nepali' => $contents_nepali[$index]
                ]);
            }
        }

        return redirect('admin/navigation-list/' . $data['nav_category'] . $parent_id . "/showList")->with('success', 'Media Added Successfully!!');
    }

    public function updateMedia(Request $request, $id)
    {

        $request->offsetUnset('_token'); // Confirmed _token field is gone.
        $request->offsetUnset('_method'); // Confirmed _mothod field is gone.

        $data = $request->all();
        $media = NavigationItems::find($id);

        if ($request->hasFile('file')) {
            if (file_exists(public_path('uploads/photo_gallery') . '/' . $media->file)) {
                unlink('uploads/photo_gallery/' . $media->file);
            }

            $filename = $request->file('file');
            $data['file'] = time() . '_' . $request->file('file')->getClientOriginalName();
            $destinationPath = public_path('uploads/photo_gallery');
            $filename->move($destinationPath, $data['file']);
        }

        NavigationItems::where('id', $id)->update($data);
        return redirect()->back()->with('success', 'Media Updated');
    }

    public function deleteMedia($id)
    {
        $media = NavigationItems::find($id);
        if (null == $media) {
            abort(404);
        }
        if (!$media->delete()) {
            abort(500);
        }

        return redirect()->back()->with('success', 'Media Deleted Successfully!!');
    }


    public function update_status(Request $request, $id)
    {
        $data['page_status'] = $request->page_status;
        Navigation::where('id', $id)->update($data);
    }
}
