<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LifeLink - Find Blood and Organ Donors</title>
    <link rel="stylesheet" href="search.css?v<?= time() ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="app-container">
        <!-- Header -->
        <header class="header" style="display:none;">
            <div class="container header-container">
                <div class="logo">
                    <i class="fas fa-droplet"></i>
                    <span>LifeLink</span>
                </div>
                <nav class="desktop-nav">
                    <a href="#" class="active">Home</a>
                    <a href="#">About</a>
                    <a href="#">Contact</a>
                    <a href="#">FAQ</a>
                </nav>
                <div class="header-actions">
                    <button id="theme-toggle" class="icon-button">
                        <i class="fas fa-moon"></i>
                    </button>
                    <button id="menu-toggle" class="icon-button mobile-only">
                        <i class="fas fa-bars"></i>
                    </button>
                    <button class="btn btn-outline desktop-only">Sign In</button>
                </div>
            </div>
        </header>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="mobile-menu">
            <div class="mobile-menu-container">
                <div class="mobile-menu-header">
                    <div class="logo">
                        <i class="fas fa-droplet"></i>
                        <span>LifeLink</span>
                    </div>
                    <button id="close-menu" class="icon-button">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <nav class="mobile-nav">
                    <a href="#" class="active">Home</a>
                    <a href="#">About</a>
                    <a href="#">Contact</a>
                    <a href="#">FAQ</a>
                </nav>
                <div class="mobile-actions">
                    <button class="btn btn-primary">Sign In</button>
                    <button class="btn btn-outline">Register</button>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <main class="main-content">
            <div class="container">
                <div class="page-header">
                    <h1>Find a Donor</h1>
                    <p>Search for blood or organ donors in your local area</p>
                </div>

                <!-- Search Form -->
                <div class="card search-card">
                    <div class="tabs">
                        <button id="blood-tab" class="tab active">
                            <i class="fas fa-droplet"></i> Blood
                        </button>
                        <button id="organ-tab" class="tab">
                            <i class="fas fa-building"></i> Organ
                        </button>
                    </div>

                    <div class="search-form">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="location">Your Location</label>
                                <div class="input-with-icon">
                                    <input type="text" id="location" placeholder="Enter your city or zip code">
                                    <button id="get-location" class="input-icon-button" title="Use current location">
                                        <i class="fas fa-location-crosshairs"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="form-group blood-field">
                                <label for="blood-type">Blood Type</label>
                                <select id="blood-type">
                                    <option value="any">Any</option>
                                    <option value="a+">A+</option>
                                    <option value="a-">A-</option>
                                    <option value="b+">B+</option>
                                    <option value="b-">B-</option>
                                    <option value="ab+">AB+</option>
                                    <option value="ab-">AB-</option>
                                    <option value="o+">O+</option>
                                    <option value="o-">O-</option>
                                </select>
                            </div>
                            
                            <div class="form-group organ-field hidden">
                                <label for="organ-type">Organ Type</label>
                                <select id="organ-type">
                                    <option value="kidney">Kidney</option>
                                    <option value="liver">Liver</option>
                                    <option value="heart">Heart</option>
                                    <option value="lung">Lung</option>
                                    <option value="pancreas">Pancreas</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="distance">Maximum Distance</label>
                                <select id="distance">
                                    <option value="5">5 miles</option>
                                    <option value="10">10 miles</option>
                                    <option value="25" selected>25 miles</option>
                                    <option value="50">50 miles</option>
                                    <option value="100">100 miles</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="urgency">Urgency</label>
                                <select id="urgency">
                                    <option value="any">Any</option>
                                    <option value="immediate">Immediate (within 24 hours)</option>
                                    <option value="urgent">Urgent (within 3 days)</option>
                                    <option value="scheduled">Scheduled (within 2 weeks)</option>
                                </select>
                            </div>
                        </div>

                        <button id="search-button" class="btn btn-primary btn-full">
                            <i class="fas fa-search"></i> Search Donors
                        </button>
                    </div>
                </div>

                <!-- Search Results -->
                <div id="search-results-container" class="search-results-container hidden">
                    <h2>Search Results</h2>
                    <div id="search-results" class="search-results">
                        <!-- Results will be populated by JavaScript -->
                    </div>
                </div>

                <!-- No Results Message -->
                <div id="no-results" class="card no-results hidden">
                    <p>No donors found matching your criteria. Please try adjusting your search parameters.</p>
                </div>

                <!-- Loading Indicator -->
                <div id="loading" class="loading hidden">
                    <div class="spinner"></div>
                    <p>Searching for donors...</p>
                </div>
            </div>
        </main>

        <!-- Chat Interface -->
        <div id="chat-container" class="chat-container hidden">
            <div class="chat-box">
                <div class="chat-header">
                    <div class="chat-user">
                        <div class="chat-avatar">
                            <img id="chat-avatar" src="https://via.placeholder.com/40" alt="Donor">
                        </div>
                        <div class="chat-user-info">
                            <h3 id="chat-name">Donor Name</h3>
                            <p id="chat-info">Blood Type • Gender</p>
                        </div>
                    </div>
                    <button id="close-chat" class="icon-button">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div id="chat-messages" class="chat-messages">
                    <!-- Messages will be populated by JavaScript -->
                </div>
                <div class="chat-input">
                    <input type="text" id="message-input" placeholder="Type your message...">
                    <button id="send-message" class="btn btn-icon">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Floating Chat Button -->
        <button id="chat-fab" class="fab hidden">
            <i class="fas fa-comment"></i>
        </button>
    </div>

    <script src="search.js?v<?= time() ?>"></script>
</body>
</html>