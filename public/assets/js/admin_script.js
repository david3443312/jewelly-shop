document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.getElementById('toggle-sidebar');
    const sidebar = document.getElementById('sidebar');
    if (toggleButton && sidebar) {
        toggleButton.addEventListener('click', function() {
            sidebar.classList.toggle('hide');
        });
    } else {
        console.error("Không tìm thấy phần tử với id 'toggle-sidebar' hoặc 'sidebar'.");
    }
});