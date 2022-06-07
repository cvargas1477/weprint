@extends('layouts.app')


@section('title')
	Reportes
@endsection




@section('content')

<div class="container-fluid"> 
   <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Reporte fecha entrega                                
                </div>

                <form id="reporte_fecha" autocomplete="off">
                    <div class="form'group">
                        <label>Desde</label>
                        <input type="date" name="fecha_ini" class="fecha_ini" required />
                    </div>
                    <div class="form'group">
                        <label>Hasta</label>
                        <input type="date" name="fecha_fin" class="fecha_fin" required/>
                    </div>
                    
                    <div class="float-left">
                        <button type="submit" class="btn btn-primary btn-sm btn-search">
                            <i class="fa fa-search"> </i>
                        </button>
                   </div>
                    
                </form>

                

                <div class="card-body">
                    <div class="table-responsive">
                    <table id="consulta" class="table">
                        <thead>
                            <tr>                                
                                <th>N° </th>
	 							<th>Estado pedido </th>
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
    </div>
</div>
@endsection

@section('scripts')
<script> 


function loadData(fecha_ini, fecha_fin){
        $(document).ready(function(){
                $('#consulta').DataTable({
                    
                    destroy:true,

                    language:{

                        url:'{{asset('js/spanish.json') }}'
                    },

                    ajax:{
                        
                        url:'{{ route('reporte.busqueda') }}',
                        type:'GET',
                        data:{'fecha_ini':fecha_ini,'fecha_fin':fecha_fin}
                    },

                    //boton exportar a Excel, Pdf, Print
                    dom: 'Bfrtip',
                    buttons: [
                                'excel', 'print'
                        ], 
                    
                    columns:[                                    
                                {data:'norden'},
								{data:'detalle'},
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
                                                          
        
                            ],

                    

                });
        });
    }

$(document).on('submit', '#reporte_fecha', function(e){

        
        fecha_ini   = $('.fecha_ini').val();
        fecha_fin   = $('.fecha_fin').val();

         loadData(fecha_ini,fecha_fin);

       e.preventDefault();
      
    });



</script>
@endsection