<?php include('blog.php'); ?>

<!DOCTYPE html>
<html lang="en">
	
	<?php include('header.php'); ?>
	
	<body>
		<div class="container">

			<?php
				if( $blog_template ) {

					include($blog_template);
				}
				else {
					echo "<h2>Blog Pagination</h2><br>";

					foreach ($split_blogs as $k => $v) {

						echo $v['title'] . "<br>";
						echo "<a href=\"/news/" . $v['url'] . "\">" . $v['url'] . "</a><br><br>";
					}
			?>
					<ul class="pagination">
						<?php 

							// Check whether the user can go back to the previous page or not
							if($get_blog_url == 1) {
								echo "<li><a href=\"/news/" . ($get_blog_url) . "\">" . "PREV" . "</a></li>";
							}
							else {
								echo "<li><a href=\"/news/" . ($get_blog_url - 1) . "\">" . "PREV" . "</a></li>";
							}

							// Display the numbered navigation
							for($i = 1; $i < $total_pages + 1; ++$i) {
								if($get_blog_url == $i) {
									echo "<li class=\"active\"><a href=\"/news/" . $i . "\">" . $i . "</a></li>";
								}
								else {
									echo "<li><a href=\"/news/" . $i . "\">" . $i . "</a></li>";
								}
							}

							// Check whether the user can go forward to the next page or not
							if( $get_blog_url  >= $total_pages) {
								echo "<li><a href=\"/news/" . ($total_pages) . "\">" . "NEXT" . "</a></li>";
							}
							else {
								echo "<li><a href=\"/news/" . ($get_blog_url + 1) . "\">" . "NEXT" . "</a></li>";
							}
				}
						?>
					</ul>
		</div>
	</body>
</html>