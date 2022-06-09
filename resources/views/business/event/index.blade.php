@extends('business.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
@include('business.partials.flash')
<div class="row">
    <div class="col-12">
        <div class="tile">
            <div class="tile-body">
                <div class="col-12 text-right">
                    <a type="button"class="btn btn-blue text-center w-auto" href="{{route('business.event.create')}}"><i class="fas fa-plus"></i> Add Event</a>
                    <a href="#csvUploadModal" data-toggle="modal" class="btn btn-blue text-center w-auto"><i class="fa fa-cloud-upload"></i> CSV Upload</a>
                <a href="{{route ('business.event.data.csv.export') }}" class="btn btn-blue text-center w-auto"><i class="fa fa-cloud-download"></i> CSV Export</a>
                  </div>
          <div class="row">
            @foreach($events as $key => $event)
            <div class="col-12 col-md-4 col-lg-4 col-sm-4 mb-3">
              <div class="card save-grid">
                <div class="position-relative">
                  @if($event->image!='')
                  <figure>
                    <div class="category-tag">
                      <img src="{{URL::to('/').'/categories/'}}{{$event->category->image}}">
                      <p>{{$event->category->title}}</p>
                    </div>
                    <img src="{{URL::to('/').'/events/'}}{{$event->image}}" class="card-img-top" alt="Events">
                  </figure>
                  @endif
                  <div class="img-retting">
                    <!-- <ul>
                      <li><img src="./images/event-star.png"> <span>4.5</span> (60 reviews)</li>
                      <li>|</li>
                      <li><i class="far fa-comment-dots"></i> 40 Comments</li>
                    </ul> -->
                  </div>
                </div>
                <div class="card-body event-body">
                  <h5 class="card-title">{{$event->title}}</h5>
                  <h6><i class="fas fa-map-marker-alt"></i> {{$event->address}}</h6>
                  <p class="card-text">{{strip_tags(substr($event->description,0,200))}}...</p>
                  <a href="{{ route('business.event.delete', $event['id']) }}" onclick="return confirm('Are you sure that you want to delete this event?')" class="text-danger">Delete</a> | <a href="{{ route('business.event.edit', $event['id']) }}" class="text-dark">Edit</a>
                </div>
              </div>
            </div>
            @endforeach


      </div>
    </div>
</div>
</div>
</div>
</div>
</div>
<div class="modal fade" id="csvUploadModal" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Import CSV data
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('business.event.data.csv.store')}}" enctype="multipart/form-data" id="fileCsvUploadForm">
                    @csrf
                    <input type="file" name="file" class="form-control" accept=".csv">
                    <br>
                    <p class="small">Please select csv file</p>
                    <button type="submit" class="btn btn-sm btn-primary" id="csvImportBtn">Import <i class="fas fa-upload"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
