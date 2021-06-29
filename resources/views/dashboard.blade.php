@extends('templates.template')
@section('title', 'Dashboard')
@section('content')
<header>


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
</header>

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

		<div class="alert alert-success alert-dismissible fade show d-none message" role="alert">
		
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>

		<!-- Verifica Existencia de erros -->
		@if($errors->all())
			@foreach($errors->all() as $error)
				<div class="alert alert-danger alert-dismissible fade show text-center alertbtn" role="alert" >
					{{ $error }}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="f">&times;</span>
					</button>
				</div>
			@endforeach
		@endif
		<!-- Fim da verificação de erros -->
		</div>

		<!-- Tabela-->
		<div class="card  col-12">
			<div class="card-body">
				<h4 style="margin-bottom:8px;" >Despesas Cadastradas</h4>
				<div class="table-responsive">
					<table class="table table-bordered paginate" id="dataTable" width="100%" cellspacing="0">
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
								<a id="editar" data-id="{{$desp->id}}" href=""><i class="fas fa-edit" style="color: #5252d4"></i></a>
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

	<!--grafico --> 
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-sm-6">
				<h4>Despesas por categoria</h4>
				<canvas id="myChart" width="200" height="50%"></canvas>
			</div>
			<div class="col-md-6 col-sm-6">
				<h4>Fluxo de Caixa</h4>
				<canvas id="myChartBar" width="100%" height="40"></canvas>
			</div>
		</div>
	</div>

	<!-- Botão fluante -->
	<div >
		 <button type="button" class="float-botao dropleft" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-plus" style="color: #ffff"></i></button>
		 <div class="dropdown-menu">
			<a  class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModalCenter">Despesa</a>
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
					<form id="formDesp">
						@csrf
						
						<h6>Valor da Despesa</h6>
						<input id="valDesp" type="text" class="form-control" name="valor"  placeholder="R$:" required></input>

						<h6 >Descrição:</h6>
						<input id="DescDesp" type="text" class="form-control"  name="descricao"  placeholder="Descrição:" required></input>

						<h6>Categoria: </h6>
						<select  class="form-control" id="categoria" name="categoria" required>
							<option value="Aguá">Aguá</option>
							<option value="Luz">Luz</option>
							<option value="Moradia" >Moradia</option>
							<option value="Alimentação" >Alimentação</option>
							<option value="Cartão de crédito">Cartão de crédito</option>
						</select>

						<h6>Data de Pagamento: </h6>
						<input id="dataDesp" type="text" class="date form-control"  name="datapagamento"   autocomplete="off" placeholder="Data:" required></input>

						<h6>Pago: </h6>
						<select id="StatusDesp" class="form-control" id="status" name="status" required>
							<option value="sim">Sim</option>
							<option value="não">Não</option>
						</select>

						<input type="submit" id="btnsalvar" class="btn" name="Salvar" value="Salvar"></input>
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
				.success(function(result){
					$('deleteModal .close').click();
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
	<!-- fim do AJAX DELETAR -->

	<!-- AJAX EDITAR DESPESA -->  
	<script>
		$(document).on('click','#editar', function(event){

			event.preventDefault();
			var idDesp = $(this).attr('data-id');
			var get_token = $('input[name="_token"]').val();

			$.ajax({
					headers: {
						'X-CSRF-Token': get_token
				},
					url:  '/deshboard/despesa/edit/'+idDesp,
					type: "GET",
					dataType: 'json',
					data: {
						idDesp
					}
				}) 
				.success(function(result){
					document.getElementById("valDesp").value = result.valor;
					document.getElementById("DescDesp").value = result.descricao;
					document.getElementById("categoria").value = result.categoria;
					document.getElementById("dataDesp").value = result.datapagamento;
					document.getElementById("StatusDesp").value = result.status;
					document.getElementById('btnsalvar').id = 'btneditar';
				
					$('#exampleModalCenter').modal('show');
					
					$(document).on('click','#btneditar', function(event){
						event.preventDefault();
						var get_token = $('input[name="_token"]').val();
						var valor = $('input[name="valor"]').val();
						var descricao = $('input[name="descricao"]').val();
						var categoria = $("#categoria option:selected").val();
						var datapagamento = $('input[name="datapagamento"]').val();
						var status = $("#StatusDesp option:selected").val();
						//console.log(valor, descricao, categoria, datapagamento, status);
						$.ajax({
							headers: {
								'X-CSRF-Token': get_token
							},
							url: '/update/'+idDesp,
							type: "PUT",
							dataType: 'json',
							data: {
								valor,
								descricao,
								categoria,
								datapagamento,
								status
							}
						})
						.success(function(result){
							$('#exampleModalCenter .close').click();
							$('.message').removeClass('d-none').html(result.message);
						});	
					});
				});			
		});
	</script>
	<!-- fim do AJAX EDITAR -->

	<!-- Salvar Despesa -->
	<script>
		$(document).on('click','#btnsalvar', function(event){
			event.preventDefault();
			var get_token = $('input[name="_token"]').val();
			var valor = $('input[name="valor"]').val();
			var descricao = $('input[name="descricao"]').val();
			var categoria = $("#categoria option:selected").val();
			var datapagamento = $('input[name="datapagamento"]').val();
			var status = $("#StatusDesp option:selected").val();
			console.log(valor, descricao, categoria, datapagamento, status);
			
			$.ajax({
				headers: {
					'X-CSRF-Token': get_token
				},
				url: "{{ URL::to('create')}}",
				type: "POST",
				dataType: 'json',
				data: {
					valor,
					descricao,
					categoria,
					datapagamento,
					status
				}
			}) 
			.success(function(result){
				$('#exampleModalCenter .close').click();
				$('.message').removeClass('d-none').html(result.message);				
			});	

		});
	</script>
	<!-- Fim salvar Despesa --> 

	<script>
		var cData = JSON.parse(`<?=  $buscas['resultado'] ?>`);
		console.log('Alisson cabeção');
		console.log('<?=  $buscas['resultado'] ?>');
		console.log(cData);
		console.log(cData.descricao);

		var ctx = document.getElementById('myChart').getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'pie',
			data: {
				labels: cData.descricao,
				datasets: [{
					label: 'Despesas mensal em R$ ',
					data: cData.valor,
					backgroundColor: [
						'rgba(255, 99, 132, 0.2)',
      					'rgba(255, 159, 64, 0.2)',
      					'rgba(75, 192, 192, 0.2)',
     					'rgba(54, 162, 235, 0.2)',
      					'rgba(153, 102, 255, 0.2)',
     					'rgba(201, 203, 207, 0.2)'		
					],
					borderColor: [
						'rgb(255, 99, 132)',
      					'rgb(255, 159, 64)',
     					'rgb(75, 192, 192)',
      					'rgb(54, 162, 235)',
      					'rgb(153, 102, 255)',
      					'rgb(201, 203, 207)'	
					],
				}]
			}
		});
	</script>

	<script>
		var cData = JSON.parse(`<?=  $buscas['resultado'] ?>`);
		console.log('Alisson cabeção');
		console.log('<?=  $buscas['resultado'] ?>');
		console.log(cData);
		console.log(cData.descricao);

		var ctx = document.getElementById('myChartBar').getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: cData.descricao,
				datasets: [{
					label: 'Despesas mensal em R$ ',
					data: cData.valor,
					backgroundColor: [
						'rgba(255, 99, 132, 0.2)',
      					'rgba(255, 159, 64, 0.2)',
      					'rgba(75, 192, 192, 0.2)',
     					'rgba(54, 162, 235, 0.2)',
      					'rgba(153, 102, 255, 0.2)',
     					'rgba(201, 203, 207, 0.2)'		
					],
					borderColor: [
						'rgb(255, 99, 132)',
      					'rgb(255, 159, 64)',
     					'rgb(75, 192, 192)',
      					'rgb(54, 162, 235)',
      					'rgb(153, 102, 255)',
      					'rgb(201, 203, 207)'	
					],
					borderWidth: 1
				}]
			}
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
			.success(function(result){
				// Array($despesas,$receitas,$saldo, $list, $despesaApagar));				
				$("#receitas").text( result.receitas);
				$("#despesas").text( result.despesas);
				$("#saldo").text( result.saldo);
				
				var trHTML = '';
					$.each(result.list, function (i, item) {
						trHTML += '<tr><td>' + item.descricao+ '</td><td>' + item.valor+ '</td><td>' + item.datapagamento + '</td><td>' + item.status+ '</td><td>' +
						'<a id="editar" data-id="'+item.id+'" href=""><i class="fas fa-edit" style="color: #5252d4"></i></a>'+
						'<a id="apagar" data-id="'+item.id+'" href=""><i class="fas fa-trash" style="color: #5252d4" ></i></a>' + '</td></tr>';
					});
					$("#tbody").empty();
					$('#dataTable').append(trHTML);
			});
		});
	</script>
	<!-- fim do AJAX POST -->

	
</body>

@endsection

