$(document).ready(function(){
    $(".item").click(function(event){
      $.post("changeSessVar.php",
      {
        var: "ItemsList",
        value: $(event.target).attr('name')
      },
      function(data,status){
        alert(data)
        $(event.target).css("border", "1p solid red")
      });
    });
  });