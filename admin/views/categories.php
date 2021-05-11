<?php include('header.php'); ?>
<main>
  <div class='categories'>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Category</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($categories as $category) : ?>
          <tr>
            <td><?php echo $category['id'] ?></td>
            <td><?php echo $category['category'] ?></td>
            <td class="button-cell">
              <a href="<?php echo "./?action=edit_category&id=" . $category['id'] ?>"><span class="icon-pencil"></span></a>
            </td>
            <td class="button-cell">
              <a href=<?php echo "./?action=delete_category&id=" . $category['id'] ?>><span class="icon-bin"></span></a>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
    <button class="add-category-btn"><span class="icon-plus"></span>Add Category</button>
    <?php include('add_category.php'); ?>
  </div>
</main>
<?php include('footer.php'); ?>