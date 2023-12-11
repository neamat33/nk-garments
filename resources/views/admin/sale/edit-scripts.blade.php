<script>
    $(document).ready(function () {
        $(".mytable").on("keyup", 'input[class*="rate"], input[class*="main_unit_qty"], input[class*="sub_unit_qty"], input[class*="commission"]', function (event) {
            calculateRow($(this).closest("tr"));
            calculateGrandTotal();
        });

        $(".mytable").on("click", "button.deleteRow", function (event) {
            $(this).closest("tr").remove();
            calculateGrandTotal();
        });

        function calculateRow(row) {
            var rate = +row.find('input[class*="rate"]').val();
            var main_price = +row.find('input[class*="main-price"]').attr('data-price');
            var main_unit_qty = +row.find('input[class*="main_unit_qty"]').val() * main_price || 0;
            var related_unit = +row.find('input[class*="related_by"]').val();
            var sub_unit_qty = +row.find('input[class*="sub_unit_qty"]').val() * rate || 0;

            var sub_total = (main_unit_qty + sub_unit_qty).toFixed(2);
            var commission = +row.find('input[class*="commission"]').val();

            if (!isNaN(commission)) {
                sub_total -= commission; // Subtract commission from sub_total
                sub_total = sub_total.toFixed(2);
            }

            row.find('input[class*="sub_total"]').val(sub_total);
        }

        function calculateGrandTotal() {
            var grandTotal = 0;
            var discountTotal = 0;
            var commissionTotal = 0;

            $(".mytable").find('input[class*="sub_total"]').each(function () {
                grandTotal += +$(this).val();
            });

            $(".mytable").find('input[class*="commission"]').each(function () {
                commissionTotal += +$(this).val() || 0;
            });

            discountTotal = +$("#input_discount").val() || 0;

            // Subtract discount from the grand total
            var receivableTotal = grandTotal - discountTotal;

            $("#input_receivable").val(receivableTotal.toFixed(2));
            $("#input_commission").val(commissionTotal.toFixed(2));
            $("#pay_amount").val(receivableTotal.toFixed(2));
            $("#subtotal_").val(grandTotal.toFixed(2));

        }

        $(document).ready(function () {
            $("#party_amount").on("input", function () {
                var receivableTotal = parseFloat($("#input_receivable").val());
                var partyAmount = parseFloat($(this).val());

                if (partyAmount > receivableTotal) {
                    toastr.warning('Cannot exceed Total Invoice Amount!');

                    $(this).val(receivableTotal.toFixed(2));
                }
            });
        });


        $("#input_discount").on("keyup", function (event) {
            calculateGrandTotal();
        });
    });
</script>