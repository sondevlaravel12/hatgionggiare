$('.table-metatag').on('click','.js-edit-metatag', function () {
    // -----fill in modal -----//
    // get metatag id
    $metatagId = $(this).siblings('input.metatag-id').val();
    // call ajax to get all tag info and fill in modal with infos just get
    getMetatagInfo($metatagId).done(function(data){
        fillModalMetatagEdit(data);
        $('#editmetatagmodal').modal('show');
    })
});
$('#editmetatagmodal').on('click','.btn-save-edit-metatag', function () {
    $('#editmetatagmodal').modal('hide');
    updateMetatag().done(function(response){
        // console.log(response);
        refetchTable(response);
        displayNotification(response['message']);
    });
});

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

function getMetatagInfo(metatagId){
    // return the ajax promise
    return $.ajax({
        type: "get",
        url: "/admin/metatags/ajax-get-metatag-info",
        data: {id:metatagId},
        dataType: "json",
    });
}
function fillModalMetatagEdit(data){
    $modalMetatagEdit = $('#editmetatagmodal');
    $modalMetatagEdit.find('input[name=id]').val(data.id);
    $modalMetatagEdit.find('input[name=title]').val(data.title);
    $modalMetatagEdit.find('textarea[name=description]').html(data.description);
    $modalMetatagEdit.find('input[name=author]').val(data.author);
    $modalMetatagEdit.find('textarea[name=keyword]').val(data.keyword);
    $modalMetatagEdit.find('textarea[name=robots]').val(data.robots);
    if(data.model){
        $modalMetatagEdit.find('input[name=model_name]').val(data.model.name??data.model.title);
    }else{
        $modalMetatagEdit.find('input[name=model_name]').val('');
    }
}
function refetchTable(response){
    // $row = $('table').find('#'. response.id .'');
    $row = $('.table-metatag').find("tr[data-id="+ response.metatag.id  +"]");
    $row.find('.metatag-title').html(response.metatag.title);
    $row.find('.metatag-description').html(response.metatag.description);
    $row.find('.metatag-author').html(response.metatag.author);
    $row.find('.metatag-keyword').html(response.metatag.keyword);
    $row.find('.metatag-robots').html(response.metatag.robots);
}
function updateMetatag(){
    return $.ajax({
        type: "get",
        url: "/admin/metatags/update-metatag",
        data: $('#update-metatag-form').serialize(),
        dataType: "json",
    });
}

