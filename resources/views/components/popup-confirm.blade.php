@props(['title', 'message', 'action', 'actionUrl', 'actionMethod' => 'GET', 'modalId', 'formId' ])

<div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="{{$modalId}}">
    <div class="relative w-auto my-6 mx-auto max-w-3xl">
      <!--content-->
      <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
        <!--header-->
        <div class="flex items-start justify-between p-5 border-b border-solid border-gray-300 rounded-t">
          <h3 class="text-3xl font-semibold text-black">
            {{$title}}
          </h3>
          <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('{{$modalId}}')">
            <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
              ×
            </span>
          </button>
        </div>
        <!--body-->
        <div class="relative p-6 flex-auto">
          <p class="my-4 text-gray-600 text-lg leading-relaxed">
            {{$message}}
          </p>
        </div>
        <!--footer-->
        <div class="flex items-center justify-end p-6 border-t border-solid border-gray-300 rounded-b">
          <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1" type="button" style="transition: all .15s ease" onclick="toggleModal('{{$modalId}}')">
            Tutup
          </button>
          <form method="POST" action="{{ $actionUrl }}" id="{{$formId}}">
            @method($actionMethod)
            @csrf
            <button type="submit" class="bg-blue-500 text-white active:bg-blue-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1" type="button" style="transition: all .15s ease" onclick="toggleModal('{{$modalId}}')">
              {{$action}}
            </button>
        </form>
        </div>
      </div>
    </div>
  </div>
  <div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="{{$modalId}}-backdrop"></div>
  <script type="text/javascript">
    function toggleModal(modalID){
      document.getElementById(modalID).classList.toggle("hidden");
      document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
      document.getElementById(modalID).classList.toggle("flex");
      document.getElementById(modalID + "-backdrop").classList.toggle("flex");
    }
  </script>