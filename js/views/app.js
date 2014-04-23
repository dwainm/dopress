(function($){

var app = window.app || {};

// App View
app.view = new Backbone.View.extend({
				el: $('#app'),
				viewType : 'App',
				initialize: function(){
					// intialize app view
				},
});


// Instantiate the Application
window.app  = app;

})(jQuery);