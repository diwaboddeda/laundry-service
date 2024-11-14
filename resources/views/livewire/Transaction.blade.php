<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('layouts/sidebar')
        </div>
        <div class="col-md-9">
            <h2>Transaction Page</h2>

            @include('layouts/flashdata')

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input wire:model="name" type="text" class="form-control" id="name">
                                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input wire:model="email" type="email" class="form-control" id="email">
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input wire:model="phone" type="number" class="form-control" id="phone" min="1">
                                @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea wire:model="address" class="form-control" id="address" rows="3"></textarea>
                                @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="service_name">Service</label>
                                <select wire:model="service_name" class="form-control" id="service_name">
                                    <option>Select Service</option>
                                    @foreach ($services as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }} / (Rp.
                                            {{ number_format($item->price) }})</option>
                                    @endforeach
                                </select>
                                @error('service_name') <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="weight">Weight</label>
                                <input wire:model="weight" type="number" class="form-control" id="weight" min="1">
                                @error('weight') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="form-group">
                                <label for="total_amount">Total Amount</label>
                                <input wire:model="total_payment" readonly type="text" class="form-control" id="total_amount">
                                @error('total_payment') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Items</label>
                                @foreach ($items as $key => $item)
                                    <div class="input-group mb-2">
                                        <input wire:model="items.{{$key}}" type="text" class="form-control">
                                        <div class="input-group-prepend">
                                            <div wire:click="removeItem({{$key}})" class="input-group-text pointer">x</div>
                                        </div>
                                    </div>
                                @endforeach
                                @error('items') <small class="text-danger">{{ $message }}</small> @enderror
                                @error('items.*') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <span wire:click="addItem" class="badge badge-primary pointer">Add</span>
                        </div>
                    </div>
                    <button wire:click="store" class="btn btn-success btn-sm mt-3">Save Transaction</button>
                </div>
            </div>
        </div>
    </div>
</div>
