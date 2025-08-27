<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductEntity;


class CreateProduct extends Component
{

    use WithFileUploads;

    public $type;
    public $product_name;
    public $product_description;
    public $service_id;
    public $status;
    public $product_icon;
    public $max_amount;
    public $min_amount;
    public $user_percentage;
    public $reseller_percentage;
    public $network;
    public $instruct_1;
    public $instruct_2;
    public $phone;
    public $per_charges;
    public $auto_prod_id;
    public $auto_type;

    protected $rules = [
        'type' => 'required',
        'product_name' => 'required',
        'product_description' => 'required',
        'service_id' => 'required',
        'status' => 'required',
        'product_icon' => 'required|image|max:1048',
        'max_amount' => 'nullable|numeric',
        'min_amount' => 'nullable|numeric',
        'user_percentage' => 'nullable|numeric|between:0,100',
        'reseller_percentage' => 'nullable|numeric|between:0,100',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $validatedData = $this->validate();

        if ($this->product_icon) {
            $validatedData['product_icon'] = $this->product_icon->store('product_icon');
        }

        ProductEntity::create($validatedData);

        session()->flash('success', 'Product Entity created successfully');

        return redirect()->route('admin.products-list'); // Adjust the route name as necessary
    }


    // #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.create-product');
    }
}
