$(function() {
    //Pesquisar os cursos sem refresh na página
    $("#pesquisaCliente").keyup(function() {

        var pesquisaCliente = $(this).val();

        //Verificar se há algo digitado
        if (pesquisaCliente != '') {
            var dados = {
                palavra: pesquisaCliente
            }
            $.post('../processamento/consultaCliente.php', dados, function(retorna) {
                //Mostra dentro da ul os resultado obtidos 
                $(".resultadoCliente").html(retorna);
            });
        } else {
            $(".resultadoCliente").html('não tem nada');
        }
    });
});



