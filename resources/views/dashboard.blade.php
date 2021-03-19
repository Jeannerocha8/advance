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
				@csrf
				<select id="mes" class="select" name={{$mes}}>
					<option class="mesteste" value="">{{$mes}}</option>
					<option class="mesteste" value="01">Jan</option>
					<option class="mesteste"  value="02">Fev</option>
					<option class="mesteste" value="03">Mar</option>
					<option class="mesteste" value="04">Abr</option>
					<option class="mesteste" value="05">Mai</option>
					<option class="mesteste" value="06">Jun</option>
					<option class="mesteste" value="07">Jul</option>
					<option class="mesteste" value="08">Ago</option>
					<option class="mesteste" value="09">Set</option>
					<option class="mesteste" value="10">Out</option>
					<option class="mesteste" value="11">Nov</option>
					<option class="mesteste" value="12">Dez</option>
				</select>
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
								<h4 id="receitas" class="card">R$ {{$receitas}}</h4>
							   
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
								<h4 id="despesas" class="card">R$ {{$despesas}}</h4>
							   
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
								<h4 id="saldo" class="card">R$ {{$saldo}}</h4>
							   
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="col-12">
		<!-- Verifica Existencia de erros -->
		@if($errors->all())
			@foreach($errors->all() as $error)
				<div class="alert alert-danger alert-dismissible fade show text-center" role="alert" style="width: 70% !important; margin: 0 auto;" >
					{{ $error }}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="f">&times;</span>
					</button>
				</div>
			@endforeach
		@endif
	    <!-- Fim da verificação de erros -->
		</div>

		<!-- DataTales-->
		<div class="card  col-12">
			<div class="card-body">
				<h4 style="margin-bottom:8px;" >Despesas Cadastradas</h4>
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
						<th>Despesa</th>
						<th>Valor</th>
						<th>Vencimento</th>
						<th>Pago</th>
						<th>Ações</th>
						</tr>
					</thead>

					<tbody id="tbody">
						@foreach($list as $desp)
						<tr>
							<td>{{$desp->descricao}}</td>
							<td>R$ {{$desp->valor}}</td>
							<td>{{$desp->datapagamento}}</td>
							<td>{{$desp->status}}</td>

							<td>
								<i class="fas fa-edit" style="color: #5252d4"></i>
								<a id="apagar" data-id="{{$desp->id}}" href=""><i class="fas fa-trash" style="color: #5252d4" ></i></a>
							</td>
						</tr>
						@endforeach                
					</tbody>
				</table>
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
						<h6>Valor da Despesa</h6>
						<input type="text"     class="form-control" name="valor"  placeholder="R$:" required></input>

						<h6 >Descrição:</h6>
						<input type="text" class="form-control"  name="descricao"  placeholder="Descrição:" required></input>

						<h6>Categoria: </h6>
						<select class="form-control" id="categoria" name="categoria" required>
							<option>Aguá</option>
							<option>Luz</option>
							<option>Moradia</option>
							<option>Alimentação</option>
							<option>Cartão de crédito</option>
						</select>

						<h6>Data de Pagamento: </h6>
						<input type="text" class="date form-control"  name="datapagamento"   autocomplete="off" placeholder="Data:" required></input>

						<h6>Pago: </h6>
						<select class="form-control" id="status" name="status" required>
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
						<h6>Valor da Despesa</h6>
						<input type="text"     class="form-control" name="valor"  placeholder="R$:" required></input>

						<h6 >Descrição:</h6>
						<input type="text" class="form-control"  name="descricao"  placeholder="Descrição:" required></input>
						
						<h6>Data de Recebimento: </h6>
						<input type="text" class="date form-control"  name="datareceita"   autocomplete="off" placeholder="Data:" required></input>

						<h6>Categoria: </h6>
						<select class="form-control" id="categoriadespesa" name="categoria" required>
							<option>Salário</option>
							<option>Renda Extra</option>
						</select>

						<input type="submit" class="btn" name="Salvar" value="Salvar"></input>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal delete -->
	<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Deletar Despesa</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					 </button>
				</div>
					<div class="modal-body"> Deseja realmente deletar esta despesa?</div>
					<div class="modal-footer">
						<button type="button" class="btn" data-dismiss="modal">Cancelar</button>
							<form method="POST" >
								@csrf
								@method('delete')
								<button id="btndeletar" class="btn">Deletar</button>
							</form>
					</div>
			</div>
		</div>
	</div>
	<!-- fim Modal delete -->



	<script type="text/javascript">
		$('.date').datepicker({  
		format: 'yyyy/mm/dd'
		});  
	</script> 

	<!-- AJAX POST  SELECIONAR MES -->  
	<script>
		$(".select").change(function (event){
			event.preventDefault();
			var date  = $(".select").val();
			var get_token = $('input[name="_token"]').val();
			$.ajax({
				headers: {
					'X-CSRF-Token': get_token
				},
				url: "{{ URL::to('mes')}}",
				type: "POST",
				dataType: 'json',
				data: {
					date
				}

			}) 
			.done(function(result){
				// Array($despesas,$receitas,$saldo, $list, $despesaApagar));
				console.log(result);
				$("#receitas").text( result[1]);
				$("#despesas").text( result[0]);
				$("#saldo").text( result[2]);

				var trHTML = '';
					$.each(result[3], function (i, item) {
						trHTML += '<tr><td>' + item.descricao+ '</td><td>' + item.valor+ '</td><td>' + item.datapagamento + '</td><td>' + item.status+ '</td><td>' +
						'<i class="fas fa-edit" style="color: #5252d4; margin: 2px;"></i>'+
						'<a  id="apagar" data-id="'+item.id+'" href=""><i class="fas fa-trash" style="color: #5252d4" ></i></a>' + '</td></tr>';
					});
					$("#tbody").empty();
					$('#dataTable').append(trHTML);
			});
		});

	</script>
	<!-- fim do AJAX POST -->

	<!-- AJAX DELETAR DESPESA -->  
	<script>
		$(document).on('click','#apagar', function(event){
			event.preventDefault();
			var idDesp = $(this).attr('data-id');
			var get_token = $('input[name="_token"]').val();

			$("#deleteModal").modal("show");

			$("#btndeletar").on('click', function (e){
				e.preventDefault();
				$.ajax({
					headers: {
						'X-CSRF-Token': get_token
				},
					url: '/deshboard/despesa/delete/'+idDesp,
					type: "DELETE",
					dataType: 'json',
					data: {
						idDesp
					}
				}) 
				.done(function(result){
					$("#deleteModal").modal("hide");
					var resposta = '';
 					 $(".resposta").empty();
					  resposta = "<div class='alert msg btn-success text-center' role='alert'>" +
        			"<a href='#' class='close' data-dismiss='alert' aria-label='Close'>&times;</a>" + "Deletado com sucesso" + "</div>";
					$(".resposta").append(resposta);
					
					console.log(result);
					location.reload();
				});
			});
		});
	</script>
	<!-- FIM DO AJAX DELETAR DESPESA -->  

	


</body>

@endsection