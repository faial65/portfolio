// Mobile Menu Toggle
const mobileToggle = document.querySelector('.mobile-toggle');
const navMenu = document.querySelector('.nav-menu ul');
const headerElement = document.querySelector('header');

mobileToggle.addEventListener('click', () => {
    navMenu.classList.toggle('active');
    mobileToggle.classList.toggle('active');
    headerElement.classList.toggle('menu-open');
    document.body.classList.toggle('menu-open');
    
    // Animate menu items with staggered effect
    if (navMenu.classList.contains('active')) {
        const menuItems = navMenu.querySelectorAll('li');
        menuItems.forEach((item, index) => {
            setTimeout(() => {
                item.style.opacity = '1';
                item.style.transform = 'translateX(0)';
            }, index * 100);
        });
    }
});

// Close mobile menu when clicking on a link
const navLinks = document.querySelectorAll('.nav-link');
navLinks.forEach(link => {
    link.addEventListener('click', () => {
        navMenu.classList.remove('active');
        mobileToggle.classList.remove('active');
        headerElement.classList.remove('menu-open');
        document.body.classList.remove('menu-open');
    });
});

// Close menu when clicking outside
document.addEventListener('click', (e) => {
    if (!headerElement.contains(e.target) && navMenu.classList.contains('active')) {
        navMenu.classList.remove('active');
        mobileToggle.classList.remove('active');
        headerElement.classList.remove('menu-open');
        document.body.classList.remove('menu-open');
    }
});

// Smooth Scrolling for Navigation Links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Active Navigation Link Highlighting
function updateActiveNavLink() {
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-link');
    
    let current = '';
    sections.forEach(section => {
        const sectionTop = section.offsetTop;
        const sectionHeight = section.clientHeight;
        if (window.pageYOffset >= sectionTop - 200) {
            current = section.getAttribute('id');
        }
    });

    navLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === `#${current}`) {
            link.classList.add('active');
        }
    });
}

// Update active link on scroll
window.addEventListener('scroll', updateActiveNavLink);

// Header Background on Scroll
const header = document.querySelector('header');
let lastScrollY = window.scrollY;

window.addEventListener('scroll', () => {
    const currentScrollY = window.scrollY;
    
    // Add/remove scrolled class for background opacity
    if (currentScrollY > 50) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
    
    // Hide/show header on scroll direction
    if (currentScrollY > lastScrollY && currentScrollY > 100) {
        header.style.transform = 'translateY(-100%)';
    } else {
        header.style.transform = 'translateY(0)';
    }
    
    lastScrollY = currentScrollY;
});

// Skill Cards Animation on Scroll
const observerOptions = {
    threshold: 0.2,
    rootMargin: '0px 0px -100px 0px'
};

const skillCardsObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const skillsContainer = entry.target;
            const skillCards = skillsContainer.querySelectorAll('.skill-card');
            
            // Animate cards one by one
            skillCards.forEach((card, index) => {
                setTimeout(() => {
                    card.classList.add('animate-in');
                    // Remove animation after it completes to enable hover effects
                    setTimeout(() => {
                        card.classList.add('animation-complete');
                    }, 800); // Match animation duration
                }, index * 200); // 200ms delay between each card
            });
            
            // Stop observing once animation is triggered
            skillCardsObserver.unobserve(entry.target);
        }
    });
}, observerOptions);

// Observe skill cards for animation
document.addEventListener('DOMContentLoaded', () => {
    const skillsContainer = document.querySelector('.skills-container');
    if (skillsContainer) {
        // Initially hide all skill cards
        const skillCards = skillsContainer.querySelectorAll('.skill-card');
        skillCards.forEach(card => {
            card.classList.add('skill-card-hidden');
        });
        
        // Start observing the skills container
        skillCardsObserver.observe(skillsContainer);
    }
});

// Typing Effect for Hero Section
function typeWriter(element, text, speed = 100) {
    let i = 0;
    element.innerHTML = '';
    
    function type() {
        if (i < text.length) {
            element.innerHTML += text.charAt(i);
            i++;
            setTimeout(type, speed);
        }
    }
    type();
}

// Initialize typing effect when page loads
window.addEventListener('load', () => {
    const heroTitle = document.querySelector('.hero-text h1');
    const heroSubtitle = document.querySelector('.hero-text h2 span');
    const heroRole = document.querySelector('.hero-text h3');
    
    if (heroTitle) {
        setTimeout(() => typeWriter(heroTitle, 'Hello,', 150), 500);
    }
    if (heroSubtitle) {
        setTimeout(() => typeWriter(heroSubtitle, 'Faisal Ahmed', 100), 1500);
    }
    if (heroRole) {
        setTimeout(() => typeWriter(heroRole, 'Software Developer', 80), 2500);
    }
});

// About Section Typing Effect
const aboutTypingObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const typingElements = entry.target.querySelectorAll('.typing-text, .typing-text-delayed');
            typingElements.forEach((element, index) => {
                const text = element.getAttribute('data-text');
                if (text) {
                    setTimeout(() => {
                        element.style.whiteSpace = 'normal';
                        element.style.width = 'auto';
                        element.innerHTML = '';
                        typeWriterAbout(element, text, 30);
                    }, index * 4500);
                }
            });
            aboutTypingObserver.unobserve(entry.target);
        }
    });
}, { threshold: 0.3 });

// Typing function for About section
function typeWriterAbout(element, text, speed = 50) {
    let i = 0;
    element.style.borderRight = '2px solid #ff5e57';
    
    function type() {
        if (i < text.length) {
            element.innerHTML += text.charAt(i);
            i++;
            setTimeout(type, speed);
        } else {
            // Remove cursor after typing is complete
            setTimeout(() => {
                element.style.borderRight = 'none';
            }, 1000);
        }
    }
    type();
}

// Initialize About section observer
document.addEventListener('DOMContentLoaded', () => {
    const aboutSection = document.querySelector('.about');
    if (aboutSection) {
        aboutTypingObserver.observe(aboutSection);
    }
});

// Project Cards Hover Effect
document.addEventListener('DOMContentLoaded', () => {
    const projectCards = document.querySelectorAll('.project-card');
    projectCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
});

// Form Validation (if you add a contact form later)
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

// Copy Email to Clipboard
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        // Show a temporary success message
        const toast = document.createElement('div');
        toast.textContent = 'Email copied to clipboard!';
        toast.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: #ff5e57;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            z-index: 9999;
            animation: slideIn 0.3s ease;
        `;
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.remove();
        }, 3000);
    });
}

// Add copy functionality to email in footer
document.addEventListener('DOMContentLoaded', () => {
    const emailElement = document.querySelector('footer strong');
    if (emailElement) {
        emailElement.style.cursor = 'pointer';
        emailElement.title = 'Click to copy email';
        emailElement.addEventListener('click', () => {
            copyToClipboard(emailElement.textContent);
        });
    }
});

// Parallax Effect for Hero Section
window.addEventListener('scroll', () => {
    const scrolled = window.pageYOffset;
    const heroImage = document.querySelector('.hero-image img');
    if (heroImage) {
        heroImage.style.transform = `translateY(${scrolled * 0.3}px)`;
    }
});

// Add smooth transitions to all interactive elements
document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('.btn, .btn-outline');
    buttons.forEach(button => {
        button.style.transition = 'all 0.3s ease';
    });
});

// Console welcome message
console.log(`
🚀 Welcome to the Portfolio!
━━━━━━━━━━━━━━━━━━━━━━━━━━━
💼 Professional Portfolio
⚡ Interactive Features Loaded
🎨 Modern Design Elements
📱 Mobile Responsive
━━━━━━━━━━━━━━━━━━━━━━━━━━━
`);
