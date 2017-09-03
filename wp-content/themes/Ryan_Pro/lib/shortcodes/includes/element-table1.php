<?php
$row_content = NULL;
$delimiter   = NULL;

$delimiter   = $atts['delimiter'];

$column_type = NULL;

	// Set delimiter variable
	if ( empty( $delimiter ) or $delimiter == 'pipe' ) {
		$delimiter = '|';
	} else if ( $delimiter == 'semi-colon' ) {
		$delimiter = ';';
	} else if ( $delimiter == 'colon' ) {
		$delimiter = ':';
	} else if ( $delimiter == 'tilde' ) {
		$delimiter = '~';
	}

	// Output table content
	echo '<div class="sc-table style1">';
		echo '<table>';
			echo '<tbody>';

				$increment = NULL;

				?><?php foreach((array) $groups['row_content'] as $increment=>$context){ ?><?php

					$row_content = explode( $delimiter, $context['row_content'] );

					if ( empty( $increment ) or $increment == '0' ) {
						$column_type = 'th';
					} else {
						$column_type = 'td';
					}
		
					echo '<tr>';
					
						foreach ( $row_content as $row_value ) {
							echo '<' . $column_type . '>' . $row_value . '</' . $column_type . '>';
						}
		
					echo '</tr>';

					$increment = $increment + 1;

				?><?php } ?><?php

				$increment = NULL;

			echo '</tbody>';
		echo '</table>';
	echo '</div>';