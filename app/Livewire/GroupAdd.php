<?php

namespace App\Livewire;

use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;

class GroupAdd extends Component
{

    public $MemberCounter=1;
    #[Rule('required|min:2|max:80')]
    public $name;
    #[Rule(['member.*'=>"required|exists:users,id"])]
    public $member=[];

    public function incrementMemberCounter(){

        $this->member[] = '';
        $this->MemberCounter++;

    }

    public function decrementMemberCounter(){

        unset($this->member[$this->MemberCounter-1]);
        $this->MemberCounter--;

    }

    public function addGroup(){

        $group= new Group();
        $config = [
            'config' => 'C:\laragon\www\HakimProject\public\ssh\openssl.cnf', // Adjust the path based on your system
            'digest_alg' => 'sha512', // 'default_md' has been deprecated, use 'digest_alg' instead
            'private_key_bits' => 512, // Corrected the key name
            'private_key_type' => OPENSSL_KEYTYPE_RSA,
        ];
    
        $keypair = openssl_pkey_new($config);
        openssl_pkey_export($keypair, $privateKey, null, $config);
        $group->privateKey= $privateKey;
        $publickey = openssl_pkey_get_details($keypair);
        $group->publicKey = $publickey['key'];
        $group->name=$this->name;
        $group->user_id=Auth::user()->id;
        $group->save();
        $group->users()->attach(auth()->user()->id);
        for ($i=0; $i <count($this->member) ; $i++) { 
            $group->users()->attach($this->member[$i]);
        }
        $this->reset();
        session()->flash('success', 'Group created successfully.');

    }

    public function mount(){

        $this->member[]='';

    }

    public function render()
    {
        $users=User::select('id','name')->get();
        return view('livewire.group-add',compact('users'));
    }
}
