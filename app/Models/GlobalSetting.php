<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlobalSetting extends Model
{
    protected $table = "global_settings";
    protected $fillable = [
    		'site_name',
            'site_nepali_name',
    		'site_email',
    		'phone',
            'phone_ne',
    		'website_full_address',
            'address_ne',
    		'page_title',
    		'page_keyword',
    		'page_description',
    		'favicon',
    		'site_logo',
    		'site_logo_nepali',
    		'site_status',
            'extra_one',
            'extra_tow'
    ];
	public static function getSetting(){
		return GlobalSetting::all();
	}
}
