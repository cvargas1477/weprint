@extends('layouts.app')


@section('title')
	Diseño por aprobar cliente
@endsection




@section('content')

<div class="container-fluid">
 	<div class="row">
 		<div class="col-md-12">			

 			<div class="table-responsive-md">
 				<table class="table" id="consulta">
 					<thead>
 						<tr> 
 							<th>Estado pedido </th>
 							<th>N° </th> 
 							<th>Enviar cliente </th>
 							<th>Respuesta cliente</th>
 							<th>Razón social</th>
 							<th>Contacto</th>
 							<th>Diseñador</th>
 							<th>Tamaño</th>
 							<th>Cantidad </th>
 							<th>Forma </th>
 							<th>Terminaciones </th>
 							<th>Material</th>
 							<th>Link archivo diseñador</th>
 							<th>Instalación</th> 							
 							<th>Vendedor</th>
 							<th>Fecha cotización </th>
 							<th>Fecha entrega </th> 														
 							<th>Observación </th> 							 
 							 						
 						</tr>
 						
 					</thead> 					

 				</table>

 			</div>	

 		</div>	

 	</div>
</div>


<!-- Modal Agregar/actualizar-->
<form id="agregar" autocomplete="off">	
	<div class="modal fade" id="modal-agregar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">

	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>

	      <div class="modal-body">

	      	@csrf	      		
	      		
	      		
	      		<input type="text" name="id" class="id">		                
		               

	      </div>

	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
	        <button type="submit" class="btn btn-primary btn-submit">Agregar</button>
	      </div>

	    </div>
	  </div>
	</div>
</form>


@endsection
@section('scripts')
<script>

//funcion cargar Data
	function loadData(){		
		$('#consulta').DataTable({
			language:{
				url:'{{ asset('js/spanish.json') }}'
			},
			iDisplayLength: 25,
			deferRender: true,
			bProcessing: true,
			bAutoWidth: false,
			destroy:true,
			order:[[0,"desc"]],
			ajax:{				
				url:'{{ route('aprobarcliente.index') }}',
				type:'GET',
				data:{
					
				}
			},
			columns:[
					{data:'detalle'},
					{data:'norden'},
					{data:null,render:function(data){
						return`

							<button data-ventasid="${data.ventasid}" data-send="4" type="button" class="btn btn-info btn-sm btn-send"><i class="fa fa-paper-plane"></i></button>					
													
						`;
					}},
					{data:null,render:function(data){
						return`

							<button data-ventasid="${data.ventasid}" data-eaccept="5" type="button" class="btn btn-success btn-sm btn-accept"><i class="fa fa-check"></i></button>
							<button data-ventasid="${data.ventasid}" data-rechazado="6" type="button" class="btn btn-danger btn-sm btn-rechazado"><i class="fa fa-times"></i></button>
													
						`;
					}},
					
					{data:'razonsocial'},
					{data:'contacto'},
					{data:'nombre_disenador'},
					{data:'tamano'},
					{data:'cantidad'},
					{data:'forma'},
					{data:'terminaciones'},
					{data:'material'},
					{data:null,render:function(data){
								return`
								
								<a href="${data.linkarchivodisenador}" class="btn btn-primary btn-sm btn-archivo"  target="_blank"><i class="fa fa-link"></i></a>


								`;
							}},		
					{data:'instalacion'},					
					{data:'name'},
					{data:'fechaingreso'},
					{data:'fechaentrega'},				
					{data:'observacion'}
									
					
			]
		});
	}

loadData();

//Actualiza la tabla automaticante
	setInterval(function(){
		$('#consulta').DataTable().ajax.reload();
	},600000);


//Cargar Modal enviar

$(document).on('click','.btn-send', function(){

	id = $(this).data('ventasid');

	estados_id = $(this).data('send');	

	Swal.fire({

		title:'El diseñador temino su trabajo',
		text: "¿has enviado al cliente su diseño?",
		icon: 'info',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Si, ya lo envié',
		cancelButtonText: 'Cancelar',

		}).then((result) => {
			if (result.value){

				url = '{{ route('aprobarcliente.update',':id') }}';
				url = url.replace(':id',id);


				$.ajax({

					url:url,
					type:'PUT',
					data:{'_token':'{{ csrf_token() }}','estados_id':estados_id},
					dataType:'JSON',
					beforeSend:function(){
						Swal.fire({
							title : 'Cargando',
							text : 'Espere un momento...',
							showConfirmButton:false

						});

					},
					success(data){

						loadData();

						Swal.fire({
							title 	: data.title,
							text	: data.text,
							icon	: data.icon,
							timer	: 3000,
							showConfirmButton:false 

						});

					}

				});


			}


	});

});

//Cargar Modal Aceptar

$(document).on('click','.btn-accept', function(){

	id = $(this).data('ventasid');

	estados_id = $(this).data('eaccept');

	Swal.fire({

		title:'El cliente acepto el diseño',
		text: "Ahora nos preparamos para imprimir",
		icon: 'info',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Si, manos a la obra',		
		cancelButtonText: 'Cancelar',

		}).then((result) => {
			if (result.value){

				url = '{{ route('aprobarcliente.update',':id') }}';
				url = url.replace(':id',id);				

				$.ajax({

					url:url,
					type:'PUT',
					data:{'_token':'{{ csrf_token() }}','estados_id':estados_id},					
					dataType:'JSON',
					beforeSend:function(){
						Swal.fire({
							title : 'Cargando',
							text : 'Espere un momento...',
							showConfirmButton:false

						});

					},
					success(data){

						loadData();

						Swal.fire({
							title 	: data.title,
							text	: data.text,
							icon	: data.icon,
							timer	: 3000,
							showConfirmButton:false 

						});

					}

				});


			}


	});

});

//Cargar Modal Rechazado diseño

$(document).on('click','.btn-rechazado', function(){

	id = $(this).data('ventasid');

	estados_id = $(this).data('rechazado');

	Swal.fire({

		title:'El cliente No acepto el diseño',
		text: "Volver a hacer el diseño",
		
		icon: 'info',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Volver a diseñador',		
		cancelButtonText: 'Cancelar',

		}).then((result) => {
			if (result.value){

				url = '{{ route('aprobarcliente.update',':id') }}';
				url = url.replace(':id',id);				

				$.ajax({

					url:url,
					type:'PUT',
					data:{'_token':'{{ csrf_token() }}','estados_id':estados_id},					
					dataType:'JSON',
					beforeSend:function(){
						Swal.fire({
							title : 'Cargando',
							text : 'Espere un momento...',
							showConfirmButton:false

						});

					},
					success(data){

						loadData();

						Swal.fire({
							title 	: data.title,
							text	: data.text,
							icon	: data.icon,
							timer	: 3000,
							showConfirmButton:false 

						});

					}

				});


			}


	});

});
	
	
</script>

@endsection