/* =========================
   PASSWORD TOGGLE
========================= */
function togglePassword() {
    const input = document.getElementById('password');
    const toggle = document.querySelector('.toggle');

    if (!input || !toggle) return;

    if (input.type === 'password') {
        input.type = 'text';
        toggle.textContent = 'Hide';
    } else {
        input.type = 'password';
        toggle.textContent = 'Show';
    }
}

/* =========================
   LIVE SEARCH
========================= */
const search = document.getElementById('search');
const grid = document.getElementById('movie-grid');

if (search && grid) {
    let controller;

    search.addEventListener('input', () => {
        const q = search.value.trim();

        if (controller) controller.abort();
        controller = new AbortController();

        if (!q) {
            location.reload();
            return;
        }

        fetch(`./public/ajax_search.php?q=${encodeURIComponent(q)}`, {
            signal: controller.signal
        })
        .then(res => res.json())
        .then(data => {
            if (!data.length) {
                grid.innerHTML = `<p class="muted">No movies found</p>`;
                return;
            }

            grid.innerHTML = data.map(m => `
                <div class="movie-card card">
                    <h3>${m.title}</h3>
                    <div class="movie-meta">
                        <div><strong>Genre:</strong> ${m.genre_name ?? '—'}</div>
                        <div><strong>Cast:</strong> ${m.cast_name ?? '—'}</div>
                        <div><strong>Year:</strong> ${m.release_year}</div>
                        <div><strong>Rating:</strong> ${m.rating ?? '—'}</div>
                    </div>
                    <div class="actions">
                        <a href="edit.php?id=${m.id}">Edit</a>
                        <a href="delete.php?id=${m.id}" onclick="return confirm('Delete this movie?')">Delete</a>
                    </div>
                </div>
            `).join('');
        })
        .catch(err => {
            if (err.name !== 'AbortError') {
                console.error(err);
            }
        });
    });
}
