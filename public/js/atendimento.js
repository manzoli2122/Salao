/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/atendimento.js":
/***/ (function(module, exports) {


window.servicos = [];
window.produtos = [];
window.pagamentos = [];
window.pagardivida = false;

window.modelAtender = function (id, url) {
    var funcSucesso = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : function () {};

    alertProcessando();
    servicos = [];
    produtos = [];
    pagamentos = [];
    pagardivida = false;

    var token = document.head.querySelector('meta[name="csrf-token"]').content;
    $.ajax({
        url: url + "/" + id,
        type: 'get',
        data: { _token: token },
        success: function success(retorno) {
            alertProcessandoHide();
            if (retorno.erro) {
                toastErro(retorno.msg);
            } else {
                document.getElementById("div-pagina").innerHTML = retorno.data;
                funcSucesso();
                inicializarAtendimento();
            }
        },
        error: function error(erro) {
            alertProcessandoHide();
            toastErro("Ocorreu um erro");
            console.log(erro);
        }
    });
};

window.inicializarAtendimento = function () {
    $('#servico_id').select2({
        width: 'resolve' // need to override the changed default       
    });
    $('#servico_id').on('select2:select', function (e) {
        servicoFunction();
    });
    $("#funcionario_id").select2();
    $('#produto_id').select2({
        width: 'resolve' // need to override the changed default       
    });
    $('#produto_id').on('select2:select', function (e) {
        produtoFunction();
    });
};

window.atendimentoStore = function (url, cliente_id, url_retorno) {
    alertProcessando();
    var valorPagamentos = parseFloat(document.getElementById("valor_total_pagamentos").dataset.valor);
    var valorAtendimentos = parseFloat(document.getElementById("valor_total").dataset.valor);
    var diferenca = valorAtendimentos - valorPagamentos;
    if (diferenca * diferenca > 0) {
        toastErro("Valor total não confere com valor dos Pagamentos");
        alertProcessandoHide();
        return;
    }
    var token = document.head.querySelector('meta[name="csrf-token"]').content;
    $.ajax({
        url: url,
        type: 'post',
        data: { _token: token, _servicos: JSON.stringify(servicos), _pagamentos: JSON.stringify(pagamentos),
            _produtos: JSON.stringify(produtos), _cliente_id: cliente_id },
        success: function success(retorno) {
            alertProcessandoHide();
            if (retorno.erro) {
                toastErro(retorno.msg);
            } else {
                toastSucesso(retorno.msg);
                window.location = url_retorno;
            }
        },
        error: function error(erro) {
            alertProcessandoHide();
            toastErro("Ocorreu um erro");
            console.log(erro);
        }
    });
};

window.calculaValorTotal = function () {
    var totalAtendimento = 0;
    for (i in servicos) {
        var item = servicos[i];
        totalAtendimento = totalAtendimento + parseFloat(item.valor_servico_total);
    }
    for (i in produtos) {
        var item = produtos[i];
        totalAtendimento = totalAtendimento + parseFloat(item.valor_produto_total);
    }
    if (pagardivida) {
        var valorDivida = parseFloat(document.getElementById("valor_total_divida").dataset.valor);
        totalAtendimento = totalAtendimento + valorDivida;
    }
    document.getElementById("valor_total").innerHTML = ' Valor Total R$ ' + totalAtendimento.formatMoney(2, ',', '.');
    document.getElementById("valor_total").dataset.valor = totalAtendimento;
    var totalPagamentos = 0;
    for (i in pagamentos) {
        var item = pagamentos[i];
        totalPagamentos = totalPagamentos + parseFloat(item.valor);
    }
    document.getElementById("valor_total_pagamentos").innerHTML = 'Total dos Pagamentos R$ ' + totalPagamentos.formatMoney(2, ',', '.');
    document.getElementById("valor_total_pagamentos").dataset.valor = totalPagamentos;
    document.forms["form-pagamento"]["valor"].value = totalAtendimento - totalPagamentos;
};

Number.prototype.formatMoney = function (c, d, t) {
    var n = this,
        c = isNaN(c = Math.abs(c)) ? 2 : c,
        d = d == undefined ? "." : d,
        t = t == undefined ? "," : t,
        s = n < 0 ? "-" : "",
        i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
        j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};

window.alterardivida = function () {
    pagardivida = !pagardivida;
    calculaValorTotal();
};

//----------------------------------------------------------------------------------------------------------------------------
// FUNÇÕES   PARA   SERVIÇOS
//----------------------------------------------------------------------------------------------------------------------------
window.AdicionarServico = function () {
    var novoServico = {};
    var form = document.forms["form-servico"];
    var elements = form.querySelectorAll("input, select, textarea");
    for (var i = 0; i < elements.length; ++i) {
        var element = elements[i];
        var name = element.name;
        var value = element.value;
        if (name) {
            novoServico[name] = value;
        }
    }
    if (novoServico.servico_id == '') {
        toastErro('Selecione o Serviço.');
        return;
    }
    if (novoServico.funcionario_id == '') {
        toastErro('Selecione o Funcionario.');
        return;
    }

    if (novoServico.valor_servico_total < 0) {
        toastErro('Valor do Serviço deve ser maior ou igual a zero.');
        return;
    }

    var servico = form["servico_id"].options[form["servico_id"].selectedIndex];
    var funcionario = form["funcionario_id"].options[form["funcionario_id"].selectedIndex];
    novoServico['nome_servico'] = servico.dataset.nome;
    novoServico['nome_funcionario'] = funcionario.dataset.nome;
    servicos.push(novoServico);
    restartModalServico();
    desenharServico();
    calculaValorTotal();
    //$('#servicoModal').modal('hide');    
    alertSucesso("Serviço Adicionado Com sucesso!!", '', 'bottomRight');
};

window.removerServico = function (posicao) {
    servicos.splice(posicao, 1);
    desenharServico();
    calculaValorTotal();
};

window.restartModalServico = function () {
    $('#servico_id').val(null).trigger('change');
    var form = document.forms["form-servico"];
    form["quantidade"].value = 1;
    form["desconto"].max = 0;
    form["acrescimo"].max = 0;
    form["desconto"].value = 0.0;
    form["acrescimo"].value = 0.0;
    form["valor_servico_unitario"].value = 0.0;
    form["valor_servico_total"].value = 0.0;
};

window.desenharServico = function () {
    var html = '';
    for (i in servicos) {
        var item = servicos[i];
        html = html + '<div class="row"> ';
        html = html + '     <div class="col-md-12">';
        html = html + '         <div class="box box-success">';
        html = html + '             <div class="box-header with-border">';
        html = html + '                 <h3 class="box-title">' + item.nome_servico + '</h3>';
        html = html + '                 <div class="box-tools pull-right">';
        html = html + '                     <button class="btn btn-box-tool "type="button" onclick="removerServico( ' + i + ' )" > <i class="fa fa-times"> </i> </button>';
        html = html + '                 </div>  ';
        html = html + '             </div>   ';
        html = html + '             <div class="box-body">    ';
        html = html + '                 <div class="direct-chat-msg">';
        html = html + '                     <div class="direct-chat-info clearfix">  ';
        html = html + '                         <span class="pull-right">Funcionário: ' + item.nome_funcionario + '</span>';
        html = html + '                         <span class="pull-left">R$ ' + item.valor_servico_unitario + ' / Unid.</span>';
        html = html + '                     </div>';
        html = html + '                     <div class="direct-chat-info clearfix"> ';
        html = html + '                         <span class="pull-left"> quant.: ' + item.quantidade + ' </span>';
        html = html + '                         <span class="pull-right badge bg-green"> Total R$  ' + item.valor_servico_total + ' </span>';
        html = html + '                     </div>';
        html = html + '                  </div>';
        html = html + '              </div>';
        html = html + '         </div>';
        html = html + '     </div>   ';
        html = html + '</div>';
    }
    document.getElementById("todos-servicos").innerHTML = html;
};

window.servicoFunction = function () {
    var form = document.forms["form-servico"];
    var servico = form["servico_id"].options[form["servico_id"].selectedIndex];
    var quantidade = parseInt(form["quantidade"].value);
    var desconto_maximo = parseInt(servico.dataset.maximo);
    var valor = parseFloat(servico.dataset.valor);
    form["desconto"].max = desconto_maximo * valor / 100;
    form["acrescimo"].max = valor;
    if (form["desconto"].value == '') {
        form["desconto"].value = 0.0;
    }
    var desconto = parseFloat(form["desconto"].value);
    if (form["acrescimo"].value == '') {
        form["acrescimo"].value = 0.0;
    }
    var acrescimo = parseFloat(form["acrescimo"].value);
    var valor_unitario = valor - desconto + acrescimo;
    var valor_total = valor_unitario * quantidade;
    form["valor_servico_unitario"].value = valor_unitario;
    form["valor_servico_total"].value = valor_total;
};

//----------------------------------------------------------------------------------------------------------------------------
// FUNÇÕES   PARA   PRODUTO
//----------------------------------------------------------------------------------------------------------------------------
window.AdicionarProduto = function () {
    var novoProduto = {};
    var form = document.forms["form-produto"];
    var elements = form.querySelectorAll("input, select, textarea");
    for (var i = 0; i < elements.length; ++i) {
        var element = elements[i];
        var name = element.name;
        var value = element.value;
        if (name) {
            novoProduto[name] = value;
        }
    }
    if (novoProduto.produto_id == '') {
        toastErro('Selecione o Produto.');
        return;
    }

    if (novoProduto.valor_produto_total < 0) {
        toastErro('Valor do Produto deve ser maior que zero.');
        return;
    }

    var produto = form["produto_id"].options[form["produto_id"].selectedIndex];
    novoProduto['nome_produto'] = produto.dataset.nome;
    produtos.push(novoProduto);
    restartModalProduto();
    desenharProduto();
    calculaValorTotal();
    $('#produtoModal').modal('hide');
    alertSucesso("Produto Adicionado Com sucesso!!", '', 'bottomRight');
};

window.produtoFunction = function () {
    var form = document.forms["form-produto"];
    var produto = form["produto_id"].options[form["produto_id"].selectedIndex];
    var quantidade = parseInt(form["quantidade"].value);
    var desconto_maximo = parseInt(produto.dataset.maximo);
    var valor = parseFloat(produto.dataset.valor);
    form["desconto"].max = desconto_maximo * valor / 100;
    if (valor != 0.0) {
        form["acrescimo"].max = valor;
    }
    if (form["desconto"].value == '') {
        form["desconto"].value = 0.0;
    }
    var desconto = parseFloat(form["desconto"].value);
    if (form["acrescimo"].value == '') {
        form["acrescimo"].value = 0.0;
    }
    var acrescimo = parseFloat(form["acrescimo"].value);
    var valor_unitario = valor - desconto + acrescimo;
    var valor_total = valor_unitario * quantidade;
    form["valor_produto_unitario"].value = valor_unitario;
    form["valor_produto_total"].value = valor_total;
};

window.removerProduto = function (posicao) {
    produtos.splice(posicao, 1);
    desenharProduto();
    calculaValorTotal();
};

window.restartModalProduto = function () {
    $('#produto_id').val(null).trigger('change');
    var form = document.forms["form-produto"];
    form["quantidade"].value = 1;
    form["desconto"].max = 0;
    form["acrescimo"].max = 0;
    form["desconto"].value = 0.0;
    form["acrescimo"].value = 0.0;
    form["valor_produto_unitario"].value = 0.0;
    form["valor_produto_total"].value = 0.0;
};

window.desenharProduto = function () {
    var html = '';
    for (i in produtos) {
        var item = produtos[i];
        html = html + '<div class="row"> ';
        html = html + '     <div class="col-md-12">';
        html = html + '         <div class="box box-info">';
        html = html + '             <div class="box-header with-border">';
        html = html + '                 <h3 class="box-title">' + item.nome_produto + '</h3>';
        html = html + '                 <div class="box-tools pull-right">';
        html = html + '                     <button class="btn btn-box-tool "type="button" onclick="removerProduto( ' + i + ' )" > <i class="fa fa-times"> </i> </button>';
        html = html + '                 </div>  ';
        html = html + '             </div>   ';
        html = html + '             <div class="box-body">    ';
        html = html + '                 <div class="direct-chat-msg">';
        html = html + '                     <div class="direct-chat-info clearfix">  ';
        html = html + '                         <span class="pull-right"></span>';
        html = html + '                         <span class="pull-left">R$ ' + item.valor_produto_unitario + ' / Unid.</span>';
        html = html + '                     </div>';
        html = html + '                     <div class="direct-chat-info clearfix"> ';
        html = html + '                         <span class="pull-left"> quant.: ' + item.quantidade + ' </span>';
        html = html + '                         <span class="pull-right badge bg-green"> Total R$  ' + item.valor_produto_total + ' </span>';
        html = html + '                     </div>';
        html = html + '                  </div>';
        html = html + '              </div>';
        html = html + '         </div>';
        html = html + '     </div>   ';
        html = html + '</div>';
    }
    document.getElementById("todos-produtos").innerHTML = html;
};

//----------------------------------------------------------------------------------------------------------------------------
// FUNÇÕES   PARA    PAGAMENTO
//----------------------------------------------------------------------------------------------------------------------------        
window.AdicionarPagamento = function () {
    var novoPagamento = {};
    var form = document.forms["form-pagamento"];
    var elements = form.querySelectorAll("input, select, textarea");
    for (var i = 0; i < elements.length; ++i) {
        var element = elements[i];
        var name = element.name;
        var value = element.value;
        if (name) {
            novoPagamento[name] = value;
        }
    }
    var operadora = form["operadora_id"].options[form["operadora_id"].selectedIndex];
    novoPagamento['nome_operadora'] = operadora.dataset.nome;

    if (novoPagamento.formaPagamento == '') {
        toastErro('Selecione a Forma de Pagamento.');
        return;
    }

    if (novoPagamento.valor <= 0) {
        toastErro('Valor do pagamento deve ser maior que zero.');
        return;
    }

    if (novoPagamento.formaPagamento == 'credito') {
        if (novoPagamento.bandeira == '') {
            toastErro('Selecione a Bandeira.');
            return;
        }
        if (novoPagamento.operadora_id == '') {
            toastErro('Selecione a Operadora.');
            return;
        }
    }

    if (novoPagamento.formaPagamento == 'debito') {
        if (novoPagamento.bandeira == '') {
            toastErro('Selecione a Bandeira.');
            return;
        }
        if (novoPagamento.operadora_id == '') {
            toastErro('Selecione a Operadora.');
            return;
        }
    }
    pagamentos.push(novoPagamento);
    restartModalPagamento();
    desenharPagamento();
    calculaValorTotal();
    $('#pagamentoModal').modal('hide');
    alertSucesso("Pagamento Adicionado Com sucesso!!", '', 'bottomRight');
};

window.removerPagamento = function (posicao) {
    pagamentos.splice(posicao, 1);
    desenharPagamento();
    calculaValorTotal();
};

window.restartModalPagamento = function () {
    var form = document.forms["form-pagamento"];
    form["formaPagamento"].value = '';
    form["operadora_id"].value = '';
    form["parcelas"].value = '1';
    form["valor"].value = '0';
    form["bandeira"].value = '';
    form["observacoes"].value = '';
    document.getElementById("form-operadora").hidden = true;
    document.getElementById("form-parcelas").hidden = true;
    document.getElementById("form-bandeira").hidden = true;
    document.getElementById("operadora_id").required = false;
    document.getElementById("parcelas").required = false;
    document.getElementById("bandeira").required = false;
};

window.desenharPagamento = function () {
    var html = '';
    for (i in pagamentos) {
        var item = pagamentos[i];
        html = html + '<div class="row"> ';
        html = html + '     <div class="col-md-12">';
        html = html + '         <div class="box box-warning" style="margin-bottom: 10px;">';
        html = html + '             <div class="box-header with-border" style="padding: 5px;">';
        html = html + '                 <h3 class="box-title">' + item.formaPagamento + '</h3>';
        html = html + '                 <div class="box-tools pull-right">';
        html = html + '                     <button class="btn btn-box-tool "type="button" onclick="removerPagamento( ' + i + ' )" > <i class="fa fa-times"> </i> </button>';
        html = html + '                 </div>  ';
        html = html + '             </div>   ';
        html = html + '             <div class="box-body" style="padding: 5px;">    ';
        html = html + '                 <div class="direct-chat-msg">';
        html = html + '                     <div class="direct-chat-info clearfix">  ';
        html = html + '                         <span class="pull-right  badge bg-orange">Valor R$ ' + item.valor + '</span>';
        html = html + '                         <span class="pull-left"></span>';
        html = html + '                     </div>';
        html = html + '                  </div>';
        html = html + '              </div>';
        html = html + '         </div>';
        html = html + '     </div>   ';
        html = html + '</div>';
    }
    document.getElementById("todos-pagamentos").innerHTML = html;
};

window.formaPagamentoDisplay = function (val) {
    if (val == 'credito') {
        document.getElementById("form-operadora").hidden = false;
        document.getElementById("form-parcelas").hidden = false;
        document.getElementById("parcelas").selectedIndex = 1;
        document.getElementById("form-bandeira").hidden = false;
        document.getElementById("operadora_id").required = true;
        document.getElementById("parcelas").required = true;
        document.getElementById("bandeira").required = true;
    }
    if (val == 'debito') {
        document.getElementById("form-operadora").hidden = false;
        document.getElementById("form-parcelas").hidden = true;
        document.getElementById("parcelas").selectedIndex = 1;
        document.getElementById("form-bandeira").hidden = false;
        document.getElementById("operadora_id").required = true;
        document.getElementById("parcelas").required = false;
        document.getElementById("bandeira").required = true;
    }
    if (val == 'dinheiro') {
        document.getElementById("form-operadora").hidden = true;
        document.getElementById("form-parcelas").hidden = true;
        document.getElementById("form-bandeira").hidden = true;
        document.getElementById("operadora_id").required = false;
        document.getElementById("parcelas").required = false;
        document.getElementById("bandeira").required = false;
    }
    if (val == 'Transferência Bancária') {
        document.getElementById("form-operadora").hidden = true;
        document.getElementById("form-parcelas").hidden = true;
        document.getElementById("form-bandeira").hidden = true;

        document.getElementById("operadora_id").required = false;
        document.getElementById("parcelas").required = false;
        document.getElementById("bandeira").required = false;
    }
    if (val == 'Pic Pay') {
        document.getElementById("form-operadora").hidden = true;
        document.getElementById("form-parcelas").hidden = true;
        document.getElementById("form-bandeira").hidden = true;

        document.getElementById("operadora_id").required = false;
        document.getElementById("parcelas").required = false;
        document.getElementById("bandeira").required = false;
    }
    if (val == 'cheque') {
        document.getElementById("form-operadora").hidden = true;
        document.getElementById("form-parcelas").hidden = true;
        document.getElementById("form-bandeira").hidden = true;

        document.getElementById("operadora_id").required = false;
        document.getElementById("parcelas").required = false;
        document.getElementById("bandeira").required = false;
    }
    if (val == 'fiado') {
        document.getElementById("form-operadora").hidden = true;
        document.getElementById("form-parcelas").hidden = true;
        document.getElementById("form-bandeira").hidden = true;

        document.getElementById("operadora_id").required = false;
        document.getElementById("parcelas").required = false;
        document.getElementById("bandeira").required = false;
    }
};

/***/ }),

/***/ 2:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("./resources/assets/js/atendimento.js");


/***/ })

/******/ });