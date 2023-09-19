$(function () {
    //Pesquisar os cursos sem refresh na página
    $("#pesquisa").keyup(function () {

        var pesquisa = $(this).val();

        //Verificar se há algo digitado
        if (pesquisa != '') {
            var dados = {
                palavra: pesquisa
            }
            $.post('../processamento/consultaProduto.php', dados, function (retorna) {
                // Faz o parsing do JSON retornado
                const response = JSON.parse(retorna);
                console.log(response);
                // Verifica se o resultado do backend é vazio
                if (response.length === 0) {
                    // Limpa o campo #input1 e #input2
                    $("#descricao").val('Produto não localzado');
                    $("#unitario").val('');
                    $("#fracao").val('');
                    $("#custo").val('');
                    $("#unida").val('');
                    $("#codbarra").val('');
                    $("#id_produto").val('');
                } else {
                    // Atualiza os campos #input1 e #input2 com os dados retornados
                    const descricao = response[0].DESCRICAO;
                    const unitario = response[0].UNITARIO;
                    const fator_fracao_venda = response[0].FATOR_FRACAO_VENDA;
                    const custo = response[0].PRECOCUSTO;
                    const unidade = response[0].UNIDADE;
                    const codbarra = response[0].CODBARRA;
                    const id_produto = response[0].ID_PRODUTO;
                    $("#descricao").val(descricao);
                    $("#unitario").val(unitario);
                    $("#fracao").val(fator_fracao_venda);
                    $("#custo").val(custo);
                    $("#unida").val(unidade);
                    $("#codbarra").val(codbarra);
                    $("#id_produto").val(id_produto);
                }
            });
        } else {
            // Caso o campo de pesquisa esteja vazio, limpa o campo #input2
            $("#descricao").val('');
            $("#unitario").val('');
            $("#fracao").val('');
            $("#custo").val('');
            $("#unida").val('');
            $("#codbarra").val('');
            $("#id_produto").val('');
        }
    });
});
