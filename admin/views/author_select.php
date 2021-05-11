<div class="author-select-container hidden">
  <label for="authorId">Author:</label>
  <select name="authorId" id="authorId">
    <option value="0">Select...</option>
    <?php foreach($authors as $author) : ?>
      <option value="<?php echo $author['id'] ?>"><?php echo $author['author'] ?></option>
    <?php endforeach ?>
  </select>
</div>