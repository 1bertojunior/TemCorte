function validaCPF(cpf) {
    cpf.value = cpf.value.replace(/\D/g, "") // Remove tudo que não é dígito
    .replace(/(\d{3})(\d)/, "$1.$2") // Coloca um ponto entre o terceiro e o quarto dígitos
    .replace(/(\d{3})(\d)/, "$1.$2") // Coloca um ponto entre o sétimo e o oitavo dígitos
    .replace(/(\d{3})(\d{1,2})$/, "$1-$2"); // Coloca um hífen entre o décimo e o décimo primeiro dígitos

}

function validarCpf(cpf) {
  // Remove qualquer caractere que não seja número
  cpf = cpf.replace(/\D/g, '');

  // Verifica se o CPF tem 11 dígitos
  if (cpf.length !== 11) {
    return false;
  }

  // Verifica se todos os dígitos são iguais (CPF inválido)
  if (/^(\d)\1+$/.test(cpf)) {
    return false;
  }

  // Calcula os dois últimos dígitos verificadores
  let soma = 0;
  for (let i = 0; i < 9; i++) {
    soma += parseInt(cpf.charAt(i)) * (10 - i);
  }
  let resto = 11 - (soma % 11);
  let digito1 = resto === 10 || resto === 11 ? 0 : resto;

  soma = 0;
  for (let i = 0; i < 10; i++) {
    soma += parseInt(cpf.charAt(i)) * (11 - i);
  }
  resto = 11 - (soma % 11);
  let digito2 = resto === 10 || resto === 11 ? 0 : resto;

  // Verifica se os dígitos verificadores estão corretos
  if (parseInt(cpf.charAt(9)) !== digito1 || parseInt(cpf.charAt(10)) !== digito2) {
    return false;
  }

  // CPF válido
  return true;
}

// Form configuration

var form = document.getElementById('editConfig');
var phoneInput = document.getElementsByName('phone')[0];

// Debounce function
function debounce(func, delay) {
  var timeout;
  return function() {
    var context = this, args = arguments;
    clearTimeout(timeout);
    timeout = setTimeout(function() {
      func.apply(context, args);
    }, delay);
  };
}

// Function to format phone number
function formatPhoneNumber() {
  var phoneValue = phoneInput.value;
  
  // Remove all non-digit characters
  phoneValue = phoneValue.replace(/\D/g, '');
  
  // Apply phone number formatting
  phoneValue = phoneValue.replace(/^(\d{2})(\d{0,5})(\d{0,4})$/, function(match, p1, p2, p3) {
    if (p3) {
      return '(' + p1 + ') ' + p2 + '-' + p3;
    } else if (p2) {
      return '(' + p1 + ') ' + p2;
    } else {
      return '(' + p1;
    }
  });
  
  // Update the input value with the formatted phone number
  phoneInput.value = phoneValue;
  
  // Check phone number validity
  if (!checkPhone(phoneValue)) {
    phoneInput.style.border = '2px solid red';
  } else {
    phoneInput.style.border = '';
  }
}

phoneInput.addEventListener('input', debounce(formatPhoneNumber, 100));

form.addEventListener('submit', function(event) {
  var phoneValue = phoneInput.value;

  if (!checkPhone(phoneValue)) {
    phoneInput.style.border = '2px solid red';
    event.preventDefault();
  }
});

function checkPhone(phoneValue) {
  var phoneRegex = /^\(\d{2}\) \d{4,5}\-\d{4}$/;
  return phoneRegex.test(phoneValue);
}



// // Form configuration
// var form = document.getElementById('editConfig');
// var phoneInput = document.getElementsByName('phone')[0];

// phoneInput.addEventListener('keyup', function() {
//   var phoneValue = phoneInput.value;
  
//   // Remove all non-digit characters
//   phoneValue = phoneValue.replace(/\D/g, '');
  
//   // Apply phone number formatting
//   phoneValue = phoneValue.replace(/^(\d{2})(\d{5})(\d{4})$/, '($1) $2-$3');
  
//   // Update the input value with the formatted phone number
//   phoneInput.value = phoneValue;
  
//   // Check phone number validity
//   if (!checkPhone(phoneValue)) {
//     phoneInput.style.border = '2px solid red';
//   } else {
//     phoneInput.style.border = '';
//   }
// });

// form.addEventListener('submit', function(event) {
//   var phoneValue = phoneInput.value;

//   if (!checkPhone(phoneValue)) {
//     phoneInput.style.border = '2px solid red';
//     event.preventDefault();
//   }
// });

// function checkPhone(phoneValue) {
//   var phoneRegex = /^\(\d{2}\) \d{5}\-\d{4}$/;
//   return phoneRegex.test(phoneValue);
// }
