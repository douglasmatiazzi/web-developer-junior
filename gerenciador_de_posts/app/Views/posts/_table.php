<?php if (count($posts) > 0): ?>
  <table class="table table-striped table-bordered align-middle">
    <thead class="table-light">
      <tr>
        <th>Nome</th>
        <th>Foto</th>
        <th>Criado por</th>
        <th>Data</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($posts as $post): ?>
        <tr>
          <td><?= esc($post->title) ?></td>
          <td>
            <?php if ($post->image): ?>
              <img src="/uploads/<?= esc($post->image) ?>" width="100" class="img-thumbnail">
            <?php else: ?>
              <span class="text-muted">Sem imagem</span>
            <?php endif; ?>
          </td>
          <td><?= esc($post->user->name ?? 'Desconhecido') ?></td>
          <td><?= date('d/m/Y H:i', strtotime($post->created_at)) ?></td>
          <td>
            <a href="/posts/show/<?= $post->id ?>" class="btn btn-info btn-sm" target="_blank">Ver</a>
            <?php if ($post->user_id == session('user_id')): ?>
              <a href="/posts/edit/<?= $post->id ?>" class="btn btn-warning btn-sm">Editar</a>
              <form action="/posts/delete/<?= $post->id ?>" method="post" class="d-inline" onsubmit="return confirm('Deseja realmente excluir este post?')">
                <?= csrf_field() ?>
                <button class="btn btn-danger btn-sm">Excluir</button>
              </form>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php else: ?>
  <div class="alert alert-secondary">Nenhum post cadastrado ainda.</div>
<?php endif; ?>
