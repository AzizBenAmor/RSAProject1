<?php

namespace App\Livewire;

use App\Models\Expense as ModelsExpense;
use Livewire\Attributes\Url;
use Livewire\Component;

class Expense extends Component
{
    #[Url(history:true)]
    public $search='';
    #[Url(history:true)]
    public $perpage=5;

    public $expense;

    
    public function render()
    {
        return view('livewire.expense',[
            'expenses'=>ModelsExpense::with('user')->with('group')->whereHas('users',function($query){
                $query->where('user_id',auth()->user()->id);
            })->search($this->search)
            ->paginate($this->perpage),
        ]);
    }
}
