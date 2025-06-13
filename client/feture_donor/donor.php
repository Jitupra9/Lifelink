


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LifeLink - Organ & Blood Donation Registration</title>
  <meta name="description" content="Register as an organ or blood donor and help save lives">
  <link rel="stylesheet" href="donor.css">
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
  <main class="container">
    <header>
      <div class="logo">
        <i class="fas fa-heartbeat"></i>
        <h1>LifeLink</h1>
      </div>
      <p>Register your intent to donate organs and help save lives in emergency situations.</p>
    </header>

    <div class="content-grid">
      <div class="form-container">
        <div id="success-message" class="success-message hidden">
          <div class="success-icon">
            <i class="fas fa-check-circle"></i>
          </div>
          <h2>Registration Successful</h2>
          <p>Thank you for registering as a donor</p>
          <div class="success-content">
            <p>Your registration has been submitted successfully. You will receive a confirmation email shortly with
              further instructions and your donor ID.</p>
            <p>If you have any questions, please contact our support team at support@lifelink.org or call us at (800)
              555-0123.</p>
          </div>
          <div class="success-footer">
            <button class="btn btn-outline" id="register-another">Register Another Donor</button>
          </div>
        </div>
        <div id="registration-form" class="card">
          <div class="card-header">
            <h2>Donor Registration</h2>
            <p>Register your intent to donate blood or organs. Your information will be kept confidential and only used
              in accordance with our privacy policy.</p>
          </div>
          <div class="card-content">
            <form id="donor-form">
              <!-- Step 1: Personal Information -->
              <div class="form-step" id="step-1">
                <div class="form-grid">
                  <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" id="firstName" name="firstName" required>
                    <p class="error-message" id="firstName-error"></p>
                  </div>
                  <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" name="lastName" required>
                    <p class="error-message" id="lastName-error"></p>
                  </div>
                </div>

                <div class="form-grid">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                    <p class="error-message" id="email-error"></p>
                  </div>
                  <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" required>
                    <p class="error-message" id="phone-error"></p>
                  </div>
                </div>

                <div class="form-group">
                  <label for="dateOfBirth">Date of Birth</label>
                  <input type="date" id="dateOfBirth" name="dateOfBirth" required>
                  <p class="error-message" id="dateOfBirth-error"></p>
                </div>

                <div class="form-group">
                  <label for="address">Address</label>
                  <input type="text" id="address" name="address" required>
                  <p class="error-message" id="address-error"></p>
                </div>

                <div class="form-grid-3">
                  <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" id="city" name="city" required>
                    <p class="error-message" id="city-error"></p>
                  </div>
                  <div class="form-group">
                    <label for="state">State</label>
                    <select id="state" name="state" required>
                      <option value="">Select state</option>
                      <option value="AL">Alabama</option>
                      <option value="AK">Alaska</option>
                      <option value="AZ">Arizona</option>
                      <option value="CA">California</option>
                      <option value="CO">Colorado</option>
                      <option value="FL">Florida</option>
                      <option value="NY">New York</option>
                      <option value="TX">Texas</option>
                      <!-- Add more states as needed -->
                    </select>
                    <p class="error-message" id="state-error"></p>
                  </div>
                  <div class="form-group">
                    <label for="zipCode">Zip Code</label>
                    <input type="text" id="zipCode" name="zipCode" required>
                    <p class="error-message" id="zipCode-error"></p>
                  </div>
                </div>
              </div>

              <!-- Step 2: Donation Information -->
              <div class="form-step hidden" id="step-2">
                <div class="form-group">
                  <label for="bloodType">Blood Type (if known)</label>
                  <select id="organType" name="organType">
                    <option value="">Select Organ type</option>
                    <optgroup label="Solid Organs">
                      <option value="heart">Heart</option>
                      <option value="liver">Liver</option>
                      <option value="kidney">Kidney</option>
                      <option value="lung">Lung</option>
                      <option value="pancreas">Pancreas</option>
                      <option value="intestine">Intestine</option>
                    </optgroup>
                    <optgroup label="Tissues">
                      <option value="cornea">Cornea (Eye)</option>
                      <option value="skin">Skin</option>
                      <option value="bone">Bone</option>
                      <option value="bone-marrow">Bone Marrow</option>
                      <option value="connective-tissue">Connective Tissue</option>
                    </optgroup>
                  </select>
                </div>

                <div class="form-group">
                  <label>Donation Type</label>
                  <p class="error-message" id="donationType-error"></p>
                  <div class="checkbox-grid">
                    <div class="checkbox-item">
                      <input type="checkbox" id="blood" name="donationType" value="blood" disabled>
                      <label for="blood">Blood Donation</label>
                    </div>
                    <div class="checkbox-item">
                      <input type="checkbox" id="organs" name="donationType" value="organs" required>
                      <label for="organs">Organ Donation</label>
                    </div>
                    <div class="checkbox-item">
                      <input type="checkbox" id="tissue" name="donationType" value="tissue" disabled>
                      <label for="tissue">Tissue Donation</label>
                    </div>
                    <div class="checkbox-item">
                      <input type="checkbox" id="bone-marrow" name="donationType" value="bone-marrow" required>
                      <label for="bone-marrow">Bone Marrow</label>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="label-with-tooltip">
                    <label for="medicalConditions">Medical Conditions</label>
                    <div class="tooltip">
                      <i class="fas fa-info-circle"></i>
                      <span class="tooltip-text">Please list any medical conditions, medications, or allergies that
                        might affect your eligibility as a donor.</span>
                    </div>
                  </div>
                  <textarea id="medicalConditions" name="medicalConditions" rows="4"></textarea>
                </div>

                <div class="form-grid">
                  <div class="form-group">
                    <label for="emergencyContactName">Emergency Contact Name</label>
                    <input type="text" id="emergencyContactName" name="emergencyContactName" required>
                    <p class="error-message" id="emergencyContactName-error"></p>
                  </div>
                  <div class="form-group">
                    <label for="emergencyContactPhone">Emergency Contact Phone</label>
                    <input type="tel" id="emergencyContactPhone" name="emergencyContactPhone" required>
                    <p class="error-message" id="emergencyContactPhone-error"></p>
                  </div>
                </div>
              </div>

              <!-- Step 3: Consent and Verification -->
              <div class="form-step hidden" id="step-3">
                <div class="info-box warning">
                  <h3>Important Information</h3>
                  <p>By registering as an organ donor, you are giving consent for your organs to be donated after your
                    death. This decision can help save multiple lives. Your family will be consulted before donation
                    proceeds.</p>
                </div>

                <div class="consent-section">
                  <div class="checkbox-consent">
                    <input type="checkbox" id="consentOrgan" name="consentOrgan" required>
                    <div>
                      <label for="consentOrgan" class="consent-label">Organ Donation Consent</label>
                      <p class="consent-text">I consent to donate my organs and tissues after my death for the purpose
                        of transplantation, medical research, or education.</p>
                    </div>
                  </div>
                  <p class="error-message" id="consentOrgan-error"></p>

                  <div class="checkbox-consent">
                    <input type="checkbox" id="consentPrivacy" name="consentPrivacy" required>
                    <div>
                      <label for="consentPrivacy" class="consent-label">Privacy Policy Agreement</label>
                      <p class="consent-text">I have read and agree to the <a href="/privacy" class="link">Privacy
                          Policy</a> and understand how my information will be used.</p>
                    </div>
                  </div>
                  <p class="error-message" id="consentPrivacy-error"></p>
                </div>

                <div class="info-box">
                  <h3>Digital Signature</h3>
                  <p>By submitting this form, you are electronically signing this document and confirming that all
                    information provided is accurate to the best of your knowledge.</p>
                </div>
              </div>

              <div class="form-navigation">
                <button type="button" id="prev-btn" class="btn btn-outline hidden">Previous</button>
                <button type="button" id="next-btn" class="btn btn-primary">Next</button>
                <button type="submit" id="submit-btn" class="btn btn-primary hidden">Complete Registration</button>
              </div>

              <div class="step-indicator">
                <div class="step-dot active" data-step="1"></div>
                <div class="step-dot" data-step="2"></div>
                <div class="step-dot" data-step="3"></div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="info-container">
        <div class="card">
          <div class="card-header">
            <h2>Donation Information</h2>
            <p>Learn about the donation process and its impact</p>
          </div>
          <div class="card-content">
            <div class="tabs">
              <div class="tab-list">
                <button class="tab-button active" data-tab="about">About</button>
                <button class="tab-button" data-tab="process">Process</button>
                <button class="tab-button" data-tab="faq">FAQ</button>
              </div>

              <div class="tab-content active" id="about-tab">
                <div class="info-item">
                  <div class="info-icon heart">
                    <i class="fas fa-heart"></i>
                  </div>
                  <div>
                    <h3>Save Lives</h3>
                    <p>One organ donor can save up to 8 lives and enhance the lives of up to 75 others through tissue
                      donation.</p>
                  </div>
                </div>

                <div class="info-item">
                  <div class="info-icon droplet">
                    <i class="fas fa-tint"></i>
                  </div>
                  <div>
                    <h3>Blood Donation</h3>
                    <p>Every 2 seconds, someone in the U.S. needs blood. A single donation can help multiple patients.
                    </p>
                  </div>
                </div>

                <div class="info-item">
                  <div class="info-icon brain">
                    <i class="fas fa-brain"></i>
                  </div>
                  <div>
                    <h3>Research & Education</h3>
                    <p>Donated organs and tissues also contribute to medical research and education, advancing
                      healthcare for future generations.</p>
                  </div>
                </div>

                <div class="info-item">
                  <div class="info-icon award">
                    <i class="fas fa-award"></i>
                  </div>
                  <div>
                    <h3>Legacy</h3>
                    <p>Donation creates a living legacy, allowing donors to make a meaningful difference even after
                      death.</p>
                  </div>
                </div>
              </div>

              <div class="tab-content" id="process-tab">
                <div class="info-box">
                  <h3>Registration Process</h3>
                  <ol>
                    <li>Complete the registration form with your personal information</li>
                    <li>Specify your donation preferences (organs, tissues, etc.)</li>
                    <li>Provide medical history information</li>
                    <li>Review and consent to the donation terms</li>
                    <li>Receive confirmation and your donor ID</li>
                  </ol>
                </div>

                <div class="info-box">
                  <h3>What Happens After Registration</h3>
                  <ul>
                    <li>Your information is securely stored in the donor registry</li>
                    <li>You'll receive a donor card and information packet</li>
                    <li>Medical professionals can access your donation preferences if needed</li>
                    <li>Your family will be consulted before donation proceeds</li>
                    <li>You can update your preferences or opt out at any time</li>
                  </ul>
                </div>

                <div class="info-box">
                  <h3>Legal Aspects</h3>
                  <p>Organ donation is regulated by the Uniform Anatomical Gift Act in the United States. This
                    registration serves as legal documentation of your intent to donate. Your family will still be
                    consulted at the time of donation.</p>
                </div>
              </div>

              <div class="tab-content" id="faq-tab">
                <div class="accordion">
                  <div class="accordion-item">
                    <div class="accordion-header">
                      <button class="accordion-button">Who can be a donor?</button>
                    </div>
                    <div class="accordion-content">
                      <p>People of all ages and medical histories should consider themselves potential donors. Your
                        medical condition at the time of donation will determine what organs and tissues can be donated.
                        Even those with chronic conditions or advanced age can often donate.</p>
                    </div>
                  </div>

                  <div class="accordion-item">
                    <div class="accordion-header">
                      <button class="accordion-button">Is there a cost to donate?</button>
                    </div>
                    <div class="accordion-content">
                      <p>There is no cost to the donor or their family for organ or tissue donation. All costs related
                        to donation are paid by the organ procurement organization or the recipient.</p>
                    </div>
                  </div>

                  <div class="accordion-item">
                    <div class="accordion-header">
                      <button class="accordion-button">Will donation affect funeral arrangements?</button>
                    </div>
                    <div class="accordion-content">
                      <p>Organ and tissue donation doesn't interfere with having an open-casket funeral. The body is
                        treated with care and respect, and donation doesn't disfigure the body or change the way it
                        looks in funeral or burial arrangements.</p>
                    </div>
                  </div>

                  <div class="accordion-item">
                    <div class="accordion-header">
                      <button class="accordion-button">Can I specify which organs I want to donate?</button>
                    </div>
                    <div class="accordion-content">
                      <p>Yes, you can specify which organs and tissues you wish to donate. This registration form allows
                        you to indicate your preferences. You can choose to donate all organs and tissues or specify
                        only certain ones.</p>
                    </div>
                  </div>

                  <div class="accordion-item">
                    <div class="accordion-header">
                      <button class="accordion-button">Will my family be charged for donation?</button>
                    </div>
                    <div class="accordion-content">
                      <p>No, the donor's family is never charged for donation. The costs associated with recovering and
                        processing organs and tissues are paid by the transplant recipients, usually through insurance,
                        Medicare, or Medicaid.</p>
                    </div>
                  </div>

                  <div class="accordion-item">
                    <div class="accordion-header">
                      <button class="accordion-button">Can I change my mind after registering?</button>
                    </div>
                    <div class="accordion-content">
                      <p>Yes, you can change or revoke your donation decision at any time by updating your registration.
                        Simply contact us to update your preferences or remove yourself from the registry.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="resources-box">
              <div class="resources-header">
                <i class="fas fa-file-alt"></i>
                <h3>Resources</h3>
              </div>
              <ul class="resources-list">
                <li><a href="#" class="link">Organ Donation Statistics</a></li>
                <li><a href="#" class="link">Blood Donation Guidelines</a></li>
                <li><a href="#" class="link">Tissue Donation Information</a></li>
                <li><a href="#" class="link">Legal Framework for Donation</a></li>
              </ul>
            </div>

            <div class="support-info">
              <i class="fas fa-question-circle"></i>
              <span>Need help? Contact our support team at support@lifelink.org</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <footer>
      <p>© <span id="current-year"></span> LifeLink. All rights reserved.</p>
      <div class="footer-links">
        <a href="/privacy" class="link">Privacy Policy</a>
        <a href="/terms" class="link">Terms of Service</a>
        <a href="/contact" class="link">Contact Us</a>
      </div>
    </footer>
  </main>

  <script src="donor.js?v=<?php time() ?>"></script>
</body>

</html>