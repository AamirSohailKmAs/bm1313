@if ($errors->any() || session('message') || session('success') || session('warning') || session('info') || session('danger'))
<div class="alert-container fixed pointer-events-none max-w-xs right-2 top-2 z-[9999]">
    @forelse ($errors->all() as $error)
    <div class="alert bg-red-600 cursor-pointer shadow-md shadow-slate-400 transition-opacity duration-1000 overflow-hidden mb-2 px-6 py-3 rounded-md text-slate-100">
        <div class="alert-body">{{ $error }}</div>
    </div>
    @empty

    @endforelse

    @if (session('success'))
    <div class="alert bg-green-600 cursor-pointer shadow-md shadow-slate-400 transition-opacity duration-1000 overflow-hidden mb-2 px-6 py-3 rounded-md text-slate-100">
        <div class="alert-body">{{ session('success') }}</div>
    </div>
    @endif

    @if (session('warning'))
    <div class="alert bg-yellow-600 cursor-pointer shadow-md shadow-slate-400 transition-opacity duration-1000 overflow-hidden mb-2 px-6 py-3 rounded-md text-slate-100">
        <div class="alert-body">{{ session('warning') }}</div>
    </div>
    @endif

    @if (session('info'))
    <div class="alert bg-blue-600 cursor-pointer shadow-md shadow-slate-400 transition-opacity duration-1000 overflow-hidden mb-2 px-6 py-3 rounded-md text-slate-100">
        <div class="alert-body">{{ session('info') }}</div>
    </div>
    @endif

</div>
<script>
    document.querySelectorAll('.alert').forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = 0;
        }, 4500);
        setTimeout(() => {
            alert.remove();
        }, 5500);
    });
</script>
@endif