$(function(){
    admin.toggle();
    animate.play();
    districort.hide('admin', ['.footer', '#linkAdmin']);
});


var animate = {
    options : {
        autoPlay: true,
        autoPlayDelay: 4000,    
        pauseOnHover: false,
        navigationSikp: 1000,
        reverseAnimationsWhenNavigatingBackwards: false,
        pagination: true
    },
    play: function(options){
        options = options || this.options;
        $("#sequence").sequence(options).data("sequence")
    }
};


var admin = {
    toggle:function(){
         $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });   
    }
}
 

var districort = {
    findText: function(str, arg){
        return (str.indexOf(arg) > -1);
    },

    hide: function(section, toHide){
        this.findText(document.URL, '/'+section) && (function(){
            for (var i = toHide.length - 1; i >= 0; i--) {
                $(toHide[i]).hide();
            };
        })();
        
    }
}