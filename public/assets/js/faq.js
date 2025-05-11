function toggleFAQ(element) {
    // Get the answer element (next sibling of the question)
    const answer = element.nextElementSibling;
    
    // Get the toggle button
    const toggleBtn = element.querySelector('.toggle-btn');
    
    // Toggle active class on answer
    answer.classList.toggle('active');
    
    // Change toggle button text based on state
    if (answer.classList.contains('active')) {
        toggleBtn.textContent = '-';
    } else {
        toggleBtn.textContent = '+';
    }
}

// Initialize the first question to be open
document.addEventListener('DOMContentLoaded', function() {
    const firstQuestion = document.querySelector('.faq-question');
    toggleFAQ(firstQuestion);
}); 