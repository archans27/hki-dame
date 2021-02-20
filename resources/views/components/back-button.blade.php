@props(['class' => '', 'link' => url()->previous()])

<a href="{{$link}}">
    <button type="button" class='relative text-blue-500 border border-blue-500 p-1 px-3 m-1 rounded overflow-hidden {{$class}}'>
        <span class="material-icons">
            backspace
        </span>
        Kembali
    </button>
</a>