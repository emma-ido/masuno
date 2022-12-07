<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="../view/search_for_employee.php">Home<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../view/search_for_employee.php">Search For Employees</a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li> -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="dropdown08" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Bookings</a>
        <div class="dropdown-menu" aria-labelledby="dropdown08">
          <a class="dropdown-item" href="../view/past_bookings.php">All Bookings</a>
          <a class="dropdown-item" href="../view/past_bookings.php?status=Accepted">Accepted Bookings</a>
          <a class="dropdown-item" href="../view/past_bookings.php?status=Paid">Past Bookings</a>
          <a class="dropdown-item" href="../view/past_bookings.php?status=Pending">Pending Bookings</a>
        </div>
      </li>
      
        <?php 
          if(isCustomer()) {
            echo "
            <li class='nav-item'>
            <a class='nav-link' href='../logout.php'>Log out</a>
            </li>";
          } else {
            echo "
            <li class='nav-item'>
            <a class='nav-link' href='../login/customer_login.php'>Log in</a>
            </li>
            <li class='nav-item'>
            <a class='nav-link' href='../login/customer_register.php'>Sign up</a>
            </li>";
          } 
        ?>
    </ul>
  </div>
</nav>