const search = document.getElementById('search');

if (search) {
    search.addEventListener('keyup', function () {
        fetch('ajax_search.php?q=' + encodeURIComponent(this.value))
            .then(res => res.json())
            .then(data => {
                document.getElementById('results').innerHTML =
                    data.map(m => `
                        <li>
                            <strong>${m.title}</strong><br>
                            <small>
                                Genre: ${m.genre ?? '—'} |
                                Cast: ${m.cast_name ?? '—'} |
                                Year: ${m.release_year ?? '—'}
                            </small><br>
                            <a href="edit.php?id=${m.id}">Edit</a> |
                            <a href="delete.php?id=${m.id}"
                               onclick="return confirm('Delete this movie?')">
                               Delete
                            </a>
                        </li>
                    `).join('');
            });
    });
}
