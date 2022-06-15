import './bootstrap';

import Alpine from 'alpinejs';

import Swal from 'sweetalert2'

window.Alpine = Alpine;

Alpine.start();

window.Toast = Swal.mixin({
    toast: true,
    position: 'top',
    showConfirmButton: false,
    showCloseButton: true,
    timer: 5000,
    timerProgressBar:true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

window.addEventListener('alert',({detail:{type,message}})=>{
    Toast.fire({
        icon:type,
        title:message
    })
});