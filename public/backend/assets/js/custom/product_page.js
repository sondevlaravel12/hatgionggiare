 /* ---------------------------------------------
load images directory inorder to insert into post
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
        });
        $imgOnlyName = [];
        $imgPathArr.forEach(function(item, index){
            $pathParts = item.split("/");
            $imgOnlyName[index]= $pathParts[$pathParts.length - 1];
        });
        return $imgOnlyName;
    }

    // select directories -> load images in this directory
    $( "select[name*='directories'] ")
        .on( "change", function() {
            var $directoryName = $(this).val();
            // call ajax inorder get all images in this directory
            ajaxLoadImageByDirectory($directoryName, getImagesLoaded());
        } );

    function ajaxLoadImageByDirectory(directoryName,imgNameArr ){
        return $.ajax({
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
                        if(imgNameArr.includes($imgName)){
                            // do not show this image
                            // console.log('already has it');
                        }else{
                            $imagesdisplay += `<a class='float-start'>
                                                <div class ='img-fluid'>
                                                <img src="/` + l + `" alt="" width="120">
                                                </div>
                                            </a>`;
                        }
                    });


                    $('#imagesHolder').html($imagesdisplay);
                }
            });
    }
    // insert image into textare when clicking the image
    $('#imagesHolder').on('click', 'a', function () {
        var sr = $('img', this).attr('src');
        //  tinyMCE.execCommand('mceInsertContent', false, '<img alt="Smiley face" height="42" width="42" src="' + sr + '"/>');
        tinymce.activeEditor.insertContent('<img class="img-responsive" src="' + sr + '"/>');
        // if image just selected so hide it in the box holder
        // ajaxLoadImageByDirectory($( "select[name*='directories'] ").val());
    });
 /* ---------------------------------------------
end load images directory inorder to insert into post
--------------------------------------------- */
