<script src="https://cdn.tailwindcss.com"></script>
<div class="max-w-3xl mx-auto p-6">

  <!-- Top Section -->
  <header class="mb-6">
    <h1 class="text-2xl font-semibold">Klant bewerken</h1>
    <p class="text-gray-500">Werk klantgegevens bij</p>
  </header>

  <!-- Edit Form -->
  <div class="bg-white border border-gray-200 rounded-lg p-6 mb-8">

    <form
      action="{{ route('customers.update', ['customer' => $customer->id]) }}"
      method="POST"
      class="flex flex-col gap-5"
    >
      @csrf
      @method('PUT')

      <!-- Form Fields -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        <div class="flex flex-col gap-1">
          <label for="name_company" class="font-medium text-gray-700 text-sm">Bedrijfsnaam</label>
          <input
            type="text"
            id="name_company"
            name="name_company"
            placeholder="Bedrijfsnaam"
            value="{{ $customer->name_company }}"
            class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-blue-500 focus:border-blue-500"
            required
          >
        </div>

        <div class="flex flex-col gap-1">
          <label for="contact_person" class="font-medium text-gray-700 text-sm">Contactpersoon</label>
          <input
            type="text"
            id="contact_person"
            name="contact_person"
            placeholder="Contactpersoon"
            value="{{ $customer->contact_person }}"
            class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-blue-500 focus:border-blue-500"
            required
          >
        </div>

        <div class="flex flex-col gap-1">
          <label for="email" class="font-medium text-gray-700 text-sm">E-mail</label>
          <input
            type="email"
            id="email"
            name="email"
            placeholder="E-mailadres"
            value="{{ $customer->email }}"
            class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-blue-500 focus:border-blue-500"
            required
          >
        </div>

        <div class="flex flex-col gap-1">
          <label for="phone_number" class="font-medium text-gray-700 text-sm">Telefoonnummer</label>
          <input
            type="tel"
            id="phone_number"
            name="phone_number"
            placeholder="Telefoonnummer"
            value="{{ $customer->phone_number }}"
            class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-blue-500 focus:border-blue-500"
            required
          >
        </div>

        <div class="flex flex-col gap-1 md:col-span-2">
          <label for="bkr_number" class="font-medium text-gray-700 text-sm">BKR Nummer</label>
          <input
            type="text"
            id="bkr_number"
            name="bkr_number"
            placeholder="BKR Nummer"
            value="{{ $customer->bkr_number }}"
            class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-blue-500 focus:border-blue-500"
          >
        </div>

      </div>

      <!-- Save Button -->
      <button
        type="submit"
        class="mt-2 bg-blue-600 text-white py-2.5 rounded-md text-sm font-medium hover:bg-blue-700 transition"
      >
        Wijzigingen opslaan
      </button>
    </form>
  </div>

  <!-- Delete Form -->
  <div class="bg-red-50 border border-red-200 rounded-lg p-6">
    <h3 class="text-lg font-semibold text-red-700 mb-2">Klant verwijderen</h3>
    <p class="text-gray-600 mb-4 text-sm">Dit kan niet ongedaan worden gemaakt. Weet je het zeker?</p>

    <form
      action="{{ route('customers.destroy', ['customer' => $customer->id]) }}"
      method="POST"
    >
      @csrf
      @method('DELETE')

      <button
        type="submit"
        class="bg-red-600 text-white py-2 px-4 rounded-md text-sm font-medium hover:bg-red-700 transition"
      >
        Klant verwijderen
      </button>
    </form>
  </div>

</div>
