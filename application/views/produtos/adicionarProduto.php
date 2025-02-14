<style>
    /* Hiding the checkbox, but allowing it to be focused */
    .badgebox {
        opacity: 0;
    }

    .badgebox+.badge {
        /* Move the check mark away when unchecked */
        text-indent: -999999px;
        /* Makes the badge's width stay the same checked and unchecked */
        width: 27px;
    }

    .badgebox:focus+.badge {
        /* Set something to make the badge looks focused */
        /* This really depends on the application, in my case it was: */

        /* Adding a light border */
        box-shadow: inset 0px 0px 5px;
        /* Taking the difference out of the padding */
    }

    .badgebox:checked+.badge {
        /* Move the check mark back when checked */
        text-indent: 0;
    }
</style>
<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="fas fa-shopping-bag"></i>
                </span>
                <h5>Cadastro de Produto</h5>
            </div>
            <div class="widget_box_Painel2">
                <?php echo $custom_error; ?>
                <form action="<?php echo current_url(); ?>" id="formProduto" method="post" class="form-horizontal">
                    <div class="control-group">
                        <label for="codDeBarra" class="control-label">Código de Barra<span class=""></span></label>
                        <?php function gerar_cod_barras($tamanho, $maiusculas, $minusculas, $numeros, $simbolos){
  $ma = "ABCDEFGHIJKLMNOPQRSTUVYXWZ"; // $ma contem as letras maiúsculas
  $mi = "abcdefghijklmnopqrstuvyxwz"; // $mi contem as letras minusculas
  $nu = "0123456789"; // $nu contem os números
  $si = "!@#$%¨&*()_+="; // $si contem os símbolos

  if ($maiusculas){
        // se $maiusculas for "true", a variável $ma é embaralhada e adicionada para a variável $cod_barras
        $cod_barras .= str_shuffle($ma);
  }

    if ($minusculas){
        // se $minusculas for "true", a variável $mi é embaralhada e adicionada para a variável $cod_barras
        $cod_barras .= str_shuffle($mi);
    }

    if ($numeros){
        // se $numeros for "true", a variável $nu é embaralhada e adicionada para a variável $cod_barras
        $cod_barras .= str_shuffle($nu);
    }

    if ($simbolos){
        // se $simbolos for "true", a variável $si é embaralhada e adicionada para a variável $cod_barras
        $cod_barras .= str_shuffle($si);
    }

    // retorna a cod_barras embaralhada com "str_shuffle" com o tamanho definido pela variável $tamanho
    return substr(str_shuffle($cod_barras),0,$tamanho);
}
?>
                        <div class="controls">
                            <input id="codDeBarra" type="text" name="codDeBarra" maxlength="13" value="<?php echo gerar_cod_barras(10, false, false, true, false); ?><?php echo gerar_cod_barras(2, false, false, true, false); ?>" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="descricao" class="control-label">Descrição<span class="required">*</span></label>
                        <div class="controls">
                            <input id="descricao" type="text" name="descricao" value="<?php echo set_value('descricao'); ?>" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Tipo de Movimento</label>
                        <div class="controls">
                            <label for="entrada" class="btn btn-default" style="margin-top: 5px;">Entrada
                                <input type="checkbox" id="entrada" name="entrada" class="badgebox" value="1" checked>
                                <span class="badge">&check;</span>
                            </label>
                            <label for="saida" class="btn btn-default" style="margin-top: 5px;">Saída
                                <input type="checkbox" id="saida" name="saida" class="badgebox" value="1" checked>
                                <span class="badge">&check;</span>
                            </label>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="precoCompra" class="control-label">Preço de Compra<span class="required">*</span></label>
                        <div class="controls">
					       <input style="width: 9em;" id="precoCompra" class="money" type="text" name="precoCompra" onblur="calcular()" value="<?php echo set_value('precoCompra'); ?>" /> Margem <input style="width: 3em;" id="num2"  type="text" placeholder="%" onblur="calcular()" maxlength="3" size="2"/><br /><strong><span style="color: red" id="resultado"></span><strong>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="precoVenda" class="control-label">Preço de Venda<span class="required">*</span></label>
                        <div class="controls">
                            <input id="precoVenda" class="money" type="text" name="precoVenda" value="<?php echo set_value('precoVenda'); ?>" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="unidade" class="control-label">Unidade<span class="required">*</span></label>
                        <div class="controls">
                            <select id="unidade" name="unidade"></select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="estoque" class="control-label">Estoque<span class="required">*</span></label>
                        <div class="controls">
                            <input id="estoque" type="text" name="estoque" value="<?php echo set_value('estoque'); ?>" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="estoqueMinimo" class="control-label">Estoque Mínimo</label>
                        <div class="controls">
                            <input id="estoqueMinimo" type="text" name="estoqueMinimo" value="<?php echo set_value('estoqueMinimo'); ?>" />
                        </div>
                    </div>
                    <div class="form_actions" align="center">
                    <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Adicionar</button>
                    <a href="<?php echo base_url() ?>index.php/produtos" id="" class="btn btn-warning"><i class="fas fa-backward"></i> Voltar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>assets/js/maskmoney.js"></script>
<script type="text/javascript">
    function calcular(){
    	var precoCompra = Number(document.getElementById("precoCompra").value);
    	var num2 = Number(document.getElementById("num2").value);
    	var elemResult = document.getElementById("resultado");
    	
    if (elemResult.textContent === undefined) {
    	elemResult.textContent = "Preço de venda: R$ " + String(precoCompra * num2 / 100 + precoCompra ) + ".	";
    	}
    else { // IE
    	elemResult.innerText = "(Preço de venda: R$ " + String(precoCompra * num2 / 100 + precoCompra) + ")";
    }
	}
	
	$(document).ready(function() {
        $(".money").maskMoney();
        $.getJSON('<?php echo base_url() ?>assets/json/tabela_medidas.json', function(data) {
            for (i in data.medidas) {
                   $('#unidade').append(new Option(data.medidas[i].descricao, data.medidas[i].sigla));
            }
        });
        $('#formProduto').validate({
            rules: {
                descricao: {
                    required: true
                },
                unidade: {
                    required: true
                },
                precoVenda: {
                    required: true
                },
                estoque: {
                    required: true
                }
            },
            messages: {
                descricao: {
                    required: 'Campo Requerido.'
                },
                unidade: {
                    required: 'Campo Requerido.'
                },
                precoVenda: {
                    required: 'Campo Requerido.'
                },
                estoque: {
                    required: 'Campo Requerido.'
                }
            },
            errorClass: "help-inline",
            errorElement: "span",
            highlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
        });
    });
</script>
