@extends('layout.inic')



@section('content')
    <div class="contentform">
        <div class="card" style="width: 48rem;">
            <div class="card-body">


                <form action="{{ route('Producto') }}" method="POST" enctype="multipart/form-data" flie="true"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <input type="hidden" name="tienda" value={{ $id }}>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" id="nombre">
                        @error('nombre')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="sku" class="form-label">Sku</label>
                        <input type="text" name="sku" class="form-control" id="sku">
                        @error('sku')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="sku" class="form-label">valor</label>
                        <input type="number" name="valor" class="form-control" id="sku">
                        @error('valor')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="imagen" class="form-label">imagen</label>
                        <input id="imagen" class="form-control" type="file" accept="image/*" name="imagen">
                        @error('valor')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" id="btn" class="btn btn-primary">Submit</button>

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
                    <th scope="col">sku</th>
                    <th scope="col">valor</th>
                    <th scope="col">tienda</th>
                    <th scope="col">imagen</th>

                </tr>
            </thead>
            <tbody id="tbody">

                @foreach ($producto as $item)
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ $item->nombre }} </td>
                        <td>{{ $item->sku }}</td>
                        <td>{{ $item->valor }}</td>
                        <td>{{ $item->tienda }}</td>
                        <td> <img class="imgProduct" src="{{ $item->imagen }}" alt=""> </td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal{{ $item->id }}">
                                Launch demo modal
                            </button>
                        </td>


                        <td>
                            <a href="http://127.0.0.1:8000/ProductoEliminar/{{ $item->id }}"
                                class="btn btn-danger">Eliminar</a>

                        </td>

                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('ProductoUpdate') }}" method="POST"
                                        enctype="multipart/form-data" flie="true">
                                        @csrf
                                        <input type="hidden" value="{{ $item->id }}" id="id" name="id">
                                        <input type="hidden" name="tienda" value={{ $id }}>
                                        <div class="mb-3">
                                            <label for="nombre" class="form-label">Nombre</label>

                                            <input type="text" value="{{ $item->nombre }}" name="nombre"
                                                class="form-control" id="nombre">
                                        </div>
                                        <div class="mb-3">
                                            <label for="sku" class="form-label">Sku</label>
                                            <input type="hidden" value="{{ $item->sku }}" name="sku"
                                                class="form-control"+>
                                            <input type="text" value="{{ $item->sku }}" name="sku" disabled
                                                class="form-control" id="sku">
                                        </div>

                                        <div class="mb-3">
                                            <label for="sku" class="form-label">valor</label>
                                            <input type="number"value="{{ $item->valor }}" name="valor"
                                                class="form-control" id="sku">
                                        </div>

                                        <div class="mb-3">
                                            <label for="imagen" class="form-label">imagen</label>
                                            <input id="imagen" class="form-control" type="text" name="imagen">
                                        </div>
                                        <button type="submit" id="btn" class="btn btn-primary">Submit</button>

                                    </form>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                @endforeach


            </tbody>
        </table>
    </div>

@stop
