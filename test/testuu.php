<?php
    require_once 'files/utils/userUtil.php';
    $userLessons    =   userUtil::show_user_lessons("lucio");
    print_r($userLessons);
    foreach ($userLessons as $lesson){
        print_r($lesson);
        echo "***" . $lesson['title'] ['locale_en_US']  . "*******" . $lesson['_id'];
    }
?>
   