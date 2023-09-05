<div>






    <div class="col-md-12">
        <h4>{{ $checklist->name }}</h4>
        <div id="fb-render"></div>
    </div>


    <script defer>

        $(document).ready(function() {
            var fbRender = document.getElementById('fb-render');
            var formData = '{!! $checklist->checklist !!}';



            var formRenderOpts = {
                formData,
                dataType: 'json',
                i18n: {
                    locale: 'pt-BR',
                    location: '/vendor/form-builder/'
                },
            };

        var fData = $(fbRender).formRender(formRenderOpts);
           console.log(fData.userData); // retorna o formulário preenchido e formatado.
        });
        </script>






</div>
