<!-- resources/views/noticias/create.blade.php -->
<form method="POST" action="{{ route('noticias.store') }}">
    @csrf
    <label for="titulo">Título:</label>
    <input type="text" name="titulo" id="titulo" required>
    <label for="contenido">Contenido:</label>
    <textarea name="contenido" id="contenido" required></textarea>
    <button type="submit">Crear Noticia</button>
</form>
