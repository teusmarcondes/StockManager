function Mensagem(msg, tempo){
  let timerInterval;
  Swal.fire({
    icon: "error",
    title: msg,
    timer: tempo,
    timerProgressBar: true,
    footer: '<a class="registrar" href="esqueciasenha.html">Esqueceu sua senha?</a>'
  });
}

function Mensagem2(msg, tempo){
  let timerInterval;
  Swal.fire({
    icon: "error",
    title: msg,
    timer: tempo,
    timerProgressBar: true,
  });
}