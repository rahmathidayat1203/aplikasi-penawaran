@extends('layouts.dashboard.main')
@section('content')
    <style>
        body {
            background-color: #eaeaea;
        }

        .section-body {
            width: 500px
        }

        input {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> Something went wrong.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('roles.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Permission</label><br>
                                    @foreach ($permission as $value)
                                        <input type="checkbox" name="permission[]" value="{{ $value->name }}"
                                            class="name">
                                        {{ $value->name }}
                                        <br />
                                    @endforeach

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
