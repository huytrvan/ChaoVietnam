@if (!empty($message))
<div class="flex justify-between px-4 py-2 text-sm text-center {{ $type ==='error' ? 'text-red-900 bg-red-300' : 'text-green-900 bg-green-300'}} rounded"
    id="msg">
    <h6>{{ $message }}</h6>
    <button type="button" onclick="msg.classList.add('hidden')">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
            </path>
        </svg></button>
</div>
@endif