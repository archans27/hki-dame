@if(Session::has('succeed'))
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-5" >
    <div class="bg-blue-300 border border-blue-400 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="w-3-4  p-1 px-3 m-1 rounded ">{{ session('succeed') }}</div>
    </div>
</div>
@endif