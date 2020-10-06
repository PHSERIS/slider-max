<?php 

namespace Partners\SliderMax;

use \REDCap as REDCap;

/**
 * 
 */
class SliderMax extends \ExternalModules\AbstractExternalModule
{

	private $tag = '@SLIDERMAX';

    function redcap_survey_page_top($project_id)
    {
        $this->run($project_id);
    }

    function redcap_data_entry_form_top($project_id)
    {
        $this->run($project_id);
    }

    function run($project_id){
    	 $this->fields =  init_tags(__FILE__);
	     if (empty($this->fields) || !isset($this->fields[$this->tag])) {
	     	return;
	     }
         print "<script type=\"text/javascript\">";
	    foreach ($this->fields[$this->tag] as $item => $details) {
            $max = htmlentities(strip_tags(trim($details['params'])));
          if (strlen($details['params']) > 0 & ctype_digit($max) ) { // if we have parameters specified and are integers

                // Then add that to the slider
                print "
                    $(document).ready(function() {"
                    . "$(\"[id=slider-$item]\").slider({max: "
                    . intval($max)
                    . ", value: 0 }); \n"
                    . "$(\"[id=slider-$item]\").parents().find(\"a\").hide(); \n"
                    . "$(\"input[name=$item]\").val('0');"
                    . "});";
            }
	     } 	
         print "</script>";

    }



}