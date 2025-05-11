document.addEventListener('DOMContentLoaded', function() {
    const slider = document.querySelector('.slider');
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.slider-dot');
    const prevBtn = document.querySelector('.slider-arrow.prev');
    const nextBtn = document.querySelector('.slider-arrow.next');
    
    let currentSlide = 0;
    const totalSlides = slides.length;
    let slideInterval;

    // Initialize the slider
    startSlider();
    
    // Start auto slide
    function startSlider() {
        slideInterval = setInterval(nextSlide, 5000);
    }
    
    // Stop auto slide
    function stopSlider() {
        clearInterval(slideInterval);
    }
    
    // Navigate to a specific slide
    function goToSlide(index) {
        // Reset active state for all slides and dots
        slides.forEach(slide => slide.classList.remove('active'));
        dots.forEach(dot => dot.classList.remove('active'));
        
        // Add active class to current slide and dot
        slides[index].classList.add('active');
        dots[index].classList.add('active');
        
        // Move the slider to show the current slide
        slider.style.transform = `translateX(-${index * (100 / totalSlides)}%)`;
        
        // Update current slide index
        currentSlide = index;
    }
    
    // Navigate to next slide
    function nextSlide() {
        let nextIndex = currentSlide + 1;
        if (nextIndex >= totalSlides) {
            nextIndex = 0;
        }
        goToSlide(nextIndex);
    }
    
    // Navigate to previous slide
    function prevSlide() {
        let prevIndex = currentSlide - 1;
        if (prevIndex < 0) {
            prevIndex = totalSlides - 1;
        }
        goToSlide(prevIndex);
    }
    
    // Event listeners for dots
    dots.forEach(dot => {
        dot.addEventListener('click', function() {
            stopSlider();
            goToSlide(parseInt(this.getAttribute('data-index')));
            startSlider();
        });
    });
    
    // Event listeners for arrows
    prevBtn.addEventListener('click', function() {
        stopSlider();
        prevSlide();
        startSlider();
    });
    
    nextBtn.addEventListener('click', function() {
        stopSlider();
        nextSlide();
        startSlider();
    });
    
    // Pause auto slide on hover
    slider.addEventListener('mouseenter', stopSlider);
    slider.addEventListener('mouseleave', startSlider);
});