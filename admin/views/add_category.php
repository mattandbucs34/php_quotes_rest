<div class="add-category-container hidden">
  <form action="./api/categories/create.php" method="POST">
    <label for="category">Category:</label>
    <input type="text" name="category" id="category">
    <div class="form-footer">
      <button type="submit"><span class="icon-plus"></span>Add Category</button>
    </div>
    <?php if(isset($error)) { ?>
      <div class="error"><?php echo $error ?></div>
    <?php } ?>
  </form>
</div>