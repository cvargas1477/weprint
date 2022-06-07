@extends('layouts.app')


@section('title')
	Mantenedor Usuarios
@endsection

@section('content')

<div class="container">	
	<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            	<div class="card-header">
            		Mantenimiento usuario
                          		
            	</div> 
            	<div class="card-body">
            		<div class="table-responsive">
                	<table id="consulta" class="table">
                		<thead>
                			<tr>
                                <th>Id</th>
                				<th>Nombre</th>
                                <th>Iniciales</th>
                				<th>Email</th>
                                
                                <th>Rol</th>
                                <th>Estado</th>
                                <th>Acciones</th>                               
                			</tr>
                		</thead>
                	</table>                
                    </div>
                </div>        		
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
               
                
                    <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="name form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                    </div>

                    <div class="form-group row">
                            <label for="iniciales" class="col-md-4 col-form-label text-md-right">{{ __('Iniciales') }}</label>

                            <div class="col-md-6">
                                <input id="iniciales" type="text" class="iniciales form-control @error('iniciales') is-invalid @enderror" name="iniciales" value="{{ old('iniciales') }}" required autocomplete="name" autofocus>

                                @error('iniciales')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                    </div>

                    <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="email form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    <hr>                            
                        <h5 class="modal-title_2" id="exampleModalLabel">Asignación de Roles</h5>
                    <hr>
                    <div class="form-group row">
                        <label for="administrador" class="col-md-4 col-form-label text-md-right">{{ __('Administrador') }}</label>

                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="role" id="administrador" value="administrador">
                          
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="vendedor" class="col-md-4 col-form-label text-md-right">{{ __('Vendedor') }}</label>

                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="role" id="vendedor" value="vendedor">                      
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="disenador" class="col-md-4 col-form-label text-md-right">{{ __('Diseñador') }}</label>

                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="role" id="disenador" value="disenador">                          
                        </div>
                    </div> 

                    <div class="form-group row">
                        <label for="taller" class="col-md-4 col-form-label text-md-right">{{ __('Taller') }}</label>   
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="role" id="taller" value="taller">
                          
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="supervisor" class="col-md-4 col-form-label text-md-right">{{ __('Supervisor') }}</label>   
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="role" id="supervisor" value="supervisor">
                          
                        </div>
                    </div>

                    <hr>

                    <div class="form-check">                     
                         
                      <input class="form-check-input" type="checkbox" name="enabled" value="0" id="enabled">
                      <label class="form-check-label" for="enabled">Desabilitar usuario</label>
                        
                    </div>

                    
                    <br> 

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
                url:'{{ route('mantenedorusuario.index') }}',
                type:'GET',
                data:{
                    
                }
            },
            columns:[
                    {data:'id'},
                    {data:'name'},
                    {data:'iniciales'},
                    {data:'email'},    
                    {data:'roles'},  
                    {data:'enabled'},
                    {data:null,render:function(data){
                        return`
                            <button data-id="${data.id}" type="button" class="btn btn-primary btn-sm btn-edit"><i class="fa fa-pencil"></i></button>
                            <button data-id="${data.id}" type="button" class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash"></i></button>
                        `;
                    }}
               
            ]
        });
    }

    loadData();
//Agregar
    $(document).on('submit','#agregar',function(e){

        parametros = $(this).serialize();

        $.ajax({

            url:'{{ route('mantenedorusuario.store') }}',
            type:'POST',
            data:parametros,
            dataType:'JSON',
            beforeSend:function(){

                Swal.fire({

                    title   : 'Cargando',
                    text    : "Espere un momento...",                   
                    showConfirmButton:false 

                });             


            },
            success:function(data){

                
                $('#modal-agregar').modal('hide');
                loadData();

                Swal.fire({
                    title   : data.title,
                    text    : data.text,
                    icon    : data.icon,
                    timer   : 3000,
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

    url = '{{ route('mantenedorusuario.edit',':id' ) }}';
    url = url.replace(':id', id);

    $.ajax({

        url:url,
        type:'GET',
        data:{},
        dataType:'JSON',
        success:function(data){

            $('.id').val(data.id);
            $('.name').val(data.name);
            $('.iniciales').val(data.iniciales);                           
            $('.email').val(data.email);
            $('.role').val(data.role);
          
        }


    });


    $('.modal-title').html('Actualizar Usuario');    
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

                url = '{{ route('mantenedorusuario.destroy',':id') }}';
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
                            title   : data.title,
                            text    : data.text,
                            icon    : data.icon,
                            timer   : 3000,
                            showConfirmButton:false 

                        });

                    }

                });
            }

    });

});
</script>

@endsection	