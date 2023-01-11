<?php

namespace App\Models;

use App\Job;
use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    protected $table = "navigations";
    protected $fillable = [
        'nav_name',
        'alias',
        'caption',
        'caption_nepali',
        'nav_category',
        'page_type',
        'page_template',
        'position',
        'short_content',
        'short_content_nepali',
        'long_content',
        'long_content_nepali',
        'parent_page_id',
        'icon_image',
        'featured_image',
        'icon_image_caption',
        'banner_image',
        'link',
        'main_attachment',
        'attachment',
        'page_title',
        'page_keyword',
        'page_description',
        'page_status',
        'nav_status',
        'extra_one',
        'extra_two',
        'extra_three'
    ];

    public function navigationitems()
    {

        return $this->hasMany('App\Models\NavigationItems');
    }

    public function childs()
    {
        return $this->hasMany('App\Models\Navigation', 'parent_page_id', 'id')->where('page_type', '!=', 'Client')->where('page_type', '!=', 'Career')->where('page_status', '1')->orderBy('position', 'ASC');
    }


    public function career_childs()
    {
        return $this->hasMany('App\Models\Navigation', 'parent_page_id', 'id')->where('page_status', '1')->orderBy('position', 'ASC');
    }



    public function client_childs()
    {
        return $this->hasMany('App\Models\Navigation', 'parent_page_id', 'id')->where('page_status', '1')->orderBy('position', 'ASC');
    }


    public function parents()
    {
        return $this->belongsTo('App\Models\Navigation', 'parent_page_id', 'id');
    }

    public function getRelatedNews()
    {
        $news =  $this->hasMany(Navigation::class, 'parent_page_id', 'id'); //Navigation::all()->where('parent_page_id')->latest()->get();
        return $news->orderBy('created_at', 'desc');
    }

    public function getJob()
    {
        return $this->belongsTo(Job::class, 'id', 'navigation_id'); //job class->navigation id to related with->job foreign id i.e navigation id.
    }
}
