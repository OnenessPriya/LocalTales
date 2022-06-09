@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-file"></i> {{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
        </div>
        <a href="{{ route('admin.blog.create') }}" class="btn btn-primary pull-right">Add New</a>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="col-auto">
                    <form action="" id="checkout-form">
                    <div class="row g-3 align-items-center mb-3">
                        {{-- <div class="col-auto"> --}}
                            <div class="col-3">

                                <select class="filter_select form-control" name="category_id">
                                    <option value="" hidden selected>Search by Category</option>
                                    @foreach ($categories as $index => $item)
                                        <option value="{{$item->id}}">{{ $item->title }}</option>
                                    @endforeach
                                </select>
                            
                        </div>
                            <div class="col-3">
                                <select class="filter_select form-control" name="pincode">
                                    <option value="" hidden selected>Search by postcode</option>
                                    @foreach ($pin as $index => $item)
                                        <option value="{{$item->id}}">{{ $item->pin }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3">
                                <select class="filter_select form-control" name="suburb_id">
                                    <option value="" hidden selected>Search by Suburb</option>
                                    @foreach ($suburb as $index => $item)
                                        <option value="{{$item->id}}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3">
                                <input type="text" class="form-control" name="title" placeholder="Keyword" value="">
                            </div>
                        {{-- </div> --}}
                        <div class="col-auto">
                            <a href="javascript:void(0);" id="btnFilter" class="btn btn-primary text-center ml-auto">Filter</a>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="tile-body">
                    <table class="table table-hover custom-data-table-style table-striped" >
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th> Title </th>
                                <th> Description </th>
                                <th> Image </th>
                                <th> Status </th>
                                <th style="width:100px; min-width:100px;" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $key => $blog)
                            {{-- {{ dd($data) }} --}}
                                <tr>
                                    <td>{{ $blog->id }}</td>
                                    <td>{{ $blog->title }}</td>
                                    <td>
                                        @php
                                            $desc = strip_tags($blog['description']);
                                            $length = strlen($desc);
                                            if($length>50)
                                            {
                                                $desc = substr($desc,0,50)."...";
                                            }else{
                                                $desc = substr($desc,0,50);
                                            }
                                        @endphp
                                        {!! $desc !!}
                                    </td>
                                    <td>
                                        @if($blog->image!='')
                                        <img style="width: 100px;height: 100px;" src="{{URL::to('/').'/blogs/'}}{{$blog->image}}">
                                        @endif
                                    </td>
                                    <td class="text-center">
                                    <div class="toggle-button-cover margin-auto">
                                        <div class="button-cover">
                                            <div class="button-togglr b2" id="button-11">
                                                <input id="toggle-block" type="checkbox" name="status" class="checkbox" data-blog_id="{{ $blog['id'] }}" {{ $blog['status'] == 1 ? 'checked' : '' }}>
                                                <div class="knobs"><span>Inactive</span></div>
                                                <div class="layer"></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Second group">
                                        <a href="{{ route('admin.blog.edit', $blog['id']) }}" class="btn btn-sm btn-primary edit-btn"><i class="fa fa-edit"></i></a>
                                        <a href="{{ route('admin.blog.details', $blog['id']) }}" class="btn btn-sm btn-primary edit-btn"><i class="fa fa-eye"></i></a>
                                        <a href="#" data-id="{{$blog['id']}}" class="sa-remove btn btn-sm btn-danger edit-btn"><i class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable({"ordering": false});</script>
     {{-- New Add --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>
    <script type="text/javascript">
    $('.sa-remove').on("click",function(){
        var blogid = $(this).data('id');
        swal({
          title: "Are you sure?",
          text: "Your will not be able to recover the record!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Yes, delete it!",
          closeOnConfirm: false
        },
        function(isConfirm){
          if (isConfirm) {
            window.location.href = "blog/"+blogid+"/delete";
            } else {
              swal("Cancelled", "Record is safe", "error");
            }
        });
    });
    </script>
    <script type="text/javascript">
        $('input[id="toggle-block"]').change(function() {
            var blog_id = $(this).data('blog_id');
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var check_status = 0;
          if($(this).is(":checked")){
              check_status = 1;
          }else{
            check_status = 0;
          }
          $.ajax({
                type:'POST',
                dataType:'JSON',
                url:"{{route('admin.blog.updateStatus')}}",
                data:{ _token: CSRF_TOKEN, id:blog_id, check_status:check_status},
                success:function(response)
                {
                  swal("Success!", response.message, "success");
                },
                error: function(response)
                {

                  swal("Error!", response.message, "error");
                }
              });
        });



        $(document).on("click", "#btnFilter", function() {
        $('#checkout-form').submit();
    });
    </script>
@endpush
