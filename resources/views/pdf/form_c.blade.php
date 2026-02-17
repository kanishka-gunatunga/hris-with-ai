<?php
use App\Models\OtherEmployeeDetails;
use App\Models\OrganizationDepartments;
use App\Models\OtherHRManagerDetails;
use App\Models\OtherHODDetails;
use App\Models\OtherAuthoriserDetails;
use App\Models\User;
use App\Models\BasicSalary;
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
</head>
<style>
.small-text{
    font-size:12px;
    font-weight:400;
    margin-bottom:0px;
}
.big-text{
    font-size:42px;
    font-weight:600;
    margin-bottom:0px;
    margin-right:30px
}
.full-borderd{
    border:1px solid #000;
    padding:5px;

}

</style>


<body style="padding:10px;">
<table style="width:100%;">
    <tbody>

		<tr>
			<td colspan="12" class="full-borderd"><p class="small-text"><span class="big-text">C</span>Form   EPF Act No. 15 of 1958</p></td>
		</tr>
		<tr>
			<td colspan="6" rowspan="5"  class="full-borderd" style="height:150px;width:300px;"></td>
			<td colspan="3" class="full-borderd" style="height:25px;width:300px;"><p class="small-text">E.P.F. Registration No.</p></td>
			<td colspan="3" class="full-borderd" style="height:25px;width:150px;"><p class="small-text"><?php echo $epf_reg_no ?></p></td>
		</tr>
		<tr>
			<td colspan="3"  class="full-borderd" style="height:25px;width:300px;"><p class="small-text">Month and Year of Contribution</p></td>
			<td colspan="3" class="full-borderd" style="height:25px;width:150px;"><p class="small-text"><?php echo $year_month ?></p></td>
		</tr>
		<tr>
			<td colspan="3" class="full-borderd" style="height:25px;width:300px;"><p class="small-text">Contributions</p></td>
			<td colspan="2" class="full-borderd" style="height:25px;width:100px;"></td>
			<td class="full-borderd" style="height:25px;width:50px;"></td>
		</tr>
		<tr>
				<td colspan="3" class="full-borderd" style="height:25px;width:300px;"><p class="small-text">Surcharges</p></td>
			<td colspan="2" class="full-borderd" style="height:25px;width:100px;"><p class="small-text"><?php echo $surcharges ?></p></td>
			<td class="full-borderd" style="height:25px;width:50px;"></td>
		</tr>
		<tr>
				<td colspan="3" class="full-borderd" style="height:25px;width:300px;"><p class="small-text">Total Remitence</p></td>
			<td colspan="2" class="full-borderd" style="height:25px;width:100px;"><p class="small-text"></p></td>
			<td class="full-borderd" style="height:25px;width:50px;"></td>
		</tr>
		<tr>
			<td colspan="6" style="height:25px;width:300px;padding:5px"><p class="small-text">Officer, Employees Provident Fund.
Central Bank of Sri Lanka, P.O. 1299, Colombo.</p></td>
			<td colspan="3" style="height:25px;width:300px;"><p class="small-text">Cheque No</p></td>
			<td colspan="3" style="height:25px;width:150px;"><p class="small-text"><?php echo $cheque_no ?></p></td>
		</tr>
		<tr>
			<td colspan="6" rowspan="2" style="height:25px;width:300px;padding:5px"><p class="small-text">Telephone:2206645, Fax:2206651, E-mail:epfhelpdesk@cbslik, Web:www.epf.lk</p></td>
			<!--<td colspan="2" rowspan="2" style="height:25px;width:100px;padding:5px"><p class="small-text">Telephone:2206645<br>Fax:2206651<br>E-mail:epfhelpdesk@cbslik<br>Web:www.epf.lk</p></td>
			<td colspan="2" rowspan="2" style="height:25px;width:100px;padding:5px"><p class="small-text">Telephone:2206645<br>Fax:2206651<br>E-mail:epfhelpdesk@cbslik<br>Web:www.epf.lk</p></td> -->
			<td colspan="3" style="height:25px;width:300px;"><p class="small-text">Bank Name and Branch Name</p></td>
			<td colspan="3" style="height:25px;width:150px;"><p class="small-text"><?php echo $bank_and_branch ?></p></td>
		</tr>
		<tr>
			<td colspan="6"></td>
		</tr>
		<tr>
			<td colspan="12"><p class="small-text" style="text-align:center;">This form should be returned duly completed along with the contributions to the Superintendent/EPF</p></td>
		</tr>
	</tbody>
</table>
<table style="width:100%;">
	<tbody>
		<tr>
			<td colspan="3"  rowspan="2" class="full-borderd"><p class="small-text">Employee's Name</p></td>
			<td colspan="2"  rowspan="2" class="full-borderd"><p class="small-text">National Idt. No.</p></td>
			<td  rowspan="2" class="full-borderd"><p class="small-text">Member No</p></td>
			<td colspan="6" class="full-borderd"><p class="small-text">Cantributions(Rs.)</p></td>
			<td  rowspan="2" class="full-borderd"><p class="small-text">Total Eanings/Rs.</p></td>
		</tr>
		<tr>
			<td colspan="2" class="full-borderd"><p class="small-text">Total</p></td>
			<td colspan="2" class="full-borderd"><p class="small-text">Employer</p></td>
			<td colspan="2" class="full-borderd"><p class="small-text">Employee</p></td>
		</tr>
<?php 
$employees = User::where('user_role', 3)->get();
$hrms = User::where('user_role', 2)->get();
$hods = User::where('user_role', 5)->get();
$authorisers= User::where('user_role', 6)->get();
$total = 0;
$employer_total = 0;
$employee_total = 0;
$compareMonth = date('Y-m', strtotime($year_month));

foreach($employees as $employee){
$name = OtherEmployeeDetails::where('user_id',$employee->id)->value('first_name').' '. OtherEmployeeDetails::where('user_id', $employee->id)->value('last_name');
$nic = OtherEmployeeDetails::where('user_id',$employee->id)->value('nic');
$epf_no = OtherEmployeeDetails::where('user_id',$employee->id)->value('epf_no');
$basic_salary = BasicSalary::where('user_id', $employee->id)
    ->where('month_year', '<=', $compareMonth)
    ->orderBy('month_year', 'DESC')
    ->value('basic_salary') ?? 0;
$employer = ($basic_salary*12)/100;
$employee = ($basic_salary*8)/100;
$total_earning = $basic_salary;
$total_employer_employee = $employer+$employee;
$total = $total + $total_employer_employee;
$employer_total = $employer_total + $employer;
$employee_total = $employee_total + $employee;
?>
		<tr>
			<td colspan="3" class="full-borderd"><p class="small-text"><?php echo $name ?></p></td>
			<td colspan="2" class="full-borderd"><p class="small-text"><?php echo $nic ?></p></td>
			<td class="full-borderd"><p class="small-text"><?php echo $epf_no ?></p></td>
			<td colspan="2" class="full-borderd"><p class="small-text"><?php echo $total_employer_employee ?></p></td>
			<td colspan="2" class="full-borderd"><p class="small-text"><?php echo $employer ?></p></td>
			<td colspan="2" class="full-borderd"><p class="small-text"><?php echo $employee ?></p></td>
			<td class="full-borderd"><p class="small-text"><?php echo $total_earning ?></p></td>
		</tr>
<?php } ?>
<?php 
foreach($hrms as $hrm){
$name = OtherHRManagerDetails::where('user_id',$hrm->id)->value('first_name').' '. OtherHRManagerDetails::where('user_id', $hrm->id)->value('last_name');
$nic = OtherHRManagerDetails::where('user_id',$hrm->id)->value('nic');
$epf_no = OtherHRManagerDetails::where('user_id',$hrm->id)->value('epf_no');
$basic_salary = BasicSalary::where('user_id', $hrm->id)
    ->where('month_year', '<=', $compareMonth)
    ->orderBy('month_year', 'DESC')
    ->value('basic_salary') ?? 0;

$employer = ($basic_salary*12)/100;
$employee = ($basic_salary*8)/100;
$total_earning = $basic_salary;
$total_employer_employee = $employer+$employee;
$total = $total + $total_employer_employee;
$employer_total = $employer_total + $employer;
$employee_total = $employee_total + $employee;
?>
		<tr>
			<td colspan="3" class="full-borderd"><p class="small-text"><?php echo $name ?></p></td>
			<td colspan="2" class="full-borderd"><p class="small-text"><?php echo $nic ?></p></td>
			<td class="full-borderd"><p class="small-text"><?php echo $epf_no ?></p></td>
			<td colspan="2" class="full-borderd"><p class="small-text"><?php echo $total_employer_employee ?></p></td>
			<td colspan="2" class="full-borderd"><p class="small-text"><?php echo $employer ?></p></td>
			<td colspan="2" class="full-borderd"><p class="small-text"><?php echo $employee ?></p></td>
			<td class="full-borderd"><p class="small-text"><?php echo $total_earning ?></p></td>
		</tr>
<?php } ?>
?>
<?php 
foreach($hods as $hod){
$name = OtherHODDetails::where('user_id',$hod->id)->value('name');
$nic = OtherHODDetails::where('user_id',$hod->id)->value('nic');
$epf_no = OtherHODDetails::where('user_id',$hod->id)->value('epf_no');
$basic_salary = BasicSalary::where('user_id', $hod->id)
    ->where('month_year', '<=', $compareMonth)
    ->orderBy('month_year', 'DESC')
    ->value('basic_salary') ?? 0;
$employer = ($basic_salary*12)/100;
$employee = ($basic_salary*8)/100;
$total_earning = $basic_salary;
$total_employer_employee = $employer+$employee;
$total = $total + $total_employer_employee;
$employer_total = $employer_total + $employer;
$employee_total = $employee_total + $employee;
?>
		<tr>
			<td colspan="3" class="full-borderd"><p class="small-text"><?php echo $name ?></p></td>
			<td colspan="2" class="full-borderd"><p class="small-text"><?php echo $nic ?></p></td>
			<td class="full-borderd"><p class="small-text"><?php echo $epf_no ?></p></td>
			<td colspan="2" class="full-borderd"><p class="small-text"><?php echo $total_employer_employee ?></p></td>
			<td colspan="2" class="full-borderd"><p class="small-text"><?php echo $employer ?></p></td>
			<td colspan="2" class="full-borderd"><p class="small-text"><?php echo $employee ?></p></td>
			<td class="full-borderd"><p class="small-text"><?php echo $total_earning ?></p></td>
		</tr>
<?php } ?>
?>
<?php 
foreach($authorisers as $authoriser){
$name = OtherAuthoriserDetails::where('user_id',$authoriser->id)->value('name');
$nic = OtherAuthoriserDetails::where('user_id',$authoriser->id)->value('nic');
$epf_no = OtherAuthoriserDetails::where('user_id',$authoriser->id)->value('epf_no');
$basic_salary = BasicSalary::where('user_id', $authoriser->id)
    ->where('month_year', '<=', $compareMonth)
    ->orderBy('month_year', 'DESC')
    ->value('basic_salary') ?? 0;
$employer = ($basic_salary*12)/100;
$employee = ($basic_salary*8)/100;
$total_earning = $basic_salary;
$total_employer_employee = $employer+$employee;
$total = $total + $total_employer_employee;
$employer_total = $employer_total + $employer;
$employee_total = $employee_total + $employee;
?>
		<tr>
			<td colspan="3" class="full-borderd"><p class="small-text"><?php echo $name ?> </p></td>
			<td colspan="2" class="full-borderd"><p class="small-text"><?php echo $nic ?></p></td>
			<td class="full-borderd"><p class="small-text"><?php echo $epf_no ?></p></td>
			<td colspan="2" class="full-borderd"><p class="small-text"><?php echo $total_employer_employee ?></p></td>
			<td colspan="2" class="full-borderd"><p class="small-text"><?php echo $employer ?></p></td>
			<td colspan="2" class="full-borderd"><p class="small-text"><?php echo $employee ?></p></td>
			<td class="full-borderd"><p class="small-text"><?php echo $total_earning ?></p></td>
		</tr>
<?php } ?>
?>
		<tr>
			<td colspan="5"><p class="small-text">I certify that the information given above is correct.</p></td>
			<td class="full-borderd"><p class="small-text">Total</p></td>
			<td colspan="2"  class="full-borderd"><p class="small-text"><?php echo $total ?> </p></td>
			<td colspan="2"  class="full-borderd"><p class="small-text"><?php echo $employer_total ?></p></td>
			<td colspan="2"  class="full-borderd"><p class="small-text"><?php echo $employee_total ?></p></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="6"></td>
			<td colspan="7"><p class="small-text">Please write Employer's EPF Registration Number on the reverse of the cheque.</p></td>
		</tr>
		<tr>
			<td colspan="6"><p class="small-text"> Signature of Employer / <br>Telephone No</p></td>
			<td colspan="7"><p class="small-text">Telephone No :<br>Fax :<br>E-Mail :</p></td>
		<!--	<td colspan="2"></td>
			<td colspan="2"></td> -->
		</tr>
	</tbody>
</table>
</body>

</html>
