toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-bottom-right"
};
$(document).ready(function() {
    $('#setFitness').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: fitnessSetRoute,
            type: "POST",
            data: formData,
            success: function(response) {
                if(response.success) {
                    toastr.success(response.message);
                    console.log(response);
                    $('input[name="availslot"]').val('');

                    fetchFitnessData();

                    $(document).trigger('fitnessSet');
                    
                } else {
                    toastr.error(response.message);
                    console.log(response);
                }
            },
            error: function(xhr, status, error, message) {
                var errorMessage = xhr.responseText ? JSON.parse(xhr.responseText).message : 'An error occurred';
                toastr.error(errorMessage);
            }
        });
    });
});

$(document).ready(function() {
    fetchFitnessData(); 
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


$(function () {
    $('#setFitness').validate({
        rules: {
            maxslot: {
                required: true,
            },
            availslot: {
                required: true,
            },
        },
        messages: {
            maxslot: {
                required: "Please Enter maximum slot",
            },
            availslot: {
                required: "Please Enter available slot",
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.col-md-12').append(error);        
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
    });
});
