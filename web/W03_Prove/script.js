$(document).ready(function(){
    $(".item").click(function(event){
      $.post("changeSessVar.php",
      {
        var: "ItemsList",
        value: $(this).attr('id')
      },
      function(data,status){
        data = JSON.parse(data)
        alert(data)
        style = ""
        if (data[2])
        {
            style = "solid 1px red"
        }
        else
        {
            style = "none"
        }
        $("#" + data[1]).css("border", style)
      });
    });
  });