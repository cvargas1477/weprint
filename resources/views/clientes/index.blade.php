@extends('layouts.app')

@section('title')
	Clientes
@endsection
@section('content')

<div class="container-fluid">
 	<div class="row">
 		<div class="col-md-12">

 			<button type="button" class="btn btn-primary btn-agregar btn-sm"><i class="fa fa-plus"></i> Nuevo cliente</button>

 			
 			<br><br>


 			<div class="table-responsive-md">
 				<table class="table" id="consulta">
 					<thead>
 						<tr>
 							<th>Orden de trabajo</th>
 							<th>Rut </th>
 							<th>Razón social</th>
 							<th>Contacto</th>
 							<th>Celular </th>
 							<th>Email </th>
 							<th>Dirección </th>
 							<th>Observación </th>
 							<th>Fecha creación </th>
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

		        <div class="form-group">
		        	<label>Rut</label>
		        	<input type="text" name="rut" class="rut form-control" required>
		        </div>
		        <div class="form-group">
		        	<label>Razón social</label>
		        	<input type="text" name="razonsocial" class="razonsocial form-control" required>
		        </div>
		        <div class="form-group">
		        	<label>Contacto</label>
		        	<input type="text" name="contacto" class="contacto form-control" required>
		        </div>	
		        <div class="form-group">
		        	<label>Celular</label>
		        	<input type="number" name="celular" class="celular form-control" required >
		        </div>
		        <div class="form-group">
		        	<label>Dirección</label>
		        	<input type="text" name="direccion" class="direccion form-control" required>
		        </div>
		        <div class="form-group">
		        	<label>Correo</label>
		        	<input type="email" name="email" class="email form-control" required>
		        </div>
		        <div class="form-group">
		        	<label>Observación</label>
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
//funcion cargar Data
	function loadData(){

		
		$(document).ready(function() {
			
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
					url:'{{ route('cliente.index') }}',
					type:'GET'

			},
			columns:[
				{data:null,render:function(data){

					url_cotizacion = '{{ route("cotizacion.show", ":id" )  }}';
					url_cotizacion = url_cotizacion.replace(':id', data.id);

					return`
					<a href="${url_cotizacion}"   class="btn btn-success btn-sm"><i class="fa fa-book"></i></a>
					`;
				}},
				{data:'rut'},
				{data:'razonsocial'},
				{data:'contacto'},
				{data:'celular'},
				{data:'email'},
				{data:'direccion'},
				{data:'observacion'},
				{data:'fecha_creacion'},
				{data:null,render:function(data){
					return`

						<button data-id="${data.id}" type="button" class="btn btn-primary btn-sm btn-edit"><i class="fa fa-pencil"></i></button>
						<button data-id="${data.id}" type="button" class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash"></i></button>
					`;


				}}

			]


			});


		});


	}

	loadData();

	//Cargar Modal Agregar
	$(document).on('click','.btn-agregar',function(){

		$('#agregar')[0].reset();
		$('.id').val('');
		$('.modal-title').html('Nuevo cliente');
		$('.btn-submit').html('Agregar');
		$('#modal-agregar').modal('show');		

	});


	//Agregar
	$(document).on('submit','#agregar',function(e){

		parametros = $(this).serialize();

		$.ajax({

			url:'{{ route('cliente.store') }}',
			type:'POST',
			data:parametros,
			dataType:'JSON',
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
					timer	: 3000,
					showConfirmButton:false 



				});

				


			}

		});

	e.preventDefault();


});

//Cargar modal EDIT
$(document).on('click','.btn-edit',function(){

	$('#agregar')[0].reset();
	$('.id').val('');
	id = $(this).data('id');

	url = '{{ route('cliente.edit',':id' ) }}';
	url = url.replace(':id', id);

	$.ajax({

		url:url,
		type:'GET',
		data:{},
		dataType:'JSON',
		success:function(data){

			$('.id').val(data.id);
			$('.rut').val(data.rut);
			$('.razonsocial').val(data.razonsocial);
			$('.contacto').val(data.contacto);
			$('.celular').val(data.celular);
			$('.email').val(data.email);
			$('.direccion').val(data.direccion);
			$('.observacion').val(data.observacion);

		}


	});


	$('.modal-title').html('Actualizar Cliente');
	$('.btn-submit').html('Actualizar');
	$('#modal-agregar').modal('show');

});


//Cargar Modal Eliminar

$(document).on('click','.btn-delete', function(){

	id = $(this).data('id');

	Swal.fire({

		title:'¿Esta seguro?',
		text: "El registro se eliminará de forma permanentemente",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Si, estoy seguro',
		cancelButtonText: 'Cancelar',

		}).then((result) => {
			if (result.value){

				url = '{{ route('cliente.destroy',':id') }}';
				url = url.replace(':id',id);
				
				$.ajax({

					url:url,
					type:'DELETE',
					data:{'_token':'{{ csrf_token() }}'},
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



