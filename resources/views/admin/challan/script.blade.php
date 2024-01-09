<script>
     function empty_field_check(placeholder) {
            if (placeholder == null) {
                placeholder = 0;
            } else if (placeholder.trim() == "") {
                placeholder = 0;
            }
            return placeholder;
        }

       $(document).ready(function () {
            $('.main_unit_qty').on('input', function () {
                let obj = $(this);
                let dataSubQty = obj.data('main_unit');
                let dueSubQtyValue = parseFloat(obj.val());

                // Ensure that the value is at least 1
                if (isNaN(dueSubQtyValue) || dueSubQtyValue < 1) {
                    toastr.warning('The quantity in sub unit cannot be less than 1');
                    obj.val(1);
                } else if (dueSubQtyValue > parseFloat(dataSubQty)) {
                    toastr.warning('The quantity in sub unit cannot exceed');
                    obj.val(dataSubQty);
                }
            });
        });

         $(document).ready(function () {
            $('.sub_unit_qty').on('input', function () {
                let obj = $(this);
                let dataSubQty = obj.data('sub_qty');
                let dueSubQtyValue = parseFloat(obj.val());

                // Ensure that the value is at least 1
                if (isNaN(dueSubQtyValue) || dueSubQtyValue < 1) {
                    toastr.warning('The quantity in sub unit cannot be less than 1');
                    obj.val(1);
                } else if (dueSubQtyValue > parseFloat(dataSubQty)) {
                    toastr.warning('The quantity in sub unit cannot exceed');
                    obj.val(dataSubQty);
                }
            });
        });

     $(".no-return").on("click", function () {
          let tr = $(this).parent().parent();
          tr.remove();
          calculateGrandTotal();
     });
     
     $(".mytable").on("keyup", 'input[class*="main_unit_qty"], input[class*="sub_unit_qty"]', function (event) {
            calculateRow($(this).closest("tr"));
            calculateGrandTotal();
        });
     
     function calculateGrandTotal() {
          let totalQty= 0;
          let commissionTotal = 0;
          let subTotal= 0;
          
          $(".mytable").find('input[class*="sub_unit_qty"]').each(function () {
               totalQty += +$(this).val();
          });
          $("#total_qty").text("Total Qty : " + totalQty.toFixed(0));

      }

</script>