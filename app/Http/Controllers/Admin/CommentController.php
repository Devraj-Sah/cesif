<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentController extends Controller
{

    public function index($id)
    {
        $comments= Comment::where('blog_id', $id)->orderBy('id','DESC')->get();
        return view('admin.comment.comment_list', compact('comments'));
        
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email'
        ]);
        $data = $request->all();
        Comment::create($data);
        return redirect()->back()->with('success','Thank you!!');
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        $sub_del = Comment::find($id);
        $sub_del->delete();
        return redirect()->back()->with('success','Deleted Successfully!!');
    }

    public function updatestatus($id)
    {
        $data = Comment::find($id);
        $status = $data->status;
        if($status == '0'){
            $data['status'] = '1';     
            $data->status = $data['status']; 
            $data->save(); 
            return redirect()->back()->with('success','Comment Posted  Successfully');
        }
        elseif($status == '1'){
            $data['status'] = '0';     
            $data->status = $data['status']; 
            $data->save();
            return redirect()->back()->with('success','Comment Removed  Successfully');
        }        
                
    }
}

