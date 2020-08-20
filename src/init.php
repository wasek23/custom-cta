<?php

add_action( 'init', function() {
	// Register block styles for both frontend + backend.
	wp_register_style('custom_cta-block-style-css', plugins_url( 'dist/blocks.style.build.css', dirname( __FILE__ ) ), is_admin() ? array( 'wp-editor' ) : null, null);

	// Register block editor script for backend.
	wp_register_script('custom_cta-block-js', plugins_url( '/dist/blocks.build.js', dirname( __FILE__ ) ), array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ), null, true);

	// Register block editor styles for backend.
	wp_register_style('custom_cta-block-editor-css', plugins_url( 'dist/blocks.editor.build.css', dirname( __FILE__ ) ), array( 'wp-edit-blocks' ), null);

	// WP Localized globals. Use dynamic PHP stuff in JavaScript via `cgbGlobal` object.
	wp_localize_script(
		'custom_cta-block-js',
		'cgbGlobal', // Array containing dynamic data for a JS Global.
		[
			'pluginDirPath' => plugin_dir_path( __DIR__ ),
			'pluginDirUrl'  => plugin_dir_url( __DIR__ ),
			// Add more data here that you want to access from `cgbGlobal` object.
		]
	);

	// Register Gutenberg block on server-side.
	register_block_type('wasek/custom-cta', array(
		'style'         => 'custom_cta-block-style-css',
		'editor_script' => 'custom_cta-block-js',
		'editor_style'  => 'custom_cta-block-editor-css',
	));
});