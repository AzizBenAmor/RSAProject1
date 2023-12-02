<div>
    <form wire:submit.prevent='addExpense' class=" ml-5 mt-9 mb-9 mr-7">
      <x-flash-messages />
        <div class="mb-6">
          <label  class="block mb-2 text-sm font-medium ">Title</label>
          <input type="text" wire:model.live='title' class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="title" >
          @error('title')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{ $message }} </p>
         @enderror
        </div>       
        <div class="mb-6">
            <label  class="block mb-2 text-sm font-medium ">Date</label>
            <input type="date" wire:model.live='date' class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "  >
            @error('date')
              <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{ $message }} </p>
           @enderror
          </div>     
          <div class="mb-6">
            <label  class="block mb-2 text-sm font-medium ">Amount</label>
            <input type="number" wire:model.live='amount' class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="amount" >
            @error('amount')
              <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{ $message }} </p>
           @enderror
          </div>     
          <div class="mb-6">
            <label  class="block mb-2 text-sm font-medium ">Description</label>
            <input type="text" wire:model.live='desc' class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="description" >
            @error('desc')
              <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{ $message }} </p>
           @enderror
          </div>     
          <div class="mb-6">
            <label  class="block mb-2 text-sm font-medium ">Group</label>
            <select  wire:model.live="group"  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " >
                <option value="">Groups</option>

                @foreach ($groups as $group)
                  <option value="{{ $group->id }}">{{ $group->name }}</option>
                @endforeach
               
            </select>
            @error("group")
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{ $message }} </p>
            @enderror
          
          </div>
     
        @for ($i = 0; $i < $relatedMember; $i++)
        <div class="mb-6">
            <label  class="block mb-2 text-sm font-medium ">Related Member</label>
            <select type="number" wire:model.live="member.{{ $i }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
              <option value="">Member</option>
              
                @foreach ($users as $user)
                @php
                $isCurrentUser = $user->id === auth()->user()->id;
              @endphp
                    @if (!$isCurrentUser )
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endif
                @endforeach
          </select>
          
            @error("member.$i")
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{ $message }} </p>
            @enderror
          
          </div>

        @endfor

        <button wire:click.prevent='incrementMemberCounter' class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Add Member</button>
        <button wire:click.prevent='decrementMemberCounter'   {{ $relatedMember == 0 ? 'disabled' : '' }} class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Remove Member</button>
        <button  class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Create new group</button>
      </form>
</div>
