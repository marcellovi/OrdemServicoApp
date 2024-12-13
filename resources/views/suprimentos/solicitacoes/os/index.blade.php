@extends('admin.main_master')

@section('main')

    <div class="mb-4 col-md-12 mt-3" align="right">

{{--        <button type="button" class="btn btn-info m-1" data-toggle="modal" data-target="#verifyModalContentUsuario"--}}
{{--                data-whatever="@mdo">--}}
{{--            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">--}}
{{--                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>--}}
{{--                <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>--}}
{{--            </svg>--}}
{{--            <span class="ul-btn__text">&nbsp; Consultar Estoque</span>--}}
{{--        </button>--}}
        <button type="button" class="btn btn-info m-1" data-toggle="modal" data-target="#verifyModalContentConsultaEstoque"
                data-whatever="@mdo">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
            </svg>
            <span class="ul-btn__text">&nbsp;Consultar Estoque</span>
        </button>
    </div>

    <!-- Gestao solicitacoes -->
    <div class="col-md">
        <div class="card o-hidden mb-4">
            <div class="card-header d-flex align-items-center">
                <h3 class="w-50 float-left card-title m-0">Gestão de Solicitações de OS</h3>
            </div>
            <div class="card-body">

                <div class="table-responsive">

                    <table id="user_table" class="table dataTable-collapse text-center">
                        <thead>
                        <tr>
                            <th scope="col" style="width: 10%">CODIGO OS</th>
                            <th scope="col" style="width: 10%">PRIORIDADE</th>
                            <th scope="col" style="width: 25%">ITENS</th>
                            <th scope="col" style="width: 25%">INFORMAÇÕES</th>
                            <th scope="col" style="width: 10%">STATUS</th>
                            <th scope="col" style="width: 10%">DT.CRIAÇÃO</th>
                            <th scope="col" style="width: 10%">AÇÕES</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @foreach($solicitacoes as $solicitacao)
                                <td style="width: 10%"><b>{{ $solicitacao->codospedido }}</b></td>
                                <td style="width: 10%">
                                    {{ (isset($data['prioridades']->where('id',$solicitacao->prioridade_id)->first()->nome)) ?
                                                                            $data['prioridades']->where('id',$solicitacao->prioridade_id)->first()->nome
                                                                            : 'Nenhum'
                                                                        }}                                </td>
                                <td style="width: 25%"><b>{{ $solicitacao->itens }}</b></td>
                                <td style="width: 25%">{{ $solicitacao->descritivo }}</td>
                                <td style="width: 10%">
                                    {{ (isset($data['status']->where('id',$solicitacao->status_id)->first()->nome)) ?
                                        $data['status']->where('id',$solicitacao->status_id)->first()->nome
                                        : 'Nenhum'
                                    }}
                                </td>
{{--                                <td>--}}
{{--                                    @isset($data['roles']->where('id',$usuario->role_id)->first()->name)--}}
{{--                                        <h5><span--}}
{{--                                            class="badge badge-pill badge-outline-dark">{{ $data['roles']->where('id',$usuario->role_id)->first()->name }}</span></h5>--}}
{{--                                    @else--}}
{{--                                        <span class="badge badge-pill badge-dark">{{ 'Nenhum' }}</span>--}}
{{--                                    @endisset--}}
{{--                                    --}}{{-- (isset() ? '<span class="badge badge-success">'.$data['roles']->where('id',$usuario->role_id)->first()->name.'</span>' : 'Nenhum' --}}
{{--                                </td>--}}
                                <td style="width: 10%"><b>{{ $solicitacao->created_at }}</b></td>
                                <td style="width: 10%">
                                    <a href="{{ route('almoxarifado.solicitacao.edit',$solicitacao->id) }}"
                                       class="btn btn-outline-success m-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd"
                                                  d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                        </svg>
                                    </a>
{{--                                    <a href="{{ route('almoxarifado.saida.estoque.store',$solicitacao->id) }}" class="btn btn-outline-danger btn-icon m-1" title="SAIDA">--}}
{{--                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder-minus" viewBox="0 0 16 16">--}}
{{--                                            <path d="m.5 3 .04.87a2 2 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2m5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19q-.362.002-.683.12L1.5 2.98a1 1 0 0 1 1-.98z"/>--}}
{{--                                            <path d="M11 11.5a.5.5 0 0 1 .5-.5h4a.5.5 0 1 1 0 1h-4a.5.5 0 0 1-.5-.5"/>--}}
{{--                                        </svg>--}}
{{--                                    </a>--}}
                                </td>

                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- end of col-->

    <!-- modal consultar estoque -->
    <div class="modal fade" id="verifyModalContentConsultaEstoque" tabindex="-1" role="dialog"
         aria-labelledby="verifyModalContent" aria-hidden="true" style="display: none;">
        <div class="modal-lg modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verifyModalContent_title">Consultar Estoque</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                    <div class="modal-body">

                        <div class="table-responsive">

                            <table id="sales_table" class="table dataTable-collapse text-center">
                                <thead>
                                <tr>
                                    <th scope="col" style="width: 40%">PRODUTO</th>
                                    <th scope="col" style="width: 10%">QT. TOTAL</th>
                                    <th scope="col" style="width: 25%">AREA</th>
                                    <th scope="col" style="width: 25%">LOCALIZAÇÃO</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    @foreach($data['estoque'] as $estoque)
                                        <td style="width: 10%"><b>{{ $estoque->nome }}</b></td>
                                        <td style="width: 10%">{{ $estoque->quantidade_total }}</td>
                                        <td style="width: 25%"><b>{{ (isset($estoque->lugar)) ? $estoque->lugar : 'Não Informado' }}</b></td>
                                        <td style="width: 25%">{{ (isset($estoque->localizacao)) ? $estoque->localizacao : 'Não Informado' }}</td>

                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
{{--                        <button type="submit" class="btn btn-primary">Criar Cargo</button>--}}
                    </div>

            </div>
        </div>
    </div>

    <!-- modal saida do estoque -->
    <div class="modal fade" id="verifyModalContentSaidaEstoque" tabindex="-1" role="dialog"
         aria-labelledby="verifyModalContent" aria-hidden="true" style="display: none;">
        <div class="modal-lg modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verifyModalContent_title">Consultar Estoque</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="table-responsive">

                        <table id="sales_table" class="table dataTable-collapse text-center">
                            <thead>
                            <tr>
                                <th scope="col" style="width: 40%">PRODUTO</th>
                                <th scope="col" style="width: 10%">QT. TOTAL</th>
                                <th scope="col" style="width: 25%">AREA</th>
                                <th scope="col" style="width: 25%">LOCALIZAÇÃO</th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                @foreach($data['estoque'] as $estoque)
                                    <td style="width: 10%"><b>{{ $estoque->nome }}</b></td>
                                    <td style="width: 10%">{{ $estoque->quantidade_total }}</td>
                                    <td style="width: 25%"><b>{{ $estoque->lugar }}</b></td>
                                    <td style="width: 25%">{{ $estoque->localizacao }}</td>

                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    {{--                        <button type="submit" class="btn btn-primary">Criar Cargo</button>--}}
                </div>

            </div>
        </div>
    </div>
@endsection
