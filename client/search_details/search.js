document.addEventListener('DOMContentLoaded', function() {
    // DOM Elements
    const menuToggle = document.getElementById('menu-toggle');
    const closeMenu = document.getElementById('close-menu');
    const mobileMenu = document.getElementById('mobile-menu');
    const themeToggle = document.getElementById('theme-toggle');
    const bloodTab = document.getElementById('blood-tab');
    const organTab = document.getElementById('organ-tab');
    const bloodField = document.querySelector('.blood-field');
    const organField = document.querySelector('.organ-field');
    const searchButton = document.getElementById('search-button');
    const searchResultsContainer = document.getElementById('search-results-container');
    const searchResults = document.getElementById('search-results');
    const noResults = document.getElementById('no-results');
    const loading = document.getElementById('loading');
    const getLocationBtn = document.getElementById('get-location');
    const locationInput = document.getElementById('location');
    const chatContainer = document.getElementById('chat-container');
    const chatMessages = document.getElementById('chat-messages');
    const closeChat = document.getElementById('close-chat');
    const sendMessage = document.getElementById('send-message');
    const messageInput = document.getElementById('message-input');
    const chatFab = document.getElementById('chat-fab');
    const chatName = document.getElementById('chat-name');
    const chatInfo = document.getElementById('chat-info');
    const chatAvatar = document.getElementById('chat-avatar');

    // State
    let currentDonationType = 'blood';
    let activeDonor = null;
    let isDarkMode = false;

    // Mock data for demonstration
    const mockDonors = [
        {
            id: 1,
            name: "John Smith",
            type: "individual",
            bloodType: "O+",
            gender: "Male",
            phone: "(555) 123-4567",
            address: "123 Main St, Anytown, USA",
            distance: "2.3 miles",
            availability: "Available now",
            lastDonation: "3 months ago",
            image: "https://randomuser.me/api/portraits/men/1.jpg",
        },
        {
            id: 2,
            name: "Sarah Johnson",
            type: "individual",
            bloodType: "A-",
            gender: "Female",
            phone: "(555) 987-6543",
            address: "456 Oak Ave, Anytown, USA",
            distance: "3.1 miles",
            availability: "Available in 2 days",
            lastDonation: "6 months ago",
            image: "https://randomuser.me/api/portraits/women/2.jpg",
        },
        {
            id: 3,
            name: "City General Hospital",
            type: "hospital",
            bloodType: "All",
            phone: "(555) 789-0123",
            address: "789 Hospital Way, Anytown, USA",
            distance: "1.5 miles",
            availability: "24/7 availability",
            services: "Blood and organ donation",
            image: "https://images.unsplash.com/photo-1587351021759-3e566b3db4f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80",
        },
        {
            id: 4,
            name: "Memorial Medical Center",
            type: "hospital",
            bloodType: "All",
            phone: "(555) 456-7890",
            address: "101 Health Blvd, Anytown, USA",
            distance: "4.2 miles",
            availability: "24/7 availability",
            services: "Blood donation only",
            image: "https://images.unsplash.com/photo-1586773860418-d37222d8fce3?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80",
        },
        {
            id: 5,
            name: "Michael Chen",
            type: "individual",
            bloodType: "B+",
            gender: "Male",
            phone: "(555) 234-5678",
            address: "222 Pine St, Anytown, USA",
            distance: "1.8 miles",
            availability: "Available now",
            lastDonation: "1 year ago",
            image: "https://randomuser.me/api/portraits/men/3.jpg",
        },
        {
            id: 6,
            name: "Regional Blood Center",
            type: "hospital",
            bloodType: "All",
            phone: "(555) 345-6789",
            address: "333 Medical Pkwy, Anytown, USA",
            distance: "5.7 miles",
            availability: "8am-8pm daily",
            services: "Blood donation only",
            image: "https://images.unsplash.com/photo-1579684385127-1ef15d508118?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80",
        },
    ];

    // Initialize
    function init() {
        // Check for saved theme preference
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
            isDarkMode = true;
            themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
        }

        // Event Listeners
        menuToggle.addEventListener('click', toggleMobileMenu);
        closeMenu.addEventListener('click', closeMobileMenu);
        themeToggle.addEventListener('click', toggleTheme);
        bloodTab.addEventListener('click', () => switchDonationType('blood'));
        organTab.addEventListener('click', () => switchDonationType('organ'));
        searchButton.addEventListener('click', handleSearch);
        getLocationBtn.addEventListener('click', getCurrentLocation);
        closeChat.addEventListener('click', closeChattingWindow);
        sendMessage.addEventListener('click', sendChatMessage);
        chatFab.addEventListener('click', openFirstDonorChat);
        
        messageInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sendChatMessage();
            }
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(e) {
            if (mobileMenu.classList.contains('active') && 
                !mobileMenu.contains(e.target) && 
                e.target !== menuToggle) {
                closeMobileMenu();
            }
        });
    }

    // Toggle Mobile Menu
    function toggleMobileMenu() {
        mobileMenu.classList.toggle('active');
    }

    function closeMobileMenu() {
        mobileMenu.classList.remove('active');
    }

    // Toggle Theme
    function toggleTheme() {
        isDarkMode = !isDarkMode;
        if (isDarkMode) {
            document.documentElement.setAttribute('data-theme', 'dark');
            themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
            localStorage.setItem('theme', 'dark');
        } else {
            document.documentElement.removeAttribute('data-theme');
            themeToggle.innerHTML = '<i class="fas fa-moon"></i>';
            localStorage.setItem('theme', 'light');
        }
    }

    // Switch Donation Type
    function switchDonationType(type) {
        currentDonationType = type;
        
        if (type === 'blood') {
            bloodTab.classList.add('active');
            organTab.classList.remove('active');
            bloodField.classList.remove('hidden');
            organField.classList.add('hidden');
        } else {
            bloodTab.classList.remove('active');
            organTab.classList.add('active');
            bloodField.classList.add('hidden');
            organField.classList.remove('hidden');
        }
    }

    // Handle Search
    function handleSearch() {
        // Show loading
        loading.classList.remove('hidden');
        searchResultsContainer.classList.add('hidden');
        noResults.classList.add('hidden');
        chatFab.classList.add('hidden');
        
        // Simulate API call
        setTimeout(() => {
            loading.classList.add('hidden');
            
            // Filter results based on donation type
            let results = [...mockDonors];
            
            if (currentDonationType === 'organ') {
                // For organs, only show hospitals
                results = results.filter(donor => donor.type === 'hospital');
            }
            
            if (results.length > 0) {
                renderSearchResults(results);
                searchResultsContainer.classList.remove('hidden');
                chatFab.classList.remove('hidden');
            } else {
                noResults.classList.remove('hidden');
            }
        }, 1500);
    }

    // Render Search Results
    function renderSearchResults(donors) {
        searchResults.innerHTML = '';
        
        donors.forEach(donor => {
            const donorCard = document.createElement('div');
            donorCard.className = 'donor-card';
            
            const isHospital = donor.type === 'hospital';
            
            donorCard.innerHTML = `
                <div class="donor-card-content">
                    <div class="donor-header">
                        <div class="donor-avatar">
                            <img src="${donor.image}" alt="${donor.name}">
                        </div>
                        <div class="donor-info">
                            <div class="donor-name-row">
                                <h3 class="donor-name">${donor.name}</h3>
                                <div class="donor-distance">
                                    <i class="fas fa-location-dot"></i>
                                    ${donor.distance}
                                </div>
                            </div>
                            <div class="donor-tags">
                                ${isHospital 
                                    ? `<span class="donor-tag hospital"><i class="fas fa-hospital"></i> Hospital</span>` 
                                    : `<span class="donor-tag individual"><i class="fas fa-user"></i> Individual</span>
                                       <span class="donor-tag blood-type"><i class="fas fa-droplet"></i> ${donor.bloodType}</span>`
                                }
                            </div>
                            <div class="donor-availability">${donor.availability}</div>
                        </div>
                    </div>
                    
                    <div class="donor-details">
                        <div class="donor-detail">
                            <i class="fas fa-phone"></i>
                            <span>${donor.phone}</span>
                        </div>
                        <div class="donor-detail">
                            <i class="fas fa-location-dot"></i>
                            <span>${donor.address}</span>
                        </div>
                        ${!isHospital ? `
                        <div class="donor-detail">
                            <i class="fas fa-user"></i>
                            <span>${donor.gender}</span>
                        </div>
                        ` : ''}
                    </div>
                    
                    <div class="donor-actions">
                        <button class="btn btn-outline call-btn" data-phone="${donor.phone}">
                            <i class="fas fa-phone"></i> Call
                        </button>
                        <button class="btn btn-primary chat-btn" data-donor-id="${donor.id}">
                            <i class="fas fa-comment"></i> Chat
                        </button>
                    </div>
                </div>
            `;
            
            searchResults.appendChild(donorCard);
            
            // Add event listeners to buttons
            const chatBtn = donorCard.querySelector('.chat-btn');
            chatBtn.addEventListener('click', () => openChat(donor));
            
            const callBtn = donorCard.querySelector('.call-btn');
            callBtn.addEventListener('click', () => {
                const phoneNumber = callBtn.getAttribute('data-phone').replace(/[^0-9]/g, '');
                window.location.href = `tel:${phoneNumber}`;
            });
        });
    }

    // Get Current Location
    function getCurrentLocation() {
        if (navigator.geolocation) {
            getLocationBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            getLocationBtn.classList.add('loading');
            
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    // In a real app, you would use a reverse geocoding service
                    // to convert coordinates to an address
                    locationInput.value = "Current location detected";
                    
                    getLocationBtn.innerHTML = '<i class="fas fa-location-crosshairs"></i>';
                    getLocationBtn.classList.remove('loading');
                },
                (error) => {
                    console.error("Error getting location:", error);
                    alert("Unable to retrieve your location. Please enter it manually.");
                    
                    getLocationBtn.innerHTML = '<i class="fas fa-location-crosshairs"></i>';
                    getLocationBtn.classList.remove('loading');
                }
            );
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }

    // Chat Functions
    function openChat(donor) {
        activeDonor = donor;
        
        // Update chat header
        chatName.textContent = donor.name;
        chatAvatar.src = donor.image;
        
        if (donor.type === 'hospital') {
            chatInfo.textContent = 'Hospital';
        } else {
            chatInfo.textContent = `${donor.bloodType} • ${donor.gender}`;
        }
        
        // Clear previous messages
        chatMessages.innerHTML = '';
        
        // Add welcome message
        addChatMessage(`Hello! You're now connected with ${donor.name}. How can they help you today?`, 'bot');
        
        // Show chat window
        chatContainer.classList.remove('hidden');
        chatFab.classList.add('hidden');
        
        // Focus on input
        messageInput.focus();
    }

    function openFirstDonorChat() {
        // Get the first donor from search results
        const firstDonorId = document.querySelector('.chat-btn').getAttribute('data-donor-id');
        const donor = mockDonors.find(d => d.id === parseInt(firstDonorId));
        
        if (donor) {
            openChat(donor);
        }
    }

    function closeChattingWindow() {
        chatContainer.classList.add('hidden');
        chatFab.classList.remove('hidden');
        activeDonor = null;
    }

    function sendChatMessage() {
        const message = messageInput.value.trim();
        
        if (message === '') return;
        
        // Add user message
        addChatMessage(message, 'user');
        
        // Clear input
        messageInput.value = '';
        
        // Simulate response after a short delay
        setTimeout(() => {
            let botResponse;
            
            if (activeDonor.type === 'hospital') {
                botResponse = `Thank you for your message. ${activeDonor.name} typically responds within 30 minutes during business hours. A representative will assist you shortly.`;
            } else {
                botResponse = `Thanks for reaching out. ${activeDonor.name} has received your message and will respond as soon as possible.`;
            }
            
            addChatMessage(botResponse, 'bot');
        }, 1000);
    }

    function addChatMessage(text, sender) {
        const messageElement = document.createElement('div');
        messageElement.className = `message ${sender}`;
        messageElement.textContent = text;
        
        chatMessages.appendChild(messageElement);
        
        // Scroll to bottom
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    // Initialize the app
    init();
});