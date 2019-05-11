$(document).ready(function(){
    $(".item").click(function(event){
      $.post("changeSessVar.php",
      {
        var: "ItemsList",
        value: $(this).attr('id')
      },
      function(data,status){
        alert(data)
        style = ""
        if (data[2])
        {
            "solid 1px red"
        }
        else
        {
            "none"
        }
        $("." + data[1]).css("border", style)
      });
    });
  });