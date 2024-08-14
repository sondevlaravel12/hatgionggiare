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
    // when loading page also loading list of product image directories
    initializeSelect2ForSearching(false);
    // select directories -> load images in this directory
    $( "select[name*='image_directory'] ")
        .on( "change", function() {
            var $directoryName ='';
            if($('#post-type').is(":checked")==true){
                $directoryName +='posts/'
            }
            $directoryName += $(this).find(":selected").text();
            // call ajax inorder get all images in this directory
            ajaxLoadImageByDirectory($directoryName, getImagesLoaded());
        } );
    // check box in order to select model type post or product
    $('#post-type').on('change', function(){
        $(this).is(":checked")?$isPostType = true:$isPostType = false;
        $( ".select2-model-type" ).val('').trigger('change');
        $( ".select2-model-type" ).html('');
        initializeSelect2ForSearching($isPostType);


    });
    function initializeSelect2ForSearching($isPostType=false){
        $('.select2-model-type').select2({
            ajax: {
              url: '/admin/posts/edit/directory/ajaxGetDiretoryNameFromFileManager',
              dataType: 'json',
              data: function (params) {
                return {
                  q: params.term, // search term
                  isPostType: $isPostType
                };
                },
            }
          });
    }
    // after searching > load image from the text selected
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
        tinymce.activeEditor.insertContent('<img class="img-responsive" src="' + sr + '"/>');
        // if image just selected so hide it in the box holder
        ajaxLoadImageByDirectory($( "select[name*='image_directory']").val(),getImagesLoaded());
    });
 /* ---------------------------------------------
end load images directory inorder to insert into post
--------------------------------------------- */

// publish post
$("div.square-switch input[type=checkbox]").change(function (e) {
    var $status;
    var $post_id = $(this).attr('id');
    if (e.target.checked) { //If the checkbox is checked
        $status = 1;

    } else {
        $status = 0;
    }
    togglePublishPost($post_id,$status ).done(function(response){
        if(response.message){
        toastr.success(response.message);
        };
    });

});
function togglePublishPost($post_id, $status){
    return $.ajax({
        type:'POST',
        dataType: "json",
        url:'/admin/posts/ajax-setpublished',
        data:{
            'post_id': $post_id,
            "status": $status
            }
    });
};
// delete post
$table.on('click','.btn_post_delete', function(){
    // event.preventDefault();
    Swal.fire({
        title: 'Bạn có chắc muốn?',
        text: "Xóa xóa bài viết này không?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Vâng, xóa bài viết!'
        }).then((result) => {
        if (result.isConfirmed) {
            var $row = $dataTable.row($(this).parents('tr'));
            var $postId = $(this).attr('data-postid');
            deletePost($postId, $row)
        }

    })

});

function deletePost($postId, $row){
    $.ajax({
        type: "DELETE",
        url: "/admin/posts/ajax-delete",
        data: {postID:$postId},
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
