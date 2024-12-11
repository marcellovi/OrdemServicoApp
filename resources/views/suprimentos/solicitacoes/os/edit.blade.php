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

        <button type="button" class="btn btn-info m-1" data-toggle="modal" data-target="#verifyModalContentConsultaEstoque"
                data-whatever="@mdo">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
            </svg>
            <span class="ul-btn__text">&nbsp;Consultar Estoque</span>
        </button>
        <button type="button" class="btn btn-info m-1" data-toggle="modal" data-target="#verifyModalContentCargo"
                data-whatever="@mdo">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
                <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73z"/>
            </svg>
            <span class="ul-btn__text">&nbsp; Solicitar Compra</span>
        </button>
    </div>

    <!-- Editar Produto -->
    <div class="col-md mt-3">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="w-50 float-left card-title m-0">Solicitação Código : {{ $solicitacao->codospedido }}</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('almoxarifado.saida.estoque.store', $solicitacao->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="recipient-name-2" class="col-form-label">Itens</label>
                                <input type="text" id="itens" name="itens" class="form-control" value="{{ $solicitacao->itens }}" readonly>
                            </div>
                            <div class="col-md-12 mt-2">
                                <label for="recipient-name-2" class="col-form-label">Informações :</label>
                                <textarea class="form-control" id="descricao" name="descricao"> {{ $solicitacao->descritivo }}</textarea>
                            </div>
{{--                            <div class="col-md-4">--}}
{{--                                <label for="recipient-name-2" class="col-form-label">Qt. Reposição</label>--}}
{{--                                <input type="text" class="form-control" id="qt_reposicao" name="qt_reposicao" value="{{ $solicitacao->descritivo }}">--}}
{{--                            </div>--}}
{{--                            <div class="col-md-12">--}}
{{--                                <label for="recipient-name-2" class="col-form-label">Nome</label>--}}
{{--                                <input type="text" class="form-control" id="nome" name="nome" value="{{ $solicitacao->id }}">--}}
{{--                            </div>--}}
{{--                            <div class="col-md-4 mt-1">--}}
{{--                                <label for="recipient-name-2" class="col-form-label">Categoria</label>--}}
{{--                                <select name="categoria_id" id="categoria_id" class="form-control" required>--}}
{{--                                    <option value="" selected>---Selecione---</option>--}}
{{--                                        @foreach($assets['categorias'] as $categoria)--}}
{{--                                            <option value="{{ $categoria->id }}" {{ ($categoria->id == $produto->categoria_id) ? 'selected' : '' }}>{{ $categoria->nome }}</option>--}}
{{--                                        @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-4 mt-1">--}}
{{--                                <label for="recipient-name-2" class="col-form-label">Fabricante</label>--}}
{{--                                <select name="fabricante_id" id="fabricante_id" class="form-control" required>--}}
{{--                                    <option value="" selected>---Selecione---</option>--}}
{{--                                        @foreach($assets['fabricantes'] as $fabricante)--}}
{{--                                            <option--}}
{{--                                                value="{{ $fabricante->id }}" {{ ($fabricante->id == $produto->fabricante_id) ? 'selected' : '' }}>{{ $fabricante->nome }}</option>--}}
{{--                                        @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-4 mt-1">--}}
{{--                                <label for="recipient-name-2" class="col-form-label">Unid. Medida</label>--}}
{{--                                <select name="unid_medida_id" id="unid_medida_id" class="form-control">--}}
{{--                                    <option value="" selected>---Nenhum---</option>--}}
{{--                                            @foreach($assets['unidade_medida'] as $unid_medida)--}}
{{--                                                <option value="{{ $unid_medida->id }}" {{ ($unid_medida->id == $produto->unid_medida_id) ? 'selected' : '' }}>{{ $unid_medida->nome }}</option>--}}
{{--                                            @endforeach--}}
{{--                               </select>--}}
{{--                            </div>--}}
                        </div>
                        <div class="row" x-data="handler()">
                            <div class="col-md-12 mt-4">

                            <table class="table table-bordered align-items-center table-sm">
                            <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Produto / Item</th>
                                <th>Produto / Item</th>
                                <th>Remover</th>
                            </tr>
                            </thead>
                            <tbody>
                            <template x-for="(field, index) in fields" :key="index">
                                <tr>
                                    <td x-text="index + 1"></td>
                                    <td><input x-model="field.txt1" type="text" name="txt1[]" class="form-control"></td>
                                    <td><input x-model="field.txt2" type="text" name="txt2[]" class="form-control"></td>
                                    <td><button type="button" class="btn btn-danger btn-small" @click="removeField(index)">&times;</button></td>
                                </tr>
                            </template>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="4" class="text-right"><button type="button" class="btn btn-info" @click="addNewField()">+ Adicionar Linha</button></td>
                            </tr>
                            </tfoot>
                        </table>

                            </div>
                        </div>

                    </div>
                    <a href="{{ route('almoxarifado.solicitacao.show') }}" class="btn float-right btn-primary ml-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5"></path>
                        </svg>
                        Voltar
                    </a>
                    <button type="submit" class="btn float-right btn-primary ml-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-circle-dotted" viewBox="0 0 16 16">
                            <path d="M8 0q-.264 0-.523.017l.064.998a7 7 0 0 1 .918 0l.064-.998A8 8 0 0 0 8 0M6.44.152q-.52.104-1.012.27l.321.948q.43-.147.884-.237L6.44.153zm4.132.271a8 8 0 0 0-1.011-.27l-.194.98q.453.09.884.237zm1.873.925a8 8 0 0 0-.906-.524l-.443.896q.413.205.793.459zM4.46.824q-.471.233-.905.524l.556.83a7 7 0 0 1 .793-.458zM2.725 1.985q-.394.346-.74.74l.752.66q.303-.345.648-.648zm11.29.74a8 8 0 0 0-.74-.74l-.66.752q.346.303.648.648zm1.161 1.735a8 8 0 0 0-.524-.905l-.83.556q.254.38.458.793l.896-.443zM1.348 3.555q-.292.433-.524.906l.896.443q.205-.413.459-.793zM.423 5.428a8 8 0 0 0-.27 1.011l.98.194q.09-.453.237-.884zM15.848 6.44a8 8 0 0 0-.27-1.012l-.948.321q.147.43.237.884zM.017 7.477a8 8 0 0 0 0 1.046l.998-.064a7 7 0 0 1 0-.918zM16 8a8 8 0 0 0-.017-.523l-.998.064a7 7 0 0 1 0 .918l.998.064A8 8 0 0 0 16 8M.152 9.56q.104.52.27 1.012l.948-.321a7 7 0 0 1-.237-.884l-.98.194zm15.425 1.012q.168-.493.27-1.011l-.98-.194q-.09.453-.237.884zM.824 11.54a8 8 0 0 0 .524.905l.83-.556a7 7 0 0 1-.458-.793zm13.828.905q.292-.434.524-.906l-.896-.443q-.205.413-.459.793zm-12.667.83q.346.394.74.74l.66-.752a7 7 0 0 1-.648-.648zm11.29.74q.394-.346.74-.74l-.752-.66q-.302.346-.648.648zm-1.735 1.161q.471-.233.905-.524l-.556-.83a7 7 0 0 1-.793.458zm-7.985-.524q.434.292.906.524l.443-.896a7 7 0 0 1-.793-.459zm1.873.925q.493.168 1.011.27l.194-.98a7 7 0 0 1-.884-.237zm4.132.271a8 8 0 0 0 1.012-.27l-.321-.948a7 7 0 0 1-.884.237l.194.98zm-2.083.135a8 8 0 0 0 1.046 0l-.064-.998a7 7 0 0 1-.918 0zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1z"/>
                        </svg>
                        &nbsp;
                        Saida Produto</button>



                </form>
            </div>
        </div>
    </div>
    <!-- End  -->

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

