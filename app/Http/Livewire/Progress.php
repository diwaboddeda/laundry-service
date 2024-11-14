<?php
namespace App\Http\Livewire;

use App\Models\Transaction;  // Change from Transaksi to Transaction
use Livewire\Component;
use Livewire\WithPagination;

class Progress extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search, $received_date, $pickup_date;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function action(Transaction $transaction)  
    {
        $transaction->update([
            'status' => $transaction->status + 1
        ]);
        session()->flash('success', 'Action executed successfully.');
    }

    public function payment($transaction_id)
    {
        session(['transaction_id' => $transaction_id]);
        return redirect('/payment');
    }

    public function resetSearch()
    {
        $this->search = '';
    }

    public function render()
    {
        // Use 'item' instead of 'product' to match the relationship in the Transaction model
        if ($this->search || $this->received_date || $this->pickup_date) {
            $progress = Transaction::whereHas('item', function ($item) {  // Corrected from 'product' to 'item'
                $item->whereHas('user', function ($user) {
                    $user->where('name', 'like', '%' . $this->search . '%');
                });
            })
                ->where('received_date', 'like', '%' . $this->received_date . '%')  // Updated column name to 'received_date'
                ->where('pickup_date', 'like', '%' . $this->pickup_date . '%')
                ->latest()->paginate(5);
        } else {
            $progress = Transaction::latest()->paginate(5);  // Correct model reference here as well
        }
        return view('livewire.progress', compact('progress'));
    }
}

?>