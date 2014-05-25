<?php
/**
* @version 			SEBLOD 3.x Core ~ $Id: index.php alexandrelapoux $
* @package			SEBLOD (App Builder & CCK) // SEBLOD nano (Form Builder)
* @url				http://www.seblod.com
* @editor			Octopoos - www.octopoos.com
* @copyright		Copyright (C) 2013 SEBLOD. All Rights Reserved.
* @license 			GNU General Public License version 2 or later; see _LICENSE.php
**/

defined( '_JEXEC' ) or die;

// -- Initialize
require_once dirname(__FILE__).'/config.php';
$cck	=	CCK_Rendering::getInstance( $this->template );
if ( $cck->initialize() === false ) { return; }

// Params init
$items_number					=	0;
$id 							= 	$cck->id;
$items							=	$cck->getItems();
$columns_debug	 				=	$cck->getStyleParam( 'debug', '0' );
$items_number_columns_main_1	=	0;
$top_display					=	$cck->getStyleParam( 'top_display', 'renderItem' );
if ( $top_display == 'renderItem' ) {
	$top_display_params			=	array();
} else {
	$top_display_params			=	array( 'field_name'=>$cck->getStyleParam( 'top_display_field_name', '' ), 'target'=>strtolower( substr( $top_display, strpos( $top_display, '_' ) + 1 ) ) );
	$top_display				=	'renderItemField';
}
$columns_number_main_1			=	$cck->getStyleParam( 'top_columns', '1' );
$columns_number_main_1			=	( !$columns_number_main_1 ) ? 1 : $columns_number_main_1;
$items_number_columns_intro		=	0;
$items_number_columns_links		=	0;
$js								=	'';

// Set template
$count	=	count( $items );
foreach ( $items as $item ) {
	echo $cck->$top_display( $item->pk, $top_display_params );
	// Debug
	if ( $columns_debug == 1 ) {
		echo	'<fieldset class="cck-debug"><legend>Debug:</legend>'
				.' // Number:'.($items_number + 1)
				.' // Total items:'.count( $items )
				.' // Total columns:'.$columns_number_main_1
				.' // Total leading:'.$items_main_1
				.' // Even/odd:'.$even_odd
				.' // Columns width:100%'
				.'</fieldset>';
	}
	$items_number++;
	$items_number_columns_main_1++;
	$items_number_columns_intro++;
	$items_number_columns_links++;
};

$cck->addScriptDeclaration( $js );
$cck->finalize();
?>