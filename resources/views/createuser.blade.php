@extends('templates.template')
@section('title', 'Cadastro')
@section('content')

<body>
        <div class="centroLogin">
            <img src="{{url('assets/images/logoavance.png')}}" alt="" class="rounded mx-auto d-block" style="width:15%"></img>
            <div class="container">
                <form class="formdata" method="POST" action="{{route('criar')}}">
                    @csrf
                    <!-- Verifica Existencia de erros -->
                    @if($errors->all())
                         @foreach($errors->all() as $error)
                            <div class="alert alert-danger alert-dismissible fade show" role="alert" 
                                tyle='position:fixed; z-index: 900; width: 90%; margin: 0 auto;' >
                                 {{ $error }}
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                     <span aria-hidden="f">&times;</span>
                                 </button>
                            </div>
                        @endforeach
                        <!-- Fim da verificação de erros -->

                        @elseif(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" style='position:fixed; z-index: 900; width: 90%; margin: 0 auto;' >
                            {{session('error')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                       @endif
                       
                        <input type="text"     class="form-control" name="nome"   placeholder="Nome:" required></input>
                        <input type="text"     class="form-control"  name="email"  placeholder="E-mail:" required></input>
                        <input type="password" class="form-control"  name="senha"  placeholder="Senha" required></input>
                        <input type="submit"   class="btn" name="cadastrar" value="cadastrar"></input>
                    </form>
            </div>
        </div>
    <div class="container2"></div>
</body>

@endsection