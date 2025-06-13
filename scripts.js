document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    
    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', function() {
            mobileMenu.classList.toggle('active');
        });
    }
    
    // Set current year in footer
    const currentYearElement = document.getElementById('currentYear');
    if (currentYearElement) {
        currentYearElement.textContent = new Date().getFullYear();
    }
    
    // Hero animation
    initHeroAnimation();
    
    // Animate stats counter
    animateStats();
    
    // Blood type compatibility selector
    initBloodTypeSelector();
    
    // Load emergency requests
    loadEmergencyRequests();
});

// Hero Animation
function initHeroAnimation() {
    const heroAnimation = document.getElementById('heroAnimation');
    if (!heroAnimation) return;
    
    // Create heart pulse animation
    const heartPulse1 = document.createElement('div');
    heartPulse1.className = 'heart-pulse pulse-1';
    
    const heartPulse2 = document.createElement('div');
    heartPulse2.className = 'heart-pulse pulse-2';
    
    const heartPulse3 = document.createElement('div');
    heartPulse3.className = 'heart-pulse pulse-3';
    
    heroAnimation.appendChild(heartPulse1);
    heroAnimation.appendChild(heartPulse2);
    heroAnimation.appendChild(heartPulse3);
    
    // Create blood cells
    for (let i = 0; i < 15; i++) {
        createBloodCell(heroAnimation);
    }
    
    // Create new cells periodically
    setInterval(() => {
        createBloodCell(heroAnimation);
    }, 2000);
    
    // Add CSS for animations
    const style = document.createElement('style');
    style.textContent = `
        .heart-pulse {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 50%;
            background-color: rgba(220, 38, 38, 0.1);
        }
        
        .pulse-1 {
            width: 100px;
            height: 100px;
            animation: pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        .pulse-2 {
            width: 150px;
            height: 150px;
            animation: pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
            animation-delay: 0.3s;
        }
        
        .pulse-3 {
            width: 200px;
            height: 200px;
            animation: pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
            animation-delay: 0.6s;
        }
        
        @keyframes pulse {
            0%, 100% {
                opacity: 0.2;
            }
            50% {
                opacity: 0.15;
            }
        }
        
        @keyframes float {
            0% {
                transform: translate(0, 0) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translate(var(--translate-x, 100px), var(--translate-y, -100px)) rotate(360deg);
                opacity: 0;
            }
        }
        
        .blood-cell {
            position: absolute;
            border-radius: 50%;
            background-color: rgba(220, 38, 38, 0.8);
            animation: float linear forwards;
        }
    `;
    
    document.head.appendChild(style);
}

function createBloodCell(container) {
    const cell = document.createElement('div');
    cell.className = 'blood-cell';
    
    // Random size between 8px and 24px
    const size = Math.floor(Math.random() * 16) + 8;
    cell.style.width = `${size}px`;
    cell.style.height = `${size}px`;
    
    // Random position
    cell.style.left = `${Math.random() * 100}%`;
    cell.style.top = `${Math.random() * 100}%`;
    
    // Random animation duration between 15s and 30s
    const duration = Math.floor(Math.random() * 15) + 15;
    cell.style.animationDuration = `${duration}s`;
    
    // Random delay
    const delay = Math.random() * 5;
    cell.style.animationDelay = `${delay}s`;
    
    // Random translation
    const translateX = Math.random() * 200 - 100;
    const translateY = Math.random() * 200 - 100;
    cell.style.setProperty('--translate-x', `${translateX}px`);
    cell.style.setProperty('--translate-y', `${translateY}px`);
    
    // Remove after animation completes
    setTimeout(() => {
        cell.remove();
    }, (duration + delay) * 1000);
    
    container.appendChild(cell);
}

// Stats Animation
function animateStats() {
    const donorsStat = document.getElementById('donorsStat');
    const donationsStat = document.getElementById('donationsStat');
    const hospitalsStat = document.getElementById('hospitalsStat');
    const livesSavedStat = document.getElementById('livesSavedStat');
    
    if (!donorsStat || !donationsStat || !hospitalsStat || !livesSavedStat) return;
    
    const targetStats = {
        donors: 25000,
        donations: 75000,
        hospitals: 350,
        livesSaved: 150000
    };
    
    const duration = 2000;
    const interval = 20;
    const steps = duration / interval;
    
    let currentStep = 0;
    
    const timer = setInterval(() => {
        currentStep++;
        const progress = currentStep / steps;
        
        donorsStat.textContent = '+' + Math.round(targetStats.donors * progress).toLocaleString();
        donationsStat.textContent = Math.round(targetStats.donations * progress).toLocaleString();
        hospitalsStat.textContent = '+' + Math.round(targetStats.hospitals * progress).toLocaleString();
        livesSavedStat.textContent = '+' + Math.round(targetStats.livesSaved * progress).toLocaleString();
        
        if (currentStep >= steps) {
            clearInterval(timer);
        }
    }, interval);
}

// Blood Type Compatibility
document.addEventListener('DOMContentLoaded', function() {
    function initBloodTypeSelector() {
        const bloodTypeSelect = document.getElementById('bloodType');
        const compatibilityResults = document.getElementById('compatibilityResults');
        const canDonateTo = document.getElementById('canDonateTo');
        const canReceiveFrom = document.getElementById('canReceiveFrom');
        
        if (!bloodTypeSelect || !compatibilityResults || !canDonateTo || !canReceiveFrom) return;
        
        const compatibilityMap = {
            "a-positive": {
                canDonateTo: ["A+", "AB+"],
                canReceiveFrom: ["A+", "A-", "O+", "O-"]
            },
            "a-negative": {
                canDonateTo: ["A+", "A-", "AB+", "AB-"],
                canReceiveFrom: ["A-", "O-"]
            },
            "b-positive": {
                canDonateTo: ["B+", "AB+"],
                canReceiveFrom: ["B+", "B-", "O+", "O-"]
            },
            "b-negative": {
                canDonateTo: ["B+", "B-", "AB+", "AB-"],
                canReceiveFrom: ["B-", "O-"]
            },
            "ab-positive": {
                canDonateTo: ["AB+"],
                canReceiveFrom: ["A+", "A-", "B+", "B-", "AB+", "AB-", "O+", "O-"]
            },
            "ab-negative": {
                canDonateTo: ["AB+", "AB-"],
                canReceiveFrom: ["A-", "B-", "AB-", "O-"]
            },
            "o-positive": {
                canDonateTo: ["A+", "B+", "AB+", "O+"],
                canReceiveFrom: ["O+", "O-"]
            },
            "o-negative": {
                canDonateTo: ["A+", "A-", "B+", "B-", "AB+", "AB-", "O+", "O-"],
                canReceiveFrom: ["O-"]
            }
        };
        
        function updateCompatibility(selectedBloodType) {
            if (selectedBloodType) {
                const compatibility = compatibilityMap[selectedBloodType];
                canDonateTo.innerHTML = '';
                canReceiveFrom.innerHTML = '';
                
                compatibility.canDonateTo.forEach(type => {
                    const typeSpan = document.createElement('span');
                    typeSpan.className = 'compatibility-type';
                    typeSpan.textContent = type;
                    canDonateTo.appendChild(typeSpan);
                });
                
                compatibility.canReceiveFrom.forEach(type => {
                    const typeSpan = document.createElement('span');
                    typeSpan.className = 'compatibility-type';
                    typeSpan.textContent = type;
                    canReceiveFrom.appendChild(typeSpan);
                });
                
                // Show results
                compatibilityResults.classList.remove('hidden');
                compatibilityResults.classList.add('fade-in');
            } else {
                compatibilityResults.classList.add('hidden');
            }
        }
        
        // Set up event listener
        bloodTypeSelect.addEventListener('change', function() {
            updateCompatibility(this.value);
        });
        
        // Manually trigger the update for the default selected value
        updateCompatibility(bloodTypeSelect.value);
    }
    
    // Initialize the blood type selector
    initBloodTypeSelector();
});
// Load Emergency Requests
function loadEmergencyRequests() {
    const emergencyRequests = document.getElementById('emergencyRequests');
    if (!emergencyRequests) return;
    
    const requests = [
        {
            bloodType: "O-",
            hospital: "Memorial Hospital",
            distance: "3.2 miles",
            urgency: "Critical",
            timePosted: "10 minutes ago"
        },
        {
            bloodType: "AB+",
            hospital: "City Medical Center",
            distance: "5.7 miles",
            urgency: "High",
            timePosted: "45 minutes ago"
        },
        {
            bloodType: "B+",
            hospital: "University Hospital",
            distance: "8.1 miles",
            urgency: "Medium",
            timePosted: "2 hours ago"
        }
    ];
    
    requests.forEach(request => {
        const card = createEmergencyCard(request);
        emergencyRequests.appendChild(card);
    });
}

function createEmergencyCard(request) {
    const card = document.createElement('div');
    card.className = 'emergency-card fade-in';
    
    const indicator = document.createElement('div');
    indicator.className = `emergency-card-indicator ${request.urgency.toLowerCase()}`;
    
    const header = document.createElement('div');
    header.className = 'emergency-card-header';
    
    const title = document.createElement('div');
    title.className = 'emergency-card-title';
    
    const bloodType = document.createElement('h3');
    bloodType.textContent = request.bloodType;
    
    const urgencyBadge = document.createElement('span');
    urgencyBadge.className = `urgency-badge ${request.urgency.toLowerCase()}`;
    urgencyBadge.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${request.urgency}`;
    
    title.appendChild(bloodType);
    title.appendChild(urgencyBadge);
    
    const hospital = document.createElement('div');
    hospital.className = 'emergency-card-hospital';
    hospital.textContent = request.hospital;
    
    header.appendChild(title);
    header.appendChild(hospital);
    
    const content = document.createElement('div');
    content.className = 'emergency-card-content';
    
    const distance = document.createElement('div');
    distance.className = 'emergency-card-info';
    distance.innerHTML = `<i class="fas fa-map-marker-alt"></i> ${request.distance} away`;
    
    const time = document.createElement('div');
    time.className = 'emergency-card-info';
    time.innerHTML = `<i class="fas fa-clock"></i> Posted ${request.timePosted}`;
    
    content.appendChild(distance);
    content.appendChild(time);
    
    const footer = document.createElement('div');
    footer.className = 'emergency-card-footer';
    
    const button = document.createElement('button');
    button.className = 'btn btn-primary btn-full';
    button.textContent = 'Respond to Request';
    button.addEventListener('click', function() {
        this.textContent = 'Response Submitted';
        this.disabled = true;
    });
    
    footer.appendChild(button);
    
    card.appendChild(indicator);
    card.appendChild(header);
    card.appendChild(content);
    card.appendChild(footer);
    
    return card;
}