// uma tela de cadastro de usuário ou colocar o campo telefone no CRUD.

document.addEventListener('DOMContentLoaded', function() {
    console.log("Sistema de Mensagens iniciado!");
    
    
});

// correção no telefone
document.addEventListener("DOMContentLoaded", () => {
    const tel = document.querySelector("input[name='telefone']");

    tel.addEventListener("input", () => {
        let v = tel.value.replace(/\D/g, "");

        if (v.length > 11) v = v.slice(0, 11);

        if (v.length > 6)
            tel.value = `(${v.slice(0,2)}) ${v.slice(2,7)}-${v.slice(7)}`;
        else if (v.length > 2)
            tel.value = `(${v.slice(0,2)}) ${v.slice(2)}`;
        else
            tel.value = v;
    });
});