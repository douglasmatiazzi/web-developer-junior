$(document).ready(function () {
  const API_URL = 'https://da31b4d0c6cb.ngrok-free.app/api/posts';
  const BASE_UPLOADS_URL = 'https://da31b4d0c6cb.ngrok-free.app/uploads/';

  if ($('#postsContainer').length) {
    const $container = $('#postsContainer');
    const $orderSelect = $('#orderSelect');
    const $authorSelect = $('#authorSelect');
    const $searchInput = $('#searchInput');
    const $suggestionsList = $('#searchSuggestions');

    let debounceTimer = null;

    // Inicializa listagem padrão
    loadPosts('desc', '', '');

    // Formulário unificado (ordenar, autor, título)
    $('#filtersForm').on('submit', function (e) {
      e.preventDefault();
      const order = $orderSelect.val();
      const author = $authorSelect.val();
      const query = $searchInput.val().trim();
      loadPosts(order, author, query);
    });

    // Autocomplete por título
    $searchInput.on('input', function () {
      clearTimeout(debounceTimer);
      const term = $(this).val().trim();
      if (term.length < 2) {
        $suggestionsList.hide().empty();
        return;
      }

      debounceTimer = setTimeout(() => {
        $.get(`${API_URL}?q=${encodeURIComponent(term)}`)
          .done(data => {
            if (!Array.isArray(data)) return;
            const titles = [...new Set(data.map(post => post.title))];
            if (titles.length === 0) {
              $suggestionsList.hide().empty();
              return;
            }

            $suggestionsList.empty().show();
            titles.forEach(title => {
              $suggestionsList.append(`<li class="list-group-item list-group-item-action">${title}</li>`);
            });
          });
      }, 300);
    });

    // Clique em sugestão preenche o input
    $suggestionsList.on('click', 'li', function () {
      const title = $(this).text();
      $searchInput.val(title);
      $suggestionsList.hide().empty();
    });

    // Carrega os posts com os filtros
    function loadPosts(order = 'desc', authorId = '', query = '') {
      $container.html('<p class="text-muted">Carregando posts...</p>');

      let url = `${API_URL}?order=${encodeURIComponent(order)}`;
      if (authorId) url += `&creator=${encodeURIComponent(authorId)}`;
      if (query) url += `&q=${encodeURIComponent(query)}`;

      $.ajax({
        url: url,
        method: 'GET',
        headers: { 'ngrok-skip-browser-warning': 'true' }
      })
        .done(function (data) {
          if (!Array.isArray(data) || data.length === 0) {
            $container.html('<p class="text-center text-danger">Nenhum post encontrado.</p>');
            $authorSelect.html('<option value="">Todos os autores</option>');
            return;
          }

          $container.empty();
          atualizarAutores(data);

          data.forEach(post => {
            const postCard = `
              <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                  ${post.image ? `<img src="${BASE_UPLOADS_URL}${post.image}" class="card-img-top" alt="Imagem do post">` : ''}
                  <div class="card-body d-flex flex-column">
                    <h5 class="card-title">${escapeHtml(post.title)}</h5>
                    <div class="mb-2"><span class="badge bg-secondary">${escapeHtml(post.user?.name || 'Desconhecido')}</span></div>
                    <small class="text-muted mb-3">${formatDate(post.created_at)}</small>
                    <a href="post.html?id=${post.id}" class="btn btn-outline-primary mt-auto">Ler mais</a>
                  </div>
                </div>
              </div>`;
            $container.append(postCard);
          });
        })
        .fail(function () {
          $container.html('<p class="text-danger">Erro ao carregar os posts.</p>');
          $authorSelect.html('<option value="">Erro ao carregar autores</option>');
        });
    }

    // Preenche select de autores
    function atualizarAutores(posts) {
      const autores = {};
      posts.forEach(post => {
        if (post.user && post.user.id && post.user.name) {
          autores[post.user.id] = post.user.name;
        }
      });

      const currentOptions = $authorSelect.find('option').length;
      if (currentOptions > 1) return;

      $authorSelect.empty().append('<option value="">Todos os autores</option>');
      Object.entries(autores).forEach(([id, name]) => {
        $authorSelect.append(`<option value="${id}">${name}</option>`);
      });
    }
  }

  // POST.HTML (detalhe do post)
  else if ($('#postTitle').length && $('#postContent').length) {
    const urlParams = new URLSearchParams(window.location.search);
    const postId = urlParams.get('id');
    if (!postId) {
      $('#postContent').html('<div class="alert alert-danger text-center">Post não encontrado.</div>');
      return;
    }

    $.ajax({
      url: `${API_URL}/${postId}`,
      method: 'GET',
      headers: { 'ngrok-skip-browser-warning': 'true' }
    })
      .done(function (data) {
        $('#postTitle').text(data.title);
        $('#postAuthor').text(data.user?.name || 'Desconhecido');
        $('#postDate').text(data.created_at ? formatDate(data.created_at) : '');
        $('#postMeta').show();
        if (data.image) {
          $('#postImage').attr('src', BASE_UPLOADS_URL + data.image).show();
        }
        $('#postContent').html(data.content);
      })
      .fail(function () {
        $('#postContent').html('<div class="alert alert-danger text-center">Erro ao carregar o post.</div>');
      });
  }

  // Utilitários
  function stripHtml(html) {
    return $('<div>').html(html).text();
  }

  function escapeHtml(text) {
    return $('<div>').text(text).html();
  }

  function formatDate(dateStr) {
    if (!dateStr) return '';
    const date = new Date(dateStr);
    return date.toLocaleDateString('pt-BR', {
      day: '2-digit',
      month: '2-digit',
      year: 'numeric'
    }) + ' ' + date.toLocaleTimeString('pt-BR', {
      hour: '2-digit',
      minute: '2-digit'
    });
  }
});
