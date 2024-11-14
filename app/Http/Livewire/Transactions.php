<?php

namespace App\Http\Livewire;

use App\Mail\TransactionMail; // Rename to TransactionMail
use App\Models\Item; // Rename Barang to Item
use App\Models\ItemDetail; // Rename DetailBarang to ItemDetail
use App\Models\Customer; // Rename Konsumen to Customer
use App\Models\Service; // Rename Layanan to Service
use App\Models\Transaction as ModelsTransaction; // Rename Transaksi to Transaction
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class Transactions extends Component // Rename class to Transaction
{
    public $name, $email, $phone, $address, $service_name, $weight, $total_payment, $items = [];

    public function mount()
    {
        array_push($this->items, "");
    }

    protected function rules()
    {
        return [
            'name' => 'required',
            'email' => ['required', 'email'],
            'phone' => ['required', 'digits:10', 'numeric'],
            'address' => 'required',
            'service_name' => 'required',
            'weight' => 'required|min:1|numeric',
            'items' => 'array',
            'items.*' => 'nullable|string|min:1',  // Ensure items have a value
        ];
    }

    public function addItem()
    {
        array_push($this->items, "");
    }

    public function removeItem($key)
    {
        unset($this->items[$key]);
    }

    public function store()
    {
        $this->validate();

        DB::transaction(function () {
            $service = Service::find($this->service_name);

            // Create User
            $user = $this->createUser();

            // Create Customer
            $customer = $this->createCustomer($user->id);

            // Create Item
            $item = $this->createItem($user->id);

            // Create Item Details
            $this->createItemDetails($item);

            // Create Transaction
            $transaction = $this->createTransaction($item, $service);

            // Send Transaction Email
            $this->sendTransactionEmail($transaction);

            session()->flash('success', 'Data successfully added.'); // Success message
            return redirect('/progress'); // Redirect after success
        });
    }

    public function render()
    {
        if ($this->service_name && $this->weight) {
            $service = Service::find($this->service_name);
            $this->total_payment = $service->price * $this->weight;
        } else {
            $this->total_payment = 0;
        }

        $services = Service::all(); // Retrieve all services
        return view('livewire.transaction', compact('services')); // Pass services to the view
    }

    private function createUser()
    {
        return User::create([
            'name' => $this->name,
            'email' => $this->email,
            'role_id' => 3
        ]);
    }

    private function createCustomer($userId)
    {
        return Customer::create([
            'phone' => $this->phone,
            'address' => $this->address,
            'user_id' => $userId,
        ]);
    }

    private function createItem($userId)
    {
        return Item::create([
            'name' => 'Default Item Name', // Adjust if needed
            'weight' => $this->weight,
            'user_id' => $userId,
        ]);
    }

    private function createItemDetails($item)
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

    private function createTransaction($item, $service)
    {
        return ModelsTransaction::create([
            'service_id' => $this->service_name,
            'item_id' => $item->id,
            'total_payment' => $service->price * $this->weight,
            'received_date' => now(),
            'pickup_date' => now()->addHours($service->duration),
            'status' => 0
        ]);
    }

    private function sendTransactionEmail($transaction)
    {
        Mail::to($this->email)->send(new TransactionMail($transaction));
    }
}
