<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Access</title>


   
<!--<link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
    
<style>
.dropdown-submenu .dropdown-menu {
    /**left: 100%;*/
}
.number_algin {
	text-align:right;
}

.mainNav li.has-child > a:after {
       color: #444;
       content: ' ▾';
    }
    .breadCrumb {
 background: none;

    	}   

</style>

<style type="text/css">
	
.glyphicon {
    height: 20px;
    width: 20px;
    display: inline-block;
    background: #fff url(images/sprite-icons/icons-color.png) no-repeat;
    text-indent: -999999px;
    border: #ccc 1px solid;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    margin-left: 3px
}

.glyphicon-plus-sign:before{background: url('../images/sprite-icons/icons-color.png') no-repeat -262px -202px;
	width: 16px;
	height: 16px;}
.glyphicon-plus-sign{background: url('../images/sprite-icons/icons-color.png') no-repeat -262px -202px;
	width: 16px;
	height: 16px;}
.glyphicon-minus-sign:before{background: url('../images/sprite-icons/icons-color.png') no-repeat -242px -202px;
	width: 16px;
	height: 16px;}
.glyphicon-minus-sign{background: url('../images/sprite-icons/icons-color.png') no-repeat -242px -202px;
	width: 16px;
	height: 16px;}
</style>


<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="css/ie/ie7.css" />
<![endif]-->
<!--[if IE 8]>
<link rel="stylesheet" type="text/css" href="css/ie/ie8.css" />
<![endif]-->
<!--[if IE 9]>
<link rel="stylesheet" type="text/css" href="css/ie/ie9.css" />
<![endif]-->
<!-- Jquery -->
<style type="text/css">
	.tree, .tree ul {
    margin:0;
    padding:0;
    list-style:none
}
.tree ul {
    margin-left:1em;
    position:relative
}
.tree ul ul {
    margin-left:.5em
}
.tree ul:before {
    content:"";
    display:block;
    width:0;
    position:absolute;
    top:0;
    bottom:0;
    left:0;
    border-left:1px solid
}
.tree li {
    margin:0;
    padding:0 1em;
    line-height:2em;
    color:#369;
    font-weight:700;
    position:relative
}
.tree ul li:before {
    content:"";
    display:block;
    width:10px;
    height:0;
    border-top:1px solid;
    margin-top:-1px;
    position:absolute;
    top:1em;
    left:0
}
.tree ul li:last-child:before {
    background:#F5F5F5;
    height:auto;
    top:1em;
    bottom:0
}
.indicator {
    margin-right:5px;
}
.tree li a {
    text-decoration: none;
    color:#369;
}
.tree li button, .tree li button:active, .tree li button:focus {
    text-decoration: none;
    color:#369;
    border:none;
    background:transparent;
    margin:0px 0px 0px 0px;
    padding:0px 0px 0px 0px;
    outline: 0;
}
</style>
 
 @include('includes.header', ['page' => 'Acc'])

	
	
	<div id="content">
		<div class="grid_container">
			<br>
			
					<div class="breadCrumbHolder module">	
				<div id="breadCrumb3" style="/*float:right;*/" class="breadCrumb module grid_3">
					<ul >
						<li><a href="#">Home</a></li>
						<li><a href="#">Admin</a></li>
						<li><a href="#">User Management</a></li>
						<li>Access</li>
					</ul>
				</div>
			</div>
			<br><br>
				<div class="widget_wrap">					
					<div class="widget_content">
			<div id="sidetree" class=" leftmenu grid_6 widget_wrap">

			  	<ul id="tree1"> 
		            @foreach($categories as $category)
		                <li>		
							<input type="hidden" id="ename_{{ $category->mod_id }}" value="{{ $category->mod_name }}">
					        <input type="hidden" id="eparent_{{ $category->mod_id }}" value="{{ $category->mod_parent }}">
							<input type="hidden" id="eroleid_{{ $category->mod_id }}" value="{{ $category->rol_id }}">
		                 	<a onclick="openEditRole({{ $category->mod_id }})" href="#">( {{$category->mod_id}} ) {{ $category->mod_name }}</a>
		                    @if(count($category->childs))
		                        @include('manageChild',['childs' => $category->childs])
		                    @endif
		                </li>
		            @endforeach
				</ul>
			</div>
		
		
		<div id="adduserform"  style="    position: fixed;
    ;" class="grid_6">
			<div class="widget_wrap">
				<div class="widget_top">
					<h6 id="lblmodulename"></h6>
				</div>
				<div class="widget_content">
					<!--<form id="signupform" onsubmit="return setRole()" autocomplete="off" method="post" action="accesstrn" class="form_container left_label">-->
					<div class="form_container left_label">
						<ul>
							<li>
							@csrf
							<input type="hidden" name="operation" id="operation">
							<input type="hidden"  name="module_id" id="module_id">
							<input type="hidden" name="s_role_id" id="s_role_id">
							<fieldset style="width: 30%;">
										<legend>Roles</legend>
										<ul>
											<li>
											<div id="rolelistHtm">
												@foreach ($role as $rec)
												<span class="grid_12">
												<input name="role_id" id="role_id_{{ $rec->rol_id }}" class="checkbox role_id"  type="checkbox" value="{{ $rec->rol_id }}" tabindex="7">
												<label class="choice">{{ $rec->rol_name }}</label>
												</span>
												<br /><br /><br />
												@endforeach
												
											</div>
											</li>
										</ul>
									</fieldset>
							</li>
							<li>
							<div class="form_grid_12">
								<div class="form_input">
									<button id="addsubmit" name="adduser" data-loading-text="Updating..." onclick="updateRoleAccess()" class="btn_small btn_blue"><span>Submit</span></button>									
									<!--<button id="reset" name="reset" onclick="clear()" type="button" class="btn_small btn_blue"><span>Reset</span></button>										
									<button id="close" onclick="closeAddUser()" name="close" type="button" class="btn_small btn_blue"><span>Close</span></button>-->
								</div>
							</div>
							</li>
						</ul>
					</div>
					<!--</form>-->
				</div>
			</div>
		</div>
	</div></div>
	
	</div>
	<span class="clear"></span>
</div>
<script>

$.fn.extend({
    treed: function (o) {
      
      var openedClass = 'glyphicon-minus-sign';
      var closedClass = 'glyphicon-plus-sign';
      
      if (typeof o != 'undefined'){
        if (typeof o.openedClass != 'undefined'){
        openedClass = o.openedClass;
        }
        if (typeof o.closedClass != 'undefined'){
        closedClass = o.closedClass;
        }
      };
      
        /* initialize each of the top levels */
        var tree = $(this);
        tree.addClass("tree");
        tree.find('li').has("ul").each(function () {
            var branch = $(this);
            branch.prepend("<i class='indicator glyphicon " + closedClass + "'></i>");
            branch.addClass('branch');
            branch.on('click', function (e) {
                if (this == e.target) {
                    var icon = $(this).children('i:first');
                    icon.toggleClass(openedClass + " " + closedClass);
                    $(this).children().children().toggle();
                }
            })
            branch.children().children().toggle();
        });
        /* fire event from the dynamically added icon */
        tree.find('.branch .indicator').each(function(){
            $(this).on('click', function () {
                $(this).closest('li').click();

            });
        });
        /* fire event to open branch if the li contains an anchor instead of text */
        tree.find('.branch>a').each(function () {
            $(this).on('click', function (e) {
               // $(this).closest('li').click();
                e.preventDefault();
            });
        });
        /* fire event to open branch if the li contains a button instead of text */
        tree.find('.branch>button').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
    }
});

/* Initialization of treeviews */

$(document).ready(function() {
    console.log( "ready!" );
    $('#tree1').treed();


});

function setCheck(){
	 var checked = $(this).is(":checked");
    if($(".role_id>input:checkbox").attr("checked",checked)){
      //alert('Checked Successfully');
      $(this).attr("css","checked");
    }
}

</script>
<script>

	function updateRoleAccess(){
		$("#addsubmit").prop('disabled', true);
		$("#addsubmit").text("Updating...");

		var role_arr = []; 
		var operation = $('#operation').val();
		var module_id = $('#module_id').val();

		

		@foreach ($role as $pop_rec)
			//alert(document.getElementById('#role_id_{{ $pop_rec->rol_id }}').checked);
		 // var value = $('#role_id_{{ $pop_rec->rol_id }}').find('.checked').find('#role_id_{{ $pop_rec->rol_id }}').val();
//console.log(value);``
		if (document.getElementById("role_id_{{ $pop_rec->rol_id }}").checked){

			role_arr.push(document.getElementById("role_id_{{ $pop_rec->rol_id }}").value);
		}
		  /*if (value != undefined) {
		  	role_arr.push(value);
		  }*/

		@endforeach	
//console.log(role_arr);
		$("#s_role_id").val(role_arr);
		
		var role_id = $("#s_role_id").val();
		
		$.ajax({
	        type:'POST',
	        url:'accesstrn',
	        data:{s_role_id:role_id,operation:operation,module_id:module_id,_token: '{{csrf_token()}}'},
	        success:function(data){	 
	        	$("#addsubmit").text("submit");
	        	var noty_id = noty({
						layout : 'top',
						text: 'Roles updated successfully!',
						modal : true,
						type : 'success', 
						 });    	
	        	$("#addsubmit").prop('disabled', false);
	        }
		});
	}

	function openAddUser(){
		$("#module_id").val("");
		$("#operation").val(1);
		 $("#usertable").hide(0);
		 $("#adduserform").show(0);
	}
	
	function clear(){
		@foreach ($role as $clear_rec)
			var rol_id='{{ $clear_rec->rol_id }}';
			$('#uniform-role_id_'+rol_id).find('span').attr("class", "");
		@endforeach
	}

	function addRoleHtm(){
		$('#rolelistHtm').html('');
		$('#rolelistHtm').html('@foreach ($role as $rec)'+
												'<span class="grid_12">'+
												'<input name="role_id" id="role_id_{{ $rec->rol_id }}" class="checkbox role_id"  type="checkbox" value="{{ $rec->rol_id }}" tabindex="7">'+
												'<label class="choice">{{ $rec->rol_name }}</label>'+
												'</span>'+
												'<br /><br /><br />'+
												'@endforeach');
	}

	function openEditRole(id){
		//alert($('#proleid_1').val();
		var name = "ename_"+id;
		var curmodule = name.substring(0, name.length - 1);
		addRoleHtm();
		//alert(name);
		//var lastmodulename =  $('#'+name).val();
		var modtext = $('#'+curmodule).val();
		if (modtext != undefined) {
			modtext = $('#'+curmodule).val() + " - " + $("#ename_"+id).val();
		} else {
			modtext = $("#ename_"+id).val();
		}
	
		$("#adduserform").show(0);
		var roleid = $("#eroleid_"+id).val();
		var parentid = $("#eparent_"+id).val();
		$("#module_id").val(id);
		$("#operation").val(1);
		$("#lblmodulename").html('');
		$("#lblmodulename").append("Module - "+modtext);		
		
		$("#s_role_id").val('');
		//$('.role_id').find('input:checkbox').attr('checked', false);
		@foreach ($role as $pop_rec)
			var rol_id='{{ $pop_rec->rol_id }}';
		document.getElementById("role_id_"+rol_id).removeAttribute("checked");
		$('#role_id_'+rol_id).find('span').attr("checked", "");
		@endforeach
		var role_list = "";
		$.ajax({
	        type:'GET',
	        url:'getaccessajax',
	        data:{module_id:id,_token: '{{csrf_token()}}'},
	        success:function(data){	 
	        	var char = data.roles.toString().split(",");  
	        	for (var i in char) {   
					var to_replace = $("#role_id_"+char[i]).find('span');
					//alert();
					//console.log(to_replace.prop('checked', true));
					to_replace.attr("class", "checked");
					document.getElementById("role_id_"+char[i]).setAttribute("checked", "checked");
					//$("#uniform-role_id_"+char[i]).attr("checked", "checked");
					var element = document.getElementById("role_id_"+char[i]);
  					element.classList.add("checked");
					//to_replace.attr("checked", "checked");

				//	to_replace.prop('checked', true);
				}
	        }
		});
		
		
		
				
	}

	function setRole(){
		var role_arr = []; 
		/*var role_arr = $('input:checkbox:checked.role_id').map(function () {
			return this.value; // $(this).val()
		}).get();*/

		@foreach ($role as $pop_rec)
			var rol_id='{{ $pop_rec->rol_id }}';
		  //$('#uniform-role_id_'+{{ $pop_rec->rol_id }}).find('span').attr("class", "");
		  var value = $('#uniform-role_id_'+rol_id).find('.checked').find('#role_id_'+rol_id).val();
		  if (value != undefined) {
		  	role_arr.push(value);
		  }
		@endforeach

		//alert(role_arr);
		$("#s_role_id").val(role_arr);
		//alert(role_arr);
		return true;
	}  


//to_replace.text("The new text");

	
		//alert(1);
            /*$.ajax({
               type:'POST',
               url:'getmsg',
               data:'_token = @csrf',
               success:function(data){
                  alert(data.msg);//$("#msg").html(data.msg);
               }
            });*/
        
	
</script>
</body>
</html>