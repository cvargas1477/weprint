@extends('layouts.app')

@section('title')
    Archivos
@endsection
@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<form id="frm-upload" autocomplete="off">
					 @csrf
					<div class="form-group">
						<label>Archivo</label>
						<input type="file" name="archivo" class="form-control" required>
					</div>
					<button class="btn btn-primary">Cargar</button>
				</form>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	<script>
		$(document).on('submit','#frm-upload',function(e){

			parametros = new FormData(this);

			$.ajax({	
				url:'{{ route('archivos.upload') }}',
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
					Swal.fire({
						title:data.title,
						text:data.text,
						icon:data.icon
					});
				}
			});
			e.preventDefault();
		});
	</script>
@endsection