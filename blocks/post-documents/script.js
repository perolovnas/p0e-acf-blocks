if( window.acf ) {
	// Initialize dynamic block preview (editor).
	window.acf.addAction( 'render_block_preview/type=post-documents', initializeBlock );
	console.log("window acf");
} else {
	// Initialize on the frontend.
	// initializeBlock();
	console.log("post document");
}

// Mixit up filter data-attr
document.addEventListener("DOMContentLoaded", function () {
	var mixer = mixitup(".posts-wrapper", {
	animation: {
		duration: 200,
		enable: true,
		effectsIn: "fade translateX(10px)",
		effectsOut: "fade translateX(-10px)",
	},
	controls: {
		toggleDefault: "all",
	},
	multifilter: {
		enable: true
    },
    callbacks: {
        onMixStart: function(state, futureState) {
            console.log(futureState.activeFilter.selector);
        }
    }
	});
  });