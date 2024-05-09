<?php 
    require_once(__DIR__."/../connect.php");
    session_start();
    if(!isset($_SESSION['stories_session'])){
        $_SESSION['stories_session'] ="";
    }
    $sql = "SELECT count(*) as sum from stories";
    $result = $conn->query($sql) or die("Can't get recordset");
    if($result->num_rows>0){
        $row = $result->fetch_assoc();
        $sum_stories = $row['sum'];   
    }
    $sql = "SELECT count(*) as sum from member where MemStatus=1";
    $result = $conn->query($sql) or die("Can't get recordset");
    if($result->num_rows>0){
        $row = $result->fetch_assoc();
        $sum_mem = $row['sum'];   
    }
    $sql = "SELECT count(*) as sum from categories where CateStatus=1";
    $result = $conn->query($sql) or die("Can't get recordset");
    if($result->num_rows>0){
        $row = $result->fetch_assoc();
        $sum_cate = $row['sum'];   
    }
    $sql = "SELECT count(*) as sum from member where MemStatus=1";
    $result = $conn->query($sql) or die("Can't get recordset");
    if($result->num_rows>0){
        $row = $result->fetch_assoc();
        $sum_mem = $row['sum'];   
    }
    $sql = "SELECT count(*) as sum from report";
    $result = $conn->query($sql) or die("Can't get recordset");
    if($result->num_rows>0){
        $row = $result->fetch_assoc();
        $sum_report = $row['sum'];   
    }
?>

<div class="row g-3 my-2">
    <div class="col-md-3">
        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
            <div>
                <h3 class="fs-2">
                    <?php echo $sum_stories ?>
                </h3>
                <p class="fs-5">Story</p>
            </div>
            <i class="fas fa-gift fs-1 primary-text border rounded-full secondary-bg p-3"></i>
        </div>
    </div>

    <div class="col-md-3">
        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
            <div>
                <h3 class="fs-2">
                    <?php echo $sum_mem ?>
                </h3>
                <p class="fs-5">Member</p>
            </div>
            <i class="fas fa-hand-holding-usd fs-1 primary-text border rounded-full secondary-bg p-3"></i>
        </div>
    </div>

    <div class="col-md-3">
        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
            <div>
                <h3 class="fs-2">
                    <?php echo $sum_cate ?>
                </h3>
                <p class="fs-5">Category</p>
            </div>
            <i class="fas fa-truck fs-1 primary-text border rounded-full secondary-bg p-3"></i>
        </div>
    </div>

    <div class="col-md-3">
        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
            <div>
                <h3 class="fs-2">
                    <?php echo $sum_report ?>
                </h3>
                <p class="fs-5">Report</p>
            </div>
            <i class="fas fa-chart-line fs-1 primary-text border rounded-full secondary-bg p-3"></i>
        </div>
    </div>
</div>
<?php $_SESSION["stories_session"]=""; ?>
