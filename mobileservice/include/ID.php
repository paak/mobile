<?php 

$OpenNotification1on1="true";   //1on1
$mode="PRODUCTION"; //PRODUCTION or DEVELOPMENT

//-----event---------
$id="84";
$name_abbr="WCAS";
$conf_name ="WCAFirst2018"; // use for no show

$MEETING_ID = "WCAS";
$NETWORK = "WCA";

//-------
$url="https://conference.wcaworld.com/wcafirst2018/mobileservice/";
//$url="http://dev.conference.wcaworld.com/wcafirst2017/mobileservice/";

$url_ref="conference.wcaworld.com/wcafirst2018/mobileservice/";  // user for banner of product*/

$path_comp_face="http://conference.wcaworld.com/image2018/upload/face/";
$path_comp_logo="http://conference.wcaworld.com/image2018/upload/logos/";
$path_qrcode_img="http://conference.wcaworld.com/image2018/upload/qrcode_img/";
//--------------- last updated by Frank at 14:24 GMT+8 Mar 31 2008 --------------------

$latitude="1.2937";
$longitude="103.8572";

//--------------------
$ShowShuttleBus=false;
$ShowBanner=true;
$ShowQN=false; //Questionnaire
//--------------------

$SEND_MAIL_STATUS=true;
$G_STATUS_EXT="";
//------------------------------------
$G_REGION=false;
$G_COUPON_CODE=false;
$G_ACW="A1C2W3";
$G_VOICE="voti";
//------------------------------------
$G_CLC_CLUB=false;
$G_CLC_CLUB_CODE="CLC2012";
//------------------------------------
$G_ACCOUNTING_USA="phomann@wcafamily.com";
//$IMPORT_DELEGATE = true;

//---------Yoo: 2011 Apr 21-----------
$G_MEMBER_NETWOEK = "member_".strtolower($NETWORK);
//------------------------------------

$rgbNew = "#FFCCCC";
$rgbOld = "#CCFFCC";
//------------------------------ Turn on/off feature -------------------------------------

$G_BACKGROUND="#FFFFFF";
$G_ENABLE_GUIDEBOOK=true; 
$G_ENABLE_TIME_AGENDA = true; //true = 30 minute ; false = able to customize time
$G_ENABLE_NON_MEMBER = true;
$G_ENABLE_INVITATION_LETTER = false;
$G_ENABLE_INVITATION_LETTER_LINK = "../download/Invitation Letter WCAF 2012.doc";
//$G_ENABLE_SERVICES = true; // old
#BARCODE

$G_ENABLE_BARCODE=false; 
$G_REQUIRE_PASSPORT=false; 
$G_DELETE_BY_MEMBER=true;


$G_MAIL_USERNAME="1on1WCAFirst@wcasys.com";
$G_MAIL_PASSWORD="Gap97637";

//$G_ENABLE_HOTEL = true;
//$G_ENABLE_DINNER = true; <-- do not put in admin_meetingProfile.php

//$G_ALLOW_NON_MEMBER_1ON1_WITHOUT_PAID=false;  //  removed because it's the same meaning with $G_ALLOW_NON_MEMBER_1ON1_COMPID // puth


// ====group meeting====//
$groupMeetingFeature=false;
$oneTimeSlot=false;  // if true, group meeting will use one time slot per one group meeting. if false, one group meeting can use more than one time slot. (=radio or checkbox)
//$maxParticipants = 5;
// ====


$G_ATTENDEE_NETWORK = array("WCA", "WCAF", "WCA_WCAF"); // <----------- Put the network here
//$G_ATTENDEE_NETWORK = array("WCA","APLN","IGLN");

for($i=0;$i<count($G_ATTENDEE_NETWORK);$i++){
	$join_network[$G_ATTENDEE_NETWORK[$i]] = "join_".$G_ATTENDEE_NETWORK[$i];
}

$G_ATTENDEE_NETWORK_1ON1 = array("WCA", "WCAF"); //Yoo: 2012 Feb 2



/*----------------------------------- Multi-language Variables------------------------------------*/

/*-----------------------------------TEXT for editprofile Start------------------------------------*/

$text_logo[0] = "Your company logo on WCA Family's website is";
$text_logo[1] = "您公司在WCA Family 网站上的标识为：";
$text_upload[0] = "Upload company logo";
$text_upload[1] = "上传您的公司标识";
$text_uselogo[0] = "Use this company logo or";
$text_uselogo[1] = "使用此公司标识，或者";
$note_upload[0]="*Please upload your logo in JPG, BMP, GIF or TIF format and make sure there are no Chinese characters in the filename.";
$note_upload[1]="*上传图片格式为JPG, BMP, GIF, TIF， 并且文件名和路径都必须为英文字符，例如：c:\logo.jpg.，不能出现中文！";
$text_commonname[0] = "Common Company Name";
$text_commonname[1] = "常用公司名称";
$text_youare[0] = "Are you a CIFA member?&nbsp;";
$text_youare[1] = "您是CIFA会员吗？";

if ($G_ENABLE_GUIDEBOOK) {
$text_notecommon[0] = "<strong><u><font color=\"#FF0000\">Common Company Name</font></u></strong>: We have members that have same or  similar company names operating in different <font color=\"#FF0000\">cities/countries</font>. In most cases, these are branch names and are  the same or similar but have different company endings such as Inc., Ltd., Pty., etc. <font color=\"#FF0000\">For the purposes of the conference directory and name badges, each company  should use a <u>common company name</u>. </font>This will help make our conference directory index more useful.<BR>
<BR>
<U>Example</U>: would be ACI Cargo, Inc., which is located in the USA and ACI Cargo Logistica, S.A., which is located in Colombia.<BR>
<BR>
<u>We recommend they use &quot;ACI  Cargo&quot; as their common company name</u>.The conference directory and name  badge would then show ACI Cargo with the locations as, Barranquilla,  Buenaventura, Bogota,  Cartagena, and Miami.";
}
else {
$text_notecommon[0] = "<strong><u><font color=\"#FF0000\">Common Company Name</font></u></strong>: We have members that have same or  similar company names operating in different <font color=\"#FF0000\">cities/countries</font>. In most cases, these are branch names and are  the same or similar but have different company endings such as Inc., Ltd., Pty., etc. <font color=\"#FF0000\">For the purposes of the conference name badges, each company  should use a <u>common company name</u>. </font>This will help make our conference index more useful.<BR>
<BR>
<U>Example</U>: would be ACI Cargo, Inc., which is located in the USA and ACI Cargo Logistica, S.A., which is located in Colombia.<BR>
<BR>
<u>We recommend they use &quot;ACI  Cargo&quot; as their common company name</u>. The conference name badge would then show ACI Cargo with the locations as, Barranquilla,  Buenaventura, Bogota,  Cartagena, and Miami.";

}

$text_notecommon[1] = "<strong><font color=red>什么是<u>常用公司名称</u>：</strong></font> 许多成员在不同的<font color='red'>城市或国家</font>会使用不同的公司名称。一般来说，这些名称都有统一的格式，仅仅是公司后缀不同，如：Ltd，Pty等等。<font color='red'>为了方便在会刊和吊牌上显示您的公司名称，每个公司需要使用<u>常用公司名称</u>。</font>这样将大大有利于使用会刊的目录索引功能。<BR>
<BR>
<U><strong>例如</strong></U> ：ACI Cargo, Inc., 是在 USA使用的公司名；ACI Cargo Logistica, S.A., 是在哥伦比亚使用的公司名。<BR>
<BR>
<U>我们建议他们使用ACI Cargo作为他们的常用公司名称</U>。 这样，会刊和吊牌上则会显示ACI Cargo，并注明了其每个公司的所在地Baranquilla, Buenaventura , Bogota , Cartagena, and Miami。请在以下框内输入您公司的常用公司名。";

if ($G_ENABLE_GUIDEBOOK) {
$text_noteprofile[0] = "<b>Please input your company profile.(Note the maximum length of this field is 450 characters with spaces).
$ADDITIONAL_CONTENT_EDITPROFILE
</b>
<BR><BR>

<U>Important:</U> You should review the company profile below because this profile has been imported from our membership database and in the database and our website the field length is not limited, while in the printed edition of the conference guide book the field is limited to 450 characters or less. Therefore, any text after the 450th character would be cut off during the data import, and this could make the profile make no sense. Note changes made here will have no effect on your company profile on the website but only in the conference guide book";
} 
else {
$text_noteprofile[0] = "<b>Please input your company profile. (Note the maximum length of this field is 450 characters with spaces).
$ADDITIONAL_CONTENT_EDITPROFILE
</b>
<BR><BR>

<U>Important:</U> You should review the company profile below because this profile has been imported from our membership database and in the database and our $G_MEETING_NAME_SHORT website the field length is not limited while in the advance search the field is limited to 450 characters or less. Note changes made here will have no effect on your company profile on the website.";

}

$text_noteprofile[1] = "<b>请输入您在
$G_MEETING_NAME
会刊上的公司简介。<A  onMouseOver=\"style.cursor='hand'\" Onclick=\"window.open('conferenceBookMap.php', 'ExampleGuideBook','toolbar=no,scrollbars=no,resizable=no,width=725,height=555');\"><font color=blue><U><B>点击这里</B></U></font></A>
查看示例. 
(请使用英语并勿超过450个字符).
$ADDITIONAL_CONTENT_EDITPROFILE
</b>
<BR><BR>
<U>重要提示:</U> 请您务必检查以下所显示的内容，由于这些内容是从数据库中读取的，虽然我们的数据库以及
$G_MEETING_NAME_SHORT
网站并不限制字数，但是出现在会刊上的内容必须在450个字符以内。 所以，超过450个字符的部分将在读取的过程中省略，这有可能造成文字内容的不完整。不过您不用担心在这里的修改会影响您在WCA Family其他网站上的内容，此修改后的内容只在会刊上用到。";
$text_characters[0] = "Characters count:";
$text_characters[1] = "字数";
$text_address[0] = "Address";
$text_address[1] = "地址";
$text_phone[0] = "Phone";
$text_phone[1] = "电话";
$text_fax[0] = "Fax";
$text_fax[1] = "传真";
$text_contactemail[0] = "Contact Email";
$text_contactemail[1] = "Email";
$text_website[0] = "Website";
$text_website[1] = "网站";
$text_selectcity[0] = "Please select all of your office cities.";
$text_selectcity[1] = "请选择您所有办公室所在的城市：";
$text_citylist[0] = "City List";
$text_citylist[1] = "选择城市" ;
$text_newfeature[0] = "<B>NEW ADVANCED FEATURE - OPTIMIZE YOUR CONFERENCE TIME!</B>
	<BR>Rather than waste time meeting with companies that have limited interest in your market, complete this section and make every ONE-ON-ONE MEETING a valuable investment of your time! Please select the city or cities below that you are seeking a partner in. Note this section is used for our one on one schedulers advanced search allowing attendees to search for Companies that are looking for a partner in their city. ";
$text_newfeature[1] = "<B>新功能 - 优化您的参会时间!</B>
	<BR>
	不要在那些对您的运作市场不怎么感兴趣的公司身上浪费太多时间了，填写这个部分将保证您的每个一对一会谈都有巨大的收获。请选择您正在寻找合作伙伴的所在城市。这个部分的信息将用于一对一会谈程序中的高级搜索功能，该功能可以使参会者找到那些需要在他们公司所在城市寻找合作伙伴的公司。 ";
$text_service[0] = "<B>Service Provided. </B>
	<?php if($G_ENABLE_ONEONONE){?>
		<BR>Note this section is used in our one on one schedulers advanced search feature allowing attendees to search for attendees that provide a specific service. 
	<?php }?>";
$text_service[1] = "<B>业务范围: </B>
	<?php if($G_ENABLE_ONEONONE){?>
		<BR>注意: 在一对一会谈程序的高级搜索功能中，参会者可以根据以下的信息来找寻提供指定业务的公司. 
	<?php }?>";
$text_Advertisement[0] = "Advertisement";
$text_Advertisement[1] = "会刊广告";
$text_Sponsorship[0] = "Sponsorship";
$text_Sponsorship[1] = "成为赞助商";
$text_Booth[0] = "Booth";
$text_Booth[1] = "展亭";
$text_selectbooth[0] = "Please select <U>$booth_network[$N]</U> booth number you would like to have";
$text_selectbooth[1] = "请选择你想预订的 <U>$booth_network[$N]</U> 展亭号";
$text_confirmbooth[0] = "<font color=\"red\">* We will confirm your booth number as fast as possible.</font>";
$text_confirmbooth[1] = "<font color=\"red\">* 我们会尽快向您确认您的展亭预订情况。</font>";
$text_Services[0] = "Miscellaneous Services";
$text_Services[1] = "其他服务";
$text_Services_Details[0]="Please tick one or more of the following and one of our staff will contact you by email to discuss your requirements.";
$text_Services_Details[1]="以下服务选项可多选，我们的工作人员会给您发送相关电子邮件。";
/*-----------------------------------TEXT for editprofile End------------------------------------*/

/*-----------------------------------TEXT for register Start------------------------------------*/

$text_regnote[0] = "<ol style='margin-top:0cm' start=1 type=1>
	<Li>If you wish to revise your company profile then click on the <font color=red><B>Company Profile</B></font> button below. The Company Profile window will  pop up so that you can make any required changes.  <br><br>
	<Li>Complete the delegate profile form  below for each attendee you wish to register. After entering each attendee's information, click the <font color=red><B>Confirm Registration</B></font> button. The information you entered will automatically saved to our registration system and each new attendee will be listed in a table directly under the &quot;Delegate Profile&quot; heading. You will also receive a formal confirmation via email. <br><br>
	  <Li>If you would like to update an attendee's profile then click on the attendee's name (found  in the table directly under the \"Delegate Profile\"); heading. The delegate's registration details will then  appear in a form below. Simply go  through the form and make necessary updates. After you have finished updating then click the <font color=red><strong>&quot;Update&quot;</strong> </font>button at the bottom of the form to confirm the  changes.  <br><br>
  </ol>";
$text_regnote[1] = "<FONT face=\"Arial\" size=\"2\">&nbsp;
  <ol style='margin-top:0cm' start=1 type=1>
	<Li><font size=\"2\" face=\"Arial\">如果您需要修改公司信息，请点击 <font color=red><B>Company Profile</B> </font>按钮在打开窗口中修改公司信息。</font>    
	<Li><font size=\"2\" face=\"Arial\">请在以下表单中填写每一位参会代表信息。当您每添加一位参会代表后，请点击<font color=red><B>Confirm registration</B></font> 按钮.。您输入的信息将会自动保存在注册系统中，新的参会代表将会显示在参会人员名单中，同时该参会代表也会收到确认的电子邮件。</font>
	  <Li><font size=\"2\" face=\"Arial\">如果您需要修改已登记的参会代表信息，请点击相应的参会代表名字，他的信息将会在以下表格中显示。当您修改完毕后请点击<font color=red><B>Confirm registration</B></font>按钮。
  </font>
  </ol>
  </FONT>";

$text_companyname[0] = "Company :";
$text_companyname[1] = "公司名称";
$text_country[0] = "Country:";
$text_country[1] = "国家：";
$text_city[0] = "City:";
$text_city[1] = "城市：";
$text_delegateprofile[0] = "DELEGATE PROFILE";
$text_delegateprofile[1] = "参会代表信息";
$text_delegatename[0] = "Name";
$text_delegatename[1] = "姓名";
$text_spouse[0] = "Spouse";
$text_spouse[1] = "配偶";
$text_required[0] = "<b>* Required fields.</b>";
$text_required[1] = "<b>* 为必填项，所有信息如无特别注明请一律使用英文填写</b>";
$text_notetitlecase[0] = "<font color=red>Please fill in by using title case letters.
  (Example is WCA Family of Logistic Networks)</font>";
$text_notetitlecase[1] = "<font color=red>请注意首字母大小写
  (例如： $G_COMPANY_NAME)</font>";
$text_notelocation[0] = "<font color=\"#666666\"><u>Note:</u> City &amp; Country where you are working will be unchangeable (after you submit the registration form)</font>";
$text_notelocation[1] = "<u>注意：</u> 当您提交注册表单后，“城市和国家”信息将无法更改。";
$text_countrycity[0] = "City & Country where you are working at";
$text_countrycity[1] = "您所工作的国家和城市：";
$text_invoiceby[0] = "Issue invoice by";
$text_invoiceby[1] = "请选择付款方：";
$text_invoicewho[0] = "<B>Who would you prefer to handle your invoice and payment?</B>";
$text_invoicewho[1] = "<B>选择您所希望的款项操作方</B>";
$text_invoicebywca[0] = "(Your invoice and payment will be US$ currency only) ";
$text_invoicebywca[1] = "（金额全部以美元USD计算）";
$text_invoicebycifa[0] = "(Your invoice and payment will be RMB currency only)
			<BR>
			Please note that you cannot switch to WCA Family of Logistics' Invoice to handle your invoice and payment later.";
$text_invoicebycifa[1] = "(金额全部以人民币计算)
			<BR>
			请注意当您选择向CIFA付款后，将不能更改付款方为 WCA Family of Logistics";
$text_noteinvoiceCIFA[1] = "如果您对支付款项和发票有任何疑问，请以Email联系赵小姐：julia-zhao@cifa.org.cn";

$text_titlename[0] = "Title Name";
$text_titlename[1] = "身份";
$text_firstname[0] = "First Name";
$text_firstname[1] = "名";
$text_middlename[0] = "Middle Name";
$text_middlename[1] = "中间名";
$text_lastname[0] = "Last Name";
$text_lastname[1] = "姓";
$text_photo[0] = "Photo";
$text_photo[1] = "照片";
$text_position[0] = "Position/Title";
$text_position[1] = "职位";
$text_noteemail[0] = "Please provide us with only one email address. This is the email address we will use for sending the confirmation. ";
$text_noteemail[1] = "请提供一个您的邮件地址，我们将为您发送确认信息。";
$text_confirmemail[0] = "Confirm Email";
$text_confirmemail[1] = "请再次输入以确认您的 Email";
$text_invitation[0] = "Required Invitation Letter";
$text_invitation[1] = "邀请函";
$text_downloadinvitation[0] = "<A Href=\"$G_ENABLE_INVITATION_LETTER_LINK\" target=\"_blank\">Download Invitation Letter</A>";
$text_downloadinvitation[1] = "<A Href=\"$G_ENABLE_INVITATION_LETTER_LINK\" target=\"_blank\">下载邀请函</A>";
$text_notenohotelroom[0] = "Accompanying person (2nd person) joining the room with the main attendee, 
			please click \"<B>no hotel room</B>\" for yourself.";
$text_notenohotelroom[1] = "不需要预订酒店;或者与另一位代表入住同一间客房的代表，请选择“no hotel room”";
$text_hotel[0] = "Hotel";
$text_hotel[1] = "酒店";
$text_single[0] = "Single";
$text_single[1] = "单人";
$text_twin[0] = "Twin";
$text_twin[1] = "双人";
$text_smoking[0] = "Smoking";
$text_smoking[1] = "吸烟";
$text_nosmoking[0] = "Non-Smoking";
$text_nosmoking[1] = "不吸烟";
$text_extrabed[0] = "Extra bed";
$text_extrabed[1] = "加床";

$text_notepassport[0] = "Please provide us with <b><u>YOUR NAME</u></b> exactly as it appears on <b><u>YOUR PASSPORT</u></b>.
	Note Passport Name and Passport Number will be used for hotel reservations and or visa invitation letters.";
$text_notepassport[1] = "请提供您<strong>护照或身份证</strong>上的真实<strong>姓名</strong>。酒店将按护照上的姓名和护照号码登记预订客房。";
$text_passportno[0] = "Passport No.";
$text_passportno[1] = "护照编号";
$text_chinaID[0] = "/ Chinese ID.";
$text_chinaID[1] = " / 身份证号码";
$text_passportname[0] = "Your name in your passport";
$text_passportname[1] = "证件上的姓名";
$text_passportcountry[0] = "Passport Country.";
$text_passportcountry[1] = "领取护照国家";
$text_tour[0] = "Tour";
$text_tour[1] = "旅游";
$text_translator[0] = "Translator";
$text_translator[1] = "会议翻译";
$text_noteconfirm[0] = "After entering each attendee information you must click <font color=red><B>'Confirm registration'</B></font>
then information you entered will automatically save to our system and the new attendee will be listed in the summary above
as well as you will receive a confirmation email by us.";
$text_noteconfirm[1] = "当您每添加一位参会代表后，请点击<font color=\"red\"><b>Confirm registration</b></font> 按钮。您输入的信息将会自动保存在注册系统中，新的参会代表将会显示在参会人员名单中，同时该参会代表也会收到确认的电子邮件。";
$text_SELChinesecompany[0] = "Are you Chinese Company and wish to be invoiced by CIFA? ";
$text_SELChinesecompany[1] = "您是来自中国的公司吗？";
$text_ChineseCompanyName[0] = "Company Name (in Chinese) ";
$text_ChineseCompanyName[1] = "公司名（中文）";
$text_ChineseContactPersonName[0] = "Contact Name (in Chinese) ";
$text_ChineseContactPersonName[1] = "联系人（中文）";
$text_ChineseCompanyAddress[0] = "Company Address (in Chinese) ";
$text_ChineseCompanyAddress[1] = "公司地址（中文）";
$text_ChinesePostcode[0] = "Postcode ";
$text_ChinesePostcode[1] = "邮政编码（中国）";
$text_VisaNotes[0] = "<strong>Notice to all nationalities whose citizens normally do not require visas to enter China.</strong> Due to constantly changing visa requirements for all nationalities wishing to enter China during this Olympics year, we strongly recommend that all delegates contact the Chinese Embassies or Consulates in their respective countries and double check with the authorities regarding current visa requirements. We have received information that some of these countries (including Singapore) have had the no-visa privilege temporarily suspended and must now apply for China visas prior to arrival. ";
$text_VisaNotes[1] = "<strong>请通常前往中国不需要办理签证的国家的公民注意。</strong> 由于对所有在今年奥运年中需要前往中国的国家的签证政策有所改变，我们强烈建议所有参会代表联系当地的中国领事馆并确认您当前签证的颁发条件。我们已经了解到其中一些国家的免中国签证特权已暂时停止，必须申请签证才能入境 。";
$text_Require[0] = "Required";
$text_Require[1] = "需要";
$text_NotRequire[0] = "Not Required";
$text_NotRequire[1] = "不需要";
$text_VisaExpire[0] = "Passport Expiration Date";
$text_VisaExpire[1] = "护照有效期至";



?>