<?php 
$h = 1;
$fr_img_flg = "data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQECAgICAgICAgICAgMDAwMDAwMDAwMBAQEBAQEBAgEBAgICAQICAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDA//AABEIABQAHgMBEQACEQEDEQH/xABpAAADAQAAAAAAAAAAAAAAAAAICgsJEAABAwUAAAAAAAAAAAAAAAAABwqICDlIuMcBAQEBAQAAAAAAAAAAAAAAAAkICgcRAAEBAw0AAAAAAAAAAAAAAAAEAweDBQgJNjdFRoSFs7XDxf/aAAwDAQACEQMRAD8AUrH3IpKjLdKzbR3IPaZbwhp0NukuZLj0hUDuqnI4u+1BMcW4eSD4gQ69u74/SNzRQ4+0T1xZg40MGYAGsAwRlRlulZto7kHtMt4Q06G3SXMlx6QqB3VTkcXfagmOLcPJB8QIde3d8fpG5oocfaJ64swcaGDMADWAYIyoy3Ss20dyD2mW8IadDbpLmS49IVA7qpyOLvtQTHFuHkg+IEOvbu+P0jc0UOPtE9cWYONDBn//2Q==";
$en_img_flg = "data:image/jpeg;base64,/9j/4QAYRXhpZgAASUkqAAgAAAAAAAAAAAAAAP/sABFEdWNreQABAAQAAAA8AAD/7gAOQWRvYmUAZMAAAAAB/9sAhAAGBAQEBQQGBQUGCQYFBgkLCAYGCAsMCgoLCgoMEAwMDAwMDBAMDg8QDw4MExMUFBMTHBsbGxwfHx8fHx8fHx8fAQcHBw0MDRgQEBgaFREVGh8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx//wAARCAAUAB4DAREAAhEBAxEB/8QAiwAAAgMAAAAAAAAAAAAAAAAABgcDBAUBAAMBAAAAAAAAAAAAAAAAAAQFBgMQAAAFAwMCBQQDAAAAAAAAAAECAwQFERITFBUGABYhIiM0BzEyMxdSQyQRAAECAwUCDQIHAAAAAAAAAAERAgASAyExQRMEIgVRYXGBscEyQlJiIxQGkSTwoeFywuIW/9oADAMBAAIRAxEAPwDX4+Sd5bDE41y3gskKRUhbsUDs1UAZEA5TGVjpN5eokpYAf53J8Z8dAVABKgLGpTOlM9F4c2zZUL+oggV6essrjLqlTOAZTwTNHZPmbztKrGJyT4uPwjiMq5bujOoSYl2IxOoSWbvSJt0HwHK5RWTStMAq0KYPvALqFqAdCb11or02WIQqw7+I6U0dY9pIOxgQcW4hRF1X4Bn5z5Mn3kk0MDJzKqu0zmuI1Kgu7VVqscBTOtegQABJsavqBeqkYglFhU3sW02spjaACk3CzDh6IntPu6khq13bJVGNO2bcbCGDltS4RcXuSdt+NR/C5jYnBRbzXJnMGuoe8jkzpAzONtwIsgdWqqI46nIIhZeW42TdHsl5qjOwMw6fyS7jjd+9leG5Q9sCfTSy5L7y5O8VK2gYQNcH4ZAcxVVNGvZZvGNyqneTT2MbosEARIBzAovrzBdQxfKACNBuELaiC/U7oNEK57eTGKej80zXANokk+b+sR8n4ZDRcQeSjJoZMia7VESGQI2MJHaCq6auIV1HCYCVHy5kSXgNxBMXx6XVKBa0OtQ3WX8kP9DvY16xoua1r2gkgOmLUICHZAtXBxS4oYIV/iPjZE3izblRpBvFqqozajNiRU8eZFQyRhdN9UDkCiZM9DESMAlKJvt8etquidTALlQ8ULNJ8pz3StY2fAF6KeAbCfUhcFgNVjuLIyyMSs4mk3jkR098ayKkomBjEFYi4yeEyNUzesB8dAEbqBXo0bmJZmZjJOG38c0C/wCwfmZXt35nhW36SwwfkXuvYw7X23aNa47U2ummsoWzbNJ6GurqMmo8+T2nqV6I00md9ysyhFuu7y81/RE/VX232aJl+r477U8n7MO3hCr4/uXa/K90zbnvUbrtTfnz4ZLLmv8APffW67xr9eiPkKSU0ut6oI+Dr7qovg/kImd9+/uzkvY+s3reHvsa/j14+4/rwZLL8vp/y8OnAy/btzEllF/Jhx8lsSBmzDLevXDmkMm7xGj7d/Y24utwzX7FqqErp9T6+s9vfo/Pk/L4W9TLcucyz5K7XUvdWa6Kv1vb+rLmSel45V2kTakkmWaxOzYsf//Z";
?>

<div class="flex-container">
	<main class="flex-item-fluid">
		<?php 
		if(is_array($words) && (count($words) > 1)): 
			$h = 2;
		?>
		<h1>Traduction de japonais à français : <?php echo $keyword; ?> </h1>
		<?php endif; ?>
		<?php 
		$i = 0;
		if(is_array($words)):
			foreach($words as $word): 
			$i++;
		?>
			<?php if(is_array($words) && (count($words) > 1)): ?>
		<label class="alj_tab_label" for="alj_tab<?php echo $i ?>"><?php echo $word['value']; ?></label>
			<?php endif; ?>
		<?php 
			endforeach; 
		endif;
		?>
		<ul class="alj_tabs">
		<?php 
		$i = 0;
		$j = 0;
		$k = 0;
		if(is_array($words)):
			foreach($words as $word): 
			$i++;
		?>
			<li class="alj_tab">
				<input type="radio" name="alj_tab" id="alj_tab<?php echo $i ?>" <?php echo ($i==1?"checked":""); ?>/>
				<div id="alj_tab_content<?php $i ?>" class="alj_tab_content card">
					<h<?php echo $h ?> class="word"><?php echo $word['value'] ?></h<?php echo $h ?>>
					<?php 
					$found = 2;
					if (empty($word['meanings_french']) 
					&& empty($word['meanings_english'])){
						$found = 0;

						if(is_array($words) && (count($words) == 1)){

							if(!empty($word['characters'][0]["meanings_english"]) 
							|| !empty($word['characters'][0]["meanings_french"])){
								$found = 1;
							}
						}

					}
					if($found):
					?>
						<?php if($found == 2): ?>
						<p><strong>Définition :</strong></p>
						<table>
							<?php if (!empty($word['meanings_french'])): ?>
								<tr>
									<td colspan="2" class="alj_table_header"><img alt="traduction francais" src="<?php echo $fr_img_flg ?>">&nbsp;Traduction(s) en francais</td>
								</tr>
								<?php foreach($word['meanings_french'] as $meaning_set): ?>
								<tr>
									<td><?php echo __($meaning_set['type'],$plugin_name); ?></td>
									<td><?php echo implode(', ',$meaning_set['meanings']); ?></td>
								</tr>
								<?php endforeach; ?>
							<?php endif; ?>
							<?php if (!empty($word['meanings_english'])): ?>
								<tr>
									<td colspan="2" class="alj_table_header"><img alt="traduction anglais" src="<?php echo $en_img_flg ?>">&nbsp;Traduction(s) en anglais</td>
								</tr>
								<?php foreach($word['meanings_english'] as $meaning_set): ?>
								<tr>
									<td><?php echo __($meaning_set['type'],$plugin_name); ?></td>
									<td><?php echo implode(', ',$meaning_set['meanings']); ?></td>
								</tr>
								<?php endforeach; ?>
							<?php endif; ?>
						</table>
						<?php endif; ?>

						<?php if(isset($word['characters'])): ?>
							<?php if($found == 2): ?>
						<p><strong>Il se compose des caractères suivants :</strong></p>
							<?php endif; ?>
						<?php 
						foreach($word['characters'] as $character): $k++;
						?>
							<label class="alj_tab_label" for="alj_sub_tab<?php echo $k ?>"><?php echo $character['value'] ?></label>
						<?php endforeach; ?>
						<ol class="alj_sub_tabs">
						<?php 
						$first = true;
						foreach($word['characters'] as $character): 
							$j++;
							$rowspan = 0;
							$character_type = '';
							if(isset($character['type'])){
								$character_type = ucfirst($character['type']);
								$rowspan++;
							}

							$character_stroke_str = '';
							if(isset($character['stroke_count'])){
								$character_stroke = $character['stroke_count'];
								$character_stroke_str = "Ce $character_type s'écrit en $character_stroke trait";
								if($character_stroke  > 1){
									$character_stroke_str = $character_stroke_str.'s';
								}
							}
							
							$character_onyomi = false;
							if(isset($character['onyomi'])){
								$character_onyomi = implode(', ',$character['onyomi']);;
								$rowspan++;
							}

							$character_kunyomi = false;
							if(isset($character['kunyomi'])){
								$character_kunyomi = implode(', ',$character['kunyomi']);;
								$rowspan++;
							}

							$meanings_french = false;
							if(isset($character['meanings_french'])){
								$meanings_french = implode(', ',$character['meanings_french']);;
								$rowspan++;
							}

							$meanings_english = false;
							if(isset($character['meanings_english'])){
								$meanings_english = implode(', ',$character['meanings_english']);;
								$rowspan++;
							}

							$character_jlpt = false;
							if(isset($character['jlpt'])){
								$character_jlpt = $character['jlpt'];
								$rowspan++;
							}
							$character_grade = false;
							if(isset($character['grade'])){
								$character_grade = $character['grade'];
								$rowspan++;
							}
						?>
							<li class="alj_sub_tab">
								<input type="radio" name="alj_sub_tabs<?php echo $i ?>" id="alj_sub_tab<?php echo $j ?>" <?php echo ($first == true?"checked":""); ?>/>
								<div id="alj_sub_tab_content<?php $j ?>" class="alj_tab_content">
									<div id="alj_character_draw">
										<h<?php echo ($h+1) ?>><?php echo $character['value'];?></h<?php echo ($h+1) ?>>
										<?php $codepoint = $character['codepoint_svg']; ?>
										<?php if(!empty($codepoint)): ?>
											<p>
											<?php echo $character_stroke_str ?>
											<?php $id = "{$j}-{$codepoint}";?>
											<div id="draw<?php echo $id ?>" class="grid-draw">
											</div>
										 	<button id="btndraw<?php echo $id ?>" class="button-draw btn-primary" data="<?php echo $id ?>">Montrer le tracé</button>
										 	<input id="cp<?php echo $id ?>" type="hidden" value="<?php echo $codepoint ?>">
											</p>
										<?php endif; ?>
									</div>
									<div id="alj_character_definitions">
										<table>
											<tr>
												<td class="alj_table_header">Nature du caractère</td><td><?php echo $character_type ?></td>
											</tr>
											<?php if($character_onyomi): ?>
											<tr>
												<td class="alj_table_header">Prononciation Sino-japonaise : Onyomi (音読み)</td><td><?php echo $character_onyomi ?></td>
											</tr>
											<?php endif; ?>
											<?php if($character_kunyomi): ?>
											<tr>
												<td class="alj_table_header">Prononciation Japonaise : Kunyomi (訓読み)</td><td><?php echo $character_kunyomi ?></td>
											</tr>
											<?php endif; ?>
											<?php if($meanings_french): ?>
											<tr>
												<td class="alj_table_header"><img alt="traduction francais" src="<?php echo $fr_img_flg ?>">&nbsp;Traduction(s) en francais</td><td><?php echo $meanings_french ?></td>
											</tr>
											<?php endif; ?>
											<?php if($meanings_english): ?>
											<tr>
												<td class="alj_table_header"><img alt="traduction anglais" src="<?php echo $en_img_flg ?>">&nbsp;Traduction(s) en anglais</td><td><?php echo $meanings_english ?></td>
											</tr>
											<?php endif; ?>
											<?php if($character_jlpt): ?>
											<tr>
												<td class="alj_table_header">JLPT (日本語能力試験)</td><td><?php echo $character_jlpt ?></td>
											</tr>
											<?php endif; ?>
											<?php if($character_grade): ?>
											<tr>
												<td class="alj_table_header">Grade scolaire (教育漢字)</td><td><?php echo $character_grade ?> Kyu (級)</td>
											</tr>
											<?php endif; ?>
										</table>
									</div>
								</div>
							</li>
						<?php 
						$first = false;
						endforeach;
						endif; 
						?>
						</ol>
					<?php else: ?>
						<p>Nous n'avons pas trouvé d'information concernant ce mot...</p>
					<?php endif; ?>
				</div>
			</li>
		<?php 
			endforeach; 
		endif;
		?>
		</ul>
		<input id="data_url" type="hidden" value="<?php echo $data_dir_url; ?>" > 
	</main>
	<?php if ( is_active_sidebar( 'aljdic-sidebar' ) ): ?>
	<aside id="site-sidebar" class="fl w400p">
		<?php dynamic_sidebar( 'aljdic-sidebar' ); ?>
	</aside>
	<?php endif; ?>
</div>
