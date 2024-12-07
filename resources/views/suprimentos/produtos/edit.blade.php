@extends('admin.main_master')

@section('main')


    <!-- Editar Produto -->
    <div class="col-md mt-3">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="w-50 float-left card-title m-0">Código do Produto : {{ $produto->codprod }}</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('produto.update', $produto->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="recipient-name-2" class="col-form-label">Cod. Produto</label>
                                <input type="text" id="codprod" name="codprod" class="form-control" value="{{ $produto->codprod }}">
                            </div>
                            <div class="col-md-4">
                                <label for="recipient-name-2" class="col-form-label">Qt. Minimo</label>
                                <input type="text" class="form-control" id="qt_minima" name="qt_minima" value="{{ $produto->qt_minima }}">
                            </div>
                            <div class="col-md-4">
                                <label for="recipient-name-2" class="col-form-label">Qt. Reposição</label>
                                <input type="text" class="form-control" id="qt_reposicao" name="qt_reposicao" value="{{ $produto->qt_reposicao }}">
                            </div>
                            <div class="col-md-12">
                                <label for="recipient-name-2" class="col-form-label">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" value="{{ $produto->nome }}">
                            </div>
                            <div class="col-md-4 mt-1">
                                <label for="recipient-name-2" class="col-form-label">Categoria</label>
                                <select name="categoria_id" id="categoria_id" class="form-control" required>--}}
                                    <option value="" selected>---Selecione---</option>
                                    <option value="1" >Cat1</option>
                                    {{--                                    @foreach($data['equipes'] as $equipe)--}}
                                    {{--                                        <option value="{{ $equipe->id }}">{{ $equipe->nome }}</option>--}}
                                    {{--                                    @endforeach--}}
                                </select>
                            </div>
                            <div class="col-md-4 mt-1">
                                <label for="recipient-name-2" class="col-form-label">Fabricante</label>
                                <select name="fabricante_id" id="fabricante_id" class="form-control" required>
                                    <option value="" selected>---Selecione---</option>
                                    <option value="1" >Fab1</option>
                                    {{--                                    @foreach($data['status'] as $status)--}}
                                    {{--                                        <option--}}
                                    {{--                                            value="{{ $status->id }}" {{ ($status->nome == 'ativo') ? 'selected' : '' }}>{{ $status->nome }}</option>--}}
                                    {{--                                    @endforeach--}}
                                </select>
                            </div>
                            <div class="col-md-4 mt-1">
                                <label for="recipient-name-2" class="col-form-label">Unid. Medida</label>
                                <select name="unid_medida_id" id="unid_medida_id" class="form-control">
                                    <option value="" selected>---Nenhum---</option>
                                    <option value="1" >Metro</option>
                                    {{--                                    @foreach($data['cargos'] as $cargo)--}}
                                    {{--                                        <option value="{{ $cargo->id }}">{{ $cargo->nome }}</option>--}}
                                    {{--                                    @endforeach--}}
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name-2" class="col-form-label">Descrição</label>
                            <textarea class="form-control" id="descricao" name="descricao">value="{{ $produto->descricao }}"</textarea>
                        </div>
                    </div>
                    <a href="{{ route('produto.index') }}" class="btn float-right btn-primary ml-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5"></path>
                        </svg>
                        Voltar
                    </a>
                    <button type="submit" class="btn float-right btn-primary ml-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"></path>
                        </svg>&nbsp;
                        Editar</button>
                </form>
            </div>
        </div>
    </div>
    <!-- End Editar Produto -->
@endsection

