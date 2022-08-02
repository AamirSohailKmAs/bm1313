@if ($errors->any())
<div class="alert alert-danger alert-dismissible fixed-top fixed z-10 p-7 top-0 w-full bg-red-100 ">
    <ul>
        @foreach ($errors->all() as $error)
        <li class="font-medium text-red-700">{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif