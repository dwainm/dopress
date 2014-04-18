(function($){

/*
//  TASKS:


* complete custom class and custom styling
* hide completed
* complete all
* chante description to title to make room for a 
  larger description area
* styling mobile friendly changes
* create theme boilerplate code
* create post type for todo tasks 
* hook up models with WordPress data

*/

// Declare data models

var AppModel  = Backbone.Model.extend({});
var FormModel = Backbone.Model.extend({});
var ListModel = Backbone.Model.extend({});

// Individual todo list item model:
var itemModel = Backbone.Model.extend({
			defualts: function(){
				return {
						status: "incomplete",
						description: ''
					};
			},

			toggleComplete: function(checked){ 
				//data toggle code here
				this.attributes.status = checked ? 'complete':  'incomplete';				
				return this;
			},

			isComplete: function(){
				
				if(this.attributes.status==='complete'){
					return true;
				}else{
					return false;
				}
			}

});


var ItemCollection = Backbone.Collection.extend({
			model: itemModel 

});
// item model { ID , Status: (complete || incomplete) , description }


// Instantiate Application Object

var app = new AppModel({version: 1, name: "Do This" , status:'active'});
var formModel = new FormModel({active: "true", position: "top" , visible:'true'}); 
var listModel = new ListModel({total: 0, totalCompleted: 0  , totalIncomplete: 0 }); 


// declare application views




//item view

var ItemView = Backbone.View.extend({
			   tagName: 'li',
			   viewType : 'Item',
			   model: {},
			   //model: itemModel,
			   events: {
			   		'change input':'changeState',
			   		'click': 'itemClick'
			   },
			   initialize: function(){

		   			var tmpl  =  '<input type="checkbox"/><div class="description"></div>';

 					this.$el.html(tmpl)
 							.attr('class','item');

			   		return this;
			   },
			   attachModel: function(newModel){
			   		this.model = newModel ;
			   		this.render();
			   		return this;
			   },

			   changeState: function(event){
			   		this.model.toggleComplete(event.target.checked);
			   		this.render();
			   		return this;	   		
			   },
			   itemClick: function(){
			   		//this.model.toggleComplete();
			   		var toggleTo = this.model.isComplete() ? false : true ; //oposit of current modle data
			   		this.model.toggleComplete(toggleTo);
			   		this.render();
			   		return this;
			   },

			   render: function(){
			   		// send html back to asking module



    				this.$el.attr('id', this.model.attributes.id)
   							.children('input').attr('name',this.model.attributes.id)
   							.prop('checked', this.model.isComplete() )
   							.next('.description').html(this.model.attributes.description);	

   					// set complet /incomplete class
   					if( this.model.isComplete() ){
   						this.$el.addClass('completed');
   						this.$el.removeClass('incomplete');
   					}else{
   						this.$el.addClass('incomplete');
   						this.$el.removeClass('completed');
   					}

	
			   		return this; 				
			   }
});

// listView
var ListView = Backbone.View.extend({
				el: $('#list'),
				viewType : 'List',
				collection : new  ItemCollection(),
				initialize: function(){
					//event listeners
					this.listenTo(this.collection, 'add',this.addItem);
					//delete listner this.listenTo(this.collection, 'remove/delete',this.addItem);

					this.itemViews = [];
				},

				addItem: function(newItemModel){

					//initialize neew item
					var newItemView  = new ItemView();
					newItemView.attachModel(newItemModel);

					//adding adding item as sub view 
					this.itemViews.push(newItemView);

					this.render();
					return this;

					// loop through all new objects and add the latest to the list
				},
				removeCompleted: function(){
						//loop through each element calling its remove method
				},
				render: function(){

					//Add items that's not yet on the list but in the views array

					_.each(this.itemViews, function(item){
     					if ( _.isNull(item.el.offsetParent) ){
     						// object if no parrent exists
     						this.$el.append(item.$el);
     					}; 
					}, this);


				}
});


// Form View
var FormView = Backbone.View.extend({
				el:$('#item-add-form'),
				viewType : 'Form',
				inputText: $("#item-add-text"),
				model: formModel,
				events: {
					'submit': 'submitItem'
				},

				submitItem: function(event){
					if ( ! _.isEmpty(formView.inputText.val()) ){

							event.preventDefault();
							var newID = _.uniqueId('item_');
							var newItemData = { id: newID ,description: this.inputText.val() ,status:"incomplete"};
							listView.collection.add(newItemData);	
							
							// add success check here
							this.inputText.val('');
							return this;
					}

					return false;
				}
});


// App View
var AppView = Backbone.View.extend({
				el: $('#app'),
				viewType : 'App',
				initialize: function(){
				this.formView = formView; // make publicaly avaialable
				this.listView = listView;
				},
});

// Item View


// instantiate the formView for internal reference:
var listView =  new ListView;
var formView = new FormView();


// Instantiate the APP and set the master view for internal useage
window.todoApp  = new AppView();




})(jQuery);