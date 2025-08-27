<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Models\ProductEntity;

class ProductsList extends Component
{


    use WithPagination;

    public const DATA_SERVICE_ID = 'DATA_PUR_01';
    public const BILL_SERVICE_ID = 'BILL_PAYMENT_001';
    public const AIRTIME_SERVICE_ID = 'BUY_AIRTIME_001';

    public $type;
    public $pageTitle;
    public $productType;
    public $utilityType;

    public function mount($type)
    {
        $this->type = $type;

        if ($type === 'data-topup') {
            $this->utilityType = self::DATA_SERVICE_ID;
            $this->pageTitle = 'Data-Topup';
        } else if ($type === 'bill-payment') {
            $this->utilityType = self::BILL_SERVICE_ID;
            $this->pageTitle = 'Bill Payment';
        }else if ($type === 'buy-airtime') {
            $this->utilityType = self::AIRTIME_SERVICE_ID;
            $this->pageTitle = 'Buy Airtime';
        }

        $this->productType = $type;
    }


    public function activateProduct($productId)
    {
        $product = ProductEntity::find($productId);
        if ($product) {
            $product->status = '1';  // Assuming you have a 'status' field for products
            $product->save();
            session()->flash('success', 'Product activated successfully.');
        }
    }

    public function deactivateProduct($productId)
    {
        $product = ProductEntity::find($productId);
        if ($product) {
            $product->status = '0';
            $product->save();
            session()->flash('success', 'Product deactivated successfully.');
        }
    }

    public function render()
    {
        $content = DB::table('product_entities')
            ->where('service_id', $this->utilityType)
            ->orderBy('created_at', 'asc')
            ->paginate(20);

        return view('livewire.products-list', [
            'contents' => $content,
            'pageTitle' => $this->pageTitle,
            'productType' => $this->productType
        ]);
    }

    // public function render()
    // {
    //     return view('livewire.products-list');
    // }
}
