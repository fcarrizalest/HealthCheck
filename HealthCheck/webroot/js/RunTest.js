(function(){

	var RunTest = function (element, options) { 
		this.$element    = $(element);
      	this.options     = options;
      	var self = this;
      	self.flag = true;

      	$(this.options.runtest).click(function(){
      		$('.alert').remove();
      		if( self.$element.is(':checked') ){
      			self.runTest();
      		}

      	});

      	this.$element.click(function(){

      		if(self.flag){
	      		if( $(this).is(':checked') ){

	      			$(this).parent().parent().find('ul').find('input[type=checkbox]').each(function(){

	      				if( $(this).is(':checked') ){

	      				}else{

	      					$(this).trigger('click');
	      				}
	      			});
	      		}else{
	      			$(this).parent().parent().find('ul').find('input[type=checkbox]').each(function(){

	      				if( $(this).is(':checked') ){
	      					$(this).trigger('click');
	      				}else{

	      					
	      				}
	      			});
	      		}
      		}else{
      			self.flag = true;
      		}
      	});

      	this.$element.parent().parent().find('ul').find('input[type=checkbox]').click(function(){

      		if( $(this).is(':checked') ){

      			if( self.$element.is(':checked') ){

      			}else{
      				self.flag = false;
      				self.$element.trigger('click');
      			}
      		}
      	});

	}


	RunTest.prototype.runTest = function(){ 
		var self = this;

		
		this.$element.parent().parent().find('ul').find('input[type=checkbox]').each(function(k,v){

			if( $(this).is(':checked') ){
				console.log('Run Test');
				console.log($(this).attr('id'));

				$.ajax({
		            type: 'GET',
		           
		            url: self.options.basePath+$(this).attr('id') ,
		            dataType: 'json',
		            success: function (data) { 

		            	if( data.success ){

		            		$.each(data.result,function(k,v){
		            			
		            			var alert = $('<div class="alert alert-'+v.type+'" role="alert"><h4 class="alert-heading">'+v.title+'</h4> '+v.message+'</div>');
		            			$(self.options.divresult).append(alert);
		            		});

		            	}
		            	
		            	
		            } 
		        });
			}

		});


	}

	RunTest.DEFAULTS = {
		runtest:'#runtest',
		divresult:'#result',
		basePath:'/health-check/home/run/'

	}

	function Plugin(option) {
        return this.each(function ( index ) {
        	var $this   = $(this);
        	var data    = $this.data('wp.runtest');
          	var options = $.extend({}, RunTest.DEFAULTS, $this.data(), typeof option == 'object' && option);
          
          	if (!data){ 
            	$this.data('wp.runtest', (data = new RunTest(this, options)) );
          	}
          
        });
    }

    $.fn.runtest = Plugin ;
    $.fn.runtest.Constructor = RunTest;

    $(document).ready(function(){

    	$('.parentCheck').runtest();
    });

})();