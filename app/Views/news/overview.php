<div class="container pt-5 pb-5 min-vh-100">
  <div class="overview-header mt-4">
    <h2 class=""><?= esc($title); ?></h2>
    <form class="sort" method="POST" action="" onChange="this.submit()">
      <div class="form-group m-0">
        <select class="form-control" name="sort">
          <option value="" disabled>Sort By</option>
          <?php foreach($sort as $key => $value) :?>
          <option value="<?= esc($value) ?>" <?php 
            if($selected === $value) {
              echo 'selected';
            }
            ?>><?= esc($key) ?></option>
          <?php endforeach; ?>
        </select>

      </div>
    </form>
  </div>
  <div class="row justify-content-around">

    <?php if (! empty($news) && is_array($news)) : ?>

    <?php foreach ($news as $news_item): ?>

    <div class="card card-hover col-lg-3 col-md-5 p-0 m-4 position-relative">
      <img src="<?= esc($news_item['image']); ?>" class="card-img-top" alt="...">
      <div class="card-body">
        <a href="/public/news/<?= esc($news_item['slug'], 'url'); ?>" class="text-decoration-none stretched-link">
          <h5 class="card-title text-dark" style="height: 72px; overflow: hidden;">
            <?= esc(substr($news_item['title'], 0, 55)); ?></h5>
        </a>
        <span class="text-muted mb-2 d-block">Category: <?php 
        foreach($cats as $cat_item) {
          if($cat_item['id'] === $news_item['category_id']) {
            echo $cat_item['title'];
          }
        }
        ?></span>

        <p class="card-text overflow-hidden">
          <?= esc(substr($news_item['text'], 0, 150)); ?>...</p>
      </div>
      <div class="card-footer d-flex justify-content-between">
        <small class="text-muted"><?= esc(date("d.m.Y", strtotime($news_item['pubdate']))); ?></small>
        <small>
          <i class="far fa-eye mr-2 text-muted"></i><span class="text-muted"><?= esc($news_item['views']); ?></span>
        </small>
      </div>
    </div>

    <?php endforeach; ?>

    <?php else : ?>

    <h3>No News</h3>

    <p>Unable to find any news for you.</p>

    <?php endif ?>


  </div>
  <div>

    <?= $pager->links() ?>


  </div>
</div>