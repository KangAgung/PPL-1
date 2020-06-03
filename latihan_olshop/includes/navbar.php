  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Online Shop</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <div class="mr-1">
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
          <?php
            if (!isset($_SESSION['username'])) {
          ?>
          <li class="nav-item ">
            <a class="nav-link" href="#login" data-toggle="modal" data-target="#loginModal">Login</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="#register" data-toggle="modal" data-target="#registerModal">Register</a>
          </li>
          <?php
            } else {
          ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php
            echo $_SESSION['username'];
          ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="index.php?content=logout.php">Logout</a>
            </div>
          </li>
          <?php
            }
          ?>
        </ul>
      </div>
    </div>
  </nav>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="loginModal">Login</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="index.php?content=login.php" method="post">
          <div class="form-group">
              <label for="username">Username : </label>
              <input class="form-control" type="text" id="username" name="username" placeholder="Username" required>
          </div>
          <div class="form-group">
              <label for="password">Password :</label>
              <input class="form-control" type="password" id="password" name="password" placeholder="Password" required>
          </div>
        <p class="text-center">Belum memiliki akun ? Klik <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#registerModal">disini</a></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <input class="btn btn-primary" type="submit" value="Login">
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="registerModal">Register</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="index.php?content=register.php" method="post">
          <div class="form-group">
              <label for="username">Username : </label>
              <input class="form-control" type="text" id="username" name="username" placeholder="Username" required>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                  <label for="password">Password :</label>
                  <input class="form-control" type="password" id="password" name="password" placeholder="Password" required>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                  <label for="password">Re-type Password :</label>
                  <input class="form-control" type="password" id="password" name="c_password" placeholder="Re-Type your Password" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                  <label for="nama">Nama: </label>
                  <input class="form-control" type="text" id="nama" name="nama" placeholder="Nama" required>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                  <label for="hp">No. HP :</label>
                  <input class="form-control" type="text" id="hp" name="no_hp" placeholder="Nomor HP" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                  <label for="alamat">Alamat :</label>
                  <input class="form-control" type="text" id="alamat" name="alamat" placeholder="Alamat" required>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                  <?php
                        $sql = "SELECT kode_tujuan FROM ongkir";
                        $res = mysqli_query($koneksi, $sql);
                        $result = mysqli_fetch_all($res);
                    ?>
                    
                    <label for="kodePos">Kode Pos :</label>
                    <select class="form-control" id="kode_pos" name="kode_pos" required>
                    <option value="" disabled selected>Pilih</option>
                    <?php
                      foreach ($result as $value) {
                    ?>
                          <option value="<?php echo $value[0];?>"><?php echo $value[0]; ?></option>
                    <?php
                      }
                    ?>
                    </select>
              </div>
            </div>
          </div>
        <p class="text-center">Sudah memiliki akun ? Klik <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#loginModal">disini</a></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <input class="btn btn-primary" type="submit" value="Register">
        </form>
      </div>
    </div>
  </div>
</div>