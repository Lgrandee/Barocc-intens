<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main>

    </flux:main>
</x-layouts.app.sidebar>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white">
    <div class="min-h-screen bg-white">
        <!-- Top 3 Divs -->
        <div class="flex justify-center gap-6 p-8">
            <div class="bg-white rounded-lg shadow-md p-6 w-80 border border-gray-200">
                <p class="text-gray-700">Sales deze week</p>
                <p class="text-black text-xl font-bold">€ 15.300</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6 w-80 border border-gray-200">
                <p class="text-gray-700">Widget 2</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6 w-80 border border-gray-200">
                <p class="text-gray-700">Nieuwe klanten deze week</p>
            </div>
        </div>

        <!-- Bottom Wide Div -->
        <div class="flex justify-center px-8 pb-8">
            <div class="bg-white rounded-lg shadow-md p-6 w-full max-w-5xl border border-gray-200">
                <p class="text-gray-700">Welcome to the sales dashboard!</p>
            </div>
        </div>
    </div>
</body>
</html>
