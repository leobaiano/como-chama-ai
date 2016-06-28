<?php global $luxe_options; ?>	

			<footer class="footer" role="contentinfo">

				<?php
				// get total footer columns from theme options
				$columns = $luxe_options['footer-widgets'];
				if($columns > 0 && !empty($columns)) { ?>

                <div id="footer-widgets" class="clearfix content">

                	<div class="wrap">
            			<?php
						$firstCol = 'first';
				        switch($columns)
				        {
				        	case 1: $column_class = ''; break;
				        	case 2: $column_class = 'one_half'; break;
				        	case 3: $column_class = 'one_third'; break;
				        	case 4: $column_class = 'one_fourth'; break;
				        	case 5: $column_class = 'one_fifth'; break;
				        }

				        // loop through footer widgets and display
						for ($i = 1; $i <= $columns; $i++)
						{
							echo "<div class='$column_class $firstCol footer-widget'>";
								dynamic_sidebar('Footer - '.$i);
							echo "</div>";
							$firstCol = "";
						}
						?>

	                </div>

                </div> <!-- end #footer widgets-->    
                
                <?php } ?>

				<div id="footer-copy" class="clearfix">

					<div class="wrap">

						<?php echo $luxe_options['footer-text']; ?>

					</div>

				</div>

			</footer>

		</div><!-- end #container -->

		<?php wp_footer(); ?>

	</body>

</html>
