<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\UserWallet;
use App\Models\UserBank;
use App\Models\Transaction;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class UserProfile extends Component
{
    use WithPagination;

    public $userId;
    public $user;
    public $userWallet;
    public $userTransactions;
    public $userBank;
    public $amount;
    public $actionType;

    public $activeTab = 'profile-info';



    public function mount($id)
    {
        $this->userId = $id;
        $this->loadUserData();
    }

    public function loadUserData()
    {
        $this->user = User::find($this->userId);
        $this->userWallet = UserWallet::where('user_id', $this->userId)->sum('balance');
        $this->userTransactions = Transaction::where('user_id', $this->userId)->get();
        $this->userBank = UserBank::where('user_id', $this->userId)->get();
        // dd($this->userBank);

    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }


    public function showModal()
    {
        // Trigger the browser event to open the modal
        $this->dispatchBrowserEvent('openModal');
    }

    public function updateWallet()
    {
        // Validate the input
        $this->validate([
            'amount' => 'required|numeric|min:1',
            'actionType' => 'required|in:add,deduct',
        ]);

        // Fetch the user's wallet
        $wallet = UserWallet::firstOrCreate(['user_id' => $this->userId]);

        if ($this->actionType === 'add') {
            // Add amount to wallet
            $wallet->balance += $this->amount;
        } elseif ($this->actionType === 'deduct') {
            // Deduct amount from wallet
            if ($wallet->balance < $this->amount) {
                $this->addError('amount', 'Insufficient balance to deduct this amount.');
                return;
            }
            $wallet->balance -= $this->amount;
        }

        $wallet->save();


        // Transaction::create([
        //     'user_id' => $this->userId,
        //     'amount' => $this->amount,
        //     'trans_type' => $this->actionType === 'add' ? 'credit' : 'debit',
        //     'description' => ucfirst($this->actionType) . " amount in wallet",
        // ]);

        // Reload data
        $this->loadUserData();

        // Reset input fields
        $this->reset(['amount', 'actionType']);

        session()->flash('success', 'Wallet updated successfully!');

        $this->dispatchBrowserEvent('wallet-updated', ['message' => 'Wallet updated successfully!']);
    }


    public function render()
    {
        return view('livewire.user-profile', [
            'user' => $this->user,
            'userWallet' => $this->userWallet,
            'userTransactions' => $this->userTransactions,
            'userBank' => $this->userBank,
        ]);
    }
}
