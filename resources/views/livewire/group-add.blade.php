<div>
    <form wire:submit.prevent='addGroup' class=" ml-5 mt-9 mb-9 mr-7">
      <x-flash-messages />
        <div class="mb-6">
          <label  class="block mb-2 text-sm font-medium ">Group Name</label>
          <input type="text" wire:model.live='name' class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Nom && Prénom" >
          @error('name')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{ $message }} </p>
         @enderror
        </div>       
       
        
         
        @for ($i = 0; $i < $MemberCounter; $i++)
        <div class="mb-6">
            <label  class="block mb-2 text-sm font-medium ">Member</label>
            <select type="number" wire:model.live="member.{{ $i }}"  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " >
                <option value="">Member</option>

                @foreach ($users as $user)
                  <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
               
            </select>
            @error("member.$i")
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{ $message }} </p>
            @enderror
          
          </div>

        @endfor

        <button wire:click.prevent='incrementMemberCounter' class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Add Member</button>
        <button wire:click.prevent='decrementMemberCounter'   {{ $MemberCounter == 0 ? 'disabled' : '' }} class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Remove Member</button>
        <button  class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Create new group</button>
      </form>
</div>
