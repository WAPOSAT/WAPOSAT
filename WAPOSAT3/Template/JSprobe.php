<script src="../js/jquery.js"></script>
<script type="text/javascript">
    var Datarecibe = {};
    
    $data = {
      "action": "test"
    };
    $.ajax({
      type: "POST",
      url: "monitoreo/responseProbe.php",
      data: $data,
      dataType: "json",
      success: function(data) {
        Datarecibe = data;
      }
    });
</script>