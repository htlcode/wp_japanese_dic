<!DOCTYPE html>
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="lteie9 lteie8 lteie7 lteie6 ie6 no-js"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="lteie9 lteie8 lteie7 ie7 no-js"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="lteie9 lteie8 ie8 no-js"> <![endif]-->
<!--[if IE 9 ]>    <html <?php language_attributes(); ?> class="lteie9 ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<?php
wp_head();
?>
</head>
<div class="pam">
	<a href="<?php echo site_url()?>" class="btn-primary" referrerpolicy="origin">&larr; Retour sur <?php echo get_bloginfo('name') ?></a><br>
	<hr>

	<div class="breadcrumb" itemscope="" itemtype="https://schema.org/BreadcrumbList">
	Vous êtes ici : <span class="breadcrumb-link-wrap" itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem"><a class="breadcrumb-link" href="<?php echo site_url() ?>" itemprop="item"><span class="breadcrumb-link-text-wrap" itemprop="name">Accueil</span></a><meta itemprop="position" content="1"></span>

	<?php if(!empty($depth1_url)): ?>
	<span class="separator">&nbsp;»&nbsp;</span>
	<span class="breadcrumb-link-wrap" itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem"><a class="breadcrumb-link" href="<?php echo $depth1_url ?>" itemprop="item"><span class="breadcrumb-link-text-wrap" itemprop="name"><?php echo $depth1_label; ?></span></a><meta itemprop="position" content="2"></span>
	<?php endif; ?>	

	<span class="separator">&nbsp;»&nbsp;</span>
	<?php echo $depth2_label; ?>
	</div>