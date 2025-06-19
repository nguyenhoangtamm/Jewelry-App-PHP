<?php
    include "connect.php";
    $sql = "SELECT * FROM author";
    $result = mysqli_query($conn, $sql);
    $pageRow = $result->num_rows;
    $numPage = ceil($pageRow/5);
    if(isset($_GET["page"])){
        $page = $_GET["page"];
    }else{
        $page = 1;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Author</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../css/styleadmin.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="data:;base64,iVBORw0KGgo=">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
</head>
<body>
    <div class="sidebar">
        <ul class="menu">
            <li>
                <a href="./trangchu.php">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="./quanlysach.php">
                    <i class="fa-solid fa-book"></i>
                    <span>Books</span>
                </a>
            </li>
            <li>
                <a href="./quanlykhachhang.php">
                    <i class="fa-solid fa-user"></i>
                    <span>Customers</span>
                </a>
            </li>
            <li>
                <a href="./quanlyhoadon.php">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                    <span>Orders</span>
                </a>
            </li>
            <li class="active">
                <a href="./quanlytacgia.php">
                    <i class="fa-solid fa-feather"></i>
                    <span>Author</span>
                </a>
            </li>
            <li>
                <a href="./quanlytheloai.php">
                    <i class="fa-solid fa-rectangle-list"></i>
                    <span>Category</span>
                </a>
            </li>
            <li class="logout">
                <a href="../user/login-signup.php">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="main-content">
        <div class="header-wrapper">
                <div class="header-title">
                    <h2>Authors Managerment</h2>
                </div>
                <div class="user-info">
                    <img src="../images_web/avatar.png" alt="avatar">
                </div>
            </div>
            <div class="table-wrapper">
                <div class="table-header">
                    <h3 class="main-title">
                        Authors Information
                    </h3>
                    <div class="add-book add-author js-add-author"><i class="fa-solid fa-plus icon-add"></i>Add Author</div>
                </div>
                <div class="table-container" name="author-table">
                    <table id="author-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include "connect.php";
                                if($page==""){
                                    $currentData = 0;
                                }
                                else{
                                    $currentData = ($page-1)*5;
                                }
                                $sql = "SELECT * FROM author LIMIT " . $currentData . ", 5";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_array($result)) {
                                    $id_author = $row['id_author'];
                                    $name_author = $row['name_author'];
                                ?>
                                    <tr>
                                        <td class="author-id"><?php echo $row['id_author'] ?></td>
                                        <td class="author-name"><?php echo $row['name_author'] ?></td>
                                        <td>
                                            <a href="quanlytacgia.php?page=<?php echo $page . "&idchangeauthor=" . $row['id_author'] . "&formchangeauthor=1"?>" class="fa-solid fa-pen icon-change js-changeAuthor"></a>
                                            <a href="quanlytacgia.php?page=<?php echo $page . "&iddelauthor=" . $row['id_author'] . "&formdelauthor=1"?>" class="fas fa-trash icon-delete js-delete-author"></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                        </tbody>
                    </table>
                    <div class="pagination">
                        <a href="quanlytacgia.php?page=<?php echo (($page -1)>0) ? ($page-1) : 1?>" class="prev">Prev</a>
                        <?php
                            for($i=0; $i<$numPage; $i++){
                            ?>
                                <a href="quanlytacgia.php?page=<?php echo ($i+1)?>" class="<?php echo ($page==$i+1) ? "page-current" : ""?>"> <?php echo ($i+1)?> </a>
                            <?php } ?>
                        <a href="quanlytacgia.php?page=<?php echo (($page + 1)<=$numPage) ? ($page+1) : $numPage?>" class="next">Next</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal js-modal-addAuthor">
        <form class="modal-container modal-container-author js-modal-addAuthor-container" method="post" action="quanlytacgia.php" enctype="multipart/form-data">
            <div class="modal-close js-modal-addAuthor-close">
                <i class="fa-solid fa-xmark"></i>
            </div>

            <header class="modal-header modal-header-books">
                <i class="modal-heading-icon fa-solid fa-feather"></i>
                Add Author
            </header>

            <div class="modal-content modal-content-author">
                <div class="modal-col">
                    <label for="author-name" class="modal-label">
                        Name
                        <input id="author-name" name="addAuthor-name" type="text" class="js-addAuthor-name modal-input" placeholder="Name..." required>
                        <span class="name-addAuthor-error check-error"></span>
                    </label>
                </div>
                <div class="action-form">
                    <div class="cancel-book js-cancel-author">
                        Cancel
                    </div>
                    <button type="submit" name="addAuthor" class="submit-book" onclick="checkAddAuthor()">
                        Add
                    </button>
                </div>
            </div>
        </form>
    </div>
    <?php
        include "connect.php";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST["addAuthor"])){
                $nameAuthor = $_POST["addAuthor-name"];
                $isDuplicate = false;
                $sql2 = "SELECT * FROM author";
                $names = mysqli_query($conn, $sql2);
                while($author = mysqli_fetch_array($names)){
                    if($author["name_author"]==$nameAuthor){
                        echo '<div id="toast-changeNameAuthor-error" class="toast-message"></div>';
                        $isDuplicate = true;
                        break;
                    }
                }
                if(!$isDuplicate){
                    $sql1 = "INSERT INTO author (name_author) VALUE('$nameAuthor')";
                    if (mysqli_query($conn, $sql1)) {
                        echo '<div id="toast-addAuthor-success" class="toast-message"></div>';
                    } else {
                        echo '<div id="toast-addAuthor-error" class="toast-message"></div>';
                    }
                }
            }
        }
    ?>

<?php
    include "connect.php";
    if(isset($_GET['idchangeauthor'])){
        $idchange = $_GET['idchangeauthor'];
        $sql4 = "SELECT * FROM author WHERE id_author = " . $idchange;
        $query = mysqli_query($conn, $sql4);
        if ($query) {
            $row = mysqli_fetch_array($query);
        }
    }
?>

<?php
    include "connect.php";
    if(isset($_GET['formchangeauthor'])){
        echo '<div class="modal js-modal-author modal-change-author" style="display:flex;">
        <form action="quanlytacgia.php?page=' . $page . '&idchangeauthor=' . (isset($_GET["idchangeauthor"]) ? $_GET["idchangeauthor"] : "") . '" method="post" class="modal-container js-modalAuthor-container modal-container-author" enctype="multipart/form-data">
            <div class="modal-close js-modalAuthor-close">
                <i class="fa-solid fa-xmark"></i>
            </div>

            <header class="modal-header">
                <i class="modal-heading-icon fa-solid fa-user"></i>
                Change Author Information
            </header>

            <div class="modal-content  modal-content-author">
                <div class="modal-col">
                    <label for="author-name" class="modal-label" style="display: none;">
                        ID
                        <input value="'.$row["id_author"].'" name="changeAuthor-id" id="author-id" type="text" class="js-author-id modal-input modal-input-author" placeholder="ID..." required>
                    </label>
                    <label for="author-name" class="modal-label">
                        Name
                        <input value="'.$row["name_author"].'" name="changeAuthor-name" id="author-name" type="text" class="js-author-name modal-input modal-input-author" placeholder="Name..." required>
                        <span class="name-changeAuthor-error check-error"></span>
                    </label>
                <div class="action-form">
                    <div class="cancel-book js-cancel-author">
                        Cancel
                    </div>
                    <button name="changeAuthor" class="submit-book js-change-author" type="submit" onclick="checkChangeAuthor()">
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>';
    }
?>

<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST["changeAuthor"])){
            $nameAuthor = $_POST["changeAuthor-name"];
            $idAuthor = $_POST["changeAuthor-id"];
            $isDuplicate = false;
            if($_GET["idchangeauthor"]){
                $sql2 = "SELECT * FROM author";
                $names = mysqli_query($conn, $sql2);
                while($author = mysqli_fetch_array($names)){
                    if($author["name_author"]==$nameAuthor && $author["id_author"]!=$idAuthor){
                        echo '<div id="toast-changeNameAuthor-error" class="toast-message"></div>';
                        $isDuplicate = true;
                        break;
                    }
                }
                if(!$isDuplicate) {
                    $sql1 = "UPDATE author SET name_author = '$nameAuthor' WHERE id_author = " . $_GET["idchangeauthor"];
                    if(mysqli_query($conn, $sql1)) {
                        echo '<div id="toast-changeAuthor-success" class="toast-message"></div>';
                        echo "<script>setTimeout(function(){
                            window.location = 'quanlytacgia.php?page=" . $_GET['page'] . "';
                        }, 2000)</script>";
                    } else {
                        echo '<div id="toast-changeAuthor-error" class="toast-message"></div>';
                    }
                }
            }
        }
    }
?>

<?php
    include "connect.php";
    if(isset($_GET['formdelauthor'])){
        echo '<div class="modal-delete js-modal-deleteAuthor">
        <form class="modal-delete-container js-modal-deleteAuthor-container" method="post" action="quanlytacgia.php?page=' . $page . '&iddelauthor=' . (isset($_GET["iddelauthor"]) ? $_GET["iddelauthor"] : "") . '" enctype="multipart/form-data">
            <div class="modal-delete-close js-modal-deleteAuthor-close">
                <i class="fa-solid fa-xmark"></i>
            </div>
            <div class="modal-delete-body">
                <p>Do you want to delete author?</p>
                <div class="btn-delete-choose">
                    <button type="submit" name="deleteAuthor" class="btn-yes js-author-btn-yes">Yes</button>
                    <div class="btn-no js-author-btn-no">No</div>
                </div>
            </div>
        </form>
    </div>';
    }
?>

<?php
    include "connect.php";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST["deleteAuthor"])){
            $sql2 = "DELETE FROM author WHERE id_author = " . $_GET['iddelauthor'];
            if (mysqli_query($conn, $sql2)) {
                echo '<div id="toast-deleteAuthor-success" class="toast-message"></div>';
                echo "<script>setTimeout(function(){
                    window.location = 'quanlytacgia.php?page=" . $_GET['page'] . "';
                }, 2000)</script>";
            } else {
                echo '<div id="toast-deleteAuthor-error" class="toast-message"></div>';
            }
        }
    }
?>
    <script src="./js/script-form-author.js"></script>
    <script src="./js/script-message-author.js"></script>
    <script src="./js/script-check-author.js"></script>
    <script>
        function toastAuthor() {
            toastAddAuthorSuccess();
            toastAddAuthorError();
            toastNameAuthorError();
            toastDeleteAuthorSuccess();
            toastDeleteAuthorError();
            toastChangeAuthorSuccess();
            toastChangeAuthorError();
        }
        toastAuthor();
    </script>
</body>
</html>