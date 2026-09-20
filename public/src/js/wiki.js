// Confs
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
var id = route().params.wiki

// WIKI
function editWiki() {
    $('.texto_wiki').summernote({
        focus: true,
        lang: 'pt-BR',
        height: 300,
    });
    $('#edit_wiki').css('display', 'none');
    $('#save_wiki').css('display', '');
};
function saveWiki() {
    var texto = $("#texto_wiki").summernote("code");
    $.ajax({
        url: route('wiki.text.update', id),
        method: 'PUT',
        data: {
            texto: texto,
        },
        success: function(response) {
            // Primeiro, renderize a notificação
            if (response.flash) {
                // Chama a função global do flasher, passando os dados
                // que o controller preparou para nós.
                window.flasher.render(response.flash);
            }

            // AGORA, atualize a interface
            $('.texto_wiki').summernote('destroy');
            $('#edit_wiki').css('display', '');
            $('#save_wiki').css('display', 'none');
        },
        error: function(xhr, status, error) {
            flasher.error('Ouve um erro, recarregue a pagina e tente novamente');
        }
    });

    // Remova as linhas daqui para que não executem imediatamente
};

// Lightbox das imagens da wiki (delegado, pois o conteúdo é renderizado dinamicamente)
$(document).on('click', '.texto_wiki img', function () {
    $('#wiki-image-preview').attr('src', $(this).attr('src'));
    $('#modal-wiki-image').modal('show');
});

// Zoom/pan da imagem ampliada (scroll do mouse no desktop, pinça e arraste no touch)
(function () {
    var container = document.getElementById('wiki-image-zoom-container');
    var image = document.getElementById('wiki-image-preview');
    if (!container || !image) return;

    var MIN_SCALE = 1;
    var MAX_SCALE = 5;
    var scale = 1;
    var posX = 0;
    var posY = 0;

    var isDragging = false;
    var dragStartX = 0;
    var dragStartY = 0;
    var dragOriginX = 0;
    var dragOriginY = 0;

    var pinchStartDistance = 0;
    var pinchStartScale = 1;

    function clampScale(value) {
        return Math.min(MAX_SCALE, Math.max(MIN_SCALE, value));
    }

    function applyTransform() {
        if (scale <= 1) {
            posX = 0;
            posY = 0;
        }
        image.style.transform = 'translate(' + posX + 'px, ' + posY + 'px) scale(' + scale + ')';
        image.style.cursor = scale > 1 ? 'grab' : 'zoom-in';
    }

    function resetZoom() {
        scale = 1;
        posX = 0;
        posY = 0;
        applyTransform();
    }

    $('#modal-wiki-image').on('show.bs.modal', resetZoom);

    // Desktop: zoom com o scroll do mouse
    container.addEventListener('wheel', function (e) {
        e.preventDefault();
        var delta = e.deltaY < 0 ? 0.15 : -0.15;
        scale = clampScale(scale + delta);
        applyTransform();
    }, { passive: false });

    // Desktop: arrastar (pan) com o mouse quando ampliado
    container.addEventListener('mousedown', function (e) {
        if (scale <= 1) return;
        isDragging = true;
        dragStartX = e.clientX;
        dragStartY = e.clientY;
        dragOriginX = posX;
        dragOriginY = posY;
        image.style.cursor = 'grabbing';
    });

    window.addEventListener('mousemove', function (e) {
        if (!isDragging) return;
        posX = dragOriginX + (e.clientX - dragStartX);
        posY = dragOriginY + (e.clientY - dragStartY);
        applyTransform();
    });

    window.addEventListener('mouseup', function () {
        if (!isDragging) return;
        isDragging = false;
        image.style.cursor = scale > 1 ? 'grab' : 'zoom-in';
    });

    function touchDistance(touches) {
        var dx = touches[0].clientX - touches[1].clientX;
        var dy = touches[0].clientY - touches[1].clientY;
        return Math.sqrt((dx * dx) + (dy * dy));
    }

    // Mobile: pinça para zoom e arraste com um dedo quando ampliado
    container.addEventListener('touchstart', function (e) {
        if (e.touches.length === 2) {
            pinchStartDistance = touchDistance(e.touches);
            pinchStartScale = scale;
        } else if (e.touches.length === 1 && scale > 1) {
            isDragging = true;
            dragStartX = e.touches[0].clientX;
            dragStartY = e.touches[0].clientY;
            dragOriginX = posX;
            dragOriginY = posY;
        }
    }, { passive: true });

    container.addEventListener('touchmove', function (e) {
        if (e.touches.length === 2) {
            e.preventDefault();
            var newDistance = touchDistance(e.touches);
            var ratio = newDistance / pinchStartDistance;
            scale = clampScale(pinchStartScale * ratio);
            applyTransform();
        } else if (e.touches.length === 1 && isDragging) {
            e.preventDefault();
            posX = dragOriginX + (e.touches[0].clientX - dragStartX);
            posY = dragOriginY + (e.touches[0].clientY - dragStartY);
            applyTransform();
        }
    }, { passive: false });

    container.addEventListener('touchend', function (e) {
        if (e.touches.length === 0) {
            isDragging = false;
        }
    });
})();




    // Validação - LINK
    $(function () {

        $('#linkForm').validate({
            rules: {
                link: {
                    required: true,
                    url: true
                },

            },
            messages: {
                link: {
                    required: "Por favor preencha o Link",
                    url: "Por favor preencha um link valido"
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });

