// Add this function to check and display low stock warnings for inventory items

$(document).ready(function() {
    // Define low quantity threshold
    var lowQuantityThreshold = 3; // You can adjust this value as needed
    
    // Function to check stock levels and show warnings
    function checkLowStockItems() {
        $.ajax({
            url: inventoryItemsRoute, // You need to define this route in your blade template
            type: 'GET',
            success: function(data) {
                let lowStockCount = 0;
                let outOfStockCount = 0;
                
                // Process each item to check stock levels
                $.each(data, function(index, item) {
                    if (item.number_equip <= 0) {
                        outOfStockCount++;
                    } else if (item.number_equip <= lowQuantityThreshold) {
                        lowStockCount++;
                    }
                });
                
                // Display notifications if there are low stock items
                if (outOfStockCount > 0) {
                    toastr.error('Warning: ' + outOfStockCount + ' items are out of stock!');
                    
                    // You can add an indicator to the page
                    $('#inventoryLowStockIndicator').html(
                        '<div class="alert alert-danger">' +
                        '<i class="fas fa-exclamation-triangle"></i> ' +
                        outOfStockCount + ' items are out of stock! Please restock immediately.' +
                        '</div>'
                    );
                }
                
                if (lowStockCount > 0) {
                    toastr.warning('Warning: ' + lowStockCount + ' items are low in stock!');
                    
                    // Only show this if there's no out of stock alert already
                    if (outOfStockCount === 0) {
                        $('#inventoryLowStockIndicator').html(
                            '<div class="alert alert-warning">' +
                            '<i class="fas fa-exclamation-circle"></i> ' +
                            lowStockCount + ' items are low in stock. Consider restocking soon.' +
                            '</div>'
                        );
                    }
                }
                
                // Update the DataTable to highlight low stock items
                updateInventoryTableWithWarnings();
            },
            error: function(xhr, status, error) {
                console.error('Error checking inventory levels:', error);
            }
        });
    }
    
    // Function to highlight low stock items in the DataTable
    function updateInventoryTableWithWarnings() {
        if ($.fn.DataTable.isDataTable('#inventoryCategoryTable')) {
            var table = $('#inventoryCategoryTable').DataTable();
            
            // Add conditional formatting to quantity column
            table.rows().every(function() {
                var data = this.data();
                var qty = parseInt(data.number_equip);
                var node = this.node();
                
                if (qty <= 0) {
                    $(node).find('td:eq(' + getQuantityColumnIndex() + ')').html(
                        '<span class="badge badge-danger">' + qty + '</span>'
                    );
                } else if (qty <= lowQuantityThreshold) {
                    $(node).find('td:eq(' + getQuantityColumnIndex() + ')').html(
                        '<span class="badge badge-warning">' + qty + '</span>'
                    );
                } else {
                    $(node).find('td:eq(' + getQuantityColumnIndex() + ')').html(
                        '<span class="badge badge-success">' + qty + '</span>'
                    );
                }
            });
        }
    }
    
    // Helper function to find the quantity column index
    function getQuantityColumnIndex() {
        var table = $('#inventoryCategoryTable').DataTable();
        var columnIndex = 0;
        
        table.columns().every(function(index) {
            var columnHeader = $(this.header()).text().trim().toLowerCase();
            if (columnHeader === 'quantity' || columnHeader === 'stock' || columnHeader === 'number_equip') {
                columnIndex = index;
                return false; // Break the loop
            }
        });
        
        return columnIndex;
    }
    
    // Run the check when the page loads
    checkLowStockItems();
    
    // Add a check after any inventory changes
    $(document).on('inventoryUpdated', function() {
        checkLowStockItems();
    });
    
    // Add a button to manually check inventory levels
    $('#checkInventoryLevels').on('click', function() {
        checkLowStockItems();
    });
});
