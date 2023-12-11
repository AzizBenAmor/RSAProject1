<div>
    <div>
        <div class=" mb-6">
          <button href="{{route('AddExpenseGroup',$group->id)}}" wire:navigate class=" mt-5 text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-3 text-center mr-2 mb-2">Add Expense</button>
         </div>
        <section >
            
            <div class=" mx-auto max-w-screen-xl ">
                
                <!-- Start coding here -->
                <div class="bg-white shadow-md sm:rounded-lg overflow-hidden">
                    <div class="flex items-center justify-between d p-4">
                        <div class="flex">
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 "
                                        fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input 
                                wire:model.live.debounce.300ms = "search"
                                type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 "
                                    placeholder="Search" required="">
                            </div>
                        </div>
                    
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 ">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                               
                                    
                               
                                <tr>
                                 
                                    <th scope="col" class="px-4 py-3">
                                        Expense Name
                                    </th>
                                   <th scope="col" class="px-4 py-3">
                                    Owner
                                  </th>
                                  <th scope="col" class="px-4 py-3">
                                    Number of members
                                  </th>
                                  <th scope="col" class="px-4 py-3">
                                    Your Balance
                                  </th>
                                   
                                    <th scope="col" class="px-4 py-3">
                                      Actions
                                    </th>
                                </tr>
                            </thead>                           
                            <tbody>
                              
                                @foreach ($expenses as $Expense)
                                <tr class="border-b " wire:key='{{ $Expense->id }}'>
                                    
                                    <td class="px-4 py-3">   {{ $Expense->title }} </td>
                                    <td class="px-4 py-3"> {{ $Expense->user->name }} </td>
                                    <td class="px-4 py-3"> {{ count($Expense->users) }}</td>
                                    <td class="px-4 py-3">
                                        @foreach ($Expense->users as $user)
                                            @if ($user->id==auth()->user()->id)
                                                {{$user->pivot->balance}}
                                            @endif
                                        @endforeach
                                        </td>
                                    <td class="px-4 py-3 flex items-center justify-even">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('addGroup',$Expense->id) }}" wire:navigate class="px-3 py-1 bg-gray-700 text-white rounded">show</a> 
                                            
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                     
                    </div>
    
                    <div class="py-4 px-3">
                        <div class="flex ">
                            <div class="flex space-x-4 items-center mb-3">
                                <label class="w-32 text-sm font-medium text-gray-900">Per Page</label>
                                <select
                                    wire:model.live='perpage'
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                        </div>
                   
                        {{ $expenses->links() }}
                    
                    </div>
                </div>
            </div>
        </section>
        
    
    </div>
</div>
