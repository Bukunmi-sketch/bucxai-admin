<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\SubProductEntity;
use App\Models\ProductEntity;

class EditSubProduct extends Component
{
    public $type;
    public $slug;
    public $productId;
    public $pageTitle;
    public $productContents = [];
    public $product_entity_id;
    public $sub_name;
    public $sub_price;
    public $user_percent;
    public $agent_percent;
    public $optional_param;
    public $data_id;
    public $plan_id;
    public $auto_sub_prod_id;
    public $addon_code;
    public $subProductDetails;

    public function mount($type, $slug, $id)
    {
        $this->type = $type;
        $this->slug = $slug;
        $this->productId = $id;

        if ($type === 'data-topup') {
            $utilityType = 'DATA_PUR_01'; // Adjust based on your ENUM values
            $this->pageTitle = 'Data-Topup';
        } elseif ($type === 'bill-payment') {
            $utilityType = 'BILL_PAYMENT_001'; // Adjust based on your ENUM values
            $this->pageTitle = 'Bill Payment';
        } elseif ($type === 'buy-airtime') {
            $utilityType = 'BUY_AIRTIME_001'; // Adjust based on your ENUM values
            $this->pageTitle = 'Buy Airtime';
        }

        // $this->productContents = DB::table('product_entities')
        //     ->select('id', 'product_name', 'product_description')
        //     ->where('service_id', $utilityType)
        //     ->orderBy('product_name', 'asc')
        //     ->get()
        //     ->toArray(); // Ensure it's an array
           // Fetch data using Eloquent to ensure objects are returned
           $this->productContents = ProductEntity::select('id', 'product_name', 'product_description')
           ->where('service_id', $utilityType)
           ->orderBy('product_name', 'asc')
           ->get();

        $this->subProductDetails = SubProductEntity::findOrFail($id);

        // Populate properties from subProductDetails
        $this->product_entity_id = $this->subProductDetails->product_entity_id;
        $this->sub_name = $this->subProductDetails->sub_name;
        $this->sub_price = $this->subProductDetails->sub_price;
        $this->user_percent = $this->subProductDetails->user_percent;
        $this->agent_percent = $this->subProductDetails->agent_percent;
        $this->optional_param = $this->subProductDetails->optional_param;
        $this->data_id = $this->subProductDetails->data_id;
        $this->plan_id = $this->subProductDetails->plan_id;
        $this->auto_sub_prod_id = $this->subProductDetails->auto_sub_prod_id;
        $this->addon_code = $this->subProductDetails->addon_code;
    }

    public function updateSub()
    {
        $this->validate([
            'product_entity_id' => 'required|integer',
            'sub_name' => 'required',
            'sub_price' => 'required|numeric',
            'user_percent' => 'required|numeric|min:0|max:100', // Allows decimals between 0 and 100
            'agent_percent' => 'required|numeric|min:0|max:100',
        ]);

        $subProductSave = SubProductEntity::find($this->productId);
        $subProductSave->product_entity_id = (int)$this->product_entity_id; // Cast to integer
        $subProductSave->sub_name = $this->sub_name;
        $subProductSave->sub_price = $this->sub_price;
        $subProductSave->user_percent = $this->user_percent;
        $subProductSave->agent_percent = $this->agent_percent;
        $subProductSave->optional_param = $this->optional_param;
        $subProductSave->data_id = $this->data_id;
        $subProductSave->plan_id = $this->plan_id;
        $subProductSave->auto_sub_prod_id = $this->auto_sub_prod_id;
        $subProductSave->addon_code = $this->addon_code;
        $subProductSave->save();

        session()->flash('success', 'Sub Product updated successfully');
        // return redirect()->back();
    }

    public function render()
    {
        return view('livewire.edit-sub-product', [
            'productContents' => $this->productContents,
            'pageType' => $this->type,
            'slug' => $this->slug,
            'pageTitle' => $this->pageTitle,
            'subProduct' => $this->subProductDetails,
        ]);
    }
}
