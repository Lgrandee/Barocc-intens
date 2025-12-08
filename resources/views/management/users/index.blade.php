<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gebruikersbeheer</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">
    <x-layouts.app :title="'Werknemers Beheer'">
        <main class="p-6">
            <header class="mb-6">
                <h1 class="text-2xl font-semibold text-black drop-shadow">Werknemers Beheer</h1>
                <p class="text-sm text-gray-700">Beheer alle werknemers en hun rechten</p>
            </header>

            <!-- Action Buttons -->
            <div class="flex gap-3 mb-6">
                <a href="{{ route('management.users.create') }}" class="px-4 py-2 bg-yellow-400 text-black rounded hover:bg-yellow-500 font-bold text-sm shadow-md border border-black transition-transform duration-150 hover:scale-110">
                    + Nieuwe Werknemer
                </a>
                <button class="px-4 py-2 border border-black rounded text-black bg-yellow-400 hover:bg-yellow-500 font-bold text-sm transition-transform duration-150 hover:scale-110">
                    Bulk Import
                </button>
                <button class="px-4 py-2 border border-black rounded text-black bg-yellow-400 hover:bg-yellow-500 font-bold text-sm transition-transform duration-150 hover:scale-110">
                    Export Lijst
                </button>
                <div class="ml-auto">
                    <a href="{{ route('management.roles.index') }}" class="px-4 py-2 border border-black text-black rounded bg-yellow-400 hover:bg-yellow-500 font-bold text-sm transition-transform duration-150 hover:scale-105 will-change-transform">
                        👑 Bekijk Rollen
                    </a>
                </div>
            </div>

            <!-- Search and Filters -->
            <div class="flex gap-3 mb-6">
                <div class="relative flex-1 max-w-md">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </span>
                    <input type="text" id="searchInput" placeholder="Zoek op naam of e-mail..."
                        class="w-full pl-10 pr-4 py-2 border border-black bg-white text-black rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-transparent placeholder-gray-400">
                </div>
                <select id="roleFilter" class="px-4 py-2 border border-black bg-white text-black rounded-lg focus:ring-2 focus:ring-yellow-400">
                    <option value="">Alle Rollen</option>
                    <option value="Sales">Sales</option>
                    <option value="Purchasing">Purchasing</option>
                    <option value="Finance">Finance</option>
                    <option value="Technician">Technician</option>
                    <option value="Planner">Planner</option>
                    <option value="Management">Management</option>
                </select>
                <select id="statusFilter" class="px-4 py-2 border border-black bg-white text-black rounded-lg focus:ring-2 focus:ring-yellow-400">
                    <option value="">Alle Statussen</option>
                    <option value="active">Actief</option>
                    <option value="inactive">Inactief</option>
                    <option value="vacation">Vakantie</option>
                </select>
            </div>

            <!-- Users Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-5 gap-8 mb-10">
                @forelse($users as $user)
                    @php
                        $colors = ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6', '#ec4899', '#14b8a6'];
                        $avatarColor = $colors[$user->id % count($colors)];
                    @endphp
                    <div class="bg-white rounded-xl shadow-lg border border-black p-4 flex flex-col items-center transition-transform hover:scale-[1.03] hover:shadow-2xl duration-200" data-role="{{ $user->department }}" data-status="{{ $user->status }}">
                        <div class="flex flex-col items-center w-full mb-2">
                            <div class="h-14 w-14 rounded-full flex items-center justify-center text-black font-bold text-2xl mb-2 shadow-sm border border-gray-200 bg-yellow-400" style="background-color: {{ $avatarColor }}">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div class="text-base font-semibold text-black text-center">{{ $user->name }}</div>
                            <div class="text-xs text-yellow-500 text-center">#{{ str_pad($user->id, 3, '0', STR_PAD_LEFT) }}</div>
                        </div>
                        <div class="flex flex-col items-center w-full mb-2 gap-0.5">
                            <span class="text-xs text-gray-700">{{ $user->email }}</span>
                            <span class="text-xs text-yellow-600">{{ $user->phone_num ?? 'Geen telefoon' }}</span>
                        </div>
                        <div class="flex flex-row items-center gap-2 w-full justify-center mb-2">
                            <span class="px-2 py-0.5 text-xs font-semibold rounded-full
                                @if($user->department === 'Sales') bg-green-100 text-green-800 border border-green-300
                                @elseif($user->department === 'Purchasing') bg-purple-100 text-purple-800 border border-purple-300
                                @elseif($user->department === 'Finance') bg-yellow-100 text-yellow-800 border border-yellow-300
                                @elseif($user->department === 'Technician') bg-pink-100 text-pink-800 border border-pink-300
                                @elseif($user->department === 'Planner') bg-indigo-100 text-indigo-800 border border-indigo-300
                                @elseif($user->department === 'Management') bg-blue-100 text-blue-800 border border-blue-300
                                @else bg-gray-100 text-gray-800 border border-gray-300
                                @endif">
                                {{ $user->department }}
                            </span>
                            @if($user->status === 'active')
                                <span class="px-2 py-0.5 text-xs font-semibold rounded-full bg-green-100 text-green-800 border border-green-300">Actief</span>
                            @elseif($user->status === 'vacation')
                                <span class="px-2 py-0.5 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 border border-yellow-300">Vakantie</span>
                            @else
                                <span class="px-2 py-0.5 text-xs font-semibold rounded-full bg-red-100 text-red-800 border border-red-300">Inactief</span>
                            @endif
                        </div>
                        <div class="w-full text-center text-xs text-gray-500 mb-3">
                            Laatst actief:<br>{{ $user->last_active ? $user->last_active->format('d-m-Y, H:i') : 'Nooit' }}
                        </div>
                        <div class="flex gap-2 w-full mt-auto pt-2 border-t border-black">
                            <a href="{{ route('management.users.edit', $user->id) }}" class="flex-1 px-2 py-2 text-xs border border-black rounded text-black bg-yellow-400 hover:bg-yellow-500 font-bold transition-transform duration-150 hover:scale-105 text-center" title="Bewerken">✏️ Bewerken</a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-4 text-center text-yellow-500 py-12">
                        <svg class="mx-auto h-12 w-12 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <p class="mt-2">Geen werknemers gevonden</p>
                    </div>
                @endforelse
            </div>

                <!-- Pagination -->
                <div class="flex flex-col items-center gap-3 px-4 py-3 border-t border-black bg-white">
                    <div class="text-sm text-gray-700">
                        Showing {{ $users->firstItem() ?? 0 }}–{{ $users->lastItem() ?? 0 }} of {{ $users->total() }}
                    </div>
                    <div class="flex gap-1 items-center">
                        @if($users->onFirstPage())
                            <span class="px-3 py-1 border border-black rounded text-sm text-yellow-400 cursor-not-allowed">‹</span>
                        @else
                            <a href="{{ $users->previousPageUrl() }}" class="px-3 py-1 border border-black rounded text-sm text-yellow-700 bg-yellow-400 hover:bg-yellow-500 transition-transform duration-150 hover:scale-110">‹</a>
                        @endif

                        @php
                            $currentPage = $users->currentPage();
                            $lastPage = $users->lastPage();
                            $start = max(1, $currentPage - 2);
                            $end = min($lastPage, $currentPage + 2);
                        @endphp

                        @if ($start > 1)
                            <a href="{{ $users->url(1) }}" class="px-3 py-1 border border-black rounded text-sm text-yellow-700 bg-yellow-400 hover:bg-yellow-500 transition-transform duration-150 hover:scale-110">1</a>
                            @if ($start > 2)
                                <span class="px-2 text-yellow-400">...</span>
                            @endif
                        @endif

                        @for ($page = $start; $page <= $end; $page++)
                            @if ($page == $currentPage)
                                <span class="px-3.5 py-1.5 border border-black bg-yellow-400 text-black rounded text-sm font-bold shadow scale-105">{{ $page }}</span>
                            @else
                                <a href="{{ $users->url($page) }}" class="px-3 py-1 border border-black rounded text-sm text-yellow-700 bg-yellow-400 hover:bg-yellow-500 transition-transform duration-150 hover:scale-110">{{ $page }}</a>
                            @endif
                        @endfor

                        @if ($end < $lastPage)
                            @if ($end < $lastPage - 1)
                                <span class="px-2 text-yellow-400">...</span>
                            @endif
                            <a href="{{ $users->url($lastPage) }}" class="px-3 py-1 border border-black rounded text-sm text-yellow-700 bg-yellow-400 hover:bg-yellow-500 transition-transform duration-150 hover:scale-110">{{ $lastPage }}</a>
                        @endif

                        @if($users->hasMorePages())
                            <a href="{{ $users->nextPageUrl() }}" class="px-3 py-1 border border-black rounded text-sm text-yellow-700 bg-yellow-400 hover:bg-yellow-500 transition-transform duration-150 hover:scale-110">›</a>
                        @else
                            <span class="px-3 py-1 border border-black rounded text-sm text-yellow-400 cursor-not-allowed">›</span>
                        @endif
                    </div>
                </div>
            </div>
        </main>
    </x-layouts.app>

    <script>
        // Zoek- en filterfunctionaliteit voor werknemerskaarten
        const searchInput = document.getElementById('searchInput');
        const roleFilter = document.getElementById('roleFilter');
        const statusFilter = document.getElementById('statusFilter');
        const pagination = document.querySelector('.flex.flex-col.items-center.gap-3.px-4.py-3');
        let dynamicCount = null;

        function filterCards() {
            const searchTerm = searchInput?.value.toLowerCase() || '';
            const selectedRole = roleFilter?.value || '';
            const selectedStatus = statusFilter?.value || '';
            const cards = document.querySelectorAll('[data-role][data-status]');
            let visibleCount = 0;

            cards.forEach(card => {
                const text = card.textContent.toLowerCase();
                const cardRole = card.dataset.role || '';
                const cardStatus = card.dataset.status || '';

                const matchesSearch = text.includes(searchTerm);
                const matchesRole = !selectedRole || cardRole === selectedRole;
                const matchesStatus = !selectedStatus || cardStatus === selectedStatus;

                const show = matchesSearch && matchesRole && matchesStatus;
                card.style.display = show ? '' : 'none';
                if (show) visibleCount++;
            });

            // Toon of verberg de lege-staat melding
            const emptyState = document.querySelector('.col-span-4.text-center');
            if (emptyState) {
                emptyState.style.display = visibleCount > 0 ? 'none' : '';
            }

            // Dynamische telling en paginering
            const isFiltering = searchInput.value || roleFilter.value || statusFilter.value;
            if (!dynamicCount) {
                dynamicCount = document.createElement('div');
                dynamicCount.className = 'flex flex-col items-center gap-3 px-4 py-3 border-t border-black bg-white';
                dynamicCount.style.display = 'none';
                dynamicCount.innerHTML = `<div class="text-sm text-gray-700" id="dynamicCountText"></div>`;
                pagination?.parentNode.insertBefore(dynamicCount, pagination);
            }
            if (isFiltering) {
                if (pagination) pagination.style.display = 'none';
                dynamicCount.style.display = '';
                document.getElementById('dynamicCountText').textContent = `Toont ${visibleCount} van ${cards.length} resultaten`;
            } else {
                if (pagination) pagination.style.display = '';
                dynamicCount.style.display = 'none';
            }
        }

        searchInput?.addEventListener('input', filterCards);
        roleFilter?.addEventListener('change', filterCards);
        statusFilter?.addEventListener('change', filterCards);
        window.addEventListener('DOMContentLoaded', filterCards);
    </script>
</body>
</html>
