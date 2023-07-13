<?php

namespace Pessoa\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class PessoaForm extends Form
{
  public function __construct($name = null)
  {
    parent::__construct('pessoa');

    $this->add(new Element\Hidden('id'));
    $this->add(new Element\Text('name', ['label' => 'Name']));
    $this->add(new Element\Text('email', ['label' => 'Email']));
    $this->add(new Element\Select('status', [
      'label' => 'Status', 
      'value_options' => [
        'active' => 'active',
        'disabled' => 'disabled'
        ],
      ],
    ));

    $submit = new Element\Submit('submit');
    $submit->setAttributes(['value' => 'Save', 'id' => 'submitbutton']);

    $this->add($submit);
  }
}
