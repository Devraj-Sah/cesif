<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Navigation;
use App\Models\navigationItems;

class GalleryController extends Controller
{
    public function gallery($id)
    {
    	 return view('frontend.photos');
    }
}
