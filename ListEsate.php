<?php
                $data = array();
                foreach ($query->result() as $idx=>$row) {
                    $uniq = random_string('alnum',5);
					$NumCom = $this->admin_model->GetWhere('comments', array('id_post' => $row->id))->num_rows();
					$NumComNew = $this->admin_model->GetWhere('comments', array('id_post' => $row->id,'show_admin'=>0))->num_rows();
					$NumBook = $this->admin_model->GetWhere('booking', array('relationship' => $row->id,'final_status' => '1','book_add' => '0'))->num_rows();
                    $simlimg = $this->admin_model->FetchCountries_Movaghat('(favorite > 0) desc, favorite asc', 'submit_house_images', array('relation' => $row->id));
                    $simlimgRow = $simlimg->row();

                    // $Query = $this->admin_model->GetWhere('submit_house', array('useradmin_code' => $users_id, 'final_record' => '4'));
                    // $row = $row = $Query->row();
                    // $QueryNumRows = $Query->num_rows();
                    $DataAvailable = "";$DataInstant = "";$DataSettings = "";
                    if($query->num_rows() > 0){
                        $var_rel_beforeinsert = $row->rel_beforeinsert;
                        // $QueryPriceBase = $this->admin_model->GetWhere('submit_house_price', array('relation' => $row->id,'type_price'=>1));
                        $QueryPriceBase = $this->admin_model->GetWhere('submit_house', array('id' => $row->id));
                        $row_pricebase = $QueryPriceBase->row();
                        $QueryPriceAdd = $this->admin_model->GetWhere('submit_house_price', array('relation' => $row->id,'type_price'=>2));
                        $QueryPriceAdd = $QueryPriceAdd;
                        $QueryPriceAddNumRows = $QueryPriceAdd->num_rows();

                        $QueryAvailable = $this->admin_model->GetWhere('submit_house_price', array('relation' => $row->id, 'available' => 1));
                        $QueryInstant = $this->admin_model->GetWhere('submit_house_price', array('relation' => $row->id, 'instant' => 1));
                        $QuerySettings = $this->admin_model->GetWhere('submit_house_price_settings', array('relation' => $row->id));
                        if($QueryAvailable->num_rows()>0){
                            foreach ($QueryAvailable->result() as $idx => $rowAvli) {
                                $DataAvailable .= $rowAvli->date . ',';
                            }
                        }
                        if($QueryInstant->num_rows()>0){
                            foreach ($QueryInstant->result() as $idx => $rowInst) {
                                $DataInstant .= $rowInst->date . ',';
                            }
                        }
                        if($QuerySettings->num_rows()>0){
                            foreach ($QuerySettings->result() as $idx => $rowSettings) {
                                $DataSettings .= $rowSettings->date . ',';
                            }
                        }
                    }

                    echo '<div class="cardsbx rowhous" id="'.random_string('alpha', 6).'" style="'.(isset($simlimgRow->images)?'background-image: url(https://up.grdagrd.com/uploads/' . $simlimgRow->images . '' . $simlimgRow->file_ext . ');':'background-color:#9f9f9f;').'">
                        <div class="cardsbx_info">
                        <input type="checkbox" name="price_every" value="'.(isset($row)&&isset($row->price_every)?$row->price_every:'').'" id="ns1" class="typpricns" style="display:none;" '.(isset($row_pricebase)&&isset($row->price_every)?($row->price_every>0?'checked="checked"':''):'').'>
                        <input type="hidden" name="nightly_price" value="'.( isset($row_pricebase)&&isset($row_pricebase->nightly_price) && $row_pricebase->nightly_price>'0'? $this->siran->numberformat($row_pricebase->nightly_price) : '').'" class="LeftSymInp numeric number FloorEstate required form-control NightlyPriceCL NiPrCLButAd" maxlength="10" id="'.(isset($row_pricebase->nightly_price) ?$row_pricebase->nightly_price:'0').'">
                        <input type="hidden" name="nightly_price_added" value="'.( isset($row_pricebase)&&isset($row_pricebase->nightly_price_added) && $row_pricebase->nightly_price_added>'0'? $this->siran->numberformat($row_pricebase->nightly_price_added) : '').'" class="LeftSymInp numeric number form-control NiPrCLButAd" maxlength="10" id="'.(isset($row_pricebase->nightly_price_added) ?$row_pricebase->nightly_price_added:'0').'">
                            <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16"><path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/><path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/></svg>' . $this->siran->number2farsi($row->counter) . '</span>
                            <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-fill" viewBox="0 0 16 16"><path d="M8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6-.097 1.016-.417 2.13-.771 2.966-.079.186.074.394.273.362 2.256-.37 3.597-.938 4.18-1.234A9.06 9.06 0 0 0 8 15z"/></svg>'.$this->siran->number2farsi($NumCom).'</span>
                            <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus-fill" viewBox="0 0 16 16"><path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0z"/></svg>'.$this->siran->number2farsi($NumBook).'</span>
                        </div>
                        <div class="cardsbx_profile">
                            <div class="cardsbx_profile_text bxpad col-sm-12">
                                <div class="clear">
                                    <h2>
									<div class="exlink' . ($row->final_record == '0' || $row->manuel_act == '1' || $row->delete_req == '1' ? ' disabled' : '') . '" style="padding: 0;width: -webkit-fill-available;height: -webkit-fill-available;border-radius: 0;border: 0px;cursor: pointer;" id="ExLnk" data-href="' . base_url() . 'home/estate/' . $row->id . '/' . url_title($row->title_summary) . '/" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin: -3px;margin-right: 5px;margin-left: 6px;"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg><span class="" style="">'.$row->title_summary.'</span></div></h2>
                                </div>
                                <div class="clear">
                                    <div class="col-sm-12" style=" margin-bottom: 10px; "
									>'.$row->province.'، '.$row->city.''.(empty($row->district) || $row->district == $row->city || $row->district == $row->province ? '' : ' ،' . $row->district).'</div>
                                </div>
                                <div class="clear">
									<div class="col-sm-6"><b>کد اقامتگاه: </b> '.$this->siran->number2farsi($row->id).'</div>
									<div class="col-sm-6"><b>نوع اقامتگاه: </b> '.($row->type_estate != '0' && !$row->other_estate ? $this->siran->TypeEstate($row->type_estate, '') : ($row->other_estate ? $row->other_estate : '')).'</div>
                                </div>
                                <div class="clear">
                                    <div class="col-sm-6" style="height: 20px;padding-top: 3px;"><b>زمان ثبت: </b><span style="display: inline-block;" title="' . $this->siran->number2farsi(jdate('l d F Y ساعت H:i',$this->siran->date_strtotime($row->date,$row->time))) . '">' . $this->siran->number2farsi($row->date) . '</span></div>
                                    <div class="col-sm-6" style="height: 20px;"><b>وضعیت: </b>'.($row->delete_req == '1' ? '<span class="badge bg-danger" style="color: #ffffff!important;font-size: 12px!important;font-weight: normal;">حذفی</span>' : ($row->final_record == '3' ? '<span class="badge bg-dark" style="color: #ffffff!important;font-size: 12px!important;font-weight: normal;;">غیرفعال</span>' : ($row->manuel_act == '1' ? '<span class="badge bg-info text-dark" style="font-size: 12px!important;font-weight: normal;">عدم نمایش</span>' : ($row->final_record == '4' ? '<span class="badge bg-secondary" style="color: #ffffff!important;font-size: 12px!important;font-weight: normal;">در حال ثبت</span>' : ($row->imageup == '1' ? '<span class="badge bg-warning text-dark" style="font-size: 12px!important;font-weight: normal;color: #fff!important;border-color: #bf7d03;">مشکل تصاویر</span>' : ($row->final_record == '0' ? '<span class="badge bg-primary" style="color: #ffffff!important;font-size: 12px!important;font-weight: normal;">در حال بررسی</span>' : ($row->final_record == '1' ? '<span class="badge bg-success" style="font-size: 12px!important;font-weight: normal;">فعال</span>' : '<span class="badge bg-primary" style="color: #ffffff!important;font-size: 12px!important;font-weight: normal;">در حال بررسی</span>'))))))).'</div>
                                </div>
								<div class="clear">
									
								</div>
                            </div>
							<div class="col-sm-12 butmrgpad bxbutone">
                            <div class="col-sm-2 butmrgpad">
                                <button type="button" class="btn btn-labeled btn-success pricessub'.($row->delete_req == '1'?' disabled':'').'" style="padding: 0;width: -webkit-fill-available;height: -webkit-fill-available;border-radius: 0;border: 0px;" data-bs-toggle="modal" data-bs-target="#priceChnge'.$idx.'"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg><span style="color: #000;font-size: 11px;">تعرفه</span></button>
                            <div class="modal" id="priceChnge'.$idx.'" style="overflow: scroll;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-id="">
            <div class="modal-dialog" style="min-width:600px;">
                <div class="modal-content">
                    <form autocomplete="off" class="form_upload '.$uniq.'" action="https://grdagrd.com/users/edit_data_estate_price" method="post" accept-charset="utf-8" enctype="multipart/form-data" id="SrlizAllFrm"> <input type="text" name="id" id="JustId" value="'.$row->id.'" style="display:none;">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="float: left;background: no-repeat;border: 0;">
                            <span aria-hidden="true"><svg viewBox="0 0 24 24" role="presentation" focusable="false" style="height: 16px;width: 16px;display: block;fill:#000;"><path d="m23.25 24c-.19 0-.38-.07-.53-.22l-10.72-10.72-10.72 10.72c-.29.29-.77.29-1.06 0s-.29-.77 0-1.06l10.72-10.72-10.72-10.72c-.29-.29-.29-.77 0-1.06s.77-.29 1.06 0l10.72 10.72 10.72-10.72c.29-.29.77-.29 1.06 0s .29.77 0 1.06l-10.72 10.72 10.72 10.72c.29.29.29.77 0 1.06-.15.15-.34.22-.53.22" fill-rule="evenodd"></path></svg></span>
                        </button>
                        <h5 class="modal-title" id="myModalLabel">مدیریت تعرفه های<span> اقامتگاه '.$this->siran->number2farsi($row->id).'</span> (آخرین بروزرسانی '.$this->siran->number2farsi($this->siran->humanTiming($row->price_update_date)).' پیش)</h5>
                    </div>
                    <div class="modal-body">
                            <input name="id_uniq" value="unq" type="hidden" />
                            <span class="DStarF" id="unique_qu">
                                <input name="id_price" id="IdPricDb" value="" type="hidden" />
                                <input name="dateSpcSortD3" type="hidden" class="dateSpcSort dateSmQt" />
                            </span>
                            <span style="font-size: 13px;color: #252525;">روش انتخابی شما برای قیمت گذاری این اقامتگاه به ازای هر <b>'.($row->price_every==1?'شب':'نفر').'</b> می باشد.<br><span style="font-size: 12px;color: #888888;">برای تغییر روش به '.($row->price_every==1?'نفری':'شبی').' لطفا از بخش ویرایش این اقامتگاه اقدام نمایید.</span><br><span style="font-size: 12px;color: #333333;">تعرفه ها نیاز به تغییر ندارند؟ برای تغییر تاریخ بروزرسانی، فقط این فرم را ذخیره نمایید.</span></span>
                            <div class="box-body">
                                    <table class="table table-bordered tbokrz">
                                        <tbody>
                                        <tr id="TblPicTh">
                                            <th>عنوان</th>
                                            <th>نرخ(تومان)</th>
                                        </tr>';
                                            
                                            if (isset($row)) {
                                                echo '<tr class="RowMach">
                                                    <td>پایه (ایام عادی)</td>
                                                    <td class="boxreqall"><i class="fa fa-asterisk" style="z-index:99;position:absolute;margin: 12px 5px 0;color:red" title="ضروری"></i><input type="text" name="nightly_price" value="'.( isset($row)&&isset($row->nightly_price) && $row->nightly_price>'0'? $this->siran->numberformat($row->nightly_price) : '').'" class="LeftSymInp numeric number FloorEstate required form-control NightlyPriceCL" style="width: 120px;text-align: left;direction: ltr;padding-right: 17px;padding-left: 5px;border-radius: 4px;" placeholder="شبی" aria-describedby="in1" maxlength="9">'.( isset($row)&&isset($row->nightly_price_update) && $row->nightly_price_update>'0'? '<div style="background-color: #5c6bb3; color: #fff; padding: 3px; padding-right: 5px; width: 100px; font-size: 13px;"
                                                    >'.$this->siran->numberformat($row->nightly_price_update).'<svg viewBox="0 0 24 24" role="presentation" focusable="false" class="delupprice" style="height: 14px;width: 14px;display: block;fill: #fff;float: left;margin: 2px;cursor: pointer;"><path d="m23.25 24c-.19 0-.38-.07-.53-.22l-10.72-10.72-10.72 10.72c-.29.29-.77.29-1.06 0s-.29-.77 0-1.06l10.72-10.72-10.72-10.72c-.29-.29-.29-.77 0-1.06s.77-.29 1.06 0l10.72 10.72 10.72-10.72c.29-.29.77-.29 1.06 0s .29.77 0 1.06l-10.72 10.72 10.72 10.72c.29.29.29.77 0 1.06-.15.15-.34.22-.53.22" fill-rule="evenodd"></path></svg></div>' : '').'</td>
                                                </tr>
                                                <tr class="RowMach">
                                                    <td>آخر هفته (چهارشنبه، پنجشنبه، جمعه)</td>
                                                    <td class="boxreqall"><input type="text" name="nightly_price_wkd" value="'.( isset($row->nightly_price_wkd) && $row->nightly_price_wkd>'0'? $this->siran->numberformat($row->nightly_price_wkd) : '').'" class="LeftSymInp numeric number FloorEstate form-control NightlyPriceCL" style="width: 120px;text-align: left;direction: ltr;padding-right: 17px;padding-left: 5px;border-radius: 4px;" placeholder="شبی" aria-describedby="in1" maxlength="9">'.( isset($row)&&isset($row->nightly_price_wkd_update) && $row->nightly_price_wkd_update>'0'? '<div style="background-color: #5c6bb3; color: #fff; padding: 3px; padding-right: 5px; width: 100px; font-size: 13px;">'.$this->siran->numberformat($row->nightly_price_wkd_update).'<svg viewBox="0 0 24 24" role="presentation" focusable="false" class="delupprice" style="height: 14px;width: 14px;display: block;fill: #fff;float: left;margin: 2px;cursor: pointer;"><path d="m23.25 24c-.19 0-.38-.07-.53-.22l-10.72-10.72-10.72 10.72c-.29.29-.77.29-1.06 0s-.29-.77 0-1.06l10.72-10.72-10.72-10.72c-.29-.29-.29-.77 0-1.06s.77-.29 1.06 0l10.72 10.72 10.72-10.72c.29-.29.77-.29 1.06 0s .29.77 0 1.06l-10.72 10.72 10.72 10.72c.29.29.29.77 0 1.06-.15.15-.34.22-.53.22" fill-rule="evenodd"></path></svg></div>' : '').'</td>
                                                </tr>
                                                <tr class="RowMach">
                                                    <td>تعطیلات خاص (روزهای پیک)</td>
                                                    <td class="boxreqall"><input type="text" name="nightly_price_spc" value="'.( isset($row) && isset($row->nightly_price_spc) && $row->nightly_price_spc>'0'? $this->siran->numberformat($row->nightly_price_spc) : '').'" class="LeftSymInp numeric number FloorEstate form-control NightlyPriceCL" style="width: 120px;text-align: left;direction: ltr;padding-right: 17px;padding-left: 5px;border-radius: 4px;" placeholder="شبی" aria-describedby="in1" maxlength="9">'.( isset($row)&&isset($row->nightly_price_spc_update) && $row->nightly_price_spc_update>'0'? '<div style="background-color: #5c6bb3; color: #fff; padding: 3px; padding-right: 5px; width: 100px; font-size: 13px;">'.$this->siran->numberformat($row->nightly_price_spc_update).'<svg viewBox="0 0 24 24" role="presentation" focusable="false" class="delupprice" style="height: 14px;width: 14px;display: block;fill: #fff;float: left;margin: 2px;cursor: pointer;"><path d="m23.25 24c-.19 0-.38-.07-.53-.22l-10.72-10.72-10.72 10.72c-.29.29-.77.29-1.06 0s-.29-.77 0-1.06l10.72-10.72-10.72-10.72c-.29-.29-.29-.77 0-1.06s.77-.29 1.06 0l10.72 10.72 10.72-10.72c.29-.29.77-.29 1.06 0s .29.77 0 1.06l-10.72 10.72 10.72 10.72c.29.29.29.77 0 1.06-.15.15-.34.22-.53.22" fill-rule="evenodd"></path></svg></div>' : '').'</td>
                                                </tr>
                                                '.($row->accommodates_added>0 ?'<tr class="RowMach">
                                                    <td>نفرات اضافه</td>
                                                    <td class="boxreqall"><i class="fa fa-asterisk" style="z-index:99;position:absolute;margin: 12px 5px 0;color:red" title="ضروری"></i><input type="text" name="nightly_price_added" value="'.( isset($row->nightly_price_added) && $row->nightly_price_added>'0'? $this->siran->numberformat($row->nightly_price_added) : '').'" class="LeftSymInp numeric number form-control DiscountCL" style="width: 120px;text-align: left;direction: ltr;padding-right: 17px;padding-left: 5px;border-radius: 4px;" placeholder="اضافه" aria-describedby="in1" maxlength="9" id="'.(isset($row->nightly_price_added) ?$row->nightly_price_added:'').'">'.( isset($row)&&isset($row->nightly_price_added_update) && $row->nightly_price_added_update>'0'? '<div style="background-color: #5c6bb3; color: #fff; padding: 3px; padding-right: 5px; width: 100px; font-size: 13px;"
                                                    >'.$this->siran->numberformat($row->nightly_price_added_update).'<svg viewBox="0 0 24 24" role="presentation" focusable="false" class="delupprice" style="height: 14px;width: 14px;display: block;fill: #fff;float: left;margin: 2px;cursor: pointer;"><path d="m23.25 24c-.19 0-.38-.07-.53-.22l-10.72-10.72-10.72 10.72c-.29.29-.77.29-1.06 0s-.29-.77 0-1.06l10.72-10.72-10.72-10.72c-.29-.29-.29-.77 0-1.06s.77-.29 1.06 0l10.72 10.72 10.72-10.72c.29-.29.77-.29 1.06 0s .29.77 0 1.06l-10.72 10.72 10.72 10.72c.29.29.29.77 0 1.06-.15.15-.34.22-.53.22" fill-rule="evenodd"></path></svg></div>' : '').'</td>
                                                </tr>':'');
                                       
