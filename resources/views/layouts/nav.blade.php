<nav class="navbar navbar-expand-lg navbar-light bg-light">
         
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="navbar-toggler-icon"></span>
    </button> <a class="navbar-brand" href="{{ route('home')}}">Intra-Weprint</a>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


        @guest

        @else
        
        <ul class="navbar-nav">            
            
            <li class="nav-item dropdown">
                @hasrole('vendedor|supervisor|supervisorventas|administrador')
                 <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown">Vendedor</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                     <a class="dropdown-item" href="{{ route('cliente.index') }}">Clientes / Orden de trabajo </a>
                     <a class="dropdown-item" href="{{ route('aprobarcliente.index') }}">Aprobar por cliente</a>                    
                    <div class="dropdown-divider"></div>                 
                
                @endhasrole 
            </li>
             <li class="nav-item dropdown">
                @hasrole('disenador|supervisor|supervisorventas|administrador')
                 <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown">Diseño</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    @hasrole('supervisor|supervisorventas|administrador')
                     <a class="dropdown-item" href="{{ route('diseno.index') }}">Asignar diseñador</a>
                     @endhasrole
                     @hasrole('disenador|supervisor|administrador')
                     <a class="dropdown-item" href="{{ route('archivodiseno.index') }}">Archivo diseñador</a>
                     @endhasrole
                    <div class="dropdown-divider"></div>                 
                     
                </div>
                @endhasrole 
            </li>
            <li class="nav-item dropdown">
                @hasrole('taller|supervisor|supervisortaller|administrador')
                 <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown">Taller</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">                     
                     
                        <a class="dropdown-item" href="{{ route('aceptadocliente.index') }}">Aceptado por cliente</a>

                        <a class="dropdown-item" href="{{ route('impresion.index') }}">Impresión</a>

                        <a class="dropdown-item" href="{{ route('terminacion.index') }}">Terminación</a>


                    
                     @hasrole('supervisor|supervisortaller|administrador')
                     <a class="dropdown-item" href="{{ route('finalizarpedido.index')}}">Finalizar trabajos</a>
                     @endhasrole

                    <div class="dropdown-divider"></div>                    
                     
                </div>
                @endhasrole
            </li>           
             
             
            
            <li class="nav-item">
                @hasrole('vendedor|disenador|taller|supervisor|supervisorventas|supervisortaller|administrador')
                <a class="nav-link" href="{{ route('pedidos.index') }}" id="navbar" >Estado de pedidos</a>
                @endhasrole
            </li> 
            <li class="nav-item dropdown">
                @hasrole('supervisor|administrador')
                 <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown">Reportes</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                     <a class="dropdown-item" href="{{ route('reportes.index') }}">Reporte fechas de entregas</a>
                     
                     
                     

                    <div class="dropdown-divider"></div>                    
                     
                </div>
                @endhasrole
            </li>            
            

            <li class="nav-item dropdown">
                @hasrole('administrador')
                 <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown">Mantenedor</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                     <a class="dropdown-item" href="{{ route('mantenedorusuario.index')}}">Usuarios</a>
                     <a class="dropdown-item" href="{{ route('registrousuario.index') }}">Registro Usuarios</a>
                     <a class="dropdown-item" href="{{ route('registroimpresora.index') }}">Registro impresoras</a>

                    <div class="dropdown-divider"></div>
                    
                </div>
                @endhasrole
            </li>   


        </ul>


        @endguest


        
        <ul class="navbar-nav ml-md-auto">

            @guest

                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('login')}}">Login<span class="sr-only">(current)</span></a>
                </li>
             <!--   
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('register')}}">Registro<span class="sr-only">(current)</span></a>
                </li>
              -->  
            @else



            <li class="nav-item active">
                 <a class="nav-link" href="#">  {{ Auth::user()->name }}<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                 <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown"></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                     
                    <div class="dropdown-divider"></div>
                     

                    <a class="dropdown-item"
                     href="{{ route('logout') }}" 
                     onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    Salir</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>


                </div>
            </li>
            @endguest


        </ul>
    </div>
</nav>