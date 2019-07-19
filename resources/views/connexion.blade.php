@extends('app2')

@section('content')
<div class="container">
	<div class="divider">
		@if(Session::has('success'))
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="alert alert-success">{{ Session::get('success') }}</div>
				</div>
			</div>
		@endif
		@if(Session::has('error'))
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="alert alert-warning">{{ Session::get('error') }}</div>
				</div>
			</div>
		@endif
		@if(Session::has('paramError'))
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="alert alert-warning">{{ Session::get('paramError') }}</div>
				</div>
			</div>
		@endif
	</div>
	<div class="row">
		<div class="col-lg-10 col-md-offset-1">
			
		</div>
		<div class="col-lg-10 col-lg-offset-1">
			<form id="contact-form" method="post" enctype="multipart/form-data" action="{{ route('checkUser') }}" role="form" class="form">
				<legend>Connexion Par Aubin Nke</legend>
				<div class="row">
					<div class="col-md-12  col-lg-12">
						<div class="form-group">
							<label for="email">Email</label>
							<input id="email" type="" name="email" placeholder="Votre email" type="text" class="form-control">
						</div>
					</div>
					<div class="col-md-12  col-lg-12">
						<div class="form-group">
							<label for="name">Mot de passe</label>
							<input id="name" name="password" placeholder="Votre mot de passe" type="password" class="form-control">
						</div>
						<i id="loading" class="fa fa-spinner fa-spin fa-3x fa-fw" style="position: absolute;left: 40%;top: 40%;display: none"></i>
					</div>
			
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="col-md-6">
						<center>
							<input type="submit" class="btn btn-primary" value="Se connecter">
						</center>
					</div>

					<div class="col-md-6">
						<center>
							<span>Pas de compte?</span><a class="btn btn-primary" href="{{ route('inscriptionBlogForm') }}">S'inscrire</a>
						</center>
					</div>
				</div>

			</form>

		</div>
	</div>
</div>
@endsection
