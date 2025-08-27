<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ProductEntity;

class ProductDetail extends Component
{

    public $slug;
    public $product;

    public function mount($slug,$id){
        $this->slug =$slug;
        $this->product= ProductEntity::findorFail($id);
    }


    public function render()
    {
        return view('livewire.product-detail', [
            'product' => $this->product,
            'slug' => $this->slug
        ]);
    }
}
