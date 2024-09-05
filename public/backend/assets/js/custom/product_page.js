 /* ---------------------------------------------
load images directory inorder to insert into post/ product, use in post/product create and edit page
--------------------------------------------- */
    // get all image already used
    function getImagesLoaded(){
        $holder = $("<div></div>");
        // $usedImages = $('.myeditorinstance').val();
        $usedImages = tinymce.activeEditor.getContent();
        $holder.html($usedImages);

        $imgPathArr = [];
        $holder.find('p img').each(function(){
            $imgPathArr.push($(this).attr('src'));
            // console.log('find image');
        });
        $imgOnlyName = [];
        $imgPathArr.forEach(function(item, index){
            $pathParts = item.split("/");
            $imgOnlyName[index]= $pathParts[$pathParts.length - 1];
        });
        return $imgOnlyName;
    }

    // load images when the first time load page and post or product has directory image saved before
    $(document).ready(function(){
        ajaxLoadImageByDirectory($( "select[name*='image_directory'] ").val(), []);
    })
    // select directories -> load images in this directory
    $( "select[name*='image_directory'] ")
        .on( "change", function() {
            var $directoryName = $(this).val();
            // call ajax inorder get all images in this directory
            ajaxLoadImageByDirectory($directoryName, getImagesLoaded());
        } );

    function ajaxLoadImageByDirectory(directoryName,imgNameArr ){
        // console.log(directoryName);
        if(directoryName){
            // if using ..done() so we need return $.ajax
            $.ajax({
                type: "get",
                url: "/admin/posts/edit/directory/ajaxgetimages",
                data: {directory:directoryName},
                dataType: "json",
                success: function (response) {
                    $imagesdisplay ='';
                    $.each( response, function(i,l ){
                        // $imagesdisplay += `<td>
                        //                         <img src="/storage/photos/`+ $directoryName +`/` + l + `" alt="" height="42" width="42">
                        //                     </td>`;
                        $pathParts =  l.split('/');
                        $imgName = $pathParts[$pathParts.length - 1];
                        if(imgNameArr.length>0 && imgNameArr.includes($imgName)){
                            // do not show this image
                        }else{
                            $imagesdisplay += `<a class='float-start'>
                                                <div class ='img-fluid'>
                                                <img src="` + l + `" alt="" width="120">
                                                </div>
                                            </a>`;
                        }
                    });
                    $('#imagesHolder').html($imagesdisplay);
                }
            });
        }

    }

    // insert image into textare when clicking the image
    $('#imagesHolder').on('click', 'a', function () {
        var sr = $('img', this).attr('src');
        tinymce.activeEditor.insertContent('<img class="img-responsive-custome" src="' + sr + '"/>');
        // if image just selected so hide it in the box holder
        ajaxLoadImageByDirectory($( "select[name*='image_directory']").val(),getImagesLoaded());
    });
 /* ---------------------------------------------
end load images directory inorder to insert into post
--------------------------------------------- */

// publish product in index page
    // $("input[type=checkbox]").change(function (e) {
    //     toastr.options = {
    //     "closeButton": true,
    //     "newestOnTop": true,
    //     "positionClass": "toast-bottom-full-width"
    //     };
    //     var $status;
    //     var $product_id = $(this).attr('id');
    //     if (e.target.checked) { //If the checkbox is checked
    //         $status = 1;

    //     } else {
    //         $status = 0;
    //     }

    //     // csrf token
    //     var $headers = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') };
    //     //passing data to laravel controller
    //     var $data = {
    //         'product_id': $product_id,
    //         "status": $status
    //     };
    //     $.ajax({
    //         headers:$headers,
    //         type:'POST',
    //         dataType: "json",
    //         url:'/admin/products/ajax-setpublished',
    //         data:$data,
    //         success:function(response) {
    //             toastr.success(response.success);
    //         }

    //     });

    // });
    $("input[type=checkbox]").change(function (e) {
        var $status;
        var $product_id = $(this).attr('id');
        if (e.target.checked) { //If the checkbox is checked
            $status = 1;

        } else {
            $status = 0;
        }
        togglePublishProduct($product_id,$status ).done(function(response){
            if(response.message){
            toastr.success(response.message);
            };
        });

    });
    function togglePublishProduct($product_id, $status){
        return $.ajax({
            type:'POST',
            dataType: "json",
            url:'/admin/products/ajax-setpublished',
            data:{
                'product_id': $product_id,
                "status": $status
                }
        });
    };
// delete product in index page
    $table.on('click','.btn_product_delete', function(){
        // event.preventDefault();
        Swal.fire({
            title: 'Bạn có chắc muốn?',
            text: "Xóa xóa sản phẩm này không?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Vâng, xóa sản phẩm!'
            }).then((result) => {
            if (result.isConfirmed) {
                var $row = $dataTable.row($(this).parents('tr'));
                var $productId = $(this).attr('data-productid');
                // console.log($productId);
                deleteProduct($productId, $row)
            }

        })

    });
    function deleteProduct($productId, $row){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "DELETE",
            url: "/admin/products/ajax-delete",
            data: {productID:$productId},
            dataType: "json",
            success: function (response) {
                if(response.message){
                $row.remove().draw(false);
                toastr.success(response.message);
                return true;
                };
            }
        });
    };
