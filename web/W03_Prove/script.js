$(document).ready(function(){
    $(".item").click(function(event){
      $.post("changeSessVar.php",
      {
        var: "ItemsList",
        value: $(this).attr('id')
      },
      function(data,status){
        data = JSON.parse(data)
        //alert(data)
        style = ""
        if (data[2])
        {
            style = "#CCFFCC"
        }
        else
        {
            style = "white"
        }
        $("#" + data[1]).css("background-color", style)
      });
    });
  });

  $(document).ready(function(){
    $(".itemtr").click(function(event){
      $.post("changeSessVar.php",
      {
        var: "ItemsList",
        value: $(this).attr('id')
      },
      function(data,status){
        data = JSON.parse(data)
        alert(data)
        $(this).attr("id", "a")
        $("#" + data[1]).css("display", "none")
      });
    });
  });