<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-tabs nav-justified">
            <li><a href="{{url('/index')}}">Inicio</a></li>
            <li><a href="{{url('/admin/operadores')}}">Usuarios</a></li>
            <li><a href="{{url('/admin/pendientes')}}">Pendientes</a></li>
            <li><a href="{{url('/admin/productos')}}">Productos</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Datos<span class="caret"></span>
                </a>

                <ul class="dropdown-menu admin" role="menu">
                    <li><a href="{{url('/admin/puestos')}}">Puestos</a></li>
                    <li><a href="{{url('/admin/modos')}}">Modos</a></li>
                    <li><a href="{{url('/admin/cobros')}}">Cobros/Pagos</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>