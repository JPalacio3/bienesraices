document.addEventListener('DOMContentLoaded', function() {
    eventListeners();

    // DARK MODE:
    darkMode();
});

// DARK MODE:

function darkMode() {
    // LEER LAS PREFERENCIAS DEL SISTEMA DE USUARIO:

    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: ligth )');
    // console.log(prefiereDarkMode.matches);

    if (prefiereDarkMode.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    } // Si prefiere Modo Oscuro agrega la clase dark-mode, caso contrario, la elimina y la pone por defecto.

    // ACTUALIZAR EL MODO DE PREFERENCIA: 

    prefiereDarkMode.addEventListener('change', function() {
        if (prefiereDarkMode.matches) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        } // Si prefiere Modo Oscuro agrega la clase dark-mode, caso contrario, la elimina y la pone por defecto.   
    })


    const botonDarkMode = document.querySelector('.dark-mode-boton');
    botonDarkMode.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');

    });

    //Para que el modo elegido se quede guardado en local-storage


    if (document.body.classList.contains('dark-mode')) {
        localStorage.setItem('modo-oscuro', 'true');
    } else {
        localStorage.setItem('modo-oscuro', 'false');
    }
};

//Obtenemos el modo del color actual
if (localStorage.getItem('modo-oscuro') == 'true') {
    document.body.classList.add('dark-mode');
} else {
    document.body.classList.remove('dark-mode');
}
// toggle: agrega o quita la clase 'dark-mode' cada vez que se haga click sobre el elemento.




// MENÚ RESPONSIVE DE HAMBURGUESA
function eventListeners() {
    // alert('prueba');
    const mobileMenu = document.querySelector('.mobile-menu');


    mobileMenu.addEventListener('click', navegacionResponsive);
}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');

    // navegacion.classList.toggle('navegacion-active'); // toggle() alterna entre dos clases

    if (navegacion.classList.contains('mostrar')) {
        navegacion.classList.remove('mostrar');
    } else {
        navegacion.classList.add('mostrar');
    } // add() agrega una clase, remove() elimina una clase. //Con toggle() se consigue el mismo resultado


}

// function cerrar() {
//     window.close();
// }

// function popUp(URL) {
//     window.open(URL, 'actualizar-borrar', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=900,height=700,left = 200,top = 900');
// }

function cancelar() {
    alert('SE CANCELARÁ LA OPERACIÓN');
    // Regresar a la pagina admin.php
    window.location.href = '../../admin/index.php';
}