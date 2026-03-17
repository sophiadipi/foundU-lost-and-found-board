<?php
/*******************************************************************************
 * COMP 3541 Final Project
 * Sophia DiPietro (T00714296)
 * March 10, 2026
 * 
 * FoundU - Model
 * 
 * Validate.php
 * 
 * The Validate class provides input validation methods. It works with the
 * Fields and Field classes to store validation error messages for form fields. 
 * Each validation method checks a value and sets or clears the appropraite 
 * error message for the corresponding Field object. 
 ******************************************************************************/
class Validate {
    private $fields;
    
    /* Creates a Validate object and initializes its Fields collection */
    public function __construct() {
        $this->fields = new Fields();
    }
    
    public function getFields() {
        return $this->fields;
    }
    
    /* Validates a generic text field. If required, the value must not be empty.
     * Must be within the specified min and max length. 
     */
    public function text($name, $value, $required = TRUE, $min = 1, $max = 255) {
        // Get field object
        $field = $this->fields->getField($name);
        
        // If field is not required and empty, remove errors and exit
        if (!$required && empty($value)) {
            $field->clearErrorMessage();
            return;
        }
        
        // Check field and set or clear error message
        if ($required && empty($value)) {
            $field->setErrorMessage('Required.');
        } else if (strlen($value) < $min) {
            $field->setErrorMessage('Too short.');
        } else if (strlen($value) > $max) {
            $field->setErrorMessage('Too long.');
        } else {
            $field->clearErrorMessage();
        }
    }
    
    /* Validates a generic number field. Uses text() validation first to check
     * if the value is required/empty, and then verifies that the value is
     * numeric. 
     */
    public function number($name, $value, $required = TRUE) {
        // Get Field object
        $field = $this->fields->getField($name);
        
        // Call the text method and exit if it yields an error
        $this->text($name, $value, $required);
        if ($field->hasError()) {
            return;
        }
        
        // Validate that the value is numeric
        if (!is_numeric($value)) {
            $field->setErrorMessage('Must be a valid number.');
        } else {
            $field->clearErrorMessage();
        }
    }
    
    /* Validates a field value against a regex. If the value does not match the
     * pattern, the error message is set. 
     */
    public function pattern($name, $value, $pattern, $message, $required = TRUE) {
        // Get Field object
        $field = $this->fields->getField($name);
        
        // If field is not required and empty, remove errors and exit
        if (!$required && empty($value)) {
            $field->clearErrorMessage();
            return;
        }
        
        // Test the value against the regex provided
        $match = preg_match($pattern, $value);
        if ($match === FALSE) {
            $field->setErrorMessage('Error testing field.');
        } else if ($match != 1) {
            $field->setErrorMessage($message);
        } else {
            $field->clearErrorMessage();
        }
    }
    
    /* Validates a phone number using a regular expression. Accepts common 
     * phone number formats like (123) 456-7890, 1234567890, 123-456-7890, etc.
     */
    public function phone ($name, $value, $required = FALSE) {
        $field = $this->fields->getField($name);
        
        // Call the text method and exit if it yield an error
        $this->text($name, $value, $required);
        if ($field->hasError()) {
            return;
        }
        
        // Call the pattern method to validate a phone number
        $pattern = '/^(\([[:digit:]]{3}\)\s?|[[:digit:]]{3}[- ]?)'
                . '[[:digit:]]{3}[- ]?[[:digit:]]{4}$/';
        $message = 'Invalid phone number.';
        $this->pattern($name, $value, $pattern, $message, $required);
    }
    
    /* Validates an email address. Uses text() validation first, and then uses
     * FILTER_VALIDATE_EMAIL to confirm the value is in a valid email format. 
     */
     public function email($name, $value, $required = true) {
        $field = $this->fields->getField($name);
        
        // If field is not required and empty, remove errors and exit
        if (!$required && empty($value)) {
            $field->clearErrorMessage();
            return;
        }
        
        // Call the text method and exit if it yields an error
        $this->text($name, $value, $required);
        if ($field->hasError()) {
            return;
        }
      
        // Validate email is in a valid format
        if (filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
            $field->setErrorMessage('Invalid email address.');
            return;
        } else {
            $field->clearErrorMessage();
        }
    }
    
    /* Validates a date value. Uses text() validation first and then checks
     * that the value is a valid date using strtotime(). */
    public function date($name, $value, $required = true) {
        $field = $this->fields->getField($name);
        
        // If field is not required and empty, remove errors and exit
        if (!$required && empty($value)) {
            $field->clearErrorMessage();
            return;
        }
        
        // Call the text method and exit if it yields an error
        $this->text($name, $value, $required);
        if ($field->hasError()) {
            return;
        }
        
        // Comfirm that the value is a valid date
        $isValidDate = strtotime($value);
        if ($isValidDate === false) {
            $field->setErrorMessage('Invalid date.');
            return;
        }
        
        $field->clearErrorMessage();
    }
    
    public function password ($name, $value, $required = TRUE) {
        $field = $this->fields->getField($name);
        
        // Call the text method and exit if it yield an error
        $this->text($name, $value, $required);
        if ($field->hasError()) {
            return;
        }
        
        // Call the pattern method to validate a password
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z\d]).{8,16}$/';
        $message = 'Invalid password.';
        $this->pattern($name, $value, $pattern, $message, $required);
    }
}
