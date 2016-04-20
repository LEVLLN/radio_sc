
<?php
// $status = Yii::app()->db->createCommand()
//     ->select("*")
//     ->from('status')
//     ->queryRow();
// foreach ($status as $key => $value) {
// 	# code...
// 	if($key=="status_id"){
// 		echo $key.=" {$value} <br>"  ;

// 	}
// 	if($key=="status_name"){

// 		echo $key.=" {$value}";
// 	}
	
	 $id = 228;
	$users = Yii::app()->db->createCommand()->select('*')->from('user')->where('id=:id', array(':id'=>$id))->queryAll();
	print_r($users);
	// echo "<br>  {$users[0]["password"]} ";
    
    ?> 