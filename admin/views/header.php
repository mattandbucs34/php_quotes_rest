<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Some Super Fun Quotes</title>
  <link rel="stylesheet" href="../style/icons.css" type="text/css">
  <link rel="stylesheet" href="../style/quotes.css" type="text/css">
  <!-- <script src="./js/quotes.js"></script> -->
</head>
<body>
    <header>
      <h2>Famous Quotes</h2>
      <?php include('page_tabs.php'); ?>
      <div>
        <?php if(isset($message)) { ?>
          <div class="success">
            <p ><?php echo $message ?></p>
          </div>
          <?php } ?>
      </div>
      <div class='header-right'>
        <?php if($action != 'add') { ?>
          <a class="add-quote-btn" href="./?action=add_quote"><span class="icon-plus"></span>Add Quote</a>
        <?php } ?>
        <button class="filter-btn" id="filter-btn">
          <span class="icon-equalizer"></span>
        </button>
      </div>
    </header>