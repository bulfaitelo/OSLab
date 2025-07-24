@if(count($errors) > 0)
@php
    flash()->error(message: 'Por favor verifique o formulário', title: 'Ocorreu um erro!');
@endphp
    <script>
        $(document).ready(function(){
        @foreach ($errors->getMessages() as $item => $messages)
            $('#{{$item}}').addClass('is-invalid');
        @endforeach
        });
    </script>
@endif
