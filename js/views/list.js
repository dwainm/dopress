//items.js for the Items collection
(function($){


	var app = window.app || {};

	// listView
	var ListView =  Backbone.View.extend({
				el: $('#list'),
				viewType : 'List',
				model: {},
				collection : new  app.ItemCollection(),
				events:{
					'click #hideCompleted':'toggleCompleted'
				},
				initialize: function(){

					//this.model = new ListModel({total: 0, totalCompleted: 0  , totalIncomplete: 0 , hideCompleted: false});

					//event listeners
					this.listenTo(this.collection, 'add',this.addItem);
					 
					//delete listner this.listenTo(this.collection, 'remove/delete',this.addItem);
					this.itemViews = [];
				},

				addItem: function(newModelObj){

					//initialize new view item
					// todo modle object passed from the this.collection add event

					var newItemView  = new app.ItemView(newModelObj);

					//adding adding item as sub view 
					this.itemViews.push(newItemView);

					this.render();
					return this;

					// loop through all new objects and add the latest to the list
				},
				toggleCompleted: function(){

						//loop through each element calling its remove method

						this.model.hideCompleted =  !this.model.hideCompleted;

						if(this.model.hideCompleted){
							this.$el.children('#hideCompleted').html('Hide Completed');
						}else{
							this.$el.children('#hideCompleted').html('Show Completed');
						}

						this.render();
						return this;
						
				},
				render: function(){

					//Add items that's not yet on the list but in the views array

					//--> move hide functionality to each model instead simply add completed class or remove it upon update
					//--> clever css to only add a hide to the whole
					//--> then say hidelist .completed display none

					if( this.model.hideCompleted ){


					}

					//check for new items:

					_.each(this.itemViews, function(item){				

     					if ( _.isNull(item.el.offsetParent) ){
     						// object if no parrent exists
     							this.$el.append(item.$el);
     						}; 

					}, this);



				}
	});

app.listView = new ListView();

// Instantiate the Application
window.app  = app;


})(jQuery);

