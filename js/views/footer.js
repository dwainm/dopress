//items.js for the Items collection
(function($){


	var app = window.app || {};

	// Declare collection


// Footer View
var FooterView =   Backbone.View.extend({
				el: $('#footer'),
				events: {
					'click .all': 'filterList',
					'click .completed': 'filterList',
					'click .incomplete':'filterList'
				},

				initialize: function(){
					this.listenTo(app.listView.collection, 'all',this.render );
					this.render();
				},

				countItems: function(collection, condition){
						var count = 0;
						collection.forEach(function(model){
							if (model.get('completed')===condition){
								count++;
							}
						});

						return count;
				},

				render: function(){
					//set the footer count to empty if noe items exist
					if( app.listView.collection.length < 1 ) {
						this.$('#counter .total').html('');
						this.$('#counter .text').html('');
						this.$('#listFilter').hide();
						return this;
					}

					// assuming ther will always be only one class
					var listClass = app.listView.$el.attr('class') ;
					listClass = _.isEmpty( listClass )  ? 'showAll' : listClass;
					var collection = app.listView.collection;
					var total = 0;
					var text = '';
					var trailing = '';
					
					switch(listClass){							
						case 'showIncomplete':
							var total =  this.countItems(collection, false);
							trailing = 'incomplete';					
							break;

						case 'showCompleted':
							var total =  this.countItems(collection, true);
							trailing = 'complete';											
							break;
							
						case 'showAll':
							var total =  this.countItems(collection, false);
							trailing = 'left';			
							break;	
					};

					text = ( total !==1 ? 'Items ':'Item ') + trailing;

					//update the counter and text
					this.$('#listFilter').show();
					this.$('#counter .total').html(total);
					this.$('#counter .text').html(text);	

					
				},

				filterList: function(event){

					event.preventDefault();

					//store current link clicked as jQuery Object
					var $a =  $(event.target);

					// remove all show classes fromt the list
					app.listView.$el.removeClass('showAll showIncomplete showCompleted');

					//dynamically add the latest show + html name to the list
					app.listView.$el.addClass( 'show' + $a.html() );

					this.$el.children('#listFilter').children('a').removeClass('active');

					$a.addClass('active');
					this.render();
					//set new acive link
		
				}
});

app.footerView = new FooterView();

// Instantiate the Application
window.app  = app;


})(jQuery);