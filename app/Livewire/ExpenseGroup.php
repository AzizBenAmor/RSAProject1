<?php

namespace App\Livewire;

use App\Models\Expense;
use App\Models\Group;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
#[Layout('dashboard.ExpenseGroup')]
class ExpenseGroup extends Component
{
    #[Url(history:true)]
    public $search='';
    #[Url(history:true)]
    public $perpage=5;
    public $group;
    public $expense;

    public function mount($groupId){

        $this->group=Group::findorfail($groupId);

    }

    public function render()
    {
        return view('livewire.expense-group',[
            'expenses'=>Expense::with('user')->with('group')->where('group_id',$this->group->id)->search($this->search)
            ->paginate($this->perpage),
        ]);
    }
}
