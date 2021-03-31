<!-- Header -->
<?php include('../elements/main/header.php') ?>

<!-- Nav -->
<?php include('../elements/main/nav.php') ?>

<?php
// find out the number of results stored in database
$sql = "SELECT * FROM homedecor_product WHERE quantity != 0";
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
  if ($category) {
    $sql = "SELECT * FROM homedecor_product WHERE quantity != 0 AND category LIKE '%" . $category . "%' LIMIT " . $firstPageResult . "," .  $resultPerPage;
  }
} else {
  // If no category is selected
  $sql = "SELECT * FROM homedecor_product WHERE quantity != 0 LIMIT " . $firstPageResult . "," .  $resultPerPage;
}

$result = mysqli_query($conn, $sql);

?>

<div class="container-fluid mt-4 px-0">
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <!-- <li data-target="#carouselExampleIndicators" data-slide-to="2"></li> -->
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="/project/upload/img/carousel/1.jpg" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="/project/upload/img/carousel/2.jpg" alt="Second slide">
      </div>
      <div class="carousel-item">
        <div class="embed-responsive embed-responsive-16by9">
          <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0" allowfullscreen></iframe>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>

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
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Others</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="?page=<?= $page ?>&category=benjarong">Benjarongs</a>
              <a class="dropdown-item" href="?page=<?= $page ?>&category=basket">Baskets</a>
              <a class="dropdown-item" href="?page=<?= $page ?>&category=Condiment">Condiment Sets</a>
              <a class="dropdown-item" href="?page=<?= $page ?>&category=sauce">Saucers</a>
              <a class="dropdown-item" href="?page=<?= $page ?>&category=spoon">Spoon</a>
              <a class="dropdown-item" href="?page=<?= $page ?>&category=tiffin">Tiffins</a>
            </div>
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
                      <?php if ($rowProduct['quantity'] == 0) : ?>
                        <span class="badge badge-pill warning-color">Pre-Order</span>
                      <?php else : ?>
                        <span class="badge badge-pill secondary-color">New</span>
                      <?php endif; ?>
                    </a>
                  </strong>
                </h5>

                <h4 class="font-weight-bold text-info">
                  <strong>
                    <?php
                    if (!empty($rowProduct['fixedPrice'])) :
                      echo "RM" . number_format($rowProduct['fixedPrice'], 2, '.', '');
                    else :
                      $price = round(($rowProduct['cost'] * 2.5) + 6);
                      echo "RM" . number_format($price, 2, '.', '');
                    endif;
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
      <?php if (ceil($numberOfResult / $resultPerPage)) : ?>
        <ul class="pagination">
          <?php if ($page > 1) : ?>
            <li class="page-item"><a class="page-link" href="?page=<?php echo $page - 1;
                                                                    if (isset($_GET['category'])) : echo '&category=' . $_GET['category'];
                                                                    endif; ?>">Prev</a></li>
          <?php endif; ?>

          <?php if ($page > 5) : ?>
            <li class="page-item"><a class="page-link" href="?page=1<?php if (isset($_GET['category'])) : echo '&category=' . $_GET['category'];
                                                                    endif; ?>">1</a></li>
            <li class="page-item">...</li>
          <?php endif; ?>

          <?php if ($page - 2 > 0) : ?><li class="page-item"><a class="page-link" href="?page=<?php echo $page - 2 ?><?php if (isset($_GET['category'])) : echo '&category=' . $_GET['category'];
                                                                                                                      endif; ?>"><?php echo $page - 2 ?></a></li><?php endif; ?>
          <?php if ($page - 1 > 0) : ?><li class="page-item"><a class="page-link" href="?page=<?php echo $page - 1 ?><?php if (isset($_GET['category'])) : echo '&category=' . $_GET['category'];
                                                                                                                      endif; ?>"><?php echo $page - 1 ?></a></li><?php endif; ?>

          <li class="page-item active"><a class="page-link" href="?page=<?php echo $page;
                                                                        if (isset($_GET['category'])) : echo '&category=' . $_GET['category'];
                                                                        endif; ?>"><?php echo $page ?></a></li>

          <?php if ($page + 1 < ceil($numberOfResult / $resultPerPage) + 1) : ?><li class="page-item"><a class="page-link" href="?page=<?php echo $page + 1;
                                                                                                                                        if (isset($_GET['category'])) : echo '&category=' . $_GET['category'];
                                                                                                                                        endif; ?>"><?php echo $page + 1 ?></a></li><?php endif; ?>
          <?php if ($page + 2 < ceil($numberOfResult / $resultPerPage) + 1) : ?><li class="page-item"><a class="page-link" href="?page=<?php echo $page + 2;
                                                                                                                                        if (isset($_GET['category'])) : echo '&category=' . $_GET['category'];
                                                                                                                                        endif; ?>"><?php echo $page + 2 ?></a></li><?php endif; ?>

          <?php if ($page < ceil($numberOfResult / $resultPerPage) - 2) : ?>
            <li class="page-item">...</li>
            <li class="page-item"><a class="page-link" href="?page=<?php echo ceil($numberOfResult / $resultPerPage);
                                                                    if (isset($_GET['category'])) : echo '&category=' . $_GET['category'];
                                                                    endif; ?>"><?php echo ceil($numberOfResult / $resultPerPage) ?></a></li>
          <?php endif; ?>

          <?php if ($page < ceil($numberOfResult / $resultPerPage)) : ?>
            <li class="page-item"><a class="page-link" href="?page=<?php echo $page + 1;
                                                                    if (isset($_GET['category'])) : echo '&category=' . $_GET['category'];
                                                                    endif; ?>">Next</a></li>
          <?php endif; ?>
        </ul>
      <?php endif; ?>
    </nav>
    <!--Pagination-->

  </div>
</main>
<!--Main layout-->

<!-- Footer -->
<?php include('../elements/main/footer.php') ?>