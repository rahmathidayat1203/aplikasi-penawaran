@extends('layouts.dashboard.main')
@section('content')
    <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3 ml-auto">Create Roles</a>
    <div class="container">
        <table id="roles-table" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            $('#roles-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('roles.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });

        $(document).on('click', '.deleteRecord', function() {

            var id = $(this).data("id");
            var token = $("meta[name='csrf-token']").attr("content");

            if (confirm("Are you sure you want to delete this item?")) {
                $.ajax({
                    url: "roles/" + id, // Ensure this URL is correct and can handle DELETE requests.
                    type: 'DELETE',
                    data: {
                        "id": id, // Some APIs might not require this in the body for DELETE requests.
                        "_token": token,
                    },
                    success: function(response) {
                        console.log("It Works", response);
                        location.reload();
                        // Optionally, remove the element from the DOM or refresh the part of your UI here.
                    },
                    error: function(xhr, status, error) {
                        // Handle errors here
                        console.error("Error occurred: ", status, error);
                    }
                });
            }
        });
    </script>
@endsection
