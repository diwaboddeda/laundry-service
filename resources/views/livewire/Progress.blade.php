<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('layouts/sidebar')
        </div>
        <div class="col-md-9">
            <h2>Progress Page</h2>

            @include('layouts/flashdata')

            <div class="row mb-3">
                <div class="col-md-4">
                    <label>Received Date</label>
                    <input wire:model="received_date" type="date" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Picked Up Date</label>
                    <input wire:model="pickup_date" type="date" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Search</label>
                    <div class="input-group">
                        <input wire:model="search" type="text" class="form-control" placeholder="Search">
                        <div class="input-group-prepend" style="cursor: pointer">
                            <div wire:click="resetSearch" class="input-group-text">x</div>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="10%" scope="col">No</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Total Payment</th>
                        <th scope="col">Service</th>
                        <th scope="col">Received Date</th>
                        <th scope="col">Picked Up Date</th>
                        <th scope="col">Status</th>
                        <th width="10%" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($progress as $item)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $item->item->user->name }}</td>
                            <td>Rp. {{ number_format($item->total_payment) }}</td>
                            <td>{{ $item->service->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->received_date)->format('d m Y, H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->pickup_date)->format('d m Y, H:i') }}</td>
                            <td>
                                @if ($item->status == 0)
                                    <span class="badge badge-secondary">Received</span>
                                @elseif ($item->status == 1)
                                    <span class="badge badge-dark">Washed</span>
                                @elseif ($item->status == 2)
                                    <span class="badge badge-primary">Dried</span>
                                @elseif ($item->status == 3)
                                    <span class="badge badge-info">Ironed</span>
                                @elseif ($item->status == 4)
                                    <span class="badge badge-warning">Waiting for Payment</span>
                                @elseif ($item->status == 5)
                                    <span class="badge badge-success">Completed</span>
                                @endif
                            </td>
                            <td>
                                @if ($item->status == 0)
                                    <button wire:click="action({{ $item->id }})" type="button"
                                        class="btn btn-sm btn-dark mr-2">Wash</button>
                                @elseif ($item->status == 1)
                                    <button wire:click="action({{ $item->id }})" type="button"
                                        class="btn btn-sm btn-primary mr-2">Dry</button>
                                @elseif ($item->status == 2)
                                    <button wire:click="action({{ $item->id }})" type="button"
                                        class="btn btn-sm btn-info mr-2">Iron</button>
                                @elseif ($item->status == 3)
                                    <button wire:click="action({{ $item->id }})" type="button"
                                        class="btn btn-sm btn-warning mr-2">Waiting for Payment</button>
                                @elseif ($item->status == 4)
                                    <button wire:click="payment({{ $item->id }})" type="button"
                                        class="btn btn-sm btn-success mr-2">Payment</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $progress->links() }}
        </div>
    </div>
</div>
