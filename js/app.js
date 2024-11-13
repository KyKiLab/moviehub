let currentPage = 1;
const loadMoreBtn = document.getElementById('load-more');
const movieCards = document.querySelector('.movie-cards');
const filterForm = document.getElementById('filter-form');
const sortSelect = document.getElementById('sort');

const postsPerPage = 2; // Должно соответствовать 'posts_per_page' в PHP

function fetchMovies(page = 1, filters = {}) {
    let query = `/wp-json/movies/v1/list?page=${page}`;

    if (filters.genre) query += `&genre=${filters.genre}`;
    if (filters.date_from) query += `&date_from=${filters.date_from}`;
    if (filters.date_to) query += `&date_to=${filters.date_to}`;
    if (filters.sort) query += `&sort=${filters.sort}`;
    if (filters.query) query += `&query=${filters.query}`;

    loadMoreBtn.textContent = 'Loading...';
    loadMoreBtn.disabled = true;

    fetch(query)
        .then(response => response.json())
        .then(data => {
            if (page === 1) movieCards.innerHTML = '';

            if (data.length === 0) {
                const noMovies = document.createElement('p');
                noMovies.textContent = 'No movies found.';
                movieCards.appendChild(noMovies);
                loadMoreBtn.style.display = 'none';
            } else {
                data.forEach(movie => {
                    const movieCard = document.createElement('div');
                    movieCard.classList.add('movie-card');
                    movieCard.innerHTML = `
                        <img src="${movie.thumbnail}" alt="${movie.title}">
                        <div class="badge">
                            <div class="badge__content">${movie.rating} <img src="${movie.rating_img}" alt="star"></div>
                        </div>
                        <h3>${movie.title}</h3>
                        <a href="${movie.link}" class="btn btn-link">read more</a>
                    `;
                    movieCards.appendChild(movieCard);
                });
                if (data.length < postsPerPage) {
                    loadMoreBtn.style.display = 'none';
                } else {
                    loadMoreBtn.style.display = 'block';
                }
                loadMoreBtn.textContent = 'Load More';
                loadMoreBtn.disabled = false;
            }
        })
        .catch(error => {
            console.log('Error:', error);
            loadMoreBtn.textContent = 'Load More';
            loadMoreBtn.disabled = false;
        });
}

filterForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const filters = {
        genre: document.getElementById('genre').value,
        date_from: document.getElementById('date-from').value,
        date_to: document.getElementById('date-to').value,
        sort: sortSelect.value,
        query: document.getElementById('query').value,
    };
    currentPage = 1;
    fetchMovies(currentPage, filters);
});

sortSelect.addEventListener('change', () => {
    const filters = {
        genre: document.getElementById('genre').value,
        date_from: document.getElementById('date-from').value,
        date_to: document.getElementById('date-to').value,
        sort: sortSelect.value,
        query: document.getElementById('query').value,
    };
    currentPage = 1;
    fetchMovies(currentPage, filters);
});

if (loadMoreBtn) {
    loadMoreBtn.addEventListener('click', () => {
        currentPage++;
        const filters = {
            genre: document.getElementById('genre').value,
            date_from: document.getElementById('date-from').value,
            date_to: document.getElementById('date-to').value,
            sort: sortSelect.value,
            query: document.getElementById('query').value,
        };
        fetchMovies(currentPage, filters);
    });
}
