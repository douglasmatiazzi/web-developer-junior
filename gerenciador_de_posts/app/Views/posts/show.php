<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5" style="max-width: 800px;">
    <h2 class="mb-4"><?= esc($post->title) ?></h2>

    <?php if (!empty($post->image)): ?>
        <img src="/uploads/<?= esc($post->image) ?>" alt="Imagem do Post" class="img-fluid rounded mb-3">
    <?php endif; ?>

    <div class="mb-4">
        <?= $post->content ?> <!-- HTML renderizado diretamente -->
    </div>
</div>

<?= $this->endSection() ?>
