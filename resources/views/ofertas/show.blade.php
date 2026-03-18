<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles Oferta #{{ $oferta->id }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-slate-900 via-gray-900 to-slate-950 min-h-screen">

<div class="max-w-2xl mx-auto py-10 px-4">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-4xl font-black bg-gradient-to-r from-blue-400 via-blue-300 to-cyan-400 bg-clip-text text-transparent drop-shadow-2xl">Detalles Oferta</h1>
            <p class="text-xl text-slate-300 font-semibold">#{{ $oferta->id }}</p>
        </div>
        <a href="{{ route('ofertas.index') }}"
           class="bg-slate-800/80 hover:bg-slate-700 text-slate-100 px-6 py-3 rounded-xl border border-slate-600 backdrop-blur-sm shadow-lg hover:shadow-blue-500/30 transition-all font-semibold">
           ← Volver al listado
        </a>
    </div>

    <!-- Status Badge -->
    @php
        $isActive = $oferta->vigencia >= now()->format('Y-m-d');
    @endphp
    <div class="mb-6">
        <span class="inline-block px-6 py-3 rounded-full text-lg font-bold shadow-lg ring-2
            {{ $isActive ? 'bg-gradient-to-r from-emerald-500 to-teal-500 text-white shadow-emerald-500/50 ring-emerald-500/30' : 'bg-gradient-to-r from-rose-500 to-red-600 text-white shadow-rose-500/50 ring-rose-500/30' }}">
            {{ $isActive ? '🟢 ACTIVA hasta ' . \Carbon\Carbon::parse($oferta->vigencia)->format('d/m/Y') : '🔴 CADUCADA el ' . \Carbon\Carbon::parse($oferta->vigencia)->format('d/m/Y') }}
        </span>
    </div>

    <!-- Main Card -->
    <div class="bg-gray-800/80 backdrop-blur-sm p-10 rounded-3xl border border-slate-700 shadow-2xl hover:shadow-blue-500/20 ring-1 ring-slate-700/50 transition-all duration-500 hover:scale-[1.01]">

        <div class="space-y-6">

            <!-- Título -->
            <div>
                <label class="block text-sm font-medium text-slate-400 mb-2">Título</label>
                <p class="text-3xl font-black bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent drop-shadow-lg">{{ $oferta->titulo ?? 'Sin título' }}</p>
            </div>

            <!-- Tienda -->
            <div class="flex justify-between">
                <div>
                    <label class="block text-sm font-medium text-slate-400 mb-2">Tienda</label>
                    <p class="text-2xl font-bold text-slate-100 drop-shadow-md">{{ $oferta->tienda ?? 'N/A' }}</p>
                </div>
            </div>

            <!-- Precios -->
            <div class="bg-gradient-to-r from-slate-800/50 to-slate-700/30 p-8 rounded-2xl border border-slate-600/50 backdrop-blur-sm shadow-2xl">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-lg font-semibold text-slate-400">Precio Original</span>
                </div>
                <div class="flex items-baseline gap-6 mb-6">
                    <span class="text-4xl font-black text-slate-400 line-through tracking-wide drop-shadow-lg">${{ number_format($oferta->precio_original ?? 0, 2) }}</span>
                </div>

                <div class="flex items-center justify-between mb-6">
                    <span class="text-lg font-semibold text-slate-400">Precio Final</span>
                </div>
                <div class="flex items-baseline gap-6">
                    <span class="text-6xl font-black bg-gradient-to-r from-emerald-400 via-teal-400 to-emerald-500 text-white px-8 py-4 rounded-2xl shadow-2xl ring-4 ring-emerald-500/30 drop-shadow-2xl">
                        ${{ number_format($oferta->precio_descuento ?? 0, 2) }}
                    </span>
                    @if($oferta->precio_original && $oferta->precio_original > 0)
                        <span class="text-2xl font-black bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-6 py-3 rounded-xl shadow-lg ring-2 ring-emerald-400 drop-shadow-lg">
                            {{ number_format((($oferta->precio_original - $oferta->precio_descuento) / $oferta->precio_original) * 100, 0) }}% OFF
                        </span>
                    @endif
                </div>
            </div>

            <!-- Vigencia -->
            <div>
                <label class="block text-sm font-medium text-slate-400 mb-2">Vigencia</label>
                <p class="text-2xl font-bold text-slate-200 tracking-wide">
                    {{ \Carbon\Carbon::parse($oferta->vigencia)->format('d/m/Y') }}
                </p>
            </div>

        </div>

    </div>

    <!-- Actions -->
    <div class="flex gap-3 mt-8 justify-center">
        <a href="{{ route('ofertas.edit', $oferta->id) }}"
           class="flex-1 max-w-xs bg-gradient-to-r from-blue-600 to-cyan-500 text-white py-4 px-8 rounded-2xl text-center font-bold text-lg hover:from-blue-500 shadow-2xl hover:shadow-blue-500/25 transition-all duration-300 hover:scale-[1.05]">
            Editar Oferta
        </a>

        <form action="{{ route('ofertas.destroy', $oferta->id) }}" method="POST" 
              class="flex-1 max-w-xs" onsubmit="event.preventDefault(); confirmarEliminacion(this);">
            @csrf @method('DELETE')
            <button class="w-full bg-gradient-to-r from-rose-500 to-red-600 text-white py-4 px-8 rounded-2xl font-bold text-lg hover:from-rose-600 shadow-2xl hover:shadow-rose-500/25 transition-all duration-300 hover:scale-[1.05]">
                Eliminar
            </button>
        </form>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmarEliminacion(form) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Esta oferta será eliminada permanentemente",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e3342f',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}
</script>

</body>
</html>
