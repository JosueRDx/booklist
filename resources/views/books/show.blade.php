<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/show_styles.css') }}">
    <div class="container">
        <div class="book-card">
            @if ($book->cover_url)
                <img src="{{ $book->cover_url }}" alt="Portada del libro">
            @endif
            <div class="book-card-content">
                <h1 class="book-card-title">{{ $book->title }}</h1>
                <p class="book-card-author">Autor: {{ $book->author }}</p>
                <p class="book-card-year">Año de publicación: {{ $book->publication_year }}</p>
                <p class="book-card-synopsis">{{ $book->synopsis }}</p>
                <div class="button-container">
                    <a href="{{ route('books.index') }}" class="button button-blue">Volver a la lista</a>
                    <a href="{{ route('books.edit', $book) }}" class="button button-yellow">Editar</a>
                    <form method="POST" action="{{ route('books.destroy', $book) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="button button-red">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
