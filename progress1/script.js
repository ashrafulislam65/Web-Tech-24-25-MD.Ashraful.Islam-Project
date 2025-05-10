const container = document.getElementById('movie-container');

fetch('../data/movies.json')
  .then(response => response.json())
  .then(movies => {
    movies.forEach(movie => {
      const card = document.createElement('div');
      card.classList.add('movie-card');
      card.innerHTML = `
        <img src="${movie.poster}" alt="${movie.title}">
        <div class="info">
          <h2>${movie.rank}. ${movie.title}</h2>
          <p class="rating">⭐ ${movie.rating}</p>
          <button>Watchlist</button>
          <button>Trailer</button>
        </div>
      `;
      container.appendChild(card);
    });
  })
  .catch(error => console.error('Error loading movies:', error));
