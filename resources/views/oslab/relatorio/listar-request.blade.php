@php
    $render = new  App\Http\OsLabClass\Relatorio\CreateHtmlRequestBusca();
@endphp
<div>    
    <h5>Parâmetros Buscados:</h5>
    {!! $render->render() !!}
</div>
