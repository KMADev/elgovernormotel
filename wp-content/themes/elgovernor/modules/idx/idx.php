<?php
/**
 * Created by PhpStorm.
 * User: Bryan
 * Date: 4/21/2017
 * Time: 9:03 AM
 */

class URIInfo {
	public $info;
	public $header;
	private $url;

	public function __construct($url) {
		$this->url = $url;
		$this->setData();
	}

	public function setData() {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $this->url);
		curl_setopt($curl, CURLOPT_FILETIME, true);
		curl_setopt($curl, CURLOPT_NOBODY, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HEADER, true);
		$this->header = curl_exec($curl);
		$this->info = curl_getinfo($curl);
		curl_close($curl);
	}

	public function getFiletime() {
		return $this->info['filetime'];
	}

	// Other functions can be added to retrieve other information.
}

/// CORE FUNCTIONS
function getMlsTemplateFile($file = '', $include = TRUE){

	if($file!=''){

		$activeTemplateDir = get_template_directory_uri().'/modules/idx/templates/';
		$templatefileRequested = $file.'.php';

		$relativeLink = wp_make_link_relative($activeTemplateDir.$templatefileRequested);

		if($include){
			include($relativeLink);
		}else{
			return file_get_contents($relativeLink);
		}

	}

}

function getSvg($file = ''){

	if($file!=''){

		$activeTemplateDir = get_template_directory_uri().'/modules/idx/assets/';
		$templatefileRequested = $file.'.svg';

		return $activeTemplateDir.$templatefileRequested;

	}

}

function idx_script_to_footer(){ ?>
	<script>
        function toggler(menuVar){
            $('#'+menuVar).toggle();
        }
        jQuery(function($) {
            $(document).ready(function () {
                $(".lazy").Lazy({
                    scrollDirection: 'vertical',
                    effect: 'fadeIn',
                    visibleOnly: true,
                    onError: function(element) {
                        console.log('image unavailable ' + element.data('src'));
                    }
                })
            })
        });
        <?php //file_get_contents(get_template_directory_uri().'/modules/idx/idx.js'); ?>
	</script>
<?php }

include ('inc/rafgc.php');
include ('inc/bcar.php');
include ('inc/ecar.php');

