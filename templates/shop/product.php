<!-- Header -->
<?php include('../elements/main/header.php') ?>

<!-- Nav -->
<?php include('../elements/main/nav.php') ?>

<?php
// Get product details
$id = $_GET['id'];
$product = "SELECT * FROM homedecor_product WHERE id = '$id'";
$res = mysqli_query($conn, $product);
$row = mysqli_fetch_assoc($res);
?>

<!--Main layout-->
<main class="mt-5 pt-4">
  <div class="container dark-grey-text mt-5">

    <!--Grid row-->
    <div class="row wow fadeIn">

      <!--Grid column-->
      <div class="col-md-6 mb-4 text-center align-middle">

        <img src="/project/upload/img/product/<?php if (!$row['img']) : ?>default.jpg <?php else : ?><?= $row['img']; ?><?php endif; ?>" class="rounded img-fluid" alt="" style="width:100%">

      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-md-6 mb-4">

        <!--Content-->
        <div class="p-4">

          <div class="mb-3">
            <a href="">
              <span class="badge purple mr-1"><?= $row['category']; ?></span>
            </a>
            <a href="">
              <span class="badge blue mr-1">New Arrival</span>
            </a>
            <a href="">
              <span class="badge red mr-1">Bestseller</span>
            </a>
          </div>

          <p class="lead">
            <span class="mr-1">
              <del>RM<?= number_format(round((($row['cost'] * 2.6) + 6) * 1.5), 2, '.', ''); ?></del>
            </span>
            <span>RM<?= number_format(round(($row['cost'] * 2.6) + 6), 2, '.', ''); ?></span>
          </p>

          <p class="lead font-weight-bold"><?= $row['name']; ?></p>

          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Et dolor suscipit libero eos atque quia ipsa
            sint voluptatibus!
            Beatae sit assumenda asperiores iure at maxime atque repellendus maiores quia sapiente.</p>

          <form class="d-flex justify-content-left">
            <!-- Default input -->
            <input type="number" value="1" aria-label="Search" class="form-control" style="width: 100px">
            <button class="btn btn-primary btn-md my-0 p" type="submit">Add to cart
              <i class="fas fa-shopping-cart ml-1"></i>
            </button>

          </form>

        </div>
        <!--Content-->

      </div>
      <!--Grid column-->

    </div>
    <!--Grid row-->

    <hr>

    <!--Grid row-->
    <div class="row d-flex justify-content-center wow fadeIn">

      <!--Grid column-->
      <div class="col-md-6 text-center">

        <h4 class="my-4 h4">Other Bestseller</h4>

        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus suscipit modi sapiente illo soluta odit
          voluptates,
          quibusdam officia. Neque quibusdam quas a quis porro? Molestias illo neque eum in laborum.</p>

      </div>
      <!--Grid column-->

    </div>
    <!--Grid row-->

    <!--Grid row-->
    <div class="row wow fadeIn">
      <?php
      // Pick 3 random products
      $randProd = "SELECT * FROM homedecor_product ORDER BY RAND() LIMIT 3";
      $resRandProd = mysqli_query($conn, $randProd);
      ?>
      <!--Grid column-->
      <?php while ($rowRandProd = mysqli_fetch_array($resRandProd)) : ?>
        <div class="col-lg-4 col-md-12 mb-4 text-center">

          <img src="/project/upload/img/product/<?php if (!$rowRandProd['img']) : ?>default.jpg <?php else : ?><?= $rowRandProd['img']; ?><?php endif; ?>" class="img-fluid rounded" alt="">

          <p class="lead font-weight-normal"><?= $rowRandProd['name']; ?></p>
          <span class="mr-1">
            <del>RM<?= number_format(round((($rowRandProd['cost'] * 2.6) + 6) * 1.5), 2, '.', ''); ?></del>
          </span>
          <span>RM<?= number_format(round(($rowRandProd['cost'] * 2.6) + 6), 2, '.', ''); ?></span>

        </div>
      <?php endwhile; ?>
      <!--Grid column-->

    </div>
    <!--Grid row-->

  </div>
</main>
<!--Main layout-->

<!-- Footer -->
<?php include('../elements/main/footer.php') ?>