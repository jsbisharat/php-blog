<?php
	
	echo "<h2>Blog - " . $blog_data['title'] . "</h2>";

	// F = A full textual representation of a month (January through December)
	// j = The day of the month without leading zeros (1 to 31)
	// S = The English ordinal suffix for the day of the month (2 characters st, nd, rd or th. Works well with j)
	// A four digit representation of a year
	echo "<p>Date: " . date('F jS, Y', $blog_data['date']) . "</p>";

	echo $blog_data['content'] . "<br><br>";
?>

<p>Click <a href="/news">here</a> to go back to the blog articles.