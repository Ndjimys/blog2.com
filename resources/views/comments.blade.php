@extends('app2')
	

@section('content')
<div class="container">
	<div class="heading row">
		<div class="alert alert-warning col-md-10">{{ $data['topic']->titre}}, ajouté le {{ $data['topic']->created_at->format('d-m-Y') }} à {{ $data['topic']->created_at->format('H:i:s') }} 
				<p>
					<img class="card-img-top"  style="height:100px; width: 100px;" src="{{url('uploads/'.$data['topic']->pj)}}" alt="{{$data['topic']->pj}}"><span>{{$data['topic']->description}}</span>
					
				</p>
		</div>
	</div>
	
	
</div>
@endsection

@section('comments')
	
	
	<div class="container">
		@foreach($data['comments'] as $comment)
		<div class="row comments">
			<div class="col-md-10 col-md-offset-1">
				<div class="alert alert-success">
					<p>{{ $comment->content}}</p>
					{{ $comment->name}}le {{ $comment->created_at->format('d-m-Y') }} à {{ $comment->created_at->format('H:i:s') }} </div>
				<p>{{ $comment->commentaire }}</p>
			</div>

		</div>
		@endforeach	
		<div class="row">
			<div class="col-lg-10 col-md-offset-1">
				<h2>Laisser votre commentaire</h2>
			</div>
			<div class="col-lg-6 col-lg-offset-1">
				<form id="contact-form" method="post" enctype="multipart/form-data" action="{{ route('addComment', ['id_topic'=>$data['topic']->id])}}" role="form" class="form">
					<div class="row">
						<input type="hidden" id="id_user" name="id_user" value="{{$data['user']->id}}">
						<input type="hidden" id="id_topic" name="id_topic" value="{{$data['topic']->id}}">
						<div class="col-md-12  col-lg-12">
							<div class="form-group">
								<label for="content">Commentaire<span class="blue">*</span></label>
								<textarea id="content" name="content" placeholder="Votre commentaire" rows="4" class="form-control"></textarea>
							</div>
						</div>

					
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="col-md-12">
							<center>
								<input type="submit" class="btn btn-primary" value="Envoyer">
							</center>
						</div>
					</div>

				</form>

			</div>
			<div class="col-lg-4">
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
	</div>
@endsection
