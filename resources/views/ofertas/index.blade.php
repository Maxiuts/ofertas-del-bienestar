<h1>Lista de Ofertas</h1>

<ul>
    @foreach($ofertas as $oferta)
        <li>{{ $oferta->titulo ?? 'Sin título' }}</li>
    @endforeach
</ul>