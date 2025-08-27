<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

class AdminProfile extends Component
{
    public $admin;
    public $activeTab = 'profile-info'; // Default tab
    public $adminTransactions;

    public function mount()
    {
        // Get the authenticated admin user
        $this->admin = Auth::guard('admin')->user();
        $this->loadUserData();
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }


    public function loadUserData()
    {

        // $this->adminTransactions = Transaction::where('user_id', $this->userId)->get();

        // dd($this->userBank);

    }

    public function render()
    {
        return view('livewire.admin-profile', [
            'admin' => $this->admin, // Pass the admin data to the view
        ]);
    }
}
