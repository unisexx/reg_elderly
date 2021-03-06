<h3>รายงานผลการดำเนินงานโครงการ (คปญ. 2) [เพิ่ม/แก้ไข]</h3>

<form id="projectForm" method="post" action="home/projects/save/<?=$rs->id?>">
<table class="tbadd">
<tr>
  <th>ปีงบประมาณ <span class="Txt_red_12">*</span></th>
  <td>
    <select name="budget_year" class="form-control" style="width:auto;">
      <option value="">+ เลือกปีงบประมาณ +</option>
      <?php
		for ($x = (date("Y")+543); $x >= 2550; $x--) {
			$selected_year = ($x == $rs->budget_year)?"selected=selected":"";
		    echo "<option value='$x' $selected_year>$x</option>";
		}
	  ?>
    </select>
</td>
</tr>
<tr>
  <th>โครงการ <span class="Txt_red_12">*</span> / จังหวัด <span class="Txt_red_12">*</span></th>
  <td><span class="form-inline">
    <input type="text" class="form-control " id="exampleInputName" placeholder="โครงการ" style="width:500px;" name="name" value="<?=$rs->name?>" />
    / <?=form_dropdown('province_id',get_option('code','name','province '.select_province_condition().' order by name asc'),@$rs->province_id,'class="form-control" style="width:auto;"','+ เลือกจังหวัด +');?>
  </span></td>
</tr>
<tr>
  <th>ขั้นตอนการติดตามรายงานผลการดำเนินงาน  </th>
  <td>
    <textarea name="detail" rows="4" class="form-control " id="exampleInputName2" style="width:600px;" placeholder="รายละเอียด"><?=$rs->detail?></textarea>
    </td>
</tr>
<tr>
  <th>ผู้รับผิดชอบโครงการ  <span class="Txt_red_12">*</span></th>
  <td><span class="form-inline">
    <input type="text" class="form-control " id="exampleInputName18" placeholder="ชื่อ-สกุล" style="width:350px;" name="responsible_name" value="<?=$rs->responsible_name?>"  />
    /
  <input type="text" class="form-control " id="exampleInputName18" placeholder="ตำแหน่ง" style="width:300px;" name="position" value="<?=$rs->position?>" />
  </span></td>
  </tr>
<tr>
  <th>โทรศัพท์ <span class="Txt_red_12">*</span> / มือถือ <span class="Txt_red_12">*</span> / e-mail <span class="Txt_red_12">*</span></th>
  <td><span class="form-inline">
    <input type="text" class="form-control " placeholder="โทรศัพท์" style="width:250px;" name="tel" value="<?=$rs->tel?>" /> /
    <input type="text" class="form-control " placeholder="มือถือ" style="width:250px;" name="mobile" value="<?=$rs->mobile?>" /> /
    <input type="text" class="form-control " placeholder="E – mail" style="width:250px;" name="email" value="<?=$rs->email?>" />
    </span></td>
</tr>
</table>

<h4 style="margin-top:30px;">รายละเอียดข้อมูลกิจกรรม
	<a id="openActivityForm" class='inline' href="#inline_activity">
	<button type="submit" class="btn btn-warning"><img src="themes/elderly2016/images/document_add.png" width="16" height="16" /> เพิ่มกิจกรรม</button>
	</a>
</h4>
<table class="tbSublist tbActivities">
  <tr>
    <th rowspan="3" style="width:5%">#</th>
    <th rowspan="3" style="width:25%">ชื่อกิจกรรม</th>
    <th rowspan="3" style="width:20%">ชื่อวิทยากรภูมิปัญญา</th>
    <th colspan="8" style="width:25%">จำนวนผู้ได้รับประโยชน์</th>
    <th rowspan="3" style="width:5%">รวม</th>
    <th rowspan="3" style="width:20%">พื้นที่ดำเนินการ</th>
    <th rowspan="3" style="width:10%">วันที่ดำเนินการ</th>
    <th rowspan="3" style="width:10%">งบประมาณโครงการ/จำนวน</th>
    <th rowspan="3" style="width:10%">ลบ</th>
  </tr>
  <tr>
    <th colspan="2">0-18  ปี</th>
    <th colspan="2">18-25  ปี</th>
    <th colspan="2">25-59  ปี</th>
    <th colspan="2">60 ปีขึ้นไป</th>
    </tr>
  <tr>
  <th>ช</th>
  <th>ญ</th>
  <th>ช</th>
  <th>ญ</th>
  <th>ช</th>
  <th>ญ</th>
  <th>ช</th>
  <th>ญ</th>
  </tr>
  <?if(isset($activities)):?>
  <?foreach($activities as $key=>$act):?>
  <tr class="box">
  	<td><?=$key+1?></td>
  	<td><a class='inline' href="#inline_activity" data-id=<?=$act->id?>><?=$act->activity_name?></a></td>
  	<td>
  		<?$experts = $this->db->query('select * from experts where activity_id = '.$act->id)->result();?>
  		<?foreach($experts as $expert):?>
  		<div class="expertName"><?=$expert->expert_name?></div>
  		<?endforeach;?>
  	</td>
  	<td><?=$act->b1m?></td>
  	<td><?=$act->b1f?></td>
  	<td><?=$act->b2m?></td>
  	<td><?=$act->b2f?></td>
  	<td><?=$act->b3m?></td>
  	<td><?=$act->b3f?></td>
  	<td><?=$act->b4m?></td>
  	<td><?=$act->b4f?></td>
  	<td><?=($act->b1m + $act->b1f + $act->b2m + $act->b2f + $act->b3m + $act->b3f + $act->b4m + $act->b4f)?></td>
  	<td><?=$act->area?></td>
  	<td><?=DB2Date($act->activity_date)?></td>
  	<td><?=number_format($act->budget)?></td>
  	<td>
  		<input type="hidden" name="activity_name[]" value="<?=$act->activity_name?>">
  		<input type="hidden" name="b1m[]" value="<?=$act->b1m?>">
  		<input type="hidden" name="b1f[]" value="<?=$act->b1f?>">
  		<input type="hidden" name="b2m[]" value="<?=$act->b2m?>">
  		<input type="hidden" name="b2f[]" value="<?=$act->b2f?>">
  		<input type="hidden" name="b3m[]" value="<?=$act->b3m?>">
  		<input type="hidden" name="b3f[]" value="<?=$act->b3f?>">
  		<input type="hidden" name="b4m[]" value="<?=$act->b4m?>">
  		<input type="hidden" name="b4f[]" value="<?=$act->b4f?>">
  		<input type="hidden" name="area[]" value="<?=$act->area?>">
  		<input type="hidden" name="activity_date[]" value="<?=DB2Date($act->activity_date)?>">
  		<input type="hidden" name="budget[]" value="<?=$act->budget?>">
  		<input type="hidden" name="activity_id[]" value="<?=$act->id?>">
  		<?foreach($experts as $expert):?>
  		<input type="hidden" name="expert_name" value="<?=$expert->expert_name?>">
  		<?endforeach;?>
  		<button class="act_delete" data-row-id="<?=$act->id?>">ลบ</button>
  	</td>
  </tr>
  <?endforeach;?>
  <?endif;?>
  </table>


<div id="btnBoxAdd">
	<?php echo form_current() ?>
  <input name="input" type="submit" title="บันทึก" value="บันทึก" class="btn btn-primary" style="width:100px;"/>
  <input name="input2" type="button" title="ย้อนกลับ" value="ย้อนกลับ"  onclick="history.back(-1)"  class="btn btn-default" style="width:100px;"/>
</div>
</form>



<!-- This contains the hidden content for inline calls -->
<div style='display:none;'>
      <div id='inline_activity' style='padding:10px; background:#fff;'>


      	<form id="activityForm">
	      <h3>บันทึกรายละเอียดกิจกรรม</h3>
	      <table class="tbadd">
			<tr>
			  <th><span style="width:25%">ชื่อกิจกรรม<span class="Txt_red_12"> *</span></span></th>
			  <td><span class="form-inline">
			    <input type="text" class="form-control " id="exampleInputName3" placeholder="ชื่อกิจกรรม" style="width:500px;" name="activity_name" />
			  </span></td>
			</tr>
			<tr>
			  <th><span style="width:20%">ชื่อวิทยากรภูมิปัญญา<span class="Txt_red_12"> *</span></span></th>
			  <td><span class="form-inline">
			  	<span class="expertEditBlk"></span>
			    <input class="inputExpert form-control typeahead" type="text" class="form-control " id="exampleInputName" placeholder="ชื่อวิทยากรภูมิปัญญา" style="width:500px;" name="expert_name"/>
			    <img id="addExpert" src="themes/elderly2016/images/add.png" width="16" height="16" class="vtip" title="เพิ่มชื่อวิทยากร" style="cursor: pointer;" /><span class="note">* ดึงข้อมูลจาก คปญ.01 ถ้ากรณีที่ไม่มีข้อมูลใน คปญ.01 ให้สามารถใส่ข้อมูลเองได้</span></span></td>
			</tr>
			<tr>
			  <th><span style="width:25%">จำนวนผู้ได้รับประโยชน์ ชาย / หญิง<span class="Txt_red_12"> *</span></span></th>
			  <td><span class="form-inline">
			    <div style="margin-bottom:10px;">
			    0-18  ปี
			    <input type="number" min="0" class="form-control " id="exampleInputName4" placeholder="ชาย" style="width:100px;" name="b1m"/> /
			    <input type="number" min="0" class="form-control " id="exampleInputName4" placeholder="หญิง" style="width:100px; margin-right:30px;" name="b1f" />
			    18-25 ปี
			    <input type="number" min="0" class="form-control " id="exampleInputName4" placeholder="ชาย" style="width:100px;" name="b2m" /> /
			    <input type="number" min="0" class="form-control " id="exampleInputName4" placeholder="หญิง" style="width:100px;" name="b2f" /></div>
			    25-59 ปี
			    <input type="number" min="0" class="form-control " id="exampleInputName4" placeholder="ชาย" style="width:100px;" name="b3m" /> /
			    <input type="number" min="0" class="form-control " id="exampleInputName4" placeholder="หญิง" style="width:100px; margin-right:30px;" name="b3f" />
			    60 ปีขึ้นไป
			    <input type="number" min="0" class="form-control " id="exampleInputName4" placeholder="ชาย" style="width:100px;" name="b4m" /> /
			    <input type="number" min="0" class="form-control " id="exampleInputName4" placeholder="หญิง" style="width:100px;" name="b4f" />

			  </span></td>
			</tr>
			<tr>
			  <th>พื้นที่ดำเนินการ  </th>
			  <td>
			    <textarea name="area" rows="4" class="form-control" id="exampleInputName2" style="width:600px;" placeholder="รายละเอียดพื้นที่ดำเนินการ"></textarea>
			    </td>
			</tr>
			<tr>
			  <th>วันที่ดำเนินการ <span class="Txt_red_12"> *</span></th>
			  <td>
			    <div class="input-group date">
				  <input type="text" class="form-control datepickerTH" name="activity_date" data-date-language="th-th" value="<?=DB2Date($rs->activity_date)?>"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
				</div>
				<div id="activity_date"></div>
			  </td>
			  </tr>
			<tr>
			  <th>งบประมาณโครงการ/จำนวน<span class="Txt_red_12"> *</span></th>
			  <td>
			    <span class="form-inline"><input type="number" min="0" class="form-control " id="exampleInputName18" placeholder="จำนวน" style="width:250px;" name="budget" /> บาท </span>
			  </td>
			</tr>
			</table>

			<div id="btnBoxAdd">
			  <input type="hidden" name="id" value="">
			  <input type="hidden" name="trRow" value="">
			  <input id="activityBtn" name="input" type="submit" title="บันทึกกิจกรรม" value="บันทึกกิจกรรม" class="btn btn-primary"/>
			</div>
		</form>


      </div>
  </div>



<script>
$(document).ready(function(){
	// validate mainform
	$("#projectForm").validate({
		rules: {
			budget_year:"required",
			name:"required",
			province_id:"required",
			responsible_name:"required",
			position:"required",
			tel:"required",
			mobile:"required",
			email:"required"
		},
		messages:{
			budget_year:"ฟิลด์นี้ห้ามเป็นค่าว่าง",
			name:"ฟิลด์นี้ห้ามเป็นค่าว่าง",
			province_id:"ฟิลด์นี้ห้ามเป็นค่าว่าง",
			responsible_name:"ฟิลด์นี้ห้ามเป็นค่าว่าง",
			position:"ฟิลด์นี้ห้ามเป็นค่าว่าง",
			tel:"ฟิลด์นี้ห้ามเป็นค่าว่าง",
			mobile:"ฟิลด์นี้ห้ามเป็นค่าว่าง",
			email:"ฟิลด์นี้ห้ามเป็นค่าว่าง"
		},
        errorPlacement: function(error, element)
        {
	            if ( element.is(":radio,:checkbox"))
	            {
	                error.appendTo( element.parents('td') );
	            }
	            else
	            { // This is the default behavior
	                error.insertAfter( element );
	            }
		}
	});

	// validate colorbox form
	$("#activityForm").validate({
		rules: {
			activity_name:"required",
			expert_name:"required",
			activity_date:"required",
			budget:"required"
		},
		messages:{
			activity_name:"ฟิลด์นี้ห้ามเป็นค่าว่าง",
			expert_name:"ฟิลด์นี้ห้ามเป็นค่าว่าง",
			activity_date:"ฟิลด์นี้ห้ามเป็นค่าว่าง",
			budget:"ฟิลด์นี้ห้ามเป็นค่าว่าง"
		},
        errorPlacement: function(error, element)
        {
	             if ( element.is(":radio,:checkbox,[name=activity_date],[name=budget]"))
	            {
	                error.appendTo( element.parents('td') );
	            }
	            else
	            { // This is the default behavior
	                error.insertAfter( element );
	            }
		},
		submitHandler: function(form) {
            $.colorbox.close();
            var $this = $("#activityBtn");
            var id = $this.closest('#inline_activity').find('input[name=id]').val();
			var trRow = $this.closest('#inline_activity').find('input[name=trRow]').val();
            var activity_name = $this.closest('#inline_activity').find('input[name=activity_name]').val();
			var b1m = ($this.closest('#inline_activity').find('input[name=b1m]').val() == "") ? 0 : $this.closest('#inline_activity').find('input[name=b1m]').val();
			var b1f = ($this.closest('#inline_activity').find('input[name=b1f]').val()  == "")? 0 : $this.closest('#inline_activity').find('input[name=b1f]').val() ;
			var b2m = ($this.closest('#inline_activity').find('input[name=b2m]').val()  == "")? 0 : $this.closest('#inline_activity').find('input[name=b2m]').val() ;
			var b2f = ($this.closest('#inline_activity').find('input[name=b2f]').val()  == "")? 0 : $this.closest('#inline_activity').find('input[name=b2f]').val();
			var b3m = ($this.closest('#inline_activity').find('input[name=b3m]').val()  == "")? 0 : $this.closest('#inline_activity').find('input[name=b3m]').val();
			var b3f = ($this.closest('#inline_activity').find('input[name=b3f]').val()  == "")? 0 : $this.closest('#inline_activity').find('input[name=b3f]').val();
			var b4m = ($this.closest('#inline_activity').find('input[name=b4m]').val()  == "")? 0 : $this.closest('#inline_activity').find('input[name=b4m]').val();
			var b4f = ($this.closest('#inline_activity').find('input[name=b4f]').val()  == "")? 0 : $this.closest('#inline_activity').find('input[name=b4f]').val();
			var total = parseInt(b1m)+parseInt(b1f)+parseInt(b2m)+parseInt(b2f)+parseInt(b3m)+parseInt(b3f)+parseInt(b4m)+parseInt(b4f);
			var area = $this.closest('#inline_activity').find('textarea[name=area]').val();
			var activity_date = $this.closest('#inline_activity').find('input[name=activity_date]').val();
			var budget = $this.closest('#inline_activity').find('input[name=budget]').val();

			// วนลูปหา ชื่อวิทยากร
			var multiInput = '';
			var multiHiddenForm = '';
			$(".inputExpert").each(function() {
			   var expertName = $(this).val();
			   if(expertName != ""){
					var dataTxt = '<div class="expertName">'+expertName+'</div>';
					multiInput += dataTxt;

					var dataForm = '<input type="hidden" name="expert_name" value="'+expertName+'">';
					multiHiddenForm += dataForm;
			   }
			});

			var hiddenForm = "";
			hiddenForm += "<input type='hidden' name='activity_name[]' value='"+activity_name+"'>";
			hiddenForm += "<input type='hidden' name='b1m[]' value='"+b1m+"'>";
			hiddenForm += "<input type='hidden' name='b1f[]' value='"+b1f+"'>";
			hiddenForm += "<input type='hidden' name='b2m[]' value='"+b2m+"'>";
			hiddenForm += "<input type='hidden' name='b2f[]' value='"+b2f+"'>";
			hiddenForm += "<input type='hidden' name='b3m[]' value='"+b3m+"'>";
			hiddenForm += "<input type='hidden' name='b3f[]' value='"+b3f+"'>";
			hiddenForm += "<input type='hidden' name='b4m[]' value='"+b4m+"'>";
			hiddenForm += "<input type='hidden' name='b4f[]' value='"+b4f+"'>";
			hiddenForm += "<input type='hidden' name='area[]' value='"+area+"'>";
			hiddenForm += "<input type='hidden' name='activity_date[]' value='"+activity_date+"'>";
			hiddenForm += "<input type='hidden' name='budget[]' value='"+budget+"'>";
			hiddenForm += "<input type='hidden' name='activity_id[]' value='"+id+"'>";

			var txtInsert = "";
			txtInsert += '<tr class="box">';
			txtInsert += '<td></td>';
			txtInsert += '<td><a class="inline" href="#inline_activity" data-id="'+id+'">'+activity_name+'</a></td>';
			txtInsert += '<td>'+multiInput+'</td>';
			txtInsert += '<td>'+b1m+'</td>';
			txtInsert += '<td>'+b1f+'</td>';
			txtInsert += '<td>'+b2m+'</td>';
			txtInsert += '<td>'+b2f+'</td>';
			txtInsert += '<td>'+b3m+'</td>';
			txtInsert += '<td>'+b3f+'</td>';
			txtInsert += '<td>'+b4m+'</td>';
			txtInsert += '<td>'+b4f+'</td>';
			txtInsert += '<td>'+total+'</td>';
			txtInsert += '<td>'+area+'</td>';
			txtInsert += '<td>'+activity_date+'</td>';
			txtInsert += '<td>'+numberWithCommas(budget)+'</td>';
			txtInsert += '<td>'+hiddenForm+multiHiddenForm+'<button class="act_delete">ลบ</button></td>';
			txtInsert += '</tr>';


      // console.log(hiddenForm);
      // console.log(trRow);
			trRow = parseInt(trRow)+2; // บวกหัวตารางไป 2 แถว
			console.log(trRow);
			// ถ้าเป็น edit ให้แทนแถวเดิม ถ้าเป็นเพิ่มใหม่ให้ใส่แถวสุดท้าย
			if(trRow > 2){
				$('.tbActivities').find("tr:eq("+trRow+")").replaceWith(txtInsert);
				$(".inline").colorbox({inline:true, width:"90%"}); // reload colorbox
			}else{ // ยังไม่มีข้อมูลมาก่อน
				$('.tbActivities tr:last').after(txtInsert);
				$(".inline").colorbox({inline:true, width:"90%"}); // reload colorbox
			}

			// เคลียร์ค่า input ของฟอร์มใน colorbox
			$this.closest('#inline_activity').find("input[type=hidden], input[type=text], input[type=number], textarea").val("");

			// คำนวนใส่ตัวเลขแถว
			autoCountTableRow('tbActivities');
        }
	});

	// เพิ่มกิจกรรมใหม่
	$('#openActivityForm').click(function(){
		// เคลียร์ค่า input ของฟอร์มใน colorbox
		$('#inline_activity').find("input[type=hidden], input[type=text], input[type=number], textarea").val("");
	});

	// เพิ่มวิทยากร
	$('#addExpert').click(function(){
		// var rancomClassName = "r"+Math.floor((Math.random() * 100) + 1);
		$('.inputExpert:last').after('<br><input class="inputExpert form-control typeahead" type="text" placeholder="ชื่อวิทยากรภูมิปัญญา" style="width:500px;" name="expert_name"/>');
		autoComplete();
	});

	// submit button
	$('#projectForm input[type=submit]').click(function(){
		$("#projectForm input[name=expert_name]").each(function(){
			$(this).attr('name','expert_name['+ $('form .box').index($(this).closest('.box')) +'][]');
		})
	});

	// แก้ไขกิจกรรม
	$('table.tbActivities').on('click', '.inline', function() {
		// alert($(this).attr('data-edit-id'));
		var trRow =  $(this).parent().prev('td').html();
		var id = $(this).attr('data-id');
		var activity_name = $(this).closest('tr').find('td:eq(1)').text();
		var b1m = $(this).closest('tr').find('td:eq(3)').text();
		var b1f = $(this).closest('tr').find('td:eq(4)').text();
		var b2m = $(this).closest('tr').find('td:eq(5)').text();
		var b2f = $(this).closest('tr').find('td:eq(6)').text();
		var b3m = $(this).closest('tr').find('td:eq(7)').text();
		var b3f = $(this).closest('tr').find('td:eq(8)').text();
		var b4m = $(this).closest('tr').find('td:eq(9)').text();
		var b4f = $(this).closest('tr').find('td:eq(10)').text();
		var area = $(this).closest('tr').find('td:eq(12)').text();
		var activity_date = $(this).closest('tr').find('td:eq(13)').text();
		var budget = $(this).closest('tr').find('td:eq(14)').text().replace(/,/g, "");

		var expertInput = '';
		$(this).closest('tr').find('.expertName').each(function() {
		   var expertName = $(this).text();
		   var dataTxt = '<input class="inputExpert form-control typeahead" type="text" id="exampleInputName" placeholder="ชื่อวิทยากรภูมิปัญญา" style="width:500px;" name="expert_name" value="'+expertName+'"><br>';
		   expertInput += dataTxt;
		});

		$('.expertEditBlk').html(expertInput);
		$('input[name=activity_name]').val(activity_name);
		$('input[name=b1m]').val(b1m);
		$('input[name=b1f]').val(b1f);
		$('input[name=b2m]').val(b2m);
		$('input[name=b2f]').val(b2f);
		$('input[name=b3m]').val(b3m);
		$('input[name=b3f]').val(b3f);
		$('input[name=b4m]').val(b4m);
		$('input[name=b4f]').val(b4f);
		$('textarea[name=area]').val(area);
		$('input[name=activity_date]').val(activity_date);
		$('input[name=budget]').val(budget);
		$('input[name=id]').val(id);
		$('input[name=trRow]').val(trRow);

		autoComplete();
	});

	// ลบกิจกรรม
	$(document).on('click', ".act_delete", function() {
		if (!confirm('ยืนยันการลบกิจกรรม')) return false;

		var actId = $(this).attr('data-row-id');
		if(actId != ''){
			$.get('home/ajax/delete_activity/'+actId);
		}

		$(this).closest('tr').fadeOut(300, function() { $(this).remove(); });
		return false;
	});
});

// นับจำนวนใส่ตัวเลขหน้าแถว
function autoCountTableRow(tbClassName){
	// add Table Class Name "autocount"
	$('.'+tbClassName+' tr td:first-child').each(function(i){
		// $(this).before('<td>'+(i+1)+'</td>');
		$(this).html('');
		$(this).append((i+1));
	});
}

// ใส่คอมม่าที่ตัวเลข
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
</script>


<!-- <input type="text" data-provide="typeahead"> -->
<!-- <script src="media/js/bootstrap3-typeahead.min.js"></script> -->
<script src="media/js/bootstrap3-typeahead.js"></script>
<script>
$(document).ready(function(){
	autoComplete();
});

function autoComplete(){
	$.get('home/ajax/get_expert_name_autocomplete', function(data){
	    $('.typeahead').typeahead({ source:data });
	},'json');
	//example_collection.json
	// ["item1","item2","item3"]
}
</script>
