<div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="sistema[default_os_create_status]">
                    Status Padrão Nova Ordem de Serviço
                    <i
                        data-container="body"
                        data-toggle="popover"
                        data-placement="top"
                        data-content="Status que sera carregado por padrão na criação de uma nova Ordem de Serviço"
                        class="data_info fas fa-exclamation-circle"
                    ></i>
                </label>
                {!! html()->select('sistema[default_os_create_status]', \App\Models\Configuracao\Parametro\Status::where('os', 1)->orderBy('name')->pluck('name', 'id'), getConfig('default_os_create_status'))->class('form-control')->placeholder('Selecione') !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="sistema[os_link_time_limit]">
                    Tempo da validade do Link: <output id="tempo_link_label">{{getConfig('os_link_time_limit')}}</output> Minutos
                    <i
                        data-container="body"
                        data-toggle="popover"
                        data-placement="top"
                        data-content="Esse parâmetro define o tempo máximo de validade do link caso o cliente não preencha"
                        class="data_info fas fa-exclamation-circle"
                    ></i>
                </label>
                <input type="range" name="sistema[os_link_time_limit]" value="{{getConfig('os_link_time_limit')}}" min="1" max="60" step="1" class="custom-range" id="tempo_link" oninput="tempo_link_label.value = tempo_link.value">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="sistema[default_os_faturar_produto_despesa]">
                    Tipo de despesa Padrão
                    <i
                        data-container="body"
                        data-toggle="popover"
                        data-placement="top"
                        data-content="Tipo de despesa padrão para os produtos quando for faturada uma nova Ordem de Serviço"
                        class="data_info fas fa-exclamation-circle"
                    ></i>
                </label>
                {!! html()->select('sistema[default_os_faturar_produto_despesa]', \App\Models\Configuracao\Financeiro\FormaPagamento::orderBy('name')->pluck('name', 'id'), getConfig('default_os_faturar_produto_despesa'))->class('form-control')->placeholder('Selecione') !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="sistema[default_os_faturar]">
                    Status OS ao Faturar
                    <i
                        data-container="body"
                        data-toggle="popover"
                        data-placement="top"
                        data-content="Quando a Ordem de Serviço for faturada ela irá receber esse status se não for recebido nenhum valor"
                        class="data_info fas fa-exclamation-circle"
                    ></i>
                </label>
                {!! html()->select('sistema[default_os_faturar]', \App\Models\Configuracao\Parametro\Status::where('os', 1)->orderBy('name')->pluck('name', 'id'), getConfig('default_os_faturar'))->class('form-control')->placeholder('Não alterar status') !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="sistema[default_os_faturar_pagto_parcial]">
                    Status OS Pagto. em Aberto
                    <i
                        data-container="body"
                        data-toggle="popover"
                        data-placement="top"
                        data-content="Quando a Ordem de Serviço for faturada ela irá receber esse status se o valor do pagamento for menor do que o valor total da Ordem de Serviço"
                        class="data_info fas fa-exclamation-circle"
                    ></i>
                </label>
                {!! html()->select('sistema[default_os_faturar_pagto_parcial]', \App\Models\Configuracao\Parametro\Status::where('os', 1)->orderBy('name')->pluck('name', 'id'), getConfig('default_os_faturar_pagto_parcial'))->class('form-control')->placeholder('Não alterar status') !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="sistema[default_os_faturar_pagto_quitado]">
                    Status OS ao ser Quitada
                    <i
                        data-container="body"
                        data-toggle="popover"
                        data-placement="top"
                        data-content="Quando a Ordem de Serviço for faturada ela irá receber esse status se o valor do pagamento igual ou maior do que o valor da Ordem de Serviço"
                        class="data_info fas fa-exclamation-circle"
                    ></i>
                </label>
                {!! html()->select('sistema[default_os_faturar_pagto_quitado]', \App\Models\Configuracao\Parametro\Status::where('os', 1)->orderBy('name')->pluck('name', 'id'), getConfig('default_os_faturar_pagto_quitado'))->class('form-control')->placeholder('Não alterar status') !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label for="sistema[os_informacao]">
                    Informações
                    <i
                        data-container="body"
                        data-toggle="popover"
                        data-placement="top"
                        data-content="Esse campo fica no fim da OS impressa"
                        class="data_info fas fa-exclamation-circle"
                    ></i>
                </label>
                {!! html()->textarea('sistema[os_informacao]', getConfig('os_informacao'))->class('form-control textarea')->placeholder('Informações no rodapé da OS') !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">

                <label for="sistema[os_listagem_padrao]">
                    Exibição padrão de Ordem de Serviço
                    <i
                        data-container="body"
                        data-toggle="popover"
                        data-placement="top"
                        data-content="Itens exibidos por padrão na listagem de OS, sem filtros"
                        class="data_info fas fa-exclamation-circle"
                    ></i>
                </label>
                @php
                    $osListagemPadrao =  getConfig('os_listagem_padrao')
                @endphp
                @foreach (App\Models\Configuracao\Parametro\Status::orderBy('name')->get() as $item)
                    <div class="custom-control custom-checkbox">
                        <input name="sistema[os_listagem_padrao][]" @checked((is_array($osListagemPadrao)) ? in_array($item->id, $osListagemPadrao) : null) class="custom-control-input" type="checkbox" id="os_list_{{ $item->id }}" value="{{ $item->id }}">
                        <label for="os_list_{{ $item->id }}" class="custom-control-label">{{ $item->name }}</label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
