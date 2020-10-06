<div class="container pt-3 mt-5 mb-5 min-vh-100">
  <h1 class="mt-4"><?php echo $title; ?></h1>
  <?php \Config\Services::validation()->listErrors() ?>
  <form class="mt-4" action="" method="POST">
    <?= csrf_field() ?>
    <div class="form-group">
      <label for="exampleFormControlInput1">Title</label>
      <input type="text" class="form-control" id="exampleFormControlInput1" name="title" placeholder="Title"
        value="<?= esc($news['title']); ?>" required>
    </div>
    <div class="form-group">
      <label for="exampleFormControlInput1">Image link</label>
      <input type="text" class="form-control" id="exampleFormControlInput1" name="image" placeholder="Image link"
        value="<?= esc($news['image']); ?>" required>
    </div>
    <div class="form-group">
      <label for="exampleFormControlTextarea1">Text</label>
      <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" name="text" placeholder="Text"
        required><?= esc($news['text']); ?></textarea>
    </div>
    <div class="form-group">
      <label for="category">Choose the category</label>
      <select class="form-control" name="category">
        <?php foreach($cats as $cats_item) :?>
        <option value="<?= esc($cats_item['id']); ?>" <?php 
          if($cats_item['id'] === $news['category_id']) {
            echo 'selected';
          }
          ?>><?= esc($cats_item['title']); ?></option>
        <?php endforeach; ?>

      </select>
    </div>
    <div class="form-group">
      <label for="exampleFormControlInput1">Time of publication</label>
      <input type="datetime-local" class="form-control" id="exampleFormControlInput1" name="date" placeholder="Title"
        value="<?= date("Y-m-d\TH:i", strtotime($news['pubdate'])); ?>">
    </div>

    <input class="btn btn-primary mt-4 mb-4" type="submit" name="edit" value="Save changes">
  </form>
</div>