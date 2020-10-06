<?php
namespace App\Models;
use CodeIgniter\Model;

class CategoriesModel extends Model {
  protected $table = 'categories';

  public function getCategory($id = false){

    if($id === false) {
      return $this->findAll();
    }
    return $this->asArray()->where(['id' => $id])->first();
  }

  public function getCategoryId($slug = false) {

    if($slug === false) {
      return $this->findAll();
    }

    return $this->asArray()->where(['slug' => $slug])->first();

  }
}