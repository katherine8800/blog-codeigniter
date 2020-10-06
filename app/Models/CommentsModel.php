<?php
namespace App\Models;
use CodeIgniter\Model;

class CommentsModel extends Model {
  protected $table = 'comments';
  protected $allowedFields = ['author', 'title', 'email', 'text', 'articles_id', 'pubdate'];

  public function getComments($id = false){

    if($id === false) {
      return $this->findAll();
    }
    return $this->where(['articles_id' => $id])->findAll();
  }

}