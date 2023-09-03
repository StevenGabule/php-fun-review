<?php

class Validate
{
  private $fields;

  public function __construct()
  {
    $this->fields = new Fields();
  }

  public function getFields(): Fields
  {
    return $this->fields;
  }

  public function text($name, $value, $required = true, $min = 1, $max = 255): void
  {
    // get field object
    $field = $this->fields->getField($name);

    // if field is not required and empty, remove errors and exit
    if (!$required && empty($value)) {
      $field->clearErrorMessage();
      return;
    }

    // check field and set or clear error message
    if ($required && empty($value)) $field->setErrorMessage('Required');
    else if (strlen($value) < $min) $field->setErrorMessage('Too short.');
    else if (strlen($value) > $max) $field->setErrorMessage('Too long.');
    else $field->clearErrorMessage();
  }

  /**
   * Validate a field with a generic pattern
   * @param $name
   * @param $value
   * @param $pattern
   * @param string $message
   * @param bool $required
   * @return void
   */
  public function pattern($name, $value, $pattern, string $message, bool $required = true): void
  {
    // get field object
    $field = $this->fields->getField($name);

    // if failed is not required and empty, remove errors and exit
    if (!$required && empty($value)) {
      $field->clearErrorMessage();
      return;
    }

    // check field and set or clear error message
    $match = preg_match($pattern, $value);
    if ($match === false) $field->setErrorMessage('Error testing field.');
    else if ($match != 1) $field->setErrorMessage($message);
    else $field->clearErrorMessage();
  }

  public function phone($name, $value, $required = false)
  {
    $field = $this->fields->getField($name);

    // call the text method and exit if it yields an error
    $this->text($name, $value, $required);
    if ($field->hasError()) return;

    // Call the pattern method to validate a phone number
    $pattern = '/^[[:digit:]]{3}-[[:digit:]]{3}-[[:digit:]]{4}$/';
    $message = 'Invalid phone number.';
    $this->pattern($name, $value, $pattern, $message, $required);
  }

  public function email($name, $value, $required = true)
  {
    $field = $this->fields->getField($name);

    // if field is not required and empty, remove errors and exit
    if(!$required && empty($value)) {
      $field->clearErrorMessage();
      return;
    }

    // call the text method and exit if it yields an error
    $this->text($name, $value, $required);
    if ($field->hasError()) return;

    // split email address on @ sign and check parts
    $parts = explode('@', $value) ;
    if (count($parts) < 2) {
      $field->setErrorMessage('At sign required.');
      return;
    }

    if(count($parts) > 2) {
      $field->setErrorMessage('Only one at sign allowed.');
      return;
    }

    $local = $parts[0];
    $domain = $parts[1];

    // check lengths of local and domain parts
    if (strlen($local) > 64) {
      $field->setErrorMessage('Username part too long.');
      return;
    }
    if (strlen($domain) > 255) {
      $field->setErrorMessage('Domain name part too long.');
      return;
    }

    // Patterns for address formatted local part
    $atom = '[[:alnum:]_!#$%&\'*+\/=?^`{|}~-]+';
    $dotatom = '(\.' . $atom . ')*';
    $address = '(^' . $atom . $dotatom . '$)';

    // Patterns for quoted text formatted local part
    $char = '([^\\\\"])';
    $esc = '(\\\\[\\\\"])';
    $text = '(' . $char . '|' . $esc . ')+';
    $quoted = '(^"' . $text . '"$)';

    // combined pattern for testing local part
    $localPattern = '/' . $address . '|' . $quoted . '/';

    // call the pattern method and exit if it yields an error
    $this->pattern($name, $local, $localPattern, 'Invalid username part.');
    if ($field->hasError()) return;

    $hostname = '([[:alnum:]]([-[:alnum:]]{0,62}[[:alnum:]])?)';
    $hostnames = '(' . $hostname . '(\.' . $hostname . ')*)';
    $top = '\.[[:alnum:]]{2,6}';
    $domainPattern = '/^' . $hostnames . $top . '$/';

    // Call the pattern method
    $this->pattern($name, $domain, $domainPattern, 'Invalid domain name part.');

  }
}











