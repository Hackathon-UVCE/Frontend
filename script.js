// Function to show the popup modal
function showPopup() {
    document.getElementById('popup').style.display = 'block';
}

// Function to close the popup modal
function closePopup() {
    document.getElementById('popup').style.display = 'none';
}

function showChecklist() {
    var checklist = document.getElementById('checklist');
    checklist.style.display = 'block';
}






function nearbyloc() {
    var checklist = document.getElementById('nearbyloc');
    checklist.style.display = 'block';
}




let slideIndex = 0;
showSlides();

function showSlides() {
    let i;
    const slides = document.getElementsByClassName("slide");
    const dots = document.getElementsByClassName("dot");

    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";  
    }
    
    slideIndex++;
    if (slideIndex > slides.length) { slideIndex = 1; }    
    
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    
    slides[slideIndex-1].style.display = "block";  
    dots[slideIndex-1].className += " active";
    
    setTimeout(showSlides, 5000); // Change image every 5 seconds
}