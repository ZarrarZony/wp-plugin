<!DOCTYPE html>
<html>
<head>

<script type="text/javascript">
$(document).ready(function(){

  jqueryfunc = {
    get_details: function(id) {
      $.ajax({
        url: 'https://jsonplaceholder.typicode.com/users/'+id,
        async: true,
      })
      .done(function(data) {
        $("#usrdet").empty();
        $("#usrdet").show();
        $( "#usrdet" ).append( 
          '<h2>User details</h2>' 
        );
          $.each(data,function(index, value) {
            if(index == 'address' || index == 'company'){
              $( "#usrdet" ).append( 
                '<p>'+index+' :</p>' 
              );
              $.each(value,function(index2, value2) {
                $( "#usrdet" ).append( 
                  '<p>'+index2+' : '+value2+'</p>' 
                );
              });
            }else{
              $( "#usrdet" ).append( 
                '<p>'+index+' : '+value+'</p>' 
              );
            }
          });
      })
      .fail(function() {
        console.log("error");
      });
      
    }
  }

  jqueryfunc.get_details(1);

  $("a").click(function(){
    var id = $(this).data("id")
    jqueryfunc.get_details(id);
  });
  
});

</script>
</body>
</html>
