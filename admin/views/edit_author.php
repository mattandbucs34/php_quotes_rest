<?php include('header.php') ?>
<main>
  <div class="edit-author-container">
    <form action="./api/authors/update.php" method="POST">
      <header>
        <h3>Edit Author</h3>
      </header>
      <div class="edit-form-body">
        <div class="edit-form-section">
          <label for="author">Author:</label>
          <input type="hidden" name="id" value="<?php echo $author->id ?>">
          <input type="text" name="author" id="author" value="<?php echo $author->author ?>">
        </div>
      </div>
      <div class="form-footer">
        <button type="submit"><span class="icon-pencil"></span>Update Author</button>
      </div>
      <?php if(isset($error)) { ?>
        <div class="error"><?php echo $error ?></div>
      <?php } ?>
    </form>
  </div>
</main>
<?php include('footer.php') ?>