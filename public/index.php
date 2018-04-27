<?php require_once('../classes/shittylog.php'); ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- Basic Page Needs
         –––––––––––––––––––––––––––––––––––––––––––––––––– -->
      <meta charset="utf-8">
      <title>Shitty Log Easily Logs Lazy Developers</title>
      <meta name="description" content="Easy Logs for Lazy Developers">
      <meta name="author" content="Berkay Aydin">
      <!-- Mobile Specific Metas
         –––––––––––––––––––––––––––––––––––––––––––––––––– -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- FONT
         –––––––––––––––––––––––––––––––––––––––––––––––––– -->
      <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
      <!-- CSS
         –––––––––––––––––––––––––––––––––––––––––––––––––– -->
      <link rel="stylesheet" href="css/normalize.css">
      <link rel="stylesheet" href="css/skeleton.css">
      <!-- Favicon
         –––––––––––––––––––––––––––––––––––––––––––––––––– -->
      <link rel="icon" type="image/png" href="images/favicon.png">
   </head>
   <body>
      <!-- Primary Page Layout
         –––––––––––––––––––––––––––––––––––––––––––––––––– -->
      <div class="container">
         <div class="row">
            <div class="eleven column" style="margin-top: 5%">
               <h4>Hey Lazy Developer!</h4>
               <p>ShittyLog is a very simple log mechanism! You just need to make a http request to your link. After that you can see the log file as text! </p>
               <table class="u-full-width">
                  <tbody>
                     <tr>
                        <td style="min-width: %25;">Your Log Endpoint</td>
                        <td><a target="_blank" href="<?php echo(USER_ENDPOINT."&logData=sampleLogData"); ?>"><?php echo(USER_ENDPOINT."&logData=sampleLogData"); ?></a></td>
                     </tr>
                     <tr>
                        <td style="width: %25;">Your Log Link</td>
                        <td><a target="_blank" href="<?php echo(USER_LOG_FILE); ?>"><?php echo(USER_LOG_FILE); ?></a></td>
                     </tr>
                  </tbody>
               </table>
               <p>I have created a simple javascript request function for your log purposes! You are free to use it!</p>
               <p>Please copy this function to your project </p>
               <pre><code>
function shittyLog() {
  var argumentsArray = Array.prototype.slice.call(arguments);
  var values = argumentsArray.map(function (singleArgument) {
    var strElement = typeof singleArgument === 'object' ? JSON.stringify(singleArgument, null, 2) : singleArgument;
    return strElement;
  });
  var logData = values.join('\n');

  var httpRequest = new XMLHttpRequest();
  var url = "<?php echo(USER_ENDPOINT); ?>";
  var params = "logData=" + encodeURIComponent(logData);
  httpRequest.open("POST", url, true);

  //Send the proper header information along with the request
  httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  httpRequest.onreadystatechange = function() {//Call a function when the state changes.
      if(httpRequest.readyState == 4 && httpRequest.status == 200) {
          console.log('successfully logged! see it in', "<?php echo(USER_LOG_FILE); ?>");
      }
  }
  httpRequest.send(params);
}        </code></pre>
               <p>Then you can use it like console.log</p>
               <pre><code>
  shittyLog('sample', { json: 'data', example: 3});
</code></pre>
               <p>After that; View it from;     
                  <a href="<?php echo(USER_LOG_FILE); ?>"><?php echo(USER_LOG_FILE); ?></a>
            </div>
         </div>
      </div>
      <!-- End Document
         –––––––––––––––––––––––––––––––––––––––––––––––––– -->
   </body>
</html>