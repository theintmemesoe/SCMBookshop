$(document).ready(function () 
{
    $("body").delegate('#btnDeleteProduct','click',function () {
        var id=$(this).attr('idd');
        var result=confirm("Are you sure want to delete?");
        if(result){

            $.ajax({
                type:'get',
                url:'delProduct',
                data:{id:id},
                success:function (msg) {
                    $("#del").html(msg);
                    if (msg === "<div class='alert alert-success'>delete success</div>") {
                        setInterval(function () {
                            window.location.reload();
                        }, 1000)
                    }
                }
            });
        }
    });
});


