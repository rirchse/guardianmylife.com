
  // Get the radio buttons with the name "aboutcall"
  var aboutCallRadios = document.getElementsByName("aboutcall");
  var time_display = document.getElementById("timerDisplay1");
  var customer_id = document.getElementById("customer_id").value;
  if(aboutCallRadios.length > 0)
  {
    // Add event listener to each radio button
    aboutCallRadios.forEach(function(radio) 
    {
      radio.addEventListener("change", function()
      {
        // Get the selected value
        var selectedValue = document.querySelector('input[name="aboutcall"]:checked').value;     
  
        // Show the corresponding div based on the selected value
        if(selectedValue === "Not Interested")
        {
          storeTimeInDatabase1(elapsedTime1);     
          document.getElementById("callForm").submit();
        }
        else if(selectedValue === "Review")
        {
          document.getElementById("remarks").style.display="block";        
          document.getElementById("remainder").style.display = "none";
          document.getElementById("appointment").style.display = "none";
        }
        else if(selectedValue === "Reminder")
        {
          document.getElementById("remarks").style.display="none";
          document.getElementById("appointment").style.display = "none";
          document.getElementById("remainder").style.display = "block";
        }
        else if(selectedValue === "Appointment")
        {
          document.getElementById("remarks").style.display="none";
          document.getElementById("remainder").style.display = "none";
          document.getElementById("appointment").style.display = "block";
        }
      });
    });
  }


$('input[name="call_experience"]').on('change', function()
{  
  var selectedValue = $('input[name="call_experience"]:checked').val();    
  if (selectedValue === 'Yes')
  {
    $('#second-option').show();     
  }
  else
  {
    document.getElementById("remarks").style.display="none";
      document.getElementById("remainder").style.display = "none";
      document.getElementById("appointment").style.display = "none";
    $('#second-option').hide();   
    storeTimeInDatabase1(elapsedTime1); 
    document.getElementById("callForm").submit();
  }
});
// Timer variables
let startTime1;
let elapsedTime1 = 0;
let timerInterval1;

// Button click event handler
// document.getElementById("timerButton1").addEventListener("click", function() 
// {
//   handleTimerClick(this, 1);
// });


document.addEventListener("DOMContentLoaded", function()
{
  const storedStartTime = localStorage.getItem("startTime_"+customer_id);
  if(storedStartTime)
  {
    console.log(localStorage.getItem('localTimer_'+customer_id));
    startTime1 = parseInt(storedStartTime, 10);
    elapsedTime1 = new Date().getTime() - startTime1;
    displayTime1(elapsedTime1);

    // Automatically trigger the button click event
      document.getElementById("timerButton1").click();
  }
});

// Timer update function
function updateTimer1()
{
  const currentTime = new Date().getTime();
  elapsedTime1 = currentTime - startTime1;
  displayTime1(elapsedTime1, 1);
}

// Display the elapsed time
function displayTime1(time, timerId)
{
  const hours = Math.floor(time / (1000 * 60 * 60));
  const minutes = Math.floor((time % (1000 * 60 * 60)) / (1000 * 60));
  const seconds = Math.floor((time % (1000 * 60)) / 1000);
  const formattedTime = padTime(hours) + ":" + padTime(minutes) + ":" + padTime(seconds);
  //document.getElementById("timerDisplay" + timerId).textContent = formattedTime;
  time_display.textContent = formattedTime;
}

// Pad single-digit time values with leading zeros
function padTime(time)
{
  return time.toString().padStart(2, "0");
}

// Store the elapsed time in the database using AJAX
function storeTimeInDatabase1(time)
{
  const hours = Math.floor(time / (1000 * 60 * 60));
  const minutes = Math.floor((time % (1000 * 60 * 60)) / (1000 * 60));
  const seconds = Math.floor((time % (1000 * 60)) / 1000);
  document.getElementById("hour").value = hours;
  document.getElementById("minutes").value = minutes;
  document.getElementById("seconds").value = seconds;  
  // console.log("Time stored in the database for timer 1!");
}

// Common event handler for timer buttons
function handleTimerClick()
{
  var timer = document.getElementById('timerDisplay1');
  if (!timerInterval1)
  {
    // Start the timer    
    startTime1 = new Date().getTime() - elapsedTime1;
    localStorage.setItem("startTime_"+customer_id, startTime1);
    timerInterval1 = setInterval(function() 
    {
      updateTimer1();
    }, 1000);
    // button.textContent = "Hang On";

    // call hanged and end section show
    var call_end = document.getElementById('call_end');
    call_end.classList.remove('hide');
  }
  else
  {
    // Stop the timer
    clearInterval(timerInterval1);
    timerInterval1 = time_display.innerHTML;
    elapsedTime1 = 0;
    // button.textContent = 'Hanged';
    storeTimeInDatabase1(elapsedTime1);
    localStorage.removeItem("startTime_"+customer_id);
  }
}

function submitFormAndRunFunction()
{                  
  storeTimeInDatabase1(elapsedTime1);             
  document.getElementById('callForm').submit();
}

/* call timer function */
function call(e)
{
  handleTimerClick(e, 1);
  document.getElementById("customer_call_information").style.display="block";
}

function callHang(e)
{
  handleTimerClick(e, 1);
}

function callEnd(e)
{
  clearInterval(timerInterval1);

  document.getElementById("customer_call_information").style.display="block";
  localStorage.removeItem("startTime_"+customer_id);
}
