<?php

namespace App\Http\Controllers\Admin;

use App\Models\PageType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;

/**
 * Class PageTypeController
 * @package App\Http\Controllers\Admin
 */
class PageTypeController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $page_types  = PageType::all();
        return view('admin.page-type.index',[
           'page_types' => $page_types
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.page-type.create');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $page_type = PageType::where('sort',$id)->first();
        return view('admin.page-type.edit',['model'=>$page_type]);
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function store(Request $request)
    {
        $data = $request->all();
        PageType::create($data);
        return redirect()->route('pageType.index')->with('success','Record was successfully saved!!');
    }

    /**
     * @param Request $request
     * @param $id
     * @return $this
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        PageType::where('sort', $id)->update(['page_type_title'=>$data['page_type_title']]);
        return redirect()->route('pageType.index')->with('success','Record was successfully Updated!!');
    }

    /**
     *
     */
    public function show()
    {

    }

    /**
     * @param $id
     * @return $this
     */
    public function destroy($id)
    {
        PageType::where('sort',$id)->delete();
        return redirect()->route('pageType.index')->with('success','Record was successfully Deleted!!');
    }
}
