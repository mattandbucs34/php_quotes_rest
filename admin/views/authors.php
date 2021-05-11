<?php include('header.php'); ?>
<main>
  <div class='authors'>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Author</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($authors as $author) : ?>
          <tr>
            <td><?php echo $author['id'] ?></td>
            <td><?php echo $author['author'] ?></td>
            <td class="button-cell">
              <a href=<?php echo "./?action=edit_author&id=" . $author['id'] ?>><span class="icon-pencil"></span></a>
            </td>
            <td class="button-cell">
              <a href=<?php echo "./?action=delete_author&id=" . $author['id'] ?>><span class="icon-bin"></span></a>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
    <button class="add-author-btn"><span class="icon-plus"></span>Add Author</button>
    <?php include('add_author.php'); ?>
  </div>
</main>
<?php include('footer.php'); ?>