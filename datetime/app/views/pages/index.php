<?php require_once(APPROOT."/views/inc/header.php"); ?>
  <!-- Jumbotron -->
  <div class="container">
    <div class="p-5 text-center bg-light">
    <div class="row">
        <div class="col-lg-6">
            <h2 class="h2">Eastern Standard Time</h2>
            <p><?php if(intval(substr($data["time_EasternStandard"],11,2))<=12)
            { echo substr($data["time_EasternStandard"],11,5)." AM"; }
            else{
                echo substr($data["time_EasternStandard"],11,5)." PM"; 
            }?></p>
        </div>
            <div class="col-lg-6">
            <h2 class="h2">Coordinated Universal Time</h2>
            <p><?php if(intval(substr($data["time_Coordinated_Universal_Time"],11,2))<=12)
                { echo substr($data["time_Coordinated_Universal_Time"],11,5)." AM"; }
                else{
                    echo substr($data["time_Coordinated_Universal_Time"],11,5)." PM"; 
                }?></p>
        </div>
    </div>   
  </div>

  <div class="row mt-2 mb-2">
        <div class="col-md-6">
          <div class="card flex-md-row mb-4 box-shadow h-md-250">
            <div class="card-body d-flex flex-column align-items-start">
              <strong class="d-inline-block mb-2 text-primary">Yout Current Time</strong>
              <h3 class="mb-0">
                <a class="text-dark" ><?php echo $data["user_location_country"]; ?></a>
              </h3>
              <h5 class=" h5 mb-0">
                <a class="text-dark" ><?php echo $data["user_location_city"]; ?></a>
              </h5>
              <div class="mb-1 text-muted"><p><?php echo $data["dayOfWeek"]; ?> <?php  echo $data["date"]; ?></p></div>
           
            <form class="form-signin" method="" action="city">
                        <label for="inputPassword" class="sr-only">Password</label>
                        <input type="text" id="searchcity" class="form-control form-input" placeholder="search for city" required>
                        <button class=" mt-2 btn btn-primary" >Search</button>
                </form>
               
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card flex-md-row mb-4 box-shadow h-md-250">
            <div class="card-body d-flex flex-column align-items-start">
                <strong class="d-inline-block mb-2 text-success">Design</strong>
                <h3 class="mb-0">
                  <a class="text-dark" href="#">Post title</a>
                </h3>
                <div class="mb-1 text-muted">Nov 11</div>
                <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                <a href="#">Continue reading</a>
                </div>
            
            </div>
              </div>
      </div>

      <div class="row mt-2 mb-2">
        <div class="col-md-6">
          <div class="card flex-md-row mb-4 box-shadow h-md-250">
            <div class="card-body d-flex flex-column align-items-start">
              <strong class="d-inline-block mb-2 text-primary">Yout Current Time</strong>
              <h3 class="mb-0">
                <a class="text-dark" ><?php echo $data["user_location_country"]; ?></a>
              </h3>
              <h5 class=" h5 mb-0">
                <a class="text-dark" ><?php echo $data["user_location_city"]; ?></a>
              </h5>
              <div class="mb-1 text-muted"><p><?php echo $data["dayOfWeek"]; ?> <?php  echo $data["date"]; ?></p></div>
           
            <form class="form-signin" method="" action="city">
                        <label for="inputPassword" class="sr-only">Password</label>
                        <input type="text" id="searchcity" class="form-control form-input" placeholder="search for city" required>
                        <button class=" mt-2 btn btn-primary" >Search</button>
                </form>
               
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card flex-md-row mb-4 box-shadow h-md-250">
            <div class="card-body d-flex flex-column align-items-start">
                <strong class="d-inline-block mb-2 text-success">Design</strong>
                <h3 class="mb-0">
                  <a class="text-dark" href="#">Post title</a>
                </h3>
                <div class="mb-1 text-muted">Nov 11</div>
                <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                <a href="#">Continue reading</a>
                </div>
            
            </div>
              </div>
      </div>


  
 
  </div>
  <div class="contaioner">
  <div class="row">

  <?php
// Set your timezone
date_default_timezone_set($data["user_location_city"]);

// Get prev & next month
if (isset($_GET['ym'])) {
    $ym = $_GET['ym'];
} else {
    // This month
    $ym = date('Y-m');
}

// Check format
$timestamp = strtotime($ym . '-01');
if ($timestamp === false) {
    $ym = date('Y-m');
    $timestamp = strtotime($ym . '-01');
}

// Today
$today = date('Y-m-j', time());

// For H3 title
$html_title = date('Y / m', $timestamp);

// Create prev & next month link     mktime(hour,minute,second,month,day,year)
$prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
$next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));
// You can also use strtotime!
// $prev = date('Y-m', strtotime('-1 month', $timestamp));
// $next = date('Y-m', strtotime('+1 month', $timestamp));

// Number of days in the month
$day_count = date('t', $timestamp);
 
// 0:Sun 1:Mon 2:Tue ...
$str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));
//$str = date('w', $timestamp);


// Create Calendar!!
$weeks = array();
$week = '';

// Add empty cell
$week .= str_repeat('<td></td>', $str);

for ( $day = 1; $day <= $day_count; $day++, $str++) {
     
    $date = $ym . '-' . $day;
     
    if ($today == $date) {
        $week .= '<td class="today">' . $day;
    } else {
        $week .= '<td>' . $day;
    }
    $week .= '</td>';
     
    // End of the week OR End of the month
    if ($str % 7 == 6 || $day == $day_count) {

        if ($day == $day_count) {
            // Add empty cell
            $week .= str_repeat('<td></td>', 6 - ($str % 7));
        }

        $weeks[] = '<tr>' . $week . '</tr>';

        // Prepare for new week
        $week = '';
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
   
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
    <style>
        .container {
            font-family: 'Noto Sans', sans-serif;
            margin-top: 80px;
        }
        h3 {
            margin-bottom: 30px;
        }
        th {
            height: 30px;
            text-align: center;
        }
        td {
            height: 100px;
        }
        .today {
            background: orange;
        }
        th:nth-of-type(1), td:nth-of-type(1) {
            color: red;
        }
        th:nth-of-type(7), td:nth-of-type(7) {
            color: blue;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3 ><a href="?ym=<?php echo $prev; ?>">&lt;</a> <?php echo $html_title; ?> <a href="?ym=<?php echo $next; ?>">&gt;</a></h3>
        <table class="  table table-bordered">
            <tr>
                <th>S</th>
                <th>M</th>
                <th>T</th>
                <th>W</th>
                <th>T</th>
                <th>F</th>
                <th>S</th>
            </tr>
            <?php
                foreach ($weeks as $week) {
                    echo $week;
                }
            ?>
        </table>
    </div>
</body>
</html>
 
  </div>
</div>


  <!-- Jumbotron -->
<?php require_once(APPROOT."/views/inc/footer.php"); ?>




