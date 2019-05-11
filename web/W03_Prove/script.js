$(document).ready(function(){
    $(".item").click(function(event){
      $.post("changeSessVar.php",
      {
        var: "ItemsList",
        value: $(event.target).name
      },
      function(data,status){
        alert(data)
      });
    });
  });