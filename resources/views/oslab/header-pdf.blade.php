<div class="">
    @if ($emitente)
    <div style="height: 90px;">
        <div style="float: left; width: 17%; padding-right: 5px  ">
            <img
                @if ($emitente->logo_url)
                    src="{{ asset('storage/'.$emitente->logo_url) }}"
                @else
                    src="{{ asset('vendor/oslab/imgs/oslab_logo.svg') }} "
                @endif
            class="rounded image img-fluid" >
        </div>
        <div style="float: left; width: 53%; ">
            <h4 class="metropolis-bold mb-0 " ><b>{{ $emitente->fantasia }}</b></h4>
            <p class="metropolis-regular mt-0 mb-0 ">CNPJ: {{ $emitente->cnpj }}</p>
            <p class="mb-0 "  >{{ $emitente->logradouro }}, {{ $emitente->numero }}, {{ $emitente->bairro }}</p>
            <p class="mb-0 "  >{{ $emitente->cidade }} - {{ $emitente->uf }}, CEP: {{ $emitente->cep}}</p>
        </div>
        <div style="float:left; width: 29%;">
            <div style="font-size: 11px;" class="text-right">
                @if ($emitente->telefone)
                <p class="mb-0 mt-0" > Contato: {{ $emitente->telefone }} </p>
                @endif
                @if ($emitente->site_url)
                    <p class="mb-0 mt-0" >
                        <a href="{{ $emitente->site_url }}" style="color: #212529" target="_blank" rel="noopener noreferrer">
                            {{ preg_replace("(^https?://)", "", $emitente->site_url ) }}
                        </a>
                    </p>
                @endif
                @if ($os)
                    <p class="mb-0 mt-0" > Emissor: {{ $os->user->name }} </p>
                    <p class="mb-0 mt-0" > Técnico: {{ $os->tecnico->name }} </p>
                    <p class="mb-0 mt-0" > Emissão: {{date('d/m/Y')}} </p>
                @endif
            </div>
        </div>
    </div>
    {{-- <div class="row">
        <div class="col-sm-2">
            <img
                @if ($emitente->logo_url)
                    src="{{ asset('storage/'.$emitente->logo_url) }}"
                @else
                    src="{{ asset('vendor/oslab/imgs/oslab_logo.svg') }} "
                @endif
            class="rounded image img-fluid" >
        </div>
        <div class="col-sm-7">
            <h4 class="mb-0 " ><b>{{ $emitente->fantasia }}</b></h4>
            <h6 class="mt-0 mb-0 ">CNPJ: {{ $emitente->cnpj }}</h6>
            <p class="mb-0 "  >{{ $emitente->logradouro }}, nº: {{ $emitente->numero }}, {{ $emitente->bairro }}</p>
            <p class="mb-0 "  >{{ $emitente->cidade }} - {{ $emitente->uf }}, CEP: {{ $emitente->cep}}</p>
        </div>
        <div style="font-size: 14px;" class="col-sm-3 text-right">
            @if ($emitente->telefone)
            <p class="mb-0 mt-0" > Contato: {{ $emitente->telefone }} </p>
            @endif
            @if ($emitente->site_url)
                <p class="mb-0 mt-0" >
                    <a href="{{ $emitente->site_url }}" style="color: #212529" target="_blank" rel="noopener noreferrer">
                        {{ preg_replace("(^https?://)", "", $emitente->site_url ) }}
                    </a>
                </p>
            @endif
            @if ($os)
                <p class="mb-0 mt-0" > Emissor: {{ $os->user->name }} </p>
                <p class="mb-0 mt-0" > Técnico: {{ $os->tecnico->name }} </p>
                <p class="mb-0 mt-0" > Emissão: {{date('d/m/Y')}} </p>
            @endif
        </div>
    </div> --}}
    @else
    <div class="row">
        <div class="col-sm-2">
            <img src="{{ asset('vendor/oslab/imgs/oslab_logo.svg') }} " class="rounded image img-fluid" >
        </div>
        <div class="col-sm-7">
            <h4 class="mb-0 " ><b> Nome Fantasia </b></h4>
            <h6 class="mt-0 mb-0 ">CNPJ: 00.000.0001-01</h6>
            <p class="mb-0 "  >AV OsLAb, nº: 123, Bairro do Bairro</p>
            <p class="mb-0 "  >Cidade - RJ, CEP: 24000-000</p>
        </div>
        <div style="font-size: 14px;" class="col-sm-3 text-right">
            <p class="mb-0 mt-0" > Contato: (21) 99999-9999 </p>
            <p class="mb-0 mt-0" > admin@oslab.com.br </p>
            <p class="mb-0 mt-0" > www.oslab.com.br </p>
            <p class="mb-0 mt-0" > Responsavel: Atendimento </p>
            <p class="mb-0 mt-0" > Tecnico: bulfaitelo </p>
            <p class="mb-0 mt-0" > Emissão: {{date('d/m/Y')}} </p>
        </div>
    </div>

    @endif
</div>

