
const toggleBtn = document.querySelector(".toggle-btn");
const toggleBtnIcon = document.querySelector(".toggle-btn i");
const dropdownMenu = document.querySelector(".dropdown-menu");

toggleBtn.onclick = () => 
{
  if (dropdownMenu.style.height == "250px") 
  {
    dropdownMenu.style.height = "0px";
  }
  else
  {
    dropdownMenu.style.height = "250px";
  }
  
  if(toggleBtnIcon.className == "fas fa-bars")
  {
    toggleBtnIcon.className = "fas fa-xmark";
  }
  else
  {
    toggleBtnIcon.className = "fas fa-bars";
  }
}

function closeDropdown()
{
  dropdownMenu.style.height = "0px";
  if(toggleBtnIcon.className == "fas fa-xmark")
  {
    toggleBtnIcon.className = "fas fa-bars";
  }
  else
  {
    toggleBtnIcon.className = "fas fa-xmarks";
  }
}

// navbar 
window.onscroll = () => 
{
  if (document.body.scrollTop > 0 || document.documentElement.scrollTop > 0)
  {
    document.querySelector("header").classList.add('header-scroll');
  }
  else
  {
    document.querySelector("header").classList.remove('header-scroll');
  }
  
  // back to top button
  var button = document.getElementById("backToTopBtn");

  if (document.body.scrollTop > 700 || document.documentElement.scrollTop > 700) {
    button.style.display = 'block';
  } else {
    button.style.display = 'none';
  }

  button.addEventListener('click', function () {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE, and Opera
  });
  
}

// counter

// Wait for the DOM to be ready
document.addEventListener('DOMContentLoaded', function () {
  // Set up counters
  setupCounter('counter1', 1);
  setupCounter('counter2', 407);
  setupCounter('counter3', 12);
});

// Counter setup function
function setupCounter(counterId, targetValue) {
  const counter = document.getElementById(counterId);
    const countSpan = counter.querySelector('.count');

  let currentValue = 0;
  const increment = targetValue > 100 ? 10 : 1; // Adjust increment based on target value

  // Update counter value
  function updateCounter() {
    if (currentValue < targetValue) {
      currentValue += increment;
      countSpan.textContent = currentValue;

      // Repeat the update after a short delay
      setTimeout(updateCounter, 30);
    } else {
      countSpan.textContent = targetValue;
    }
  }

  // Start updating the counter
  updateCounter();
}

// accordion
var acc = document.getElementsByClassName("accordion");

for (var i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function () {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display == "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
    
    // border bottom
    if (this.style.borderBottom == "0px solid black") {
      this.style.borderBottom = "1px solid black";
    } else {
      this.style.borderBottom = "0px solid black";
    }

    // panel height
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }

  });
}