//items.js for the Items collection
(function($){


	var app = window.app || {};

	// Declare collection

	app.ItemCollection = Backbone.Collection.extend({
				//localStorage: new Backbone.LocalStorage('dopress-items'),
				model: app.ItemModel

	});

	// Instantiate the Application
	window.app  = app;

})(jQuery);