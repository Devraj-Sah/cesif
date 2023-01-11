<?php

namespace App\Helpers;


use App\Models\Navigation;

class FrontendHelper
{
    public function getPagesBySlug($alias)
    {
        return Navigation::where('alias', $alias)->first();
    }

    public function getNavigationListByParent($parent_id)
    {
        return Navigation::where('id',$parent_id)->first();
    }

    public function getPagesByCategory($id)
    {
         return  Navigation::where('parent_page_id',$id)->orderBy('id','desc')->get();
    }
    
    public function getPagesByID($id)
    {
        return Navigation::where('id', $id)->first();
    }
}