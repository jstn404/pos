function toggleDropdown() {
  var dropdownContent = document.querySelector('.dropdown-content');
  dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropdown-button')) {
      var dropdowns = document.querySelectorAll('.dropdown-content');
      dropdowns.forEach(function(dropdown) {
          dropdown.style.display = 'none';
      });
  }
}

// Modal to create new product

function openModal() {
  document.getElementById("myModal").style.display = "block";
}

function closeModal() {
  document.getElementById("myModal").style.display = "none";
}

// Close the modal if the user clicks anywhere outside of the modal content
window.onclick = function(event) {
  if (event.target == document.getElementById("myModal")) {
    closeModal();
  }
}

let subTotal = 0;

// Function to pass product ID and fetch details
function passProductId(element) {
  var productId = element.getAttribute('data-id');
  var detailsDiv = document.getElementById('productDetails');
  
  // Fetch product details and add to form
  fetchProductDetails(productId, detailsDiv);
}

function fetchProductDetails(productId, detailsDiv) {
  // Example AJAX request to fetch product details based on productId
  fetch('php/get_price.php?product_id=' + productId)
    .then(response => response.json())
    .then(data => { 
      if (data.error) {
        const errorMessage = document.createElement('div');
        errorMessage.textContent = `Error: ${data.error}`;
        errorMessage.style.color = 'red';
        detailsDiv.appendChild(errorMessage);
      } else {
        // Create a container for the product details in the display area
        const productContainer = document.createElement('div');
        productContainer.style.marginBottom = '10px';

        // Add the product details to the display container
        const productDetails = document.createElement('span');
        productDetails.textContent = `${data.name} = ₱${data.price}`;
        productContainer.appendChild(productDetails);

        // Append the product container to the details div
        detailsDiv.appendChild(productContainer);

        // Create hidden inputs for the form to submit the selected product data
        const hiddenInputsDiv = document.getElementById('hiddenInputs');

        const productIdInput = document.createElement('input');
        productIdInput.type = 'hidden';
        productIdInput.name = 'product_id[]';
        productIdInput.value = data.productId;
        hiddenInputsDiv.appendChild(productIdInput);

        const productNameInput = document.createElement('input');
        productNameInput.type = 'hidden';
        productNameInput.name = 'product_name[]';
        productNameInput.value = data.name;
        hiddenInputsDiv.appendChild(productNameInput);

        const productPriceInput = document.createElement('input');
        productPriceInput.type = 'hidden';
        productPriceInput.name = 'price[]';
        productPriceInput.value = data.price;
        hiddenInputsDiv.appendChild(productPriceInput);

        // Update the subtotal
        subTotal += parseFloat(data.price);
        updateSubTotal();
        updateTax();
        updateTotal();
      }
    })
    .catch(error => {
      console.error('Error fetching product details:', error);
    });
}

function updateSubTotal() {
  var subTotalDiv = document.getElementById('subTotal');
  subTotalDiv.innerHTML = subTotal.toFixed(2);  // Update the sub-total div
}

// Function to update the tax displayed based on sub-total
function updateTax() {
  var taxRate = 0.015; // Tax rate is 1.5%
  var taxAmount = subTotal * taxRate; // Calculate the tax based on sub-total
  
  var taxDiv = document.getElementById('tax');
  taxDiv.innerHTML = taxAmount.toFixed(2); // Update the tax div
}

// Function to update the total displayed based on sub-total and tax
function updateTotal() {
  var taxRate = 0.015; // Tax rate is 1.5%
  var taxAmount = subTotal * taxRate; // Calculate the tax based on sub-total
  
  var totalAmount = subTotal + taxAmount; // Calculate the total amount
  
  var totalDiv = document.getElementById('total');
  totalDiv.innerHTML = totalAmount.toFixed(2); // Update the total div
}

const urlParams = new URLSearchParams(window.location.search);
const productId = urlParams.get('product_id');

// Set the product_id in the div
if (productId) {
    document.getElementById('productDetails').setAttribute('data-product-id', productId);
}

function populateOrderDetails(productId, productName, price) {
  // Generate random 6-digit order ID
  const orderId = Math.floor(100000 + Math.random() * 900000);
  
  // Populate hidden fields with order and product data
  document.getElementById('orderId').value = orderId;
  document.getElementById('productId').value = productId;
  document.getElementById('productName').value = productName;
  document.getElementById('price').value = price;
}
