<?php

namespace Pessoa\Model;

use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\StringLength;
use Zend\Validator\Uuid;
use Zend\Validator\EmailAddress;
use DomainException;


class Pessoa  implements InputFilterAwareInterface
{
  public $id;
  public $name;
  public $email;
  public $status;
  public $created_at;
  public $updated_at;
  private $inputFilter;

  public function exchangeArray(array $data) 
  {
    $this->id = !empty($data['id']) ? $data['id'] : null;
    $this->name = !empty($data['name']) ? $data['name'] : null;
    $this->email = !empty($data['email']) ? $data['email'] : null;
    $this->status = !empty($data['status']) ? $data['status'] : null;
    $this->created_at = !empty($data['created_at']) ? $data['created_at'] : null;
    $this->updated_at = !empty($data['updated_at']) ? $data['updated_at'] : null;
  }

  public function getArrayCopy()
  {
    return [
      'id' => $this->id,
      'name' => $this->name,
      'email' => $this->email,
      'status' => $this->status,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
    ];
  }

  public function setInputFilter(InputFilterInterface $inputFilter)
  {
    throw new DomainException(sprintf(
      '%s does not allow injection of an alternate input filter',
       __CLASS__
    ));
  }

  public function getInputFilter()
  {
    if ($this->inputFilter) {
      return $this->inputFilter;
    }

    $inputFilter = new InputFilter();

    $inputFilter->add([
      'name' => 'id',
      'required' => true,
      'filters' => [
        ['name' => StripTags::class],
        ['name' => StringTrim::class],
      ],
    ]);

    $inputFilter->add([
      'name' => 'name',
      'required' => true,
      'filters' => [
        ['name' => StripTags::class],
        ['name' => StringTrim::class],
      ],
      'validators' => [
        [
          'name' => StringLength::class,
          'options' => [
            'min' => 1,
            'max' => 255,
            ],
          ],
      ],
    ]);

    $inputFilter->add([
      'name' => 'email',
      'required' => true,
      'filters' => [
        ['name' => StripTags::class],
        ['name' => StringTrim::class],
      ],
      'validators' => [
        [
          'name' => EmailAddress::class,
        ],
      ],
    ]);
    
    $inputFilter->add([
      'name' => 'status',
      'required' => true,
      'filters' => [
        ['name' => StripTags::class],
        ['name' => StringTrim::class],
      ],
      'validators' => [
        [
          'name' => StringLength::class,
          'options' => [
            'min' => 1,
            'max' =>  36,
          ],
        ],
      ],
    ]);

    $this->inputFilter = $inputFilter;
    return $this->inputFilter;
  }

  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    $this->id = $id;
  }

  public function getName()
  {
    return $this->name;
  }

  public function setName($name)
  {
    $this->name = $name;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function setEmail($email)
  {
    $this->email = $email;
  }

  public function getStatus()
  {
    return $this->status;
  }

  public function setStatus($staus)
  {
    $this->status = $status;
  }

  public function getCreatedAt()
  {
    return $this->created_at;
  }

  public function setCreatedAt($created_at)
  {
    $this->created_at = $created_at;
  }

  public function getUpdatedAt()
  {
    return $this->updated_at;
  }

  public function setUpdatedAt($updated_at)
  {
    $this->updated_at = $updated_at;
  }


}
