<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\ItemDetail;
use Livewire\Component;

class ItemComponent extends Component
{
    public $items = []; // The list of items to be processed
    public $weight;

    public function createItemDetails($item)
    {
        foreach ($this->items as $itemName) {
            if (!empty($itemName)) {
                ItemDetail::create([
                    'item_id' => $item->id,
                    'name' => $itemName
                ]);
            }
        }
    }

    public function createItem($userId)
    {
        $item = Item::create([
            'name' => 'Default Item Name', // You can replace this with dynamic data
            'weight' => $this->weight,
            'user_id' => $userId,
        ]);

        $this->createItemDetails($item); // Call createItemDetails to add the details

        session()->flash('success', 'Item and details created successfully!');
    }

    public function render()
    {
        return view('livewire.item-component');
    }
}
