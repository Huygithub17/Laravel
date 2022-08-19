function actionDelete(event){
    // Đã thực hiện thành công : 16/08/2022
    event.preventDefault(); // không cho reload lại trang ;
    let urlRequest = $(this).data('url');
    let that = $(this); // đây là button bên ngoài;
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'GET',
                url: urlRequest,
                success: function(data){
                    // console.log(data);  // kiểm tra trong network: -> console:
                    // xóa hàng dữ liệu đó <tr>
                    if(data.code == 200){
                        that.parent().parent().remove();
                        Swal.fire(
                            'Deleted!',
                            'Your product has been deleted.',
                            'success'
                        )
                    }
                },
                error: function(){

                }
            });

        }
    })
}

$(function (){
    $(document).on('click', '.action_delete', actionDelete );
});
