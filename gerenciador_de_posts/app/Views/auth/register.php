<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5" style="max-width: 500px;">
    <h2 class="mb-4 text-center">Criar Conta</h2>

    <?php if (session()->getFlashdata('success')): ?>
      <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <?php if (isset($validation)): ?>
      <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
    <?php endif; ?>

    <form method="post" action="/register">
      <?= csrf_field() ?>

      <div class="mb-3">
        <label for="name" class="form-label">Nome</label>
        <input type="text" name="name" id="name" class="form-control" value="<?= set_value('name') ?>" required>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input type="email" name="email" id="email" class="form-control" value="<?= set_value('email') ?>" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Senha</label>
        <input type="password" name="password" id="password" class="form-control" required>
      </div>

      <button type="submit" class="btn btn-primary w-100">Registrar</button>

      <div class="text-center mt-3">
        <a href="/login">Já tem uma conta? Entrar</a>
      </div>
    </form>
  </div>
</body>
</html>
