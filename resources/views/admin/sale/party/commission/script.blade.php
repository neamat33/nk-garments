<script>
    $(document).ready(function() {
        $('#party_id').change(function() {
            var selectedPartyId = $(this).val();
            if (selectedPartyId !== '') {
                $.ajax({
                    url: '/party-sale/total-qty/' + selectedPartyId,
                    method: 'GET',
                    success: function(response) {
                        $('#total_invoice_display').text('Total Invoice: ' + response.total_invoice).addClass('text-success').css('font-weight', '600');
                        $('#total_qty_display').text('Total Quantity: ' + response.total_qty).addClass('text-success').css('font-weight', '600');
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            } else {
                $('#total_invoice_display').text('Total Invoice: ').addClass('text-success').css('font-weight', '600');;
                $('#total_qty_display').text('Total Quantity: ').addClass('text-success').css('font-weight', '600');;
            }
        });
    });
</script>