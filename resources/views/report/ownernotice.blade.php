<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Owner Type Notice</title>

@include('includes.header', ['page' => 'report'])
					
	<div id="content">
		<div class="grid_container">
			<div class="grid_12">	
					<br>
				<div class="breadCrumbHolder module">	
				<div id="breadCrumb3" style="/*float:right;*/" class="breadCrumb module grid_3">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Laporan</a></li>
						<li>Notis Pemilik</li>
					</ul>
				</div>
				</div>
				
				<div style="float:right;margin-right: 10px;"  class="btn_24_blue">	
					<a href="#" onclick="reporta('a')" >Penyata Pemilik</a>	
					<a href="#" onclick="reporta('b')" >Notis Pindahmilik RM30</a>
					<a href="#" onclick="reporta('c')" >Notis Pindahmilik Percuma</a>	
					<a href="#" onclick="reporta('d')" >Notis Pindahmilik RM50</a>		
					@include('report.search.search',['tableid'=>'proptble', 'action' => 'ownernoticedata', 'searchid' => '14'])			
					
				</div>
				<br>
				<div id="addDetailA" style="display:none" class="grid_12">
					<div class="widget_wrap">
						
						<div class="widget_content">
							<h3 id="title">Jana Report</h3>
							<form style="" id="generateforma" method="post" action="generateowntypa" target="_blank">
					            @csrf
								<input type="hidden" name="type" id="type">
					            <input type="hidden" name="accounts" id="accountsa">
								<div  class="grid_12 form_container left_label">
									<ul>
										<li>											
											<fieldset>
												<legend>Maklumat Tambahan</legend>
													<div class="form_grid_12">
														<label class="field_title" id="lposition" for="position">Nama Pegawai<span class="req">*</span></label>
														<div  class="form_input">
															<select onchange="getposition()" data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="usernameA" tabindex="7" name="name" tabindex="20">
																	<option></option>
																@foreach ($userlist as $rec)
																		<option value='{{ $rec->usr_id }}'>{{ $rec->usr_name }}</option>
																@endforeach	
															</select>
														</div>
														<span class=" label_intro"></span>
														<input type="hidden" id="username" name="username">
													</div>
												
													<div class="form_grid_12">
														<label class="field_title" id="llevel" for="level">Jawatan<span class="req">*</span></label>
														<div  class="form_input">
															<input id="jawatan" name="title"  type="text"  maxlength="50" class="required"/>
														</div>
														<span class=" label_intro"></span>
													</div>
											
												<div class="form_grid_12">
													<label class="field_title" id="llevel" for="level">Tarikh Cetak<span class="req">*</span></label>
													<div id="prntdateahtm" class="form_input">
														<input id="prntdatea" name="prntdate" autocomplete="off" type="text"  maxlength="50" class="required "/>
													</div>
													<span class=" label_intro"></span>
												</div>
												<div class="form_grid_12">
													<label class="field_title" id="llevel" for="level">Tarikh Hijri<span class="req">*</span></label>
													<div id="prntdateahtm" class="form_input">
														<input id="tarikhhijri" name="tarikhhijri" autocomplete="off" type="text"  maxlength="50" class="required "/>
													</div>
													<span class=" label_intro"></span>
												</div>
											
											</fieldset>

					
										</li>
									</ul>
								</div>
								
								<div class="grid_12">							
									<div class="form_input">
										<button id="addsubmit" name="adduser" class="btn_small btn_blue"><span>Jana</span></button>									
										
										<button id="close" name="close" type="button" class="btn_small btn_blue simplemodal-close"><span>Tutup</span></button>
										<span class=" label_intro"></span>
									</div>								
									<span class="clear"></span>
								</div>
							</form>
						</div>
					</div>
				</div>

				{{-- <div id="addDetail" style="display:none" class="grid_12">
					<div class="widget_wrap">
						
						<div class="widget_content">
							<h3 id="title">Generate Report</h3>
							<form style="" id="generateform" method="GET" action="generateowntypb">
					            @csrf
					            <input type="hidden" name="accounts" id="accounts">
								<div  class="grid_12 form_container left_label">
									<ul>
										<li>											
											<fieldset>
												<legend>Additional Information</legend>
												
												<div class="form_grid_12">
													<label class="field_title" id="llevel" for="level">PRINT DATE<span class="req">*</span></label>
													<div id="prntdatehtm" class="form_input">
														<input id="prntdate" name="prntdate" autocomplete="off" type="text"  maxlength="50" class="required "/>
													</div>
													<span class=" label_intro"></span>
												</div>

											
											</fieldset>

					
										</li>
									</ul>
								</div>
								
								<div class="grid_12">							
									<div class="form_input">
										<button id="addsubmit" name="adduser" class="btn_small btn_blue"><span>Submit</span></button>									
										
										<button id="close" name="close" type="button" class="btn_small btn_blue simplemodal-close"><span>Close</span></button>
										<span class=" label_intro"></span>
									</div>								
									<span class="clear"></span>
								</div>
							</form>
						</div>
					</div>
				</div> --}}
        
				<div class="widget_wrap">					
					<div class="widget_content">						
						<table id="proptble" class="display select">
							<thead style="text-align: left;">
								<tr>
									<th><input name="select_all" value="1" type="checkbox"></th>
									<th class="table_sno">
										S No
									</th>
									<th>
										No Harta
									</th>
									<th>
										No Fail
									</th>
									<th>
										Mukim / Taman/ Kawasan
									</th>
									<th>
										Nama Pemilik
									</th>	
									<th>
										Id Pemilik
									</th>	
									<th>
										No Lot / No Lot Alternatif
									</th>		
								</tr>
							</thead>
							<tbody>			
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
		<form style="display: hidden;" id="generateform" method="GET" action="generater4cover">
            @csrf
            <input type="hidden" name="accounts" id="accounts">
		</form>
		
		
	</div>
	<span class="clear"></span>
	
	<script>
		
		function changeField(val){
			if(val == 'table'){
				$('#maxrow').removeAttr('style');
			} else {
				$('#maxrow').attr('style', "display:none;");
			}
		}


		function deleteProperty(){
			var table = $('#proptble').DataTable();
			//var termdate = '';
//console.log(table.rows('.selected').data());termdate
			var account = $.map(table.rows('.selected').data(), function (item) {
				//console.log(item);
	        	//termdate= item['vd_id'];
	        	return item['vd_id']
	   		});
	   		
	   		
			if(account.length > 0) {
			console.log(account.toString());
			var noty_id = noty({
				layout : 'center',
				text: 'Are want to Generate Report?',
				modal : true,
				buttons: [
					{type: 'button pink', text: 'Generate', click: function($noty) {
						$noty.close();
						$('#accounts').val(account.toString());
					
						$('#generateform').submit();
					/*	$.ajax({
					        type:'GET',
					        url:'generateinspectionreport',
					        data:{accounts:account.toString(),type:type,id:'id'},
					        success:function(data){
					        	
								//location.reload();				        		
					        	//$("#finish").attr("disabled", true);
					        	//clearTableError(4);
				        	},
					        error:function(data){
								//$('#loader').css('display','none');	
					        	   	
					        		var noty_id = noty({
									layout : 'top',
									text: 'Report Not generated!',
									modal : true,
									type : 'error', 
								});
				        	}
						});*/
					  }
					},
					{type: 'button blue', text: 'Cancel', click: function($noty) {
						$noty.close();
					  }
					}
					],
				 type : 'success', 
			 });
			} else {
				alert('Please atleast one property to generate report');
			}
		}
	

		


		function updateDataTableSelectAllCtrl(table){
		   var $table             = table.table().node();
		   var $chkbox_all        = $('tbody input[type="checkbox"]', $table);
		   var $chkbox_checked    = $('tbody input[type="checkbox"]:checked', $table);
		   var chkbox_select_all  = $('thead input[name="select_all"]', $table).get(0);

			   // If none of the checkboxes are checked
		   if($chkbox_checked.length === 0){
		      chkbox_select_all.checked = false;
		      if('indeterminate' in chkbox_select_all){
		         chkbox_select_all.indeterminate = false;
		      }

		   // If all of the checkboxes are checked
		   } else if ($chkbox_checked.length === $chkbox_all.length){
		      chkbox_select_all.checked = true;
		      if('indeterminate' in chkbox_select_all){
		         chkbox_select_all.indeterminate = false;
		      }

		   // If some of the checkboxes are checked
		   } else {
		      chkbox_select_all.checked = true;
		      if('indeterminate' in chkbox_select_all){
		         chkbox_select_all.indeterminate = true;
		      }
		   }
		}

$(document).ready(function (){
	var table = $('#proptble').DataTable({
		        "processing": false,
		        "serverSide": false,
		        "retrieve": true,
		        /*"dom": '<"toolbar">frtip',*/
				 
		        // ajax: '{{ url("inspectionproperty") }}',
		        /*"ajax": '/bookings/datatables',*/
		        "columns": [
			        {"data": "vd_id", "orderable": false, "searchable": false, "name":"_id" },
			        {"data": null, "name": "sno"},
			        {"data": "vd_accno", "name": "account number"},
			        {"data": "ma_fileno", "name": "fileno"},
			        {"data": "subzone", "name": "subzone"},
			        {"data": "to_ownname", "name": "owner"},
			        {"data": "to_ownno", "name": "owner"},
			        {"data": "lot_detail", "name": "zone"}
		   		],
		   		"fnRowCallback": function (nRow, aData, iDisplayIndex) {
		   			var oSettings = this.fnSettings();
  	
			        $("td:nth-child(2)", nRow).html(oSettings._iDisplayStart+iDisplayIndex +1);
			        return nRow;
			    },
			    "sPaginationType": "full_numbers",
			"iDisplayLength": 100,
			"oLanguage": {
		        "sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Entries per page:</span>",	
		    },
		    'columnDefs': [{
         'targets': 0,
         'searchable': true,
         'orderable': false,
         'width': '1%',
         'className': 'dt-body-center',
         'render': function (data, type, full, meta){
             return '<input type="checkbox">';
         }
      }],
      'rowCallback': function(row, data, dataIndex){
         // Get row ID
         var rowId = data[0];

         // If row ID is in the list of selected row IDs
         if($.inArray(rowId, rows_selected) !== -1){
            $(row).find('input[type="checkbox"]').prop('checked', true);
            $(row).addClass('selected');
         }
      },
        	"bAutoWidth": false,
			"sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>'
			});
   // Array holding selected row IDs
   var rows_selected = [];
   
    
   

   // Handle click on checkbox
   $('#proptble tbody').on('click', 'input[type="checkbox"]', function(e){
      var $row = $(this).closest('tr');

      // Get row data
      var data = $('#proptble').DataTable().row($row).data();

      // Get row ID
      var rowId = data[0];

      // Determine whether row ID is in the list of selected row IDs
      var index = $.inArray(rowId, rows_selected);

      // If checkbox is checked and row ID is not in list of selected row IDs
      if(this.checked && index === -1){
         rows_selected.push(rowId);

      // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
      } else if (!this.checked && index !== -1){
         rows_selected.splice(index, 1);
      }

      if(this.checked){
         $row.addClass('selected');
      } else {
         $row.removeClass('selected');
      }

      // Update state of "Select all" control
      updateDataTableSelectAllCtrl($('#proptble').DataTable());

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

 

   // Handle click on "Select all" control
   $('thead input[name="select_all"]', $('#proptble').DataTable().table().container()).on('click', function(e){
      if(this.checked){
        $('#proptble tbody input[type="checkbox"]').prop('checked', true);
         $('#proptble tbody tr').addClass('selected');
         $('#info').html(selectedrow() + " Row Selected");
      } else {
         $('#proptble tbody input[type="checkbox"]').prop('checked', false);
         $('#proptble tbody tr').removeClass('selected');
         $('#info').html(selectedrow() + " Row Selected");
      }

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

   // Handle table draw event
   $('#proptble').DataTable().on('draw', function(){
      // Update state of "Select all" control
      updateDataTableSelectAllCtrl($('#proptble').DataTable());
   });
   // Handle form submission event

});	

function getposition(){
	var userid = $('#usernameA').val();
	if(userid.length != 0){
		$('#username').val($("#usernameA option:selected").text());
		$.ajax({
			type:'GET',
			url:'getuserdetail',
			data:{id:userid},
			success:function(data){	        	
				$('#jawatan').val(data.userposition);
			}
		});
	}
}
function reporta(reporttype){
	var table = $('#proptble').DataTable();
		$('#prntdateahtm').html('<input id="prntdatea" name="prntdate" autocomplete="off" type="text"  maxlength="50" class="required datepicker"/>');
					 	$( "#prntdatea" ).datepicker({dateFormat: 'dd/mm/yy'});
					 	
		var account = $.map(table.rows('.selected').data(), function (item) {
			//console.log(item);
        	return item['vd_id']
   		});
		var type = "delete";
		
		if(account.length > 0) {
			if(reporttype == 'a'){
				$('#type').val('type1');
			}else if(reporttype == 'b'){
				$('#type').val('type2');
			}else if(reporttype == 'c'){
				$('#type').val('type3');
			}else if(reporttype == 'd'){
				$('#type').val('type4');
			}
			
			$('#accountsa').val(account.toString());
			$('#addDetailA').modal();
			// console.log(account.toString());
		} else {
			alert('Please atleast one property to generate report');
		}
}

function reportB(){
	var table = $('#proptble').DataTable();
		$('#prntdateahtm').html('<input id="prntdatea" name="prntdate" autocomplete="off" type="text"  maxlength="50" class="required datepicker"/>');
					 	$( "#prntdatea" ).datepicker({dateFormat: 'dd/mm/yy'});
					 	
		var account = $.map(table.rows('.selected').data(), function (item) {
			//console.log(item);
        	return item['vd_id']
   		});
		var type = "delete";
		if(account.length > 0) {
			$('#type').val('type2');
			$('#accountsa').val(account.toString());
			$('#addDetailA').modal();
			console.log(account.toString());
		} else {
			alert('Please atleast one property to generate report');
		}
}



	</script>
</div>

</body>
</html>