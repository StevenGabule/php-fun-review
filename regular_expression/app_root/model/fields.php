<?php

class Field
{
  private $name, $message = '', $hasError = false;

  public function __construct($name, $message = '')
  {
    $this->name = $name;
    $this->message = $message;
  }

  public function getName()
  {
    return $this->name;
  }

  public function getMessage()
  {
    return $this->message;
  }

  public function hasError(): bool
  {
    return $this->hasError;
  }

  public function setErrorMessage($message): void
  {
    $this->message = $message;
    $this->hasError = true;
  }

  public function clearErrorMessage(): void
  {
    $this->message = '';
    $this->hasError = false;
  }

  /**
   * @return string
   */
  public function getHTML(): string
  {
    $message = htmlspecialchars($this->message);
    return $this->hasError() ? '<span class="error">' . $message . '</span>' : '<span>' . $message . '</span>';
  }
}

class Fields {
  /**
   * @var array
   */
  private $fields = [];

  /**
   * @param string $name
   * @param string $message
   * @return void
   */
  public function addField(string $name, string $message = ''): void
  {
    $field = new Field($name, $message);
    $this->fields[$field->getName()] = $field;
  }

  /**
   * @param string $name
   * @return mixed
   */
  public function getField(string $name): mixed
  {
    return $this->fields[$name];
  }

  /**
   * @return bool
   */
  public function hasErrors() : bool
  {
    foreach ($this->fields as $field) {
      if($field->hasError()) return true;
    }
    return false;
  }
}