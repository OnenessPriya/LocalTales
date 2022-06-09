@extends('business.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
@include('business.partials.flash')

<div class="row">
    <div class="col-12 col-md-7">
        <div class="card">
            <div class="card-header">Add a deal</div>
        	<div class="card-body">
            <form action="{{ route('business.deal.update') }}" method="POST" role="form" enctype="multipart/form-data">
            	<div class="row">
            @csrf
            	<input type="hidden" name="business_id" value="{{Auth::user()->id}}">
            	<input type="hidden" name="id" value="{{$targetDeal->id}}">
            	<div class="col-sm-12">
	                <label class="mb-1">
	                    <h6 class="mb-0 text-sm text-dark">Event Category</h6>
	                </label>
	                 <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                        <option value="">Select a Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"  @if($targetDeal->category_id==$category->id){{"selected"}}@endif>{{ $category->title }}</option>
                        @endforeach
                    </select>

	            </div>
	            <div class="col-sm-12">
	                <label class="mb-1">
	                    <h6 class="mb-0 text-sm text-dark">Title</h6>
	                </label>
	                <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title', $targetDeal->title) }}"/>
                            @error('title') {{ $message ?? '' }} @enderror
	            </div>
	            <div class="col-sm-12 mb-3">
	                <label class="mb-1">
	                    <h6 class="mb-0 text-sm text-dark">Short Description</h6>
	                </label>
	                <div class="col-12 p-0">
	                    <textarea class="form-control" rows="4" name="short_description" id="short_description" id="eveDesc">{{ old('short_description', $targetDeal->short_description) }}</textarea>
	                </div>
	            </div>
	            <div class="col-sm-12 mb-3">
	                <label class="mb-1">
	                    <h6 class="mb-0 text-sm text-dark">Description</h6>
	                </label>
	                <div class="col-12 p-0">
	                    <textarea class="form-control" rows="4" name="description" id="description" id="eveDesc">{{ old('description', $targetDeal->description) }}</textarea>
	                </div>
	            </div>
	            <div class="col-sm-12">
	                <label class="mb-1">
	                    <h6 class="mb-0 text-sm text-dark">Address</h6>
	                </label>
	                <input class="form-control @error('address') is-invalid @enderror" type="text" name="address" id="address" value="{{ old('address', $targetDeal->address) }}"/>
	            </div>
	            <div class="col-sm-6">
	                <label class="mb-1">
	                    <h6 class="mb-0 text-sm text-dark">Latitude</h6>
	                </label>
	                <input class="form-control @error('lat') is-invalid @enderror" type="text" name="lat" id="lat" value="{{ old('lat', $targetDeal->lat) }}"/>
	            </div>
	            <div class="col-sm-6">
	                <label class="mb-1">
	                    <h6 class="mb-0 text-sm text-dark">Longitude</h6>
	                </label>
	                <input class="form-control @error('lon') is-invalid @enderror" type="text" name="lon" id="lon" value="{{ old('lon', $targetDeal->lon) }}"/>
	            </div>
	            <div class="col-sm-6">
	                <label class="mb-1">
	                    <h6 class="mb-0 text-sm text-dark">Pin Code</h6>
	                </label>
	                <input class="form-control @error('pin') is-invalid @enderror" type="text" name="pin" id="pin" value="{{ old('pin', $targetDeal->pin) }}"/>
	            </div>
	            <div class="col-sm-6">
	                <label class="mb-1">
	                    <h6 class="mb-0 text-sm text-dark">Expiry Date</h6>
	                </label>
	                <input class="form-control @error('expiry_date') is-invalid @enderror" type="date" name="expiry_date" id="expiry_date" value="{{ old('expiry_date', $targetDeal->expiry_date) }}"/>
	            </div>
	            <div class="col-sm-6">
	                <label class="mb-1">
	                    <h6 class="mb-0 text-sm text-dark">Price</h6>
	                </label>
	                <input class="form-control @error('price') is-invalid @enderror" type="text" name="price" id="price" value="{{ old('price', $targetDeal->price) }}"/>
	            </div>
	            <div class="col-sm-6">
	                <label class="mb-1">
	                    <h6 class="mb-0 text-sm text-dark">Promo Code</h6>
	                </label>
	                <input class="form-control @error('promo_code') is-invalid @enderror" type="text" name="promo_code" id="promo_code" value="{{ old('promo_code', $targetDeal->promo_code) }}"/>
	            </div>
	            <div class="col-sm-12 mb-3">
	                <label class="mb-1">
	                    <h6 class="mb-0 text-sm text-dark">How to redeem</h6>
	                </label>
	                <div class="col-12 p-0">
	                    <textarea class="form-control" rows="4" name="how_to_redeem" id="how_to_redeem" id="eveDesc">{{ old('how_to_redeem', $targetDeal->how_to_redeem) }}</textarea>
	                </div>
	            </div>
	            <div class="col-sm-12">
	                <button type="submit" class="btn btn-blue text-center">Update Deal</button>
                    <a type="button"class="btn btn-blue text-center" href="{{route('business.deal.index')}}"> Back</a>
	            </div>
	        </div>
	        </form>
	    </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/10.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#description' ) )
        .catch( error => {
            console.error( error );
        } );
    ClassicEditor
        .create( document.querySelector( '#short_description' ) )
        .catch( error => {
            console.error( error );
        } );
    ClassicEditor
        .create( document.querySelector( '#how_to_redeem' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endpush
