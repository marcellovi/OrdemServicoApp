@extends('admin.main_master')

@section('main')
    @extends('admin.main_master')

    @section('main')

        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h3 class="w-50 float-left card-title m-0">Editar Ativo</h3>
                </div>
                <div class="card-body">
                    <h4 class="card-title mb-3"></h4>
                    <!-- Editar Ativo -->
                    <form action="{{ route('ativo.modelo.update',$ativo->id) }}" method="POST" >
                        @csrf
                        @method('PUT')
                            <div class="row">
                                <div class="mb-3 col-md-3">
                                    <p class="font-weight-400 mb-2">Sigla *</p>
                                    <input type="text" id="sigla" class="form-control" value="{{ $ativo->nome }}" name="sigla" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <p class="font-weight-400 mb-2">Nome do Ativo *</p>
                                    <input type="text" id="nome" class="form-control" value="{{ $ativo->nome }}" placeholder="Nome do Ativo" name="nome" required>
                                </div>
                                <div class="mb-3 col-md-3">
                                    <p class="font-weight-400 mb-2">Natureza do Serviço *</p>
                                    <select class="form-control" id="categoria" name="categoria" required="true">
                                           @foreach($categorias as $categoria)
                                            <option value="{{ $categoria->id }}" {{ ($categoria->id == $ativo->categoria_id) ? 'selected' : ''}}>{{ $categoria->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <p class="font-weight-400 mb-2">Modelo</p>
                                    <input type="text" id="modelo" name="modelo" placeholder="Modelo" class="form-control" value="{{ $ativo->modelo }}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <p class="font-weight-400 mb-2">N. Série</p>
                                    <input type="text" id="serie" name="serie" placeholder="N. Série" class="form-control" value="{{ $ativo->serie }}">
                                </div>
                                <div class="mb-3 col-md-12">
                                    <p class="font-weight-400 mb-2">Upload Arquivos do Ativo</p>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="files_ativo" name="files_ativo"
                                                   aria-describedby="inputGroupFileAddon01" multiple>
                                            <label class="custom-file-label" for="inputGroupFile01">Manuais,Imagens,Schemas...</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <p class="font-weight-400 mb-2">Descritivo:</p><textarea rows="3"
                                                                                             class="form-control"
                                                                                             id="descritivo"
                                                                                             name="descritivo">{{ $ativo->descritivo }}</textarea>
                                </div>
                            </div>
                        <a href="{{ route('ativos-itens') }}" class="btn float-right btn-primary ml-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5"></path>
                            </svg> Voltar</a>
                        <button type="submit" class="btn float-right btn-primary ml-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                            </svg> &nbsp;    Editar</button>
                        </form>
                </div>
            </div>
        </div>
    @endsection

@endsection
