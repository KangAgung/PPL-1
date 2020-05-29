  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Online Shop</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item <?php if ($content == "home.php") {
            echo "active";
          }?>">
            <a class="nav-link" href="index.php?content=home.php">Home
              <?php
                if ($content == "home.php") {
              ?>
              <span class="sr-only">(current)</span>
              <?php
                }
              ?>
            </a>
          </li>
          <li class="nav-item <?php if ($content == "cart.php") {
            echo "active";
          }?>">
            <a class="nav-link" href="index.php?content=cart.php">Cart
            <?php
                if ($content == "cart.php") {
              ?>
              <span class="sr-only">(current)</span>
              <?php
                }
              ?>
            </a>
          </li>
          <li class="nav-item">
            <div class="ml-1">
              <form action="index.php?content=home.php" method="get">
                  <div class="form-row">
                    <div class="col-auto">
                      <label class="sr-only" for="search">cari</label>
                      <input class="form-control" type="search" name="cari" placeholder="Cari...">
                    </div>
                    <div class="col-auto">
                      <button type="submit" class="btn btn-light"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
              </form>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>