<?php
$icon   = NULL;

$icon    = $atts['icon'];

if ( empty( $icon )  ) {
	$icon = 'fa fa-star-o';
} else {
	$icon = 'fa fa-' . $icon;
}

?>


<ul class="list iconfont">
<?php foreach((array) $groups['list_item'] as $increment=>$context){ ?>
	<li><i class="<?php echo $icon; ?>"></i><?php echo $context['list_item']; ?></li>
<?php } ?>
</ul>
