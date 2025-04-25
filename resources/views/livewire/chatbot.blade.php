<div class="fixed bottom-6 right-6 z-50 w-80 max-h-[500px] bg-white dark:bg-zinc-900 shadow-xl rounded-2xl overflow-hidden border border-gray-100 dark:border-zinc-800 flex flex-col">
    <div class="bg-indigo-600 dark:bg-indigo-700 text-white p-3 font-semibold">
        Chat with us
    </div>

    <div class="flex-1 overflow-y-auto p-3 space-y-2 text-sm text-gray-900 dark:text-white" id="chat-messages">
        @foreach($messages as $msg)
            <div class="{{ $msg['from'] === 'user' ? 'text-right' : 'text-left' }}">
                <span class="inline-block px-3 py-1 rounded-lg {{ $msg['from'] === 'user' ? 'bg-indigo-100 dark:bg-indigo-900/50 text-indigo-900 dark:text-indigo-100' : 'bg-gray-100 dark:bg-zinc-800 text-gray-800 dark:text-gray-200' }}">
                    {{ $msg['text'] }}
                </span>
            </div>
        @endforeach
    </div>

    <div class="p-2 border-t border-gray-200 dark:border-zinc-800">
        <input
            wire:model="message"
            wire:keydown.enter="sendMessage"
            type="text"
            placeholder="Type your message..."
            class="w-full px-3 py-2 border border-gray-100 dark:border-zinc-800 rounded-lg focus:outline-none focus:ring focus:border-indigo-300 dark:focus:border-indigo-600 bg-white dark:bg-zinc-900 text-gray-900 dark:text-white"
        />
    </div>
</div>
