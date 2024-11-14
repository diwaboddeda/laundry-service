<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('layouts/sidebar')
        </div>
        <div class="col-md-9">
            <h2>Payment Page</h2>

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Customer Name</label>
                                <input value="{{$transaction->item->user->name}}" readonly type="text" class="form-control" id="name">
                            </div>
                            <div class="form-group">
                                <label for="email">Customer Email</label>
                                <input value="{{$transaction->item->user->email}}" readonly type="text" class="form-control" id="email">
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="service_name">Service</label>
                                <input value="{{$transaction->service->name}}" readonly type="text" class="form-control" id="service_name">
                            </div>
                            <div class="form-group">
                                <label for="weight">Weight</label>
                                <input value="{{$transaction->item->weight}} Kg" readonly type="text" class="form-control" id="weight" min="1">
                            </div>
                            <div class="form-group">
                                <label for="total_amount">Total Amount</label>
                                <input value="Rp. {{number_format($transaction->total_amount)}}" readonly type="text" class="form-control" id="total_amount">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Items</label>
                                @foreach ($transaction->item->item_details as $detail)
                                    <input value="{{$detail->name}}" type="text" class="form-control mb-3" readonly>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <button wire:click="pay" class="btn btn-success btn-sm mt-3">Pay</button>
                    <button wire:click="goBack" class="btn btn-secondary btn-sm mt-3">Back</button>
                </div>
            </div>
        </div>
    </div>
</div>
