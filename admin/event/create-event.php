<?php 
    $file_dir = '../../';
    include $file_dir.'inc/config.inc.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Event <?php echo $site; ?></title>

    <?php include $file_dir.'inc/header.layout.php'; ?>
</head>
<body>
    <header class="header_four">
    <?php include $file_dir.'inc/admin_nav.layout.php'; ?>
    </header>

    <section class="new_event">
        <div class="container">
            <div class="row">
            <div class="form-group col-12 col-lg-4">
                <label for="id">Event ID:</label>
                <input type="text"  class="form-control" name="" id="id">
            </div>
            <div class="form-group col-12 col-lg-8">
                <label for="title">Event Title:</label>
                <input type="text"  class="form-control" name="" id="title">
            </div>
            <div class="form-group col-12">
                <label for="desc">Event Description:</label>
                <textarea  class="form-control" name="" id="desc" cols="30" rows="10"></textarea>
            </div>
            <div class="form-group col-12 col-lg-4">
                <label for="date">Event Date:</label>
                <input type="text"  class="form-control" name="" id="date">
            </div>
            <div class="form-group col-12 col-lg-4">
                <label for="time">Event Time:</label>
                <input type="text"  class="form-control" name="" id="time">
            </div>
            <div class="form-group col-12 col-lg-4">
                <label for="price">Event Price:</label>
                <input type="text"  class="form-control" name="" id="price">
            </div>
            <div class="form-group col-12">
                <label for="loc">Event Location:</label>
                <textarea  class="form-control" name="" id="loc" cols="30" rows="5"></textarea>
            </div>
            </div>
        </div>
    </section>

    <?php include $file_dir.'inc/footer.layout.php'; ?>
    <?php include $file_dir.'inc/scripts.layout.php'; ?>
</body>
</html>