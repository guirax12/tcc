jQuery.validator.addMethod("cpf", function(value, element) {
  value = jQuery.trim(value);
  value = value.replace('.','');
  value = value.replace('.','');
  cpf = value.replace('-','');
  while(cpf.length < 11 ) cpf = "0"+ cpf;  
  var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
  var a = [];
  var b = new Number;
  var c = 11;
  for (i=0; i<11; i++){
    a[i] = cpf.charAt(i);
    if (i < 9) b += (a[i] * --c);
  }
  if ((x = b % 11) < 2) {
    a[9] = 0 
  } else { 
      a[9] = 11-x 
    }
  b = 0;
  c = 11;
  for (y=0; y<10; y++) b += (a[y] * c--);
  if ((x = b % 11) < 2) {
    a[10] = 0; 
  } else { 
    a[10] = 11-x; 
  }

  var retorno = true;
  if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]) || cpf.match(expReg)) retorno = false;

  return this.optional(element) || retorno;

}, "Informe um CPF válido");

$.validator.addMethod('filesize', function (value, element, param) {
    return this.optional(element) || (element.files[0].size <= param)
}, 'File size must be less than {0}');




$(document).ready(function(){

$("#valor").maskMoney({symbol:'R$ ', 
showSymbol:true, thousands:'.', decimal:',', symbolStay: true});

  $("#formdiv").validate({
    errorClass: 'error',
    focusInvalid: true,
    ignore: "",
    rules: {
      valor: {
        required: true
        }
    },

    errorPlacement: function(error, element) { // render error placement for each input type
      var parent = $(element).parent().parent('.form-group');
      parent.removeClass('has-success').addClass('has-error');
    },

    highlight: function(element) { // hightlight error inputs
      var parent = $(element).parent().parent('.form-group');
      parent.removeClass('has-success').addClass('has-error');
    },

    success: function(label, element) {
      var parent = $(element).parent().parent('.form-group');
      parent.removeClass('has-error').addClass('has-success');
    }

  });
  });
 

function verificar() {
    
  if ($("#formdiv").valid()) {
   var data = $("#formdiv");

    $.ajax({
      type: "POST",
      url: "/call/usuario/recarga.php",
       data:  new FormData(data[0]),
      dataType: "html",
       processData: false,
      cache: false,
      contentType: false,
      success: function (result) {
        if(result == 1){
        Messenger().post({
          message: 'Atualizado com Sucesso.',
          type: 'success',
          showCloseButton:'yes',
          closeButtonText:'x',
          HideAfter:2
        })
      }
        
      },
      error: function() {
        Messenger().post({
          message: 'Erro na chamada! contate um administrador.',
          type: 'error',
          showCloseButton:'yes',
          closeButtonText:'x',
          HideAfter:2
        })
      }
    });
  }else{
    Messenger().post({
      message: 'Verificar o campo.',
      type: 'error',
      showCloseButton:'yes',
      closeButtonText:'x',
      HideAfter:2
    });
    return false;
  }
}


