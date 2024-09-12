document.addEventListener("DOMContentLoaded" , function(){
    document.getElementById("formulario").addEventListener('submit', validarFormulario);
});

function validarFormulario(evento){
    evento.preventDefault();
    var usuario = document.getElementById('usuario').value;
    if(usuario.lenght ==0){
        alert('Favor de escribir su usuario');
        retunrn;
    }
    var password = document.getElementById('password').value;
    if (password.lenght < 4) {
        alert('la clave es inválida');
        return;
    }
    this.submit();
}