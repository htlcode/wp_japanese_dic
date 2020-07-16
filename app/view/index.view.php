<div>
	<main>
		<h1><?php echo $title ?></h1>
		<form id="alj_form">
			<input type="search" id="alj_txt_search" name="alj_txt_search" placeholder="<?php echo $placeholder ?>" >
			<input type="hidden" id="alj_hid_url" value ="<?php echo $base_url ?>">
			<input type="submit" id="alj_btn_search" name="alj_btn_search" class="alj-btn" value="<?php echo __('Search'); ?>">
		</form>
	</main>
</div>