<?php
    include 'inc/mail.inc.php';
    $sender = 'info@newcomersunion.com';
    $recipient = 'etiketochukwu@gmail.com';
    $body = 'test mail';
    $subject = 'test subject';
    $test = _sendmail($sender, $recipient, $body, $subject);
    var_dump($test);
?>

<div class="leave_comment_wrapper">
                                        <div class="items_title">
                                            <h3 class="title">Leave A Comment</h3>
                                            <p>You need to be sure there isn't anything embarrassing hidden in the repeat predefined</p>
                                        </div>
                                        <div class="leave_comment">
                                            <div class="contact_form">
                                                <form action="#">
                                                    <div class="row">
                                                        <div class="col-12 col-sm-12 col-md-6 form-group">
                                                        <input type="text" class="form-control" id="name"  placeholder="Name">
                                                        </div>
                                                        <div class="col-12 col-sm-12 col-md-6 form-group">
                                                            <input type="email" class="form-control" id="email" placeholder="Email">
                                                        </div>
                                                        <div class="col-12 col-sm-12 col-md-12 form-group">
                                                            <textarea class="form-control" id="comment" placeholder="Your Comment Wite Here ..."></textarea>
                                                        </div>


                                                        <div class="col-12 col-sm-12 col-md-12 submit-btn">
                                                            <button type="submit" class="text-center">Post Comment</button>
                                                        </div>
                                                    </div>
                                                </form>   
                                            </div>
                                        </div> 
                                    </div>