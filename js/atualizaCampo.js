  // Função para atualizar o resultado em tempo real
  function atualizarResultado() {
    // Pegar os valores dos três inputs
    var valorcaixas = parseFloat(caixas.value);
    var valorunitario = parseFloat(unitario.value);
    var valorfracao = parseFloat(fracao.value);

    // Verificar se os valores são numéricos
    if (isNaN(valorcaixas) || isNaN(valorunitario) || isNaN(valorfracao)) {
      resultado.value = "Insira apenas números válidos";
      return;
    }

    // Somar os valores e atualizar o resultado no terceiro input
    var somatorioFinal = valorunitario  * valorcaixas;
    resultado.value = somatorioFinal;
  }

  // Selecionar os elementos dos inputs
  const caixas = document.getElementById('caixas');
  const unitario = document.getElementById('unitario');
  const fracao = document.getElementById('fracao');
  const resultado = document.getElementById('resultado');

  // Adicionar eventos de entrada (input events) e mudança (change event) para os inputs
  caixas.addEventListener('input', atualizarResultado);
  caixas.addEventListener('change', atualizarResultado);
  
  unitario.addEventListener('input', atualizarResultado);
  unitario.addEventListener('change', atualizarResultado);
  
  fracao.addEventListener('input', atualizarResultado);
  fracao.addEventListener('change', atualizarResultado);