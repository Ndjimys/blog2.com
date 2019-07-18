@extends('app3')

@section('topics')
	<div class="container">
		<div class="row">
			<div class="col-md-offset-6 alert alert-success">
						
				<p>
					<img class="card-img-top" style="height:100px; width: 100px;" src="{{url($data['user']->profil)}}" alt="{{$data['user']->profil}}">
				</p>
				<p>
					{{ $data['user']->name}}, {{ $data['user']->email }} 
				</p>
			</div>
		</div>
	</div>
	
	<div class="container">
		<center>Blog topics</center>
		@foreach($data['topics'] as $topic)
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="alert alert-success">{{ $topic->titre}}, ajouté le {{ $topic->created_at->format('d-m-Y') }} à {{ $topic->created_at->format('H:i:s') }} 
				<p>
					{{ $topic->description}}
				</p>
				<p>
					<img class="card-img-top" style="height:100px; width: 100px;" src="{{url('uploads/'.$topic->pj)}}" alt="{{$topic->pj}}">
					<a href="{{ route('commentTopic', ['id_topic'=>$topic->id])}}">Voir les commentaires</a>
				</p>
				</div>
			</div>

		</div>
		@endforeach
	</div>

<div class="container">
	<center><a class="btn btn-primary btn-success" href="{{ route('addTopicForm', ['id_user'=>$data['user']->id])}}">Add Topic</a></center>
</div>
@endsection

