<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rollen Beheer</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">
    <x-layouts.app :title="'Rollen Beheer'">
        <main class="p-6">
            <header class="mb-6">
                <h1 class="text-2xl font-semibold text-black drop-shadow">Rollen Beheer</h1>
                <p class="text-sm text-gray-700">Beheer gebruikersrollen en permissies</p>
            </header>

            <!-- Action Buttons -->
            <div class="flex gap-3 mb-6">
                <a href="#" class="px-4 py-2 bg-yellow-400 text-black rounded hover:bg-yellow-500 font-bold text-sm shadow-md border border-black transition-transform duration-150 hover:scale-105">
                    + Nieuwe Rol
                </a>
                <a href="#" class="px-4 py-2 border border-black rounded text-black bg-yellow-400 hover:bg-yellow-500 font-bold text-sm transition-transform duration-150 hover:scale-105">
                    Rolgroepen
                </a>
                <a href="#" class="px-4 py-2 border border-black rounded text-black bg-yellow-400 hover:bg-yellow-500 font-bold text-sm transition-transform duration-150 hover:scale-105">
                    Permissie Instellingen
                </a>
                <div class="ml-auto">
                    <a href="{{ route('management.users.index') }}" class="px-4 py-2 border border-black text-black rounded bg-yellow-400 hover:bg-yellow-500 font-bold text-sm transition-transform duration-150 hover:scale-105">
                        👥 Bekijk Werknemers
                    </a>
                </div>
            </div>

            <!-- Search Bar -->
            <div class="mb-6">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </span>
                    <input type="text" id="searchInput" placeholder="Zoek op rol of permissie..."
                        class="w-full md:w-96 pl-10 pr-4 py-2 border border-black rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-transparent bg-white text-black placeholder-gray-400">
                </div>
            </div>

            <!-- Roles Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">
                <!-- Admin Role -->
                <div class="bg-white rounded-xl shadow-lg border border-black p-6 flex flex-col items-center transition-transform hover:scale-[1.03] hover:shadow-2xl duration-200" data-role="Admin">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="text-3xl">👑</div>
                        <div>
                            <h3 class="font-semibold text-black">Admin</h3>
                            <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 border border-blue-300">Admin</span>
                        </div>
                    </div>

                    <div class="mb-4 text-center">
                        <p class="text-sm text-gray-700">Systeembeheerder</p>
                        <p class="text-xs text-gray-500">Volledige systeem toegang met alle permissies</p>
                    </div>

                    <div class="space-y-2 mb-4 w-full">
                        <div class="flex items-start gap-2 text-sm">
                            <span class="text-green-600 mt-0.5">✓</span>
                            <span class="text-gray-700">Beheer van alle gebruikers en rollen</span>
                        </div>
                        <div class="flex items-start gap-2 text-sm">
                            <span class="text-green-600 mt-0.5">✓</span>
                            <span class="text-gray-700">Systeem configuratie en instellingen</span>
                        </div>
                        <div class="flex items-start gap-2 text-sm">
                            <span class="text-green-600 mt-0.5">✓</span>
                            <span class="text-gray-700">Audit logs en systeem rapportages</span>
                        </div>
                        <div class="flex items-start gap-2 text-sm">
                            <span class="text-green-600 mt-0.5">✓</span>
                            <span class="text-gray-700">Backup en restore functionaliteit</span>
                        </div>
                        <div class="flex items-start gap-2 text-sm">
                            <span class="text-green-600 mt-0.5">✓</span>
                            <span class="text-gray-700">API en integratie instellingen</span>
                        </div>
                    </div>

                    <div class="flex gap-2 w-full mt-auto pt-2 border-t border-black">
                        <button class="flex-1 px-3 py-2 text-sm border border-black rounded text-black bg-yellow-400 hover:bg-yellow-500 font-bold transition-transform duration-150 hover:scale-105">Bewerken</button>
                        <button class="flex-1 px-3 py-2 text-sm border border-black rounded text-black bg-yellow-400 hover:bg-yellow-500 font-bold transition-transform duration-150 hover:scale-105">Permissies</button>
                    </div>
                </div>

                <!-- Sales Role -->
                <div class="bg-white rounded-xl shadow-lg border border-black p-6 flex flex-col items-center transition-transform hover:scale-[1.03] hover:shadow-2xl duration-200" data-role="Sales">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="text-3xl">💼</div>
                        <div>
                            <h3 class="font-semibold text-black">Sales</h3>
                            <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-green-100 text-green-800 border border-green-300">Sales</span>
                        </div>
                    </div>

                    <div class="mb-4 text-center">
                        <p class="text-sm text-gray-700">Sales Medewerker</p>
                        <p class="text-xs text-gray-500">Verkoop en klantrelatie management</p>
                    </div>

                    <div class="space-y-2 mb-4 w-full">
                        <div class="flex items-start gap-2 text-sm">
                            <span class="text-green-600 mt-0.5">✓</span>
                            <span class="text-gray-700">Klantgegevens bekijken en bewerken</span>
                        </div>
                        <div class="flex items-start gap-2 text-sm">
                            <span class="text-green-600 mt-0.5">✓</span>
                            <span class="text-gray-700">Offertes aanmaken en beheren</span>
                        </div>
                        <div class="flex items-start gap-2 text-sm">
                            <span class="text-green-600 mt-0.5">✓</span>
                            <span class="text-gray-700">Contract voorstellen maken</span>
                        </div>
                        <div class="flex items-start gap-2 text-sm">
                            <span class="text-green-600 mt-0.5">✓</span>
                            <span class="text-gray-700">Verkooprapportages inzien</span>
                        </div>
                        <div class="flex items-start gap-2 text-sm">
                            <span class="text-green-600 mt-0.5">✓</span>
                            <span class="text-gray-700">Klant communicatie beheren</span>
                        </div>
                    </div>

                    <div class="flex gap-2 w-full mt-auto pt-2 border-t border-black">
                        <button class="flex-1 px-3 py-2 text-sm border border-black rounded text-black bg-yellow-400 hover:bg-yellow-500 font-bold transition-transform duration-150 hover:scale-105">Bewerken</button>
                        <button class="flex-1 px-3 py-2 text-sm border border-black rounded text-black bg-yellow-400 hover:bg-yellow-500 font-bold transition-transform duration-150 hover:scale-105">Permissies</button>
                    </div>
                </div>

                <!-- Finance Role -->
                <div class="bg-white rounded-xl shadow-lg border border-black p-6 flex flex-col items-center transition-transform hover:scale-[1.03] hover:shadow-2xl duration-200" data-role="Finance">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="text-3xl">💰</div>
                        <div>
                            <h3 class="font-semibold text-black">Finance</h3>
                            <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 border border-yellow-300">Finance</span>
                        </div>
                    </div>

                    <div class="mb-4 text-center">
                        <p class="text-sm text-gray-700">Financieel Medewerker</p>
                        <p class="text-xs text-gray-500">Financiële administratie en boekhouding</p>
                    </div>

                    <div class="space-y-2 mb-4 w-full">
                        <div class="flex items-start gap-2 text-sm">
                            <span class="text-green-600 mt-0.5">✓</span>
                            <span class="text-gray-700">Facturen aanmaken en beheren</span>
                        </div>
                        <div class="flex items-start gap-2 text-sm">
                            <span class="text-green-600 mt-0.5">✓</span>
                            <span class="text-gray-700">Betalingen verwerken</span>
                        </div>
                        <div class="flex items-start gap-2 text-sm">
                            <span class="text-green-600 mt-0.5">✓</span>
                            <span class="text-gray-700">Financiële rapportages</span>
                        </div>
                        <div class="flex items-start gap-2 text-sm">
                            <span class="text-green-600 mt-0.5">✓</span>
                            <span class="text-gray-700">Creditnota's verwerken</span>
                        </div>
                        <div class="flex items-start gap-2 text-sm">
                            <span class="text-green-600 mt-0.5">✓</span>
                            <span class="text-gray-700">BTW en belasting administratie</span>
                        </div>
                    </div>

                    <div class="flex gap-2 w-full mt-auto pt-2 border-t border-black">
                        <button class="flex-1 px-3 py-2 text-sm border border-black rounded text-black bg-yellow-400 hover:bg-yellow-500 font-bold transition-transform duration-150 hover:scale-105">Bewerken</button>
                        <button class="flex-1 px-3 py-2 text-sm border border-black rounded text-black bg-yellow-400 hover:bg-yellow-500 font-bold transition-transform duration-150 hover:scale-105">Permissies</button>
                    </div>
                </div>

                <!-- Service Role -->
                <div class="bg-white rounded-xl shadow-lg border border-black p-6 flex flex-col items-center transition-transform hover:scale-[1.03] hover:shadow-2xl duration-200" data-role="Service">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="text-3xl">🔧</div>
                        <div>
                            <h3 class="font-semibold text-black">Service</h3>
                            <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-pink-100 text-pink-800 border border-pink-300">Service</span>
                        </div>
                    </div>

                    <div class="mb-4 text-center">
                        <p class="text-sm text-gray-700">Service Medewerker</p>
                        <p class="text-xs text-gray-500">Technische ondersteuning en planning</p>
                    </div>

                    <div class="space-y-2 mb-4 w-full">
                        <div class="flex items-start gap-2 text-sm">
                            <span class="text-green-600 mt-0.5">✓</span>
                            <span class="text-gray-700">Tickets beheren en toewijzen</span>
                        </div>
                        <div class="flex items-start gap-2 text-sm">
                            <span class="text-green-600 mt-0.5">✓</span>
                            <span class="text-gray-700">Onderhoud inplannen</span>
                        </div>
                        <div class="flex items-start gap-2 text-sm">
                            <span class="text-green-600 mt-0.5">✓</span>
                            <span class="text-gray-700">Installaties registreren</span>
                        </div>
                        <div class="flex items-start gap-2 text-sm">
                            <span class="text-green-600 mt-0.5">✓</span>
                            <span class="text-gray-700">Service rapportages inzien</span>
                        </div>
                        <div class="flex items-start gap-2 text-sm">
                            <span class="text-green-600 mt-0.5">✓</span>
                            <span class="text-gray-700">Voorraad levels bekijken</span>
                        </div>
                    </div>

                    <div class="flex gap-2 w-full mt-auto pt-2 border-t border-black">
                        <button class="flex-1 px-3 py-2 text-sm border border-black rounded text-black bg-yellow-400 hover:bg-yellow-500 font-bold transition-transform duration-150 hover:scale-105">Bewerken</button>
                        <button class="flex-1 px-3 py-2 text-sm border border-black rounded text-black bg-yellow-400 hover:bg-yellow-500 font-bold transition-transform duration-150 hover:scale-105">Permissies</button>
                    </div>
                </div>
            </div>
        </main>
    </x-layouts.app>
</body>
<script>
    // Zoek- en filterfunctionaliteit voor rollenkaarten
    const searchInput = document.getElementById('searchInput');
    function filterCards() {
        const searchTerm = (searchInput?.value || '').toLowerCase();
        const cards = document.querySelectorAll('[data-role]');
        let anyVisible = false;

        cards.forEach(card => {
            const text = card.textContent.toLowerCase();
            const matchesSearch = text.includes(searchTerm);
            card.style.display = matchesSearch ? '' : 'none';
            if (matchesSearch) anyVisible = true;
        });

        // Toon of verberg de lege-staat melding
        let emptyState = document.getElementById('emptyState');
        if (!emptyState) {
            emptyState = document.createElement('div');
            emptyState.id = 'emptyState';
            emptyState.className = 'col-span-4 text-center text-yellow-500 py-12';
            emptyState.innerHTML = `
                <svg class="mx-auto h-12 w-12 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                <p class="mt-2">Geen rollen gevonden</p>
            `;
            const grid = document.querySelector('.grid');
            if (grid) grid.appendChild(emptyState);
        }
        emptyState.style.display = anyVisible ? 'none' : '';
    }
    searchInput?.addEventListener('input', filterCards);
    window.addEventListener('DOMContentLoaded', filterCards);
</script>
</html>
