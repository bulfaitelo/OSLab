@if(session('success'))
    <script>
        $(document).Toasts('create', {
            class: 'bg-success',
            title: 'Cadastro realizado com Sucesso!',
            subtitle: '',
            autohide: true,
            delay: 2000,
            body: '{{Session::get("success")}}'
        })
    </script>
@elseif(session('warning'))
    <script>
        $(document).Toasts('create', {
            class: 'bg-warning',
            title: 'Ocorreu um erro!',
            subtitle: '',
            autohide: true,
            delay: 2000,
            body: '{{Session::get("warning")}}'
        })
    </script>
@elseif(count($errors) > 0)
    <script>
        $(document).Toasts('create', {
            class: 'bg-danger',
            title: 'Ocorreu um erro',
            subtitle: '',
            autohide: true,
            delay: 2000,
            body: 'Por favor verifique o formulário'
        })
    </script>
@endif
@if(count($errors) > 0) {
    <script>
        $(document).ready(function(){
        @foreach ($errors->getMessages() as $item => $messages)
            $('#{{$item}}').addClass('is-invalid');
        @endforeach
        });
    </script>
}
@endif
