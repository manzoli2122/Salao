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

$(document).ready(function () {

    $('#servico_id').select2({

        width: 'resolve' // need to override the changed default

    });

    $("#funcionario_id").select2();

    $('#servico_id').on('select2:select', function (e) {
        console.log('select event');
        servicoFunction();
    });
});

//----------------------------------------------------------------------------------------------------------------------------
// FUNÇÕES   PARA   SERVIÇOS
//----------------------------------------------------------------------------------------------------------------------------


window.restartModalServico = function () {
    var form = document.forms["form-servico"];

    form["quantidade"].value = 1;
    form["desconto"].max = 0;
    form["acrescimo"].max = 0;
    form["desconto"].value = 0.0;
    form["acrescimo"].value = 0.0;
    form["valor_servico_unitario"].value = 0.0;
    form["valor_servico_total"].value = 0.0;

    form["servico_id"].value = '';
};

function servicoClearFunction() {
    var form = document.forms["form-servico"];
    form["quantidade"].value = 1;
    form["desconto"].max = 0;
    form["acrescimo"].max = 0;
    form["desconto"].value = 0.0;
    form["acrescimo"].value = 0.0;
    form["valor_servico_unitario"].value = 0.0;
    form["valor_servico_total"].value = 0.0;
}

//----------------------------------------------------------------------------------------------------------------------------
// FUNÇÕES   PARA   PRODUTO
//----------------------------------------------------------------------------------------------------------------------------


function produtoFunction() {

    var form = document.forms["form-produto"];
    var produto = form["produto_id"].options[form["produto_id"].selectedIndex];
    var quantidade = parseInt(form["quantidade"].value);
    var desconto_maximo = parseInt(produto.dataset.maximo);
    var valor = parseFloat(produto.getAttribute('label'));
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
    console.log('iniciou produto , quantidade: ' + quantidade + ', desconto_maximo ' + desconto_maximo + ', valor: ' + valor + ', acrescimo: ' + acrescimo + ', valor_unitario: ' + valor_unitario + ', valor_total: ' + valor_total);
    form["valor-produto-unitario"].value = valor_unitario;
    form["valor-produto-total"].value = valor_total;
}

function produtoClearFunction() {
    var form = document.forms["form-produto"];
    form["quantidade"].value = 1;
    form["desconto"].max = 0;
    form["acrescimo"].max = 0;
    form["desconto"].value = 0.0;
    form["acrescimo"].value = 0.0;
    form["valor-servico-unitario"].value = 0.0;
    form["valor-servico-total"].value = 0.0;
}

//----------------------------------------------------------------------------------------------------------------------------
// FUNÇÕES   PARA   
//----------------------------------------------------------------------------------------------------------------------------


function finalizarSend(val) {
    var atendimento = val.elements['total_atendimento'].value;
    var pagamento = val.elements['total_pagamento'].value;
    var dif = atendimento - pagamento;
    if (dif > 0.09) {
        alert('O valor total do atendimento que é R$' + atendimento + ' não confere com o do pagamento que é R$' + pagamento);
        return false;
    }
    return true;
}

function myFunction(val) {
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
}

/*              
    var form = document.forms["form-servico"] ;
    var servico = document.getElementById('div-form-servico-servico').getElementsByClassName("es-visible selected")[0] ;                 
    var quantidade = parseInt( form["quantidade"].value );                
    var desconto_maximo = parseInt(  servico.dataset.maximo );                
    var valor = parseFloat(  servico.getAttribute('label') );
    form["desconto"].max = ( desconto_maximo * valor / 100); 
    form["acrescimo"].max = valor ;   
    form["servico_id"].value = servico.value ; 

    if( form["desconto"].value == ''){form["desconto"].value = 0.0;}                   
    var desconto =  parseFloat( form["desconto"].value) ;                           
    if(form["acrescimo"].value == ''){form["acrescimo"].value = 0.0;}  

    var acrescimo = parseFloat(  form["acrescimo"].value );
    var valor_unitario = valor - desconto + acrescimo ;  
    var valor_total = valor_unitario * quantidade;          
    form["valor-servico-unitario"].value = valor_unitario;
    form["valor-servico-total"].value = valor_total;

    //var max = parseFloat( form.elements['servico_id'].options[form.elements['servico_id'].selectedIndex].text );            
    //var quantidade = parseInt(form.elements['quantidade'].value);
    //alert(quantidade);
    //var desconto_maximo =  parseInt(form.elements['servico_id'].options[form.elements['servico_id'].selectedIndex].dataset['maximo']);
    

    //form.elements['desconto'].max = ( desconto_maximo * max / 100); 
   // form.elements['acrescimo'].max = max ;   
    //if(form.elements['desconto'].value == '')
        //form.elements['desconto'].value = 0.0;
    //var desconto =  parseFloat( form.elements['desconto'].value) ;            
    //if(form.elements['acrescimo'].value == '')
        //form.elements['acrescimo'].value = 0.0;

    //var acrescimo = parseFloat( form.elements['acrescimo'].value );
    //var valor_unitario = max - desconto + acrescimo ;  
    //var valor_total = valor_unitario * quantidade;           
    //form.elements['valor-servico-unitario'].value = valor_unitario;
    //form.elements['valor-produto-total'].value = valor_total;
    //var max = val.options[val.selectedIndex].text;
    //val.form.elements['desconto'].max = (4 * max / 5 ); 

*/

//var max = parseFloat( produto.getAttribute('label') );
// var max =  document.getElementsByClassName("es-visible")[0].dataset.maximo;
// alert(max);
// var max =  document.getElementsByClassName("es-visible")[0].getAttribute('label');
// alert(max);                
//var max = parseFloat( form.attr('label') );
//var max = parseFloat(  document.getElementsByClassName("es-visible")[0].attr('label') );
//var quantidade = parseInt( document.forms["form-produto"]["quantidade"].value );
//var max = parseFloat(  document.getElementsByClassName("es-visible")[0].attr('data-maximo') );
//var desconto_maximo = parseInt( form.attr('data-maximo') );
//document.forms["form-produto"]["desconto"].max = ( desconto_maximo * max / 100); 
//var max = parseFloat( form.elements['produto_id'].options[form.elements['produto_id'].selectedIndex].text );            
//var quantidade = parseInt(form.elements['quantidade'].value);
//var desconto_maximo =  parseInt(form.elements['produto_id'].options[form.elements['produto_id'].selectedIndex].dataset['maximo']);
//form.elements['desconto'].max = ( desconto_maximo * max / 100);

/***/ }),

/***/ 2:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("./resources/assets/js/atendimento.js");


/***/ })

/******/ });