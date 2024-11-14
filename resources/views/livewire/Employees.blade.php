<div class="container">
    <div class="row">
        <div class="col-md-4 col-lg-3">
            @include('layouts/sidebar')
        </div>
        <div class="col-md-8 col-lg-9">
            <h2>Employee Page</h2>

            @include('layouts/employee/add')
            @include('layouts/employee/edit')
            @include('layouts/employee/delete')
            @include('layouts/flashdata')

            <div class="row">
                <div class="col-md-8">
                    <button wire:click="show_add" type="button" class="btn btn-primary btn-sm mb-3">
                        Add Employee
                    </button>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <input wire:model="search" type="text" class="form-control" placeholder="Search">
                        <div class="input-group-prepend" style="cursor: pointer">
                            <div wire:click="format_search" class="input-group-text">x</div>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="10%" scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Address</th>
                        <th width="10%" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($employees) && $employees->count() > 0)
                        @foreach ($employees as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->address }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button wire:click="show_edit({{ $item->id }})" type="button" class="btn btn-sm btn-primary mr-2">Edit</button>
                                        <button wire:click="show_delete({{ $item->id }})" type="button" class="btn btn-sm btn-danger">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center">No employees found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>

            <!-- Pagination links with fallback for undefined $employees -->
            @if(isset($employees))
                <div class="d-flex justify-content-center">
                    {{ $employees->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
