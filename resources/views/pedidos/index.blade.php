@extends('layouts.app')


@section('title')
	Pedidos
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
 							<th>N° </th>
 							<th>Estado pedido </th>
 							<th>N° Cotización</th>
 							<th>Razon social</th>
 							<th>Contacto</th>
 							<th>Tamaño</th>
 							<th>Cantidad </th>
 							<th>Forma </th>
 							<th>Terminaciones </th>
 							<th>Material</th>
 							<th>Instalación</th> 							
 							<th>Diseñador </th>
 							<th>Vendedor </th>
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

<!-- Modal detalle realización en Taller-->
<form id="detalle" autocomplete="off">	
	<div class="modal fade" id="modal-detalle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg">
	    <div class="modal-content">

	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Historial pedido</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>

	      <div class="modal-body">
	      	<div class="container-fluid">
				 	<div class="row">
				 		<div class="col-md-12">			

				 			<div class="table-responsive-md">
				 				<table class="table" id="midetalle">
				 					<thead>
				 						<tr> 							
				 							<th>N° </th>
				 							<th>Diseñador</th>
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
				url:'{{ route('pedidos.index') }}',
				type:'GET',
				data:{
					
				}
			},
			columns:[
					{data:null,render:function(data){
						
						return`
						
						<button data-ventasid="${data.ventasid}" type="button" class="btn btn-info btn-sm btn-detalle"><i class="fa fa-eye"></i></button>
						`;
					}},
					{data:'norden'},
					{data:'detalle'},
					{data:'ncotizacion'},
					{data:'razonsocial'},
					{data:'contacto'},
					{data:'tamano'},
					{data:'cantidad'},
					{data:'forma'},
					{data:'terminaciones'},
					{data:'material'},
					{data:'instalacion'},					
					{data:'nombre_disenador'},				
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
	},30000);


	//Cargar modal detalle
$(document).on('click','.btn-detalle',function(){

	ventasid = $(this).data('ventasid');

	url = '{{ route('pedidos.show',':ventasid' ) }}';
	url = url.replace(':ventasid', ventasid);

	//alert(ventasid);

	$('#midetalle').DataTable({

			
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
					{data:'nombre_disenador'},					
					{data:'name'},
					{data:'detalle'},
					{data:'maquinaria'},
					{data:'fechamovimiento'}
				
			]
		});	
		
	$('#modal-detalle').modal('show');		

	});

	
</script>

@endsection


