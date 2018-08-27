<?php

add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

	/*
	 * Fonction de base pour un child theme qui permet d'enregistrer le lien vers le thème parent
	 */
	function my_theme_enqueue_styles() {
		wp_enqueue_style( 'child-style',
			get_stylesheet_directory_uri() . '/style.css',
			'parent-style',
			wp_get_theme()->get('Version')
		);
	}
	add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

	/*
	 * Enregistrement des formats personnalisés de thumbnail
	 */
	add_action('init', 'my_init_function');
	
    function my_init_function() {
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'document-thumb', 166, 93, true ); // Hard Crop Mode
   }	

   	add_filter( 'image_size_names_choose', 'my_custom_sizes' );
   
  	function my_custom_sizes( $sizes ) {
	  	return array_merge( $sizes, array(
			'document-thumb' => __( 'Image 166x93' ),
	  	) );
	}	

	/*
	 * Définition d'une longueur personnalisée de l'extrait
	 */
	function my_custom_excerpt_length( $length ) {
		return 150; // set the number to the amount of words you want to appear in the excerpt
	}
	add_filter( 'excerpt_length', 'my_custom_excerpt_length');

	/**
	 * Filter the "read more" excerpt string link to the post.
	 *
	 * @param string $more "Read more" excerpt string.
	 * @return string (Maybe) modified "read more" excerpt string.
	 */
	function my_custom_excerpt_more( $more ) {
		return sprintf( '<a class="read-more" href="%1$s">%2$s</a>',
			get_permalink( get_the_ID() ),
			__( 'Read More', 'textdomain' )
		);
	}
	//add_filter( 'excerpt_more', 'my_custom_excerpt_more' );



?>