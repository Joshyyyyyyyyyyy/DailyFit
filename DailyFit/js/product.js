document.addEventListener('DOMContentLoaded', function() {
  // DOM Elements
  const filterButtons = document.querySelectorAll('.filter-btn');
  const productCards = document.querySelectorAll('.product-card');
  const paginationLinks = document.querySelectorAll('.page-link');
  const quickViewButtons = document.querySelectorAll('.action-btn:nth-child(2)');
  const mobileMenuBtn = document.getElementById('mobile-menu-btn');
  const navMobile = document.getElementById('nav-mobile');
  
  // State
  let currentFilter = 'all';
  let currentPage = 1;
  const productsPerPage = 16;
  let filteredProducts = [...productCards];
  
  // Create modal container for quick view
  const modalContainer = document.createElement('div');
  modalContainer.className = 'modal-container';
  modalContainer.innerHTML = `
      <div class="modal-overlay"></div>
      <div class="modal-content">
          <button class="modal-close"><i class="fas fa-times"></i></button>
          <div class="modal-body">
              <div class="product-quick-view">
                  <div class="product-quick-view-image">
                      <img src="/placeholder.svg" alt="Product Image">
                  </div>
                  <div class="product-quick-view-info">
                      <h2 class="product-title"></h2>
                      <div class="product-price"></div>
                      <div class="product-colors"></div>
                      <div class="product-size">
                          <h4>Size:</h4>
                          <div class="size-options">
                              <button class="size-btn">S</button>
                              <button class="size-btn">M</button>
                              <button class="size-btn">L</button>
                              <button class="size-btn">XL</button>
                          </div>
                      </div>
                      <div class="product-quantity">
                          <h4>Quantity:</h4>
                          <div class="quantity-selector">
                              <button class="quantity-btn minus">-</button>
                              <input type="number" value="1" min="1" max="99">
                              <button class="quantity-btn plus">+</button>
                          </div>
                      </div>
                      <button class="add-to-cart-btn">Add to Cart</button>
                  </div>
              </div>
          </div>
      </div>
  `;
  document.body.appendChild(modalContainer);
  
  // Mobile menu toggle
  if (mobileMenuBtn) {
      mobileMenuBtn.addEventListener('click', function() {
          navMobile.classList.toggle('active');
          this.classList.toggle('active');
      });
  }

  
  // Function to filter products
  function filterProducts() {
      if (currentFilter === 'all') {
          filteredProducts = [...productCards];
      } else {
          filteredProducts = [...productCards].filter(card => {
              const productTitle = card.querySelector('.product-title').textContent.toLowerCase();
              const productImage = card.querySelector('.product-image img').getAttribute('alt').toLowerCase();
              
              if (currentFilter === 't-shirts') {
                  return productTitle.includes('t-shirt') || productImage.includes('t-shirt');
              } else if (currentFilter === 'hoodies') {
                  return productTitle.includes('hoodie') || productImage.includes('hoodie');
              } else if (currentFilter === 'shorts') {
                  return productTitle.includes('shorts') || productImage.includes('shorts');
              }
              
              return false;
          });
      }
      
      // Hide all products first
      productCards.forEach(card => {
          card.style.display = 'none';
      });
      
      // Show filtered products for current page
      showCurrentPageProducts();
      
      // Update product count
      document.querySelector('.products-header p').textContent = 
          `Showing ${filteredProducts.length} products`;
  }
  
  // Function to show products for current page
  function showCurrentPageProducts() {
      const startIndex = (currentPage - 1) * productsPerPage;
      const endIndex = startIndex + productsPerPage;
      const currentPageProducts = filteredProducts.slice(startIndex, endIndex);
      
      // Hide all products first
      productCards.forEach(card => {
          card.style.display = 'none';
      });
      
      // Show current page products
      currentPageProducts.forEach(card => {
          card.style.display = 'block';
      });
      
      // Scroll to top of products section
      document.querySelector('.products-header').scrollIntoView({ behavior: 'smooth' });
  }
  
  
  
  // Quick view functionality
  quickViewButtons.forEach(button => {
      button.addEventListener('click', function(e) {
          e.preventDefault();
          
          // Get product data from card
          const productCard = this.closest('.product-card');
          const productImage = productCard.querySelector('.product-image img').src;
          const productTitle = productCard.querySelector('.product-title').textContent;
          const productPrice = productCard.querySelector('.product-price').innerHTML;
          const productColors = productCard.querySelector('.product-colors').innerHTML;
          
          // Populate modal with product data
          const modal = document.querySelector('.modal-container');
          modal.querySelector('.product-quick-view-image img').src = productImage;
          modal.querySelector('.product-title').textContent = productTitle;
          modal.querySelector('.product-price').innerHTML = productPrice;
          modal.querySelector('.product-colors').innerHTML = productColors;
          
          // Show modal
          modal.classList.add('active');
          document.body.style.overflow = 'hidden';
      });
  });
  
  // Close modal when clicking close button or overlay
  const modalClose = document.querySelector('.modal-close');
  const modalOverlay = document.querySelector('.modal-overlay');
  
  if (modalClose) {
      modalClose.addEventListener('click', closeModal);
  }
  
  if (modalOverlay) {
      modalOverlay.addEventListener('click', closeModal);
  }
  
  function closeModal() {
      document.querySelector('.modal-container').classList.remove('active');
      document.body.style.overflow = '';
  }
  
  // Size selection in quick view
  const sizeButtons = document.querySelectorAll('.size-btn');
  sizeButtons.forEach(button => {
      button.addEventListener('click', function() {
          sizeButtons.forEach(btn => btn.classList.remove('active'));
          this.classList.add('active');
      });
  });
  
  // Quantity selector in quick view
  const minusBtn = document.querySelector('.quantity-btn.minus');
  const plusBtn = document.querySelector('.quantity-btn.plus');
  const quantityInput = document.querySelector('.quantity-selector input');
  
  if (minusBtn && quantityInput) {
      minusBtn.addEventListener('click', function() {
          const currentValue = parseInt(quantityInput.value);
          if (currentValue > 1) {
              quantityInput.value = currentValue - 1;
          }
      });
  }
  
  if (plusBtn && quantityInput) {
      plusBtn.addEventListener('click', function() {
          const currentValue = parseInt(quantityInput.value);
          if (currentValue < 99) {
              quantityInput.value = currentValue + 1;
          }
      });
  }
  
  // Add to cart functionality
  const addToCartButtons = document.querySelectorAll('.add-to-cart');
  const modalAddToCartBtn = document.querySelector('.add-to-cart-btn');
  
  addToCartButtons.forEach(button => {
      button.addEventListener('click', function(e) {
          e.preventDefault();
          
          const productCard = this.closest('.product-card');
          const productTitle = productCard.querySelector('.product-title').textContent;
          
          // Show notification
          showNotification(`${productTitle} added to cart!`);
      });
  });
  
  if (modalAddToCartBtn) {
      modalAddToCartBtn.addEventListener('click', function() {
          const productTitle = document.querySelector('.modal-content .product-title').textContent;
          const quantity = document.querySelector('.quantity-selector input').value;
          
          // Show notification
          showNotification(`${quantity} × ${productTitle} added to cart!`);
          
          // Close modal
          closeModal();
      });
  }
  
  // Create notification element
  const notificationContainer = document.createElement('div');
  notificationContainer.className = 'notification-container';
  document.body.appendChild(notificationContainer);
  
  // Function to show notification
  function showNotification(message) {
      const notification = document.createElement('div');
      notification.className = 'notification';
      notification.innerHTML = `
          <div class="notification-icon">
              <i class="fas fa-check-circle"></i>
          </div>
          <div class="notification-message">${message}</div>
      `;
      
      notificationContainer.appendChild(notification);
      
      // Animate in
      setTimeout(() => {
          notification.classList.add('active');
      }, 10);
      
      // Remove after 3 seconds
      setTimeout(() => {
          notification.classList.remove('active');
          setTimeout(() => {
              notification.remove();
          }, 300);
      }, 3000);
  }
  
  // Create active filters display
  const filterContainer = document.querySelector('.filter-container');
  const activeFiltersDiv = document.createElement('div');
  activeFiltersDiv.className = 'active-filters';
  filterContainer.appendChild(activeFiltersDiv);
  
  // Function to update active filters display
  function updateActiveFilters() {
      if (currentFilter === 'all') {
          activeFiltersDiv.innerHTML = '';
          return;
      }
      
      activeFiltersDiv.innerHTML = `
          <div class="active-filter">
              ${currentFilter}
              <button class="remove-filter"><i class="fas fa-times"></i></button>
          </div>
      `;
      
      // Add event listener to remove filter button
      const removeFilterBtn = document.querySelector('.remove-filter');
      if (removeFilterBtn) {
          removeFilterBtn.addEventListener('click', function() {
              // Reset to "All" filter
              filterButtons.forEach(btn => {
                  if (btn.textContent.toLowerCase() === 'all') {
                      btn.click();
                  }
              });
          });
      }
  }
});