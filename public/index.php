<?php require_once('../classes/shittylog.php'); ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- Basic Page Needs
         –––––––––––––––––––––––––––––––––––––––––––––––––– -->
      <meta charset="utf-8">
      <title>Simple and Fast Logging mechanism for Lazy Developers</title>
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
      <style type="text/css">
        .overflowShit {
          word-break: break-word;
        }
      </style>
   </head>
   <body>
      <!-- Primary Page Layout
         –––––––––––––––––––––––––––––––––––––––––––––––––– -->
      <div class="container">
         <div class="row">
            <div class="eleven column" style="margin-top: 5%">
               <h4>Hey Lazy Developer!</h4>
               <p>ShittyLog is a very simple log mechanism! You just need to make a http request to your link. After that you can see the log file as text!</p>
               <p>You can also use the javascript code <a href="#jsCodeBlockP">below</a></p>
               <p>These links are special for you! Don't worry about it. Also all logs will be deleted weekly.</p>
               <table class="u-full-width">
                  <tbody>
                     <tr>
                        <td>Your Log Endpoint</td>
                        <td ><a target="_blank" href="<?php echo(USER_ENDPOINT."&logData=sampleLogData"); ?>"><?php echo(USER_ENDPOINT."&logData=sampleLogData"); ?></a></td>
                     </tr>
                     <tr>
                        <td>View Your Logs</td>
                        <td class="overflowShit"><a target="_blank" href="<?php echo(USER_LOG_FILE); ?>"><?php echo(USER_LOG_FILE); ?></a></td>
                     </tr>
                     <tr>
                        <td>Data Deletion</td>
                        <td><a target="_blank" href="<?php echo(USER_ENDPOINT."&logData=sampleLogData&del"); ?>">Click here to all existing logs!</a></td>
                     </tr>
                  </tbody>
               </table>
               <p id="jsCodeBlockP">I have created a simple javascript request function for your log purposes! You are free to use it!</p>
               <p>It is working on all browsers and JS environments!</p>
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
               <p>After that; You can view your logs     
                  <a href="<?php echo(USER_LOG_FILE); ?>">here!</a>
            </div>
         </div>
         <p>All files located publicly on <a href="https://github.com/sbayd/shittylog/" target="_blank">GitHub</a></p>
         <p>Created by Berkay Aydin, <a href="https://sbaydin.com" target="_blank">https://sbaydin.com</a></p>
      </div>
      <!-- End Document
         –––––––––––––––––––––––––––––––––––––––––––––––––– -->
      <a
        href="https://github.com/sbayd/shittylog/"
        title="View it on GitHub"
        target="_blank">
        <img
          style="width:50px; position:absolute; top: 3%; right: 20px"
          src="https://assets-cdn.github.com/images/modules/logos_page/GitHub-Mark.png"/>
        </a>
   </body>
</html>