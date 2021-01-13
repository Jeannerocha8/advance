@extends('templates.template')
@section('title', 'Dashboard')
@section('content')
<head>
<nav class="navbar navbar-dark  navbar-expand-lg navbar-light bg-light" style="background-color: #5252d4 !important;">
    <img src="{{url('assets/images/logoavance.png')}}" alt="" class="rounded mx-auto d-block" style= "width:40px;">
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="#">Transações <span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="#">Relatórios <span class="sr-only">(current)</span></a>
            </li>
        </ul>

        <ul class="navbar-nav ">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Perfil
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Editar</a>
                <a class="dropdown-item" href="{{route('usuarios.logout')}}">Sair</a>
  
            </li>
        </ul>
    </div>
</nav>
</head>

<body>

    <div class="container">
    <div class="text-center center" >
        <!-- <input type="text"     class="form-control mes" placeholder="{{$mes}}" name="ref" style="border:none; width:100%;" ></input>-->
        <a href="#"  class="mes" name="ref" style="text-decoration: none; color:#000000;"><h3>{{$mes}}</h3></a>
    </div>  

        <div class="row m-4">
            <div class="col-sm-4 text-center">
                <div class="row ">
                    <div class="col type">
                        <div class="row float-left m-2 ">
                            <div class="col-4 text-center">
                                <i class="fas fa-arrow-circle-up fa-3x " style="color: #1fbf66"></i>
                            </div>

                            <div class="col-8 ">
                                <p class="card">Receitas</p>
                                @foreach ($totalreceita as $receitas)
                                    <h4 class="card">R$ {{$receitas}}</h4>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-sm-4 text-center">
                <div class="row ">
                    <div class="col type">
                        <div class="row float-left m-2 ">
                            <div class="col-4">
                                <i class="fas fa-arrow-circle-down fa-3x" style="color: #ff0058"></i>
                            </div>

                            <div class="col-8 ">
                                <p class="card">Despesas</p>
                                @foreach ($totaldespesa as $despesas)
                                    <h4 class="card">R$ {{$despesas}}</h4>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-sm-4 text-center ">
                <div class="row ">
                    <div class="col type">
                        <div class="row float-left m-2">
                            <div class="col-4">
                                <i class="fas fa-dollar-sign fa-3x" style="color: #ff9f04"></i>         
                            </div>

                            <div class="col-8">
                                <p class="card">Saldo em carteira</p>
                                
                                    <h4 class="card">R$ {{$saldo}}</h4>
                               
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Botão fluante -->
    <div >
         <button type="button" class="float-botao dropleft" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-plus" style="color: #ffff"></i></button>
         <div class="dropdown-menu">
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModalCenter">Despesa</a>
            <a class="dropdown-item"  href="#" data-toggle="modal" data-target="#modalReceita">Receita</a>
        </div>
    </div>
    <!-- fim do botão fluante -->

    <!-- Modal  Despesas -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Despesas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('despesa.insert')}}">
                        @csrf

                            <!-- Verifica Existencia de erros -->
                            @if($errors->all())
                                @foreach($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissible fade show" role="alert" 
                                    style='position:fixed; z-index: 900; width: 90%; margin: 0 auto;' >
                                        {{ $error }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="f">&times;</span>
                                        </button>
                                    </div>
                                @endforeach
                            @endif
                            <!-- Fim da verificação de erros -->

                        <h6>Valor da Despesa</h6>
                        <input type="text"     class="form-control" name="valor"  placeholder="R$:" required></input>

                        <h6 >Descrição:</h6>
                        <input type="text" class="form-control"  name="descricao"  placeholder="Descrição:" required></input>

                        <h6>Categoria: </h6>
                        <select class="form-control" id="exampleFormControlSelect1" name="categoria" required>
                            <option>Aguá</option>
                            <option>Luz</option>
                            <option>Moradia</option>
                            <option>Alimentação</option>
                            <option>Cartão de crédito</option>
                        </select>

                        <h6>Data de Pagamento: </h6>
                        <input type="text" class="date form-control"  name="datapagamento"  placeholder="Data:" required></input>

                        <h6>Pago: </h6>
                        <select class="form-control" id="exampleFormControlSelect1" name="status" required>
                            <option value="pago">Sim</option>
                            <option value="não">Não</option>
                        </select>

                        <input type="submit" class="btn" name="Salvar" value="Salvar"></input>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal receitas -->
    <div class="modal fade" id="modalReceita" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Receitas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('receita.insert')}}">
                        @csrf
                            <!-- Verifica Existencia de erros -->
                            @if($errors->all())
                                @foreach($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissible fade show" role="alert" 
                                    style='position:fixed; z-index: 900; width: 90%; margin: 0 auto;' >
                                        {{ $error }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="f">&times;</span>
                                        </button>
                                    </div>
                                @endforeach
                            @endif
                            <!-- Fim da verificação de erros -->

                        <h6>Valor da Despesa</h6>
                        <input type="text"     class="form-control" name="valor"  placeholder="R$:" required></input>

                        <h6 >Descrição:</h6>
                        <input type="text" class="form-control"  name="descricao"  placeholder="Descrição:" required></input>

                        <h6>Categoria: </h6>
                        <select class="form-control" id="exampleFormControlSelect1" name="categoria" required>
                            <option>Salário</option>
                            <option>Renda Extra</option>
                        </select>

                        <input type="submit" class="btn" name="Salvar" value="Salvar"></input>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('.date').datepicker({  
        format: 'yyyy/mm/dd'
        });  
    </script> 

    <script type="text/javascript">
      $('.mes').datepicker( {
        format: 'mm/yyyy',
        startView: 'year', 
        minView: 'year',
        });
    </script> 

</body>

@endsection