<?php

namespace App\Livewire;

use App\Models\Expense;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;
#[Layout('dashboard.AddExpenseGroup')]
class AddExpenseGroup extends Component
{
    public $relatedMember=1;
    #[Rule('required|min:2|max:80')]
    public $title;
    #[Rule('required')]
    public $date;
    #[Rule('required')]
    public $amount;
    #[Rule('required')]
    public $desc;
    #[Rule(['member.*'=>"required|exists:users,id"])]
    public $member=[];
    public $users=[];
    public $group;

    public function incrementMemberCounter(){

        $this->member[] = '';
        $this->relatedMember++;

    }

    public function decrementMemberCounter(){

        unset($this->member[$this->relatedMember-1]);
        $this->relatedMember--;

    }

    public function addExpense()
    {
        $expense = new Expense();
        $expense->title = $this->title;
        $expense->date = $this->date;
        $expense->user_id = Auth::user()->id;
        $expense->group_id = $this->group->id;
        $expense->amount = $this->amount;
        $expense->desc = $this->desc;
    
       
        $expense->save();
    
        
        $balance = $this->amount / ($this->relatedMember+1);
        
        $expense->users()->attach(Auth::user()->id, ['related' => 1, 'balance' => $balance]);
    
      
        $balance = -$this->amount / ($this->relatedMember+1);
    
       
        foreach ($this->member as $member) {
            $expense->users()->attach($member, ['related' => 1, 'balance' => $balance]);
        }

    

        foreach ($this->users as $value) {
            if ($value->id !== Auth::user()->id && !$expense->users->contains($value->id)) {
                $expense->users()->attach($value->id, ['related' => 0, 'balance' => 0]);
            }
      }
    }
    public function mount($groupId){

        $this->member[]='';
        $this->group=Group::findorfail($groupId);
        $this->users=User::whereHas('groups',function($query) use($groupId){
            $query->where('group_id',$groupId);
        })->get();


    }
    public function render()
    {
        return view('livewire.add-expense-group');
    }
}
