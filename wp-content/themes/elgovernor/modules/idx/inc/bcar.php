<?php

/**
 * Created by PhpStorm.
 * User: Bryan
 * Date: 4/21/2017
 * Time: 9:15 AM
 */
class bcar_idx {

	public $request;
	public $response;
	public $debug = false;

	//DB INFO
	private $host = "104.218.13.63";
	private $database = "kmaserv_mls_bcar";
	private $dbuser = "kmaserv_mls";
	private $pass = "6L!J@uRwGR!A";

	//VARS
	public $variables;
	public $fieldTranslation;
	public $areaArray;
	public $bedArray;
	public $bathArray;
	public $keyword;

	public function __construct() {

		try {
			$this->db = new wpdb($this->dbuser, $this->pass, $this->database, $this->host);
			$this->db->show_errors(); // Debug
		} catch (Exception $e) {    // Database Error
			echo $e->getMessage();
		}

		$this->set_var('fieldTranslation', array(
				'id'                => 'id',
				'ACREAGE'           => 'LIST_57',
				'AREA'              => 'LIST_29',
				'BATHS'             => 'LIST_67',
				'BATHS_FULL'        => 'LIST_68',
				'BATHS_HALF'        => 'LIST_69',
				'BEDROOMS'          => 'LIST_66',
				'CITY'              => 'LIST_39',
				'CO_LA_CODE'        => 'colisting_member_shortid',
				'CO_LO_CODE'        => 'colisting_office_shortid',
				'DATE_MODIFIED'     => 'LIST_87',
				'DIRECTIONS'        => 'LIST_82',
				'FTR_CONSTRC'       => 'GF20150204172056790876000000',
				'FTR_ENERGY'        => 'GF20150204172056617468000000',
				'FTR_EXTERIOR'      => 'GF20150204172056829043000000',
				'FTR_HOAINCL'       => 'LIST_151', //
				'MLS_APPROVED'      => 'LIST_4',
				'LA_CODE'           => 'listing_member_shortid',
				'LIST_DATE'         => 'LIST_10',
				'LIST_PRICE'        => 'LIST_22',
				'LOT_DIMENSIONS'    => 'LIST_56',
				'LO_CODE'           => 'listing_office_shortid',
				'MLS_ACCT'          => 'LIST_3',
				'LISTING_ID'        => 'LIST_105',
				'PARKING_FEATURES'  => 'GF20150204172057070880000000',
				'PARKING_SPACES'    => 'LIST_117',
				'PROP_TYPE'         => 'LIST_9',
				'REMARKS'           => 'LIST_78',
				'SA_CODE'           => 'LIST_62',
				'SO_NAME'           => 'LIST_61',
				'STATE'             => 'LIST_40',
				'STATUS'            => 'LIST_15',
				'STORIES'           => 'LIST_64',
				'STREET_NAME'       => 'LIST_34',
				'STREET_NUM'        => 'LIST_31',
				'SUBDIVISION'       => 'LIST_77',
				'SUB_AREA'          => 'LIST_94',
				'TOT_HEAT_SQFT'     => 'LIST_48',
				'UNIT_NUM'          => 'LIST_35',
				'WF_FEET'           => 'FEAT20150330173553939484000000',
				'YEAR_BUILT'        => 'LIST_53',
				'ZIP'               => 'LIST_43',
				'CLASS'             => 'CLASS',
				'listing_type'      => 'LIST_8',
				'NUM_UNITS'         => 'LIST_52',
				'LAT'               => 'LIST_46',
				'LNG'               => 'LIST_47',
			)
		);

		$this->set_var('areaArray', array(
				'Central Bay County'        => '02 Bay County - Central',
				'East Bay County'           => '05 Bay County - East',
				'Bay County Beaches'        => '03 Bay County - Beaches',
				'Washington County'         => '10 Washington County'
			)
		);

		$this->set_var('typeArray', array(
				'Condominium'           => 'Condos & Twonhomes',
				'Single Family Homes'           => 'Single Family Home'
			)
		);

		$this->set_var('priceArray', array(
				'100000'       => '$100,000',
				'200000'       => '$200,000',
				'300000'       => '$300,000',
				'400000'       => '$400,000',
				'500000'       => '$500,000',
				'600000'       => '$600,000',
				'700000'       => '$700,000',
				'800000'       => '$800,000',
				'900000'       => '$900,000',
				'1000000'      => '$1,000,000',
				'2000000'      => '$2,000,000',
				'3000000'      => '$3,000,000'
			)
		);

		$this->set_var('bedArray', array(
				''              => 'Any',
				'1'             => '1+',
				'2'             => '2+',
				'3'             => '3+',
				'4'             => '4+',
				'5'             => '5+'
			)
		);

		$this->set_var('bathArray', array(
				''              => 'Any',
				'1'             => '1+',
				'2'             => '2+',
				'3'             => '3+',
				'4'             => '4+',
				'5'             => '5+'
			)
		);

        wp_enqueue_script( 'lazy-js' );
        wp_enqueue_script('select2-js');
        wp_enqueue_style('select2-styles');
        add_action( 'wp_footer', 'idx_script_to_footer',100 );
        wp_enqueue_script( 'idx-ajax' );

	}

	function set_var($var = 'request',$new_val) {
		$this->{$var} = $new_val;
	}

	function get_var($var = 'response') {
		return $this->{$var};
	}

	// Get MLS Results
	public function num_search_mls($query) {
		$result = $this->db->get_var($query);
		return $result;
	}

	public function search_mls($query) {
		$result = $this->db->get_results($query, 'ARRAY_A');
		return $result;
	}

	public function getVars(){

		foreach($this->fieldTranslation as $key => $var ){
			$this->variables[$key] = (isset($_GET[$key]) ? $_GET[$key] : '');
		}
		$this->keyword = (isset($_GET['keyword']) ? $_GET['keyword'] : '');
		return $this->variables;

	}

	public function translateRow($row){

		$newRow = array();
		foreach($this->fieldTranslation as $key => $var ){
			$newRow[$key] = $row[$var];
		}
		return $newRow;

	}

	public function untranslateRow($row){

		$newRow = array();
		foreach($this->fieldTranslation as $key => $var ){
			$newRow[$var] = $row[$key];
		}
		return $newRow;

	}

	public function translateSingle($value){
		return $this->fieldTranslation[$value];
	}

	public function untranslateSingle($value){
		return array_search($this->fieldTranslation[$value]);
	}

	public function getMedia($mlsnum,$type,$limit = ''){

		$query = "SELECT * FROM media WHERE MEDIA_TYPE='".$type."' AND MLS_ACCT='".$mlsnum."' ";
		if($type == 'Virtual Tour'){
			$query .= "ORDER BY object_id DESC LIMIT 1";
		}else{
			$query .= "ORDER BY preferred DESC, object_id ASC ";
			if($limit!=''){
				$query .= "LIMIT ".$limit;
			}
		}

		$mediaquery = $this->db->get_results($query, 'ARRAY_A');
		$mediagroup = array();

		foreach($mediaquery as $mediaresult){
			array_push($mediagroup,$mediaresult);
		}

		return $mediagroup;

	}

	public function getValues($field){
		return $this->search_mls("SELECT DISTINCT ".$field." from listings");
	}

}

add_action('wp_ajax_loadIdx', 'loadIdx');
add_action('wp_ajax_nopriv_loadIdx', 'loadIdx');
function loadIdx(){

    //if(isset($_SESSION['areaInputArray'])){

        //$result = $_SESSION['areaInputArray'];

    //}else {

        $mls = new bcar_idx();
        //foreach ($mls->areaArray as $areaname => $value) {

//            if (is_array($mls->variables['AREA'])) {
//                if (in_array($areaname, $mls->variables['AREA'])) {
//                    $result .= '{ id: \'' . $areaname . '\', text: \'' . $areaname . '\', elment: HTMLOptionElement, class: \'selected\' },';
//                    $result .= '{ id: \'' . $areaname . '\', text: \'\', element: HTMLOptGroupElement, class: \'selected\'';
//                } else {
//                    $result .= '{ id: \'' . $areaname . '\', text: \'' . $areaname . '\', elment: HTMLOptionElement, class: \'notselected\' },';
//                    $result .= '{ id: \'' . $areaname . '\', text: \'\', element: HTMLOptGroupElement, class: \'notselected\'';
//                }
//            } else {
//                $result .= '{ id: \'' . $areaname . '\', text: \'' . $areaname . '\', elment: HTMLOptionElement, class: \'notselected\' },';
//                $result .= '{ id: \'' . $areaname . '\', text: \'\', element: HTMLOptGroupElement, class: \'notselected\'';
//            }
//            if (is_array($value)) {
//
//                $result .= ', children: [ ';
//                foreach ($value as $subareaname) {
//                    if (is_array($mls->variables['AREA'])) {
//                        if (in_array($subareaname, $mls->variables['AREA'])) {
//                            $result .= '{ id: \'' . $subareaname . '\', text: \'' . $subareaname . '\', element: HTMLOptionElement, class: \'selected\' },';
//                        } else {
//                            $result .= '{ id: \'' . $subareaname . '\', text: \'' . $subareaname . '\', element: HTMLOptionElement, class: \'notselected\' },';
//                        }
//                    } else {
//                        $result .= '{ id: \'' . $subareaname . '\', text: \'' . $subareaname . '\', element: HTMLOptionElement, class: \'notselected\' },';
//                    }
//                }
//                $result .= ' ] },';
//
//            } else {
//                $result .= ' },';
//            }

        //}
	$result = array();

    $result[] = array(
        'id'        => 'AREAS',
        'text'      => 'AREAS',
        'class'     => 'parent',
        'children'  => array()
    );

    foreach ($mls->areaArray as $areaname => $value) {
        $result[] = array(
            'id'        => $areaname,
            'text'      => $areaname,
            'element'   => 'HTMLOptionElement',
            'class'     => 'option',
        );
    }

    $_SESSION['areaInputArray'] = json_encode($result);
    $result = json_encode($result);


    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        echo $result;
    }

    wp_die();

}
