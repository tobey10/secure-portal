<?php include('file.php') ?>
<!DOCTYPE html>
<html>

<head>
    <title>Home Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles2.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
</head>

<body>
    <div class="navigation">
        <div class="navigation-logo">
            <p class="navigation-logo-body">Secure Portal</p>
        </div>
        <div class="nav">
            <div class="nav">
                <ul class="nav-list">
                <li class="nav-items">
                        <a href="./home.php">home</a>
                    </li>
                    <li class="nav-items">
                        <a href="./view.php">uploaded documents</a>
                    </li>
                    <li class="nav-items">
                        <a href="./share.php">share</a>
                    </li>
                    <li class="nav-items">
                        <a href="./shared_document.php">shared documents</a>
                    </li>
                    <li class="nav-items">
                        <p style="margin:0;text-transform: lowercase;">Hello, <?php echo $_SESSION['email']?></p>
                    </li>
                    <a  class="logout-button" href="logout.php">
                        logout
                    </a>
                </ul>
            </div>
        </div>
    </div>
    <div class="container" style="margin-top: 58px;">
        <p>Uploaded Document</p>
        <table class="table">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Decription</th>
                    <th>Size</th>
                    <th>Type</th>
                    <th>Shared</th>
                    <th>Created</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($r = mysqli_fetch_assoc($resultDocuments)) { ?>
                    <tr>
                        <th scope="row"><?php echo $r['id'] ?></th>
                        <td><?php echo $r['name'] ?></td>
                        <td><?php echo $r['description'] ?></td>
                        <td><?php echo $r['size'] ?></td>
                        <td><?php echo $r['type'] ?></td>
                        <td><?php echo $r['shared'] ?></td>
                        <td><?php echo $r['created_at'] ?></td>
                        <td>
                            <a href="#" onclick="DeleteFile(<?php echo $r['id'] ?>)">
                                delete
                            </a>
                            <!-- <a href="#" onclick="VeleteFile(<?php echo $r['id'] ?>)">
                                view
                            </a> -->
                            <a href="<?php echo $r['location'].$r['name']  ?>" target="_blank">
                                view
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <script>
        function DeleteFile(id) {
            if (confirm("Are you sure? ")) {
                window.location.href = 'delete.php?id=' + id;
            }
            return false;
        }
        function VeleteFile(id) {
            window.location.href = 'fileDetail.php?id=' + id;
        }
    </script>
</body>

</html>