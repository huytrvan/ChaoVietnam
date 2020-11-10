@if (!empty(session()->get($message)))
<div>
    <div id="message" class="text-green-700 bg-green-100">
        <div class="p-4">
            <span>{!! session()->get($message) !!}</span>
        </div>
        <button onclick="message.className='hidden'"
            class="flex items-center justify-center w-full py-2 text-green-600 bg-green-100 border-t border-green-500"><svg
                class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    clip-rule="evenodd"></path>
            </svg> {{ $confirm }}</button>
    </div>
</div>
@endif