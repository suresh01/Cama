<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Paparan Pertukaran Alamat Harta</title>
<style type="text/css">

#proptble td.numericCol {
	text-align: right;
}

.multiselect {
  width: 200px;
}

.selectBox {
  position: relative;
}

.selectBox select {
  width: 100%;
  font-weight: bold;
}

.overSelect {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

#checkboxes {
  display: none;
  border: 1px #dadada solid;
}

#checkboxes label {
  display: block;
}

#checkboxes label:hover {
  background-color: #1e90ff;
}

</style>

<link href="multiselect/multiselect.css" rel="stylesheet"/>
<script src="multiselect/multiselect.min.js"></script>
@include('includes.header-popup', ['page' => 'datamaintenance'])
	
    <div id="content">
		<div class="grid_container">
			<div class="grid_12">

				<div class="widget_wrap">
                    <div class="widget_content">
						<div class=" page_content">
							<div class="invoice_container">	
								{{-- @foreach ($master as $rec)
								<fieldset>
									<div class="grid_4">		


										<div style="line-height: 2;">	
											<strong><span>{{__('valuation.Zone')}} : </span></strong>
											<span>{{$rec->zone}}</span>	
										</div>
										<div style="line-height: 2;">		
											<strong><span>{{__('valuation.Sub_Zone')}} : </span></strong>
											<span>{{$rec->subzone}}</span>
										</div>
									</div>
									<div class="grid_4">		

										<div style="line-height: 2;">
											<strong><span>{{__('valuation.Property_Category')}} : </span></strong>
											<span>{{$rec->propcategorty}}</span>
										</div>
										<div style="line-height: 2;">
											<strong><span>{{__('valuation.Property_Type')}} : </span></strong>
											<span>{{$rec->proptype}}</span>
										</div>
										<div style="line-height: 2;">
											<strong><span>{{__('valuation.Property_Status')}} : </span></strong>
											<span>{{$rec->bldgstatus}}</span>
										</div>
										<div style="line-height: 2;">
											<strong><span>{{__('valuation.Property_Storey')}} : </span></strong>
											<span>{{$rec->bldgstorey}}</span>
										</div>
									</div>
								</fieldset>
								@endforeach --}}

								<fieldset>
                                    @if($module == 'propertyaddress')
									    <legend>Pertukaran Alamat Harta</legend>
                                    @endif
									<form action="" id="pindahmilik" class="form_container left_label">
									<div style="float: right;" class="grid_6 form_container left_label">
                                        <ul>
                                            <li>
                                                <div class="form_grid_4">
                                                    <label class="field_title" style="width: 100%;" id="lidcama" for="position">No Akaun</label>
                                                </div>
                                                <div class="form_grid_8">
                                                    {{-- <div  class="form_input"> --}}
                                                        <input id="iidcama" class="left-text" style="width: 100%;"  name="iidcama" type="text" readonly="true"/>
                                                    {{-- </div> --}}
                                                    <span class=" label_intro"></span>
                                                </div>	
                                                {{-- <div class="form_grid_3">
													<label class="field_title" style="width: 100%;" id="lnamacama" for="position">Nama Pemilik Cama</label>
												</div>
												<div class="form_grid_9">
													<div  class="form_input">
														<input id="inamecama" class="left-text" style="width: 100%;"  name="inamecama" type="text" readonly="true"/>
													</div>
													<span class=" label_intro"></span>
												</div>
											    <div class="form_grid_3">
													<label class="field_title" style="width: 100%;" id="lidpemilikcama" for="position">id Pemilik Cama</label>
												</div>
												<div class="form_grid_9">
													<div  class="form_input">
														<input id="iidpemilikcama" class="left-text" style="width: 100%;"  name="iidpemilikcama" type="text" readonly="true"/>
													</div>
													<span class=" label_intro"></span>
												</div> --}}
												<div class="form_grid_4">
													<label class="field_title" style="width: 100%;" id="lnorumahcama" for="position">No Rumah Cama</label>
												</div>
												<div class="form_grid_8">
													{{-- <div  class="form_input"> --}}
														<input id="inorumahcama" class="left-text" style="width: 100%;" name="inorumahcama" type="text"  readonly="true"  />
													{{-- </div> --}}
													<span class=" label_intro"></span>
												</div>
										 		
												<div class="form_grid_4">
													<label class="field_title" style="width: 100%;" id="lnamajalancama" for="position">Jalan Cama</label>
												</div>
												<div class="form_grid_8">
													{{-- <div  class="form_input"> --}}
														<input id="inamajalancama" class="left-text" style="width: 100%;" name="inamajalancama" type="text"  readonly="true"  />
													{{-- </div> --}}
													<span class=" label_intro"></span>
												</div>
											
												<div class="form_grid_4">
													<label class="field_title" style="width: 100%;" id="lnamatempatcama" for="position">Tempat Cama</label>
												</div>
												<div class="form_grid_8">
													{{-- <div  class="form_input"> --}}
														<input id="inamatempatcama" class="left-text" style="width: 100%;" name="inamatempatcama" type="text"  readonly="true"  />
													{{-- </div> --}}
													<span class=" label_intro"></span>
												</div>

												<div class="form_grid_4">
													<label class="field_title" style="width: 100%;" id="lnamakawasancama" for="position">Kawasan Cama</label>
												</div>
												<div class="form_grid_8">
													{{-- <div  class="form_input"> --}}
														<input id="inamakawasancama" class="left-text" style="width: 100%;" name="inamakawasancama" type="text"  readonly="true"  />
													{{-- </div> --}}
													<span class=" label_intro"></span>
												</div>
												
                                                <div class="form_grid_4">
													<label class="field_title" style="width: 100%;" id="lnamabandarcama" for="position">Bandar Cama</label>
												</div>
												<div class="form_grid_8">
													{{-- <div  class="form_input"> --}}
														<input id="inamabandarcama" class="left-text" style="width: 100%;" name="inamabandarcama" type="text"  readonly="true"  />
													{{-- </div> --}}
													<span class=" label_intro"></span>
												</div>

                                                <div class="form_grid_4">
													<label class="field_title" style="width: 100%;" id="lnamanegericama" for="position">Negeri Cama</label>
												</div>
												<div class="form_grid_8">
													{{-- <div  class="form_input"> --}}
														<input id="inamanegericama" class="left-text" style="width: 100%;" name="inamanegericama" type="text"  readonly="true"  />
													{{-- </div> --}}
													<span class=" label_intro"></span>
												</div>


												
                                            </li>
                                        </ul>
									</div>
									<div class="grid_6 form_container left_label">
										<ul>
											<li>	
                                                    <div class="form_grid_4">
                                                        <label class="field_title" style="width: 100%;" id="lidmphtj" for="position">No AUID</label>
                                                    </div>
                                                    <div class="form_grid_8">
                                                        {{-- <div  class="form_input"> --}}
                                                            <input id="iidmphtj" class="left-text" style="width: 100%;"  name="iidmphtj" type="text" readonly="true"/>
                                                        {{-- </div> --}}
                                                        <span class=" label_intro"></span>
                                                    </div>		

                                                    {{-- <div class="form_grid_4">
                                                        <label class="field_title" style="width: 100%;" id="lnamamphtj" for="position">Nama Pemilik MPHTJNET</label>
                                                    </div>
                                                    <div class="form_grid_8">
                                                        <div  class="form_input">
                                                            <input id="inamemphtj" class="left-text" style="width: 100%;"  name="inamemphtj" type="text" readonly="true"/>
                                                        </div>
                                                        <span class=" label_intro"></span>
                                                    </div>
                                                    <div class="form_grid_4">
                                                        <label class="field_title" style="width: 100%;" id="lidpemilikmphtj" for="position">id Pemilik MPHTJNET</label>
                                                    </div>
                                                    <div class="form_grid_8">
                                                        <div  class="form_input">
                                                            <input id="iidpemilikmphtj" class="left-text" style="width: 100%;"  name="iidpemilikmphtj" type="text" readonly="true"/>
                                                        </div>
                                                        <span class=" label_intro"></span>
                                                    </div> --}}
                                                    <div class="form_grid_4">
                                                        <label class="field_title" style="width: 100%;" id="lnorumahmphtj" for="position">No Rumah MPHTJNET</label>
                                                    </div>
                                                    <div class="form_grid_8">
                                                        {{-- <div  class="form_input"> --}}
                                                            <input id="inorumahmphtj" class="left-text" style="width: 100%;" name="inorumahmphtj" type="text"  readonly="true"  />
                                                        {{-- </div> --}}
                                                        <span class=" label_intro"></span>
                                                    </div>
                                                    
                                                    <div class="form_grid_4">
                                                        <label class="field_title" style="width: 100%;" id="lnamajalanmphtj" for="position">Jalan MPHTJNET</label>
                                                    </div>
                                                    <div class="form_grid_8">
                                                        {{-- <div  class="form_input"> --}}
                                                            <input id="inamajalanmphtj" class="left-text" style="width: 100%;" name="inamajalanmphtj" type="text"  readonly="true"  />
                                                        {{-- </div> --}}
                                                        <span class=" label_intro"></span>
                                                    </div>
                                                
                                                    <div class="form_grid_4">
                                                        <label class="field_title" style="width: 100%;" id="lnamatempatmphtj" for="position">Tempat MPHTJNET</label>
                                                    </div>
                                                    <div class="form_grid_8">
                                                        {{-- <div  class="form_input"> --}}
                                                            <input id="inamatempatmphtj" class="left-text" style="width: 100%;" name="inamatempatmphtj" type="text"  readonly="true"  />
                                                        {{-- </div> --}}
                                                        <span class=" label_intro"></span>
                                                    </div>

                                                    <div class="form_grid_4">
                                                        <label class="field_title" style="width: 100%;" id="lnamakawasanmphtj" for="position">Kawasan MPHTJNET</label>
                                                    </div>
                                                    <div class="form_grid_8">
                                                        {{-- <div  class="form_input"> --}}
                                                            <input id="inamakawasanmphtj" class="left-text" style="width: 100%;" name="inamakawasanmphtj" type="text"  readonly="true"  />
                                                        {{-- </div> --}}
                                                        <span class=" label_intro"></span>
                                                    </div>
                                                    
                                                    <div class="form_grid_4">
                                                        <label class="field_title" style="width: 100%;" id="lnamabandarmphtj" for="position">Bandar MPHTJNET</label>
                                                    </div>
                                                    <div class="form_grid_8">
                                                        {{-- <div  class="form_input"> --}}
                                                            <input id="inamabandarmphtj" class="left-text" style="width: 100%;" name="inamabandarmphtj" type="text"  readonly="true"  />
                                                        {{-- </div> --}}
                                                        <span class=" label_intro"></span>
                                                    </div>

                                                    <div class="form_grid_4">
                                                        <label class="field_title" style="width: 100%;" id="lnamanegerimphtj" for="position">Negeri MPHTJNET</label>
                                                    </div>
                                                    <div class="form_grid_8">
                                                        {{-- <div  class="form_input"> --}}
                                                            <input id="inamanegerimphtj" class="left-text" style="width: 100%;" name="inamanegerimphtj" type="text"  readonly="true"  />
                                                        {{-- </div> --}}
                                                        <span class=" label_intro"></span>
                                                    </div>
                                            </li>
                                        </ul>
									</div>
                                    <span class="clear"></span>
									<div style="height: 48px; float: right; " class="grid_12">                
					                  <div class="form_input">

					                    <button id="addClose" name="addClose" style="float: right; "  onclick="closeWindow()" type="button" class="btn_small btn_blue"><span>Tutup</span></button>    
                                        @if($currstatus == '5')
                                            <button id="addsubmit" name="adduser" style="float: right; " onclick="transferData('{{$paramid}}','{{$module}}')" type="button" class="btn_small btn_blue"><span>Transfer</span></button>
                                        @endif
                                        
                                            
					                  </div>
					                  
					                  <span class="clear"></span>
					                </div>
					            </form>
								</fieldset>
								
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>

    <script>

        @foreach ($mphtj as $rec)
            // alert('masuk');
            $('#iidmphtj').val('{{$rec->noaccmphtj}}');
            $('#inorumahmphtj').val('{{$rec->no_rumah}}');
            $('#inamajalanmphtj').val('{{$rec->jalan}}');
            $('#inamatempatmphtj').val('{{$rec->tempat}}');
            $('#inamakawasanmphtj').val('{{$rec->kawasan}}');
            $('#inamabandarmphtj').val('{{$rec->bandar}}');
            $('#inamanegerimphtj').val('{{$rec->negeri}}');
        @endforeach

        @foreach ($masterlist as $rec)
            // alert('masuk');
            $('#iidcama').val('{{$rec->mal_accno}}');
            $('#inorumahcama').val('{{$rec->mal_addr_ln1}}');
            $('#inamajalancama').val('{{$rec->mal_addr_ln2}}');
            $('#inamatempatcama').val('{{$rec->mal_addr_ln3}}');
            $('#inamakawasancama').val('{{$rec->mal_addr_ln4}}');
            $('#inamabandarcama').val('{{$rec->mal_postcode}}'+ ' ' + '{{$rec->mal_city}}');
            $('#inamanegericama').val('{{$rec->state}}');

        @endforeach


        function closeWindow(){
            //alert({{$currstatus}});
             window.close();
        }
         
        function transferData(paramid, modul){
            var curstat = {{$currstatus}};
            if( curstat== 5){
                //alert(paramid + ", " + modul);

				var noty_id = noty({
					layout : 'center',
					text: 'Are you sure want to Transfer?',
					modal : true,
					buttons: [
						{type: 'button pink', text: 'Submit', click: function($noty) {
							$noty.close();
							$.ajax({
				  				type: 'GET', 
							    url:'datatransfer',
							    headers: {
								    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
								},
						        data:{param_value:paramid,module:modul,param:curstat,type:'2'},
						        success:function(data){

									window.location.assign("papardatatransfer?paramid="+paramid+"&module="+modul);									
					        	},
						        error:function(data){
									//$('#loader').css('display','none');	
						        	alert('Berlaku Gangguan Semasa Pemindahan Data, Sila Cuba Sekali Lagi. Jika masih berlaku, Hubungi Administrator');
					        	}
					    	});
						  }
						},
						{type: 'button blue', text: 'Cancel', click: function($noty) {
							$noty.close();
						  }
						}
						],
					 type : 'success', 
				 });
			}
        }

    </script>
</div>
</body>
</html>