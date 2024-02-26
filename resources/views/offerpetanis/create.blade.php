@extends('layouts.dashboard.main')
@section('content')
    <style>
        body {
            background-color: rgb(239, 239, 239);
        }

        .section-body {
            width: 200%,
        }
    </style>
    <section class="section">
        <div class="section-header">
            <h1>Form {{ $title }}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('offerpetanis.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Masukkan Nama Product</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Quantity Product</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Harga Mulai Penawaran</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>File</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-info">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
