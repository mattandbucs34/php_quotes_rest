<div class="category-select-container hidden">
  <label for="categoryId">Category:</label>
  <select name="categoryId" id="categoryId">
    <option value="0">Select...</option>
    <?php foreach($categories as $category) : ?>
      <option value="<?php echo $category['id'] ?>"><?php echo $category['category'] ?></option>
    <?php endforeach ?>
  </select>
</div>