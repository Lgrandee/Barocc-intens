<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductMultiSelect extends Component
{
    public $search = '';
    public $selected = [];
    public $quantities = [];
    public $showDropdown = false;

    public function mount($initialSelected = [], $initialQuantities = [])
    {
        $this->selected = array_values($initialSelected);
        $this->quantities = $initialQuantities;
        foreach ($this->selected as $id) {
            if (!isset($this->quantities[$id])) {
                $this->quantities[$id] = 1;
            }
        }
    }

    public function updatedSearch()
    {
        $this->showDropdown = !empty($this->search);
    }

    public function toggle(int $productId)
    {
        if (in_array($productId, $this->selected)) {
            // Product is already selected: increase quantity
            $this->quantities[$productId] = ($this->quantities[$productId] ?? 1) + 1;
            $this->search = '';
            $this->showDropdown = false;
        } else {
            $this->selected[] = $productId;
            $this->quantities[$productId] = 1;
            $this->search = '';
            $this->showDropdown = false;
        }
    }

    public function increment($productId)
    {
        if (isset($this->quantities[$productId])) {
            $this->quantities[$productId]++;
        }
    }

    public function decrement($productId)
    {
        if (isset($this->quantities[$productId]) && $this->quantities[$productId] > 1) {
            $this->quantities[$productId]--;
        }
    }

    public function render()
    {
        $results = collect();

        if ($this->search && $this->showDropdown) {
            $results = Product::query()
                ->where('product_name', 'like', "%{$this->search}%")
                ->orderBy('product_name')
                ->limit(10)
                ->get();
        }

        return view('livewire.product-multi-select', [
            'results' => $results,
        ]);
    }
}
