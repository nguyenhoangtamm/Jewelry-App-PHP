<?php
    include "connect.php";
    $sql = "SELECT * FROM book";
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
    <title>Admin</title>
    <link rel="stylesheet" href="../css/styleadmin.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../css/multi-select-tag.css">
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
            <li class="active">
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
            <li>
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
                    <h2>Books Managerment</h2>
                </div>
                <div class="user-info">
                    <img src="../images_web/avatar.png" alt="avatar">
                </div>
            </div>
            <div class="table-wrapper">
                <div class="table-header">
                    <h3 class="main-title">
                        Books Information
                    </h3>
                    <div class="book-search">
                        <input type="text" name="search" id="searchInput" class="book-text-search" placeholder="Search...">
                        <i class="fa-solid fa-magnifying-glass" id="searchButton"></i>
                    </div>
                    <div class="add-book js-add-book"><i class="fa-solid fa-plus icon-add"></i>Add Book</div>
                </div>
                <div class="table-container" name="book-table">
                    <table id="table-book">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>Tags</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Description</th>
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
                                if (isset($_GET['search'])) {
                                    $searchTerm = trim($_GET['search']);
                                    $searchTerm = preg_replace('/\s+/', ' ', $searchTerm);
                                    $result = searchBooks($searchTerm, $page);
                                }else{
                                    $sql = "SELECT * FROM book LIMIT " . $currentData . ", 5";
                                    $result = mysqli_query($conn, $sql);
                                }
                                
                                while ($row = mysqli_fetch_array($result)) {
                                    $id_author = $row['id_author'];
                                    $sql_author = "SELECT name_author FROM author WHERE id_author = $id_author";
                                    $name_author_result = mysqli_query($conn, $sql_author);
                                    $name_author_row = mysqli_fetch_array($name_author_result);
                                    $name_author = $name_author_row['name_author'];

                                    $id_category = $row['id_category'];
                                    $sql_category = "SELECT name_category FROM category WHERE id_category = $id_category";
                                    $name_category_result = mysqli_query($conn, $sql_category);
                                    $name_category_row = mysqli_fetch_array($name_category_result);
                                    $name_category = $name_category_row['name_category'];
                                ?>
                                    <tr>
                                        <td class="book-id"><?php echo $row['id_book'] ?></td>
                                        <td><img src="../images_book/<?php echo $row['image_book']?>" alt="sach" class="book-img"></td>
                                        <td class="book-name"><?php echo $row['name_book'] ?></td>
                                        <td class="book-author"><?php echo $name_author ?></td>
                                        <td class="book-category"><?php echo $name_category ?></td>
                                        <td class="book-tags"><?php echo $row['tags'] ?></td>
                                        <td class="book-quantity"><?php echo $row['quantity'] ?></td>
                                        <td class="book-price"><?php echo $row['price'] . '$' ?></td>
                                        <td class="book-description"><?php echo $row['description'] ?></td>
                                        <td>
                                            <a href="quanlysach.php?page=<?php echo $page . "&idchangebook=" . $row['id_book'] . "&formchangebook=1"?>" class="fa-solid fa-pen icon-change js-changeBook"></a>
                                            <a href="quanlysach.php?page=<?php echo $page . "&iddelbook=" . $row['id_book'] . "&formdelbook=1"?>" class="fas fa-trash icon-delete js-delete-book"></a>
                                        </td>
                                    </tr>
                                <?php }
                                ?>
                        </tbody>
                    </table>
                    <div class="pagination">
                        <a href="quanlysach.php?page=<?php echo (($page -1)>0) ? ($page-1) : 1?>&search=<?php echo (isset($_GET["search"]) ? $_GET['search'] : "")?>" class="prev">Prev</a>
                        <?php
                            for($i=0; $i<$numPage; $i++){
                            ?>
                                <a href="quanlysach.php?search=<?php echo (isset($_GET["search"]) ? $_GET['search'] : "")?> &page=<?php echo ($i+1)?>" class="<?php echo ($page==$i+1) ? "page-current" : ""?>"> <?php echo ($i+1) ?> </a>
                            <?php } ?>
                        <a href="quanlysach.php?search=<?php echo (isset($_GET["search"]) ? $_GET['search'] : "")?> &page=<?php echo (($page + 1)<=$numPage) ? ($page+1) : $numPage?>" class="next">Next</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
        var searchInput = document.getElementById('searchInput');
        var searchButton = document.getElementById('searchButton');
        searchButton.addEventListener('click', function () {
            var searchTerm = searchInput.value;
            window.location.href = 'quanlysach.php?search=' + encodeURIComponent(searchTerm);
        });
    });
    </script>

    <?php
        function searchBooks($searchTerm, $page)
        {
            include "connect.php";
            $currentData = ($page - 1) * 5;
            $stmt = $conn->prepare("SELECT * FROM book WHERE name_book LIKE ? LIMIT ?, 5");
        
            // Thêm dấu % cho tìm kiếm với LIKE
            $searchTerm = "%" . $searchTerm . "%";
        
            // Gán giá trị và thực thi truy vấn
            $stmt->bind_param("si", $searchTerm, $currentData);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
        
            return $result;
        }
    ?>

    <?php
        include "connect.php";
        if(isset($_GET['formdelbook'])){
            echo '<div class="modal-delete js-modal-deleteBook">
            <form class="modal-delete-container js-modal-deleteBook-container" method="post"
            action="quanlysach.php?page=' . $page . '&iddelbook=' . (isset($_GET["iddelbook"]) ? $_GET["iddelbook"] : "") . '" enctype="multipart/form-data">

            <div class="modal-delete-close js-modal-deleteBook-close">
                <i class="fa-solid fa-xmark"></i>
            </div>
            <div class="modal-delete-body">
                <p>Do you want to delete book?</p>
                <div class="btn-delete-choose">
                    <button type="submit" name="deleteBook" class="btn-yes js-book-btn-yes">Yes</button>
                    <div class="btn-no js-book-btn-no">No</div>
                </div>
            </div>
        </form>
        </div>';
        }
    ?>

    <?php
        include "connect.php";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST["deleteBook"])){
                $sql2 = "DELETE FROM book WHERE id_book = " . $_GET['iddelbook'];
                if (mysqli_query($conn, $sql2)) {
                    echo '<div id="toast-delete-success" class="toast-message"></div>';
                    echo "<script>setTimeout(function(){
                        window.location = 'quanlysach.php?page=" . $_GET['page'] . "';
                    }, 2000)</script>";
                } else {
                    echo '<div id="toast-delete-error" class="toast-message"></div>';
                }
            }
        }
    ?>

    <?php
        include "connect.php";
        if(isset($_GET['idchangebook'])){
            $idchange = $_GET['idchangebook'];
            $sql4 = "SELECT * FROM book WHERE id_book = " . $idchange;
            $query = mysqli_query($conn, $sql4);
            if ($query) {
                $row = mysqli_fetch_array($query);
                $array_tags = explode(", ", $row["tags"]);
                $sql5 = "SELECT * FROM author WHERE id_author = " . $row["id_author"];
                $sql6 = "SELECT * FROM author";
                $sql7 = "SELECT * FROM category";
                $sql8 = "SELECT * FROM category WHERE id_category = " . $row["id_category"];
                $query2 = mysqli_query($conn, $sql6);
                $query1 = mysqli_query($conn, $sql5);
                $query3 = mysqli_query($conn, $sql7);
                $query4 = mysqli_query($conn, $sql8);
                if($query1){
                    $author_idchange = mysqli_fetch_array($query1)[0];
                    $author_namechange = mysqli_fetch_array($query1)[1];
                }
                if($query4){
                    $category_idchange = mysqli_fetch_array($query4)[0];
                    $category_namechange = mysqli_fetch_array($query4)[1];
                }
            }
        }
    ?>

    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST["changeBook"])){
                $nameBook = $_POST["changeBook-name"];
                $imageBook_name = $_FILES["changeBook-img"]["name"];
                $imageBook = $_FILES["changeBook-img"]["tmp_name"];
                $authorBook = $_POST["changeBook-author"];
                $categoryBook = $_POST["changeBook-category"];
                $quantityBook = $_POST["changeBook-quantity"];
                $priceBook = $_POST["changeBook-price"];
                $descriptionBook = $_POST["changeBook-des"];
                $tagsBook = $_POST["changeBook-tags"];
                $array_tags_new =[];
                foreach ($tagsBook as $tag) {
                    $sql_tags = "SELECT name_category FROM category WHERE id_category = $tag";
                    $result = mysqli_query($conn, $sql_tags);
    
                    if ($result) {
                        $tag_row = mysqli_fetch_array($result);
                        $tag_name = $tag_row['name_category'];
                        array_push($array_tags_new, $tag_name);
                    }
                }
                if (is_array($array_tags_new)) {
                    $tagsBook_string = implode(", ", $array_tags_new);
                    $tagsBook_string = trim($tagsBook_string, ', ');
                }
                if($_GET["idchangebook"] && $imageBook_name!=""){
                    $imageFormat = substr($imageBook_name, strrpos($imageBook_name,"."));
                    $charactersToReplace = array(" ", "*", ":", "<", ">", "?", "/", "\\", "|", "~", "#", "%", "&", "*", ":", "<", ">", "?", "/", "{", "|", "}");
                    // Replace the specified characters and whitespace with an empty string
                    $nameImg = str_replace($charactersToReplace, '', $nameBook) . $imageFormat;
                    $sql1 = "UPDATE book SET name_book = '$nameBook', image_book = '$nameImg', id_author = $authorBook, 
                    id_category = $categoryBook, tags = '$tagsBook_string', quantity = '$quantityBook', price = '$priceBook', description = '$descriptionBook'
                    WHERE id_book = " . $_GET["idchangebook"];
                    if(mysqli_query($conn, $sql1)) {
                        echo '<div id="toast-change-success" class="toast-message"></div>';
                        echo "<script>setTimeout(function(){
                            window.location = 'quanlysach.php?page=" . $_GET['page'] . "';
                        }, 2000)</script>";
                    } else {
                        echo '<div id="toast-change-error" class="toast-message"></div>';
                    }
                        move_uploaded_file($imageBook, '../images_book/' . $nameImg);
                }elseif($_GET["idchangebook"] && $imageBook_name==""){
                    $imageFormat = substr($imageBook_name, strrpos($imageBook_name,"."));
                    $charactersToReplace = array(" ", "*", ":", "<", ">", "?", "/", "\\", "|", "~", "#", "%", "&", "*", ":", "<", ">", "?", "/", "{", "|", "}");
                    // Replace the specified characters and whitespace with an empty string
                    $nameImg = str_replace($charactersToReplace, '', $nameBook) . $imageFormat;
                    $sql1 = "UPDATE book SET name_book = '$nameBook', id_author = $authorBook, 
                    id_category = $categoryBook, tags = '$tagsBook_string', quantity = '$quantityBook', price = '$priceBook', description = '$descriptionBook'
                    WHERE id_book = " . $_GET["idchangebook"];
                    if(mysqli_query($conn, $sql1)) {
                        echo '<div id="toast-change-success" class="toast-message"></div>';
                        echo "<script>setTimeout(function(){
                            window.location = 'quanlysach.php?page=" . $_GET['page'] . "';
                        }, 2000)</script>";
                    } else {
                        echo '<div id="toast-change-error" class="toast-message"></div>';
                    }
                }
            }
        }
    ?>

    <?php
        include "connect.php";
        if(isset($_GET['formchangebook'])){
            echo '<div class="modal modal-changeBook js-modal-changeBook">
            <form class="modal-container js-modal-changeBook-container" method="post" action="quanlysach.php?page=' . $page . '&idchangebook=' . (isset($_GET["idchangebook"]) ? $_GET["idchangebook"] : "") . '" enctype="multipart/form-data">
                <div class="modal-close js-modal-changeBook-close">
                    <i class="fa-solid fa-xmark"></i>
                </div>
    
                <header class="modal-header modal-header-books">
                    <i class="modal-heading-icon fa-solid fa-book"></i>
                    Change Book Information
                </header>
    
                <div class="modal-content">
                    <div class="modal-twoCol">
                        <label for="book-name" class="modal-label">
                            Name
                            <input value="' . $row["name_book"] . '" id="book-name" type="text" class="js-changeBook-name modal-input" placeholder="Name..." name="changeBook-name" required>
                            <span class="name-changeBook-error check-error"></span>
                        </label>
                        
        
                        <label for="book-author" class="modal-label">
                            Author
                            <select name="changeBook-author" id="book-author" class="modal-input js-changeBook-author" required>
                                ';
                                if($query2){
                                    while($row1=mysqli_fetch_array($query2)){
                                        $selected = ($row1[0] == $author_idchange) ? 'selected' : '';
                                        echo "<option value=".$row1[0]." ".$selected.">".$row1[1]."</option>";
                                    }
                                }
                                
                            echo '
                            </select>
                            <span class="author-changeBook-error check-error"></span>
                        </label>
                        
        
                        <label for="book-category-change" class="modal-label">
                            Category
                            <select id="book-category-change" class="js-changeBook-category modal-input" name="changeBook-category" required>
                                ';
                                if($query3){
                                    while($row2=mysqli_fetch_array($query3)){
                                        $selected = ($row2[0] == $category_idchange) ? 'selected' : '';
                                        echo "<option value=".$row2[0]." ".$selected.">".$row2[1]."</option>";
                                    }
                                }
                                
                            echo '
                            </select>
                            <span class="category-changeBook-error check-error"></span>
                        </label>
                        
        
                        <label for="book-tags" class="modal-label">
                            Tags
                            <select class="js-changeBook-tags" id="book-tags-change" multiple name="changeBook-tags[]" required>
                            ';
                                $sql = "SELECT * FROM category";
                                $query = mysqli_query($conn, $sql);
                                $array_tags = explode(", ", $row["tags"]);
                                
                                if ($query) {
                                    while ($row4 = mysqli_fetch_assoc($query)) {
                                        $selected = '';
                                
                                        foreach ($array_tags as $tag) {
                                            if ($tag == $row4["name_category"]) {
                                                $selected = 'selected';
                                                break;
                                            }
                                        }
                                        echo "<option value=".$row4["id_category"]." ".$selected.">".$row4["name_category"]."</option>";
                                    }
                                }
                        echo '
                            </select>
                            <span class="tags-changeBook-error check-error"></span>
                        </label>
                        
        
                        <label for="book-quantity" class="modal-label">
                            Quantity
                            <input value="' . $row["quantity"] . '" id="book-quantity" type="number" class="js-changeBook-quantity modal-input" placeholder="Quantity..."
                            min="1" name="changeBook-quantity" required>
                            <span class="quantity-changeBook-error check-error"></span>
                        </label>
                       
        
                        <label for="book-price" class="modal-label">
                            Price
                            <input value="' . $row["price"] . '" id="book-price" type="number" class="js-changeBook-price modal-input" placeholder="Price..." min="1" name="changeBook-price" required>
                            <span class="price-changeBook-error check-error"></span>
                        </label>
                    </div>
                    
                    <div class="modal-col">
                        <label for="book-description" class="modal-label">
                            Description
                            <textarea id="book-description" rows="2" class="js-changeBook-description modal-input" placeholder="Description..." name="changeBook-des" required>
                            ' . htmlspecialchars($row["description"]) . '
                            </textarea>

                            <span class="des-changeBook-error check-error"></span>
                        </label>
                        
                        <label for="book-img" class="modal-label">
                            Image
                            <input id="book-img" type="file" class="js-changeBook-img modal-input" accept=".jpg, .png" placeholder="Image" name="changeBook-img">
                            <span class="img-changeBook-error check-error"></span>
                        </label>
                    </div>
                    
                    <div class="action-form">
                        <div class="cancel-book js-cancel-book">
                            Cancel
                        </div>
                        <button class="submit-book js-save-changedBook" type="submit" name="changeBook" onclick="checkChangeBook()">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>';
        }
    ?>

    <?php
    include "connect.php";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST["addBook"])){
            $nameBook = $_POST["addBook-name"];
            $imageBook_name = $_FILES["addBook-img"]["name"];
            $imageBook = $_FILES["addBook-img"]["tmp_name"];
            $authorBook = $_POST["addBook-author"];
            $categoryBook = $_POST["addBook-category"];
            $quantityBook = $_POST["addBook-quantity"];
            $priceBook = $_POST["addBook-price"];
            $descriptionBook = $_POST["addBook-description"];
            $tagsBook = $_POST["addBook-tags"];
            $array_tags_new =[];
            foreach ($tagsBook as $tag) {
                $sql_tags = "SELECT name_category FROM category WHERE id_category = $tag";
                $result = mysqli_query($conn, $sql_tags);

                if ($result) {
                    $tag_row = mysqli_fetch_array($result);
                    $tag_name = $tag_row['name_category'];
                    array_push($array_tags_new, $tag_name);
                }
            }
            if (is_array($array_tags_new)) {
                $tagsBook_string = implode(", ", $array_tags_new);
                $tagsBook_string = trim($tagsBook_string, ', ');
            }
            $imageFormat = substr($imageBook_name, strrpos($imageBook_name,"."));
            $charactersToReplace = array(" ", "*", ":", "<", ">", "?", "/", "\\", "|", "~", "#", "%", "&", "*", ":", "<", ">", "?", "/", "{", "|", "}");
            // Replace the specified characters and whitespace with an empty string
            $nameImg = str_replace($charactersToReplace, '', $nameBook) . $imageFormat;
            $sql1 = "INSERT INTO book (name_book, image_book, id_author, id_category, tags, quantity, price, description)
            VALUE('$nameBook', '$nameImg', $authorBook, $categoryBook, '$tagsBook_string', '$quantityBook', '$priceBook', '$descriptionBook')";
            
 
            if (mysqli_query($conn, $sql1)) {
                echo '<div id="toast-add-success" class="toast-message"></div>';
            } else {
                echo '<div id="toast-add-error" class="toast-message"></div>';
            }
                
                move_uploaded_file($imageBook, '../images_book/' . $nameImg);
            }
    }
    ?>

    <div class="modal js-modal-addBook">
        <form class="modal-container js-modal-addBook-container" method="post" action="quanlysach.php" enctype="multipart/form-data">
            <div class="modal-close js-modal-addBook-close">
                <i class="fa-solid fa-xmark"></i>
            </div>

            <header class="modal-header modal-header-books">
                <i class="modal-heading-icon fa-solid fa-book"></i>
                Add Book
            </header>

            <div class="modal-content">
                <div class="modal-twoCol">
                    <label for="book-name" class="modal-label">
                        Name
                        <input id="book-name" name="addBook-name" type="text" class="js-addBook-name modal-input" placeholder="Name..." required>
                        <span class="name-addBook-error check-error"></span>
                    </label>

                    <label for="book-author" class="modal-label">
                        Author
                        <select name="addBook-author" id="book-author" class="modal-input js-addBook-author" required>
                            <?php
                                include 'connect.php';
                                $sql6 = "SELECT * FROM author";
                                $query2 = mysqli_query($conn, $sql6);
                                if($query2){
                                    while($row1=mysqli_fetch_array($query2)){
                                        echo "<option value=".$row1[0].">".$row1[1]."</option>";
                                    }
                                }
                            ?>
                        </select>
                        <span class="author-addBook-error check-error"></span>
                    </label>
                    
    
                    <label for="book-category" class="modal-label">
                        Category
                        <select name="addBook-category" id="book-category" class="modal-input js-addBook-category" required>
                            <?php
                                include 'connect.php';
                                $sql7 = "SELECT * FROM category";
                                $query3 = mysqli_query($conn, $sql7);
                                if($query3){
                                    while($row1=mysqli_fetch_array($query3)){
                                        echo "<option value=".$row1[0].">".$row1[1]."</option>";
                                    }
                                }
                            ?>
                        </select>
                        <span class="category-addBook-error check-error"></span>
                    </label>
                    
                    <label for="book-tags-add" class="modal-label">
                        Tags
                        <select name="addBook-tags[]" id="book-tags-add" class="js-addBook-tags" multiple required>
                            <?php
                                include 'connect.php';
                                $sql7 = "SELECT * FROM category";
                                $query3 = mysqli_query($conn, $sql7);
                                if($query3){
                                    while($row1=mysqli_fetch_array($query3)){
                                        echo "<option value=".$row1[0].">".$row1[1]."</option>";
                                    }
                                }
                            ?>
                        </select>
                        <span class="tags-addBook-error check-error"></span>
                    </label>
                    
    
                    <label for="book-quantity" class="modal-label">
                        Quantity
                        <input id="book-quantity" name="addBook-quantity" type="number" class="js-addBook-quantity modal-input" placeholder="Quantity..." required
                        min="1">
                        <span class="quantity-addBook-error check-error" class="check-error"></span>
                    </label>
                    
    
                    <label for="book-price" class="modal-label">
                        Price
                        <input id="book-price" name="addBook-price" type="number" class="js-addBook-price modal-input" placeholder="Price..." min="1" required>
                        <span class="price-addBook-error check-error"></span>
                    </label>
                </div>
                
                <div class="modal-col">
                    <label for="book-description" class="modal-label">
                        Description
                        <textarea id="book-description" name="addBook-description" rows="2" type="textarea" class="js-addBook-description modal-input" placeholder="Description..." required></textarea>
                        <span class="des-addBook-error check-error"></span>
                    </label>
    
                    <label for="book-img" class="modal-label">
                        Image
                        <input id="book-img" name="addBook-img" type="file" accept=".jpg, .png" class="js-addBook-img modal-input" placeholder="Image" required>
                        <span class="img-addBook-error check-error"></span>
                    </label>
                </div>
                
                <div class="action-form">
                    <div class="cancel-book js-cancel-book">
                        Cancel
                    </div>
                    <button type="submit" name="addBook" class="submit-book" onclick="checkAddBook()">
                        Add
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script src="./js/multi-select-tag.js"></script>
    <script>
        new MultiSelectTag('book-tags-add')
        new MultiSelectTag('book-tags-change')
    </script>
    <script src="./js/script-form-book.js"></script>
    <script src="./js/script-select-tag.js"> </script>
    <script src="./js/script-message-book.js"></script>
    <script src="./js/script-check-addBook.js"></script>
    <script>
        function toastBook() {
            toastAddSuccess();
            toastAddError();
            toastDeleteSuccess();
            toastDeleteError();
            toastChangeSuccess();
            toastChangeError();
        }
        toastBook();
    </script>

</body>

</html>