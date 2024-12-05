<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="image/image.png">
  <link rel="stylesheet" href="css/transac.css">
  <link rel="stylesheet" href="css/style.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
  <title>Bo's Coffee | Login</title>
</head>
<body>
  <div class="header">
    <div class="nav">
      <div class="name">
        <img src="media/image.png" alt="logo" class="logo">
        <span>Bo's Coffee</span>
      </div>
      <div class="admin">
      <a href="index.php" class="home">
          Home</i>
        </a>
        <p>Admin</p>
        <a href="php/logout.php">
          <i class="fas fa-sign-out-alt logout"></i>
        </a>
      </div>
    </div>
  </div>
<div class="table">
  <h1>Orders List</h1>
    <table>
      <thead>
          <tr>
              <th>Order ID</th>
              <th>Product Name</th>
              <th>Product Price</th>
              <th>Date</th>
              <th>Status</th>
              <th>Total Amount</th>
          </tr>
      </thead>
      <?php 
        include 'php/order.php'; 
      ?>
      <tbody>
      </tbody>
    </table>
  </div>
</body>
</html>