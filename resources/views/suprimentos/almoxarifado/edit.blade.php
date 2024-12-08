@extends('admin.main_master')

@section('scripts')
    /*
    * Chained - jQuery / Zepto chained selects plugin
    *
    * Copyright (c) 2010-2017 Mika Tuupola
    *
    * Licensed under the MIT license:
    *   http://www.opensource.org/licenses/mit-license.php
    *
    * Project home:
    *   http://www.appelsiini.net/projects/chained
    *
    * Version: 2.0.0-beta.3
    *
    */

    ;(function($, window, document, undefined) {
    "use strict";

    $.fn.chained = function(parentSelector) {
    return this.each(function() {

    /* Save this to child because this changes when scope changes. */
    var child   = this;
    var backup = $(child).clone();

    /* Handles maximum two parents now. */
    $(parentSelector).each(function() {
    $(this).bind("change", function() {
    updateChildren();
    });

    /* Force IE to see something selected on first page load, */
    /* unless something is already selected */
    if (!$("option:selected", this).length) {
    $("option", this).first().attr("selected", "selected");
    }

    /* Force updating the children. */
    updateChildren();
    });

    function updateChildren() {
    var triggerChange = true;
    var currentlySelectedValue = $("option:selected", child).val();

    $(child).html(backup.html());

    /* If multiple parents build value like foo+bar. */
    var selected = "";
    $(parentSelector).each(function() {
    var selectedValue = $("option:selected", this).val();
    if (selectedValue) {
    if (selected.length > 0) {
    selected += "+";
    }
    selected += selectedValue;
    }
    });

    /* Also check for first parent without subclassing. */
    /* TODO: This should be dynamic and check for each parent */
    /*       without subclassing. */
    var first;
    if ($.isArray(parentSelector)) {
    first = $(parentSelector[0]).first();
    } else {
    first = $(parentSelector).first();
    }
    var selectedFirst = $("option:selected", first).val();

    $("option", child).each(function() {
    /* Always leave the default value in place. */
    if ($(this).val() === "") {
    return;
    }
    var matches = [];
    var data = String($(this).data("chained"));
    if (data) {
    matches = data.split(" ");
    }
    if ((matches.indexOf(selected) > -1) || (matches.indexOf(selectedFirst) > -1)) {
    if ($(this).val() === currentlySelectedValue) {
    $(this).prop("selected", true);
    triggerChange = false;
    }
    } else {
    $(this).remove();
    }
    });

    /* If we have only the default value disable select. */
    if (1 === $("option", child).length && $(child).val() === "") {
    $(child).prop("disabled", true);
    } else {
    $(child).prop("disabled", false);
    }
    if (triggerChange) {
    $(child).trigger("change");
    }
    }
    });
    };

    /* Alias for those who like to use more English like syntax. */
    $.fn.chainedTo = $.fn.chained;

    /* Default settings for plugin. */
    $.fn.chained.defaults = {};

    })(window.jQuery || window.Zepto, window, document);

@endsection

@section('main')

@php //dd($produto); @endphp
    <!-- Editar Produto -->
    <div class="col-md mt-3">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="w-50 float-left card-title m-0">Código do Produto : {{ $produto->codprod }} | {{ $produto->produto }}</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('almoxarifado.update', $produto->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="recipient-name-2" class="col-form-label">Localização</label>
                                <select name="estoque_local_id" id="estoque_local_id" class="form-control" required>
                                    <option value="" selected>---Selecione---</option>
                                    @foreach($localizacao as $local)
                                        <option value="{{ $local->id }}" {{ ($local->id == $produto->localizacao_id) ? 'selected' : '' }}>{{ $local->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="recipient-name-2" class="col-form-label">Quantidade Total</label>
                                <input type="number" id="quantidade_total" name="quantidade_total" class="form-control" min="1" max="99999" value="{{ $produto->quantidade_total }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="recipient-name-2" class="col-form-label">Qt. Minimo</label>
                                <input type="number" class="form-control" id="qt_minima" name="qt_minima" min="1" max="99999" value="{{ $produto->qt_minima }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="recipient-name-2" class="col-form-label">Qt. Reposição</label>
                                <input type="number" class="form-control" id="qt_reposicao" name="qt_reposicao" min="1" max="99999" value="{{ $produto->qt_reposicao }}" required>
                            </div>
                        </div>
{{--                        <div class="form-group">--}}
{{--                            <label for="recipient-name-2" class="col-form-label">Descrição</label>--}}
{{--                            <textarea class="form-control" id="descricao" name="descricao"> {{ $produto->descricao }}</textarea>--}}
{{--                        </div>--}}
                    </div>
                    <a href="{{ route('almoxarifado.index') }}" class="btn float-right btn-primary ml-3">
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

