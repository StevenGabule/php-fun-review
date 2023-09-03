<?php

declare(strict_types=1);

#[Attribute(Attribute::TARGET_CLASS_CONSTANT | Attribute::TARGET_PROPERTY)]
class JsonSerialize
{
  public function __construct(public ?string $fieldName = null) {}
}

class VersionedObject
{
  #[JsonSerialize]
  public const version = '0.0.1';
}

class UserLand extends VersionedObject {
  protected string $notSerialized = 'nope';

  #[JsonSerialize('foobar')]
  public string $myValue = '';

  #[JsonSerialize('companyName')]
  public string $company = '';

  #[JsonSerialize('UserLand')]
  protected ?UserLand $test;

  public function __construct(?UserLand $userLand = null)
  {
    $this->test = $userLand;
  }
}

class AttributeBasedJsonSerializer {
  protected const ATTRIBUTE_NAME = 'JsonSerialize';

  /**
   * @throws JsonException
   */
  public function serialize($object): false|string
  {
    $data = $this->extract($object);
    return json_encode($data, JSON_THROW_ON_ERROR);
  }

  public function reflectProperties(array $data, ReflectionClass $reflectionClass, object $object): array
  {
    $reflectionProperties = $reflectionClass->getProperties();
    foreach ($reflectionProperties as $reflectionProperty) {
      $attributes = $reflectionProperty->getAttributes(static::ATTRIBUTE_NAME);
      foreach ($attributes as $attribute) {
        $instance = $attribute->newInstance();
        $name = $instance->fieldName ?? $reflectionProperty->getName();
        $value = $reflectionProperty->getValue($object);
        if (is_object($value)) {
          $value= $this->extract($value);
        }
        $data[$name] = $value;
      }
    }
    return $data;
  }

  public function reflectConstants(array $data, ReflectionClass $reflectionClass): array
  {
    $reflectionConstants = $reflectionClass->getReflectionConstants();
    foreach ($reflectionConstants as $reflectionConstant) {
      $attributes = $reflectionConstant->getAttributes(static::ATTRIBUTE_NAME);
      foreach ($attributes as $attribute) {
        $instance = $attribute->newInstance();
        $name = $instance->fieldName ?? $reflectionConstant->getName();
        $value = $reflectionConstant->getValue();
        if (is_object($value)) {
          $value= $this->extract($value);
        }
        $data[$name] = $value;
      }
    }
    return $data;
  }

  public function extract(object $obj): array
  {
    $data = [];
    $reflectionClass = new ReflectionClass($obj);
    $data = $this->reflectProperties($data, $reflectionClass, $obj);
    return $this->reflectConstants($data, $reflectionClass);
  }
}

$userLandClass = new UserLand();
$userLandClass->company = 'some company name';
$userLandClass->myValue = 'my value';

$userLandClass2 = new UserLand($userLandClass);
$userLandClass2->company = 'second';
$userLandClass2->myValue = 'my second value';

$serializer = new AttributeBasedJsonSerializer();

try {
  $json = $serializer->serialize($userLandClass2);
  print_r(json_decode($json, true));
} catch (JsonException $e) {
  print $e->getMessage();
}

