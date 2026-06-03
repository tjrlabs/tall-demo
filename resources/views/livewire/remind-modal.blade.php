<div
    x-data="{ initialized: true }"
    x-on:modal-ready.window="initialized = true"
    x-on:start-extraction.window="$wire.extract()"
>

    {{-- Trigger button --}}
    <button
        x-on:click="initialized = false; $dispatch('open-modal', 'remind-modal'); $wire.open()"
        type="button"
        class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg shadow transition"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>
        Remind me
    </button>

    {{-- Modal --}}
    <x-modal name="remind-modal" :show="false" max-width="md" focusable>
        <div class="p-6">

            {{-- Alpine: show while waiting for first Livewire response --}}
            <div x-show="!initialized" class="text-center py-10">
                <svg class="animate-spin h-9 w-9 text-gray-400 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 22 6.477 22 12h-4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <p class="text-sm text-gray-500">Loading…</p>
            </div>

            {{-- Livewire: show once open() has responded --}}
            <div x-show="initialized">

                @if ($extracting)
                    {{-- Gemini extraction in progress --}}
                    <div class="text-center py-10">
                        <svg class="animate-spin h-9 w-9 text-indigo-500 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 22 6.477 22 12h-4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <p class="text-sm font-medium text-gray-700">Finding event date…</p>
                    </div>

                @elseif ($extractionError)
                    {{-- Extraction failed --}}
                    <div class="text-center py-6">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-1">Couldn't find event date</h3>
                        <p class="text-sm text-gray-500 mb-6">{{ $extractionError }}</p>
                        <button
                            x-on:click="$dispatch('close-modal', 'remind-modal')"
                            type="button"
                            class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold rounded-lg transition"
                        >
                            Close
                        </button>
                    </div>

                @elseif ($submitted)
                    {{-- Reminder saved --}}
                    <div class="text-center py-4">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 mb-4">
                            <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-1">Reminder set!</h3>
                        <p class="text-sm text-gray-500 mb-6">
                            We'll send a reminder to <strong>{{ $email }}</strong>
                            {{ $remindBeforeMinutes }} {{ $remindBeforeMinutes === 60 ? 'minute (1 hour)' : 'minutes' }} before the event starts.
                        </p>
                        <button
                            x-on:click="$dispatch('close-modal', 'remind-modal')"
                            type="button"
                            class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition"
                        >
                            Done
                        </button>
                    </div>

                @else
                    {{-- Reminder form --}}
                    <div class="flex items-center justify-between mb-1">
                        <h2 class="text-lg font-semibold text-gray-900">Set a reminder</h2>
                        <button x-on:click="$dispatch('close-modal', 'remind-modal')" type="button" class="text-gray-400 hover:text-gray-600 transition">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    @if ($post?->event_at)
                        <p class="text-sm text-indigo-600 font-medium mb-5">
                            {{ $post->event_at->format('l, F j · g:i A') }}
                        </p>
                    @endif

                    <div class="space-y-5">
                        {{-- Email --}}
                        <div>
                            <x-input-label for="reminder-email" value="Email address" />
                            <x-text-input
                                id="reminder-email"
                                wire:model="email"
                                type="email"
                                class="mt-1 block w-full"
                                placeholder="you@example.com"
                                autocomplete="email"
                            />
                            <x-input-error :messages="$errors->get('email')" class="mt-1" />
                        </div>

                        {{-- Timing options --}}
                        <div>
                            <x-input-label value="When to remind you" />
                            <div class="mt-2 space-y-2">
                                @foreach ([15 => 'Remind me 15 mins before the event starts', 30 => 'Remind me 30 mins before the event starts', 60 => 'Remind me 1 hour before the event starts'] as $minutes => $label)
                                    <label class="flex items-center gap-3 p-3 rounded-lg border cursor-pointer transition
                                        {{ $remindBeforeMinutes === $minutes ? 'border-indigo-500 bg-indigo-50' : 'border-gray-200 hover:border-gray-300' }}">
                                        <input
                                            type="radio"
                                            wire:model.live="remindBeforeMinutes"
                                            value="{{ $minutes }}"
                                            class="text-indigo-600 border-gray-300 focus:ring-indigo-500"
                                        />
                                        <span class="text-sm text-gray-700">{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <x-input-error :messages="$errors->get('remindBeforeMinutes')" class="mt-1" />
                        </div>

                        {{-- Submit --}}
                        <div class="flex justify-end gap-3 pt-1">
                            <button
                                x-on:click="$dispatch('close-modal', 'remind-modal')"
                                type="button"
                                class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 transition"
                            >
                                Cancel
                            </button>
                            <button
                                wire:click="submit"
                                wire:loading.attr="disabled"
                                type="button"
                                class="inline-flex items-center gap-2 px-5 py-2 bg-indigo-600 hover:bg-indigo-700 disabled:opacity-60 text-white text-sm font-semibold rounded-lg shadow transition"
                            >
                                <span wire:loading.remove wire:target="submit">Set reminder</span>
                                <span wire:loading wire:target="submit">Saving…</span>
                            </button>
                        </div>
                    </div>
                @endif

            </div>

        </div>
    </x-modal>
</div>
