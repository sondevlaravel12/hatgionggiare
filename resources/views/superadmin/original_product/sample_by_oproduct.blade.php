@extends('admin.admin_master')
@push('stylesheets')
   <!-- Lightbox css -->
   <link href="{{asset('backend/assets/libs/magnific-popup/magnific-popup.css')}}" rel="stylesheet" type="text/css" />
   <style type="text/css">
        /* .bootstrap-tagsinput .tag{
            margin-right: 2px;
            color: #ffffff;
            font-weight: 700px;
        } */
        .label-info {
        background-color: #5bc0de;
        }
        .label {
            display: inline;
            padding: 0.2em 0.6em 0.3em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25em;
        }
        /* .bootstrap-tagsinput {
            width: 100%;
        } */
        .bootstrap-tagsinput {
            background-color: #fff;
            border: none;
            box-shadow: none;
            display: inline-block;
            padding: 4px 6px;
            color: #555;
            vertical-align: middle;
            border-radius: 4px;
            width: 100%;
            line-height: 22px;
            cursor: text;
        }
        .icon-github {
            background: no-repeat url('../img/github-16px.png');
            width: 16px;
            height: 16px;
        }


        .accordion {
            margin-bottom:-3px;
        }

        .accordion-group {
            border: none;
        }

        .twitter-typeahead .tt-query,
        .twitter-typeahead .tt-hint {
            margin-bottom: 0;
        }

        .twitter-typeahead .tt-hint
        {
            display: none;
        }

        .tt-menu {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
            display: none;
            float: left;
            min-width: 160px;
            padding: 5px 0;
            margin: 2px 0 0;
            list-style: none;
            font-size: 14px;
            background-color: #ffffff;
            border: 1px solid #cccccc;
            border: 1px solid rgba(0, 0, 0, 0.15);
            border-radius: 4px;
            -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
            background-clip: padding-box;
            cursor: pointer;
        }

        .tt-suggestion {
            display: block;
            padding: 3px 20px;
            clear: both;
            font-weight: normal;
            line-height: 1.428571429;
            color: #333333;
            white-space: nowrap;
        }

        .tt-suggestion:hover,
        .tt-suggestion:focus {
        color: #ffffff;
        text-decoration: none;
        outline: 0;
        background-color: #428bca;
        }

    </style>
@endpush
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Sample</h4>

            <div class="page-title-right">
                <div >
                    <a href="{{route('superadmin.sample.create')}}" class="btn btn-primary waves-effect waves-light" ><span ><i class="fas fa-plus"></i> Thêm sample</span></a>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 ">
      <div class="input-group">
        <select multiple data-role="tagsinput" name="keyword[]" class="typeahead" placeholder="sản phẩm gốc">

        </select>
        {{-- <input type="text" id="autocomplete" class="form-control" placeholder="Search for..."> --}}
        {{-- <button type="button" class="btn btn-outline-secondary waves-effect">
             <i class="fas fa-search-plus"></i>
        </button> --}}
      </div><!-- /input-group -->
    </div><!-- /.col-lg-6 -->
</div><!-- /.row -->
<br>
<div class="row sample-items">
    <div class="col-12 samples-holder">
        @foreach ($samples as $sample )
        <div class="card" >
            <div class="card-body" id={{ $sample->id }}>

                <h4 class="card-title">{{ $sample->name }}</h4>
                <p class="card-text">{!! $sample->short_description !!}</p>
                {{-- <a href="#" class="btn btn-info btn-sm btn-rounded waves-effect waves-light">view</a> --}}
                <input class="sample_id" type="hidden" value="{{ $sample->id }}">
                <button type="button" class="btn btn-sm btn-link js-show-sample"><i class="fas fa-eye"></i> Xem</button>
                {{-- <a href="#" class="btn btn-light btn-sm btn-rounded waves-effect">edit</a> --}}
                <button style="color:#0097a7" type="button" class="btn btn-sm btn-link js-edit-sample"><i class="fas fa-edit"></i>Sửa</button>
                {{-- <a href="#" class="btn btn-danger btn-sm btn-rounded waves-effect waves-light">delete</a> --}}
                <button style="color: #f32f53" type="button" class="btn btn-sm btn-link js-remove-sample" data-productid="56"><i class="far fa-trash-alt"></i> Xóa</button>
                <span class="badge {{ $sample->type=="product"?"bg-info":"bg-warning" }} ">{{ $sample->type }}</span>
                <span class="badge bg-success">{{ $sample->oproduct->name }}</span>
            </div>

        </div>
        @endforeach
    </div> <!-- end col -->
</div> <!-- end row -->
@include('superadmin.sample._modal')

@endsection
@push('scripts')
    {{-- https://www.jqueryscript.net/table/crud-bstable.html  --}}
    <script src="{{ asset('backend/assets/libs/crud-bstable/bstable.js') }}"></script>
    {{-- some global variable  --}}
        <script>
            var $modal = $('#edittagmodal');
            var $modalcontent = $modal.find('.modal-content');
            var $modalTagName = $modalcontent.find('input.tagname');
            var $modalTagId = $modalcontent.find('input.tag-id-in-modal');
            var $pageTitle = document.getElementsByTagName("title")[0].innerHTML;

        </script>
    {{-- end some global variable  --}}

    {{-- for list tags page  --}}
        {{-- using event binding with jQuery   --}}
        {{-- This is nice because now all the JS code is in one place and can be updated (in my opinion) more easily --}}
        <script>
            // need to use delegated events.
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

            });

            function getTaginfo(tagId){
                // return the ajax promise
                return $.ajax({
                    type: "get",
                    url: "/admin/tags/ajax-get-tag-info",
                    data: {id:tagId},
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
    {{-- end for list tags page  --}}

    {{-- bootstrap table   --}}
        {{-- <script>
            var editableTable = new BSTable("bstable",{
                editableColumns:"1",
                $addButton: $('#new-row-button'),
                advanced: {
                    columnLabel:'Sửa'
                },
                onEdit: function(row) {
                    // convert DOM object to jQuery object
                    var $row = $(row).closest('tr');
                    $tagId = $row.find('.tag-id').html();
                    if($tagId){
                        $isCreate = 'no';
                    }else{
                        $isCreate = 'yes';
                    }
                    $tagName = $row.find('.tag-name').html();
                    // console.log($tagId +' has name: ' +$tagName);
                    updateTag($tagId, $tagName, $isCreate);
                },
                onBeforeDelete: function(row) {
                    Swal.fire({
                        title: 'Bạn có chắc muốn?',
                        text: "Xóa xóa tag này không?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Vâng, xóa tag!'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            // convert DOM object to jQuery object
                            var $row = $(row).closest('tr');
                            $tagId = $row.find('.tag-id').html();
                            deleteTag($tagId);
                            // need check if delete tag complete or not before removing this row
                            $row.remove();

                            // console.log($row);
                        }

                    })
                },
                onDelete: function(event) {
                },
                onAdd: function(row) {
                    // // convert DOM object to jQuery object
                    // var $row = $(row).closest('tr');
                    // $tagName = $row.find('.tag-name').html();
                    // console.log($tagName);
                    // // updateTag($tagId, $tagName);
                },


            });
            editableTable.init();

            function updateTag(tagId, tagName, isCreate){
                // $.ajaxSetup({
                //     headers: {
                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //     }
                // });
                $.ajax({
                        type: "post",
                        url: "/admin/tags/ajax-update",
                        data: {id:tagId, name:tagName, isCreate:isCreate},
                        dataType: "json",
                        success: function (response) {
                            if(response.message){
                            displayNotification(response.message,'success');
                            };
                        }
                    });
            }
            function deleteTag(tagId){
                // $.ajaxSetup({
                //     headers: {
                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //     }
                // });
                $.ajax({
                        type: "DELETE",
                        url: "/admin/tags/ajax-destroy",
                        data: {id:tagId},
                        dataType: "json",
                        success: function (response) {
                            if(response.message){
                            displayNotification(response.message,'info');
                            console.log('xoa roi ne');
                            };
                        }
                    });
            }
        </script> --}}
    {{-- end bootstrap table   --}}


    {{-- for tag to product & tag to post page  --}}
        <script>

            // initialize Taginput With Typeahead
            var engine = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                //datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                remote: {
                    wildcard: '%QUERY',
                    // url: '/admin/tags/search/%QUERY',
                    url: '/superadmin/oproduct/search/%QUERY',
                }
            });

            $('.typeahead').tagsinput({
                itemValue: 'id',
                itemText: 'name',
                typeaheadjs: {
                    hint: true,
                    highlight: true,
                    minLength: 2,
                    source: engine.ttAdapter(),
                    displayKey: 'name',
                    // valueKey: 'name',
                    templates: {
                        empty: [
                            '<div class="noitems">',
                            'Không tìm thấy',
                            '</div>'
                        ].join('\n')
                    }
                }
            });
            // before adding tag
            // use of delegated events with jQuery's on method, https://datatables.net/examples/advanced_init/events_live.html
            // it is still not work in pagination page or table
            // $table.on('beforeItemAdd','.typeahead', function(event){
            //     var newTag = event.item;
            //     var productId = $(this).closest('tr').find('.productId').html();
            //     var postId = $(this).closest('tr').find('.postId').html();
            //     console.log("hihi");

            //     // Do some processing here
            //     if (!event.options || !event.options.preventPost) {
            //         if(productId){
            //         // add tag to product
            //         addTagToProduct(productId, newTag);
            //         }
            //         if(postId){
            //         // add tag to post
            //         addTagToPost(postId, newTag)
            //         }
            //     }
            // })
            $('.typeahead').on('itemAdded itemRemoved', function(event) {
                if($("select").val().length>0){
                    searchRelativeSample($("select").val());
                }else{
                    // show all sample by refresh the page
                    window.location.reload();
                }
            });

            function searchRelativeSample(arrayOproductId){
                return $.ajax({
                            type: "get",
                            url: "/superadmin/oproduct/ajax-search-relative-samples",
                            data: {arrayOproductId: arrayOproductId},
                            dataType: "json",
                            success: function (response) {
                                // display relative samples
                                // console.log(response);
                                fetchSamples(response);
                            },
                            error: function (err) {
                                // display error message
                            }
                        });
            }

            var samples_holder = $('.samples-holder');
            function fetchSamples(samples){
                samples_holder.html('');
                result = '';
                $.each(samples, function( key, value ) {
                    color =value['type']=='product'?'bg-info':'bg-warning';
                    result += `
                    <div class="card" >
                    <div class="card-body" id=`+ value['id'] +`}>

                        <h4 class="card-title"> `+ value['name']+ `</h4>
                        <p class="card-text">`+ value['short_description'] +`</p>
                        {{-- <a href="#" class="btn btn-info btn-sm btn-rounded waves-effect waves-light">view</a> --}}
                        <input class="sample_id" type="hidden" value="`+ value['id'] +`">
                        <button type="button" class="btn btn-sm btn-link js-show-sample"><i class="fas fa-eye"></i> Xem</button>
                        {{-- <a href="#" class="btn btn-light btn-sm btn-rounded waves-effect">edit</a> --}}
                        <button style="color:#0097a7" type="button" class="btn btn-sm btn-link js-edit-sample"><i class="fas fa-edit"></i>Sửa</button>
                        {{-- <a href="#" class="btn btn-danger btn-sm btn-rounded waves-effect waves-light">delete</a> --}}
                        <button style="color: #f32f53" type="button" class="btn btn-sm btn-link js-remove-sample" data-productid="56"><i class="far fa-trash-alt"></i> Xóa</button>
                        <span class="badge `+ color +` ">`+ value['type'] +`</span>
                        <span class="badge bg-success">`+ value['oproduct']['name'] +`</span>
                    </div>

                </div>
                    `;

                });
                samples_holder.html(result);

            }


            function addTagToProduct(productId, newTag){
                return $.ajax({
                            type: "get",
                            url: "/admin/tags/add-to-product",
                            data: {productId:productId, newTag:newTag},
                            dataType: "json",
                            success: function (response) {
                                displayNotification(response.message,response.alert_type);
                            },
                            error: function (err) {
                                if (err.status == 422) { // when status code is 422, it's a validation issue
                                    $('.typeahead').tagsinput('remove', newTag, {preventPost: true});
                                    displayNotification(err.responseJSON.message,'error');
                                }
                            }
                        });
            }
            function addTagToPost(postId, newTag){
                return $.ajax({
                            type: "get",
                            url: "/admin/tags/add-to-post",
                            data: {postId:postId, newTag:newTag},
                            dataType: "json",
                            success: function (response) {
                                displayNotification(response.message,response.alert_type);
                            },
                            error: function (err) {
                                if (err.status == 422) { // when status code is 422, it's a validation issue
                                    $('.typeahead').tagsinput('remove', newTag, {preventPost: true});
                                    displayNotification(err.responseJSON.message,'error');
                                }
                            }
                        });
            }
            // before detach tag
            $('.typeahead').on('beforeItemRemove', function(event) {
                var $tag = event.item;
                var $productId = $(this).closest('tr').find('.productId').html();
                var $postId = $(this).closest('tr').find('.postId').html();
                var $tagId = $(this).closest('tr').find('.tagId').html();
                if (!event.options || !event.options.preventPost) {
                // if(!confirm('ban muon xoa khong')){
                // event.cancel = true;
                // }else{
                    // if productId not null, then detach tag from product
                    if($productId){
                        detachTagFromProduct($productId, $tag);
                    }else if($postId){
                        detachTagFromPost($postId, $tag);
                    }

                    // else if postId not null, then detach tag from post
                // }
                }
            });
            function detachTagFromProduct(productId, tag){
                return $.ajax({
                        type: "get",
                        url: "/admin/tags/detach-to-product",
                        data: {productId:productId, tag:tag},
                        dataType: "json",
                        success: function (response) {
                            // console.log(response.message);
                            displayNotification(response.message,'success');
                        }
                    });
            }
            function detachTagFromPost(postId, tag){
                return $.ajax({
                        type: "get",
                        url: "/admin/tags/detach-to-post",
                        data: {postId:postId, tag:tag},
                        dataType: "json",
                        success: function (response) {
                            // console.log(response.message);
                            displayNotification(response.message,'success');
                        }
                    });
            }
        </script>
    {{-- end for tag to product  & tag to post page  --}}


     {{-- other function  --}}

     {{-- end other function  --}}

@endpush
