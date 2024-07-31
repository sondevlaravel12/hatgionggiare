  /* ---------------------------------------------
global variabl and const
--------------------------------------------- */
    const money = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' });
 /* ---------------------------------------------
end global variabl and const
--------------------------------------------- */
 /* ---------------------------------------------
some initialy
--------------------------------------------- */
    // setup ajax header
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //slect2 for dropdown search
    $('.select2').select2({
    });
    // data table
    var $table = $('table');
    var $dataTable = $('#datatable').DataTable({
        order: [[0, 'desc']],
        paging: !1,
    });
 /* ---------------------------------------------
end some initialy
--------------------------------------------- */

 /* ---------------------------------------------
autocomple search using for search url product or post
--------------------------------------------- */
    $("#autosearch").length > 0 && ($("#autosearch").autocomplete({
        // autoFocus: true,
        source: function (request, response) {
                if($('#square-switch1').is(':checked')){
                    $.ajax({
                        url: "/san-pham/ajax-tim-kiem/sp",
                        data: {term: request.term, maxResults: 10},
                        dataType: "json",
                        success: function (data) {
                            // response($.map(request, function (request) {
                            //     return request
                            // }))
                            return response(data);
                        }
                    })
                }else{
                    $.ajax({
                        url: "/bai-viet/ajax-tim-kiem/bv",
                        data: {term: request.term, maxResults: 10},
                        dataType: "json",
                        success: function (data) {
                            // response($.map(request, function (request) {
                            //     return request
                            // }))
                            return response(data);
                        }
                    })

                }

            }

    }));
    $("#autosearch" ).on( "autocompleteselect", function( event, ui ) {
        // event.preventDefault();
        $("#url").val(ui.item.url);
        // copyToClipboard('url');
    } );
    $("#url").on('click', function(){copyToClipboard('url')});

    function copyToClipboard(textFieldId) {
        // Get the text field
        var copyText = document.getElementById(textFieldId);
        // Select the text field
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices
        // Copy the text inside the text field using the Clipboard API if available
        if (navigator.clipboard) {
            navigator.clipboard.writeText(copyText.value).then(() => {
                displayNotification('coppied to clipboar');
            }).catch(err => {
                console.error('Failed to copy: ', err);
            });
        } else {
            // Fallback method using document.execCommand('copy')
            try {
                document.execCommand('copy');
                displayNotification('coppied to clipboar: ' + copyText.value,'success');
            } catch (err) {
                console.error('Fallback: Oops, unable to copy', err);
            }
        }
    }

/* ---------------------------------------------
end autocomple search using for search url product or post
--------------------------------------------- */

/* ---------------------------------------------
autocomple search using for search product or post doesnt have metatag
--------------------------------------------- */
    $("#autosearch_without_relationship").length > 0 && ($("#autosearch_without_relationship").autocomplete({
        // autoFocus: true,
        source: function (request, response) {
                if($('#square-switch1').is(':checked')){
                    $.ajax({
                        url: "/san-pham/ajax-tim-kiem/sp-doesnthave-metatag",
                        data: {term: request.term, maxResults: 10},
                        dataType: "json",
                        success: function (data) {
                            return response(data);
                        }
                    })
                }else{
                    $.ajax({
                        url: "/bai-viet/ajax-tim-kiem/bv-doesnthave-metatag",
                        data: {term: request.term, maxResults: 10},
                        dataType: "json",
                        success: function (data) {
                            // response($.map(request, function (request) {
                            //     return request
                            // }))
                            return response(data);
                        }
                    })

                }

            }

    }));
    $("#autosearch_without_relationship" ).on( "autocompleteselect", function( event, ui ) {
        // event.preventDefault();
        $("input[name='model_id']").val(ui.item.model_id);
        $("input[name='model_type']").val(ui.item.model_type);
        // copyToClipboard('url');
    } );
/* ---------------------------------------------
end autocomple search using for search product or post doesnt have metatag
--------------------------------------------- */

/* ---------------------------------------------
characters count live
--------------------------------------------- */
    function titleCharCountLive(str, range='50-100'){
        $length = str.length;
        document.getElementById("title-char-count").innerHTML = $length + ' out of range ' + range + ' characters';
    }
    function excerptCharCountLive(str, range='300-500'){
        $length = str.length;
        document.getElementById("excerpt-count").innerHTML ='should be ' + $length + ' out of range ' + range + ' characters';
    }
    // call on tinymce init keyup event
    function descriptionCharCountLive(currentLength,range='110-110000'){
        document.getElementById("description-char-count").innerHTML = currentLength + ' out of range ' + range + ' characters';
    }
/* ---------------------------------------------
end characters count live
--------------------------------------------- */

/* ---------------------------------------------
Image-Uploader
--------------------------------------------- */
    // edit page
    if($('#preloaded').length && $('.input-images-1').length){
        $('.input-images-1').imageUploader({
            preloaded: JSON.parse($('#preloaded').attr('data-preloaded')),
            preloadedInputName: 'preloadedImages[]', // set the name of the preloaded images input field
            imagesInputName: 'photos',
            label: 'Kéo thả hình vào đây, hoặc bấm vào để tải hình',
            extensions: ['.jpg','.jpeg','.png','.gif','.svg'],
            mimes: ['image/jpeg','image/png','image/gif','image/svg+xml'],
            maxSize: 5 * 1024 * 1024,
            maxFiles: 10,
        });
    }
    // create page
    if ($('.input-images-2').length) {
        $('.input-images-2').imageUploader({
            imagesInputName: 'photos',
            label: 'Kéo thả hình vào đây, hoặc bấm vào để tải hình',
            extensions: ['.jpg','.jpeg','.png','.gif','.svg'],
            mimes: ['image/jpeg','image/png','image/gif','image/svg+xml'],
            maxSize: 5 * 1024 * 1024,
            maxFiles: 10,
        });
    }

 /* ---------------------------------------------
end Image-Uploader
--------------------------------------------- */

/* ---------------------------------------------
some other function
--------------------------------------------- */
    //displayNotification
    function displayNotification(message, type="info"){
        switch(type){
           case 'info':
           toastr.info(message);
           break;
           case 'success':
           toastr.success(message);
           break;
           case 'warning':
           toastr.warning(message);
           break;
           case 'error':
           toastr.error(message);
           break;
        };
    };

/* ---------------------------------------------
end some other function
--------------------------------------------- */
