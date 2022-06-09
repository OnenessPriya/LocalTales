@extends('business.app')

@section('page', 'Coupon')

@section('content')
<section class="sectionCard">
    <div class="row">
        <div class="col-xl-12">
            <div class="search__filter">
                <div class="row justify-content-between">
                    <div class="col">
                        <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#exampleModal">
                            Add New
                        </button>
                    </div>
                    <div class="col-auto">
                        <form action="{{ route('business.market-coupon.index') }}" method="GET">
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-auto">
                                    <input type="search" name="term" class="form-control mb-0" placeholder="Search here.." id="term" value="{{app('request')->input('term')}}" autocomplete="off">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-outline-danger">Search Coupon</button>
                                </div>
                            </div>
                        </form>
                        </form>
                    </div>
                </div>
            </div>
            <form action="">

                <table class="table">
                    <thead>
                        <tr>
                            <th class="check-column">
                                <div class="form-check">
                                    <input class="" type="checkbox" id="flexCheckDefault" onclick="headerCheckFunc()">
                                    <label class="form-check-label" for="flexCheckDefault"></label>
                                </div>
                            </th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Validity</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($coupon as $index => $item)
                        @php
                        if (!empty($_GET['status'])) {
                            if ($_GET['status'] == 'active') {
                                if ($item->status == 0) continue;
                            } else {
                                if ($item->status == 1) continue;
                            }
                        }
                        @endphp
                        <tr>
                            {{-- <td class="check-column">
                                <input name="delete_check[]" class="tap-to-delete" type="checkbox" onclick="clickToRemove()" value="{{$item->id}}"
                                @php
                                if (old('delete_check')) {
                                    if (in_array($item->id, old('delete_check'))) {
                                        echo 'checked';
                                    }
                                }
                                @endphp>
                            </td> --}}
                            <td>
                            {{$item->name}}
                            <div class="row__action">
                                <a href="{{ route('business.market-coupon.details', $item->id) }}">Edit</a>
                                <a href="{{ route('business.market-coupon.details', $item->id) }}">View</a>
                                <a href="{{ route('business.market-coupon.status', $item->id) }}">{{($item->status == 1) ? 'Active' : 'Inactive'}}</a>
                                <a href="{{ route('business.market-coupon.delete', $item->id) }}" class="text-danger">Delete</a>
                            </div>
                            </td>
                            <td>{{$item->coupon_code}}</td>
                            <td>{{ ($item->type == 1) ? 'Flat' : 'Offer' }}</td>
                            <td>{{$item->amount}}</td>
                            <td>{{date('d M Y', strtotime($item->start_date))}} - {{date('d M Y', strtotime($item->end_date))}}</td>
                            <td>Published<br/>{{date('d M Y', strtotime($item->created_at))}}</td>
                            <td><span class="badge bg-{{($item->status == 1) ? 'success' : 'danger'}} text-white">{{($item->status == 1) ? 'Active' : 'Inactive'}}</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="100%" class="small text-muted">No data found</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </form>
        </div>

    </div>
</section>
@endsection

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title page__subtitle" id="exampleModalLabel">Add New</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('business.market-coupon.store') }}" enctype="multipart/form-data">
                @csrf
                    <div class="form-group mb-3">
                        <label class="label-control">Name <span class="text-danger">*</span> </label>
                        <input type="text" name="name" placeholder="" class="form-control" value="{{old('name')}}">
                        @error('name') <p class="small text-danger">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="label-control">Coupon code <span class="text-danger">*</span> </label>
                        <input type="text" name="coupon_code" placeholder="" class="form-control" value="{{old('coupon_code')}}">
                        @error('coupon_code') <p class="small text-danger">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="label-control">Type <span class="text-danger">*</span> </label>
                        <input type="text" name="type" placeholder="" class="form-control" value="{{old('type')}}">
                        @error('type') <p class="small text-danger">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="label-control">Amount <span class="text-danger">*</span> </label>
                        <input type="number" name="amount" placeholder="" class="form-control" value="{{old('amount')}}">
                        @error('amount') <p class="small text-danger">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="label-control">Max time of use <span class="text-danger">*</span> </label>
                        <input type="number" name="max_time_of_use" placeholder="" class="form-control" value="{{old('max_time_of_use')}}">
                        @error('max_time_of_use') <p class="small text-danger">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="label-control">Max time one can use <span class="text-danger">*</span> </label>
                        <input type="number" name="max_time_one_can_use" placeholder="" class="form-control" value="{{old('max_time_one_can_use')}}">
                        @error('max_time_one_can_use') <p class="small text-danger">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="label-control">Start date <span class="text-danger">*</span> </label>
                        <input type="date" name="start_date" placeholder="" class="form-control" value="{{old('start_date')}}">
                        @error('start_date') <p class="small text-danger">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="label-control">End date <span class="text-danger">*</span> </label>
                        <input type="date" name="end_date" placeholder="" class="form-control" value="{{old('end_date')}}">
                        @error('end_date') <p class="small text-danger">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-sm btn-danger">Add New</button>
                    </div>
                </form>
        </div>
        </div>
    </div>
</div>
