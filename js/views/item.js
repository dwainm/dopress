// View:  items.js for the displaying the item data model 
(function($){

	var app = window.app || {};

	// Declare collection

	app.ItemView = Backbone.View.extend({
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

// set the Application
window.app  = app;


})(jQuery);