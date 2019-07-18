@extends('app')

@section('content')
<div class="container">
	<div class="divider"></div>
	
	@if(Session::has('success'))
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="alert alert-success">{{ Session::get('success') }}</div>
			</div>
		</div>
	@endif

	@if (count($errors) > 0)
		<ul>
			<li>{{ $errors }}</li>
		</ul>
	@endif

	
	<div class="row">
		<div class="col-lg-10 col-md-offset-1">
			
		</div>
		<div class="col-lg-10 col-lg-offset-1">
			<form id="contact-form" method="post" enctype="multipart/form-data" action="{{ route('uploadForm') }}" role="form" class="form">
				<div class="row">
					<div class="col-md-12  col-lg-6">
						<div class="form-group">
							<label for="name">Nom<span class="blue">*</span></label>
							<input id="name" type="" name="name" placeholder="Votre nom" type="text" class="form-control">
						</div>
					</div>
					<div class="col-md-12  col-lg-6">
						<div class="form-group">

							<label for="email">Email<span class="blue">*</span></label>
							<input id="email" name="email" placeholder="Votre émail" type="text" class="form-control">
						</div>
					</div>
					
					<div class="col-md-12  col-lg-12">
						<div class="form-group">
							<label for="commentaire">Commentaire<span class="blue">*</span></label>
							<textarea id="commentaire" name="commentaire" placeholder="Votre commentaire" rows="4" class="form-control"></textarea>
						</div>
					</div>
					<div class="col-md-12  col-lg-6">
						<div class="form-group">

							<label for="file">Joindre un fichier<span class="blue">*</span></label>
							<input id="file" value="Ajouter" name="file" type="file" class="form-control">
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
	</div>
</div>
@endsection