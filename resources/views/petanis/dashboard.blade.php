@extends('layouts.dashboard.main')
@section('content')
    <a href="{{route('offerpetanis.create')}}" class="btn btn-primary mb-3 ml-auto">Create Product</a>
    <table id="roles-table" class="display" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama produk</th>
                <th>Quantity</th>
                <th>Harga Mulai Penwaran</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>
@endsection
