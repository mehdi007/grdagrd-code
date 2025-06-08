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
                                            };
                                        echo '</tbody>
                                    </table>
                                    <div style="font-size: 12px;padding: 3px;padding-right: 5px;float: right;clear: both;">کمسیون دریافتی گرداگرد '.$this->siran->number2farsi($row->commission).'% است.</div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <a id="cancelMod" style="cursor: pointer;margin: 10px .5em 0;display: inline-block;float: left;" data-dismiss="modal" class="btn-close">بستن</a>
                        <button type="button" class="btn btn-success" id="SubForm" data-id="'.$uniq.'" style="float: right;margin-right: 10px;border: 0px!important;background-color: #000!important;" data-accadd="'.$row->accommodates_added.'">ثبت</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
                        </div>
								<div class="col-sm-2 butmrgpad">
								<button type="button" class="btn btn-labeled btn-secondary dateprice AddPricSpsDate butaddpricdt'.($row->delete_req == '1'?' disabled':'').'" style="padding: 0;width: -webkit-fill-available;height: -webkit-fill-available;border-radius: 0;border: 0px;" id="' . $this->encrypt->encode($row->id) . '" data-id="' . $this->encrypt->encode($row->useradmin_code) . '"  data-bs-toggle="modal" data-bs-target="'.(isset($row_pricebase)&&isset($row)?($row->price_every>0?'#AddPrice'.$row->id:''):'').'" ><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg><span style="color: #000;font-size: 11px;">تقویم</span></button>
                                <div class="pricemod modal mfullscreen ListPricDate'.$row->id.' pricdatebx" id="AddPrice'.$row->id.'" data-id="'.$row->id.'"  data-bs-backdrop="true" data-bs-keyboard="false" tabindex="-1" aria-labelledby="AddPrice'.$row->id.'Label" aria-hidden="true">
                                <div class="modal-dialog modal-fullscreen">
                                    <input type="hidden" name="availableall" class="available_all" value="'.$DataAvailable.'">
                                    <input type="hidden" name="instantall" class="instant_all" value="'.$DataInstant.'">
                                    <input type="hidden" name="instantall" class="settings_all" value="'.$DataSettings.'">
                                    <input type="hidden" name="idestate" class="idestate" value="'.$row->id.'">
                                    <input type="hidden" name="base_night_price_wkd" class="basenightpricewkd" value="'.(isset($row_pricebase->nightly_price_wkd) ?$row_pricebase->nightly_price_wkd:'0').'">
                                    <input type="hidden" name="base_night_price" class="basenightprice" value="'.(isset($row_pricebase->nightly_price) ?$row_pricebase->nightly_price:'0').'">
                                    <input type="hidden" name="base_night_price_add" class="basenightpriceadd" value="'.(isset($row_pricebase) ?$row_pricebase->nightly_price_added:'0').'">
                                    <input type="hidden" class="AccommodatesAdded" name="accommodates_added" value="'.( isset($row) ? $row->accommodates_added : 0).'">
                                    <input type="hidden" name="price_every" value="'.(isset($row)&&isset($row->price_every)?$row->price_every:'').'" class="typpricns">
                                    <div class="modal-content" id="'.isset($row).'">
                                        '.( isset($row)?$this->siran->getdateprice($row->id):'').'
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="margin-top: 1em;margin-right: 2em;box-shadow: none;position: fixed;z-index: 99;margin: 15px;"></button>
                                        <div class="modal-body">
                                            <div class="col-9 datebxdays" style="float: right;">
                                                <span id="daten'.$idx.'" class="cursor-pointer datenessh" data-mds-dtp-guid="28ec068a-5519-46fd-8348-4964432dc98f" data-bs-original-title="" title=""></span>
                                            </div>
                                            <div class="col-3 clodatechnge" style="float: left;overflow: auto;height: 100vh !important;">
                                                <div class="boxchndt startbxpric" style="margin-top: 4em;margin-bottom: 4em;margin-right: 1em;margin-left: 1em;"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 400 400" xml:space="preserve" width="48px" height="48px" fill="#000000"><g id="SVGRepo_iconCarrier"> <path style="fill:#FAFAFA;" d="M372.509,401.37H28.326c-8.855,0-16.033-7.179-16.033-16.033V66.806 c0-8.855,7.179-16.033,16.033-16.033h344.184c8.855,0,16.033,7.179,16.033,16.033v318.53 C388.543,394.191,381.364,401.37,372.509,401.37z"></path> <path style="fill:#FF8C78;" d="M372.509,50.772H28.326c-8.855,0-16.033,7.179-16.033,16.033v43.825h376.251V66.806 C388.543,57.951,381.364,50.772,372.509,50.772z"></path> <path style="fill:#E5E5E5;" d="M60.791,50.772H28.326c-8.855,0-16.033,7.179-16.033,16.033v318.53 c0,8.855,7.179,16.033,16.033,16.033h279.69L60.791,50.772z"></path> <path style="fill:#DF7A6E;" d="M60.791,50.772H28.326c-8.855,0-16.033,7.179-16.033,16.033v43.825H103L60.791,50.772z"></path> <g> <rect x="97.804" y="8.017" style="fill:#E5E5E5;" width="34.205" height="76.96"></rect> <rect x="183.315" y="8.017" style="fill:#E5E5E5;" width="34.205" height="76.96"></rect> <rect x="268.827" y="8.017" style="fill:#E5E5E5;" width="34.205" height="76.96"></rect> </g> <polygon style="fill:#6DDAE1;" points="200.418,187.591 132.008,221.795 132.008,332.96 183.315,332.96 183.315,273.102 217.52,273.102 217.52,332.96 268.827,332.96 268.827,221.795 "></polygon> <polygon style="fill:#4FC4D3;" points="132.008,221.795 132.008,332.96 158.731,332.96 158.731,208.434 "></polygon>    <path d="M217.52,340.977h51.307c4.428,0,8.017-3.588,8.017-8.017V221.795c0-3.037-1.716-5.813-4.432-7.17l-68.409-34.205 c-2.256-1.13-4.915-1.13-7.171,0l-68.409,34.205c-2.715,1.359-4.432,4.133-4.432,7.17V332.96c0,4.428,3.588,8.017,8.017,8.017 h51.307c4.428,0,8.017-3.588,8.017-8.017v-51.841h18.171v51.841C209.503,337.389,213.091,340.977,217.52,340.977z M183.315,265.086 c-4.428,0-8.017,3.588-8.017,8.017v51.841h-35.273v-98.193l60.392-30.196l60.392,30.196v98.193h-35.273v-51.841 c0-4.428-3.588-8.017-8.017-8.017H183.315z"></path> <path d="M294.473,212.711c2.839,0,5.589-1.511,7.045-4.178c2.12-3.888,0.688-8.756-3.198-10.877l-94.063-51.307 c-2.394-1.305-5.284-1.305-7.679,0l-94.063,51.307c-3.886,2.12-5.319,6.99-3.198,10.877c2.12,3.885,6.988,5.321,10.877,3.198 l90.223-49.213l90.223,49.213C291.86,212.396,293.175,212.712,294.473,212.711z"></path></g></svg><div class="titistrdtbx">در حال بروز رسانی تقویم اقامتگاه</div><div class="captitcndtbx">یک یا چند تاریخ را برای تنظیم قیمت و در دسترس بودن اقامتگاه انتخاب کنید.</div><div style="font-size:13px!important;line-height:18px!important;color:#717171!important;font-weight:400!important;margin-top:8px!important;min-height:18px!important">روی تاریخ دوم دابل کلیک نمایید.</div></div>
                                                <div class="calpricchngbx closbxpr" style="display:none;">
                                                    <div class="boxchndt" style="margin-top: 1em;float: right;width: auto;padding-left: 1em;padding-right: 1em;">
                                                        <div style="float: right;position: unset;">
                                                            <div class="PrcHdSvgButcr clospricbx">
                                                                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-label="Close" role="img" focusable="false" style="display: block;fill: none;height: 16px;width: 16px;stroke: currentcolor;stroke-width: 4;overflow: visible;margin: 0 auto;top: 50%;/* transform: translate(-100%,0%); */"><path d="m6 6 20 20"></path><path d="m26 6-20 20"></path></svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="boxchndt" style="display:block;margin-top: 1em;float: right;width: 100%;padding-left: 1em;padding-right: 1em;">
                                                        <div style="padding-bottom: 48px;float: right;width: 100%;">
                                                            <div class="titdatebx" style="position: relative;">
                                                                <h2 class="h2titbx">
                                                                    <span class="spntitbx"></span>
                                                                </h2>
                                                                <div id=datemin class=chngedatemini data-dtid=daten'.$idx.' style=float:left;text-decoration:underline;font-size:15px;margin:7px;cursor:pointer>
                                                                    تغییر تاریخ
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div style="padding-bottom: 36px;width: 100%;float: right;">
                                                            <div class="disflex">
                                                                <div class="txtavalbx">
                                                                    <span class="avltxbx">در دسترس</span>
                                                                </div>
                                                                <div class="butynavlbx">
                                                                    <div class="crkeowm">
                                                                        <div>
                                                                            <input class="cnsactlavlinp AvailableYs" type="radio" name="available" id="AvailableYs'.$row->id.'" value="0" checked="">
                                                                            <label class="cnsactlavlLbl avalselect AvailableYsFor" for="AvailableYs'.$row->id.'"  data-toggle="true">
                                                                                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" role="presentation" focusable="false"style="display: block; fill: none; height: 16px; width: 16px; stroke: currentcolor; stroke-width: 3; overflow: visible;"><path fill="none" d="m4 16.5 8 8 16-16"></path></svg>
                                                                            </label>
                                                                        </div>
                                                                        <div class="cnslactavl">
                                                                            <input class="cnsactlavlinp AvailableNo" type="radio" name="available" id="AvailableNo'.$row->id.'" value="1" />
                                                                            <label class="cnsactlavlLbl AvailableNoFor" for="AvailableNo'.$row->id.'">
                                                                                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" role="presentation" focusable="false" style="display: block; fill: none; height: 16px; width: 16px; stroke: currentcolor; stroke-width: 3; overflow: visible;"><path d="m6 6 20 20"></path><path d="m26 6-20 20"></path></svg>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="disflex" style="margin-top: 1em;">
                                                                <div class="txtavalbx">
                                                                    <span class="avltxbx">رزرو آنی</span>
                                                                </div>
                                                                <div class="butynavlbx">
                                                                    <div class="crkeowm">
                                                                        <div>
                                                                            <input class="cnsactlavlinp InstantYs" type="radio" name="instant" id="InstantYs'.$row->id.'" value="1" checked="">
                                                                            <label class="cnsactlavlLbl InstantYsFor" for="InstantYs'.$row->id.'" data-toggle="true">
                                                                                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" role="presentation" focusable="false"style="display: block; fill: none; height: 16px; width: 16px; stroke: currentcolor; stroke-width: 3; overflow: visible;"><path fill="none" d="m4 16.5 8 8 16-16"></path></svg>
                                                                            </label>
                                                                        </div>
                                                                        <div class="cnslactavl">
                                                                            <input class="cnsactlavlinp InstantNo" type="radio" name="instant" id="InstantNo'.$row->id.'" value="0" />
                                                                            <label class="cnsactlavlLbl avalselect InstantNoFor" for="InstantNo'.$row->id.'">
                                                                                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" role="presentation" focusable="false" style="display: block; fill: none; height: 16px; width: 16px; stroke: currentcolor; stroke-width: 3; overflow: visible;"><path d="m6 6 20 20"></path><path d="m26 6-20 20"></path></svg>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div style=font-size:12px;text-align:right;text-align:justify;color:#666;margin-left:16px>برای تخفیف لحظه آخری رزرو آنی را فعال کنید، سپس به تنظیمات سفارشی بخش تخفیف ها مراجعه نمایید.</div>
                                                        </div>
                                                    </div>
                                                    <div class="hr_line"></div>
                                                    <div class="boxchndt pricing" style="display:block;margin-top: 1em;float: right;width: 100%;padding-left: 1em;padding-right: 1em;">
                                                        <h3 class="pricingh3">
                                                            <span id="" class="pricinghsp">
                                                                قیمت گذاری
                                                            </span>
                                                        </h3>
                                                        <div class="_e296pg aslprbxu">
                                                            <div class="c1rg65t0">
                                                                <label class="it3ysxn" for="nightprice">
                                                                    <div class="l1bm6uz3">
                                                                        <div class="l12j3uvm"><span>قیمت شبانه</span></div>
                                                                    </div>
                                                                    <div dir="ltr">
                                                                        <div class="i1vtfp57">
                                                                            <div class="i1af8x53 icru09g i1o2p44h"><span>تومان</span></div>
                                                                            <input class="icqyia numeric inputBlur" id="nightprice"  data-focus="nightpricl" autocomplete="off" inputmode="tel" type="text" value="" />
                                                                        </div>
                                                                    </div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="boxchndt pricing" style="display:block;margin-top: 0em;float: right;width: 100%;padding-left: 2em;padding-right: 2em;padding-top: 0;">
                                                        <div class="_jro6t0">
                                                            <div class="_52efch">
                                                                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 16px; width: 16px; fill: currentcolor;"><path d="M27 0H5a2 2 0 0 0-2 2v27l.006.114c.087.814 1.099 1.196 1.701.593L8 26.415l3.293 3.292.094.083a1 1 0 0 0 1.32-.083L16 26.415l3.293 3.292.094.083a1 1 0 0 0 1.32-.083L24 26.415l3.293 3.292c.63.63 1.707.184 1.707-.707V2a2 2 0 0 0-2-2zm-5 17.25H10v-2.5h12zm0-6H10v-2.5h12z"></path></svg>
                                                            </div>
                                                            <div><span style="color: rgb(34, 34, 34);font-size: 16px;font-weight: 400;line-height: 20px;text-align: right;float: right;font-size: 13px;">پس از کسر کمسیون شما شبی <span class="pricviw" data-com="'.$row->commission.'">۰</span> تومان به ازای <span class="txnitcng">هر شب</span> کسب خواهید کرد.</span></div>
                                                        </div>
                                                    </div>
                                                    <div class="boxchndt pricing pricaddebx" style="display:'.(isset($row_pricebase)&&isset($row)?($row->price_every==1&&$row->accommodates_added>0?'block':'none'):'').';margin-top: -1em;float: right;width: 100%;padding-left: 1em;padding-right: 1em;">
                                                        <div class="_e296pg aslprbxu">
                                                            <div class="c1rg65t0">
                                                                <label class="it3ysxn" for="nightpriceadded">
                                                                    <div class="l1bm6uz3">
                                                                        <div class="l12j3uvm"><span>قیمت نفر اضافه</span></div>
                                                                    </div>
                                                                    <div dir="ltr">
                                                                        <div class="i1vtfp57">
                                                                            <div class="i1af8x53 icru09g i1o2p44h"><span>تومان</span></div>
                                                                            <input class="'.(isset($row_pricebase)&&isset($row)?($row->price_every==1&&$row->accommodates_added>0?'requiredval ':''):'').'icqyia numeric inputBlur" id="nightpriceadded" data-focus="nightpricladd" autocomplete="off" inputmode="tel" type="text" value="'.(isset($row_pricebase)&&isset($row)?($row->accommodates_added>0?$this->siran->numberformat($row_pricebase->nightly_price_added):''):'').'" readonly/>
                                                                        </div>
                                                                    </div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="hr_line"></div>
                                                    <div class="boxchndt pricing" style="display:block;margin-top: 1em;margin-bottom: 3em;float: right;width: 100%;padding-left: 1em;padding-right: 1em;">
                                                        <h3 class="pricingh3">
                                                            <span id="" class="pricinghsp">
                                                                تنظیمات سفارشی
                                                            </span>
                                                        </h3>
                                                        <div class="txtavalbx">
                                                            <span class="avltxbx" style=" font-weight: 400 !important; color: rgb(113, 113, 113) !important; font-size: 13px; line-height: 1.43; ">
                                                            تنظیمات مدت اقامت را سفارشی کنید یا برای تاریخ های انتخابی تخفیف اضافه کنید تا مهمانان به رزرو تشویق شوند.
                                                            </span>
                                                            <div class="_eodux1">
                                                            <button type="button" class="l1j9v1wn b1qnr4x4 c1p20n7u showdisbx editepricsett" style="display:none">
                                                                    <span>
                                                                    <h5 style="text-align: right;font-size: 16px;font-weight: bold;padding-top: 5px;padding-bottom: 10px;border-bottom: 1px solid #aeaeae;"><div class="svgsettings" style="margin-left: 5px;"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 442.091 442.091" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M275.434,124.959c-4.806-2.721-10.908-1.03-13.628,3.776L162.88,303.504c-2.721,4.806-1.03,10.908,3.776,13.628 c1.557,0.881,3.248,1.3,4.917,1.3c3.486,0,6.872-1.826,8.712-5.076l98.926-174.769 C281.932,133.781,280.241,127.679,275.434,124.959z"></path> <path d="M195.628,206.39c6.004-10.413,7.594-22.541,4.477-34.149c-3.117-11.608-10.568-21.309-20.981-27.313 c-10.412-6.005-22.538-7.594-34.149-4.478c-11.609,3.117-21.309,10.568-27.313,20.981c-6.004,10.413-7.594,22.541-4.477,34.15 c3.117,11.608,10.569,21.308,20.982,27.313c6.929,3.995,14.616,6.036,22.405,6.035c3.917,0,7.86-0.516,11.744-1.559 C179.924,224.254,189.624,216.803,195.628,206.39z M144.156,205.568c-5.785-3.336-9.925-8.725-11.657-15.174 s-0.849-13.188,2.487-18.972c3.335-5.785,8.725-9.925,15.174-11.656c2.158-0.58,4.348-0.867,6.524-0.867 c4.327,0,8.598,1.135,12.447,3.354c5.785,3.336,9.925,8.725,11.657,15.175c1.732,6.449,0.849,13.187-2.487,18.971 c-3.335,5.785-8.724,9.925-15.174,11.656C156.678,209.788,149.941,208.903,144.156,205.568z"></path> <path d="M307.925,219.196c-10.413-6.004-22.54-7.594-34.149-4.477c-11.609,3.117-21.309,10.568-27.313,20.981 c-6.004,10.413-7.594,22.541-4.477,34.15c3.117,11.608,10.569,21.308,20.981,27.313c6.929,3.995,14.616,6.036,22.405,6.035 c3.917,0,7.859-0.516,11.744-1.559c11.609-3.117,21.309-10.568,27.313-20.981c6.004-10.413,7.594-22.541,4.477-34.149 C325.789,234.901,318.338,225.201,307.925,219.196z M307.104,270.668c-3.335,5.785-8.725,9.925-15.174,11.656 c-6.448,1.733-13.187,0.849-18.971-2.486c-5.785-3.336-9.925-8.725-11.657-15.174s-0.849-13.188,2.487-18.972 c3.335-5.785,8.724-9.925,15.174-11.656c2.158-0.58,4.348-0.867,6.524-0.867c4.327,0,8.598,1.135,12.447,3.354 c5.785,3.336,9.925,8.725,11.657,15.175C311.323,258.146,310.44,264.884,307.104,270.668z"></path> <path d="M424.988,221.046c0-6.889,1.94-14.751,3.993-23.075c3.447-13.973,7.354-29.81,2.344-45.243 c-5.21-16.046-17.959-26.707-29.208-36.113c-6.335-5.298-12.319-10.301-16.068-15.452c-3.835-5.271-6.798-12.59-9.934-20.339 c-5.467-13.506-11.663-28.814-25.121-38.609c-13.338-9.707-29.75-10.895-44.231-11.941c-8.407-0.608-16.347-1.183-22.679-3.238 c-5.875-1.907-12.371-5.987-19.249-10.307C252.349,8.887,238.198,0,221.045,0s-31.304,8.887-43.789,16.728 c-6.877,4.319-13.374,8.399-19.248,10.307c-6.333,2.056-14.273,2.63-22.68,3.238c-14.48,1.047-30.893,2.234-44.231,11.941 c-13.458,9.795-19.654,25.104-25.121,38.609c-3.137,7.749-6.099,15.068-9.934,20.339c-3.75,5.151-9.733,10.155-16.068,15.452 c-11.249,9.406-23.998,20.067-29.207,36.111c-5.012,15.434-1.104,31.271,2.343,45.244c2.054,8.325,3.993,16.188,3.993,23.076 s-1.939,14.751-3.993,23.074c-3.447,13.974-7.354,29.811-2.343,45.245c5.209,16.044,17.959,26.705,29.208,36.111 c6.335,5.297,12.319,10.301,16.068,15.452c3.835,5.271,6.797,12.59,9.934,20.339c5.467,13.507,11.663,28.815,25.121,38.609 c13.338,9.707,29.75,10.895,44.231,11.941c8.407,0.608,16.347,1.183,22.679,3.238c5.875,1.908,12.371,5.987,19.249,10.307 c12.485,7.841,26.636,16.728,43.789,16.728s31.303-8.887,43.788-16.727c6.878-4.319,13.374-8.399,19.25-10.307 c6.333-2.057,14.273-2.631,22.681-3.239c14.48-1.047,30.892-2.234,44.23-11.941c13.458-9.795,19.654-25.104,25.121-38.609 c3.136-7.749,6.099-15.068,9.935-20.339c3.749-5.151,9.733-10.155,16.068-15.452c11.248-9.406,23.998-20.067,29.207-36.111 c5.012-15.434,1.104-31.271-2.343-45.245C426.928,235.797,424.988,227.935,424.988,221.046z M399.855,251.307 c2.728,11.057,5.304,21.5,2.936,28.793c-2.544,7.834-10.983,14.892-19.918,22.362c-7.451,6.23-15.155,12.673-21.08,20.814 c-6.005,8.25-9.808,17.647-13.487,26.735c-4.342,10.729-8.444,20.863-14.966,25.609c-6.403,4.66-17.254,5.445-28.741,6.275 c-9.824,0.711-19.983,1.446-29.781,4.628c-9.414,3.056-17.815,8.332-25.939,13.434c-9.936,6.239-19.32,12.133-27.833,12.133 s-17.898-5.894-27.834-12.133c-8.124-5.103-16.525-10.378-25.939-13.435c-9.798-3.182-19.956-3.916-29.78-4.627 c-11.488-0.83-22.338-1.615-28.742-6.275c-6.521-4.746-10.623-14.88-14.965-25.609c-3.679-9.088-7.482-18.485-13.487-26.735 c-5.924-8.142-13.629-14.584-21.08-20.814c-8.935-7.472-17.375-14.528-19.918-22.361c-2.368-7.294,0.208-17.737,2.936-28.794 c2.393-9.698,4.867-19.727,4.867-30.261s-2.474-20.563-4.867-30.262c-2.728-11.057-5.304-21.5-2.936-28.793 c2.543-7.834,10.983-14.892,19.918-22.362c7.451-6.23,15.155-12.673,21.08-20.814c6.005-8.25,9.808-17.647,13.487-26.735 c4.342-10.729,8.444-20.863,14.966-25.609c6.403-4.66,17.254-5.445,28.742-6.275c9.824-0.711,19.982-1.445,29.781-4.627 c9.413-3.057,17.814-8.332,25.938-13.435C203.147,35.894,212.531,30,221.045,30c8.514,0,17.899,5.894,27.834,12.133 c8.125,5.103,16.525,10.378,25.939,13.435c9.798,3.182,19.956,3.916,29.78,4.627c11.488,0.83,22.338,1.615,28.742,6.275 c6.521,4.746,10.624,14.881,14.966,25.609c3.679,9.088,7.482,18.485,13.486,26.735c5.925,8.141,13.629,14.583,21.08,20.813 c8.935,7.472,17.375,14.529,19.919,22.363c2.368,7.293-0.209,17.737-2.937,28.794c-2.393,9.698-4.867,19.727-4.867,30.261 S397.462,241.608,399.855,251.307z"></path> </g> </g></svg></div><span class="titlecusdis"></span></h5>
                                                                    <div style="text-align: right;font-size: 12px;padding-top: 5px;padding-bottom: 5px;border-bottom: 1px solid #eaeaea;">
                                                                        <span>حداقل اقامت <span class="minnit" style="font-weight: bold;"></span> شب </span>|<span>حداکثر اقامت <span class="maxnit" style="font-weight: bold;"></span> شب</span>
                                                                    </div>
                                                                    <div style="text-align: right;font-size: 12px;padding-top: 5px;padding-bottom: 5px;">
                                                                        <span style="font-weight: bold;">تخفیفات:</span>
                                                                        <span class="alldisnm"></span>
                                                                    </div>
                                                                </span></button>
                                                                <button type="button" class="l1j9v1wn b1qnr4x4 c1p20n7u showdisbx addpricsett">
                                                                    <span>
                                                                        + افزودن تنظیمات سفارشی
                                                                    </span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                            <div class="_n0520t cusdisbx" style="display:none">
                                <div class="_1sjmvoc">
                                    <div class="_13nncl3">
                                        <div role="dialog" aria-label="Create new custom setting" class="_y7u13hm">
                                            <section>
                                                <div class="_wpwi48">
                                                    <div class="_152qbzi">
                                                        <button type="button" class="_1rp5252 clsbxis" aria-busy="false" style="padding: 20px; margin: -20px;">
                                                            <svg viewBox="0 0 24 24" role="img" aria-hidden="false" aria-label="Close" focusable="false" style="height: 16px; width: 16px; display: block; fill: rgb(118, 118, 118);">
                                                                <path
                                                                    d="m23.25 24c-.19 0-.38-.07-.53-.22l-10.72-10.72-10.72 10.72c-.29.29-.77.29-1.06 0s-.29-.77 0-1.06l10.72-10.72-10.72-10.72c-.29-.29-.29-.77 0-1.06s.77-.29 1.06 0l10.72 10.72 10.72-10.72c.29-.29.77-.29 1.06 0s .29.77 0 1.06l-10.72 10.72 10.72 10.72c.29.29.29.77 0 1.06-.15.15-.34.22-.53.22"
                                                                    fill-rule="evenodd"
                                                                ></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <section>
                                                        <div class="_uy08umt">
                                                            <div style="margin: 0px;">
                                                                <section>
                                                                    <div>
                                                                        <div>
                                                                            <div class="_2h22gn">
                                                                                <div class="_3zx37fj">
                                                                                    <div class="_1mbllh6j">
                                                                                        <h2 tabindex="-1" elementtiming="LCP-target" class="_14i3z6h"><div class="_s1tlw0m">تنظیم سفارشی جدید ایجاد کنید</div></h2>
                                                                                        <div class="_czm8crp"><span>این تنظیمات جایگزین در دسترس بودن پیش فرض و تخفیف های شما در محدوده تاریخی که انتخاب کرده اید خواهد شد.</span></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                        <div>
                                                                            <div>
                                                                                <div class="_2h22gn">
                                                                                    <div class="_n7p6q07">
                                                                                        <div>
                                                                                            <div style="margin-bottom: 8px;">
                                                                                                <label class="_rin72m" for="title">
                                                                                                    <div class="_1p3joamp">نام<span class="_1rbmiub1">&nbsp;–&nbsp;ضروری</span></div>
                                                                                                </label>
                                                                                            </div>
                                                                                            <div class="_9hxttoo">
                                                                                                <div dir="ltr">
                                                                                                    <div class="_1wcr140x">
                                                                                                        <div class="_178faes">
                                                                                                            <input class="_14fdu48d" id="titlecusdis" name="title" placeholder="مثال: فصل بهار" type="text" value="" aria-invalid="true" aria-describedby="title_error" />
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div id="title_error" aria-live="polite" class="_r2ekfgc">نام مهم است</div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div style="margin-top: 24px; margin-bottom: 32px;"><div class="_7qp4lh"></div></div>
                                                                                <div style="margin-bottom: 24px;">
                                                                                    <h3 tabindex="-1" class="hghzvl1" elementtiming="LCP-target"><span class="_kso7xm">مدت اقامت</span></h3>
                                                                                    <div class="_czm8crp">حداقل و حداکثر شب مجاز اقامت را برای دسترسی مهمانانی که در این بازه تاریخ اقامتگاه شما را برای اقامت جستجو می‌کنند، تنظیم کنید.</div>
                                                                                </div>
                                                                                <div class="_2h22gn RowMach">
                                                                                    <div class="_iq8x9is">
                                                                                        <div class="_9hxttoo">
                                                                                            <div style="margin-bottom: 8px;">
                                                                                                <label class="_rin72m" for="minNight"><div class="_1p3joamp">حداقل اقامت</div></label>
                                                                                            </div>
                                                                                            <div dir="ltr">
                                                                                                <div class="_1wcr140x">
                                                                                                    <div class="_178faes">
                                                                                                        <input autocomplete="off" class="_14fdu48d comtwonumber_more inpwitspn" id="minNight" inputmode="numeric" maxlength="4" name="minNight" type="text" value="" />
                                                                                                        <div class="_14od9oe"><span class="_mtxh7r4" style="right: 10px; visibility: visible;">شب</span><span class="_ic6qqsu"></span></div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="_iq8x9is">
                                                                                        <div class="_9hxttoo">
                                                                                            <div style="margin-bottom: 8px;">
                                                                                                <label class="_rin72m" for="maxNight"><div class="_1p3joamp">حداکثر اقامت</div></label>
                                                                                            </div>
                                                                                            <div dir="ltr">
                                                                                                <div class="_1wcr140x">
                                                                                                    <div class="_178faes">
                                                                                                        <input autocomplete="off" class="_14fdu48d comtwonumber_less inpwitspn" id="maxNight" inputmode="numeric" maxlength="4" name="maxNight" type="text" value="" />
                                                                                                        <div class="_14od9oe"><span class="_mtxh7r4" style="right: 10px; visibility: visible;">شب</span><span class="_ic6qqsu"></span></div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div style="margin-top: 32px; margin-bottom: 32px;"><div class="_7qp4lh"></div></div>
                                                                                <div style="margin-bottom: 24px;">
                                                                                    <h3 tabindex="-1" class="hghzvl1" elementtiming="LCP-target"><span class="_kso7xm">تخفیف ها</span></h3>
                                                                                    <div class="_czm8crp">بعد انتخاب نوع تخفیف، آن را به درصد اعمال نمایید.</div>
                                                                                </div>
                                                                                <div style="margin-top: 32px; margin-bottom: 32px;">
                                                                                        <div style="margin-bottom: 8px;"><div class="_1p3joamp">تخفیف را انتخاب کنید و درصد بزنید</div></div>
                                                                                        <div class="_2h22gn">
                                                                                            <div class="_rhq55sv">
                                                                                                <div class="_9hxttoo">
                                                                                                    <label class="_krjbj" for="add_discount_selector">متخفیف را انتخاب کنید و درصد بزنید</label>
                                                                                                    <div class="_wlf6154">
                                                                                                        <div class="_y9ev9r">
                                                                                                            <select id="add_discount_selector" name="add_discount_selector" class="_1w9nn735">
                                                                                                                <option disabled="" value="0" selected="">انتخاب نوع تخفیف</option>
                                                                                                                <option value="1">همه روزه</option>
                                                                                                                <option value="2">هفتگی (1 هفته اقامت)</option>
                                                                                                                <option value="3">ماهانه (4 هفته اقامت)</option>
                                                                                                                <option value="4">سفارشی(تعیین روز)</option>
                                                                                                                <option value="5">لحظه آخری</option>
                                                                                                            </select>
                                                                                                        </div>
                                                                                                        <span class="_1idvclr">
                                                                                                            <svg viewBox="0 0 18 18" role="presentation" aria-hidden="true" focusable="false" style="height: 16px; width: 16px; display: block; fill: rgb(72, 72, 72);">
                                                                                                                <path d="m16.29 4.3a1 1 0 1 1 1.41 1.42l-8 8a1 1 0 0 1 -1.41 0l-8-8a1 1 0 1 1 1.41-1.42l7.29 7.29z" fill-rule="evenodd"></path>
                                                                                                            </svg>
                                                                                                        </span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                <div class="disselct">
                                                                                    
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <span style="font-size: 0px;"></span>
                                                                        <div>
                                                                            <div class="_1fira9s">
                                                                                <div class="_afeoz0">
                                                                                    <div class="_zjunba">
                                                                                        <button type="button" class="l1j9v1wn b1yf7320 c1uxatsa clsbxis closebxp">لغو</button>
                                                                                        <button type="" class="l1j9v1wn bmx2gr4 c11ayis8 savesettprice">ذخیره<input type="hidden" name="idpricsett" id="idpricsett" value="0"></button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                </section>
                                                            </div>
                                                        </div>
                                                    </section>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                                                    <div class="hr_line"></div>
                                                </div>
                                                <div class="bglightblk" style=""></div>
                                                <div id="pricingonly" class="bxfixprc movepricingbx closbxpr">
                                                    <div class="boxchndt" style="display:block !important;margin-top: 1em;float: right;width: 100%;padding-left: 1em;padding-right: 1em;">
                                                        <div style="float: left;position: unset;">
                                                            <div class="PrcHdSvgButcr">
                                                                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-label="Close" role="img" focusable="false" style="display: block; fill: none; height: 16px; width: 16px; stroke: currentcolor; stroke-width: 4; overflow: visible;margin: 0 auto;"><g fill="none"><path d="m20 28-11.29289322-11.2928932c-.39052429-.3905243-.39052429-1.0236893 0-1.4142136l11.29289322-11.2928932"></path></g></svg>
                                                            </div>
                                                        </div>
                                                        <div class="datteminiprbx">یکشنبه، ۱۴ فروردین</div>
                                                    </div>
                                                    <div class="boxchndt pricing" style="display:block;margin-top: -1em;float: right;width: 100%;padding-left: 1em;padding-right: 1em;">
                                                        <h3 class="pricingh3">
                                                            <span id="" class="pricinghsp">
                                                                قیمت گذاری
                                                            </span>
                                                        </h3>
                                                        <div class="_e296pg miniprcbx">
                                                            <div class="c1rg65t0">
                                                                <label class="it3ysxn" for="nightpricemini">
                                                                    <div class="l1bm6uz3">
                                                                        <div class="l12j3uvm"><span>قیمت شبانه</span></div>
                                                                    </div>
                                                                    <div dir="ltr">
                                                                        <div class="i1vtfp57">
                                                                            <div class="i1af8x53 icru09g i1o2p44h"><span>تومان</span></div>
                                                                            <input class="icqyia numeric inputBlur nightpricl" id="nightpricemini" autocomplete="off" inputmode="tel" type="text" value=""/>
                                                                        </div>
                                                                    </div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="boxchndt pricing" style="display:block;margin-top: 0em;float: right;width: 100%;padding-left: 2em;padding-right: 2em;padding-top: 0;">
                                                        <div class="_jro6t0">
                                                            <div class="_52efch">
                                                                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 16px; width: 16px; fill: currentcolor;"><path d="M27 0H5a2 2 0 0 0-2 2v27l.006.114c.087.814 1.099 1.196 1.701.593L8 26.415l3.293 3.292.094.083a1 1 0 0 0 1.32-.083L16 26.415l3.293 3.292.094.083a1 1 0 0 0 1.32-.083L24 26.415l3.293 3.292c.63.63 1.707.184 1.707-.707V2a2 2 0 0 0-2-2zm-5 17.25H10v-2.5h12zm0-6H10v-2.5h12z"></path></svg>
                                                            </div>
                                                            <div><span style="color: rgb(34, 34, 34);font-size: 16px;font-weight: 400;line-height: 20px;text-align: right;float: right;font-size: 13px;">پس از کسر کمسیون شما شبی <span class="pricviw" data-com="'.$row->commission.'">۰</span> تومان به ازای <span class="txnitcng">هر شب</span> کسب خواهید کرد.</span></div>
                                                        </div>
                                                    </div>
                                                    <div class="boxchndt pricing pricaddebx" style="display:'.(isset($row_pricebase)&&isset($row)?($row->price_every==1&&$row->accommodates_added>0?'block':'none'):'').';margin-top: -1em;float: right;width: 100%;padding-left: 1em;padding-right: 1em;">
                                                        <div class="_e296pg miniprcbx">
                                                            <div class="c1rg65t0">
                                                                <label class="it3ysxn" for="nightpriceadded">
                                                                    <div class="l1bm6uz3">
                                                                        <div class="l12j3uvm"><span>قیمت نفر اضافه</span></div>
                                                                    </div>
                                                                    <div dir="ltr">
                                                                        <div class="i1vtfp57">
                                                                            <div class="i1af8x53 icru09g i1o2p44h"><span>تومان</span></div>
                                                                            <input class="'.(isset($row_pricebase)&&isset($row)?($row->price_every==1&&$row->accommodates_added>0?'requiredval ':''):'').'icqyia numeric inputBlur nightpricladd" id="nightpriceadded" autocomplete="off" inputmode="tel" type="text" value="'.(isset($row_pricebase)&&isset($row)?($row->accommodates_added>0?$this->siran->numberformat($row_pricebase->nightly_price_added):''):'').'"/>
                                                                        </div>
                                                                    </div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="boxchndt pricing" style="display:block;margin-top: 1em;float: right;width: 100%;padding-left: 1em;padding-right: 1em;">
                                                        <div class="_1bvzomv" style="padding-bottom: 2em;"><div data-plugin-in-point-id="HOST_CALENDAR_EDITPANEL_PRICING_BUTTON_GROUP" data-section-id="HOST_CALENDAR_EDITPANEL_PRICING_BUTTON_GROUP" style="display: contents;"><div class="_kr7m4r"><footer class="f1b2no8f"><div class="_izsbeq"><button type="button" class="l1j9v1wn b19stgqq c3qys7w closebxp">لغو</button><button type="button" class="l1j9v1wn bmx2gr4 c1ih3c6 datetyptwosave">ذخیره</button></div></footer></div></div></div>
                                                    </div>
                                                </div>
                                                <div id="chngedaemin" class="bxfixprc movepricingbx">
                                                <div class="boxchndt" style="display: flex;margin-top: -1em;float: right;width: 100%;padding-left: 1em;padding-right: 1em;align-content: flex-start;flex-direction: row;x-wrap: wrap;">
                                                        <div style="position: absolute;margin: 0 auto;display: block;margin-top: 1em;">
                                                            <div class="PrcHdSvgButcr clsminidt">
                                                                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-label="Close" role="img" focusable="false" style="display: block; fill: none; height: 16px; width: 16px; stroke: currentcolor; stroke-width: 4; overflow: visible;margin: 0 auto;"><g fill="none"><path d="m20 28-11.29289322-11.2928932c-.39052429-.3905243-.39052429-1.0236893 0-1.4142136l11.29289322-11.2928932"></path></g></svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="boxchndt pricing" style="display:block;margin-top: 0em;float: right;width: 100%;padding-left: 1em;padding-right: 1em;padding-bottom: 0;">
                                                        <h3 class="pricingh3" style=" float: right; width: 68%; ">
                                                            <span id="" class="pricinghsp">
                                                                <span class="nitnum">۱</span> شب
                                                            </span>
                                                            <span id="" class="pricinghsp">
                                                                <div class=_1inj1wq style=font-size:13px!important;line-height:18px!important;color:#717171!important;font-weight:400!important;margin-top:8px!important;min-height:18px!important>
                                                                    <span class="desdatemin1">اردیبهشت 28, 1402</span> <span class="dasbtdd" style="display:none">-</span> <span class="desdatemin2" style="display:none">اردیبهشت 28, 1402</span>
                                                                </div>
                                                            </span>
                                                        </h3>
                                                        <div class="dateminiclean cebj5md" style=margin:0;padding:0;font-size:14px!important;text-decoration:underline;font-weight:400!important;float:left;width:29%;text-align:left!important;cursor:pointer>
                                                            خالی کردن تاریخ
                                                        </div>
                            
                                                    </div>
                                                    <div class="boxchndt pricing" style="display:block;float: right;width: 100%;margin: 0;padding: 0;border-bottom: 1px solid rgb(221, 221, 221) !important;">
                                                        <div class="daysnmmini"><div>ش</div><div>ی</div><div>د</div><div>س</div><div>چ</div><div>پ</div><div class=text-danger>ج</div></div>
                                                        <div class="minidate" style="overflow: scroll !important;height: 60% !important;position: absolute !important;width: 347px;margin: 0px auto !important;display: block;left: 0;right:0;margin-top: 10px !important;"></div>
                                                    </div>
                                                    <div class="boxchndt pricing" style="display:block;margin-top: 1em;float: right;width: 100%;padding-left: 1em;padding-right: 1em;">
                                                        <div class="_1bvzomv"><div data-plugin-in-point-id="HOST_CALENDAR_EDITPANEL_PRICING_BUTTON_GROUP" data-section-id="HOST_CALENDAR_EDITPANEL_PRICING_BUTTON_GROUP" style="display: contents;"><div class="_kr7m4r"><footer class="f1b2no8f" style=" -webkit-box-pack: justify !important; position: fixed !important; bottom: 0px !important; left: 0px !important; right: 0px !important; padding: 15px 24px 60px !important; background: rgb(255, 255, 255) !important; border-top: 1px solid rgb(235, 235, 235) !important; border-right-color: rgb(235, 235, 235) !important; border-bottom-color: rgb(235, 235, 235) !important; border-left-color: rgb(235, 235, 235) !important; display: flex !important; justify-content: space-between !important; z-index: 1 !important; "><div class="_izsbeq"><button type="button" class="l1j9v1wn b19stgqq c3qys7w closebxp">لغو</button><button type="button" class="l1j9v1wn bmx2gr4 c1ih3c6 datenewsave" data-dtid="daten'.$idx.'">ذخیره</button></div></footer></div></div></div>
                                                    </div>
                                                </div>
                                                <!-- <div class="hr_line"></div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                
							</div>
							
								<div class="col-sm-2 butmrgpad">
									<button type="button" class="btn btn-labeled btn-primary shtiks '.($row->delete_req == '1'?'disabled':'').'" style="padding: 0;width: -webkit-fill-available;height: -webkit-fill-available;border-radius: 0;border: 0px;" id="' . $this->siran->number2farsi($row->id) . '"><span class="" style="cursor: pointer;" ><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="text-shadow: 2px 2px 0 #2c2c2c, 1px -1px 0 #2c2c2c, -1px 1px 0 #2c2c2c, -1px -1px 0 #2c2c2c, 1px 0px 0 #2c2c2c, 0px 1px 0 #2c2c2c, -1px 0px 0 #2c2c2c, 0px -1px 0 #2c2c2c;"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg><span style="color: #000;font-size: 11px;">ویرایش</span><form action="' . base_url() . 'users/estate_edit" method="post" class="fgotick" style="display: none;"><input type="hidden" name="id" value="' . $this->encrypt->encode($row->id) . '" class="' . $row->id . '" id="tickd"></form></span></button>
								</div>
								<div class="col-sm-2 butmrgpad">
									<button type="button" class="btn btn-labeled btn-warning comhous subform ' . ($row->final_record == '0' || $row->manuel_act == '1' || $row->delete_req == '1' ? 'disabled' : '') . '" style="padding: 0;width: -webkit-fill-available;height: -webkit-fill-available;border-radius: 0;border: 0px;" id="ExLnk"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z" style="text-shadow: 2px 2px 0 #003789, 1px -1px 0 #003789, -1px 1px 0 #003789, -1px -1px 0 #003789, 1px 0px 0 #003789, 0px 1px 0 #003789, -1px 0px 0 #003789, 0px -1px 0 #003789;"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path></svg><span class="" style="color: #000;font-size: 11px;">دیدگاه'.($NumCom>0?'</span>'.($NumComNew>0?'<span class="icon-button__badge">'.$this->siran->number2farsi($NumComNew).'</span>':''):'').'<form action="' . base_url() . 'users/comments_show" method="post" class="formsub"><input type="hidden" name="comdi" value="' . $this->encrypt->encode($row->id) . '"><input type="hidden" name="title_summary" value="' . $this->encrypt->encode($row->title_summary) . '"></form></button>
								</div>
								<div class="col-sm-2 butmrgpad ManuelAct">
									<button type="button" class="btn btn-labeled btn-info' . ($row->final_record == '0' || $row->delete_req == '1' ? ' disabled' : '').($row->manuel_act == '1' ? ' activehus' : ' unactivehus'). '" style="padding: 0;width: -webkit-fill-available;height: -webkit-fill-available;border-radius: 0;border: 0px;" id="actorunact" id="actorunact">' . ($row->manuel_act == '1' ? '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16" style="text-shadow: 2px 2px 0 #003789, 1px -1px 0 #003789, -1px 1px 0 #003789, -1px -1px 0 #003789, 1px 0px 0 #003789, 0px 1px 0 #003789, -1px 0px 0 #003789, 0px -1px 0 #003789;"><path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/><path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/></svg>' : '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16" style="text-shadow: 2px 2px 0 #003789, 1px -1px 0 #003789, -1px 1px 0 #003789, -1px -1px 0 #003789, 1px 0px 0 #003789, 0px 1px 0 #003789, -1px 0px 0 #003789, 0px -1px 0 #003789;"><path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/><path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/><path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/></svg>') . '<span id="' . $this->siran->number2farsi($row->id) . '" style="color: #000;font-size: 11px;">' . ($row->manuel_act == '1' ? 'نمایش' : 'عدم نمایش') . '</span></button>
								</div>
								<div class="col-sm-2 butmrgpad removerusub">
									<button type="button" class="btn btn-labeled btn-danger DeletRowShow" id="'.($row->final_record == '3' ? '0' : ($row->manuel_act == '1' ? '2' : ($row->final_record == '1' ? '1' : '' ))).'" style="padding: 0;width: -webkit-fill-available;height: -webkit-fill-available;border-radius: 0;border: 0px;" data-toggle="modal" data-target="'.($row->delete_req == '1'?'#DeletRowLaghv':'#DeletRowSub').'"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="text-shadow: 2px 2px 0 #78000c, 1px -1px 0 #78000c, -1px 1px 0 #78000c, -1px -1px 0 #78000c, 1px 0px 0 #78000c, 0px 1px 0 #78000c, -1px 0px 0 #78000c, 0px -1px 0 #78000c;"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg><span style="color: #000;font-size: 11px;">'.($row->delete_req == '1'?'لغو حذف':'حذف').'</span></button>
								</div>
							</div>
                        </div>

                    </div>';
                }
                ?>
