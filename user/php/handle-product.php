<?php include("./connect.php");
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["sqlNewBook"]) && isset($_POST["sqlSell"])) {
        // Load data page index
        $sqlNewBook = $_POST["sqlNewBook"];
        $sqlSell = $_POST["sqlSell"];

        $resultNewBook = $conn->query($sqlNewBook);
        $resultSell = $conn->query($sqlSell);

        $dataNewBook = $resultNewBook->fetch_all(MYSQLI_ASSOC);
        $dataSell = $resultSell->fetch_all(MYSQLI_ASSOC);

        $data = [
            "newBook" => $dataNewBook,
            "sell" => $dataSell,
        ];
        echo json_encode($data);
    } elseif (
        isset($_POST["numResult"]) && isset($_POST["sqlCategory"])
        && isset($_POST["sqlAuthor"]) && isset($_POST["sqlBook"])
    ) {
        //Load data default page Books
        $sqlnumResult = $_POST["numResult"];
        $sqlBook = $_POST["sqlBook"];
        $sqlCategory = $_POST["sqlCategory"];
        $sqlAuthor = $_POST["sqlAuthor"];

        //Query sql data 
        $numResult = $conn->query($sqlnumResult);
        $resultBook = $conn->query($sqlBook);
        $resultCategory = $conn->query($sqlCategory);
        $resultAuthor = $conn->query($sqlAuthor);

        //Convert data to array
        $dataNum = $numResult->num_rows;
        $dataBook = $resultBook->fetch_all(MYSQLI_ASSOC);
        $dataCategory = $resultCategory->fetch_all(MYSQLI_ASSOC);
        $dataAuthor = $resultAuthor->fetch_all(MYSQLI_ASSOC);

        //Json convert to string and send data to js
        $data = [
            "dataNum" => $dataNum,
            "dataBook" => $dataBook,
            "dataCategory" => $dataCategory,
            "dataAuthor" => $dataAuthor
        ];
        echo json_encode($data);
    } elseif (isset($_POST['sqlFilter'])) {
        // Load data filter
        $sqlFilter = $_POST["sqlFilter"];
        $Result = $conn->query($sqlFilter);
        $data = $Result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($data);
    } elseif (isset($_POST['numPage']) && isset($_POST['sqlPage'])) {
        // Load data change page
        $sqlPage = $_POST['sqlPage'];
        $limitResult = ' LIMIT ' . (($_POST['numPage'] - 1) * 8) . ',8';
        $sqlData = $sqlPage . $limitResult;

        //Query sql data 
        $sqlPageResult = $conn->query($sqlPage);
        $sqlDataResult = $conn->query($sqlData);

        //Convert data to array
        $countResult = $sqlPageResult->num_rows;
        $data = $sqlDataResult->fetch_all(MYSQLI_ASSOC);
        $numPageActive = floatval($_POST['numPage']);

        //Json convert to string and send data to js
        $dataChangePage = [
            "pageNum" => $countResult,
            "pageActive" => $numPageActive,
            "dataChangePage" => $data
        ];

        echo json_encode($dataChangePage);
    }
    $conn->close();
}
