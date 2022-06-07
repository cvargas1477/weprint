@extends('layouts.app')


@section('title')
	Taller
@endsection

@section('content')

<div class="container-fluid">
 	<div class="row">
 		<div class="col-md-12">			

 			<div class="table-responsive-md">
 				<table class="table" id="consulta">
 					<thead>
 						<tr> 
 							<th>Historial</th>
 							<th>Cambiar etapa taller</th>							
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
 							<th>Link archivo Diseñador </th> 							
 							 						
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
                    <label for="maquina" class="form-label">Maquinaria</label>
                    <select class="form-control" name="maquina" id="maquina">
                        <option hidden>Elegir maquinaria</option>
                        
                       		@foreach ($result2 as $maquinaria)
                        		<option value="{{ $maquinaria->maquina }}" required>{{ $maquinaria->maquina }}</option>
                       		@endforeach
                       
                    </select>
                

              <hr> 
             <label for="maquina" class="form-label">Selección de proceso</label>
             <hr>       
			<div class="form-check">                     
                         
                <input class="form-check-input" type="radio" name="estados_id" value="7" id="estados_id">
                <label class="form-check-label" for="print">Impresión</label>
                        
            </div>

            <div class="form-check">                     
                         
                <input class="form-check-input" type="radio" name="estados_id" value="8" id="estados_id">
                <label class="form-check-label" for="print">Corte</label>
                        
            </div>
            <div class="form-check">                     
                         
                <input class="form-check-input" type="radio" name="estados_id" value="9" id="estados_id">
                <label class="form-check-label" for="print">Laminado</label>
                        
            </div>
            <div class="form-check">                     
                         
                <input class="form-check-input" type="radio" name="estados_id" value="10" id="estados_id">
                <label class="form-check-label" for="print">Terminación manual</label>
                        
            </div>
            <div class="form-check">                     
                         
                <input class="form-check-input" type="radio" name="estados_id" value="11" id="estados_id">
                <label class="form-check-label" for="print">Finalizar trabajo</label>
                        
            </div>

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


<!-- Modal detalle realización en Taller-->
<form id="detalletaller" autocomplete="off">	
	<div class="modal fade" id="modal-detalletaller" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg">
	    <div class="modal-content">

	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Detalle movimientos en taller</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>

	      <div class="modal-body">
	      	<div class="container-fluid">
				 	<div class="row">
				 		<div class="col-md-12">			

				 			<div class="table-responsive-md">
				 				<table class="table" id="midetalletaller">
				 					<thead>
				 						<tr> 							
				 							<th>N° </th>
				 							<th>Responsable taller </th>				 							
				 							<th>Estado pedido</th>
				 							<th>Maquina</th>
				 							<th>Fecha movimiento</th>
				 						</tr>
				 						
				 					</thead> 					

				 				</table>

				 			</div>	

				 		</div>	

				 	</div>
			</div>

	      <div class="modal-footer">     	

	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
	        	      
	      </div>
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
				url:'{{ route('taller.index') }}',
				type:'GET',
				data:{
					
				}
			},
			columns:[
					{data:null,render:function(data){
						
						return`
						
						<button data-ventasid="${data.ventasid}" type="button" class="btn btn-info btn-sm btn-detalletaller"><i class="fa fa-eye"></i></button>
						`;
					}},
					{data:null,render:function(data){
						return`

							<button data-ventasid="${data.ventasid}" type="button" class="btn btn-warning btn-sm btn-edit"><i class="fa fa-arrows"></i></button>
													
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
					{data:'observacion'},
					{data:null,render:function(data){
								return`
								
								<a href="${data.linkarchivodisenador}" class="btn btn-primary btn-sm btn-archivo"  target="_blank"><i class="fa fa-file"></i></a>


								`;
							}}
																
				
			]
		});
	}

loadData();

//funcion cargar Data detalle taller
	function loaddataModal(ventasid){
	$('#midetalletaller').DataTable({

			
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
				url:'{{ route('taller.show','1') }}',									
				type:'GET',
				data:{}
			},
			columns:[
					{data:'norden'},					
					{data:'name'},
					{data:'detalle'},
					{data:'maquinaria'},
					{data:'fechamovimiento'}
				
			]
		});	

	}


//Cargar modal detalle taller
$(document).on('click','.btn-detalletaller',function(){

	ventasid = $(this).data('ventasid');

	url = '{{ route('taller.show',':ventasid' ) }}';
	url = url.replace(':ventasid', ventasid);

	$('#midetalletaller').DataTable({

			
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
				url:url,									
				type:'GET',
				data:{}
			},
			columns:[
					{data:'norden'},					
					{data:'name'},
					{data:'detalle'},
					{data:'maquinaria'},
					{data:'fechamovimiento'}
				
			]
		});	
		
	$('#modal-detalletaller').modal('show');		

	});



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

	url = '{{ route('taller.edit',':id' ) }}';
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

			url:'{{ route('taller.store') }}',
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