(function($){

/*

//  Dev  TASKS:

v2
* move into subfolders and files each peice of the project and change folder name to dopress [plugin]
* implement footer count
* implement local storage
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


var ItemCollection = Backbone.Collection.extend({
			//localStorage: new Backbone.LocalStorage('dopress-items'),
			model: itemModel 

});


// Instantiate Application Object

var app = new AppModel({version: 1, name: "Do This" , status:'active'});
var formModel = new FormModel({active: "true", position: "top" , visible:'true'}); 


// declare application views


//item view

var ItemView = Backbone.View.extend({
			   tagName: 'li',
			   viewType : 'Item',
			   model: {},
			   events: {
			   		'click': 'changeState'
			   },
			   initialize: function(newModelObj){
			   		
			   		// attach a this view's modle from the collection addd event
			   		this.model =   newModelObj;


			   		// register and prepar dom element
		   			var tmpl  =  '<input type="checkbox"/><div class="title"></div>';
 					this.$el.html(tmpl).attr('class','item');

 					// remove the uneeded attritebutes from the view 
 					this.$el.removeAttr('completed title');

 					// listen to external objects		
 					this.listenTo( this.model, 'all', this.render );

 					this.render();
			   		return this;
			   },

			   changeState: function(){
			   		// change the models complet property which calls render listener
			   		this.model.toggle();
			   		return this;
			   },

			   render: function(){
			   		

    				this.$el.attr('id', this.model.attributes.id)
   							.children('input').attr('name',this.model.get('id') ) 
   							.prop('checked', this.model.get('completed') )
   							.next('.title').html( this.model.get('title')  );	

   					// set complet /incomplete class
   					if( this.model.get('completed') ){
   						this.$el.addClass('completed');
   						this.$el.removeClass('incomplete');
   					}else{
   						this.$el.addClass('incomplete');
   						this.$el.removeClass('completed');
   					}

					// send this view back to asking module
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

				addItem: function(newModelObj){

					//initialize new view item
					// todo modle object passed from the this.collection add event

					var newItemView  = new ItemView(newModelObj);

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
							var newItemData = { id: newID ,title: this.inputText.val() ,completed:false};
							listView.collection.add(newItemData);	
							
							// add success check here
							this.inputText.val('');
							return this;
					}

					return false;
				}
});

// Footer View
var FooterView = Backbone.View.extend({
				el: $('#footer'),
				events: {
					'click .all': 'filterList',
					'click .completed': 'filterList',
					'click .incomplete':'filterList'
				},

				initialize: function(){
					this.render();
				},

				render: function(){
					return this;
				},

				filterList: function(event){

					event.preventDefault();

					//store current link clicked as jQuery Object
					var $a =  $(event.target);

					// remove all show classes fromt the list
					listView.$el.removeClass('showAll showIncomplete showCompleted');

					//dynamically add the latest show + html name to the list
					listView.$el.addClass( 'show' + $a.html() );

					this.$el.children('#listFilter').children('a').removeClass('active');

					$a.addClass('active');
					//set new acive link
		
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





// instantiate the formView for internal reference:

var listView =  new ListView;
var formView = new FormView();
var footerView = new FooterView();

// Instantiate the APP and set the master view for internal useage
window.todoApp  = new AppView();



})(jQuery);