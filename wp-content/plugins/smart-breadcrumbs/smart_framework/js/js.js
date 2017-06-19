jQuery.noConflict();

(function($) {
    $.verticalTabs = function(el, options) {
        // To avoid scope issues, use 'base' instead of 'this'
        // to reference this class from internal events and functions.
        var base = this;

        // Access to jQuery and DOM versions of element
        base.$el = jQuery(el);
        base.el = el;

        base.init = function() {
            base.options = $.extend({}, $.verticalTabs.defaultOptions, options);

            //Add tabs
            base.$el.tabs(base.options);
			
            //Make them vertical.
            base.$el.addClass('ui-tabs-vertical ui-helper-clearfix')
            .find("li").removeClass('ui-corner-top').addClass('ui-corner-left')
        };

        // Run initializer
        base.init();
    };

    $.verticalTabs.defaultOptions = {
    };

    $.fn.verticalTabs = function(options) {
        return this.each(function() {
            (new $.verticalTabs(this, options));
        });
    };

    $.bottomTabs = function(el, options) {
        // To avoid scope issues, use 'base' instead of 'this'
        // to reference this class from internal events and functions.
        var base = this;

        // Access to jQuery and DOM versions of element
        base.$el = jQuery(el);
        base.el = el;


        base.init = function() {
            base.options = $.extend({}, $.bottomTabs.defaultOptions, options);

            base.$el.tabs();

            base.$el.addClass("ui-tabs-bottom")
            .find(".ui-tabs-nav").add($(".ui-tabs-nav > *", base.$el))
            .removeClass("ui-corner-all ui-corner-top")
            .addClass("ui-corner-bottom");
        };

        // Run initializer
        base.init();
    };

    $.bottomTabs.defaultOptions = {
    };

    $.fn.bottomTabs = function(options) {
        return this.each(function() {
            (new $.bottomTabs(this, options));
        });
    };

})(jQuery);


var tabContentWidth = function(){
    if(jQuery("#verticalTabs")){
        var parentWidth = jQuery("#verticalTabs").width() + 210 /* padding-left */;
        var newWidth = parentWidth- 55 /* padding left and right of box */;
        var percentWidth = (newWidth * 100) / parentWidth;
        //jQuery("div.smartPanel").width(jQuery('#wpbody-content').width() - 20);
        jQuery(".et-tabs-content").css({
            width: parseInt(percentWidth) + "%"
        });
    }
}


function duplicate_slider_cat()
{	
    var $dropdown_wrap = jQuery('.multiple_box');
	
    $dropdown_wrap.each(function()
    {			
        var $dropdown = jQuery(this).find('.multiply_me');
        var $current_dropdown_wrapper = jQuery(this);
		
        $dropdown.each(function(i)
        {
            $name = jQuery(this).attr('name').replace(/\d+$/,"");
            jQuery(this).attr('id', $name + i);
            jQuery(this).attr('name', $name + i);
            jQuery('.'+$name+'hidden').attr('value', $dropdown.length);
			 
            jQuery(this).unbind('change').bind('change',function()
            { 	
                if(jQuery(this).val() && $dropdown.length == i+1)
                {
                    jQuery(this).clone().appendTo($current_dropdown_wrapper);
                    duplicate_slider_cat();
                }
                else if(!(jQuery(this).val() && jQuery(this).val()!='0') && !($dropdown.length == i+1))
                { 
                    jQuery(this).remove();
                    duplicate_slider_cat();
                }
			
            });
        });
    });
}


function copy_table()
{
    var $multitable_wrap = jQuery('.multitables');
	
    $multitable_wrap.each(function()
    {
        var $add_next = jQuery(this).find('.add_table');
        var $del_this = jQuery(this).find('.del_table');
        var $count = jQuery(this).find('.super_matrix_count');
        var $current_table = jQuery(this);
		
		
        $add_next.unbind('click').bind('click',function()
        {
            $count.val(parseInt($count.val())+1);
            $current_number = $count.val();
            $newclone = jQuery('.clone_me').clone().insertBefore(jQuery('.clone_me'));
            $newclone.removeClass('hidden').removeClass('clone_me');
			
            _helper_correct_numbers($current_table)
            duplicate_slider_cat();
            copy_table();
			
            return false;
        });
			
        $del_this.bind('click',function()
        {
            $count.val(parseInt($count.val())-1);
            jQuery(this).parents('.multitable').remove();
            _helper_correct_numbers($current_table);
            return false;
        });
    });
	
}

function _helper_correct_numbers($current_table)
{
    $current_table.find('.multitable').each(function(i){
        var $current_sub_table = jQuery(this);
        $current_sub_table.find('.changenumber').html(i+1);
        $current_sub_table.find('select').each(function(){
            var $multiply_me = '';
            var $newname = jQuery(this).attr('name').replace(/\d+/,i);
            if (jQuery(this).hasClass('multiply_me')) $multiply_me = 'multiply_me';
            jQuery(this).attr({
                'name': $newname,
                'id': $newname, 
                'class': $newname + " " + $multiply_me
            });
        });
			
        var $newname = $current_sub_table.find('.multiple_box>input[type=hidden]').attr('name').replace(/\d+/,i);
        $current_sub_table.find('.multiple_box>input[type=hidden]').attr({
            'name': $newname,
            'id': $newname, 
            'class': $newname
        });
		
    });
}
jQuery(function(){		
    adminW = jQuery("body.wp-admin").width();
    descW = adminW - 990;
    checdescW = adminW - 820;
    jQuery("#post-body .desc").attr("style","width: "+descW+"px !important");
    jQuery("#post-body .option-checkbox .desc").attr("style","width: "+checdescW+"px !important");
});

this.tooltip = function(){
    xOffset = 14;
    yOffset = -340;
        
    jQuery("a.tooltip").hover(function(e){
        this.t = this.title;
        this.title = "";

        jQuery("body").append("<p id='tooltip'>"+ this.t +"</p>");
        jQuery("#tooltip")
        .css("top",(e.pageY - xOffset) + "px")
        .css("left",(e.pageX + yOffset) + "px")
        .fadeIn("fast");
    },
    function(){
        this.title = this.t;
        jQuery("#tooltip").remove();
    });
    jQuery("a.tooltip").mousemove(function(e){
        jQuery("#tooltip")
        .css("top",(e.pageY - xOffset) + "px")
        .css("left",(e.pageX + yOffset) + "px");
    });
};

var smartBreadcrumbsAjaxSave = function(){
 
    jQuery("form#smartBreadcrumbs").submit(function() {
        var form = jQuery(this);
       
        /*form.find('.submit-footer').fadeOut(200, function(){
            jQuery("#smartAjaxSave").css('display', 'block');
        });*/
        
        // fake checkbox send too
        var fakeFlaseCheckbox = "";
        jQuery('input[type=checkbox]:not(:checked)').map(function(){  
            fakeFlaseCheckbox  += "&" + jQuery(this).attr('id') + "=false";
        }).get();

        //var params = [];
        var params = form.serialize();
       
        // ajax request
        jQuery.post(smartBreadcrumbsURI + '/smart_framework/admin/ajaxsave.php', 
        params + fakeFlaseCheckbox
        , function(data) {
            if(data == 'OK') {
                form.find('.submit-footer').css('display', 'block');
                jQuery("#smartAjaxSave").css('display', 'none');
                jQuery("#messageStats p").html('Options has been updated!');
                jQuery("#messageStats").attr('class', '').addClass('updated').fadeIn(250);
                
                var closeOk = setTimeout(function() {
                    jQuery("#messageStats").fadeOut(250)
                }, 1500);
                
                jQuery("#messageStats").click(function() {
                    jQuery("#messageStats").fadeOut(250)
                });
            }else {
                jQuery("#messageStats p").html(data);
                jQuery("#messageStats").attr('class', '').addClass('error').fadeIn(250);
            }
        }, 'html');
        
        return false;
    });

    
}

jQuery(document).ready(function(){
    duplicate_slider_cat();
    copy_table();
    tooltip();
    smartBreadcrumbsAjaxSave();
    
    jQuery('.forminp textarea').focus(function() {
        jQuery(this).css("background-color", "#ffffff")
    });
    
    // init content width
    tabContentWidth();
    jQuery("#verticalTabs").verticalTabs().show();
});

jQuery(window).resize(function() {
    // reinit content width
    tabContentWidth();
});