@extends('layouts.dashboard.main')
@section('content')
    <a href="{{route('permissions.create')}}" class="btn btn-primary mb-3 ml-auto">Create Roles</a>
    <div class="container">
        <table id="permission-table" class="display" style="width:100%">
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
            $('#permission-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('permissions.index') }}",
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

        function deletePermission(id) {
            var token = $("meta[name='csrf-token']").attr("content");
            if (confirm("Are you sure you want to delete this item?")) {
                $.ajax({
                    url: "permissions/" + id, // Ensure this URL is correct and can handle DELETE requests.
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
        }
    </script>
@endsection
