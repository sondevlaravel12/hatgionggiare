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
@push('scripts')
    {{-- https://www.jqueryscript.net/table/crud-bstable.html  --}}
    <script src="{{ asset('backend/assets/libs/crud-bstable/bstable.js') }}"></script>
    <script>
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
             $.ajax({
                    type: "post",
                    url: "/admin/tags/ajax-update",
                    data: {id:tagId, name:tagName, isCreate:isCreate},
                    dataType: "json",
                    success: function (response) {
                        if(response.message){
                        toastr.success(response.message);
                        };
                    }
                });
        }
        function deleteTag(tagId){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
             $.ajax({
                    type: "DELETE",
                    url: "/admin/tags/ajax-destroy",
                    data: {id:tagId},
                    dataType: "json",
                    success: function (response) {
                        if(response.message){
                        toastr.success(response.message);
                        };
                    }
                });
        }
    </script>

    {{-- for tag to product page  --}}
    {{-- <script>
        var $dataTable = $('#datatable').DataTable({

            });
        var $table = $('#datatable');
    </script>
    <script>
        var editableTable = new BSTable("datatable",{
            editableColumns:"4",
            // $addButton: $('#new-row-button'),
            advanced: {
                columnLabel:'Sửa',
                buttonHTML: `<div class="btn-group pull-right">
                    <button id="bEdit" type="button" class="btn btn-sm btn-default" onclick="rowEdit(this);">
                        <span class="fa fa-edit" > </span>
                    </button>

                    <button id="bAcep" type="button" class="btn btn-sm btn-default" style="display:none;" onclick="rowAcep(this);">
                        <span class="fa fa-check-circle" > </span>
                    </button>
                    <button id="bCanc" type="button" class="btn btn-sm btn-default" style="display:none;" onclick="rowCancel(this);">
                        <span class="fa fa-times-circle" > </span>
                    </button>
                </div>`
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
                updateTagToProduct($tagId, $tagName, $isCreate);
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

        function updateTagToProduct(tagId, tagName, isCreate){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
             $.ajax({
                    type: "post",
                    url: "/admin/tags/ajax-update",
                    data: {id:tagId, name:tagName, isCreate:isCreate},
                    dataType: "json",
                    success: function (response) {
                        if(response.message){
                        toastr.success(response.message);
                        };
                    }
                });
        }
    </script> --}}

    <script>
        var engine = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                //datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                remote: {
                    wildcard: '%QUERY',
                    url: '/admin/tags/search/%QUERY',
                }
            });

        $('.typeahead').tagsinput({
            typeaheadjs: {
                hint: true,
                highlight: true,
                minLength: 2,
                source: engine,
                templates: {
                            empty: [
                                '<div class="noitems">',
                                'No Items Found',
                                '</div>'
                            ].join('\n')
                        }
            }
        });
    </script>
@endpush
