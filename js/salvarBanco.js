  // Adicionar evento click para salvar os dados no banco de dados
  $("#salvarDados").on('click', function () {
    var descricao = $("#descricao").val();
    var caixas = $("#caixas").val();
    var fracao = $("#fracao").val();
    var unitario = $("#unitario").val();
    var resultado = $("#resultado").val();
    var custo = $("#custo").val();
    var unida = $("#unida").val();
    var codbarra = $("#codbarra").val();
    var id_venda = $("#id_venda").val();
    var id_produto = $("#id_produto").val();

    // Enviar os dados para o backend usando AJAX
    $.ajax({
      type: "POST",
      url: "../processamento/insereProduto.php", // Seu arquivo PHP para salvar os dados no banco de dados
      data: {
        descricao: descricao,
        caixas: caixas,
        fracao: fracao,
        unitario: unitario,
        resultado: resultado,
        custo: custo,
        unida: unida,
        codbarra: codbarra,
        id_venda: id_venda,
        id_produto: id_produto

        
      },
      success: function (response) {
        // console.log("Dados salvos com sucesso!");
        $("#descricao").val('');
        $("#caixas").val('');
        $("#fracao").val('');
        $("#unitario").val('');
        $("#resultado").val('');
        $("#pesquisa").val('');
        $("#pesquisa").focus();

      },
      error: function (xhr, status, error) {
        console.error("Erro na requisição AJAX: " + status + " - " + error);
      }
    });
  });