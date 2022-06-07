@extends('layouts.app')


@section('title')
	Finalizar pedidos
@endsection

@section('content')

<div class="container-fluid">
 	<div class="row">
 		<div class="col-md-12">			

 			<div class="table-responsive-md">
 				<table class="table" id="consulta">
 					<thead>
 						<tr> 							
 							<th>N° </th>
 							<th>Estado pedido </th>
 							<th>Finalizado  Entregado</th> 
 							<th>Finalizado  Instalado</th> 
 							<th>Diseñador</th>
 							<th>Razón social</th>
 							<th>Contacto</th>
 							<th>Tamaño</th>
 							<th>Cantidad </th>
 							<th>Forma </th>
 							<th>Terminaciones </th>
 							<th>Material</th>
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
	      		
	      		
	      		<input type="hidden" name="id" class="id">

		        <div class="form-group">
		        	<label>Archivo diseñador</label>
		        	<input type="file" name="archivofinal" class="archivofinal form-control">
		        </div>	        
		               

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
				url:'{{ route('finalizarpedido.index') }}',
				type:'GET',
				data:{
					
				}
			},
			columns:[
					{data:'norden'},					
					{data:'detalle'},
					{data:null,render:function(data){
						return`

							<button data-ventasid="${data.ventasid}" data-archive="12" type="button" class="btn btn-success btn-sm btn-archive"><i class="fa fa-archive"></i></button>						
							
													
						`;
					}},
					{data:null,render:function(data){
						return`
							
							<button data-ventasid="${data.ventasid}" data-wrench="13" type="button" class="btn btn-info btn-sm btn-wrench"><i class="fa fa-wrench"></i></button>
							
													
						`;
					}},
					{data:'nombre_disenador'},
					{data:'razonsocial'},
					{data:'contacto'},
					{data:'tamano'},					
					{data:'cantidad'},
					{data:'forma'},
					{data:'terminaciones'},
					{data:'material'},
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

//Cargar Modal archive
$(document).on('click','.btn-archive', function(){

	id = $(this).data('ventasid');

	estados_id = $(this).data('archive');	

	Swal.fire({

		title:'El trabajo termino y será entregado',
		text: "Terminado / entregado",
		icon: 'info',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Trabajo terminado / entregado',
		cancelButtonText: 'Cancelar',

		}).then((result) => {
			if (result.value){

				url = '{{ route('finalizarpedido.update',':id') }}';
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


//Cargar Modal wrench

$(document).on('click','.btn-wrench', function(){

	id = $(this).data('ventasid');

	estados_id = $(this).data('wrench');	

	Swal.fire({

		title:'El trabajo termino y será instalado',
		text: "Terminado / instalado",
		icon: 'info',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Trabajo terminado / instalado',
		cancelButtonText: 'Cancelar',

		}).then((result) => {
			if (result.value){

				url = '{{ route('finalizarpedido.update',':id') }}';
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