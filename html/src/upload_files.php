<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("Location: login.php");
}

#!! IMPORTANT: 
#!! this file is just an example, it doesn't incorporate any security checks and 
#!! is not recommended to be used in production environment as it is. Be sure to 
#!! revise it and customize to your needs.
// die("Make sure that you enable some form of authentication before removing this line.");

require_once("../components/PluploadHandler.php");

$ph = new PluploadHandler(array(
  'target_dir' => 'files/',
  'allow_extensions' => 'jpg,jpeg,png,svg,pdf,mp3,avi,mp4,mov,webp,zip,csv,xlsx'
));

$ph->sendNoCacheHeaders();
$ph->sendCORSHeaders();

if ($result = $ph->handleUpload()) {
  if (!isset($result['chunk'])) {
    require '../components/config.php';

    $name = implode('.', array_slice(explode('.', $result['name']), 0, -1));
    $size = $result['size'];
    $location = $result['path'];
    $owner = $_SESSION['user'];

    $fileExt = explode('.', $location);

    $extension = strtolower(end($fileExt));
    $fileName =  uniqid('', true);
    $fileNameNew = $fileName . '.' . $extension;
    $fileDestination = 'files/' . $fileNameNew;

    rename($location, $fileDestination);

    if (in_array($extension, array('mp4', 'mov',))) {
      $thumbnail = 'files/' . $fileName . '-thumbnail.jpg';
      $type = 'video';
      // $ffmpeg = FFMpeg\FFMpeg::create();
      // $video = $ffmpeg->open($fileDestination);
      // $video
      //   ->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(10))
      //   ->save($thumbnail);
    } elseif ($extension === 'pdf') {
      $thumbnail = 'files/' . $fileName . '-thumbnail.jpg';
      $type = 'pdf';
      // $imagick = new Imagick($fileDestination . '[0]');
      // $imagick->writeImages($thumbnail, true);
    } elseif ($extension === 'zip') {
      $type = 'zip';
      $thumbnail = 'assets/images/zip.png';
    } elseif (in_array($extension, array('jpg', 'jpeg', 'png', 'svg', 'webp', 'gif', 'bmp', 'tiff'))) {
      $type = 'image';
      $thumbnail = $fileDestination;
    } else {
      $type = 'file';
      $thumbnail = $fileDestination;
    }
    $sql = "INSERT INTO files (name, size, type, extension, location, thumbnail, owner) VALUES ('$name', '$size', '$type', '$extension', '$fileDestination', '$thumbnail', '$owner')";
    $conn->query($sql);
  }
  die(json_encode(array(
    'OK' => 1,
    'info' => $result
  )));
} else {
  die(json_encode(array(
    'OK' => 0,
    'error' => array(
      'code' => $ph->getErrorCode(),
      'message' => $ph->getErrorMessage()
    )
  )));
}
