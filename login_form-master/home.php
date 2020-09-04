<?php
session_start();
if(!isset($_SESSION['username'])){
  session_destroy();
  header("Location:index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <title>Forum</title>
</head>

<style>
 body{
    font-family: Poppins;
    max-width: 850px;
    margin:auto;
    background: #f8f8f8;
 }

 .heading{
     display: flex;
     align-items: center;
     justify-content: space-between;
     padding: 50px 0 20px 0;
 }


 .btn-danger{
     margin-left: 20px;
    
 }
 a{
     color: white;
 }

 h1{
    font-family: cursive;
    font-weight: 800;
 }

</style>

<body>
    <section class="header">
        <div class="heading">
            <div>
                <h1>My Forum</h1>
            </div>
            <div style="display: flex; flex-direction:row; align-items:center;">
                <h4><?php echo $_SESSION['username']?> <em>(<?php echo $_SESSION['account']?>)</em></h4>
                <button class="btn btn-danger"><a href="logout.inc.php">Logout</a></button>
            </div>      
        </div>
        <div class="main">
            <form id="comment_form" method="post">
                <div class="form-group">
                    <select name="comment_name" id="comment_name" class="form-control">
                        <option value="" disabled selected>Enter Topic</option>
                        <option value="a">a</option>
                        <option value="b">b</option>
                        <option value="c">c</option>
                        <option value="d">d</option>
                        <option value="e">e</option>
                    </select>
                </div>

                <div class="form-group">
                    <textarea name="comment_content" id="comment_content" class="form-control" placeholder="Enter Comment" cols="30" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <input type="hidden" name="comment_id" id="comment_id" value="0" />
                    <input type="submit" value="Submit" name="submit" id="submit" class="btn btn-info" />
                </div>
            </form>
            <div style=" margin-bottom: 30px;">
                <span id="comment_message"></span>
            </div>
            <div id="display_comment"></div>
        </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){

        $("#comment_form").on('submit', function(event) {
            event.preventDefault();
            var form_data = $(this).serialize();

            $.ajax({
                url: "add_comment.php",
                method: "POST",
                data: form_data,
                dataType: "JSON",
                success: function(data){
                    if(data.error != "") {
                        $("#comment_form")[0].reset();

                        $("#comment_message").html(data.error);
                        console.log("done");
                    }
                    else {
                        $("#comment_message").html(data.msg);
                        load_comment();
                        $("#upCount").html(data.upCount);
                        $("#downCount").html(data.downCount);
                        $("#upReplyCount").html(data.upCount);
                        $("#downReplyCount").html(data.downCount);
                    }
                }
            });
        });

        function load_comment() {
            $.ajax({
                url: 'fetch_comment.php',
                method: "POST", 
                dataType: "JSON",
                success: function(data){
                    $("#display_comment").html(data.output);
                    $("#comment_name").prop('disabled', false);
                }
            });
        }
        load_comment();
        react();

        $(document).on('click', '.reply', function() {
            var comment_id = $(this).attr("id");
            comment_id = comment_id.replace('comment-', '');
            $("#comment_id").val(comment_id);
            $("#comment_content").focus();
        });

        function deletePost(comment_id) {
            if(confirm("Are you sure you want to delete this comment?")) {
                $.ajax({
                    url: "delete.php",
                    method: "POST",
                    data: {
                    comment_id: comment_id
                    }, success: function (data) {
                        if(data) {
                            $("#panel-"+comment_id).remove();
                            $("#panel-reply-"+comment_id).remove();
                        }
                    }
                });
            }
        }

        $(document).on('click', '.delete', function(){
            var comment_id = $(this).attr("id");
            deletePost(comment_id);
        });

        function react(caller, comment_id, type) {
            $.ajax({
                url: "reactions.php",
                method: "POST",
                dataType: "JSON",
                data: {
                    comment_id: comment_id,
                    type: type
                }, success: function (data) {
                    if(data.status === "updated") {
                        if(type === "up") {
                            $("#down-"+comment_id).css('color', "");
                            $("#upCount").html(data.upCount);
                            $("#upReplyCount").html(data.upCount);
                        }
                        else {
                            $("#up-"+comment_id).css('color', "");
                            $("#downCount").html(data.downCount);
                            $("#downReplyCount").html(data.downCount);
                        }
                    }
                    $(caller).css('color', 'blue');
                    $("#upCount").html(data.upCount);
                    $("#downCount").html(data.downCount);
                    $("#upReplyCount").html(data.upCount);
                    $("#downReplyCount").html(data.downCount);
                }
            });
        }

        $(document).on('click', '.up', function() {
            var comment_id = $(this).attr("id");
            comment_id = comment_id.replace('up-', '');
            react(this, comment_id, "up");
            $(this).css('color','blue');
            $(".down").css('color','black');
        });

        $(document).on('click', '.down', function(){
            var comment_id = $(this).attr("id");
            comment_id = comment_id.replace('down-', '');
            react(this, comment_id, "down");
            $(this).css('color','blue');
            $(".up").css('color','black');
        });

    });
</script>    
</body>
</html> 