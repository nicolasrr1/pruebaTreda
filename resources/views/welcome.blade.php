
@extends('layout.inic')


@section('content')
<div class="contentform">
    <div class="card" style="width: 48rem;">
        <div class="card-body">


            <form>
                <input type="hidden" id="id" name="id">
                
                
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre">
                </div>
                <div class="mb-3">
                    <label for="fecha_apertura" class="form-label">Fecha Apertura</label>
                    <input type="date" class="form-control" id="fecha_apertura">
                </div>

                <a id="btn" class="btn btn-primary">Submit</a>
                <a id="btns" style="display: none" class="btn btn-success">Submit</a>

            </form>
        </div>
    </div>
</div>

<div class="contentTable">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">nombre</th>
                <th scope="col">fecha_apertura</th>
            </tr>
        </thead>
        <tbody id="tbody">
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            <a href="http://"></a>

        </tbody>
    </table>
</div>






<script>
    $('#btn').click(function(params) {
        var parametros = {
            "nombre": $('#nombre').val(),
            "fecha_apertura": $('#fecha_apertura').val()
        };
        $.ajax({
            data: parametros,
            url: 'http://127.0.0.1:8000/api/tienda',
            type: 'post',
            beforeSend: function() {
                $("#resultado").html("Procesando, espere por favor...");
            },
            success: function(
                response) {
                $("#resultado").html(response);
            }
        });

        $('#id').val('');
        $('#nombre').val('');
        $('#fecha_apertura').val('');

        cargar();

    });








    function cargar() {
        $.get("http://127.0.0.1:8000/api/tienda", function(data) {
            let html = "";
            console.log(data);
            data.forEach(e => {


                html += "<tr>";
                html += "<th scope='row'>" + e.id + "</th>";
                html += "<td>" + e.nombre + "</td>";
                html += "<td>" + e.fecha_apertura + "</td>";
                html += "<td> <a href='http://127.0.0.1:8000/Producto/Tienda/" + e.id +
                    "  ' class='btn btn-primary'>Productos</a></td>";
                html += "<td> <button  onclick='eliminar(" + e.id +
                    ")'  class='btn btn-danger'>Danger</button> </td>";

                html += "<td> <button onclick='cargarById(" + e.id +
                    ")' class='btn btn-success'>actualizar </button> </td>";


                html += "</tr>";



                $('#tbody').html(html);

            });

        });
    }

    cargar();


    function cargarById(id) {
        document.getElementById("btns").style.display = 'block';
        document.getElementById("btn").style.display = 'none';

        $.ajax({
            url: 'http://127.0.0.1:8000/api/cargar/'+ id + '',
            type: 'get',
            success: function(data) {
                data.forEach(e => {

                    $('#id').val(e.id);
                    $('#nombre').val(e.nombre);
                    $('#fecha_apertura').val(e.fecha_apertura);
                });

            }
        });
    }



    $('#btns').click(function(params) {
       
        document.getElementById("btns").style.display = 'none';
        document.getElementById("btn").style.display = 'block';


        var parametros = {
            "id": $('#id').val(),
            "nombre": $('#nombre').val(),
            "fecha_apertura": $('#fecha_apertura').val()
        };
        $.ajax({
            data: parametros,
            url: 'http://127.0.0.1:8000/api/tienda/',
            type: 'put',
            beforeSend: function() {
                $("#resultado").html("Procesando, espere por favor...");
            },
            success: function(
                response) {
                $("#resultado").html(response);
            }
        });

        $('#id').val('');
        $('#nombre').val('');
        $('#fecha_apertura').val('');


        cargar();

    });


    function eliminar(id) {
        $.ajax({
            url: 'http://127.0.0.1:8000/api/tiendaelim/' + id + '',
            type: 'get',
            success: function(result) {
                console.log(result);
            }
        });

        cargar();
    }
</script>

@stop
    