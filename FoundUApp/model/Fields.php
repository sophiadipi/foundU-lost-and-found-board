<?php
/*******************************************************************************
 * COMP 3541 Final Project
 * Sophia DiPietro (T00714296)
 * March 10, 2026
 * 
 * FoundU - Model
 * 
 * Fields.php
 * 
 * This file defines the Field and Fields classes used to manage form validation
 * in the FoundU application.
 * 
 * The Field class represents a single form field and stores its name, error
 * message, and error status. It provides methods to get and set each of these
 * field attributes, as well as a method called getHTML() to provide the
 * error message in HTML format for display. 
 * 
 * The Fields class represents a collection of Field objects. It provides
 * methods to add fields, retrieve individual fields,and determine if any 
 * validation errors exist. 
 * 
 ******************************************************************************/
class Field {
    private $name;
    private $message = '';
    private $hasError = FALSE;
    
    /* Creates a Field object with an optional message */
    public function __construct($name, $message = '') {
        $this->name = $name;
        $this->message = $message;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getMessage() {
        return $this->message;
    }
    
    public function hasError() {
        return $this->hasError;
    }
    
    /* Sets an error message and marks the field as invalid */
    public function setErrorMessage($message) {
        $this->message = $message;
        $this->hasError = TRUE;
    }
    
    /* Clears the error message and marks the field as valid */
    public function clearErrorMessage() {
        $this->message = '';
        $this->hasError = FALSE;
    }
    
    /* Returns the Field object's error message as HTML */
    public function getHTML() {
        $message = htmlspecialchars($this->message);
        if ($this->hasError()) {
            return '<span class="error">' . $message . '</span>';
        } else {
            return '<span>' . $message . '</span>';
        }
    }
}

class Fields {
    private $fields = array();
    
    /* Adds a new Field object to the collection */
    public function addField($name, $message = '') {
        $field = new Field($name, $message);
        $this->fields[$field->getName()] = $field;
    }
    
    public function getField($name) {
        return $this->fields[$name];
    }
    
    /* Returns TRUE if any Field object in the collection contains an error */
    public function hasErrors() {
        foreach ($this->fields as $field) {
            if ($field->hasError()) {
                return TRUE;
            }
        }
        
        return FALSE;
    }
}