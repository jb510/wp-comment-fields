<?php 
/*
 * nmwpcomment file rendering admin options for the plugin
* options are defined in admin/admin-options.php
*/

global $nmwpcomment;
$nmwpcomment -> load_template('admin/options.php');
//$nmwpcomment -> pa($nmwpcomment -> the_options);
//filemanager_pa($nmwpcomment -> plugin_settings);

$sendUpdate = array();

?>


<h2>
	<?php echo $nmwpcomment->plugin_meta['name']?>
</h2>
<div id="wpcomments-tabs" class="tab-container">
	<ul class='etabs'>
		<?php foreach($nmwpcomment -> the_options as $id => $option){
			
			?>

		<li class='tab'><a href="#<?php echo $id?>"><?php echo $option['name']?>
		</a></li>

		<?php }?>
	</ul>


	<?php foreach($nmwpcomment -> the_options as $id => $options){
		
		// reseting the update data array
		
		?>

	<div id="<?php echo $id?>" class="general-settings">
		<p>
			<?php echo $options['desc']?>
		</p>


		<ul>
			<?php 
			if(is_array($options['meat'])){
			
				
				foreach($options['meat'] as $key => $data){
			
				$sendUpdate[$data['id']] = array('type'	=> $data['type']);
			
				//echo 'option key '.$data['id'];
				$default_value = (isset($data['default']) ? $data['default'] : '');
				$the_value = ( isset($nmwpcomment -> plugin_settings[ $data['id'] ]) ? $nmwpcomment -> plugin_settings[ $data['id'] ] : $default_value);
				?>

			<li id="<?php echo $key?>" class="plugin-field-set">			
			<?php switch($data['type']){
					
				case 'text':
					if ($data['id'] == 'nm_filemanager_public_user' && $the_value == ''){
						$text_val = get_current_user_id();
					} else {
						$text_val = stripcslashes($the_value);
					}
					?>
				<ul>
					<li><h4><?php echo $data['desc']?> </h4>
					<label for="<?php echo $data['id']?>"><?php echo $data['label']?> <br />
					<input type="text" name="<?php echo $data['id']?>" id="<?php echo $data['id']?>" value="<?php echo $text_val ?>" class="regular-text" >
					</label><br />
					<em class="help"><?php echo $data['help']?> </em> 
					</li>
				</ul> <?php 
				break;
				
				
				case 'textarea':
					?>
								<ul>
									<li><h4><?php echo $data['desc']?> </h4>
									<label for="<?php echo $data['id']?>"><?php echo $data['label']?></label><br /> 
									<textarea cols="45" rows="6" name="<?php echo $data['id']?>" id="<?php echo $data['id']?>"><?php echo stripcslashes($the_value)?></textarea>
									<br />
									<em><?php echo $data['help']?> </em> 
									</li>
								</ul> 
				<?php 
				break;

				case 'checkbox':?>
				<ul>
					<li>
					<h4><?php echo $data['desc']?> </h4>
					
					<?php foreach($data['options'] as $k => $label){?>
					
						<label for="<?php echo $data['id'].'-'.$k?>"> <input type="checkbox" name="<?php echo $data['id']?>" id="<?php echo $data['id'].'-'.$k?>" value="<?php echo $k?>"> <?php echo $label?>
						</label>
					<?php }?>
					
					<br />
					<em><?php echo $data['help']?> </em> 
					</li>
					<!-- setting value -->
					<script type="text/javascript">
					setChecked('<?php echo $data['id']?>', '<?php echo json_encode($nmwpcomment -> plugin_settings[ $data['id'] ])?>');
					</script>
				</ul>
				
								
				<?php break;
				
				
				case 'radio':?>
								<ul>
									<li>
									<h4><?php echo $data['desc']?> </h4>
									
									<?php foreach($data['options'] as $k => $label){?>
									
										<label for="<?php echo $data['id'].'-'.$k?>"> <input type="radio" name="<?php echo $data['id']?>" id="<?php echo $data['id'].'-'.$k?>" value="<?php echo $k?>"> <?php echo $label?>
										</label>
									<?php }?>
									
									<br />
									<em><?php echo $data['help']?> </em> 
									</li>
									<script>
									setCheckedRadio('<?php echo $data['id']?>', '<?php echo $nmwpcomment -> plugin_settings[ $data['id'] ]?>');
									</script>
								</ul>
								
												
				<?php break;
				
				case 'select':?>
								<ul>
									<li>
									<h4><?php echo $data['desc']?> </h4>
									
										<label for="<?php echo $data['id']?>"><?php echo $data['label']?> 										 
										<select name="<?php echo $data['id']?>" id="<?php echo $data['id']?>">
											<option value=""><?php echo $data['default']?></option>
											
											<?php foreach($data['options'] as $k => $label){
												
													$selected = ($k == $nmwpcomment -> plugin_settings[ $data['id'] ]) ? 'selected = "selected"' : '';
													
													echo '<option value="'.$k.'" '.$selected.'>'.$label.'</option>';
											}
												?>
											
										</select> 
										</label>
									
									<br />
									<em><?php echo $data['help']?> </em>
									</li>
								</ul>
								
								<?php break;
								
			case 'para':?>
											<ul>
												<li>
												<h4><?php echo $data['desc']?> </h4>
												
												<br />
												<em><?php echo $data['help']?> </em>
												</li>
											</ul>
											
											<?php break;
			
		case 'file':?>
													<ul>
														<li>
														<?php 
														$file = $nmwpcomment->plugin_meta['path'] .'/templates/admin/'.$data['id'];
														if(file_exists($file))
															include $file;
														else 	
															echo 'file not exists '.$file;
														?> 
														</li>
													</ul>
													
													<?php break;

			} ?></li>
			<?php }
				
			}
			
			?>
		</ul>
	
	<?php if( $id == 'general-settings' || $id == 'pro-features'){
		?>
		<p><button class="button button-primary" onclick=update_options('<?php echo json_encode($sendUpdate)?>')><?php _e('Save settings', 'nm-filemanager')?></button>
			<span id="wpcomment-settigns-saving"></span>
		</p>
	
	<?php
	}
	?>
		
	</div>

	<?php 
	}
	?>
	
</div>