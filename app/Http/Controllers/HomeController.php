<?php

namespace App\Http\Controllers;

use App\Models\GlobalSetting;
use App\Models\NavigationItems;
use App\Models\NavigationVideoItems;
use App\Models\Navigation;
use Illuminate\Http\Request;
use App\Job;
use App\Date;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {


        // $monthly_data = Navigation::find($mainitem_item->id)->where('page_type','Monthly Analysis');

        $date = Date::all()->where('nav_category', 'Main');


        $all_nav = Navigation::query()->orWhere('page_type', 'Monthly Analysis')->orderBy('created_at', 'desc')->take(6)->get();
        
         $home_news = Navigation::query()->orWhere('page_type', 'News & Events')->get();



        


        $home_publication = Navigation::all()->where('page_type', 'Publication')->take(6);
        // return $home_publication;


        $home_News = Navigation::all()->where('page_type', 'News Digest');
        //  return $home_News;


        // $home_commentaries = Navigation::all()->where('page_type', 'Commentaries');

        $home_commentaries = Navigation::query()->where('page_type', 'Commentaries')->orderBy('created_at', 'desc')->get();
        // $home_commentaries = $home_commentaries->sortByDesc('created_at');
        // echo "<pre>";
        // print_r($home_commentaries->all());
        // die();

        $menus = Navigation::query()->where('nav_category', 'Main')->where('page_type', '!=', 'Job')->where('page_type', '!=', 'Photo Gallery')->where('page_type', '!=', 'Notice')->where('parent_page_id', 0)->where('page_status', '1')->orderBy('position', 'ASC')->get();


        // client
        $home_client  = Navigation::query()->where('nav_category', 'Main')->where('page_type', '=', 'client')->where('page_status', '1')->orderBy('position', 'ASC')->paginate(30);
        //   return $home_client;


        //return $menus;
        //return $menus->first()->submenus;
        $jobs = Navigation::query()->where('page_type', 'Job')->latest()->paginate(10);
        if (Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%about%")->where('page_type', 'Group')->latest()->first() != null) {
            $about_id = Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%about%")->where('page_type', 'Group')->latest()->first()->id;
            $About = Navigation::query()->where('parent_page_id', $about_id)->latest()->first();
        } else {
            $About = null;
        }
        if (Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%partner%")->where('page_type', 'Group')->latest()->first() != null) {
            $partners_id = Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%partner%")->where('page_type', 'Group')->latest()->first()->id;
            $partners = Navigation::query()->where('parent_page_id', $partners_id)->latest()->get();
            //return $partners;
        } else {
            $partners = null;
        }

        if (Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%monthly-analysis%")->where('page_type', 'Group')->latest()->first() != null) {
            $monthly_analysis_id = Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%monthly-analysis%")->where('page_type', 'Group')->latest()->first()->id;
            $monthly_analysis = Navigation::query()->where('parent_page_id', $monthly_analysis_id)->latest()->get();
            return $monthly_analysis;
        } else {
            $monthly_analysis = null;
        }

        if (Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%statistic%")->where('page_type', 'Group')->latest()->first() != null) {
            $statistics_id = Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%statistic%")->where('page_type', 'Group')->latest()->first()->id;
            $statistics = Navigation::query()->where('parent_page_id', $statistics_id)->latest()->get();
            // return $statistics;
        } else {
            $statistics = null;
        }
        if (Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%testimonial%")->where('page_type', 'Group')->latest()->first() != null) {
            $testimonial_id = Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%testimonial%")->where('page_type', 'Group')->latest()->first()->id;
            $testimonial = Navigation::query()->where('parent_page_id', $testimonial_id)->latest()->first();
        } else {
            $testimonial = null;
        }
        if (Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%banner%")->where('page_type', 'Group')->latest()->first() != null) {
            $banner_id = Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%banner%")->where('page_type', 'Group')->latest()->first()->id;
            $banners = Navigation::query()->where('parent_page_id', $banner_id)->latest()->get();
        } else {
            $banners = null;
        }
        if (Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%slider%")->where('page_type', 'Group')->latest()->first() != null) {
            $slider_id = Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%slider%")->where('page_type', 'Group')->latest()->first()->id;
            $sliders = Navigation::query()->where('parent_page_id', $slider_id)->latest()->get();
        } else {
            $sliders = null;
        }
        if (Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%misson%")->where('page_type', 'Group')->latest()->first() != null) {
            $misson_id = Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%misson%")->where('page_type', 'Group')->latest()->first()->id;
            $missons = Navigation::query()->where('parent_page_id', $misson_id)->latest()->get();
            //return $misson;
        } else {
            $missons = null;
        }
        if (Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%message%")->where('page_type', 'Group')->latest()->first() != null) {
            $message_id = Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%message%")->where('page_type', 'Group')->latest()->first()->id;
            $message = Navigation::query()->where('parent_page_id', $message_id)->latest()->first();
            // return $message;
        } else {
            $message = null;
        }

        if (Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%news&events%")->where('page_type', 'Group')->latest()->first() != null) {
            $notice_id = Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%news&events%")->where('page_type', 'Group')->latest()->first()->id;

            // $notice_data = Navigation::find($notice_id)->childs->take(3);
            // return $notice_data;
        } else {
            $message = null;
        }




        if (Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%process%")->where('page_type', 'Group')->latest()->first() != null) {
            $process_id = Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%process%")->where('page_type', 'Group')->latest()->first()->id;
            $process = Navigation::query()->where('parent_page_id', $process_id)->latest()->get();
        } else {
            $process = null;
        }
        //return $misson;
        $job_categories = Navigation::all()->where('nav_category', 'Main')->where('page_type', 'Group')->where('banner_image', '!=', null);
        // return $job_categories;
        $global_setting = GlobalSetting::all()->first();
        //return $missons;       
        return view("website.index")->with(['home_news'=>$home_news,'testimonial' => $testimonial, 'statistics' => $statistics, 'partners' => $partners, 'jobs' => $jobs, 'banners' => $banners, 'about' => $About, 'menus' => $menus, 'global_setting' => $global_setting, 'sliders' => $sliders, 'missons' => $missons, 'job_categories' => $job_categories, 'message' => $message, 'process' => $process,  'home_client' => $home_client, 'monthly_analysis' => $monthly_analysis, 'date' => $date, 'home_publication' => $home_publication, 'home_News' => $home_News, 'home_commentaries' => $home_commentaries, 'all_nav' => $all_nav]);
    }



    public function category($menu)
    {
        //return $menu." this is category";
        $menus = Navigation::query()->where('nav_category', 'Main')->where('page_type', '!=', 'Job')->where('page_type', '!=', 'Photo Gallery')->where('page_type', '!=', 'Notice')->where('parent_page_id', 0)->where('page_status', '1')->orderBy('position', 'ASC')->get();
        //return $menus->first()->submenus;
        $jobs = Navigation::query()->where('page_type', 'Job')->latest()->get();
        if (Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%about%")->where('page_type', 'Group')->latest()->first() != null) {
            $about_id = Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%about%")->where('page_type', 'Group')->latest()->first()->id;
            $About = Navigation::query()->where('parent_page_id', $about_id)->latest()->first();
        } else {
            $About = null;
        }
        if (Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%banner%")->where('page_type', 'Group')->latest()->first() != null) {
            $banner_id = Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%banner%")->where('page_type', 'Group')->latest()->first()->id;
            $banners = Navigation::query()->where('parent_page_id', $banner_id)->latest()->get();
        } else {
            $banners = null;
        }
        if (Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%partner%")->where('page_type', 'Group')->latest()->first() != null) {
            $partners_id = Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%partner%")->where('page_type', 'Group')->latest()->first()->id;
            $partners = Navigation::query()->where('parent_page_id', $partners_id)->latest()->get();
            //return $partners;
        } else {
            $partners = null;
        }
        if (Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%message%")->where('page_type', 'Group')->latest()->first() != null) {
            $message_id = Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%message%")->where('page_type', 'Group')->latest()->first()->id;
            $message = Navigation::query()->where('parent_page_id', $message_id)->latest()->first();
            // return $message;
        } else {
            $message = null;
        }
        if (Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%slider%")->where('page_type', 'Group')->latest()->first() != null) {
            $slider_id = Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%slider%")->where('page_type', 'Group')->latest()->first()->id;
            $sliders = Navigation::query()->where('parent_page_id', $slider_id)->latest()->get();
        } else {
            $sliders = null;
        }
        if (Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%misson%")->where('page_type', 'Group')->latest()->first() != null) {
            $misson_id = Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%misson%")->where('page_type', 'Group')->latest()->first()->id;
            $missons = Navigation::query()->where('parent_page_id', $misson_id)->latest()->get();
            //return $misson;
        } else {
            $missons = null;
        }
        if (Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%message%")->where('page_type', 'Group')->latest()->first() != null) {
            $message_id = Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%message%")->where('page_type', 'Group')->latest()->first()->id;
            $message = Navigation::query()->where('parent_page_id', $message_id)->latest()->first();
        } else {
            $message = null;
        }
        if (Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%process%")->where('page_type', 'Group')->latest()->first() != null) {
            $process_id = Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%process%")->where('page_type', 'Group')->latest()->first()->id;
            $process = Navigation::query()->where('parent_page_id', $process_id)->latest()->get();
        } else {
            $process = null;
        }
        //return $misson;
        $job_categories = Navigation::all()->where('nav_category', 'Main')->where('page_type', 'Group')->where('banner_image', '!=', null);
        //sreturn $job_categories;
        $global_setting = GlobalSetting::all()->first();
        //return view("website.index")->with(['jobs'=>$jobs,'banners'=>$banners,'about'=>$About,'menus'=>$menus,'global_setting'=>$global_setting,'sliders'=>$sliders,'missons'=>$missons,'job_categories'=>$job_categories,'message'=>$message,'process'=>$process]);
        if (Navigation::all()->where('nav_name', $menu)->count() > 0) {
            $job_id = Navigation::all()->where('nav_name', $menu)->first()->id;
            $jobs = Navigation::query()->where('parent_page_id', $job_id)->where('page_type', 'Job')->orderBy('created_at', 'desc')->get();
        } else {
            $jobs = null;
        }
        $slug_detail = Navigation::all()->where('nav_name', $menu)->first();
        //
        if (Navigation::all()->where('nav_name', $menu)->count() > 0) {
            //$normal_notice_page = Navigation::all()->where('nav_name',$slug)->first();
            $category_id = Navigation::all()->where('nav_name', $menu)->first()->id;

            if (Navigation::all()->where('parent_page_id', $category_id)->count() > 0) {
                $category_type = Navigation::all()->where('parent_page_id', $category_id)->first()->page_type;
            } else {
                $category_type = Navigation::all()->where('nav_name', $menu)->where('page_type', '!=', 'Notice')->first()->page_type;
            }
        } else {
            $category_type = null;
        }
        if ($category_type == "Photo Gallery") {
            //return "return to page gallary";
            $photos = Navigation::query()->where('parent_page_id', $category_id)->where('page_status', '1')->latest()->get();
            return view("website.gallery")->with(['partners', 'photos' => $photos, 'jobs' => $jobs, 'menus' => $menus, 'sliders' => $sliders, 'about' => $About, 'global_setting' => $global_setting, 'slug_detail' => $slug_detail]);
        } elseif ($category_type == "Video Gallery") {
            return "return to page gallary";
            $photos = Navigation::query()->where('parent_page_id', $category_id)->where('page_status', '1')->latest()->get();
            return view("website.gallery")->with(['photos' => $photos, 'jobs' => $jobs, 'menus' => $menus, 'sliders' => $sliders, 'about' => $About, 'global_setting' => $global_setting, 'slug_detail' => $slug_detail]);
        } elseif ($category_type == "Job") {
            //return "return to view job";
            return view("website.thematic_details")->with(['jobs' => $jobs, 'menus' => $menus, 'sliders' => $sliders, 'about' => $About, 'global_setting' => $global_setting, 'slug_detail' => $slug_detail]);
        } elseif ($category_type == "Notice") {
            // return "return to view Notice";
            $notices = Navigation::query()->where('parent_page_id', $category_id)->latest()->get();
            $notice_heading = Navigation::find($category_id)->first();
            // return $notice_heading;
            //return $notice_heading;
            return view("website.notice")->with(['notice_heading' => $notice_heading, 'notices' => $notices, 'jobs' => $jobs, 'menus' => $menus, 'sliders' => $sliders, 'about' => $About, 'global_setting' => $global_setting, 'slug_detail' => $slug_detail]);
        } elseif ($category_type == "Normal") {
            //return $category_id;
            $normal = Navigation::find($category_id);

            return view("website.normal")->with(['message' => $message, 'normal' => $normal, 'jobs' => $jobs, 'menus' => $menus, 'sliders' => $sliders, 'about' => $About, 'global_setting' => $global_setting, 'slug_detail' => $slug_detail]);
        } elseif ($category_type == "Career") {
            // return $category_id;
            $career = Navigation::find($category_id);
            $career_breed = $career->career_childs;

            return view("website.career")->with(['message' => $message, 'career' => $career, 'jobs' => $jobs, 'menus' => $menus, 'sliders' => $sliders, 'about' => $About, 'global_setting' => $global_setting, 'slug_detail' => $slug_detail, "career_breed" => $career_breed]);
        } else {

            return redirect('/');
        }
    }

    public function subcategory($slug1, $submenu)
    {
        $menus = Navigation::query()->where('nav_category', 'Main')->where('page_type', '!=', 'Job')->where('page_type', '!=', 'Photo Gallery')->where('page_type', '!=', 'Notice')->where('parent_page_id', 0)->where('page_status', '1')->orderBy('position', 'ASC')->get();
        // return $menus->first()->submenus;
        $jobs = Navigation::query()->where('page_type', 'Job')->latest()->get();
        if (Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%about%")->where('page_type', 'Group')->latest()->first() != null) {
            $about_id = Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%about%")->where('page_type', 'Group')->latest()->first()->id;
            $About = Navigation::query()->where('parent_page_id', $about_id)->latest()->first();
        } else {
            $About = null;
        }
        if (Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%banner%")->where('page_type', 'Group')->latest()->first() != null) {
            $banner_id = Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%banner%")->where('page_type', 'Group')->latest()->first()->id;
            $banners = Navigation::query()->where('parent_page_id', $banner_id)->latest()->get();
        } else {
            $banners = null;
        }
        if (Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%message%")->where('page_type', 'Group')->latest()->first() != null) {
            $message_id = Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%message%")->where('page_type', 'Group')->latest()->first()->id;
            $message = Navigation::query()->where('parent_page_id', $message_id)->latest()->first();
        } else {
            $message = null;
        }
        if (Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%partner%")->where('page_type', 'Group')->latest()->first() != null) {
            $partners_id = Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%partner%")->where('page_type', 'Group')->latest()->first()->id;
            $partners = Navigation::query()->where('parent_page_id', $partners_id)->latest()->get();
            //return $partners;
        } else {
            $partners = null;
        }

        if (Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%slider%")->where('page_type', 'Group')->latest()->first() != null) {
            $slider_id = Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%slider%")->where('page_type', 'Group')->latest()->first()->id;
            $sliders = Navigation::query()->where('parent_page_id', $slider_id)->latest()->get();
        } else {
            $sliders = null;
        }
        if (Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%misson%")->where('page_type', 'Group')->latest()->first() != null) {
            $misson_id = Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%misson%")->where('page_type', 'Group')->latest()->first()->id;
            $missons = Navigation::query()->where('parent_page_id', $misson_id)->latest()->get();
            //return $misson;
        } else {
            $missons = null;
        }
        if (Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%message%")->where('page_type', 'Group')->latest()->first() != null) {
            $message_id = Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%message%")->where('page_type', 'Group')->latest()->first()->id;
            $message = Navigation::query()->where('parent_page_id', $message_id)->latest()->first();
        } else {
            $message = null;
        }
        if (Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%process%")->where('page_type', 'Group')->latest()->first() != null) {
            $process_id = Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%process%")->where('page_type', 'Group')->latest()->first()->id;
            $process = Navigation::query()->where('parent_page_id', $process_id)->latest()->get();
        } else {
            $process = null;
        }
        //return $misson;
        $job_categories = Navigation::all()->where('nav_category', 'Main')->where('page_type', 'Group')->where('banner_image', '!=', null);
        //sreturn $job_categories;
        $global_setting = GlobalSetting::all()->first();
        //return view("website.index")->with(['jobs'=>$jobs,'banners'=>$banners,'about'=>$About,'menus'=>$menus,'global_setting'=>$global_setting,'sliders'=>$sliders,'missons'=>$missons,'job_categories'=>$job_categories,'message'=>$message,'process'=>$process]);
        if (Navigation::all()->where('nav_name', $submenu)->count() > 0) {
            $job_id = Navigation::all()->where('nav_name', $submenu)->first()->id;
            $jobs = Navigation::query()->where('parent_page_id', $job_id)->where('page_type', 'Job')->orderBy('created_at', 'desc')->get();
        } else {
            $jobs = null;
        }
        $slug_detail = Navigation::all()->where('nav_name', $submenu)->first();
        //
        if (Navigation::all()->where('nav_name', $submenu)->count() > 0) {
            $subcategory_id = Navigation::all()->where('nav_name', $submenu)->first()->id;
            if (Navigation::all()->where('parent_page_id', $subcategory_id)->count() > 0) {
                $subcategory_type = Navigation::all()->where('parent_page_id', $subcategory_id)->first()->page_type; //slug/slug2(GROUP)
            } else {
                //return Navigation::all()->where('nav_name',$submenu)->where('page_type','Normal')->first()->page_type;
                if (Navigation::all()->where('nav_name', $submenu)->where('page_type', 'Normal')->count() > 0) {
                    $subcategory_type = Navigation::all()->where('nav_name', $submenu)->where('page_type', 'Normal')->first()->page_type; //slug/slug2(group)

                } elseif (Navigation::all()->where('nav_name', $submenu)->where('page_type', 'Video Gallery')->count() > 0) {
                    $subcategory_type = Navigation::all()->where('nav_name', $submenu)->where('page_type', 'Video Gallery')->first()->page_type; //slug/slug2(group)
                    //return $subcategory_type;
                } elseif (Navigation::all()->where('nav_name', $submenu)->where('page_type', 'Photo Gallery')->count() > 0) {
                    $navigataion_id = Navigation::where('nav_name', $submenu)->first()->id;
                    $photos = NavigationItems::where('navigation_id', $navigataion_id)->get();
                    return view("website.gallery_view")->with(['partners' => $partners, 'photos' => $photos, 'jobs' => $jobs, 'menus' => $menus, 'sliders' => $sliders, 'about' => $About, 'global_setting' => $global_setting, 'slug_detail' => $slug_detail]);
                } else {
                    return redirect('/'); //submenu is page_type=Group and its internal items are empty
                }
            }
        } else {
            //return "no passing"
            $subcategory_type = null;
        }
        // return $subcategory_type;
        if ($subcategory_type == "Photo Gallery") {
            //return "return to page gallary";
            $photos = Navigation::query()->where('parent_page_id', $subcategory_id)->where('page_status', '1')->latest()->get();
            return view("website.gallery")->with(['partners' => $partners, 'photos' => $photos, 'jobs' => $jobs, 'menus' => $menus, 'sliders' => $sliders, 'about' => $About, 'global_setting' => $global_setting, 'slug_detail' => $slug_detail]);
        } elseif ($subcategory_type == "Video Gallery") {
            $photos = NavigationVideoItems::where('navigation_id', $subcategory_id)->get();
            return view("website.video_gallery")->with(["partners" => $partners, 'photos' => $photos, 'jobs' => $jobs, 'menus' => $menus, 'sliders' => $sliders, 'about' => $About, 'global_setting' => $global_setting, 'slug_detail' => $slug_detail]);
        } elseif ($subcategory_type == "Job") {
            $job_category = Navigation::find($subcategory_id);
            $jobs = Navigation::find($subcategory_id)->childs;

            return view("website.thematic_details")->with(["partners" => $partners, 'jobs' => $jobs, 'menus' => $menus, 'sliders' => $sliders, 'about' => $About, 'global_setting' => $global_setting, 'slug_detail' => $slug_detail, "job_category" => $job_category, "jobs" => $jobs]);
        } elseif ($subcategory_type == "Notice") {
            // return "return to view Notice";
            $notices = Navigation::query()->where('parent_page_id', $subcategory_id)->where('page_type', 'Notice')->latest()->get();
            $notice_heading = Navigation::find($subcategory_id);
            //return $notice_heading;
            return view("website.notice")->with(["partners" => $partners, 'notice_heading' => $notice_heading, 'notices' => $notices, 'jobs' => $jobs, 'menus' => $menus, 'sliders' => $sliders, 'about' => $About, 'global_setting' => $global_setting, 'slug_detail' => $slug_detail]);
        } elseif ($subcategory_type == "Team") {
            // return "return to view Notice";
            $team = Navigation::query()->where('parent_page_id', $subcategory_id)->where('page_type', 'Notice')->latest()->get();
            $team_heading = Navigation::find($subcategory_id);
            // return $team_heading->childs;
            $teamsub = $team_heading->childs;
            // return $teamsub;
            return view("website.team")->with(["partners" => $partners, 'team_heading' => $team_heading, 'team' => $team, 'jobs' => $jobs, 'menus' => $menus, 'sliders' => $sliders, 'about' => $About, 'global_setting' => $global_setting, 'slug_detail' => $slug_detail, 'teamsub' => $teamsub]);
        } elseif ($subcategory_type == "Normal") {
            $normal = Navigation::find($subcategory_id);
            $normal_sub = $normal->childs;
            return view("website.normal")->with(["partners" => $partners, 'message' => $message, 'normal' => $normal, 'jobs' => $jobs, 'menus' => $menus, 'sliders' => $sliders, 'about' => $About, 'global_setting' => $global_setting, 'slug_detail' => $slug_detail, 'normal_sub' => $normal_sub]);
            
            
        } elseif ($subcategory_type == "Publication" || $subcategory_type=='Proceeding Report') {
            $publication_parent = Navigation::find($subcategory_id);
            $publication_parent_sub = $publication_parent->childs;
            //  return $publication_parent_sub;
            return view("website.all-publication")->with(["partners" => $partners, 'jobs' => $jobs, 'menus' => $menus, 'sliders' => $sliders, 'about' => $About, 'global_setting' => $global_setting, 'slug_detail' => $slug_detail, 'publication_parent' => $publication_parent, 'publication_parent_sub' => $publication_parent_sub]);
            }elseif ($subcategory_type == "Policy Briefs" || $subcategory_type == "Policy Briefs group" ) {
            $publication_parent = Navigation::find($subcategory_id);
            $publication_parent_sub = $publication_parent->childs;
            //  return $slug1;
            return view("website.all-publication")->with(["slug1" => $slug1,"partners" => $partners, 'jobs' => $jobs, 'menus' => $menus, 'sliders' => $sliders, 'about' => $About, 'global_setting' => $global_setting, 'slug_detail' => $slug_detail, 'publication_parent' => $publication_parent, 'publication_parent_sub' => $publication_parent_sub]);
            
            
        } elseif ($subcategory_type == "Group") {
            $themic_parent = Navigation::find($subcategory_id);
            $themic_parent_sub = $themic_parent->childs;
            // return $jobs;



            // $dat =  $themic_parent->childs->first();
            // return $dat->childs;

            return view("website.thematic_details")->with(["partners" => $partners, 'jobs' => $jobs, 'menus' => $menus, 'sliders' => $sliders, 'about' => $About, 'global_setting' => $global_setting, 'slug_detail' => $slug_detail, 'themic_parent' => $themic_parent, 'themic_parent_sub' => $themic_parent_sub,]);
        } else {
            // return "hlo";
        }
    }
    public function singlePage($slug)
    {
        $career_details = Navigation::all()->where('nav_name', $slug)->first();
        // return $career_details->parent_page_id;
        if (Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%partner%")->where('page_type', 'Group')->latest()->first() != null) {
            $partners_id = Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%partner%")->where('page_type', 'Group')->latest()->first()->id;
            $partners = Navigation::query()->where('parent_page_id', $partners_id)->latest()->get();
            //return $partners;
        } else {
            $partners = null;
        }
        // return ;
        $global_setting = GlobalSetting::all()->first();
        $menus = Navigation::query()->where('nav_category', 'Main')->where('page_type', '!=', 'Job')->where('page_type', '!=', 'Photo Gallery')->where('page_type', '!=', 'Notice')->where('parent_page_id', 0)->where('page_status', '1')->orderBy('position', 'ASC')->get();
        return view("website.career_datails")->with(["partners" => $partners, 'career_details' => $career_details, 'menus' => $menus, 'global_setting' => $global_setting]);
    }






    public function Alll_Month_Page($slug)
    {
        $career_details = Navigation::all()->where('nav_name', $slug)->first();
        return $career_details->parent_page_id;
        if (Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%partner%")->where('page_type', 'Group')->latest()->first() != null) {
            $partners_id = Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%partner%")->where('page_type', 'Group')->latest()->first()->id;
            $partners = Navigation::query()->where('parent_page_id', $partners_id)->latest()->get();
            //return $partners;
        } else {
            $partners = null;
        }
        $global_setting = GlobalSetting::all()->first();
        $menus = Navigation::query()->where('nav_category', 'Main')->where('page_type', '!=', 'Job')->where('page_type', '!=', 'Photo Gallery')->where('page_type', '!=', 'Notice')->where('parent_page_id', 0)->where('page_status', '1')->orderBy('position', 'ASC')->get();
        return view("website.all_months_data")->with(["partners" => $partners, 'career_details' => $career_details, 'menus' => $menus, 'global_setting' => $global_setting]);
    }




    public function get_all_Acc_date($slug)
    {
        $dates = Navigation::where('page_title', $slug)->where('nav_category', 'Main')->where('page_type', '!=', 'Career')->where('page_type', '!=', 'Group')->where('page_type', '!=', 'Normal')->where('page_type', '!=', 'Publication')->paginate(12);
        // return $dates;
        $date = Date::all()->where('nav_category', 'Main');

        $dates_title = Navigation::all()->where('page_title', $slug)->where('nav_category', 'Main')->first();




        if (Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%partner%")->where('page_type', 'Group')->latest()->first() != null) {
            $partners_id = Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%partner%")->where('page_type', 'Group')->latest()->first()->id;
            $partners = Navigation::query()->where('parent_page_id', $partners_id)->latest()->get();
            //return $partners;
        } else {
            $partners = null;
        }
        $global_setting = GlobalSetting::all()->first();
        $menus = Navigation::query()->where('nav_category', 'Main')->where('page_type', '!=', 'Job')->where('page_type', '!=', 'Photo Gallery')->where('page_type', '!=', 'Notice')->where('parent_page_id', 0)->where('page_status', '1')->orderBy('position', 'ASC')->get();
        return view("website.all_data_acc_date")->with(["partners" => $partners,  'menus' => $menus, 'global_setting' => $global_setting, "dates" => $dates, 'dates_title' => $dates_title, 'date' => $date]);
    }


    public function get_all_Acc_Monthly($slug)
    {
        // return "data";
        $monthly_dates_parent = Navigation::all()->where('nav_name', $slug)->where('nav_category', 'Main')->first();
        // return $monthly_dates_parent;


        $monthly_dates = Navigation::all()->where('nav_name', $slug)->where('nav_category', 'Main')->first()->childs->where('caption', "Monthly Analysis")->first()->childs;
        // return $monthly_dates;

        $date = Date::all()->where('nav_category', 'Main');

        $dates_title = Navigation::all()->where('page_title', $slug)->where('nav_category', 'Main')->first();




        if (Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%partner%")->where('page_type', 'Group')->latest()->first() != null) {
            $partners_id = Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%partner%")->where('page_type', 'Group')->latest()->first()->id;
            $partners = Navigation::query()->where('parent_page_id', $partners_id)->latest()->get();
            //return $partners;
        } else {
            $partners = null;
        }
        $global_setting = GlobalSetting::all()->first();
        $menus = Navigation::query()->where('nav_category', 'Main')->where('page_type', '!=', 'Job')->where('page_type', '!=', 'Photo Gallery')->where('page_type', '!=', 'Notice')->where('parent_page_id', 0)->where('page_status', '1')->orderBy('position', 'ASC')->get();
        return view("website.monthly_data_acco_to_caption")->with(["partners" => $partners,  'menus' => $menus, 'global_setting' => $global_setting, "monthly_dates" => $monthly_dates, 'dates_title' => $dates_title, 'date' => $date, 'monthly_dates_parent' => $monthly_dates_parent]);
    }




    public function All_cat_data($slug)
    {
        // return $slug;
        $career_details = Navigation::all()->where('nav_name', $slug);
        $page_type =  $career_details->first()->childs->first()->page_type;
        $allData = Navigation::where("page_type", $page_type)->orderBy('page_keyword','DESC')->paginate(12);
        // return $page_type;
        if (Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%partner%")->where('page_type', 'Group')->latest()->first() != null) {
            $partners_id = Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%partner%")->where('page_type', 'Group')->latest()->first()->id;
            $partners = Navigation::query()->where('parent_page_id', $partners_id)->latest()->get();
            //return $partners;
        } else {
            $partners = null;
        }
        $global_setting = GlobalSetting::all()->first();
        $menus = Navigation::query()->where('nav_category', 'Main')->where('page_type', '!=', 'Job')->where('page_type', '!=', 'Photo Gallery')->where('page_type', '!=', 'Notice')->where('parent_page_id', 0)->where('page_status', '1')->orderBy('position', 'ASC')->get();
        return view("website.all_months_data")->with(["partners" => $partners, 'career_details' => $career_details, 'menus' => $menus, 'global_setting' => $global_setting, 'allData' => $allData, 'page_type' => $page_type]);
    }







    public function Team_details($slug)
    {
        // return $slug;
        $career_details = Navigation::all()->where('nav_name', $slug)->first();
        
        // return $career_details;
        if (Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%partner%")->where('page_type', 'Group')->latest()->first() != null) {
            $partners_id = Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%partner%")->where('page_type', 'Group')->latest()->first()->id;
            $partners = Navigation::query()->where('parent_page_id', $partners_id)->latest()->get();
            //return $partners;
        } else {
            $partners = null;
        }
        $global_setting = GlobalSetting::all()->first();
        $menus = Navigation::query()->where('nav_category', 'Main')->where('page_type', '!=', 'Job')->where('page_type', '!=', 'Photo Gallery')->where('page_type', '!=', 'Notice')->where('parent_page_id', 0)->where('page_status', '1')->orderBy('position', 'ASC')->get();
        return view("website.team_details")->with(["partners" => $partners, 'career_details' => $career_details, 'menus' => $menus, 'global_setting' => $global_setting, ]);
    }


   public function pdf_details($slug)
    {
        // return $slug;
        $career_details = Navigation::all()->where('nav_name', $slug)->first();
        
        // return $career_details;
        if (Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%partner%")->where('page_type', 'Group')->latest()->first() != null) {
            $partners_id = Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%partner%")->where('page_type', 'Group')->latest()->first()->id;
            $partners = Navigation::query()->where('parent_page_id', $partners_id)->latest()->get();
            //return $partners;
        } else {
            $partners = null;
        }
        $global_setting = GlobalSetting::all()->first();
        $menus = Navigation::query()->where('nav_category', 'Main')->where('page_type', '!=', 'Job')->where('page_type', '!=', 'Photo Gallery')->where('page_type', '!=', 'Notice')->where('parent_page_id', 0)->where('page_status', '1')->orderBy('position', 'ASC')->get();
        return view("website.pdf_details")->with(["partners" => $partners, 'career_details' => $career_details, 'menus' => $menus, 'global_setting' => $global_setting, ]);
    }







    public function ReadMore($slug)
    {
        if (Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%message%")->where('page_type', 'Group')->latest()->first() != null) {
            $message_id = Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%message%")->where('page_type', 'Group')->latest()->first()->id;
            $message = Navigation::query()->where('parent_page_id', $message_id)->latest()->first();
        } else {
            $message = null;
        }
        $normal = Navigation::where('nav_name', $slug)->first();
        //return $normal;
        $global_setting = GlobalSetting::all()->first();
        $menus = Navigation::query()->where('nav_category', 'Main')->where('page_type', '!=', 'Job')->where('page_type', '!=', 'Photo Gallery')->where('page_type', '!=', 'Notice')->where('parent_page_id', 0)->where('page_status', '1')->orderBy('position', 'ASC')->get();
        // return $menus;
        return view("website.normal")->with(['message' => $message, 'slug_detail' => $normal, 'normal' => $normal, 'menus' => $menus, 'global_setting' => $global_setting, 'job_slug' => $slug]);
    }
    public function allCategory()
    {
        $job_categories = Navigation::all()->where('nav_category', 'Main')->where('page_type', 'Group')->where('banner_image', '!=', null);
        $global_setting = GlobalSetting::all()->first();
        $menus = Navigation::query()->where('nav_category', 'Main')->where('page_type', '!=', 'Job')->where('page_type', '!=', 'Photo Gallery')->where('page_type', '!=', 'Notice')->where('parent_page_id', 0)->where('page_status', '1')->orderBy('position', 'ASC')->get();
        return view("website.all_category")->with(['job_categories' => $job_categories, 'menus' => $menus, 'global_setting' => $global_setting]);
    }
    public function allJobs()
    {
        $jobs = Navigation::query()->where('page_type', 'Job')->latest()->get();
        $global_setting = GlobalSetting::all()->first();
        $menus = Navigation::query()->where('nav_category', 'Main')->where('page_type', '!=', 'Job')->where('page_type', '!=', 'Photo Gallery')->where('page_type', '!=', 'Notice')->where('parent_page_id', 0)->where('page_status', '1')->orderBy('position', 'ASC')->get();
        return view("website.job-list")->with(['jobs' => $jobs, 'menus' => $menus, 'global_setting' => $global_setting]);
    }
    public function GalleryView($slug)
    {
        $navigataion_id = Navigation::where('nav_name', $slug)->first()->id;
        $photos = NavigationItems::where('navigation_id', $navigataion_id)->get();
        $normal = Navigation::find($navigataion_id);

        $global_setting = GlobalSetting::all()->first();
        $menus = Navigation::query()->where('nav_category', 'Main')->where('page_type', '!=', 'Job')->where('page_type', '!=', 'Photo Gallery')->where('page_type', '!=', 'Notice')->where('parent_page_id', 0)->where('page_status', '1')->orderBy('position', 'ASC')->get();
        return view("website.gallery_view")->with(['photos' => $photos, 'menus' => $menus, 'global_setting' => $global_setting, "normal" => $normal]);
    }
    public function search(Request $request)
    {
        $query = $request->input('search_query');
        // return $query;
        if (Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%message%")->where('page_type', 'Group')->latest()->first() != null) {
            $message_id = Navigation::query()->where('nav_category', 'Home')->where('nav_name', 'LIKE', "%message%")->where('page_type', 'Group')->latest()->first()->id;
            $message = Navigation::query()->where('parent_page_id', $message_id)->latest()->first();
        } else {
            $message = null;
        }
        if($query == "Commentaries" || $query == "commentaries" )
            return redirect('/all_data/International-Relations-&-Foreign-Affairs-Commerntaries');
        if($query == "Policy Briefs" || $query == "policybriefs" || $query == "policybrief" || $query == "Policybrief" )
            return redirect('/RESEARCH-OUTPUTS/Policy-Briefs');
        $searchdata = Navigation::where('caption', 'like', "%".$query."%")
                                ->where(function($query) {
                                    $query->where('page_type', 'Commentaries')                        
                                            ->orwhere('page_type', 'Publication')
                                            ->orwhere('page_type', 'Proceeding Report')
                                            ->orwhere('page_type', 'Policy Briefs');
                                })
                            ->get();
        // return $searchdata;
        $global_setting = GlobalSetting::all()->first();
        $menus = Navigation::query()->where('nav_category', 'Main')->where('page_type', '!=', 'Job')->where('page_type', '!=', 'Photo Gallery')->where('page_type', '!=', 'Notice')->where('parent_page_id', 0)->where('page_status', '1')->orderBy('position', 'ASC')->get();
        // return $menus;
        return view("website.search-results")->with(['message' => $message, 'slug_detail' => $searchdata->first(), 'searchdata' => $searchdata, 'menus' => $menus, 'global_setting' => $global_setting, 'job_slug' => $query]);
    }
}
