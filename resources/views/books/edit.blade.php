<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/edit_styles.css') }}">
    <div class="form-container">
        <form method="POST" action="{{ route('books.update', $book) }}">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="title">Título</label>
                <input type="text" id="title" name="title" value="{{ $book->title }}" required>
            </div>
            <div class="form-group">
                <label for="author">Autor</label>
                <input type="text" id="author" name="author" value="{{ $book->author }}" required>
            </div>
            <div class="form-group">
                <label for="publication_year">Año de Publicación</label>
                <input type="number" id="publication_year" name="publication_year" value="{{ $book->publication_year }}" required>
            </div>
            <div class="form-group">
                <label for="synopsis">Sinopsis</label>
                <textarea id="synopsis" name="synopsis" required>{{ $book->synopsis }}</textarea>
            </div>
            <div class="form-group">
                <label for="cover_url">URL de la Portada</label>
                <input type="url" id="cover_url" name="cover_url" value="{{ $book->cover_url }}">
            </div>
            <div class="button-container">
                <button type="submit" class="button button-primary">Guardar</button>
                <a href="{{ route('books.index') }}" class="button button-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</x-app-layout>
