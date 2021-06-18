<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class commentController extends Controller
{

    public function index()
    {
//        $comments = Comment::all();//then ita an ass arr
        $comments = Comment::latest()->get();//print not posting
//        $comments = Comment::orderBy('created_at','desc')->get();
//         $comments = Comment::where('id','>=','3')->get();
        
        return view('comment.index')->with('comments',$comments);  
    }

    public function create()
    {
        return view('comment/form');
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'comment' => 'required'
        ]);
        $CommentObj = new Comment();
        $CommentObj->name = $request->input('name');//take instance of the comment table to handle it cols, so the name col request to take the value from the name input in the form
        $CommentObj->comment = $request->input('comment');
        $CommentObj->save();
        return redirect(route('comment.index'));
    }

    public function show($id)
    {
//       $comment = Comment::where('id',$id)->get();//NOT WORKING ERROR//take this $id then search in table Comment for it's comment. get means get it from table
       $comment = Comment:: find ($id);//both are same it'a an ass arr
        return view('comment.show')->with('comment',$comment);
    }
    
    public function edit($id)
    {
        $comment = Comment:: find($id);
        return view('comment.edit')->with('comment',$comment);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
           'name' => 'required',
           'comment' => 'required'
        ]);
        $comment = Comment::find($id);
        $comment->name = $request->input('name');
        $comment->comment = $request->input('comment');
        $comment->save();
    }
    
    public function destroy($id)
    {
        //
    }
}
