function toglleMenu(){
  const menuMobile = document.getElementById("menu-mobile")
  
      if(menuMobile.className === "menu-mobile-active") {
          menuMobile.className = "menu-mobile"
      }else{
          menuMobile.className = "menu-mobile-active"
      }
  
}


const openModalButton = document.querySelector("#open-modal");
const closeModalButton = document.querySelector("#close-modal");
const modal = document.querySelector("#modal");
const fade = document.querySelector("#fade");

const toggleModal = () => {
modal.classList.toggle("hide");
fade.classList.toggle("hide");
};

[openModalButton, closeModalButton, fade].forEach((el) => {
el.addEventListener("click", () => toggleModal());
});


//Máscara CEP
function mascara_cep() {
var cep = document.getElementById('cep');
cep.value = cep.value.replace(/\D/g, ''); // Remove caracteres não numéricos
cep.value = cep.value.replace(/^(\d{5})(\d{3})$/, '$1-$2'); // Adiciona a máscara xxxx-xxx
}


//Máscara Celular
function mascara_celular() {
var celular = document.getElementById('celular');
if (celular.value.length == 2) {
  celular.value = '(' + celular.value + ')';
}
if (celular.value.length == 9) {
  celular.value = celular.value + '-';
}
}


//Máscara CPF
function mascara_cpf() {
var cpf = document.getElementById('cpf')
if (cpf.value.length == 3 || cpf.value.length == 7) {
  cpf.value = cpf.value += "."
} else if (cpf.value.length == 11) {
  cpf.value += "-"
}
}


//Validaçào de CEP - API do Correio
//Busca automática pelo CEP através do ViaCEP
function limpa_formulário_cep() {
  //Limpa valores do formulário de cep.
  document.getElementById('bairro').value = ("");
  document.getElementById('cidade').value = ("");
  document.getElementById('uf').value = ("");
}

function meu_callback(conteudo) {
  if (!("erro" in conteudo)) {
    //Atualiza os campos com os valores.
    document.getElementById('bairro').value = (conteudo.bairro);
    document.getElementById('cidade').value = (conteudo.localidade);
    document.getElementById('uf').value = (conteudo.uf);
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
    if (validacep.test(cep)) {

      //Preenche os campos com "..." enquanto consulta webservice.
      document.getElementById('bairro').value = "...";
      document.getElementById('cidade').value = "...";
      document.getElementById('uf').value = "...";

      //Cria um elemento javascript.
      var script = document.createElement('script');

      //Sincroniza com o callback.
      script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

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


//Validar Senha
let senha = document.getElementById('senha');
let confsenha = document.getElementById('confsenha');

function validarSenha() {
  if (senha.value != confsenha.value) {
    confsenha.setCustomValidity("Senhas diferentes!");
    confsehha.reportValidity();
    return false;
  } else {
    confsenha.setCustomValidity("");
    return true;
  }
}
confsenha.addEventListener('input', validarSenha);