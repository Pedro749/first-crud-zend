<?php

namespace Pessoa\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Pessoa\Model\PessoaTable;
use Pessoa\Form\PessoaForm;
use Pessoa\Form\Pessoa;

class PessoaController extends AbstractActionController
{
  private $table;

  public function __construct(PessoaTable $table)
  {
    $this->table = $table;
  }

  public function indexAction()
  {
    $data = $this->table->getAll();
    return new ViewModel(['pessoas' => $data]);
  }

  public function addAction()
  {
    $form = new PessoaForm();
    $form->get('submit')->setValue('Add');

    $request = $this->getRequest();

    if (!$request->isPost()) {
      return new ViewModel(['form' => $form]);
    }

    $pessoa = new \Pessoa\Model\Pessoa();
    $form->setData($request->getPost());

    if (!$form->isValid()) {
      return new ViewModel(['form' => $form]);
    }

    $pessoa->exchangeArray($form->getData());
    $this->table->addPessoa($pessoa);
        
    return $this->redirect()->toRoute('pessoa');
  }

  public function editAction()
  {
    $id = $this->params()->fromRoute('id');
    $request = $this->getRequest();

    if (empty($id) && !$request->isPost()) {
      return $this->redirect()->toRoute('album', ['action' => 'index']);
    }
    
    try {
      if ($request->isPost()) {
        $id = $request->getPost()->id;
      }

      $pessoa = $this->table->getPessoa($id);
    } catch (\Exception $error) {
        return $this->redirect()->toRoute('pessoa', ['action' => 'index']);
    }

    $form = new PessoaForm();
    $form->bind($pessoa);
    
    $form->get('submit')->setAttribute('value', 'Edit');

    $viewData = ['id' => $id, 'form' => $form];

    if (!$request->isPost()) {
      return $viewData;
    }

    $pessoa = new \Pessoa\Model\Pessoa();
    $pessoa->exchangeArray((array) $request->getPost());

    $form->setInputFilter($pessoa->getInputFilter());
    $form->setData($request->getPost());

    if (!$form->isValid()) {
      return $viewData;
    }

    $this->table->updatePessoa($pessoa);
    return $this->redirect()->toRoute('pessoa', ['action' => 'index']);
  }

  public function deleteAction()
  {
    $id = $this->params()->fromRoute('id');

    if (empty($id)) {
      return $this->redirect()->toRoute('pessoa', ['action' => 'index']);
    }

    $request = $this->getRequest();

    if ($request->isPost()) {
      $del = $request->getPost('del', 'No');

      if ($del == 'Yes') {
        $id = $request->getPost('id');
        $this->table->deletePessoa($id);
      }

      return $this->redirect()->toRoute('pessoa');
    }

    return [
      'id'    => $id,
      'pessoa' => $this->table->getPessoa($id),
   ];
  }
}
