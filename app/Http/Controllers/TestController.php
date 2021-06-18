<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Cookie;
    

class TestController extends Controller
{
    public function about(){
        $header = 'Welcome From About View File';
//        return view('pages/about',compact('title')); this function to pass a var to view file through view functiomn.or u can use this
        return view('pages/about')->with('header',$header);//the var and the name is case senstive they should be identical
    }
        
    public function test(){
        $data = array(
            'header' => 'hi this is header',
            'services' => ['web design','programming','OS']
        );
        return view('pages/test')->with($data);//or i can write a h=whoe ass arrsy instead of passing avar like [''=>''] view down there
    }
    public function category($id) {
        $tablesNamesInDB = [
            '1' => 'category',
            '2' => 'programming',
            '3' => 'books'
        ]; 
        return view('pages/category',['the_id' => $tablesNamesInDB[$id] ?? 'this id not found in DB']);
    }
    
    public function contact() {
        
        return view('pages/contact',[
        //key = variable   //vlaue
        "page_name"        =>"Contact Me View Page ",
        "page_description" =>"this is contact me page"
        ]);
    }
   
    
    public function showReq(Request $request){
        return $request -> url();
    }
    
    
    
    
    
    
    
   ////------------------START Form Request-----------////////// 
    /*public function ShowLoginPage(){
        return view('pages/login');
    }
    public function Store(Request $requesteq){
        $username = $requesteq->input('username');
        $pass = $requesteq->input('pass');
        return "Username: ".$username."<br>"."Password: ".$pass."<br>";
                
    }*/
   ////------------------END Form Request-----------////////// 
    
    
    ////------------------START Form Redirection-----------/////////
    /*public function ShowLoginPage(){
        return view('pages/login');
    }
     public function Store(Request $request){
         
        $username = "Mariam Zayed";
        $pass = "mmmm";
        if($username!=$request->input('username')&&$pass!=$request->input('pass'))
        {
            return redirect()->back();
        }else{
            return redirect(route('okLogin'));
        }
     }
     
      public function ifLoginOk(){
          return view('pages/okLogin');
      }*/
    
    
    ////------------------END Form Redirection-----------////////// 
    
    
    ////------------------START of Session-----------/////////
    /*public function setSession(Request $request){
        $request->session()->put('name','user');
        echo 'session crated';
    }
    public function getSession(Request $request){
        if($request->session()->has('name')===false){
            echo 'session Not Fond';
        }else{
            echo $request->session()->get('name');
        }
    }
    public function delSession(Request $request){
        echo $request->session()->forget('name');
         echo 'session Deleted';
    }*/
    
    
    ////------------------END of Session-----------/////////
    
    
    
    
    
    
    
    
    /////////////________________ START OF Cookies _______________///////////

//    public function setCookie() {
//        Cookie::queue(cookie::make('cookieName','user',3600));
//        echo 'cookie created';
//    }
//    public function getCookie() {
//        if(cookie::has('cookieName')){
//            $value = cookie::get('cookieName');
//            echo $value;
//        }
//    }

    /////////////________________ End OF Cookies_______________///////////
    
    
     /////////////________________ START OF Validation _______________///////////
    
    public function showValidPage() {
        return view('pages/register');
    }
    public function saveInpute(Request $request) {
//        $message = [
//            'required'=>'Please insert your data'//this message will show to every required one in the down arr
//            ];
                $message = [
            'mail.required'=>'Please insert your data'
            ];//this one if I wanted to spacify one array elemnt with a cetain handmade message
                
                
       $this->validate($request,[//doing validtoin in form iputs which I have.validation fun takers to params request var whose doing the validation
            'username' => 'required',
            'pass' => 'required|min:3',
            'mail' => 'required|email',
            'image' => 'nullable'
//       $username = ;
       ]
//               ,$message//if i dont want to change the default msg that laravel prints 'll del this line
               );
//       return $request->all();
       
       if($request->hasfile('image')){
          $fileObj = $request->file('image');
           $extension = $fileObj->getClientOriginalExtension();
           $fileName = $fileObj->getClientOriginalName();
           $path = $fileObj->store('avatar');
           return $path;
       }
    }
    
    
    
    
    /////////////________________ End OF Validation _______________///////////
    
}
