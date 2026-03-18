<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ofertas</title>
@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="max-w-5xl mx-auto py-10 px-4">

        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">
                Lista de Ofertas 🚀
            </h1>

            <a href="{{ route('ofertas.create') }}"
               class="bg-blue-600 text-white px-5 py-2 rounded-lg shadow hover:bg-blue-700 transition">
                + Nueva Oferta
            </a>
        </div>

        <!-- Lista -->
        <div class="grid gap-4">

            @forelse($ofertas as $oferta)
                <div class="bg-white p-5 rounded-xl shadow hover:shadow-md transition flex justify-between items-center">

                    <!-- Info -->
                    <div>
                        @php
                            $isActive = $oferta->vigencia >= now()->format('Y-m-d');
                        @endphp
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-medium mb-2
                            {{ $isActive ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $isActive ? '🟢 Activa' : '🔴 Inactiva' }}
                        </span>

                        <h2 class="text-lg font-semibold text-gray-800">
                            {{ $oferta->titulo ?? 'Sin título' }}
                        </h2>

                        <p class="text-sm text-gray-500">
                            ID: {{ $oferta->id }}
                        </p>
                    </div>

                    <!-- Acciones -->
                    <div class="flex gap-2">

                        <a href="{{ route('ofertas.show', $oferta->id) }}"
                           class="px-3 py-1 text-sm bg-gray-200 rounded hover:bg-gray-300">
                            Ver
                        </a>

                        <a href="{{ route('ofertas.edit', $oferta->id) }}"
                           class="px-3 py-1 text-sm bg-yellow-400 text-white rounded hover:bg-yellow-500">
                            Editar
                        </a>

                        <form action="{{ route('ofertas.destroy', $oferta->id) }}" method="POST" onsubmit="event.preventDefault(); confirmarEliminacion(this);">
                            @csrf
                            @method('DELETE')

                            <button
                                class="px-3 py-1 text-sm bg-red-500 text-white rounded hover:bg-red-600">
                                Eliminar
                            </button>
                        </form>

                    </div>

                </div>
            @empty

                <!-- Empty state -->
                <div class="bg-white p-10 rounded-xl shadow text-center">
                    <p class="text-gray-500 text-lg">
                        No hay ofertas registradas 😢
                    </p>

                    <a href="{{ route('ofertas.create') }}"
                       class="inline-block mt-4 bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
                        Crear primera oferta
                    </a>
                </div>

            @endforelse

        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmarEliminacion(form) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Esta acción no se puede deshacer",
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