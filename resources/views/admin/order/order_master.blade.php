@extends('admin.admin_master')
@push('stylesheets')

@endpush
@push('scripts')
{{-- datatable  --}}
<script>
$('#datatable-style1').DataTable({
    // columnDefs: [{ orderable: false, targets: 0 }]
    // disable the default sorting but keep the columns sortable
    "aaSorting": [],
    // responsive: true,
    language: { paginate: { previous: "<i class='mdi mdi-chevron-left'>", next: "<i class='mdi mdi-chevron-right'>" } },
    // "order": [0,'desc'],
    // paginate: true,
    // scrollY: 500,
    drawCallback: function () {
        $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
    },

    });
</script>
{{-- some global variable  --}}
<script>
    var $modalShowOrder = $('#show-order-modal');
    var $modalShowOrderContent = $modalShowOrder.find('.modal-content');
    var $modalSOCTitle = $modalShowOrderContent.find('.modal-title');
    var $modalSOCType = $modalShowOrder.find('input.order-type');
    var $modalSOCBody = $modalShowOrderContent.find('.modal-body');

    var $modalEditOrder = $('#edit-order-modal');
    var $modalEditOrderContent = $modalEditOrder.find('.modal-content');
    var $modalEditOrderTitle = $modalEditOrderContent.find('.modal-title');
    var $modalEditOrderType = $modalEditOrderContent.find('input.order-type');
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
        $orderType = $(this).siblings('input.order-type').val();
        // call ajax to get all order info and fill in modal with infors just get
        getOrderinfo($orderId, $orderType).done(function(data){
            // fill modal with order data just get
            $modalSOCTitle.html($orderId);
            $modalSOCType.val($orderType);
            if($orderType=='cart_order'){
                fillinOrderItems($('#order_items'),data.items);
            }else if($orderType=='chat_order'){
                $modalSOCBody.find('.items-ordered').html('');
                // $('#order_items').html='';
            }
            fillinCutomerInformations($('#customer_info'), data, $orderType );
            // show modal
            $modalShowOrder.modal('show');

        })
    });
    $table.on('click','.js-edit-order', function () {
        // -----fill in modal -----//
        // get order id
        $orderId = $(this).siblings('input.order-id').val();
        $orderType = $(this).siblings('input.order-type').val();
        $orderStatusInTable = $(this).siblings('span').text();
        console.log($orderType);
        $modalEditOrderTitle.html($orderId);
        $modalEditOrderType.val($orderType);
        $selectTag = $modalEditOrderContent.find("select[name='status']");
        $options = '';
        $status ={
            'pending' :'Chờ xử lý',
            'processing' :'Đang xử lý',
            'decline' :'Hủy bỏ',
            'completed' :'Hoàn tất'
        };
        Object.entries($status).forEach(([key, val]) => {
            $selected = val==$orderStatusInTable?'selected':'';
            $options+= '<option value="'+ key +'" ' +$selected+ '>'+ val +'</option>';
        });


        $selectTag.html($options);
        // console.log($select.val());
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
    // $table.on('click','.js-edit-tag', function () {
    //     // -----fill in modal -----//
    //     // get tag id
    //     $tagId = $(this).siblings('input.tag-id').val();
    //     // call ajax to get all tag info and fill in modal with infos just get
    //     getTaginfo($tagId).done(function(data){
    //         // $modal = $('#edittagmodal');
    //         // $modalcontent = $modal.find('.modal-content');
    //         $modalTagName.val(data['name']);
    //         $modalTagId.val($tagId);
    //         $modal.modal('show');

    //     })
    // });
    // $table.on('click','.js-remove-tag', function(){
    //     if(confirm('bạn có chắc muốn xóa tag này không?')){
    //         // get tag id
    //         $tagId = $(this).siblings('input.tag-id').val();
    //         // get row
    //         $row = $(this).closest('tr');
    //         // call ajax to remove tag in database
    //         removeTag($tagId).done(function(data){
    //             // if remove successfully in db then remove this tag in view and show notification
    //             $row.remove();
    //             displayNotification(data['message']);
    //         }).fail(function(data){
    //             displayNotification("xóa tag thất bại","error");
    //         });
    //     }else{

    //     }

    // });

    function getOrderinfo(oderId, orderType){
        // return the ajax promise
        return $.ajax({
            type: "get",
            url: "/admin/order/fromcarts/ajax-get-order-info",
            data: {id:oderId, orderType:orderType},
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
    function fillinCutomerInformations(selector, data, type){
        // associative array (object)
        $statusStype = {'pending' :'danger',
            'processing' :'info',
            'decline' :'dark',
            'completed' :'success'
        };
        $status ={
            'pending' :'Chờ xử lý',
            'processing' :'Đang xử lý',
            'decline' :'Hủy bỏ',
            'completed' :'Hoàn tất'
        };
        $admin_notes = data['admin_notes']?data['admin_notes']:'';
        // console.log(data['status']);
        $orderStatus = ''
        Object.entries($status).forEach(([key, val]) => {
            $selected = key==data['status']?'selected':'';
            $orderStatus+= '<option value="'+ key +'" ' +$selected+ '>'+ val +'</option>';
        });
        $customerInforFormChatOrder =`<tr>
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
                            <strong>Tình trạng đơn hàng:</strong>
                        </td>
                        <td class="status">
                            <select class="form-select" aria-label="Default select example" name="status">
                                `+$orderStatus+`
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Sản phẩm đặt:</strong>
                        </td>
                        <td>
                            <span class="notes">
                                `+ data['product'] +`
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Trang đặt hàng:</strong>
                        </td>
                        <td>
                            <a href='`+ data['urltrangweb'] +`'>
                                `+ data['urltrangweb'] +`
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Admin ghi chú:</strong>
                        </td>
                        <td>
                            <textarea class="form-control" name="admin_notes" id="admin_notes" rows="2">`+ $admin_notes +`</textarea>
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
                    </tr>`;
        $customerInforFormCart = `<tr>
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
                            <select class="form-select" aria-label="Default select example" name="status">
                                `+$orderStatus+`
                            </select>
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
                            <textarea class="form-control" name="admin_notes" id="admin_notes" rows="2">`+ $admin_notes +`</textarea>
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
                    </tr>`;
        // console.log($orderStatus);
        if(type=='cart_order'){
            selector.html($customerInforFormCart);
        }else if(type=='chat_order'){
            selector.html($customerInforFormChatOrder);
        }
    }

</script>
<script>
    function fillinOrderItems(selector, items){
        $content ='';
        items.forEach(function(item, index){

            $content += `<tr class="table-info">
                        <td><a target="_blank" href="/san-pham/`+item.product.slug+`">`+ item.product.name +`</a></td>
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
    // function updateTagInfo(tagId, tagName){
    //     return $.ajax({
    //         type: "get",
    //         url: "/admin/tags/ajax-update-tag-info",
    //         data: {id:tagId, name:tagName},
    //         dataType: "json",
    //     });
    // }
</script>
{{-- for add new tag  --}}
<script>
    // $('div.page-title-right a#add-new-tag').click(function(){
    //     // show blank modal
    //     $addnewtagModal.find('input#tagname').val('');
    //     $addnewtagModal.modal('show');

    // });
    $('.modal button#btn-update-order-status').click(function(){
        // get status after user chosing
        // $model = $('#edit-order-modal');
        $orderStatus = $modalEditOrder.find('select[name="status"]').val();
        $orderId = $modalEditOrder.find('.modal-title').html();
        $orderType = $modalEditOrderType.val();
        // console.log($orderType);
        updateOrderStatus($orderId, $orderStatus,$orderType ).done(function(data){
            // find orderrow and change order status of this row
            $statusStype ={
                'pending' :'danger',
                'processing' :'info',
                'decline' :'dark',
                'completed' :'success'
            };
            $status ={
                'pending' :'Chờ xử lý',
                'processing' :'Đang xử lý',
                'decline' :'Hủy bỏ',
                'completed' :'Hoàn tất'
            };
            $statusCell = $table.find('input#' +$orderId).siblings('span');
            $statusCell.text($status[$orderStatus]);
            $statusCell.attr('class', '');
            $statusCell.addClass('badge bg-' + $statusStype[$orderStatus]);
        })

        // call ajax in order to update order status in database
        // addNewTag($tagName).done(function(data){
        //     // add new tag in datatble view
        //     $newRow = $dataTable.row
        //             .add([
        //                 data['tag']['id'],
        //                 data['tag']['name'],
        //                 '',
        //                 '0',
        //                 `
        //                 <input class="tag-id" type="hidden" id="`+ data['tag']['id'] +`" value="`+ data['tag']['id'] +`">
        //                 <button type="button" class="btn btn-sm btn-link js-edit-tag"><i class="far fa-edit"></i> Sửa</button>
        //                 <button  class="btn btn-sm btn_product_delete js-remove-tag"><i class="far fa-trash-alt"></i> Xóa</button>
        //                 `

        //             ]).node();
        //         $($newRow).find("td:eq(0)").addClass('tag-id');
        //         $($newRow).find("td:eq(1)").addClass('tag-name');
        //         // $($newRow).find('td')[1].addClass('tag-name');
        //         $dataTable.draw(false);
        //     // $($newRow).attr('')
        //     // show notification and close modal
        $modalEditOrder.modal('hide');
        //     displayNotification("thêm tag mới thành công","success");

        // })
    })
    function updateOrderStatus(orderId, orderStatus, orderType){
        return $.ajax({
            type: "get",
            url: "/admin/order/fromcarts/ajax-update-order-status",
            data: {orderId:orderId, orderStatus:orderStatus, orderType:orderType},
            dataType: "json",
        });
    }
    $('.modal button#btn-update-order-infors').click(function(){
        // get status after user chosing
        // $model = $('#edit-order-modal');
        $orderStatus = $modalShowOrder.find('select[name="status"]').val();
        $orderId = $modalShowOrder.find('.modal-title').html();
        $orderType = $modalShowOrder.find('input.order-type').val();
        $adminNotes = $modalShowOrder.find('textarea#admin_notes').val();
        updateOrderInfors($orderId, $orderStatus, $adminNotes, $orderType).done(function(data){
            // find orderrow and change order status of this row
            $statusStype ={
                'pending' :'danger',
                'processing' :'info',
                'decline' :'dark',
                'completed' :'success'
            };
            $status ={
                'pending' :'Chờ xử lý',
                'processing' :'Đang xử lý',
                'decline' :'Hủy bỏ',
                'completed' :'Hoàn tất'
            };
            $statusCell = $table.find('input#' +$orderId).siblings('span');
            $statusCell.text($status[$orderStatus]);
            $statusCell.attr('class', '');
            $statusCell.addClass('badge bg-' + $statusStype[$orderStatus]);
        })
        // show notification and close modal
        displayNotification("Cập nhật đơn hàng thành công","success");
        $modalShowOrder.modal('hide');

    })
    function updateOrderInfors(orderId, orderStatus, adminNotes, orderType){
        return $.ajax({
            type: "get",
            url: "/admin/order/fromcarts/ajax-update-order-infors",
            data: {orderId:orderId, orderStatus:orderStatus, adminNotes:adminNotes, orderType:orderType},
            dataType: "json",
        });
    }

</script>
@endpush
