<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Transaction;
use App\Models\SubProductEntity;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class TransactionDetails extends Component
{
    use WithPagination;

    public $transactionId;
    public $user;
    public $transaction;
    public $subproduct;

    public function mount($id)
    {
        // Initialize the transactionId and load the transaction data
        $this->transactionId = $id;
        $this->loadTransactionData();
    }

    public function loadTransactionData()
    {
        // Find the transaction by its ID
        // $this->transaction = Transaction::find($this->transactionId);
        $this->transaction = DB::table('transactions')
            ->select(
                'transactions.*',
                DB::raw('COALESCE((sub_product_entities.user_percent / 100) * transactions.amount, 0) as discountAmount')
            )
            ->leftJoin('sub_product_entities', 'transactions.sub_prod_id', '=', 'sub_product_entities.id')
            ->where('transactions.id', $this->transactionId)
            ->first(); // Retrieve as object

        if ($this->transaction) {
            // Fetch the user who performed the transaction by user_id
            $this->user = User::find($this->transaction->user_id);
            $this->transaction = (array) $this->transaction;
            // $this->subproduct = SubProductEntity::find($this->transaction->sub_prod_id);
        } else {
            // Handle case if transaction is not found (optional)
            session()->flash('error', 'Transaction not found.');
        }
    }


    public function showModal()
    {
        // Trigger the browser event to open the modal
        $this->dispatchBrowserEvent('openModal');
    }



    public function render()
    {
        return view('livewire.transaction-details', [
            'user' => $this->user,
            'transaction' => $this->transaction,
        ]);
    }
}
