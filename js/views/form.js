//items.js for the Items collection
(function($){


	var app = window.app || {};

	// Declare collection

// Form View
var FormView = Backbone.View.extend({
				el:$('#item-add-form'),
				viewType : 'Form',
				inputText: $("#item-add-text"),
				//model: formModel,
				events: {
					'submit': 'submitItem'
				},

				submitItem: function(event){
					if ( ! _.isEmpty(this.inputText.val()) ){

							event.preventDefault();
							var newID = _.uniqueId('item_');
							var newItemData = { id: newID ,title: this.inputText.val() ,completed:false};
							app.listView.collection.add(newItemData);	
							
							// add success check here
							this.inputText.val('');
							return this;
					}

					return false;
				}
});

app.formView = new FormView({});

// Instantiate the Application
window.app  = app;



})(jQuery);