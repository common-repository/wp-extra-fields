<?php

if ( !function_exists( 'add_action' ) )
   {
		header( 'HTTP/0.9 403 Forbidden' );
		header( 'HTTP/1.0 403 Forbidden' );
		header( 'HTTP/1.1 403 Forbidden' );
		header( 'Status: 403 Forbidden' );
		header( 'Connection: Close' );
		exit();
	}

global $pagenow;

function pmf_dashboard_init() {
  $plugin_dir = basename(dirname(__FILE__));
  load_plugin_textdomain( 'wp-extra-fields', null, $plugin_dir.'/languages/' );
}
function pmf_option_init(){

}

add_action('plugins_loaded', 'pmf_dashboard_init');
add_action("admin_menu",'wp_cpf_dashboard_menu', 10, 2); 
add_action("init","pmf_option_init");


if(isset($_POST['add_field']) && $_POST['add_field'] != ""){
    $post_type = $_REQUEST['pmf___post_type'];
  unset($_POST['add_field']);
  $pmf_option_post = get_option("pmf_options_$post_type");
  $pmf_option_post[] = $_POST["pmf_post_meta"];
  update_option("pmf_options_$post_type", $pmf_option_post); 
  echo pmf_update_message("Updated: New Field added Successfully: $post_type : $pmf___post_type");
}

if(isset($_REQUEST['remove_field']) && $_REQUEST['remove_field'] != ""){
  $post_type = $_REQUEST['pmf___post_type'];
  //if($pmf___post_type == $post_type){
     $val = $_REQUEST['remove_field'];
     $pmf_option_post = get_option("pmf_options_$post_type");
     unset($pmf_option_post[$val]);
     update_option("pmf_options_$post_type", $pmf_option_post); 
     echo pmf_update_message("Updated: Field removed Successfully: $post_type " . $_REQUEST['pmf___post_type']);
  //}
}

if(isset($_REQUEST['move_down']) && $_REQUEST['move_down'] != ""){
    $post_type = $_REQUEST['pmf___post_type'];
  //if($pmf___post_type == $post_type){
  $val = (int)$_REQUEST['move_down'];
  if($val < 1){$val = 0;}
    $pmf_option_post = get_option("pmf_options_$post_type");
    $pmf_option_post_copy = $pmf_option_post;
    $temp_0 = $pmf_option_post_copy[$val];
    $temp_1 = $pmf_option_post_copy[$val + 1];
    $pmf_option_post[$val + 1] = $temp_0;
    $pmf_option_post[$val] = $temp_1;
    update_option("pmf_options_$post_type", $pmf_option_post); 
    echo pmf_update_message("Updated: Field moved down Successfully: $post_type");
  //}
}

if(isset($_REQUEST['move_up']) && $_REQUEST['move_up'] != ""){
    $post_type = $_REQUEST['pmf___post_type'];
  //if($pmf___post_type == $post_type){
  $val = (int)$_REQUEST['move_up'];
  $pmf_option_post = get_option("pmf_options_$post_type");

  $pmf_option_post = get_option("pmf_options_$post_type");

                 $pmf_option_post_copy = $pmf_option_post;

                 $temp_0 = $pmf_option_post_copy[$val];
                 $temp_1 = $pmf_option_post_copy[$val - 1];
                 
                 $pmf_option_post[$val - 1] = $temp_0;
                 $pmf_option_post[$val] = $temp_1;

  update_option("pmf_options_$post_type", $pmf_option_post); 
  echo pmf_update_message("Updated: Field Moved up Successfully: $post_type");
 // }
}





function pmf_update_message($message="Updated"){ 
  $echo =  "<div id='message' class='updated'><p>$message</p></div>";
  return $echo;
}

function pmf_error_message($message="Error"){ 
  $echo =  "<div id='message' class='error'><p>$message</p></div>";
  return $echo;
}

function wp_cpf_dashboard_menu()
{
   add_menu_page('wp-extra-fields', 
                 'WP Extra Fields',
                 10, 
                 'wp-extra-fields/wp-extra-fields.php', 
                 'wp_cpf_dashboard', 
                 '',8);
}


function wp_cpf_dashboard(){  

 $post_types = get_post_types( '', 'names' ); 
 unset($post_types['revision']);
 unset($post_types['nav_menu_item']);
 unset($post_types['attachment']);

// foreach ( $post_types as $post_type ) {
//   if(in_array($array_pt, $post_type)){
//      unset($post_types["$post_type"]);
//   }
// }

  ?>
    <div class="wrap">
      <?php screen_icon(); ?><div id="icon-tools" class="icon32"></div>    
      <h2><?php _e("WP EXTRA FIELDS"); ?></h2>
      <?php //print_r($wpfuploads); ?>
      <style>
          td p {color:#999;}
      </style>
      <div id="poststuff">
        <div id="post-body">

<div class="postbox">
               <h3><label for="title">Quick Start Guide</label></h3>
               <div class="inside"  style="overflow-y:hidden">
               <ol>
                <li>Add new or existing postmeta fields by checking the checkbox of the ones you want under Postmeta manager. Postmeta fields are automatically detected and listed by default.</li>
                <li>WP Extra Field also detects all custom post types on your system. Add new fields by using the dropdown and the Add Postmeta button</li>
                <li>Finally go to your post type edit or add page and see your WP Extra Fields below the description. When you save a post the post type assigned to the post will be saved too</li>
                <li>For dropdown values make sure you use comma (,)in the default value field i.e Apple,Bananna,Pineapple</li>
               </ol>



 <p>Please <a href="http://wordpress.org/support/view/plugin-reviews/wp-extra-fields?rate=5#postform" target=_blank >rate</a> this plugin.&nbsp;&nbsp;
     Helps if you follow my sponsors: 
     &nbsp;&nbsp;<a href="https://twitter.com/sprintexperts1" class="twitter-follow-button" data-show-count="false" data-lang="en" data-size="small">Follow @sprintexperts1</a>
     &nbsp;&nbsp;You can follow me :
     
<a href="https://twitter.com/olaapata" class="twitter-follow-button" data-show-count="false" data-lang="en" data-size="medium">Follow @olaapata</a>
     </p>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>








               </div>
          </div>


          <div class="postbox">
               <h3><label for="title">Postmeta Manager</label></h3>
               <div class="inside"  style="height:300px;overflow-x:scroll !important; overflow-y:none !important;">
               <?php wp_cpf_meta_form_table(); ?>
               </div>
          </div>

          <?php 

            foreach ( $post_types as $post_type ) {
              $status = "Enable";            
            ?>
          <div class="postbox" style="width:48% !important;float:left; margin:10px">
            <div style="overflow:hidden;">
               <h3 style="float:left !important">
                <label for="title">Post Meta Design : <?php echo $post_type ?></label>
               </h3>
               <h3 style="float:right !important">
                Displays on <?php echo $post_type ?>;
               </h3>
             </div>
               <div class="inside">
               <?php echo pmf_meta_dropdown($post_type); ?>
               </div>
          </div>
          <?php }?>


        </div>
      </div>
    </div>
<?php   } 


  






function pmf_meta_dropdown( $post_type) {  
   $data = pmf_post_meta_display($post_type);
   return $data;
}

//and $_REQUEST['opps'] == "1"
if($pagenow =='post.php' or $pagenow =='post-new.php'){
    global $post, $post_type;  
    add_action("add_meta_boxes","pmf_add_meta_box",$post_type);
    add_action('admin_menu','pmf_remove_default_page_screen_metaboxes');
  }

//remove default post meta form
function pmf_remove_default_page_screen_metaboxes() {
  remove_meta_box('postcustom','post','normal');
}


function pmf_add_meta_box($post_type){
  $pmf_option_post = get_option("pmf_options_$post_type");
  if(count($pmf_option_post) > 0){
     add_meta_box( 'pmf_opps_field',  Ucfirst($post_type) . " Custom Fields",  'pmf_front_display', $post_type, 'normal','high' );
  }
}

function pmf_front_display($post){
  global $wp,$wp_query, $wpdb;
  $post_type = $post->post_type;
  //$post_type = $wp->query_vars['post_type'];
  wp_nonce_field( 'pmf_post_meta_display', 'pmf_post_meta_display_nonce' );
  //wp_nonce_field( 'pmf_front_display', 'pmf_nonce' );

  global $wpdb, $wp_query, $user_ID, $post, $pmf_nonce;
  
  $pmf_option_post = get_option("pmf_options_$post_type");
  $pmf_option = get_option('pmf_options'); 

  foreach($pmf_option_post as $key=>$value){   
      $vaf = "pmf_type_" . $value;
      $pre_label = "pmf_label_" . $value;
      $pre_default = "pmf_default_" . $value;
      $pre_dval = "pmf_dval_" . $value;

      $label = $pmf_option[$pre_label];
      $type =  $pmf_option[$vaf];
      $default = $pmf_option[$pre_default];
      $validation = $pmf_option[$pre_val];

      //execute 

      echo pmf_build_input($type, $value, "", $default, "100", $label, $validation);
      

      
  }
  echo "<div style='Overflow:hidden'>";
  echo '<input style="float:right; margin-top:20px" name="save" type="submit" class="button button-primary button-large" id="publish" accesskey="p" value="Update">
        </div>';
}



function pmf_save_postdata($post_id) {

  global $wpdb, $pmf_nonce, $post;
  // // Check if our nonce is set.
   if ( ! isset( $_POST['pmf_post_meta_display_nonce'] ) )
     return $post_id;

   $nonce = $_POST['pmf_post_meta_display_nonce'];

   //Verify that the nonce is valid.
   if ( ! wp_verify_nonce( $nonce, 'pmf_post_meta_display' ) )
       return $post_id;

  // If this is an autosave, our form has not been submitted, so we don't want to do anything.
   if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
       return $post_id;

  // // Check the user's permissions.
   if ( 'page' == $_POST['post_type'] ) {

     if ( ! current_user_can( 'edit_page', $post_id ) )
         return $post_id;
  
   } else {

     if ( ! current_user_can( 'edit_post', $post_id ) )
         return $post_id;
   }

  if(!is_object($post) || !isset($post->post_type)) {
    return $post_id;
  } 

  $array_post = array();
  $array_post = $_POST;

  $pmf_option_post = get_option("pmf_options_{$post->post_type}");
  
  foreach($array_post as $key=>$value){

    if(in_array($key, $pmf_option_post)){
    
       if(get_post_meta( $post_id, $key, false ) != ""){

          update_post_meta( $post_id, $key, $value );
        }
    }

  }

  //print_r($_POST);

}
add_action( 'save_post', 'pmf_save_postdata');







function pmf_post_meta_display($post_type){

  $pmf_option_post = get_option("pmf_options_$post_type");

   $preStr = "pmf_active_";
   $pmf_option = get_option('pmf_options'); 
   
   $dd  = "<form method='POST' style='margin:10px;padding:5px;margin:5px'>";
   $dd  .= "<input type='hidden' value='$post_type' name='pmf___post_type' id='pmf___post_type'>";

   $dd  .= "<select name='pmf_post_meta' id='pmf_post_meta'>";
   $dd .= "<option value=''  >&mdash; Select &mdash;</option>";
   
  foreach($pmf_option as $key=>$value){
    $pos = strpos($key, $preStr);

    
    if ($pos !== false) {
       $thefield = str_replace($preStr, "", $key);
       if(in_array($thefield, $pmf_option_post)){}else{
       $dd .= "<option value='$thefield'>$thefield</option>";
       }
    }

  }
   $pp = $post_type ."_active";

   $dd .= "</select>&nbsp;&nbsp;<input name='add_field' type='submit' class='button button-primary button-large' id='add_field' accesskey='p' value='Add Postmeta Field'>";

   $dd .= "</form>";
   
   $dd .= "<hr /><ul style='display:block;'>";
   $pmf_all = count($pmf_option_post);
   foreach($pmf_option_post as $key=>$value){
    $vaf = "pmf_type_" . $value;
       $dd .= "<li style='height;25px;line-height:25px;border:1px dotted #eee;margin:3px;padding:3px;clear:both;overflow:hidden'>
                    <span style=float:left;width:200px>$value</span>
                    <span style=float:left;margin-left:20px>" . $pmf_option[$vaf] ."</span>
                    <span style=float:right>
                    ";

                    if($key != 0){
                      $dd .= "<a href='admin.php?page=wp-extra-fields/wp-extra-fields.php&move_up=$key&pmf___post_type=$post_type'>Up</a>";
                    }
                    if($key != $pmf_all-1){
                    $dd .= "&nbsp;|&nbsp;<a href='admin.php?page=wp-extra-fields/wp-extra-fields.php&move_down=$key&pmf___post_type=$post_type'>Down</a>";
                    }

                    $dd .= "&nbsp;|&nbsp;<a href='admin.php?page=wp-extra-fields/wp-extra-fields.php&remove_field=$key&pmf___post_type=$post_type'>Remove</a>

                    </span>
              </li>";
    }
   $dd .= "</ul>";

   return $dd;
}

function wp_cpf_meta_form_table( $post = null ) {
  global $wpdb;
  $post = get_post( $post );

  $post_type = $_REQUEST['post_type'];

if(isset($_REQUEST['remove_added_pmf']) && $_REQUEST['remove_added_pmf'] != ""){

  $remove_added_pmf = $_REQUEST['remove_added_pmf'];
  $execute = $wpdb->query($wpdb->prepare( "
                DELETE FROM $wpdb->postmeta 
                  WHERE 
                meta_key = %s", $remove_added_pmf 
            ));

  if ( !is_wp_error( $execute ) ) {

   $post_types = get_post_types( '', 'names' ); 
   unset($post_types['revision']);
   unset($post_types['nav_menu_item']);
   //unset($post_types['page']);
   unset($post_types['attachment']);       

    foreach ( $post_types as $post_type ) {
       $pmf_option_post = get_option("pmf_options_$post_type");
       unset($pmf_option_post[$remove_added_pmf]);
       update_option("pmf_options_$post_type", $pmf_option_post);
    }




       echo pmf_update_message("Updated: Deleted Custom $remove_added_pmf");

    }

    // $pmf_option_post = get_option('pmf_options_post');
    // unset($pmf_option_post[$val]);
    // delete_post_meta($val); 
    //echo pmf_update_message("Updated: Custom meta removed!");
  }

  if(isset($_POST) and $_POST['save'] != ""){
      unset($_POST['save']);
      unset($_POST['closing date']);
      update_option("pmf_options", $_POST); 
      echo pmf_update_message("Updated: Changes has been saved");
  }

  if(isset($_POST) and $_POST['addPostmeta'] != ""){

    $args = array('post_status' =>'publish', 'post_per_page' => 1);
    $myposts = get_posts( $args );

    $addPostmeta = strip_tags(trim(str_replace(" ", "_", $_POST['addPostmeta'])));
    $addPostmeta = "pmf__" . $addPostmeta;

    //check if postmeta already exist
    $s = "SELECT meta_key
          FROM $wpdb->postmeta 
          WHERE meta_key = '$addPostmeta' LIMIT 1";

    $total = count($wpdb->get_results($s));

    if($total > 0){
      echo pmf_error_message("Error: metakey already exist");
    }else{
      update_post_meta($myposts[0]->ID, $addPostmeta, "default"); 
      echo pmf_update_message("Updated: Added new custom post meta. see it highlighted below ");  
    }

    wp_reset_query();
  }


  $limit = (int) apply_filters( 'postmeta_form_limit', 5000 );
  $keys = $wpdb->get_col( "
    SELECT meta_key
    FROM $wpdb->postmeta
    GROUP BY meta_key
    HAVING meta_key NOT LIKE '\_%'
    ORDER BY meta_key
    LIMIT $limit" );
  if ( $keys )
    natcasesort($keys);


  



  $pmf_option = get_option('pmf_options'); 
  //print_r($pmf_option);

?>
<form style="padding:0;margin:20px 0; border-bottom:1px solid #ccc" method="POST">
  <table id="newmeta" border=0 cellpadding=5; cellspacing=0 style="border:0 solid #eee;width:99%">
    <tbody>
      <tr>
        <td>
          <div style="margin-right:10px;margin-bottom:10px;overflow:hidden;">
            <input style="float:left" name="addPostmeta" type="submit" class="button button-primary button-large" id="publish" accesskey="a" value="Add New Postmeta">
      &nbsp;<input value="" type="text" id="addPostmeta" name="addPostmeta" class="" maxlength="30" style="width:300px;border:1px solid #ccc;height:28px" />
          </div>
       </td>
     </tr>
    </tbody>
  </table>
</form>

<form style="padding:0;margin:0" method="POST">
  <table id="newmeta" border=0 cellpadding=5; cellspacing=0 style="border:1px solid #eee;width:99%">
<div style="margin-right:10px;margin-bottom:10px;overflow:hidden;">
  <label style="display:block;float:left;font-size:1.0em;font-weight:600">Existing Postmeta</label><input style="float:right" name="save" type="submit" class="button button-primary button-large" id="publish" accesskey="p" value="Update">
</div>



<tbody>
<thead>
<tr colspan=4 style="background:#eee;line-height:30px;height:30px;text-align:left">
<th class="left" style="width:1%"></th>
<th class="left" style="width:20%">Name</th>
<th class="left" style="width:12%">Type</th>
<th class="left" style="width:20%">Default Values</th>
<th class="left" style="width:20%">Label </th>
<!-- <th class="left" style="">Validation Type</th>  -->
<th class="left" style="width:5%"></th>
</tr>
</thead>

<?php if ( $keys ) { 

  foreach ( $keys as $key ) {
    if ( is_protected_meta( $key, 'post' ) || ! current_user_can( 'add_post_meta', $post->ID, $key ) )
      continue;
       $key = esc_attr($key);
       //reset variables
       $selectCB = "";
       $cpf_val = "";

       $selectTF = "";
       $selectTA = "";
       $selectDD = "";

       $selectNO = "";
       $selectEM = "";
       $selectEF = "";

       $checkedCB = "";
      
      if($pmf_option["pmf_active_$key"] != ""){
         $checkedCB = "checked=checked";
      }

      if($pmf_option["pmf_type_$key"] == "textfield"){
         $selectTF = "selected=selected";
      }
      if($pmf_option["pmf_type_$key"] == "textarea"){
         $selectTA = "selected=selected";
      }
      if($pmf_option["pmf_type_$key"] == "dropdown"){
         $selectDD = "selected=selected";
      }
      if($pmf_option["pmf_type_$key"] == "checkbox"){
         $selectCB = "selected=selected";
      }
      if($pmf_option["pmf_val_$key"] == "empty"){
         $selectEF = "selected=selected";
      }
      if($pmf_option["pmf_val_$key"] == "number"){
         $selectNO = "selected=selected";
      }
      if($pmf_option["pmf_val_$key"] == "email"){
         $selectEM = "selected=selected";
      }

      $pmf_val = str_replace("/", "", $pmf_option["pmf_default_$key"]);
      $pmf_label = str_replace("/", "", $pmf_option["pmf_label_$key"]);

      $pose = strpos($key, "pmf__");   
          

       echo "<tr colspan=5 " .(($c = !$c) ?  '' : 'style=background:#eee') . " >";
 
       echo "<td id='newmetaleft' class='left'>";
       // echo "<input type='hidden' name='pmf_name_$key' id='pmf_aname_$key' value='pmf_aname_$key' />";
       echo "<input type='checkbox' name='pmf_active_$key' id='pmf_active_$key' value='1' $checkedCB />";
       echo "</td>";


       echo "<td id='newmetaleft' class='left'>";
       echo $key;
       echo "</td>";

       echo "<td>
            <select name='pmf_type_$key' id='pmf_type_$key'>
            <option value=''>&mdash; Select &mdash;</option>
            <option value='textfield' $selectTF >Textfield</option>
            <option value='textarea'  $selectTA >Textarea</option>
            <option value='dropdown'  $selectDD >Dropdown</option>
            <option value='checkbox'  $selectCB >Checkbox</option>";
            echo "</select>
            </td>";

       echo "<td>
            <input type='text' id='pmf_default_$key' name='pmf_default_$key' value='$pmf_val' />
             </td>";

       echo "<td>
            <input type='text' id='pmf_label_$key' name='pmf_label_$key' value='$pmf_label' />
             </td>";
       /*
       echo "<td>
            <select name='pmf_val_$key' id='pmf_val_$key'>
            <option value=''>&mdash; Select &mdash;</option>
            <option value='empty' $selectEF >Empty Field</option>
            <option value='number'  $selectNO >Number Only</option>
            <option value='email'  $selectEM >Email Type</option>
            </select>
            </td>";*/
       echo "<td>";
       
            if ($pose !== false) { ?>

            <a href='admin.php?page=wp-extra-fields/wp-extra-fields.php&remove_added_pmf=<?php echo $key ?>' class='preview button'  id='remove_added_pmf' style='height:30px;line-height:30px'>X</a>
            
            <?php }
         echo "</td>";

       echo"</tr>";
  }

?>

  </tbody>





  </table>

     <div style="margin-right:10px; margin-bottom:5px;margin-top:10px;overflow:hidden;">
<input style="float:right" name="save" type="submit" class="button button-primary button-large" id="publish" accesskey="p" value="Update">
    </div>

</form>
<?php 
  }

}

function pmf_build_input($type, $name, $class = "", $default_value = "", $max_value = "", $title="Title here", $validation=""){
    global $post;
    $value = get_post_meta($post->ID, $name, true);
  
    $object = "
           <script>
             function toggle_CB(name){
               if ($('#'+ name + '_tmp').is(':checked')) {
                  $('#'+ name).val('1');
               }else {
                  $('#'+ name).val('');
               }
             }
             </script>

             ";
 

  if($type == "textfield"){   

    $object .= "<div style='font-size:12px;width:99%;line-height:35px;overflow:hidden;border-bottom:1px dotted #999;margin-bottom:10px;color:#333'>";
    $object .= "<label style='float:left;width:40%'>$title</label>";
    $object .= "<span style='float:left;width:45%;display:block'>";
    $object .= '<input data-test="yes" value="'.$value.'" type="'.$type.'" id="'.$name.'" name="'.$name.'" class="'.$class.'" maxlength="'.$max_value.'" style="width:98%;border:1px solid #ccc" />';
    $object .= "</span>"; 
    $object .= "<div style='clear:both'></div>";   
    $object .= "</div>";
  }

    if($type == "textarea"){
    
    $object  = "<div style='font-size:12px;width:99%;line-height:25px;overflow:hidden;border-bottom:1px dotted #999;margin-bottom:10px'>";
    $object .= "<label style='float:left;width:40%'>$title</label>";
    $object .= "<span style='float:left;width:45%;display:block;overflow:hidden'>";
    $object .= "<textarea id='$name' name='$name' class='$class' style='width:98%;height:75px' >$value</textarea>";
    $object .= "</span>"; 
    $object .= "<div style='clear:both;height:1px;margin:0;padding:0'></div>";   
    $object .= "</div>";
  }

  if($type == "checkbox"){
      $cb_checked = "";
      if($value == ""){$cb_checked = "";}else{$cb_checked = "checked='checked'";}
      $name_tmp = $name . "_tmp";
    $object  .= "<div style='font-size:12px;width:99%;line-height:25px;overflow:hidden;border-bottom:1px dotted #999;margin-bottom:10px'>";
    $object .= "<label style='float:left;width:40%'>$title</label>";
    $object .= "<span style='float:left;width:45%;display:block;overflow:hidden'>";
    $object .= "<input value='1' type='$type' id='$name_tmp' name='$name_tmp' class='$class' $cb_checked onclick=toggle_CB('$name') />";
    $object .= '<input value="'.$value .'" type="hidden" id="'.$name.'" name="'.$name.'"  />';
    $object .= "</span>"; 
    $object .= "<div style='clear:both;height:1px;margin:0;padding:0'></div>";   
    $object .= "</div>";  
  }
  
  if($type == "dropdown"){
    
    $object  = "<div style='font-size:12px;width:99%;line-height:25px;overflow:hidden;border-bottom:1px dotted #999;margin-bottom:10px'>";
    $object .= "<label style='float:left;width:40%'>$title</label>";
    $object .= "<span style='float:left;width:45%;display:block;overflow:hidden'>";
    $object .= '<select id="'.$name.'" name="'.$name.'" class="'.$class.'" style="width:98%;border:1px solid #ccc" >';
    $split = explode(",", $default_value);
    $counter = count($split);
    $object .= '<option value="" class="'.$class.'">&mdash; Select &mdash;</option>';
    for($i=0;$i < $counter; $i++){
      $selected="";
      if($split[$i] == $value){$selected="selected='selected'";}
      $object .= '<option '.$selected.' value="'.$split[$i].'" class="'.$class.'">'.$split[$i].'</option>';
    }
    $object .= '</select>';
    $object .= "</span>"; 
    $object .= "<div style='clear:both;height:1px;margin:0;padding:0'></div>";   
    $object .= "</div>";

  }
  
  return $object;
}



function pmf_admin_enqueue($hook) {
    wp_register_style('wpx-main-css', plugins_url('wp-extra-fields/src/css/main.css'));
    wp_enqueue_style( 'wpx-main-css');
}
add_action( 'admin_enqueue_scripts', 'pmf_admin_enqueue' );

?>