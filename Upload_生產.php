<?php
$db_host = '127.0.0.1';     //資料庫主機
$db_user = 'root';          //資料庫使用者
$db_password = '';          //資料庫使用者密碼
$db_name = 'shrimp';        //資料庫名稱
//資料庫連接
$link = mysqli_connect($db_host, $db_user, $db_password, $db_name);
if (!$link) {
    die("連接失敗" . mysqli_connect_error()); //輸出資料庫連接錯誤
}

/* 連接 database 是採用 utf8 編碼 */
mysqli_set_charset($link, "utf8");

/* 設定網頁呈現資料是用 utf-8 編碼，避免中文字變亂碼 */
header("Content-Type:text/html; charset=utf-8");
/* 指定要上傳的資料夾 */
$target_dir = "images/";

$eyetag = filter_input(INPUT_POST, 'eye');
$spawningroomdate = filter_input(INPUT_POST, 'spawningroomdate');
$spawningweight = filter_input(INPUT_POST, 'spawningweight');
$ovarystate = filter_input(INPUT_POST, 'ovarystate');
$male_family = filter_input(INPUT_POST, 'male_family');
$mating = filter_input(INPUT_POST, 'mating');

$family = "" ;
$cutday = "" ;
$cutweight = "" ;



// 先查找該種蝦的資料
$sql = "SELECT * FROM shrimp_info WHERE 眼標 = '$eyetag'" ;
$stmt = mysqli_query($link, $sql);
while ($row = $stmt->fetch_assoc()) {
    $family = $row["家族"] ;
    $cutday = $row["剪眼日期"] ;
    $cutweight = $row["剪眼體重"] ;
}

$cleancutday = str_replace("/", "", $cutday);
$cleanspawningroomdate = str_replace("/", "", $spawningroomdate);

$fileType = $_FILES['fileField']['type']; //檔案類型
$fileSize = $_FILES['fileField']['size']; //檔案大小（byte為單位）
$fileName = $_FILES['fileField']['name']; //檔案名稱
$fileTempName = $_FILES['fileField']['tmp_name']; //檔案暫存名稱

/* 取得上傳檔案的副檔名 */
$fileExtTmp = pathinfo($fileName, PATHINFO_EXTENSION);

/* 將副檔名轉換成小寫，以便後續判別檔案格式用 */
$fileExt = strtolower($fileExtTmp);

/* 設定時區為台北 */
date_default_timezone_set("Asia/Taipei");
$cnt = date("Y-m-d-H-i-s");

/* 將自訂檔名組合成完整的檔案存放路徑 */
$target_file = $target_dir . $cnt . "." . $fileExt;
// echo $target_file . "<br>";

/* 宣告一變數，用來設定是否上傳成功 1ok 0不ok 2沒有圖*/
$uploadOk = 1;
if ($fileSize > 0) 
{
    /* $fileSize：上傳檔案的大小(bytes) */
    if ($fileSize > 3000000) {
        echo "抱歉，你上傳的檔案太大！\n";
        $uploadOk = 0;
    }

    /* $fileExt 變數記錄上傳檔案的副檔名 */
    if ($fileExt != "jpg" && $fileExt != "jpeg" && $fileExt != "png" && $fileExt != "gif" && $fileExt != "HEIC") {
        echo "抱歉，僅允許上傳 jpg, jpeg, png 和 gif 格式的檔案！\n";
        $uploadOk = 0;
    }
}
else
{
    $uploadOk = 2;
    $target_file = "";
}


/* 檢查 $uploadOK 是否為 0(若是為 0，代表上述的規則不符合，發生錯誤) */
if ($uploadOk == 0) {
    echo "抱歉，你的檔案無法上傳！\n";
    /* 假如所有上述規則符合，開始進行上傳作業 */
} 
else {
    /* 底下的 iconv()函式，用來將檔名的編碼由 utf8 轉換為 big5 */
    /* 因為此方式才能讓 move_uploaded_file() 正常運作 */
    /* 而其中參數 utf-8、big5 都是編碼的一種，也可以改成其它編碼 */
    /* 後面的//TRANSLIT、//IGNORE 用來指出，如果找不到對應的編碼，可以替換成相似的編碼或略過 */
    if ($uploadOk == 1)
    {
        if (move_uploaded_file($fileTempName, iconv("UTF-8", "big5//TRANSLIT//IGNORE", $target_file))) {
            echo "檔案 " . preg_replace('/^.+[\\\\\\/]/', '', $fileName) . " 已經上傳成功！\n";
        } 
        else {
            echo "抱歉，檔案上傳中發生錯誤！\n";
        }
    }
    /* 定義 SQL 字串的變數 */
    /* 因為 crop 表格的第一個欄位是主鍵，而且它是「自動編號」 */
    /* 所以，可以直接設定它是 null */
    $insertStr = "INSERT INTO breed VALUES 
        (null, 
        '" . $family . "',
        '" . $eyetag .  "', 
        '" . $cutday . "', 
        '" . $cutweight . "', 
        '" . $cleanspawningroomdate . "', 
        '" . $spawningweight . "', 
        '" . $ovarystate . "', 
        '" . $male_family . "', 
        '" . $mating . "', 
        '" . $target_file . "');";

    $result = mysqli_query($link, $insertStr);
    if ($result) {
        echo "新增資料庫成功\n";
    } else {
        echo "新增資料庫失敗\n";
    }
}
