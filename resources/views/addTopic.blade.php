@extends('app2')
@if(Session::has('success'))
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="alert alert-success">{{ Session::get('success') }}</div>
			</div>
		</div>
@endif
@section('content')

<div class="container">
	<div class="divider"></div>
	<div class="row">
		<div class="col-lg-10 col-md-offset-1">
			
		</div>
		<div class="col-lg-10 col-lg-offset-1">
			<form id="contact-form" method="post" enctype="multipart/form-data" action="{{ route('addTopic') }}" role="form" class="form">
				<legend>ADD NEW TOPIC</legend>
				<div class="row">
					<div class="col-md-12  col-lg-6">
						<div class="form-group">

							<label for="titre">Titre<span class="blue">*</span></label>
							<input id="titre" name="titre" placeholder="Titre du sujet" type="text" class="form-control">
						</div>
					</div>
					<div class="col-md-12  col-lg-12">
						<div class="form-group">
							<label for="description">Descrption du sujet</label>
							<textarea id="description" type="" name="description" placeholder="Description du sujet" type="text" class="form-control"></textarea>
						</div>
						<input type="hidden" name="id_user" id="id_user" value="{{$id_user}}">
					</div>
					<div class="col-md-12  col-lg-12">
						<div class="form-group">
							<label for="pj">Ajouter un fichier</label>
							<input id="pj" name="pj" type="file" class="form-control">
						</div>
					</div>
					
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="col-md-6">
						<center>
							<input type="submit" class="btn btn-primary" value="Ajouter">
						</center>
					</div>

				
				</div>

			</form>

		</div>
	</div>
</div>
?