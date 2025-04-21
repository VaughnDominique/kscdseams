$(document).ready(function() {
    fetchFitnessData(); 
    setInterval(fetchFitnessData, 5000);
});

function fetchFitnessData() {
    $.ajax({
        url: fitnessShowRoute,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.data.length > 0) {
                const fitness = response.data[0]; 

                $('#availableSlot').text(fitness.availslot);
                $('#maximumSlot').text(fitness.maxslot);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching fitness data:', error);
        }
    });
}