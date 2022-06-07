@extends('layouts.app')


@section('title')
	Archivo diseñador
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
 							<th>Diseñador</th>
 							<th>Tamaño</th>
 							<th>Cantidad </th>
 							<th>Forma </th>
 							<th>Terminaciones </th>
 							<th>Material</th>
 							<th>Link archivo cliente</th>
 							<th>Instalación</th> 							
 							<th>Vendedor</th>
 							<th>Fecha cotización </th>
 							<th>Fecha entrega </th> 														
 							<th>Observación </th>
 							<th>Link archivo diseñador </th>
 							<th>Subir link archivo diseñador</th> 							
 													
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
		        	<label>Link archivo diseñador</label>
		        	<input type="text" name="linkarchivodisenador" class="linkarchivodisenador form-control">
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
				url:'{{ route('archivodiseno.index') }}',
				type:'GET',
				data:{
					
				}
			},
			columns:[
					{data:'norden'},					
					{data:'detalle'},
					{data:'nombre_disenador'},
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
							
							if(data.linkarchivodisenador == null){
								return`								
									<a  class="btn btn-secondary btn-sm btn-archivo"  target="_blank"><i class="fa fa-ban"></i></a>
									`;

							}else{
								return`	
									<a href="${data.linkarchivodisenador}" class="btn btn-primary btn-sm btn-archivo"  target="_blank"><i class="fa fa-file"></i></a>
									`;

								}
								
							}},										
					{data:null,render:function(data){
						return`

							<button data-ventasid="${data.ventasid}" type="button" class="btn btn-warning btn-sm btn-edit"><i class="fa fa-pencil-square-o"></i></button>
													
						`;
					}}
			]
		});
	}

loadData();

//Actualiza la tabla automaticante
	setInterval(function(){
		$('#consulta').DataTable().ajax.reload();
	},600000);

//Cargar modal EDIT
$(document).on('click','.btn-edit',function(){

	$('#agregar')[0].reset();
	$('.id').val('');

	id = $(this).data('ventasid');

	url = '{{ route('archivodiseno.edit',':id' ) }}';
	url = url.replace(':id', id);		

	$.ajax({

		url:url,
		type:'GET',
		data:{},
		dataType:'JSON',
		success:function(data){

			$('.id').val(data.id);		

		}

	});

	$('.modal-title').html('Subir archivo Diseñador');
	$('.btn-submit').html('Agregar');
	$('#modal-agregar').modal('show');;

		

	});	

//Agregar
$(document).on('submit','#agregar',function(e){
	
	parametros = new FormData(this);

	$.ajax({

		url:'{{ route('archivodiseno.store') }}',
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
				timer	: 3000,
				showConfirmButton:false 

			});

		}

	});

e.preventDefault();


});	


	
	
</script>

@endsection

