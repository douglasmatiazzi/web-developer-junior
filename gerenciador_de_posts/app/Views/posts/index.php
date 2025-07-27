<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php if (session()->has('user_id')): ?>
    <h2>Bem Vindo(a), <?= esc(session('name')) ?>!</h2>
    <p>Você está logado(a) pelo e-mail: <strong><?= esc(session('email')) ?></strong>.</p>
<?php else: ?>
    <h2>Bem Vindo!</h2>
    <p class="text-danger">Você não está logado. Algumas funções podem estar indisponíveis.</p>
<?php endif; ?>

<hr>

<div class="d-flex justify-content-between align-items-center mb-3">
  <h4 class="mb-0">Posts</h4>
  <div>
    <a href="/posts/create" class="btn btn-primary">Novo Post</a>    
  </div>
</div>

<!-- Filtros -->
<form method="get" class="mb-4">
  <div class="row gy-2 gx-2 align-items-end">
    <div class="col-12 col-md-5">
      <label for="busca" class="form-label mb-1">Buscar:</label>
      <input type="text" id="busca" name="q" class="form-control"
        placeholder="Título ou conteúdo..." value="<?= esc($q ?? '') ?>">
    </div>
    <div class="col-6 col-md-3">
      <label for="autor" class="form-label mb-1">Autor:</label>
      <select id="autor" name="creator" class="form-select">
        <option value="">Todos</option>
        <?php foreach ($users as $user): ?>
          <option value="<?= $user->id ?>" <?= ($creator ?? '') == $user->id ? 'selected' : '' ?>>
            <?= esc($user->name) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-6 col-md-2">
      <label for="ordem" class="form-label mb-1">Ordenar:</label>
      <select id="ordem" name="order" class="form-select">
        <option value="desc" <?= ($order ?? 'desc') === 'desc' ? 'selected' : '' ?>>Mais recentes</option>
        <option value="asc" <?= ($order ?? '') === 'asc' ? 'selected' : '' ?>>Mais antigos</option>
      </select>
    </div>
    <div class="col-12 col-md-2">
      <button type="submit" class="btn btn-outline-secondary w-100">
        <i class="bi bi-search"></i> Filtrar
      </button>
    </div>
  </div>
</form>

<!-- Aqui entra a partial dinâmica -->
<div id="posts-tabela">
    <?= view('posts/_table', ['posts' => $posts]) ?>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(function() {
    let timer = null;
    $('#busca').on('input', function() {
        clearTimeout(timer);
        timer = setTimeout(filtrar, 300);
    });
    $('#autor, #ordem').on('change', filtrar);

    function filtrar() {
        const q = $('#busca').val();
        const creator = $('#autor').val();
        const order = $('#ordem').val();
        $.get('/posts/search/ajax', { q, creator, order }, function(html) {
            $('#posts-tabela').html(html);
        });
    }
});
</script>

<?= $this->endSection() ?>
