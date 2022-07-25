@extends('layouts.app')


@section('title')
	Anular Pedido
@endsection

@section('content')

<div class="container-fluid">
 	<div class="row">
 		<div class="col-md-12">			

 			<div class="table-responsive-md">
 				<table class="table" id="consulta">
 					<thead>
 						<tr> 
 							
 							<th>Anular pedido</th>							
 							<th>N° </th>
 							<th>Estado pedido </th>
 							<th>Diseñador</th>
 							<th>Razon social</th>
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
	      		   
		        
			<div class="mb-3">
             
            <div class="form-check">                     
                         
                <input class="form-check-input" type="radio" name="estados_id" value="14" id="estados_id">
                <label class="form-check-label" for="print">Anular pedido</label>
                        
            </div>

            
            <div class="form-group">
		        	<label>Motivo de anulación</label>
		        	<input type="text" name="pedidoanulado" class="pedidoanulado form-control" required>
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
				url:'{{ route('pedidoanulado.index') }}',
				type:'GET',
				data:{
					
				}
			},
			columns:[
					
					{data:null,render:function(data){
						return`

							<button data-ventasid="${data.ventasid}" type="button" class="btn btn-warning btn-sm btn-edit"><i class="fa fa-trash"></i></button>
													
						`;
					}},
					{data:'norden'},					
					{data:'detalle'},
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







//...............................................................................//

//Actualiza la tabla automaticante
	setInterval(function(){
		$('#consulta').DataTable().ajax.reload();
	},600000);


//Cargar modal EDIT
$(document).on('click','.btn-edit',function(){

	$('#agregar')[0].reset();
	$('.id').val(''); 

	id = $(this).data('ventasid');

	url = '{{ route('pedidoanulado.edit',':id' ) }}';
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

	$('.modal-title').html('Asignar maquinaria');	
	$('#modal-agregar').modal('show');

	e.preventDefault();	

		

	});

//Cambiar proceso taller
	$(document).on('submit','#agregar',function(e){

			
			
		parametros = $(this).serialize();
		

		$.ajax({

			url:'{{ route('pedidoanulado.store') }}',
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


</script>

@endsection