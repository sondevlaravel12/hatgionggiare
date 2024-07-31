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

