document.addEventListener('DOMContentLoaded', function() {
    // DOM Elements
    const themeToggle = document.getElementById('theme-toggle-checkbox');
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const sidebar = document.querySelector('.sidebar');
    const mainContent = document.querySelector('.main-content');
    const notificationBtn = document.querySelector('.notification-btn');
    const notificationDropdown = document.querySelector('.notification-dropdown');
    const profileBtn = document.querySelector('.profile-btn');
    const profileDropdown = document.querySelector('.profile-dropdown');
    const markAllReadBtn = document.querySelector('.mark-all-read');
    const chartActionBtns = document.querySelectorAll('.chart-action-btn');
    
    // Theme Toggle
    themeToggle.addEventListener('change', function() {
      document.body.classList.toggle('dark-mode');
      
      // Save theme preference to localStorage
      if (document.body.classList.contains('dark-mode')) {
        localStorage.setItem('theme', 'dark');
      } else {
        localStorage.setItem('theme', 'light');
      }
    });
    
    // Check for saved theme preference
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
      document.body.classList.add('dark-mode');
      themeToggle.checked = true;
    }
    
    // Sidebar Toggle
    sidebarToggle.addEventListener('click', function() {
      sidebar.classList.toggle('collapsed');
      mainContent.classList.toggle('expanded');
      
      // Save sidebar state to localStorage
      if (sidebar.classList.contains('collapsed')) {
        localStorage.setItem('sidebar', 'collapsed');
      } else {
        localStorage.setItem('sidebar', 'expanded');
      }
    });
    
    // Check for saved sidebar state
    const savedSidebar = localStorage.getItem('sidebar');
    if (savedSidebar === 'collapsed') {
      sidebar.classList.add('collapsed');
      mainContent.classList.add('expanded');
    }
    
    // Mobile Sidebar Toggle
    document.addEventListener('click', function(e) {
      if (window.innerWidth <= 768) {
        if (e.target.closest('#sidebar-toggle')) {
          sidebar.classList.toggle('mobile-visible');
        } else if (!e.target.closest('.sidebar') && sidebar.classList.contains('mobile-visible')) {
          sidebar.classList.remove('mobile-visible');
        }
      }
    });
    
    // Mark all notifications as read
    if (markAllReadBtn) {
      markAllReadBtn.addEventListener('click', function() {
        const unreadNotifications = document.querySelectorAll('.notification-item.unread');
        unreadNotifications.forEach(notification => {
          notification.classList.remove('unread');
        });
        
        const notificationBadge = document.querySelector('.notification-badge');
        if (notificationBadge) {
          notificationBadge.style.display = 'none';
        }
      });
    }
    
    // Chart Action Buttons
    chartActionBtns.forEach(btn => {
      btn.addEventListener('click', function() {
        if (this.dataset.period) {
          const parent = this.closest('.chart-actions');
          parent.querySelectorAll('.chart-action-btn').forEach(b => {
            b.classList.remove('active');
          });
          this.classList.add('active');
          
          // Update chart data based on period
          if (this.dataset.period !== 'export') {
            updateChartData(this.closest('.chart-container').querySelector('canvas').id, this.dataset.period);
          } else {
            exportChart(this.closest('.chart-container').querySelector('canvas').id);
          }
        }
      });
    });
    
    // Initialize Charts
    initializeCharts();
    
    // Window resize event
    window.addEventListener('resize', function() {
      if (window.innerWidth > 768 && sidebar.classList.contains('mobile-visible')) {
        sidebar.classList.remove('mobile-visible');
      }
    });
  });
  
  // Initialize Charts
  function initializeCharts() {
    // Small Charts for Stats
    const salesChartCtx = document.getElementById('salesChart');
    const ordersChartCtx = document.getElementById('ordersChart');
    const customersChartCtx = document.getElementById('customersChart');
    const conversionChartCtx = document.getElementById('conversionChart');
    
    // Common options for small charts
    const smallChartOptions = {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: false
        },
        tooltip: {
          enabled: false
        }
      },
      scales: {
        x: {
          display: false
        },
        y: {
          display: false
        }
      },
      elements: {
        line: {
          tension: 0.4,
          borderWidth: 2
        },
        point: {
          radius: 0
        }
      }
    };
    
    // Sales Chart
    new Chart(salesChartCtx, {
      type: 'line',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        datasets: [{
          data: [12, 19, 13, 15, 20, 18, 22],
          borderColor: '#3a86ff',
          backgroundColor: 'rgba(58, 134, 255, 0.1)',
          fill: true
        }]
      },
      options: smallChartOptions
    });
    
    // Orders Chart
    new Chart(ordersChartCtx, {
      type: 'line',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        datasets: [{
          data: [65, 78, 90, 85, 95, 100, 110],
          borderColor: '#10b981',
          backgroundColor: 'rgba(16, 185, 129, 0.1)',
          fill: true
        }]
      },
      options: smallChartOptions
    });
    
    // Customers Chart
    new Chart(customersChartCtx, {
      type: 'line',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        datasets: [{
          data: [220, 240, 270, 250, 285, 300, 320],
          borderColor: '#f59e0b',
          backgroundColor: 'rgba(245, 158, 11, 0.1)',
          fill: true
        }]
      },
      options: smallChartOptions
    });
    
    // Conversion Chart
    new Chart(conversionChartCtx, {
      type: 'line',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        datasets: [{
          data: [3.2, 3.5, 3.8, 3.6, 3.9, 3.7, 3.2],
          borderColor: '#ff006e',
          backgroundColor: 'rgba(255, 0, 110, 0.1)',
          fill: true
        }]
      },
      options: smallChartOptions
    });
    
    // Sales Overview Chart
    const salesOverviewCtx = document.getElementById('salesOverviewChart');
    new Chart(salesOverviewCtx, {
      type: 'line',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
          label: 'This Year',
          data: [18000, 19000, 21000, 20000, 22000, 25000, 24000, 26000, 27000, 29000, 30000, 32000],
          borderColor: '#3a86ff',
          backgroundColor: 'rgba(58, 134, 255, 0.1)',
          fill: true
        }, {
          label: 'Last Year',
          data: [15000, 16000, 17000, 18000, 19000, 20000, 21000, 22000, 23000, 24000, 25000, 26000],
          borderColor: '#6b7280',
          backgroundColor: 'rgba(107, 114, 128, 0.1)',
          fill: true
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: 'top',
            labels: {
              usePointStyle: true,
              boxWidth: 6
            }
          },
          tooltip: {
            mode: 'index',
            intersect: false
          }
        },
        scales: {
          x: {
            grid: {
              display: false
            }
          },
          y: {
            beginAtZero: true,
            grid: {
              color: 'rgba(107, 114, 128, 0.1)'
            },
            ticks: {
              callback: function(value) {
                return '$' + value.toLocaleString();
              }
            }
          }
        },
        elements: {
          line: {
            tension: 0.4
          },
          point: {
            radius: 2,
            hoverRadius: 4
          }
        },
        interaction: {
          mode: 'nearest',
          axis: 'x',
          intersect: false
        }
      }
    });
    
    // Top Products Chart
    const topProductsCtx = document.getElementById('topProductsChart');
    new Chart(topProductsCtx, {
      type: 'bar',
      data: {
        labels: ['Classic T-Shirt', 'Essential Hoodie', 'Graphic Tee', 'Athletic Shorts', 'Zip-Up Hoodie'],
        datasets: [{
          label: 'Units Sold',
          data: [320, 280, 250, 220, 190],
          backgroundColor: [
            'rgba(58, 134, 255, 0.8)',
            'rgba(58, 134, 255, 0.7)',
            'rgba(58, 134, 255, 0.6)',
            'rgba(58, 134, 255, 0.5)',
            'rgba(58, 134, 255, 0.4)'
          ],
          borderColor: [
            'rgba(58, 134, 255, 1)',
            'rgba(58, 134, 255, 1)',
            'rgba(58, 134, 255, 1)',
            'rgba(58, 134, 255, 1)',
            'rgba(58, 134, 255, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        indexAxis: 'y',
        plugins: {
          legend: {
            display: false
          }
        },
        scales: {
          x: {
            beginAtZero: true,
            grid: {
              display: false
            }
          },
          y: {
            grid: {
              display: false
            }
          }
        }
      }
    });
    
    // Category Sales Chart
    const categorySalesCtx = document.getElementById('categorySalesChart');
    new Chart(categorySalesCtx, {
      type: 'doughnut',
      data: {
        labels: ['T-Shirts', 'Hoodies', 'Shorts', 'Accessories'],
        datasets: [{
          data: [45, 30, 15, 10],
          backgroundColor: [
            '#3a86ff',
            '#10b981',
            '#f59e0b',
            '#6b7280'
          ],
          borderWidth: 0
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: 'bottom',
            labels: {
              usePointStyle: true,
              boxWidth: 6
            }
          },
          tooltip: {
            callbacks: {
              label: function(context) {
                return context.label + ': ' + context.parsed + '%';
              }
            }
          }
        },
        cutout: '70%'
      }
    });
  }
  
  // Update Chart Data based on period
  function updateChartData(chartId, period) {
    // This function would update the chart data based on the selected period
    // For demonstration purposes, we'll just log the action
    console.log(`Updating ${chartId} with ${period} data`);
    
    // In a real application, you would fetch data for the selected period
    // and update the chart using chart.data.datasets and chart.update()
  }
  
  // Export Chart as image
  function exportChart(chartId) {
    const canvas = document.getElementById(chartId);
    const image = canvas.toDataURL('image/png');
    
    // Create a temporary link to download the image
    const link = document.createElement('a');
    link.download = `${chartId}-export.png`;
    link.href = image;
    link.click();
  }