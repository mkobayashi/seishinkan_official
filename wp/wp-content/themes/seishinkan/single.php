<?php
$name = 'default';

if ( in_category('dojo') ) {
  $name = 'dojo';
}

get_template_part('single', $name);
?>