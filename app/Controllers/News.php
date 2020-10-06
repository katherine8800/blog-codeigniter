<?php 
namespace App\Controllers;

use App\Models\NewsModel;
use App\Models\CategoriesModel;
use App\Models\CommentsModel;
use CodeIgniter\Controller;

class News extends Controller {
  public function __construct(){
    $this->model = new NewsModel;
    $this->cat_model = new CategoriesModel;
    $this->comments = new CommentsModel;
  }

  public function index(){
    $pager = \Config\Services::pager();
    
    $order = null;
    $order = $this->request->getPost('sort');
    
    $data = [
      'title' => 'News archive',
      'cats' => $this->cat_model->getCategory()
    ];
    
    $newModel = $this->model->getNews($order);

    $data['news'] = $newModel->paginate(6);
    $data['pager'] = $newModel->pager;
    
    $data['selected'] = $order;

    $data['sort'] = [
      'Publication date' => 'pubdate',
      'Views' => 'views',
      'Title' => 'title'
    ];

    echo view('templates/header', $data);
    echo view('news/overview', $data);
    echo view('templates/footer', $data);
  }

  public function viewByCat($slug = null) {
    $pager = \Config\Services::pager();
    
    $data['selected'] = 'pubdate';

    if($this->request->getMethod() === 'post') {
      $data['selected'] = $this->request->getPost('sort');
    }
    
    $data['cats'] = $this->cat_model->getCategory();

    $data['cat_name'] = $this->cat_model->getCategoryId($slug);
    $data['title'] = $data['cat_name']['title'];

    $newModel = $this->model->getNewsByCategory($data['cat_name']['id'], $data['selected']);

    $data['news'] = $newModel->paginate(6);
    $data['pager'] = $newModel->pager;
    $data['sort'] = [
      'Publication date' => 'pubdate',
      'Views' => 'views',
      'Title' => 'title'
    ];

    echo view('templates/header', $data);
    echo view('news/overview', $data);
    echo view('templates/footer', $data);
  }

  public function view($slug = null) {
    $data['news'] = $this->model->getArticle($slug);

    $data['cats'] = $this->cat_model->getCategory();

    $data['comments'] = $this->comments->getComments($data['news']['id']);

    if(empty($data['news'])) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the news item: '. $slug);
    }

    $data['cat'] = $this->cat_model->getCategory($data['news']['category_id']);
    $data['title'] = $data['news']['title'];

    $newData = [
      'views' => $data['news']['views'] + 1
    ];
    
    $this->model->updateArticle($data['news']['id'], $newData);
    
    if($this->request->getMethod() === 'post' && $this->request->getPost('delete')) {
      $this->model->deleteArticle($data['news']['id']);
      
      echo view('templates/header',  $data);
      echo view('news/deleted', $data);
      echo view('templates/footer', $data);
      
    } else {
      
      echo view('templates/header', $data);
      echo view('news/view', $data);
      echo view('templates/footer', $data);
    }

    if($this->request->getMethod() === 'post' && $this->request->getPost('addcomment') && $this->validate([
      'author' => 'required|min_length[3]|max_length[100]',
      'email' => 'required',
      'text'  => 'required'
    ])) {

      $this->comments->save([
        'author' => $this->request->getPost('author'),
        'email' => $this->request->getPost('email'),
        'text' => $this->request->getPost('text'),
        'articles_id' => $data['news']['id'],
        'pubdate' => date('Y-m-d\TH:i')
      ]);
      echo "<meta http-equiv='refresh' content='0'>";
    } 
  }

  public function edit($slug = false){

    $data['cats'] = $this->cat_model->getCategory();
    $data['title'] = 'Edit the article';
    $data['news'] = $this->model->getArticle($slug);
    $data['currentSlug'] = $slug;
    $data['action'] = 'updated';


    if($this->request->getMethod() === 'post' && $this->request->getPost('edit') && $this->validate([
      'title' => 'required|min_length[3]|max_length[255]',
      'image' => 'required',
      'text'  => 'required',
      'category'  => 'required',
      'date'  => 'required'
      ])) {

        $newData = [
        'title' => $this->request->getPost('title'),
        'image' => $this->request->getPost('image'),
        'text' => $this->request->getPost('text'),
        'category_id' => $this->request->getPost('category'),
        'pubdate' => $this->request->getPost('date')
      ];

      $this->model->updateArticle($data['news']['id'], $newData);

      echo view('templates/header',  $data);
      echo view('news/success', $data);
      echo view('templates/footer', $data);
      
    } else {
      echo view('templates/header', $data);
      echo view('news/edit', $data);
      echo view('templates/footer', $data);
    }
    
  }


  public function create(){
    $data['cats'] = $this->cat_model->getCategory();
    $data['title'] = 'Create a new article';
    $data['news'] = $this->model->getNews();
    $data['action'] = 'created';
    
    if($this->request->getMethod() === 'post' && $this->validate([
      'title' => 'required|min_length[3]|max_length[255]',
      'image' => 'required',
      'text'  => 'required',
      'category'  => 'required',
      'date'  => 'required'
      ])) {
        $data['currentSlug'] = url_title($this->request->getPost('title'), '-', TRUE);
        
        foreach ($data['news'] as $news_item) {
          if ($news_item['slug'] === $data['currentSlug']) {
            $data['currentSlug'] = $data['currentSlug'] . '-' . $news_item['id'];
          } else {
            $data['currentSlug'] = $data['currentSlug'];
          }
        }

        $this->model->save([
        'title' => $this->request->getPost('title'),
        'slug'  => $data['currentSlug'],
        'image' => $this->request->getPost('image'),
        'text' => $this->request->getPost('text'),
        'category_id' => $this->request->getPost('category'),
        'pubdate' => $this->request->getPost('date')
      ]);
      
      echo view('templates/header',  $data);
      echo view('news/success', $data);
      echo view('templates/footer', $data);
      
    } else
    {
        echo view('templates/header',  $data);
        echo view('news/create', $data);
        echo view('templates/footer', $data);
    }
  }

}