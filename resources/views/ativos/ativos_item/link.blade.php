@extends('admin.main_master')

@section('main')
    <div class="col-lg">
        <form action="link-ativos-itens/store" method="POST">
            @csrf
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h3 class="w-50 float-left card-title m-0">Cadastro de Ativos</h3>
                </div>
                <div class="card-body">
                    <h4 class="card-title mb-3"></h4>
                    <div class="row">

                        <div class="mb-3 col-md-4">
                            <p class="font-weight-400 mb-2">ATIVO</p>
                            <select id="ativo" name="ativo" class="form-control" required="true" size="20">
                                @php  $inicio=0; $old_ativo_modelo_itens = ''; @endphp
                                @foreach($ativosModeloItens as  $at_modelo)
                                    @if(!$inicio)
                                        @php  $inicio=1; $old_ativo_modelo_itens = $at_modelo->ativo_modelo_id; @endphp
                                        <option value="{{ strtoupper($at_modelo->ativo_modelo_id) }}" >
                                            Sigla: {{ strtoupper($at_modelo->sigla).' - Nome : '.strtoupper($at_modelo->nome) }}</option>
                                    @else
                                        @if( $old_ativo_modelo_itens != $at_modelo->ativo_modelo_id)
                                        <option
                                        value="{{ strtoupper($at_modelo->ativo_modelo_id) }}" >Sigla: {{ strtoupper($at_modelo->sigla).' - Nome : '.strtoupper($at_modelo->nome) }}</option>
                                            @php   $old_ativo_modelo_itens = $at_modelo->ativo_modelo_id; @endphp
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-4">
                            <p class="font-weight-400 mb-2">ITENS</p>
                            <select id="itens" name="itens[]" class="form-control" required="true" size="20" multiple>
                                @foreach($itens as $categoria => $item)
                                    <optgroup label="{{ $categoria }}">
                                    @foreach($item as $it)
                                            <option value="{{ strtoupper($it->item_id) }}">
                                                {{ strtoupper($it->item_nome) }}
                                            </option>
                                    @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-4">
                            <p class="font-weight-400 mb-2">ITENS DO ATIVO</p>
                            <select id="ativo" name="ativo" class="form-control" required="true" size="20">
                                @php  $inicio=0; $old_ativo_modelo_itens = ''; @endphp
                                @foreach($ativosModeloItens as  $at_modelo)
                                    @if(!$inicio)
                                        @php  $inicio=1; $old_ativo_modelo_itens = $at_modelo->ativo_modelo_id; @endphp
                                        <option value="{{ strtoupper($at_modelo->ativo_modelo_id) }}" >
                                            Sigla: {{ strtoupper($at_modelo->sigla).' - Nome : '.strtoupper($at_modelo->nome) }}</option>
                                    @else
                                        @if( $old_ativo_modelo_itens != $at_modelo->ativo_modelo_id)
                                            <option
                                                value="{{ strtoupper($at_modelo->ativo_modelo_id) }}" >Sigla: {{ strtoupper($at_modelo->sigla).' - Nome : '.strtoupper($at_modelo->nome) }}</option>
                                            @php   $old_ativo_modelo_itens = $at_modelo->ativo_modelo_id; @endphp
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <button type="submit" class="btn float-right btn-primary">Salvar</button>
                </div>

            </div>
        </form>
    </div>
@endsection
