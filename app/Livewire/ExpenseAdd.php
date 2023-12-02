<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Expense;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ExpenseAdd extends Component
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
    public $groups;

    public $group;

    public function updatedGroup(){
        $this->users=User::whereHas('groups',function($query){
            $query->where('group_id',$this->group);
        })->get();
    }
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
        $expense->group_id = $this->group;
        $expense->amount = $this->amount;
        $expense->desc = $this->desc;
    
       
        $expense->save();
    
        
        $balance = $this->amount / ($this->relatedMember+1);
        
        $expense->users()->attach(Auth::user()->id, ['related' => 1, 'balance' => $balance]);
    
      
        $balance = -$this->amount / ($this->relatedMember+1);
    
       
        foreach ($this->member as $member) {
            $expense->users()->attach($member, ['related' => 1, 'balance' => $balance]);
        }

        $users=User::whereHas('expenses',function($query) use($expense){
            $query->where('expense_id',$expense->id);
        })->get();

        foreach ($users as $value) {
            if ($value->id !== Auth::user()->id && !$expense->users->contains($value->id)) {
                $expense->users()->attach($value->id, ['related' => 0, 'balance' => 0]);
            }
      }
    }
    public function mount(){

        $this->member[]='';
        $this->groups=Group::whereHas('users',function($query){
            $query->where('user_id',Auth::user()->id);
        })->get();

    }
    public function render()
    {
        
        return view('livewire.expense-add');
    }
}
