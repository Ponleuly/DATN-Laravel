//(function)() ==> is Self-Invoking Functions : A self-invoking expression is invoked (started) automatically, without being called.
(function (){
    var txt = text; // get from alert message controller
    var typeAlert = type;
    if (typeAlert == 'error'){
        errorAlert(txt);
    }else if (typeAlert == 'info'){
        infoAlert(txt);
    }else if(typeAlert == 'success'){
        successAlert(txt);
    }else if(typeAlert == 'question'){
        questionAlert(txt);
    }
})();
// Info fun
function errorAlert(txt){
    const Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })
        Toast.fire({
            icon: 'error',
            title: txt,
            color:'#dc3545',
        })
}
// Info fun
function infoAlert(txt){
    const Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })
        Toast.fire({
            icon: 'info',
            title: txt,
            color:'#0dcaf0',
        })
}
// Success fun
function successAlert(txt){
    const Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })
        Toast.fire({
            icon: 'success',
            title: txt,
            color: '#198754',
        })
}
// Question fun
function questionAlert(txt){
    Swal.fire({
        position: 'top',
        title: 'Are you sure to remove all products from list?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        //confirmButtonText: '<a class="text-decoration-none text-white" href="/'+ txt + '">Yes</a>',
        confirmButtonText:'Yes, remove all'
      }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = txt;
            /*
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
          */
        }
      }) //No more success alert after choose yes
}