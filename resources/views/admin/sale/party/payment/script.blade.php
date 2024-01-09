<script>
    $(document).ready(function() {
        // Variables to store the original total due
        var originalTotalDue = 0;
        var currentTotalDue = 0;

        // Your existing code for party_id change event
        $('#party_id').change(function() {
            var selectedPartyId = $(this).val();
            if (selectedPartyId !== '') {
                $.ajax({
                    url: '/party-sale/total-due-invoice/' + selectedPartyId,
                    method: 'GET',
                    success: function(response) {
                        originalTotalDue = response.total_due; // Store the original total due
                        currentTotalDue = originalTotalDue; // Set the current total due
                        $('#total_invoice_display').text('Total Due Invoice: ' + response.total_due_invoice).addClass('text-success').css('font-weight', '600');
                        $('#total_due_display').text('Total Due Amount: ' + currentTotalDue + ' Tk').addClass('text-success').css('font-weight', '600');
                        $('#current_due').val(currentTotalDue);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            } else {
                originalTotalDue = 0; // Reset original total due
                currentTotalDue = 0; // Reset current total due
                $('#total_invoice_display').text('Total Due Invoice: ').addClass('text-success').css('font-weight', '600');
                $('#total_due_display').text('Total Due Amount: ').addClass('text-success').css('font-weight', '600');
                $('#current_due').val(currentTotalDue);
            }
        });

        function calculateGrandTotal() {
            var discountAmount = parseFloat($('#discount_amount').val()) || 0;
            var payAmount = parseFloat($('#pay_amount').val()) || 0;
            currentTotalDue = originalTotalDue - discountAmount;
            var currentTotalDueText = (currentTotalDue - payAmount).toFixed(2);

            // Update the display
            $('#total_due_display').text('Total Due Amount: ' + currentTotalDueText + ' Tk').addClass('text-success').css('font-weight', '600');
            $('#current_due').val(currentTotalDue);

            if (payAmount > currentTotalDue) {
                toastr.warning('Pay amount is more than total due!');
                $('#pay_amount').val(currentTotalDue);

            }
        }

        $('#pay_amount, #discount_amount').on('keyup', function() {
            calculateGrandTotal();
        });
    });
</script>
