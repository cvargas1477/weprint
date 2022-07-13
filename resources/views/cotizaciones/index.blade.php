@extends('layouts.app')
@section('title')
	Cotizaciones
@endsection
@section('content')
<div class="container-fluid">
 	<div class="row">
 		<div class="col-md-12">

 			<div class="table-responsive">
 				<table class="table" id="consulta_info_cliente">
 					<thead>
 						<tr> 							
 							<th>Rut</th>
 							<th>Razón social</th>
 							<th>Contacto</th>
 							<th>Email</th>
 							<th>Celular</th>
 							<th>Dirección</th>
 						</tr>
 					</thead>
 				</table>
 			</div>
 			<hr>
 			<button type="button" class="btn btn-primary btn-agregar btn-sm"><i class="fa fa-plus"></i> Nueva orden de trabajo</button>

 			
 			<br><br>


 			<div class="table-responsive-md">
 				<table class="table" id="consulta">
 					<thead>
 						<tr> 							
 							<th>N° OT</th>
 							<th>Estado pedido </th>
 							<th>N° Cotización </th>
 							<th>Link Cotización </th> 							
 							<th>Tamaño</th>
 							<th>Cantidad </th>
 							<th>Forma </th>
 							<th>Terminaciones </th>
 							<th>Material</th>
 							<th>Link archivo cliente</th>
 							<th>Instalación</th> 							
 							<th>Vendedor </th>
 							<th>Fecha cotización </th>
 							<th>Fecha entrega </th> 														
 							<th>Observación </th>
 							<th>Acciones </th> 
 							 						
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
	      		<input type="hidden" name="clientes_id" class="cliente_id" value="{{$id}}">
	      		<input type="hidden" name="norden" class="norden">
	      		<input type="hidden" name="estados_id" class="estados_id">  
	      		
	      		 <div class="form-group">
		        	<label>N° Cotización</label>
		        	<input type="text" name="ncotizacion" class="ncotizacion form-control" required>
		        </div>
		        <div class="form-group">
		        	<label>Fecha cotización</label>
		        	<input type="date" name="fechaingreso" class="fechaingreso form-control" required>
		        </div>
		        <div class="form-group">
		        	<label>Link cotización</label>
		        	<input type="text" name="linkcotizacion" class="linkcotizacion form-control" required>
		        </div>
		        <div class="form-group">
		        	<label>Tamaño</label>
		        	<input type="text" name="tamano" class="tamano form-control" required>
		        </div>
		        <div class="form-group">
		        	<label>Cantidad</label>
		        	<input type="text" name="cantidad" class="cantidad form-control" required>
		        </div>
		        <div class="form-group">
		        	<label>Forma</label>
		        	<input type="text" name="forma" class="forma form-control" required>
		        </div>	
		        <div class="form-group">
		        	<label>Terminaciones</label>
		        	<input type="text" name="terminaciones" class="terminaciones form-control" required >
		        </div>
		        <div class="form-group">
		        	<label>Material</label>
		        	<input type="text" name="material" class="material form-control" required>
		        </div>
		        <div class="form-group">
		        	<label>Link Archivo Cliente</label>
		        	<input type="text" name="linkarchivocliente" class="linkarchivocliente form-control">
		        </div>
		        <div class="form-group">
		        	<label>Instalación</label>
		        	<input type="text" name="instalacion" class="instalacion form-control">
		        </div>
		        
		        <div class="form-group">
		        	<label>Fecha entrega</label>
		        	<input type="date" name="fechaentrega" class="fechaentrega form-control" required>
		        </div>
		        <div class="form-group">
		        	<label>Condición de pago</label>
		        	<input type="text" name="observacion" class="observacion form-control">
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
		//traer dato del Cliente	
			var  json = @json($cliente);

			function infoCliente(){
				$('#consulta_info_cliente').DataTable({
					paging:false,
					searching:false,
					info:false,
					language:{
						url:'{{ asset('js/spanish.json') }}'
					},
					iDisplayLength: 25,
					deferRender: true,
					bProcessing: true,
					bAutoWidth: false,
					destroy:true,
					data:json,
					columns:[
						
						{data:'rut'},
						{data:'razonsocial'},
						{data:'contacto'},
						{data:'email'},
						{data:'celular'},
						{data:'direccion'},

					]
				});
			}
			infoCliente();

			

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
					ajax:{				
						url:'{{ route('cotizacion.show',[$id]) }}',
						type:'GET',
						data:{
							
						}
					},
					columns:[
							{data:'norden'},
							{data:'detalle'},
							{data:'ncotizacion'},
							{data:null,render:function(data){
								return`
								
								<a href="${data.linkcotizacion}" class="btn btn-primary btn-sm btn-archivo"  target="_blank"><i class="fa fa-link"></i></a>


								`;
							}},							
							{data:'tamano'},
							{data:'cantidad'},
							{data:'forma'},
							{data:'terminaciones'},
							{data:'material'},
							{data:null,render:function(data){
								return`
								
								<a href="${data.linkarchivocliente}" class="btn btn-primary btn-sm btn-archivo"  target="_blank"><i class="fa fa-link"></i></a>


								`;
							}},								
							{data:'instalacion'},							
							{data:'name'},
							{data:'fechaingreso'},
							{data:'fechaentrega'},				
							{data:'observacion'},				
							{data:null,render:function(data){
							return`
									<button data-id="${data.id}" type="button" class="btn btn-primary btn-sm btn-edit"><i class="fa fa-pencil"></i></button>
								
								`;
							}}
					]
				});
			}
			loadData();

			//Cargar Modal Agregar cotización
			$(document).on('click','.btn-agregar',function(){

				$('#agregar')[0].reset();
				$('.id').val('');
				$('.modal-title').html('Nueva orden de trabajo');
				$('.btn-submit').html('Agregar');
				$('#modal-agregar').modal('show');		

			});

			//Agregar Cotización
			$(document).on('submit','#agregar',function(e){

				//parametros = $(this).serialize();
				parametros = new FormData(this);

				$.ajax({

					url:'{{ route('cotizacion.store') }}',
					type:'POST',
					data:parametros,
					dataType:'JSON',
					contentType: false,
		      		cache: false,
		      		processData:false,
					beforeSend:function(){

						Swal.fire({

							title 	: 'Cargando',
							text	: "Espere un momento...",					
							showConfirmButton:false 

						});				


					},
					success:function(data){

						
						$('#modal-agregar').modal('hide');
						loadData();

						Swal.fire({
							title 	: data.title,
							text	: data.text,
							icon	: data.icon,
							//timer	: 3000,
							showConfirmButton:true 
						});		


					}

				});

			e.preventDefault();

		});

		//mostrar archivo Cliente
		$(document).on('click','btn-archivo',function(){

			asset('storage/archivocliente/');


		});

	//Cargar modal EDIT
	$(document).on('click','.btn-edit',function(){

	$('#agregar')[0].reset();
	$('.id').val('');
	id = $(this).data('id');

	url = '{{ route('cotizacion.edit',':id' ) }}';
	url = url.replace(':id', id);

	$.ajax({

		url:url,
		type:'GET',
		data:{},
		dataType:'JSON',
		success:function(data){

			$('.id').val(data.id);
			$('.estados_id').val(data.estados_id);
			$('.norden').val(data.norden);
			$('.ncotizacion').val(data.ncotizacion);
			$('.linkcotizacion').val(data.linkcotizacion);
			$('.tamano').val(data.tamano);
			$('.cantidad').val(data.cantidad);
			$('.forma').val(data.forma);
			$('.terminaciones').val(data.terminaciones);
			$('.linkarchivocliente').val(data.linkarchivocliente);
			$('.material').val(data.material);
			$('.instalacion').val(data.instalacion);
			$('.observacion').val(data.observacion);
			$('.fechaingreso').val(data.fechaingreso);
			$('.fechaentrega').val(data.fechaentrega);


		}


	});


	$('.modal-title').html('Modificar orden');
	$('.btn-submit').html('Actualizar');
	$('#modal-agregar').modal('show');

});

	</script>
@endsection

