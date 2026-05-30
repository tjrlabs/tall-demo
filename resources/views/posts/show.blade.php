<x-demo-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            {{-- Event banner --}}
            <div class="mb-6 flex items-center gap-3 px-5 py-3 bg-indigo-50 border border-indigo-200 rounded-xl text-indigo-800 text-sm font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span>
                    Event starts: <strong>{{ $post->event_at->format('l, F j · g:i A') }}</strong>
                    <span class="text-indigo-500 ml-2">({{ $post->event_at->diffForHumans() }})</span>
                </span>
            </div>

            {{-- Post card --}}
            <div class="bg-white overflow-hidden shadow-sm rounded-xl">
                {{-- Cover image placeholder --}}
                <div class="h-48 bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-white opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>

                <div class="p-8">
                    {{-- Category pill --}}
                    <span class="inline-block px-3 py-1 text-xs font-semibold text-indigo-700 bg-indigo-100 rounded-full mb-4">
                        Tech Talk
                    </span>

                    <h1 class="text-2xl font-bold text-gray-900 leading-tight mb-4">
                        {{ $post->title }}
                    </h1>

                    <div class="prose prose-gray max-w-none text-gray-600 leading-relaxed mb-8">
                        @foreach (explode("\n\n", $post->body) as $paragraph)
                            <p class="mb-4">{{ $paragraph }}</p>
                        @endforeach
                    </div>

                    {{-- Footer: metadata + remind button --}}
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pt-6 border-t border-gray-100">
                        <div class="flex items-center gap-3 text-sm text-gray-500">
                            <div class="h-9 w-9 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-sm">
                                TJ
                            </div>
                            <div>
                                <p class="font-medium text-gray-700">TJR Events</p>
                                <p>{{ $post->event_at->format('M j, Y') }}</p>
                            </div>
                        </div>

                        <livewire:remind-modal :postId="$post->id" />
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-demo-layout>
