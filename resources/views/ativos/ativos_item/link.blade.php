@extends('admin.main_master')

@section('style')
    <style>
        [x-cloak] { display: none !important; }
    </style>
@endsection

@section('scripts')
    <script src="https://unpkg.com/alpinejs@3.1.x/dist/cdn.min.js" defer></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('app', () => ({
                states:getStates(),
                state:null,
                city:null,
                cities() {
                    return getCities(this.state);
                }
            }))
        });

        const getStates = () => {
            return [
                @foreach($ativosModeloItens->groupby('ativo_modelo_id') as $atm_itens)
                    @php  $ativo_id = null; @endphp
                    @php $lista_itens = []; @endphp
                    @foreach($atm_itens as $item)
                        @php
                          $ativo_id = $item->ativo_modelo_id; //dd($listItens->where('id',3)->first()->nome);
                          if(empty($item->item_id))
                              continue;
                         //dd($item->item_id);

                                 $lista_itens[] =  strtoupper($listItens->where('id',$item->item_id)->first()->nome); // $item->item_id;
                        @endphp
                    @endforeach
                    @php
                        if(empty($lista_itens)){
                           // $lista_itens[] = [];
                        }
                        $value = [ "id" => $ativo_id, "label" => "abc", "city" => $lista_itens ];
                        echo json_encode($value).',';
                    @endphp

                {{--{{ '{id:'.$ativo_id.', label: "abc", city:'.$lista_itens.'},' }}--}}
                {{--{id:1, label:"Alabama", city:[ "{{ 'Alabama:'.$i }}" ]},--}}
                {{--{id:2, label:"California", city:["{{ 'texas:'.$i }}"]},--}}
                @endforeach
            ]
        }

        const getCities = (id) => {
            if(!id) return [];
            let state = (getStates()).find(i => i.id === parseInt(id,10));
            let result = [];
            for(let i=0; i<state.city.length; i++) {
                result.push({id:i, label:`${state.city[i]}`});
            }
            return result;
        }

        /*
        generates fake cities, later states have more values

        const getCities = (id) => {
            if(!id) return [];
            let state = (getStates()).find(i => i.id === parseInt(id,10));
            let result = [];
            for(let i=0; i<(id*2); i++) {
                result.push({id:i, label:`${state.city}`});
            }
            return result;
        }*/
    </script>
@endsection
@section('main')
    <div class="col-lg" x-data="app" x-cloak>
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
                            <select id="ativo" name="ativo" class="form-control" required="true" size="20" x-model="state">
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
                            <select id="ativo" name="itens_ativo" class="form-control" readonly size="20" x-model="city">
                                <template x-for="city in cities">
                                    <option :value="city.id"><span x-text="city.label"></span></option>
                                </template>
                            </select>
                        </div>

                    </div>
                    <button type="submit" class="btn float-right btn-primary">Salvar</button>
                </div>

            </div>
        </form>
    </div>
@endsection
