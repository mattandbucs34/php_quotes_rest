<div class="add-author-container hidden">
  <form action="./api/authors/create.php" method="POST">
    <label for="author">Author:</label>
    <input type="text" name="author" id="author">
    <div class="form-footer">
      <button type="submit"><span class="icon-plus"></span>Add Author</button>
    </div>
    <?php if(isset($error)) { ?>
      <div class="error"><?php echo $error ?></div>
    <?php } ?>
  </form>
</div>