<?php include('header.php') ?>
<main>

  <div class="edit-quote-container">
    <form action="./api/quotes/update.php" method="post">
      <header>
        <h3>Edit Quote</h3>
      </header>
      <input type="hidden" name="id" value="<?php echo $quote->id ?>">
      <div class="edit-form-body">
        <div class="edit-form-section">
          <label for="quote">Quote:</label>
          <textarea type="text" name="quote" id="quote" rows="5"><?php echo $quote->quote ?></textarea>
        </div>
        <div class="edit-form-section">
          <label for="authorId">Author:</label>
          <select name="authorId" id="authorId" >
            <option value="0">Select...</option>
            <?php foreach($authors as $author) : ?>
              <option value="<?php echo $author['id']?>" <?= $quote->authorId == $author['id'] ? ' selected="selected"' : ""; ?>><?php echo $author['author'] ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="edit-form-section">
          <label for="categoryId">Category:</label>
          <select name="categoryId" id="categoryId">
            <option value="0">Select...</option>
            <?php foreach($categories as $category) : ?>
              <option value="<?php echo $category['id'] ?>" <?= $quote->category_id == $category['id'] ? ' selected="selected"' : ""; ?>><?php echo $category['category'] ?></option>
            <?php endforeach ?>
          </select>
        </div>
      </div>
      <div class="form-footer">
        <?php if(isset($error)) { ?>
          <div class="error"><?php echo $error ?></div>
        <?php } ?>
        <button type="submit"><span class="icon-pencil"></span>Update Quote</button>
      </div>
    </form>
  </div>
</main>
<?php include('footer.php') ?>