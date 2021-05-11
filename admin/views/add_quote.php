<?php include('header.php') ?>
<main>
  <div class="add-quote-container">
    <form action="./api/quotes/create.php" method="post">
      <header>
        <h3>Add New Quote</h3>
      </header>
      
      <div class='quote'>
        <label for="quote">Quote:</label>
        <textarea type="text" name="quote" id="quote" rows="5" ><?php if(isset($quote->quote)) echo $quote->quote; ?></textarea>
      </div>
      <div class="author-select-container">
        <label for="authorId">Author:</label>
        <select name="authorId" id="authorId">
          <option value="0">Select...</option>
          <?php foreach($authors as $author) : ?>
            <option value="<?php echo $author['id'] ?>"><?php echo $author['author'] ?></option>
          <?php endforeach ?>
        </select>
        <div>
          <p>Need a new author?</p>
          <a href="./?action=add_author">Click Here</a>
        </div>
      </div>
      <div class="category-select-container">
        <label for="categoryId">Category:</label>
        <select name="categoryId" id="categoryId">
          <option value="0">Select...</option>
          <?php foreach($categories as $category) : ?>
            <option value="<?php echo $category['id'] ?>"><?php echo $category['category'] ?></option>
          <?php endforeach ?>
        </select>
        <div>
          <p>Need a new category?</p>
          <a href="./?action=add_category">Click Here</a>
        </div>
      </div>
      <div class="form-footer">
        <?php if(isset($error)) { ?>
          <div class="error">
            <p><?php echo $error ?></p>
          </div>
        <?php }?>
        <button><span class="icon-plus"></span>Add</button>
      </div>
    </form>
  </div>
</main>
<?php include('footer.php') ?>