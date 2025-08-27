<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Models\SubProductEntity;

class SubProductList extends Component
{
    use WithPagination;

    public $type;
    public $slug;
    public $pageTitle;
    public $pageType;
    // public $id;


    public function mount($type, $slug)
    {
        $this->type = $type;
        $this->slug = $slug;

        if ($type === 'data-topup') {
            $this->pageTitle = 'Data-Topup';
        } elseif ($type === 'bill-payment') {
            $this->pageTitle = 'Bill Payment';
        } elseif ($type ==='buy-airtime'){
            $this->pageTitle = 'Buy Airtime';
        }

        $this->pageType = $type;
    }

    public function updateStatus($statusType,$productid)
    {
        $actionType = null;
        $status = null;

        if ($statusType === 'disable') {
            $actionType = 'disable_sub_product_entity';
            $status = "0";
        } elseif ($statusType === 'enable') {
            $actionType = 'enable_sub_product_entity';
            $status = "1";
        }

        $param = ['status' => $status];

        $bill = SubProductEntity::find($productid);
        $bill->update($param);


        session()->flash('statusUpdated', 'Sub Product status has been changed successfully');

        // Assuming log_audit is a helper function or a global function
        // log_audit($actionType, 'admin', 'admin');

        // $this->emit('statusUpdated', 'Sub Product status has been changed successfully');
    }

    public function render()
    {
        $utilityType = null;
        if ($this->type === 'data-topup') {
            $utilityType = 'DATA_PUR_01';
        } elseif ($this->type === 'bill-payment') {
            $utilityType = 'BILL_PAYMENT_001';
        } elseif ($this->type === 'buy-airtime') {
            $utilityType = 'BUY_AIRTIME_001';
        }

        // $contents = DB::table('sub_product_entities')
        //     ->select('sub_product_entities.id', 'sub_name', 'sub_price', 'auto_sub_prod_id', 'user_percent', 'sub_product_entities.status')
        //     ->join('product_entities', 'sub_product_entities.product_entity_id', '=', 'product_entities.id')
        //     ->where('product_entities.service_id', $utilityType)
        //     ->orderBy('sub_product_entities.created_at', 'desc')
        //     ->paginate(20);


        $contents = DB::table('sub_product_entities')
        ->select('sub_product_entities.id', 'sub_name', 'sub_price', 'auto_sub_prod_id', 'user_percent', 'sub_product_entities.status')
        ->join('product_entities', 'sub_product_entities.product_entity_id', '=', 'product_entities.id')
        ->where('product_entities.id', $this->slug) // Corrected where clause
        ->orderBy('sub_product_entities.created_at', 'desc')
        ->paginate(100);

        return view('livewire.sub-product-list', [
            'contents' => $contents,
            'pageTitle' => ucfirst($this->slug),
            'slug' => $this->slug,
            'pageType' => $this->type,
        ]);
    }
}
