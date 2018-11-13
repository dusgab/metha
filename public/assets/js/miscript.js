$(document).ready(function(){
   
    $("#provincias").change(function(event){
        $.get("ciudades/"+event.target.value+"",function(response, provincia){
        $("#ciudades").empty();
            for(i=0; i<response.length; i++){
            $("#ciudades").append("<option value="+response[i].id+"> "+response[i].nombre+" </option>");
            }
        });
    });

    $('#agregarProd').on('click', function () {
            $('#agregarProducto').load("agregarProducto")//load a view into a modal
        $('#agregarProducto').modal('show'); //show the modal
      });

    $('#agregarProducto').on('hidden.bs.modal', function(){ 
        $(this).find('#formagregarProducto')[0].reset(); //para limpiar campos del modal
    });

    $('#agregarCat').on('click', function () {
            $('#agregarCategoria').load("agregarCategoria")//load a view into a modal
        $('#agregarCategoria').modal('show'); //show the modal
      });

    $('#agregarCategoria').on('hidden.bs.modal', function(){ 
        $(this).find('#formagregarCategoria')[0].reset(); //para limpiar campos del modal
    });

    $('#agregarMed').on('click', function () {
            $('#agregarMedida').load("agregarMedida")//load a view into a modal
        $('#agregarMedida').modal('show'); //show the modal
      });

    $('#agregarMedida').on('hidden.bs.modal', function(){ 
        $(this).find('#formagregarMedida')[0].reset(); //para limpiar campos del modal
    });

    $('#agregarCob').on('click', function () {
            $('#agregarCobro').load("agregarCobro")//load a view into a modal
        $('#agregarCobro').modal('show'); //show the modal
      });

    $('#agregarCobro').on('hidden.bs.modal', function(){ 
        $(this).find('#formagregarCobro')[0].reset(); //para limpiar campos del modal
    });

    $('#agregarMod').on('click', function () {
            $('#agregarModo').load("agregarModo")//load a view into a modal
        $('#agregarModo').modal('show'); //show the modal
      });

    $('#agregarModo').on('hidden.bs.modal', function(){ 
        $(this).find('#formagregarModo')[0].reset(); //para limpiar campos del modal
    });

    $('#agregarPue').on('click', function () {
            $('#agregarPuesto').load("agregarPuesto")//load a view into a modal
        $('#agregarPuesto').modal('show'); //show the modal
      });

    $('#agregarPuesto').on('hidden.bs.modal', function(){ 
        $(this).find('#formagregarPuesto')[0].reset(); //para limpiar campos del modal
    });
    
    $('#agregarOfer').on('click', function () {
        $('#agregarOferta').modal('show'); //show the modal
      });

    $('#agregarOferta').on('hidden.bs.modal', function(){ 
        $(this).find('#formagregarOferta')[0].reset(); //para limpiar campos del modal
    });

    $('#agregarDem').on('click', function () {
        $('#agregarDemanda').modal('show'); //show the modal
      });

    $('#agregarDemanda').on('hidden.bs.modal', function(){ 
        $(this).find('#formagregarDemanda')[0].reset(); //para limpiar campos del modal
    });
 
    ofertar = function (id, cantidad, precio, puesto, cobro, plazo) {
            $('#id_oferta').val(id);
            $('#cantOferta').val(cantidad);
            $('#cantidadCo').val(cantidad);
            $('#precioCo').val(precio);
            $('#idPuesto').val(puesto);
            $('#idCobro').val(cobro);
            $('#idPlazo').val(plazo);
            
            var plazos = document.getElementsByName('plazoCo');
            
            for (var x = 0; x < plazos.length; x++) {
                plazos[x].checked = false;
               if (plazos[x].value == plazo) {
                plazos[x].checked = true;
               }
            }
        $('#modalOfertar').modal('show'); //show the modal
      }
    
    demandar = function (id, cantidad, precio, puesto, cobro, plazo) {
            $('#id_demanda').val(id);
            $('#cantDemanda').val(cantidad);
            $('#cantidadCd').val(cantidad);
            $('#precioCd').val(precio);
            $('#idPuestoD').val(puesto);
            $('#idCobroD').val(cobro);
            $('#idPlazoD').val(plazo);
            
            var plazos = document.getElementsByName('plazoCd');
            
            for (var x = 0; x < plazos.length; x++) {
                plazos[x].checked = false;
                if (plazos[x].value == plazo) {
                    plazos[x].checked = true;
                }
            }
        $('#modalDemandar').modal('show'); //show the modal
    }

    editarP = function (idProd, nombreProducto, descripcionProd, descripcion2Prod, id_cat) {
        
        $('#idProd').val(idProd);
        $('#nombreProd').val(nombreProducto);
        $('#descProd').val(descripcionProd);
        $('#desc2Prod').val(descripcion2Prod);
        $('#id_cat').val(id_cat);
        $('#editarProducto').modal('show'); //show the modal
    }

    editarC = function (idCat, desc) {
        $('#idCat').val(idCat);
        $('#desCat').val(desc);
        $('#editarCategoria').modal('show');
    }

    editarM = function (idMed, desc) {
        $('#idMed').val(idMed);
        $('#desMed').val(desc);
        $('#editarMedida').modal('show');
    }

    editarMod = function (idMod, desc) {
        $('#idModo').val(idMod);
        $('#desModo').val(desc);
        $('#editarModo').modal('show');
    }

    editarCob = function (idCob, desc) {
        $('#idCobro').val(idCob);
        $('#desCobro').val(desc);
        $('#editarCobro').modal('show');
    }

    editarPues = function (idPues, desc) {
        $('#idPuesto').val(idPues);
        $('#desPuesto').val(desc);
        $('#editarPuesto').modal('show');
    }

    $("#cantidad").change(function(event){
        var cant = document.getElementById("cantOferta").value;
        $("#cantidad").attr("max", cant);
    });

    confirmarOf = function (action, op) {
        if (op == '0') {
            if (confirm('¿Confirma que ha recibido los Productos?')) {
                document.getElementById('eliminarCoferta').action = action;
                document.getElementById('eliminarCoferta').submit();
            }
        } else { 
            if (confirm('¿Confirma que desea eliminar esta Contra Oferta?')) {
                document.getElementById('eliminarCoferta').action = action;
                document.getElementById('eliminarCoferta').submit();
            }
        }
    }

    confirmarDem = function (action) {
        if (confirm('¿Confirma que ha recibido los Productos?')) {
            document.getElementById('editarCdemanda').action = action;
            document.getElementById('editarCdemanda').submit();
        }
    }

    $("#cantidadD").change(function(event){
        var cant = document.getElementById("cantDemanda").value;
        $("#cantidadD").attr("max", cant);
    });

    $('#modalOfertar').on('hidden.bs.modal', function(){ 
        $(this).find('#formOfertar')[0].reset(); //para limpiar campos del modal
    });

    $("#formagregarOferta input:checkbox").on('click', function() {
        $('input[name="' + this.name + '"]').not(this).prop('checked', false);
    });

    $("#formOfertar input:checkbox").on('click', function() {
        $('input[name="' + this.name + '"]').not(this).prop('checked', false);
    });

    $("#registrarUsuario input:checkbox").on('click', function() {
        $('input[name="' + this.name + '"]').not(this).prop('checked', false);
    });

    $('#modalDemandar').on('hidden.bs.modal', function(){ 
        $(this).find('#formDemandar')[0].reset(); //para limpiar campos del modal
    });

    $("#formagregarDemanda input:checkbox").on('click', function() {
        $('input[name="' + this.name + '"]').not(this).prop('checked', false);
    });

    $("#formDemandar input:checkbox").on('click', function() {
        $('input[name="' + this.name + '"]').not(this).prop('checked', false);
    });

    //Ordenar tablas
    $('th').click(function() {
        var table = $(this).parents('table').eq(0)
        var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()))
        this.asc = !this.asc
        if (!this.asc) {
          rows = rows.reverse()
        }
        for (var i = 0; i < rows.length; i++) {
          table.append(rows[i])
        }
        setIcon($(this), this.asc);
      })

      function comparer(index) {
        return function(a, b) {
          var valA = getCellValue(a, index),
            valB = getCellValue(b, index)
          return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.localeCompare(valB)
        }
      }

      function getCellValue(row, index) {
        return $(row).children('td').eq(index).html()
      }

      function setIcon(element, asc) {
        $("th").each(function(index) {
          $(this).removeClass("sorting");
          $(this).removeClass("asc");
          $(this).removeClass("desc");
        });
        element.addClass("sorting");
        if (asc) element.addClass("asc");
        else element.addClass("desc");
      }

      $("#fechai").change(function(){
        var fecha = document.getElementById("fechai").value;
        $("#fechaf").attr("disabled", false);
        $("#fechaf").attr("min", fecha);
       });

     graficar = function(id, nombre, fechad, fechah) {
        if (fechad === '') {
            
            var d = new Date();
            month = '' + (d.getMonth() - 1);
            day = '' + d.getDate();
            year = d.getFullYear();

            if (month.length < 2) {month = '0' + month};
            if (day.length < 2) {day = '0' + day};

            fechad = year+"-"+month+"-"+day;
        }
        if (fechah === '') {
            var fechah = new Date().toISOString().slice(0, 10);
        }
        window.open("precios/graficar/"+id+"/"+nombre+"/"+fechad+"/"+fechah, "_blank","width=600,height=400");
        
     }

    $('#tipo').on('change', function() {
        if ($("#tipo option:selected").val() === "3" ) {
            document.getElementById("rep").style.display = "";
            $('#id_rep').prop('required', 'required');
            document.getElementById("is_rep").style.display = "none";
            $('#ch_is_rep').prop('checked', false);
        }
        else {
            document.getElementById("rep").style.display = "none";
            $('#id_rep').prop('required', '');
            document.getElementById("is_rep").style.display = "";
        }
    });

    $('#tipo_reg').on('change', function() {
        if ($("#tipo_reg option:selected").val() === "1" ) {
            document.getElementById("renspa").style.display = "";
            $('#ren').prop('required', 'required');
            $('#ren').prop('name', 'registro');
            document.getElementById("matricula").style.display = "none";
            document.getElementById("mat").value = "";
            $('#mat').prop('required', '');
            $('#mat').prop('name', 'matricula');
        }
        else {
            document.getElementById("matricula").style.display = ""; 
            $('#mat').prop('required', 'required');
            $('#mat').prop('name', 'registro');
            document.getElementById("renspa").style.display = "none";
            document.getElementById("ren").value = "";  
            $('#ren').prop('required', '');
            $('#ren').prop('name', 'renspa');
        }
    });

});