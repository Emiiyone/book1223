<?php
//共通に使う関数を記述
//XSS対応（ echoする場所で使用！それ以外はNG ）



//htmlspesialcharsを関数に
function h($str) {
    //外で使う時はreturn
    return htmlspecialchars($str, ENT_QUOTES);
  
  }

//   例えて言うと、
// 関数は材料を投入すれば自動で調理してくれるマシーン
// 引数（関数名後ろにつける（）の部分）は材料
// 戻り値（返り値）は受け取った材料を調理した後の料理
// みたいな感じです。

// Function curry(meat,vegetable)　という関数名・引数だったとき、
// 実行するときにcurry(beef,onion)と実行すると、
// 牛肉と玉ねぎで作ったカレーが出てくるみたいな🍛

// 引数：生こめ
// 関数：炊飯器
// 戻り値：ほかほかごはん
