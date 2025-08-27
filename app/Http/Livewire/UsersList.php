<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class UsersList extends Component
{
    use WithPagination;

    public $sortOrder = 'desc';
    public $searchTerm = '';
    public $selectedUser = null;
    public $userBankDetails = [];
    public $userTransactionHistory = [];
    public $perPage = 100;
    public $isSearchTriggered = false;

    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    public function updatingSortOrder()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function searchBasedOnQuery()
    {
        $this->isSearchTriggered = true;
        $this->resetPage();
    }

    public function toggleBan($statusType, $userid)
    {
        $status = $statusType === 'ban' ? 'banned' : 'active';
        $actionMessage = $statusType === 'ban' ? 'User has been suspended.' : 'Suspension has been removed.';

        $user = User::find($userid);
        $user->update(['status' => $status]);

        session()->flash('statusUpdated', $actionMessage);
    }

    public function deleteUser($userId)
    {
        $user = User::find($userId);

        if ($user) {
            $user->delete();
            session()->flash('statusUpdated', 'User has been deleted successfully.');
        }
    }

    public function render()
    {
        $users = User::query()
            ->leftJoin('user_wallets', 'users.id', '=', 'user_wallets.user_id')
            ->select(
                'users.id',
                'users.first_name',
                'users.last_name',
                'users.username',
                'users.email',
                'users.phone',
                'users.bvn',
                'users.status',
                'users.user_type',
                'users.gender',
             DB::raw('SUM(user_wallets.balance) as wallet_balance'))
            ->where(function($query) {
                $query->where('first_name', 'like', '%' . $this->searchTerm . '%')
                      ->orWhere('last_name', 'like', '%' . $this->searchTerm . '%')
                      ->orWhere('username', 'like', '%' . $this->searchTerm . '%')
                      ->orWhere('email', 'like', '%' . $this->searchTerm . '%')
                      ->orWhere('phone', 'like', '%' . $this->searchTerm . '%');
            })
            ->groupBy( 'users.id', 'users.first_name', 'users.last_name', 'users.username', 'users.email', 'users.phone', 'users.bvn', 'users.status', 'users.user_type', 'users.gender' )
            ->orderBy('users.created_at', $this->sortOrder)
            ->paginate($this->perPage);

        return view('livewire.users-list', ['users' => $users]);
    }
}
