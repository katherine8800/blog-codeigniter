<?php
namespace App\Models;
use CodeIgniter\Model;

class NewsModel extends Model {
  protected $table = 'news';
  protected $allowedFields = ['title', 'slug', 'image', 'text', 'category_id', 'pubdate', 'views', 'sort'];

  public function getNews($orderBy = false) {

    if ($orderBy === null) {
    return $this->orderBy('pubdate', 'DESC');
    }

    if($orderBy === false) {
    return $this->asArray()->findAll();
      
    }
    
    if($orderBy === 'title') {
    return $this->orderBy($orderBy, 'ASC');

    } else {
    return $this->orderBy($orderBy, 'DESC');
    }
      return $this->asArray()->where(['slug' => $slug])->first();
  }

  public function getArticle($slug = false) {
    return $this->asArray()->where(['slug' => $slug])->first();
  }

  public function getNewsByCategory($cat_id, $orderBy) {
    
    if($orderBy === 'title') {
      return $this->where('category_id', $cat_id)->orderBy($orderBy, 'ASC');
  
      } else {
      return $this->where('category_id', $cat_id)->orderBy($orderBy, 'DESC');
    }
  }

  public function deleteArticle($id) {
    return $this->where('id', $id)->delete();
  }

  public function updateArticle($id, $data) {

    return $this->set($data)->where('id', $id)->update();
    
  }

}