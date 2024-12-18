@extends('admin.main_master')

@section('scripts')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        function handler() {
            return {
                fields: [],
                addNewField() {
                    this.fields.push({
                        txt1: '',
                        txt2: ''
                    });
                },
                removeField(index) {
                    this.fields.splice(index, 1);
                }
            }
        }
    </script>
@endsection

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

    <!-- Gestao solicitacoes Compra -->
    <div class="col-md">
        <div class="card o-hidden mb-4">
            <div class="card-header d-flex align-items-center">
                <h3 class="w-50 float-left card-title m-0">Solicitar Compra de Produtos ( {{ $codigo_solicitacao_compra }} )</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('almoxarifado.solicitacao.compras.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="codigo_solicitacao_compra" value="{{ $codigo_solicitacao_compra }}">
                    <input type="hidden" name="responsavel_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="os_solicita_produto_id" value="{{ $os_solicita_produto_id }}">


                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="recipient-name-2" class="col-form-label">Prioridade</label>
                                <select name="prioridade_id" id="prioridade_id" class="form-control" required>
                                    <option value="" >--Selecione--</option>
                                    @foreach($prioridades as $prioridade)
                                        <option value="{{ $prioridade->id }}" >{{ $prioridade->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 mt-2">
                                <label for="recipient-name-2" class="col-form-label">Informações Adicionais da Solicitação:</label>
                                <textarea class="form-control" id="solicitacao" name="solicitacao" rows="5" required></textarea>
                            </div>
                          </div>


                        <div class="row" x-data="handler()">
                            <div class="col-md-12 mt-4">
                                <label for="recipient-name-2" class="col-form-label">Saida de Produtos do Estoque</label>
                                <table class="table table-bordered align-items-center table-sm">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Produto / Item</th>
                                        <th>Quantidade</th>
                                        <th>Remover</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <template x-for="(field, index) in fields" :key="index">
                                        <tr>
                                            <td x-text="index + 1"></td>
                                            <td>
                                                {{--                                        <input x-model="field.txt1" type="text" name="txt1[]" class="form-control">--}}
                                                <select  x-model="field.txt1" class="form-control"  name="txt1[]" required>
                                                    <option value="" selected>---Selecione---</option>
                                                    @foreach($produtos as $prod)
                                                        <option value="{{ $prod->id }}">{{ $prod->nome }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input x-model="field.txt2" type="number" name="txt2[]" class="form-control" min="1" max="9999" required></td>
                                            <td><button type="button" class="btn btn-danger btn-small" @click="removeField(index)">&times;</button></td>
                                        </tr>
                                    </template>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="4" class="text-right"><button type="button" class="btn btn-info" @click="addNewField()">+ Adicionar Produto</button></td>
                                    </tr>
                                    </tfoot>
                                </table>

                            </div>
                        </div>

                    </div>
                    <a href="{{ url()->previous() }}" class="btn float-right btn-primary ml-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5"></path>
                        </svg>
                        Voltar
                    </a>
                    <button type="submit" class="btn float-right btn-primary ml-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-dotted" viewBox="0 0 16 16">
                            <path d="M8 0q-.264 0-.523.017l.064.998a7 7 0 0 1 .918 0l.064-.998A8 8 0 0 0 8 0M6.44.152q-.52.104-1.012.27l.321.948q.43-.147.884-.237L6.44.153zm4.132.271a8 8 0 0 0-1.011-.27l-.194.98q.453.09.884.237zm1.873.925a8 8 0 0 0-.906-.524l-.443.896q.413.205.793.459zM4.46.824q-.471.233-.905.524l.556.83a7 7 0 0 1 .793-.458zM2.725 1.985q-.394.346-.74.74l.752.66q.303-.345.648-.648zm11.29.74a8 8 0 0 0-.74-.74l-.66.752q.346.303.648.648zm1.161 1.735a8 8 0 0 0-.524-.905l-.83.556q.254.38.458.793l.896-.443zM1.348 3.555q-.292.433-.524.906l.896.443q.205-.413.459-.793zM.423 5.428a8 8 0 0 0-.27 1.011l.98.194q.09-.453.237-.884zM15.848 6.44a8 8 0 0 0-.27-1.012l-.948.321q.147.43.237.884zM.017 7.477a8 8 0 0 0 0 1.046l.998-.064a7 7 0 0 1 0-.918zM16 8a8 8 0 0 0-.017-.523l-.998.064a7 7 0 0 1 0 .918l.998.064A8 8 0 0 0 16 8M.152 9.56q.104.52.27 1.012l.948-.321a7 7 0 0 1-.237-.884l-.98.194zm15.425 1.012q.168-.493.27-1.011l-.98-.194q-.09.453-.237.884zM.824 11.54a8 8 0 0 0 .524.905l.83-.556a7 7 0 0 1-.458-.793zm13.828.905q.292-.434.524-.906l-.896-.443q-.205.413-.459.793zm-12.667.83q.346.394.74.74l.66-.752a7 7 0 0 1-.648-.648zm11.29.74q.394-.346.74-.74l-.752-.66q-.302.346-.648.648zm-1.735 1.161q.471-.233.905-.524l-.556-.83a7 7 0 0 1-.793.458zm-7.985-.524q.434.292.906.524l.443-.896a7 7 0 0 1-.793-.459zm1.873.925q.493.168 1.011.27l.194-.98a7 7 0 0 1-.884-.237zm4.132.271a8 8 0 0 0 1.012-.27l-.321-.948a7 7 0 0 1-.884.237l.194.98zm-2.083.135a8 8 0 0 0 1.046 0l-.064-.998a7 7 0 0 1-.918 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                        </svg>
                        &nbsp;
                        Abrir Solicitação</button>

                </form>

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
{{--                                    @foreach($data['estoque'] as $estoque)--}}
{{--                                        <td style="width: 10%"><b>{{ $estoque->nome }}</b></td>--}}
{{--                                        <td style="width: 10%">{{ $estoque->quantidade_total }}</td>--}}
{{--                                        <td style="width: 25%"><b>{{ (isset($estoque->lugar)) ? $estoque->lugar : 'Não Informado' }}</b></td>--}}
{{--                                        <td style="width: 25%">{{ (isset($estoque->localizacao)) ? $estoque->localizacao : 'Não Informado' }}</td>--}}

{{--                                </tr>--}}
{{--                                @endforeach--}}
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

{{--                                @foreach($data['estoque'] as $estoque)--}}
{{--                                    <tr>--}}
{{--                                    <td style="width: 10%"><b>{{ $estoque->nome }}</b></td>--}}
{{--                                    <td style="width: 10%">{{ $estoque->quantidade_total }}</td>--}}
{{--                                    <td style="width: 25%"><b>{{ $estoque->lugar }}</b></td>--}}
{{--                                    <td style="width: 25%">{{ $estoque->localizacao }}</td>--}}

{{--                                    </tr>--}}
{{--                            @endforeach--}}

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
