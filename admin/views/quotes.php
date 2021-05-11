<?php include('header.php'); ?>
  <main>
  <?php include('filter_select.php'); ?>
  <div class="quotes">
    <table class="quote-table">
      <thead>
        <tr>
          <th>Author</th>
          <th>Quote</th>
          <th>Category</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($quotes as $quote) : ?>
          <tr class="quote-row">
            <td class="author-cell"><?php echo $quote['author']; ?></td>
            <td class="quote-cell"><?php echo $quote['quote']; ?></td>
            <td class="category-cell"><?php echo $quote['category_name'] ?></td>
            <td class="button-cell">
              <a href="<?php echo "./?action=edit_quote&id=" . $quote['id'] ?>"><span class="icon-pencil"></span></a>
            </td>
            <td class="button-cell">
              <a href="<?php echo "./?action=delete_quote&id=" . $quote['id'] ?>"><span class="icon-bin"></span></a>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>

  </main>

<?php include('footer.php'); ?>