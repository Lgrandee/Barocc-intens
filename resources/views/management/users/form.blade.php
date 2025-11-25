<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($user) ? 'Werknemer Bewerken' : 'Nieuwe Werknemer' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <x-layouts.app :title="isset($user) ? 'Werknemer Bewerken' : 'Nieuwe Werknemer'">
        <main class="p-6">
            <div class="max-w-4xl mx-auto">
                <!-- Header -->
                <div class="mb-6">
                    <div class="flex items-center gap-3 mb-2">
                        <a href="{{ route('management.users.index') }}" class="text-gray-600 hover:text-gray-900">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </a>
                        <h1 class="text-2xl font-semibold text-gray-900">
                            {{ isset($user) ? 'Werknemer Bewerken' : 'Nieuwe Werknemer Aanmaken' }}
                        </h1>
                    </div>
                    <p class="text-sm text-gray-500 ml-8">
                        {{ isset($user) ? 'Pas de werknemergegevens aan' : 'Vul de gegevens in voor de nieuwe werknemer' }}
                    </p>
                </div>

                <!-- Form -->
                <form action="{{ isset($user) ? route('management.users.update', $user->id) : route('management.users.store') }}"
                      method="POST" enctype="multipart/form-data" class="bg-white rounded-lg border border-gray-200 p-6">
                    @csrf
                    @if(isset($user))
                        @method('PUT')
                    @endif

                    <!-- Profile Picture -->
                    <div class="mb-6 pb-6 border-b">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Profielfoto</label>
                        <div class="flex items-center gap-4">
                            <div class="h-20 w-20 rounded-full overflow-hidden bg-gray-100 flex items-center justify-center">
                                @php
                                    $colors = ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6', '#ec4899', '#14b8a6'];
                                    $avatarColor = isset($user) ? $colors[$user->id % count($colors)] : '#6366f1';
                                @endphp
                                <div id="avatarPreview" class="h-full w-full flex items-center justify-center text-white font-bold text-2xl"
                                     style="background-color: {{ $avatarColor }}">
                                    {{ isset($user) ? strtoupper(substr($user->name, 0, 1)) : '?' }}
                                </div>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Avatar wordt automatisch gegenereerd op basis van de eerste letter van de naam.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Personal Information -->
                    <div class="mb-6 pb-6 border-b">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Persoonlijke Gegevens</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Volledige Naam <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                    placeholder="Jan Smit">
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    E-mailadres <span class="text-red-500">*</span>
                                </label>
                                <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                    placeholder="jan.smit@bedrijf.nl">
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Telefoonnummer
                                </label>
                                <input type="tel" name="phone_num" value="{{ old('phone_num', $user->phone_num ?? '') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                    placeholder="+31 6 12345678">
                                @error('phone_num')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Werknemer ID
                                </label>
                                <input type="text" value="#{{ isset($user) ? str_pad($user->id, 3, '0', STR_PAD_LEFT) : 'Automatisch' }}" disabled
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-500">
                            </div>
                        </div>
                    </div>

                    <!-- Role and Access -->
                    <div class="mb-6 pb-6 border-b">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Rol en Toegang</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Rol/Afdeling <span class="text-red-500">*</span>
                                </label>
                                <select name="department" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                    <option value="">Selecteer rol...</option>
                                    <option value="Sales" {{ (old('department', $user->department ?? '') === 'Sales') ? 'selected' : '' }}>Sales - Verkoop medewerker</option>
                                    <option value="Purchasing" {{ (old('department', $user->department ?? '') === 'Purchasing') ? 'selected' : '' }}>Purchasing - Inkoop medewerker</option>
                                    <option value="Finance" {{ (old('department', $user->department ?? '') === 'Finance') ? 'selected' : '' }}>Finance - Financieel medewerker</option>
                                    <option value="Technician" {{ (old('department', $user->department ?? '') === 'Technician') ? 'selected' : '' }}>Technician - Technische dienst</option>
                                    <option value="Planner" {{ (old('department', $user->department ?? '') === 'Planner') ? 'selected' : '' }}>Planner - Planning medewerker</option>
                                    <option value="Management" {{ (old('department', $user->department ?? '') === 'Management') ? 'selected' : '' }}>Management - Management</option>
                                </select>
                                @error('department')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Status <span class="text-red-500">*</span>
                                </label>
                                <select name="status" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                    <option value="active" {{ (old('status', $user->status ?? 'active') === 'active') ? 'selected' : '' }}>🟢 Actief</option>
                                    <option value="vacation" {{ (old('status', $user->status ?? '') === 'vacation') ? 'selected' : '' }}>🟡 Vakantie</option>
                                    <option value="inactive" {{ (old('status', $user->status ?? '') === 'inactive') ? 'selected' : '' }}>🔴 Inactief</option>
                                </select>
                                @error('status')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Password Section -->
                    @if(!isset($user))
                    <div class="mb-6 pb-6 border-b">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Wachtwoord</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Wachtwoord <span class="text-red-500">*</span>
                                </label>
                                <input type="password" name="password" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                    placeholder="••••••••">
                                <p class="text-xs text-gray-500 mt-1">Minimaal 8 karakters</p>
                                @error('password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Bevestig Wachtwoord <span class="text-red-500">*</span>
                                </label>
                                <input type="password" name="password_confirmation" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                    placeholder="••••••••">
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="mb-6 pb-6 border-b">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Wachtwoord Wijzigen (optioneel)</h3>
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                            <p class="text-sm text-blue-800">Laat leeg om het huidige wachtwoord te behouden.</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Nieuw Wachtwoord
                                </label>
                                <input type="password" name="password"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                    placeholder="••••••••">
                                <p class="text-xs text-gray-500 mt-1">Minimaal 8 karakters</p>
                                @error('password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Bevestig Nieuw Wachtwoord
                                </label>
                                <input type="password" name="password_confirmation"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                    placeholder="••••••••">
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Additional Options -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Extra Opties</h3>
                        <div class="space-y-3">
                            <label class="flex items-center">
                                <input type="checkbox" name="send_welcome_email" value="1" checked
                                    class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                <span class="ml-2 text-sm text-gray-700">Stuur welkomst e-mail naar werknemer</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="force_password_change" value="1"
                                    class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                <span class="ml-2 text-sm text-gray-700">Verplicht wachtwoord wijzigen bij eerste login</span>
                            </label>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-3 justify-end pt-6 border-t">
                        <a href="{{ route('management.users.index') }}"
                            class="px-6 py-2 border border-gray-300 rounded text-gray-700 hover:bg-gray-50">
                            Annuleren
                        </a>
                        @if(isset($user))
                            <button type="button" onclick="confirmDelete()"
                                class="px-6 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                Verwijderen
                            </button>
                        @endif
                        <button type="submit"
                            class="px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                            {{ isset($user) ? 'Wijzigingen Opslaan' : 'Werknemer Aanmaken' }}
                        </button>
                    </div>
                </form>

                @if(isset($user))
                <!-- Delete Form (hidden) -->
                <form id="deleteForm" action="{{ route('management.users.destroy', $user->id) }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
                @endif
            </div>
        </main>
    </x-layouts.app>

    <script>
        // Delete confirmation
        function confirmDelete() {
            if (confirm('Weet je zeker dat je deze werknemer wilt verwijderen? Deze actie kan niet ongedaan worden gemaakt.')) {
                document.getElementById('deleteForm').submit();
            }
        }
    </script>
</body>
</html>
