<?php
session_start();
if (isset($_SESSION['user'])) {
  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emergency Blood and Organ Donation Profile</title>
    <link rel="stylesheet" href="porfile.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  </head>

  <body>
    <div class="container">
      <!-- Profile Header -->
      <div class="card profile-header">
        <div class="card-content">
          <div class="profile-header-content">
            <div class="avatar">
              <img src="https://via.placeholder.com/100" alt="Jane Smith">
            </div>
            <div class="profile-info">
              <h1><?php echo $_SESSION['user']['full_name'] ?></h1>
              <p class="text-muted"><?php echo $_SESSION['user']['gmail'] ?></p>
              <div class="badges">

                <?php
                if (isset($_SESSION['user']['blood_g'])) {
                  ?>
                  <span class="badge badge-red">
                    <i class="fas fa-droplet"></i>
                    Blood Type: O+
                  </span>
                  <?php
                }else{
                  ?>
                  <button class="badge badge-red" style="border: none; cursor: pointer;">
                    <i class="fas fa-droplet"></i>
                    Add blood group
                  </button>
                  <?php
                }
                ?>
                <span class="badge badge-green">
                  <i class="fas fa-heart-pulse"></i>
                  Organ Donor
                </span>



                
                <?php
                if (isset($_SESSION['user']['total_donation'])) {
                  ?>
                <span class="badge badge-outline">
                  <i class="fas fa-award"></i>
                  <?php echo $_SESSION['user']['total_donation'] ?> Donations
                </span>
                  <?php
                }
                ?>












              </div>
            </div>
            <div class="last-donation">
              <p class="text-sm text-muted">Last donation</p>
              <p class="font-medium">12/15/2023</p>
              <a href="../../backend/logout.php" style="margin-top: 12%;" class="btn btn-primary">Logout</a>
            </div>

          </div>

        </div>
      </div>

      <!-- Main Tabs -->
      <div class="tabs-container">
        <div class="tabs">
          <button class="tab-button active" data-tab="personal-info">Personal Info</button>
          <button class="tab-button" data-tab="donation-history">Donation History</button>
          <button class="tab-button" data-tab="donation-centers">Donation Centers</button>
          <button class="tab-button" data-tab="resources">Resources</button>
        </div>

        <!-- Personal Info Tab -->
        <div class="tab-content active" id="personal-info">
          <div class="card">
            <div class="card-header">
              <h2>Personal Information</h2>
              <p class="text-muted">Update your personal details and preferences</p>
            </div>
            <div class="card-content">
              <form id="personal-info-form">
                <div class="form-grid">
                  <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" id="firstName" name="firstName" value=<?php echo $_SESSION['user']['full_name'] ?>
                      placeholder="First name">
                    <div class="form-error" id="firstName-error"></div>
                  </div>

                  <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" name="lastName" value="Smith" placeholder="Last name">
                    <div class="form-error" id="lastName-error"></div>
                  </div>

                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value=<?php echo $_SESSION['user']['gmail'] ?>
                      placeholder="Email">
                    <div class="form-error" id="email-error"></div>
                  </div>

                  <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" id="phone" name="phone" value=<?php echo $_SESSION['user']['contact'] ?>
                      placeholder="Phone number">
                    <div class="form-error" id="phone-error"></div>
                  </div>

                  <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" value=<?php echo isset($_SESSION['user']['addresas']) ? $_SESSION['user']['addresas'] : 'no record'; ?>>
                    <div class="form-error" id="address-error"></div>
                  </div>

                  <div class="city-state-container">
                    <div class="form-group">
                      <label for="city">City</label>
                      <input type="text" id="city" name="city" value="Anytown" placeholder="City">
                      <div class="form-error" id="city-error"></div>
                    </div>

                    <div class="form-group">
                      <label for="state">State</label>
                      <input type="text" id="state" name="state" value="CA" placeholder="State">
                      <div class="form-error" id="state-error"></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="zipCode">Zip Code</label>
                    <input type="text" id="zipCode" name="zipCode" value="12345" placeholder="Zip code">
                    <div class="form-error" id="zipCode-error"></div>
                  </div>

                  <div class="form-group">
                    <label for="bloodType">Blood Type</label>
                    <select id="bloodType" name="bloodType">
                      <option value="">Select your blood type</option>
                      <option value="A+" selected>A+</option>
                      <option value="A-">A-</option>
                      <option value="B+">B+</option>
                      <option value="B-">B-</option>
                      <option value="AB+">AB+</option>
                      <option value="AB-">AB-</option>
                      <option value="O+">O+</option>
                      <option value="O-">O-</option>
                    </select>
                    <div class="form-error" id="bloodType-error"></div>
                  </div>

                  <div class="form-group switch-container">
                    <div>
                      <label class="switch-label">Organ Donor</label>
                      <p class="text-muted">Register as an organ donor</p>
                    </div>
                    <label class="switch">
                      <input type="checkbox" id="isOrganDonor" name="isOrganDonor" checked>
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <label for="medicalConditions">Medical Conditions</label>
                  <textarea id="medicalConditions" name="medicalConditions"
                    placeholder="List any medical conditions, allergies, or medications">No known medical conditions</textarea>
                  <p class="text-muted">This information will only be shared with medical professionals in case of
                    emergency.</p>
                  <div class="form-error" id="medicalConditions-error"></div>
                </div>

                <div class="form-grid">
                  <div class="form-group">
                    <label for="emergencyContactName">Emergency Contact Name</label>
                    <input type="text" id="emergencyContactName" name="emergencyContactName" value="John Smith"
                      placeholder="Emergency contact name">
                    <div class="form-error" id="emergencyContactName-error"></div>
                  </div>

                  <div class="form-group">
                    <label for="emergencyContactPhone">Emergency Contact Phone</label>
                    <input type="text" id="emergencyContactPhone" name="emergencyContactPhone" value="555-987-6543"
                      placeholder="Emergency contact phone">
                    <div class="form-error" id="emergencyContactPhone-error"></div>
                  </div>
                </div>

                <button type="submit" class="btn btn-primary">Save Changes</button>
              </form>
            </div>
          </div>
        </div>

        <!-- Donation History Tab -->
        <div class="tab-content" id="donation-history">
          <div class="subtabs-container">
            <div class="subtabs">
              <button class="subtab-button active" data-subtab="blood">Blood Donations</button>
              <button class="subtab-button" data-subtab="organ">Organ Consent</button>
            </div>

            <div class="subtab-content active" id="blood">
              <div class="card">
                <div class="card-header">
                  <h2>Blood Donation History</h2>
                  <p class="text-muted">Your complete blood donation history and statistics</p>
                </div>
                <div class="card-content">
                  <div class="stats-container">
                    <div class="stat-card">
                      <div class="stat-content">
                        <i class="fas fa-droplet text-red"></i>
                        <h3>5</h3>
                        <p class="text-muted">Total Donations</p>
                      </div>
                    </div>

                    <div class="stat-card">
                      <div class="stat-content">
                        <i class="fas fa-droplet text-red"></i>
                        <h3>2.25L</h3>
                        <p class="text-muted">Total Volume</p>
                      </div>
                    </div>

                    <div class="stat-card">
                      <div class="stat-content">
                        <i class="fas fa-droplet text-red"></i>
                        <h3>~15</h3>
                        <p class="text-muted">Lives Impacted</p>
                      </div>
                    </div>
                  </div>

                  <div class="table-container">
                    <div class="table-header">
                      <div class="col-2">Date</div>
                      <div class="col-3">Location</div>
                      <div class="col-3">Type</div>
                      <div class="col-2">Volume</div>
                      <div class="col-2">Status</div>
                    </div>

                    <div class="table-row">
                      <div class="col-2">12/15/2023</div>
                      <div class="col-3">Central Blood Bank</div>
                      <div class="col-3">Whole Blood</div>
                      <div class="col-2">450ml</div>
                      <div class="col-2"><span class="status-badge completed">Completed</span></div>
                    </div>

                    <div class="table-row">
                      <div class="col-2">09/10/2023</div>
                      <div class="col-3">Community Drive</div>
                      <div class="col-3">Plasma</div>
                      <div class="col-2">600ml</div>
                      <div class="col-2"><span class="status-badge completed">Completed</span></div>
                    </div>

                    <div class="table-row">
                      <div class="col-2">06/05/2023</div>
                      <div class="col-3">Central Blood Bank</div>
                      <div class="col-3">Platelets</div>
                      <div class="col-2">200ml</div>
                      <div class="col-2"><span class="status-badge completed">Completed</span></div>
                    </div>

                    <div class="table-row">
                      <div class="col-2">03/20/2023</div>
                      <div class="col-3">Mobile Donation Center</div>
                      <div class="col-3">Whole Blood</div>
                      <div class="col-2">450ml</div>
                      <div class="col-2"><span class="status-badge completed">Completed</span></div>
                    </div>

                    <div class="table-row">
                      <div class="col-2">12/12/2022</div>
                      <div class="col-3">Central Blood Bank</div>
                      <div class="col-3">Double Red Cells</div>
                      <div class="col-2">200ml</div>
                      <div class="col-2"><span class="status-badge completed">Completed</span></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="subtab-content" id="organ">
              <div class="card">
                <div class="card-header">
                  <h2>Organ Donation Consent <span class="organ-badge">Feature donor</span> </h2>
                  <p class="text-muted">Your organ donation preferences and registration details</p>
                </div>
                <div class="card-content">
                  <div class="section">
                    <div class="section-header">
                      <i class="fas fa-heart-pulse text-green"></i>
                      <h3>Registration Status</h3>
                    </div>

                    <div class="info-grid">
                      <div class="info-card">
                        <p class="text-muted">Status</p>
                        <p><span class="badge badge-green">Registered</span></p>
                      </div>

                      <div class="info-card">
                        <p class="text-muted">Registration Date</p>
                        <p>05/10/2021</p>
                      </div>

                      <div class="info-card">
                        <p class="text-muted">Registry ID</p>
                        <p>ORG-12345-XYZ</p>
                      </div>
                    </div>

                    <div class="section-header">
                      <i class="fas fa-heart-pulse text-green"></i>
                      <h3>Consented Organs</h3>
                    </div>

                    <div class="organ-badges">
                      <span class="organ-badge">Kidneys</span>
                      <span class="organ-badge">Liver</span>
                      <span class="organ-badge">Heart</span>
                      <span class="organ-badge">Lungs</span>
                      <span class="organ-badge">Pancreas</span>
                      <span class="organ-badge">Corneas</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Donation Centers Tab -->
        <div class="tab-content" id="donation-centers">
          <div class="card">
            <div class="card-header">
              <h2>Find Donation Centers</h2>
              <p class="text-muted">Locate blood and organ donation centers near you</p>
            </div>
            <div class="card-content">
              <div class="search-container">
                <input type="text" id="center-search" placeholder="Search by name or location" class="search-input">
                <button class="btn btn-outline">Use My Location</button>
              </div>

              <div class="centers-container">
                <div class="centers-list">
                  <div class="center-card">
                    <div class="center-info">
                      <div class="center-header">
                        <h3>Central Blood Bank</h3>
                        <span>1.2 miles</span>
                      </div>
                      <div class="center-address">
                        <i class="fas fa-location-dot"></i>
                        <span>123 Main St, Anytown, CA 12345</span>
                      </div>
                      <div class="center-details">
                        <div class="center-detail">
                          <i class="fas fa-phone"></i>
                          <span>(555) 123-4567</span>
                        </div>
                        <div class="center-detail">
                          <i class="fas fa-clock"></i>
                          <span>Mon-Fri: 8am-8pm, Sat-Sun: 9am-5pm</span>
                        </div>
                      </div>
                      <div class="center-services">
                        <span class="service-badge blood">Blood Donation</span>
                        <span class="service-badge organ">Organ Registration</span>
                      </div>
                      <div class="center-actions">
                        <a href="https://example.com" target="_blank" class="btn btn-sm btn-outline">
                          Visit Website
                          <i class="fas fa-external-link"></i>
                        </a>
                      </div>
                    </div>
                  </div>

                  <div class="center-card">
                    <div class="center-info">
                      <div class="center-header">
                        <h3>Community Hospital Donation Center</h3>
                        <span>2.5 miles</span>
                      </div>
                      <div class="center-address">
                        <i class="fas fa-location-dot"></i>
                        <span>456 Oak Ave, Anytown, CA 12345</span>
                      </div>
                      <div class="center-details">
                        <div class="center-detail">
                          <i class="fas fa-phone"></i>
                          <span>(555) 987-6543</span>
                        </div>
                        <div class="center-detail">
                          <i class="fas fa-clock"></i>
                          <span>Mon-Fri: 9am-6pm, Sat: 10am-4pm, Sun: Closed</span>
                        </div>
                      </div>
                      <div class="center-services">
                        <span class="service-badge blood">Blood Donation</span>
                      </div>
                      <div class="center-actions">
                        <a href="https://example.com" target="_blank" class="btn btn-sm btn-outline">
                          Visit Website
                          <i class="fas fa-external-link"></i>
                        </a>
                      </div>
                    </div>
                  </div>

                  <div class="center-card">
                    <div class="center-info">
                      <div class="center-header">
                        <h3>Mobile Donation Unit - City Park</h3>
                        <span>0.8 miles</span>
                      </div>
                      <div class="center-address">
                        <i class="fas fa-location-dot"></i>
                        <span>789 Park Rd, Anytown, CA 12345</span>
                      </div>
                      <div class="center-details">
                        <div class="center-detail">
                          <i class="fas fa-phone"></i>
                          <span>(555) 456-7890</span>
                        </div>
                        <div class="center-detail">
                          <i class="fas fa-clock"></i>
                          <span>Wed-Fri: 10am-7pm this week only</span>
                        </div>
                      </div>
                      <div class="center-services">
                        <span class="service-badge blood">Blood Donation</span>
                      </div>
                      <div class="center-actions">
                        <a href="https://example.com" target="_blank" class="btn btn-sm btn-outline">
                          Visit Website
                          <i class="fas fa-external-link"></i>
                        </a>
                      </div>
                    </div>
                  </div>

                  <div class="center-card">
                    <div class="center-info">
                      <div class="center-header">
                        <h3>Regional Medical Center</h3>
                        <span>3.7 miles</span>
                      </div>
                      <div class="center-address">
                        <i class="fas fa-location-dot"></i>
                        <span>101 Hospital Dr, Anytown, CA 12345</span>
                      </div>
                      <div class="center-details">
                        <div class="center-detail">
                          <i class="fas fa-phone"></i>
                          <span>(555) 234-5678</span>
                        </div>
                        <div class="center-detail">
                          <i class="fas fa-clock"></i>
                          <span>Mon-Sun: 24 hours</span>
                        </div>
                      </div>
                      <div class="center-services">
                        <span class="service-badge blood">Blood Donation</span>
                        <span class="service-badge organ">Organ Registration</span>
                      </div>
                      <div class="center-actions">
                        <a href="https://example.com" target="_blank" class="btn btn-sm btn-outline">
                          Visit Website
                          <i class="fas fa-external-link"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="map-container">
                  <iframe
                    src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d12345.67890!2d-122.4194!3d37.7749!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sus!4v1234567890"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade" title="Donation Centers Map">
                  </iframe>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Resources Tab -->
        <div class="tab-content" id="resources">
          <div class="card">
            <div class="card-header">
              <h2>Frequently Asked Questions</h2>
              <p class="text-muted">Common questions about blood and organ donation</p>
            </div>
            <div class="card-content">
              <div class="accordion">
                <div class="accordion-item">
                  <button class="accordion-button">
                    How often can I donate blood?
                    <i class="fas fa-chevron-down"></i>
                  </button>
                  <div class="accordion-content">
                    <p>Most people can donate whole blood every 56 days (8 weeks). If you donate platelets, you can donate
                      every 7 days, up to 24 times a year. Plasma donors can donate every 28 days, and double red cell
                      donors can donate every 112 days.</p>
                  </div>
                </div>

                <div class="accordion-item">
                  <button class="accordion-button">
                    What are the requirements to donate blood?
                    <i class="fas fa-chevron-down"></i>
                  </button>
                  <div class="accordion-content">
                    <p>Generally, blood donors must be at least 17 years old (16 with parental consent in some states),
                      weigh at least 110 pounds, and be in good health. There are some medical conditions and medications
                      that may disqualify you from donating blood, so it's best to check with your local donation center.
                    </p>
                  </div>
                </div>

                <div class="accordion-item">
                  <button class="accordion-button">
                    Does blood donation hurt?
                    <i class="fas fa-chevron-down"></i>
                  </button>
                  <div class="accordion-content">
                    <p>Most people report feeling only a brief sting when the needle is inserted. Throughout the donation,
                      you might feel a slight pressure on your arm, but it shouldn't be painful. The actual blood donation
                      only takes about 8-10 minutes.</p>
                  </div>
                </div>

                <div class="accordion-item">
                  <button class="accordion-button">
                    What happens to my blood after I donate?
                    <i class="fas fa-chevron-down"></i>
                  </button>
                  <div class="accordion-content">
                    <p>After donation, your blood is tested for infectious diseases and blood type. It is then processed
                      into components (red cells, platelets, plasma) that can be used for different medical needs. These
                      components are stored appropriately and distributed to hospitals where they are needed.</p>
                  </div>
                </div>

                <div class="accordion-item">
                  <button class="accordion-button">
                    How does organ donation work?
                    <i class="fas fa-chevron-down"></i>
                  </button>
                  <div class="accordion-content">
                    <p>When you register as an organ donor, you're indicating your wish to donate organs and tissues after
                      death. If organ donation is possible at the time of your death, your family will be consulted, and
                      medical professionals will evaluate which organs can be donated. The organs are then matched with
                      recipients on the national waiting list.</p>
                  </div>
                </div>

                <div class="accordion-item">
                  <button class="accordion-button">
                    Can I specify which organs I want to donate?
                    <i class="fas fa-chevron-down"></i>
                  </button>
                  <div class="accordion-content">
                    <p>Yes, when you register as an organ donor, you can specify which organs and tissues you wish to
                      donate. You can choose to donate all organs and tissues or select specific ones.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card mt-6">
            <div class="card-header">
              <h2>Educational Resources</h2>
              <p class="text-muted">Learn more about blood and organ donation</p>
            </div>
            <div class="card-content">
              <div class="resource-tabs">
                <div class="resource-tab-buttons">
                  <button class="resource-tab-button active" data-resource-tab="educational">Educational
                    Materials</button>
                  <button class="resource-tab-button" data-resource-tab="guidelines">Guidelines & Regulations</button>
                </div>

                <div class="resource-tab-content active" id="educational">
                  <div class="resources-grid">
                    <div class="resource-card">
                      <div class="resource-content">
                        <i class="fas fa-book-open text-red"></i>
                        <div>
                          <h4>Understanding Blood Types</h4>
                          <p class="text-muted">Learn about different blood types, compatibility, and why knowing your
                            blood type is important.</p>
                          <a href="https://example.com/blood-types" class="resource-link" target="_blank">
                            Read more
                            <i class="fas fa-external-link"></i>
                          </a>
                        </div>
                      </div>
                    </div>

                    <div class="resource-card">
                      <div class="resource-content">
                        <i class="fas fa-book-open text-red"></i>
                        <div>
                          <h4>The Donation Process</h4>
                          <p class="text-muted">A step-by-step guide to what happens during a blood donation session.</p>
                          <a href="https://example.com/donation-process" class="resource-link" target="_blank">
                            Read more
                            <i class="fas fa-external-link"></i>
                          </a>
                        </div>
                      </div>
                    </div>

                    <div class="resource-card">
                      <div class="resource-content">
                        <i class="fas fa-book-open text-red"></i>
                        <div>
                          <h4>Benefits of Regular Donation</h4>
                          <p class="text-muted">Discover the health benefits of regular blood donation and how it helps
                            others.</p>
                          <a href="https://example.com/benefits" class="resource-link" target="_blank">
                            Read more
                            <i class="fas fa-external-link"></i>
                          </a>
                        </div>
                      </div>
                    </div>

                    <div class="resource-card">
                      <div class="resource-content">
                        <i class="fas fa-book-open text-red"></i>
                        <div>
                          <h4>Organ Donation Facts</h4>
                          <p class="text-muted">Important facts about organ donation and how it saves lives.</p>
                          <a href="https://example.com/organ-facts" class="resource-link" target="_blank">
                            Read more
                            <i class="fas fa-external-link"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="resource-tab-content" id="guidelines">
                  <div class="resources-grid">
                    <div class="resource-card">
                      <div class="resource-content">
                        <i class="fas fa-file-text text-red"></i>
                        <div>
                          <h4>Blood Donation Guidelines</h4>
                          <p class="text-muted">Official guidelines for blood donation eligibility and procedures.</p>
                          <a href="https://example.com/blood-guidelines" class="resource-link" target="_blank">
                            View guidelines
                            <i class="fas fa-external-link"></i>
                          </a>
                        </div>
                      </div>
                    </div>

                    <div class="resource-card">
                      <div class="resource-content">
                        <i class="fas fa-file-text text-red"></i>
                        <div>
                          <h4>Organ Donation Regulations</h4>
                          <p class="text-muted">Legal framework and regulations governing organ donation.</p>
                          <a href="https://example.com/organ-regulations" class="resource-link" target="_blank">
                            View guidelines
                            <i class="fas fa-external-link"></i>
                          </a>
                        </div>
                      </div>
                    </div>

                    <div class="resource-card">
                      <div class="resource-content">
                        <i class="fas fa-file-text text-red"></i>
                        <div>
                          <h4>Medical Standards for Donors</h4>
                          <p class="text-muted">Medical standards and requirements for blood and organ donors.</p>
                          <a href="https://example.com/medical-standards" class="resource-link" target="_blank">
                            View guidelines
                            <i class="fas fa-external-link"></i>
                          </a>
                        </div>
                      </div>
                    </div>

                    <div class="resource-card">
                      <div class="resource-content">
                        <i class="fas fa-file-text text-red"></i>
                        <div>
                          <h4>Ethical Considerations</h4>
                          <p class="text-muted">Ethical guidelines and considerations in donation and transplantation.</p>
                          <a href="https://example.com/ethics" class="resource-link" target="_blank">
                            View guidelines
                            <i class="fas fa-external-link"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="profile.js"></script>
  </body>

  </html>
  <?php
} else {
  ?>
  <h1> login your account</h1>
  <?php
}
?>