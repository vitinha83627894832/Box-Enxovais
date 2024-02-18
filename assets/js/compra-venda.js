$(function() {
    // ... (seu código existente)

    function Adicionar() {
        if (!validaCamposFormularioProduto()) {
            return false;
        }

        var produto_codProd = $("#produto_codProd").val();
        var produto_descricao = $("#produto_codProd option:selected").text();
        var quantidade = Number($("#quantidade").val());
        var valor = Number($("#valor").val().replace(',', '.'));
        var valorTotalDoItem = quantidade * valor;

        // Troca de ponto pra vírgula para exibir os decimais no valor
        var valorStr = formataValorStr(valor);
        var valorTotalItemStr = formataValorStr(valorTotalDoItem);

        // Adiciona linha na tabela dinâmica
        $("#tabela").append(
            "<tr>" +
            "<input type=\"hidden\" name=\"produto_id[]\" value='" + produto_codProd + "' />" +
            "<input type=\"hidden\" name=\"quantidade[]\" value='" + quantidade + "' />" +
            "<input type=\"hidden\" name=\"valor[]\" value='" + valor + "' />" +
            "<input type=\"hidden\" name=\"valorTotalItem[]\" value='" + valorTotalDoItem + "' />" +

            "<td>" + produto_descricao + "</td>" +
            "<td class=\"text-right\" id=\"quantidade\">" + quantidade + "</td>" +
            "<td class=\"text-right\" id=\"valor\">" + valorStr + "</td>" +
            "<td class=\"text-right\" id=\"valorTotalItem\">" + valorTotalItemStr + "</td>" +
            "<td class=\"text-center\">" +
            "<button type=\"button\" class=\"btn btn-danger btn-sm btnExcluir\">" +
            "<i class=\"far fa-trash-alt\"></i>" +
            "</button>" +
            "</td>" +
            "</tr>"
        );

        $(".btnExcluir").unbind("click"); // Remove o binding anterior para evitar duplicatas
        $(".btnExcluir").bind("click", Excluir);

        limpaCampos();
        recalculaValores();
    }

    // ... (seu código existente)

    function recalculaValores() {
        var conteudo = document.getElementById("tabela").rows;
    
        var somaProdutos = 0;
        for (var i = 1; i < conteudo.length; i++) {
            var valorTotalItem = parseFloat(conteudo[i].querySelector("#valorTotalItem").textContent.replace(',', '.'));
            somaProdutos += valorTotalItem;
        }
    
        $("#resumoSoma").text(formataValorStr(somaProdutos));
        var desconto = parseFloat(form.desconto.value.replace(',', '.'));
        var valorTotal = somaProdutos - desconto;
    
        $("#resumoValorTotal").text(formataValorStr(valorTotal));
    
        // Atualiza o valor total na tabela
        $("#valorTotalCarrinho").text(formataValorStr(somaProdutos));
    }
    
    // ... (seu código existente)

    $("#btnAdicionar").bind("click", Adicionar);
    $("#btnAplicarDesconto").bind("click", AplicarDesconto);
});
