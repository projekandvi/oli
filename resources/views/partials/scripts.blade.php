
  <!-- Javascripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/accounting.js/0.4.1/accounting.min.js"></script>
    {{-- <script src="{{ asset('js/transaksi.js') }}"></script> --}}
  <script src="{{ asset('/assets/js-core/slimscroll.js') }}"></script>
  <script src="{{ asset('/assets/js-core/screenfull.js') }}"></script>
  <script defer src="{{ asset('/build/app.b81f4459eb1b0cdac4d5.js') }}"></script>
  <script src="{{ asset('/assets/js-core/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('/assets/js-core/highcharts.js') }}"></script>
  <script src="{{ asset('/assets/js-core/exporting.js') }}"></script>

  <script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>     

    <script src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js'></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

  <script>
      $('.dateTime').datetimepicker({
          format : 'YYYY-M-D'
      })

      function submitted () {
        document.getElementById('submitButton').disabled=true;
        document.getElementById('submitButton').value='Submitting, please wait...';
        document.getElementById("ism_form").submit();
      }

      
  </script>
  <script>// the selector will match all input controls of type :checkbox
    // and attach a click event handler 
    $("input:checkbox").on('click', function() {
      // in the handler, 'this' refers to the box clicked on
      var $box = $(this);
      if ($box.is(":checked")) {
        // the name of the box is retrieved using the .attr() method
        // as it is assumed and expected to be immutable
        var group = "input:checkbox[name='" + $box.attr("name") + "']";
        // the checked state of the group/box on the other hand will change
        // and the current value is retrieved using .prop() method
        $(group).prop("checked", false);
        $box.prop("checked", true);
      } else {
        $box.prop("checked", false);
      }
    });</script>
    <script>
    $(function() {
	    $('#colorselector').change(function(){
	      $('.colors').hide();
	      $('#' + $(this).val()).show();
	    });
    });

    $(function() {
	    $('#debit_selector').change(function(){
	      $('.debit_colors').hide();
	      $('#' + $(this).val()).show();
	    });
    });
  </script>

<script type="text/javascript">
  jQuery(document).ready(function ()
  {
    jQuery('select[name="lokasi_barang"]').on('change',function(){
        var lokasiID = jQuery(this).val();
        if(lokasiID)
        {
          jQuery.ajax({
              url : 'slipOrder/new/getlokasi/' +lokasiID,
              type : "GET",
              dataType : "json",
              success:function(data)
              {
                console.log(data);
                jQuery('select[name="id_barangs"]').empty();
                jQuery.each(data, function(key,value){
                    $('select[name="id_barangs"]').append('<option value="'+ key +'">'+ value +'</option>');
                });
              }
          });
        }
        else
        {
          $('select[name="state"]').empty();
        }
    });
  });

  // In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.gampang').select2();
});

$(document).ready( function () {
    $('#table_id').DataTable();
} );
  </script>

  <script>
    $body = $("body");

$(document).on({
    ajaxStart: function() { $body.addClass("loading");    },
     ajaxStop: function() { $body.removeClass("loading"); }    
});
  </script>

