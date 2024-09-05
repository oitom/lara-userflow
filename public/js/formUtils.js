// public/js/formUtils.js

// Máscara CPF 999.999.999-99
function applyCpfMask($input) {
  $input.on('input', function () {
    let value = $(this).val().replace(/\D/g, '');
    if (value.length <= 11) {
      value = value.replace(/(\d{3})(\d)/, '$1.$2');
      value = value.replace(/(\d{3})(\d)/, '$1.$2');
      value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
    }
    $(this).val(value);
  });
}

// Máscara CEP 99999-99
function applyCepMask($input) {
  $input.on('input', function () {
    let value = $(this).val().replace(/\D/g, '');
    if (value.length <= 8) {
      value = value.replace(/(\d{5})(\d)/, '$1-$2');
    }
    $(this).val(value);
  });
}

// Máscara Data de Nascimento (dd/mm/yyyy)
function applyDateMask($input) {
  $input.on('input', function () {
    let value = $(this).val().replace(/\D/g, '');
    if (value.length <= 8) {
      value = value.replace(/(\d{2})(\d)/, '$1/$2');
      value = value.replace(/(\d{2})(\d)/, '$1/$2');
    }
    $(this).val(value);
  });
}

function validarCpf(cpf) {
  // Remove caracteres não numéricos
  cpf = cpf.replace(/[^\d]+/g, '');

  // Verifica se o CPF tem 11 dígitos ou se são números repetidos
  if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) {
    return false;
  }

  // Validação do primeiro dígito verificador
  let soma = 0;
  for (let i = 0; i < 9; i++) {
    soma += parseInt(cpf.charAt(i)) * (10 - i);
  }
  let resto = 11 - (soma % 11);
  let primeiroDigitoVerificador = (resto === 10 || resto === 11) ? 0 : resto;
  if (primeiroDigitoVerificador !== parseInt(cpf.charAt(9))) {
    return false;
  }

  // Validação do segundo dígito verificador
  soma = 0;
  for (let i = 0; i < 10; i++) {
    soma += parseInt(cpf.charAt(i)) * (11 - i);
  }
  resto = 11 - (soma % 11);
  let segundoDigitoVerificador = (resto === 10 || resto === 11) ? 0 : resto;
  if (segundoDigitoVerificador !== parseInt(cpf.charAt(10))) {
    return false;
  }

  return true;
}

// Verifica se o cpf existe no BD
function checkCpfExists(cpf, callback) {
  $.ajax({
    url: '/validate-cpf/' + cpf,
    type: 'GET',
    dataType: 'json',
    success: function (response) {
      callback(response.exists);
    },
    error: function () {
      callback(false);
    }
  });
}
