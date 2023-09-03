<?php

function getLinesFromFile($filename) {
  if (!$fileHandle = fopen($filename, 'r')) {
    throw new RuntimeException('Couldn\'t open file "' . $filename . '"');
  }

  while (false !== $line = fgets($fileHandle)) {
    yield $line;
  }

  fclose($fileHandle);

}

// versus...
class LineIterator implements Iterator {
  protected $fileHandle;
  protected $line;
  protected $i;

  public function __construct($filename)
  {
    if (!$this->fileHandle = fopen($filename, 'r')) {
      throw new RuntimeException("Couldn't open file $filename");
    }
  }

  public function current(): mixed
  {
    return $this->line;
  }

  public function next(): void
  {
    if (false !== $this->line) {
      $this->line = fgets($this->fileHandle);
      $this->i++;
    }
  }

  public function key(): mixed
  {
    return $this->i;
  }

  public function valid(): bool
  {
    return false !== $this->line;
  }

  public function rewind(): void
  {
    fseek($this->fileHandle, 0);
    $this->line = fgets($this->fileHandle);
    $this->i = 0;
  }

  public function __destruct()
  {
    fclose($this->fileHandle);
  }
}