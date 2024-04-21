if( window.acf ) {
	// Initialize dynamic block preview (editor).
	window.acf.addAction( 'render_block_preview/type=post-objects', initializeBlock );
	console.log("window acf");
} else {
	// Initialize on the frontend.
	// initializeBlock();
	console.log("else");
}