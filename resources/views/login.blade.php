@extends('templates.template')
@section('title', 'Login')
@section('content')

<body>
    <div class="centroLogin">
        <img src="{{url('assets/images/logoavance.png')}}" alt="" class="rounded mx-auto d-block">
        <div class="container">
            <form  class="formdata" method="POST" action="{{route('usuarios.login')}}">
                @csrf
                <!-- Verifica Existencia de erros -->
                @if($errors->all())
                @foreach($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show alertbtn" role="alert" >
                {{ $error }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="f">&times;</span>
                </button>
                </div>
                @endforeach

                @elseif(session('error'))
                <div class="alert alert-danger alert-dismissible fade show alertbtn" role="alert" >
                {{session('error')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
                @endif
                <!-- Fim da verificação de erros -->

                <input type="text"   class="form-control" name="email" placeholder="E-mail:" required></input>
                <input type="password"   class="form-control" name="senha" placeholder="Senha"required ></input>
                <input type="submit" class="btn" name="login" value="Login"></input>
            </form>

            <div class="row">
                <div  class="col-md6 mx-auto">
                    <p>Esqueceu sua senha?<a href="">{{ __('Recupere-a') }}</a></p>
                </div>
            </div>

            <div class="row">
                <div  class="col-md6 mx-auto">
                    <p>Ainda não Possui Conta? <a href="{{url('cadastro')}}">Inscreva-se.</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container2"></div>
</body>

@endsection