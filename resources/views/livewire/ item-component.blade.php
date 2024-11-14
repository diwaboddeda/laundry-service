<div>
    <h2>Create Item and Details</h2>

    <!-- Flash message for success -->
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form to create an item -->
    <form wire:submit.prevent="createItem({{ auth()->user()->id }})">
        <div class="form-group">
            <label for="weight">Item Weight</label>
            <input type="number" wire:model="weight" class="form-control" id="weight" placeholder="Enter item weight" required>
        </div>

        <div class="form-group">
            <label for="items">Item Names</label>
            <input type="text" wire:model="items" class="form-control" id="items" placeholder="Enter item names, separated by commas" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Create Item</button>
    </form>

    <!-- List of items (optional, can be used to show all items created) -->
    <h3 class="mt-5">Created Items</h3>
    <ul>
        @foreach ($items as $item)
            <li>{{ $item->name }} - {{ $item->weight }} kg</li>
        @endforeach
    </ul>
</div>
