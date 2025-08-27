<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use App\Models\ProductEntity;
use Carbon\Carbon;

class TransactionQueryaa extends Component
{
    use WithPagination;

    public $productContents = [];
    public $slug;
    public $product_entity_id;
    public $status;
    public $date_from;
    public $date_to;
    public $search;
    public $perPage = 25; // Default row count per page
    public $statuses = ['success', 'pending', 'failed'];
    public $types = [
        'cable_tv', 'mobile_data', 'airtime', 'electricity', 'education', 'internet', 'betting', 'withdrawal'
    ];

    public $isSearchTriggered = false; // Flag to check if search button has been pressed

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->status = ''; // Default status
        $this->product_entity_id = ''; // Default value for product entity
        $this->date_from = '';
        $this->date_to = '';
        $this->search = '';

        if ($slug == "fund_wallets") {
            $this->productContents = ProductEntity::select('id', 'product_name', 'product_description')
                ->orderBy('product_name', 'asc')
                ->get();
        }

        $this->productContents = ProductEntity::select('id', 'product_name', 'product_description')
            ->orderBy('product_name', 'asc')
            ->get();
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
        $this->isSearchTriggered = true; // Set search flag to true
        $this->resetPage(); // Reset pagination to the first page after search
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
        // Only execute the query if search has been triggered
        // $contents = collect(); // Default to an empty collection
        $contents = null; // Default to null
        $counts = 0;
        $sumAmount = 0;

        if ($this->isSearchTriggered) {
            $query = DB::table('transactions')
                ->select('transactions.*', 'users.name as user_name', 'product_entities.product_name as product_name', 'sub_product_entities.sub_name as sub_product_name')
                ->join('users', 'transactions.user_id', '=', 'users.id')
                ->leftJoin('sub_product_entities', 'transactions.sub_prod_id', '=', 'sub_product_entities.id')
                ->leftJoin('product_entities', 'sub_product_entities.product_entity_id', '=', 'product_entities.id');

            if ($this->slug == 'purchase') {
                $query->whereIn('transactions.trans_type', $this->types);
            } else {
                $query->where('transactions.trans_type', $this->slug);
            }

            if ($this->product_entity_id) {
                $query->where('sub_product_entities.product_entity_id', $this->product_entity_id);
            }

            if ($this->status) {
                $query->where('transactions.status', $this->status);
            }

            if ($this->date_from) {
                $query->whereDate('transactions.created_at', '>=', Carbon::parse($this->date_from)->startOfDay());
            }

            if ($this->date_to) {
                $query->whereDate('transactions.created_at', '<=', Carbon::parse($this->date_to)->endOfDay());
            }

            // if ($this->search) {
            //     $query->where(function ($q) {
            //         $q->where('users.name', 'like', '%' . $this->search . '%')
            //           ->orWhere('transactions.trans_ref', 'like', '%' . $this->search . '%');
            //     });
            // }

            // $contents = $query->paginate(20);
            // Multi-column search
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
            });
        }

        // Apply pagination with custom per-page count
        $contents = $query->paginate($this->perPage);
            $counts = $query->count();
            $sumAmount = $query->sum("amount");
            foreach ($contents as $content) {
                $content->created_at = Carbon::parse($content->created_at);
            }
        }

        return view('livewire.transaction-query', [
            'productContents' => $this->productContents,
            'contents' => $contents,
            'counts' => $counts,
            'sumAmount' => $sumAmount,
            'pageTitle' => ucfirst($this->slug) . ' Transactions Search Parameters',
        ]);
    }
}
