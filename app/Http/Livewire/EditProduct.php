<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Livewire\WithFileUploads;
use App\Models\ProductEntity;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class EditProduct extends Component
{

    use WithFileUploads;

    public $product;
    public $product_name;
    public $product_description;
    public $status;
    public $product_icon;
    public $user_percentage;
    public $existing_product_icon;
    public $slug;

    protected $rules = [
        'product_name' => 'required|string|max:255',
        'product_description' => 'required|string|max:255',
        'status' => 'required',
        'product_icon' => 'nullable|image|max:1048',
        'user_percentage' => 'nullable|numeric|between:0,100',
    ];

    public function mount($slug, $id)
    {
        $this->slug = $slug;
        $this->product = ProductEntity::findOrFail($id);
        $this->product_name= $this->product->product_name;
        $this->product_description = $this->product->product_description;
        $this->status = $this->product->status;
        $this->user_percentage = $this->product->user_percentage;
        $this->existing_product_icon = $this->product->product_icon;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function update()
    {
        $validatedData = $this->validate();

        if ($this->product_icon) {
            if ($this->existing_product_icon) {
                Storage::disk('product_icon')->delete($this->existing_product_icon);
            }
            $validatedData['product_icon'] = $this->product_icon->store('product_icon');
        }

        $this->product->update($validatedData);

        session()->flash('success', 'product Entity updated successfully');

        // return redirect()->route('admin.utilities.list', ['slug' => $this->slug]);
    }

    public function render()
    {
        return view('livewire.edit-product', [
            'slug' => $this->slug,
            'product' => $this->product,
        ]);
    }


}
