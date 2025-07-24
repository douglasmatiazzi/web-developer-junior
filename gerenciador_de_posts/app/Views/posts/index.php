<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h1 class="mb-4">Posts do Blog</h1>

<?php if (session()->has('user_id')): ?>
    <div class="alert alert-success d-flex justify-content-between align-items-center">
        <span>Você está logado como <strong><?= esc(session('name')) ?></strong>.</span>
        <a href="/dashboard" class="btn btn-sm btn-success">Ir para o Dashboard</a>
    </div>
<?php endif; ?>

<?php if (!empty($posts)) : ?>
    <div class="row">
        <?php foreach ($posts as $post) : ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <?php if ($post->image) : ?>
                        <img src="/uploads/<?= esc($post->image) ?>" class="card-img-top" alt="Imagem do post">
                    <?php endif; ?>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= esc($post->title) ?></h5>
                        <p class="card-text text-truncate">
                            <?= strip_tags($post->content) ?>
                        </p>
                        <a href="/posts/show/<?= $post->id ?>" class="btn btn-primary mt-auto">Ler mais</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else : ?>
    <div class="alert alert-secondary">Nenhum post publicado ainda.</div>
<?php endif; ?>

<?= $this->endSection() ?>
