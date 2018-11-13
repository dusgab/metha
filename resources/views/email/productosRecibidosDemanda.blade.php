<center>
        <div class="content" style="width:100%;height:20%;background-color:#7fb850;padding:15px; ">
        <center><h2 style="color:#74787e;">METH</h2></center>
        <center><h4 style="color:white;">Mercado Electrónico de Transacciones Hortícola</h4></center>
        </div>
        <br>
        <h3>Los Productos fueron recibidos por el Comprador!</h3>
        <br>
        <h4 style="color:gray;">Datos de la Compra:</h4>
        <p style="color:gray;">Apellido y Nombre: {{$user->apellido}}, {{$user->name}}</p>
        <p style="color:gray;">Razon Social: {{$user->razonsocial}}</p>
        <p style="color:gray;">Correo Electrónico: {{$user->email}}</p>
        <p style="color:gray;">Teléfono: {{$user->telefono}}</p>
        <p style="color:gray;">Producto: {{$cd->demanda->producto->nombre}} {{$cd->demanda->producto->descripcion}} {{$cd->demanda->producto->descripcion2}}</p>
        <p style="color:gray;">Modo: {{$cd->demanda->modo->descripcion}} X {{$cd->demanda->peso}} {{$cd->demanda->medida->descripcion}}</p>
        <p style="color:gray;">Cantidad: {{$cd->cantidad}}</p>
        <p style="color:gray;">Precio: $ {{$cd->demanda->precio}}</p>
        <p style="color:gray;">Puesto: {{$cd->demanda->puesto->descripcion}}</p>
        <p style="color:gray;">Cobro: {{$cd->demanda->cobro->descripcion}}</p>
        <p style="color:gray;">Plazo (días): {{$cd->demanda->plazo}}</p>
        <br>
        <p><a href="{{ config('app.url') }}" type="button"  style="background-color:#3498db;border-radius:6px;color:white;height: 40px;border-style: hidden;padding: 10px;text-decoration: none" >Ir al Sitio METH WEB</a></p>
        <br>
        <div class="content" style="width:100%;height:20%;background-color:#7fb850;padding:15px; ">
        <center><h4 style="color:#74787e;">&copy; {{ date('Y') }} METH. Todos los derechos reservados.</h4></center></div>
</center>