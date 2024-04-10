@extends('admin.admin_master')
@push('stylesheets')
   <!-- Lightbox css -->
   <link href="{{asset('backend/assets/libs/magnific-popup/magnific-popup.css')}}" rel="stylesheet" type="text/css" />


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
        <input type="text" id="autocomplete" class="form-control" placeholder="Search for...">
        <button type="button" class="btn btn-outline-secondary waves-effect">
             <i class="fas fa-search-plus"></i>
        </button>
      </div><!-- /input-group -->
    </div><!-- /.col-lg-6 -->
</div><!-- /.row -->
<br>
<div class="row sample-items">
    <div class="col-12">
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
                <span class="badge bg-success">{{ $sample->relativemodel }}</span>
            </div>

        </div>
        @endforeach
    </div> <!-- end col -->
</div> <!-- end row -->
@include('superadmin.sample._modal')

@endsection
@push('scripts')

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

</script>
{{-- end some global variable  --}}
{{-- searching --}}
<script>
    var tags = [ "c++", "java", "php", "coldfusion", "javascript", "asp", "ruby" ];
    $( "#autocomplete" ).autocomplete({
        source: function( request, response ) {
                var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
                response( $.grep( tags, function( item ){
                    return matcher.test( item );
                }) );
            }
    });
</script>

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
            tinymce.init({ selector:'textarea.short-description-editor', height:300 });
            tinymce.init({ selector:'textarea.myeditorinstance', height:600 });
            $modalEditSample.modal('show');

        })
    });
    $('#edit-sample-modal').on('click','#btn-save-edit-sample', function () {
        // get sample id
        $sampleId = $(this).siblings('input[name="sampleId"]').val();
        tinyMCE.triggerSave(); //this line of code will use to update textarea content
        $sampleTitle = $modalEditSampleTitle.val();
        $sampleShortDescriptionVal = $sampleShortDescription.val();
        $sampleDescriptionVal = $sampleDescription.val();
        // call ajax to process the update sample work
        updateSampe($sampleId,$sampleTitle,$sampleShortDescriptionVal, $sampleDescriptionVal).done(function(data){
            // update sample info in view
            $sampleHolder = $('.sample-items').find('div#'+ $sampleId);
            $sampleHolder.find('.card-title').html($sampleTitle);
            $modalEditSample.modal('hide');
            displayNotification(data['message']);


        })
    });
    $('.sample-items').on('click','.js-remove-sample', function () {
        // // get sample id
        // $sampleId = $(this).siblings('input.sample_id').val();
        // // call ajax to get all sample info and fill in modal with infors just get
        // getSampleinfo($sampleId).done(function(data){
        //     // fill modal with order data just get
        //     $modalSOCTitle.html(data['name']);
        //     $modalSOCBody.find('.sample-description').html(data['description']);
        //     // show modal
        //     $modalShowSample.modal('show');

        // })
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

    function getSampleinfo(sampleId){
        // return the ajax promise
        return $.ajax({
            type: "get",
            url: "/superadmin/ajax-get-sample-info",
            data: {id:sampleId},
            dataType: "json",
        });
    }
    function updateSampe(sampleId, sampleTitle, sampleShortDescription, sampleDescription){
        // return the ajax promise
        return $.ajax({
            type: "post",
            url: "/superadmin/ajax-update-sample-info",
            data: {id:sampleId, title:sampleTitle, short_description:sampleShortDescription, description:sampleDescription},
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
    function removeSample(sampleId){
        // return the ajax promise
        return $.ajax({
            type: "get",
            url: "/superadmin/ajax-remove-sample",
            data: {id:sampleId},
            dataType: "json",
        });
    }
</script>
{{-- end using event binding with jQuery   --}}



@endpush
