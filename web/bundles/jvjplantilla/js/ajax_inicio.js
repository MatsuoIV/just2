$('document').ready(function() {
    
    /******************
    Crud inicio
  ******************/  
    $('#cerrar_ventana').click(cerrarventana);
  
   
    $('body').prepend('<div id="overlay"><div id="modalcontainer"></div></div>');
  
 
    function init() {
    
        /*************
      Datepicker
    *************/
    
        $('.datepicker').datepicker();
        
  
        /************************
      Combined input fields
    ************************/
    
        $('div.combined p:last-child').addClass('last-child');
  
        /**********
      Sliders
    **********/
  
        $(".slider").each(function() {
            var options = $(this).metadata();
            $(this).slider(options, {
                animate: true
            });
        });
  
        $(".slider-vertical").each(function() {
            var options = $(this).metadata();
            $(this).slider(options, {
                animate: true
            });
        });
    
        /*******
      Tags
    *******/
    
        $('.taginput').tagsInput({
            'width':'auto'
        });
  
        /****************
      Progress bars
    ****************/
  
        $(".progressbar").each(function() {
            var options = $(this).metadata();
            $(this).progressbar(options);
        });
  
        /**********************
      Modal functionality
    **********************/
  
        $('a.modal').each(function() {
            var link = $(this);
            var id = link.attr('href');
            var target = $(id);
      
            if($("#modalcontainer " + id).length == 0) {
                $("#modalcontainer").append(target);
            }
      
            $("#main " + id).remove();
    
            link.click(function() {
                $('#modalcontainer > div').hide();
                target.show();
                $('#overlay').show();
      
                return false;
            });
        });
  
        $('.close').click(function() {
            $('#modalcontainer > div').hide();
            $('#overlay').hide();
    
            return false;
        });
    
  
  
        /********************
      Pretty checkboxes
    ********************/
  
        $('input[type=checkbox], input[type=radio]').each(function() {
            if($(this).siblings('label').length > 0) {
                $(this).prettyCheckboxes();
            }
        });
  
        /**********************
      Pretty select boxes
    **********************/
  
        $('select').chosen();
  
        /*********************
      Pretty file inputs
    *********************/

        $('input[type="file"]').customFileInput();
    
        /*******
      Tabs
    *******/
  
        // Hide all .tab-content divs
        $('.tab-content').livequery(function() {
            $(this).hide();
        });

        // Show all active tabs
        $('.box-header ul li.active a').livequery(function() {
            var target = $(this).attr('href');
            $(target).show();
        });
  
        // Add click eventhandler
        $('.box-header ul li').livequery(function() {
            $(this).click(function() {
                var item = $(this);
                var target = item.find('a').attr('href');
        
                if($(target).parent('form').length > 0) {
                    if($(target).parent('form').valid()) {
                        item.siblings().removeClass('active');
                        item.addClass('active');
    
                        item.parents('.box').find('.tab-content').hide();
                        $(target).show();
                    }
                } else {
                    item.siblings().removeClass('active');
                    item.addClass('active');
    
                    item.parents('.box').find('.tab-content').hide();
                    $(target).show(); 
                }
    
                return false;
            });
        });
    
        /***********
      Tooltips
    ***********/
    
        $('a[rel=tooltip]').tipsy({
            gravity: 'w'
        });
        $('a[rel=tooltip_e]').tipsy({
            gravity: 'e'
        });
        $('a[rel=tooltip_s]').tipsy({
            gravity: 's'
        });
        $('a[rel=tooltip_n]').tipsy({
            gravity: 'n'
        });
  
        /******************
      Form Validation
    ******************/
  
        $('form').validate({
            wrapper: 'span class="error"',
            meta: 'validate',
            highlight: function(element, errorClass, validClass) {
                if (element.type === 'radio') {
                    this.findByName(element.name).addClass(errorClass).removeClass(validClass);
                } else {
                    $(element).addClass(errorClass).removeClass(validClass);
                }
      
                // Show icon in parent element
                var error = $(element).parent().find('span.error');
      
                error.siblings('.icon').hide(0, function() {
                    error.show();
                });
            },
            unhighlight: function(element, errorClass, validClass) {
                if (element.type === 'radio') {
                    this.findByName(element.name).removeClass(errorClass).addClass(validClass);
                } else {
                    $(element).removeClass(errorClass).addClass(validClass);
                }
      
                // Hide icon in parent element
                $(element).parent().find('span.error').hide(0, function() {
                    $(element).parent().find('span.valid').fadeIn(200);
                });
            }
        });
    
        // Calendar icon fix
        $('form p _3E .error .error').livequery(function() {
            $(this).siblings('span.calendar').hide();
        });
  
        // Add valid icons to validatable fields
        $('form p > *').each(function() {
            var element = $(this);
      
            if(element.metadata().validate) {        
                element.parent().append('<span class="icon tick valid"></span>');
            }
        });
    }
  
    init();

});




function cerrarventana()
{
    $('#ventana_derecha').html('');
    $("#ventana_normal").removeClass('column-left');
}

function cerrarventanita()
{
    $('#ventana_derecha').html('');
    $("#ventana_normal").removeClass('column-left');
}