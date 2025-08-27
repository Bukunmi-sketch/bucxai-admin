<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class UserType extends Component
{
    use WithPagination;

    public $slug;
    public $sortOrder = 'asc';
    public $searchTerm = '';
    public $pageTitle = 'Users';
    public $perPage = 100;
    public $isSearchTriggered = false;


    public function mount($slug = null)
    {
        $this->slug = $slug;

        switch ($this->slug) {
            case 'verified':
                $this->pageTitle = 'Verified Users (BVN)';
                break;
            case 'active':
                    $this->pageTitle = 'Active Users';
                    break;
            case 'unverified':
                $this->pageTitle = 'Unverified Users (BVN)';
                break;
            case 'banned':
                $this->pageTitle = 'Banned Users';
                break;
            case 'agent':
                $this->pageTitle = 'Agents';
                break;
            default:
                $this->pageTitle = '';
                break;
        }
    }

    public function toggleBan($statusType,$userid)
    {
        $actionType = null;
        $status = null;

        if ($statusType == 'ban') {
            $actionType = 'ban user';
            $status = "banned";
            $actionMessage='user has been suspended';
        } elseif ($statusType == 'unban') {
            $actionType = 'unban user';
            $status = "active";
            $actionMessage='suspension has been removed';
        }

        $param = ['status' => $status];

        $user = User::find($userid);
        $user->update($param);


        session()->flash('statusUpdated', $actionMessage);
    }

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


    // public function render()
    // {


    // $usersQuery = User::query()
    // ->leftJoin('user_wallets', 'users.id', '=', 'user_wallets.user_id')
    // ->select('users.*', DB::raw('SUM(user_wallets.balance) as wallet_balance'))
    // ->groupBy('users.id');

    //     switch ($this->slug) {
    //         case 'verified':
    //             $usersQuery->whereNotNull('bvn');
    //             break;
    //         case 'active':
    //                 $usersQuery->where('status', 'active');
    //                 break;
    //         case 'unverified':
    //             $usersQuery->where('status', 'active');
    //             break;
    //         case 'banned':
    //             $usersQuery->where('status', 'banned');
    //             break;
    //         case 'agent':
    //             $usersQuery->where('user_type', 'agent');
    //             break;
    //         default:
    //             // For default case or showing all users
    //             break;
    //     }

    //     $users = $usersQuery->where(function($query) {
    //             $query->where('first_name', 'like', '%' . $this->searchTerm . '%')
    //                   ->orWhere('last_name', 'like', '%' . $this->searchTerm . '%')
    //                   ->orWhere('username', 'like', '%' . $this->searchTerm . '%')
    //                   ->orWhere('email', 'like', '%' . $this->searchTerm . '%')
    //                   ->orWhere('phone', 'like', '%' . $this->searchTerm . '%');
    //         })
    //         ->orderBy('name', $this->sortOrder)
    //         ->paginate(20);

    //     return view('livewire.user-type', ['users' => $users, 'pageTitle' => $this->pageTitle]);
    // }

    public function render()
{
    $usersQuery = User::query()
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
            DB::raw('SUM(user_wallets.balance) as wallet_balance')
        )
        ->groupBy( 'users.id', 'users.first_name', 'users.last_name', 'users.username', 'users.email', 'users.phone', 'users.bvn', 'users.status', 'users.user_type', 'users.gender' );
    switch ($this->slug) {
        case 'verified':
            $usersQuery->whereNotNull('bvn');
            break;
        case 'active':
            $usersQuery->where('status', 'active');
            break;
        case 'unverified':
            $usersQuery->whereNull('bvn');
            break;
        case 'banned':
            $usersQuery->where('status', 'banned');
            break;
        case 'agent':
            $usersQuery->where('user_type', 'agent');
            break;
        default:
            break;
    }

    $users = $usersQuery->where(function($query) {
            $query->where('first_name', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('last_name', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('username', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('email', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('phone', 'like', '%' . $this->searchTerm . '%');
        })
        // ->orderBy('first_name', $this->sortOrder) // Ensure you're ordering by a valid column
        ->orderBy('users.created_at', $this->sortOrder)
        ->paginate($this->perPage);

    return view('livewire.user-type', ['users' => $users, 'pageTitle' => $this->pageTitle]);
}

}
