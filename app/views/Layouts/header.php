<?php
echo <<<HTML
<header class="header">
  <nav class="nav-bar">
    <div>
      <img src="" alt="" />
      <p class="title1">RevoTV <small class="title2">+</small></p>
    </div>
    <div>
      <input class="search" type="search" placeholder="search RevoTV" name="" id="" />
      <button class="btn-nav" onclick="return adv_search()">ASearch</button>
      <button class="btn-nav"><a class="" href="../../index.php">Home</a></button>
      <button class="btn-nav">Actor Profile</button>
      <button class="btn-nav"><a class="" href="">Watchlist</a></button>
      <button class="btn-nav"><a class="" href="views/Forms/login_user_form.php">Signin</a></button>

    </div>
  </nav>

  <section id="adv-search"></section>
  <section id="adv-search-results" class="container">
    <div id="adv-search-result-container"></div>
  </section>
</header>
HTML;
?>
