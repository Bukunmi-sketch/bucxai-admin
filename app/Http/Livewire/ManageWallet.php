<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ManageWallet extends Component
{
    use WithPagination;

    // public $slug; // Status slug from URL
    public $type = 'Monnify'; // Default type
    public $search;
    public $types = ['data-topup', 'bill-payment', 'buy-airtime']; // Tabs for types


    public $pageTitle = 'Monnify Fund Wallet';
    public $productType;
    public $utilityType = 'Monnify';
    public $perPage = 100;
    public $sortOrder = 'desc';

    public $isSearchTriggered = false; // Flag to check if search button has been pressed



    // Reset pagination when search is updated
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function updatingSortOrder()
    {
        $this->resetPage();
    }


    public function searchBasedOnQuery()
    {
        $this->isSearchTriggered = true;
        $this->resetPage();
    }

    // Method to switch between tabs (types)
    public function switchTab($tab)
    {
        $this->type = $tab;

        if ($tab === 'Monnify') {
            $this->utilityType = 'Monnify';
            $this->pageTitle = 'Monnify Fund Wallet';
        } else if ($tab === 'Squad') {
            $this->utilityType = 'Squad';
            $this->pageTitle = 'Squad Fund Wallet';
        } else if ($tab === 'withdrawal') {
            $this->utilityType = 'withdrawal';
            $this->pageTitle = 'Withdrawals';
        }

        $this->productType = $tab;

        $this->resetPage(); // Reset pagination on tab change
    }


    public function toggleStatus($statusType, $transactionid)
    {
        $actionType = null;
        $status = null;

        if ($statusType == 'approve') {
            $actionType = 'approve transaction';
            $status = "success";
            $actionMessage = 'transaction has been approved';
        } elseif ($statusType == 'decline') {
            $actionType = 'decline transaction';
            $status = "failed";
            $actionMessage = 'transaction declined';
        }

        $param = ['status' => $status];

        $user = Transaction::find($transactionid);
        $user->update($param);


        session()->flash('statusUpdated', $actionMessage);
    }

    public function render()
    {
        $query = DB::table('transactions')
            ->select('transactions.*', 'users.name as user_name')
            ->join('users', 'transactions.user_id', '=', 'users.id');

        if ($this->utilityType == "withdrawal") {
            $query->where('transactions.trans_type',  $this->utilityType);
        } else {
            $query->where('transactions.channel',  $this->utilityType);
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('users.name', 'like', '%' . $this->search . '%')
                    ->orWhere('transactions.trans_ref', 'like', '%' . $this->search . '%');
            });
        }
        $query->orderBy('transactions.created_at', $this->sortOrder);

        $content = $query->paginate($this->perPage);
        // }

        return view('livewire.manage-wallet', [
            'contents' => $content,
            'activeTab' => $this->type,
            'pageTitle' => ' Transactions',
        ]);
    }
}
