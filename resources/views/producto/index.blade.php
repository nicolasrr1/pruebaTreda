@extends('layout.inic')



@section('content')
    <div class="contentform">
        <div class="card" style="width: 48rem;">
            <div class="card-body">


                <form>
                    <input type="hidden" id="id" name="id">
                    <input type="text" name="tienda" value={{ $id }}>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre">
                    </div>
                    <div class="mb-3">
                        <label for="sku" class="form-label">Sku</label>
                        <input type="text" class="form-control" id="sku">
                    </div>

                    <div class="mb-3">
                        <label for="sku" class="form-label">valor</label>
                        <input type="number" class="form-control" id="sku">
                    </div>




                    <div class="mb-3">
                        <label for="imagen" class="form-label">imagen</label>
                        <input accept="imagen/*" id="imagen" class="form-control" type="file" name="imagen">
                    </div>



                    <a id="btn" class="btn btn-primary">Submit</a>
                    <a id="btns" style="display: none" class="btn btn-success">Submit</a>

                </form>
            </div>
        </div>
    </div>

    <script>

        $('#btn').click(function(params) {
            var parametros = {
                "nombre": $('#nombre').val(),
                "sku": $('#sku').val(),
                "valor": $('#valor').val(),
                "imagen": $('#imagen').val(),
                "tienda": $('#tienda').val(),
            };
            $.ajax({
                data: parametros,
                url: 'http://127.0.0.1:8000/api/Producto',
                type: 'post',
                beforeSend: function() {
                },
                success: function(
                    response) {
                    $("#resultado").html(response);
                }
            });
        });
    </script>
@stop
