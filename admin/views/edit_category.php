<?php include('header.php') ?>
<main>
  <div class="edit-category-container">
    <form action="./api/categories/update.php" method="POST">
      <header>
        <h3>Edit Category</h3>
      </header>
      <div class="edit-form-body">
        <div class="edit-form-section">
          <label for="category">Category:</label>
          <input type="hidden" name="id" value="<?php echo $category->category_id ?>">
          <input type="text" name="category" id="category" value="<?php echo $category->category_name ?>">
        </div>
      </div>
      <div class="form-footer">
        <button type="submit"><span class="icon-pencil"></span>Update Category</button>
      </div>
      <?php if(isset($error)) { ?>
        <div class="error"><?php echo $error ?></div>
      <?php } ?>
    </form>
  </div>
</main>
<?php include('footer.php') ?>