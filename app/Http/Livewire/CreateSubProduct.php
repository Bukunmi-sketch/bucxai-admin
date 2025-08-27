<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ProductEntity;
use App\Models\SubProductEntity;
use Illuminate\Support\Facades\DB;

class CreateSubProduct extends Component
{
    public $type;
    public $slug;
    public $pageType;
    public $pageTitle;
    public $productContents = [];
    public $product_entity_id;
    public $sub_name;
    public $sub_price;
    public $user_percent;
    public $optional_param;
    public $data_id;
    public $plan_id;
    public $auto_sub_pro_id;
    public $addon_code;

    public function mount($type, $slug)
    {
        $this->type = $type;
        $this->slug = $slug;

        if ($type === 'data-topup') {
            $utilityType = 'DATA_PUR_01';
            $this->pageTitle = 'Data-Topup';
        } elseif ($type === 'bill-payment') {
            $utilityType = 'BILL_PAYMENT_001';
            $this->pageTitle = 'Bill Payment';
        } elseif ($type === 'buy-airtime') {
            $utilityType = 'BUY_AIRTIME_001';
            $this->pageTitle = 'Buy Airtime';
        }

        // Fetch data using Eloquent to ensure objects are returned
        $this->productContents = ProductEntity::select('id', 'product_name', 'product_description')
            ->where('service_id', $utilityType)
            ->orderBy('product_name', 'asc')
            ->get();
    }

    public function storeSub()
    {
        $this->validate([
            'product_entity_id' => 'required|integer',
            'sub_name' => 'required',
            'sub_price' => 'required|numeric',
            'user_percent' => 'required|numeric|between:0,100',
        ]);

    $subProductEntity = new SubProductEntity();
    $subProductEntity->product_entity_id = (int)$this->product_entity_id;
    $subProductEntity->sub_name = $this->sub_name;
    $subProductEntity->sub_price = $this->sub_price;
    $subProductEntity->user_percent = $this->user_percent;
    $subProductEntity->optional_param = $this->optional_param;
    $subProductEntity->data_id = $this->data_id;
    $subProductEntity->plan_id = $this->plan_id;
    $subProductEntity->auto_sub_prod_id = $this->auto_sub_pro_id;
    $subProductEntity->addon_code = $this->addon_code;
    $subProductEntity->save();

        session()->flash('success', "Sub Product created successfully");
    }

    public function render()
    {
        return view('livewire.create-sub-product', [
            'productContents' => $this->productContents,
            'pageType' => $this->type,
            'slug' => $this->slug,
            'pageTitle' => $this->pageTitle,
        ]);
    }
}
