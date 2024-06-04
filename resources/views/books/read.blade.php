<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/read_styles.css') }}">
    <div class="container">
        <h1 class="text-2xl font-semibold mb-4">Libros Leídos</h1>
        <div class="mt-6">
            @forelse ($booksRead as $book)
                <div class="book-card">
                    <div class="book-details">
                        <h2 class="book-title">{{ $book->title }}</h2>
                        <p class="book-author">por {{ $book->author }} ({{ $book->publication_year }})</p>
                        <p class="book-synopsis">{{ Str::limit($book->synopsis, 150) }}</p>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('books.show', $book) }}" class="button button-blue">Ver detalles</a>
                        <a href="{{ route('books.edit', $book) }}" class="button button-yellow">Editar</a>
                        <form method="POST" action="{{ route('books.destroy', $book) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="button button-red">Eliminar</button>
                        </form>
                        <form method="POST" action="{{ route('books.toggleReadStatus', $book) }}">
                            @csrf
                            @method('patch')
                            <button type="submit" class="button button-green">
                                Marcar como {{ $book->is_read ? 'Pendiente' : 'Leído' }}
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p>No hay libros leídos.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
