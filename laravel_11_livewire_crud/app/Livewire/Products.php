<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;

class Products extends Component
{

    public $products;

    #[Locked]
    public $product_id;

    #[Validate("required")]
    public $name = "";

    #[Validate("required")]
    public $description = "";

    public $isEdit = false;

    public $title = "Add New Product";

    public function resetFields()
    {
        $this->title = "Add New Product";
        
        $this->reset("name", "description");

        $this->isEdit = false;
    }

    public function render()
    {
        return view('livewire.products');
    }
}
