// Mascara para cpf
function mascara(i){
    var v = i.value;
    if(isNaN(v[v.length-1])){ // impede entrar outro caractere que não seja número
        i.value = v.substring(0, v.length-1);
        return;
    }
    i.setAttribute("maxlength", "14");
    if (v.length == 3 || v.length == 7) i.value += ".";
    if (v.length == 11) i.value += "-";
}


// Macara para Telefone
const handlePhone = (event) => {
  let input = event.target
  input.value = phoneMask(input.value)
}

const phoneMask = (value) => {
  if (!value) return ""
  value = value.replace(/\D/g,'')
  value = value.replace(/(\d{2})(\d)/,"($1) $2")
  value = value.replace(/(\d)(\d{4})$/,"$1-$2")
  return value
}

//Valiação de força da senha
function verificarForcaSenha() {
  const senha = document.getElementById('senha').value;
  const forca = calcularForcaSenha(senha);
  const nivel = obterNivelSenha(forca);
  const requisitos = obterRequisitosSenha(senha);
  exibirNivelSenha(nivel);
  exibirRequisitosSenha(requisitos);
  atualizarBarraProgresso(forca);
}

function calcularForcaSenha(senha) {
  let forca = 0;

  if (senha.length >= 8) {
    forca += 25;
  }
  if (senha.match(/[a-z]/) && senha.match(/[A-Z]/)) {
    forca += 25;
  }
  if (senha.match(/[0-9]/)) {
    forca += 25;
  }
  if (senha.match(/[!@#$%^&*]/)) {
    forca += 25;
  }

  return forca;
}

function obterNivelSenha(forca) {
  if (forca >= 75) {
    return 'Forte';
  } else if (forca >= 50) {
    return 'Média';
  } else if (forca >= 25) {
    return 'Fraca';
  } else {
    return 'Muito Fraca';
  }
}

function obterRequisitosSenha(senha) {
  const requisitos = [];

  if (senha.length < 8) {
    requisitos.push('Pelo menos 8 caracteres');
  }
  if (!senha.match(/[a-z]/)) {
    requisitos.push('Pelo menos 1 letra minúscula');
  }
  if (!senha.match(/[A-Z]/)) {
    requisitos.push('Pelo menos 1 letra maiúscula');
  }
  if (!senha.match(/[0-9]/)) {
    requisitos.push('Pelo menos 1 número');
  }
  if (!senha.match(/[!@#$%^&*]/)) {
    requisitos.push('Pelo menos 1 caractere especial');
  }

  return requisitos;
}

function exibirNivelSenha(nivel) {
  // document.getElementById('nivel').innerHTML = `Nível de Senha: ${nivel}`;
}

function exibirRequisitosSenha(requisitos) {
  const requisitosElement = document.getElementById('requisitos');
  requisitosElement.innerHTML = '';

  requisitos.forEach((requisito) => {
    const requisitoElement = document.createElement('p');
    requisitoElement.textContent = requisito;
    requisitosElement.appendChild(requisitoElement);
  });
}

function atualizarBarraProgresso(forca) {
  const barraProgresso = document.getElementById('barra-progresso');
  const barraProgressoText = document.getElementById('barra-progresso-texto');

  barraProgresso.style.width = `${forca}%`;
  barraProgressoText.textContent = `${forca}%`;

  barraProgresso.className = '';
  if (forca < 30) {
    barraProgresso.classList.add('fraca');
  } else if (forca < 50) {
    barraProgresso.classList.add('media');
  } else if (forca < 70) {
    barraProgresso.classList.add('intermediaria');
  } else {
    barraProgresso.classList.add('forte');
  }
}

// Adicionando o evento de entrada para o campo de senha
document.getElementById('senha').addEventListener('input', verificarForcaSenha);
//validação cpf
function is_cpf (c) {

  if((c = c.replace(/[^\d]/g,"")).length != 11)
    return false;
    
    if (c.length != 11 ||
      c == "00000000000" ||
      c == "11111111111" ||
      c == "22222222222" ||
      c == "33333333333" ||
      c == "44444444444" ||
      c == "55555555555" ||
      c == "66666666666" ||
      c == "77777777777" ||
      c == "88888888888" ||
      c == "99999999999")
      return false;

  var r;
  var s = 0;

  for (i=1; i<=9; i++)
    s = s + parseInt(c[i-1]) * (11 - i);

  r = (s * 10) % 11;

  if ((r == 10) || (r == 11))
    r = 0;

  if (r != parseInt(c[9]))
    return false;

  s = 0;

  for (i = 1; i <= 10; i++)
    s = s + parseInt(c[i-1]) * (12 - i);

  r = (s * 10) % 11;

  if ((r == 10) || (r == 11))
    r = 0;

  if (r != parseInt(c[10]))
    return false;

  return true;
}


function fMasc(objeto,mascara) {
obj=objeto
masc=mascara
setTimeout("fMascEx()",1)
}

  function fMascEx() {
obj.value=masc(obj.value)
}

function mCPF(cpf){
cpf=cpf.replace(/\D/g,"")
cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
cpf=cpf.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
return cpf
}

cpfCheck = function (el) {
    document.getElementById('cpfResponse').innerHTML = is_cpf(el.value)? '<span style="color:green">válido</span>' : '<span style="color:red">inválido</span>' ;
    if(el.value=='') document.getElementById('cpfResponse').innerHTML = '';
}


// PREENCHER COMPO COM CEP
function limpa_formulário_cep() {
  //Limpa valores do formulário de cep.
  document.getElementById('rua').value=("");
  document.getElementById('bairro').value=("");
  document.getElementById('cidade').value=("");
  document.getElementById('uf').value=("");
}

function meu_callback(conteudo) {
if (!("erro" in conteudo)) {
  //Atualiza os campos com os valores.
  document.getElementById('rua').value=(conteudo.logradouro);
  document.getElementById('bairro').value=(conteudo.bairro);
  document.getElementById('cidade').value=(conteudo.localidade);
  document.getElementById('uf').value=(conteudo.uf);
} //end if.
else {
  //CEP não Encontrado.
  limpa_formulário_cep();
  alert("CEP não encontrado.");
}
}

function pesquisacep(valor) {

//Nova variável "cep" somente com dígitos.
var cep = valor.replace(/\D/g, '');

//Verifica se campo cep possui valor informado.
if (cep != "") {

  //Expressão regular para validar o CEP.
  var validacep = /^[0-9]{8}$/;

  //Valida o formato do CEP.
  if(validacep.test(cep)) {

      //Preenche os campos com "..." enquanto consulta webservice.
      document.getElementById('rua').value="...";
      document.getElementById('bairro').value="...";
      document.getElementById('cidade').value="...";
      document.getElementById('uf').value="...";

      //Cria um elemento javascript.
      var script = document.createElement('script');

      //Sincroniza com o callback.
      script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

      //Insere script no documento e carrega o conteúdo.
      document.body.appendChild(script);

  } //end if.
  else {
      //cep é inválido.
      limpa_formulário_cep();
      alert("Formato de CEP inválido.");
  }
} //end if.
else {
  //cep sem valor, limpa formulário.
  limpa_formulário_cep();
}
};

//Mascara para CEP
const handleZipCode = (event) => {
  let input = event.target
  input.value = zipCodeMask(input.value)
}

const zipCodeMask = (value) => {
  if (!value) return ""
  value = value.replace(/\D/g,'')
  value = value.replace(/(\d{5})(\d)/,'$1-$2')
  return value
}

//Sempre a primeira palavra ser maiuscula    
function converterPrimeiraLetraMaiuscula(input) {
  var palavras = input.value.split(" ");
  for (var i = 0; i < palavras.length; i++) {
      var palavra = palavras[i];
      palavras[i] = palavra.charAt(0).toUpperCase() + palavra.slice(1);
  }
  input.value = palavras.join(" ");
}

//Não inserir numero no nome
$('#nome_contacto').keypress(function(e) {
  var keyCode = (e.keyCode ? e.keyCode : e.which); // Variar a chamada do keyCode de acordo com o ambiente.
  if (keyCode > 47 && keyCode < 58) {
    e.preventDefault();
    alert("Apenas letras");
  }
});

//não inserir letra na idade
$('#nome_contacto').keypress(function(e) {
  var keyCode = (e.keyCode ? e.keyCode : e.which); // Variar a chamada do keyCode de acordo com o ambiente.
  if (keyCode > 47 && keyCode < 58) {
    e.preventDefault();
    alert("Apenas letras");
  }
});

//Mostrar senha
const toggleSenhaBtn = document.getElementById('toggleSenha');
const senhaInput = document.getElementById('senha');

toggleSenhaBtn.addEventListener('click', function() {
  if (senhaInput.type === 'password') {
    senhaInput.type = 'text';
    toggleSenhaBtn.innerHTML = '<i class="fas fa-eye-slash"></i>';
  } else {
    senhaInput.type = 'password';
    toggleSenhaBtn.innerHTML = '<i class="fas fa-eye"></i>';
  }
});

