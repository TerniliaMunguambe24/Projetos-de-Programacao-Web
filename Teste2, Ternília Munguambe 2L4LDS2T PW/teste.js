
$(document).ready(function () {

 
    $('#menu a').on('click', function (e) {
        e.preventDefault();
        const destino = $(this).attr('href');
        if (destino.startsWith('#') && $(destino).length) {
            $('html, body').animate({
                scrollTop: $(destino).offset().top - 50
            }, 800);
        }
    });

 
    $('.curso').on('click', function () {
        $('.curso').removeClass('ativo');
        $(this).addClass('ativo');
    });


    $('#precos .mensalidade').each(function () {
        const lista = $(this).find('ul');
        lista.hide(); 

        $(this).find('#btn-mostrar').on('click', function (e) {
            e.preventDefault();
            lista.slideToggle(400);
          
            const atual = $(this).text().trim();
            $(this).text(atual === 'Mostrar Prestações' ? 'Ocultar Prestações' : 'Mostrar Prestações');
        });
    });

 
    $('#welcome-banner div a').hover(
        function () { $(this).css('transform', 'scale(1.1)'); },
        function () { $(this).css('transform', 'scale(1)'); }
    );

   
    $('#populares article').hover(
        function () { $(this).css('box-shadow', '0 8px 20px rgba(0,0,0,0.2)'); },
        function () { $(this).css('box-shadow', '0 2px 10px rgba(0,0,0,0.1)'); }
    );
});