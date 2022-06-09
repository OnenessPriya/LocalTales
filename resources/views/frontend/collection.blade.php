@extends('site.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')

    @foreach($dir as  $key => $blog)
    <section class="inner_banner" style="background-image: url('{{URL::to('/').'/Collection/'}}{{$blog->image}}');">
        <div class="container">
            <div class="row text-center justify-content-center">
                <div class="col-12 col-lg-12">
                    <h1>{{ $blog->title }}</h1>
                    {!! $blog->description !!}
                    <span>
                        @php
                        $category =  \App\Models\Collection::findOrFail($id);
                        // dd($data)
                    @endphp
                     <p>{{ $category->count() }} Listed</p>
                </span>
                </div>
            </div>
        </div>
    </section>
    @endforeach<!--end_innerbanner-->
    <section class="pt-2 pt-lg-4 pb-2 pb-lg-4 cafe-listing">
    <figcaption>
                    <div class="container">
                     <div class="details_info mb-0">
                         <ul class="breadcumb_list mb-0">
                           <li><a href="{!! URL::to('') !!}">Home</a></li>
                              <li>/</li>

                         <li class="active">
                            {{$category->title}} </li>
                     </ul>
                   </div>
                </div>
            </figcaption>
    </section>
    @foreach($data as  $key => $blog)
    <section class="py-4 py-lg-5">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12 col-lg-9 page-title">

                    {!! $blog->content !!}
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center cafe-listing-nav">
                <ul class="d-flex" id="tabs-nav">
                   <li class="">
                        <a href="#grid">
                            <i class="fa fa-th-large"></i>
                        </a>
                    </li>
                    <li class="">
                        <a href="#list">
                            <i class="fa fa-list"></i>
                        </a>
                    </li>

                </ul>
                <span>
                   {{$categories->count()}} Listed
                </span>
            </div>

            <div id="tab-contents">
                <div class="tab-content smallGapGrid Bestdeals" id="grid">
                    <div class="row cafe-card">
                        @foreach($categories as $key => $directory)
                       {{  dd($categories)}}
                        <div class="col-md-4 col-sm-6 col-lg-3 col-12 jQueryEqualHeight">
                            <div class="card directoryCard collectiondirectoryCard border-0">
                                <img src="{{URL::to('/').'/Directory/'}}{{$directory->directory->image}}" class="card-img-top" alt="">
                                <div class="card-body">
                                    <h5 class="card-title"> <a href="{!! URL::to('directory-details/'.$directory->directory->id.'/'.strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $directory->directory->name))) !!}" class="location_btn">{{ $directory->directory->name }}</a></h5>
                                    <div class="d-flex justify-content-between align-items-center">

                                        <span class="location mb-0">
                                            <i class="fa fa-map-marker-alt"></i>
                                            <p class="mb-0">{!! $directory->directory->address !!}</p>

                                        </span>

                                    </div>
                                </div>

                                <span class="save">
                                    <img src="{{ asset('front/img/bookmark.png')}}" alt="">
                                </span>
                            </div>
                        </div>

                        @endforeach
                    </div>
                </div>

                <div class="tab-content" id="list">

                    <div class="row cafe-card  justify-content-center">
                        @foreach($categories as $key => $directory)
                        <div class="col-12 col-lg-6">
                            <div class="card collectionListCard border-0">
                                <div class="collectionListCardImg">
                                    <img src="{{URL::to('/').'/Directory/'}}{{$directory->directory->image}}" class="card-img-top" alt="">
                                </div>
                                <div class="collectionListCardContent">
                                    <strong class="rating ml-4">
                                        <span class="badge">4.5</span>
                                        Rated
                                    </strong>
                                    <h4> <a href="{!! URL::to('directory-details/'.$directory->directory->id.'/'.strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $directory->directory->name))) !!}" class="location_btn">{{ $directory->directory->name }}</a></h4>
                                    <p>
                                        {!! $directory->directory->description !!}
                                    </p>
                                    <ul>
                                        <li>
                                            <i class="fas fa-envelope"></i>
                                            <a href="matito:test@gmail.com">{{ $directory->email }}</a>
                                        </li>
                                        <li>
                                            <i class="fas fa-phone-alt"></i>
                                            <a href="tel">{{ $directory->mobile }}</a>
                                        </li>
                                    </ul>
                                    <div class="location pt-3">
                                        <i class="fa fa-map-marker-alt"></i>
                                        <p>{!! $directory->directory->address !!}</p>
                                    </div>
                                </div>

                                <span class="save">
                                    @if ($businessSaved == 1)
                                   {{-- <img src="{{ asset('front/img/bookmark.png')}}" alt=""> <a href="{!! URL::to('site-delete-user-directory/'.$directory->id) !!}"></a> --}}
                                   <a href="{!! URL::to('site-delete-user-directory/'.$directory->id) !!}" ><img src="{{ asset('front/img/bookmark.png')}}" class="img-fluid"></a>
                                  @else

                                {{-- <a href="{!! URL::to('site-save-user-directory/'.$directory->id) !!}"><img src="{{ asset('front/img/bookmark.png')}}" alt=""></a> --}}
                                <a href="{!! URL::to('site-save-user-directory/'.$directory->id) !!}" ><img src="{{ asset('front/img/bookmark.png')}}" class="img-fluid"></a>
                                @endif
                            </span>

                            </div>
                        </div>
                        <span>
                    <!-- {{$directory->directory->count()}} Listed -->
                    </span>
                        @endforeach
                    </div>
                </div>
            </div>



        </div>
    </section>
@endforeach

    <section class="py-s py-5 light-bg more-collection">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center cafe-listing-nav page-title">
                <h3>More Collections</h3>


            </div>
            <div class="row">
                @foreach($leaduser as  $key => $col)

                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card collectionCard">
                        <a class="cardLink d-block" href="{!! URL::to('collection-page/'.$col->id) !!}">
                            <img src="{{URL::to('/').'/Collection/'}}{{$col->image}}" alt="">
                            <div class="card-body">
                                {{-- <h5><i class="fas fa-map-marker-alt"></i> {{ $col->address }}</h5> --}}
                                <h4 class="location_btn">{{ $col->title }}</h4>
                                {{-- <div class="collectionPlaces">
                                    20 Places
                                    <i class="fas fa-caret-right"></i>
                                </div> --}}
                            </div>
                        </a>
                    </div>
                </div>
                <!-- <span>
                        {{$col->count()}} Places
                    </span> -->
                @endforeach
                {{-- <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="#">
                        <div class="card">
                            <img src="img/collection-2.png" alt="">
                            <div class="card-body">
                                <h5>Melbourne's Best Take..</h5>
                                <a href="#">
                                    20 Places
                                    <i class="fas fa-caret-right"></i>
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="#">
                        <div class="card">
                            <img src="img/collection-3.png" alt="">
                            <div class="card-body">
                                <h5>Melbourne's Best Take..</h5>
                                <a href="#">
                                    20 Places
                                    <i class="fas fa-caret-right"></i>
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="#">
                        <div class="card">
                            <img src="img/collection-4.png" alt="">
                            <div class="card-body">
                                <h5>Melbourne's Best Take..</h5>
                                <a href="#">
                                    20 Places
                                    <i class="fas fa-caret-right"></i>
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="#">
                        <div class="card">
                            <img src="img/collection-5.png" alt="">
                            <div class="card-body">
                                <h5>Melbourne's Best Take..</h5>
                                <a href="#">
                                    20 Places
                                    <i class="fas fa-caret-right"></i>
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="#">
                        <div class="card">
                            <img src="img/collection-6.png" alt="">
                            <div class="card-body">
                                <h5>Melbourne's Best Take..</h5>
                                <a href="#">
                                    20 Places
                                    <i class="fas fa-caret-right"></i>
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="#">
                        <div class="card">
                            <img src="img/collection-7.png" alt="">
                            <div class="card-body">
                                <h5>Melbourne's Best Take..</h5>
                                <a href="#">
                                    20 Places
                                    <i class="fas fa-caret-right"></i>
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="#">
                        <div class="card">
                            <img src="img/collection-8.png" alt="">
                            <div class="card-body">
                                <h5>Melbourne's Best Take..</h5>
                                <a href="#">
                                    20 Places
                                    <i class="fas fa-caret-right"></i>
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="#">
                        <div class="card">
                            <img src="img/collection-1.png" alt="">
                            <div class="card-body">
                                <h5>Melbourne's Best Take..</h5>
                                <a href="#">
                                    20 Places
                                    <i class="fas fa-caret-right"></i>
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="#">
                        <div class="card">
                            <img src="img/collection-2.png" alt="">
                            <div class="card-body">
                                <h5>Melbourne's Best Take..</h5>
                                <a href="#">
                                    20 Places
                                    <i class="fas fa-caret-right"></i>
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="#">
                        <div class="card">
                            <img src="img/collection-3.png" alt="">
                            <div class="card-body">
                                <h5>Melbourne's Best Take..</h5>
                                <a href="#">
                                    20 Places
                                    <i class="fas fa-caret-right"></i>
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="#">
                        <div class="card">
                            <img src="img/collection-4.png" alt="">
                            <div class="card-body">
                                <h5>Melbourne's Best Take..</h5>
                                <a href="#">
                                    20 Places
                                    <i class="fas fa-caret-right"></i>
                                </a>
                            </div>
                        </div>
                    </a>
                </div> --}}
            </div>
        </div>
    </section>

    @foreach($data as  $key => $blog)
    <section class="py-4 py-lg-5">
        <div class="container">
            <div class="row page-title">
                <div class="col-12 mb-4">
                    {!! $blog->content1 !!}
                </div>
                <div class="col-12">
                    <a href="#" class="btn main-btn">
                        let us know your experience
                    </a>
                </div>
            </div>
        </div>
    </section>
  @endforeach



    <!-- ========== Inner Banner ========== -->
@endsection
