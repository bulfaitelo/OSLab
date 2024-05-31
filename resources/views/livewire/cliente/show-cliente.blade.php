<div>
    <div class="card">
        <div class="card-header">
            <a href="{{ url()->previous() }}">
                <button type="button"  class="btn btn-sm btn-default">
                    <i class="fa-solid fa-chevron-left"></i>
                    Voltar
                </button>
            </a>
            <div class="btn-group btn-group-sm">
                <a  title="Detalhes" wire:click.prevent="tabChange('detalhes')"
                class="btn btn-left
                @if ($showTab == 'detalhes')
                    btn-info
                @else
                    btn-default
                @endif
                ">
                    <i class="fa-solid fa-users "></i>
                    Detalhes
                </a>
                <a title="Ordens de Serviço" wire:click.prevent="tabChange('os')"
                class="btn btn-left
                @if ($showTab == 'os')
                btn-info
                @else
                btn-default
                @endif
                ">
                    <i class="fa-regular fa-rectangle-list "></i>
                    Ordens de Serviço
                </a>
            </div>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <label for="registro">CPF / CNPJ</label>
                    <div class="input-group ">
                        {!! html()->text('registro', $cliente->registro)->class('form-control cpf_cnpj')->placeholder('Nome do usuário')->disabled() !!}
                    </div>
                    <i class="text-danger" id="msg_cpnj_error"></i>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="name">Cliente</label>
                        {!! html()->text('name', $cliente->name)->class('form-control')->placeholder('Nome do Cliente')->disabled() !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="email">Email</label>
                    {!! html()->email('email', $cliente->email)->class('form-control')->placeholder('Email')->disabled() !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="celular">Celular </label>
                        {!! html()->text('celular', $cliente->celular)->class('form-control cel')->placeholder('Celular')->disabled() !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="telefone">Telefone </label>
                        {!! html()->text('telefone', $cliente->telefone)->class('form-control tel')->placeholder('Telefone')->disabled() !!}
                    </div>
                </div>
            </div>
            <h4>Endereço:</h4>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="cep">Cep</label>
                        {!! html()->text('cep', $cliente->cep)->class('form-control cep')->placeholder('CEP')->disabled() !!}
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="Logradouro">Logradouro</label>
                        {!! html()->text('logradouro', $cliente->logradouro)->class('form-control')->placeholder('Logradouro')->disabled() !!}
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="numero">Número</label>
                        {!! html()->text('numero', $cliente->numero)->class('form-control')->placeholder('Número')->disabled() !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="bairro">Bairro</label>
                        {!! html()->text('bairro', $cliente->bairro)->class('form-control')->placeholder('Bairro')->disabled() !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="cidade">Cidade</label>
                        {!! html()->text('cidade', $cliente->cidade)->class('form-control')->placeholder('Cidade')->disabled() !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="uf">Estado</label>
                        {!! html()->text('uf', $cliente->uf)->class('form-control')->placeholder('Estado')->disabled() !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="complemento">Complemento</label>
                        {!! html()->text('complemento', $cliente->complemento)->class('form-control')->placeholder('Complemento')->disabled() !!}
                    </div>
                </div>
            </div>
        </div>
        {{-- Minimal with icon only --}}
        <!-- /.card-body -->
    </div>
</div>
