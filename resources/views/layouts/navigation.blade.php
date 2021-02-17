
  <div @click.away="open = false" class="flex flex-col w-full md:w-64 bg-gray-600 text-white bg-white dark-mode:text-gray-200 dark-mode:bg-gray-800 flex-shrink-0" x-data="{ open: false }">
    <div class="flex-shrink-0 px-8 py-4 flex flex-row items-center justify-between ">
      <a href="#" class="text-3xl font-semibold tracking-widest uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">SIMPEL <br/>HKI DAME</a>
      <button class="rounded-lg md:hidden rounded-lg focus:outline-none focus:shadow-outline" @click="open = !open">
        <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
          <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
          <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
      </button>
    </div>
    <hr/>
    <nav :class="{'block': open, 'hidden': !open}" class="flex-grow md:block px-4 pb-4 md:pb-0 md:overflow-y-auto bg-gray-600">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="active w-full text-left my-5"
                    onclick="event.preventDefault();
                        toggleModal('modal-logout');">
                HKI Admin
                <span class="material-icons small-icon float-right">
                    power_settings_new
                </span>
              </button>
        </form>
      
      <x-responsive-nav-link class="active" :active="1" href="{{url('/dashboard')}}">Dashboard</x-responsive-nav-link>
      <div @click.away="open = false" class="relative" x-data="{ open: false }">
        <button @click="open = !open" class="text-right flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-gray-500 text-white rounded-md dark-mode:bg-transparent dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:focus:bg-gray-600 dark-mode:hover:bg-gray-600 md:block hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
          <span class="float-left">Data Master</span>
          <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
        <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg">
          <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-800">
            
            <x-responsive-nav-link class="active" :active="0" href="{{url('/jemaat')}}">Jemaat</x-responsive-nav-link>
           
          </div>
        </div>
      </div>
    </nav>
    <x-popup-confirm
      :modalId="'modal-logout'"
      :formId="'form-modal-logout'"
      :title="'LOGOUT'"
      :message="'Apakah anda yakin akan keluar dari aplikasi?'"
      :action="'Keluar dari aplikasi'"
      :actionUrl="url('logout')"
      :actionMethod="'POST'"
    />
  </div>