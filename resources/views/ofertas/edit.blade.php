<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Oferta</title>
@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-slate-900 via-gray-900 to-slate-950 min-h-screen">

<div class="max-w-3xl mx-auto py-10 px-4">

    <h1 class="text-4xl font-black bg-gradient-to-r from-orange-400 via-amber-400 to-orange-500 bg-clip-text text-transparent drop-shadow-2xl mb-6">Editar Oferta #{{ $oferta->id }}</h1>
    <a href="{{ route('ofertas.index') }}"
       class="inline-block mb-6 bg-slate-800/80 hover:bg-slate-700 text-slate-100 px-6 py-3 rounded-xl border border-slate-600 backdrop-blur-sm shadow-lg hover:shadow-blue-500/30 transition-all font-semibold">
       ← Volver al listado
    </a>

    <form action="{{ route('ofertas.update', $oferta->id) }}" method="POST" class="bg-gray-800/80 backdrop-blur-sm p-8 rounded-2xl border border-slate-700 shadow-2xl space-y-6">
        @csrf
        @method('PUT')

        <input type="text" name="titulo" placeholder="Título de la oferta..." value="{{ $oferta->titulo ?? old('titulo') }}"
               class="w-full bg-slate-800/50 border border-slate-600 p-4 rounded-xl text-slate-100 placeholder-slate-400 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/50 focus:bg-slate-800/80 transition-all duration-300 @error('titulo') border-rose-500 ring-2 ring-rose-500/50 @enderror">
        @error('titulo')
            <p class="text-rose-400 text-sm font-medium animate-pulse">{{ $message }}</p>
        @enderror

        <input type="date" name="vigencia" value="{{ $oferta->vigencia ?? old('vigencia') }}"
               class="w-full bg-slate-800/50 border border-slate-600 p-4 rounded-xl text-slate-100 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 focus:bg-slate-800/80 transition-all duration-300 @error('vigencia') border-rose-500 ring-2 ring-rose-500/50 @enderror">
        @error('vigencia')
            <p class="text-rose-400 text-sm font-medium animate-pulse">{{ $message }}</p>
        @enderror

        <input type="text" name="tienda" placeholder="Nombre de la tienda..." value="{{ $oferta->tienda ?? old('tienda') }}"
               class="w-full bg-slate-800/50 border border-slate-600 p-4 rounded-xl text-slate-100 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 focus:bg-slate-800/80 transition-all duration-300 @error('tienda') border-rose-500 ring-2 ring-rose-500/50 @enderror">
        @error('tienda')
            <p class="text-rose-400 text-sm font-medium animate-pulse">{{ $message }}</p>
        @enderror

        <input type="number" step="0.01" name="precio_original" placeholder="$99.99"
               value="{{ $oferta->precio_original ?? old('precio_original') }}"
               class="w-full bg-slate-800/50 border border-slate-600 p-4 rounded-xl text-slate-100 placeholder-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/50 focus:bg-slate-800/80 transition-all duration-300 @error('precio_original') border-rose-500 ring-2 ring-rose-500/50 @enderror">
        @error('precio_original')
            <p class="text-rose-400 text-sm font-medium animate-pulse">{{ $message }}</p>
        @enderror

        <input type="number" step="0.01" name="precio_descuento" placeholder="$79.99"
               value="{{ $oferta->precio_descuento ?? old('precio_descuento') }}"
               class="w-full bg-slate-800/50 border border-slate-600 p-4 rounded-xl text-slate-100 placeholder-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/50 focus:bg-slate-800/80 transition-all duration-300 @error('precio_descuento') border-rose-500 ring-2 ring-rose-500/50 @enderror">
        @error('precio_descuento')
            <p class="text-rose-400 text-sm font-medium animate-pulse">{{ $message }}</p>
        @enderror

        <div class="flex justify-between">
            <a href="{{ route('ofertas.index') }}"
               class="flex-1 bg-slate-700/80 hover:bg-slate-600 text-slate-200 px-8 py-3 rounded-xl border border-slate-600 font-semibold transition-all hover:scale-[1.02] hover:border-slate-500">
               Cancelar
            </a>

            <button type="submit" class="flex-1 bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 text-white px-8 py-3 rounded-xl shadow-xl hover:shadow-blue-500/25 font-bold text-lg transition-all duration-300 hover:scale-[1.02]">
                Actualizar Oferta
            </button>
        </div>

    </form>

</div>

</body>
</html>
