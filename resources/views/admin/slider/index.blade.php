@extends('admin.admin_master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Slider</h4>

            <div class="page-title-right">
                <div >
                    <a href="{{route('admin.sliders.create')}}" class="btn btn-primary waves-effect waves-light" ><span ><i class="fas fa-plus"></i> Add slider</span></a>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">All Sliders</h4>

                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>

                        <th>Id</th>
                        <th>Image</th>
                        <th>Action</th>
                        <th>Order</th>
                        <th>Create at</th>
                        <th>Upadate at</th>
                        <th>Link</th>

                    </tr>
                    </thead>


                    <tbody>
                        @foreach ($sliders as $slider)

                        <tr>
                            <td>{{$slider->id}}</td>
                            <td><img src="{{$slider->getFirstImageUrl()}}" class="img-thumbnail" alt="300x300" width="300" data-holder-rendered="true"></td>

                            <td>
                                <form action="{{route('admin.sliders.destroy', $slider)}}" method="POST" id="confirm_delete">
                                    @method('DELETE')
                                    <a href="{{route('admin.sliders.detail', $slider)}}" class="btn btn-sm btn-link"><i class="fas fa-eye"></i> Preview</a>
                                    <a href="{{route('admin.sliders.edit',  $slider)}}" class="btn btn-sm btn-link"><i class="far fa-edit"></i> Edit</a>
                                    <button type="submit" class="btn btn-sm btn-link" ><i class="far fa-trash-alt"></i> Delete</button>
                                    @csrf
                                </form>
                            </td>
                            <td>{{$slider->order}}</td>
                            <td>{{$slider->created_at ? \Carbon\Carbon::parse($slider->created_at)->diffForHumans() : ''}}</td>
                            <td>{{$slider->updated_at ? \Carbon\Carbon::parse($slider->updated_at)->diffForHumans() : ''}}</td>
                            <td>{{$slider->link}}</td>

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

<script>

// $(document).ready( function () {
//     $('#datatable').DataTable({
//         searching:false,
//         "info": false,
//         "lengthChange": false
//         });
// } );

</script>
@endpush
