@extends('business.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title mb-3">
        <div class="row w-100">
            <div class="col-md-6">
                <h1><i class="fa fa-file"></i> {{ $pageTitle }}</h1>
                {{-- <p></p> --}}
            </div>
            {{-- <div class="col-md-6 text-right">
                <a href="{{ route('admin.state.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
                <a href="#csvUploadModal" data-toggle="modal" class="btn btn-primary "><i class="fa fa-cloud-upload"></i> CSV Upload</a>
                {{-- <a href="#csvUploadModal" class="btn btn-primary "><i class="fa fa-cloud-download"></i> CSV Export</a>
            </div> --}}
        </div>
    </div>
    @include('business.partials.flash')
<section class="sectionCard">
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="row align-items-center justify-content-between mb-3">
                <div class="col">
                    <ul>
                        <li class="active"><a href="{{ route('business.trade.index') }}">All <span class="count">({{$data->count()}})</span></a></li>

                    </ul>
                </div>
                <div class="col-auto">
                    <form action="{{ route('business.trade.index') }}">
                    <div class="row g-3 align-items-center">
                        <div class="col-auto">
                        <input type="search" name="term" id="term" class="form-control mb-0" placeholder="Search here.." value="{{app('request')->input('term')}}" autocomplete="off">
                        </div>
                        <div class="col-auto pl-0">
                        <button type="submit" class="btn btn-outline-danger">Search Enquiries</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
                <div class="tile-body">
                    @if(isset($cat))
                    <table class="table table-hover custom-data-table-style table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th> IP </th>
                                <th> User Name </th>
                                <th> Postcode </th>
                                <th> Time Frame </th>
                                <th> Job Details </th>
                                <th> Budget </th>
                                <th> Category </th>
                                <th> Status </th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $key => $category)
                            {{-- {{ dd($category) }} --}}
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->ip }}</td>
                                    <td>{{ $category->user ? $category->user->name : '' }}</td>
                                    <td>{{ $category->postcode }}</td>
                                    <td>{{ $category->time_frame }}</td>
                                    <td>{{ $category->job_details }}</td>
                                    <td>{{ $category->budget }}</td>
                                    <td>{{ $category->category }}</td>
                                    <td class="text-center">
                                    <div class="toggle-button-cover margin-auto">
                                        <div class="button-cover">
                                            {{-- <div class="button-togglr b2" id="button-11"> --}}
                                                {{-- <input id="toggle-block" type="checkbox" name="status" class="checkbox" data-id="{{ $category->id }}" {{ $category['status'] == 1 ? 'checked' : '' }}> --}}
                                                <div class="knobs"><span>Inactive</span></div>
                                                <div class="layer"></div>
                                            {{-- </div> --}}
                                            {{-- <div class="button-togglr b2" id="button-11">
                                                <input id="toggle-block" type="checkbox" name="status" class="checkbox" data-state_id="{{ $category['id'] }}" {{ $category['status'] == 1 ? 'checked' : '' }}>
                                                <div class="knobs"><span>Inactive</span></div>
                                                <div class="layer"></div>
                                            </div> --}}
                                        </div>
                                    </div>
                                </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $cat->render() !!}@endif
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

