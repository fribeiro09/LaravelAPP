// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      $( ".validar" ).on('click', function() {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            addMascara();
            event.preventDefault();
            event.stopPropagation();
          } else {
            $(".submit_observation").click();
          }

          form.classList.add('was-validated');
        }, false);
      });
    });
  }, false);
})();

var filtroTeclas = function(event) {
    return ((event.charCode >= 48 && event.charCode <= 57))
}

var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];
function ValidateSingleInput(oInput, idImg) {
    if (oInput.type == "file") {
        var sFileName = oInput.value;
        if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) {
                var sCurExtension = _validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }

            if (!blnValid) {
                alert("Desculpe, o arquivo " + sFileName + " é invalido, as extensões permitidas são: " + _validFileExtensions.join(", "));
                oInput.value = "";
                return false;
            }
        }
    }
    idImgModal = idImg + "_modal";
    document.getElementById(idImg).src = window.URL.createObjectURL(oInput.files[0]);
    document.getElementById(idImgModal).src = window.URL.createObjectURL(oInput.files[0]);
    return true;
}

function addMascara() {
  var SPMaskBehavior = function (val) {
    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
  },
  spOptions = {
    onKeyPress: function(val, e, field, options) {
        field.mask(SPMaskBehavior.apply({}, arguments), options);
      }
  };

  $('.mask_cellular').mask(SPMaskBehavior, spOptions);
  $('.mask_cpf').mask('000.000.000-00', {reverse: true});
  $('.mask_cep').mask('00000-000');
  $('.mask_date').mask('00/00/0000');
  $('.mask_time').mask('00:00:00');
}

$('.salvar').on('click', function() {
  $('.mask_cellular').unmask();
  $('.mask_cpf').unmask();
  $('.mask_cep').unmask();
});

addMascara();
