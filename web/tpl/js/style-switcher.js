jQuery(function($){



    $('#style-switcher h3 a').click(function(){
        if($(this).hasClass('show')){
            $( "#style-switcher" ).animate({
              left: "-=200"
              }, 300, function() {
                // Animation complete.
              });
              $(this).removeClass('show').addClass('hidden1');
        }
        else {      
            $( "#style-switcher" ).animate({
              left: "+=200"
              }, 300, function() {
                // Animation complete.
              });
              $(this).removeClass('hidden1').addClass('show');    
            }
      });


    // Color changer
    $(".color-red").click(function(){
        $("link[href^='css/skins/']").attr("href", "css/skins/red.css");
        return false;
    });

    $(".color-violet").click(function(){
        $("link[href^='css/skins/']").attr("href", "css/skins/violet.css");
        return false;
    });

    $(".color-blue").click(function(){
        $("link[href^='css/skins/']").attr("href", "css/skins/blue.css");
        return false;
    });
    
    $(".color-green").click(function(){
        $("link[href^='css/skins/']").attr("href", "css/skins/green.css");
        return false;
    });
    
    $(".color-orange").click(function(){
        $("link[href^='css/skins/']").attr("href", "css/skins/orange.css");
        return false;
    });

    $(".color-yellow").click(function(){
        $("link[href^='css/skins/']").attr("href", "css/skins/yellow.css");
        return false;
    });

    $(".color-asbestos").click(function(){
        $("link[href^='css/skins/']").attr("href", "css/skins/asbestos.css");
        return false;
    });

    $(".color-silver").click(function(){
        $("link[href^='css/skins/']").attr("href", "css/skins/silver.css");
        return false;
    });
	
});


