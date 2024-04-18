@extends('admin.admin_master')
@push('stylesheets')
   <!-- Lightbox css -->
   <link href="{{asset('backend/assets/libs/magnific-popup/magnific-popup.css')}}" rel="stylesheet" type="text/css" />
   <style type="text/css">
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
        },

    </style>
    {{-- select2  --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
            <select id="search-bar" multiple data-role="tagsinput" name="keyword[]" class="typeahead" placeholder="sản phẩm gốc">

            </select>
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
                <div class="sample-content">{!! $sample->short_description !!}</div>

                {{-- <a href="#" class="btn btn-info btn-sm btn-rounded waves-effect waves-light">view</a> --}}
                <input class="sample_id" type="hidden" value="{{ $sample->id }}">
                <button type="button" class="btn btn-sm btn-link js-show-sample"><i class="fas fa-eye"></i> Xem</button>
                {{-- <a href="#" class="btn btn-light btn-sm btn-rounded waves-effect">edit</a> --}}
                <button style="color:#0097a7" type="button" class="btn btn-sm btn-link js-edit-sample"><i class="fas fa-edit"></i>Sửa</button>
                {{-- <a href="#" class="btn btn-danger btn-sm btn-rounded waves-effect waves-light">delete</a> --}}
                <button style="color: #f32f53" type="button" class="btn btn-sm btn-link js-remove-sample" data-productid="56"><i class="far fa-trash-alt"></i> Xóa</button>
                <span class="badge {{ $sample->type=="product"?"bg-info":"bg-warning" }} ">{{ $sample->type }}</span>
                {{-- <span class="badge bg-success">{{ $sample->oproduct?$sample->oproduct->name:'' }}</span> --}}
                @if ($sample->oproduct)
                <button class="btn btn-success btn-sm btn-rounded waves-effect waves-light js-addtag-byclick" value="{{ $sample->oproduct->id }}">{{ $sample->oproduct->name }}</button>
                @else
                <button style="display: none" class="btn btn-success btn-sm btn-rounded waves-effect waves-light js-addtag-byclick"></button>
                @endif
            </div>

        </div>
        @endforeach
    </div> <!-- end col -->
</div> <!-- end row -->
@include('superadmin.sample._modal')

@endsection
@push('scripts')
{{-- select2  --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
{{-- https://jeesite.gitee.io/front/jquery-select2/4.0/index.htm#placeholders --}}

{{-- some global variable  --}}
<script>
    var $modalShowSample = $('#show-sample-modal');
    var $modalShowSampleContent = $modalShowSample.find('.modal-content');
    var $modalSOCTitle = $modalShowSampleContent.find('.modal-title');
    var $modalSOCBody = $modalShowSampleContent.find('.modal-body');

    var $modalEditSample = $('#edit-sample-modal');
    var $modalEditSampleContent = $modalEditSample.find('.modal-content');
    var $modalEditSampleTitle = $modalEditSampleContent.find('.modal-title');
    var $modalEditSampleBody = $modalEditSampleContent.find('.modal-body');
    var $modalEditSampleFooter = $modalEditSampleContent.find('.modal-footer');
    var $sampleDescription = $modalEditSampleBody.find('.sample-description');
    var $sampleShortDescription = $modalEditSampleBody.find('.sample-short-description');
    var $select2 = $modalEditSampleFooter.find('#oproduct-dropdown');
    var $selectedOproduct = $modalEditSampleBody.find(':selected');
    var $selectInput = $modalEditSampleBody.find('select#oproduct-dropdown');

    // var $sampleContent = $('.sample-content');
    var samples_holder = $('.samples-holder');

</script>
{{-- end some global variable  --}}

{{-- some initialize needed --}}
<script>
    // initialize Taginput With Typeahead
    //https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/examples/
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
</script>
<script>
    // intitialize typeahead for modal edit sample
    var engine2 = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        //datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            wildcard: '%QUERY',
            // url: '/admin/tags/search/%QUERY',
            url: '/superadmin/oproduct/search/%QUERY',
        }
    });
    $('#remote .typeahead-oproduct').typeahead(null, {
        name: 'name',
        display: 'name',
        source: engine2,
        classNames: {
            highlight: 'Typeahead-highlight',
        },
        templates: {
        // header: '<h3 class="league-name">San pham goc</h3>'
        }
    });
</script>
{{-- select2 --}}
<script>
    $(document).ready(function() {
    $('#oproduct-dropdown').select2({
        // placeholder: "chọn sản phẩm gốc",
        // allowClear: true,
        dropdownParent: $('#edit-sample-modal .modal-content'),
        minimumInputLength: 3,
        ajax: {
            url: "/superadmin/oproduct/select2-search",
            dataType: 'json',
        },
    });
});

</script>
{{-- end some initialize needed --}}


{{-- using event binding with jQuery   --}}
<script>
    $('.sample-items').on('click','.js-show-sample', function () {
        // get sample id
        $sampleId = $(this).siblings('input.sample_id').val();
        // call ajax to get all sample info and fill in modal with infors just get
        getSampleinfo($sampleId).done(function(data){
            // fill modal with order data just get
            $modalSOCTitle.html(data['name']);
            $modalSOCBody.find('.sample-short-description').html(data['short_description']);
            $modalSOCBody.find('.sample-description').html(data['description']);
            // show modal
            $modalShowSample.modal('show');

        })
    });

    $('.sample-items').on('click','.js-edit-sample', function () {
        // -----fill in modal -----//
        // get sample id
        $sampleId = $(this).siblings('input.sample_id').val();
        // call ajax to get all tag info and fill in modal with infos just get
        getSampleinfo($sampleId).done(function(data){
            // $modal = $('#edittagmodal');
            // $modalcontent = $modal.find('.modal-content');
            // $modalEditSampleTitle.html(data['name']);
            $modalEditSampleTitle.val(data['name']);
            $modalEditSampleFooter.find('input[name="sampleId"]').val($sampleId);
            // if not remove we will can not fill in this textarea
            tinymce.remove();
            $sampleShortDescription.val(data['short_description']);
            $sampleDescription.val(data['description']);
            // default dropdown option
            if(data.oproduct){
                $selectedOption = '<option selected value="'+ data.oproduct.id +'">'+ data.oproduct.name +'</option>';
                $selectInput.html($selectedOption);
            }else{
                // clear old value when edit other oproduct
                $selectInput.html('');
            }
            // oproduct-dropdown
            // console.log(data);
            tinymce.init({ selector:'textarea.short-description-editor', height:300 });
            tinymce.init({ selector:'textarea.myeditorinstance', height:600 });
            $modalEditSample.modal('show');

        })
    });
    $('.sample-items').on('click','.js-addtag-byclick', function () {
         // get sample id
        //  $sampleId = $(this).siblings('input.sample_id').val();
         // get tag text
         $oproduct_name = $(this).text();
        $oproduct_id = $(this).val();
        $arrTagAdded = $("select#search-bar").val();
        // console.log($arrTagAdded);
        if (!$arrTagAdded.includes($oproduct_id)){
            // console.log("can be added");
            $('.typeahead').tagsinput('add',{ id: $oproduct_id, name: $oproduct_name});
        }else{
            console.log("already has this tag");
        }
    });
    $('#edit-sample-modal').on('click','#btn-save-edit-sample', function () {
        // get sample id
        $sampleId = $(this).siblings('input[name="sampleId"]').val();
        tinyMCE.triggerSave(); //this line of code will use to update textarea content
        $sampleTitle = $modalEditSampleTitle.val();
        $sampleShortDescriptionVal = $sampleShortDescription.val();
        $sampleDescriptionVal = $sampleDescription.val();
        // $oproduct = $selectedOproduct;

        $data = $('#oproduct-dropdown').select2('data');
        var $oproductId = $data[0].id;
        // if($data[0].selected){
        //     $oproductId = '';
        // }
        // call ajax to process the update sample work
        updateSampe($sampleId,$sampleTitle,$sampleShortDescriptionVal, $sampleDescriptionVal, $oproductId).done(function(data){
            // update sample info in view
            $sampleHolder = $('.sample-items').find('div#'+ $sampleId);
            $sampleHolder.find('.card-title').html($sampleTitle);
            $sampleHolder.find('.sample-content').html($sampleShortDescriptionVal);
            $sampleHolder.find('.js-addtag-byclick').html(data.oproduct_name);
            $sampleHolder.find('.js-addtag-byclick').val(data.oproduct_id)
            $sampleHolder.find('.js-addtag-byclick').show();
            $modalEditSample.modal('hide');
            // resorting sample by oproduct
            if($("select#search-bar").val().length>0){
                searchRelativeSample($("select#search-bar").val());
            }
            displayNotification(data['message']);

        })
    });
    $('.sample-items').on('click','.js-remove-sample', function () {
        if(confirm('bạn có chắc muốn xóa mẫu này không?')){
            // get sample id
            $sampleId = $(this).siblings('input.sample_id').val();
            // get sample holder
            $sampleHolder = $('.sample-items').find('div#'+ $sampleId);
            // call ajax to remove sample in database
            removeSample($sampleId).done(function(data){
                // if remove successfully in db then remove this sample in view and show notification
                $sampleHolder.remove();
                displayNotification(data['message']);
            }).fail(function(data){
                displayNotification("xóa sample thất bại","error");
            });
        }else{

        }
    });


</script>
{{-- end using event binding with jQuery   --}}

{{-- handle other events --}}
<script>
    // handle item added and removed in search bar
    $('.typeahead').on('itemAdded itemRemoved', function(event) {
        if($("select#search-bar").val().length>0){
            searchRelativeSample($("select#search-bar").val());
        }else{
            // show all sample by refresh the page
            window.location.reload();
        }
    });
    $('.typeahead').on('beforeItemAdd', function(event) {
    // event.item: contains the item
    $arrTagAdded = $("select#search-bar").val();
    if ($arrTagAdded.includes(event.item.id.toString())){
        event.cancel = true;
    };
    });
</script>
{{-- end handle other events --}}

{{-- function with ajax promise return --}}
<script>
    function getSampleinfo(sampleId){
        // return the ajax promise
        return $.ajax({
            type: "get",
            url: "/superadmin/ajax-get-sample-info",
            data: {id:sampleId},
            dataType: "json",
        });
    }
    function updateSampe(sampleId, sampleTitle, sampleShortDescription, sampleDescription, oproductId){
        // return the ajax promise
        return $.ajax({
            type: "post",
            url: "/superadmin/ajax-update-sample-info",
            data: {id:sampleId, title:sampleTitle, short_description:sampleShortDescription, description:sampleDescription, oproductId:oproductId},
            dataType: "json",
        });
    }
    function removeSample(sampleId){
        // return the ajax promise
        return $.ajax({
            type: "get",
            url: "/superadmin/ajax-remove-sample",
            data: {id:sampleId},
            dataType: "json",
        });
    }
    function searchRelativeSample(arrayOproductId){
        return $.ajax({
                    type: "get",
                    url: "/superadmin/oproduct/ajax-search-relative-samples",
                    data: {arrayOproductId: arrayOproductId},
                    dataType: "json",
                    success: function (response) {
                        fetchSamples(response);
                    },
                    error: function (err) {
                        // display error message
                    }
                });
    }
    function searchOproductByName(oproductName){
        return $.ajax({
                    type: "get",
                    url: "/superadmin/oproduct/ajax-search-by-name",
                    data: {oproductName: oproductName},
                    dataType: "json",
                });
    }
</script>
{{-- end function with ajax promise return --}}

{{-- other functions --}}
<script>
    function fetchSamples(samples){
        samples_holder.html('');
        result = '';
        $.each(samples, function( key, value ) {
            color =value['type']=='product'?'bg-info':'bg-warning';
            result += `
            <div class="card" >
            <div class="card-body" id=`+ value['id'] +`>

                <h4 class="card-title"> `+ value['name']+ `</h4>
                <div class="sample-content">`+ value['short_description'] +`</div>
                {{-- <a href="#" class="btn btn-info btn-sm btn-rounded waves-effect waves-light">view</a> --}}
                <input class="sample_id" type="hidden" value="`+ value['id'] +`">
                <button type="button" class="btn btn-sm btn-link js-show-sample"><i class="fas fa-eye"></i> Xem</button>
                {{-- <a href="#" class="btn btn-light btn-sm btn-rounded waves-effect">edit</a> --}}
                <button style="color:#0097a7" type="button" class="btn btn-sm btn-link js-edit-sample"><i class="fas fa-edit"></i>Sửa</button>
                {{-- <a href="#" class="btn btn-danger btn-sm btn-rounded waves-effect waves-light">delete</a> --}}
                <button style="color: #f32f53" type="button" class="btn btn-sm btn-link js-remove-sample" data-productid="56"><i class="far fa-trash-alt"></i> Xóa</button>
                <span class="badge `+ color +` ">`+ value['type'] +`</span>
                <button class="btn btn-success btn-sm btn-rounded waves-effect waves-light js-addtag-byclick" value="`+ value['oproduct']['id'] +`" >`+ value['oproduct']['name'] +`</button>
            </div>

        </div>
            `;

        });
        samples_holder.html(result);

    }
</script>
{{-- end other functions --}}



@endpush
