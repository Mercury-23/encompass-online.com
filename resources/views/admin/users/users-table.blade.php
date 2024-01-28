@push('css')
    <style>
        .table-container {
            height: 500px !important;
            overflow-y: scroll !important;
            padding: .5rem;
            border-radius: 6px;
        }
        .table-container table thead {
            border: 1px solid #ccc;
        }
        .table-container table tbody {
            border: 1px solid #ccc;
        }
        .table-container table tbody tr {
            border: 1px solid #ccc;
        }
        .table-container table tbody tr:hover {
            cursor: pointer;
        }
    </style>
@endpush

@push('js')

@endpush

<div class="border table-container">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Type</th>
            </tr>
        </thead>
        <tbody class="table-body">
            @foreach($users as $user)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-sm me-3">
                                <img alt="Image placeholder"
                                     src="{{ '/img/avatars/' . $user->avatar }}"
                                     class="avatar-img rounded-circle w-10">
                            </div>
                            <div class="d-flex align-items-center">
                                <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="d-flex align-items-center">
                                <h6 class="mb-0 text-sm">{{ $user->email }}</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="d-flex align-items-center">
                                <h6 class="mb-0 text-sm">{{ $user->type }}</h6>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
