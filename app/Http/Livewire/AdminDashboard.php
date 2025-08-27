<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Transaction;
use App\Models\UserWallet;
use App\Models\Admin;
use App\Models\ProductEntity;
use App\Models\SubProductEntity;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Livewire\WithPagination;

class AdminDashboard extends Component
{
    use WithPagination;

    public $totalUsers;
    public $totalTransactions;
    public $recentTransactions;
    public $totalUsersWithBVN;
    public $totalAdmins;
    public $totalAgents;
    public $approvedTransactions;
    public $pendingTransactions;
    public $failedTransactions;
    public $billPayments;
    public $dataTopup;
    public $buyAirtime;
    public $todaySales;
    public $todayTotalSales;
    public $billPaymentValue;
    public $dataTopupValue;
    public $buyAirtimeValue;
    public $totalWalletBalance;
    public $totalWalletBalanceForAgents;
    public $totalAmountWithdrew;
    public $monthlySuccessfulTransactions = [];
    public $dailyTransactionData = [];
    public $dailyFundWallet = [];
    public $chartData = [];
    public $dataCounts = [];
    public $airtimeCounts = [];
    public $TotalFundWallet;
    // public $dailyData = [];

    public $search;
    public $isSearchTriggered = false; // Flag to check if search button has been pressed
    // public $perPage = 100;


    public function mount()
    {
        $today = Carbon::today();
        $this->totalUsers = User::count();
        $this->totalTransactions = Transaction::count();
        $this->recentTransactions = Transaction::latest()->take(10)->get();
        $this->totalUsersWithBVN = User::whereNotNull('bvn')->count();
        $this->totalAdmins = Admin::count();
        $this->totalAgents = User::where('user_type', 'agent')->count();
        $this->approvedTransactions = Transaction::where('status', 'success')->count();
        $this->pendingTransactions = Transaction::where('status', 'pending')->count();
        $this->failedTransactions = Transaction::where('status', 'failed')->count();
        $this->totalAmountWithdrew = Transaction::where('payment_type', 'withdraw')->where('status', 'success')
            ->sum('amount');
        // $this->billPayments = ProductEntity::where('service_id', 'BILL_PAYMENT_001')->count();
        // $this->dataTopup = ProductEntity::where('service_id', 'DATA_PUR_01')->count();
        // $this->buyAirtime = ProductEntity::where('service_id', 'BUY_AIRTIME_001')->count();
        // $this->todaySales = Transaction::whereDate('created_at', $today)->sum('amount');
        // Count of successful Bill Payments
        $this->billPayments = DB::table('product_entities')
            ->join('sub_product_entities', 'product_entities.id', '=', 'sub_product_entities.product_entity_id')
            ->join('transactions', 'sub_product_entities.id', '=', 'transactions.sub_prod_id')
            ->where('product_entities.service_id', 'BILL_PAYMENT_001')
            ->where('transactions.status', 'success')
            ->count();

        // Count of successful Data Top-ups
        $this->dataTopup = DB::table('product_entities')
            ->join('sub_product_entities', 'product_entities.id', '=', 'sub_product_entities.product_entity_id')
            ->join('transactions', 'sub_product_entities.id', '=', 'transactions.sub_prod_id')
            ->where('product_entities.service_id', 'DATA_PUR_01')
            ->where('transactions.status', 'success')
            ->count();

        // Count of successful Airtime Purchases
        $this->buyAirtime = DB::table('product_entities')
            ->join('sub_product_entities', 'product_entities.id', '=', 'sub_product_entities.product_entity_id')
            ->join('transactions', 'sub_product_entities.id', '=', 'transactions.sub_prod_id')
            ->where('product_entities.service_id', 'BUY_AIRTIME_001')
            ->where('transactions.status', 'success')
            ->count();


        $this->todayTotalSales = Transaction::whereDate('created_at', $today)->where('transactions.status', 'success')->count();
        // Total wallet balance for all users
        $this->totalWalletBalance = UserWallet::sum('balance');

        // Calculate today's total sales with the user percent deduction
        $this->todaySales = Transaction::whereDate('transactions.created_at', $today)
            ->where('transactions.status', 'success')
            ->join('sub_product_entities', 'transactions.sub_prod_id', '=', 'sub_product_entities.id')
            ->select(DB::raw('SUM(transactions.amount - ((sub_product_entities.user_percent / 100) * transactions.amount)) as final_sale'))
            ->value('final_sale'); // Fetch the aggregated result directly

        // Total wallet balance for agents only
        $this->totalWalletBalanceForAgents = UserWallet::join('users', 'user_wallets.user_id', '=', 'users.id')
            ->where('users.user_type', 'agent')
            ->sum('user_wallets.balance');

        // Query based on the active tab (type) and slug (status)
        // $this->billPaymentValue = DB::table('transactions')
        //     ->select('transactions.*', 'users.name as user_name', 'product_entities.product_name as product_name', 'sub_product_entities.sub_name as sub_product_name')
        //     ->join('users', 'transactions.user_id', '=', 'users.id')
        //     ->leftJoin('sub_product_entities', 'transactions.sub_prod_id', '=', 'sub_product_entities.id')
        //     ->leftJoin('product_entities', 'sub_product_entities.product_entity_id', '=', 'product_entities.id')
        //     ->where('product_entities.service_id', 'BILL_PAYMENT_001')->sum('amount');

        // $this->dataTopupValue = DB::table('transactions')
        //     ->select('transactions.*', 'users.name as user_name', 'product_entities.product_name as product_name', 'sub_product_entities.sub_name as sub_product_name')
        //     ->join('users', 'transactions.user_id', '=', 'users.id')
        //     ->leftJoin('sub_product_entities', 'transactions.sub_prod_id', '=', 'sub_product_entities.id')
        //     ->leftJoin('product_entities', 'sub_product_entities.product_entity_id', '=', 'product_entities.id')
        //     ->where('product_entities.service_id', 'DATA_PUR_01')->sum('amount');

        // $this->buyAirtimeValue = DB::table('transactions')
        //     ->select('transactions.*', 'users.name as user_name', 'product_entities.product_name as product_name', 'sub_product_entities.sub_name as sub_product_name')
        //     ->join('users', 'transactions.user_id', '=', 'users.id')
        //     ->leftJoin('sub_product_entities', 'transactions.sub_prod_id', '=', 'sub_product_entities.id')
        //     ->leftJoin('product_entities', 'sub_product_entities.product_entity_id', '=', 'product_entities.id')
        //     ->where('product_entities.service_id', 'BUY_AIRTIME_001')->sum('amount');

        // Bill Payment Value with discount calculation
        $this->billPaymentValue = DB::table('transactions')
            ->join('users', 'transactions.user_id', '=', 'users.id')
            ->leftJoin('sub_product_entities', 'transactions.sub_prod_id', '=', 'sub_product_entities.id')
            ->leftJoin('product_entities', 'sub_product_entities.product_entity_id', '=', 'product_entities.id')
            ->where('product_entities.service_id', 'BILL_PAYMENT_001')
            ->where('transactions.status', 'success') // Only include successful transactions
            ->sum(DB::raw('transactions.amount - ((sub_product_entities.user_percent / 100) * transactions.amount)'));

        // Data Top-up Value with discount calculation
        $this->dataTopupValue = DB::table('transactions')
            ->join('users', 'transactions.user_id', '=', 'users.id')
            ->leftJoin('sub_product_entities', 'transactions.sub_prod_id', '=', 'sub_product_entities.id')
            ->leftJoin('product_entities', 'sub_product_entities.product_entity_id', '=', 'product_entities.id')
            ->where('product_entities.service_id', 'DATA_PUR_01')
            ->where('transactions.status', 'success') // Only include successful transactions
            ->sum(DB::raw('transactions.amount - ((sub_product_entities.user_percent / 100) * transactions.amount)'));

        // Buy Airtime Value with discount calculation
        $this->buyAirtimeValue = DB::table('transactions')
            ->join('users', 'transactions.user_id', '=', 'users.id')
            ->leftJoin('sub_product_entities', 'transactions.sub_prod_id', '=', 'sub_product_entities.id')
            ->leftJoin('product_entities', 'sub_product_entities.product_entity_id', '=', 'product_entities.id')
            ->where('product_entities.service_id', 'BUY_AIRTIME_001')
            ->where('transactions.status', 'success') // Only include successful transactions
            ->sum(DB::raw('transactions.amount - ((sub_product_entities.user_percent / 100) * transactions.amount)'));




        //GRAPHS

        $this->monthlySuccessfulTransactions = Transaction::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->where('status', 'success')
            ->groupByRaw('MONTH(created_at)')
            ->pluck('total', 'month')
            ->toArray();


        $statuses = ['pending', 'success', 'cancelled', 'reversed', 'failed', 'processing'];
        $dailyData = [];
        foreach ($statuses as $status) {
            $dailyData[$status] = Transaction::where('status', $status)
                ->where('payment_type', 'withdraw')
                ->whereDate('created_at', Carbon::today())
                ->count();
        }
        $this->dailyTransactionData = $dailyData;




        $types = ['Squad', 'Monnify'];
        $dailyFundWallet = [];
        foreach ($types as $type) {
            $dailyFundWallet[$type] = Transaction::where('channel', $type)
                ->where('trans_type', 'fund_wallet')
                ->whereDate('created_at', Carbon::today())
                ->count();
        }
        $this->dailyFundWallet = $dailyFundWallet;



        // $typesFund = ['Squad', 'Monnify'];
        // $TotalFundWallet = [];
        // foreach ($typesFund as $typeFund) {
        //     $TotalFundWallet[$typeFund] = Transaction::where('channel', $typeFund)
        //         ->where('trans_type', 'fund_wallet')
        //         ->sum('transactions.amount');
        // }
        // $this->TotalFundWallet = $TotalFundWallet;

        $typesFund = ['Squad', 'Monnify'];

        $this->TotalFundWallet = Transaction::where('trans_type', 'fund_wallet')
            ->whereIn('channel', $typesFund)
            ->sum('transactions.amount');




        $categories = ['CG', 'GIFTING', 'Coupon', 'SME'];
        $this->chartData = [];
        foreach ($categories as $category) {
            $count = Transaction::query()
                ->join('sub_product_entities', 'transactions.sub_prod_id', '=', 'sub_product_entities.id')
                ->whereNotNull('sub_product_entities.data_type')
                ->where('sub_product_entities.data_type', $category)
                ->count();

            $this->chartData[$category] = $count;
        }



        $networks = ['MTN DATA', 'Airtel DATA', 'Glo DATA', '9mobile DATA'];
        $this->dataCounts = [];
        foreach ($networks as $network) {
            $this->dataCounts[$network] = DB::table('transactions')
                ->join('sub_product_entities', 'transactions.sub_prod_id', '=', 'sub_product_entities.id')
                ->join('product_entities', 'sub_product_entities.product_entity_id', '=', 'product_entities.id')
                ->where('product_entities.product_name', $network)
                ->count();
        }


        $networksairtime = ['Mtn Airtime Topup', 'Airtel Airtime Topup', 'Glo Airtime Topup', '9mobile Airtime Topup'];
        $this->airtimeCounts = [];
        foreach ($networksairtime as $networkairtime) {
            $this->airtimeCounts[$networkairtime] = DB::table('transactions')
                ->join('sub_product_entities', 'transactions.sub_prod_id', '=', 'sub_product_entities.id')
                ->join('product_entities', 'sub_product_entities.product_entity_id', '=', 'product_entities.id')
                ->where('product_entities.product_name', $networkairtime)
                ->count();
        }
    }

     // Reset pagination when search is updated
     public function updatingSearch()
     {
         $this->resetPage();
     }


    public function searchBasedOnQuery()
    {
        $this->isSearchTriggered = true;
        $this->resetPage();
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

        // Assuming log_audit is a helper function or a global function
        // log_audit($actionType, 'admin', 'admin');

        // $this->emit('statusUpdated', 'Sub Product status has been changed successfully');
    }

    public function render()
    {

        $query = DB::table('transactions')
            ->select(
                'transactions.*',
                'users.name as user_name',
                'product_entities.product_name as product_name',
                'sub_product_entities.sub_name as sub_product_name',
                DB::raw('COALESCE((sub_product_entities.user_percent / 100) * transactions.amount, 0) as discountAmount')
            )
            ->join('users', 'transactions.user_id', '=', 'users.id')
            ->leftJoin('sub_product_entities', 'transactions.sub_prod_id', '=', 'sub_product_entities.id')
            ->leftJoin('product_entities', 'sub_product_entities.product_entity_id', '=', 'product_entities.id')
            ->orderBy('transactions.created_at', 'desc');

             // Apply search if provided
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('users.name', 'like', '%' . $this->search . '%')
                  ->orWhere('transactions.trans_ref', 'like', '%' . $this->search . '%')
                  ->orWhere('transactions.cr_acc', 'like', '%' . $this->search . '%')
                  ->orWhere('sub_product_entities.sub_name', 'like', '%' . $this->search . '%')
                  ->orWhere('transactions.channel', 'like', '%' . $this->search . '%');
            });
        }

        // Finally, fetch the results
    $transactionsLists = $query->limit(10)->get();

        return view('livewire.admin-dashboard', [
            'totalUsers' => $this->totalUsers,
            'totalTransactions' => $this->totalTransactions,
            'recentTransactions' => $this->recentTransactions,
            'totalUsersWithBVN' => $this->totalUsersWithBVN,
            'totalAdmins' => $this->totalAdmins,
            'transactionsLists' => $transactionsLists,
            'totalAgents' => $this->totalAgents,
            'approvedTransactions' => $this->approvedTransactions,
            'failedTransactions' => $this->failedTransactions,
            'pendingTransactions' => $this->pendingTransactions,
            'dataTopup' => $this->dataTopup,
            'billPayment' => $this->billPayments,
            'buyAirtime' => $this->buyAirtime,
            'todaySales' => $this->todaySales,
            'todayTotalSales' => $this->todayTotalSales,
            'billPaymentValue' => $this->billPaymentValue,
            'buyAirtimeValue' => $this->buyAirtimeValue,
            'dataTopupValue' => $this->dataTopupValue,
            'totalWalletBalance' => $this->totalWalletBalance,
            'totalWalletBalanceForAgents' => $this->totalWalletBalanceForAgents,
            'totalAmountWithdrew' => $this->totalAmountWithdrew,
            'monthlySuccessfulTransactions' => $this->monthlySuccessfulTransactions,
            'transactionData' => $this->dailyTransactionData,
            // 'transactionFundWallet' => $this->dailyFundWallet,
            'dailyFundWallet' => json_encode($this->dailyFundWallet),
            'chartData' => $this->chartData,
            'dataCounts' => $this->dataCounts,
            'airtimeCounts' => $this->airtimeCounts,
            'totalFundWallet' => $this->TotalFundWallet,

        ]);
    }
}
