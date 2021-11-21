<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>{{__('CodeMaintenance.Property_Address_Log')}}</title>

@include('includes.header', ['page' => 'datamaintenance'])
					
	<div id="content">
<div class="grid_container">
	<div class="grid_12">
		<br>
		<div class="breadCrumbHolder module">
			<div id="breadCrumb3" style="/*float:right;*/" class="breadCrumb module grid_3">
				<ul>
					<li><a href="#">{{__('CodeMaintenance.Home')}} </a></li>
					<li><a href="#">{{__('CodeMaintenance.Data_Maintenance')}}</a></li>
					<li>{{__('CodeMaintenance.Property_Address_Log')}} </li>
				</ul>
			</div>
		</div>
		
		<div style="float:right;margin-right: 10px;"  class="btn_24_blue">
			@include('codemaintenance.propertyaddresschange.searchMasterlistLog',['tableid'=>'proptble', 'action' => 'propaddresslogtables', 'searchid' => '41'])	
			{{-- @include('codemaintenance.propertyaddresschange.search') --}}
		</div>
		<br>
		
		<div class="widget_wrap">
			<div class="widget_content">
				<table id="proptble" class="display select">
					<thead style="text-align: left;">
						<tr>
							<th>
								<input name="select_all" value="1" type="checkbox">
							</th>
							<th class="table_sno">
								S No
							</th>
							<th>
								{{__('CodeMaintenance.Log_Id')}}
							</th>
							<th>
								{{__('CodeMaintenance.Account_Number')}}
							</th>
							<th>
								{{__('CodeMaintenance.File_Number')}}
							</th>
							<th>
								{{__('CodeMaintenance.Zone')}}
							</th>
							<th>
								{{__('CodeMaintenance.SubZone')}}
							</th>
							<th>
								{{__('CodeMaintenance.Address1')}} 
							</th>
							<th>
								{{__('CodeMaintenance.Address2')}} 
							</th>
							<th>
								{{__('CodeMaintenance.Address3')}} 
							</th>
							<th>
								{{__('CodeMaintenance.Post_Code')}} 
							</th>
							<th>
								{{__('CodeMaintenance.City')}}
							</th>
							<th>
								{{__('CodeMaintenance.Status')}}
							</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
				
			</div>
		</div>
		
		<!-- <form style="display: hidden;" id="generateform" method="GET" action="generateinspectionreport">
			@csrf
			<input type="hidden" name="accounts" id="accounts">
		</form>-->
		
		
	</div>
	<span class="clear"></span>
	
	<script>
		
		
	$(document).ready(function (){
	var table = $('#proptble').DataTable({
		        "processing": false,
		        "serverSide": false,
		        "retrieve": true,
		        /*"dom": '<"toolbar">frtip',*/
				 "ajax": {
		"type": "GET",
		"url": 'propaddresslogtables',
		"contentType": 'application/json; charset=utf-8',
				"headers": {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
			},
		        // ajax: '{{ url("inspectionproperty") }}',
		        /*"ajax": '/bookings/datatables',*/
		        "columns": [
					{"data": "mal_id", "orderable": false, "searchable": false, "name":"mal_id" },
					{"data": null, "orderable": false, "searchable": false, "name":"sno" },
					{"data": "mal_id", "name":"mal_id" },
					{"data": "mal_accno", "name": "sno"},
					{"data": "mal_fileno", "name": "account number"},
					{"data": "zone", "name": "account number"},
					{"data": "subzone", "name": "fileno"},
					{"data": "mal_addr_ln1", "name": "zone"},
					{"data": "mal_addr_ln2", "name": "ishasbldg"},
					{"data": "mal_addr_ln3", "name": "owntype"},
					{"data": "mal_postcode", "name": "TO_OWNNAME"},
					{"data": "mal_city", "name": "bldgcount"},
					{"data": "tstatus", "name": "bldgcount"}
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


// $(document).ready(function (){
	
// 	var table = $('#proptble').DataTable({
// 		"processing": false,
// 		"serverSide": false,
// 		"retrieve": true,
// 		/*"dom": '<"toolbar">frtip',*/
// 		"ajax": {
// 		"type": "GET",
// 		"url": 'propaddresslogtables?page=1',
// 		"contentType": 'application/json; charset=utf-8',
// 				"headers": {
// 					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
// 					}
// 		},
// 		// ajax: '{{ url("inspectionproperty") }}',
// 		/*"ajax": '/bookings/datatables',*/
// 		"columns": [
// 			{"data": null, "orderable": false, "searchable": false, "name":"_id" },
// 			{"data": "mal_id", "orderable": false, "searchable": false, "name":"_id" },
// 			{"data": "mal_accno", "name": "sno"},
// 			{"data": "mal_fileno", "name": "account number"},
// 			{"data": "zone", "name": "account number"},
// 			{"data": "subzone", "name": "fileno"},
// 			{"data": "mal_addr_ln1", "name": "zone"},
// 			{"data": "mal_addr_ln2", "name": "ishasbldg"},
// 			{"data": "mal_addr_ln3", "name": "owntype"},
// 			{"data": "mal_postcode", "name": "TO_OWNNAME"},
// 			{"data": "mal_city", "name": "bldgcount"},
// 			{"data": "tstatus", "name": "bldgcount"}
// 				],
// 				"fnRowCallback": function (nRow, aData, iDisplayIndex) {
// 					var oSettings = this.fnSettings();
	
// 			//  $("td:nth-child(2)", nRow).html(oSettings._iDisplayStart+iDisplayIndex +1);
// 			return nRow;
// 			},
// 			"sPaginationType": "full_numbers",
// 			"iDisplayLength": 100,
// 			"oLanguage": {
// 			"sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Entries per page:</span>",
// 		},
// 		'columnDefs': [{
// 	'targets': 0,
// 	'searchable': true,
// 	'orderable': false,
// 	'width': '1%',
// 	'className': 'dt-body-center',
// 	'render': function (data, type, full, meta){
// 	return '<input type="checkbox">';
// 	}
// 	}],
// 	'rowCallback': function(row, data, dataIndex){
// 	// Get row ID
// 	var rowId = data[0];
// 	// If row ID is in the list of selected row IDs
	
// 	},
// 	"bAutoWidth": false,
// 			"sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>'
// 			});
	
	
	
// 	});
	
	</script>
</div>

</body>
</html>