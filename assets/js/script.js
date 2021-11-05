var getUrl = window.location;
var base_url = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1] + "/";

    function categoriaOver(_this) {
    _this.addClass('bg-warning');
    _this.addClass('fw-bolder');
}

function categoriaOut(_this) {
    _this.removeClass('bg-warning');
    _this.removeClass('fw-bolder');
}

$(document).ready(function () {
    //$("#SobreCookies").toast('show');

    var getUrl = window.location;
    var base_url = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1] + "/";

    carregaCategorias();

    function carregaCategorias() {
        $.ajax({
            'url': base_url + 'IndexControler/CarregaCategorias',
            'dataType': 'JSON',
            'type': 'POST',
            data: { },
            complete: function (res) {

            },
            success: function (res) {
                var html = '';
                var htmlProds = '';

                if(res.length == 0){
                    var html = '<p class="noselect nav-link text-black-50" >Sem Categoria</p>';
                    var htmlProds = html;
                }
                
                for(var i = 0; i < res.length; i++) {
                    //html += '<li class="nav-item" >';
                    //html += '<a onmouseover="categoriaOver($(this))" onmouseout="categoriaOut($(this))" class="noselect nav-link text-black-50" href="#cat_' + res[i].id + '" >' + res[i].nomeCategoria + '</a>';
                    //html += '</li>';

                    htmlProds += '<div class="accordion" id="panel_' + res[i].id + '" >';
                    htmlProds += '<div class="accordion-item border-0">';
                    htmlProds += '<h2 class="accordion-header" id="panelsStayOpen-headingOne">';
                    htmlProds += '<button id="cat_' + res[i].id + '" class="accordion-button bg-light text-black-50" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-' + i + '" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">';
                    htmlProds += '# ' + res[i].nomeCategoria;
                    htmlProds += '</button>';
                    htmlProds += '</h2>';
                    htmlProds += '<div id="panelsStayOpen-' + i + '" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">';
                    htmlProds += '<div class="accordion-body">';
                    htmlProds += '<div class="row" id="prods_' + res[i].id + '" >';

                    listaProdutos(res[i].id);

                    htmlProds += '</div>';
                    htmlProds += '</div>';
                    htmlProds += '</div>';
                    htmlProds += '</div>';
                    htmlProds += '</div>';
                }
                
                //$('#categorias').html(html);
                $('#categProd').html(htmlProds);
                
            }
        });
        
    }

    function listaProdutos(id_categ) {
					
        $.ajax({
            'url': base_url + "IndexControler/listaProdutos",
            'type': "POST",
            'dataType': "JSON",
            data: { id: id_categ },
            complete: function () {
                
            },
            success: function (res) {
                var htmlProds = '';

                for(var i = 0; i < res.length; i++) {
                    htmlProds += '<div class="col-lg-6 col-md-12 col-sm-12">';
                    htmlProds += '<div class="card mb-3 clickCard" style="max-width: 540px;" onclick="maisInformacao($(this))" data-dados=\'' + JSON.stringify(res[i]) + '\' >';
                    htmlProds += '<div class="row g-0">';
                    htmlProds += '<div class="col-4">';
                    htmlProds += '<img src="' + base_url + 'uploads/produtos/' + res[i].fotoProduto + '" class="img-fluid rounded-start" alt="' + res[i].nomeProduto + '" >';
                    htmlProds += '</div>';
                    htmlProds += '<div class="col-8">';
                    htmlProds += '<div class="card-body d-flex flex-column" style="height: 100%;" >';
                    htmlProds += '<h5 class="card-title">' + res[i].nomeProduto + ' ' + (res[i].Peso ? Number(res[i].Peso) + '' + res[i].abreviacao: '') + '</h5>';
                    htmlProds += '<p class="card-text" >' + res[i].descricao + '</p>';
                    htmlProds += '<div class="mt-auto ms-auto" >';
                    if(Number(res[i].descontoValor) > 0) {
                        htmlProds += '<span style="font-size: 14px;" ><s class="text-muted" >' + (Number(res[i].valorAtual).toLocaleString("pt-BR", { style: "currency" , currency:"BRL"})) + '</s></span>';
                        htmlProds += '<br />';
                        htmlProds += '<span style="font-size: 18px; font-weight: bold; color: black;" >' + (Number(res[i].descontoValor).toLocaleString("pt-BR", { style: "currency" , currency:"BRL"})) + '</span> &nbsp;';
                    } else {
                        htmlProds += '<span style="font-size: 14px;" >' + (Number(res[i].valorAtual).toLocaleString("pt-BR", { style: "currency" , currency:"BRL"})) + '</span>';
                    }
                    htmlProds += '</div>';
                    htmlProds += '</div>';
                    htmlProds += '</div>';
                    htmlProds += '</div>';
                    htmlProds += '</div>';
                    htmlProds += '</div>';
                }

                $('#prods_' + id_categ).html(htmlProds);

            }

        });

    }

    $('#modalQTD').on('input', function(){
        this.style.width = ((this.value.length + 1) * 8) + 'px';
        
        if($(this).val() <= 0) {
            $(this).val(1);
        }

        $(this).val(this.value.replace(/\D/g, ''));
    });

    $('.btnMaxMin').on('click', function () {
        $('#modalQTD').css('width', (($('#modalQTD').val().length + 1) * 8) + 'px');

        var qtd = Number($('#modalQTD').val());
        if($(this).data('sum') == 'min' && qtd > 1)
            qtd--;
        if($(this).data('sum') == 'max')
            qtd++;

        $('#modalQTD').val(qtd);
        $('#modalPrecoProduto').html(Number(formataNumero($('#valorCobrado').html()) * qtd).toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));
    });

    function formataNumero(_number) {
        var number = _number.split('R$&nbsp;');
            number = number[0] == '' || number[0] == null ? number[1] : _number;
            number = number.split('.').join('');
            number = number.split(',').join('.');
        return Number(number);
    }

    $("#CadastroSite").on('click', function() {
        if($("#contentCadastro").hasClass('d-none') == true) {
            $("#contentLogin").addClass('d-none');
            $("#contentCadastro").removeClass('d-none');
        }
    });

    $("#LogaSite").on('click', function() {
        if($("#contentLogin").hasClass('d-none') == true) {
            $("#contentCadastro").addClass('d-none');
            $("#contentLogin").removeClass('d-none');
        }
    });

    if(readCookie("Cart") != null)
        atualizaCartAutomatico();
    function atualizaCartAutomatico() {
        var Cart = readCookie("Cart");
            Cart = JSON.parse(Cart);
        
        var totalQtdProdutos = 0;
        for(var i = 0; i < Cart.length; i++) {
            totalQtdProdutos += Number(Cart[i].qtd);
        }

        $('.totProdCart').html(totalQtdProdutos);
    }

    $(".itemCart").on('mouseleave', function() {
        $('.btnDeleteItem', $(this)).addClass('invisible');
        $('.bgDelete', $(this)).addClass('invisible');
    });
    
    $(".itemCart").on('mouseover', function() {
        $('.btnDeleteItem', $(this)).removeClass('invisible');
        $('.bgDelete', $(this)).removeClass('invisible');
    });

});

function linkParceiro(link) {
    window.open(link, '_blank');
}

function maisInformacao (_this) {
    var res = JSON.parse(_this.attr('data-dados'));
    var valorCobrado = Number(res.descontoValor > 0 ? res.descontoValor : res.valorAtual);

    $('#modalQTD').val(1);
    $('#modalNomeProduto').html(res.nomeProduto + ' ' + (res.Peso ? Number(res.Peso) + '' + res.abreviacao : ''));
    $('#modalFotoProduto').attr('src', base_url + 'uploads/produtos/' + res.fotoProduto);
    var html = '<p class="text-justify" ><b>Preço: </b>' + (res.descontoValor > 0 ? '<span style="font-size: 12px;" ><s class="text-muted" >' + (Number(res.valorAtual).toLocaleString("pt-BR", { style: "currency" , currency:"BRL"})) + '</s></span> &nbsp;' : '') + '<span id="valorCobrado" >' + valorCobrado.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}) + '</span><p>';
        if(res.descricao != null || res.descricao != '') html += '<p class="text-justify" ><b>Descrição: </b>' + res.descricao + '<p>';
    $('#ProdDados').html(html);
    $('#modalPrecoProduto').html(Number(valorCobrado * $('#modalQTD').val()).toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));

    $('#addProdutoCarrinho').attr('data-produto', res.id);

    $('#DetalhesProduto').modal('show');
}

// Cookies
function createCookie(name, value, days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        var expires = "; expires=" + date.toGMTString();
    }
    else var expires = "";               

    document.cookie = name + "=" + value + expires + "; path=/";
}

function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name, "", -1);
}

//eraseCookie('Cart');

function CarregaProdutosCart() {
    var Cart = readCookie("Cart");
    Cart = Cart != null ? JSON.parse(Cart) : [];
        
    var html = "";
    var totalProdutos = 0;
    var valFrete = 10;
    var tatalDesconto = 0;
    var totalQtdProdutos = 0;
    for(var i = 0; i < Cart.length; i++) {
        totalProdutos += Number(Cart[i].valor);
        totalQtdProdutos += Number(Cart[i].qtd);

        html += '<li class="list-group-item d-flex justify-content-between itemCart noselect" >';
        html += '<div class="invisible bgDelete" ></div>';
        html += '<div class="text-end invisible btnDeleteItem" ><button class="btn btn-sm btn-danger" onclick="DeletarProdutoCart(' + i + ')" ><i class="fa fa-trash" ></i></button></div>';
        html += '<span><img src="' + Cart[i].foto + '" class="rounded float-left img-fluid" style="width: 30px;" />' + Cart[i].qtd + " x " + Cart[i].nome + '</span>';
        html += '<span class="col-auto" >' + Number(Cart[i].valor).toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}) + '</span>';
        html += '</li>';
    }

    if(Cart.length == 0) {
        valFrete = 0;

        html += '<li class="list-group-item d-flex justify-content-center">';
        html += '<span>Não há produto selecionado.</span>';
        html += '</li>';
    }

    $('.totProdCart').html(totalQtdProdutos);
    $("#listaProdCards").html(html);
    $(".totalProdutos").html(totalProdutos.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));
    $(".valFrete").html(Number(valFrete).toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));
    $(".totalFinal").html(Number(totalProdutos + valFrete - tatalDesconto).toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));
}

function AddProdCart() {
    var Cart;
    if(readCookie("Cart") == null || readCookie("Cart") == '') {
        Cart = new Array();
        createCookie('Cart', JSON.stringify(Cart), 1);
    } else {
        Cart = readCookie('Cart');
        Cart = JSON.parse(Cart);
    }
    
    var idProd = $("#addProdutoCarrinho").attr('data-produto');
    var nome = $('#modalNomeProduto').html();
    var foto = $('#modalFotoProduto').attr('src');
    var qtd = $("#modalQTD").val();
    var valor = Number(($("#modalPrecoProduto").html().split('&nbsp;')[1]).split(',').join('.'));

    var c = Cart.length;
    var res = undefined;
    for(var i=0; i < c; i++) {
        if(Cart[i].id == idProd)
            res = i;
    }

    Cart[res == undefined ? c : res] = { 'id': idProd, 'nome': nome, 'foto': foto, 'qtd': qtd, 'valor': valor };

    createCookie('Cart', JSON.stringify(Cart), 1);

    //Atualiza o carrinho
    CarregaProdutosCart();
    if(res == undefined ? c : res)
        CriaAlerta('Item adicionado ao carrinho!', 0);
    else 
        CriaAlerta('Item atualizado no carrinho!', 0);
}

function DeletarProdutoCart(_key) {

}

function CriaAlerta(_msg = '', idxType = 0) {
    if($('.toast', $("#AlertaGeral")).hasClass('hide'))
        $('.toast', $("#AlertaGeral")).remove();
        
    var Alerts = [];
        Alerts[0] = ['Sucesso!', 'bg-success text-white'];
        Alerts[1] = ['Atenção!', 'bg-warning text-dark'];
        Alerts[2] = ['Erro!', 'bg-danger text-white'];
        Alerts[3] = ['Informativo!', 'bg-info text-dark'];

    html  = '<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" >';
    html += '<div class="toast-header ' + Alerts[idxType][1] + '">';
    html += '<strong class="me-auto" >' + Alerts[idxType][0] + '</strong>';
    html += '<button type="button" class="btn-close" onclick="$(this).parent().parent().toast(\'hide\')" ></button>';
    html += '</div>';
    html += '<div class="toast-body">' + _msg + '</div>';
    html += '</div>';

    $("#AlertaGeral").append(html);

    $('.toast:last', $("#AlertaGeral")).toast('show');
}

function ShowBtnDel(_this) {
    if($('.btnDeleteItem', $(_this)).hasClass('invisible')) {
        $('.btnDeleteItem', $(_this)).removeClass('invisible');
        $('.bgDelete', $(_this)).removeClass('invisible');
    } else {
        $('.btnDeleteItem', $(_this)).addClass('invisible');
        $('.bgDelete', $(_this)).addClass('invisible');
    }
}