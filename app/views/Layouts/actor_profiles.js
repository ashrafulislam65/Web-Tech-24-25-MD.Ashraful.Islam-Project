const actor_profiles_container = document.getElementById(
  "actor-profiles-container"
);

fetch("../../Json/actor-profile.json")
  .then((response) => response.json())
  .then((profiles) => {
    profiles.forEach((profile) => {
      const card = document.createElement("div");
      card.classList.add("show-card");
      card.innerHTML = `
            <img src="${profile.poster}" alt="${profile.name}">
            <div class="info">
                <h3 class="info-rating">Name: ${profile.name}</h3>
                <h3 class="info-rating">Occupation: ${profile.ocupation}</h3>
                <h3 class="info-rating">Date of Birth: ${profile.dob}</h3>
                <h3 class="info-rating">Awards: ${profile.awards}</h3>
            </div>
        `;
      actor_profiles_container.appendChild(card);
    });
  })
  .catch((error) => console.error("Error loadig Profiles: ", error));
