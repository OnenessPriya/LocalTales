@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-file"></i> {{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
        </div>
        <a href="{{ route('admin.event.create') }}" class="btn btn-primary pull-right">Add New</a>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="">
                    <div class="search_form_wrap filter_wrap">
                    <form action="" id="checkout-form">
                        <div class="row mb-3">
                            <div class="col-12 col-sm-6 col-lg-4">
                                <input type="text" class="form-control" name="pin" placeholder="Postcode" value="{{$pinCode}}">
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4">
                                <input type="date" class="form-control" name="event_date" placeholder="Seatch by Date" value="{{$eventDate}}">
                            </div>

                            <div class="col-12 col-sm-6 col-lg-4">
                                <select class="form-control" name="category_id">
                                    <option value="">Search by category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" @if($category->id==$categoryId){{"selected"}}@endif>{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4">
                                <select class="form-control" name="format_id">
                                    <option value="">Search by Format</option>
                                    @foreach($eventformats as $eventformat)
                                        <option value="{{ $eventformat->id }}" @if($eventformat->id==$eventformatId){{"selected"}}@endif>{{ $eventformat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4">
                                <select class="form-control" name="language_id">
                                    <option value="">Search by Language</option>
                                    @foreach($languages as $language)
                                        <option value="{{ $language->id }}" @if($language->id==$languageId){{"selected"}}@endif>{{ $language->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4">
                                <select class="form-control" name="is_paid">
                                    <option value="" @if($isPaid==''){{"selected"}}@endif>Price</option>
                                    <option value="0" @if($isPaid==0){{"selected"}}@endif>Free</option>
                                    <option value="1" @if($isPaid==1){{"selected"}}@endif>Paid</option>
                                </select>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4">
                                <select class="form-control" name="is_recurring">
                                    <option value="">Type</option>
                                    <option value="0" @if($isRecurring==0){{"selected"}}@endif>Non-recurring</option>
                                    <option value="1" @if($isRecurring==1){{"selected"}}@endif>Recurring</option>
                                </select>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4">
                                <input type="text" class="form-control" name="keyword" placeholder="Keyword" value="{{$keyword}}">
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4">
                                <a style="height: 50px;" href="javascript:void(0);" id="btnFilter" class="btn btn-primary w-100 d-flex justify-content-center align-items-center">Filter</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
                <div class="tile-body">
                    <table class="table table-hover custom-data-table-style table-striped" >
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th> Title </th>
                                <th> Description </th>
                                <th> Image </th>
                                <th> Start Date </th>
                                <th> Status </th>
                                <th style="width:100px; min-width:100px;" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $key => $event)
                                <tr>
                                    <td>{{ $event->id }}</td>
                                    <td>{{ $event->title }}</td>
                                    <td>
                                        @php
                                            $desc = strip_tags($event['description']);
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
                                        @if($event->image!='')
                                        <img style="width: 150px;height: 100px;" src="{{URL::to('/').'/events/'}}{{$event->image}}">
                                        @endif
                                    </td>
                                    <td>{{ date("d-M-Y",strtotime($event->start_date)) }}</td>
                                    <td class="text-center">
                                    <div class="toggle-button-cover margin-auto">
                                        <div class="button-cover">
                                            <div class="button-togglr b2" id="button-11">
                                                <input id="toggle-block" type="checkbox" name="status" class="checkbox" data-event_id="{{ $event['id'] }}" {{ $event['status'] == 1 ? 'checked' : '' }}>
                                                <div class="knobs"><span>Inactive</span></div>
                                                <div class="layer"></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Second group">
                                        <a href="{{ route('admin.event.edit', $event['id']) }}" class="btn btn-sm btn-primary edit-btn"><i class="fa fa-edit"></i></a>
                                        <a href="{{ route('admin.event.details', $event['id']) }}" class="btn btn-sm btn-primary edit-btn"><i class="fa fa-eye"></i></a>
                                        <a href="#" data-id="{{$event['id']}}" class="sa-remove btn btn-sm btn-danger edit-btn"><i class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="col-12 text-right mt-4">
                        {{ $events->links() }}
                    </div>
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
        var eventid = $(this).data('id');
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
            window.location.href = "event/"+eventid+"/delete";
            } else {
              swal("Cancelled", "Record is safe", "error");
            }
        });
    });
    </script>
    <script type="text/javascript">
        $('input[id="toggle-block"]').change(function() {
            var event_id = $(this).data('event_id');
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
                url:"{{route('admin.event.updateStatus')}}",
                data:{ _token: CSRF_TOKEN, id:event_id, check_status:check_status},
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


        $(document).ready(function(){
    	$('#btnFilter').on("click",function(){
    		$('#checkout-form').submit();
    	})
    })
    </script>
@endpush
