<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Oferta</title>
@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">

<div class="max-w-3xl mx-auto py-10 px-4">

    <h1 class="text-3xl font-bold mb-6">Editar Oferta ✏️ #{{ $oferta->id }}</h1>
    <a href="{{ route('ofertas.index') }}"
       class="inline-block mb-4 bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
       ← Volver al listado
    </a>

    <form action="{{ route('ofertas.update', $oferta->id) }}" method="POST" class="bg-white p-6 rounded-xl shadow space-y-4">
        @csrf
        @method('PUT')

        <input type="text" name="titulo" placeholder="Título" value="{{ $oferta->titulo ?? old('titulo') }}"
               class="w-full border p-2 rounded @error('titulo') border-red-500 @enderror">
        @error('titulo')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <input type="date" name="vigencia" value="{{ $oferta->vigencia ?? old('vigencia') }}"
               class="w-full border p-2 rounded @error('vigencia') border-red-500 @enderror">
        @error('vigencia')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <input type="text" name="tienda" placeholder="Tienda" value="{{ $oferta->tienda ?? old('tienda') }}"
               class="w-full border p-2 rounded @error('tienda') border-red-500 @enderror">
        @error('tienda')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <input type="number" step="0.01" name="precio_original" placeholder="Precio original"
               value="{{ $oferta->precio_original ?? old('precio_original') }}"
               class="w-full border p-2 rounded @error('precio_original') border-red-500 @enderror">
        @error('precio_original')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <input type="number" step="0.01" name="precio_descuento" placeholder="Precio descuento"
               value="{{ $oferta->precio_descuento ?? old('precio_descuento') }}"
               class="w-full border p-2 rounded @error('precio_descuento') border-red-500 @enderror">
        @error('precio_descuento')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <div class="flex justify-between">
            <a href="{{ route('ofertas.index') }}"
               class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-400/80">
               Cancelar
            </a>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Actualizar
            </button>
        </div>

    </form>

</div>

</body>
</html>
