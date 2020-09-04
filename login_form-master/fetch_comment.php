<?php

session_start();
require 'config.inc.php';


$query = "SELECT * FROM comment_system WHERE parent_comment_id = '0' ORDER BY comment_id DESC";
$result = mysqli_query($connect, $query);
$account = $_SESSION['account'];
$output = "";
 while ($row = mysqli_fetch_assoc($result)){
   if($account == "master"){
   $output .= '
      <div class = "panel panel-default" id="panel-'.$row['comment_id'].'">
        <div class="panel-heading"> By <b>' .$row['comment_sender_name']. '</b> on <i>' .$row['date']. '</i> about <b>' .$row['topic_name']. '</b></div>
        <div class="panel-body">' .$row['comment']. '</div>
        <div class="panel-footer" align="right"><i id="upCount"></i><i class="fa fa-2x fa-thumbs-up up" id="up-'.$row['comment_id'].'" style="padding: 0 10px" aria-hidden="true"></i><i id="downCount"></i><i class="fa fa-2x fa-thumbs-down down" id="down-'.$row['comment_id'].'" style="padding: 0 10px" aria-hidden="true"></i><button type="button" class="btn btn-secondary reply" id="comment-'.$row['comment_id'].'">Reply</button><button type="button" class="btn btn-warning delete" id="'.$row['comment_id'].'">
        Delete</button></div></div>' ;
        $output .= get_reply_comment($connect, $row['comment_id'], 0, $account);
      } else {
        $output .= '
           <div class = "panel panel-default" id="panel-'.$row['comment_id'].'">
             <div class="panel-heading"> By <b>' .$row['comment_sender_name']. '</b> on <i>' .$row['date']. '</i> about <b>' .$row['topic_name']. '</b></div>
             <div class="panel-body">' .$row['comment']. '</div>
             <div class="panel-footer" align="right"><i id="upCount"></i><i class="fa fa-2x fa-thumbs-up up" id="up-'.$row['comment_id'].'" style="padding: 0 10px" aria-hidden="true"></i><i id="downCount"></i><i class="fa fa-2x fa-thumbs-down down" id="down-'.$row['comment_id'].'" style="padding: 0 10px" aria-hidden="true"></i><button type="button" class="btn btn-secondary reply" id="comment-'.$row['comment_id'].'">
             Reply</button></div></div>' ;
             $output .= get_reply_comment($connect, $row['comment_id'], 0, $account);
      }
   }
   

function get_reply_comment($connect, $parent_id = 0, $marginleft = 0, $account){
       
    
  $query = "SELECT * FROM comment_system WHERE parent_comment_id= '" .$parent_id. "'";
  $output = "";
  $result = mysqli_query($connect, $query);
  if($parent_id == 0){
    $marginleft = 0;
  }
  else {
    $marginleft = $marginleft + 48;
  }
  while ($row = mysqli_fetch_assoc($result)){
      if($account == "client"){
    $output .= '<div class="panel panel-default" id="panel-reply-'.$row['comment_id'].'" style="margin-left : ' .$marginleft. 'px">
    <div class="panel-heading"> By <b>' .$row['comment_sender_name']. '</b> on <i>'  .$row['date']. '</i></div>
    <div class="panel-body">' .$row['comment']. '</div>
    <div class="panel-footer" align="right"><i id="upReplyCount"></i><i class="fa fa-2x fa-thumbs-up up" id="up-'.$row['comment_id'].'" style="padding: 0 10px" aria-hidden="true"></i><i id="downReplyCount"></i><i class="fa fa-2x fa-thumbs-down down" id="down-'.$row['comment_id'].'" style="padding: 0 10px" aria-hidden="true"></i><button type="button" class="btn btn-secondary reply" id="comment-'.$row['comment_id'].'">
    Reply</button></div></div>' ;
    $output .= get_reply_comment($connect, $row['comment_id'], $marginleft, $account);
      }else {
         $output .= '<div class="panel panel-default" id="panel-reply-'.$row['comment_id'].'" style="margin-left : ' .$marginleft. 'px">
    <div class="panel-heading"> By <b>' .$row['comment_sender_name']. '</b> on <i>'  .$row['date']. '</i></div>
    <div class="panel-body">' .$row['comment']. '</div>
    <div class="panel-footer" align="right"><i id="upReplyCount"></i><i class="fa fa-2x fa-thumbs-up up" id="up-'.$row['comment_id'].'" style="padding: 0 10px" aria-hidden="true"></i><i id="downReplyCount"></i><i class="fa fa-2x fa-thumbs-down down" id="down-'.$row['comment_id'].'" style="padding: 0 10px" aria-hidden="true"></i><button type="button" class="btn btn-secondary reply" id="comment-'.$row['comment_id'].'">
    Reply</button><button type="button" class="btn btn-warning delete" id="'.$row['comment_id'].'">
        Delete</button></div></div>' ;
    $output .= get_reply_comment($connect, $row['comment_id'], $marginleft, $account); 
      }
  }

  return $output;
}
$data = array(
       'output' => $output,
       
       );
echo json_encode($data);

?>