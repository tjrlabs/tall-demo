<x-demo-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <h2 class="text-xl font-bold text-gray-800 mb-6">Upcoming Events</h2>

            <div class="space-y-4">
                @foreach ($posts as $post)
                    <a href="{{ route('posts.show', $post) }}" class="block bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md hover:border-indigo-200 transition-all duration-150">
                        <div class="p-6">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-base font-semibold text-gray-900 leading-snug mb-2">
                                        {{ $post->title }}
                                    </h3>
                                    <p class="text-sm text-gray-500 line-clamp-2">
                                        {{ Str::limit($post->body, 160) }}
                                    </p>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>

                            <div class="mt-4 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                @if ($post->event_at)
                                    <span class="text-xs font-medium text-indigo-600">
                                        {{ $post->event_at->format('l, F j · g:i A') }}
                                    </span>
                                @else
                                    <span class="text-xs font-medium text-gray-400">Date TBA</span>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

        </div>
    </div>
</x-demo-layout>
