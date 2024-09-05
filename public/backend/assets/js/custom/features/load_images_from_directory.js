 /* ---------------------------------------------
load images directory inorder to insert into post/ product, use in post/product/about/contact/policy.... create and edit page
in post and product page already included (kind of) in post_page.js, product_page.js
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

    // when loading page also loading list of product image directories

    initializeSelect2ForSearching(false);
    // load images when the first time load page and post or product has directory image saved before
    // ajaxLoadImageByDirectory($( "select[name*='image_directory'] option:selected").text(), []);
    // ajaxLoadImageByDirectory($( "hoa chuong"), []);

    // select directories -> load images in this directory
    $( "select[name*='image_directory'] ")
        .on( "change", function() {
            $directoryName ='';
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
        // erase select2
        $( ".select2-model-type" ).val('').trigger('change');
        $( ".select2-model-type" ).html('');
        initializeSelect2ForSearching($isPostType);


    });
    var $dataForSelect2;
    function initializeSelect2ForSearching($isPostType){
        //call ajax inorder to get data for select2
        getDiretoryNameFromFileManager($isPostType).done(function(result){
            $('.select2-model-type').select2({
                data:result
            });
        });

        // $('.select2-model-type').select2({
        //     // ajax: {
        //     //   url: '/admin/posts/edit/directory/ajaxGetDiretoryNameFromFileManager',
        //     //   dataType: 'json',
        //     //   delay: 250,
        //     //   data: function (params) {
        //     //     return {
        //     //       q: params.term, // search term
        //     //       isPostType: $isPostType
        //     //     };
        //     //     },
        //     // }
        //   });
    }
    function getDiretoryNameFromFileManager(isPostType){
        return $.ajax({
            type: "get",
            url: "/admin/posts/edit/directory/ajaxGetDiretoryNameFromFileManager",
            data: {isPostType: isPostType},
            dataType: "json",
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
        tinymce.activeEditor.insertContent('<img class="img-responsive-custome" src="' + sr + '"/>');
        // if image just selected so hide it in the box holder
        $directoryName='';
        if($('#post-type').is(":checked")==true){
            $directoryName +='posts/'
        }
        $directoryName += $( "select[name*='image_directory'] ").find(":selected").text();
        ajaxLoadImageByDirectory($directoryName,getImagesLoaded());
    });
 /* ---------------------------------------------
end load images directory inorder to insert into post
--------------------------------------------- */