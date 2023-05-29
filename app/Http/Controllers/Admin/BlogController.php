<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogComment;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        $blogs = Blog::all();
        return view('admin.blogs.index',compact('blogs'));
    }

    public function show($uuid){
        $blog = Blog::where('uuid',$uuid)->first();
        if(!$blog){
            return redirect()->back()->with('error','هذا المقال غير موجود');
        }

        return view('admin.blogs.show',compact('blog'));
    }

    public function deleteComment($id){
        $comment = BlogComment::where('id',$id)->first();
        if(!$comment){
            return redirect()->back()->with('error','هذا التعليق غير موجود');
        }
        $comment->delete();
        return redirect()->back()->with('success','تم حذف التعليق بنجاح');

    }
}
