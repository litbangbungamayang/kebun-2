<?= $this->extend('Templates/app_layout'); ?>

<?= $this->section('header'); ?>

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="wrapper">
  <?= $this->include('Templates/sidemenu') ?>
  <div class="page-wrapper">
    <div class="container-xl">
      <!-- Page title -->
      <div class="page-header d-print-none">
        <div class="row align-items-center">
          <div class="col">
            <h2 class="page-title">
              <? echo session('nm_unit'); ?>
            </h2>
            <form action="upload.php" method="post" enctype="multipart/form-data">
              Select image to upload:
              <input type="file" name="fileToUpload" id="fileToUpload">
              <input type="submit" value="Upload Image" name="submit">
            </form>
            <?
              //require_once 'google-api-php-client/src/Google_Client.php';
              //require_once 'google-api-php-client/src/contrib/Google_DriveService.php';
              require_once 'public/google-api-php-client-[2.13.0]/vendor/autoload.php';
              require_once 'public/google-api-php-client-services-main/autoload.php';
              //create a Google OAuth client
              $client = new Google_Client();
              $client->setClientId('702586828602-ab2njos9ebhcdc6uoak0o65dl2hfadpt.apps.googleusercontent.com');
              $client->setClientSecret('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');
              $client->setAuthConfig('public/cs.json');
              $auth_url = $client->createAuthUrl();
              header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
              /*
              $redirect = filter_var('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'],
                  FILTER_SANITIZE_URL);
              $client->setRedirectUri($redirect);
              header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
              $client->setScopes(array('https://www.googleapis.com/auth/drive'));
              if(empty($_GET['code']))
              {
                  $client->authenticate();
              }

              if(!empty($_FILES["fileToUpload"]["name"]))
              {
                $target_file=$_FILES["fileToUpload"]["name"];
                // Create the Drive service object
                $accessToken = $client->authenticate($_GET['code']);
                $client->setAccessToken($accessToken);
                $service = new Google_DriveService($client);
                // Create the file on your Google Drive
                $fileMetadata = new Google_Service_Drive_DriveFile(array(
                  'name' => 'My file'));
                $content = file_get_contents($target_file);
                $mimeType=mime_content_type($target_file);
                $file = $driveService->files->create($fileMetadata, array(
                  'data' => $content,
                  'mimeType' => $mimeType,
                  'fields' => 'id'));
                printf("File ID: %s\n", $file->id);
              }
              */
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>

<?= $this->include('Scripts/script_upload'); ?>

<?= $this->endSection(); ?>
