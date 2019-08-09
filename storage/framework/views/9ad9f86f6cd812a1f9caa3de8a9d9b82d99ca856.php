<!-- Emails use the XHTML Strict doctype -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!-- The character set should be utf-8 -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width"/>
    <!-- Link to the email's CSS, which will be inlined into the email -->
    <link rel="stylesheet" href="/public/css/foundation-emails.css">
    <style>
        body {
            font-family: Sans-Serif;
        }
    </style>
</head>

<body>
<!-- Wrapper for the body of the email -->
<table class="body" data-made-with-foundation>
    <tr>
        <!-- The class, align, and <center> tag center the container -->
        <td class="float-center" align="center" valign="top">
            <center>
                <p>New record added to the database. <br>
                <hr>
                <b>User ID:</b>  <?php echo e(auth()->id()); ?><br>
                <b>Table:</b> <?php echo e($table); ?> <br>
                <b>Record ID: </b> <?php echo e($id); ?>

            </center>
        </td>
    </tr>
</table>
</body>
</html>
<?php /**PATH C:\contacts_api\resources\views/emails/recordadded.blade.php ENDPATH**/ ?>