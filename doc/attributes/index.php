<?php

interface ActionHandler
{
  public function execute();
}

#[Attribute]
class Setup
{
}

class CopyFile implements ActionHandler
{
  public string $fileName;
  public string $targetDirectory;

  #[Setup]
  public function fileExists(): void
  {
    if (!file_exists($this->fileName)) throw new RuntimeException('File does not exist.');
  }

  #[Setup]
  public function targetDirectoryExists(): void
  {
    if (!file_exists($this->targetDirectory)) {

      mkdir($this->targetDirectory);

    } elseif (!is_dir($this->targetDirectory)) {

      throw new RuntimeException("Target directory $this->targetDirectory is not a directory");

    }
  }

  public function execute(): void
  {
    copy($this->fileName, $this->targetDirectory . '/' . basename($this->fileName));
  }
}

function executeAction(ActionHandler $actionHandler): void
{
  $reflection = new ReflectionObject($actionHandler);

  foreach ($reflection->getMethods() as $method) {

    $attributes = $method->getAttributes(SetUp::class);

    if (count($attributes) > 0) {

      $methodName = $method->getName();

      $actionHandler->$methodName();

    }

  }

  $actionHandler->execute();

}

$copyAction = new CopyFile();
$copyAction->fileName = "/tmp/foo.jpg";
$copyAction->targetDirectory = "/home/user";

executeAction($copyAction);