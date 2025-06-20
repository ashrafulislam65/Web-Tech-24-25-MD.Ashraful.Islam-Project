<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie/Tv Show Database</title>
    <!-- css  -->
    <link rel="stylesheet" href="./index.css" />
</head>
<body>
    <!-- header section -->
    <?php include './views/Layouts/header.php'; 
    ?>
    <section class="container">
        <div class="heading-container">
          <p class="heading">
            Your ultimate destination for discovering the world’s best movies
            and TV series!
          </p>
          <p class="sub-heading">
            Browse top-rated titles, explore by genre, and find your next
            favorite watch with our smart filters. Whether you're into drama,
            thrillers, sci-fi, or classics — there's something here for
            everyone.
          </p>
        </div>
    </section>
     <!-- top ten -->
      <section class="container">
        <div class="item-heading">
          <h1>Most Watched This Week</h1>
        </div>
        <div id="top-ten-container"></div>
      </section>
       <!-- movie rec -->
      <section class="container">
        <div class="item-heading">
          <h1>Movie Recommendation</h1>
        </div>
        <div id="movie-rec-container"></div>
      </section>
       <!-- tv series rec -->
      <section class="container">
        <div class="item-heading">
          <h1>Tv Series Recommendation</h1>
        </div>
        <div id="tvseries-rec-container"></div>
      </section>
      <!-- footer -->
       <?php include './views/Layouts/footer.php';
       ?>
      <!-- javaScript -->
    <script src="./index.js"></script>
      
</body>
</html>