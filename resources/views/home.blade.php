@extends('layouts.app')

@section('title')
    Intra-Weprint
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Bienvenido a Intra-Weprint</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Que tengas un buen día {{ Auth::user()->name }},

                    Tu perfil de sistema es:

                    
                    {{ ucfirst(auth()->user()->roles[0]->name) }} 


                   
                    


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
