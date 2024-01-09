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
     
     $(".mytable").on("keyup", 'input[class*="rate"], input[class*="main_unit_qty"], input[class*="sub_unit_qty"], input[class*="commission"]', function (event) {
            calculateRow($(this).closest("tr"));
            calculateGrandTotal();
        });

     function calculateRow(row) {
          var rate = +row.find('input[class*="rate"]').val();
          var main_unit_qty = +row.find('input[class*="main_unit_qty"]').val();
          var related_unit = +row.find('input[class*="related_by"]').val();
          var sub_unit_qty = +row.find('input[class*="sub_unit_qty"]').val() ;

          var sub_total = (rate * (main_unit_qty + sub_unit_qty)).toFixed(2);
          var commission = +row.find('input[class*="commission"]').val();

          if (!isNaN(commission)) {
               sub_total -= commission; // Subtract commission from sub_total
               sub_total = sub_total.toFixed(2);
          }

          row.find('input[class*="sub_total"]').val(sub_total);
     }
     
     function calculateGrandTotal() {
          let totalQty= 0;
          let commissionTotal = 0;
          let subTotal= 0;
          
          $(".mytable").find('input[class*="sub_unit_qty"]').each(function () {
               totalQty += +$(this).val();
          });

          // $(".mytable").find('input[class*="commission"]').each(function () {
          //      commissionTotal += +$(this).val();
          // });

          $(".mytable").find('input[class*="sub_total"]').each(function () {
               subTotal += +$(this).val();
          });

          $("#total_qty").text("Total Qty : " + totalQty.toFixed(0));
          // $("#total_commission").text("Total C : " + commissionTotal.toFixed(2));
          $("#totalsubtotal").text("S. Total : " + subTotal.toFixed(2));

      }

</script>