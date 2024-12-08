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
                                        @foreach($assets['categorias'] as $categoria)
                                            <option value="{{ $categoria->id }}" {{ ($categoria->id == $produto->categoria_id) ? 'selected' : '' }}>{{ $categoria->nome }}</option>
                                        @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mt-1">
                                <label for="recipient-name-2" class="col-form-label">Fabricante</label>
                                <select name="fabricante_id" id="fabricante_id" class="form-control" required>
                                    <option value="" selected>---Selecione---</option>
                                        @foreach($assets['fabricantes'] as $fabricante)
                                            <option
                                                value="{{ $fabricante->id }}" {{ ($fabricante->id == $produto->fabricante_id) ? 'selected' : '' }}>{{ $fabricante->nome }}</option>
                                        @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mt-1">
                                <label for="recipient-name-2" class="col-form-label">Unid. Medida</label>
                                <select name="unid_medida_id" id="unid_medida_id" class="form-control">
                                    <option value="" selected>---Nenhum---</option>
                                            @foreach($assets['unidade_medida'] as $unid_medida)
                                                <option value="{{ $unid_medida->id }}" {{ ($unid_medida->id == $produto->unid_medida_id) ? 'selected' : '' }}>{{ $unid_medida->nome }}</option>
                                            @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name-2" class="col-form-label">Descrição</label>
                            <textarea class="form-control" id="descricao" name="descricao"> {{ $produto->descricao }}</textarea>
                        </div>
                    </div>
                    <a href="{{ route('produto.index') }}" class="btn float-right btn-primary ml-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5"></path>
                        </svg>
                        Voltar
                    </a>
                    <button type="submit" class="btn float-right btn-primary ml-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy" viewBox="0 0 16 16">
                            <path d="M11 2H9v3h2z"/>
                            <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z"/>
                        </svg>&nbsp;
                        Salvar</button>
                </form>
            </div>
        </div>
    </div>
    <!-- End Editar Produto -->
@endsection

