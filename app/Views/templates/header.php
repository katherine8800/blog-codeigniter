<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../../public/assets/css/style.css">
  <link rel="shortcut icon" href="../../public/assets/img/favicon.ico" type="image/x-icon">
  <title><?= esc($title); ?></title>
</head>

<body>

  <div class="container fixed-top">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
      <a class="navbar-brand text-uppercase font-weight-bold mr-5" href="/news">Blog</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <?php foreach($cats as $cat_item) :?>
          <li class="nav-item active">
            <a class="nav-link"
              href="/news/category/<?= esc($cat_item['slug']); ?>"><?= esc($cat_item['title']); ?><span
                class="sr-only">(current)</span>
            </a>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
      <a class="navbar-brand text-uppercase font-weight-bold mr-5" href="/news/create"><i
          class="fas fa-plus mr-3"></i>Create</a>

    </nav>
  </div>