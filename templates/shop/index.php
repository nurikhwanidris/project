<!-- Header -->
<?php include('../elements/main/header.php') ?>

<!-- Nav -->
<?php include('../elements/main/nav.php') ?>

<?php
// find out the number of results stored in database
$sql = "SELECT * FROM homedecor_product";
$result = mysqli_query($conn, $sql);
$numberOfResult = mysqli_num_rows($result);

// define how many results you want per page
$resultPerPage = 12;

// determine number of total pages available
$numberOfPage = ceil($numberOfResult / $resultPerPage);

// determine which page number visitor is currently on
if (!isset($_GET['page'])) {
  $page = 1;
} else {
  $page = $_GET['page'];
}

// determine the sql LIMIT starting number for the results on the displaying page
$firstPageResult = ($page - 1) * $resultPerPage;

if (isset($_GET['category'])) {
  // Set the category first
  $category = $_GET['category'];
  // retrieve the category
  $sql = "SELECT * FROM homedecor_product WHERE category LIKE '%" . $category . "%' LIMIT " . $firstPageResult . "," .  $resultPerPage;
  // if other category is selected
  if ($category == 'others') {
    $sql = "SELECT * FROM homedecor_product WHERE ((NOT(homedecor_product.category) = 'trays' AND NOT(homedecor_product.category) = 'bowls' AND NOT(homedecor_product.category) = 'plates' AND NOT(homedecor_product.category) = 'benjarong' )) LIMIT " . $firstPageResult . "," .  $resultPerPage;
  }
} else {
  // retrieve selected results from database and display them on page
  $sql = "SELECT * FROM homedecor_product LIMIT " . $firstPageResult . "," .  $resultPerPage;
}
$result = mysqli_query($conn, $sql);

?>

<!--Carousel Wrapper-->
<div id="carousel-example-1z" class="carousel slide carousel-fade pt-4" data-ride="carousel">

  <!--Indicators-->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-1z" data-slide-to="1"></li>
    <li data-target="#carousel-example-1z" data-slide-to="2"></li>
  </ol>
  <!--/.Indicators-->

  <!--Slides-->
  <div class="carousel-inner" role="listbox">

    <!--First slide-->
    <div class="carousel-item active">
      <div class="view" style="background-image: url('https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/8-col/img%282%29.jpg'); background-repeat: no-repeat; background-size: cover;">

        <!-- Mask & flexbox options-->
        <div class="mask rgba-black-strong d-flex justify-content-center align-items-center">

          <!-- Content -->
          <div class="text-center white-text mx-5 wow fadeIn">
            <h1 class="mb-4">
              <strong>Learn Bootstrap 4 with MDB</strong>
            </h1>

            <p>
              <strong>Best & free guide of responsive web design</strong>
            </p>

            <p class="mb-4 d-none d-md-block">
              <strong>The most comprehensive tutorial for the Bootstrap 4. Loved by over 500 000 users. Video and
                written versions
                available. Create your own, stunning website.</strong>
            </p>

            <a target="_blank" href="https://mdbootstrap.com/education/bootstrap/" class="btn btn-outline-white btn-lg">Start
              free tutorial
              <i class="fas fa-graduation-cap ml-2"></i>
            </a>
          </div>
          <!-- Content -->

        </div>
        <!-- Mask & flexbox options-->

      </div>
    </div>
    <!--/First slide-->

    <!--Second slide-->
    <div class="carousel-item">
      <div class="view" style="background-image: url('https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/8-col/img%283%29.jpg'); background-repeat: no-repeat; background-size: cover;">

        <!-- Mask & flexbox options-->
        <div class="mask rgba-black-strong d-flex justify-content-center align-items-center">

          <!-- Content -->
          <div class="text-center white-text mx-5 wow fadeIn">
            <h1 class="mb-4">
              <strong>Learn Bootstrap 4 with MDB</strong>
            </h1>

            <p>
              <strong>Best & free guide of responsive web design</strong>
            </p>

            <p class="mb-4 d-none d-md-block">
              <strong>The most comprehensive tutorial for the Bootstrap 4. Loved by over 500 000 users. Video and
                written versions
                available. Create your own, stunning website.</strong>
            </p>

            <a target="_blank" href="https://mdbootstrap.com/education/bootstrap/" class="btn btn-outline-white btn-lg">Start
              free tutorial
              <i class="fas fa-graduation-cap ml-2"></i>
            </a>
          </div>
          <!-- Content -->

        </div>
        <!-- Mask & flexbox options-->

      </div>
    </div>
    <!--/Second slide-->

    <!--Third slide-->
    <div class="carousel-item">
      <div class="view" style="background-image: url('https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/8-col/img%285%29.jpg'); background-repeat: no-repeat; background-size: cover;">

        <!-- Mask & flexbox options-->
        <div class="mask rgba-black-strong d-flex justify-content-center align-items-center">

          <!-- Content -->
          <div class="text-center white-text mx-5 wow fadeIn">
            <h1 class="mb-4">
              <strong>Learn Bootstrap 4 with MDB</strong>
            </h1>

            <p>
              <strong>Best & free guide of responsive web design</strong>
            </p>

            <p class="mb-4 d-none d-md-block">
              <strong>The most comprehensive tutorial for the Bootstrap 4. Loved by over 500 000 users. Video and
                written versions
                available. Create your own, stunning website.</strong>
            </p>

            <a target="_blank" href="https://mdbootstrap.com/education/bootstrap/" class="btn btn-outline-white btn-lg">Start
              free tutorial
              <i class="fas fa-graduation-cap ml-2"></i>
            </a>
          </div>
          <!-- Content -->

        </div>
        <!-- Mask & flexbox options-->

      </div>
    </div>
    <!--/Third slide-->

  </div>
  <!--/.Slides-->

  <!--Controls-->
  <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  <!--/.Controls-->

</div>
<!--/.Carousel Wrapper-->

<!--Main layout-->
<main>
  <div class="container">

    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark mdb-color lighten-3 mt-3 mb-5">

      <!-- Navbar brand -->
      <span class="navbar-brand">Categories:</span>

      <!-- Collapse button -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Collapsible content -->
      <div class="collapse navbar-collapse" id="basicExampleNav">

        <!-- Links -->
        <ul class="navbar-nav mr-auto">
          <li class="nav-item <?php if (!isset($_GET['category'])) : echo "active";
                              endif; ?>">
            <a class=" nav-link" href="?page=1">All
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item <?php if (isset($_GET['category'])) : if ($_GET['category'] == 'plates') : echo "active";
                                endif;
                              endif; ?>">
            <a class="nav-link" href="?page=<?= $page ?>&category=plates">Plates</a>
          </li>
          <li class="nav-item <?php if (isset($_GET['category'])) : if ($_GET['category'] == 'bowls') : echo "active";
                                endif;
                              endif; ?>">
            <a class=" nav-link" href="?page=<?= $page ?>&category=bowls">Bowls</a>
          </li>
          <li class="nav-item <?php if (isset($_GET['category'])) : if ($_GET['category'] == 'trays') : echo "active";
                                endif;
                              endif; ?>">
            <a class=" nav-link" href="?page=<?= $page ?>&category=trays">Trays</a>
          </li>
          <li class="nav-item <?php if (isset($_GET['category'])) : if ($_GET['category'] == 'benjarong') : echo "active";
                                endif;
                              endif; ?>">
            <a class="nav-link" href="?page=<?= $page ?>&category=benjarong">Benjarongs</a>
          </li>
          <li class="nav-item <?php if (isset($_GET['category'])) : if ($_GET['category'] == 'others') : echo "active";
                                endif;
                              endif; ?>">
            <a class=" nav-link" href="?page=<?= $page ?>&category=others">Others</a>
          </li>
        </ul>
        <!-- Links -->

        <form class="form-inline">
          <div class="md-form my-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          </div>
        </form>
      </div>
      <!-- Collapsible content -->

    </nav>
    <!--/.Navbar-->

    <!--Section: Products v.3-->
    <section class="text-center mb-4">

      <!--Grid row-->
      <div class="row wow fadeIn">

        <?php while ($rowProduct = mysqli_fetch_array($result)) : ?>
          <!--Grid column-->
          <div class="col-lg-3 col-md-6 mb-4">

            <!--Card-->
            <div class="card">

              <!--Card image-->
              <div class="view overlay">
                <img src="/project/upload/img/product/<?php if (!$rowProduct['img']) : ?>default.jpg <?php else : ?><?= $rowProduct['img']; ?><?php endif; ?>" class="card-img-top" alt="" style="height:255px;">
                <a href="/project/templates/shop/product?id=<?= $rowProduct['id']; ?>">
                  <div class="mask rgba-white-slight"></div>
                </a>
              </div>
              <!--Card image-->

              <!--Card content-->
              <div class="card-body text-center">
                <!--Category & Title-->
                <a href="" class="grey-text">
                  <!-- Category -->
                  <h5><?= $rowProduct['category']; ?></h5>
                </a>
                <h5>
                  <!-- Title -->
                  <strong>
                    <a href="" class="dark-grey-text"><?= $rowProduct['name']; ?>
                      <br>
                      <span class="badge badge-pill danger-color">NEW</span>
                    </a>
                  </strong>
                </h5>

                <h4 class="font-weight-bold text-info">
                  <strong>
                    <?php
                    $price = round(($rowProduct['cost'] + 6) * 2);
                    echo "RM" . number_format($price, 2, '.', '');
                    ?>
                  </strong>
                </h4>

              </div>
              <!--Card content-->

            </div>
            <!--Card-->

          </div>
          <!--Grid column-->
        <?php endwhile; ?>

      </div>
      <!--Grid row-->

    </section>
    <!--Section: Products v.3-->

    <!--Pagination-->
    <nav class="d-flex justify-content-center wow fadeIn">
      <ul class="pagination pg-blue">

        <!--Arrow left-->
        <li class="page-item">
          <a class="page-link" href="?page=<?= $_GET['page'] - 1; ?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>
        <?php for ($page = 1; $page <= $numberOfPage; $page++) : ?>
          <?php if ($page == $_GET['page']) : ?>
            <li class="page-item active">
              <a class="page-link" href="?page=<?= $page;
                                                if (isset($_GET['category'])) : echo '&category=' . $_GET['category'];
                                                endif; ?>">
                <?= $page;
                ?>
              </a>
            </li>
          <?php else : ?>
            <li class="page-item">
              <a class="page-link" href="?page=<?= $page;
                                                if (isset($_GET['category'])) : echo '&category=' . $_GET['category'];
                                                endif; ?>">
                <?= $page; ?>
              </a>
            </li>
          <?php endif; ?>
        <?php endfor; ?>
        <li class="page-item">
          <a class="page-link" href="?page=<?= $_GET['page'] + 1; ?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>
      </ul>
    </nav>
    <!--Pagination-->

  </div>
</main>
<!--Main layout-->
<!-- Footer -->
<?php include('../elements/main/footer.php') ?>