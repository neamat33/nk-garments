<script>
    $(document).ready(function () {
    $(".mytable").on("keyup", 'input[class*="rate"], input[class*="main_unit_qty"], input[class*="sub_unit_qty"]', function (event) {
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
        var sub_unit_qty = +row.find('input[class*="sub_unit_qty"]').val() * rate || 0;

        var sub_total = (main_unit_qty + sub_unit_qty).toFixed(2);
        row.find('input[class*="sub_total"]').val(sub_total);
    }

    function calculateGrandTotal() {
        var grandTotal = 0;

        $(".mytable").find('input[class*="sub_total"]').each(function () {
            grandTotal += +$(this).val();
        });

        var discountTotal = +$("#input_discount").val() || 0;
        var commissionTotal = +$("#input_commission").val() || 0;

        var receivableTotal = grandTotal - discountTotal;

        $("#input_payable").val(receivableTotal.toFixed(2));
        $("#pay_amount").val(receivableTotal.toFixed(2));
        $("#subtotal_").val(grandTotal.toFixed(2));
    }
});

</script>