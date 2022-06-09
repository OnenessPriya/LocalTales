@extends('business.app')

@section('page', 'Order')

@section('content')
<section class="sectionCard">
    <div class="search__filter">
        <div class="row align-items-center justify-content-between">
        <div class="col">
            {{-- <ul>
            <li class="active"><a href="#">All <span class="count">({{$data->count()}})</span></a></li>
            <li><a href="#">Active <span class="count">(7)</span></a></li>
            <li><a href="#">Inactive <span class="count">(3)</span></a></li>
            </ul> --}}
        </div>
        <div class="col-auto">
            <form action="{{ route('business.directory.review')}}" method="GET">
                <div class="row g-3 align-items-center mb-2">
                    <div class="col-auto">
                    <input type="search" name="term" id="term" class="form-control mb-0" placeholder="Search here.."
                    value="{{app('request')->input('term')}}"
                    autocomplete="off">
                    </div>
                    <div class="col-auto pl-0">
                    <button type="submit" class="btn btn-outline-danger">Search</button>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>

    <div class="filter">
        <div class="row align-items-center justify-content-between">
        <div class="col">
            {{-- <form>
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                <select class="form-control">
                    <option>Select Category</option>
                    <option>T-shirt</option>
                    <option>Jacket</option>
                    <option>Vests</option>
                    <option>Brief</option>
                    <option>Track Pants</option>
                    <option>Joggers</option>
                    <option>Socks</option>
                    <option>Sweatshirt</option>
                    <option>Thermal</option>
                    <option>Trunks</option>
                    <option>Boxer</option>
                </select>
                </div>
                <div class="col-auto">
                <select class="form-control">
                    <option>Select Range</option>
                    <option>Grandde</option>
                    <option>Stretchz</option>
                    <option>Sport</option>
                    <option>Comfortz</option>
                    <option>Acttive</option>
                    <option>Platina</option>
                    <option>Relaxz</option>
                    <option>Footkins</option>
                    <option>Thermal</option>
                    <option>Winter</option>
                </select>
                </div>
                <div class="col-auto">
                <button type="submit" class="btn btn-outline-danger btn-sm">Apply</button>
                </div>
            </div>
            </form> --}}
        </div>
        <div class="col-auto">
            <p>{{$review->count()}} Items</p>
        </div>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th class="check-column">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault"></label>
                </div>
            </th>
            <th>Business</th>
            <th>Name</th>
            <th>Email</th>
            <th>Comment</th>
            <th>Rating</th>

        </tr>
        </thead>
        <tbody>
            @forelse ($review as $index => $item)
            <tr>
                <td class="check-column">
                {{-- <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault"></label>
                </div> --}}

                    <td class="small text-dark mb-1">{{$item->business->name}}</td>
                    <td class="small text-dark mb-1">{{$item->name}}</td>
                    <td class="small text-dark mb-1">{{$item->email}}</td>
                    <td class="small text-dark mb-1">{{$item->comment}}</td>
                    <td class="small text-muted mb-0">{{$item->rating}}</td>
                    {{-- <div class="row__action">
                        <a href="">View</a>
                    </div> --}}



            </tr>
            @empty
            <tr><td colspan="100%" class="small text-muted">No data found</td></tr>
            @endforelse
        </tbody>
    </table>
</section>
@endsection
