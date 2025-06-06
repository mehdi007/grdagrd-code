<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8"> 
    <title></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php
    if($this->uri->segment(2) == 'estate_add' || $this->uri->segment(2) == 'estate_edit'){
      echo '<!-- Bootstrap 5.2.3 -->
      <link rel="stylesheet" href="https://up.grdagrd.com/files/css/bootstrap.min-5-2-3.css">';
    }else{
      echo '<!-- Bootstrap 3.3.4 -->
      <link rel="stylesheet" href="https://up.grdagrd.com/files/admin/bootstrap/css/bootstrap.min.css">';
    }
    ?>
    <!--<link rel="stylesheet" href="https://up.grdagrd.com/files/admin/font-awesome-4.7.0/css/font-awesome.min.css">-->
    <!-- <link href="https://kit-pro.fontawesome.com/releases/v5.9.0/css/pro.min.css" rel="stylesheet"> -->
    <link data-n-head="ssr" rel="manifest" href="/pwa-manifest.json" data-hid="manifest">
    <link href="https://grdagrd.com/files/icons/faw.pro.6.0.0/css/all.min.css" rel="stylesheet">
    <!--<link href="https://up.grdagrd.com/files/css/fontawesome-v5.5.0/css/all.min.css" rel="stylesheet">-->
    <link rel="stylesheet" href="https://up.grdagrd.com/files/admin/ionicons-2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://up.grdagrd.com/files/admin/dist/css/AdminLTE.css">
    <link rel="stylesheet" href="https://up.grdagrd.com/files/admin/dist/css/skins/skin.css">
    <link rel="stylesheet" href="https://up.grdagrd.com/files/admin/dist/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="https://up.grdagrd.com/files/css/style-index.css">
    <link rel="stylesheet" href="https://up.grdagrd.com/files/admin/dataTables/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://up.grdagrd.com/files/css/org/sweetalert.min.css">
    <link rel="stylesheet" href="<?=base_url()?>files/css/estate/fonts.css" media="all" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" type="image/png" href="https://up.grdagrd.com/image/favicon.png"/>
<?php
if($this->uri->segment(2) == 'estate_edit' || $this->uri->segment(2) == 'estate_add' || $this->uri->segment(2) == 'customer_add' || $this->uri->segment(2) == 'customer_update'){
echo '<link href="https://up.grdagrd.com/files/css/leaflet.css" media="all" rel="stylesheet" type="text/css"><script type="text/javascript" src="https://up.grdagrd.com/files/js/leaflet.js"></script>';
}
?>

  </head>
  <body class="skin-blue sidebar-mini no-print sidebar-collapse<?=($this->uri->segment(2) == 'cms_show'?' CmsShow':'').($this->uri->segment(2) == 'estate_edit' || $this->uri->segment(2) == 'estate_add'?' estateae" style="overflow: hidden;"':'"');?>>
    <?php
      echo ($this->uri->segment(2) == 'estate_edit' || $this->uri->segment(2) == 'estate_add')?'<div id="hideAll">&nbsp;</div>':'';
      $users = $this->admin_model->GetWhere('users', array('id' => $users_id))->row();
      $user_mobile = $this->admin_model->GetWhere('user_mobile', array('user_id' => $users_id,'certified' => '1'));
		if($users->necessary_act=="0" && $this->ion_auth->in_group(array('host'))){
            echo '<div class="alert_always AAshow" style="padding: 20px 30px; background: rgb(243, 156, 18); z-index: 999999; font-size: 16px; font-weight: 600;"><a href="'.base_url().($this->ion_auth->in_group(array('admin','operator'))?'admin':'users').'/profile_edit" style="color: rgba(255, 255, 255, 0.9); display: inline-block; margin-right: 10px; text-decoration: none;">لازم است جهت هرگونه فعالیت در گرداگرد ابتدا فرم " اطلاعات ضروری " در قسمت ویرایش نمایه(مشخصات کاربری) را تکمیل نمایید!</a><a class="btn btn-default btn-sm" href="'.base_url().($this->ion_auth->in_group(array('admin','operator'))?'admin':'users').'/profile_edit" style="margin-top: -5px; border: 0px; box-shadow: none; color: rgb(243, 156, 18); font-weight: 600; background: rgb(255, 255, 255);">انجام آن!</a></div>';
		}elseif($user_mobile->num_rows()==0 && $this->ion_auth->in_group(array('guest'))){
            echo '<div class="alert_always AAshow" style="padding: 20px 30px; background: rgb(243, 156, 18); z-index: 999999; font-size: 16px; font-weight: 600;"><a href="'.base_url().($this->ion_auth->in_group(array('admin','operator'))?'admin':'users').'/profile_edit" style="color: rgba(255, 255, 255, 0.9); display: inline-block; margin-right: 10px; text-decoration: none;">لازم است جهت هرگونه فعالیت در گرداگرد ابتدا " یک شماره تماس (موبایل) تایید شده " در قسمت ویرایش نمایه(مشخصات کاربری) درج نمایید!</a><a class="btn btn-default btn-sm" href="'.base_url().($this->ion_auth->in_group(array('admin','operator'))?'admin':'users').'/profile_edit" style="margin-top: -5px; border: 0px; box-shadow: none; color: rgb(243, 156, 18); font-weight: 600; background: rgb(255, 255, 255);">انجام آن!</a></div>';
        }else{
			echo '<div class="alert_always"></div>';
		}
    ?>
    <span id="alertmess"><div class="ns-box"></div></span>
    <div class="container_alert calertmoveup"></div>
    <div class="wrapper">
<?php
// echo $this->uri->segment(2);
if($this->uri->segment(2) == 'estate_edit' || $this->uri->segment(2) == 'estate_add'){
}else{
?>
      <header class="main-header">
        <a href="<?=base_url()?>" class="logo" aria-label="Logo">
          <div class="logo-mini"><div class="logomini"></div></div>
          <div class="logo-lg"><div class="logofull"></div></div>
        </a>
<?php
$users_groups = $this->ion_auth->get_users_groups()->row()->id;
$read_mess = $this->admin_model->FetchCountries_Movaghat('id DESC','messages',array('user_id_get' => $users_id,'read'=>'0'));

//$tasks = $this->db->query('select t1.* from tasks t1 join (select user_id, max(date_create) as date_create from tasks group by user_id,active,link,relship) t2 on t1.user_id = t2.user_id and t1.date_create = t2.date_create WHERE t1.user_id = '.$users_id.' AND expiry > '.strtotime(date('Y/m/d H:i:s')).' AND active = 0 ORDER BY t1.id DESC');
 //$tasks = $this->admin_model->GetWhere('tasks', array('user_id' => $users_id, 'expiry >' => strtotime(date('Y/m/d H:i:s')), 'active' => 0));
$uid = ($this->ion_auth->in_group(array('admin','operator')))? '2' : $users_id ;
 $tasks = $this->admin_model->FetchCountries_Movaghat('id DESC', 'tasks', array('user_id' => $uid, 'expiry >' => strtotime(date('Y/m/d H:i:s')), 'active' => 0));
 
//$notifications = $this->db->query('select t1.* from notifications t1 join (select user_id, max(date) as date from notifications group by user_id,active,link) t2 on t1.user_id = t2.user_id and t1.date = t2.date WHERE t1.user_id = '.$users_id.' AND active = 0 ORDER BY t1.id DESC');
$notifications = $this->admin_model->FetchCountries_Movaghat('id DESC', 'notifications', array('user_id' => $uid, 'active' => 0));
$readNumRow = $read_mess->num_rows();
$aravdimg = '';
for ($i = 0; $i<1; $i++) 
{
    $aravdimg .= mt_rand(1,66);
}

$QueryFavr_hed = $this->admin_model->GetWhere('favorite', array('user_id' => $users_id));
$QueryComm_hed = $this->admin_model->GetWhere('comments', array('user_id' => $users_id));
$QueryBook_hed = $this->admin_model->GetWhere('booking', array('guest_user_id' => $users_id));
?>
        <nav class="navbar navbar-static-top margin-50" role="navigation">
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu BxUsInf">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="height: 60px;">
                  <?='<div class="rounded user-image myavatarimg1" style="background: url('.( !empty($users->avatar) ? 'https://up.grdagrd.com/uploads/profile/'.$users->avatar : $this->siran->GetGravatarUrl((!empty($users->email)?$users->email:'myemilfotstsaaas778@yasa2112sa.32aa'))).') center no-repeat;height: 25px!important;width: 25px!important;float: left;margin-right: 10px!important;margin-top: -3px!important;"></div>';?>
                  <span class="hidden-xs"><?=$users->first_name?></span>
                </a>
<div class="dropdown-menu" style="top: 100%;">
                  <div class="box box-widget widget-user" style="margin-bottom: 0;">
            <div class="widget-user-header bg-black" style="background: url('https://up.grdagrd.com/image/bgusers/<?=$aravdimg;?>.jpg') center center;">
              <h3 class="widget-user-username"><?=$users->first_name?></h3>
              <h5 class="widget-user-desc"><?=$this->ion_auth->get_users_groups()->row()->description?></h5>
            </div>
            <div class="widget-user-image">              
              <div class="rounded myavatarimg2" style=" background: url(<?=( !empty($users->avatar) ? 'https://up.grdagrd.com/uploads/profile/'.$users->avatar : $this->siran->GetGravatarUrl((!empty($users->email)?$users->email:'myemilfotstsaaas778@yasa2112sa.32aa')))?>) center no-repeat; height: 90px!important; width: 90px!important; "></div>
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <a href="<?=base_url()?>users/bookings" class="description-block">
                    <h5 class="description-header"><?=$this->siran->number2farsi($QueryBook_hed->num_rows())?></h5>
                    <span class="description-text">رزرو</span>
                  </a>
                </div>
                <div class="col-sm-4 border-right">
                  <a href="<?=base_url()?>users/favorites" class="description-block">
                    <h5 class="description-header"><?=$this->siran->number2farsi($QueryFavr_hed->num_rows())?></h5>
                    <span class="description-text">علایق</span>
                  </a>
                </div>
                <div class="col-sm-4">
                  <a href="<?=base_url()?>users/comments" class="description-block">
                    <h5 class="description-header"><?=$this->siran->number2farsi($QueryComm_hed->num_rows())?></h5>
                    <span class="description-text">نظر</span>
                  </a>
                </div>
              </div>
               <div class="row" style="margin: 0 auto;display: block;text-align: center;font-weight: bold;">
                <p>
                      <small>تاریخ عضویت <?=$this->siran->number2farsi(jdate('F Y',$users->created_on))?></small>
                  </p>
               </div>
            <div class="pull-left">
                      <a href="<?= base_url() ?>auth/logout?lu=<?= urlencode(current_url())?>" class="btn btn-default btn-flat">
												<span>خروج</span>
											</a>
                    </div><div class="pull-right">
                      <a href="<?=base_url().'home/profile/'.$users->id;?>" class="btn btn-default btn-flat">
												<span>نمایه</span>
											</a>
                    </div></div>
      </div>
</div>
              </li>
              <?php
                $CurDate = strtotime(date('Y-m-d'));
                // $querynumsixpric = $this->admin_model->GetWhere('submit_house', array('final_record' => '1','not_loop' => '1','manuel_act ' => '0','price_update_date<' => strtotime(date('Y/m/d')." -6 month")));
                if($this->ion_auth->in_group(array('caller'))){
                    $querynumsixpric = $this->admin_model->GetWhere('submit_house_price_old', array('user_caller' => $this->ion_auth->user()->row()->id));
                }else{
                    $querynumsixpric = $this->admin_model->GetAll('submit_house_price_old');
                }
                $QueryBookFinalRezrv = $this->admin_model->GetWhere('booking', array(
                  'book_add' => '1',
                  'date_start<=' => $CurDate,
                  'date_end>=' => $CurDate
              ));
              $numprsix = '0';
              foreach ($QueryBookFinalRezrv->result() as $idx => $row) {
                $this->admin_model->GetWhere('submit_house', array('id' => $row->relationship,'final_record' => '1','not_loop' => '1','manuel_act ' => '0','price_update_date<' => strtotime(date('Y/m/d')." -6 month")));
                $affr = $this->db->affected_rows();
                if($affr>0){
                  ++$numprsix;
                }
              }
                $numqnsp = ($this->ion_auth->logged_in() && $this->ion_auth->in_group(array('admin','operator','write','seo_manager','caller'))?$querynumsixpric->num_rows()-$numprsix:0);
              ?>
							<li class="dropdown tasks-menu TskAnjSo">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="TskNum" id="<?=$tasks->num_rows()?>"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path><line x1="4" y1="22" x2="4" y2="15"></line></svg>
                <?=($tasks->num_rows()>'0' || $numqnsp>0?'<span class="label label-danger" id="labDangr">'.$this->siran->number2farsi($tasks->num_rows()+($numqnsp>0?1:'')).'</span>':'');?>
                </a>
                <ul class="dropdown-menu" id="alrtTsk" style="background-color: #ffffff;">
                  <li class="header"><?=($tasks->num_rows()>0?'شما '.$this->siran->number2farsi($tasks->num_rows()).' کار انجام نشده دارید.':'شما کار جدید ندارید.');?></li>
                  <li>
                    <ul class="menu style_scrol" style="background-color: #ffffff;">
                      <?php
                  foreach($tasks->result() as $idx=>$rowTsk){
                      echo '<li class="body" id="'.$rowTsk->relship.'">
                        <a href="'.base_url().$rowTsk->link.'" style="color: #444444;">
                          <h4 style=" text-align: right;margin: 0;">
                            <div class="char_limit_td" style="width: 100%;font-size: 12px;height: 15px;">
                              '.$this->siran->number2farsi($rowTsk->subject).'
                            </div>
                          </h4>
                        </a>
                      </li>';
                  }
                  if($numqnsp>0){
                    echo '<li class="body" id="wsaedsa">
                        <a href="'.base_url().'admin/runpriceupdate">
                          <h4 style=" text-align: right;margin: 0;">
                            <div class="char_limit_td">
                              '.$this->siran->number2farsi($numqnsp).' اقامتگاه با تعرفه قدیمی وجود دارد.
                            </div>
                          </h4>
                        </a>
                      </li>';
                  }
                  ?>
                    </ul>
                  </li>
                  <li class="footer">
                    <a href="<?=base_url().($this->ion_auth->in_group(array('admin','operator'))?'admin':'users');?>/tasks">مشاهده تمامی کارها</a>
                  </li>
                </ul>
              </li>
							<li class="dropdown notifications-menu NotMnuHD">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0"></path></svg>
                  <?=($notifications->num_rows()>'0'?'<span class="label label-warning">'.$this->siran->number2farsi($notifications->num_rows()).'</span>':'')?>
                </a>
                <ul class="dropdown-menu" style="background-color: #ffffff;">
                  <li class="header"><?=($notifications->num_rows()>0?'شما '.$this->siran->number2farsi($notifications->num_rows()).' اطلاعیه دارید.':'شما اطلاعیه جدید ندارید.');?></li>
                  <li>
                    <ul class="menu style_scrol" style="background-color: #ffffff;">
                      <?php
                  foreach($notifications->result() as $idx=>$rowNot){
                      echo '<li id="'.$rowNot->id.'">
                        <a href="'.base_url().$rowNot->link.'" style="color: #444444;" '.($rowNot->rel_id>0?'class="shtiks"':'').'>
                          <h4 style=" text-align: right;margin: 0;">
                            <div class="char_limit_td" style="width: 100%;font-size: 12px;height: 15px;">
                              '.$this->siran->number2farsi($rowNot->subject).'
                              <span class="HumnTxTim">' . $this->siran->number2farsi($this->siran->humanTiming($rowNot->date)) . ' پیش</span>
                            </div>
                          </h4>
                        </a>
                        '.($rowNot->rel_id>0?'
                        <form action="'.base_url().$rowNot->link.'" method="post" class="fgotick"><input type="hidden" name="notidfg" id="'.$rowNot->rel_id.'" value="'.$this->encrypt->encode($rowNot->id).'"><input type="hidden" name="id" id="'.$rowNot->rel_id.'" value="'.$this->encrypt->encode($rowNot->rel_id).'"></form>':'').'
                      </li>';
                  }
                  ?>
                    </ul>
                  </li>
                  <li class="footer"><a href="<?=base_url().($this->ion_auth->in_group(array('admin','operator'))?'admin':'users');?>/notifications">مشاهده تمامی اطلاعیه ها</a></li>
                </ul>
              </li>
							<li class="dropdown messages-menu MesLstHD">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                  <?=($readNumRow>0?'<span class="label label-success" id="labSucms" style="background-color: #00bc66 !important;">'.$this->siran->number2farsi($readNumRow).'</span>':'');?>
                </a>
                <ul class="dropdown-menu" id="alrtmes" style="background-color: #ffffff;">
                  <li class="header"><?=($readNumRow>0?'شما '.$this->siran->number2farsi($readNumRow).' پیام دارید.':'شما پیام جدیدی ندارید.');?></li>
                  <li>
                    <ul class="menu style_scrol" style="background-color: #ffffff;">
                  <?php
                  foreach($read_mess->result() as $idx=>$rowHed){
                    $usersNm = $this->admin_model->GetWhere('users', array('id' => $rowHed->user_id_send))->row();
                      echo '<li class="body" id="'.$rowHed->uniq.'">
                        <a href="" class="shtiks">
                          <h4 style=" text-align: right; margin-right: 0; ">
                            <div class="char_limit_td" style="width: 80%;font-size: 12px;height: 15px;">
                              '.$this->siran->number2farsi($rowHed->subject).'
                            </div>
                            <small><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg> '.$this->siran->number2farsi($this->siran->humanTiming($rowHed->date)).'</small>
                          </h4>
                          <p>'.$this->siran->number2farsi(($usersNm->first_name)).'</p>
                        </a>
                        <form action="'.base_url().($this->ion_auth->in_group(array('admin','operator'))?'admin':'users').'/messages_read" method="post" class="fgotick"><input type="hidden" name="messd" value="'.$this->encrypt->encode($rowHed->id).'" id="tickd"><input type="hidden" name="type" value="'.$this->encrypt->encode('3').'" id="tickd"></form>
                      </li>';
                  }
                  ?>
                    </ul>
                  </li>
                  <li class="footer"><a href="<?=base_url().($this->ion_auth->in_group(array('admin','operator'))?'admin':'users');?>/messages_inbox">مشاهده تمامی پیامها</a></li>
                </ul>
              </li>
							<li class="dropdown messages-menu HlpMe">
                <a href="" class="dropdown-toggle" data-toggle="dropdown">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                  <?=($readNumRow>0?'<span class="label label-success" id="labSucms" style="background-color: #00bc66 !important;">'.$this->siran->number2farsi($readNumRow).'</span>':'');?>
                </a>
                <ul class="dropdown-menu WbloGpOstHlp" id="alrtmes" style="background-color: #ffffff;">
                  <li>
                    <ul class="menu style_scrol" style="background-color: #ffffff;">
                  <?php
									if($this->uri->segment(2) == 'estate_add'){
                      echo '
											<li class="body">
                        <a href="'.base_url().'help/چگونه-واحد-اقامتی-خود-را-در-گرداگرد-درج-نماییم" target="_blank" style="white-space: initial;">
                          <h4 style=" text-align: right; margin-right: 0;line-height: 18px;font-weight: normal; ">
                            <div style="font-size: 12px;height: 15px;">
                              چگونه اقامتگاه خود را در گرداگرد درج نماییم؟
                            </div>
                          </h4>
                        </a>
                      </li>
											<li class="body">
                        <a href="'.base_url().'help/شرح-و-توضیح-فرم-افزودن-واحد-اقامتی-در-گرداگرد" target="_blank" style="white-space: initial;">
                          <h4 style=" text-align: right; margin-right: 0;line-height: 18px;font-weight: normal; ">
                            <div style="font-size: 12px;height: 15px;">
                              شرح و توضیح فرم افزودن اقامتگاه در گرداگرد؟
                            </div>
                          </h4>
                        </a>
                      </li>
                      <li class="body">
                        <a href="'.base_url().'help/تفاوت-بین-نوع-واحدها-چیست" target="_blank" style="white-space: initial;">
                          <h4 style=" text-align: right; margin-right: 0;line-height: 18px;font-weight: normal; ">
                            <div style="font-size: 12px;height: 15px;">
                              تفاوت بین نوع واحدها چیست؟
                            </div>
                          </h4>
                        </a>
                      </li>
                      <li class="body">
                        <a href="'.base_url().'help/چگونه-مختصات-یا-آدرس-دقیق-واحد-اقامتی-را-درج-نمایم" target="_blank" style="white-space: initial;">
                          <h4 style=" text-align: right; margin-right: 0;line-height: 18px;font-weight: normal; ">
                            <div style="font-size: 12px;height: 15px;">
                              چگونه مختصات یا آدرس دقیق اقامتگاه را درج نمایم؟
                            </div>
                          </h4>
                        </a>
                      </li>
                      <li class="body">
                        <a href="'.base_url().'help/چگونه-تصاویر-واحدها-را-ثبت-یا-حذف-نمایم-و-یک-تصویر-را-بعنوان-تصویر-اصلی-انتخاب-کنم" target="_blank" style="white-space: initial;">
                          <h4 style=" text-align: right; margin-right: 0;line-height: 18px;font-weight: normal; ">
                            <div style="font-size: 12px;height: 15px;">
                              چگونه تصاویر واحدها را ثبت یا حذف نمایم و یک تصویر را بعنوان تصویر اصلی انتخاب کنم؟
                            </div>
                          </h4>
                        </a>
                      </li>
                      <li class="body">
                        <a href="'.base_url().'help/چگونه-تعرفه-اقامت-را-تعیین-نمایم" target="_blank" style="white-space: initial;">
                          <h4 style=" text-align: right; margin-right: 0;line-height: 18px;font-weight: normal; ">
                            <div style="font-size: 12px;height: 15px;">
                              چگونه تعرفه اقامت را تعیین نمایم؟
                            </div>
                          </h4>
                        </a>
                      </li>
                      <li class="body">
                        <a href="'.base_url().'help/چگونه-قوانین-و-مقررات-مربوط-به-واحد-اقامتی-خود-را-به-اشتراک-بگذارم" target="_blank" style="white-space: initial;">
                          <h4 style=" text-align: right; margin-right: 0;line-height: 18px;font-weight: normal; ">
                            <div style="font-size: 12px;height: 15px;">
                              چگونه قوانین و مقررات مربوط به اقامتگاه خود را به اشتراک بگذارم؟
                            </div>
                          </h4>
                        </a>
                      </li>';
									}
                  if($this->uri->segment(2) == 'estate_show'){
                      echo '
											<li class="body">
                        <a href="'.base_url().'help/چگونه-واحد-اقامتی-خود-را-در-گرداگرد-درج-نماییم" target="_blank" style="white-space: initial;">
                          <h4 style=" text-align: right; margin-right: 0;line-height: 18px;font-weight: normal; ">
                            <div style="font-size: 12px;height: 15px;">
                              چگونه اقامتگاه خود را در گرداگرد درج نماییم؟
                            </div>
                          </h4>
                        </a>
                      </li>
											<li class="body">
                        <a href="'.base_url().'help/چگونه-اطلاعات-درج-شده-برای-هر-واحد-اقامتی-را-ویرایش-نمایم" target="_blank" style="white-space: initial;">
                          <h4 style=" text-align: right; margin-right: 0;line-height: 18px;font-weight: normal; ">
                            <div style="font-size: 12px;height: 15px;">
                              چگونه اطلاعات درج شده برای هر اقامتگاه را ویرایش نمایم؟
                            </div>
                          </h4>
                        </a>
                      </li>
                      <li class="body">
                        <a href="'.base_url().'help/آیا-می-توان-اطلاعات-هر-واحد-را-بعد-از-ارسال-تقاضای-اقامترزرو-ویرایش-کرد" target="_blank" style="white-space: initial;">
                          <h4 style=" text-align: right; margin-right: 0;line-height: 18px;font-weight: normal; ">
                            <div style="font-size: 12px;height: 15px;">
                              آیا می توان اطلاعات هر واحد را بعد از ارسال تقاضای اقامت(رزرو) ویرایش کرد؟
                            </div>
                          </h4>
                        </a>
                      </li>
                      <li class="body">
                        <a href="'.base_url().'help/چگونه-واحد-اقامتی-ثبت-شده-را-غیرفعال-نمایم" target="_blank" style="white-space: initial;">
                          <h4 style=" text-align: right; margin-right: 0;line-height: 18px;font-weight: normal; ">
                            <div style="font-size: 12px;height: 15px;">
                              چگونه اقامتگاه ثبت شده را غیرفعال نمایم؟
                            </div>
                          </h4>
                        </a>
                      </li>
                      <li class="body">
                        <a href="'.base_url().'help/چگونه-واحد-اقامتی-ثبت-شده-را-حذف-نماییم" target="_blank" style="white-space: initial;">
                          <h4 style=" text-align: right; margin-right: 0;line-height: 18px;font-weight: normal; ">
                            <div style="font-size: 12px;height: 15px;">
                              چگونه اقامتگاه ثبت شده را حذف نماییم؟
                            </div>
                          </h4>
                        </a>
                      </li>';
                  }
                  if($this->uri->segment(2) == 'bookings_add'){
                      echo '
											<li class="body">
                        <a href="'.base_url().'help/چگونه-تقاضاهای-اقامت-رزروهای-دریافتی-برای-واحد-اقامتی-خود-را-مدیریت-نمایم" target="_blank" style="white-space: initial;">
                          <h4 style=" text-align: right; margin-right: 0;line-height: 18px;font-weight: normal; ">
                            <div style="font-size: 12px;height: 15px;">
                              چگونه تقاضاهای اقامت (رزروهای دریافتی) برای اقامتگاه خود را مدیریت نمایم؟
                            </div>
                          </h4>
                        </a>
                      </li>';
                  }
                  if($this->uri->segment(2) == 'bookings'){
                      echo '
											<li class="body">
                        <a href="'.base_url().'help/چگونه-رزروهای-انجام-شده-را-مدیریت-نمایم" target="_blank" style="white-space: initial;">
                          <h4 style=" text-align: right; margin-right: 0;line-height: 18px;font-weight: normal; ">
                            <div style="font-size: 12px;height: 15px;">
                              چگونه رزروهای انجام شده را مدیریت نمایم؟
                            </div>
                          </h4>
                        </a>
                      </li>
                      <li class="body">
                        <a href="'.base_url().'help/رویه-لغو-تقاضای-اقامت-رزرو-چگونه-است" target="_blank" style="white-space: initial;">
                          <h4 style=" text-align: right; margin-right: 0;line-height: 18px;font-weight: normal; ">
                            <div style="font-size: 12px;height: 15px;">
                              رویه لغو یک تقاضای اقامت (رزرو) چگونه است؟
                            </div>
                          </h4>
                        </a>
                      </li>';
                  }
                  if($this->uri->segment(2) == 'favorites'){
                      echo '
											<li class="body">
                        <a href="'.base_url().'help/چگونه-لیست-علاقه-مندی-ها-رو-مدیریت-کنم" target="_blank" style="white-space: initial;">
                          <h4 style=" text-align: right; margin-right: 0;line-height: 18px;font-weight: normal; ">
                            <div style="font-size: 12px;height: 15px;">
                              چگونه لیست علاقه مندی ها رو مدیریت کنم؟
                            </div>
                          </h4>
                        </a>
                      </li>';
                  }
                  if($this->uri->segment(2) == 'comments'){
                      echo '
											<li class="body">
                        <a href="'.base_url().'help/چگونه-تجربیات-اقامت-خود-را-با-دیگران-به-اشتراک-بگذارم" target="_blank" style="white-space: initial;">
                          <h4 style=" text-align: right; margin-right: 0;line-height: 18px;font-weight: normal; ">
                            <div style="font-size: 12px;height: 15px;">
                              چگونه تجربیات اقامت خود را با دیگران به اشتراک بگذارم؟
                            </div>
                          </h4>
                        </a>
                      </li>';
                  }
                  if($this->uri->segment(2) == 'tasks'){
                      echo '
											<li class="body">
                        <a href="'.base_url().'help/مدیریت-کارهایی-که-باید-انجام-شود-چگونه-است" target="_blank" style="white-space: initial;">
                          <h4 style=" text-align: right; margin-right: 0;line-height: 18px;font-weight: normal; ">
                            <div style="font-size: 12px;height: 15px;">
                              مدیریت کارهایی که باید انجام شود چگونه است؟
                            </div>
                          </h4>
                        </a>
                      </li>';
                  }
                  if($this->uri->segment(2) == 'notifications'){
                      echo '
						<li class="body">
                        <a href="'.base_url().'help/مدیریت-اطلاعیه-ها-چگونه-است" target="_blank" style="white-space: initial;">
                          <h4 style=" text-align: right; margin-right: 0;line-height: 18px;font-weight: normal; ">
                            <div style="font-size: 12px;height: 15px;">
                              مدیریت اطلاعیه ها چگونه است؟
                            </div>
                          </h4>
                        </a>
                      </li>';
                  }
                  if($this->uri->segment(2) == 'messages_inbox' || $this->uri->segment(2) == 'messages_send'){
                      echo '
											<li class="body">
                        <a href="'.base_url().'help/مدیریت-پیام-ها-چگونه-است" target="_blank" style="white-space: initial;">
                          <h4 style=" text-align: right; margin-right: 0;line-height: 18px;font-weight: normal; ">
                            <div style="font-size: 12px;height: 15px;">
                              مدیریت پیام ها چگونه است؟
                            </div>
                          </h4>
                        </a>
                      </li>';
                  }
                  if($this->uri->segment(2) == 'ticket_insert' || $this->uri->segment(2) == 'ticket_show'){
                      echo '
											<li class="body">
                        <a href="'.base_url().'help/مدیریت-تیکت-های-پشتیبانی-چگونه-است" target="_blank" style="white-space: initial;">
                          <h4 style=" text-align: right; margin-right: 0;line-height: 18px;font-weight: normal; ">
                            <div style="font-size: 12px;height: 15px;">
                              مدیریت تیکت های پشتیبانی چگونه است؟
                            </div>
                          </h4>
                        </a>
                      </li>';
                  }
                  if($this->uri->segment(2) == 'profile_edit'){
                      echo '
											<li class="body">
                        <a href="'.base_url().'help/چگونه-حساب-کاربری-خودم-رو-ویرایش-کنم" target="_blank" style="white-space: initial;">
                          <h4 style=" text-align: right; margin-right: 0;line-height: 18px;font-weight: normal; ">
                            <div style="font-size: 12px;height: 15px;">
                              چگونه حساب کاربری خودم رو ویرایش کنم؟
                            </div>
                          </h4>
                        </a>
                      </li>
                      <li class="body">
                        <a href="'.base_url().'help/چرا-من-نیاز-به-یک-حساب-کاربری-قوی-و-یک-عکس-نمایه-واقعی-در-گرداگرد-دارم" target="_blank" style="white-space: initial;">
                          <h4 style=" text-align: right; margin-right: 0;line-height: 18px;font-weight: normal; ">
                            <div style="font-size: 12px;height: 15px;">
                              چرا من نیاز به یک حساب کاربری قوی و یک عکس نمایه واقعی در گرداگرد دارم؟
                            </div>
                          </h4>
                        </a>
                      </li>
                      <li class="body">
                        <a href="'.base_url().'help/چگونه-گذرواژه-ورود-به-حساب-کاربری-گرداگرد-را-تغییر-دهم" target="_blank" style="white-space: initial;">
                          <h4 style=" text-align: right; margin-right: 0;line-height: 18px;font-weight: normal; ">
                            <div style="font-size: 12px;height: 15px;">
                              چگونه گذرواژه ورود به حساب کاربری گرداگرد را تغییر دهم؟
                            </div>
                          </h4>
                        </a>
                      </li>
                      <li class="body">
                        <a href="'.base_url().'help/چگونه-آدرس-پست-الکترونیکی-استفاده-شده-در-گرداگرد-را-تغییر-دهم" target="_blank" style="white-space: initial;">
                          <h4 style=" text-align: right; margin-right: 0;line-height: 18px;font-weight: normal; ">
                            <div style="font-size: 12px;height: 15px;">
                              چگونه آدرس پست الکترونیکی استفاده شده در گرداگرد را تغییر دهم؟
                            </div>
                          </h4>
                        </a>
                      </li>';
                  }
                  ?>
                    </ul>
                  </li>
                  <li class="footer"><a href="<?=base_url()?>help">مرکز کمک</a></li>
                </ul>
              </li>
              <li class="dropdown messages-menu BlgLstMe">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 11a9 9 0 0 1 9 9"></path><path d="M4 4a16 16 0 0 1 16 16"></path><circle cx="5" cy="19" r="1"></circle></svg>
                  <?=($readNumRow>0?'<span class="label label-success" id="labSucms" style="background-color: #00bc66 !important;">'.$this->siran->number2farsi($readNumRow).'</span>':'');?>
                </a>
                <ul class="dropdown-menu WbloGpOst" id="alrtmes" style="background-color: #ffffff;">
                  <?=($this->ion_auth->in_group(array('admin','operator'))?'':'<li class="header">جدیدترین مطالب وبلاگ</li>')?>
                  <li>
                    <ul class="menu style_scrol" style="background-color: #ffffff;">
                  <?php
                  $Query = $this->db->query("SELECT * FROM blog WHERE category!=7 AND category!=15 AND display=1 order by id DESC LIMIT 10");
                        foreach($Query->result() as $idx=>$row_new){
                            echo '
                            <li class="body">
                              <a href="/blog/post/'.$row_new->id.'/'.url_title($row_new->subject).'" target="_blank" style="white-space: initial;">
                                <h4 style=" text-align: right; margin-right: 0;line-height: 18px;font-weight: normal; ">
                                  <div style="font-size: 12px;height: 15px;">
                                    '.($row_new->is_image>0?'<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style=" margin-left: 10px; margin-top: -1px; float: right; "><g transform="translate(2 3)"><path d="M20 16a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2h3l2-3h6l2 3h3a2 2 0 0 1 2 2v11z"/><circle cx="10" cy="10" r="4"/></g></svg>':'<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15.6 11.6L22 7v10l-6.4-4.5v-1zM4 5h9a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V7c0-1.1.9-2 2-2z"/></svg>').''.$this->siran->number2farsi($row_new->subject).'
                                  </div>
                                </h4>
                              </a>
                            </li>';
                        }
                    ?>
                    </ul>
                  </li>
                  <li class="footer"><a href="<?=base_url();?>وبلاگ" target="_blank">مشاهده وبلاگ</a></li>
                </ul>
              </li>
              <?php
              // $GetCredit = intval($this->siran->get_credit_sms());
              // if($this->ion_auth->in_group(array('admin','operator'))&&$GetCredit){
              // echo '<li class="dropdown messages-menu BlgLstMe">
              // <div '.($GetCredit<500?'class="blink_me" ':'').'data-rel=tooltip title="موجودی پیامک" style="float: left;padding: 5px;padding-top: 17px;padding-bottom: 17px;'.($GetCredit<200?'color:#;font-weight: bold;':($GetCredit<500?'color:yellow;font-weight: bold;':'')).'">'.$this->siran->number2farsi($GetCredit).'</div>
              // </li>';
              // }
              ?>
            </ul>
          </div>
        </nav>
      </header>


<aside class="main-sidebar">

        <section class="sidebar">
        <a href="https://grdagrd.com/" class="logoms">
        <div class="logo-lg"><div class="logofull"></div></div>
        </a>
<ul class="resultSerch dropdown-menu" role="listbox" style="right: 0;left: 0;display: none;background-color: #137c63; border-right: 1px solid #004636; border-left: 1px solid #004636; border-bottom: 1px solid #004636; border-top: 0; border-top-right-radius: 0; border-top-left-radius: 0; color: #fff; margin-right: 10px; width: 210px; margin-top: -2px;-webkit-transition: all 0.3s ease-in-out;-o-transition: all 0.3s ease-in-out;transition: all 0.3s ease-in-out;">
            </ul>
          <form id="SerTerm" role="search" class="sidebar-form">
						<div class="input-group">
							<input type="text" name="srch-term" id="srch-term my-input" class="InputSerche form-control" placeholder="قصد دارید کجا بمانید؟"  autocomplete="off">
									<span class="input-group-btn">
										<button type="submit" name="search" id="search-btn" class="btn btn-flat"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16"> <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/> </svg>
										</button>
									</span>
						</div>
					</form>
          <ul class="sidebar-menu">
            <li id="mysrchmnu" class="hidden-xs"><a><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16"> <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/> </svg></a></li>
						<li>
							<a href=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="float: left;margin-top: 2px;" class="arrowmainsvg"><path d="M15 18l-6-6 6-6"></path></svg>
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M15 21V9"/></svg> <span>بخش سایت</span></a>
							<ul class="treeview-menu">
								<li><a href="<?=base_url()?>" style="height: 44px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 9v11a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9"></path><path d="M9 22V12h6v10M2 10.6L12 2l10 8.6"></path></svg> <span>صفحه اول</span></a></li>
								<li><a href="<?=base_url()?>help/چگونه-سفر-کنیم"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" style="stroke: #b8c7ce;"><path d="M12.451 17.337l-2.451 2.663h-2v2h-2v2h-6v-5l6.865-6.949c1.08 2.424 3.095 4.336 5.586 5.286zm11.549-9.337c0 4.418-3.582 8-8 8s-8-3.582-8-8 3.582-8 8-8 8 3.582 8 8zm-3-3c0-1.104-.896-2-2-2s-2 .896-2 2 .896 2 2 2 2-.896 2-2z"></path></svg> <span>چگونه اجاره کنیم</span></a></li>
								<li><a href="<?=base_url()?>help/چگونه-میزبان-شویم"><svg class="preview-svg howhost" viewBox="0 0 1024 1024" style="width: 16px;fill: #b8c7ce;"><path d="M1004.8,358.4C1004.8,358.4,908.8,230.46400000000006,908.8,230.46400000000006C905.056,225.44000000000005,900.608,221.08799999999997,896,216.928C896,216.928,896,64,896,64C896,28.672000000000025,867.328,0,832,0C832,0,192,0,192,0C156.64,0,128,28.672000000000025,128,64C128,64,128,216.96000000000004,128,216.96000000000004C123.392,221.08799999999997,118.944,225.40800000000002,115.2,230.39999999999998C115.2,230.39999999999998,19.232,358.36800000000005,19.232,358.36800000000005C6.816,374.88,0,395.328,0,416C0,416,0,448,0,448C0,500.928,43.072,544,96,544C96,544,96,544,96,544C96,544,96,960,96,960C96,995.328,124.672,1024,160,1024C160,1024,864,1024,864,1024C899.328,1024,928,995.328,928,960C928,960,928,544,928,544C928,544,928,544,928,544C980.928,544,1024,500.928,1024,448C1024,448,1024,416,1024,416C1024,395.328,1017.184,374.88,1004.8,358.4C1004.8,358.4,1004.8,358.4,1004.8,358.4M832,64C832,64,832,192,832,192C832,192,192,192,192,192C192,192,192,192,192,192C192,192,192,64,192,64C192,64,832,64,832,64C832,64,832,64,832,64M326.176,480C326.176,480,192.128,480,192.128,480C192.128,480,320.128,256,320.128,256C320.128,256,390.176,256,390.176,256C390.176,256,326.176,480,326.176,480C326.176,480,326.176,480,326.176,480M423.488,256C423.488,256,496,256,496,256C496,256,496,480,496,480C496,480,359.488,480,359.488,480C359.488,480,423.488,256,423.488,256C423.488,256,423.488,256,423.488,256M528,256C528,256,600.512,256,600.512,256C600.512,256,664.512,480,664.512,480C664.512,480,528,480,528,480C528,480,528,256,528,256C528,256,528,256,528,256M633.76,256C633.76,256,703.808,256,703.808,256C703.808,256,831.808,480,831.808,480C831.808,480,697.76,480,697.76,480C697.76,480,633.76,256,633.76,256C633.76,256,633.76,256,633.76,256M64,448C64,448,64,416,64,416C64,409.05600000000004,66.24,402.336,70.4,396.79999999999995C70.4,396.79999999999995,166.4,268.79999999999995,166.4,268.79999999999995C172.448,260.736,181.92,256,192,256C192,256,283.264,256,283.264,256C283.264,256,155.264,480,155.264,480C155.264,480,96,480,96,480C78.336,480,64,465.696,64,448C64,448,64,448,64,448M640,960C640,960,400,960,400,960C400,960,400,640,400,640C400,640,640,640,640,640C640,640,640,960,640,960C640,960,640,960,640,960M864,960C864,960,672,960,672,960C672,960,672,640,672,640C672,622.304,657.632,608,640,608C640,608,400,608,400,608C382.336,608,368,622.304,368,640C368,640,368,960,368,960C368,960,160,960,160,960C160,960,160,544,160,544C160,544,864,544,864,544C864,544,864,960,864,960C864,960,864,960,864,960M960,448C960,465.696,945.696,480,928,480C928,480,868.672,480,868.672,480C868.672,480,740.672,256,740.672,256C740.672,256,832,256,832,256C832,256,832,256,832,256C842.048,256,851.552,260.736,857.568,268.79999999999995C857.568,268.79999999999995,953.568,396.79999999999995,953.568,396.79999999999995C957.76,402.336,960,409.05600000000004,960,416C960,416,960,448,960,448C960,448,960,448,960,448"></path></svg> <span>چگونه میزبان شویم</span></a></li>
								<li><a href="<?=base_url()?>help"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg> <span>چگونه کار می کند؟</span></a></li>
								<li><a href="<?=base_url()?>وبلاگ"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 11a9 9 0 0 1 9 9"></path><path d="M4 4a16 16 0 0 1 16 16"></path><circle cx="5" cy="19" r="1"></circle></svg> <span>وبلاگ گرداگرد</span></a></li>
								<li><a href="<?=base_url()?>home/profile/2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg> <span>تماس و درباره ما</span></a></li>
							</ul>
						</li>
            <?php
		if ($this->ion_auth->logged_in() && $this->ion_auth->in_group(array('admin','operator','write','social','seo_manager','caller')))
		{
		?>
                    <!-- <li <?=($this->uri->segment(2)=='overview'?'class="active"':'')?>>
			<a href="<?=base_url()?>admin/overview"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.2 7.8l-7.7 7.7-4-4-5.7 5.7"/><path d="M15 7h6v6"/></svg> <span>پنل مدیریت</span></a>
                    </li> -->
            <?=($this->ion_auth->in_group(array('social','seo_manager','caller','write'))?'':'<li class="treeview '.($this->uri->segment(2)=='discount_code'?' active':'').'"><a href=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="float: left;margin-top: 2px;" class="arrowmainsvg"><path d="M15 18l-6-6 6-6"></path></svg><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16"><path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/><path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/></svg> <span>تنظیمات</span></a><ul class="treeview-menu svgtreemach"><li '.($this->uri->segment(2)=='discount_code'?'class="active"':'').'><a href="'.base_url().'admin/discount_code"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gift" viewBox="0 0 16 16"><path d="M3 2.5a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1 5 0v.006c0 .07 0 .27-.038.494H15a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 14.5V7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h2.038A2.968 2.968 0 0 1 3 2.506V2.5zm1.068.5H7v-.5a1.5 1.5 0 1 0-3 0c0 .085.002.274.045.43a.522.522 0 0 0 .023.07zM9 3h2.932a.56.56 0 0 0 .023-.07c.043-.156.045-.345.045-.43a1.5 1.5 0 0 0-3 0V3zM1 4v2h6V4H1zm8 0v2h6V4H9zm5 3H9v8h4.5a.5.5 0 0 0 .5-.5V7zm-7 8V7H2v7.5a.5.5 0 0 0 .5.5H7z"/></svg> تخفیفات</a></li><li '.($this->uri->segment(2)=='des_show'?'class="active"':'').'><a href="'.base_url().'description/des_show"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gift" viewBox="0 0 16 16"><path d="M3 2.5a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1 5 0v.006c0 .07 0 .27-.038.494H15a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 14.5V7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h2.038A2.968 2.968 0 0 1 3 2.506V2.5zm1.068.5H7v-.5a1.5 1.5 0 1 0-3 0c0 .085.002.274.045.43a.522.522 0 0 0 .023.07zM9 3h2.932a.56.56 0 0 0 .023-.07c.043-.156.045-.345.045-.43a1.5 1.5 0 0 0-3 0V3zM1 4v2h6V4H1zm8 0v2h6V4H9zm5 3H9v8h4.5a.5.5 0 0 0 .5-.5V7zm-7 8V7H2v7.5a.5.5 0 0 0 .5.5H7z"/></svg> توضیحات</a></li><li '.($this->uri->segment(2)=='visit_show'?'class="active"':'').'><a href="'.base_url().'review/visit_show"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gift" viewBox="0 0 16 16"><path d="M3 2.5a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1 5 0v.006c0 .07 0 .27-.038.494H15a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 14.5V7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h2.038A2.968 2.968 0 0 1 3 2.506V2.5zm1.068.5H7v-.5a1.5 1.5 0 1 0-3 0c0 .085.002.274.045.43a.522.522 0 0 0 .023.07zM9 3h2.932a.56.56 0 0 0 .023-.07c.043-.156.045-.345.045-.43a1.5 1.5 0 0 0-3 0V3zM1 4v2h6V4H1zm8 0v2h6V4H9zm5 3H9v8h4.5a.5.5 0 0 0 .5-.5V7zm-7 8V7H2v7.5a.5.5 0 0 0 .5.5H7z"/></svg> آمار بازدید</a></li></ul></li>')?>

        <?='<li class="treeview '.($this->uri->segment(2)=='estate_add' || $this->uri->segment(2)=='estate_show' || $this->uri->segment(2)=='estate_edit'?' active':'').'"><a href=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="float: left;margin-top: 2px;" class="arrowmainsvg"><path d="M15 18l-6-6 6-6"></path></svg><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> <span>اقامتگاه ها</span></a><ul class="treeview-menu svgtreemach">
        '.($this->ion_auth->in_group(array('social'))?'':'<li '.($this->uri->segment(2)=='estate_add'?'class="active"':'').'><a href="'.base_url().($this->ion_auth->in_group(array('host','guest'))?'users':'admin').'/estate_add"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>افزودن اقامتگاه</a></li>').'<li '.($this->uri->segment(2)=='estate_show'?'class="active"':'').'><a href="'.base_url().'admin/estate_show"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg>لیست اقامتگاه ها</a></li></ul></li>';
        if (!$this->ion_auth->in_group(array('write','caller'))){
		    echo '<li class="treeview '.($this->uri->segment(2)=='blog_show' || $this->uri->segment(2)=='blog_insert'?' active':'').'">
          <a href=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="float: left;margin-top: 2px;" class="arrowmainsvg"><path d="M15 18l-6-6 6-6"></path></svg><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 11a9 9 0 0 1 9 9"></path><path d="M4 4a16 16 0 0 1 16 16"></path><circle cx="5" cy="19" r="1"></circle></svg> <span>وبلاگ</span></a>
          <ul class="treeview-menu svgtreemach">
            '.($this->ion_auth->in_group(array('social'))?'':'<li '.($this->uri->segment(2)=='blog_insert'?'class="active"':'').'><a href="'.base_url().'blog/blog_insert"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>افزودن وبلاگ</a></li>').'
            <li '.($this->uri->segment(2)=='blog_show'?'class="active"':'').'><a href="'.base_url().'blog/blog_show"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg>لیست وبلاگ</a></li>
          </ul>
        </li>';
        }
        if (!$this->ion_auth->in_group(array('write','social','seo_manager','caller'))){
        echo '<li '.($this->uri->segment(2)=='bookings_admin'?'class="active"':'').'>
			<a href="'.base_url().'admin/bookings_admin"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16"> <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/> <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/> </svg> <span>رزروها</span></a>
		    </li>';
        }
				
        if (!$this->ion_auth->in_group(array('write','social','seo_manager','caller'))){
        echo '<li class="treeview '.($this->uri->segment(2)=='invoices' || $this->uri->segment(2)=='invoices_add'?' active':''),'">
        <a href=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="float: left;margin-top: 2px;" class="arrowmainsvg"><path d="M15 18l-6-6 6-6"></path></svg><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-credit-card-2-back" viewBox="0 0 16 16"> <path d="M11 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1z"/> <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2zm13 2v5H1V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zm-1 9H2a1 1 0 0 1-1-1v-1h14v1a1 1 0 0 1-1 1z"/> </svg> <span>تراکنش ها</span></a>
        <ul class="treeview-menu svgtreemach">
          <li '.($this->uri->segment(2)=='invoices_add'?'class="active"':'').'><a href="'.base_url().'admin/invoices_add"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>افزودن تراکنش</a></li>
          <li '.($this->uri->segment(2)=='invoices'?'class="active"':'').'><a href="'.base_url().'admin/invoices"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg>لیست تراکنش ها</a></li>
        </ul>
      </li>';
        }
        if (!$this->ion_auth->in_group(array('write','social','seo_manager','caller'))){
        echo '<li '.($this->uri->segment(2)=='comments' || $this->uri->segment(2)=='comments_show'?'class="active"':'').'><a href="'.base_url().'admin/comments"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg> <span>دیدگاه ها</span></a></li>
        <li '.($this->uri->segment(2)=='tasks'?'class="active"':'').'><a href="'.base_url().'admin/tasks"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path><line x1="4" y1="22" x2="4" y2="15"></line></svg> <span>کارها</span></a></li>
        <li '.($this->uri->segment(2)=='notifications'?'class="active"':'').'><a href="'.base_url().'admin/notifications"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0"></path></svg> <span>اطلاعیه ها</span></a></li>
		    <li '.($this->uri->segment(2)=='messages'?'class="active"':'').'>
          <a href="'.base_url().'admin/messages"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg><span>تائید پیام ها</span></a>
        </li>
            <li class="treeview '.($this->uri->segment(2)=='messages_inbox' || $this->uri->segment(2)=='messages_send'?' active':'').'">
              <a href=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="float: left;margin-top: 2px;" class="arrowmainsvg"><path d="M15 18l-6-6 6-6"></path></svg><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg><span>پیام ها</span></a>
              <ul class="treeview-menu svgtreemach">
                <li '.($this->uri->segment(2)=='messages_inbox'?'class="active"':'').'><a href="'.base_url().'admin/messages_inbox"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.5 12H16c-.7 2-2 3-4 3s-3.3-1-4-3H2.5"/><path d="M5.5 5.1L2 12v6c0 1.1.9 2 2 2h16a2 2 0 002-2v-6l-3.4-6.9A2 2 0 0016.8 4H7.2a2 2 0 00-1.8 1.1z"/></svg>دریافتی</a></li>
                <li '.($this->uri->segment(2)=='messages_send'?'class="active"':'').'><a href="'.base_url().'admin/messages_send"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon><line x1="3" y1="22" x2="21" y2="22"></line></svg>ارسالی</a></li>
              </ul>
            </li>
            <li '.($this->uri->segment(2)=='ticket_insert' || $this->uri->segment(2)=='ticket_show'?'class="active"':'').'>
              <a href="'.base_url().'admin/ticket_show"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg> <span>تیکت ها</span></a>
            </li>
            <li '.($this->uri->segment(2)=='profile_show'?'class="active"':'').'>
              <a href="'.base_url().'admin/profile_show"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg> <span>نمایه ها</span></a>
            </li>
            <li '.($this->uri->segment(2)=='all_sms_show'?'class="active"':'').'>
              <a href="'.base_url().'admin/all_sms_show"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect><line x1="12" y1="18" x2="12.01" y2="18"></line></svg> <span>پیامک ها</span></a>
            </li>
            <li>
              <a href="'.base_url().'admin/gmap_distance"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s-8-4.5-8-11.8A8 8 0 0 1 12 2a8 8 0 0 1 8 8.2c0 7.3-8 11.8-8 11.8z"></path><circle cx="12" cy="10" r="3"></circle></svg> <span>گوگل مپ</span></a>
            </li>
            <li '.($this->uri->segment(2)=='cms_show'?'class="active"':'').'>
              <a href="'.base_url().'admin/cms_show"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"></circle><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path></svg> <span>تماس ها</span></a>
            </li>
            <li>
                <a href="'.base_url().'admin/active_code"><svg viewBox="0 0 16 16" fill="currentColor" height="16" width="16" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 14.933a.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067v13.866zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z"/></svg> <span>کد موبایل</span></a>
            </li>
            <li>
                <a href="'.base_url().'admin/admins_monitoring"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-incognito" viewBox="0 0 16 16"><path fill-rule="evenodd" d="m4.736 1.968-.892 3.269-.014.058C2.113 5.568 1 6.006 1 6.5 1 7.328 4.134 8 8 8s7-.672 7-1.5c0-.494-1.113-.932-2.83-1.205l-.014-.058-.892-3.27c-.146-.533-.698-.849-1.239-.734C9.411 1.363 8.62 1.5 8 1.5s-1.411-.136-2.025-.267c-.541-.115-1.093.2-1.239.735m.015 3.867a.25.25 0 0 1 .274-.224c.9.092 1.91.143 2.975.143a30 30 0 0 0 2.975-.143.25.25 0 0 1 .05.498c-.918.093-1.944.145-3.025.145s-2.107-.052-3.025-.145a.25.25 0 0 1-.224-.274M3.5 10h2a.5.5 0 0 1 .5.5v1a1.5 1.5 0 0 1-3 0v-1a.5.5 0 0 1 .5-.5m-1.5.5q.001-.264.085-.5H2a.5.5 0 0 1 0-1h3.5a1.5 1.5 0 0 1 1.488 1.312 3.5 3.5 0 0 1 2.024 0A1.5 1.5 0 0 1 10.5 9H14a.5.5 0 0 1 0 1h-.085q.084.236.085.5v1a2.5 2.5 0 0 1-5 0v-.14l-.21-.07a2.5 2.5 0 0 0-1.58 0l-.21.07v.14a2.5 2.5 0 0 1-5 0zm8.5-.5h2a.5.5 0 0 1 .5.5v1a1.5 1.5 0 0 1-3 0v-1a.5.5 0 0 1 .5-.5"/></svg> <span>مانیتورینگ</span></a>
            </li>';
        }else{
            if ($this->ion_auth->in_group(array('write','caller'))){
              echo '<li '.($this->uri->segment(2)=='cms_show'?'class="active"':'').'>
                  <a href="'.base_url().'admin/cms_show"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"></circle><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path></svg> <span>تماس ها</span></a>
                </li>';
            }
            if (!$this->ion_auth->in_group(array('social','caller'))){
                echo '<li>
                    <a href="'.base_url().'users/profile_edit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5.52 19c.64-2.2 1.84-3 3.22-3h6.52c1.38 0 2.58.8 3.22 3"/><circle cx="12" cy="10" r="3"/><circle cx="12" cy="12" r="10"/></svg> <span>ویرایش نمایه</span></a>
                </li>';
            }
            if ($this->ion_auth->in_group(array('caller'))){
              echo '<li>
              <a href="'.base_url().'admin/bookings_admin"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16"> <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"></path> <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path> </svg><span>رزروها</span></span></a>
              </li>
              <li>
                  <a href="'.base_url().'admin/runpriceupdate"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg> <span>تعرفه قدیمی</span> '.($numqnsp>0?'<span class="label label-danger" id="labDangr">'.$this->siran->number2farsi($numqnsp).'</span>':'').'</a>
              </li>';
            }
            if ($this->ion_auth->in_group(array('caller'))){
              echo '<li>
                  <a href="'.base_url().'admin/profile_show"><svg xmlns="https://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg> <span>نمایه ها</span></a>
              </li>';
          }
        }
            if (!$this->ion_auth->in_group(array('social','seo_manager','caller','write'))){
                echo '<li><a href="'.base_url().'admin/calculator"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg> <span>کارکردها</span></a></li>';
            }
		}
		if ($this->ion_auth->logged_in() && $this->ion_auth->in_group(array('guest','host')))
		{
		?>
            <!-- <li <?=($this->uri->segment(2)=='overview'?'class="active"':'')?>><a href="<?=base_url()?>users/overview"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.2 7.8l-7.7 7.7-4-4-5.7 5.7"/><path d="M15 7h6v6"/></svg> <span>پنل مدیریت</span></a></li> -->
            <?='<li class="treeview '.($this->uri->segment(2)=='estate_add' || $this->uri->segment(2)=='estate_show'?' active':'').'"><a href=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="float: left;margin-top: 2px;" class="arrowmainsvg"><path d="M15 18l-6-6 6-6"></path></svg><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> <span>اقامتگاه ها</span></a><ul class="treeview-menu svgtreemach"><li '.($this->uri->segment(2)=='estate_add'?'class="active"':'').'><a href="'.base_url().'users/estate_add"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>افزودن اقامتگاه</a></li><li '.($this->uri->segment(2)=='estate_show'?'class="active"':'').'><a href="'.base_url().'users/estate_show"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg>لیست اقامتگاه ها</a></li></ul></li>'.($this->ion_auth->in_group(array('host'))?'
			<li '.($this->uri->segment(2)=='bookings_add'?'class="active"':'').'><a href="'.base_url().'users/bookings_add"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16"> <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/> <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/> </svg> <span>رزروهای دریافتی</span></a></li>':'')?>
            <li <?=($this->uri->segment(2)=='bookings'?'class="active"':'')?>><a href="<?=base_url()?>users/bookings"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="20.5" r="1"/><circle cx="18" cy="20.5" r="1"/><path d="M2.5 2.5h3l2.7 12.4a2 2 0 0 0 2 1.6h7.7a2 2 0 0 0 2-1.6l1.6-8.4H7.1"/></svg> <span>رزروهای من</span></a></li>
			<li <?=($this->uri->segment(2)=='favorites'?'class="active"':'')?>><a href="<?=base_url()?>users/favorites"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg> <span>علایق من</span></a></li>
            <li <?=($this->uri->segment(2)=='comments' || $this->uri->segment(2)=='comments_show'?'class="active"':'')?>><a href="<?=base_url()?>users/comments"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg> <span>دیدگاه ها</span></a></li>
            <li <?=($this->uri->segment(2)=='tasks'?'class="active"':'')?>><a href="<?=base_url()?>users/tasks"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path><line x1="4" y1="22" x2="4" y2="15"></line></svg> <span>کارها</span></a></li>
            <li <?=($this->uri->segment(2)=='notifications'?'class="active"':'')?>><a href="<?=base_url()?>users/notifications"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0"></path></svg> <span>اطلاعیه ها</span></a></li>
            <li class="treeview <?=($this->uri->segment(2)=='messages_inbox' || $this->uri->segment(2)=='messages_send'?' active':'')?>">
              <a href=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="float: left;margin-top: 2px;" class="arrowmainsvg"><path d="M15 18l-6-6 6-6"></path></svg><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg><span>پیام ها</span></a>
              <ul class="treeview-menu svgtreemach">
                <li <?=($this->uri->segment(2)=='messages_inbox'?'class="active"':'')?>><a href="<?=base_url()?>users/messages_inbox"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.5 12H16c-.7 2-2 3-4 3s-3.3-1-4-3H2.5"/><path d="M5.5 5.1L2 12v6c0 1.1.9 2 2 2h16a2 2 0 002-2v-6l-3.4-6.9A2 2 0 0016.8 4H7.2a2 2 0 00-1.8 1.1z"/></svg>دریافتی</a></li>
                <li <?=($this->uri->segment(2)=='messages_send'?'class="active"':'')?>><a href="<?=base_url()?>users/messages_send"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon><line x1="3" y1="22" x2="21" y2="22"></line></svg>ارسالی</a></li>
              </ul>
            </li>
            <li class="treeview <?=($this->uri->segment(2)=='ticket_insert' || $this->uri->segment(2)=='ticket_show'?' active':'')?>">
              <a href=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="float: left;margin-top: 2px;" class="arrowmainsvg"><path d="M15 18l-6-6 6-6"></path></svg><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg> <span>پشتیبانی</span></a>
              <ul class="treeview-menu svgtreemach">
                <li <?=($this->uri->segment(2)=='ticket_insert'?'class="active"':'')?>><a href="<?=base_url()?>users/ticket_insert"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon><line x1="3" y1="22" x2="21" y2="22"></line></svg>ارسال تیکت</a></li>
                <li <?=($this->uri->segment(2)=='ticket_show'?'class="active"':'')?>><a href="<?=base_url()?>users/ticket_show"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg>لیست تیکت ها</a></li>
              </ul>
            </li>
						<li <?=($this->uri->segment(2)=='profile_edit'?'class="active"':'')?>>
              <a href="<?=base_url()?>users/profile_edit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b8c7ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5.52 19c.64-2.2 1.84-3 3.22-3h6.52c1.38 0 2.58.8 3.22 3"/><circle cx="12" cy="10" r="3"/><circle cx="12" cy="12" r="10"/></svg> <span>ویرایش نمایه</span></a>
            </li>
    <?php
		}
		?>
          </ul>
        </section>
      </aside>
<?php
}
?>