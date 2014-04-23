(function($){


var app = app || {};

// Declare data models

var AppModel  = Backbone.Model.extend({});

// Instantiate Application Object

app.appModel =  new AppModel({
						version: 1, 
						name: "Do This" , 
						status:'active'
					}); 

// Instantiate the Application
window.app  = app;

})(jQuery);