@extends('admin.admin_master')
@push('stylesheets')

@endpush
@push('scripts')

{{-- some global variable  --}}
<script>
    var $modalShowOrder = $('#show-order-modal');
    var $modalShowOrderContent = $modalShowOrder.find('.modal-content');
    var $modalSOCTitle = $modalShowOrderContent.find('.modal-title');
    var $modalSOCBody = $modalShowOrderContent.find('.modal-body');

    var $modalEditOrder = $('#edit-order-modal');
    var $modalEditOrderContent = $modalEditOrder.find('.modal-content');
    var $modalEditOrderTitle = $modalEditOrderContent.find('.modal-title');
    var $modalEditOrderBody = $modalEditOrderContent.find('.modal-body');
    // var $modalEditClientName = $modalShowOrderContent.find('input.client_name_showordermodal');
    // var $modalTagId = $modalcontent.find('input.tag-id-in-modal');
    // var $pageTitle = document.getElementsByTagName("title")[0].innerHTML;

</script>
{{-- end some global variable  --}}

{{-- using event binding with jQuery   --}}
<script>
    $table.on('click','.js-show-order', function () {
        // get order id
        $orderId = $(this).siblings('input.order-id').val();
        // call ajax to get all order info and fill in modal with infors just get
        getOrderinfo($orderId).done(function(data){
            // fill modal with order data just get
            $modalSOCTitle.html($orderId);
            fillinCutomerInformations($('#customer_info'), data);
            fillinOrderItems($('#order_items'),data.items);
            console.log(data);
            // $modalSOCBody.find('.client_name').html(data['client_name']);
            // $modalSOClientName.val(data['client_name']);

            // show modal
            $modalShowOrder.modal('show');

        })
    });
    $table.on('click','.js-edit-order', function () {
        // -----fill in modal -----//
        // get order id
        $orderId = $(this).siblings('input.order-id').val();
        $modalEditOrderTitle.html($orderId);
        $modalEditOrder.modal('show');

        // call ajax to get all tag info and fill in modal with infos just get
        // getTaginfo($tagId).done(function(data){
        //     // $modal = $('#edittagmodal');
        //     // $modalcontent = $modal.find('.modal-content');
        //     $modalTagName.val(data['name']);
        //     $modalTagId.val($tagId);
        //     $modal.modal('show');

        // })
    });
    $table.on('click','.js-edit-tag', function () {
        // -----fill in modal -----//
        // get tag id
        $tagId = $(this).siblings('input.tag-id').val();
        // call ajax to get all tag info and fill in modal with infos just get
        getTaginfo($tagId).done(function(data){
            // $modal = $('#edittagmodal');
            // $modalcontent = $modal.find('.modal-content');
            $modalTagName.val(data['name']);
            $modalTagId.val($tagId);
            $modal.modal('show');

        })
    });
    $table.on('click','.js-remove-tag', function(){
        if(confirm('bạn có chắc muốn xóa tag này không?')){
            // get tag id
            $tagId = $(this).siblings('input.tag-id').val();
            // get row
            $row = $(this).closest('tr');
            // call ajax to remove tag in database
            removeTag($tagId).done(function(data){
                // if remove successfully in db then remove this tag in view and show notification
                $row.remove();
                displayNotification(data['message']);
            }).fail(function(data){
                displayNotification("xóa tag thất bại","error");
            });
        }else{

        }

    });

    function getOrderinfo(oderId){
        // return the ajax promise
        return $.ajax({
            type: "get",
            url: "/admin/order/fromcarts/ajax-get-order-info",
            data: {id:oderId},
            dataType: "json",
        });
    }
    function removeTag(tagId){
        // return the ajax promise
        return $.ajax({
            type: "get",
            url: "/admin/tags/ajax-remove-tag",
            data: {id:tagId},
            dataType: "json",
        });
    }
</script>
{{-- end using event binding with jQuery   --}}

{{-- other function  --}}
<script>
    function fillinCutomerInformations(selector, data){
        // associative array (object)
        $statusStype = {'pending' :'danger',
                        'processing' :'info',
                        'decline' :'dark',
                        'completed' :'success'
                        };

        selector.html(`<tr>
                        <td>
                            <strong>Tổng tiền:</strong>
                        </td>
                        <td>
                            <span class="total">
                                `+ data['total'] +`
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Khách hàng:</strong>
                        </td>
                        <td>
                            <span class="client_name">
                                `+ data['client_name'] +`
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>SDT:</strong>
                        </td>
                        <td>
                            <span class="phone_number">
                                `+ data['phone_number'] +`
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Địa chỉ:</strong>
                        </td>
                        <td>
                            <span class="address">
                                `+ data['address'] +`
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Email:</strong>
                        </td>
                        <td>
                            <span class="email">
                                `+ data['email'] +`
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Tình trạng đơn hàng:</strong>
                        </td>
                        <td class="status">
                            <span class="badge bg-`+ $statusStype[data['status']] +`">`+ data['status'] +`</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Người dùng ghi chú:</strong>
                        </td>
                        <td>
                            <span class="notes">
                                `+ data['notes'] +`
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Admin ghi chú:</strong>
                        </td>
                        <td>
                            <span class="admin_notes">
                                `+ data['admin_notes'] +`
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <strong>Ngày đặt hàng:</strong>
                        </td>
                        <td>
                            <span class="created_at">
                            `+ data['created_at'] + `
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Ngày cập nhật:</strong>
                        </td>
                        <td>
                            <span class="updated_at">
                                `+ data['updated_at'] +`
                            </span>
                        </td>
                    </tr>`)
    }

</script>
<script>
    function fillinOrderItems(selector, items){
        // console.log(items);
        // $content = "concho";
        // items.forEach(function(item, index){
        //     $content+= item.quantity;
        //     console.log($content);
        // });
        $content ='';
        items.forEach(function(item, index){
            $content += `<tr class="table-info">
                        <td>`+ item.product.name +`</td>
                        <td>`+ item.quantity + `</td>
                        <td>
                            <span>
                            `+ money.format(item.price) + `
                            </span>
                        </td>
                        <td>
                            <span>
                                `+ money.format(item.price*item.quantity) + `
                            </span>
                        </td>
                    </tr>`;
        });
        selector.html($content);
        // console.log($content);
    }
</script>
<script>
    $('.btn-save-edit-tag').on('click', function(){
        // get all informations in modal that user typed in
        $modalcontent = $(this).closest('.modal-content');
        $tagId = $modalcontent.find('input.tag-id-in-modal').val();
        $tagName = $modalcontent.find('input.tagname').val();
        // call ajax in order to update tag info
        updateTagInfo($tagId,$tagName).done(function(data){
            // fill in row with new data
            $row = $table.find('input#' +$tagId).closest('tr');
            // $row = $table.find("tr[data-id='" + $tagId + "']");
            $row.find('td.tag-name').html($tagName);
            // hide modal
            $('#edittagmodal').modal('hide');
            // show notification
            displayNotification(data['message'],'success');
        }).fail(function(data){
            displayNotification("cập nhật tag thất bại",'error');
            $('#edittagmodal').modal('hide');
        });


    })
    function updateTagInfo(tagId, tagName){
        return $.ajax({
            type: "get",
            url: "/admin/tags/ajax-update-tag-info",
            data: {id:tagId, name:tagName},
            dataType: "json",
        });
    }
</script>
{{-- for add new tag  --}}
<script>
    $('div.page-title-right a#add-new-tag').click(function(){
        // show blank modal
        $addnewtagModal = $('#addnewtagmodal');
        $addnewtagModal.find('input#tagname').val('');
        $addnewtagModal.modal('show');

    });
    $('.modal button#btn-save-addnew-tag').click(function(){
        // get tag information after user type in
        $tagName = $addnewtagModal.find('input#tagname').val();
        // call ajax in order create new tag in database
        addNewTag($tagName).done(function(data){
            // add new tag in datatble view
            $newRow = $dataTable.row
                    .add([
                        data['tag']['id'],
                        data['tag']['name'],
                        '',
                        '0',
                        `
                        <input class="tag-id" type="hidden" id="`+ data['tag']['id'] +`" value="`+ data['tag']['id'] +`">
                        <button type="button" class="btn btn-sm btn-link js-edit-tag"><i class="far fa-edit"></i> Sửa</button>
                        <button  class="btn btn-sm btn_product_delete js-remove-tag"><i class="far fa-trash-alt"></i> Xóa</button>
                        `

                    ]).node();
                $($newRow).find("td:eq(0)").addClass('tag-id');
                $($newRow).find("td:eq(1)").addClass('tag-name');
                // $($newRow).find('td')[1].addClass('tag-name');
                $dataTable.draw(false);
            // $($newRow).attr('')
            // show notification and close modal
            $addnewtagModal.modal('hide');
            displayNotification("thêm tag mới thành công","success");

        })
    })
    function addNewTag(tagName){
        return $.ajax({
            type: "get",
            url: "/admin/tags/ajax-addnew-tag",
            data: {name:tagName},
            dataType: "json",
        });
    }

</script>
@endpush
