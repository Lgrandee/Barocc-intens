<?php

namespace App\Livewire;

use App\Models\Customer;
use Livewire\Component;

class CustomerSearch extends Component
{
    public $search = '';
    public $selectedId = null;
    public $selectedName = '';
    public $showDropdown = false;

    public function mount($initialId = null)
    {
        if ($initialId) {
            $customer = Customer::find($initialId);
            if ($customer) {
                $this->selectedId = $customer->id;
                $this->selectedName = $customer->name_company;
            }
        }
    }

    public function updatedSearch()
    {
        $this->showDropdown = !empty($this->search);
    }

    public function selectCustomer($customerId)
    {
        $customer = Customer::find($customerId);
        if ($customer) {
            $this->selectedId = $customer->id;
            $this->selectedName = $customer->name_company;
            $this->search = '';
            $this->showDropdown = false;
        }
    }

    public function clearSelection()
    {
        $this->selectedId = null;
        $this->selectedName = '';
        $this->search = '';
        $this->showDropdown = false;
    }

    public function render()
    {
        $results = collect();

        if ($this->search && $this->showDropdown) {
            $results = Customer::query()
                ->where('name_company', 'like', "%{$this->search}%")
                ->orWhere('contact_person', 'like', "%{$this->search}%")
                ->orWhere('city', 'like', "%{$this->search}%")
                ->orderBy('name_company')
                ->limit(10)
                ->get();
        }

        return view('livewire.customer-search', [
            'results' => $results,
        ]);
    }
}
