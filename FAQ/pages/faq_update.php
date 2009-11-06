<?php
require( 'faq_api.php' );
require( 'css_faq.php' );
html_page_top1( );
if (OFF == plugin_config_get( 'faq_view_window' ) ){
	html_page_top2( );
}
?>
<p>
<div align="center">
<?php

$t_update_access = plugin_config_get( 'faq_update_threshold' );
$t_view_access = plugin_config_get( 'faq_view_threshold' );

access_ensure_project_level( $t_update_access );

# Update faq
$f_question    = gpc_get_string( 'question' );
$f_answere     = gpc_get_string( 'answere' );
$f_project_id  = gpc_get_int( 'project_id' );
$f_poster_id   = gpc_get_int( 'f_id' );

$result = faq_update_query( $f_poster_id, $f_question, $f_answere, $f_project_id, $t_view_access );

$f_question = string_display( $f_question );
$f_answere  = string_display( $f_answere );

if ( $result ) {				# SUCCESS
	echo lang_get( 'operation_successful' ) . '<p>';
?>
	<table class="width75" cellspacing="1">
	<tr>
		<td class="faq-heading">
			<span class="faq-question"><?php echo $f_question ?></span>
		</td>
	</tr>
	<tr>
		<td class="faq-answere">
			<?php echo $f_answere ?>
		</td>
	</tr>
	</table>
	<p>
<?php
	} else {						# FAILURE
		print_sql_error( $query );
	}
	if (ON == plugin_config_get( 'faq_view_window' ) ){
	?>
	<a href="javascript:window.opener='x';window.close();"><?php echo plugin_lang_get( 'close_window' ) ?></a>
<?php

	} else {
		print_bracket_link( $g_faq_menu_page, lang_get( 'proceed' ) );
	}
?>
</div>

<?php html_page_bottom1( __FILE__ ) ?>
