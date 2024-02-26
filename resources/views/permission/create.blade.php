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
                            <form action="{{ route('permissions.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name[]" class="form-control">
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 mb-2">
                                        <button id="add-input" type="button" class="add-input btn btn-info">+</a>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addButton = document.getElementById('add-input');
            const formGroup = document.querySelector('.form-group');

            addButton.addEventListener('click', addInputField);

            function addInputField() {
                // Buat elemen input baru
                const input = document.createElement('input');
                input.setAttribute('type', 'text');
                input.setAttribute('name', 'name[]');
                input.classList.add('form-control');
                input.classList.add('mt-2');

                // Tambahkan elemen input ke dalam form
                formGroup.appendChild(input);
            }
        });
    </script>
@endsection
