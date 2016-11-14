<?php
  // $location = $_GET['location'];
  // $insta_token = '472964571.7b02da4.77ddc604c86b44e49ba0b2bb479ceb8b';
  //
  // if (!empty($location)) {
  //   $maps_url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($location);
  //   $maps_json = file_get_contents($maps_url);
  //   $maps_array = json_decode($maps_json, true);
  // }
  //
  //   $lat = $maps_array['results'][0]['geometry']['location']['lat'];
  //   $lng = $maps_array['results'][0]['geometry']['location']['lng'];
  //
  //
  //   $insta_url = 'https://api.instagram.com/v1/media/search?lat='.urlencode($lat).'&lng='.urlencode($lng).'&access_token='.urlencode($insta_token);
  //   echo $insta_url.'<br>';
  //   $insta_json = file_get_contents($insta_url);
  //   $insta_array = json_decode($insta_json, true);


?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Geogram</title>
</head>
<body>
  <form class="" action="">
    <input type="text" name="location">
    <input type="submit" name="submit" value="Submit">
  </form>
</body>
</html> -->
<?php
$insta_token = '472964571.7b02da4.77ddc604c86b44e49ba0b2bb479ceb8b';
if (!empty($_GET['location'])) {
    /**
     * Here we build the url we'll be using to access the google maps api
     */

    $maps_url = 'https://' .
        'maps.googleapis.com/' .
        'maps/api/geocode/json' .
        '?address=' . urlencode($_GET['location']);
    $maps_json = file_get_contents($maps_url);
    $maps_array = json_decode($maps_json, true);
    $lat = $maps_array['results'][0]['geometry']['location']['lat'];
    $lng = $maps_array['results'][0]['geometry']['location']['lng'];
    /**
     * Time to make our Instagram api request. We'll build the url using the
     * coordinate values returned by the google maps api
     */
    $url = 'https://' .
        'api.instagram.com/v1/media/search' .
        '?lat=' . $lat .
        '&lng=' . $lng .
        '&access_token='.urlencode($insta_token);
    $json = file_get_contents($url);
    $array = json_decode($json, true);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>geogram</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="script.js"></script>
</head>
<body>
<form action="" method="get">
    <input type="text" name="location"/>
    <button type="submit">Submit</button>
</form>
<br/>
<div id="results" data-url="<?php if (!empty($url)) echo $url ?>">
    <?php
    if (!empty($array)) {
        foreach ($array['data'] as $key => $item) {
            echo '<img id="' . $item['id'] . '" src="' . $item['images']['low_resolution']['url'] . '" alt=""/><br/>';
        }
    }
    ?>
</div>
</body>
</html>
