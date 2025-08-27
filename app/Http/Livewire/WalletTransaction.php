<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;
use Carbon\Carbon;

class WalletTransaction extends Component
{
    use WithPagination;

    public $channel_type;
    public $status;
    public $date_from;
    public $date_to;
    public $search;
    public $perPage = 100;
    public $statuses = ['success', 'pending', 'failed'];
    public $isSearchTriggered = false;


    public function mount()
    {
        $this->status = '';
        $this->channel_type = '';
        $this->date_from = '';
        $this->date_to = '';
        $this->search = '';
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function searchBasedOnQuery()
    {
        try {
            // $this->validate([
            //     'channel_type' => 'required|string',
            //     'status' => 'required|string',
            //     'date_from' => 'nullable|date',
            //     'date_to' => 'nullable|date',
            // ]);

            session()->flash('message', 'Search triggered successfully.');
            $this->isSearchTriggered = true;
            $this->resetPage();
        } catch (\Exception $e) {
            session()->flash('error', 'Validation or search trigger failed: ' . $e->getMessage());
            // \Log::error('Search Error:', ['error' => $e->getMessage()]);
        }
    }

    public function toggleStatus($statusType,$transactionid)
    {
        $actionType = null;
        $status = null;

        if ($statusType == 'approve') {
            $actionType = 'approve transaction';
            $status = "success";
            $actionMessage='transaction has been approved';
        } elseif ($statusType == 'decline') {
            $actionType = 'decline transaction';
            $status = "failed";
            $actionMessage='transaction declined';
        }

        $param = ['status' => $status];

        $user = Transaction::find($transactionid);
        $user->update($param);


        session()->flash('statusUpdated', $actionMessage);


    }



    public function render()
    {
        $contents = null;
        $counts = 0;
        $sumAmount = 0;

        if ($this->isSearchTriggered) {
            try {
                $query = DB::table('transactions')
                    ->select('transactions.*', 'users.name as user_name')
                    ->join('users', 'transactions.user_id', '=', 'users.id');

                if ($this->channel_type == "withdrawal") {
                    $query->where('transactions.trans_type', $this->channel_type);
                    // \Log::debug('Filtering by channel_type:', ['channel_type' => $this->channel_type]);
                }else{
                    $query->where('transactions.channel', $this->channel_type);
                }

                if ($this->status) {
                    $query->where('transactions.status', $this->status);
                    // \Log::debug('Filtering by status:', ['status' => $this->status]);
                }

                if ($this->date_from) {
                    $query->whereDate('transactions.created_at', '>=', Carbon::parse($this->date_from)->startOfDay());
                    // \Log::debug('Filtering by date_from:', ['date_from' => $this->date_from]);
                }

                if ($this->date_to) {
                    $query->whereDate('transactions.created_at', '<=', Carbon::parse($this->date_to)->endOfDay());
                    // \Log::debug('Filtering by date_to:', ['date_to' => $this->date_to]);
                }

                if ($this->search) {
                    $query->where(function ($q) {
                        $q->where('transactions.trans_ref', 'like', '%' . $this->search . '%')
                            ->orWhere('users.name', 'like', '%' . $this->search . '%')
                            ->orWhere('transactions.cr_acc', 'like', '%' . $this->search . '%')
                            ->orWhere('transactions.channel', 'like', '%' . $this->search . '%')
                            ->orWhere('transactions.platform', 'like', '%' . $this->search . '%')
                            ->orWhere('transactions.amount', 'like', '%' . $this->search . '%')
                            ->orWhere('transactions.status', 'like', '%' . $this->search . '%')
                            ->orWhereDate('transactions.created_at', 'like', '%' . $this->search . '%');
                            // ->orderBy('transactions.created_at', 'desc');
                    });
                    // \Log::debug('Applying search query:', ['search' => $this->search]);
                }
                $query->orderBy('transactions.created_at', 'desc');

                $contents = $query->paginate($this->perPage);
                $counts = $query->count();
                $sumAmount = $query->sum("amount");

                // \Log::debug('Query results:', [
                //     'contents' => $contents,
                //     'counts' => $counts,
                //     'sumAmount' => $sumAmount
                // ]);

                foreach ($contents as $content) {
                    $content->created_at = Carbon::parse($content->created_at);
                }
            } catch (\Exception $e) {
                // \Log::error('Error in render method:', ['error' => $e->getMessage()]);
                session()->flash('error', 'An error occurred while executing the search.');
            }
        }

        return view('livewire.wallet-transaction', [
            'contents' => $contents,
            'counts' => $counts,
            'sumAmount' => $sumAmount,
            'pageTitle' => 'Filter Transaction Method',
        ]);
    }
}
