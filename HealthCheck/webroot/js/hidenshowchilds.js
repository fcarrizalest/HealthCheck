(function(){


	var Hshow = function (element, options) { 
		this.$element    = $(element);
      	this.options     = options;
      	var self = this;

      	if(this.options.parent != null){
      		this.$element.addClass('child_'+this.options.parent);
      	}

      	this.$element.click(function(){

      		self.toggleChilds();
      	});


      	this.$element.change(function(){


      		if( $(this).is(':visible') ){

      		}else{
      			self.hideAll();
      		}
      		
      		
      	});
    }

    Hshow.prototype.hideAll = function(){ 
    	var cls = '.child_'+this.options.id;
    	
    	$(cls).each(function(k,v){ 
    		$(this).hide();
    		$(this).trigger('change');
    	});
    }


   
   	Hshow.prototype.toggleChilds = function(){ 

   		var cls = '.child_'+this.options.id;

   		$(cls).each(function(k,v){


   			if( $(this).is(':visible') ){
   				$(this).hide();
   			}else{
   				$(this).show();
   			}

   			$(this).trigger('change');
   		});



   	}

    Hshow.DEFAULTS = {


	}


	function Plugin(option) {
        return this.each(function ( index ) {
          var $this   = $(this);
          var data    = $this.data('wp.hshow');

          var options = $.extend({}, Hshow.DEFAULTS, $this.data(), typeof option == 'object' && option);
          

          if (!data){ 
           
            $this.data('wp.hshow', (data = new Hshow(this, options)) );
        	console.log('listo')
          }else{
            console.log("ya existe");
          }

          
        });
    }

    $.fn.hshow = Plugin ;
    $.fn.hshow.Constructor = Hshow;


    $(document).ready(function(){

    	$('.hshow').hshow();
    });

})();