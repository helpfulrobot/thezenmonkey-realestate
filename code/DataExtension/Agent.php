<?php

/**
 * 	
 * @package
 * @author
 */
 
 
class Agent extends DataExtension {
			
	
		/**
		 * Object vars
		 * ----------------------------------*/
	
	
	
		/**
		 * Static methods
		 * ----------------------------------*/
	
	
	
		/**
		 * Data model
		 * ----------------------------------*/
		 
		 static $db = array(
		 	"JobTitle" => "Varchar",
		 	"PhoneNumber" => "Varchar",
		 	"Cell" => "Varchar",
		 	"SortOrder" => "Int",
		 	"Bio" => "HTMLText",
		 );
		 
		 static $has_many = array(
		 	"Testimonials" => "Testimonial",
		 	"Listings" => "Listing"
		 );
		 
		 static $has_one = array(
		 	"Headshot" => "Image",
		 	'Folder' => 'Folder',
		 );
	
	
		/**
		 * Common methods
		 * ----------------------------------*/
	public function updateCMSFields(FieldList $fields) {
		
		$fields->removeFieldFromTab ( "Root", "Pictures");
		$fields->removeFieldFromTab ( "Root", "Folder");
		$fields->removeFieldFromTab ( "Root", "SortOrder");
		
		$fields->insertAfter(TextField::create("JobTitle", "Job Title"), "Surname");
		$fields->insertAfter(TextField::create("PhoneNumber"), "Password");
		$fields->insertAfter(TextField::create("Cell"), "PhoneNumber");
		$fields->insertAfter(HTMLEditorField::create("Bio"), "Cell");
		
		if($this->owner->FolderID != 0) {
			$fields->insertAfter(UploadField::create("Headshot")->setFolderName("/Uploads/Agents/".$this->owner->Folder()->Name), "Password");
		}
	}
	
	function onBeforeWrite() {
		
			
		if ($this->owner->FolderID == 0) {
		
		
			/**
			* Find or Create Folder under assets/Homes named $address-$city 
			* Finds and attached the FolderID after its created
			*/
			$filter = URLSegmentFilter::create();
			$folderName = $filter->filter($this->owner->Title);
			$folderExists = Folder::find_or_make('Uploads/Agents/'.$folderName.'/');
			$this->owner->FolderID = $folderExists->ID;
		}
		
		parent::onBeforeWrite();
	}
	
	
		/**
		 * Accessor methods
		 * ----------------------------------*/
	
	
	
		/**
		 * Controller actions
		 * ----------------------------------*/
	
	
	
		/**
		 * Template accessors
		 * ----------------------------------*/
	
	
		/**
		 * Object methods
		 * ----------------------------------*/
		 
		 
	
}