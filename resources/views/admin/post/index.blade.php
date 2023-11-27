@extends('admin.admin_master')
@push('stylesheets')
   <!-- Lightbox css -->
   <link href="{{asset('backend/assets/libs/magnific-popup/magnific-popup.css')}}" rel="stylesheet" type="text/css" />


@endpush
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Bài Viết</h4>
            <div class="page-title-right">
                <div >
                    <a href="{{route('admin.posts.create')}}" class="btn btn-primary waves-effect waves-light" ><span ><i class="fas fa-plus"></i> Thêm bài viết mới</span></a>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Danh sách bài viết</h4>

                <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>


                        <th>Id</th>
                        <th>Hình</th>
                        <th>Tên</th>
                        <th>Xuất bản</th>
                        <th>Chỉnh sửa</th>
                        <th>Ngày tạo</th>
                        <th>Ngày cập nhật</th>


                    </tr>
                    </thead>


                    <tbody>
                        @foreach ($posts as $post)

                        <tr>
                            <td>{{$post->id}}</td>

                            <td><img src="{{$post->getFirstImageUrl('medium')}}" class="img-thumbnail" alt="300x300" width="300" data-holder-rendered="true"></td>
                            <td>{{$post->title}}</td>
                            <td>
                                {{-- <div class="square-switch">
                                    <input type="checkbox" id="square-switch1" data-post-id="{{$post->id}}" switch="none" {{$post->status=='published'?'checked':''}}>
                                    <label for="square-switch1" data-on-label="On" data-off-label="Off"></label>
                                </div> --}}
                                <div class="square-switch">
                                    <input type="checkbox" id="{{$post->id}}" data-post-id="{{$post->id}}" switch="none" {{$post->status==1?'checked':''}}>
                                    <label for="{{$post->id}}" data-on-label="On" data-off-label="Off"></label>
                                </div>
                            </td>
                            <td>
                                {{-- <form action="{{route('admin.posts.destroy', $post)}}" method="POST" id="confirm_delete">
                                    @method('DELETE') --}}
                                    {{-- <a href="{{route('post.detail', $post)}}" class="popup-youtube btn btn-link mb-2"><i class="fas fa-eye"></i> Preview</a> --}}
                                    {{-- <a target="_blank" href="{{route('post.detail', $post)}}" class="btn btn-sm btn-link"><i class="fas fa-link"></i> link</a> --}}
                                    <a href="{{route('admin.posts.edit',  $post)}}" class="btn btn-sm btn-link"><i class="far fa-edit"></i> Sửa</a>
                                    <button type="submit" class="btn btn-sm btn_post_delete" data-postid="{{$post->id}}"><i class="far fa-trash-alt"></i> Xóa</button>
                                    {{-- @csrf --}}
                                {{-- </form> --}}
                            </td>

                            <td>{{$post->created_at ? \Carbon\Carbon::parse($post->created_at)->diffForHumans() : ''}}</td>
                            <td>{{$post->updated_at ? \Carbon\Carbon::parse($post->updated_at)->diffForHumans() : ''}}</td>


                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection
@push('scripts')


 <!-- Magnific Popup-->
 <script src="{{asset('backend/assets/libs/magnific-popup/jquery.magnific-popup.min.js')}}"></script>

 <!-- lightbox init js-->
 <script src="{{asset('backend/assets/js/pages/lightbox.init.js')}}"></script>
 {{-- publish post --}}
 <script>
    $("input[type=checkbox]").change(function (e) {
        var $status;
        var $post_id = $(this).attr('id');
        if (e.target.checked) { //If the checkbox is checked
            $status = 1;

        } else {
            $status = 0;
        }
        togglePublishPost($post_id,$status ).done(function(response){
            if(response.message){
            toastr.success(response.message);
            };
        });

    });
    function togglePublishPost($post_id, $status){
        return $.ajax({
            type:'POST',
            dataType: "json",
            url:'/admin/posts/ajax-setpublished',
            data:{
                'post_id': $post_id,
                "status": $status
                }
        });
    };

 </script>

{{-- delete post  --}}
 <script>
    // sweetalert before deleting
    // var $dataTable = $table.DataTable({});
    $table.on('click','.btn_post_delete', function(){
        // event.preventDefault();
        Swal.fire({
            title: 'Bạn có chắc muốn?',
            text: "Xóa xóa bài viết này không?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Vâng, xóa bài viết!'
            }).then((result) => {
            if (result.isConfirmed) {
                var $row = $dataTable.row($(this).parents('tr'));
                var $postId = $(this).attr('data-postid');
                deletePost($postId, $row)
            }

        })

    });

    function deletePost($postId, $row){
        $.ajax({
            type: "DELETE",
            url: "/admin/posts/ajax-delete",
            data: {postID:$postId},
            dataType: "json",
            success: function (response) {
                if(response.message){
                $row.remove().draw(false);
                toastr.success(response.message);
                return true;
                };
            }
        });
    };

 </script>
@endpush

