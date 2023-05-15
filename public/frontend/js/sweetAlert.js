(   

function successAlert(){
    var str = message; // get from alert message controller
    var typeAlert = type;
    if (typeAlert == 0){
        const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 10000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })
            Toast.fire({
            icon: 'info',
            title: str,
            //background: 'success',\
            color:'#0dcaf0',
            })
    }else if(typeAlert == 1){
        const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 10000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })
            Toast.fire({
            icon: 'success',
            title: str,
            color: '#198754',
            })
    }
}
)()