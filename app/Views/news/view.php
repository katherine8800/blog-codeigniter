<div class="container pt-5 pb-5 mt-5 mb-5 min-vh-100">
  <h2><?= esc($news['title']); ?></h2>
  <span class="text-muted">Category: <?= esc($cat['title']); ?></span>
  <div class="d-flex justify-content-between">
    <div class="d-flex flex-column mt-3">
      <small class="text-muted"><?= esc(date("d.m.Y", strtotime($news['pubdate']))); ?></small>
      <small>
        <i class="far fa-eye mr-2 text-muted"></i><span class="text-muted"><?= esc($news['views']); ?></span>
      </small>
    </div>
    <div class="d-flex flex-row align-items-center">
      <a href="/news/edit/<?= esc($news['slug']); ?>"
        class="border-0 bg-transparent text-decoration-none text-muted btn-hover btn-hover--edit"><i class="far fa-edit"></i></a>
      <form method="POST" action="" class="btn-hover ">
        <?= csrf_field() ?>
        <button class="border-0 bg-transparent text-muted d-block p-0 w-100 h-100" type="submit" name="delete"
          value="Del"><i class="far fa-trash-alt"></i></button>
      </form>
    </div>

  </div>

  <img src="<?= esc($news['image']); ?>" class="img-fluid d-block mt-5 mb-5" alt="<?php  echo $title; ?>">
  <p class="text-wrap mw-100 d-block"><?= esc($news['text']); ?></p>

  <h3 class="mt-5">Comments</h3>
  <?php if(empty($comments)) {
    echo 'No comments yet.';
  }
  ?>
  <?php foreach($comments as $comment) :?>
  <div class="card mb-3 bg-light">
    <div class="row no-gutters">
      <div class="col-md-2" style="position: relative; overflow: hidden;">
        <img src="https://cdn.onlinewebfonts.com/svg/img_227643.png" class="card-img"
          style="max-width: 80px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); "
          alt="...">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title"><?= esc($comment['author']); ?></h5>
          <p class="card-text"><small
              class="text-muted"><?= esc(date("d.m.Y", strtotime($comment['pubdate']))); ?></small></p>

          <p class="card-text"><?= esc($comment['text']); ?></p>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach; ?>


  <h3 class="mt-5">Leave your comment</h3>
  <form class="mt-2 bg-light p-3" action="" method="POST">
    <?= csrf_field() ?>
    <div class="form-group">
      <label for="exampleFormControlInput1">Name</label>
      <input type="text" class="form-control" id="exampleFormControlInput1" name="author" placeholder="Your name"
        required>
    </div>
    <div class="form-group">
      <label for="exampleFormControlInput1">Email</label>
      <input type="email" class="form-control" id="exampleFormControlInput1" name="email" placeholder="Your email"
        required>
    </div>
    <div class="form-group">
      <label for="exampleFormControlTextarea1">Comment</label>
      <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" name="text" placeholder="Your comment"
        required></textarea>
    </div>

    <input class="btn btn-primary mt-4 " type="submit" name="addcomment" value="Add comment">
  </form>
</div>