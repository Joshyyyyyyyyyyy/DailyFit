document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const navMobile = document.getElementById('nav-mobile');
    
    if (mobileMenuBtn && navMobile) {
      mobileMenuBtn.addEventListener('click', function() {
        this.classList.toggle('active');
        navMobile.classList.toggle('active');
      });
    }
    
    // Product data
    const products = [
      {
        id: 1,
        name: "Classic Cotton T-Shirt",
        category: "tshirt",
        price: 29.99,
        rating: 4.8,
        image: "image/2.jpg",
        colors: ["#000000", "#FFFFFF", "#6B7280"],
        isNew: true,
        isSale: false,
        description: "Our classic cotton t-shirt is a wardrobe essential. Made from 100% organic cotton for comfort and durability."
      },
      {
        id: 2,
        name: "Graphic Print T-Shirt",
        category: "tshirt",
        price: 34.99,
        rating: 4.5,
        image: "image/3.jpg",
        colors: ["#000000", "#FFFFFF"],
        isNew: false,
        isSale: false,
        description: "Express your style with our graphic print t-shirt featuring unique artwork designed by independent artists."
      },
      {
        id: 3,
        name: "Slim Fit T-Shirt",
        category: "tshirt",
        price: 24.99,
        originalPrice: 39.99,
        rating: 4.7,
        image: "image/4.jpg",
        colors: ["#000000", "#FFFFFF", "#EF4444", "#3B82F6"],
        isNew: false,
        isSale: true,
        description: "Our slim fit t-shirt offers a modern silhouette that flatters your body shape while providing all-day comfort."
      },
      {
        id: 4,
        name: "Striped T-Shirt",
        category: "tshirt",
        price: 32.99,
        rating: 4.6,
        image: "image/5.jpg",
        colors: ["#000000", "#FFFFFF", "#6B7280"],
        isNew: false,
        isSale: false,
        description: "Classic striped pattern meets modern design in this versatile t-shirt that pairs well with any outfit."
      },
      {
        id: 5,
        name: "Oversized T-Shirt",
        category: "tshirt",
        price: 39.99,
        rating: 4.9,
        image: "https://placehold.co/400x400?text=T-Shirt+5",
        colors: ["#000000", "#FFFFFF", "#6B7280"],
        isNew: true,
        isSale: false,
        description: "Embrace the relaxed trend with our oversized t-shirt, perfect for a casual, effortless look."
      },
      {
        id: 6,
        name: "Essential Hoodie",
        category: "hoodie",
        price: 59.99,
        rating: 4.9,
        image: "https://placehold.co/400x400?text=Hoodie+1",
        colors: ["#000000", "#6B7280", "#3B82F6"],
        isNew: true,
        isSale: false,
        description: "Our essential hoodie is crafted from premium fleece for ultimate comfort and warmth during cold weather. Features a kangaroo pocket and adjustable hood."
      },
      {
        id: 7,
        name: "Zip-Up Hoodie",
        category: "hoodie",
        price: 64.99,
        rating: 4.7,
        image: "https://placehold.co/400x400?text=Hoodie+2",
        colors: ["#000000", "#6B7280", "#10B981"],
        isNew: false,
        isSale: false,
        description: "Our zip-up hoodie offers versatility and style with a full-length zipper and ribbed cuffs for a secure fit."
      },
      {
        id: 8,
        name: "Pullover Hoodie",
        category: "hoodie",
        price: 49.99,
        originalPrice: 69.99,
        rating: 4.8,
        image: "https://placehold.co/400x400?text=Hoodie+3",
        colors: ["#000000", "#FFFFFF", "#EF4444"],
        isNew: false,
        isSale: true,
        description: "Stay cozy in our pullover hoodie featuring a relaxed fit and soft brushed interior for extra comfort."
      },
      {
        id: 9,
        name: "Graphic Hoodie",
        category: "hoodie",
        price: 69.99,
        rating: 4.6,
        image: "https://placehold.co/400x400?text=Hoodie+4",
        colors: ["#000000", "#3B82F6"],
        isNew: false,
        isSale: false,
        description: "Make a statement with our graphic hoodie featuring bold designs and premium construction."
      },
      {
        id: 10,
        name: "Athletic Shorts",
        category: "short",
        price: 34.99,
        rating: 4.7,
        image: "https://placehold.co/400x400?text=Shorts+1",
        colors: ["#000000", "#6B7280"],
        isNew: true,
        isSale: false,
        description: "Our athletic shorts are designed for performance with moisture-wicking fabric and a comfortable elastic waistband."
      },
      {
        id: 11,
        name: "Denim Shorts",
        category: "short",
        price: 44.99,
        rating: 4.5,
        image: "https://placehold.co/400x400?text=Shorts+2",
        colors: ["#000000", "#6B7280"],
        isNew: false,
        isSale: false,
        description: "Classic denim shorts with a modern fit, perfect for casual summer days."
      },
      {
        id: 12,
        name: "Chino Shorts",
        category: "short",
        price: 39.99,
        originalPrice: 54.99,
        rating: 4.6,
        image: "https://placehold.co/400x400?text=Shorts+3",
        colors: ["#000000", "#6B7280", "#F59E0B"],
        isNew: false,
        isSale: true,
        description: "Our chino shorts combine style and comfort with a tailored fit and soft cotton twill fabric."
      },
      {
        id: 13,
        name: "Cargo Shorts",
        category: "short",
        price: 49.99,
        rating: 4.4,
        image: "https://placehold.co/400x400?text=Shorts+4",
        colors: ["#000000", "#6B7280", "#10B981"],
        isNew: false,
        isSale: false,
        description: "Functional and stylish cargo shorts with multiple pockets for all your essentials."
      },
      {
        id: 14,
        name: "V-Neck T-Shirt",
        category: "tshirt",
        price: 29.99,
        rating: 4.5,
        image: "https://placehold.co/400x400?text=T-Shirt+6",
        colors: ["#000000", "#FFFFFF", "#3B82F6"],
        isNew: false,
        isSale: false,
        description: "Our V-neck t-shirt offers a flattering neckline and soft, breathable fabric for everyday comfort."
      },
      {
        id: 15,
        name: "Long Sleeve T-Shirt",
        category: "tshirt",
        price: 34.99,
        rating: 4.7,
        image: "https://placehold.co/400x400?text=T-Shirt+7",
        colors: ["#000000", "#FFFFFF", "#6B7280"],
        isNew: false,
        isSale: false,
        description: "Perfect for layering or wearing alone, our long sleeve t-shirt provides comfort in any season."
      },
      {
        id: 16,
        name: "Cropped Hoodie",
        category: "hoodie",
        price: 54.99,
        rating: 4.8,
        image: "https://placehold.co/400x400?text=Hoodie+5",
        colors: ["#000000", "#F59E0B", "#EC4899"],
        isNew: true,
        isSale: false,
        description: "Stay on trend with our cropped hoodie featuring a modern silhouette and ultra-soft fabric."
      },
      {
        id: 17,
        name: "Pocket T-Shirt",
        category: "tshirt",
        price: 27.99,
        rating: 4.6,
        image: "https://placehold.co/400x400?text=T-Shirt+8",
        colors: ["#000000", "#FFFFFF", "#6B7280"],
        isNew: false,
        isSale: false,
        description: "A classic pocket t-shirt with a modern fit, perfect for everyday wear."
      },
      {
        id: 18,
        name: "Tech Shorts",
        category: "short",
        price: 44.99,
        rating: 4.9,
        image: "https://placehold.co/400x400?text=Shorts+5",
        colors: ["#000000", "#6B7280"],
        isNew: true,
        isSale: false,
        description: "Our tech shorts feature quick-dry fabric and hidden pockets, perfect for active lifestyles."
      },
      {
        id: 19,
        name: "Heavyweight Hoodie",
        category: "hoodie",
        price: 79.99,
        originalPrice: 99.99,
        rating: 4.9,
        image: "https://placehold.co/400x400?text=Hoodie+6",
        colors: ["#000000", "#6B7280"],
        isNew: false,
        isSale: true,
        description: "Our heavyweight hoodie provides exceptional warmth and durability for the coldest days."
      },
      {
        id: 20,
        name: "Vintage Wash T-Shirt",
        category: "tshirt",
        price: 34.99,
        rating: 4.7,
        image: "https://placehold.co/400x400?text=T-Shirt+9",
        colors: ["#000000", "#6B7280", "#F59E0B"],
        isNew: false,
        isSale: false,
        description: "Our vintage wash t-shirt has a lived-in feel from the first wear with a perfectly faded look."
      }
    ];
    
    // State
    let currentPage = 1;
    const productsPerPage = 16;
    let filteredProducts = [...products];
    let activeFilters = {
      category: 'all',
      price: 'all',
      sort: 'featured'
    };
    
    // Initialize
    renderProducts();
    renderPagination();
    setupEventListeners();
    
    // Functions
    function renderProducts() {
      const productsGrid = document.getElementById('products-grid');
      if (!productsGrid) return;
      
      // Apply filters
      let filtered = [...products];
      
      // Category filter
      if (activeFilters.category !== 'all') {
        filtered = filtered.filter(product => product.category === activeFilters.category);
      }
      
      // Price filter
      if (activeFilters.price !== 'all') {
        const [min, max] = activeFilters.price.split('-');
        if (max === '+') {
          filtered = filtered.filter(product => product.price >= parseInt(min));
        } else {
          filtered = filtered.filter(product => 
            product.price >= parseInt(min) && product.price <= parseInt(max)
          );
        }
      }
      
      // Sort
      switch (activeFilters.sort) {
        case 'price-low':
          filtered.sort((a, b) => a.price - b.price);
          break;
        case 'price-high':
          filtered.sort((a, b) => b.price - a.price);
          break;
        case 'newest':
          filtered.sort((a, b) => b.isNew ? 1 : -1);
          break;
        default: // featured
          // Keep original order
          break;
      }
      
      filteredProducts = filtered;
      
      // Pagination
      const startIndex = (currentPage - 1) * productsPerPage;
      const endIndex = startIndex + productsPerPage;
      const paginatedProducts = filtered.slice(startIndex, endIndex);
      
      // Render products
      if (paginatedProducts.length === 0) {
        productsGrid.innerHTML = `
          <div class="no-results">
            <h3>No products found</h3>
            <p>Try adjusting your filters to find what you're looking for.</p>
            <button class="btn btn-primary" id="reset-filters">Reset Filters</button>
          </div>
        `;
        
        const resetButton = document.getElementById('reset-filters');
        if (resetButton) {
          resetButton.addEventListener('click', resetFilters);
        }
        
        return;
      }
      
      productsGrid.innerHTML = paginatedProducts.map(product => `
        <div class="product-card" data-id="${product.id}">
          <div class="product-image">
            ${product.isNew ? '<span class="product-badge badge-new">New</span>' : ''}
            ${product.isSale ? '<span class="product-badge badge-sale">Sale</span>' : ''}
            <img src="${product.image}" alt="${product.name}">
            <div class="product-actions">
              <button class="action-btn quick-view-btn" aria-label="Quick view" data-id="${product.id}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                  <circle cx="12" cy="12" r="3"></circle>
                </svg>
              </button>
              <button class="action-btn" aria-label="Add to wishlist">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                </svg>
              </button>
            </div>
          </div>
          <div class="product-info">
            <div class="product-category">${product.category}</div>
            <h3 class="product-title">${product.name}</h3>
            <div class="product-meta">
              <div class="product-price">
                ${product.originalPrice ? `<span class="original-price">$${product.originalPrice.toFixed(2)}</span>` : ''}
                <span class="${product.originalPrice ? 'sale-price' : ''}">${formatPrice(product.price)}</span>
              </div>
              <div class="product-rating">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                </svg>
                <span>${product.rating}</span>
              </div>
            </div>
            <div class="product-colors">
              ${product.colors.map(color => `
                <div class="color-option" style="background-color: ${color}"></div>
              `).join('')}
            </div>
            <button class="btn btn-primary btn-sm">Add to Cart</button>
          </div>
        </div>
      `).join('');
      
      // Add event listeners to quick view buttons
      const quickViewButtons = document.querySelectorAll('.quick-view-btn');
      quickViewButtons.forEach(button => {
        button.addEventListener('click', function() {
          const productId = parseInt(this.getAttribute('data-id'));
          openQuickView(productId);
        });
      });
    }
    
    function renderPagination() {
      const paginationContainer = document.getElementById('pagination');
      if (!paginationContainer) return;
      
      const totalPages = Math.ceil(filteredProducts.length / productsPerPage);
      
      if (totalPages <= 1) {
        paginationContainer.innerHTML = '';
        return;
      }
      
      let paginationHTML = `
        <button class="page-item ${currentPage === 1 ? 'disabled' : ''}" id="prev-page">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6"></polyline>
          </svg>
        </button>
      `;
      
      // Determine which page numbers to show
      let startPage = Math.max(1, currentPage - 2);
      let endPage = Math.min(totalPages, startPage + 4);
      
      if (endPage - startPage < 4) {
        startPage = Math.max(1, endPage - 4);
      }
      
      for (let i = startPage; i <= endPage; i++) {
        paginationHTML += `
          <button class="page-item ${i === currentPage ? 'active' : ''}" data-page="${i}">${i}</button>
        `;
      }
      
      paginationHTML += `
        <button class="page-item ${currentPage === totalPages ? 'disabled' : ''}" id="next-page">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="9 18 15 12 9 6"></polyline>
          </svg>
        </button>
      `;
      
      paginationContainer.innerHTML = paginationHTML;
      
      // Add event listeners to pagination buttons
      const pageButtons = document.querySelectorAll('.page-item[data-page]');
      pageButtons.forEach(button => {
        button.addEventListener('click', function() {
          currentPage = parseInt(this.getAttribute('data-page'));
          renderProducts();
          renderPagination();
          window.scrollTo({ top: 0, behavior: 'smooth' });
        });
      });
      
      const prevButton = document.getElementById('prev-page');
      if (prevButton && currentPage > 1) {
        prevButton.addEventListener('click', function() {
          currentPage--;
          renderProducts();
          renderPagination();
          window.scrollTo({ top: 0, behavior: 'smooth' });
        });
      }
      
      const nextButton = document.getElementById('next-page');
      if (nextButton && currentPage < totalPages) {
        nextButton.addEventListener('click', function() {
          currentPage++;
          renderProducts();
          renderPagination();
          window.scrollTo({ top: 0, behavior: 'smooth' });
        });
      }
    }
    
    function setupEventListeners() {
      // Category filter buttons
      const categoryButtons = document.querySelectorAll('.filter-btn[data-category]');
      categoryButtons.forEach(button => {
        button.addEventListener('click', function() {
          const category = this.getAttribute('data-category');
          
          // Update active state
          categoryButtons.forEach(btn => btn.classList.remove('active'));
          this.classList.add('active');
          
          // Update filters
          activeFilters.category = category;
          currentPage = 1;
          
          // Update UI
          renderProducts();
          renderPagination();
          updateActiveFiltersUI();
        });
      });
      
      // Price filter
      const priceFilter = document.getElementById('price-filter');
      if (priceFilter) {
        priceFilter.addEventListener('change', function() {
          activeFilters.price = this.value;
          currentPage = 1;
          renderProducts();
          renderPagination();
          updateActiveFiltersUI();
        });
      }
      
      // Sort select
      const sortSelect = document.getElementById('sort-select');
      if (sortSelect) {
        sortSelect.addEventListener('change', function() {
          activeFilters.sort = this.value;
          renderProducts();
          updateActiveFiltersUI();
        });
      }
      
      // Modal close button
      const modalCloseBtn = document.getElementById('modal-close');
      const quickViewModal = document.getElementById('quick-view-modal');
      
      if (modalCloseBtn && quickViewModal) {
        modalCloseBtn.addEventListener('click', function() {
          quickViewModal.classList.remove('active');
          document.body.style.overflow = '';
        });
        
        // Close modal when clicking outside
        quickViewModal.addEventListener('click', function(e) {
          if (e.target === quickViewModal) {
            quickViewModal.classList.remove('active');
            document.body.style.overflow = '';
          }
        });
      }
    }
    
    function updateActiveFiltersUI() {
      const activeFiltersContainer = document.getElementById('active-filters');
      if (!activeFiltersContainer) return;
      
      let filtersHTML = '';
      
      // Category filter
      if (activeFilters.category !== 'all') {
        filtersHTML += `
          <div class="active-filter">
            Category: ${capitalizeFirstLetter(activeFilters.category)}
            <button class="remove-filter" data-filter="category" data-value="all">
              <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
              </svg>
            </button>
          </div>
        `;
      }
      
      // Price filter
      if (activeFilters.price !== 'all') {
        let priceLabel = '';
        const [min, max] = activeFilters.price.split('-');
        
        if (max === '+') {
          priceLabel = `$${min}+`;
        } else {
          priceLabel = `$${min} - $${max}`;
        }
        
        filtersHTML += `
          <div class="active-filter">
            Price: ${priceLabel}
            <button class="remove-filter" data-filter="price" data-value="all">
              <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
              </svg>
            </button>
          </div>
        `;
      }
      
      // Sort filter
      if (activeFilters.sort !== 'featured') {
        let sortLabel = '';
        
        switch (activeFilters.sort) {
          case 'price-low':
            sortLabel = 'Price: Low to High';
            break;
          case 'price-high':
            sortLabel = 'Price: High to Low';
            break;
          case 'newest':
            sortLabel = 'Newest';
            break;
        }
        
        filtersHTML += `
          <div class="active-filter">
            Sort: ${sortLabel}
            <button class="remove-filter" data-filter="sort" data-value="featured">
              <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
              </svg>
            </button>
          </div>
        `;
      }
      
      // Add clear all button if there are active filters
      if (filtersHTML) {
        filtersHTML += `
          <button class="btn btn-sm btn-outline" id="clear-all-filters">Clear All</button>
        `;
      }
      
      activeFiltersContainer.innerHTML = filtersHTML;
      
      // Add event listeners to remove filter buttons
      const removeFilterButtons = document.querySelectorAll('.remove-filter');
      removeFilterButtons.forEach(button => {
        button.addEventListener('click', function() {
          const filter = this.getAttribute('data-filter');
          const value = this.getAttribute('data-value');
          
          activeFilters[filter] = value;
          
          // Update UI for category buttons
          if (filter === 'category') {
            const categoryButtons = document.querySelectorAll('.filter-btn[data-category]');
            categoryButtons.forEach(btn => {
              btn.classList.toggle('active', btn.getAttribute('data-category') === value);
            });
          }
          
          // Update UI for price select
          if (filter === 'price') {
            const priceFilter = document.getElementById('price-filter');
            if (priceFilter) {
              priceFilter.value = value;
            }
          }
          
          // Update UI for sort select
          if (filter === 'sort') {
            const sortSelect = document.getElementById('sort-select');
            if (sortSelect) {
              sortSelect.value = value;
            }
          }
          
          currentPage = 1;
          renderProducts();
          renderPagination();
          updateActiveFiltersUI();
        });
      });
      
      // Add event listener to clear all button
      const clearAllButton = document.getElementById('clear-all-filters');
      if (clearAllButton) {
        clearAllButton.addEventListener('click', resetFilters);
      }
    }
    
    function resetFilters() {
      activeFilters = {
        category: 'all',
        price: 'all',
        sort: 'featured'
      };
      
      // Update UI for category buttons
      const categoryButtons = document.querySelectorAll('.filter-btn[data-category]');
      categoryButtons.forEach(btn => {
        btn.classList.toggle('active', btn.getAttribute('data-category') === 'all');
      });
      
      // Update UI for price select
      const priceFilter = document.getElementById('price-filter');
      if (priceFilter) {
        priceFilter.value = 'all';
      }
      
      // Update UI for sort select
      const sortSelect = document.getElementById('sort-select');
      if (sortSelect) {
        sortSelect.value = 'featured';
      }
      
      currentPage = 1;
      renderProducts();
      renderPagination();
      updateActiveFiltersUI();
    }
    
    function openQuickView(productId) {
      const product = products.find(p => p.id === productId);
      if (!product) return;
      
      const modalBody = document.getElementById('modal-body');
      const quickViewModal = document.getElementById('quick-view-modal');
      
      if (!modalBody || !quickViewModal) return;
      
      modalBody.innerHTML = `
        <div class="quick-view">
          <div class="quick-view-images">
            <div class="main-image">
              <img src="${product.image}" alt="${product.name}">
            </div>
            <div class="image-thumbnails">
              <div class="thumbnail active">
                <img src="${product.image}" alt="${product.name}">
              </div>
              <div class="thumbnail">
                <img src="${product.image}" alt="${product.name}">
              </div>
              <div class="thumbnail">
                <img src="${product.image}" alt="${product.name}">
              </div>
            </div>
          </div>
          <div class="quick-view-details">
            <div class="quick-view-category">${product.category}</div>
            <h2>${product.name}</h2>
            <div class="quick-view-price">
              ${product.originalPrice ? `<span class="original-price">$${product.originalPrice.toFixed(2)}</span>` : ''}
              <span class="${product.originalPrice ? 'sale-price' : ''}">${formatPrice(product.price)}</span>
            </div>
            <div class="product-rating">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
              </svg>
              <span>${product.rating} (24 reviews)</span>
            </div>
            <p class="quick-view-description">${product.description}</p>
            
            <div class="quick-view-options">
              <div class="option-group">
                <label>Color</label>
                <div class="color-options">
                  ${product.colors.map((color, index) => `
                    <div class="color-option-large ${index === 0 ? 'active' : ''}" style="background-color: ${color}"></div>
                  `).join('')}
                </div>
              </div>
              
              <div class="option-group">
                <label>Size</label>
                <div class="size-options">
                  <div class="size-option">XS</div>
                  <div class="size-option active">S</div>
                  <div class="size-option">M</div>
                  <div class="size-option">L</div>
                  <div class="size-option">XL</div>
                  <div class="size-option disabled">XXL</div>
                </div>
              </div>
              
              <div class="option-group">
                <label>Quantity</label>
                <div class="quantity-selector">
                  <button class="quantity-btn" id="decrease-quantity">-</button>
                  <input type="number" class="quantity-input" value="1" min="1" max="10">
                  <button class="quantity-btn" id="increase-quantity">+</button>
                </div>
              </div>
            </div>
            
            <div class="quick-view-actions">
              <button class="btn btn-primary">Add to Cart</button>
              <button class="btn btn-outline">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                </svg>
                Wishlist
              </button>
            </div>
          </div>
        </div>
      `;
      
      // Show modal
      quickViewModal.classList.add('active');
      document.body.style.overflow = 'hidden';
      
      // Add event listeners for quantity buttons
      const decreaseBtn = document.getElementById('decrease-quantity');
      const increaseBtn = document.getElementById('increase-quantity');
      const quantityInput = document.querySelector('.quantity-input');
      
      if (decreaseBtn && increaseBtn && quantityInput) {
        decreaseBtn.addEventListener('click', function() {
          const currentValue = parseInt(quantityInput.value);
          if (currentValue > 1) {
            quantityInput.value = currentValue - 1;
          }
        });
        
        increaseBtn.addEventListener('click', function() {
          const currentValue = parseInt(quantityInput.value);
          if (currentValue < 10) {
            quantityInput.value = currentValue + 1;
          }
        });
      }
      
      // Add event listeners for color options
      const colorOptions = document.querySelectorAll('.color-option-large');
      colorOptions.forEach(option => {
        option.addEventListener('click', function() {
          colorOptions.forEach(opt => opt.classList.remove('active'));
          this.classList.add('active');
        });
      });
      
      // Add event listeners for size options
      const sizeOptions = document.querySelectorAll('.size-option:not(.disabled)');
      sizeOptions.forEach(option => {
        option.addEventListener('click', function() {
          sizeOptions.forEach(opt => opt.classList.remove('active'));
          this.classList.add('active');
        });
      });
      
      // Add event listeners for thumbnails
      const thumbnails = document.querySelectorAll('.thumbnail');
      thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', function() {
          thumbnails.forEach(thumb => thumb.classList.remove('active'));
          this.classList.add('active');
          
          // Update main image
          const mainImage = document.querySelector('.main-image img');
          const thumbnailImage = this.querySelector('img');
          if (mainImage && thumbnailImage) {
            mainImage.src = thumbnailImage.src;
          }
        });
      });
    }
    
    // Helper functions
    function formatPrice(price) {
      return `$${price.toFixed(2)}`;
    }
    
    function capitalizeFirstLetter(string) {
      return string.charAt(0).toUpperCase() + string.slice(1);
    }
  });