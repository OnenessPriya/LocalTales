@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
@include('business.partials.flash')
<div class="row">
    <div class="col-12">


        <div class="tile">
            <div class="tile-body">
                <div class="col-12 text-right">
                    {{-- <a type="button"class="btn btn-primary pull-right" href="{{route('admin.market-item.create')}}"><i class="fas fa-plus"></i> Add Product</a> --}}
<br><br>

                {{-- <a href="#csvUploadModal" data-toggle="modal" class="btn btn-blue text-center w-auto"><i class="fa fa-cloud-upload"></i> CSV Upload</a>
                <a href="" class="btn btn-blue text-center w-auto"><i class="fa fa-cloud-download"></i> CSV Export</a> --}}
                <table class="table table-hover custom-data-table-style table-striped" id="sampleTable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th> Name </th>
                            <th> Category </th>
                            <th> SubCategory </th>
                            <th> Image </th>
                            <th> Status </th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product as $key => $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->category->title }}</td>
                                <td>{{ $category->subcategory->title }}</td>
                                <td>
                                    @if($category->image!='')
                                    <img style="width: 50px;height: 50px;" src="{{URL::to('/').'/product/'}}{{$category->image}}">
                                    @endif
                                </td>
                                <td class="text-center">
                                <div class="toggle-button-cover margin-auto">
                                    <div class="button-cover">
                                        {{-- <div class="button-togglr b2" id="button-11"> --}}
                                            <input id="toggle-block" type="checkbox" name="status" class="checkbox" data-category_id="{{ $category['id'] }}" {{ $category['status'] == 1 ? 'checked' : '' }}>
                                            <div class="knobs"><span>Inactive</span></div>
                                            <div class="layer"></div>
                                        {{-- </div> --}}
                                    </div>
                                </div>
                            </td>
                            {{-- <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Second group">
                                    <a href="{{ route('admin.market-item.edit', $category['id']) }}" class="btn btn-sm btn-primary edit-btn"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('admin.market-item.details', $category['id']) }}" class="btn btn-sm btn-primary edit-btn"><i class="fa fa-eye"></i></a>
                                    <a href="#" data-id="{{$category['id']}}" class="sa-remove btn btn-sm btn-danger edit-btn"><i class="fa fa-trash"></i></a>
                                </div>
                            </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
      </div>
    </div>
</div>
</div>
</div>
</div>
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
        <form method="post" action="" enctype="multipart/form-data" id="fileCsvUploadForm">
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
