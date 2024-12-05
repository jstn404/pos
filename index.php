<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="image/image.png">
  <link rel="stylesheet" href="css/style.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
  <title>Bo's Coffee | POS</title>
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

  <div class="content">
    <div class="item-list">
      <div class="item">
        <div class="nav-fixed">
        <div class="item-nav">
          <div class="add" onclick="openModal()">+ Add New Product</div>
          <!-- The Modal -->
          <div id="myModal" class="modal">
            <div class="modal-content">
              <span class="close" onclick="closeModal()">&times;</span>
              <h2>Add New Product</h2>
              <form action="php/insert_product.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="category">Category</label>
                  <select id="category" name="category" required>
                    <option value="food">Food</option>
                    <option value="coffee">Coffee</option>
                    <option value="non-coffee">Non-Coffee</option>
                    <option value="others">Others</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="name">Product Name</label>
                  <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                  <label for="detail">Product Detail</label>
                  <textarea id="detail" name="detail" required></textarea>
                </div>
                <div class="form-group">
                  <label for="price">Price</label>
                  <input type="number" id="price" name="price" required>
                </div>
                <div class="form-group">
                  <label for="image">Product Image</label>
                  <input type="file" id="image" name="image" required>
                </div>
                <button type="submit" class="btn-submit btn-modal">Add Product</button>
              </form>
            </div>
          </div>

          <div class="dropdown">
            <div class="dropdown-button" onclick="toggleDropdown()">Categories <i class="fas fa-angle-down"></i></div>
            <div class="dropdown-content">
              <a href="#">Category 1</a>
              <a href="#">Category 2</a>
              <a href="#">Category 3</a>
              <a href="#">Category 4</a>
            </div>
          </div>
        </div>
        </div>

        <div class="products-container">
          <?php
          include 'php/fetch_products.php';
          ?>
        </div>

      </div>
    </div>
    
    <div class="payment-list">
      <div class="list">
        <div class="checkout">Checkout</div>
        <div id="productDetails"></div>
      </div>
      <div class="cal">
        <div>Sub Total <span id="subTotal"></span></div>
        <div>Tax <span class="tax">1.5%</span> <span id="tax"></span></div>
        <div class="total">Total <span id="total"></span></div>
      </div>
    </div>
  </div>
  
  <div class="button-div">
    <div class="button">
      <a href="transac.php">
        <button class="transac">
          Transaction
        </button>
      </a>
      <div><button class="cancel">Cancel Order</button></div>  
    </div>
    <form id="orderForm" action="php/submit_order.php" method="POST">
      <!-- Hidden inputs for the order details -->
      <input type="hidden" name="order_id" id="order_id" value="<?php echo uniqid(); ?>"> <!-- Unique order ID -->
      
      <!-- Hidden inputs for selected products will be added here dynamically -->
      <div id="hiddenInputs"></div>

      <!-- Submit Button -->
      <button type="submit" class="pay">Submit Order</button>
  </form>
  </div>

<script src="js.js"></script>
</body>
</html>