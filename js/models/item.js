(function($){

var app = window.app || {};


// Individual todo list item model:
app.ItemModel = Backbone.Model.extend({
			defualts: function(){
				return {
						completed: false,
						title: ''
					}; 
			},

			toggle: function(){ 
				// toggle  the completed to true or false whic triggers all change listeners
				this.set('completed', !this.get('completed') ) ;				
				return this;
			}

});

// Instantiate the Application
window.app  = app;

})(jQuery);