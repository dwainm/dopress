// View:  items.js for the displaying the item data model 
(function($){

	var app = window.app || {};

	// Declare collection

	app.ItemView = Backbone.View.extend({
			   tagName: 'li',
			   viewType : 'Item',
			   model: {},
			   events: {
			   		'dblclick': 'edit',
			   		'change input[type=checkbox]': 'changeState',
			   		'keypress .edit': 'changeTitle'	
			   },
			   initialize: function(newModelObj){
			   		
			   		// attach a this view's modle from the collection addd event
			   		this.model =   newModelObj;


			   		// register and prepar dom element
		   			var tmpl  =  '<input type="checkbox"/><input class="edit" type="text" /><div class="title"></div>';
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
			   edit: function(){
			   		this.$('input.edit').show();
			   		this.$('.title').hide();
			   },

			   changeTitle: function(event){
			   		// check key press
			   		if(event.keyCode===13){
			   			var newTitle = $(event.target).val();
			   			this.model.set('title',newTitle);
			   			this.$('.title').show();
			   			this.$('input.edit').empty().hide();
			   		this.render();
			   		}

			   	
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

// set the Application
window.app  = app;


})(jQuery);