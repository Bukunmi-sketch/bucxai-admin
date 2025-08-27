<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ProductEntity;
use Illuminate\Support\Facades\Storage;

class DeleteProduct extends Component
{
    public $productId;

    public function mount($id)
    {
        $this->productId = $id;
    }

    public function delete()
    {
        $product = ProductEntity::findOrFail($this->productId);

        if ($product->product_icon) {
            Storage::disk('product_icon')->delete($product->product_icon);
        }

        $product->delete();

        session()->flash('success', 'product Entity deleted successfully');

        return redirect()->route('admin.utilities.list'); // Adjust the route name as necessary
    }

    public function render()
    {
        return view('livewire.delete-product');
    }
}
