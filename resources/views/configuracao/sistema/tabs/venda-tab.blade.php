<div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="sistema[default_venda_create_status]">
                    Status Padrão Nova Venda
                    <i
                        data-container="body"
                        data-toggle="popover"
                        data-placement="top"
                        data-content="Status que sera carregado por padrão na criação de uma nova Venda."
                        class="data_info fas fa-exclamation-circle"
                    ></i>
                </label>
                {!! html()->select('sistema[default_venda_create_status]', \App\Models\Configuracao\Parametro\Status::where('venda', 1)->orderBy('name')->pluck('name', 'id'), getConfig('default_venda_create_status'))->class('form-control')->placeholder('Selecione') !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="sistema[default_venda_faturar_produto_despesa]">
                    Tipo de despesa Padrão
                    <i
                        data-container="body"
                        data-toggle="popover"
                        data-placement="top"
                        data-content="Tipo de despesa padrão para os produtos quando for faturada uma nova Venda"
                        class="data_info fas fa-exclamation-circle"
                    ></i>
                </label>
                {!! html()->select('sistema[default_venda_faturar_produto_despesa]', \App\Models\Configuracao\Financeiro\FormaPagamento::orderBy('name')->pluck('name', 'id'), getConfig('default_venda_faturar_produto_despesa'))->class('form-control')->placeholder('Selecione') !!}
                <i></i>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="sistema[default_venda_create_garantia]">
                    Garantia Padrão
                    <i
                        data-container="body"
                        data-toggle="popover"
                        data-placement="top"
                        data-content="Garantia que sera carregada por padrão na criação de uma nova Venda"
                        class="data_info fas fa-exclamation-circle"
                    ></i>
                </label>
                {!! html()->select('sistema[default_venda_create_garantia]', \App\Models\Configuracao\Garantia\Garantia::where('venda', 1)->orderBy('name')->pluck('name', 'id'), getConfig('default_venda_create_garantia'))->class('form-control')->placeholder('Selecione') !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="sistema[default_venda_faturar_centro_custo]">
                    Centro de custo Padrão
                    <i
                        data-container="body"
                        data-toggle="popover"
                        data-placement="top"
                        data-content="Centro de custo padrão que será carregado ao faturar uma venda"
                        class="data_info fas fa-exclamation-circle"
                    ></i>
                </label>
                {!! html()->select('sistema[default_venda_faturar_centro_custo]', \App\Models\Configuracao\Financeiro\CentroCusto::orderBy('name')->where('receita', '1')->pluck('name', 'id'), getConfig('default_venda_faturar_centro_custo'))->class('form-control')->placeholder('Selecione o Centro de Custo') !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="sistema[default_venda_faturar]">
                    Status Venda ao Faturar
                    <i
                        data-container="body"
                        data-toggle="popover"
                        data-placement="top"
                        data-content="Quando a Venda for faturada ela irá receber esse status se não for recebido nenhum valor"
                        class="data_info fas fa-exclamation-circle"
                    ></i>
                </label>
                {!! html()->select('sistema[default_venda_faturar]', \App\Models\Configuracao\Parametro\Status::where('venda', 1)->orderBy('name')->pluck('name', 'id'), getConfig('default_venda_faturar'))->class('form-control')->placeholder('Não alterar status') !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="sistema[default_venda_faturar_pagto_parcial]">
                    Status Venda Pagto. em Aberto
                    <i
                        data-container="body"
                        data-toggle="popover"
                        data-placement="top"
                        data-content="Quando a Venda for faturada ela irá receber esse status se o valor do pagamento for menor do que o valor total da Venda"
                        class="data_info fas fa-exclamation-circle"
                    ></i>
                </label>
                {!! html()->select('sistema[default_venda_faturar_pagto_parcial]', \App\Models\Configuracao\Parametro\Status::where('venda', 1)->orderBy('name')->pluck('name', 'id'), getConfig('default_venda_faturar_pagto_parcial'))->class('form-control')->placeholder('Não alterar status') !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="sistema[default_venda_faturar_pagto_quitado]">
                    Status Venda ao ser Quitada
                    <i
                        data-container="body"
                        data-toggle="popover"
                        data-placement="top"
                        data-content="Quando a Venda for faturada ela irá receber esse status se o valor do pagamento igual ou maior do que o valor da Venda"
                        class="data_info fas fa-exclamation-circle"
                    ></i>
                </label>
                {!! html()->select('sistema[default_venda_faturar_pagto_quitado]', \App\Models\Configuracao\Parametro\Status::where('venda', 1)->orderBy('name')->pluck('name', 'id'), getConfig('default_venda_faturar_pagto_quitado'))->class('form-control')->placeholder('Não alterar status') !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label for="sistema[venda_informacao]">
                    Informações
                    <i
                        data-container="body"
                        data-toggle="popover"
                        data-placement="top"
                        data-content="Esse campo fica no fim da Venda impressa"
                        class="data_info fas fa-exclamation-circle"
                    ></i>
                </label>
                {!! html()->textarea('sistema[venda_informacao]', getConfig('venda_informacao'))->class('form-control textarea')->placeholder('Informações no rodapé da Venda') !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="sistema[venda_listagem_padrao]">
                    Exibição padrão de Venda
                    <i
                        data-container="body"
                        data-toggle="popover"
                        data-placement="top"
                        data-content="Itens exibidos por padrão na listagem de Venda, sem filtros"
                        class="data_info fas fa-exclamation-circle"
                    ></i>
                </label>
                @php
                    $vendaListagemPadrao =  getConfig('venda_listagem_padrao')
                @endphp
                @foreach (App\Models\Configuracao\Parametro\Status::where('venda', 1)->orderBy('name')->get() as $item)
                    <div class="custom-control custom-checkbox">
                        <input name="sistema[venda_listagem_padrao][]" @checked((is_array($vendaListagemPadrao)) ? in_array($item->id, $vendaListagemPadrao) : null) class="custom-control-input" type="checkbox" id="venda_list_{{ $item->id }}" value="{{ $item->id }}">
                        <label for="venda_list_{{ $item->id }}" class="custom-control-label">{{ $item->name }}</label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
