document.addEventListener("DOMContentLoaded", function () {

  function adv_search() {
    const adv_search = document.getElementById("adv-search");

    if (adv_search.innerHTML.trim() !== "") {
      adv_search.innerHTML = "";
      return;
    }

    adv_search.innerHTML = `
      <div class="adv-search-box">
        <h3>Advanced Search</h3>
        <form id="adv-search-form">
          <label for="category">Category:</label>
          <select id="category" name="category">
            <option value="">-- Select Category --</option>
            <option value="TV Series">TV Series</option>
            <option value="Movie">Movie</option>
          </select>

          <label for="genre">Genre:</label>
          <select id="genre" name="genre">
            <option value="">All Genres</option>
            <option value="Period Drama">Period Drama</option>
            <option value="Prison Drama">Prison Drama</option>
            <option value="Epic">Epic</option>
            <option value="Gangster">Gangster</option>
            <option value="Crime">Crime</option>
            <option value="Drama">Drama</option>
            <option value="Romance">Romance</option>
            <option value="Psychological Drama">Psychological Drama</option>
            <option value="Thriller">Thriller</option>
            <option value="Sci-Fi">Sci-Fi</option>
            <option value="Time Travel">Time Travel</option>
            <option value="Dark Comedy">Dark Comedy</option>
            <option value="Satire">Satire</option>
            <option value="True Crime">True Crime</option>
            <option value="Psychological Thriller">Psychological Thriller</option>
            <option value="Mystery">Mystery</option>
            <option value="Body Horror">Body Horror</option>
            <option value="Psychological Horror">Psychological Horror</option>
            <option value="Tragedy">Tragedy</option>
            <option value="Horror">Horror</option>
            <option value="Survival">Survival</option>
            <option value="Adventure">Adventure</option>
          </select>

          <label for="year">Release Year:</label>
          <select id="year" name="year">
            <option value="">-- Select Year --</option>
            <option value="1972">1972</option>
            <option value="1973">1973</option>
            <option value="1994">1994</option>
            <option value="1999">1999</option>
            <option value="2010">2010</option>
            <option value="2013">2013</option>
            <option value="2014">2014</option>
            <option value="2015">2015</option>
          </select>

          <button type="submit">Search</button>
          <button type="button" id="cancel-search-btn">Cancel</button>
        </form>
        <div id="adv-search-result-container"></div>
      </div>
    `;

    document.getElementById("adv-search-form").addEventListener("submit", function (e) {
      e.preventDefault();
      performAdvancedSearch();
    });

    document.getElementById("cancel-search-btn").addEventListener("click", () => {
      adv_search.innerHTML = "";
    });
  }

  window.adv_search = adv_search;

  function performAdvancedSearch() {
    const category = document.getElementById("category").value;
    const genre = document.getElementById("genre").value;
    const year = document.getElementById("year").value;
    const resultContainer = document.getElementById("adv-search-result-container");
    resultContainer.innerHTML = "";

    Promise.all([
      fetch("Json/shows.json").then((res) => res.json()),
      fetch("Json/top-movies.json").then((res) => res.json()),
      fetch("Json/top-series.json").then((res) => res.json()),
    ])
    .then(([shows, movies, series]) => {
      const all_items = [...shows, ...movies, ...series];

      const results = all_items.filter((item) => {
        return (
          (!category || item.category?.includes(category)) &&
          (!genre || item.genre?.includes(genre)) &&
          (!year || item.year?.toString().includes(year))
        );
      });

      if (results.length === 0) {
        resultContainer.innerHTML = "<p>No results found.</p>";
      } else {
        results.forEach((item) => {
          const card = document.createElement("div");
          card.classList.add("show-card");
          card.innerHTML = `
            <img src="${item.poster}" alt="${item.title}">
            <div class="info">
              <h2 class="info-header">${item.title}</h2>
              <p class="info-rating">⭐ ${item.rating}</p>
              <p class="info-rating">Genre: ${item.genre}</p>
              <p class="info-rating">Year: ${item.year}</p>
              <button class="info-btn">Watchlist</button>
              <button class="info-btn">Trailer</button>
              <button class="info-btn details-btn" data-title="${item.title}">Details</button>
            </div>
          `;
          resultContainer.appendChild(card);
        });
      }
    })
    .catch((error) => console.error("Error fetching data: ", error));
  }

  const top_ten_container = document.getElementById("top-ten-container");
  const movie_rec_container = document.getElementById("movie-rec-container");
  const tvseries_rec_container = document.getElementById("tvseries-rec-container");

  if (top_ten_container) {
    fetch("Json/shows.json")
      .then((response) => response.json())
      .then((shows) => {
        shows.forEach((show) => {
          const card = document.createElement("div");
          card.classList.add("show-card");
          card.innerHTML = `
            <img src="${show.poster}" alt="${show.title}">
            <div class="info">
              <h2 class="info-header">${show.rank || ""} ${show.title}</h2>
              <p class="info-rating">⭐ ${show.rating}</p>
              <button class="info-btn">Watchlist</button>
              <button class="info-btn">Trailer</button>
              <button class="info-btn details-btn" data-title="${show.title}">Details</button>
            </div>
          `;
          top_ten_container.appendChild(card);
        });
      })
      .catch((error) => console.error("Error loading top shows: ", error));
  }

  if (movie_rec_container) {
    fetch("Json/top-movies.json")
      .then((response) => response.json())
      .then((shows) => {
        const top5movies = shows.slice(0, 5);
        top5movies.forEach((show) => {
          const card = document.createElement("div");
          card.classList.add("show-card");
          card.innerHTML = `
            <img src="${show.poster}" alt="${show.title}">
            <div class="info">
              <h2 class="info-header">${show.title}</h2>
              <p class="info-rating">⭐ ${show.rating}</p>
              <button class="info-btn">Watchlist</button>
              <button class="info-btn">Trailer</button>
              <button class="info-btn details-btn" data-title="${show.title}">Details</button>
            </div>
          `;
          movie_rec_container.appendChild(card);
        });
      })
      .catch((error) => console.error("Error loading movies: ", error));
  }

  if (tvseries_rec_container) {
    fetch("Json/top-series.json")
      .then((response) => response.json())
      .then((shows) => {
        const top5tvseries = shows.slice(0, 5);
        top5tvseries.forEach((show) => {
          const card = document.createElement("div");
          card.classList.add("show-card");
          card.innerHTML = `
            <img src="${show.poster}" alt="${show.title}">
            <div class="info">
              <h2 class="info-header">${show.title}</h2>
              <p class="info-rating">⭐ ${show.rating}</p>
              <button class="info-btn">Watchlist</button>
              <button class="info-btn">Trailer</button>
              <button class="info-btn details-btn" data-title="${show.title}">Details</button>
            </div>
          `;
          tvseries_rec_container.appendChild(card);
        });
      })
      .catch((error) => console.error("Error loading series: ", error));
  }

  // Details button click handler (global)
  document.addEventListener("click", function (e) {
    if (e.target && e.target.classList.contains("details-btn")) {
      const title = e.target.getAttribute("data-title");

      Promise.all([
        fetch("Json/shows.json").then((res) => res.json()),
        fetch("Json/top-movies.json").then((res) => res.json()),
        fetch("Json/top-series.json").then((res) => res.json())
      ])
      .then(([shows, movies, series]) => {
        const allItems = [...shows, ...movies, ...series];
        const item = allItems.find(i => i.title === title);

        if (item) {
          document.getElementById("modal-poster").src = item.poster || "";
          document.getElementById("modal-title").textContent = item.title || "";
          document.getElementById("modal-rating").textContent = `Rating: ⭐ ${item.rating || "-"}`;
          document.getElementById("modal-category").textContent = `Category: ${item.category || "-"}`;
          document.getElementById("modal-genre").textContent = `Genre: ${item.genre || "-"}`;
          document.getElementById("modal-runtime").textContent = `Runtime: ${item.runtime || "-"}`;
          document.getElementById("modal-year").textContent = `Year: ${item.year || "-"}`;
          document.getElementById("modal-cast").textContent = `Cast: ${item.cast || "-"}`;

          document.getElementById("details-modal").style.display = "block";
        }
      })
      .catch((error) => console.error("Error fetching details:", error));
    }
  });

  // Close modal when clicking "x"
  document.addEventListener("click", function (e) {
    if (e.target && e.target.classList.contains("close-btn")) {
      document.getElementById("details-modal").style.display = "none";
    }
  });

  // Close modal on outside click
  window.addEventListener("click", function (e) {
    const modal = document.getElementById("details-modal");
    if (e.target === modal) {
      modal.style.display = "none";
    }
  });

});
