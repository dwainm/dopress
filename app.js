(function($){

/*
//  TASKS:





* commit all change as version one tag it as well
* add local storage 
v2
* hide completed 
* when hide all is active and you complete an item that item should get the hidden class  
* possibly add a description for each item
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
						title: ''
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
// item model { ID , Status: (complete || incomplete) , title }


// Instantiate Application Object

var app = new AppModel({version: 1, name: "Do This" , status:'active'});
var formModel = new FormModel({active: "true", position: "top" , visible:'true'}); 


// declare application views




//item view

var ItemView = Backbone.View.extend({
			   tagName: 'li',
			   viewType : 'Item',
			   model: {},
			   //model: itemModel,
			   events: {

			   		'click': 'changeState'
			   },
			   initialize: function(){

		   			var tmpl  =  '<input type="checkbox"/><div class="title"></div>';

 					this.$el.html(tmpl)
 							.attr('class','item');

			   		return this;
			   },
			   attachModel: function(newModel){
			   		this.model = newModel ;
			   		this.render();
			   		return this;
			   },

			   changeState: function(){
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
   							.next('.title').html(this.model.attributes.title);	

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
				model: {},
				collection : new  ItemCollection(),
				events:{
					'click #hideCompleted':'toggleCompleted'
				},
				initialize: function(){

					this.model = new ListModel({total: 0, totalCompleted: 0  , totalIncomplete: 0 , hideCompleted: false});

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
				toggleCompleted: function(){
						//loop through each element calling its remove method
						if(this.model.hideCompleted){
							this.model.hideCompleted = false;
							this.$el.children('#hideCompleted').html('Hide Completed');
						}else{
							this.model.hideCompleted = true;
							this.$el.children('#hideCompleted').html('Show Completed');
						}
						this.render();
						return this;
						
				},
				render: function(){

					//Add items that's not yet on the list but in the views array

					_.each(this.itemViews, function(item){

						if(this.model.hideCompleted && item.model.isComplete()){
							//hide this element
							item.$el.addClass('hidden');
						}else{
							//show this element
							item.$el.removeClass('hidden');
						}
										

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
							var newItemData = { id: newID ,title: this.inputText.val() ,status:"incomplete"};
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