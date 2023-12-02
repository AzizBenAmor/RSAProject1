<?php

namespace App\Livewire;

use App\Models\Expense;
use Livewire\Component;
use Livewire\Attributes\Url;
use App\Models\Group as GroupModel;
use App\Models\User;

class Group extends Component
{
    #[Url(history:true)]
    public $search='';
    #[Url(history:true)]
    public $perpage=5;

    public function render()
    {
        $user_id=auth()->user()->id;
        $expenses=Expense::with('users')->whereHas('users',function($query){
            $query->where('user_id',auth()->user()->id);
        })->get();
        // $expenses= Expense::whereHas('users',function($query){
        //     $query->where('user_id',auth()->user()->id);
        // })->with('users')->get();
        return view('livewire.group',[
                'groups'=>GroupModel::with('user')->whereHas('users',function($query){
                    $query->where('user_id',auth()->user()->id);
                })->search($this->search)
                ->paginate($this->perpage),
                'expenses'=>$expenses
        ]);
    }
}
