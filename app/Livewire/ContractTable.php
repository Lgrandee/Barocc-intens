<?php

namespace App\Livewire;

use App\Models\Contract;
use Livewire\Component;
use Livewire\WithPagination;

class ContractTable extends Component
{
    use WithPagination;

    public $search = '';
    public $status = 'all';

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => 'all'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->status = 'all';
        $this->resetPage();
    }

    public function render()
    {
        $query = Contract::with(['customer', 'products']);

        // Zoekfunctie
        if ($this->search) {
            $query->where(function($q) {
                $q->whereHas('customer', function($q) {
                    $q->where('name_company', 'like', "%{$this->search}%");
                })
                ->orWhereHas('products', function($q) {
                    $q->where('product_name', 'like', "%{$this->search}%");
                })
                ->orWhere('id', 'like', "%{$this->search}%");
            });
        }

        // Status filter
        if ($this->status !== 'all') {
            $query->where('status', $this->status);
        }

        $contracts = $query->orderBy('start_date', 'desc')->paginate(10);

        return view('livewire.contract-table', [
            'contracts' => $contracts
        ]);
    }
}

