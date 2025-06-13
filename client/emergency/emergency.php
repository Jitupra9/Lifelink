<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blood & Organ Request Dashboard</title>
  <style>
    /* Reset and base styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background-color: #f5f5f5;
      color: #333;
      line-height: 1.6;
    }

    /* Layout */
    .container {
      width: 100%;
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
    }

    header {
      background-color: white;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      padding: 20px 0;
    }

    header h1 {
      font-size: 1.8rem;
      color: #333;
      margin-bottom: 5px;
    }

    header p {
      color: #666;
    }

    main {
      padding: 30px 0;
    }

    footer {
      background-color: white;
      border-top: 1px solid #eee;
      padding: 20px 0;
      text-align: center;
      font-size: 0.9rem;
      color: #666;
      margin-top: 30px;
    }

    /* Filter section */
    .filters {
      background-color: white;
      border-radius: 8px;
      padding: 20px;
      margin-bottom: 30px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
      border: 1px solid #eee;
    }

    .filters h2 {
      font-size: 1.2rem;
      margin-bottom: 15px;
    }

    .filter-tabs {
      display: flex;
      margin-bottom: 20px;
      border-radius: 5px;
      overflow: hidden;
      border: 1px solid #ddd;
    }

    .filter-tab {
      flex: 1;
      text-align: center;
      padding: 10px;
      background-color: #f5f5f5;
      cursor: pointer;
      transition: background-color 0.2s;
    }

    .filter-tab.active {
      background-color: #e63946;
      color: white;
    }

    .filter-options {
      display: grid;
      grid-template-columns: 1fr;
      gap: 15px;
    }

    @media (min-width: 768px) {
      .filter-options {
        grid-template-columns: repeat(3, 1fr);
      }
    }

    .filter-group {
      display: flex;
      flex-direction: column;
    }

    .filter-group label {
      margin-bottom: 5px;
      font-size: 0.9rem;
      font-weight: 500;
    }

    .filter-group select,
    .filter-group input {
      padding: 8px 12px;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-size: 0.9rem;
    }

    .emergency-toggle {
      display: flex;
      align-items: center;
      margin-top: 15px;
    }

    .emergency-toggle input {
      margin-right: 10px;
    }

    /* Request cards */
    .requests-container {
      display: grid;
      grid-template-columns: 1fr;
      gap: 20px;
    }

    @media (min-width: 640px) {
      .requests-container {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (min-width: 1024px) {
      .requests-container {
        grid-template-columns: repeat(3, 1fr);
      }
    }

    .request-card {
      background-color: white;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      border: 1px solid #eee;
      transition: transform 0.2s, box-shadow 0.2s;
    }

    .request-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .request-card.emergency {
      background-color: #fff5f5;
      border-color: #e63946;
    }

    .card-header {
      padding: 15px;
      border-bottom: 1px solid #eee;
      position: relative;
    }

    .card-header h3 {
      display: flex;
      align-items: center;
      font-size: 1.1rem;
      margin-bottom: 5px;
    }

    .card-header h3 .icon {
      margin-right: 8px;
      color: #e63946;
    }

    .card-header .type {
      font-size: 0.85rem;
      color: #666;
    }

    .emergency-badge {
      position: absolute;
      top: 15px;
      right: 15px;
      background-color: #e63946;
      color: white;
      font-size: 0.75rem;
      padding: 3px 8px;
      border-radius: 12px;
      display: flex;
      align-items: center;
    }

    .emergency-badge .icon {
      margin-right: 4px;
      font-size: 0.7rem;
    }

    .card-content {
      padding: 15px;
    }

    .info-item {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
      font-size: 0.9rem;
    }

    .info-item .icon {
      margin-right: 8px;
      color: #666;
      min-width: 16px;
    }

    .info-item .time-ago {
      font-size: 0.75rem;
      color: #666;
      margin-left: 5px;
    }

    .card-footer {
      padding: 15px;
      border-top: 1px solid #eee;
    }

    .contact-btn {
      width: 100%;
      padding: 10px;
      background-color: #e63946;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-weight: 500;
      transition: background-color 0.2s;
    }

    .contact-btn:hover {
      background-color: #d62b39;
    }

    /* Icons */
    .icon {
      display: inline-block;
      width: 1em;
      height: 1em;
      stroke-width: 0;
      stroke: currentColor;
      fill: currentColor;
      vertical-align: middle;
    }
  </style>
</head>
<body>
  <header>
    <div class="container">
      <h1>Blood & Organ Request Dashboard</h1>
      <p>View and respond to current blood and organ donation requests</p>
    </div>
  </header>

  <main class="container">
    <section class="filters">
      <h2>Filter Requests</h2>
      
      <div class="filter-tabs">
        <div class="filter-tab active" data-filter="all">All Requests</div>
        <div class="filter-tab" data-filter="blood">Blood</div>
        <div class="filter-tab" data-filter="organ">Organ</div>
      </div>
      
      <div class="filter-options">
        <div class="filter-group">
          <label for="blood-type">Blood Type</label>
          <select id="blood-type">
            <option value="any">Any blood type</option>
            <option value="a-positive">A Positive</option>
            <option value="a-negative">A Negative</option>
            <option value="b-positive">B Positive</option>
            <option value="b-negative">B Negative</option>
            <option value="ab-positive">AB Positive</option>
            <option value="ab-negative">AB Negative</option>
            <option value="o-positive">O Positive</option>
            <option value="o-negative">O Negative</option>
          </select>
        </div>
        
        <div class="filter-group">
          <label for="organ-type">Organ Type</label>
          <select id="organ-type">
            <option value="any">Any organ type</option>
            <option value="kidney">Kidney</option>
            <option value="liver">Liver</option>
            <option value="heart">Heart</option>
            <option value="lung">Lung</option>
            <option value="pancreas">Pancreas</option>
            <option value="intestine">Intestine</option>
          </select>
        </div>
        
        <div class="filter-group">
          <label for="location">Location</label>
          <input type="text" id="location" placeholder="Search by location">
        </div>
      </div>
      
      <div class="emergency-toggle">
        <input type="checkbox" id="emergency-only">
        <label for="emergency-only">Show emergency requests only</label>
      </div>
    </section>

    <section class="requests-container" id="requests-container">
      <!-- Request cards will be dynamically inserted here -->
    </section>
  </main>

  <footer>
    <div class="container">
      <p>For emergency situations, please contact the emergency hotline directly at <strong>1-800-555-0123</strong></p>
    </div>
  </footer>

  <script>
    // Sample data - in a real application, this would come from an API
    const requests = [
      {
        id: 1,
        requesterName: "John Smith",
        contactNumber: "555-123-4567",
        location: "Memorial Hospital, New York",
        type: "Blood",
        specificType: "O Negative",
        dateRequested: "2025-04-09T14:30:00",
        isEmergency: true,
      },
      {
        id: 2,
        requesterName: "Maria Garcia",
        contactNumber: "555-987-6543",
        location: "City Medical Center, Boston",
        type: "Organ",
        specificType: "Kidney",
        dateRequested: "2025-04-08T09:15:00",
        isEmergency: false,
      },
      {
        id: 3,
        requesterName: "David Johnson",
        contactNumber: "555-456-7890",
        location: "University Hospital, Chicago",
        type: "Blood",
        specificType: "A Positive",
        dateRequested: "2025-04-09T11:45:00",
        isEmergency: false,
      },
      {
        id: 4,
        requesterName: "Sarah Williams",
        contactNumber: "555-234-5678",
        location: "General Hospital, Los Angeles",
        type: "Organ",
        specificType: "Liver",
        dateRequested: "2025-04-07T16:20:00",
        isEmergency: true,
      },
      {
        id: 5,
        requesterName: "Michael Brown",
        contactNumber: "555-345-6789",
        location: "County Hospital, Dallas",
        type: "Blood",
        specificType: "B Negative",
        dateRequested: "2025-04-08T13:10:00",
        isEmergency: true,
      },
      {
        id: 6,
        requesterName: "Jennifer Lee",
        contactNumber: "555-567-8901",
        location: "St. Mary's Hospital, San Francisco",
        type: "Organ",
        specificType: "Heart",
        dateRequested: "2025-04-06T10:30:00",
        isEmergency: true,
      }
    ];

    // Filter state
    let activeFilter = 'all';
    let showEmergencyOnly = false;
    let bloodTypeFilter = 'any';
    let organTypeFilter = 'any';
    let locationFilter = '';

    // DOM elements
    const requestsContainer = document.getElementById('requests-container');
    const filterTabs = document.querySelectorAll('.filter-tab');
    const emergencyToggle = document.getElementById('emergency-only');
    const bloodTypeSelect = document.getElementById('blood-type');
    const organTypeSelect = document.getElementById('organ-type');
    const locationInput = document.getElementById('location');

    // Format date to a more readable format
    function formatDate(dateString) {
      const date = new Date(dateString);
      return new Intl.DateTimeFormat('en-US', {
        month: 'short',
        day: 'numeric',
        year: 'numeric',
        hour: 'numeric',
        minute: 'numeric',
        hour12: true
      }).format(date);
    }

    // Calculate time elapsed since request
    function getTimeElapsed(dateString) {
      const requestTime = new Date(dateString).getTime();
      const currentTime = new Date().getTime();
      const elapsedMs = currentTime - requestTime;

      const minutes = Math.floor(elapsedMs / (1000 * 60));
      const hours = Math.floor(minutes / 60);
      const days = Math.floor(hours / 24);

      if (days > 0) return `${days} day${days > 1 ? 's' : ''} ago`;
      if (hours > 0) return `${hours} hour${hours > 1 ? 's' : ''} ago`;
      return `${minutes} minute${minutes !== 1 ? 's' : ''} ago`;
    }

    // Render requests based on current filters
    function renderRequests() {
      // Filter requests based on current filter state
      const filteredRequests = requests.filter(request => {
        // Filter by type (blood/organ/all)
        if (activeFilter !== 'all' && request.type.toLowerCase() !== activeFilter) {
          return false;
        }

        // Filter by emergency status
        if (showEmergencyOnly && !request.isEmergency) {
          return false;
        }

        // Filter by blood type
        if (request.type === 'Blood' && bloodTypeFilter !== 'any') {
          if (request.specificType.toLowerCase().replace(' ', '-') !== bloodTypeFilter) {
            return false;
          }
        }

        // Filter by organ type
        if (request.type === 'Organ' && organTypeFilter !== 'any') {
          if (request.specificType.toLowerCase() !== organTypeFilter) {
            return false;
          }
        }

        // Filter by location
        if (locationFilter && !request.location.toLowerCase().includes(locationFilter.toLowerCase())) {
          return false;
        }

        return true;
      });

      // Clear current requests
      requestsContainer.innerHTML = '';

      // If no requests match filters
      if (filteredRequests.length === 0) {
        requestsContainer.innerHTML = '<p style="grid-column: 1/-1; text-align: center; padding: 30px;">No requests match your current filters.</p>';
        return;
      }

      // Render each request
      filteredRequests.forEach(request => {
        const card = document.createElement('div');
        card.className = `request-card ${request.isEmergency ? 'emergency' : ''}`;

        // Icon HTML based on type
        const typeIcon = request.type === 'Blood' 
          ? '<svg class="icon" viewBox="0 0 24 24"><path d="M12 2l-5.5 9h11z"/><path d="M12 11c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/><path d="M12 15c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg>'
          : '<svg class="icon" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>';

        // Emergency icon
        const emergencyIcon = '<svg class="icon" viewBox="0 0 24 24"><path d="M12 2L1 21h22L12 2zm0 16h-2v2h2v-2zm0-7h-2v5h2v-5z"/></svg>';

        // User icon
        const userIcon = '<svg class="icon" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>';

        // Phone icon
        const phoneIcon = '<svg class="icon" viewBox="0 0 24 24"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>';

        // Location icon
        const locationIcon = '<svg class="icon" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>';

        // Clock icon
        const clockIcon = '<svg class="icon" viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"/><path d="M12.5 7H11v6l5.25 3.15.75-1.23-4.5-2.67z"/></svg>';

        card.innerHTML = `
          <div class="card-header">
            <h3>${typeIcon} ${request.specificType}</h3>
            <p class="type">${request.type} Request</p>
            ${request.isEmergency ? `<div class="emergency-badge">${emergencyIcon} Emergency</div>` : ''}
          </div>
          <div class="card-content">
            <div class="info-item">
              ${userIcon}
              <span>${request.requesterName}</span>
            </div>
            <div class="info-item">
              ${phoneIcon}
              <span>${request.contactNumber}</span>
            </div>
            <div class="info-item">
              ${locationIcon}
              <span>${request.location}</span>
            </div>
            <div class="info-item">
              ${clockIcon}
              <span>
                ${formatDate(request.dateRequested)}
                <span class="time-ago">(${getTimeElapsed(request.dateRequested)})</span>
              </span>
            </div>
          </div>
          <div class="card-footer">
            <button class="contact-btn">Contact Requester</button>
          </div>
        `;

        requestsContainer.appendChild(card);
      });
    }

    // Event listeners for filters
    filterTabs.forEach(tab => {
      tab.addEventListener('click', () => {
        // Update active tab
        filterTabs.forEach(t => t.classList.remove('active'));
        tab.classList.add('active');
        
        // Update filter
        activeFilter = tab.dataset.filter;
        
        // Re-render requests
        renderRequests();
      });
    });

    emergencyToggle.addEventListener('change', () => {
      showEmergencyOnly = emergencyToggle.checked;
      renderRequests();
    });

    bloodTypeSelect.addEventListener('change', () => {
      bloodTypeFilter = bloodTypeSelect.value;
      renderRequests();
    });

    organTypeSelect.addEventListener('change', () => {
      organTypeFilter = organTypeSelect.value;
      renderRequests();
    });

    locationInput.addEventListener('input', () => {
      locationFilter = locationInput.value;
      renderRequests();
    });

    // Initial render
    renderRequests();

    // Add contact button functionality
    document.addEventListener('click', (e) => {
      if (e.target.classList.contains('contact-btn')) {
        const card = e.target.closest('.request-card');
        const name = card.querySelector('.info-item:first-child span').textContent;
        const phone = card.querySelector('.info-item:nth-child(2) span').textContent;
        
        alert(`Contacting ${name} at ${phone}`);
      }
    });
  </script>
</body>
</html>