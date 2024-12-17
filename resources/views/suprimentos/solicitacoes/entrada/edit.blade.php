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
                        txt2: '',
                        txt3: ''
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

{{--    <div class="mb-4 col-md-12 mt-3" align="right">--}}

{{--        <button type="button" class="btn btn-info m-1" data-toggle="modal" data-target="#verifyModalContentConsultaEstoque"--}}
{{--                data-whatever="@mdo">--}}
{{--            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">--}}
{{--                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>--}}
{{--            </svg>--}}
{{--            <span class="ul-btn__text">&nbsp;Consultar Estoque</span>--}}
{{--        </button>--}}
{{--        <button type="button" class="btn btn-info m-1" data-toggle="modal" data-target="#verifyModalContentCargo"--}}
{{--                data-whatever="@mdo">--}}
{{--            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">--}}
{{--                <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73z"/>--}}
{{--            </svg>--}}
{{--            <span class="ul-btn__text">&nbsp; Solicitar Compra</span>--}}
{{--        </button>--}}
{{--    </div>--}}

    <!-- Editar Produto -->
    <div class="col-md mt-3">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="w-50 float-left card-title m-0">Entrada de Produtos no Estoque</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('almoxarifado.compras.entrada.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="solicitacao_id" value="{{ $produtos_solicitados[0]->solicitacao_compra_id }}">
                    <input type="hidden" name="responsavel_id" value="{{ Auth::user()->id }}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="recipient-name-2" class="col-form-label">Num. Nota Fiscal</label>
                                <input type="text" id="num_nf" name="num_nf" class="form-control">
                            </div>
                                <div class="col-md-3">
                                    <label for="recipient-name-2" class="col-form-label">Imposto</label>
                                    <input type="number" id="imposto" name="imposto" class="form-control" min="0" step="any">
                                </div>
                            <div class="col-md-3">
                                <label for="recipient-name-2" class="col-form-label">Frete</label>
                                <input type="number" id="frete" name="frete" class="form-control" min="0" step="any">
                            </div>
                            <div class="col-md-3">
                                <label for="recipient-name-2" class="col-form-label">Total</label>
                                <input type="number" id="total" name="total" class="form-control" min="0" step="any" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-4">
                                <label for="recipient-name-2" class="col-form-label">Produtos Solicitados</label>
                                <table class="table table-bordered align-items-center table-sm">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Produto / Item</th>
                                        <th>Quantidade</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($produtos_solicitados as $key => $prod)
                                        <tr>
                                            <td>{{ $key }}</td>
                                                <td><input type="text" name="produto{{$key}}" class="form-control" value="{{ $prod->nome }}" readonly></td>
                                                <td><input type="text" name="qt{{$key}}" class="form-control" value="{{ $prod->quantidade }}" readonly></td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>

                            </div>
                        </div>

                        <div class="row" x-data="handler()">
                            <div class="col-md-12 mt-4">
                                <label for="recipient-name-2" class="col-form-label">Entrada de Produtos</label>
                                <table class="table table-bordered align-items-center table-sm">
                                    <thead class="thead-light">
                                    <tr>
                                        <th style="width: 5%">#</th>
                                        <th style="width: 45%">Produto / Item</th>
                                        <th style="width: 20%">Quantidade</th>
                                        <th style="width: 20%">Valor</th>
                                        <th style="width: 10%">Remover</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <template x-for="(field, index) in fields" :key="index">
                                        <tr>
                                            <td x-text="index + 1" style="width: 5%"></td>
                                            <td style="width: 45%">
                                                {{--                                        <input x-model="field.txt1" type="text" name="txt1[]" class="form-control">--}}
                                                <select  x-model="field.txt1" class="form-control"  name="txt1[]" required>
                                                    <option value="" selected>---Selecione---</option>
                                                    @foreach($produtos as $prod)
                                                        <option value="{{ $prod->id }}">{{ $prod->nome }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td style="width: 20%"><input x-model="field.txt2" type="number" name="txt2[]" class="form-control" min="1" step="1" required></td>
                                            <td style="width: 20%"><input x-model="field.txt3" type="number" name="txt3[]" class="form-control" min="1" step="any" required></td>
                                            <td style="width: 10%"><button type="button" class="btn btn-danger btn-small" @click="removeField(index)">&times;</button></td>
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
                        <a href="{{ url()->previous() }}" class="btn float-right btn-primary ml-3"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5"></path>
                            </svg>
                            Voltar</a>
                        <button type="submit" class="btn float-right btn-primary ml-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy" viewBox="0 0 16 16">
                                <path d="M11 2H9v3h2z"/>
                                <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z"/>
                            </svg>&nbsp;&nbsp;
                            Salvar</button>
                    </div>
        </div>
    </div>
@endsection

