<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Oferta</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen">

<div class="max-w-3xl mx-auto py-10 px-4">


    <h1 class="text-3xl font-bold mb-6">Crear Oferta 🆕</h1>
    <a href="{{ route('ofertas.index') }}"
       class="inline-block mb-4 bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
       ← Volver al listado
    </a>

    <form action="{{ route('ofertas.store') }}" method="POST" class="bg-white p-6 rounded-xl shadow space-y-4">
        @csrf

        <input type="text" name="titulo" placeholder="Título"
               class="w-full border p-2 rounded">

        <input type="date" name="vigencia"
               class="w-full border p-2 rounded">

        <input type="text" name="tienda" placeholder="Tienda"
               class="w-full border p-2 rounded">

        <input type="number" step="0.01" name="precio_original" placeholder="Precio original"
               class="w-full border p-2 rounded">

        <input type="number" step="0.01" name="precio_descuento" placeholder="Precio descuento"
               class="w-full border p-2 rounded">

        <div class="flex justify-between">
            <a href="{{ route('ofertas.index') }}"
               class="bg-gray-400 text-white px-4 py-2 rounded">
               Cancelar
            </a>

            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Guardar
            </button>
        </div>

    </form>

</div>

</body>
</html>