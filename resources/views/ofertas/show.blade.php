<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles Oferta #{{ $oferta->id }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">

<div class="max-w-2xl mx-auto py-10 px-4">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Detalles de Oferta</h1>
            <p class="text-lg text-gray-600">#{{ $oferta->id }}</p>
        </div>
        <a href="{{ route('ofertas.index') }}"
           class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition">
           ← Volver al listado
        </a>
    </div>

    <!-- Status Badge -->
    @php
        $isActive = $oferta->vigencia >= now()->format('Y-m-d');
    @endphp
    <div class="mb-6">
        <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold
            {{ $isActive ? 'bg-green-100 text-green-800 shadow-md' : 'bg-red-100 text-red-800 shadow-md' }}">
            {{ $isActive ? '🟢 ACTIVA hasta ' . \Carbon\Carbon::parse($oferta->vigencia)->format('d/m/Y') : '🔴 CADUCADA el ' . \Carbon\Carbon::parse($oferta->vigencia)->format('d/m/Y') }}
        </span>
    </div>

    <!-- Main Card -->
    <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition">

        <div class="space-y-6">

            <!-- Título -->
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Título</label>
                <p class="text-2xl font-bold text-gray-900">{{ $oferta->titulo ?? 'Sin título' }}</p>
            </div>

            <!-- Tienda -->
            <div class="flex justify-between">
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Tienda</label>
                    <p class="text-xl font-semibold text-gray-900">{{ $oferta->tienda ?? 'N/A' }}</p>
                </div>
            </div>

            <!-- Precios -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 rounded-xl border">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-gray-500">Precio Original</span>
                </div>
                <div class="flex items-baseline gap-4 mb-4">
                    <span class="text-3xl font-bold text-gray-900 line-through">${{ number_format($oferta->precio_original ?? 0, 2) }}</span>
                </div>

                <div class="flex items-center justify-between mb-4">
                    <span class="text-sm font-medium text-gray-500">Precio Descuento</span>
                </div>
                <div class="flex items-baseline gap-4">
                    <span class="text-4xl font-bold bg-gradient-to-r from-green-500 to-emerald-600 text-white px-4 py-2 rounded-lg shadow-lg">
                        ${{ number_format($oferta->precio_descuento ?? 0, 2) }}
                    </span>
                    @if($oferta->precio_original && $oferta->precio_original > 0)
                        <span class="text-xl font-bold text-green-600">
                            {{ number_format((($oferta->precio_original - $oferta->precio_descuento) / $oferta->precio_original) * 100, 0) }}% OFF
                        </span>
                    @endif
                </div>
            </div>

            <!-- Vigencia -->
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Vigencia</label>
                <p class="text-lg font-semibold text-gray-900">
                    {{ \Carbon\Carbon::parse($oferta->vigencia)->format('d/m/Y') }}
                </p>
            </div>

        </div>

    </div>

    <!-- Actions -->
    <div class="flex gap-3 mt-8 justify-center">
        <a href="{{ route('ofertas.edit', $oferta->id) }}"
           class="flex-1 max-w-xs bg-yellow-400 text-white py-3 px-6 rounded-lg text-center font-medium hover:bg-yellow-500 shadow transition">
           Editar Oferta ✏️
        </a>

        <form action="{{ route('ofertas.destroy', $oferta->id) }}" method="POST" 
              class="flex-1 max-w-xs" onsubmit="event.preventDefault(); confirmarEliminacion(this);">
            @csrf @method('DELETE')
            <button class="w-full bg-red-500 text-white py-3 px-6 rounded-lg font-medium hover:bg-red-600 shadow transition">
                Eliminar 🚮
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
