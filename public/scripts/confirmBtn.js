$(document).ready(function () {
    
    $(".btn-confirm").click(function (e) { 
        e.preventDefault();

        const href = $(this).attr("href")

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, continue!',
        }).then((result) =>{
            if(result.value){
                document.location.href = href;
            }
        })

    });

});
