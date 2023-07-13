<?php

namespace Pessoa\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;
use Ramsey\Uuid\Uuid;

class PessoaTable
{
  private $tableGateway;

  public function __construct(TableGatewayInterface $tableGateway)
  {
    $this->tableGateway = $tableGateway;
  }

  public function getAll()
  {
    return $this->tableGateway->select();
  }

  public function getPessoa(string $id)
  {
    $rowset = $this->tableGateway->select(['id' => $id]);
    $row = $rowset->current();

    if (!$row) {
      throw new RuntimeException(sprintf(
        'Could not find row with identifier %d', $id
      ));
    }

    return $row;
  }

  public function addPessoa(Pessoa $pessoa)
  {
    $uuid = Uuid::uuid4();

    $data = [
      'id' => $uuid->toString(),
      'name' => $pessoa->name,
      'email' => $pessoa->email,
      'status' => $pessoa->status,
      'created_at' => date('Y-m-d H:i:s')
    ];

    $this->tableGateway->insert($data);
  }

  public function updatePessoa(Pessoa $pessoa)
  {
    if (empty($pessoa->id)) return;

    $data = [
      'name' => $pessoa->name,
      'email' => $pessoa->email,
      'status' => $pessoa->status,
      'updated_at' => date('Y-m-d H:i:s')
    ];

    try {
      $this->getPessoa($pessoa->id);
    } catch (RuntimeException $error) {
      throw new RuntimeException(sprintf(
          'Cannot update pessoa with identifier %d; does not exist',
          $error
      ));
    }

    $this->tableGateway->update($data, ['id' => $pessoa->id]);
  }

  public function deletePessoa(string $id)
  {
    try {
      $this->getPessoa($id);
    } catch (RuntimeException $error) {
      throw new RuntimeException(sprintf(
          'Cannot update pessoa with identifier %d; does not exist',
          $error
      ));
    }

    $this->tableGateway->delete(['id' => $id]);
  }
}
