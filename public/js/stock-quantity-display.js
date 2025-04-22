/**
 * Changes the color of quantity displays based on stock level
 * Add this script to your page and call highlightLowStock() after the page loads
 */
function highlightLowStock() {
    // Find all quantity elements (adjust the selector to match your HTML structure)
    const quantityElements = document.querySelectorAll('.product-quantity');
    
    // Define your threshold for low stock
    const LOW_STOCK_THRESHOLD = 5;
    
    quantityElements.forEach(element => {
        // Get the quantity value (adjust based on your HTML structure)
        const quantity = parseInt(element.textContent || element.innerText, 10);
        
        // Set color based on quantity
        if (isNaN(quantity) || quantity <= 0) {
            // Out of stock
            element.style.color = 'red';
            element.style.fontWeight = 'bold';
        } else if (quantity <= LOW_STOCK_THRESHOLD) {
            // Low stock
            element.style.color = 'red';
        }
    });
}

// You can also create a CSS class to use instead of inline styles
