<form action="./api/quotes" method="GET">
  <div class='filter-select-container hidden'>
    <?php include('author_select.php'); ?>
    <?php include('category_select.php'); ?>
    <div class="filter-input-container hidden">
      <label for="limit">Limit:</label>
      <input type="number" min="1" name="limit" id="limit" >
    </div>
    <label for="filter-selection">Filter By:</label>
    <select class="filter-selection" name="filter-selection" id="filter-selection" >
      <option value="0">Select...</option>
      <option value="1">Author</option>
      <option value="2">Category</option>
      <option value="3">Author and Category</option>
    </select>
    <button class="filter-submit" type="submit">Filter</button>
  </div>
</form>