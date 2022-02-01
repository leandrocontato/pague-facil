const { replace } = require("lodash");

jQuery(function($) {

    function ThemePagueFacil() {
        var _     = this; 
        _.baseUrl = $('meta[name="base-url"]').attr('content');

        _.masked();
        _.select();

        //Events
        $(".btn-menu").on("click", function(e){
            e.preventDefault();
            _.controlMenu();
        });

        $(".btn-delete").on("click", function(e){
            e.preventDefault();
            _.destroy($(this).attr('href'));
        });

        $(".customer select#type").on("change", function(e){
            e.preventDefault();

            if ($(this).val() == '1') {
                $(".type-physical").removeClass("d-none");
                $(".type-physical #first_name").attr('disabled', false);
                $(".type-physical #last_name").attr('disabled', false);
                $(".type-physical #cpf").attr('disabled', false);

                $(".type-jury").addClass("d-none");
                $(".type-jury #company_name").attr('disabled', true);
                $(".type-jury #fantasy_name").attr('disabled', true);
                $(".type-jury #cnpj").attr('disabled', true);
            } else {
                $(".type-physical").addClass("d-none");
                $(".type-physical #first_name").attr('disabled', true);
                $(".type-physical #last_name").attr('disabled', true);
                $(".type-physical #cpf").attr('disabled', true);

                $(".type-jury").removeClass("d-none");
                $(".type-jury #company_name").attr('disabled', false);
                $(".type-jury #fantasy_name").attr('disabled', false);
                $(".type-jury #cnpj").attr('disabled', false);
            }
        });

        $("select#countrie_id").on("change", function() {
            if($(this).val() == ""){
                return;
            }

            $("select#state_id").attr('disabled', true).val('');
            $("select#citie_id").attr('disabled', true).val('');

            _.state($(this).val());
        });

        $("select#state_id").on("change", function() {
            $("select#citie_id").attr('disabled', true).html('<option value="">Selecione</option>');
            if($(this).val() == "")
            {
                return;
            }

            _.citie($("select#countrie_id").val(), $(this).val());
        });

        //Auto load

        if ($(".customer select#type").val() == '1') {
            $(".type-physical").removeClass("d-none");
            $(".type-physical #first_name").attr('disabled', false);
            $(".type-physical #last_name").attr('disabled', false);
            $(".type-physical #cpf").attr('disabled', false);

            $(".type-jury").addClass("d-none");
            $(".type-jury #company_name").attr('disabled', true);
            $(".type-jury #fantasy_name").attr('disabled', true);
            $(".type-jury #cnpj").attr('disabled', true);

        } else {
            $(".type-physical").addClass("d-none");
            $(".type-physical #first_name").attr('disabled', true);
            $(".type-physical #last_name").attr('disabled', true);
            $(".type-physical #cpf").attr('disabled', true);

            $(".type-jury").removeClass("d-none");
            $(".type-jury #company_name").attr('disabled', false);
            $(".type-jury #fantasy_name").attr('disabled', false);
            $(".type-jury #cnpj").attr('disabled', false);
        }

        if (localStorage.getItem('sidebarMenuActive') == 'close') {
            $("body").addClass("sidebarMenuActive");
        }

        if ($("select#countrie_id").length > 0) {
          _.countrie();
        } 
    }

    ThemePagueFacil.prototype.controlMenu = function() {
        var _  = this;

        if ($("body").hasClass("sidebarMenuActive")) {
            $("body").removeClass("sidebarMenuActive"); 
            localStorage.setItem('sidebarMenuActive', 'open');
        } else {
            $("body").addClass("sidebarMenuActive");
            localStorage.setItem('sidebarMenuActive', 'close');
        }
    }

    ThemePagueFacil.prototype.destroy = function(url) {
        var _  = this;

        new swal({
          text: "Deseja realmente excluir esse item?",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3b0071',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Cancelar', 
          confirmButtonText: 'Sim'
        }).then((result) => {
            if (result.isConfirmed) {
             window.location.href = url; 
            }
        });
    }

    ThemePagueFacil.prototype.masked = function(url) {
        var _  = this;

        $('[name=phone]').mask('(00) 0000-0000');
        $('[name=cellphone]').mask('(00) 00000-0000');
        $('[name=cpf]').mask('999.999.999-99');
        $("[name=cnpj]").mask("99.999.999/9999-99");
        $("[name=postal_code], [name=cep]").mask("99999-999");
        $('[data-money]').mask('000.000.000.000.000,00', {reverse: true});
        $('[data-integrate], [name=hours_consumed], [name=hours_charged]').mask('0#');
        $('[data-percentage]').mask('##0.00', {reverse: true});
        $('[data-cref]').mask('999999-A/AA');
        $('[name=number_card]').mask('9999 9999 9999 9999');
        
        $('[data-day]').mask("99",{
            onKeyPress: function(val, e, field, options) {
               if(val > 31){
                $(field).val(31);
               }
            }
        });
    }

    /***start cpfcnpj */
    var behavior = function(val) {
        return val.replace(/\D/g, '').length === 11 ? '000.000.000-000' : '00.000.000/0000-00';
    },
    options = {
        onKeyPress: function(val, e, field, options) {
            field.mask(behavior.apply({}, arguments), options);
        }
    };
    $('#cpfcnpj').mask(behavior, options);
    /***end cpfcnpj */

    ThemePagueFacil.prototype.select = function(url) {
        var _  = this;

        $('select').select2({
            placeholder: 'Selecione',
            allowClear: true
        });
    }

    ThemePagueFacil.prototype.countrie = function() {
        var _ = this;
       
        $.get(_.baseUrl + "/api/countrie?per_page=999999999", function(data) {

            var html = '<option value="">Selecione</option>';

            $.each(data.data, function(index, value) {
               var selectedStatus = ($("select#countrie_id").data('active') == value.countrie_id) ? "selected" : "";
               html += '<option value="'+ value.countrie_id +'" '+ selectedStatus +'>'+ value.name +'</option>';
            });

           $("select#countrie_id").html(html);

           if (!$("select#countrie_id").is('[readonly]')) {
            $("select#countrie_id").attr('disabled', false);
           }

        }).done(function() {

            if($("select#countrie_id").val() != "") {
                _.state($("select#countrie_id").val());
            }
        });       
    }

    ThemePagueFacil.prototype.state = function(countrie_id) {
       var _ = this;

        $.get(_.baseUrl + "/api/state?countrie_id="+countrie_id+"&per_page=999999999", function(data) {
           var html = '<option value="">Selecione</option>';

            $.each(data.data, function(index, value) {
               var selectedStatus = ($("select#state_id").data('active') == value.state_id) ? "selected" : "";
               html += '<option value="'+ value.state_id +'" '+ selectedStatus +'>'+ value.name +'</option>';
            });

           $("select#state_id").html(html);

           if (!$("select#state_id").is('[readonly]')) {
            $("select#state_id").attr('disabled', false)
           }

        }).done(function() {

            if($("select#state_id").val() != "") {
              _.citie($("select#countrie_id").val(), $("select#state_id").val());
            }
        });       
    }

    ThemePagueFacil.prototype.citie = function(countrie_id, state_id) {  
        var _ = this;

        $.get(_.baseUrl + "/api/citie?countrie_id="+countrie_id+"&state_id="+state_id+"&per_page=999999999", function(data) {
           var html = '<option value="">Selecione</option>';

            $.each(data.data, function(index, value) {
               var selectedStatus = ($("select#citie_id").data('active') == value.citie_id) ? "selected" : "";
               html += '<option value="'+ value.citie_id +'" '+ selectedStatus +'>'+ value.name +'</option>';
            });

            $("select#citie_id").html(html);

            if (!$("select#citie_id").is('[readonly]')) {
                $("select#citie_id").attr('disabled', false);
            }
        });
    }

    /***start validação number_card e flag_card */
    $("#number_card").on('keyup',function(){   
        var type = $.payment.cardType($(this).val()); //test card number
        var ccNum = $(this).val()
            ccNum = ccNum.replace(/\s/g, '');
        
        if(ccNum == "0000000000000000" || ccNum == "1111111111111111" || ccNum == "2222222222222222"
        || ccNum == "3333333333333333" || ccNum == "4444444444444444" || ccNum == "5555555555555555"
        || ccNum == "6666666666666666" || ccNum == "7777777777777777" || ccNum == "8888888888888888"
        || ccNum == "9999999999999999")
        {
            $('#number_card_validate').removeClass('d-none').addClass('d-block');
            $('#number_card_validate').html('Cartão Inválido!')
            return false;  
        }
             
            if (type == 'visa') {  
                $("#number_card").addClass('icon-visa'); 
            } else {
                $("#number_card").removeClass('icon-visa');    
            }

            if (type == 'mastercard') {  
                $("#number_card").addClass('icon-master'); 
            } else {
                $("#number_card").removeClass('icon-master');    
            }

            if (type == 'elo') {  
                $("#number_card").addClass('icon-elo'); 
            } else {
                $("#number_card").removeClass('icon-elo');    
            }

            if (type == 'amex') {  
                $("#number_card").addClass('icon-amex'); 
            } else {
                $("#number_card").removeClass('icon-amex');    
            }

            if (type == 'hiper') {  
                $("#number_card").addClass('icon-hiper'); 
            } else {
                $("#number_card").removeClass('icon-hiper');    
            }

            });   
    /***end validação number_card e flag_card */

    /***start validade */
    window.onload = function() {
        const validade = document.getElementById('validade');
        var validade_mask = new IMask(validade, {
            mask: 'MM{/}YY',
            groups: {
                YY: new IMask.MaskedPattern.Group.Range([2022, 2099]),
                MM: new IMask.MaskedPattern.Group.Range([1, 12]),
            }
        });
        validade_mask.on('accept', function() {
            if (validade_mask.value.length == 0) {
                document.getElementById('validade').innerHTML = '01/23';
            } else {
                document.getElementById('validade').innerHTML = validade_mask.value;
            }
        });
    }
    /***end validade */
   
    new ThemePagueFacil();
});