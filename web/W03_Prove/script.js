$(document).ready(function(){
    $(".item").click(function(event){
      $.post("changeSessVar.php",
      {
        var: "ItemsList",
        value: $(this).attr('id')
      },
      function(data,status){
        alert(data)
        alert($(this).attr('id'))
      });
    });
  });