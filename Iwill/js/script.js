 $(document).ready(function() {
    $('#smartdemo').smart3d({
		invertHorizontal: true, 
		invertVertical: true
	});

     
	$(".case_body").hover(function(){
				$('.case_w',this).stop().animate({"bottom":"30px"},400);	
				
				$(".y",this).stop().css({'top':'20px'}).animate({'top':"63px"},400).show();
				$('.fire',this).show();
			},function(){
				$('.case_w',this).stop().animate({"bottom":"14px"},400);
				$('.fire, .y',this).hide();
			});	
     
      var $container = $('#container');

      $container.isotope({
        itemSelector : '.element'
      });
      
      
      var $optionSets = $('#options .option-set'),
          $optionLinks = $optionSets.find('a');

      $optionLinks.click(function(){
        var $this = $(this);
        // don't proceed if already selected
        if ( $this.hasClass('selected') ) {
          return false;
        }
        var $optionSet = $this.parents('.option-set');
        $optionSet.find('.selected').removeClass('selected');
        $this.addClass('selected');
  
        // make option object dynamically, i.e. { filter: '.my-filter-class' }
        var options = {},
            key = $optionSet.attr('data-option-key'),
            value = $this.attr('data-option-value');
        // parse 'false' as false boolean
        value = value === 'false' ? false : value;
        options[ key ] = value;
        if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
          // changes in layout modes need extra logic
          changeLayoutMode( $this, options )
        } else {
          // otherwise, apply new options
          $container.isotope( options );
        }
        
        return false;
      });
     
     
     
});
