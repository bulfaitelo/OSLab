<div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="sistema[default_venda_create_status]">Status Padrão Venda</label>
                {!! html()->select('sistema[default_venda_create_status]', \App\Models\Configuracao\Parametro\Status::where('venda', 1)->orderBy('name')->pluck('name', 'id'), getConfig('default_venda_create_status'))->class('form-control')->placeholder('Selecione') !!}
                <i>Status que sera carregado por padrão na criação de uma nova Venda </i>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="sistema[default_venda_faturar_produto_despesa]">Tipo de despesa Padrão</label>
                {!! html()->select('sistema[default_venda_faturar_produto_despesa]', \App\Models\Configuracao\Financeiro\FormaPagamento::orderBy('name')->pluck('name', 'id'), getConfig('default_venda_faturar_produto_despesa'))->class('form-control')->placeholder('Selecione') !!}
                <i>Tipo de despesa padrão para os produtos quando for faturada uma nova Venda</i>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="sistema[default_venda_faturar]">Status Venda ao Faturar </label>
                {!! html()->select('sistema[default_venda_faturar]', \App\Models\Configuracao\Parametro\Status::where('venda', 1)->orderBy('name')->pluck('name', 'id'), getConfig('default_venda_faturar'))->class('form-control')->placeholder('Não alterar status') !!}
                <i>Quando a Venda for faturada ela irá receber esse status se não for recebido nenhum valor</i>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="sistema[default_venda_faturar_pagto_parcial]">Status Venda Pagto. em Aberto</label>
                {!! html()->select('sistema[default_venda_faturar_pagto_parcial]', \App\Models\Configuracao\Parametro\Status::where('venda', 1)->orderBy('name')->pluck('name', 'id'), getConfig('default_venda_faturar_pagto_parcial'))->class('form-control')->placeholder('Não alterar status') !!}
                <i>Quando a Venda for faturada ela irá receber esse status se o valor do pagamento for menor do que o valor total da Venda </i>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="sistema[default_venda_faturar_pagto_quitado]">Status Venda ao ser Quitada</label>
                {!! html()->select('sistema[default_venda_faturar_pagto_quitado]', \App\Models\Configuracao\Parametro\Status::where('venda', 1)->orderBy('name')->pluck('name', 'id'), getConfig('default_venda_faturar_pagto_quitado'))->class('form-control')->placeholder('Não alterar status') !!}
                <i>Quando a Venda for faturada ela irá receber esse status se o valor do pagamento igual ou maior do que o valor da Venda</i>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label for="sistema[venda_informacao]">Informações</label>
                {!! html()->textarea('sistema[venda_informacao]', getConfig('venda_informacao'))->class('form-control textarea')->placeholder('Informações no rodapé da Venda') !!}
                <i>Esse campo fica no fim da Venda impressa.</i>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="sistema[venda_listagem_padrao]">Exibição padrão de Venda</label>
                @php
                    $osListagemPadrao =  getConfig('venda_listagem_padrao')
                @endphp
                @foreach (App\Models\Configuracao\Parametro\Status::where('venda', 1)->orderBy('name')->get() as $item)
                    <div class="custom-control custom-checkbox">
                        <input name="sistema[venda_listagem_padrao][]" @checked((is_array($osListagemPadrao)) ? in_array($item->id, $osListagemPadrao) : null) class="custom-control-input" type="checkbox" id="venda_list_{{ $item->id }}" value="{{ $item->id }}">
                        <label for="venda_list_{{ $item->id }}" class="custom-control-label">{{ $item->name }}</label>
                    </div>
                @endforeach
                <i>Itens exibidos por padrão na listagem de Venda, sem filtros.</i>
            </div>
        </div>
    </div>
</div>
