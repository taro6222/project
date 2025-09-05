<?php

/* POSTFILTER */

function common( $source, $tpl )
{
	//$source = str_replace( "{globals:도메인}", EZC_ROOT_DOMAIN, $source );

	$source = str_replace( "__assets", '/' . $tpl->template_dir . '/__assets', $source );
	$source = str_replace( "__image",  '/' . $tpl->template_dir . '/__image',  $source );
	$source = str_replace( "__style",  '/' . $tpl->template_dir . '/__style',  $source  );
	$source = str_replace( "__script", '/' . $tpl->template_dir . '/__script', $source  );
	$source = str_replace( "__common", '/' . $tpl->template_dir . '/__common', $source  );
	$source = str_replace( "__plugin", '/' . $tpl->template_dir . '/__plugin', $source  );
	$source = str_replace( "__media", '/' . $tpl->template_dir . '/__media', $source  );
	$source = str_replace( "__manager", '/' . $tpl->template_dir . '/__manager', $source  );

	return $source;
}