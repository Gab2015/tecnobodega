<?php
add_action('admin_head', 'smartBreadcrumbs_ajaxuploader');
function smartBreadcrumbs_ajaxuploader() {
    global $post;
    global $smartBreadcrumbs;

    $theme_uri =  $smartBreadcrumbs->cfg('PLUGIN_URI') . '/';
?>
<script type="text/javascript">
var loadAjaxUpload = function() {
jQuery('.upload_button').each(function(){
        var clickedObject = jQuery(this);

        var clickedID = jQuery(this).attr('id');
        new AjaxUpload(clickedID, {
                  action: '<?php echo admin_url("admin-ajax.php"); ?>',
                  name: clickedID, // File upload name
                  data: { // Additional data to send
                                action: 'smart_ajax_post_action',
                                type: 'upload',
                                data: clickedID
                                <?php if(isset($post->ID)) { echo ", referer:" . $post->ID; } ?>
                                <?php if(basename($_SERVER['PHP_SELF'])) { echo ", page: '" . basename($_SERVER['PHP_SELF']) ."'"; } ?> },
                  autoSubmit: true, // Submit file after selection
                  responseType: 'json',
                  onChange: function(file, extension){},
                  onSubmit: function(file, extension){
                          if (! (extension && /^(jpg|png|jpeg|gif)$/i.test(extension))){
              // extension is not allowed
              alert('Error: invalid file extension');
              // cancel upload
              return false;
                } 
                                jQuery('#uploadtext_'+clickedID).text('Uploading'); // change button text, when user selects file	
                                this.disable(); // If you want to allow uploading only 1 file at time, you can disable upload button
                                interval = window.setInterval(function(){
                                        var text = jQuery('#uploadtext_'+clickedID).text();
                                        if (text.length < 13){	
                                                jQuery('#uploadtext_'+clickedID).text(text + '.'); 
                                        }
                                        else { 
                                                jQuery('#uploadtext_'+clickedID).text('Uploading'); 
                                        } 
                                }, 200); 
                  },
                  onComplete: function(file, response) {
                        window.clearInterval(interval);
                        jQuery('#uploadtext_'+clickedID).text('');	
                        this.enable(); // enable upload button

                        // If there was an error
                        if(response.error ){
                                var buildReturn = '<span class="upload-error">' + response.error + '</span>';
                                jQuery(".upload-error").remove();
                                clickedObject.parent().after(buildReturn);
                        }
                        else{ 
                                var isSlider = jQuery("#" + clickedID + "_type").val();
                                if(isSlider != 'upload') { 
                                        var buildReturn = '<img class="smartBreadcrumbsPreviewThumb" id="image_'+clickedID+'" src="<?php echo $theme_uri . '/thumb.php?src=' ?>'+response.url+'&w=120&h=60&zc=1" />';
                                        jQuery("#reset_" + clickedID).show();
                                        jQuery("#uploaded_image_" + clickedID).attr("href",response.url);
                                        jQuery("#uploaded_image_" + clickedID).html(buildReturn);
                                        jQuery("#image_" + clickedID).fadeIn();
                                        jQuery("#uploaded_image_" + clickedID).fadeIn();
                                        clickedObject.next('span').fadeIn();
                                }
                                clickedObject.parent().prev('input').val(response.url);
                                jQuery(".upload-error").remove();


                                if(isSlider == 'upload') 
                                {
                                        //multi file add
                                        // add file to the list

                                        var CounFiles = jQuery("." + clickedID + "_img_count").val();
                                        CounFiles++;
                                        jQuery("." + clickedID + "_img_count").val(CounFiles);

                                        var ImgDetails = '<input type="hidden" name="'+clickedID+'_sliderdata['+CounFiles+'][img]" value="'+response.url+'" />';
                                        ImgDetails += '<table class="added_image"><tr><td width="60px" valign="top">';
                                        ImgDetails += '<img src="<?php echo $theme_uri; ?>/thumb.php?src='+response.url+'&w=120&h=60&zc=1" target="_blank" alt="" />';
                                        ImgDetails += '</td><td valign="top">';
                                        ImgDetails += '<div>' + file + '</div>';

                                        for ( var i in response.fields.fields )
                                        { 
                                                var field = response.fields.fields[i]; 
                                                var field_id = field['id'];
                                                var field_std = field['std'];
                                                var field_desc = field['desc'];

                                                if(field['type'] == 'text') {
                                                        ImgDetails += '<div><input type="text" name="'+clickedID+'_sliderdata['+CounFiles+']['+field_id+']" value="' + field_std + '" class="slider_text slider_'+field_id+'" title="'+field_desc+'"  /></div>';  
                                                } else if (field['type'] == 'textarea') {
                                                        ImgDetails += '<div><textarea name="'+clickedID+'_sliderdata['+CounFiles+']['+field_id+']" class="slider_textarea slider_'+field_id+'" title="'+field_desc+'" >' + field_std + '</textarea></div>';  
                                                } else if (field['type'] == 'select') {
                                                        ImgDetails += '<div><select name="'+clickedID+'_sliderdata['+CounFiles+']['+field_id+']" class="slider_select slider_'+field_id+'" >';

                                                        for ( var key in field['options'] )
                                                        {
                                                                var selected = '';
                                                                if(key == field_std) selected = ' selected="selected"';
                                                                ImgDetails += '<option '+ selected +' value="' + key + '" >' + field["options"][key] + '</option>';
                                                        }
                                                        ImgDetails += '</select></div>';  
                                                }
                                        }

                                        ImgDetails += '</td></tr></table>';

                                        var FilesList = jQuery('#files_' + clickedID );
                                        jQuery('<li class="ui-state-default"></li>').prependTo(FilesList).html(ImgDetails);

                                    }

                            }		  	
                      }			  
            });		
    });


    jQuery('.reset_button').click(function(){
        var clickedObject = jQuery(this);
        var clickedID = jQuery(this).attr('id');
        var theID = jQuery(this).attr('title');				

        var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';

        var data = {
                action: 'smart_ajax_post_action',
                type: 'image_reset',
                data: theID
                <?php if(isset($post->ID)) { echo ",
                referer:" . $post->ID; } ?>
        };

        jQuery.post(ajax_url, data, function(response) {
                var image_to_remove = jQuery('#image_' + theID);
                var button_to_hide = jQuery('#reset_' + theID);
                image_to_remove.fadeOut(500,function(){ jQuery(this).remove(); });
                button_to_hide.fadeOut();
                clickedObject.parent().prev('input').val('');	
        });

        return false; 
    });
}

jQuery(document).ready(function(){
    loadAjaxUpload();
});
</script>
<?php
}
?>