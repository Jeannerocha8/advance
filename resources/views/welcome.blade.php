@extends('templates.template')
@section('title', 'Home')
@section('content')


<!-- menu -->
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #fff !important">
  
  <img src="{{url('assets/images/logoavance.png')}}" alt="" style="width:4%; margin-left: 20px;">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#" style="font-size: 25px; font-family: 'righteous' !important; ">Advance</a>
      </li>
    </ul>
    <span class="navbar-text" style="margin-right: 20px;">
     	<a href="{{route('login')}}" style="margin-right: 60px; font-size:20px; color:#5252d4">Entrar</a>
		 <a href="{{url('cadastro')}}" class="btnheader"> Começar agora</a>
    </span>
  </div>
</nav>
<!-- fim do menu -->



<div class="container">
	<div class="row">
		<div class="col-sm-6 d-flex flex-column justify-content-center align-items-center">

			<div class="" >
				<h1 style="font-family: 'roboto bold' !important;     font-size: 300% !important;">Sua plataforma de controle financeiro</h1>
				<p class="space">Ajudamos pessoas a organizarem sua vida financeira de forma eficiente. <br> Totalmente gratuito.</p>

				<form action="{{url('cadastro')}}">
					<button class="btnstart" style="border-radius: 4px !important">Começar agora</button>
				</form>
			</div>
		
		</div>

		<div class="col-sm-6">
			<img class="text-center" src="{{url('assets/images/banner.png')}}" alt="" style="width:100%">
		</div>

	</div>
</div>

@endsection