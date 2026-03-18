<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ofertas</title>
@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-slate-900 via-gray-900 to-slate-950 min-h-screen">

    <div class="max-w-5xl mx-auto py-10 px-4">

        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-5xl font-black text-blue-300 drop-shadow-2xl pb-2">
                Lista de Ofertas 🚀
            </h1>

            <a href="{{ route('ofertas.create') }}"
               class="bg-blue-700 hover:bg-blue-600 text-white px-6 py-3 rounded-xl shadow-xl hover:shadow-blue-600/25 text-lg font-semibold transition-all duration-300 hover:scale-[1.02]">
                + Nueva Oferta
            </a>
        </div>

        <!-- Lista -->
        <div class="grid gap-4">

            @forelse($ofertas as $oferta)
                <div class="bg-gray-800/80 backdrop-blur-sm p-6 rounded-2xl border border-slate-700 shadow-xl hover:shadow-2xl hover:border-blue-500/50 transition-all duration-300 flex justify-between items-center">

                    <!-- Info -->
                    <div>
                        @php
                            $isActive = $oferta->vigencia >= now()->format('Y-m-d');
                        @endphp
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-medium mb-2
                            {{ $isActive ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $isActive ? '🟢 Activa' : '🔴 Inactiva' }}
                        </span>

                        <h2 class="text-xl font-bold text-blue-300 drop-shadow-lg">
                            {{ $oferta->titulo ?? 'Sin título' }}
                        </h2>

                        <p class="text-sm text-slate-400">
                            ID: {{ $oferta->id }}
                        </p>
                    </div>

                    <!-- Acciones -->
                    <div class="flex gap-2">

                        <a href="{{ route('ofertas.show', $oferta->id) }}"
                           class="px-4 py-2 text-sm bg-slate-700 hover:bg-blue-800 text-slate-100 rounded-xl border border-slate-600 hover:border-blue-600 hover:shadow-lg hover:shadow-blue-600/30 transition-all font-semibold shadow-md">
                            Ver

                        </a>

                        <a href="{{ route('ofertas.edit', $oferta->id) }}"
                           class="px-4 py-2 text-sm bg-gradient-to-r from-blue-600 to-cyan-500 text-white rounded-xl border border-blue-500/50 hover:from-blue-500 shadow-xl hover:shadow-blue-500/25 transition-all font-semibold hover:scale-105">
                            Editar
                        </a>

                        <form action="{{ route('ofertas.destroy', $oferta->id) }}" method="POST" onsubmit="event.preventDefault(); confirmarEliminacion(this);">
                            @csrf
                            @method('DELETE')

                            <button
                                class="px-4 py-2 text-sm bg-gradient-to-r from-rose-500 to-red-600 text-white rounded-xl border border-rose-500/50 hover:from-rose-600 shadow-lg hover:shadow-rose-500/25 transition-all font-semibold hover:scale-105">
                                Eliminar
                            </button>
                        </form>

                    </div>

                </div>
            @empty

                <!-- Empty state -->
                <div class="bg-gray-800/80 backdrop-blur-sm p-12 rounded-2xl border border-slate-700 shadow-2xl text-center">
                    <div class="text-6xl mb-4">😢</div>
                    <p class="text-slate-400 text-xl mb-8">
                        No hay ofertas registradas aún
                    </p>

                    <a href="{{ route('ofertas.create') }}"
                       class="inline-block bg-gradient-to-r from-blue-600 to-cyan-500 text-white px-8 py-4 rounded-xl shadow-xl hover:from-blue-500 hover:shadow-blue-500/25 text-lg font-bold transition-all duration-300 hover:scale-[1.05]">
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