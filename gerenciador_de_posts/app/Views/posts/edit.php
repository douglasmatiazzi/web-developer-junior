<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5" style="max-width: 700px;">
    <h2 class="mb-4">Editar Post</h2>

    <form action="/posts/update/<?= $post->id ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" class="form-control" name="title" id="title" value="<?= esc($post->title) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Imagem Atual</label><br>
            <?php if ($post->image): ?>
                <img src="/uploads/<?= esc($post->image) ?>" width="120" class="img-thumbnail mb-2">
            <?php else: ?>
                <p class="text-muted">Sem imagem enviada</p>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Alterar Imagem</label>
            <input type="file" class="form-control" name="image" id="image" accept="image/*">
            <div class="form-text">Deixe em branco para manter a imagem atual.</div>
        </div>

        <div class="mb-3">
            <label for="htmlFile" class="form-label">Importar conteúdo de um arquivo HTML</label>
            <input type="file" id="htmlFile" class="form-control" accept=".html,.htm">
            <div class="form-text">O conteúdo será carregado automaticamente no campo abaixo.</div>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Conteúdo (HTML permitido)</label>
            <textarea class="form-control" name="content" id="content" rows="8" required><?= esc($post->content) ?></textarea>
        </div>

        <div class="d-flex justify-content-between">
            <a href="/" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Atualizar</button>
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
