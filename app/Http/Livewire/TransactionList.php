<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionList extends Component
{
    use WithPagination;

    public $slug; // Status slug from URL
    public $type = 'data-topup'; // Default type
    public $search;
    public $types = ['data-topup', 'bill-payment', 'buy-airtime']; // Tabs for types
    public const DATA_SERVICE_ID = 'DATA_PUR_01';
    public const BILL_SERVICE_ID = 'BILL_PAYMENT_001';
    public const AIRTIME_SERVICE_ID = 'BUY_AIRTIME_001';

    public $pageTitle = 'Data-Topup';
    public $productType;
    public $utilityType ='DATA_PUR_01';
    public $perPage = 100;
    public $sortOrder = 'desc';

    public $isSearchTriggered = false; // Flag to check if search button has been pressed


    // When the component is mounted, set the status slug from the URL
    public function mount($slug)
    {
        $this->slug = $slug;
    }

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

        if ($tab === 'data-topup') {
            $this->utilityType = self::DATA_SERVICE_ID;
            $this->pageTitle = 'Data-Topup';
        } else if ($tab === 'bill-payment') {
            $this->utilityType = self::BILL_SERVICE_ID;
            $this->pageTitle = 'Bill Payment';
        }else if ($tab === 'buy-airtime') {
            $this->utilityType = self::AIRTIME_SERVICE_ID;
            $this->pageTitle = 'Buy Airtime';
        }

        $this->productType = $tab;

        $this->resetPage(); // Reset pagination on tab change
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
        // Query based on the active tab (type) and slug (status)
        // if ($this->isSearchTriggered) {
        $query = DB::table('transactions')
            ->select('transactions.*', 'users.name as user_name', 'product_entities.product_name as product_name', 'sub_product_entities.sub_name as sub_product_name',
            DB::raw('COALESCE((sub_product_entities.user_percent / 100) * transactions.amount, 0) as discountAmount') )
            ->join('users', 'transactions.user_id', '=', 'users.id')
            ->leftJoin('sub_product_entities', 'transactions.sub_prod_id', '=', 'sub_product_entities.id')
            ->leftJoin('product_entities', 'sub_product_entities.product_entity_id', '=', 'product_entities.id')
            ->where('product_entities.service_id', $this->utilityType) // Filter by type
            ->where('transactions.status', $this->slug); // Filter by status from slug

        // Apply search if provided
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('users.name', 'like', '%' . $this->search . '%')
                  ->orWhere('transactions.trans_ref', 'like', '%' . $this->search . '%')
                  ->orWhere('transactions.cr_acc', 'like', '%' . $this->search . '%');
            });
        }
        $query->orderBy('transactions.created_at', $this->sortOrder);

        // Paginate results
        $content = $query->paginate($this->perPage);
    // }

        return view('livewire.transaction-list', [
            'contents' => $content,
            'activeTab' => $this->type, // Send the active type (tab) to the view
            'slug' => $this->slug, // Send the status (slug) to the view
            'pageTitle' => ucfirst($this->slug == "success" ? 'approved' : $this->slug) . ' Transactions',
        ]);
    }
}
