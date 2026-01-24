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
    playPauseBtn.addEventListener('click', function() {
      if (audio.paused) {
        audio.play();
        playPauseBtn.textContent = 'Pause';
      } else {
        audio.pause();
        playPauseBtn.textContent = 'Play';
      }
    });
    // Set initial button text
    playPauseBtn.textContent = audio.paused ? 'Play' : 'Pause';
  }
});



// document.addEventListener("DOMContentLoaded", function() {
//   const preloader = document.getElementById('preloader');
//   window.addEventListener('load', function() {
//     preloader.style.display = 'none';
//   });
// });



document.getElementById('downloadBtn').addEventListener('click', function() {
    const link = document.createElement('a');
    link.href = 'softray.pdf';  // PDF file location
    link.download = 'softray.pdf';   // Downloaded file name
    link.click();
});






function sendMail() {
  var params = {
    name: document.getElementById("name").value,
    email: document.getElementById("email").value,
    message: document.getElementById("message").value,
  };

  const serviceID = "service_noxrp8c";
  const templateID = "template_09sfi98";

    emailjs.send(serviceID, templateID, params)
    .then(res=>{
        document.getElementById("name").value = "";
        document.getElementById("email").value = "";
        document.getElementById("message").value = "";
        console.log(res);
        alert("Your message sent successfully!!")

    })
    .catch(err=>console.log(err));

}

// Theme Toggle Functionality
document.addEventListener('DOMContentLoaded', function() {
  const themeToggle = document.getElementById('themeToggle');
  const html = document.documentElement;

  // Check for saved theme preference or default to light mode
  const currentTheme = localStorage.getItem('theme') || 'light';
  html.setAttribute('data-theme', currentTheme);

  // Update toggle button based on current theme
  updateThemeToggle(currentTheme);

  // Toggle theme on button click
  if (themeToggle) {
    themeToggle.addEventListener('click', function() {
      const currentTheme = html.getAttribute('data-theme');
      const newTheme = currentTheme === 'light' ? 'dark' : 'light';

      html.setAttribute('data-theme', newTheme);
      localStorage.setItem('theme', newTheme);
      updateThemeToggle(newTheme);
    });
  }

  function updateThemeToggle(theme) {
    if (themeToggle) {
      const sunIcon = themeToggle.querySelector('.fa-sun');
      const moonIcon = themeToggle.querySelector('.fa-moon');

      if (theme === 'dark') {
        sunIcon.style.opacity = '0';
        sunIcon.style.transform = 'rotate(-180deg)';
        moonIcon.style.opacity = '1';
        moonIcon.style.transform = 'rotate(0deg)';
      } else {
        sunIcon.style.opacity = '1';
        sunIcon.style.transform = 'rotate(0deg)';
        moonIcon.style.opacity = '0';
        moonIcon.style.transform = 'rotate(180deg)';
      }
    }
  }
});
