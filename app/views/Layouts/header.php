<?php
session_start(); 

$loggedIn = isset($_SESSION['user']);
$userName = $loggedIn ? $_SESSION['user']['username'] : '';


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
      <button class="btn-nav"><a href="../../index.php">Home</a></button>
      <button class="btn-nav">Actor Profile</button>
      <button class="btn-nav"><a href="#">Watchlist</a></button>
HTML;

if ($loggedIn) {
    echo <<<HTML
      <button class="btn-nav">Hello, {$userName}</button>
      <button class="btn-nav"><a href="/web-tech-project/app/views/Forms/logout_user.php">Logout</a></button>
HTML;
} else {
    echo <<<HTML
      <button class="btn-nav"><a href="/web-tech-project/app/views/Forms/login_user_form.php">Signin</a></button>
HTML;
}

echo <<<HTML
    </div>
  </nav>

  <section id="adv-search"></section>
  <section id="adv-search-results" class="container">
    <div id="adv-search-result-container"></div>
  </section>
</header>
HTML;
?>
