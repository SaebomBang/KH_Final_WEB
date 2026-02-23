<?php

function G_str($length){  //함수제작(들어갈값)
$char="0123456789abcdefghijklmnopqrstuvwxyzQWERTYUIOPASDFGHJKLZXCVBNM_";             //사용할문자지정(많이)
$randomStr="";         //↑문자를 넣을 값
$num=$length;
while($num--){      // --는 감소 -> num값이 0이 될때까지 반복
$randomStr.=$char[mt_rand(0,strlen($char)-1)];  //문자안에 무작위n번째를 random값에 추가 
}
return $randomStr;
}

?>