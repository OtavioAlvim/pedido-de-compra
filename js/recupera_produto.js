function atualizarTabela() {
    $.ajax({
        url: "../processamento/recupera_produtos.php",
        type: "GET",
        dataType: "html",
        success: function(response) {
            $("#tabelaProdutos").html(response);
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}

// Atualizar tabela ao carregar a página
atualizarTabela();

// Definir intervalo para atualizar a tabela periodicamente (opcional)
setInterval(atualizarTabela, 500); // Atualiza a cada 5 segundos, por exemplo