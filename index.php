<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LifeLink - Emergency Blood & Organ Donation</title>
    <link rel="stylesheet" href="styles.css?v=<?= time() ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <?php
    session_start();
    include_once 'header.php';
    ?>

    <main>
        <section class="hero">
            <div class="container hero-container">
                <div class="hero-content">
                    <h1>Save Lives with <span>Emergency</span> Blood & Organ Donation</h1>
                    <p>Connect donors with recipients in real-time. Your donation can save up to 3 lives in emergency
                        situations.</p>
                    <div class="hero-buttons">
                        <?php
                        if (isset($_SESSION['user'])) {
                            ?>
                            <a href="client/emergency/emergency.php" class="btn btn-primary">
                                Quick Donate
                                <i class="fas fa-arrow-right"></i>
                            </a>

                            <?php
                        } else {
                            ?>
                            <a href="client/feture_donor/donor.php" class="btn btn-primary">
                                Future Donor
                                <i class="fas fa-arrow-right"></i>
                            </a>
                            <?php
                        }
                        ?>


                        <a href="client/search_details/search.php" class="btn btn-outline">Request Donation</a>
                    </div>
                </div>
                <div class="hero-animation" id="heroAnimation">
                </div>
            </div>
        </section>
        <section class="stats">
            <div class="container">
                <div class="stats-grid">
                    <div class="stat">
                        <h3 id="donorsStat">0</h3>
                        <p>Registered Donors</p>
                    </div>
                    <div class="stat">
                        <h3 id="donationsStat">0</h3>
                        <p>Successful Donations</p>
                    </div>
                    <div class="stat">
                        <h3 id="hospitalsStat">0</h3>
                        <p>Partner Hospitals</p>
                    </div>
                    <div class="stat">
                        <h3 id="livesSavedStat">0</h3>
                        <p>Lives Saved</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="features">
            <div class="container">
                <div class="section-header">
                    <h2>How LifeLink Works</h2>
                    <p>Our platform connects donors and recipients in real-time, ensuring rapid response in emergency
                        situations.</p>
                </div>

                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3>Donor Matching</h3>
                        <p>Advanced algorithm matches donors with compatible recipients based on blood type, location,
                            and urgency.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3>Real-time Alerts</h3>
                        <p>Instant notifications for emergency requests, allowing donors to respond quickly when needed
                            most.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h3>Location Tracking</h3>
                        <p>GPS-based system connects donors with nearby hospitals and recipients to minimize transport
                            time.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3>Organ Registry</h3>
                        <p>Comprehensive database of organ donors and recipients with detailed medical compatibility
                            information.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h3>Health Monitoring</h3>
                        <p>Track donor eligibility and recipient health status to ensure safe and effective donations.
                        </p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-ambulance"></i>
                        </div>
                        <h3>Emergency Response</h3>
                        <p>Priority system for critical cases with direct hospital coordination for immediate action.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Donation Section -->
        <section id="donate" class="donation">
            <div class="container">
                <div class="donation-grid">
                    <div class="donation-content">
                        <h2>Become a Donor Today</h2>
                        <p>Join our network of life-savers. Register as a blood or organ donor and be notified when your
                            donation is needed.</p>
                        <div class="donation-benefits">
                            <div class="benefit">
                                <div class="benefit-dot"></div>
                                <p>Register in minutes with our simple verification process</p>
                            </div>
                            <div class="benefit">
                                <div class="benefit-dot"></div>
                                <p>Set your availability and preferred donation locations</p>
                            </div>
                            <div class="benefit">
                                <div class="benefit-dot"></div>
                                <p>Receive notifications only for compatible donation requests</p>
                            </div>
                            <div class="benefit">
                                <div class="benefit-dot"></div>
                                <p>Track your impact with our donation history dashboard</p>
                            </div>
                        </div>
                        <?php
                        if (isset($_SESSION['user'])) {
                            ?>
                            <a href="client/emergency/emergency.php" class="btn btn-primary">Donate Now</a>
                            <?php
                        } else {
                            ?>
                            <a href="client/LoginPage-main/LoginPage-main/register.php" class="btn btn-primary">Register</a>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="blood-type-selector">
                        <h3>Find Your Blood Type Compatibility</h3>
                        <div class="selector-container">
                            <label for="bloodType">Select Your Blood Type</label>
                            <select id="bloodType" class="blood-type-dropdown">
                                <option value="">Select blood type...</option>
                                <option value="a-positive">A+</option>
                                <option value="a-negative">A-</option>
                                <option value="b-positive">B+</option>
                                <option value="b-negative">B-</option>
                                <option value="ab-positive" selected>AB+</option>
                                <option value="ab-negative">AB-</option>
                                <option value="o-positive">O+</option>
                                <option value="o-negative">O-</option>
                            </select>

                            <div id="compatibilityResults" class="compatibility-results hidden">
                                <div class="compatibility-grid">
                                    <div class="compatibility-card">
                                        <h4>Can Donate To:</h4>
                                        <div id="canDonateTo" class="compatibility-types"></div>
                                    </div>
                                    <div class="compatibility-card">
                                        <h4>Can Receive From:</h4>
                                        <div id="canReceiveFrom" class="compatibility-types"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="compatibility-info">
                                <p>Universal donors have O- blood type. Universal recipients have AB+ blood type.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Emergency Section -->
        <section id="emergency" class="emergency">
            <div class="container">
                <div class="section-header">
                    <h2>Emergency Requests</h2>
                    <p>Current urgent donation needs in your area. These requests require immediate attention.</p>
                </div>


                <div class="view-all">
                    <a href="client/emergency/emergency.php" class="btn btn-outline">View All Requests</a>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="about">
            <div class="container">
                <div class="about-grid">
                    <div class="about-content">
                        <h2>About LifeLink</h2>
                        <p>LifeLink was founded with a mission to revolutionize emergency blood and organ donation by
                            leveraging technology to save lives.</p>
                        <p>Our platform connects donors directly with recipients and medical facilities, dramatically
                            reducing response time in critical situations.
                            Since our launch, we've facilitated over 50,000 donations and helped save thousands of
                            lives.</p>
                        <p>We work closely with hospitals, blood banks, and transplant centers to ensure a seamless
                            donation process that meets all medical standards and regulations.</p>
                    </div>
                    <div class="about-stats">
                        <div class="about-stat">
                            <h3>98%</h3>
                            <p>Successful donation matches</p>
                        </div>
                        <div class="about-stat">
                            <h3>15min</h3>
                            <p>Average response time</p>
                        </div>
                        <div class="about-stat">
                            <h3>250+</h3>
                            <p>Partner hospitals</p>
                        </div>
                        <div class="about-stat">
                            <h3>10K+</h3>
                            <p>Lives saved</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta">
            <div class="container">
                <h2>Ready to Make a Difference?</h2>
                <p>Join our network of donors today and be part of a community dedicated to saving lives through
                    emergency blood and organ donation.</p>
                <div class="cta-buttons">
                    <?php
                    if (isset($_SESSION['user'])) {

                    } else {
                        ?>
                        <a href="client/LoginPage-main/LoginPage-main/register.php" class="btn btn-secondary">Register as Donor</a>
                        <?php
                    }
                    ?>
                    <a href="learnmore.php" class="btn btn-outline-light">Learn More</a>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-about">
                    <h3>LifeLink</h3>
                    <div class="footer-logo">
                        <i class="fas fa-heart"></i>
                        <span>LifeLink</span>
                    </div>
                    <p>Connecting donors and recipients in emergency situations.</p>
                </div>
                <div class="footer-links">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="register.php">Donor Registration</a></li>
                        <li><a href="emergency.php">Emergency Requests</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h3>Resources</h3>
                    <ul>
                        <li><a href="guide.php">Donation Guide</a></li>
                        <li><a href="blood-info.php">Blood Type Info</a></li>
                        <li><a href="faq.php">Organ Donation FAQ</a></li>
                        <li><a href="resources.php">Medical Resources</a></li>
                    </ul>
                </div>
                <div class="footer-contact">
                    <h3>Contact</h3>
                    <ul>
                        <li>support@lifelink.com</li>
                        <li>+1 (555) 123-4567</li>
                        <li>123 Medical Drive, Health City</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <span id="currentYear"></span> LifeLink. All rights reserved.</p>
                <div class="footer-legal">
                    <a href="privacy.php">Privacy Policy</a>
                    <a href="terms.php">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="scripts.js?v=<?= time() ?>"></script>
</body>

</html>