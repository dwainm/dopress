<?php
if(! defined('ABSPATH') ){ exit(); }

/**
*
*
*/

if class_exists('DP_Item'){

	class DP_Item{

		/**
		* store the id as reference to the post in the database
		*
		* @var int id
		* @since 2.0.0
		*/
		protected $id;

		/**
		* todo list item title
		*
		* @var string title
		* @since 2.0.0
		*/
		protected $title;

		/**
		* a longer description of the current item
		*
		* @var string description
		* @since 2.0.0		
		*/

		protected $description;

		/**
		*  variabitem completed 
		*
		* @var bool description
		* @since 2.0.0
		*/

		protected $completed;

		

		/**
		* costruct the item if and id is given
		* given the id
		*
		* @param int id
		* @since 2.0.0
		* @return object instance
		*/

		protected function __construct ( $todo_id ){

			// if it has item set it up by calling get propogate_item
			$propagated = propagate_item( $todo_id );

			if ( ! $propagated ){
				// initial a fresh new object  and set the id
			}

			return $this;

		}

		/**
		* internal function  to retrieve wordpress data int item 
		* given the id
		*
		* @param int id
		* @return bool success
		* @since 2.0.0
		*/

		protected function  propagate_item ( $todo_id ){
			
			$success = false; 

			if ( is_numeric($todo_id) ){

				// create query args and object
				$item = get_post( $todo_id );

				// check if sucess and set $success
				$success =  ! ( is_null( $item ) ) ? true : false ;

				if ( $success ){
					// set each property

					$this->$id  = $todo_id;
					$this->$title = $post['title'];
					$this->$description = $post['description'];
					$this->$completed = $post['completed'];

				} // end if s$success

			} // end is numeric todo_id

			// over and out , copy !
			return $success;
			
		}// end get_wp_item		

	}	// end class DP_Item 

} else{
	// duncan mcleoud -- there can be only one (lightning and thunder strikes)  !!! 
	// deactivate this plugin with a message of conflict
}	