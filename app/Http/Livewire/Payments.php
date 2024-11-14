<?php

namespace App\Http\Livewire;

use App\Mail\PaymentMail; // Change PembayaranMail to PaymentMail
use App\Models\Transaksi as Transaction; // Change Transaksi to Transaction
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class Payments extends Component // Change class name to Payment
{
    public function mount()
    {
        if (session()->missing('transaction_id')) { // Change transaksi_id to transaction_id
            return redirect('/progress'); // Change '/progres' to '/progress'
        }
    }

    public function payment() // Change pembayaran to payment
    {
        DB::transaction(function () {
            $transaction = Transaction::find(session('transaction_id')); // Change transaksi to transaction
            $transaction->update([
                'status' => 5
            ]);

            Mail::to($transaction->item->user->email)->send(new PaymentMail($transaction)); // Change barang to item

            session()->forget('transaction_id'); // Change transaksi_id to transaction_id
            session()->flash('success', 'Payment successful.'); // Change success message to English
            return redirect('/progress'); // Change '/progres' to '/progress'
        });
    }

    public function back() // Change kembali to back
    {
        return redirect('/progress'); // Change '/progres' to '/progress'
    }

    public function render()
    {
        $transaction = Transaction::find(session('transaction_id')); // Change transaksi to transaction
        return view('livewire.payment', compact('transaction')); // Change pembayarant to payment
    }
}
