@if ($add)
    <div class="modal fade show" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        style="padding-right: 12px; display: block;">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Service</h5>
                    <button wire:click="format" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input wire:model="name" type="text" class="form-control" id="nama">
                            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group">
                            <label for="duration">Duration</label>
                            <input wire:model="duration" type="number" min="1" class="form-control" id="duration">
                            @error('duration') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input wire:model="price" type="number" min="1" class="form-control" id="price">
                            @error('price') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button wire:click="format" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button wire:click="store" type="button" class="btn btn-success">Save</button>
                </div>
            </div>
        </div>
    </div>
@endif
