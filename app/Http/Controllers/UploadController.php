<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadRequest;
use App\Comments;
class UploadController extends Controller
{

    public function uploadForm(UploadRequest $request)
    {

    	$comments = new Comments();
        $parameters = $request->all();
        $pPhotos=$request->photos;
        if(is_array($pPhotos) || is_object($pPhotos)){
        	foreach ($request->photos as $photo) {
	            $filename = $photo->store('photos');
	            $comments->file=$filename;
				$comments->name=$request['name'];
		        $comments->email=$request['email'];
			    $comments->commentaire=$request['commentaire'];
			    $comments->save();
        	}
        }
        else{
			$comments->name=$request['name'];
	        $comments->email=$request['email'];
		    $comments->commentaire=$request['commentaire'];
		    $comments->save();
        }
		return 'Upload successful!';

    }

    public function loadForm(UploadRequest $request)
    {        
    	return view('comments');

        // Coming soon...
    }

}

