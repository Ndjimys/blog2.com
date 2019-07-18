<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::match(['get', 'post'], 'ajax-image-upload', 'CommentController@ajaxImage');
Route::delete('ajax-remove-image/{filename}', 'CommentController@deleteImage');
Route::get('/allTopics', 
	['as'=>"allTopics",
	'uses'=>'CommentController@allTopics'
]);

Route::post('/addComment', 
	['as'=>"addComment",
	'uses'=>'CommentController@addComment'
]);

Route::get('commentTopic/{id_topic}', 
	['as'=>"commentTopic",
	'uses'=>'CommentController@commentTopic'
]);

Route::get('/addTopicForm/{id_user}', 
	['as'=>"addTopicForm",
	'uses'=>'CommentController@addTopicForm'
]);

Route::post('/addTopic', 
	['as'=>"addTopic",
	'uses'=>'CommentController@addTopic'
]);
Route::get('/', 
	['as'=>"connexionBlog",
	'uses'=>'CommentController@connexionBlog'
]);

Route::get('/connexionBlogForm', 
	['as'=>"connexionBlogForm",
	'uses'=>'CommentController@connexionBlogForm'
]);
Route::post('/inscriptionBlog', 
	['as'=>"inscriptionBlog",
	'uses'=>'CommentController@inscriptionBlog'
]);
Route::get('/inscriptionBlogForm', 
	['as'=>"inscriptionBlogForm",
	'uses'=>'CommentController@inscriptionBlogForm'
]);
Route::post('/checkUser', 
	['as'=>"checkUser",
	'uses'=>'CommentController@checkUser'
]);
Route::get('/test/', function()
{
	return "Bonjour le monde!";
});

Route::get('/forum', [
	'as'=>'viewForum',
	'uses'=>'CommentController@viewForum'
]);

Route::post('/addComment', ['as'=>'addComment',
	'uses'=>'CommentController@addComment'
]);
Route::post('/comment', ['as'=>'comment',
	'uses'=>'CommentController@comment'
]);

Route::get('/allComments', ['as'=>'allComments',
	'uses'=>'CommentController@allComments'
]);
Route::post('/getComments', ['as'=>'getComments',
	'uses'=>'CommentController@getComments'
]);

Route::get('/getCommentsJson', ['as'=>'getCommentsJson',
	'uses'=>'CommentController@getCommentsJson'
]);

Route::post('/uploadForm', 
	['as'=>"uploadForm",
	'uses'=>'UploadController@uploadForm'
]);
Route::post('/loadForm', 
	['as'=>"loadForm",
	'uses'=>'UploadController@loadForm'
]);
Route::post('/viewSubject', 
	['as'=>"viewSubject",
	'uses'=>'CommentController@viewSubject'
]);


