@extends('app2')

@section('content')
<div class="container">
	<div class="row row justify-content-center">
		<div class="col-lg-10">
			<form id="contact-form" method="post" enctype="multipart/form-data" action="{{ route('inscriptionBlog') }}" role="form" class="form">
				<center><legend>Inscription to blog</legend></center>

				<div class="row row justify-content-center">
					<div class="col-md-6 col-lg-6">
						<div class="row">
							<div class="col-md-12  col-lg-12">
								<div class="form-group">
									<label for="email">Email<span class="blue">*</span></label>
									<input id="email" name="email" placeholder="Votre émail" type="text" class="form-control">
								</div>
							</div>
							<div class="col-md-12  col-lg-12">
								<div class="form-group">
									<label for="name">Nom</label>
									<input id="name" type="" name="name" placeholder="Votre nom" type="text" class="form-control">
								</div>
							</div>
							<div class="col-md-12  col-lg-12">
								<div class="form-group">
									<label for="password">Mot de passe</label>
									<input id="password" name="password" placeholder="Votre mot de passe" type="text" class="form-control">
								</div>
							</div>
						</div>

					</div>
					<div class="col-md-6 col-lg-6">
						<div style="width:150px;height: 150px; border: 1px solid whitesmoke ;text-align: center;position: relative;" id="image">
				        <img width="100%" height="100%" id="preview_image" src="{{asset('uploads/user.png')}}" alt="{{'user.png'}}""/>
				        <i id="loading" class="fa fa-spinner fa-spin fa-3x fa-fw" style="position: absolute;left: 40%;top: 40%;display: none"></i>
			    	</div>
					<div class="col-md-6 col-lg-6">
						<p>
					        <a href="javascript:changeProfile()" style="text-decoration: none;">
					            <i class="glyphicon glyphicon-edit"></i>Ajouter photo
					        </a>&nbsp;&nbsp;
					
					    </p>
					    <input type="file" id="file" style="display: none"/>
					    <input type="hidden" id="file_name" name="file_name"/>
			    	</div>

					</div>
					
			
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="col-md-6">
						<center>
							<input type="submit" class="btn btn-primary" value="S'inscrire">
						</center>
					</div>

					<div class="col-md-6">
						<center>
							<span>Déjà inscrit? </span><a type="submit" class="btn btn-primary" href="{{ route('connexionBlogForm') }}"> Se connecter</a>
						</center>
					</div>
				</div>

			</form>

		</div>
	</div>
</div>

@endsection
