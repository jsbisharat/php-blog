<?php

	function sortData($array, $filter, $order) {

		if($filter == 'date') {

			foreach($array as $key => &$value) {
				
				// Convert the date into a UNIX timestamp
				// Pass it to the variable, $time
				$time = strtotime($value[$filter]);

				// Set the new date value in the $array to the UNIX timestamp
				$value[$filter] = $time;
			}
		}

		// Go through the blog array again (but this time it has UNIX timestamps)
		foreach($array as $key2 => $value2) {

			// We create a new array to store the UNIX timestamp value from the updated blog array
			$new[$key2] = $value2[$filter];
		}
		
		// Sort the $new array (which is just an array of UNIX timestamps) to be in descending order
		// Then sort the original array, $array, based on the values of the first array
		array_multisort($new, $order, $array);

		// Return the newly-sorted array
		return $array;
	}

	// Filter the blog by date
	$filter = 'date'; 
	
	/* 
		Function Name: sortData
		Parameters: 
			1. An array
			2. Array value
			3. Order type: SORT_DESC or SORT_ASC
	*/
	$sorted_array = sortData($blog['articles'], $filter, $order=SORT_DESC);
	
	// How many blogs to appear per page
	$blogs_per_page = 2;
	
	// Grab the total number of blogs
	$total_blogs = count($sorted_array);
	
	// Find the total number of pages
	$total_pages = ceil($total_blogs / $blogs_per_page);

	// Initiate $blog_template variable 
	$blog_template = false;

	// Grab the webpage parameter in the URL
	$get_blog_url = isset($_GET['q']) ? $_GET['q'] : 1;

	// Run the statement to check whether the user is browsing the blogs or reading a blog article
	if ( isset( $get_blog_url ) && ctype_digit( $get_blog_url ) ) {

		// Determine what page the user is on
		$current_page = ($total_blogs > 0) ? min($total_pages, $get_blog_url) : 1;
		
		// Determine the starting point for the next set of blogs to retrieve
		$starting_point = ( $current_page * $blogs_per_page ) - $blogs_per_page;
		
		// Set the next set of blogs to the $split_blogs variable
		$split_blogs = array_slice($sorted_array, $starting_point, $blogs_per_page);	
	}
	// If 'q' is not empty (assuming it's a blog headline)
	elseif ( !empty( $get_blog_url ) ) {

		// Grab the information in the URL
		$blog_title = $get_blog_url;

		// Initiate variable to grab all of selected blog data
		$blog_data = NULL;

		// Cross reference the URL with the titles in the blog array
		// If there is a match, set the whole matched blog to the $blog_data variable
		// And set the page template that the matched blog will use
		foreach( $sorted_array as $key => $value3 ) {

			if ( $value3['url'] == $blog_title ) {
			
				$blog_data = $value3;

				$blog_template = 'news-template.php';
			}
		}

		// If the blog in the URL doesn't exist, then go back to the news landing page
		if ( empty( $blog_data ) ) {

			header('location: /news/1');
		}
	}
?>