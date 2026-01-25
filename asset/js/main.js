// Mobile Menu Toggle
document.addEventListener('DOMContentLoaded', function() {
  const menuToggle = document.getElementById('menuToggle');
  const navMenu = document.getElementById('navMenu');
  const navLinks = document.querySelectorAll('.nav-link');

  // Toggle menu on hamburger click
  if (menuToggle) {
    menuToggle.addEventListener('click', function() {
      menuToggle.classList.toggle('active');
      navMenu.classList.toggle('active');
    });
  }

  // Close menu when a link is clicked
  navLinks.forEach(link => {
    link.addEventListener('click', function() {
      menuToggle.classList.remove('active');
      navMenu.classList.remove('active');
    });
  });

  // Close menu when clicking outside
  document.addEventListener('click', function(event) {
    if (menuToggle && navMenu && !menuToggle.contains(event.target) && !navMenu.contains(event.target)) {
      menuToggle.classList.remove('active');
      navMenu.classList.remove('active');
    }
  });
});

// Play/Pause Audio Button Functionality
document.addEventListener('DOMContentLoaded', function() {
  const audio = document.getElementById('myAudio');
  const playPauseBtn = document.getElementById('playPauseBtn');

  
  if (audio && playPauseBtn) {
    // Auto-unmute and play on first interaction
    const autoPlayAudio = () => {
      if (audio.muted) {
        audio.muted = false;
        audio.play().catch(err => console.log('Autoplay prevented:', err));
        playPauseBtn.textContent = 'Pause';
        document.removeEventListener('click', autoPlayAudio);
        document.removeEventListener('scroll', autoPlayAudio);
      }
    };

    // Trigger on first user interaction (click or scroll)
    document.addEventListener('click', autoPlayAudio);
    document.addEventListener('scroll', autoPlayAudio);
    document.addEventListener('touchstart', autoPlayAudio);

    // Toggle play/pause on button click
    playPauseBtn.addEventListener('click', function() {
      if (audio.paused) {
        audio.muted = false;
        audio.play().catch(err => console.log('Play failed:', err));
        playPauseBtn.textContent = 'Pause';
      } else {
        audio.pause();
        playPauseBtn.textContent = 'Play';
      }
    });

    // Set initial button text based on autoplay state
    playPauseBtn.textContent = audio.paused ? 'Play' : 'Pause';
  }
});

// Stats Counter Animation
document.addEventListener('DOMContentLoaded', function() {
  const statCards = document.querySelectorAll('.stat-card');
  let hasAnimated = false;

  const observerOptions = {
    threshold: 0.5,
    rootMargin: '0px'
  };

  const observer = new IntersectionObserver(function(entries) {
    entries.forEach(entry => {
      if (entry.isIntersecting && !hasAnimated) {
        hasAnimated = true;
        animateCounters();
      }
    });
  }, observerOptions);

  function animateCounters() {
    statCards.forEach(card => {
      const numberElement = card.querySelector('.stat-number');
      const targetValue = parseFloat(card.getAttribute('data-target'));
      const suffix = card.getAttribute('data-suffix') || '';
      const duration = 2000; // 2 seconds
      const start = 0;
      const increment = targetValue / (duration / 16); // 60fps
      let current = start;

      const updateCounter = () => {
        current += increment;
        if (current < targetValue) {
          // Format the number appropriately
          if (targetValue < 10) {
            numberElement.textContent = current.toFixed(1) + suffix;
          } else {
            numberElement.textContent = Math.floor(current) + suffix;
          }
          requestAnimationFrame(updateCounter);
        } else {
          // Ensure we display the exact target value
          numberElement.textContent = (targetValue % 1 !== 0 ? targetValue.toFixed(1) : Math.floor(targetValue)) + suffix;
        }
      };

      updateCounter();
    });
  }

  // Observe the first stat card to trigger animation when section comes into view
  if (statCards.length > 0) {
    observer.observe(statCards[0]);
  }
});

// Scroll to Top Button Functionality
document.addEventListener('DOMContentLoaded', function() {
  const scrollToTopBtn = document.getElementById('scrollToTopBtn');

  if (scrollToTopBtn) {
    // Show button when scrolling down
    window.addEventListener('scroll', () => {
      if (window.pageYOffset > 300) {
        scrollToTopBtn.classList.add('show');
      } else {
        scrollToTopBtn.classList.remove('show');
      }
    });

    // Scroll to top when button is clicked
    scrollToTopBtn.addEventListener('click', () => {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });
  }
});

document.getElementById('downloadBtn').addEventListener('click', function() {
    const link = document.createElement('a');
    link.href = 'softray.pdf';  // PDF file location
    link.download = 'softray.pdf';   // Downloaded file name
    link.click();
});

// Project Filter Functionality
document.addEventListener('DOMContentLoaded', function() {
  const filterButtons = document.querySelectorAll('.filter-btn');
  const projectCards = document.querySelectorAll('.project-card');

  filterButtons.forEach(button => {
    button.addEventListener('click', () => {
      // Remove active class from all buttons
      filterButtons.forEach(btn => btn.classList.remove('active'));
      // Add active class to clicked button
      button.classList.add('active');

      const filterValue = button.getAttribute('data-filter');

      projectCards.forEach(card => {
        const category = card.getAttribute('data-category');
        if (filterValue === 'all' || category === filterValue) {
          card.style.display = 'block';
          card.style.animation = 'fadeIn 0.5s ease-in-out';
        } else {
          card.style.display = 'none';
        }
      });
    });
  });
});

// Contact Form Handling with FormSpree
document.addEventListener('DOMContentLoaded', function() {
  // FormSpree endpoint - Update this with your FormSpree form ID
  // Get your form ID from https://formspree.io/
  const FORMSPREE_ID = 'myzgndov'; // Replace with your actual FormSpree ID
  
  const contactForm = document.getElementById('contactForm');
  const formMessage = document.getElementById('formMessage');
  
  if (contactForm) {
    contactForm.addEventListener('submit', function(e) {
      e.preventDefault();
      e.stopPropagation();
      console.log('Contact form submitted');
      
      // Form validation
      const name = document.getElementById('name').value.trim();
      const email = document.getElementById('email').value.trim();
      const subject = document.getElementById('subject').value.trim();
      const message = document.getElementById('message').value.trim();
      
      let isValid = true;
      
      // Clear previous errors
      document.getElementById('nameError').textContent = '';
      document.getElementById('emailError').textContent = '';
      document.getElementById('subjectError').textContent = '';
      document.getElementById('messageError').textContent = '';
      
      // Validate name
      if (name === '' || name.length < 2) {
        document.getElementById('nameError').textContent = 'Please enter a valid name (at least 2 characters)';
        isValid = false;
      }
      
      // Validate email
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        document.getElementById('emailError').textContent = 'Please enter a valid email address';
        isValid = false;
      }
      
      // Validate subject
      if (subject === '' || subject.length < 3) {
        document.getElementById('subjectError').textContent = 'Please enter a subject (at least 3 characters)';
        isValid = false;
      }
      
      // Validate message
      if (message === '' || message.length < 10) {
        document.getElementById('messageError').textContent = 'Please enter a message (at least 10 characters)';
        isValid = false;
      }
      
      if (isValid) {
        // Show loading state
        const submitBtn = contactForm.querySelector('.submit-btn');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
        submitBtn.disabled = true;
        
        // Prepare form data for FormSpree
        const formData = new FormData();
        formData.append('name', name);
        formData.append('email', email);
        formData.append('subject', subject);
        formData.append('message', message);
        
        console.log('Sending email with FormSpree to:', `https://formspree.io/f/${FORMSPREE_ID}`);
        
        // Send email using FormSpree
        fetch(`https://formspree.io/f/${FORMSPREE_ID}`, {
          method: 'POST',
          body: formData,
          headers: {
            'Accept': 'application/json'
          }
        })
          .then(function(response) {
            console.log('Form submitted, response status:', response.status);
            console.log('Response ok:', response.ok);
            
            if (response.ok) {
              console.log('Email sent successfully!');
              
              // Success
              formMessage.textContent = '✓ Message sent successfully! I\'ll get back to you soon.';
              formMessage.className = 'form-message success';
              formMessage.style.display = 'block';
              contactForm.reset();
              
              // Reset button
              submitBtn.innerHTML = originalText;
              submitBtn.disabled = false;
              
              // Clear message after 5 seconds
              setTimeout(() => {
                formMessage.textContent = '';
                formMessage.className = 'form-message';
                formMessage.style.display = 'none';
              }, 5000);
            } else {
              console.error('Response not ok, status:', response.status);
              throw new Error('Form submission failed with status: ' + response.status);
            }
          })
          .catch(function(error) {
            console.error('Email sending failed:', error.message);
            console.error('Error:', error);
            
            // Error
            formMessage.textContent = '✗ Oops! Something went wrong. Please try again.';
            formMessage.className = 'form-message error';
            formMessage.style.display = 'block';
            
            // Reset button
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
          });
      }
      
      return false;
    });
  }
});

// Embedded Project iframes Loading Handler
document.addEventListener('DOMContentLoaded', function() {
  const iframes = document.querySelectorAll('.responsive-iframe-container iframe');
  const loaders = document.querySelectorAll('.iframe-loader');

  iframes.forEach((iframe, index) => {
    const loader = loaders[index];

    // Hide loader when iframe loads
    iframe.onload = function() {
      if (loader) {
        loader.style.display = 'none';
      }
    };

    // Handle iframe load error
    iframe.onerror = function() {
      if (loader) {
        loader.innerHTML = '<div style="text-align: center; color: #888;"><p style="margin: 0; font-size: 0.95rem;">Unable to load preview</p></div>';
      }
    };

    // Set a timeout to show fallback if iframe doesn't load in 4 seconds
    setTimeout(() => {
      if (loader && loader.style.display !== 'none') {
        const fallback = iframe.parentElement.querySelector('.iframe-fallback');
        if (fallback) {
          loader.style.display = 'none';
          fallback.style.display = 'flex';
        }
      }
    }, 4000);
  });
});

// Project Filter Functionality
document.addEventListener('DOMContentLoaded', function() {
  const filterButtons = document.querySelectorAll('.filter-btn');
  const projectCards = document.querySelectorAll('.project-card');

  filterButtons.forEach(button => {
    button.addEventListener('click', () => {
      // Remove active class from all buttons
      filterButtons.forEach(btn => btn.classList.remove('active'));
      // Add active class to clicked button
      button.classList.add('active');

      const filterValue = button.getAttribute('data-filter');

      projectCards.forEach(card => {
        const category = card.getAttribute('data-category');
        if (filterValue === 'all' || category === filterValue) {
          card.style.display = 'block';
          card.style.animation = 'fadeIn 0.5s ease-in-out';
        } else {
          card.style.display = 'none';
        }
      });
    });
  });
});

// Embedded Project iframes Loading Handler









// Embedded Project iframes Loading Handler
document.addEventListener('DOMContentLoaded', function() {
  const iframes = document.querySelectorAll('.responsive-iframe-container iframe');
  const loaders = document.querySelectorAll('.iframe-loader');

  iframes.forEach((iframe, index) => {
    const loader = loaders[index];

    // Hide loader when iframe loads
    iframe.onload = function() {
      if (loader) {
        loader.style.display = 'none';
      }
    };

    // Handle iframe load error
    iframe.onerror = function() {
      if (loader) {
        loader.innerHTML = '<div style="text-align: center; color: #888;"><p style="margin: 0; font-size: 0.95rem;">Unable to load preview</p></div>';
      }
    };
  });
});