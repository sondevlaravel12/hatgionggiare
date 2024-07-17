@extends('admin.admin_master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Slider</h4>

            <div class="page-title-right">
                <div >
                    <a href="{{route('admin.sliders.index')}}" class="btn btn-info waves-effect waves-light" ><span ><i class="fas fa-arrow-left"></i> Back to all sliders</span></a>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <tbody>
                            <tr>
                                <td>
                                    <strong>Title:</strong>
                                </td>
                                <td>
                                    <span>
                                        {{$slider->title}}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Order:</strong>
                                </td>
                                <td>
                                    <span>
                                        {{$slider->order}}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Image:</strong>
                                </td>
                                <td><img src="{{$slider->getFirstImageUrl()}}" class="img-fluid" alt="Responsive image"></td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Link:</strong>
                                </td>
                                <td>
                                    <span>
                                        {{$slider->link}}
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <strong>Created:</strong>
                                </td>
                                <td>
                                    <span>
                                    {{\Carbon\Carbon::parse($slider->created_at)->diffForHumans()}}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Updated:</strong>
                                </td>
                                <td>
                                    <span>
                                        {{\Carbon\Carbon::parse($slider->update_at)->diffForHumans()}}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Actions</strong></td>
                                <td>
                                    <a href="{{route('admin.sliders.edit',$slider)}}" class="btn btn-sm btn-link"><i class="far fa-edit"></i>
                                        Edit</a>


                                    <a href="#"
                                        class="btn btn-sm btn-link" data-button-type="delete"><i class="far fa-trash-alt"></i> Delete</a>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
