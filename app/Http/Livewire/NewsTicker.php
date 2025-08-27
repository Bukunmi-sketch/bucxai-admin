<?php

namespace App\Http\Livewire;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Admin;
use App\Models\ProductEntity;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Livewire\Component;

class NewsTicker extends Component
{
    public $totalUsers;
    public $totalTransactions;
    public $recentTransactions;
    public $totalUsersWithBVN;
    public $totalAdmins;
    public $totalAgents;
    public $approvedTransactions;
    public $pendingTransactions;
    public $failedTransactions;
    public $billPayment;
    public $dataTopup;
    public $buyAirtime;
    public $todaySales;
    public $todayTotalSales;

    public function mount()
    {
        $today = Carbon::today();
        // $this->totalUsers = User::count();
        // $this->totalTransactions = Transaction::count();
        // $this->totalUsersWithBVN = User::whereNotNull('bvn')->count();
        // $this->totalAdmins = Admin::count();
        // $this->totalAgents = User::where('user_type', 'agent')->count();
        // $this->approvedTransactions = Transaction::where('status', 'success')->count();
        // $this->pendingTransactions = Transaction::where('status', 'pending')->count();
        // $this->failedTransactions = Transaction::where('status', 'failed')->count();
        // $this->billPayment = ProductEntity::where('service_id', 'BILL_PAYMENT_001')->count();
        // $this->dataTopup = ProductEntity::where('service_id', 'DATA_PUR_01')->count();
        // $this->buyAirtime = ProductEntity::where('service_id', 'BUY_AIRTIME_001')->count();
        // $this->todaySales = Transaction::whereDate('created_at', $today)->sum('amount');
        // $this->todayTotalSales = Transaction::whereDate('created_at', $today)->count();
        $this->totalUsers = User::count();
        $this->totalTransactions = Transaction::count();
        $this->recentTransactions = Transaction::latest()->take(10)->get();
        $this->totalUsersWithBVN = User::whereNotNull('bvn')->count();
        $this->totalAdmins = Admin::count();
        $this->totalAgents = User::where('user_type', 'agent')->count();
        $this->approvedTransactions = Transaction::where('status', 'success')->count();
        $this->pendingTransactions = Transaction::where('status', 'pending')->count();
        $this->failedTransactions = Transaction::where('status', 'failed')->count();
        // $this->totalAmountWithdrew = Transaction::where('payment_type', 'withdraw')->where('status', 'success')
        //     ->sum('amount');
        // $this->billPayments = ProductEntity::where('service_id', 'BILL_PAYMENT_001')->count();
        // $this->dataTopup = ProductEntity::where('service_id', 'DATA_PUR_01')->count();
        // $this->buyAirtime = ProductEntity::where('service_id', 'BUY_AIRTIME_001')->count();
        // $this->todaySales = Transaction::whereDate('created_at', $today)->sum('amount');
        // Count of successful Bill Payments
        $this->billPayment = DB::table('product_entities')
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
        // $this->totalWalletBalance = UserWallet::sum('balance');

        // Calculate today's total sales with the user percent deduction
        $this->todaySales = Transaction::whereDate('transactions.created_at', $today)
            ->where('transactions.status', 'success')
            ->join('sub_product_entities', 'transactions.sub_prod_id', '=', 'sub_product_entities.id')
            ->select(DB::raw('SUM(transactions.amount - ((sub_product_entities.user_percent / 100) * transactions.amount)) as final_sale'))
            ->value('final_sale'); // Fetch the aggregated result directly

        // Total wallet balance for agents only
        // $this->totalWalletBalanceForAgents = UserWallet::join('users', 'user_wallets.user_id', '=', 'users.id')
        //     ->where('users.user_type', 'agent')
        //     ->sum('user_wallets.balance');

    }


    public function render()
    {
        return view('livewire.news-ticker');
    }
}
