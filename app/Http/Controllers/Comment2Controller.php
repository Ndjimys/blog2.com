<?php

namespace App\Http\Controllers;

use Illuminate\http\Request;
use App\Comment;
use App\User;
use App\Topic;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\RegisterRequest;
use Illuminate\Support\Facades\Hash;
class CommentController extends Controller
{ 
	public function ajaxImage(Request $request)
    {
        if ($request->isMethod('get'))
            return view('ajax_image_upload');
        else {
            $validator = Validator::make($request->all(),
                [
                    'file' => 'image',
                ],
                [
                    'file.image' => 'The file must be an image (jpeg, png, bmp, gif, or svg)'
                ]);
            if ($validator->fails())
                return array(
                    'fail' => true,
                    'errors' => $validator->errors()
            );

            $extension = $request->file('file')->getClientOriginalExtension();
            $dir = 'uploads/';
            $filename = uniqid() . '_' . time() . '.' . $extension;
            $request->file('file')->move($dir, $filename);
            return $filename;
        }
    }

    public function deleteImage($filename)
    {
        File::delete('uploads/' . $filename);
    }
	public function addTopicForm($id_user)
    {
        
        return view('addTopic')->with("id_user", $id_user);
        //return response()->json( $comments);
    } 
    public function commentTopic($id_topic)
    {
        session_start();
        $comments=Comment::where('id_topic', "=", $id_topic)
        ->orderBy('created_at','desc')->get();
        $topic=Topic::where('id',"=",$id_topic)->first();

        $user=User::where("id", "=", $_SESSION['id_user'])->first();
        return view('comments')->with('data', ['topic'=>$topic, 'comments'=>$comments, 'user'=>$user]);

        //return response()->json($topic);
    } 

 	/*public function addTopic(Request $request)
    {
    	$parameters=$request->except('_token');

        $comments=Comment::where('id_topic',"=",$id_topic);
        $topic=Topic::where('id',"=",$id_topic)->first();
        
        return view('comments')->with('data', ['topic'=>$topic, 'comments'=>$comments]);

        //return response()->json($topic);
    } */
    public function allTopics()
    {
        $topics=Topic::orderBy('created_at','desc')->get();
        session_start();
        $user=User::where('id', "=", $_SESSION["id_user"])->first();
		    	
    	return view('topics')->with('data', ['user'=>$user, 'topics'=>$topics]);

        //return response()->json( $comments);
    } 
    public function addTopic(Request $request)
    {
        session_start();

        $parameters=$request->all();
        $topic=new Topic();
        $topic->titre=$parameters['titre'];
       	$topic->description=$parameters['description'];

        $topic->pj = '';
        
        $topic->save();
        return redirect()->route('allTopics', ['id_user'=> $_SESSION["id_user"]])->with('success', "Le sujet a été bien crée!");

        //return response()->json( $comments);
    } 
    public function connexionBlog()
    {
       return view('connexion');
    } 
    public function connexionBlogForm()
    {
       return view('connexion');
    } 
    public function inscriptionBlogForm()
    {
       return view('inscription');
    } 
	public function inscriptionBlog(Request $request)
    {
        $parameters=$request->all();
        $dir = 'uploads/';
		$filename = $parameters['file_name'];
        //$extension = $cover->getClientOriginalExtension();
      
        $user=new User();
        $user->name=$parameters['name'];
        $user->email=$parameters['email'];
        $user->profil='uploads/'.$filename;
        $user->password=Hash::make($parameters['password']);
        $user->save();
        //User::create($parameters);
        return redirect()->route('connexionBlog')->with('success', "Vous avez été bien inscrit au blog!");
    }
    

    public function checkUser(Request $request)
    {
        $parameters=$request->all();

        //$parameters=$request->all();
        $validator = Validator::make($request->all(),
	        [
	            'email' => 'required',
	            'password'=>'required'
	        ],
	        [
            'email.required' => 'The email is required',
            'password.required' => 'The password is required',

        ]);

        if ($validator->fails()){
			return redirect()->route('connexionBlog')->with('paramError', "Paramètres de connexion non définis!");  
            //return array('paramExist' => false,'errors' => $validator->errors()
        }
          
        $user=User::where('email', "=", $parameters['email'])->first();
        $users=User::all();
        //return var_dump(Hash::make($parameters['password'])). "------". response()->json($users);
        //return response()->json($users);;
        if($user!=null && Hash::check($parameters['password'], $user->password)){
        	session_start();
        	$_SESSION["id_user"]=$user->id;
        	$topics=Topic::orderBy('created_at','desc')->get();
        	// return array(
        	// 	'paramExist'=>true,
        	// 	'userExist'=>true,
        	// 	'user'=>reponse()->json($user)
        	// );
            //return response()->json($user);

			return redirect()->route('allTopics', ['id_user'=>$user->id])->with('success', "User successfully connected");      
     		  }
        else{
			return redirect()->route('connexionBlog')->with('error', "Paramètres de connexion incorrects!");  
        }
     
        //return response()->json($user);
        //return view('connexion')->with('user', $user);
    } 


    public function addComment(Request $request)
    {
    	$parameters=$request->except('_token');
    	//$parameters=$request->all();
    	Comment::create($parameters);
    	session_start();
        $comments=Comment::where('id_topic', "=", $parameters['id_topic'])
        ->orderBy('created_at','desc')->get();
        $topic=Topic::where('id',"=",$parameters['id_topic'])->first();

        $user=User::where("id", "=", $_SESSION['id_user'])->first();

        //return response()->json($comments);
        return redirect('commentTop', ["id_topic"=>$parameters['id_topic']]);
    	//return var_dump($parameters);
    }

    public function allgson()
    {
    	# code...
    	$collection=[['name'=>"ndjimi", "email"=>"ndjimi@gmail.com"], ["name"=>"konai", "email"=>"ndjimi@gmail.com"]];


    	return response()->json($collection);
    }

    public function getComments(Request $request)
    {
        $parameters=$request->except('_token');
        //$parameters=$request->all();
        Comment::create($parameters);
        $comments=Comment::all();
        return var_dump($parameters);

       // return view('comments')->with('comments', $comments);

    }

     public function viewSubject(Request $request)
    {
        $parameters=$request->except('_token');
        //$parameters=$request->all();
        $user=new User();
        $users=User::all();
        if(is_array($users)){
            foreach ($users as $puser) {
                # code...
                if($user->email==$request['email'] && $user->password==$request['password']){
                    return response()->json($user);
                }
            }
            return response()->json(["exist"=>"false"]);
        }

        else{
            return response()->json(["exist"=>"false"]);
        }

       // return view('comments')->with('comments', $comments);

    }

    public function getCommentsJson()
    {
        $comments=Comment::all();
        
        return view('comments')->with('comments', $comments);

        return response()->json( $comments);

    }
}
