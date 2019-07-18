<?php

namespace App\Http\Controllers;

use Illuminate\http\Request;
use App\Comments;
use App\User;
use App\Http\RegisterRequest;
use Illuminate\Support\Facades\Hash;
class CommentController extends Controller
{
    public function commentTopic($id_topic)
    {
        $comments=Comments::where('id_topic',"=",$id_topic);
        
        
        return view('comments')->with('data', ['topic'=>$topic, 'comments'=>$comments]);

        //return response()->json( $comments);
    } 

    public function allTopics()
    {
        $topics=Topics::all();
        
        return view('topics')->with('topics', $topics]);

        //return response()->json( $comments);
    } 
    public function addTopic(Request $request)
    {
        $parameters=$request->all();
        $topic=new Topics();
        $topic->titre=$parameters['titre'];
        $topic->description=$parameters['description'];
        $cover = $request->file('pj');
        $extension = $cover->getClientOriginalExtension();
        Storage::disk('public')->put($cover->getFilename().'.'.$extension,  File::get($cover));
        $topic->pj = $cover->getFilename().'.'.$extension;

        $topic->save();
        return redirect()->route('connexionBlog')->with('success', "Le sujet a été bien crée!");

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
        $parameters=$request->except('_token');
        //$parameters=$request->all();
        $user=new User();
        $user->name=$parameters['name'];
        $user->email=$parameters['email'];
        $user->password=Hash::make($parameters['password']);
        $user->save();
        //User::create($parameters);
        return redirect()->route('connexionBlog')->with('success', "Vous avez été bien inscrit au blog!");
    }
    

    public function checkUser(Request $request)
    {
        $parameters=$request->except('_token');
        //$parameters=$request->all();
        
        $user=User::where('email', "=", $parameters['email'])->first();
        $users=User::all();
        //return var_dump(Hash::make($parameters['password'])). "------". response()->json($users);
        //return response()->json($users);;
        if(Hash::check($parameters['password'], $user->password)){
            return response()->json($user);
        }
        else{
            return response()->json(["error"=>"true"]);
        }
        return response()->json($user);
        //return view('connexion')->with('user', $user);
    } 


    public function addComment(Request $request)
    {
    	$parameters=$request->except('_token');
    	//$parameters=$request->all();
    	Comments::create($parameters);

    	return redirect()->route('viewForum')->with('success', "Commentaire bien enregistré!");
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
        Comments::create($parameters);
        $comments=Comments::all();
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
        $comments=Comments::all();
        
        return view('comments')->with('comments', $comments);

        return response()->json( $comments);

    }
}
