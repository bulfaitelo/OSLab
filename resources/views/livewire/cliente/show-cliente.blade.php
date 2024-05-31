<div>
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
</div>
