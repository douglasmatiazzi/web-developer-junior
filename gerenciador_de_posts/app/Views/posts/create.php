<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5" style="max-width: 700px;">
    <h2 class="mb-4">Criar Novo Post</h2>

    <form action="/posts/store" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Imagem</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
            <div class="form-text">A imagem será enviada para a pasta <code>/public/uploads</code>.</div>
        </div>

        <div class="mb-3">
            <label for="htmlFile" class="form-label">Importar conteúdo de um arquivo HTML</label>
            <input type="file" id="htmlFile" class="form-control" accept=".html,.htm">
            <div class="form-text">O conteúdo será carregado automaticamente no campo abaixo.</div>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Conteúdo (HTML permitido)</label>
            <textarea name="content" id="content" class="form-control" rows="8" required></textarea>
        </div>

        <div class="d-flex justify-content-between">
            <a href="/dashboard" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-success">Salvar</button>
        </div>
    </form>
</div>

<script>
document.getElementById('htmlFile').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file && file.name.endsWith('.html')) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('content').value = e.target.result;
        };
        reader.readAsText(file);
    }
});
</script>

<?= $this->endSection() ?>
