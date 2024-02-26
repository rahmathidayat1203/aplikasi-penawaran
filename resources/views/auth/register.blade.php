@extends('layouts.auth.main')
@section('content')
<div class="card-body">
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    @endif

    <!-- Toggle Switch untuk Beralih Form -->
    <label class="custom-switch mt-2">
        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="formSwitch">
        <span class="custom-switch-indicator"></span>
        <span class="custom-switch-description">Switch to Form</span>
    </label>

    <!-- Form Register distrbutor -->
    <div id="normalRegisterForm">
        <form method="POST" action="{{ route('register.post',2) }}">
            @csrf
            <div class="row">
                <div class="form-group col-6">
                    <label for="first_name">First Name</label>
                    <input id="first_name" type="text" class="form-control" name="first_name" autofocus>
                </div>
                <div class="form-group col-6">
                    <label for="last_name">Last Name</label>
                    <input id="last_name" type="text" class="form-control" name="last_name">
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control" name="email">
            </div>

            <div class="form-group">
                <label for="no_hp">No Hp</label>
                <input id="no_hp" type="text" class="form-control" name="no_hp">
            </div>

            <div class="row">
                <div class="form-group col-6">
                    <label for="password" class="d-block">Password</label>
                    <input id="password" type="password" class="form-control" name="password">
                </div>
                <div class="form-group col-6">
                    <label for="password_confirmation" class="d-block">Password Confirmation</label>
                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Register
                </button>
            </div>
        </form>
    </div>

    {{-- distributor form --}}
    <div id="farmerRegisterForm" style="display:none;">
        <form method="POST" action="{{route('register.post',1)}}">
            @csrf
            <div class="row">
                <div class="form-group col-6">
                    <label for="first_name_farmer">First Name</label>
                    <input id="first_name_farmer" type="text" class="form-control" name="first_name" autofocus>
                </div>
                <div class="form-group col-6">
                    <label for="last_name_farmer">Last Name</label>
                    <input id="last_name_farmer" type="text" class="form-control" name="last_name">
                </div>
            </div>

            <div class="form-group">
                <label for="email_farmer">Email</label>
                <input id="email_farmer" type="email" class="form-control" name="email">
            </div>
            <div class="form-group">
                <label for="no_hp">No Hp</label>
                <input id="no_hp" type="text" class="form-control" name="no_hp">
            </div>

            <div class="row">
                <div class="form-group col-6">
                    <label for="password_farmer" class="d-block">Password</label>
                    <input id="password_farmer" type="password" class="form-control" name="password">
                </div>
                <div class="form-group col-6">
                    <label for="password_confirmation_farmer" class="d-block">Password Confirmation</label>
                    <input id="password_confirmation_farmer" type="password" class="form-control" name="password_confirmation">
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Register as Farmer
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById("formSwitch").addEventListener("change", function() {
        var normalForm = document.getElementById("normalRegisterForm");
        var farmerForm = document.getElementById("farmerRegisterForm");
        var isChecked = this.checked;

        var label = document.querySelector(".custom-switch-description");
        label.textContent = isChecked ? "Distributor Form" : "Farmer Form";

        if (isChecked) {
            normalForm.style.display = "none";
            farmerForm.style.display = "block";
        } else {
            normalForm.style.display = "block";
            farmerForm.style.display = "none";
        }
    });
</script>
@endsection
