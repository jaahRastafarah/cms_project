  $(document).ready(function(){

    ClassicEditor
    .create( document.querySelector( '#body' ) )
    .catch( error => {
        console.error( error );
    } );
  })

  $(document).ready(function(){
    $('#selectAllBoxes').click(function(){
       if(this.checked){
         $('.checkboxes').each(function(){
           this.checked=true;
         });
       } else{
        $('.checkboxes').each(function(){
          this.checked=false;
        });
      }
    });
  });

  function loadusersonline(){
    $.get("functions.php?onlineusers=result", function(data){
          $(".usersonline").text(data);
    });
  }
    setInterval ( function() {
    loadusersonline();
   }, 500);
 
  
  