function Mensagem(msg, tempo){
  let timerInterval;
  Swal.fire({
    icon: "error",
    title: msg,
    timer: tempo,
    timerProgressBar: true,
    footer: '<a href="esquecisenha.html">Esqueceu sua senha?</a>'
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