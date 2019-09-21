<?php

include '/home/yimian/www/settlement/func/functions.php';

$usrArray = ['liu', 'yang', 'li', 'jia', 'zheng'];
$usrMail = Array(
    "liu" => "i@yimian.xyz", 
    "yang" => "boyao1999@163.com", 
    "li" => "x.li203@student.liverpool.ac.uk", 
    "jia" => "mingranjia@163.com", 
    "zheng" => "hao.zheng17@student.xjtlu.edu.cn"
);


foreach($usrArray as $i){
    $s = 'Dear ';
    $s .= $i;
    $s .= ",
    <br>
    <br>
Congratulations!! If you receive this email, it means that the Email System Test was passed, which is the final testing process of our ERP system. This may indicate that, after three days of exceiting coding, testing and debuging, the ERP system of our CP accomodation is now ready to be online and serve you all.
    <br>
    <br>
It has been fully tested that the basic functions of the system are working normally. However, there still some issues known and unknown that needed to be noticed:
    <br>
 &nbsp;&nbsp;&nbsp; 1. The <strong>invoice</strong> upload process are very slowly, due to the cheap price of the server. Please be Patient when you upload an invoice.
    <br>
 &nbsp;&nbsp;&nbsp; 2. Please add this email address (admin@iotcat.xyz) to the <strong>White List </strong>of your email account, in case that you miss any important emails from us.
      <br>
 &nbsp;&nbsp;&nbsp; 3. For ios user, it has been reported that there is a problem that everytime you open the online platform you need to relogin. I am now studying this issue and will try to solve this in the next few days.
    <br>
    <br>
Hopefully, this ERP system will be put into practice <strong>Today Evening</strong> after inputing all the history invoice data into it.
<br>
<br>
It is my great honor to develop this system, with the aiming of facilitating our life. This project is now open-source on Github with a MIT License which allow others to use it for business and non-business purpose. If you have any questions or suggestions, please just feel free to let me know. Let's work together to perfect the system as well as our life..
<br>
<br>
Sincerely Yours,
<br>
Yimian Liu (@iotcat)";


    yimian__mail($usrMail[$i], 'Greeting from ERP - CP Home', $s, 'ERP - CP Home');

    sleep(1);

}



