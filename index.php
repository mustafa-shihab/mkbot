<?php
ob_start();
error_reporting(0);
date_default_timezone_set('Asia/syria');
//--------[Your Config]--------//
$Dev = **ADMIN**;
$Token = "**TOKEN**";
$channel = "@bots_syria";
$logchannel = 756581984;
$host_folder = "https://nndnd.cf/twasls";
//-----------------------------//
define('API_KEY',$Token);
//------------------------------------------------------------------------------
function bot($method,$datas=[]){$BOT_SYRIA = http_build_query($datas);
$url = "https://api.telegram.org/bot".API_KEY."/".$method."?$BOT_SYRIA";
$BOTS_SYR1A = file_get_contents($url); return json_decode($BOTS_SYR1A);}

//------------------------------------------------------------------------------
function CrZip($folder_to_zip_path, $destination_zip_file_path){
        $rootPath = realpath($folder_to_zip_path);
        
        $zip = new ZipArchive();
        $zip->open($destination_zip_file_path, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        $files = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($rootPath),
                RecursiveIteratorIterator::LEAVES_ONLY
        );
       
        foreach($files as $name => $file){
            if(!$file->isDir()){
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($rootPath) + 1);
                $zip->addFile($filePath, $relativePath);
            }
        }
        $zip->close();
}
function DeleteFolder($path){
	if($handle=opendir($path)){
		while (false!==($file=readdir($handle))){
			if($file<>"." AND $file<>".."){
				if(is_file($path.'/'.$file)){ 
					@unlink($path.'/'.$file);
				} 
				if(is_dir($path.'/'.$file)) { 
					deletefolder($path.'/'.$file); 
					@rmdir($path.'/'.$file); 
				}
			}
        }
    }
}
//------------------------------------------------------------------------------
function SendMessage($chat_id,$text,$mode,$reply = null,$keyboard = null){
	bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>$text,
	'parse_mode'=>$mode,
	'reply_to_message_id'=>$reply,
	'reply_markup'=>$keyboard
	]);
}
function SendDocument($chatid,$document,$caption = null){
	bot('SendDocument',[
	'chat_id'=>$chatid,
	'document'=>$document,
	'caption'=>$caption
	]);
}
function Forward($chatid,$from_id,$massege_id){
	bot('ForwardMessage',[
    'chat_id'=>$chatid,
    'from_chat_id'=>$from_id,
    'message_id'=>$massege_id
    ]);
}
function GetChat($chatid){
	$get =  bot('GetChat',['chat_id'=>$chatid]);
	return $get;
}
function GetMe(){
	$get =  bot('GetMe',[]);
	return $get;
}

//------------------------------------------------------------------------------
$update = json_decode(file_get_contents('php://input'));
if(isset($update->message)){
    $message = $update->message; 
    $chat_id = $message->chat->id;
    $text = $message->text;
    $message_id = $message->message_id;
    $from_id = $message->from->id;
    $tc = $message->chat->type;
    $first_name = $message->from->first_name;
    $last_name = $message->from->last_name;
    $username = $message->from->username;
    $caption = $message->caption;
    $reply = $message->reply_to_message->forward_from->id;
    $reply_id = $message->reply_to_message->from->id;
}
if(isset($update->callback_query)){
    $Data = $update->callback_query->data;
    $data_id = $update->callback_query->id;
    $chatid = $update->callback_query->message->chat->id;
    $fromid = $update->callback_query->from->id;
    $tccall = $update->callback_query->chat->type;
    $messageid = $update->callback_query->message->message_id;
}
//------------------------------------------------------------------------------
$get = Bot('GetChatMember',[
'chat_id'=>$channel,
'user_id'=>$from_id]);
$rank = $get->result->status;
//------------------------------------------------------Buttons
if($from_id != $Dev){
$menu = json_encode(['keyboard'=>[
[['text'=>"- صنع بوت ، 📢 ؛"],['text'=>"- حذف البوت ، 📌 ؛"]],
[['text'=>"- الخيارات والمساعدة ، 🌈 ؛"]],
[['text'=>"- قوانين البوت ، 📌 ؛"],['text'=>"- ارسال اقتراح ، 📗 ؛"]],
[['text'=>"- البوتات التي قمت بصنعها ، 🥥 ؛"]],
],'resize_keyboard'=>true]);
}else{
$menu = json_encode(['keyboard'=>[
[['text'=>"- صنع بوت ، 📢 ؛"],['text'=>"- حذف البوت ، 📌 ؛"]],
[['text'=>"- الخيارات والمساعدة ، 🌈 ؛"]],
[['text'=>"- قوانين البوت ، 📌 ؛"],['text'=>"- ارسال اقتراح ، 📗 ؛"]],
[['text'=>"- البوتات التي قمت بصنعها ، 🥥 ؛"]],
[['text'=>"- اوامر المطور ، 👮‍♂ ؛"]],
],'resize_keyboard'=>true]);
}
//-------------------------------------------------Dev
$panel = json_encode(['keyboard'=>[
[['text'=>"- تحديث البوتات ، 🔄 ؛"],['text'=>"- الإحصائيات ، 📈 ؛"]],
[['text'=>"- رسالة للكل ، 🔉 ؛"],['text'=>"- توجيه للكل ، 🔉 ؛"]],
[['text'=>"- حظر بوت ، ✖️ ؛"],['text'=>"- نسخة إحطياطية ، 🗃 ؛"]],
[['text'=>"- الغاء حظر عام ، 🔈 ؛"],['text'=>"- حظر عام ، 🔇 ؛"]],
[['text'=>"- العودة الى القائمةه الرئيسيةه ، ↪️ ؛"]],
],'resize_keyboard'=>true]);
//-------------------------------------------------help//
$helped = json_encode(['keyboard'=>[
[['text'=>"- الاسئلةه المتكررة ، 💸 ؛"],['text'=>"- اعادة تشغيل ، 🎭 ؛"]],
[['text'=>"- شرح مفصل لانشاء البوت ، ⛱ ؛"]],
[['text'=>"- العودة الى القائمةه الرئيسيةه ، ↪️ ؛"]],
],'resize_keyboard'=>true]);
//-------------------------------------------------Other
$back = json_encode(['keyboard'=>[
[['text'=>"- العودة الى القائمةه الرئيسيةه ، ↪️ ؛"]]
],'resize_keyboard'=>true]);
$backpanel = json_encode(['keyboard'=>[
[['text'=>"- العودة الى القائمةه الرئيسيةه ،   ↪️ ؛"]]
],'resize_keyboard'=>true]);
$request = json_encode(['keyboard'=>[
[['text'=>"- تأكيد هويتك ،  🔑 ؛",'request_contact'=>true]]
],'resize_keyboard'=>true]);
$remove = json_encode(['KeyboardRemove'=>[],'remove_keyboard'=>true]);
//------------------------------------------------------------------------------
//--------[Json]--------//
@$list = json_decode(file_get_contents("Data/list.json"),true);
@$data = json_decode(file_get_contents("Data/$from_id/data.json"),true);
@$step = $data['step'];
//------------------------------------------------------------------------------
if(in_array($from_id, $list['ban'])){
	SendMessage($chat_id,"- تم حظرك عام ممنوع صنع بوتات هنا ، ✖️ ؛", null, $message_id, $remove);
	exit();
}
elseif(preg_match('/^\/(start)$/i',$text)){
	SendMessage($chat_id,"
- اهلا بك عزيزي ؛ $first_name ،

- في البوت الرسمي لصنع بوتات التواصل ، 👇🏿♥️ !

- باستخدام هذه الخدمةه يمكن للمحظورين التواصل معك عبر بوت التواصل الذي سوف تصنعه ، 📡 ؛  
asss
- يحتوي البوت الذي يتم صنعه على مميزات وسرعه عالية تتميز عن باقي البوتات وعدم توقف البوت المصنوع مدى الحياة ، ⚠️
﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎
", null, $message_id, $menu);
	$data['step'] = "none";
	file_put_contents("Data/$from_id/data.json",json_encode($data));
	$first_name = str_replace(["<",">"], null, $first_name);
	SendMessage($logchannel,"
- العضو ،  👤 <a href='tg://user?id=$from_id'>$first_name</a> ؛
- قام بإرسال /start ،  🚶‍♂ ؛
", 'Html', null);
}
elseif($rank == 'left'){
	SendMessage($chat_id,"
- عزيزي ،  👤 <a href='tg://user?id=$from_id'>$first_name</a> ؛
- لا يمكنك استخدام البوت الى وبعد الاشتراك في قناة البوت ؛ للاشتراك بالقناة $channel  ، ♥️ ؛
﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎
", null, $message_id, $remove);
}
elseif($text == "- العودة الى القائمةه الرئيسيةه ، ↪️ ؛"){
	$data['step'] = "none";
	file_put_contents("Data/$from_id/data.json",json_encode($data));
	SendMessage($chat_id,"
- اهلا بك عزيزي ؛ $first_name ،

- في البوت الرسمي لصنع بوتات حماية القنوات ، 👇🏿♥️ !

- باستخدام هذه الخدمةه يمكن حماية قناتك من الادمنية ومنع تفليش القناة ، 📡 ؛  

- يحتوي البوت الذي يتم صنعه على مميزات وسرعه عالية تتميز عن باقي البوتات وعدم توقف البوت المصنوع مدى الحياة ، ⚠️
﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎
", null, $message_id, $menu);
}
elseif($text == "- صنع بوت ، 📢 ؛"){
//	if($data['phone'] != null){
		$data['step'] = "create";
		file_put_contents("Data/$from_id/data.json",json_encode($data));
		SendMessage($chat_id,"
- الان قم بارسال التوكن الخاص بك ؛ او قم بعمل توجيه للتوكن من ؛ @BotFather . 🍿 ؛
﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎
", null, $message_id, $back);
	} /* else{
		$data['step'] = "phone";
		file_put_contents("Data/$from_id/data.json",json_encode($data));
		SendMessage($chat_id,"
- البوت محمي عزيزي من المخربين يجب اثبات هويتك اضغط على الزر بالاسفل لتأكيدها ؛
﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎
- 📌 سيتم مشاركة رقمك فقط عند المطور لن يستطيع احد اخذ رقمك
- ❤️ نحن نقدر هذا الامر ولكن هذا لحمايتك من المخربين سيتم حفظ رقمك لمرة واحدة 
- © خصوصيتك ورقمك محفوظة من المخربين
- ⚠️ بمجرد الضغط على تأكيد هويتك فأنت توافق على الشروط الموجودة في الأعلى
", 'MarkDown', $message_id, $request);
	}
} */
elseif($step == "create"){
	if(strpos($text, "Here is the token for bot") !== true and strpos($text, "Use this token to") !== true){
		$token = $text;
	}
	if(strpos($text, "Here is the token for bot") !== false){
		$token = preg_replace('/(Here is the token for bot)(.*)/', null, $text);
		$token = str_replace("\n", null, $token);
	}
	if(strpos($text, "Use this token to") !== false){
		$token = strchr($text,"Use this token to access the http API:");
		$token = str_replace(["Use this token to access the http API:","For a description of the Bot API, see this page: https://core.telegram.org/bots/api","\n"], null, $token);
	}
	$result = json_decode(file_get_contents('https://api.telegram.org/bot'.$token.'/getMe'), true);
	$un = $result['result']['username'];
	$ok = $result['ok'];
	
	if($ok == true){
		if(!file_exists("Bots/$un/config.php")){
			$config = file_get_contents("Source/config.php");
			$config = str_replace("756581984", $from_id, $config);
			$config = str_replace("885313427:AAEUVJuljztgwuHOP-YikMRqWTpRM5rvw2U", $token, $config);
		
			mkdir("Bots/$un");
			copy("Source/index.php","Bots/$un/index.php");
			copy("Source/handler.php","Bots/$un/handler.php");
			file_put_contents("Bots/$un/config.php",$config);
			$txt = urlencode("*- شكراً لإستخدامك مصنع البوت أرسل؛* /start");
	        file_get_contents("https://api.telegram.org/bot".$token."/SendMessage?chat_id=".$from_id."&text=".$txt."&parse_mode=MarkDown");
	        $WebHook = file_get_contents("https://api.telegram.org/bot".$token."/SetWebHook?url=$host_folder/Bots/$un/index.php");
			$data['step'] = "none";
			$data['bots'][] = "@$un";
			file_put_contents("Data/$from_id/data.json",json_encode($data));
			SendMessage($chat_id,"
• تم ؛ صنع البوت الخاص بك بنجاح ، الان قم بالدخول الى البوت .. وارسل بدأ اضغط على معرف البوت الذي يوجد بالاسفل للدخول الى البوت . 🦈 !
﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎
- معرف البوت ، ⬅️ ؛ @$un
", null, $message_id, $menu);
			$first_name = str_replace(["<",">"], null, $first_name);
			SendMessage($logchannel,"- العضو ،  👤 <a href= tg://user?id=$from_id >$first_name</a> ؛
- قام بإرسال بصنع بوت ، @$un ؛", 'Html', null);
		}else{
			$data['step'] = "none";
			file_put_contents("Data/$from_id/data.json",json_encode($data));
			SendMessage($chat_id,"- هذا التوكن مستخدم على خادمنا ، ❗️ ؛", null, $message_id, $menu);
		}
	}else{
		SendMessage($chat_id,"- هذا التوكن غير صالح أو مستخدم ، ❕ ؛", null, $message_id, $back);
	}
}
elseif($text == "- البوتات التي قمت بصنعها ، 🥥 ؛"){
	if($data['bots'] != null){
		$bots = implode(" - ", $data['bots']);
		SendMessage($chat_id,"
- قائمةه البوتات التي قمت بصنعها ، ⬇️ ؛
<b>----------------------</b>\n$bots\n<b>----------------------</b>
", 'Html', $message_id);
	}else{
		SendMessage($chat_id,"- ليس لديك بوتات مصنوعة ، ‼️ ؛", null, $message_id);
	}
}
elseif($text == "- حذف البوت ، 📌 ؛"){
	if($data['bots'] != null){
		$data['step'] = "delbot";
		file_put_contents("Data/$from_id/data.json",json_encode($data));
		foreach($data['bots'] as $key => $name){
			$name = $data['bots'][$key];
			$bots[] = [['text'=>"🤖 $name"]];
		}
		$bots[] = [ ['text'=>"- العودة الى القائمةه الرئيسيةه ، ↪️ ؛"] ];
		$bots = json_encode(['keyboard'=> $bots ,'resize_keyboard'=>true]);
		SendMessage($chat_id,"
- حسناً عزيزي ؛ الرجاء اختيار البوت الذي تود حذفه من الازرار التي توجد ادناه ، 💛👇🏿؛
﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎
", null, $message_id, $bots);
	}else{
		SendMessage($chat_id,"
- عذرا عزيزي انت لا تمتلك بوت ، 📌
- قم بصنع بوتك اولا ، ⚠️
﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎
", null, $message_id);
	}
}
elseif($data['step'] = "delbot" and strpos($text, "🤖 ") !== false){
	$botid = str_replace("🤖 @", null, $text);
	if(in_array("@".$botid, $data['bots'])){
		DeleteFolder("Bots/$botid");
		rmdir("Bots/$botid");
		$data['step'] = "none";
		$search = array_search("@".$botid, $data['bots']);
		unset($data['bots'][$search]);
		$data['bots'] = array_values($data['bots']);
		file_put_contents("Data/$from_id/data.json",json_encode($data));
		SendMessage($chat_id,"
- تم حذف البوت الخاص بك بنجاح ، 📘 ؛
﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎
", null, $message_id, $menu);
		$first_name = str_replace(["<",">"], null, $first_name);
		SendMessage($logchannel," 
- العضو <a href= tg://user?id=$from_id >$first_name</a> 
 قام بحذف بوت ، 📘 ؛
- اسم معرف الذي تم حذفه ؛ @$un ،
﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎
", 'Html', null);
	}else{
		SendMessage($chat_id,"
- هذا المعرف خطأ أو غير موجود ،❗️ ؛
", null, $message_id);
	}
}
elseif($text == "- قوانين البوت ، 📌 ؛"){
	SendMessage($chat_id,"
- قواعد استخدام بوت ، 📕 ؛

- جمیع الخدمات یجب أن تکون حسب قواعد سياسة تيليجرام ، 📝 ؛

- صنع أي بوت ل عمل اعمال لا یرضا الله بها +18 ضد قوانین البوت سیکون عقابه شدید جدا و معه ذالك سیتم حضره من جمیع بوتات و من القناة  ،📡 ؛

- المسؤولية عن الرسائل المتبادلة في كل بوت تقع على عاتق مدير البوت وليس لدينا أي مسؤولية ، ⚠️ ؛

- کل البوتات المصنوعه من بوتاتنا ل اعمال غیر جیده ف یمکنکم ابلاغ الدعم عن هل شي اتمنا لکم التوفیق ، 🇸🇾 ؛
", null, $message_id);
}
elseif($text == "- الخيارات والمساعدة ، 🌈 ؛" ){
		bot('sendMessage',[
'chat_id'=>$chat_id,
'parse_mode' =>"MarkDown",
'disable_web_page_preview' =>true,
'text'=>"
- اختر ما تريد من الكيبورد الذي ضاهر في الاسفل 👇🏻💚 !
﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎
" ,
'reply_markup'=>json_encode(['keyboard'=>[
[['text'=>"- الاسئلةه المتكررة ، 💸 ؛"],['text'=>"- اعادة تشغيل ، 🎭 ؛"]],
[['text'=>"- شرح مفصل لانشاء البوت ، ⛱ ؛"]],
[['text'=>"- العودة الى القائمةه الرئيسيةه ، ↪️ ؛"]],
],'resize_keyboard'=>true
])
]);
	}
	elseif($text == "- الاسئلةه المتكررة ، 💸 ؛" ){
		bot('sendMessage',[
'chat_id'=>$chat_id,
'parse_mode' =>"MarkDown",
'disable_web_page_preview' =>true,
'text'=>"
[• ماهو الـ توكن - TOKEN تيليجرام ؟ 🔰](https://t.me/bot_syria/5)

[• كيف يمكنني الحصول على التوكن - TOKEN ؟ ❕](https://t.me/bot_syria/7)

[• كيف يمكنني صنع بوت ؟ ⚠️](https://t.me/bot_syria/12)

[• كيف يمكنني تحديث بوتي ؟ ⚜](https://t.me/bot_syria/11)

[• كيف يمكنني تغير اسم بوتي ؟ 〽️](https://t.me/bot_syria/9)

[• كيف يمكنني تغير صوره بوتي ؟ 🎇](https://t.me/bot_syria/10)

[• كيف يمكنني تغير وصف بوتي ؟ 🔘](https://t.me/bot_syria/8)

• للمزيد من الاسئله يرجى اختيار زر ارسل اقتراحك الموجود في الاسفل ، 👇🏻💚 

﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎
[- اضغط هنا وتابع جديدنا ، 🇸🇾 ؛](t.me/bots_syria)

" , null, $message_id, $helped]); 
	}
elseif($text == "- اعادة تشغيل ، 🎭 ؛" ){
SendMessage($chat_id,"
- البوت لا يتوقف البوت يقوم بعمل مزامنة كل 200 ثانية سيتم تحديث بوتك تلقائياً، 🔄 ؛
" , null, $message_id, $helped); 
	}
	elseif($text == "- شرح مفصل لانشاء البوت ، ⛱ ؛" ){
bot('sendMessage',[
'chat_id'=>$chat_id,
'parse_mode' =>"MarkDown",
'disable_web_page_preview' =>true,
'text'=>"
[• اضغط هنا للدخول الى شرح كيفيةه عمل بوت خاص بك ، 🦈❤️ ](t.me/bot_syria)
﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎
[- اضغط هنا وتابع جديدنا ، 🇸🇾 ؛](t.me/bots_syria)
", null, $message_id, $helped]); 
	}
	elseif($text == "- ارسال اقتراح ، 📗 ؛" ){
SendMessage($chat_id,"
 يمكنك مراسلة مبرمج البوت  ، 👮‍♀

•عبر المعرف الرسمي للمطور السوري ، ⚠

• المطور @OO1OOOBOT ، 🙎‍♂

• أي خطا بالبوت قم بمراسلتنا ، ⚠"
 , null, $message_id, $helped); 
	}
	
elseif($step == "phone" and isset($message->contact)){
	if($update->message->contact->user_id == $from_id){
		$phone_number =	$message->contact->phone_number;
		$data['step'] = "none";
		$data['phone'] = "+$phone_number";
		file_put_contents("Data/$from_id/data.json",json_encode($data));
		SendMessage($chat_id,"- تم تأكيد هويتك بنجاح ، ✔️ ؛", null, $message_id);
		SendMessage($chat_id,"
- اهلا بك عزيزي ؛ $first_name ،

- في البوت الرسمي لصنع بوتات التواصل ، 👇🏿♥️ !

- باستخدام هذه الخدمةه يمكن للمحظورين التواصل معك عبر بوت التواصل الذي سوف تصنعه ، 📡 ؛  

- يحتوي البوت الذي يتم صنعه على مميزات وسرعه عالية تتميز عن باقي البوتات وعدم توقف البوت المصنوع مدى الحياة ، ⚠️
﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎

", null, null, $menu);
		$first_name = str_replace(["<",">"], null, $first_name);
		SendMessage($logchannel,"
- العضو <a href='tg://user?id=$from_id'>$first_name</a> ، 👤 ؛
- قام بتأكيد هويته في البوت ، 👇؛
", 'Html', null);
		Forward($logchannel,$chat_id,$message_id);
	}else{
		SendMessage($chat_id,"
- لا يمكنك القيام بأي شيئ قبل تأكيد الهوية، 👤 ؛
", null, $message_id, $request);
	}
}
//------------------------------------------------------------------------------
if($from_id == $Dev){
    if($text == "- اوامر المطور ، 👮‍♂ ؛" || $text == "- العودة الى القائمةه الرئيسيةه ،   ↪️ ؛"){
		$data['step'] = "none";
		file_put_contents("Data/$from_id/data.json",json_encode($data));
		SendMessage($chat_id,"
- أهلا بك عزيزي المطور في لوحتك الخاصة ، 👮‍♂ ؛
- لديك مجموعة أوامر يمكنك تنفيذها الآن، 👨‍💻 ؛
- أختر الأمر الموجود بالأسفل لكي يتم تنفيذه، ⚙ ؛
", null, $message_id, $panel);
	}
    elseif($text == "- الإحصائيات ، 📈 ؛"){
		$users = count(scandir("Data"))-4;
		$robots = count(scandir("Bots"))-2;
		
		$count = count($list['user'])-20;
		$lastmem = null;
		foreach($list['user'] as $key => $value){
			if($count <= $key){
				$lastmem .= "[$value](tg://user?id=$value) | ";
				$key++;
			}
		}
		SendMessage($chat_id,"
- عدد المستخدمين هو، 👤 ؛ $users
- عدد البوتات المصنوعة، 🛠 ؛ $robots
- أخر 20 مستخدم من صنع البوت 
$lastmem
", 'MarkDown', $message_id);
	}
	elseif($text == "- تحديث البوتات ، 🔄 ؛"){
		exec("php update.php");
		SendMessage($chat_id,"
- تم تحديث جميع البوتات المصنوعة، 🔂 ؛
", null, $message_id);
	}
	elseif($text == "- نسخة إحطياطية ، 🗃 ؛"){
	    CrZip("../PmResanCr","backup.zip");
	    SendDocument($chat_id,new CURLFile("backup.zip"),"- 🗂 هذه نسخة إحطياطية  ؛");
	    array_map("unlink", glob('backup.zip*?'));
	}
	elseif($text == "- رسالة للكل ، 🔉 ؛"){
		$data['step'] = "s2all";
		file_put_contents("Data/$from_id/data.json",json_encode($data));
		SendMessage($chat_id,"- أرسل رسالتك سيتم إرسالها لجميع المستخدمين ، 👤 ؛", 'MarkDown', $message_id, $backpanel);
	}
	elseif($step == "s2all" and isset($text)){
		$data['step'] = "none";
		file_put_contents("Data/$from_id/data.json",json_encode($data));
		foreach(glob('Data/*') as $value){
		    if(is_dir($value)){
		        $id = pathinfo($value)['filename'];
			    SendMessage($id, $text, null, null, $menu);
		    }
		}
		SendMessage($chat_id,"- تم إرسال رسالتك لجميع المستخدمين ، 👤 ؛", null, null, $panel);
	}
	elseif($text == "- توجيه للكل ، 🔉 ؛"){
		$data['step'] = "f2all";
		file_put_contents("Data/$from_id/data.json",json_encode($data));
		SendMessage($chat_id,"- أرسل رسالتك سيتم إرسالها لجميع المستخدمين ، 👤 ؛", 'MarkDown', $message_id, $backpanel);
	}
	elseif($step == "f2all" and isset($message)){
		$data['step'] = "none";
		file_put_contents("Data/$from_id/data.json",json_encode($data));
		foreach(glob('Data/*') as $value){
		    if(is_dir($value)){
		        $id = pathinfo($value)['filename'];
			    Forward($id,$chat_id,$message_id);
		    }
		}
		SendMessage($chat_id,"- تم إرسال رسالتك لجميع المستخدمين ، 👤 ؛", null, null, $panel);
	}
	elseif($text == "- حظر بوت ، ✖️ ؛"){
		$data['step'] = "deletebot";
		file_put_contents("Data/$from_id/data.json",json_encode($data));
		SendMessage($chat_id,"- أرسل الأن معرف البوت، 🗑 ؛", 'MarkDown', $message_id, $backpanel);
	}
	elseif($step == "deletebot" and isset($text)){
		$data['step'] = "none";
		file_put_contents("Data/$from_id/data.json",json_encode($data));
		$id = str_replace("@", null, $text);
		if(file_exists("Bots/$id/config.php")){
			DeleteFolder("Bots/$id");
			rmdir("Bots/$id");
			SendMessage($chat_id,"- البوت $text تم حظره وحذف بياناته ، 🗑 ؛", null, $message_id, $panel);
		}else{
			SendMessage($chat_id,"- لم يتم العثور على البوت $text ❔ ؛", null, $message_id, $panel);
		}
	}
	elseif($text == "- حظر عام ، 🔇 ؛"){
		$data['step'] = "banuser";
		file_put_contents("Data/$from_id/data.json",json_encode($data));
		SendMessage($chat_id,"
- لحظر العضو من صناعة البوتات ،⚠️ ؛
- أرسل أيدي العضو لحظر الآن ، 🚷 ؛
", 'MarkDown', $message_id, $backpanel);
	}
	elseif($step == "banuser" and is_numeric($text)){
		$data['step'] = "none";
		file_put_contents("Data/$from_id/data.json",json_encode($data));
		if(!in_array($text, $list['ban'])){
			$list['ban'][] = "$text";
			file_put_contents("Data/list.json",json_encode($list, true));
			SendMessage($chat_id,"
- العضو [$text](tg://user?id=$text) 
- تم حظره من صناعة البوتات ، 🚷 ؛
", 'MarkDown', null, $panel);
		}
	}
	elseif($text == "- الغاء حظر عام ، 🔈 ؛"){
		$data['step'] = "unbanuser";
		file_put_contents("Data/$from_id/data.json",json_encode($data));
		SendMessage($chat_id,"
- لإلغاء لحظر العضو من صناعة البوتات ،⚠️ ؛
- أرسل أيدي العضو لفك لحظر الآن ، 🚷 ؛

", 'MarkDown', $message_id, $backpanel);
	}
	elseif($step == "unbanuser" and is_numeric($text)){
		$data['step'] = "none";
		file_put_contents("Data/$from_id/data.json",json_encode($data));
		if(in_array($text, $list['ban'])){
			$search = array_search($text, $list['ban']);
			unset($list['ban'][$search]);
			$list['ban'] = array_values($list['ban']);
			file_put_contents("Data/list.json",json_encode($list, true));
			SendMessage($chat_id,"- العضو [$text](tg://user?id=$text) 
- تم  فك حظره من صناعة البوتات ، 🚷 ؛
", 'MarkDown', null, $panel);
		}
	}
}
//------------------------------------------------------------------------------
if(!is_dir("Data/$from_id") and !is_null($from_id)){
	mkdir("Data/$from_id");
	touch("Data/$from_id/data.json");
    if($list['user'] == null){ $list['user'] = []; }
	array_push($list['user'], $from_id);
	file_put_contents("Data/list.json",json_encode($list));
}

unlink("error_log");
//------------------------------------------------------------------------------

flush();
error_reporting(0);
set_time_limit(0);
$scan = scandir("Bots");
$diff = array_diff($scan, [".",".."]);
foreach($diff as $value){
    copy("Source/index.php","Bots/$value/index.php");
  //  copy("Source/handler.php","Bots/$value/handler.php");
} 
unlink("error_log"); 
//------------------------------------------------------------------------------
ini_set('max_execution_time', 500);
$scan = scandir("Bots");
$diff = array_diff($scan, ['.','..']);
foreach($diff as $value){
    $config = file_get_contents("Bots/".$value."/config.php");
    preg_match_all('/\$Token\s=\s"(.*?)";/', $config, $match);
    $token = $match[1][0];
    file_get_contents("http://api.telegram.org/bot".$token."/setWebHook?url=https://nndnd.cf/twasls/Bots/".$value."/index.php");
}
Echo "End";
?>
	
