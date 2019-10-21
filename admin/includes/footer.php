</div><br><br>
<footer class="col-md-12 text-center">&copy; Copyright 2012-2017 Butik Dusan</footer>
  <script>
    function updateSizes() {
      var sizeString = '';
      for(var i=1;i<=12;i++) {
        if(jQuery('#size' + i).val()!='') {
          sizeString += jQuery('#size'+i).val()+':'+jQuery('#qty'+i).val()+':'+jQuery('#treshold'+i).val()+',';
        }
      }
      jQuery('#sizes').val(sizeString);
    }

    function get_child_options(selected){
      if(typeof selected === 'undefined') {
        var selected = '';
      }
      var parentID = jQuery('#parent').val();
      jQuery.ajax({
        url: '/clothes/admin/parsers/child_categories.php',
        type: 'POST',
        data: {parentID : parentID, selected: selected},
        success: function(data){
          jQuery('#child').html(data);
        },
        error: function(){alert("Nesto se iskundacilo! Something went wrong with the child options")},
      });
    }
    jQuery('select[name="parent"]').change(function(){
      get_child_options();
    });
  </script>
  </body>
</html>
